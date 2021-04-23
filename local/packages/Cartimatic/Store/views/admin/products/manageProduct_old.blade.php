{{--

    * Created by   :  Muhammad Yasir
    * Project Name : shalmi
    * Product Name : PhpStorm
    * Date         : 06-May-16 6:44 PM
    * File Name    :

--}}
@extends('Store::layouts.store-admin')
@section('content')
  <style>
    .minimum_stock_reached {
      border: 4px solid #ddd;
      -webkit-animation: example 5s infinite; /* Chrome, Safari, Opera */
      animation: example 5s infinite;
    }

    /* Chrome, Safari, Opera */
    @-webkit-keyframes example {
      0% {
        border-color: #ddd;
      }
      10% {
        border-color: #ddd;
      }
      25% {
        border-color: red;
      }
      50% {
        border-color: red;
      }
      100% {
        border-color: red;
      }
    }

    /* Standard syntax */
    @keyframes example {
      0% {
        border-color: #ddd;
      }
      10% {
        border-color: #ddd;
      }
      25% {
        border-color: red;
      }
      50% {
        border-color: red;
      }
      100% {
        border-color: red;
      }
    }

    .product_children {
      display: none;
    }

    .product_children_row {
      margin-left: 20px;
    }
  </style>
  <!-- page content -->
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>
          Products
          <small>
            All Products
          </small>
        </h3>
        <div id="filter_tabs">
          <a class="btn btn-primary" href="{{url('store/'.Auth::user()->username.'/admin/manage-product')}}">
            All
          </a>
          <a class="btn btn-success"
             href="{{url('store/'.Auth::user()->username.'/admin/manage-product?is_published=1')}}">
            Published
          </a>
          <a class="btn btn-info"
             href="{{url('store/'.Auth::user()->username.'/admin/manage-product?is_published=0')}}">
            Draft
          </a>

          <a class="btn btn-warning"
             href="{{url('store/'.Auth::user()->username.'/admin/manage-product?is_deleted=1')}}">
            Deleted
          </a>

          <a class="btn btn-danger"
             href="{{url('store/'.Auth::user()->username.'/admin/manage-product?out_of_stock=1')}}">
            Out of Stock <?php $outOfStocProducts = getOutOfStockProducts(Auth::user()->id); ?>
            @if($outOfStocProducts > 0)
              <span class="badge badge-success">{{$outOfStocProducts}}</span>
            @endif
          </a>
        </div>
      </div>

      <div class="title_right">

        {!! Form::open(['url'=>url('store/'.Auth::user()->username.'/admin/manage-product')]) !!}
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" name="product_name" value="{{$product_name}}" class="product_name_txt form-control"
                   placeholder="Enter Product Name">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-default" type="button">Go!</button>
                        </span>

          </div>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
    <div class="clearfix"></div>
    @include('includes.alerts')
    <div class="row">
      <div class="col-md-12 table-responsive">
        <div class="x_panel">
          <div class="x_title">
            <h2>All Products</h2>
            <div class="form-group pull-right filter-wrapper">
              <label for="sel1">Filter By Category:</label>
              <select name="filter_by_category" id="filter_by_category" class="form-control" id="sel1">
                @foreach($ownerProductCategories as $cat)
                  <option @if(isset($category_id)) @if($category_id == $cat->id) selected="selected" @endif @endif value="{{$cat->id}}">{{$cat->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <section class="content invoice">
              <!-- Table row -->
              <div class="row">
                <div class="col-xs-12 table">
                  <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>Product Title</th>
                      <th>Category</th>
                      <th>Quantity</th>
                      <th>Stock Alert Quantity</th>
                      <th>In Stock</th>
                      <th>Sold</th>
                      <th>POS Stock</th>
                      <th>Affiliated</th>
                      <th>Master Attribute 1</th>
                      <th>Master Attribute 2</th>
                      <th>Cost Price</th>
                      <th>Price</th>
                      <th>Discount</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($AllProducts->isEmpty())
                      <div class="notify p10">No product added yet. Please click on add product button
                        to add the products.
                      </div>
                    @else
                      <?php
                      $to = ($AllProducts->currentPage() * $AllProducts->perPage());
                      if ($to > $AllProducts->total()) {
                        $to = $AllProducts->total();
                      }
                      if ($AllProducts->currentPage() > 1) {
                        $from = ($AllProducts->currentPage() * $AllProducts->perPage()) - $AllProducts->perPage();
                      } else {
                        $from = 1;
                      }

                      $filter_parameter_name = '';
                      $filter_parameter_value = '';

                      if(isset($_GET['out_of_stock'])){
                        $filter_parameter_name = 'out_of_stock';
                        $filter_parameter_value = $_GET['out_of_stock'];
                      }
                      if(isset($_GET['is_deleted'])){
                        $filter_parameter_name = 'is_deleted';
                        $filter_parameter_value = $_GET['is_deleted'];
                      }
                      if(isset($_GET['is_published'])){
                        $filter_parameter_name = 'is_published';
                        $filter_parameter_value = $_GET['is_published'];
                      }
                      $extraParams = '';
                      if($filter_parameter_name != ''){
                        $extraParams = [$filter_parameter_name => $filter_parameter_value];
                      }
                      ?>
                      {!! $AllProducts->appends($extraParams)->render().'Showing '. $from .' - '. $to . ' of '.$AllProducts->total() !!}
                      <?php $previousProductId = 0; $previousCategoryId = 0; ?>
                      @foreach($AllProducts as $Product)
                        <?php
                            if(!isset($Product->id)){continue;}

                        $productVariants = $allProductSubItems[$Product->id]['items'];
                        $totalProducts = getTotal($Product->id, 'store', $user->id);
                        ?>
                        <tr @if($Product->quantity <= $Product->stock_alert_quantity) title="Your product quantity is in need to be updated."
                            @endif class="productList @if($Product->quantity <= $Product->stock_alert_quantity) minimum_stock_reached @endif product_item_{{$Product->id}} @if($previousProductId == $Product->id) child_of_product_{{$Product->id}} product_children @else product_parent @endif">
                        <!-- showing categories breadcrumb -->
                        @if($previousCategoryId != $Product->category_id)
                          <?php $count = 0; $breadCrumbsCats = getBreadCrumbsBySubCategoryId($Product->category_id); ?>
                          <tr>
                            <th colspan="16">
                              <?php $breadCrumbsCats = array_reverse($breadCrumbsCats); $lastElement = end($breadCrumbsCats); ?>
                              @foreach($breadCrumbsCats as $breadCrumbsCat)
                                <span title="This product belongs to Category: {{$breadCrumbsCat['name']}}">{{$breadCrumbsCat['name']}}</span> @if($lastElement != $breadCrumbsCat) > @endif
                              @endforeach
                            </th>
                          </tr>
                        @endif
                        <!-- end of showing categories breadcrumb -->

                          <td class="imgW">
                            <?php $productImage = getRandomImageOfProduct($Product->id); ?>
                            @if($previousProductId == $Product->id)
                              <?php
                              $attribute_label_1 = getAttributeLabel($Product->master_attribute_1);
                              $attribute_label_2 = getAttributeLabel($Product->master_attribute_2);
                              $attribute_1_value = getAttributeValueLabel($Product->master_attribute_1_value);
                              $attribute_2_value = getAttributeValueLabel($Product->master_attribute_2_value);
                              ?>
                              <a class="titleW product_children_row">{{$attribute_label_1}}:{{$attribute_1_value}}
                                , {{$attribute_label_2}}:{{$attribute_2_value}}</a>
                            @else
                              <a class="titleW"
                                 href="{{url('product/'.$Product->id )}}">
                                <img
                                    src="{{ $productImage }}" alt="image"
                                    width="80 " height="54"
                                    onError="this.onerror=null;this.src='{{getProductDefaultImage()}}';">
                              </a>
                              <a class="titleW" title="{{$Product->title}}"
                                 href="{{url('product/'.$Product->id )}}">{{str_limit($Product->title, 50)}}</a>
                              <a id="product-parent-{{$Product->id}}"
                                 data-product-id="{{$Product->id}}"
                                 class="stats product_variants_btn btn btn-primary"
                                 title="Show variants of product."><i class="fa fa-bars"></i> Show Variants</a>
                            @endif

                          </td>
                          <td>@if($Product->category_id > 0) {{getCategoryId($Product->category_id)->name}} @else N/A @endif</td>
                          <td>@if($previousProductId == $Product->id) {{$Product->quantity}} @else {{$totalProducts}} @endif</td>
                          <td>@if($previousProductId == $Product->id){{$Product->stock_alert_quantity}} @else - @endif</td>

                          <td>
                            <?php
                            if ($previousProductId == $Product->id) {
                              $inStockProducts = $Product->quantity;
                            } else {
                              $inStockProducts = getInStock($Product->id);
                            }

                            $sentToPos = getSentToPos($Product->id);?>
                            {{$inStockProducts}}
                          </td>

                          <td>{{$totalProducts - $inStockProducts - $sentToPos}}</td>
                          <td>{{$sentToPos}}</td>
                          <td class="actW">
                            @if($previousProductId != $Product->id)
                              @if($Product->affiliate == 1)
                                Yes
                              @else
                                No
                              @endif
                            @else
                              -
                            @endif
                          </td>
                          <td class="actW">@if($previousProductId == $Product->id) {{$attribute_label_1}}: {{$attribute_1_value}} @else - @endif</td>
                          <td class="actW">@if($previousProductId == $Product->id) {{$attribute_label_2}}: {{$attribute_2_value}} @else - @endif</td>
                          <td class="actW">@if($previousProductId == $Product->id) {{$Product->cost_price}} @else - @endif</td>
                          <td class="actW">@if($previousProductId == $Product->id) {{$Product->price}} @else - @endif</td>
                          <td>-</td>
                          <td class="actW">
                            @if($previousProductId != $Product->id)
                              <a title="Web Stat" class="stats" target="_blank"
                                 href="{{url('store/'.Auth::user()->username.'/admin/'.$Product->id )}}/product_analytics">
                                <i class="fa fa-bar-chart-o"></i>
                              </a>
                              <a href="{{url('store/'.Auth::user()->username.'/admin/edit-product/'.$Product->id )}} "
                                 class="editProduct ml20 mr20" title="Edit"><i class="fa fa-edit"></i></a>
                              <a title="Delete" data-toggle="confirmation"
                                 data-href="{{url('store/'.Auth::user()->username.'/admin/delete/product/'.$Product->id)}}"
                                 id="{{$Product->id}}" style="cursor: pointer"
                                 class="deleteProduct"><i class="fa fa-close"></i></a>


                              @if($Product->is_published == 1)
                                <a class="btn btn-primary" data-target="#push-items"
                                   data-toggle="modal" type="button"
                                   href="{{url('store/pos/push-items/'.$Product->id)}}"
                                   data-header="Push Items to POS">
                                  Push Items to POS
                                </a>
                                <a href="#" data-product-id="{{$Product->id}}"
                                   class="btn btn-primary btn-draft-product"
                                   title="This product is Published, click to sent this product in Draft Box.">Click to Un-Publish</a>
                              @else
                                <a href="#" data-product-id="{{$Product->id}}"
                                   class="btn btn-primary btn-publish-product"
                                   title="This product is Un-Published, click to set this product as Published.">Click to Publish</a>
                              @endif
                            @else
                              -
                            @endif
                          </td>
                        </tr>

                        @if($previousProductId != $Product->id)
                            <!-- parent product as variant-->
                        <tr @if($Product->quantity <= $Product->stock_alert_quantity) title="Your product quantity is in need to be updated." @endif class="productList @if($Product->quantity <= $Product->stock_alert_quantity) minimum_stock_reached @endif product_item_{{$Product->id}}  child_of_product_{{$Product->id}} product_children">
                          <td class="imgW">
                            <?php $productImage = getRandomImageOfProduct($Product->id); ?>

                              <?php
                              $attribute_label_1 = getAttributeLabel($Product->master_attribute_1);
                              $attribute_label_2 = getAttributeLabel($Product->master_attribute_2);
                              $attribute_1_value = getAttributeValueLabel($Product->master_attribute_1_value);
                              $attribute_2_value = getAttributeValueLabel($Product->master_attribute_2_value);
                              ?>
                              <a class="titleW product_children_row">{{$attribute_label_1}}:{{$attribute_1_value}}
                                , {{$attribute_label_2}}:{{$attribute_2_value}}</a>
                          </td>
                          <td>@if($Product->category_id > 0) {{getCategoryId($Product->category_id)->name}} @else N/A @endif</td>
                          <td>{{$Product->quantity}}</td>
                          <td>{{$Product->stock_alert_quantity}}</td>

                          <td>
                            <?php
                              $inStockProducts = $Product->quantity;
                              $sentToPos = '-';
                            ?>
                            {{$inStockProducts}}
                          </td>

                          <td>{{$totalProducts - $inStockProducts}}</td>
                          <td>{{$sentToPos}}</td>
                          <td class="actW">-</td>
                          <td class="actW">{{$attribute_label_1}}: {{$attribute_1_value}}</td>
                          <td class="actW">{{$attribute_label_2}}: {{$attribute_2_value}}</td>
                          <td class="actW">{{$Product->cost_price}}</td>
                          <td class="actW">{{$Product->price}}</td>
                          <td class="actW"> - </td>
                          <td class="actW"> - </td>
                        </tr>
                        <!-- end of parent product as variant-->
                        @endif
                        <?php $previousProductId = $Product->id;
                              $previousCategoryId = $Product->category_id;
                        ?>
                      @endforeach
                    @endif
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

  <!-- /page content -->
  @endsection

  @section('scripts')
  {{-- {!! HTML::script('local/public/assets/store/general.js') !!}--}}
  {!! HTML::script('local/public/assets/js/global/global.js') !!}
  {{-- <div aria-hidden="true" role="dialog" tabindex="-1" class="modal fade bs-example-modal-sm">
       <div class="modal-dialog modal-sm">
           <div class="modal-content">

               <div class="modal-header">
                   <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span>
                   </button>
                   <h4 id="myModalLabel2" class="modal-title">Select POS</h4>
               </div>


           </div>
       </div>
   </div>--}}
      <!--product-variants-popup-->
  <div class="modal fade" id="product-variants" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
       aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <a class="close" data-dismiss="modal">×</a>

          <h3 id="modal-header" class="product-title">Product Variant(s)</h3>
        </div>
        <div class="modal-body row product_variants_listing"></div>
        <div class="modal-footer">
          <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
          <a href="#" class="btn btn-primary edit_product_link">Edit Product</a>
        </div>
      </div>

    </div>
  </div>
  <!--end of product-variants-popup-->

  {!! Form::open(['url' => 'admin/store/pos/push-items']) !!}
  <div class="modal fade" id="push-items" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <a class="close" data-dismiss="modal">×</a>

          <h3 id="modal-header">Push Items</h3>
        </div>
        <div class="modal-body row"></div>
        <div class="modal-footer">
          <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
          <button class="btn btn-primary" type="submit">Push Items</button>
        </div>
      </div>

    </div>
  </div>
  {!! Form::close() !!}

  <script>
    $(document).on('change', '#filter_by_category', function (evt) {
        var category_id = $('#filter_by_category').val();
        window.location = '{{url('store/'.Auth::user()->username.'/admin/manage-product?category_id=')}}'+category_id;
    });

    $(document).on('click', '.product_variants_btn', function (evt) {
      var productId = $(this).data('productId');
      $(".child_of_product_" + productId).toggle();
      var variantsBtn = $('#product-parent-' + productId);
      var variantsBtnText = $('#product-parent-' + productId).text();
      if (variantsBtnText.indexOf('Show Variants') > -1) {
        variantsBtn.html('<i class="fa fa-bars"></i> Hide Variants');
      } else {
        variantsBtn.html('<i class="fa fa-bars"></i> Show Variants');
      }

      //var editProductUrl = $(this).data('editUrl');
      //var productTitle = $(this).data('productTitle');
      //var productImageSource = $(this).data('productImageSource');
      //var productDefaultImageSource = $(this).data('productDefaultImageSource');

      //$(".edit_product_link").attr('href', editProductUrl);
      //$(".product-title").html(productTitle + " Variant(s)");

      //var getVariantsUrl = '{{url('store/'.Auth::user()->username.'/admin/get-product-variants/')}}/' + productId;
      //$.ajax({
      //  type: "POST",
      //url: getVariantsUrl,
      //data: {},
      //success: function (data) {
      //  $(".product_variants_listing").html(data);
      //}
      //});
    });

    $(document).on('click', '.btn-publish-product', function (evt) {
      //var confirmed = confirm("Are you sure you want to Publish this product.");
      //if(!confirmed){
      //   return false;
      //}

      var product_id = $(this).data('productId');
      var shipping_cost = $("#shipping-cost").val();
      $(".actionBar a:nth-child(2)").html('Saving..');
      $(".actionBar a:first").html('Saving..');

      var saveUrl = '{{url('store/'.Auth::user()->username.'/admin/save-product-for-publish/')}}/' + product_id;
      $.ajax({
        type: "POST",
        url: saveUrl,
        data: {shipping_cost: shipping_cost},
        success: function (data) {
          window.location = "{{url('store/'.Auth::user()->username.'/admin/manage-product')}}";
        }
      });
    });

    $(document).on('click', '.btn-draft-product', function () {
      //var confirmed = confirm("Are you sure you want to Send this product in drafts.");
      //if(!confirmed){
      //   return false;
      // }
      var product_id = $(this).data('productId');
      var shipping_cost = $("#shipping-cost").val();

      var saveUrl = '{{url('store/'.Auth::user()->username.'/admin/save-product-for-draft/')}}/' + product_id;
      $.ajax({
        type: "POST",
        url: saveUrl,
        data: {shipping_cost: shipping_cost},
        success: function (data) {
          window.location = "{{url('store/'.Auth::user()->username.'/admin/manage-product')}}";
        }
      });
    });
  </script>
  @if(Auth::Check())
    {!! getOutOfStockProducts(Auth::user()->id, 1) !!}
  @endif
@endsection
