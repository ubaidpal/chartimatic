(function (factory) {
    if (typeof define === 'function' && define.amd) {
        define(['jquery'], factory)
    } else if (typeof define === 'object') {
        factory(require('jquery'))
    } else {
        factory(jQuery)
    }
})(function ($) {
    function GRN() {
        this.$rootUrl = '/admin/store/grn';
        this.$purchaseOrder = $('#purchase-order');
        this.$productCode = $('#product_code');
        this.$invoiceNumber = $('#invoice_number');
        this.$invoiceAmount = $('#invoice_amount');
        this.$totalAmount = $('#total_amount');
        this.$suppliers = $('#suppliers');
        this.$allOtherExpense = $('.other-expense');
        this.$importGrnFile = $('#grn-btn');
        this.$grnFile = $('#grn-file');
        this.$generateBarcode = $('#generate-barcode');
        this.$productTable = '';
        this.$productTable = '';
        this.$isPoAdded = false;
        this.$purchaseOrderUrl = this.$rootUrl + "/get-purchase-order";
        this.$serachProductUrl = this.$rootUrl + "/searchProducts";
        this.$singleProductDetailUrl = this.$rootUrl + "/product-detail";
        this.$getSupplierOrdersUrl = this.$rootUrl + "/get-purchase-orders";
        this.$deletGrnProduct = this.$rootUrl + "/delete-product";
        this.$importGrnDataUlr = this.$rootUrl + "/upload";
        this.$printBarcodeDataUrl = this.$rootUrl + "/print-barcode";
        this.$printBarcodeUrl = this.$rootUrl + "/print-barcode";
        this.init();
    }


    GRN.prototype = {
        constructor: GRN,
        updateAmountFields: function () {
            var total = 0,
                loading = (!isNaN(parseFloat($('#loading').val())) ? parseFloat($('#loading').val()) : 0),
                freight = (!isNaN(parseFloat($('#freight').val())) ? parseFloat($('#freight').val()) : 0),
                other = (!isNaN(parseFloat($('#other_expense').val())) ? parseFloat($('#other_expense').val()) : 0),
                adj_amount = (!isNaN(parseFloat($('#adj_amount').val())) ? parseFloat($('#adj_amount').val()) : 0),
                sales_tex = (!isNaN(parseFloat($('#sales_tax_p').val())) ? parseFloat($('#sales_tax_p').val()) : 0),
                invoiceTotal = (!isNaN(parseFloat(this.$invoiceAmount.val())) ? parseFloat(this.$invoiceAmount.val()) : 0);

            total = parseFloat(total) + invoiceTotal;
            total = loading + freight + other + adj_amount + total;
            if (sales_tex != 0) {
                var tax = (total * sales_tex) / 100;
                total = total + tax;
                $('#sales_tax_amount').val(tax.toFixed(2))
            } else {
                $('#sales_tax_amount').val(0)
            }
            this.$totalAmount.val(total.toFixed(2))
        },
        appendProducts: function (data) {

            this.$productTable.column(6).visible(false);

            this.$productTable.clear().rows.add(data.products).draw();
            this.$invoiceNumber.val(data.po_detail.id);
            this.$invoiceAmount.val(data.po_detail.invoice_total);
            this.$totalAmount.val(data.po_detail.invoice_total);
            this.updateAmountFields();
            this.$isPoAdded = true;
        },
        initDataTable: function () {
            this.$productTable = $("#products").DataTable({
                dom: "Bfrtip",
                buttons: [{
                    extend: "copy",
                    className: "btn-sm"
                }, {
                    extend: "csv",
                    className: "btn-sm"
                }, {
                    extend: "excel",
                    className: "btn-sm"
                }, {
                    extend: "pdf",
                    className: "btn-sm"
                }, {
                    extend: "print",
                    className: "btn-sm"
                }],
                responsive: !0,
                "ordering": false,
            });
            if ($('#grn-edit').length == 0) {
                this.$productTable.column(6).visible(false);
            }
        },
        getPurchaseOrder: function (ele) {
            var purchaseOrder = $(ele.target).val();
            if (purchaseOrder == '') {
                return false;
            }
            var _this = this;
            this.ajaxSetup();
            $.ajax({
                type: "POST",
                url: this.$purchaseOrderUrl,
                data: {id: purchaseOrder},
                beforeSend: function () {
                    // _this.submitStart();
                },

                success: function (data) {
                    _this.appendProducts(data);
                },

                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    _this.submitFail(textStatus || errorThrown);
                },

                complete: function () {
                    //_this.submitEnd();
                }
            })
        }

        ,
        submitFail: function (msg) {
            this.alert(msg);
        }
        ,
        alert: function (msg) {
            var $alert = [
                '<div class="alert alert-danger avatar-alert alert-dismissable">',
                '<button type="button" class="close" data-dismiss="alert">&times;</button>',
                msg,
                '</div>'
            ].join('');

            $('.ajax-error').empty().html($alert);
        }
        ,
        getPurchaseOrders: function (ele) {
            var supplier = $(ele.target).val();
            this.ajaxSetup();
            var _this = this;
            $.ajax({
                type: "POST",
                url: this.$getSupplierOrdersUrl,
                data: {id: supplier},
                beforeSend: function () {
                    // _this.submitStart();
                },

                success: function (data) {
                    var html = '<option value="">Select</option>';
                    $.each(data, function (i, value) {
                        html += '<option value="' + value.id + '">' + value.id + '</option>'
                    });
                    _this.$purchaseOrder.html(html);
                    _this.$purchaseOrder.prop('disabled', false);
                    //  _this.appendProduct(data);
                },

                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    _this.submitFail(textStatus || errorThrown);
                },

                complete: function () {
                    //_this.submitEnd();
                }
            })
        },
        grnFileTrigger: function () {
            if (this.$suppliers.val() == '') {
                this.alert('Please select supplier!');
                return false;
            } else {
                $('.alert-danger').remove();
                this.$purchaseOrder.prop('disabled', true)
            }
            this.$grnFile.trigger('click');
        },
        importGrnData: function () {
            var formData = new FormData();
            formData.append('grn_file', this.$grnFile[0].files[0]);
            this.ajaxSetup();
            var _this = this;
            $.ajax({
                type: "POST",
                url: this.$importGrnDataUlr,
                data: formData,
                processData: false,  // tell jQuery not to process the data
                contentType: false,  // tell jQuery not to set contentType

                beforeSend: function () {
                    // _this.submitStart();
                },

                success: function (data) {
                    if (data.error == 1) {
                        _this.submitFail(data.message);
                    }
                    _this.$productTable.clear().rows.add(data).draw();
                    //this.$isPoAdded = true;
                },

                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    _this.submitFail(textStatus || errorThrown);
                },

                complete: function () {
                    //_this.submitEnd();
                }
            })

        },
        generateBarcode: function () {
            var data = $('#grn-form').serialize();
            var fields = $('#grn-form').find('[name*=products]').length;
            if (fields == 0) {
                this.alert('Please add at least one product');
                return false;
            }
            var _this = this;
            this.ajaxSetup();

            $.ajax({
                type: "POST",
                url: this.$printBarcodeDataUrl,
                data: data,
                beforeSend: function () {
                    // _this.submitStart();
                },

                success: function (data) {
                    if (data.error == 1) {
                        _this.alert(data.message);
                    } else if (data.error == 0) {
                        window.open(_this.$printBarcodeUrl, '_blank')
                    }

                },

                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    _this.submitFail(textStatus || errorThrown);
                },

                complete: function () {
                    //_this.submitEnd();
                }
            })

        },
        addListener: function () {
            this.$purchaseOrder.on('change', $.proxy(this.getPurchaseOrder, this));
            this.$suppliers.on('change', $.proxy(this.getPurchaseOrders, this));
            this.$allOtherExpense.on('change', $.proxy(this.updateAmountFields, this));
            this.$grnFile.on('change', $.proxy(this.importGrnData, this));
            this.$importGrnFile.on('click', $.proxy(this.grnFileTrigger, this));
            this.$generateBarcode.on('click', $.proxy(this.generateBarcode, this));
        }
        ,
        appendProduct: function (data) {
            if (this.$isPoAdded) {
                if ($('#grn-edit').length == 0) {
                    this.$productTable.clear();
                }
                this.$isPoAdded = false;
            }
            this.$productTable.column(6).visible(true);
            this.$productTable.row.add(data).draw();
        },
        deleteProduct: function (ele) {
            var keeping = ele.data('keeping');
            var id = ele.data('id');
            var grn = ele.data('grn');
            this.ajaxSetup();
            var _this = this;
            $.ajax({
                type: "POST",
                url: this.$deletGrnProduct,
                data: {id: id, keeping: keeping, grn: grn},
                beforeSend: function () {
                    // _this.submitStart();
                },

                success: function (data) {
                    if (data.error == 0) {
                        _this.$productTable
                            .row(ele.parents('tr'))
                            .remove()
                            .draw();
                    }
                    //console.log($("#purchase-order").find("option[value='']"))
                },

                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    _this.submitFail(textStatus || errorThrown);
                },

                complete: function () {
                    //_this.submitEnd();
                }
            })
        },
        getProductDetail: function (productId) {
            this.ajaxSetup();
            var _this = this;
            $.ajax({
                type: "POST",
                url: this.$singleProductDetailUrl,
                data: {id: productId},
                beforeSend: function () {
                    // _this.submitStart();
                },

                success: function (data) {
                    //console.log($("#purchase-order").find("option[value='']"))
                    $("#purchase-order").find("option[value='']").prop('selected', true);
                    _this.$invoiceNumber.val('');
                    _this.$invoiceAmount.val('');
                    _this.$totalAmount.val('');
                    _this.updateAmountFields();
                    _this.appendProduct(data);
                },

                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    _this.submitFail(textStatus || errorThrown);
                },

                complete: function () {
                    //_this.submitEnd();
                }
            })
        },
        autoComplete: function () {
            if (this.$productCode.length != 0) {


                this.$productCode.autocomplete({
                    source: this.$serachProductUrl
                })
                    .data("ui-autocomplete")._renderItem = function (ul, item) {
                    return $("<li>")
                        .data("item.ui-autocomplete", item)
                        .append("<a class='add-grn-product' data-title='" + item.title + "' data-id='" + item.id + "' data-keeping-id='" + item.keeping_id + "' data-unit-price='" + item.cost_price + "'>" + item.title + ' ' + item.master_attribute_1_value + '-' + item.master_attribute_2_value + "</a>")
                        .appendTo(ul);
                };
            }

            //$('.add-grn-product').unbind('click');
            //$('.add-grn-product').on('click', $.proxy(this.getProductDetail, this));
        },
        init: function () {
            this.addListener();
            this.autoComplete();
            this.initDataTable();
        }
        ,
        ajaxSetup: function () {
            $.ajaxSetup(
                {
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    }
                });
        }
    }
    ;
    var grn = new GRN();
    $(document).on('click', '.add-grn-product', function (e) {
        var product_id = $(this).data('id');
        var keeping_id = $(this).data('keeping-id');
        var unit_price = $(this).data('unit-price');
        var title = $(this).data('title');

        grn.getProductDetail(keeping_id)

    });
    $(document).on('click', '.remove-row', function (e) {
        // grn.removeRow($(this));
        if ($(this).hasClass('update')) {
            grn.deleteProduct($(this))
        } else {
            grn.$productTable
                .row($(this).parents('tr'))
                .remove()
                .draw();
        }

    });

    return grn;

});
