@extends('layouts.main')

@section('content')
<div class="col-md-12">
    <div class="row">
        <div class="pro-header">
            <h1>Manage Wishlist</h1>
        </div>
    </div>
</div>
<div class="col-md-12">
                    <div class="row">
                        <div class="order-title-box">
                            <div class="select-category">
                                {!!  \Form::select('wishList', $wishList, 0, ['class' => 'form-control' ,'id' => 'wish_list'])!!}
                            </div>
                        </div>
                <div class="order-wrapper">
                        @foreach($favoriteProducts as $favoriteProduct)
                            <div class="order-list-wrapper" id="delete_wishList_{{$favoriteProduct->product_id}}">
                                <div class="col-md-1 del-s">
                                    <div class="time"></div>
                                    <a href="#" class="delete-list delete" data-toggle="modal" data-target="#myModal" id="{{$favoriteProduct->product_id}}"><i class="glyphicon glyphicon-remove"></i></a>
                                </div>
                               <div class="col-md-7">
                                    <div class="row">
                                        <a href="{{url('product/'.$favoriteProduct->product_id)}}" title="click to view detail page">
                                            <div class="col-md-2">
                                                @if(isset($favoriteProduct->image_path))
                                                <img alt="{{$favoriteProduct->title}}" class="img-responsive"
                                                                  src="{!! getImage($favoriteProduct->image_path) !!}">
                                                @else
                                                    <img alt="{{$favoriteProduct->title}}" class="img-responsive"
                                                         src="{!! getImage(null) !!}" onError="this.onerror=null;this.src='<?php echo url('local/storage/app/')?>/product-images/default.jpg';">
                                                @endif
                                            </div>
                                            <div class="col-md-10">
                                                <p class="product-det-txt">{{$favoriteProduct->title}}</p>

                                                <div class="per-piece">US ${!! wishListPrice($favoriteProduct->product_id) !!} <sub>/ piece</sub></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="store-name">Store Name: {{$favoriteProduct->name}}</div>
                                    <div><a href="{{url('store/'.$favoriteProduct->username)}}">View Profile</a></div>
                                </div>
                            </div>
                        @endforeach
                  </div>
              @if(count($favoriteProducts) > 0)
                <div class="pagination-wrapper">
                    <div class="pages-limit">
                        <div class="input-group">
                            <label>Show</label>
                            {!!  \Form::select('sortingRecordsNumber', ["25"=>25, "50" =>50, "100" => 100], $perPage, ['class' => 'form-control pageSort' ,'id' => 'sortingRecordsNumber'])!!}
                            <label>per page</label>
                        </div>
                    </div>

                    <div class="pagination-box">
                        {!!  $favoriteProducts->render()!!}
                    </div>
                </div>
                  @else
                  <div class="no_product_message" style="min-height: 28px;background: #fff;padding: 10px;">No product added to favorite.</div>
                  @endif
            </div>
        </div>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete Record</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this product in your wishList.</p>
            </div>
            <div class="modal-footer">
                <input class="delWishList" type="hidden" name="delParent" value="">
                <a href="#" class="btn btn-danger delP" data-dismiss="modal">Delete</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>

    </div>
</div>
@endsection
@section('footer-scripts')
    @include('includes.searchQueryScript.searchScript')
    <script>
        $(document).on("click", ".delete", function (e) {

            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });//for token purpose in laravel
            var delWishList = e.target.id;
            $(".delWishList").val(delWishList);
            return false;
        });

        $('.delP').click(function (e) {
            e.preventDefault();
            var delWishList =  $('.delWishList').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });//for token purpose in laravel
            jQuery.ajax({
                type: "Post",
                url: '{{url('wishlist/delete')}}',
                data: {delWishList: delWishList},
                success: function (data) {
                    if (data > 0) {
                        $("#myModal").hide();
                        $("#delete_wishList_" +delWishList).remove();
                    } else {
                        return false;
                    }
                }, error: function (xhr, ajaxOptions, thrownError) {
                    alert("ERROR:" + xhr.responseText + " - " + thrownError);
                }
            });
        });

        $(document).on("click", "#wish_list", function (e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });//for token purpose in laravel
            var cat = $('#wish_list').val();
            $(".no_product_message").remove();

            jQuery.ajax({
                url: '{{ url("wishlist/filter") }}',
                type: "Post",
                data: {category: cat},
                success: function (data) {

                    /*var maArray = jQuery.parseJSON(data);
                    var Html = '';
                    var countProduct = 0;
                    $.each(maArray, function (key, val) {

                        Html += '<div class="order-list-wrapper"' + val.id + '" id="delete_wishList_' + val.id + '">';
                        Html += '<div  class="col-md-6">';
                        Html += '<div  class="col-md-3">';
                        Html += '<div class="row">';
                        Html += '<img src="' + val.image + '" class="img-responsive" alt="image" width="105 " height="120">';
                        Html += '</div>';
                        Html += '</div>';
                        Html += '<div  class="col-md-9">';
                        Html += '<p class="product-det-txt">' + val.title + '</p>';
                        Html += '<div class="per-piece">' + 'US $' + val.price + '</div>';
                        Html += '</div>';
                        Html += '</div>';

                        Html += '<div  class="col-md-4">';
                        Html += '<div  class="row">';
                        Html += '<div class="store-name">' + 'Store Name:' + val.name + '</div>';
                        Html += '<div><a href="{{url('store')}}/'+ val.username +'">' + 'View Profile' + '</a></div>';
                        Html += '</div>';
                        Html += '</div>';


                        Html += '<div  class="col-md-2">';
                        Html += '<div class="row">';
                        Html += '<div class="time">' + '' + '</div>';
                        Html += '<a class="delete-list delete" data-toggle="modal" data-target="#myModal" href="#" ' +
                                'id="' + val.id + '">' + 'Delete from wishList' + '</a>';

                        Html += '</div>';
                        Html += '</div>';
                        Html += '</div>';

                        countProduct++;
                    });*/

                    if (data != 0) {
                        $(".order-wrapper").html(data);
                    } else {
                        $(".order-wrapper").html('<div class="no_product_message" style="min-height: 28px;background: #fff;padding: 10px;">No product added to favorite.</div>');
                    }
                }, error: function (xhr, ajaxOptions, thrownError) {
                    alert("ERROR:" + xhr.responseText + " - " + thrownError);
                }
            });
        });
        $(document).on("change", ".pageSort", function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });//for token purpose in laravel

            var perPage =  $('.pageSort option:selected').text();
            var url = '{{url('wishlist')}}'+ '/' +perPage;
            document.location.reload(true);
            window.location = url;

        });
        $(document).on("change", ".pageSortDynamic", function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });//for token purpose in laravel

            var perPage =  $('.pageSort option:selected').text();
            var url = '{{url('wishlist/filter/')}}'+ '/' +perPage;
            document.location.reload(true);
            window.location = url;

        });

    </script>


@endsection
