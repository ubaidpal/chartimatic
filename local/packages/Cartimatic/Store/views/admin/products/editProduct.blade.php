@extends('Store::layouts.store-admin')
@section('styles')

  {!! HTML::style('local/public/assets/plugins/jquery-cropper/css/cropper.min.css') !!}
  {!! HTML::style('local/public/assets/plugins/jquery-cropper/css/main.css') !!}
  <style>
    body {
      background: #2A3F54;
    }
  </style>
@endsection
@section('content')
  {!! HTML::script('local/public/assets/js/tinymce/tinymce.min.js') !!}
  <style>
    .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
      padding-left: 3px;
      padding-right: 3px;
    }

    .col-md-1 {
      padding-right: 0px;
      padding-left: 5px;
    }
  </style>
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h1>Edit Product</h1>
      </div>

    </div>
    <div class="clearfix"></div>
    <input type="hidden" value="{{url("")}}" name="baseURL" id="baseURL">

    <input type="hidden" value="{{@$categories}}" name="p_categories" id="parent_categories"/>

    <div class="row">

      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Steps to add product
              <small id="auto_saving" class="auto_saving" style="text-align:center; display: none;">Saving...</small>
            </h2>

            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <!-- Smart Wizard -->
            <div id="wizard" class="form_wizard wizard_horizontal">
              <ul class="wizard_steps">
                <li>
                  <a href="#step-1">
                    <span class="step_no">1</span>
                                        <span class="step_descr">
                                            Step 1<br/>
                                            <small>Basic Information</small>
                                        </span>
                  </a>
                </li>
                <li>
                  <a href="#step-6">
                    <span class="step_no">2</span>
                                        <span class="step_descr">
                                            Step 2<br/>
                                            <small>Product Attributes</small>
                                        </span>
                  </a>
                </li>
                <li>
                  <a href="#step-2">
                    <span class="step_no">3</span>
                                        <span class="step_descr">
                                            Step 3<br/>
                                            <small>Specifications & Features</small>
                                        </span>
                  </a>
                </li>
                <li>
                  <a href="#step-3" class="step-3">
                    <span class="step_no">4</span>
                                        <span class="step_descr">
                                            Step 4<br/>
                                            <small>Pricing & Inventory</small>
                                        </span>
                  </a>
                </li>
                <li>
                  <a href="#step-4">
                    <span class="step_no">5</span>
                                        <span class="step_descr">
                                            Step 5<br/>
                                            <small>Product Photos</small>
                                        </span>
                  </a>
                </li>
                <li>
                  <a href="#step-5" id="last_step">
                    <span class="step_no">6</span>
                    <span class="step_descr">
                        Step 6<br/>
                        <small>Shipping Cost</small>
                    </span>
                  </a>
                </li>
              </ul>
              <div id="step-1">

                <form class="form-horizontal form-label-left" id="form-basic">
                  <input type="hidden" class="is_product_id_edit" id="is_product_id_edit" name="is_product_id_edit"
                         value="{{@$product->id}}"/>
                  <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Title
                      <span class="required">*</span>
                    </label>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" name="title" id="product-title"
                             value="{{@$product->title}}" required="required"
                             class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="parent_custom_id control-label col-md-3 col-sm-3 col-xs-12" for="parent_custom_id">Custom ID
                    </label>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" readonly name="custom_id" id="parent_custom_id" value="{{@$product->custom_id}}"
                             class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Alternate Code</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" name="alternate_code" id="p_custom_id" value="{{$product->alternate_code}}" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Overview
                      <span class="required">*</span>
                    </label>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" name="overview" id="product-overview"
                             value="{{@$product->overview}}" required="required"
                             class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Description <span
                          class="required">*</span>
                    </label>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <textarea required="required" name="content"
                                id="content">{!! $autoSavingProductInfo->description !!}</textarea>
                    </div>
                  </div>

                  <div class="form-group category_selection_wrap">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Line Item<span class="required">*</span>
                    </label>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div id='loading_category'
                           style="margin-bottom:10px; text-align:center; background: red; color: #fff;">Loading
                        Categories
                      </div>

                      <?php if (isset($product->category_id)) {
                        $categorySelected = $product->category_id;
                      } else {
                        $categorySelected = '';

                      }{
                        $categorySelected = '';

                      } ?>

                      {!!  Form::select('category',
 [''], $categorySelected, ['id' => 'category', 'class' => 'parent_category form-control category_selection',
 'name' => 'category_id' , 'data-level'=> '0'])!!}

                    </div>
                  </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12"
                             for="first-name">Category</label>

                      <div class="sub-cat-list level-1 col-md-6 col-sm-6 col-xs-12"
                           data-level="1">

                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Brand</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="brand">
                          <option value="">--Select Brand--</option>
                          @foreach($brands as $id => $name)
                            <option @if($product->brand_id == $id) selected @endif value="{{$id}}">{{ucfirst($name)}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Acquire Type</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="acquire_type">
                          <option value="">--Select--</option>
                          <option @if($product->acquire_type == 'purchased') selected @endif value="purchased">Purchased</option>
                          <option @if($product->acquire_type == 'manufactured') selected @endif value="manufactured">Manufactured</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Purchase Type</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="purchase_type">
                          <option value="">--Select--</option>
                          <option @if($product->purchase_type == 'foreign') selected @endif value="foreign">Foreign</option>
                          <option @if($product->purchase_type == 'imported') selected @endif value="imported">Imported</option>
                          <option @if($product->purchase_type == 'local') selected @endif value="local">Local</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Supplier</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="supplier">
                          <option value="">--Select Supplier--</option>
                          @foreach($suppliers as $id => $name)
                            <option @if($product->supplier_id == $id) selected @endif value="{{$id}}">{{ucfirst($name)}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Manufacturing</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="manufacturing">
                          <option value="">--Select--</option>
                          <option @if($product->manufacturing == 'outsourced') selected @endif value="outsourced">Outsourced</option>
                          <option @if($product->manufacturing == 'self') selected @endif value="self">Self</option>
                        </select>
                      </div>
                    </div>

                  </div>
                  <div class="col-md-6">

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Sales Tax(Purchase)</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input value="{{$autoSavingProductInfo->sales_tax_purchase}}" type="number" min="0" max="100" name="sales_tax_purchase" class="form-control">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-3">&nbsp;</label>
                      <div class="col-md-9">
                        <label class="radio-inline">
                          <input @if($autoSavingProductInfo->sales_tax_purchase_at == 'retail_price') checked @endif type="radio" name="sales_tax_purchase_at"  value="retail_price"> At Retail Price
                        </label>
                        <label class="radio-inline">
                          <input @if($autoSavingProductInfo->sales_tax_purchase_at == 'retail_price') checked @endif type="radio" name="sales_tax_purchase_at" value="purchase_price"> At Purchase Price
                        </label>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Sales Tax(Sales)</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input value="{{$autoSavingProductInfo->sales_tax_sales}}" type="number" min="0" name="sales_tax_sales" class="form-control">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-3">&nbsp;</label>
                      <div class="col-md-9">
                        <label class="radio-inline">
                          <input @if($autoSavingProductInfo->sales_tax_sales_type == 'percentage') checked @endif type="radio" name="sales_tax_sales_type"  value="percentage"> Percentage
                        </label>
                        <label class="radio-inline">
                          <input @if($autoSavingProductInfo->sales_tax_sales_type == 'value') checked @endif type="radio" name="sales_tax_sales_type" value="value"> Value
                        </label>
                      </div>
                    </div>

                  </div>
                </form>
              </div>
              <div id="step-6">
                <form class="form-horizontal form-label-left" id="product-attributes">

                </form>
              </div>
              <div id="step-2">
                <form class="form-horizontal form-label-left" id="specifications-form">

                  @if(isset($features))
                    @if($features > 0)
                      @foreach($features as  $key => $feature)
                        <input type="hidden" name="is_product_id_edit"
                               value="{{@$product->id}}"/>

                        <div class="x_panel">

                          <div class="form-group col-md-5">
                            <label class="@if($key == 0) first_title_spec_lbl @endif control-label col-md-3 col-sm-3 col-xs-12"
                                   for="first_title_spec_lbl">Feature
                              Title
                            </label>

                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input @if($key == 0) id="first_title_spec_lbl" @endif type="text" name="title[]" required="required"
                                     value="{{@$feature->title}}"
                                     class="form-control col-md-7 col-xs-12">
                            </div>
                          </div>

                          <div class="form-group col-md-6">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                   for="first-name">Feature
                              Value
                            </label>

                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" name="detail[]" required="required"
                                     value="{{@$feature->detail}}"
                                     class="form-control col-md-7 col-xs-12">
                            </div>
                          </div>
                          <div class="col-md-1">
                            <ul class="nav navbar-right panel_toolbox">
                              <li>
                                <a class="close-link"><i class="fa fa-times"></i></a>
                              </li>
                            </ul>
                          </div>
                        </div>
                      @endforeach
                    @endif
                </form>

                <div class="right">
                  <button type="button" class="btn btn-default right add-specs-pair">Add New
                  </button>
                </div>

                <div class="hidden first-specs-pair">
                  <div class="form-group col-md-5">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Feature
                      Title
                    </label>

                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" name="title[]" required="required"
                             class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>

                  <div class="form-group col-md-6">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Feature
                      Value
                    </label>

                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" name="detail[]" required="required"
                             class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>

                  <div class="col-md-1">
                    <ul class="nav navbar-right panel_toolbox">
                      <li>
                        <a class="close-link"><i class="fa fa-times"></i></a>
                      </li>
                    </ul>
                  </div>
                </div>
                @endif
              </div>
              <div id="step-3">
                <h2 class="StepTitle"></h2>

                <div class="x_panel" style="border: none">
                  <div class="form-group col-md-12">
                    <label class="product_id_lbl control-label col-md-1 col-sm-12 col-xs-1" for="product_id_lbl">Product ID
                    </label>
                    <label class="control-label col-md-1 col-sm-12 col-xs-1" for="first-name" id="attribute-1">Size
                    </label>

                    <label class="control-label col-md-1 col-sm-12 col-xs-21" for="first-name" id="attribute-2">Colour
                    </label>

                    <label class="control-label col-md-1 col-sm-12 col-xs-2" for="first-name">Package
                    </label>

                    <label class="control-label col-md-1 col-sm-12 col-xs-1" for="first-name">Price
                    </label>

                    <label class="control-label col-md-1 col-sm-12 col-xs-1" for="first-name">Cost Price
                    </label>

                    <label class="control-label col-md-1 col-sm-12 col-xs-1" for="first-name">Quantity
                    </label>

                    <label title="Stock Alert Quantity is going to alert when your product stock reached this limit."
                           class="control-label col-md-1 col-sm-12 col-xs-1" for="first-name">Stock Alert Quantity
                    </label>

                    <label title="Optimal Quantity is going to alert when your product stock reached this limit."
                           class="control-label col-md-1 col-sm-12 col-xs-1" for="first-name">Optimal Quantity
                    </label>

                    <label class="control-label col-md-1 col-sm-12 col-xs-1" for="first-name">Discount
                    </label>
                    <label class="control-label col-md-2 col-sm-12 col-xs-2" for="first-name">Barcode
                    </label>
                  </div>

                </div>
                <form id="inventoryPricing">
                  <input type="hidden" name="is_product_id_edit" value="{{@$product->id}}"/>

                  <div class="x_panel">
                    <div class="form-group col-md-1">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="text" id="product_id_lbl" name="custom_id[]"
                               class="keeping_custom_product_id form-control col-md-12 col-xs-12"
                               placeholder="Custom Id">
                      </div>
                    </div>

                    <div class="form-group col-md-1">
                      <div class="col-md-12 col-sm-12 col-xs-12 attribute-1-value" id="attribute-1-value">

                      </div>
                    </div>
                    <div class="form-group col-md-1">
                      <div class="col-md-12 col-sm-12 col-xs-12 attribute-2-value" id="attribute-2-value">

                      </div>
                    </div>
                    <div class="form-group col-md-1">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="text" name="package[]"
                               class="keeping_package form-control col-md-12 col-xs-12"
                               placeholder="e.g Bundle">
                      </div>
                    </div>


                    <div class="form-group col-md-1">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="text" name="price[]"
                               class="keeping_price form-control col-md-12 col-xs-12"
                               placeholder="e.g 99.99">
                      </div>
                    </div>

                    <div class="form-group col-md-1">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="text" name="cost_price[]"
                               class="keeping_cost_price form-control col-md-12 col-xs-12"
                               placeholder="e.g 99.99">
                      </div>
                    </div>

                    <div class="form-group col-md-1">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="text" name="quantity[]"
                               class="keeping_quantity form-control col-md-12 col-xs-12"
                               placeholder="e.g 555">
                      </div>
                    </div>

                    <div class="form-group col-md-1">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="text" name="stock_alert_quantity[]"
                               class="keeping_stock_alert_quantity form-control col-md-12 col-xs-12"
                               placeholder="e.g: 10">
                      </div>
                    </div>

                    <div class="form-group col-md-1">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="text" name="optimal_quantity[]"
                               class="keeping_optimal_quantity form-control col-md-12 col-xs-12"
                               placeholder="e.g: 10">
                      </div>
                    </div>

                    <div class="form-group col-md-1">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="text" name="discount[]"
                               class="keeping_discount form-control col-md-12 col-xs-12"
                               placeholder="In Percentage">
                      </div>
                    </div>

                    <div class="form-group col-md-1">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="number" name="barcode[]"
                               class="keeping_barcode form-control col-md-12 col-xs-12"
                               placeholder="Barcode" minlength="4" maxlength="8">
                      </div>
                    </div>

                    <div class="col-md-1">
                      <ul class="nav navbar-right panel_toolbox">
                        <li>
                          <a class="clone-link" tooltip="Click to clone this variant."
                             title="Click to clone this variant."><i class="fa fa-clone"></i></a>
                        </li>
                        <li>
                          <a class="close-link"><i class="fa fa-times"></i></a>
                        </li>
                      </ul>
                    </div>
                  </div>

                </form>

                <div class="right">
                  <button type="button" class="btn btn-default right add-inventory-group">Add New
                  </button>
                </div>

                <div class="hidden first-inventory-group">
                  <div class="form-group col-md-1">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <input type="text" name="custom_id[]"
                             class="keeping_custom_product_id form-control col-md-12 col-xs-12"
                             placeholder="Custom Id">
                    </div>
                  </div>

                  <div class="form-group col-md-1">
                    <div class="col-md-12 col-sm-12 col-xs-12 attribute-1-value">

                    </div>
                  </div>

                  <div class="form-group col-md-1">
                    <div class="col-md-12 col-sm-12 col-xs-12 attribute-2-value">

                    </div>
                  </div>

                  <div class="form-group col-md-1">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <input type="text" name="package[]"
                             class="keeping_package form-control col-md-12 col-xs-12"
                             placeholder="e.g Red">
                    </div>
                  </div>

                  <div class="form-group col-md-1">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <input type="text" name="price[]"
                             class="keeping_price form-control col-md-12 col-xs-12"
                             placeholder="e.g Red">
                    </div>
                  </div>

                  <div class="form-group col-md-1">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <input type="text" name="cost_price[]"
                             class="keeping_cost_price form-control col-md-12 col-xs-12"
                             placeholder="e.g 99.99">
                    </div>
                  </div>

                  <div class="form-group col-md-1">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <input type="text" name="quantity[]"
                             class="keeping_quantity form-control col-md-12 col-xs-12" placeholder="e.g Red">
                    </div>
                  </div>

                  <div class="form-group col-md-1">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <input type="text" name="stock_alert_quantity[]"
                             class="keeping_stock_alert_quantity form-control col-md-12 col-xs-12"
                             placeholder="e.g: 10">
                    </div>
                  </div>

                  <div class="form-group col-md-1">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <input type="text" name="optimal_quantity[]"
                             class="keeping_optimal_quantity form-control col-md-12 col-xs-12"
                             placeholder="e.g: 10">
                    </div>
                  </div>

                  <div class="form-group col-md-1">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <input type="text" name="discount[]"
                             class="keeping_discount form-control col-md-12 col-xs-12"
                             placeholder="In Percentage">
                    </div>
                  </div>

                  <div class="form-group col-md-1">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <input type="number" name="barcode[]"
                             class="keeping_barcode form-control col-md-12 col-xs-12"
                             placeholder="Barcode" minlength="4" maxlength="8">
                    </div>
                  </div>

                  <div class="col-md-1">
                    <ul class="nav navbar-right panel_toolbox">
                      <li>
                        <a class="clone-link" tooltip="Click to clone this variant."
                           title="Click to clone this variant."><i class="fa fa-clone"></i></a>
                      </li>
                      <li>
                        <a class="close-link"><i class="fa fa-times"></i></a>
                      </li>
                    </ul>
                  </div>
                </div>

              </div>
              <div id="step-4">
                <div class="x_content">
                  <p>Upload your product photos.</p>

                  <?php $countImages = 0; ?>

                  @if($StoreImagePath != 0)
                    @foreach($StoreImagePath as  $StoreImagePaths)
                      <?php if (!isset($StoreImagePaths->image_path)) {
                        continue;
                      }
                      $countImages++;
                      ?>
                      <div class="col-md-2 thumbnail" id="wrap_thumb_{{$StoreImagePaths->id}}" style="height: 310px;">
                        <div id="delete_image" data-image-src-id="{{$StoreImagePaths->id}}" style="cursor: pointer"
                             class="delete_image">Delete
                        </div>
                        <div class="crop-avatar" data-aspect-ratio="353/403" data-height="816"
                             data-width="706" data-image-src-id="thumb_{{$StoreImagePaths->id}}" data-item-id="1"
                             data-update-id="-1">
                          <!-- Current avatar -->
                          <div class="avatar-view" title="Change the avatar">
                            <img id="thumb_{{$StoreImagePaths->id}}"
                                 onError="this.onerror=null;this.src='<?php echo url('local/storage/app/')?>/product-images/default.jpg';"
                                 src="{{url($StoreImagePaths->image_path)}}"
                                 alt="Avatar" class="img-responsive">
                          </div>

                        </div>
                      </div>
                    @endforeach

                  @endif
                  @if($countImages != 6)
                    @for($l=1; $l<=6-$countImages; $l++)
                      <div class="col-md-2 thumbnail">
                        <div class="crop-avatar" data-aspect-ratio="353/403" data-height="800"
                             data-width="706" data-image-src-id="thumb_{{$l}}" data-item-id="1" data-update-id="-1">
                          <!-- Current avatar -->
                          <div class="avatar-view" title="Change the avatar">
                            <img
                                onError="this.onerror=null;this.src='<?php echo url('local/storage/app/')?>/product-images/default.jpg';"
                                id="thumb_{{$l}}" src="{{getImage('')}}"
                                alt="Avatar" class="img-responsive">
                          </div>
                        </div>
                      </div>
                    @endfor
                  @endif
                </div>
              </div>
              <div id="step-5">
                <form id="shipping-cost-form" class="form-horizontal form-label-left" style="overflow:hidden;">
                  <input type="hidden" name="is_product_id_edit" value="{{@$product->id}}"/>

                  <div class="form-group">
                    <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Shipping
                      Cost
                    </label>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" class="form-control col-md-7 col-xs-12"
                             id="shipping-cost" name="shipping_cost"
                             value="{{$product->shipping_cost}}">
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- End SmartWizard Content -->

          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection

  @section('bottom-scripts')
  @include('Admin::modals.cropper', ['url'=> route('store.upload-picture',$user->username)])

  {!! HTML::script('local/public/assets/plugins/jquery-cropper/js/cropper.min.js') !!}
  {!! HTML::script('local/public/assets/plugins/jquery-cropper/js/main.js') !!}

      <!-- form wizard -->
  <script type="text/javascript"
          src="{!! asset('local/public/assets/gentelella/js/wizard/jquery.smartWizard.js') !!}"></script>
  <!-- pace -->
  <script src="{!! asset('local/public/assets/gentelella/js/pace/pace.min.js') !!}"></script>

  <script src="{{url('local/public/assets/js/jquery.validate.min.js')}}"></script>
  <!-- select2 -->
  {!! HTML::script('local/public/assets/gentelella/js/select/select2.full.js') !!}
  {!! HTML::style('local/public/assets/gentelella/css/select/select2.min.css') !!}


  <style>
    .select2.select2-container.select2-container--default {
      width: 100% !important;
    }

    .select2-search__field {
      width: 100% !important;
    }
  </style>

  <script type="text/javascript">
    var totalAlreadyFields = 1;
    var alreadySelectedAtt1VariantsFields = [];
    var alreadySelectedAtt2VariantsFields = [];
    var alreadyCombinations = [];

    var newCombinations1 = [];
    var newCombinations2 = [];

    baseURL = $("#baseURL").val();

    categories = $("#parent_categories").val();

    console.log(categories);

    var saveBasicInfoUrl = baseURL + "/store/saveBasicProductInfo";
    var saveSpecsUrl = baseURL + "/store/saveSpecifications";
    var saveInventoryPricingUrl = baseURL + "/store/saveInventoryPricing";
    var addPhotosUrl = baseURL + "/store/saveSpecifications";
    var getCategoriesUrl = baseURL + "/store/getCategories";
    var shippingCostUrl = baseURL + "/store/shipping-cost";
    var saveProductAttributeUrl = baseURL + "/store/product-attributes";

    var elemFormBasic = "form#form-basic";
    var elemFormSpecs = "form#specifications-form";
    var elemInventoryPricing = "form#inventoryPricing";
    var elemPhotos = "form#specifications";
    var shippingCost = "form#shipping-cost-form";
    var productAttribute = "form#product-attributes";

    $(document).ready(function () {
      $.ajaxSetup(
          {
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            }
          });
      /// ------------- Generic Event Bindings and Initializations ------------ //

      $(".add-specs-pair").click(function () {
        $(elemFormSpecs).append("<div class='x_panel'>" + $(".first-specs-pair").html() + "</div>")
      });

      $(".add-inventory-group").click(function () {
        $(elemInventoryPricing).append("<div class='x_panel'>" + $(".first-inventory-group").html() + "</div>")
      });


      function getCategoriesOptionsHtml(categories) {
        var categoriesHtml = '';
        $.each(JSON.parse(categories), function (ind, val) {
          categoriesHtml += "<option value='" + val.id + "'>" + val.name + "</option>";
        });
        return categoriesHtml;
      }

      var categoriesHtml = getCategoriesOptionsHtml(categories);

      $("select.category_selection").append(categoriesHtml);

      function bindCategoryChange(categories) {
        var count = 0;
        $.each(categories, function () {
          $(this).data("level", count);
          count++;
          $(this).unbind("change");
          $(this).bind("change", function (e) {
            fetchChildCategories($(this).val(), $(e.target).data("level"));
          });
        });
      }

      var executedLevel1 = false;
      var executedLevel2 = false;

      function fetchChildCategories(id, level) {
        if (id == 0) {
          return false;
        }
        $("#loadingIcon").show();

        var data = {id: id};
        $.ajax({
          type: "POST",
          url: getCategoriesUrl,
          data: data,
          success: function (data) {
            $("#loadingIcon").hide();

            if (JSON.parse(data).length) {
              var categoriesHtml = '<select id="level-' + (level + 1) + '" class="form-control category_selection" name="category_id"><option value="0">Select Category</option>';
              categoriesHtml += getCategoriesOptionsHtml(data) + '</select>';
              if ($(".sub-cat-list.level-" + (level + 1)).length) {
                $(".sub-cat-list.level-" + (level + 1)).html(categoriesHtml)
              } else {
                var html = '<div class="sub-cat-list level-' + (level + 1) + '">' + categoriesHtml + '<div>';
                $(".sub-cat-list.level-" + (level)).append(html);
              }
              bindCategoryChange($("select.category_selection"));

              if (executedLevel1 == false) {
                secondChild();
                executedLevel1 = true;
              }

              if ($("#level-1").length > 0) {
                thirdChild();
                executedLevel2 = true;
              }
            }
          }
        });
      }

      bindCategoryChange($("select.category_selection"));

      /// ------------- Smart Wizard, Steps Changing and Step Validations ------------ //

      $('#wizard').smartWizard({
        onLeaveStep: leaveAStepCallback,
        onFinish: onFinishCallback
      });

      function leaveAStepCallback(obj, context) {
        //alert("Leaving step " + context.fromStep + " to go to step " + context.toStep);
        return validateStep(context.fromStep, context.toStep);//validateSteps(context.fromStep); // return false to stay on step and true to continue navigation
      }

      function onFinishCallback(objs, context) {
        $("form#shipping-cost-form").trigger("submit");


      }

      jQuery.validator.addMethod("notEqualToGroup", function (value, element, options) {
// get all the elements passed here with the same class
        var elems = $(element).parents('form').find(options[0]);
// the value of the current element
        var valueToCompare = value;
// count
        var matchesFound = 0;
// loop each element and compare its value with the current value
// and increase the count every time we find one
        jQuery.each(elems, function () {
          thisVal = $(this).val();
          if (thisVal == valueToCompare) {
            matchesFound++;
          }
        });
// count should be either 0 or 1 max
        if (this.optional(element) || matchesFound <= 1) {
          //elems.removeClass('error');
          return true;
        } else {
          //elems.addClass('error');
        }
      }, "Please enter a Unique Value.");

      function validateStep(from, to) {

        if (from == 1) {

          var basicForm = $('form#form-basic');
          var affiliate_reward = $("#affiliate_reward").val();
          if (affiliate_reward < 1) {
            $("#affiliate_reward").attr('value', 1)
          }
          var is_category = $("#category option:selected").val();
          if (is_category == 0) {
            $("#category option:selected").attr('value', '');
          }
          basicForm.validate({
            errorElement: 'span',
            rules: {
              'title': {required: true},
              'category_id': {
                required: true
              }
            }
          });

          if (basicForm.valid()) {
            $("form#form-basic").trigger("submit");
            return true
          } else {
            return false;
          }
        } else if (from == 2) {

          var error = false;
          $('.this_attribute_required').each(function (index) {
            if ($(this).val() < 1) {
              error = true;
            }
          });

          if (error == true) {
            //alert("Please fill all the master attribute values, and try again.");
            $('#second-message').html("Please fill all the master attribute values, and try again.").show();
            return false
          }

          $(productAttribute).trigger("submit");

          return true;

        } else if (from == 3) {
          $("form#specifications-form").trigger("submit");
          return true
        } else if (from == 4) {
          var inventoryPricing = $('form#inventoryPricing');
          inventoryPricing.validate({
            errorElement: 'span',
            ignore: [],
            rules: {
              'custom_id[]': {
                required: true,
                notEqualToGroup: ['.keeping_custom_product_id'],
              },
              'price[]': {
                required: true,
                number: true,
              },
              'cost_price[]': {
                required: true,
                number: true,
              },
              'quantity[]': {
                //required: true,
                number: true
              },
              'stock_alert_quantity[]': {
                number: true
              },

              'optimal_quantity[]': {
                //required: true,
                number: true,
              },
              'barcode[]': {
                minlength: 4,
                notEqualToGroup: ['.keeping_barcode']
              }
            }
          });

          if (inventoryPricing.valid()) {

            var cost_prices_txt_boxes = document.getElementsByClassName("keeping_cost_price");//$(".keeping_cost_price");
            var prices_txt_boxes = document.getElementsByClassName("keeping_price");//$(".keeping_price");
            var is_lesser_then_cost_price = false;
            $(".cost_msg").remove();
            $(cost_prices_txt_boxes).each(function (i, item) {

              if(i != $(cost_prices_txt_boxes).length - 1){
                $(item).css('border', '1px solid #ccc');
                $(prices_txt_boxes[i]).css('border', '1px solid #ccc');
                console.log($(item).val()+" < cost price > "+ $(prices_txt_boxes[i]).val());
                if ($(prices_txt_boxes[i]).val() <= $(item).val() ) {
                  $(".cost_msg").remove();
                  $(item).css('border', '1px solid red');
                  $(prices_txt_boxes[i]).css('border', '1px solid red');
                  $(prices_txt_boxes[i]).after('<span class="cost_msg" style="color: red;">Sale Price must be greater than Cost Price.</span>');
                  is_lesser_then_cost_price = true;
                }
              }
            });

            if(is_lesser_then_cost_price == false){
//              console.log('here in cost false');
              $("form#inventoryPricing").trigger("submit");
              return true;
            }
//            console.log('here in cost '+is_lesser_then_cost_price+' inventoryPricing');

            return false;
          }
        } else if (from == 5) {
          $("form#sp-form").trigger("submit");
          return true

        } else if (from == 6) {
          $("form#inventoryPricing").trigger("submit");

          return true
        } else {
          return true
        }
        return false;
      }


      /// ------------- All form submissions via AJAX ------------ //

      $(elemFormBasic).submit(function (e) {
        e.preventDefault();
        var form = new FormData($("#form-basic")[0]);
        form.append('description', $('#content').val());
        //console.log(form);
        //return false;

        $.ajax({
          type: "POST",
          url: saveBasicInfoUrl,
          data: $(elemFormBasic).serialize(),
          success: function (data) {
            data = JSON.parse(data);
            $(elemFormBasic).append('<input type="hidden" class="product_id" name="id" value="' + data.id + '"/>');
            $('.crop-avatar').attr('data-item-id', data.id);
            appendAttributes(data.attributes, data.selected_attributes);
          }
        });

        return false;

      });

      $(elemFormSpecs).submit(function (e) {
        e.preventDefault();


        $(elemFormSpecs).append('<input type="hidden" class="product_id" name="product_id" value="' + $("input.product_id").val() + '"/>');

        $.ajax({
          type: "POST",
          url: saveSpecsUrl,
          data: $(elemFormSpecs).serialize(),
          success: function (data) {
            data = JSON.parse(data);
            $(elemFormSpecs).append('<input type="hidden" name="id" value="' + data.id + '"/>');
            console.log('elemFormSpecs');
            $(".product_id_lbl").click();
          }
        });

        return false;

      });

      $(elemInventoryPricing).submit(function (e) {
        e.preventDefault();
        $(elemInventoryPricing).append('<input type="hidden" class="product_id" name="product_id" value="' + $("input.product_id").val() + '"/>');
        $.ajax({
          type: "POST",
          url: saveInventoryPricingUrl,
          data: $(elemInventoryPricing).serialize(),
          success: function (data) {
            data = JSON.parse(data);
            $(elemFormSpecs).append('<input type="hidden" name="id" value="' + data.id + '"/>');
          }
        });
        return false;
      });

      $(shippingCost).submit(function (e) {
        e.preventDefault();
        $(shippingCost).append('<input type="hidden" class="product_id" name="product_id" value="' + $("#is_product_id_edit").val() + '"/>');
        $.ajax({
          type: "POST",
          url: shippingCostUrl,
          data: $(shippingCost).serialize(),
          success: function (data) {
            window.location = "{{url('store/'.$storeBrandId.'/admin/manage-product')}}";
          }
        });

        return false;

      });

      function getProductKeepingRecords() {
        var keepingRecords = '<?php echo getProductKeepingRecords($product->id) ?>';
        keepingRecords = JSON.parse(keepingRecords);

        if (keepingRecords.length > 1) {
          totalAlreadyFields = keepingRecords.length;
          for (var i = 0; i < keepingRecords.length - 1; i++) {
            $(".add-inventory-group").trigger('click');
          }
        }

        $(".select_box_of_master_attr1").each(function (attributeIndex, attributeHtml) {
          if (typeof keepingRecords[attributeIndex] !== typeof undefined) {
            $(this).val(keepingRecords[attributeIndex].master_attribute_1_value);
            alreadySelectedAtt1VariantsFields.push(keepingRecords[attributeIndex].master_attribute_1_value);
            $(elemInventoryPricing).append("<input type='hidden' name='keeping_id[]' value='" + keepingRecords[attributeIndex].id + "'>");

          }
        });

        $(".select_box_of_master_attr2").each(function (attributeIndex, attributeHtml) {
          if (typeof keepingRecords[attributeIndex] !== typeof undefined) {
            $(this).val(keepingRecords[attributeIndex].master_attribute_2_value);
            alreadySelectedAtt2VariantsFields.push(keepingRecords[attributeIndex].master_attribute_2_value);
          }
        });

        var fieldsToBeUpdated = ['package', 'custom_product_id', 'barcode', 'price', 'cost_price', 'quantity', 'stock_alert_quantity', 'optimal_quantity', 'discount'];

        for (var i = 0; i < fieldsToBeUpdated.length; i++) {
          $(".keeping_" + fieldsToBeUpdated[i]).each(function (attributeIndex, attributeHtml) {
            if (typeof keepingRecords[attributeIndex] !== typeof undefined) {
              $(this).val(keepingRecords[attributeIndex][fieldsToBeUpdated[i]]);
            }
          });
        }
      }

      $(productAttribute).submit(function (e) {
        e.preventDefault();

        $(productAttribute).append('<input type="hidden" class="product_id" name="product_id" value="' + $("input.product_id").val() + '"/>');

        $.ajax({
          type: "POST",
          url: saveProductAttributeUrl,
          data: $(productAttribute).serialize(),
          success: function (data) {
            appendAttributesForInventory(data);
            getProductKeepingRecords();
            generateAutoVariations();
            $(".first_title_spec_lbl").click();
          }
        });

        return false;

      });
      /// ------------- End All form submissions via AJAX ------------ //

    });

  </script>
  <!-- /editor -->
  {!! HTML::script('local/public/assets/store/add-product.js') !!}
  <script>
        <?php
             $breadCrumbsCats = getBreadCrumbsBySubCategoryId($product->category_id);
             $breadCrumbsCats = array_reverse($breadCrumbsCats);
        ?>

    var id0 = '<?php echo (isset($breadCrumbsCats[0]['id']))?$breadCrumbsCats[0]['id'] :"" ?>';
    var id1 = '<?php echo (isset($breadCrumbsCats[1]['id']))?$breadCrumbsCats[1]['id'] :"" ?>';
    var id2 = '<?php echo (isset($breadCrumbsCats[2]['id']))?$breadCrumbsCats[2]['id'] :"" ?>';

    function selectedCategory() {
      //parent category
      $("select.parent_category option").each(function (i, val) {
        if ($(this).val() == id0) {
          $(this).prop('selected', true);
          $("select.parent_category").trigger("change");
        }
      });
    }

    function secondChild() {
      //second child
      $("#level-1 option").each(function (i, val) {
        if ($(this).val() == id1) {
          $(this).prop('selected', true);
          $("select#level-1").trigger("change");
        }
      });

      if (typeof id2 == "undefined") {
        $("#loading_category").remove();
      }
    }

    function thirdChild() {
      //third child
      $("#level-2 option").each(function (i, val) {
        if ($(this).val() == id2) {
          $(this).prop('selected', true);
          $("select#level-2").trigger("change");
        }
      });

      $("#loading_category").remove();
    }

    setInterval(function () {
      if ($(".step-3").hasClass('selected')) {
      } else {
        $(".actionBar a:first").attr('href', '{{url('store/'.$storeBrandId.'/admin/manage-product')}}');
        $(".actionBar a:first").removeClass('buttonDisabled');
      }

    }, 1000);

    $(document).ready(function () {
      applyAttributes($('select[name="acquire_type"]').val());
      $(".parent_custom_id").click();
      selectedCategory();
      $(".actionBar").prepend('<small id="auto_saving" class="auto_saving" style="text-align:center; display: none;">Saving...</small>');
      $(document).on("click", ".actionBar a:first", function () {
        e.preventDefault();
        var form = new FormData($("#form-basic")[0]);
        form.append('description', $('#content').val());
        //console.log(form);
        //return false;

        $.ajax({
          type: "POST",
          url: saveBasicInfoUrl,
          data: $(elemFormBasic).serialize(),
          success: function (data) {
            data = JSON.parse(data);
            window.location = "{{url('store/'.$storeBrandId.'/admin/manage-product')}}";
          }
        });

        return false;
      });
    });

    function auto_save_product_info() {
      if(!$("#step_one").hasClass("selected")){
        return false;
      }
      $(".auto_saving").show();
      tinymce.triggerSave();

      var title = $("#product-title").val();
      var custom_id = $("#parent_custom_id").val();
      var overview = $("#product-overview").val();
      var affiliate_reward = $("#affiliate_reward").val();
      var description = $("#content").val();

      var autoSaveUrl = '{{url('store/'.$storeBrandId.'/admin/auto_save_product_info/'.$autoSavingProductInfo->id)}}';
      $.ajax({
        type: "POST",
        url: autoSaveUrl,
        data: {
          title: title,
          custom_id: custom_id,
          overview: overview,
          affiliate_reward: affiliate_reward,
          description: description
        },
        success: function (data) {
          $(".auto_saving").hide();
        }
      });
    }

    $("#product-title, #product-overview, #affiliate_reward, #content, #mceu_15, .form-group").bind("blur", auto_save_product_info);

    $("#category").change(function (evt) {
      auto_save_product_info();
    });

    $(document).on("click", ".col-md-12", function () {
      auto_save_product_info();
    });

    /*$(document).on("click", ".fa-times", function () {
      var parent = $(this).parents();
      console.log(parent[4]);
      parent[4].remove();
    });*/

    $(document).on("click", ".clone-link", function () {
      $(this).closest("div.x_panel").clone().appendTo($("form#inventoryPricing")).hide().fadeIn('slow');
    });

    $(".delete_image").click(function (e) {

      var confirmDelete = confirm("Are you sure you want to delete image.");

      if (confirmDelete) {
        var image_id = $(this).data("imageSrcId");
        var product_id = '{{$product->id}}';

        $.ajax({
          type: "POST",
          url: '{{url('store/'.$storeBrandId.'/admin/delete_product_image')}}',
          data: {product_id: product_id, image_id: image_id},
          success: function (data) {
            $("#wrap_thumb_" + image_id).remove();
          }
        });
      }

    });

    tinymce.init({
      selector: '#content',
      automatic_uploads: true,
      plugins: [
        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars code fullscreen',
        'insertdatetime media nonbreaking save table contextmenu directionality',
        'emoticons template paste textcolor colorpicker textpattern imagetools'
      ],
      toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
      toolbar2: 'print preview media | forecolor backcolor emoticons',
    });

    //last_step  change buttons text
    setInterval(function () {
      if ($("#last_step").hasClass('selected')) {
        $(".actionBar a:first").hide();
        $(".actionBar a:nth-child(2)").hide();

        if ($(".btn-publish-product").length < 1) {
          $(".actionBar").append('<a href="#" class="btn btn-default btn-publish-product">Publish</a>');
          $(".actionBar").append('<a href="#" class="btn btn-default btn-draft-product">Save for Draft</a>');
        }
      } else {
        $(".buttonDisabled").show();
        $(".actionBar a:first").show();
        $(".actionBar a:nth-child(2)").show();
        $('.btn-publish-product').remove();
        $('.btn-draft-product').remove();
      }
    }, 500);

    $(document).on('click', '.btn-publish-product', function () {
      var shipping_cost = $("#shipping-cost").val();
      $(".actionBar a:nth-child(2)").html('Saving..');
      $(".actionBar a:first").html('Saving..');

      var saveUrl = '{{url('store/'.$storeBrandId.'/admin/save-product-for-publish/'.$autoSavingProductInfo->id)}}';
      $.ajax({
        type: "POST",
        url: saveUrl,
        data: {shipping_cost: shipping_cost},
        success: function (data) {
          window.location = "{{url('store/'.$storeBrandId.'/admin/manage-product')}}";
        }
      });
    });

    $(document).on('click', '.btn-draft-product', function () {
      var shipping_cost = $("#shipping-cost").val();

      var saveUrl = '{{url('store/'.$storeBrandId.'/admin/save-product-for-draft/'.$autoSavingProductInfo->id)}}';
      $.ajax({
        type: "POST",
        url: saveUrl,
        data: {shipping_cost: shipping_cost},
        success: function (data) {
          window.location = "{{url('store/'.$storeBrandId.'/admin/manage-product')}}";
        }
      });
    });

    $(document).ajaxError(function (event, jqxhr, settings, exception) {
      if (jqxhr.status === 401) {
        window.location.href = '{{url('login')}}';
      }
    });

      jQuery(document).on('change','select[name="acquire_type"]',function (e) {
        applyAttributes($(this).val());
      });
      applyAttributes = function (myVal) {
        if(myVal == 'manufactured')
        {
          $('select[name="manufacturing"]').prop('disabled',false);
          $('select[name="supplier"]').prop('disabled',true);
          $('select[name="purchase_type"]').prop('disabled',true);
        }else {
          $('select[name="manufacturing"]').prop('disabled',true);
          $('select[name="supplier"]').prop('disabled',false);
          $('select[name="purchase_type"]').prop('disabled',false);
        }
      }
        function generateAutoVariations(){
          var itemsAttribute1 = [];
          var itemsAttribute2 = [];
          var lengthAttr1 = lengthAttr1 = 0;

          $(".select_box_of_master_attr1 option").each(function(i, item){
            itemsAttribute1.push($(item).val());
          });

          $(".select_box_of_master_attr2 option").each(function(i, item){
            itemsAttribute2.push($(item).val());
          });

          var uniqueItemsAttribute1 = itemsAttribute1.filter(function(itm,i,itemsAttribute1){
            return i == itemsAttribute1.indexOf(itm);
          });

          var uniqueItemsAttribute2 = itemsAttribute2.filter(function(itm,i,itemsAttribute2){
            return i == itemsAttribute2.indexOf(itm);
          });
          if(uniqueItemsAttribute1.length < 1){
            lengthAttr1 = 1;
          }

          if(uniqueItemsAttribute2.length < 1){
            lengthAttr2 = 1;
          }
          var totalNewVariants = (uniqueItemsAttribute1.length  * uniqueItemsAttribute2.length) -totalAlreadyFields;
          for(var i = 0; i < totalNewVariants; i++){
            $(".add-inventory-group").click();
          }
          $(alreadySelectedAtt1VariantsFields).each(function(i, itemValue){
            alreadyCombinations.push(itemValue+"_"+alreadySelectedAtt2VariantsFields[i]);
          });

          var totalNewItemsAt1 = $("#inventoryPricing .x_panel").find(".select_box_of_master_attr1");
          var totalNewItemsAt2 = $("#inventoryPricing .x_panel").find(".select_box_of_master_attr2");

          //for new combinations
          $(uniqueItemsAttribute1).each(function (i, item) {
            $(uniqueItemsAttribute2).each(function (j, itemAt2) {
              if($.inArray(item+"_"+itemAt2, alreadyCombinations) < 1){
                newCombinations1.push(item);
                newCombinations2.push(itemAt2);
              }
            });
          });
          //end for new combinations
          console.log(" already selected "+alreadyCombinations+" new combi "+newCombinations1+" 1 <> 2 "+newCombinations2);
          $(newCombinations1).each(function (i, item) {
                var item2 = $(newCombinations2)[i];
                if($.inArray(item+"_"+item2, alreadyCombinations) > -1){
                  console.log(" in array "+item+"_"+item2);
                  newCombinations1.splice(i, 1);
                  newCombinations2.splice(i, 1);
                }
          });
          console.log(" after deletion new combi "+newCombinations1+" 1 <> 2 "+newCombinations2);

          var newItemIndex = 0;
          var newCombiCount = 0;
          $(uniqueItemsAttribute1).each(function (i, item) {//red, green, blue, pink
            $(uniqueItemsAttribute2).each(function (j, itemAt2) {//small, medium, large
              if(newItemIndex > totalAlreadyFields - 1){
                  $(totalNewItemsAt1[newItemIndex]).val(newCombinations1[newCombiCount]);
                  $(totalNewItemsAt2[newItemIndex]).val(newCombinations2[newCombiCount]);
                  newCombiCount++;
              }
              newItemIndex++;
            });
          });
        }
  </script>
@endsection
