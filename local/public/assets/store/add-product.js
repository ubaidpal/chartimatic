/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 09-Jun-16 11:16 AM
 * File Name    :
 */
$(document).ready(function () {
    var data = [
        {id: 0, text: 'enhancement'},
        {id: 1, text: 'bug'},
        {id: 2, text: 'duplicate'},
        {id: 3, text: 'invalid'},
        {id: 4, text: 'wontfix'}
    ];
    /* $(".select2_single").select2({
     placeholder: "Select a state",
     allowClear: true
     });
     $(".select2_group").select2({});*/

});
var attribute_1_values_html = '';
var attribute_2_values_html = '';
function initMultiSelect(selected_attributes) {
    for(var i=1; i<= $("#product-attributes select").length;i++){
        $(".select2_multiple_"+i).select2({
            placeholder: "Select Attribute Value",
            allowClear: true,
        }).select2('val', selected_attributes);
    }


}

function appendAttributes(attributes, selected_attributes) {
    var attributeHtml = '';
    var count = 0;
    $.each(attributes, function (index, values) {
        count++;
        var attributeValues = '';
        $.each(values.attribute_values, function (index, data) {
            attributeValues += '<option value="' + data.id + '" >' + data.value + '</option>';
        });

        var spanHtml = '';

        if(values.is_default == 0){
            var selectionOfAttributeIsRequired = "select2_multiple select2_multiple_"+count+" form-control";
        }

        if(values.is_default == 1){
            var selectionOfAttributeIsRequired = "select2_multiple select2_multiple_"+count+" form-control this_attribute_required";
            var spanHtml = '<span class="required">*</span>';
        }

        attributeHtml += '<div class="form-group"><label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">' + values.attribute.label + '<input type="hidden" tabindex="'+count+'" name="attributeId[]" value="' + values.attribute.id + '">'+spanHtml+'</label><div class="col-md-6 col-sm-6 col-xs-12"><select class="'+selectionOfAttributeIsRequired+'" multiple="multiple" name="attributeValues-' + values.attribute.id + '[]">' + attributeValues + '</select></div></div> ';
    });
    $('#product-attributes-wrapper').empty().append(attributeHtml);
    initMultiSelect(selected_attributes);
}


function appendAttributesForInventory(data) {


    $('#attribute-1').empty().text(data[0].attributeDetail.label);
    $('#attribute-2').empty().text(data[1].attributeDetail.label);

    var attributeValues = '';
    $.each(data[0].attribute_values, function (index, row) {
        attributeValues += '<option value="' + row.id + '" >' + row.value + '</option>';
    });
    attribute_1_values_html = '<input type="hidden" name="master_attribute_1[]" value="' + data[0].attributeDetail.id + '"><select  class="form-control col-md-12 col-xs-12 select_box_of_master_attr1" name="master_attribute_1_value[]">' + attributeValues + '</select>';

    $('.attribute-1-value').empty();
    $('.attribute-1-value').append(attribute_1_values_html);

    attributeValues = '';
    $.each(data[1].attribute_values, function (index, row) {
        attributeValues += '<option value="' + row.id + '" >' + row.value + '</option>';
    });
    attribute_2_values_html = '<input type="hidden" name="master_attribute_2[]" value="' + data[1].attributeDetail.id + '"><select  class="form-control col-md-12 col-xs-12 select_box_of_master_attr2" name="master_attribute_2_value[]">' + attributeValues + '</select>';
    $('.attribute-2-value').empty();
    $('.attribute-2-value').append(attribute_2_values_html);
}
