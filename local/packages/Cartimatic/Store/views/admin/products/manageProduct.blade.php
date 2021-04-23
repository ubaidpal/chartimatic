@extends('Store::layouts.store-admin')
@section('content')
  <style>
    #advanced-search{
      cursor: pointer;
    }
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
          <small>
            <span id="advanced-search">Advanced Search</span>
          </small>
        </div>
        {!! Form::close() !!}

        <div id="advanced-search-form">
          <form class="form-horizontal form-label-left">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Name</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" class="form-control" id="adv_srch_product_name" class="adv_srch_product_name" value="" name="adv_srch_product_name" placeholder="Product Name">
                <input type="hidden" class="form-control" id="is_adv_srch" class="adv_srch_product_name" value="1" name="is_adv_srch" >
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Brands</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="adv_srch_brands" name="adv_srch_brands[]" class="select2_multiple adv_srch_brands form-control select2-hidden-accessible" multiple="" tabindex="8881" aria-hidden="true">
                  <option>Select Brands</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Suppliers</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="adv_srch_suppliers" name="adv_srch_suppliers[]" class="select2_multiple adv_srch_suppliers form-control select2-hidden-accessible" multiple="" tabindex="8881" aria-hidden="true">
                  <option>Select Suppliers</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Categories</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="adv_srch_categories" name="adv_srch_categories[]" class="select2_multiple adv_srch_categories form-control select2-hidden-accessible" multiple="" tabindex="8882" aria-hidden="true">
                  <option>Select Categories</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Attributes</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="adv_srch_attributes" name="adv_srch_attributes[]" class="select2_multiple adv_srch_attributes form-control select2-hidden-accessible" multiple="" tabindex="8883" aria-hidden="true">
                  <option>Select Attributes</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Price Range</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="adv_srch_price_range" name="adv_srch_price_range[]" class="select2_multiple adv_srch_price_range form-control select2-hidden-accessible" multiple="" tabindex="8884" aria-hidden="true">
                  <option>Select Price Range</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="button" onclick="window.location.href='<?php echo url('store/'.Auth::user()->username.'/admin/manage-product'); ?>'" class="btn btn-primary">Reset</button>
                <button type="submit" class="btn btn-success advance-search-button">Search</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    @include('includes.alerts')
    <div class="row">
      <div class="col-md-12 table-responsive">
        <div class="x_panel">
          <div class="x_title">
            <h2>All Products
            </h2>

            <div class="form-group pull-right filter-wrapper">
              <label for="sel1">Filter By Category:</label>
              <select name="filter_by_category" id="filter_by_category" class="form-control" id="sel1">
                @foreach($ownerProductCategories as $cat)
                  <option @if(isset($category_id)) @if($category_id == $cat->id) selected="selected"
                          @endif @endif value="{{$cat->id}}">{{$cat->name}}</option>
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

                    if (isset($_GET['out_of_stock'])) {
                      $filter_parameter_name  = 'out_of_stock';
                      $filter_parameter_value = $_GET['out_of_stock'];
                    }
                    if (isset($_GET['is_deleted'])) {
                      $filter_parameter_name  = 'is_deleted';
                      $filter_parameter_value = $_GET['is_deleted'];
                    }
                    if (isset($_GET['is_published'])) {
                      $filter_parameter_name  = 'is_published';
                      $filter_parameter_value = $_GET['is_published'];
                    }
                    $extraParams = ['no_var'=>'no_var'];
                    if ($filter_parameter_name != '') {
                      $extraParams = [$filter_parameter_name => $filter_parameter_value];
                    }
                    if(isset($_GET)){
                      $extraParams = array_merge($extraParams, $_GET);
                    }
                    ?>
                    {!! $AllProducts->appends($extraParams)->render().'Showing '. $from .' - '. $to . ' of '.$AllProducts->total() !!}
                    <?php $previousProductId = 0; $previousCategoryId = 0; ?>
                    <table class="table table-hover table-bordered">
                      <thead>
                      <tr>
                        <th>#</th>
                        <th>Product Title</th>
                        <th>Variant</th>
                        <th>Brand Info</th>
                        <th>Supplier Info</th>
                        <th>Category</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Alert Qty</th>
                        <th class="text-center">Stock Qty</th>
                        <th class="text-center">Sold</th>
                        <th class="text-center">Sent to POS</th>
                        <th class="text-center">Cost Price</th>
                        <th class="text-center">Price</th>
                        <th width="10%" class="text-center">Actions</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php ($AllProducts->currentPage() == 1) ? $countRecordsAccordingPage = $from - 1 : $countRecordsAccordingPage = $from;?>
                      @foreach($AllProducts as $k => $Product)
                        <?php
                        if (!isset($Product->id)) {
                          continue;
                        }
                        $productVariants = $allProductSubItems[$Product->id]['items'];
                         $totalProducts = getTotal($Product->id, 'store', $user->id, $Product->keeping_id);
                        ?>
                        <tr @if($previousProductId != $Product->id) style="background-color: #e3e3e3;" @endif>
                          <th scope="row">
                            <?php echo ++$countRecordsAccordingPage; ?></th>
                          <td>
                            <?php $productImage = getRandomImageOfProduct($Product->id); ?>
                            <a class="titleW"
                               href="{{url('product/'.$Product->id )}}">
                              <img
                                  src="{{ $productImage }}" alt="image"
                                  width="80 " height="54"
                                  onError="this.onerror=null;this.src='{{getProductDefaultImage()}}';">
                            </a>
                            <a target="_blank" href="{{url('product/'.$Product->id)}}"
                               title="View product detail {{$Product->title}}">{{$Product->title}}</a>
                          </td>
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
                          <td class="imgW">
                            <?php $brandInfo = getStoreBrandInfo($Product->brand_id);
                            if(isset($brandInfo->id)){
                              $brand_info_str = $brandInfo->name.' ( Tel # '.$brandInfo->contact_no.')';
}else{  $brand_info_str = ''; } ?>
                            {{$brand_info_str}}
                          </td>

                          <td class="imgW">
                            <?php $supplierInfo = getStoreSupplierInfo($Product->supplier_id);
                            if(isset($supplierInfo->id)){
                              $supplier_info_str = $supplierInfo->name.' ( Tel # '.$supplierInfo->contact_no.')';
                            }else{  $supplier_info_str = ''; } ?>
                            {{$supplier_info_str}}
                          </td>
                          <td>@if($Product->category_id > 0) {{getCategoryId($Product->category_id)->name}} @else
                              N/A @endif</td>
                          <td class="text-center">{{$Product->quantity}}</td>
                          <td class="text-center">{{$Product->stock_alert_quantity}}</td>

                          <td class="text-center">
                            <?php
                            $inStockProducts = $Product->quantity;
                            $sentToPos = '-';
                            ?>
                            {{$inStockProducts}}
                          </td>

                          <td class="text-center">{{$totalProducts - $inStockProducts}}</td>
                          <td class="text-center">{{$sentToPos}}</td>
                          <td class="actW text-center">{{$Product->cost_price}}</td>
                          <td class="actW text-center">{{$Product->price}}</td>
                          <td class="actW ttext-center">
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


                              <!--<div style="display: none;" class="push_to_item_wrap" id="push_to_itme_wrap_{{$Product->id}}">-->
                              @if($Product->is_published == 1)
                                <a class="ml20 mr20" data-target="#push-items"
                                   data-toggle="modal" type="button"
                                   href="{{url('store/pos/push-items/'.$Product->id)}}"
                                   data-header="Push Items to POS"><i class="fa fa-square"></i></a>
                                <a href="#" data-product-id="{{$Product->id}}"
                                   class="ml20 mr20 btn-draft-product"
                                   title="This product is Published, click to sent this product in Draft Box."><i class="fa fa-shopping-cart"></i></a>

                              @else
                                <a href="#" data-product-id="{{$Product->id}}"
                                   class="ml20 mr20 btn-publish-product"
                                   title="This product is Un-Published, click to set this product as Published."><i class="fa fa-square"></i></a>
                                <!--</div>-->
                              @endif

                            @else
                              <a title="Delete" data-toggle="confirmation"
                                 data-href="{{url('store/'.Auth::user()->username.'/admin/delete/product/'.$Product->id.'/'.$Product->master_attribute_1.'/'.$Product->master_attribute_1_value.'/'.$Product->master_attribute_2.'/'.$Product->master_attribute_2_value)}}"
                                 id="{{$Product->id}}" style="cursor: pointer"
                                 class="deleteProduct"><i class="fa fa-close"></i></a>
                            @endif
                            <?php $previousProductId = $Product->id;
                            $previousCategoryId = $Product->category_id;
                            ?>
                          </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  @endif
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
  {!! HTML::script('local/public/assets/js/global/global.js') !!}
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
      <!-- select2 -->
  {!! HTML::script('local/public/assets/gentelella/js/select/select2.full.js') !!}
  {!! HTML::style('local/public/assets/gentelella/css/select/select2.min.css') !!}
  <script>
    var howManyTimeSearchShowed = 0;
    $(document).on('change', '#filter_by_category', function (evt) {
      var category_id = $('#filter_by_category').val();
      window.location = '{{url('store/'.Auth::user()->username.'/admin/manage-product?category_id=')}}' + category_id;
    });

    $(document).on('click', '.btn-publish-product', function (evt) {
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

    $('tr').hover(function () {
      $(".push_to_item_wrap").hide();
      $(this).find(".push_to_item_wrap").fadeIn();
    });

    $(document).on('click', '.btn-draft-product', function () {
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

    $(".adv_srch_brands").select2();
    $(".adv_srch_suppliers").select2();
    $(".adv_srch_categories").select2();
    $(".adv_srch_attributes").select2();
    $(".adv_srch_price_range").select2();

    $("#advanced-search").click(function (evt) {
      howManyTimeSearchShowed++;
      $("#advanced-search-form").toggle();
      if(howManyTimeSearchShowed > 1 && howManyTimeSearchShowed < 3){
        fetchAdvancedSearchAttributes();
      }
    });
    $("#advanced-search").click();
    function fetchAdvancedSearchAttributes(){
      $(".advance-search-button").text("loading...");
      var fetchUrl = '{{url('store/'.Auth::user()->username.'/admin/getAdvancedSearchAttributes')}}';
      $.ajax({
        type: "POST",
        url: fetchUrl,
        data: {shipping_cost: 208},
        success: function (data) {
          var parseJson = jQuery.parseJSON( data );
          var items = '';

          $(".advance-search-button").text("Search");
          // brands
          $(parseJson.brands).each(function (i, item) {
            var id = parseInt(item.id);
            items += '<option value="'+id+'">'+item.name+'</option>';
          });

          $(".adv_srch_brands").empty().append(items).trigger('change');
          // end brands

          // suppliers
          items = '';
          $(parseJson.suppliers).each(function (i, item) {
            var id = parseInt(item.id);
            items += '<option value="'+id+'">'+item.name+'</option>';
          });

          $(".adv_srch_suppliers").empty().append(items).trigger('change');
          // end suppliers

          // categories
          items = '';
          $(parseJson.categories).each(function (i, item) {
            var id = parseInt(item.id);
            items += '<option value="'+id+'">'+item.name+'</option>';
          });
          $(".adv_srch_categories").empty().append(items).trigger('change');
          // end categories

          // price rang
          items = '';
          $(parseJson.variants).each(function (i, item) {
            var id = parseInt(item.id);
            items += '<option value="'+id+'">'+item.attribute+'</option>';
          });
          $(".adv_srch_attributes").empty().append(items).trigger('change');
          // end attributes

          // price rang
          items = '';
          $(parseJson.price_range).each(function (i, item) {
            var id = parseInt(item.id);
            items += '<option value="'+id+'">'+item.price+'</option>';
          });
          $(".adv_srch_price_range").empty().append(items).trigger('change');
          // end price rang
          //to pre-selected filter attributes.
          if($.isFunction(ifAlreadyInAdvSrchFilters())){ifAlreadyInAdvSrchFilters();}
        }
      });
      $(".advance-search-button").click(function (evt) {
        var is_advance_search = 1;
        var adv_srch_product_name = $("#adv_srch_product_name").val();
        var brands = $(".adv_srch_brands").val();
        var categories = $(".adv_srch_categories").val();
        var attributes = $(".adv_srch_attributes").val();
        var price_range = $(".adv_srch_price_range").val();
        console.log(adv_srch_product_name +" product name < "+brands+' < b '+ categories+ ' < c '+attributes+ ' atr '+ price_range + ' pra ');
      });
    }
  </script>
@if(isset($_REQUEST['is_adv_srch']))
<script>
function ifAlreadyInAdvSrchFilters(){
  var adv_srch_product_name = '<?php echo (isset($_REQUEST['adv_srch_product_name']))? $_REQUEST['adv_srch_product_name']: ''; ?>';
  var adv_srch_brands = [<?php echo (isset($_REQUEST['adv_srch_brands']))? convertArrayToString($_REQUEST['adv_srch_brands']): ''; ?>];
  var adv_srch_suppliers = [<?php echo (isset($_REQUEST['adv_srch_suppliers']))? convertArrayToString($_REQUEST['adv_srch_suppliers']): ''; ?>];
  var adv_srch_categories = [<?php echo (isset($_REQUEST['adv_srch_categories']))? convertArrayToString($_REQUEST['adv_srch_categories']): ''; ?>];
  var adv_srch_attributes = [<?php echo (isset($_REQUEST['adv_srch_attributes']))? convertArrayToString($_REQUEST['adv_srch_attributes']): ''; ?>];
  var adv_srch_price_range = [<?php echo (isset($_REQUEST['adv_srch_price_range']))? convertArrayToString($_REQUEST['adv_srch_price_range']): ''; ?>];

  $("#adv_srch_product_name").val(adv_srch_product_name);

  $("#adv_srch_brands").select2('val', adv_srch_brands);
  $("#adv_srch_suppliers").select2('val', adv_srch_suppliers);
  $("#adv_srch_categories").select2('val', adv_srch_categories);
  $("#adv_srch_attributes").select2('val', adv_srch_attributes);
  $("#adv_srch_price_range").select2('val', adv_srch_price_range);
}
  $("#advanced-search").click();
</script>
@endif
  @if(Auth::Check())
    {!! getOutOfStockProducts(Auth::user()->id, 1) !!}
  @endif
@endsection
