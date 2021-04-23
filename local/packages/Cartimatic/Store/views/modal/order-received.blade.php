{{--

    * Created by   :  Muhammad Yasir
    * Project Name : shalmi
    * Product Name : PhpStorm
    * Date         : 13-May-16 11:09 AM
    * File Name    : 

--}}

<div class="col-sm-12 ">
    <div class="col-sm-3 text-left no-padding" style="margin-bottom: 10px">
        <strong>Order ID:</strong>
    </div>
    <div class="col-sm-7 text-left">{{getOrderNumber($order_id)}}</div>
</div>
<div class="clearfix"></div>

<div class="col-sm-12 text-info" style="margin-bottom: 10px">
    If you have issue with received goods, you can request refund now.
</div>
<div class="clearfix"></div>
<div class="col-sm-12">
    <a href="" id="approve_6_order_{{$order_id }}"
       class="btn btn-default order_status_btn order_action_brn_{{$order_id}} confirm_order_btns">Order Received</a>
    <a data-href="{{url("store/order/dispute/".$order_id)}}" id="disputeBtn_{{$order_id }}" class="btn btn-success refund-request">Request Refund</a>
    <a id="modal-submit" class="btn btn-info" data-dismiss="modal">Cancel</a>
</div>
<script type="text/javascript">
    $('.modal-footer').hide();
    $(".refund-request").click(function(evt) {
        evt.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var urlToSubmit = $(this).data('href');
        window.location.href = urlToSubmit;
    });

</script>

