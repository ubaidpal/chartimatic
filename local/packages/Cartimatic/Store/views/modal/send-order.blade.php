{{--

    * Created by   :  Muhammad Yasir
    * Project Name : shalmi
    * Product Name : PhpStorm
    * Date         : 13-May-16 11:09 AM
    * File Name    : 

--}}


{!! HTML::style('local/public/assets/gentelella/css/animate.min.css') !!}

{!! Form::open( [ 'url' => url( "store/" . Auth::user()->username . "/admin/add-courier-service-info/" . $order_id . "/" . $param ), "id" => "add_courier_service_info_".$order_id, "enctype" => "multipart/form-data" ,'novalidate'] )  !!}
<div class="">
    <div class="col-sm-12">
        <h2>Add Courier Service Information</h2>
    </div>

    <div class="col-sm-12" style="margin-bottom: 10px">
        <div class="form-group">
            <label class="col-sm-5 text-right">
                Courier Service Title:
            </label>

            <div class="col-sm-7">
                <input type="text" name="courier_service_name" id="courier_service_name_{{$order_id}}"
                       placeholder="Enter Courier Service Title" required class="form-control">
                {!! Form::hidden('order_id', $order_id) !!}
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-sm-12" style="margin-bottom: 10px">
        <div class="form-group">
            <label class="col-sm-5 text-right">
                Courier Service website link:
            </label>

            <div class="col-sm-7">

                <input type="text" name="courier_service_url" id="courier_service_url_{{$order_id}}"
                       placeholder="Enter Courier Service website link" required class="form-control">

                <div class="text-danger" id="urlLinkError_{{$order_id}}"></div>
            </div>
        </div>
    </div>
    <div class="col-sm-12" style="margin-bottom: 10px">
        <div class="form-group">
            <label class="col-sm-5 text-right">
                Order Tracking Number:
            </label>

            <div class="col-sm-7">
                <input type="url" name="order_tracking_number" id="order_tracking_number_{{$order_id}}"
                       placeholder="Enter Order Tracking Number" required class="form-control">
                <div class="text-danger" id="urlTrackOrdrError_{{$order_id}}"></div>
                {!! Form::hidden('order_id', $order_id) !!}
            </div>
        </div>
    </div>
    <div class="col-sm-12" style="margin-bottom: 10px">
        <div class="form-group">
            <label class="col-sm-5 text-right">
                Delivery Date:
            </label>

            <div class="col-sm-7">
                <input type="text" name="date_to_be_delivered" id="date_to_be_delivered_{{$order_id}}"
                       placeholder="Enter Order delivery date" required class="form-control">

            </div>
            <input type="hidden" id="delivery_charges_paid" name="delivery_charges_paid" value="1">
        </div>
    </div>
    <input type="submit" id="addOrderDeliveryButton_{{$order_id}}" value="Save" class="btn btn-default"
           data-example-id="">
</div>
{!! Form::close() !!}

{!! HTML::script('local/public/assets/gentelella/js/validator/validator.js') !!}
<script type="text/javascript" src="{!! asset('local/public/assets/js/jquery-ui.min.js') !!}"></script>
<link rel="stylesheet" href="{!! asset('local/public/assets/css/jquery-ui.min.css') !!}">
<script>
    $('.modal-footer').hide();


    function validCadsUrl(s, trackUrl) {
        var message;
        var myRegExp = /^(?:(?:https?|ftp):\/\/)(?:\S+(?::\S*)?@)?(?:(?!10(?:\.\d{1,3}){3})(?!127(?:\.\d{1,3}){3})(?!169\.254(?:\.\d{1,3}){2})(?!192\.168(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/[^\s]*)?$/i;
        var urlToValidate = s;
        var trackUrlUrlToValidate = trackUrl;

        if (!myRegExp.test(urlToValidate)) {
            return "serviceLink";
        }

        if (!myRegExp.test(trackUrlUrlToValidate)) {
            //return "trackUrl";
        }

        return true;
    }

    $("#addOrderDeliveryButton_"+"{{$order_id}}").click(function (evt) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var serviceUrl = $("#courier_service_url_"+"{{$order_id}}").val();
        var trackUrl = $("#order_tracking_number_"+"{{$order_id}}").val();

        var isValidUrl = validCadsUrl(serviceUrl, trackUrl);

        if (isValidUrl != true) {
            $("#urlLinkError_"+"{{$order_id}}").html("Please enter valid 'Courier Service website link' (e.g: http://www.dhl.com.pk) ");
            //alert("Please enter valid \'Courier Service website link\' (e.g: http://www.dhl.com.pk) ");
            //return false;
        }

        if (trackUrl == "") {
            $("#urlTrackOrdrError_"+"{{$order_id}}").html("Please enter 'Order Tracking Number'");
            //alert("Please enter valid \'Order Tracking website link\' (e.g: http://www.dhl.com.pk/order=ASW98234) ");
            //return false;
        }
        if (isValidUrl != true) {
            return false;
        }
        $("#linkSpan").remove();
        var isEmpty = false;

        $("#add_courier_service_info_" + "{{$order_id}}" + " input").each(function () {
            if (!$(this).val()) {

                if (isEmpty !== true) {
                    alert("Some fields are empty, please fill all fields.");
                }
                isEmpty = true;
            }
        });

        if (isEmpty === true) {
            return false;
        }
        evt.preventDefault();

        $.ajax({
            type: 'POST',
            url: "{{url( "store/".Auth::user()->username.'/admin/add-courier-service-info/'.$order_id .'/'. $param )}}",
            data: $('#add_courier_service_info_'+"{{$order_id}}").serialize(), success: function (data) {
                $('#myModal').modal('toggle');
                $(".order_action_brn_" + data.order_id).remove();
                $(".order_action_" + data.order_id).html(data.action_btn_1 + data.action_btn_2);
                $(".order_status_" + data.order_id).html(data.status);
            }
        });
    });

</script>

<script>
    var today = new Date();
    var dd = today.getDate();
    if(dd < 10){
        dd = "0"+dd;
    }
    var mm = today.getMonth()+1;
    if(mm < 10){
        mm = "0"+mm;
    }
    var yy = today.getFullYear();
    var date  = yy+"-"+mm+"-"+dd;

    $(function(){
        $("#date_to_be_delivered_"+'<?php echo $order_id ?>').datepicker({
            inline: true,
            showOtherMonths: true,
            minDate: 0,
            onSelect: function(theDate) {
                $("#dataEnd").datepicker('option', 'minDate', new Date(theDate));
            },
            dateFormat: 'yy-mm-dd' ,
        dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
        });
    });
</script>


