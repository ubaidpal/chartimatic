@extends('layouts.default')

@section('content')
    <div class="col-md-12">
        <div class="row">
            <div class="pro-header">
                <h1> Request Refund</h1>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="row">
            @include('Store::includes.orders-sidebar')

            <div class="col-md-9">
                <div class="row">
                    <div class="dispute-main-title">Open Dispute</div>
                    {!! Form::model($dispute,['url' => url("store/dispute/complain"), "id" => "order_dispute_detail", "enctype"=>"multipart/form-data"]) !!}
                    {!! Form::hidden('order_id', $dispute->order_id) !!}
                    {!! Form::hidden('payment_received', format_currency($order->total_price - $order->total_discount)) !!}
                    {!! Form::hidden('shipping_time', $deliveryInfo->date_to_be_delivered) !!}
                    <div class="dispute-wrapper">
                        <div class="dp-box">
                            <div class="col-md-4"><label class="col-left">Did you receive your order :</label></div>
                            <div class="col-md-8">
                                <div class="col-right">
                                    <label class="radio-inline">

                                        {!! Form::radio('order_receive',"Yes",($dispute->is_received == "Yes"? TRUE :FALSE), ["class"=>"order_receive"] ) !!}
                                        Yes
                                    </label>
                                    <label class="radio-inline">
                                        {!! Form::radio('order_receive',"No",($dispute->is_received == "No"? TRUE :FALSE), ["class"=>"order_receive"] ) !!}
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="dp-box">
                            <div class="col-md-4"><label class="col-left">Payment Received :</label></div>
                            <div class="col-md-8">
                                <div class="col-right">
                                    <div class="col-md-6">
                                        <div class="row">{{format_currency($order->total_price - $order->total_discount)}}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">Shipping Time:
                                            &nbsp; {{$deliveryInfo->date_to_be_delivered}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="dp-box">
                            <div class="col-md-4"><label class="col-left">Refund Requested :</label></div>
                            <div class="col-md-8">
                                <div class="col-right">
                                    <label class="radio-inline">
                                        {!! Form::radio('refund_type',"full",($dispute->claim_request == "full"? TRUE :FALSE), ["class"=>"refund"] ) !!}
                                        Full Refund
                                    </label>
                                </div>
                                <div class="col-right">
                                    <label class="radio-inline">
                                        {!! Form::radio('refund_type',"partial",($dispute->claim_request == "partial"? TRUE :FALSE), ["class"=>"refund"] ) !!}
                                        Partial Refund - Amount Requested: &dollar;

                                        <small class="clearfix" style=" font-size: 11px">
                                            Maximum  amount to be claimed {{format_currency($order->total_price - $order->total_discount)}}
                                        </small>
                                    </label>

                                    <input class="form-control partial-field" data-val="true" id="partial_refund"
                                           name="claimed_amount" type="text"
                                           value="{{$dispute->claimed_amount}}">
                                </div>
                            </div>
                        </div>

                        <div class="dp-box">
                            <div class="col-md-4"><label class="col-left mt10">Reason :</label></div>
                            <div class="col-md-8">
                                <div class="col-right">
                                    <select class="form-control" required name="reason">
                                        <option class="reason" name="reason_A" value="">Select Reason</option>
                                        <option class="reason" @if($dispute->reason == '1') selected @endif name="reason_A" value="1">Reason A</option>
                                        <option class="reason" @if($dispute->reason == '2') selected @endif name="reason_A" name="reason_A" value="2">Reason B</option>
                                        <option class="reason" @if($dispute->reason == '3') selected @endif name="reason_A" name="reason_c" value="3">Reason C</option>
                                        <option class="reason" @if($dispute->reason == '4') selected @endif name="reason_A" name="reason_d" value="4">Reason D</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="dp-box">
                            <div class="col-md-4"><label class="col-left mt10">Detail :</label></div>
                            <div class="col-md-8">
                                <div class="col-right">
                                    <textarea required name="detail" placeholder="Type you message here . . ." id="comment"
                                              rows="5"
                                              class="form-control">{{$dispute->detail}}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="dp-box">
                            <div class="col-md-4"><label class="col-left mt10">Attachment :</label></div>
                            <div class="col-md-8 mar-bt-10">
                                <div class="col-right">
                                    @foreach($files as $file)
                                        <div class="attachment" id="attachment-{{$file->id}}">
                                            <span data-id="{{$file->id}}"
                                                  class="glyphicon glyphicon-remove-circle cursor_pointer remove-attachment"
                                                  aria-hidden="true" style="position: absolute;z-index: 1"></span>

                                            <div class="product-image">
                                                <div class="col-md-4 thumbnail">
                                                    <img alt="a" class="img-responsive"
                                                         src="{{url('local/storage/app/'.$file->attachment_path)}}">
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-8 col-md-offset-4">
                                <div class="append-more">
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-right mt10 more-attachment"><a href="javascript:void(0)">Add another
                                        attachment</a></div>
                            </div>

                        </div>

                        <div class="dp-box">
                            <div class="col-md-4">&nbsp;</div>
                            <div class="col-md-8">
                                <div class="col-right">
                                    <div aria-label="Basic example" role="group" class="btn-group">
                                        <button class="btn btn-default" type="submit">Submit</button>
                                        <a class="btn btn-grey" href="{{URL::previous()}}">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>
@endsection
@section('footer-scripts')
    {!! HTML::script('local/public/assets/store/refund-request.js') !!}
    <script src="{{url('local/public/assets/js/jquery.validate.min.js')}}"></script>
    <script>
        jQuery(document).ready(function (e) {

            jQuery('#order_dispute_detail').validate({
                errorElement: 'span',
                rules: {
                    "payment_type": {required: true},
                    "claimed_amount": {
                        required: function (e) {
                            if (jQuery('input[name="refund_type"]:checked').val() == 'partial') {
                                return true;
                            } else {
                                return false;
                            }
                        }, max:{{$order->total_price - $order->total_discount}}, number: true
                    }
                }
            });
        });
    </script>
@endsection
