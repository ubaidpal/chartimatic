@extends('layouts.default')

@section('content')
    <div class="col-md-12">
        <div class="row">
            <div class="pro-header">
                <h1>Manage Orders</h1>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="row">
            @include('Store::includes.orders-sidebar')

            <div class="col-md-9">
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        <strong>Success!</strong> {{html_entity_decode(Session::get('success'))}}
                    </div>
                @endif
                @if(Session::has('error'))
                    <div class="alert alert-danger">
                        <strong>Danger!</strong> {{html_entity_decode(Session::get('error'))}}
                    </div>
                @endif
                <div class="row">
                    <div class="dispute-main-title">Dispute Details</div>
                    <div class="dispute-wrapper">
                        <div class="dp-box">
                            <div class="col-md-2"><label class="col-left">Order ID :</label></div>
                            <div class="col-md-10">
                                <div class="col-right">{{$order->order_number}}</div>
                            </div>
                        </div>
                        @if(isset($claim_detail))
                            <div class="dp-box">
                                <div class="col-md-2"><label class="col-left">Title :</label></div>
                                <div class="col-md-10">
                                    <div class="col-right">{{$claim_detail->title}}</div>
                                </div>
                            </div>
                            @if($claim_detail->fee_paid)
                                <div class="dp-box">
                                    <div class="col-md-2"><label class="col-left">Fee Paid :</label></div>
                                    <div class="col-md-10">
                                        <div class="col-right">{{format_currency($claim_detail->fee_amount)}}</div>
                                    </div>
                                </div>
                            @endif
                        @endif
                        <div class="dp-box">
                            <div class="col-md-2"><label class="col-left">Status :</label></div>
                            <div class="col-md-10">
                                <div class="col-right">{{ dispute_status($dispute->status, $user->user_type) }}</div>
                            </div>
                        </div>

                        <div class="dp-box">
                            <div class="col-md-2"><label class="col-left">Track Info :</label></div>
                            <div class="col-md-10">
                                <div class="col-right">
                                    <div class="col-md-6">
                                        <div class="row">Tracking Number:
                                            &nbsp;@if($shipping_info)  {{$shipping_info->order_tracking_number}}@endif</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">Shipping Time:
                                            &nbsp; @if($shipping_info)  {{$shipping_info->date_to_be_delivered}}@endif</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="dp-box">
                            <div class="col-md-2"><label class="col-left">Reminder :</label></div>
                            <div class="col-md-10">
                                <div class="col-right">Please wait for the supllier to respond to your dispute. You can
                                    modify the details of your dispute or cancel
                                    your dispute by clicking the button below
                                </div>
                                <div class="col-right">
                                    <p>If you cannot reach an agreement with the seller, you can file a claim for the
                                        order</p>
                                </div>
                            </div>
                        </div>

                        <div class="dp-box">
                            <div class="col-md-2"><label class="col-left">Details :</label></div>
                            <div class="col-md-10">
                                <div class="col-right">
                                    @if(isset($claim_detail))
                                        {{$claim_detail->detail}}
                                    @else
                                        {{$dispute->detail}}
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="dp-box">
                            <div class="col-md-2"><label class="col-left">Claimed Amount :</label></div>
                            <div class="col-md-10">
                                <div class="col-right">
                                    @if($dispute->claim_request == 'full')
                                        {{format_currency(@$order_transection->amount)}}
                                    @else
                                        {{format_currency(@$dispute->claimed_amount)}}
                                    @endif

                                </div>
                            </div>
                        </div>
                        @if(isset($claim_detail) && $claim_detail->status == config('admin_constants.CLAIM_STATUS.RESOLVED'))
                            <div class="dp-box">
                                <div class="col-md-2"><label class="col-left">Resolved in Favour of :</label></div>
                                <div class="col-md-10">
                                    <div class="col-right">
                                        @if($claim_detail->favour_of_seller == 1 && $claim_detail->favour_of_buyer ==1)
                                            Both(Seller & Buyer)
                                        @elseif($claim_detail->favour_of_seller == 1)
                                            Seller
                                        @else
                                            Buyer
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="dp-box">
                                <div class="col-md-2"><label class="col-left">Decided amount :</label></div>
                                <div class="col-md-10">
                                    <div class="col-right">
                                        {{format_currency($claim_detail->amount)}}
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($order->is_refunded)
                            <div class="dp-box">
                                <div class="col-md-2"><label class="col-left">Refunded Amount :</label></div>
                                <div class="col-md-10">
                                    <div class="col-right">
                                        {{format_currency($order->refund_amount)}}
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="dp-box">
                            <div class="col-md-2"><label class="col-left">Attachments :</label></div>
                            <div class="col-md-10">
                                <div class="col-right">
                                    @foreach($files as $file)
                                        <div class="product-image">
                                            <div class="col-md-2">
                                                {{--<img alt="a" class="img-responsive"
                                                     src="{{getImage($file->attachment_path, 'refund_request')}}">--}}
                                                <img alt="a" class="img-responsive"
                                                     src="{{url('local/storage/app/'.$file->attachment_path)}}">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @if($user->user_type == config('constants.BRAND_USER') || $user->user_type == config('constants.REGULAR_USER'))
                            {{--@if($dispute->status != config('constants_brandstore.DISPUTE_STATUS.DISPUTE_CANCELLED_BUYER'))--}}
                            @if(is_null($dispute->status))
                                <div class="dp-box">
                                    <div class="col-md-2"><label class="col-left">Note :</label></div>
                                    <div class="col-md-10">
                                        <div class="col-right">
                                            @if($user->user_type == config('constants.BRAND_USER'))
                                                @if($dispute->status == \Config::get('constants_brandstore.DISPUTE_STATUS.DISPUTE_ACCEPTED'))
                                                    <div class="text-info">{{config('constants_brandstore.DISPUTE_NOTE.DISPUTE_ACCEPTED_SELLER')}}</div>
                                                @else
                                                    <div class="text-info">{{config('constants_brandstore.DISPUTE_NOTE.BRAND')}}
                                                    </div>
                                                @endif
                                            @else
                                                @if($dispute->status == \Config::get('constants_brandstore.DISPUTE_STATUS.DISPUTE_ACCEPTED'))
                                                    <div class="text-info">{{config('constants_brandstore.DISPUTE_NOTE.DISPUTE_ACCEPTED_BUYER')}}</div>
                                                @else
                                                    <div class="text-info">
                                                        {{config('constants_brandstore.DISPUTE_NOTE.BUYER')}}
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                        <div class="dp-box">
                            <div class="col-md-2">&nbsp;</div>
                            <div class="col-md-10">
                                <div class="col-right">
                                    <div aria-label="Basic example" role="group" class="btn-group">
                                        @if($user->user_type == Config::get('constants.REGULAR_USER'))
                                            @if(is_null($dispute->status))
                                                <a class="btn btn-default"
                                                   href="{{url('store/dispute/modify/'.$dispute->reference_id)}}">Modify</a>
                                                <a class="btn btn-grey"
                                                   href="{{url('store/dispute/cancel/'.$dispute->reference_id)}}">Cancel</a>
                                            @endif
                                            @if($dispute->status != config('constants_brandstore.DISPUTE_STATUS.DISPUTE_CANCELLED_BUYER') && $dispute->status != config('constants_brandstore.DISPUTE_STATUS.RESOLVED') && $dispute->status != config('constants_brandstore.DISPUTE_STATUS.CLAIMED_BY_BUYER') && $dispute->status != config('constants_brandstore.DISPUTE_STATUS.DISPUTE_ACCEPTED') )
                                                <a href="#" data-toggle="modal" data-target="#openDispute">Open
                                                    Dispute</a>
                                            @endif
                                        @else
                                            @if(is_null($dispute->status)  )
                                                <a class="btn btn-default"
                                                   href="{{url('store/dispute/accept/'.$dispute->reference_id)}}">Accept
                                                    Request</a>
                                                <a class="btn btn-default"
                                                   href="{{url('store/dispute/cancel/'.$dispute->reference_id)}}">Reject</a>
                                            @endif
                                        @endif


                                    </div>
                                </div>
                                {{--<div class="col-right">
                                    <p>Please check your order when it's delivered by the shipping company. Only confirm
                                        receipt of delivery when
                                        you are satisfied with the condition of your order. You can open a dispute for
                                        the order if your are not satisfied
                                        with the items you receive.</p>
                                </div>--}}
                            </div>
                        </div>
                    </div>

                    <div class="dispute-wrapper">
                        <div class="messages-title bdrB">Messages</div>
                        <div class="msgs-box" id="messageBox">
                            @if(isset($messages) && $messages !=  'No more Message')
                                @foreach($messages as $msg)
                                    <div class="msg-list">
                                        <div class="col-md-2">
                                            <div class="name">
                                                @if($msg['sender_id'] == $user->id)
                                                    Me
                                                @else
                                                    {{$msg['sender_name']}}
                                                @endif

                                            </div>
                                            <div class="td">{{getTimeByTZ($msg['created_at'], 'M d | H:i A')}}</div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="msg @if($msg['sender_id'] == $user->id) me @endif">
                                                @if(isset($msg['file_name']) && !empty($msg['file_name']))
                                                    <span class="attachment-icon"></span>

                                                    <div class="linkDownload mar-bt-10">
                                                        <span class="attachment-name">{{$msg['file_name']}}</span>
                                    <span class="attachment-url"><a href="{{url('photo/'.$msg['url'])}}"
                                                                    download="">Download</a></span>
                                                    </div>
                                                @endif
                                                {{$msg['content']}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                No record found
                            @endif
                        </div>
                    </div>
                    @if(is_null($dispute->status) || $dispute->status == config('constants_brandstore.DISPUTE_STATUS.CLAIMED_BY_BUYER'))
                        <div class="dispute-wrapper">
                            <div class="messages-title">Leave a Message</div>

                            {!! Form::open(['url' => 'store/dispute/message', 'id' => 'msg-form']) !!}
                            <input type="file" accept="" id="postFiles" name="attachment"
                                   style="position: fixed; top: -30px;"/>
                            @if(is_null($dispute->conv_id))
                                {!! Form::hidden('receiver_id',$seller_id) !!}
                                {!! Form::hidden('dispute_id',$dispute->reference_id) !!}
                            @else
                                {!! Form::hidden('conv_id',$dispute->conv_id) !!}
                            @endif
                            <div class="write-msg">
                                <textarea class="form-control" name="body" rows="5" id="msg-body"
                                          placeholder="Type you message here . . ."></textarea>
                            </div>
                            <div class="btn-box">
                                <button class="btn btn-primary" type="button" id="send-msg">Send</button>
                                <button class="btn btn-primary" type="button" id="chat-attachment">Attach</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    @endif


                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('footer-scripts')
    {!! HTML::script('local/public/assets/js/pages/dispute.js') !!}
            <!-- Modal -->
    <div class="modal fade" id="openDispute" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" class="form-horizontal" action="{{url( "store/claim/store" )}}" role="form">
                    {!! csrf_field() !!}
                    {!! Form::hidden('dispute_id', $dispute->id) !!}
                    {!! Form::hidden('owner_type', 'dispute') !!}
                    {!! Form::hidden('user_id', $user_id) !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Dispute Detail</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="email">Title:</label>

                            <div class="col-sm-9">
                                <input name="title" type="text" class="form-control" id="email"
                                       placeholder="Enter Title" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="email">Select Reason:</label>

                            <div class="col-sm-9">
                                {!! Form::select('reason',  $reasons,NULL, ['class'=>'form-control']) !!}

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="email">Detail:</label>

                            <div class="col-sm-9">
                                <textarea class="form-control " required name="detail"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-default">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
