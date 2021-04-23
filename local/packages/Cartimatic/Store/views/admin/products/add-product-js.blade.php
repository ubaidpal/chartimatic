{{--

    * Created by   :  Muhammad Yasir
    * Project Name : shalmi
    * Product Name : PhpStorm
    * Date         : 23-Dec-16 4:37 PM
    * File Name    : 

--}}
<script>
    var variationUpdated = true;
    var loading = $("#loadingIcon");
    function alertMessage(msg, status) {
        status = status || 'alert-danger';
        if (status == 200) {
            status = "alert-success"
        }
        var $alert = [
            '<div class="alert ' + status + ' avatar-alert alert-dismissable">',
            '<button type="button" class="close" data-dismiss="alert">&times;</button>',
            msg,
            '</div>'
        ].join('');

        $('.alerts').empty().html($alert);
    }
    $(document).ready(function () {

        var isSetStockOpening = "{{$isStockOpening}}";

        var stockOpeningForm = $('#opening-stock-form');
        var stockOpeningBtn = $('#opening-stock-btn');
        stockOpeningBtn.click(function () {
            if (!isSetStockOpening) {
                alertMessage("Please map opening stock supplier.");
                return false;
            }
            var keepingRows = $('#product-keeping').find('tbody tr');
            $(keepingRows).each(function () {
                if ($(this).data('quantity') != -1) {
                    alertMessage("Transaction exists against this product, opening can't be entered");
                    return false;
                }
            });

            var data = stockOpeningForm.serialize();
            $.ajax({
                type: "POST",
                data: data,
                url: "{{url('store/'.$user->username.'/admin/opening-stock')}}",
                success: function (response) {
                    alertMessage('Opening stock added successfully!', 200);
                    console.log('response', response)

                }, beforeSend: function () {
                    stockOpeningBtn.prop('disabled', true);
                }, error: function (XMLHttpRequest, textStatus, errorThrown) {

                    alertMessage(XMLHttpRequest.responseText || textStatus);
                    stockOpeningBtn.prop('disabled', false);
                }, complete: function () {
                    stockOpeningBtn.prop('disabled', false);
                }
            });
            return false;

        });
        $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
            var type = $(e.target).data('type');


            if (type == 'opening-stock') {
                if (!isVariantsAdded) {
                    alertMessage("Please add variations first!");
                    e.preventDefault();
                }
            } else if (type == 'variations') {
                var defaultAttiCheckBox = $('#default-attributes');
                defaultAttributes = 0;
                if(defaultAttiCheckBox.is(':checked')){
                    var defaultAttributes = 1;
                }
                var attr = $('input.attributes:checked');
                if (attr.length == 0) {
                    alertMessage("Please add attributes first!");
                    e.preventDefault();
                    return false;
                }

                $.ajax({
                    url: "{{url('store/'.$user->username.'/admin/get-variation-list')}}",
                    type: "POST",
                    data: {product_id: $('#new_product_id').val(),default_attribute:defaultAttributes},
                    beforeSend: function () {
                        loading.show();
                    }, success: function (response) {
                        addVariations(response);
                    }, error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alertMessage(XMLHttpRequest.responseText || textStatus);
                    }, complete: function () {

                        loading.hide();
                    }
                });
            }

            //e.target // newly activated tab
            // e.relatedTarget // previous active tab
        })
    });
    function addVariations(response) {
        var html = '';
        html += '<input type="hidden" name="master1" value="' + response.attribute1Id + '"> ' +
            '<input type="hidden" name="master2" value="' + response.attribute2Id + '">';
        $.each(response.variations, function () {
            var price;
            var updatePrice = '';
            var keepingId = '';
            if (this.is_new == 1) {

                price = '<input type="text" name="variation[' + this.value1Id + '-' + this.value2Id + '][price]" class="keeping_price form-control col-md-12 col-xs-12" placeholder="e.g 99.99" value="'+this.price+'">';
            } else {
                price = this.price;
                updatePrice = '<li> ' +
                    '<a class="price-pop" data-id="' + this.keeping_id + '">' +
                    '<i class="fa fa-print"></i>' +
                    '</a>' +
                    '</li>';
                keepingId = this.keeping_id;
            }

            html += '<div class="x_panel"> ' +
                '<div class="form-group col-md-2">' +
                '<input type="hidden" name="variation[' + this.value1Id + '-' + this.value2Id + '][variation1]" value="' + this.value1Id + '"> ' +
                '<input type="hidden" name="variation[' + this.value1Id + '-' + this.value2Id + '][variation2]" value="' + this.value2Id + '"> ' +
                '<div class="col-md-12 col-sm-12 col-xs-12 attribute-1-value" id="attribute-1-value">' +
                this.value1 +
                '</div>' +
                '</div>' +
                '<div class="form-group col-md-2">' +
                '<div class="col-md-12 col-sm-12 col-xs-12 attribute-2-value" id="attribute-2-value">' +
                this.value2 +
                '</div>' +
                '</div>' +
                '<div class="form-group col-md-2">' +
                '<div class="col-md-12 col-sm-12 col-xs-12" id="price-' + keepingId + '">' +
                price +
                '</div>' +
                '</div>' +
                '<div class="form-group col-md-2">' +
                '<div class="col-md-12 col-sm-12 col-xs-12" id="start_date-' + keepingId + '">' +
                this.start_date +
                '</div>' +
                '</div>' +
                '<div class="col-md-1">' +
                '<ul class="nav navbar-right panel_toolbox">' +
                '<li>' +
                '<a class="close-link"><i class="fa fa-times" data-quantity="'+this.quantity+'" data-id="'+keepingId+'"></i></a>' +
                '</li>' +
                updatePrice +
                '</ul>' +
                '</div>' +
                '</div>';
        })
        $('.inventoryPricing-wrapper').empty().html(html);
    }
</script>
