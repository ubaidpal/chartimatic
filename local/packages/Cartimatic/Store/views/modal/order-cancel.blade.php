{{--

    * Created by   :  Muhammad Yasir
    * Project Name : shalmi
    * Product Name : PhpStorm
    * Date         : 13-May-16 11:09 AM
    * File Name    : 

--}}
{!! Form::open( [ 'url' => url( ),
            "id" => "cancelOrderForm_".$order_id,
            "class" => "form-container wA",
            "enctype" => "multipart/form-data"
            ] ) !!}
<div class="col-sm-12 ">
    <div class="col-sm-5 text-right ">
        <strong>Order ID:</strong>
    </div>
    <div class="col-sm-7 text-left">{{getOrderNumber($order_id)}}</div>
</div>
<div class="clearfix"></div>

<div class="col-sm-12">
    <div class="col-sm-5 text-right ">
        <strong>*Select a reason For cancellation:</strong>
    </div>
    <div class="form-group ">
        <div class="col-sm-7 text-left">

            <select name="reason" class="form-control">
                <option value="1">Reason goes here</option>
                <option value="2">Reason goes here</option>
            </select>
        </div>
    </div>
</div>
<div class="col-sm-12 text-info">
    Please note if you cancel an order that was paid, the purchase amount will be credited to buyer.
</div>
<div class="col-sm-12 text-danger">
    <p id="error_mesage_{{$order_id}}" style="display:none;"></p>
</div>
{!! Form::close() !!}
<script>
    $("#modal-submit").click(function (evt) {
        evt.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: '{{url( "store/".$param."/cancelOrder/".$order_id )}}',
            data: $("#cancelOrderForm_" + '{{$order_id}}').serialize(),

            success: function (data) {

                if (data.status == "success") {
                    $(".order_action_brn_" + data.order_id).remove();
                    $(".order_action_" + data.order_id).html(data.action_btn_1 + data.action_btn_2);
                    $(".order_status_" + data.order_id).html(data.status);
                    $("#orderCancelationInfo_" + '{{$order_id}}').remove();
                } else {
                    jQuery("#error_mesage_" + '{{$order_id}}').text(data.message_text).show().css("color", "#FF0000");
                }

            },
            error: function (data) {
                alert("error: " + data);
            }
        });
    });
</script>
