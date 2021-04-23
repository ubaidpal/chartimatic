@extends('layouts.default')

@section('content')
  <div class="col-md-12">
    <div class="row">
      <div class="pro-header">
        <h1>Search Result</h1>
        <div class="col-md-9">
          <div class="row">
            <ol class="breadcrumb" style="margin-bottom: 5px;">
              <li><a href="{{url('/')}}">Home</a></li>
              @if(isset($breadCrumb[0]))
                <li class="active"><a href="{{url('category/'.$breadCrumb[0]['slug'])}}">{{$breadCrumb[0]['name']}}</a></li>
              @else
                <li class="active"><a href="/">Showing All</a></li>
              @endif
            </ol>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="order-wrapper">
            @if(count($products) > 0)
            @foreach($products as $product)
              <div class="order-list-wrapper" id="delete_wishList_{{$product->id}}">
                <a href="{{url('product/'.$product->id)}}" title="Click to view detail.">
                  <div class="col-md-6">
                    <div class="col-md-3">
                      <div class="row">

                        <img alt="product-image-thumb" class="img-responsive"
                             src="{!! getRandomImageOfProduct($product->id) !!}">

                      </div>
                    </div>
                    <div class="col-md-9">
                      <p class="product-det-txt">{{$product->title}}</p>
                      <p class="product-det-txt"> {{$product->overview}}</p>

                    </div>
                  </div>
                </a>
                <div class="col-md-4">
                  <div class="row">
                    <div class="store-name">Price: {!! wishListPrice($product->id) !!}</div>

                  </div>
                </div>

                <div class="col-md-4">
                  <div class="row">
                    <div class="store-name">Available Quantity: {!! quantityPrice($product->id) !!}</div>

                  </div>
                </div>

                <div class="col-md-4">
                  <div class="row">
                    <div class="store-name">Store Name: {!! getStoreName($product->owner_id) !!}</div>

                    <div><a href="{{url('store/'.getUserNameByUserId($product->owner_id))}}">View Profile</a></div>
                  </div>
                </div>


              </div>
            @endforeach

              @else
              <div class="order-list-wrapper" id="no-product-found">
                <h3>No product found..</h3>
</div>
              @endif
          </div>

        </div>
      </div>
    </div>
  </div>

@endsection
