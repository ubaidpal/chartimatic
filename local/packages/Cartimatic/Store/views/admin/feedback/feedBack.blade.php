@extends('Store::layouts.store-admin')
@section('content')
        <!-- page content -->

<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>
                Feedback
                <small>
                    All Feedback
                </small>
            </h3>
        </div>

        <!--<div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <form class="navbar-form p0" role="search">

                <div class="input-group">
                    <input type="text" class="form-control" name="srch-term" placeholder="Enter Product Name" value="{{(isset($search_term)?$search_term:'')}}"  id="srch-term">
                  <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Go!</button>
                        </span>
                </div>
                </form>
            </div>

        </div>-->
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>All Feedback
                    </h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <section class="content invoice">


                        <!-- Table row -->
                        <div class="row">
                            <div class="col-xs-12 table">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Feedback State</th>
                                        <th>Rating</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $pendingReviewsCount = 0;?>
                                    <?php $reviewsCount = 0;?>
                                    @foreach($allOrders as $order)
                                            <!-- Order Brand Item -->


                                        <?php $orderAllProducts = getOrderAllProducts($order->id); ?>
                                        <?php $orderBuyer = getUserDetail($order->customer_id); ?>
                                        <?php $reviewsHtml = ''; $data['popUpHtml']= ''; ?>
                                        @foreach($orderAllProducts as $orderProduct)
                                            <tr>
                                                <?php $reviewsHtml = ''; $product = getProductDetailsByID($orderProduct->product_id);//Complete detail of product
                                            if (!isset($product->id)) {
                                                continue;
                                            }?>
                                            <?php
                                                    dd('koi produc ha?');
                                            $review = getRatingOfUserById($order->customer_id, $product->id);
                                            $storeName = getUserNameByUserId($order->seller_id);
                                            ?>

                                            <td><a class="product-img" title="{{$product->title}}"
                                                   href="{{getProductUrlByIdAndOwnerId($orderProduct->product_id, $product->owner_id)}}">
                                                    <?php $imageThumb = getRandomImageOfProduct($product->id) ?>
                                                    <img title="{{$product->title}}" class="product-image" width="100" height="100"
                                                         src="{{$imageThumb}}" onError="this.onerror=null;this.src='{{getProductDefaultImage()}}';" alt="image"></a>
                                            </td>

                                            <td>
                                                <?php $data = getReviewStatusForSeller($review, $orderBuyer, $storeName, $order->id, $product->id);
                                                $reviewsHtml .= '<div class="feedback-state order_action_' . $order->id . $product->id . ' ' . $data["class"] . '">';
                                                $reviewsHtml .= $data['status'] . $data['action_btn_1'] . $data['action_btn_2'] . '</div>';
                                                ?>
                                                {!! $reviewsHtml !!}
                                            </td>

                                            <td style="border-bottom: 1px solid #dddddd">
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
                                                                 src="{!! asset('local/public/assets/images/star.png') !!}"
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
                                                        <?php $pendingReviewsCount++; ?>
                                                        Not rated yet
                                                    @endif
                                                </div>
                                                    @endforeach
                                                    </td>
                                                    @if($data['popUpHtml'] != '')
                                                {!! $data['popUpHtml'] !!}
                                                    @endif
                                                    <?php if (!isset($product->id)) {
                                                        continue;
                                                    }?>

                                            </tr>
                                    <tr>
                                        <td>
                                            <div class="oi-footer">
                                                <div class="oi-detail">
                                                    <p class="mb5">
                                                        Order ID: {{$order->order_number}} <a
                                                                href="{{url('store/'.Auth::user()->username.'/admin/order-invoice/'.$order->id)}}">View
                                                            Detail</a>
                                                    </p>

                                                    <p>
                                                        Order time & date: {{$order->created_at}}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="oi-profile">
                                                <p class="mb5">
                                                    Buyer Name: <?php $buyerName = (isset($orderBuyer->displayname))?$orderBuyer->displayname:'Deleted Buyer';
                                                    $profileAddress = profileAddress($orderBuyer);?> <a
                                                            target="_blank"
                                                            href="{{$profileAddress}}"> <?php echo ucfirst($buyerName); ?></a>
                                                </p>

                                                <p>
                                                    <a href="{{$profileAddress}}">View Profile</a>
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('click', ".order_status_btn", function (evt) {

        var order_info = evt.target.id;

        jQuery.ajax({
            url: '{{url("store/".Auth::user()->username."/admin/update/order-status")}}',
            type: "Post",
            data: {order_info: order_info},
            success: function (data) {
                //{"class":"shipped","status":"Awaiting receiver approval","action_btn_1":"","action_btn_2":""}
                $(".order_action_brn_" + data.order_id).remove();
                $(".order_action_" + data.order_id).html(data.action_btn_1 + data.action_btn_2);

                if (data.status != undefined || data.status != null) {
                    $(".order_status_" + data.order_id).html(data.status);
                }

            }, error: function (xhr, ajaxOptions, thrownError) {
                alert("ERROR:" + xhr.responseText + " - " + thrownError);
            }
        });
    });

    $(".filter_orders").click(function (evt) {
        var toBeFiltered = evt.target.id;

        $.each(document.getElementsByClassName("orderb-item"), function (i, item) {
            var html = item.innerHTML;
            if (html.indexOf(toBeFiltered) > -1) {
                setTimeout(function () {
                    $(item).fadeIn('slow');
                }, 500);
                //item.style.display = "";
            } else {
                setTimeout(function () {
                    $(item).fadeOut('slow');
                }, 500);
//                item.style.display = "none";
            }
        });
    });

    $(document).on('keyup', ".search_order", function (evt) {
        var order_number = $("#search_order_number").val();
        var product_name = $("#search_product_name").val();

        jQuery.ajax({
            url: '{{url("store/".Auth::user()->username."/admin/serach-my-reviews")}}',
            type: "Post",
            data: {order_number: order_number, product_name: product_name},
            success: function (data) {
                $("#nothing_found").remove();

                if (typeof  data === 'string') {
                    $(".orderb-item").remove();
                    $(data).insertAfter(".bsmo-nav");
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert("ERROR:" + xhr.responseText + " - " + thrownError);
            }
        });
    });
</script>
@endsection
