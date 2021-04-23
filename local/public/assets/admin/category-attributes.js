/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 01-Jun-16 5:40 PM
 * File Name    :
 */
var total_values = 0;
(function (factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as anonymous module.
        define(['jquery'], factory);
    } else if (typeof exports === 'object') {
        // Node / CommonJS
        factory(require('jquery'));
    } else {
        // Browser globals.
        factory(jQuery);
    }
})(function ($) {
    function Attribute() {

        this.$newAttribute = '';
        this.$addValue = '';
        this.$categories = '';


        this.$getCategoryURL = "http://localhost/shalmi/admin/category/get";
        this.$getAttributesURL = "http://localhost/shalmi/admin/category/get-attributes";
        this.$saveAttributesURL = "http://localhost/shalmi/admin/category/save-attribute";
        this.$saveValuesURL = "http://localhost/shalmi/admin/category/save-values";
        this.$deleteValueURL = "http://localhost/shalmi/admin/category/delete-values";
        this.$doneURL = "http://localhost/shalmi/admin/category/add-attribute";
        this.$parentCategory = $('#category');
        this.$loadChild = $('#load-child');
        this.$loading = $('#loading-div');
        this.$childCategory = $('.child-category');
        this.$mainHeading = $('.main_heading');
        this.$attributeForm = $('#attributes');
        this.$loadChildBox = $('#load-child-box');
        this.$assignAttributes = $('#assign-attribute');
        this.$mainWrapper = $('.task_inner_wrapper');

        this.init();
    }

    Attribute.prototype = {
        Constructor: Attribute,

        init: function () {
            this.addListener();
        },

        addListener: function () {
            this.$parentCategory.on('change', $.proxy(this.change, this));
            this.$loadChild.on('click', $.proxy(this.loadChild, this));
            this.$assignAttributes.on('click', $.proxy(this.getAttributes, this));
        },
        addDynamicListener: function (element, event, method) {
            //alert('here');
            element.on(event, $.proxy(method, this));
        },
        loadChild: function (target) {
            var $catId = $(target.target).parents('.add-form-block').find('select').val();
            this.getCategory($catId);
        },
        getCategory: function (catId) {
            $.ajaxSetup(
                {
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    }
                });
            var _this = this;
            $.ajax(this.$getCategoryURL, {
                type: 'post',
                data: {catId: catId},
                dataType: 'json',
                //processData: false,
                //contentType: false,
                beforeSend: function () {
                    _this.submitStart();
                },
                success: function (data) {
                    _this.submitDone(data);
                },

                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    _this.submitFail(textStatus || errorThrown);
                },
                complete: function () {
                    _this.submitEnd();
                }
            });
        },
        change: function () {

            //this.getCategory(this.$parentCategory.val());
        },

        getAttributes: function (event) {
            event.preventDefault();
            if ($(event.target).is(':disabled')) {
                // alert('here')
            }
            this.$catId = $('#all-categories .add-form-block:last').prev().find('select').val();
            this.$parentCatId = $('#all-categories .add-form-block:last').prev().prev().find('select').val();
            if (this.$parentCatId === undefined || this.$parentCatId === null) {
                this.$parentCatId = 0;
            }

            this.ajaxGetAttributes(this.$catId, this.$parentCatId);

        },

        ajaxGetAttributes: function (catId, parentCatId) {
            $.ajaxSetup(
                {
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    }
                });
            var _this = this;
            $.ajax(this.$getAttributesURL, {
                type: 'post',
                data: {catId: catId, parentCatId: parentCatId},
                dataType: 'json',
                //processData: false,
                //contentType: false,
                beforeSend: function () {
                    _this.submitStart();
                },
                success: function (data) {
                    _this.getAttributeDone(data);
                },

                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    _this.submitFail(textStatus || errorThrown);
                },
                complete: function () {
                    _this.submitEnd();
                }
            });
        },
        initMultiSelect: function () {
            $('select[multiple]').multiselect({
                columns: 2,
                search: true,
                selectAll: true,
                texts: {
                    placeholder: 'Select attributes'
                }
            });
        },
        getAttributeDone: function (data) {
            if (data.selected.length === 0) {
                this.$mainWrapper.append('<div class="assigned-task-wrapper"><div class="add-form-block" id="attribute-not-found"> <div class="user-title" >No attribute found</div></div><div class="add-form-block" id="add-new-attribute"><div class="user-input"> <button type="button" class="orngBtn mr10" id="add-new-attribute-btn">Add Attributes</button><button  id="btn-save-attributes" class="greyBtn" type="button">Save</button></div></div> </div>');
                // this.addDynamicListener($('#add-new-attribute-btn'), 'click', 'appendAttributeField');
            } else {

                var options = '';
                var selectedObj = $(data.selected).toArray();
                $.each(data.allAttributes, function (index, value) {
                    var selected = '';
                    if ($.inArray(parseInt(value.store_attribute_id), selectedObj) != -1) {
                        selected = 'selected="selected"';
                    }

                    if(value.attribute != null){
                        options += '<option value="' + value.store_attribute_id + '" ' + selected + '>' + value.attribute.label + '</option>';
                    }

                });
                this.$allAttributes = options;
                this.$mainWrapper.append('<div class="assigned-task-wrapper"><div class="add-form-block" id="all-attributes"> </div><div class="add-form-block" id="add-new-attribute"><div class="user-input"> <button type="button" class="orngBtn mr10" id="add-new-attribute-btn">Add Attributes</button><button  id="btn-save-attributes" class="greyBtn" type="button">Save</button></div></div> <div class="clrfix"></div></div>');

                this.appendAttributes(this.$categories);
                $('#all-attributes').append(this.$appendAttributes);
                this.initMultiSelect();
            }
            $('#btn-save-attributes').on('click', $.proxy(this.saveAttributes, this));
            $('#add-new-attribute-btn').on('click', $.proxy(this.appendAttributeField, this));

            this.$loadChildBox.remove();
            this.$assignAttributes.prop('disabled', true);
        },

        appendAttributeField: function () {

            var html = '<div class="add-form-block">' +
                '<div class="user-title">Add Attribute * :</div> ' +
                '<div class="user-input"><input type="text" name="attribute[]" class="user-input"></div>' +
                '<div id="line_item_attribute"><span>Line Item Attribute:</span>' +
                    '<input type="checkbox" name="line_item_attributes[]" value="1" class="line_item_attribute"><span class="remove-field">x</span>' +
                '</div>';
            $('#attribute-not-found').remove();
            $(html).insertBefore($('#add-new-attribute'));
            $('.remove-field').unbind('click');
            $('.remove-field').on('click', $.proxy(this.removeField, this));
            /* this.saveAttributeBtn = $('#btn-save-attributes');
             if (this.saveAttributeBtn.length == 0) {
             $('#add-new-attribute .user-input').append('<button  id="btn-save-attributes" class="greyBtn" type="button">Save</button>');
             $('#btn-save-attributes').on('click', $.proxy(this.saveAttributes, this));
             }*/

        },

        saveAttributes: function () {
            var attributes = $("input[name='attribute[]']")
                .map(function () {
                    return $(this).val();
                }).get();
            var selectedAttributes = $("select[name='all_attributes[]']").val();
            var lineItemAttributesEl = $("input[name='line_item_attributes[]']");
            this.$selectedAttributes = 0;
            var lineItemAttributes = [];
            if (selectedAttributes != null || selectedAttributes != 'undefined') {
                this.$selectedAttributes = selectedAttributes;
            }
            if (lineItemAttributesEl != null || lineItemAttributesEl != 'undefined') {
                $(lineItemAttributesEl).each(function (i, item) {
                    if ($(item).is(':checked')) {
                        lineItemAttributes.push(1);
                    }else{
                        lineItemAttributes.push(0);
                    }
                });
            }
            this.saveAttributeAjax(attributes, lineItemAttributes);
        },


        saveAttributeDone: function (data) {
            //$('#btn-save-attributes').prop('disabled', true);
            //$('#add-new-attribute-btn').prop('disabled', true);
            var html = '';
            var values = '';
            var block = '';
            $('.all-selected-attributes').siblings('.done-btn').remove();
            $('.all-selected-attributes').remove();
            $.each(data.attributeValues, function (index, value) {
                var checked = '';
                if(value.is_default == '1'){
                    checked = 'checked="checked"'
                }
                var addedValueHeading = '<div class="added-value"> No value found</div>';
                html = '<div class="main_heading" style="padding: 17px 0 0 18px;"><h1>' + value.attribute.label + '</h1><div class="default-attribute" title="Make default attribute for add product">Is default <input class="default-checkbox" type="checkbox" name="default_' + value.attribute.id + '" value="1" '+checked+'></div></div>';
                if (value.attribute_values.length != 0) {
                    addedValueHeading = '<div class="added-value"> Added Values:</div>';
                    $.each(value.attribute_values, function (index, data) {
                        values += '<div class="value-box"> <span class="value-text">' + data.value + '</span><span class="remove-value" data-id="' + data.id + '">x</span></div>';
                    });
                }

                block += '<div class="value-block">' + html + '<div class="add-form-block added-values-' + value.attribute.id + '">' + addedValueHeading + values + '</div><div class="add-form-block add-value-btn" id="add-value-block-' + value.attribute.id + '"><div class="user-title">&nbsp;</div><div class="user-input"><p class="unique_code_msg_'+value.attribute.id+'"></p><button id="" class="save_val_btn_' + value.attribute.id + ' orngBtn mr10 add-new-value" data-id="' + value.attribute.id + '" type="submit">Add New Value</button><button  id="" class="save_attr_value_btn_' + value.attribute.id + ' greyBtn save-value" type="button" data-id="' + value.attribute.id + '">Save</button></div></div></div>';
                values = '';
            });
            var wholeBlock = '<div class="assigned-task-wrapper all-selected-attributes">' + block + '</div><div class="user-input done-btn"><a href="' + this.$doneURL + '" class="orngBtn mr10"  type="submit">Done</a></div>';
            this.$mainWrapper.append(wholeBlock);
            $('.add-new-value').on('click', $.proxy(this.appendNewValueField, this));
            $('.save-value').on('click', $.proxy(this.saveValue, this));
            $('.remove-value').unbind('click');
            $('.remove-value').on('click', $.proxy(this.removeValue, this));

        },
        removeField: function ($this) {
            $($this.target).parents('.add-form-block').remove();
        },
        appendNewValueField: function ($this) {
          total_values++;
            var attributeId = $($this.target).data('id');
            var html =
                '<div class="add-form-block add-value-field-' + attributeId + '">' +
                    '<div class="user-title">Add Value * :</div>' +
                    '<div class="user-input">' +
                        '<input type="text" name="values_' + attributeId + '[]" class="user-input attribute_values">' +
                    '</div>' +
                    '<div style="margin-top: 50px;">'+
                        '<div class="user-title clearfix">Add Code * :</div>' +
                        '<div class="user-input">' +
                            '<input required="required" minlength="2" maxlength="3" onchange="isUniqueCode(' + attributeId + ', '+total_values+');" id="code_'+total_values+'" type="text" name="codes_' + attributeId + '[]" data-attr_id="'+ attributeId + '[]"  class="unique_code user-input">' +
                        '</div>' +
                    '</div>'+
                    '<span class="remove-field">x</span>' +
                '</div>';
            //$('#add-value-block-'+attributeId).remove();
            $(html).insertBefore($('#add-value-block-' + attributeId));
            $('.remove-field').unbind('click');
            $('.remove-field').on('click', $.proxy(this.removeField, this));
        },
        saveValue: function ($this) {
          var is_empty_value_input = false;
          var is_empty_code_input  = false;
          var is_valid_code_input  = true;
          var attributeId = $($this.target).data('id');
          var values = $("input[name='values_" + attributeId + "[]']")
              .map(function () {
                if(/^[a-zA-Z0-9- ]*$/.test($(this).val()) == false) {
                  $(this).css('border', '1px solid red');
                  alert('Your attribute values string contains illegal characters.');
                  is_valid_code_input = false;
                }
                if ($(this).val() == ''){
                  $(this).css('border', '1px solid red');
                  is_empty_value_input = true;
                }
                return $(this).val();
              }).get();

          var codes = $("input[name='codes_" + attributeId + "[]']")
              .map(function () {
                if(/^[a-zA-Z0-9- ]*$/.test($(this).val()) == false) {
                  $(this).css('border', '1px solid red');
                  alert('Your code values string contains illegal characters.');
                  is_valid_code_input = false;
                }
                if ($(this).val() == ''){
                  $(this).css('border', '1px solid red');
                  is_empty_code_input = true;
                }
                return $(this).val();
              }).get();
          if (values.length == 0) {
            //alert('Please add Values');
            //return false;
          }
          var defaultAttr = 0;
          if(is_empty_value_input == true || is_empty_code_input == true){
            alert('Please provide valid data.');
            return false;
          }

          if(is_valid_code_input == false){
            alert('Please provide valid data.');
            return false;
          }
            if ($('input[name="default_' + attributeId + '"]').is(':checked'))
                defaultAttr = 1;  // checked
            var catId = $('#all-categories .add-form-block:last').prev().find('select').val();
            this.ajaxSetup();
            var _this = this;
            $.ajax(this.$saveValuesURL, {
                type: 'post',
                data: {attributeId: attributeId, values: values, codes: codes, defaultAttr:defaultAttr, catId:catId},
                dataType: 'json',
                //processData: false,
                //contentType: false,
                beforeSend: function () {
                    _this.submitStart();
                },
                success: function (data) {
                    _this.saveValueDone(data, attributeId);
                },

                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    _this.submitFail(textStatus || errorThrown);
                },
                complete: function () {
                    _this.submitEnd();
                }
            });

        },
        saveValueDone: function (result, attributeId) {
            $('.add-value-field-' + attributeId).remove();
            if (result.length != 0) {
                var heading = '<div class="added-value"> Added Values:</div>';
                var values = '';
                $.each(result, function (id, value) {
                    values += '<div class="value-box"> <span class="value-text">' + value + '</span><span class="remove-value" data-id="' + id + '">x</span></div>';
                });

                $('.added-values-' + attributeId).empty().append(heading + values);
                $('.remove-value').unbind('click');
                $('.remove-value').on('click', $.proxy(this.removeValue, this));
            }

        },
        removeValue: function ($this) {
            /*var confirm = confirm("Are you sure!");
             if (confirm == false) {
             return false;
             }*/
            var valueId = $($this.target).data('id');
            this.ajaxSetup();
            var _this = this;
            $.ajax(this.$deleteValueURL, {
                type: 'post',
                data: {valueId: valueId},
                dataType: 'json',
                //processData: false,
                //contentType: false,
                beforeSend: function () {
                    _this.submitStart();
                },
                success: function (data) {
                    if(data == 1){
                        $($this.target).parents('.value-box').remove();
                    }else{
                        alert("This attribute value is being used, so this could not be deleted.");
                    }
                    //_this.saveAttributeDone(data);
                },

                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    _this.submitFail(textStatus || errorThrown);
                },
                complete: function () {
                    _this.submitEnd();
                }
            });
        },
        ajaxSetup: function () {
            $.ajaxSetup(
                {
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    }
                });
        },
        saveAttributeAjax: function (attributes, lineItemAttributes) {
            this.ajaxSetup();
            var _this = this;
            $.ajax(this.$saveAttributesURL, {
                type: 'post',
                data: {catId: this.$catId, attributes: attributes, selectedAttributes: this.$selectedAttributes, lineItemAttributes: lineItemAttributes},
                dataType: 'json',
                //processData: false,
                //contentType: false,
                beforeSend: function () {
                    _this.submitStart();
                },
                success: function (data) {
                    _this.saveAttributeDone(data);
                },

                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    _this.submitFail(textStatus || errorThrown);
                },
                complete: function () {
                    _this.submitEnd();
                }
            });

        },
        submitStart: function () {

            this.$loading.fadeIn();
        },
        submitDone: function (data) {
            this.$loadChildBox.remove();

            if (data.length === 0) {
                return false;
            }

            var options = '';
            $.each(data, function (index, value) {
                options += '<option value="' + index + '">' + value + '</option>';
            });
            this.$categories = options;
            this.appendChildCategories(this.$categories);
            $(this.$appendCategory).insertBefore('.assign-btn');
            this.$loadChild = $('#load-child');
            this.$loadChild.on('click', $.proxy(this.loadChild, this));
            this.$loadChildBox = $('#load-child-box');
        },
        submitEnd: function () {
             this.$loading.fadeOut();
        },
        submitFail: function (msg) {
            this.alert(msg);
        },
        appendChildCategories: function (categories) {

            this.$appendCategory = '<div class="add-form-block"><div class="user-title">Select Child Category * :</div><div class="user-input"><select name="categories" id="" class="user-input child-category">' + this.$categories + '</select></div><div id="load-child-box" style="margin-left: 20px" class="user-input"><button id="load-child" class="orngBtn mr10" type="button">Load Child Category</button></div></div>';
        },
        appendAttributes: function () {
            this.$appendAttributes = '<div class="add-form-block"><div class="user-title">Select Attributes * :</div><div class="user-input"><select name="all_attributes[]" id="" class="user-input child-category" multiple="multiple">' + this.$allAttributes + '</select></div></div>';
        },
        alert: function (msg) {
            var $alert = [
                '<div class="alert alert-danger avatar-alert alert-dismissable">',
                '<button type="button" class="close" data-dismiss="alert">&times;</button>',
                msg,
                '</div>'
            ].join('');

            this.$mainHeading.after($alert);
        }
    };

    $(function () {
        return new Attribute();
    });
});

function isUniqueCode(attributeId, current_total_values) {
  var code = $("#code_"+current_total_values).val();
      $.ajaxSetup({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            }
      });
      var isUniqueCodeURL = "http://localhost/shalmi/admin/category/attribute-value-unique-code";
      $(".save_attr_value_btn_"+attributeId).prop("disabled", true);
      var category_id = $('select[name="categories"] :selected').last().val();

      $.ajax(isUniqueCodeURL, {
        type: 'post',
        data: {category_id: category_id, code: code},
        success: function (data) {
          $(".unique_code_msg_"+attributeId).html('');
          if(data > 0){
            $(".save_attr_value_btn_"+attributeId).prop("disabled", false);
          }else{
              $(".unique_code_msg_"+attributeId).html('Please select unique code for attribute value.');
            $(".save_attr_value_btn_"+attributeId).prop("disabled", true);
          }
        }
      });
}
