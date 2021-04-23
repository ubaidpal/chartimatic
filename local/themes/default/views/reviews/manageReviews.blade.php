@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <div class="pro-header">
                    <h1>Manage Feedback</h1>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="row">
                @include('includes.buyer_profile_navigation')
                <div class="col-md-9">
                    <div class="row">
                        <div class="order-title-box">
                            <div class="col-md-7">Product</div>

                            <div class="col-md-3">
                                <div class="row">
                                    Feedback State
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="row">Rating</div>
                            </div>
                        </div>
                        @foreach($allOrders as $order)
                                <!-- Order Brand Item -->
                        <div class="order-wrapper">
                            <?php $orderAllProducts = getOrderAllProducts($order->id); ?>
                            <?php $orderBuyer = getUserDetail($order->customer_id); ?>
                            <?php $reviewsHtml = ''; ?>
                            @foreach($orderAllProducts as $orderProduct)
                            <div class="order-list-wrapper">
                                <div class="col-md-7">
                                    <div class="col-md-3">
                                        <?php $reviewsHtml = ''; $product = getProductDetailsByID($orderProduct->product_id);//Complete detail of product
                                        if (!isset($product->id)) {
                                            continue;
                                        }?>
                                        <?php
                                        $review = getRatingOfUserById($order->customer_id, $product->id);
                                        $storeName = getUserNameByUserId($product->owner_id);
                                        ?>
                                        <div class="row"><a                                                     href="{{url('product/'.$orderProduct->product_id)}}"><img src="{{getRandomImageOfProduct($orderProduct->product_id)}}" class="img-responsive" alt="a" onError="this.onerror=null;this.src='<?php echo url('local/storage/app/')?>/product-images/default.jpg';"></a></div>
                                    </div>
                                    <div class="col-md-9">
                                        <p class="product-det-txt">{{$product->title}}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <?php $data = getReviewStatusForBuyer($review, $storeName, $order->id, $product->id);
                                    $reviewsHtml .= '<div class="feedback-state order_action_' . $order->id . $product->id . ' ' . $data["class"] . '">';
                                    $reviewsHtml .= $data['status'] . $data['action_btn_1'] . $data['action_btn_2'] . '</div>';
                                    ?>
                                    <div class="row finance">{!! $reviewsHtml !!}</div>
                                </div>
                                <div class="col-md-2">
                                    <div class="row unit-price">
                                        <div class="reviews-wrapper">
                                            <div id="rating_status_{{$order->id.$product->id}}">
                                                @if(isset($review->rating))

                                                    @if($review->rating == 0)
                                                        <img class="rated_stars"
                                                             src="{!! asset('local/public/assets/images/star.png') !!}"
                                                             alt="Rating" />
                                                    @endif
                                                    @for($i=1;$i<=$review->rating;$i++)
                                                        <img class="rated_stars"
                                                             src="{!! asset('local/public/assets/images/rattingstar.png') !!}"
                                                             alt="Rating"/>
                                                    @endfor
                                                    @for($i=1; $i <= 5 - $review->rating; $i++)
                                                        <img class="rating_stars"
                                                             src="http://localhost/kinnect2/local/public/assets/images/star.png"
                                                             alt="Rating">
                                                    @endfor
                                                        <!-- Trigger the modal with a button -->
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#review_{{$review->id}}">View Comment</button>

                                                        <!-- Modal -->
                                                        <div id="review_{{$review->id}}" class="modal fade" role="dialog">
                                                            <div class="modal-dialog">

                                                                <!-- Modal content-->
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        <h4 class="modal-title">Feedback</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>{{$review->description}}</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                @else
                                                    Not rated yet
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                {!! $data['popUpHtml'] !!}
                                @endforeach
                                <?php if (!isset($product->id)) {
                                    continue;
                                }?>
                            <div class="order-detail-wrapper">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="left-col">
                                            <div class="status">Order ID: {{$order->order_number}} <a href="{{url('order-invoice/'.$order->id)}}">View Detail</a></div>
                                            <div>Date: {{$order->created_at}} </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="right-col pull-left">
                                            <div class="sc">Store Name: <span><?php echo $storeName = ucfirst($storeName); ?></span></div>
                                            <div><a href="{{url('brand/'.$storeName)}}">View Profile</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        @endforeach

                        <div class="pagination-wrapper">
                            <div class="pages-limit">
                                <div class="input-group">
                                    <label>Show</label>
                                    <select name="show-record-limit" class="show-record-limit form-control">
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                    <label>per page</label>
                                </div>
                            </div>

                            <div class="pagination-box">
                                {!! $allOrders->appends(['status' => ''])->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
    @include('includes.searchQueryScript.searchScript')
<script type="text/javascript">
    $(".show-record-limit").change(function(evt){
        var url = '{{url('my-feedback')}}/';
        window.location.href = url+$(".show-record-limit").val();
    });
    $(".save_changes").click(function(){
        var url = window.location.href ='{{url('my-feedback')}}';
        location.reload(url);
    });
    $(".save_revise_feed_changes").click(function(){
        var url = window.location.href ='{{url('my-feedback')}}';
        location.reload(url);
    });

</script>
@endsection
