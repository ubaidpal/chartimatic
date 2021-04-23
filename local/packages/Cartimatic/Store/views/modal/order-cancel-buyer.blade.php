{{--

    * Created by   :  Muhammad Yasir
    * Project Name : shalmi
    * Product Name : PhpStorm
    * Date         : 13-May-16 11:09 AM
    * File Name    : 

--}}
{!! Form::open( [ 'url'     => url( ),
	                  "id"      => "cancelOrderForm_".$order_id,
	                  "class"      => "form-container wA",
	                  "enctype" => "multipart/form-data"
	] ) !!}
{!!  Form::hidden('order_id', $order_id)!!}
<div class="col-sm-12 mar-bt-10">
    <div class="col-sm-5 text-right ">
        <strong>Order ID:</strong>
    </div>
    <div class="col-sm-7 text-left">{{getOrderNumber($order_id)}}</div>
</div>
<div class="clearfix"></div>

<div class="col-sm-12 mar-bt-10" >
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
<div class="col-sm-12 text-info mar-bt-10">
    If you have made payment for this order but not arrived to Kinnect2 yet, please do not cancel this order.
</div>
<div class="col-sm-12 text-danger">
    <p id="error_mesage_{{$order_id}}" style="display:none;"></p>
</div>
<div class="col-sm-12">
    <input type="submit" id="cancelOrderBtn_{{$order_id}}" value="Cancel" class="btn btn-default">
</div>
{!! Form::close() !!}
<script>
    $('.modal-footer').hide();
    $("#cancelOrderBtn_"+{{$order_id}}).click(function (evt) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        evt.preventDefault();
        $.ajax({
            type: "POST",
            url: '{{url( "store/cancelOrder/".$order_id )}}',
            data: $("#cancelOrderForm_"+{{$order_id}}).serialize(),
            success: function (data) {
                $('#myModal').modal('toggle');
                if (data.status == "Order Canceled") {
                    $(".order_action_brn_" + data.order_id).remove();
                    $(".order_action_" + data.order_id).html(data.action_btn_1 + data.action_btn_2);
                    $(".order_status_" + data.order_id).html(data.status);
                    $("#orderCancelationInfo_" + '{{$order_id}}').remove();
                } else {
                    jQuery("#error_mesage_"+{{$order_id}}).text(data.message_text).show().css("color", "#FF0000");
                }

            },
            error: function (data) {
                alert("error: " + data);
            }
        });
    });
</script>
