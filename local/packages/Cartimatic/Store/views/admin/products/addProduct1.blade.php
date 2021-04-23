@extends('Store::layouts.store-admin')
@section('styles')

    {!! HTML::style('local/public/assets/plugins/jquery-cropper/css/cropper.min.css') !!}
    {!! HTML::style('local/public/assets/plugins/jquery-cropper/css/main.css') !!}
    <style type="text/css">
        body {
            background: #2A3F54;
        }

        textarea {
            margin-left: 99999999px;
            position: absolute;
        }
        .overlay {
            z-index: 50;
            background: rgba(255, 255, 255, 0.5);
            display: none;
        }

        .overlay .fa {
            position: absolute;
            left: 50%;
            top: 50%
        }

        .overlay {
            z-index: 50;
            background: rgba(255, 255, 255, 0.5);
            display: none;
        }

        .overlay .fa {
            position: absolute;
            left: 50%;
            top: 50%;
            z-index: 50;
        }

        .overlay{z-index:50;background: rgba(255,255,255,0.5);display: none;}
        .overlay .fa{position: absolute;left: 50%;top: 50%;z-index: 50;}


    </style>
@endsection
@section('content')
    {!! HTML::script('local/public/assets/js/tinymce/tinymce.min.js') !!}
    <style type="text/css">
        .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
            padding-left: 3px;
            padding-right: 3px;
        }

        .col-md-1 {
            padding-right: 0px;
            padding-left: 5px;
        }
    </style>
    <div>
        <div class="page-title">
            <div class="title_left">

                @if(empty($product->id))
                    <h1>Add Product</h1>
                @else
                    <h1>Edit Product</h1>
                @endif
            </div>
        </div>
        <div class="clearfix"></div>
        @include('includes.alerts')
        <input type="hidden" value="{{url("")}}" name="baseURL" id="baseURL">

        <div>
            <div class="alerts"></div>
            <div class="x_panel">
                <div class="x_content">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#step-1" data-toggle="tab" aria-expanded="true">Basic</a></li>
                            <li class=""><a href="#step-2" class="description-and-features" data-toggle="tab" aria-expanded="false">Description
                                    & Features</a></li>
                            <li class=""><a href="#step-3" class="variations-tab" data-toggle="tab" aria-expanded="false"
                                            data-type="variations">Variations</a>
                            </li>
                            <li class=""><a href="#step-4" class="photos-tab" data-toggle="tab" aria-expanded="false">Photos</a></li>
                            <li class=""><a href="#step-5" data-toggle="tab" aria-expanded="false">Shipping Cost</a></li>
                            <li class=""><a href="#opening-stock" data-toggle="tab" aria-expanded="false" data-type="opening-stock">Opening
                                    Stock</a></li>
                        </ul>
                        <div id="wizard" class="tab-content">
                            <hr>
                            <div class="overlay">
                                <i class="fa fa-refresh fa-spin fa-3x"></i>
                            </div>
                            <div id="step-1" class="tab-pane active">

                                <form class="form-horizontal form-label-left" id="form-basic">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Line Item <span
                                                        class="required">*</span></label>

                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select class="form-control category_selection" name="line_item_id" id="category"
                                                        data-level="0">
                                                    <option value="">--Select Line Item--</option>
                                                    @foreach($the_categories as $category)
                                                        <option @if($autoSavingProductInfo->line_item_id == $category->id) selected
                                                                @endif value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div id="loadingIcon" style="display: none;" class="col-md-3 col-sm-3 col-xs-12">
                                                <img width="32"
                                                     onError="this.onerror=null;this.src='<?php echo url('local/storage/app/')?>/product-images/default.jpg';"
                                                     src="{!! asset('local/public/images/loading.gif') !!}" title="Loading please wait.."/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Title
                                                <span class="required">*</span>
                                            </label>

                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="title" id="product-title" value="{{$autoSavingProductInfo->title}}"
                                                       required="required"
                                                       class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="p_custom_id control-label col-md-3 col-sm-3 col-xs-12" for="p_custom_id">Product
                                                Code</label>

                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="product_code" id="p_custom_id"
                                                       value="{{$autoSavingProductInfo->product_code}}"
                                                       class="form-control col-md-7 col-xs-12">
                                                <div class="text-danger" id="product-code-error"></div>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <button type="button" class="btn btn-primary btn-sm barcode-template"><span
                                                            class="fa fa-random"></span></button>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Alternate Code</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="alternate_code" id="p_custom_id"
                                                       value="{{$autoSavingProductInfo->alternate_code}}"
                                                       class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>

                                        <div id="subcategories">
                                            @if(!empty($line_item_childs))
                                                <?php $index = 0; ?>
                                                @foreach($line_item_childs as $selected => $childs)
                                                    <div class="form-group" data-child-level="{{$index}}">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">&nbsp;</label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <select class="form-control sub-cat-selection sub-cat-list-{{$index}}"
                                                                    data-child-selection="{{$index}}" name="category_id">
                                                                @foreach($childs as $child)
                                                                    <option @if($child->id == $selected)) selected
                                                                            @endif value="{{$child->id}}">{{$child->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <?php $index++; ?>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="form-group" id="age_group">
                                            <input type="hidden" id="age_group" value="{{$autoSavingProductInfo->age_group_id}}">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">{{Session::get('SYSTEM_CONFIGURATION.PRODUCT_VARIABLE_1')}}</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select class="form-control" id="age_group_select" name="season">
                                                    <option value="">--Select--</option>
                                                </select>
                                                <span id="ageGroup" style="display: none"></span>
                                            </div>
                                        </div>

                                        <div class="form-group" id="brand_label">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">{{Session::get('SYSTEM_CONFIGURATION.PRODUCT_VARIABLE_2')}}</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select class="form-control" name="brand">
                                                    <option value="">--Select--</option>
                                                    @foreach($brands as $id => $name)
                                                        <option @if($autoSavingProductInfo->brand_id == $id) selected
                                                                @endif value="{{$id}}">{{ucfirst($name)}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group" id="season_label">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Cal. Season</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select class="form-control" name="season">
                                                    <option value="">--Select--</option>
                                                    @foreach($seasons as $id => $name)
                                                        <option @if($autoSavingProductInfo->season_id == $id) selected
                                                                @endif value="{{$id}}">{{ucfirst($name)}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group" id="product_gender_label">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">{{Session::get('SYSTEM_CONFIGURATION.PRODUCT_VARIABLE_4')}}</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select class="form-control" name="product_gender">
                                                    <option value="">--Select--</option>
                                                    @foreach($productGenders as $id => $name)
                                                        <option @if($autoSavingProductInfo->product_gender_id == $id) selected
                                                                @endif value="{{$id}}">{{ucfirst($name)}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group" id="value_addition_label">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">{{Session::get('SYSTEM_CONFIGURATION.PRODUCT_VARIABLE_5')}}</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select class="form-control" name="value_addition">
                                                    <option value="">--Select--</option>
                                                    @foreach($valueAdditions as $id => $name)
                                                        <option @if($autoSavingProductInfo->value_addition_id == $id) selected
                                                                @endif value="{{$id}}">{{ucfirst($name)}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group" id="life_type_label">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">{{Session::get('SYSTEM_CONFIGURATION.PRODUCT_VARIABLE_3')}}</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select class="form-control" name="life_type">
                                                    <option value="">--Select--</option>
                                                    @foreach($lifeTypes as $id => $name)
                                                        <option @if($autoSavingProductInfo->life_type_id == $id) selected
                                                                @endif value="{{$id}}">{{ucfirst($name)}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Acquire Type</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select class="form-control" name="acquire_type">
                                                    <option value="">--Select--</option>
                                                    <option @if($autoSavingProductInfo->acquire_type == 'purchased') selected
                                                            @endif value="purchased">Purchased
                                                    </option>
                                                    <option @if($autoSavingProductInfo->acquire_type == 'manufactured') selected
                                                            @endif value="manufactured">Manufactured
                                                    </option>
                                                    <option @if($autoSavingProductInfo->acquire_type == 'sale_base') selected
                                                            @endif value="sale_base">Sale Base
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Purchase Type</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select class="form-control" name="purchase_type">
                                                    <option value="">--Select--</option>
                                                    <option @if($autoSavingProductInfo->purchase_type == 'foreign') selected
                                                            @endif value="foreign">Foreign
                                                    </option>
                                                    <option @if($autoSavingProductInfo->purchase_type == 'imported') selected
                                                            @endif value="imported">Imported
                                                    </option>
                                                    <option @if($autoSavingProductInfo->purchase_type == 'local') selected
                                                            @endif value="local">Local
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Supplier</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select class="form-control" name="supplier">
                                                    <option value="">--Select Supplier--</option>
                                                    @foreach($suppliers as $id => $name)
                                                        <option @if($autoSavingProductInfo->supplier_id == $id) selected
                                                                @endif value="{{$id}}">{{ucfirst($name)}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Manufacturing</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select class="form-control" name="manufacturing">
                                                    <option value="">--Select--</option>
                                                    <option @if($autoSavingProductInfo->manufacturing == 'outsourced') selected
                                                            @endif value="outsourced">Outsourced
                                                    </option>
                                                    <option @if($autoSavingProductInfo->manufacturing == 'self') selected
                                                            @endif value="self">Self
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Purchase Conv. Unit</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select class="form-control" name="unit_id">
                                                    <option value="">--Select--</option>
                                                    @foreach($units as $unit)
                                                        <option @if($autoSavingProductInfo->unit_id == $unit->id) selected
                                                                @endif value="{{$unit->id}}">{{$unit->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Purchase Conv. Factor</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input value="{{$autoSavingProductInfo->conv_factor}}" type="number" min="0"
                                                       name="conv_factor" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tax Code</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select class="form-control" name="tax_code_id">
                                                    <option value="">--Select--</option>
                                                    @foreach($codes as $code)

                                                        <option data-value="{{$code->value}}" data-is-percentage="{{$code->is_percent}}"
                                                                @if($autoSavingProductInfo->tax_code_id == $code->id) selected
                                                                @endif value="{{$code->id}}">{{$code->tax_code}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Sales Tax(Purchase)</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input value="{{$autoSavingProductInfo->sales_tax_purchase}}" type="number" min="0"
                                                       max="100" name="sales_tax_purchase" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3">&nbsp;</label>
                                            <div class="col-md-9">
                                                <label class="radio-inline">
                                                    <input @if($autoSavingProductInfo->sales_tax_purchase_at == 'retail_price') checked
                                                           @endif type="radio" name="sales_tax_purchase_at" value="retail_price"> At Retail
                                                    Price
                                                </label>
                                                <label class="radio-inline">
                                                    <input @if($autoSavingProductInfo->sales_tax_purchase_at == 'retail_price') checked
                                                           @endif type="radio" name="sales_tax_purchase_at" value="purchase_price"> At
                                                    Purchase Price
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Sales Tax(Sales)</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input value="{{$autoSavingProductInfo->sales_tax_sales}}" type="number" min="0"
                                                       name="sales_tax_sales" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3">&nbsp;</label>
                                            <div class="col-md-9">
                                                <label class="radio-inline">
                                                    <input @if($autoSavingProductInfo->sales_tax_sales_type == 'percentage') checked
                                                           @endif type="radio" name="sales_tax_sales_type" value="percentage"> Percentage
                                                </label>
                                                <label class="radio-inline">
                                                    <input @if($autoSavingProductInfo->sales_tax_sales_type == 'value') checked
                                                           @endif type="radio" name="sales_tax_sales_type" value="value"> Value
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Price</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input @if(isset($edit))) readonly @endif value="{{$autoSavingProductInfo->price}}" type="number" min="0"
                                                       name="price" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">&nbsp;</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12 ">
                                                <label class="checkbox">
                                                    <input @if($autoSavingProductInfo->sales_tax_sales_type == 'value') checked
                                                           @endif type="checkbox" name="print_barcode" value="1">&nbsp;Print Barcode
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">&nbsp;</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12 ">
                                                <label class="checkbox">
                                                    <input @if($autoSavingProductInfo->default_variation == 1) checked
                                                           @endif type="checkbox" id="default-attributes" name="default_variation"
                                                           value="1">&nbsp;Default Size & Color
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group" id="product_attributes">
                                            @if(isset($attributes))
                                                @foreach($attributes as $index => $attribute)
                                                    <div class="col-md-4">
                                                        <div class="panel panel-default">
                                                            <div id="attr-{{$index}}" class="panel-heading"
                                                                 data-label="{{$attribute['attribute']['label']}}"
                                                                 data-id="{{$attribute['attribute']['id']}}">
                                                                {{$attribute['attribute']['label']}}
                                                            </div>
                                                            <div class="panel-body">
                                                                @foreach($attribute['attribute_values'] as $value)
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input @if(isset($selected_attributes[$value['id']])) checked
                                                                                   data-edit="true"
                                                                                   @endif class="attributes" type="checkbox"
                                                                                   name="attributes[{{$attribute['attribute']['id']}}][]"
                                                                                   value="{{$value['id']}}" data-value="{{$value['value']}}"
                                                                                   data-attrId="{{$attribute['attribute']['id']}}">&nbsp;{{$value['value']}}
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="pull-left">
                                        <a href="#" data-target=".send-request" data-toggle="modal" class="link"
                                           title="Request to add for Missing Category or Category Attributes">
                                            <span class="fa fa-plus-square"></span>
                                        </a>
                                    </div>
                                    <div class="pull-right">
                                        <input type="hidden" name="action" value="save">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <button type="button" class="btn btn-info basic-info-next">Save & Go To Next</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>

                            </div>
                            <div id="step-6" class="tab-pane">
                                <span id="second-message" style="display:none;color: #a94442"></span>
                                <form class="form-horizontal form-label-left" id="product-attributes">
                                    <div class="" id="product-attributes-wrapper"></div>
                                    <div class="pull-right">
                                        <button class="btn btn-primary" type="submit">Save</button>
                                    </div>
                                </form>
                                <div class="col-sm-9 col-sm-offset-3">
                                    <a href="#" data-target=".send-request" data-toggle="modal" class="link">* Request to add for Missing
                                        Category or Category Attributes</a>
                                </div>
                            </div>
                            <div id="step-2" class="tab-pane">
                                <form class="form-horizontal form-label-left" id="specifications-form">
                                    <div class="x_panel">
                                        <input type="hidden" value="{{$autoSavingProductInfo->id}}" name="product_id">
                                        <input type="hidden" id="description" name="description">
                                        <div class="form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-6" for="overview">Overview</label>

                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="overview" id="overview"
                                                       value="{{$autoSavingProductInfo->overview}}" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="form-group affiliate">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-6" for="affiliate">&nbsp;</label>

                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <label class="checkbox">
                                                    <input type="checkbox" name="affiliate" id="affiliate">&nbsp;Affiliate
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group affiliate_reward" style="display: none;">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-6" for="affiliate_reward">Affiliate Reward
                                                (in
                                                Percentage)</label>

                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <input type="number"
                                                       value="{{($autoSavingProductInfo->affiliate_reward < 1)?1:$autoSavingProductInfo->affiliate_reward}}"
                                                       name="affiliate_reward" id="affiliate_reward"
                                                       class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Description <span
                                                        class="required">*</span></label>

                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <textarea name="content" id="content">{!! $autoSavingProductInfo->description !!}</textarea>
                                            </div>
                                        </div>
                                        <div class="product-features-container">
                                            @if(!empty($features))
                                                @foreach($features as $feature)
                                                    <div class="x_panel">
                                                        <div class="form-group col-md-5">
                                                            <label class="first_title_spec_lbl control-label col-md-3 col-sm-3 col-xs-12"
                                                                   for="first_title_spec">Feature
                                                                Title <span class="required"></span>
                                                            </label>

                                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                                <input type="text" value="{{$feature->title}}" name="title[]"
                                                                       id="first_title_spec"
                                                                       required="required"
                                                                       class="form-control col-md-7 col-xs-12">
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                                   for="first-name">Feature Value
                                                            </label>

                                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                                <input value="{{$feature->detail}}" type="text" name="detail[]"
                                                                       required="required"
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
                                            @else
                                                <div class="x_panel">
                                                    <div class="form-group col-md-5">
                                                        <label class="first_title_spec_lbl control-label col-md-3 col-sm-3 col-xs-12"
                                                               for="first_title_spec">Feature
                                                            Title <span class="required"></span>
                                                        </label>

                                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                                            <input type="text" name="title[]" id="first_title_spec" required="required"
                                                                   class="form-control col-md-7 col-xs-12">
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                               for="first-name">Feature Value
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
                                        <div class="clearfix"></div>
                                        <div class="pull-right">
                                            <input type="hidden" name="description_action">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                            <button type="button" class="btn-description-next btn btn-info">Save & Go To Next</button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </form>

                                {{--<div class="right">
                                    <button type="button" class="btn btn-default right add-specs-pair">Add New
                                    </button>
                                </div>--}}

                                <div class="hidden first-specs-pair">
                                    <div class="form-group col-md-5">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Feature
                                            Title
                                        </label>

                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input type="text" name="title[]" id="first_title" required="required"
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
                            </div>
                            <div id="step-3" class="tab-pane">
                                <h2 class="StepTitle"></h2>

                                <div class="x_panel" style="border: none">
                                    <div class="form-group col-md-12">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-3" for="first-name"
                                               id="attribute-1">Size</label>

                                        <label class="control-label col-md-2 col-sm-2 col-xs-3" for="first-name"
                                               id="attribute-2">Colour</label>

                                        {{-- <label class="control-label col-md-2 col-sm-2 col-xs-3" for="first-name">Package</label>--}}

                                        <label class="control-label col-md-2 col-sm-2 col-xs-3" for="first-name">Price</label>

                                        <label class="control-label col-md-2 col-sm-2 col-xs-3" for="first-name">Start Date</label>

                                    </div>
                                </div>

                                <form id="inventoryPricing">

                                    @if(isset($edit))
                                        <input type="hidden" name="is_product_id_edit" value="{{$product->id}}">

                                    @else
                                        {{--
                                                                                <input type="hidden" name="is_product_id_edit" value="{{$product['id']}}">
                                        --}}
                                    @endif


                                    <div class="inventoryPricing-wrapper">

                                    </div>

                                    <div class="pull-right">
                                        <input type="hidden" name="variation_action">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <button type="button" class="btn btn-info btn-variations-next">Save & Go To Next</button>
                                    </div>
                                </form>

                                {{--<div class="right">
                                    <button type="button" class="btn btn-default right add-inventory-group">Add New
                                    </button>
                                </div>--}}

                                <div class="hidden first-inventory-group">

                                    <div class="form-group col-md-2">
                                        <div class="col-md-12 col-sm-12 col-xs-12 attribute-1-value">

                                        </div>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <div class="col-md-12 col-sm-12 col-xs-12 attribute-2-value">

                                        </div>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <input type="text" name="package[]"
                                                   class="form-control col-md-12 col-xs-12"
                                                   placeholder="e.g Red">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <input type="text" name="price[]"
                                                   class="keeping_price form-control col-md-12 col-xs-12"
                                                   placeholder="e.g Red">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <input type="text" name="cost_price[]"
                                                   class="keeping_cost_price form-control col-md-12 col-xs-12"
                                                   placeholder="e.g Red">
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

                                <div class="clearfix"></div>
                            </div>
                            <div id="step-4" class="tab-pane">
                                <div class="x_content">
                                    <p>Upload your product photos.</p>
                                    @for($l=1; $l<=6; $l++)
                                        <div class="col-md-2 thumbnail">
                                            <div class="crop-avatar" data-aspect-ratio="353/403" data-height="800"
                                                 data-width="706" data-image-src-id="thumb_{{$l}}" data-item-id="1" data-update-id="-1">
                                                <!-- Current avatar -->
                                                <div class="avatar-view" title="Change the avatar">
                                                    <img id="thumb_{{$l}}" src="{{getImage('')}}"
                                                         onError="this.onerror=null;this.src='<?php echo url('local/storage/app/')?>/product-images/default.jpg';"
                                                         alt="Avatar" class="img-responsive">
                                                </div>

                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                            <div id="step-5" class="tab-pane">
                                <form id="shipping-cost-form" class="form-horizontal form-label-left" style="overflow:hidden;">
                                    <input type="hidden" class="product_id" name="product_id" value="{{$autoSavingProductInfo->id}}">
                                    <div class="form-group">
                                        <label for="first-name" class="control-label col-md-3 col-sm-3 col-xs-12">Shipping Cost</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <input type="number" class="form-control col-md-7 col-xs-12"
                                                   id="shipping-cost" name="shipping_cost" value="{{$autoSavingProductInfo->shipping_cost}}">
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="pull-right">
                                            <input type="hidden" value="0" name="is_published">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                            <button type="button" class="btn btn-info publish-to-web">Publish To Web</button>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                            <div id="opening-stock" class="tab-pane">
                                <?php
                                $isStockOpening = (isset(Session::get('SYSTEM_CONFIGURATION')[ 'STOCK_OPENING' ]) ? true : false);
                                ?>
                                <form id="opening-stock-form" class="" style="overflow:hidden;">
                                    {!! Form::hidden('product_id',\Vinkla\Hashids\Facades\Hashids::connection('store')->encode($product['id']) ) !!}
                                    <table id="product-keeping" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Attribute 1</th>
                                            <th>Attribute 2</th>
                                            <th>Cost Price</th>
                                            <th>Retail Price</th>
                                            <th>Opening</th>
                                            <th>Opening Value</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($Product_Keeping) && count($Product_Keeping) > 0 && $Product_Keeping != 0)

                                            @foreach($Product_Keeping as $keeping)
                                                <tr class="keeping-row" data-quantity="{{$keeping['quantity']}}">
                                                    <td>{{$keeping['value1']['value']}}</td>
                                                    <td>{{$keeping['value2']['value']}}</td>
                                                    <td>{{$keeping['cost_price']}}</td>
                                                    <td>{{$keeping['price']}}</td>
                                                    <td>
                                                        <input type="number" name="products[{{$keeping['id']}}]" value=""
                                                               class="form-control">
                                                    </td>
                                                    <td class="opening-stock"></td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                    <div class="clearfix"></div>
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary" id="opening-stock-btn">Save</button>
                                    </div>

                                </form>
                            </div>
                        </div>
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

    <!-- pace -->
    <script src="{!! asset('local/public/assets/gentelella/js/pace/pace.min.js') !!}"></script>

    <script src="{!! asset('local/public/assets/gentelella/js/validator/validator.js') !!}"></script>

    <script src="{{url('local/public/assets/js/jquery.validate.min.js')}}"></script>
    {!! HTML::script('local/public/assets/gentelella/js/datatables/jquery.dataTables.min.js') !!}
    {!! HTML::script('local/public/assets/gentelella/js/datatables/dataTables.bootstrap.js') !!}
    {!! HTML::script('local/public/assets/bootstrap/javascripts/bootstrap/bootstrap-tooltip.js') !!}
    {!! HTML::script('local/public/assets/bootstrap/javascripts/bootstrap/confirmation.js') !!}
    {!! HTML::script('local/public/assets/gentelella/js/moment/moment.min.js') !!}
    {!! HTML::script('local/public/assets/gentelella/js/datepicker/daterangepicker.js') !!}

    @if(isset($edit))
        <script>
            var editScreen = true;
            var isVariantsAdded = true;
            var isAttributesAdded = true;
        </script>
    @else

        @if(count($Product_Keeping) > 0 && $Product_Keeping != 0)
            <script>
                var editScreen = true;
                var isVariantsAdded = true;
            </script>
        @else
            <script>
                var editScreen = false;
                var isVariantsAdded = false;
            </script>
        @endif

        <script>


            var isAttributesAdded = false;
        </script>
    @endif
    @include('Store::admin.products.add-product-js')
    <style type="text/css">

        .daterangepicker {
            z-index: 1100 !important;
        }

        .daterangepicker td.disabled {
            color: #999 !important;
        }

        .table.table-striped.table-bordered.dataTable.no-footer {
            width: 100% !important;
        }
    </style>
    <script type="text/javascript">
        var dataTable;
        $(document).ajaxStart(function () {
            $(".overlay").show();
        });

        $(document).ajaxStop(function () {
            $(".overlay").hide();
        });
        $(document).ready(function () {
            dataTable = $("#product-keeping").DataTable();
            $('.date-picker').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_4",
                format: 'DD-MM-YYYY',
                minDate: new Date()
            });
        })

    </script>

    <script type="text/javascript">

        baseURL = $("#baseURL").val();
        var moreThenOnceError = 0;

        var saveBasicInfoUrl = baseURL + "/store/saveBasicProductInfo";
        var saveSpecsUrl = baseURL + "/store/saveSpecifications";
        var saveInventoryPricingUrl = baseURL + "/store/saveInventoryPricing";
        var addPhotosUrl = baseURL + "/store/saveSpecifications";
        var getCategoriesUrl = baseURL + "/store/getCategories";
        var getParentLineItemsUrl = baseURL + "/store/getParentLineItems";
        var shippingCostUrl = baseURL + "/store/shipping-cost";
        var saveProductAttributeUrl = baseURL + "/store/product-attributes";

        var elemFormBasic = "form#form-basic";

        var new_product_id = '{{$autoSavingProductInfo->id}}';

        $(elemFormBasic).append('<input type="hidden" id="new_product_id" class="product_id" name="id" value="' + new_product_id + '"/>');

        var elemFormSpecs = "form#specifications-form";
        var elemInventoryPricing = "form#inventoryPricing";
        var elemPhotos = "form#specifications";
        var shippingCost = "form#shipping-cost-form";
        var productAttribute = "form#product-attributes";


        (function ($) {
            $.unserialize = function (serializedString) {
                var str = decodeURI(serializedString);
                var pairs = str.split('&');
                var obj = {}, p, idx, val;
                for (var i = 0, n = pairs.length; i < n; i++) {
                    p = pairs[i].split('=');
                    idx = p[0];

                    if (idx.indexOf("[]") == (idx.length - 2)) {
                        // Eh um vetor
                        var ind = idx.substring(0, idx.length - 2)
                        if (obj[ind] === undefined) {
                            obj[ind] = [];
                        }
                        obj[ind].push(p[1]);
                    }
                    else {
                        obj[idx] = p[1];
                    }
                }
                return obj;
            };
            if ($.trim($('#subcategories').html()) == '') {
                fetchChildCategories($('#category').val(), 0);
            }
        })(jQuery);

        jQuery(document).on('change', '#category', function () {
            $('#subcategories').html('');
            fetchChildCategories($(this).val(), 0);
        });

        jQuery(document).on('change', '.sub-cat-selection', function () {
            var the_level = $(this).data('child-selection');
            fetchChildCategories($(this).val(), the_level);
        });

        function fetchChildCategories(id, level) {
            if (id == 0) {
                return false;
            }
            $("#loadingIcon").show();

            if (level == 0) {

            }
            var data = {id: id};

            $.ajax({
                type: "POST",
                url: getCategoriesUrl,
                data: data,
                success: function (data) {
                    $("#loadingIcon").hide();
                    if (JSON.parse(data).length) {
                        var categoriesHtml = '<select class="form-control sub-cat-selection sub-cat-list-' + (level + 1) + '" data-child-selection="' + (level + 1) + '" name="category_id">';

                        categoriesHtml += getCategoriesOptionsHtml(data) + '</select>';
                        if ($(".sub-cat-list-" + (level + 1)).length) {
                            $(".sub-cat-list-" + (level + 1)).html(categoriesHtml)
                        } else {
                            var html = '<div class="form-group" data-child-level="' + (level + 1) + '">';
                            html += '<label class="control-label col-md-3 col-sm-3 col-xs-12">&nbsp;</label>';
                            html += '<div class="col-md-6 col-sm-6 col-xs-12">';
                            html += categoriesHtml
                            html += '</div>';
                            html += '</div>';
                            $('#subcategories').append(html);
                        }
                    }
                }
            });

            $.ajax({

                //url: '{{url('store/getCategoryAttributes')}}',
                url: '{{url('store/'.$storeBrandId.'/admin/getCategoryAttributes')}}',
                data: {category_id: id},
                success: function (data) {
                    var count = 0;
                    var myHtml = '';
                    $.each(data.attributes, function (index, values) {
                        count++;
                        myHtml += '<div class="col-md-4 col-sm-6">';
                        myHtml += '<div class="panel panel-default">';
                        myHtml += '<div id="attr-' + index + '" class="panel-heading attribute" data-label="' + values.attribute.label + '" data-id="' + values.attribute.id + '">' + values.attribute.label + '</div>';
                        myHtml += '<div class="panel-body">';
                        $.each(values.attribute_values, function (index, data) {
                            myHtml += '<div class="checkbox">';
                            myHtml += '<label><input type="checkbox" class="attributes" name="attributes[' + values.attribute.id + '][]" value="' + data.id + '" data-value="' + data.value + '" data-attrId="' + values.attribute.id + '"> &nbsp;' + data.value + '</label>';
                            myHtml += '</div>';
                        });
                        myHtml += '</div>';
                        myHtml += '</div>';
                        myHtml += '</div>';
                        if (values.is_default == 0) {
                        }

                        if (values.is_default == 1) {
                        }
                    });
                    $('#product_attributes').html(myHtml);
                }
            });
        }

        function getCategoriesOptionsHtml(categories, selected) {
            var categoriesHtml = '';
            categoriesHtml = "<option value='0' selected='selected'>Select Category</option>";
            $.each(JSON.parse(categories), function (ind, val) {
                var tmpCatName = val.name;
                var the_selected = '';
                if (selected == val.id) {
                    the_selected = 'selected';
                }
                categoriesHtml += "<option " + the_selected + " value='" + val.id + "'>" + tmpCatName + "</option>";
            });
            return categoriesHtml;
        }

        $(document).ready(function () {

            $.ajaxSetup(
                {
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    }
                });
            /// ------------- Generic Event Bindings and Initializations ------------ //

            $(".add-specs-pair").click(function () {
                $('.product-features-container').append("<div class='x_panel'>" + $(".first-specs-pair").html() + "</div>")
            });

            $(".add-inventory-group").click(function () {
                $('.inventoryPricing-wrapper').append("<div class='x_panel'>" + $(".first-inventory-group").html() + "</div>");
            });

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

            $(document).ajaxError(function (event, jqxhr, settings, exception) {
                if (jqxhr.status === 401) {
                    window.location.href = '{{url('login')}}';
                }
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
                    var basicInfoForm = $('form#form-basic');
                    var affiliate_reward = $("#affiliate_reward").val();
                    if (affiliate_reward < 1) {
                        $("#affiliate_reward").attr('value', 1)
                    }
                    var is_category = $("#category option:selected").val();
                    if (is_category == 0) {
                        $("#category option:selected").attr('value', '');
                    }
                    basicInfoForm.validate({
                        errorElement: 'span',
                        rules: {
                            'title': {required: true},
                            'category_id': {
                                required: true
                            }
                        },
                    });

                    if (basicInfoForm.valid()) {
                        $("form#form-basic").trigger("submit");
                        return true;
                    } else {
                        return false;
                    }
                } else if (from == 2) {
                    if (to == 1) {
                        return true;
                    }

                    var error = false;

                    if ($('.this_attribute_required').length < 1) {
                        $('#second-message').html("This category does not have attributes, please select another one and try again.").show();
                        return false
                    }

                    $('.this_attribute_required').each(function (index) {
                        if ($(this).val() < 1) {
                            error = true;
                        }
                    });

                    if (error == true) {
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
                                notEqualToGroup: ['.keeping_custom_product_id']
                            },
                            'price[]': {
                                required: true,
                                number: true
                            },
                            'cost_price[]': {
                                required: true,
                                number: true
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

                            if (i != $(cost_prices_txt_boxes).length - 1) {
                                $(item).css('border', '1px solid #ccc');
                                $(prices_txt_boxes[i]).css('border', '1px solid #ccc');
                                console.log($(item).val() + " < cost price > " + $(prices_txt_boxes[i]).val());
                                if ($(prices_txt_boxes[i]).val() <= $(item).val()) {
                                    $(".cost_msg").remove();
                                    $(item).css('border', '1px solid red');
                                    $(prices_txt_boxes[i]).css('border', '1px solid red');
                                    $(prices_txt_boxes[i]).after('<span class="cost_msg" style="color: red;">Sale Price must be greater than Cost Price.</span>');
                                    is_lesser_then_cost_price = true;
                                }
                            }
                        });

                        if (is_lesser_then_cost_price == false) {

                            $("form#inventoryPricing").trigger("submit");
                            return true;
                        }
                        console.log('here in cost ' + is_lesser_then_cost_price + ' inventoryPricing');

                        return false;
                    }
                } else if (from == 5) {
                    $("form#sp-form").trigger("submit");
                    return true;
                } else if (from == 6) {
                    $("form#inventoryPricing").trigger("submit");
                    if (moreThenOnceError == 1) {
                        return false;
                    }
                    return true
                } else {
                    return true
                }
                return false;
            }


            /// ------------- All form submissions via AJAX ------------ //

            $(elemFormBasic).submit(function (e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: saveBasicInfoUrl,
                    data: $(elemFormBasic).serialize(),
                    success: function (data) {
                        data = JSON.parse(data);
                        if (data.error == 1) {
                            $('#product-code-error').text(data.message).show();
                            return;
                        } else {
                            $('#product-code-error').hide();
                        }
                        if (data.action == 'next') {
                            $('.description-and-features').trigger('click');
                        }
                        $('input[name="action"]').val('save');
                        $('.crop-avatar').attr('data-item-id', data.id);

                        $(".select2-search__field").first().click();
                    }
                });

                return false;

            });

            $(elemFormSpecs).submit(function (e) {
                tinymce.triggerSave();
                e.preventDefault();
                $('#description').val($('#content').val());
                $.ajax({
                    type: "POST",
                    url: saveSpecsUrl,
                    data: $(elemFormSpecs).serialize(),
                    success: function (data) {
                        data = JSON.parse(data);
                        if (data.action == 'next') {
                            $('.variations-tab').trigger('click');
                        }
                        $('input[name="description_action"]').val('save');
                        $(".product_id_lbl").click();
                    }
                });

                return false;

            });

            $(document).on('click', '.btn-description-next', function (e) {
                e.preventDefault();
                $('input[name="description_action"]').val('next');
                $(elemFormSpecs).submit();
            });

            $(document).on('click', '.btn-variations-next', function (e) {
                e.preventDefault();
                $('input[name="variation_action"]').val('next');
                $(elemInventoryPricing).submit();
            });

            $(elemInventoryPricing).submit(function (e) {
                e.preventDefault();

                $(elemInventoryPricing).append('<input type="hidden" class="product_id" name="product_id" value="' + $("input.product_id").val() + '"/>');
                $.ajax({
                    type: "POST",
                    url: saveInventoryPricingUrl,
                    data: $(elemInventoryPricing).serialize(),
                    success: function (data) {
                        if (data == 0) {
                            $(".error_msg_master").remove();
                            $("#step-3").prepend("<h3 class='error_msg_master'>Please avoid to assign two same master attributes for this product.<h3>");
                            alertMessage("Please avoid to assign two same master attributes for this product.");
                            materAttributFunction();
                        }

                        data = JSON.parse(data);
                        isVariantsAdded = true;
                        dataTable.clear().rows.add(data).draw();
                        $(elemFormSpecs).append('<input type="hidden" name="id" value="' + data.id + '"/>');

                        var thmb = $("#thumb_1").attr("src");
                        if (thmb.indexOf("product-large-image.jpg") > 0) {
                            $("#thumb_1").click();
                        }
                        if (data.action == 'next') {
                            $('input[name="variation_action"]').val('save');
                        }

                    }
                });
                return false;
            });

            $(shippingCost).submit(function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: shippingCostUrl,
                    data: $(shippingCost).serialize(),
                    success: function (data) {

                        $('input[name="is_published"]').val(0);
                        if(data.action == 'next')
                        {
                        }
                    }
                });

                return false;

            });

            $(productAttribute).submit(function (e) {
                e.preventDefault();

                $(productAttribute).append('<input type="hidden" class="product_id" name="product_id" value="' + $("input.product_id").val() + '"/>');

                $.ajax({
                    type: "POST",
                    url: saveProductAttributeUrl,
                    data: $(productAttribute).serialize(),
                    success: function (data) {
                        appendAttributesForInventory(data);
                        generateAutoVariations();
                        isAttributesAdded = true;

                        $(".first_title_spec_lbl").click();
                    }
                });

                return false;

            });
            /// ------------- End All form submissions via AJAX ------------ //

        });

        var materAttributErrorFunction = '';
        function materAttributFunction() {
            materAttributErrorFunction = setInterval(function () {
                $("#step_3_pricing").click();
                myStopFunction();
            }, 500);
        }

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

        function myStopFunction() {
            clearInterval(materAttributErrorFunction);
        }

        $("#affiliate").click(function (evt) {
            $(".affiliate_reward").hide();

            if ($('#affiliate').is(":checked")) {
                $(".affiliate_reward").show();
            }
        })

        $(document).on("click", ".fa-times", function () {
            //debugger;
            var id = $(this).data('id');
            if (id == '') {
                var parent = $(this).parents();
                parent[4].remove();
                return false;
            }
            var quantity = $(this).data('quantity');
            var _this = this;
            if (quantity == -1) {
                $.ajax({
                    type: "POST",
                    url: "{{url('store/'.$storeBrandId.'/admin/delete-keeping')}}",
                    data: {id: +$(this).data('id')},
                    success: function (data) {
                        var parent = $(_this).parents();
                        parent[4].remove();
                        return false;
                    }, error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alertMessage(XMLHttpRequest.responseText);
                        return false;
                    }
                })
            } else {
                alertMessage('Cannot delete. Dependent Record exist!');
                return false;
            }

        });

        $(document).on("click", ".clone-link", function () {
            $(this).closest("div.x_panel").clone().appendTo($("form#inventoryPricing")).hide().fadeIn('slow');
        });

        tinymce.init({
            selector: '#content',
            automatic_uploads: true,
            height: 200,
            menubar: false,
            statusbar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste code'
            ],
            file_browser_callback_types: 'image',
            images_upload_url: '{{url('store/'.$storeBrandId.'/admin/uploadImage')}}',
            file_browser_callback: function (field_name, url, type, win) {
                $('#' + field_name).addClass('upload-imag-url-containter');
                if (type == 'image') $('#my_form input').click();
            }
        });
    </script>

    <form id="my_form" action="{{url('store/'.$storeBrandId.'/admin/uploadImage')}}" method="post" enctype="multipart/form-data"
          style="width:0px;height:0;overflow:hidden">
        <input name="image" type="file" onchange="$('#my_form').submit(); this.value='';">
    </form>

    {!! HTML::script('local/public/assets/store/add-product.js') !!}
    <div aria-hidden="true" role="dialog" tabindex="-1" class="modal fade send-request"
         style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <button data-dismiss="modal" class="close" type="button"><span
                                aria-hidden="true">×</span>
                    </button>
                    <h4 id="myModalLabel" class="modal-title">Send Request to Add Category or Missing
                        Attributes</h4>
                </div>
                {!! Form::open(['url'=> 'admin/store/requests/save-request']) !!}
                <div class="modal-body row">

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Description <span
                                    class="required">*</span>
                        </label>

                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <textarea name="request_detail" class="form-control" required
                                      style="margin-left: 0; position: inherit;height: auto;"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer ">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                    <button class="btn btn-primary" type="submit">Send Request</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="template_modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Product Code Templates</h4>
                </div>
                <div class="modal-body" id="code_template_container">
                    <p>One fine body&hellip;</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="useBtn">Use</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{asset('local/public/assets/js/jquery.form.min.js')}}"></script>
    <script type="text/javascript">

        if ($('#category').val() != '') {
            getItemsAgeGroup($('#category').val(), "{{$autoSavingProductInfo->age_group_id}}");
        }
        jQuery(document).on('change', '#category', function (e) {
            var categoryId = $('#category').val();
            var age_id = $('#age_group').val();
            getItemsAgeGroup(categoryId, age_id);

        });
        function getItemsAgeGroup(categoryId, age_id) {
            var html = '';
            jQuery.ajax({
                url: '{{url('store/'.$storeBrandId.'/admin/getItemsAgeGroup')}}',
                type: "POST",
                data: {categoryId: categoryId},
                success: function (data) {
                    var maArrayData = jQuery.parseJSON(data);
                    if (data != 0) {
                        html += '<select class="form-control" name="age_group">';
                        html += '<option value="">--Select--</option>';
                        $.each(maArrayData, function (key, val) {

                            html += '<option ';
                            if (age_id == key) {
                                html += 'selected ';
                            }
                            html += 'value="' + key + '" name="' + val + '"';

                            html += '>' + val + '</option>';

                        });
                        html += '</select>';
                        if (data != 0) {
                            $("#ageGroup").show();
                            $("#age_group_select").hide();
                            $("#ageGroup").html(html);
                        } else {
                            $("#ageGroup").hide();
                            $("#age_group_select").show();

                        }
                    }
                }
            });
        }

        jQuery(document).on('change', 'select[name="tax_code_id"]', function (e) {
            var selected = $(this).find('option:selected');

        });

        jQuery(document).on('click', '.basic-info-next', function (e) {
            e.preventDefault();
            $('input[name="action"]').val('next');
            $('#form-basic').submit();
        });

        jQuery(document).on('click', '.barcode-template', function (e) {
            p.getProductCodeTemplates();
        });

        jQuery(document).on('click','.publish-to-web',function (e) {
            e.preventDefault();

            $('input[name="is_published"]').val(1);
            $('#shipping-cost-form').submit();
        });

        var p = {
            getProductCodeTemplates: function () {
                var categoryId = $('#category').val();
                if (categoryId == 0) {
                    var $alert = [
                        '<div class="alert alert-danger avatar-alert alert-dismissable">',
                        '<button type="button" class="close" data-dismiss="alert">&times;</button> Please select line item first  </div>'
                    ].join('');

                    $('.alerts').empty().html($alert);
                    return;
                }
                jQuery.ajax({
                    url: '{{url('store/'.$storeBrandId.'/admin/getProductCodeTemplates')}}',
                    type: "POST",
                    data: {categoryId: categoryId}
                }).done(function (data) {
                    $('#template_modal').modal('show');
                    var theHtml = '';
                    if (data.templates.length == 0) {
                        theHtml += '<div class="clearfix">';
                        theHtml += '<div class="checkbox">';
                        theHtml += '<div class="col-md-8">';
                        theHtml += 'No Template found!';
                        theHtml += '</div>';
                        theHtml += '</div>';
                        theHtml += '</div>';
                    }
                    $.each(data.templates, function (index, template) {
                        theHtml += '<div class="clearfix">';

                        theHtml += '<div class="checkbox">';
                        theHtml += '<div class="col-md-8">';
                        theHtml += '<label><input type="radio" class="template" name="template" data-increment="' + template.incremented_value + '" data-template="' + template.code + '" data-id="' + template.id + '" data-length="' + data.templateLength + '">&nbsp;&nbsp;' + template.name + '</label>';
                        theHtml += '</div>';
                        theHtml += '<div class="col-md-2">' + template.code + '</div>';
                        theHtml += '</div>';
                        theHtml += '</div>';
                    });
                    $('#code_template_container').html(theHtml);

                    // $('#template_modal').on('hide.bs.modal', function () {
                    $('#useBtn').unbind('click').bind('click', function () {
                        var templateBtn = $('.template:checked');
                        if (templateBtn.length == 0) {
                            return;
                        }
                        var template = $(templateBtn).data('template');
                        var templateId = $(templateBtn).data('id');
                        var incrementedValue = $(templateBtn).data('increment');
                        var codeLength = $(templateBtn).data('length');

                        var templateLength = String(template).length,
                            nextIncrementedVal = incrementedValue + 1,
                            incrementedValueLength = String(nextIncrementedVal).length;
                        var totalLength = parseInt(templateLength) + parseInt(incrementedValueLength);
                        var remainingLength = parseInt(codeLength) - parseInt(totalLength);
                        var text = "";
                        var possible = "0";
                        for (var i = 0; i < remainingLength; i++)
                            text += possible;

                        var code = template + text + nextIncrementedVal;
                        $('#p_custom_id').val(code);
                        $.ajax({
                            url: '{{url('store/'.$storeBrandId.'/admin/update-template-increment')}}',
                            type: "POST",
                            data: {id: templateId},
                            success: function () {
                                $('#template_modal').modal('toggle')
                            }
                        })

                    })
                });
            }

        };
        jQuery(document).ready(function (e) {
            applyAttributes($('select[name="acquire_type"]').val());
            $(".p_custom_id").click();
            $('#my_form').ajaxForm({
                success: function (responseText, statusText, xhr, $form) {
                    $('.upload-imag-url-containter').val(responseText.path);
                }
            });
        });

        jQuery(document).on('change', 'select[name="acquire_type"]', function (e) {
            applyAttributes($(this).val());
        });
        applyAttributes = function (myVal) {
            if (myVal == 'manufactured') {
                $('select[name="manufacturing"]').prop('disabled', false);
                $('select[name="supplier"]').prop('disabled', true);
                $('select[name="purchase_type"]').prop('disabled', true);
            } else if (myVal == 'purchased') {
                $('select[name="manufacturing"]').prop('disabled', true);
                $('select[name="manufacturing"]').prop('disabled', true);
                $('select[name="supplier"]').prop('disabled', false);
                $('select[name="purchase_type"]').prop('disabled', false);
            } else {
                $('select[name="manufacturing"]').prop('disabled', true);
                $('select[name="supplier"]').prop('disabled', true);
                $('select[name="purchase_type"]').prop('disabled', true);
            }
        }

        function generateAutoVariations() {
            var itemsAttribute1 = [];
            var itemsAttribute2 = [];
            var lengthAttr1 = lengthAttr1 = 0;

            $(".select_box_of_master_attr1 option").each(function (i, item) {
                itemsAttribute1.push($(item).val());
            });

            $(".select_box_of_master_attr2 option").each(function (i, item) {
                itemsAttribute2.push($(item).val());
            });

            var uniqueItemsAttribute1 = itemsAttribute1.filter(function (itm, i, itemsAttribute1) {
                return i == itemsAttribute1.indexOf(itm);
            });

            var uniqueItemsAttribute2 = itemsAttribute2.filter(function (itm, i, itemsAttribute2) {
                return i == itemsAttribute2.indexOf(itm);
            });
            if (uniqueItemsAttribute1.length < 1) {
                lengthAttr1 = 1;
            }

            if (uniqueItemsAttribute2.length < 1) {
                lengthAttr2 = 1;
            }
            var totalNewVariants = uniqueItemsAttribute1.length * uniqueItemsAttribute2.length;
            for (var i = 0; i < totalNewVariants - 1; i++) {
                $(".add-inventory-group").click();
            }

            var totalNewItemsAt1 = $("#inventoryPricing .x_panel").find(".select_box_of_master_attr1");
            var totalNewItemsAt2 = $("#inventoryPricing .x_panel").find(".select_box_of_master_attr2");
            var newItemIndex = 0;
            $(uniqueItemsAttribute1).each(function (i, item) { //3 times
                $(uniqueItemsAttribute2).each(function (j, itemAt2) { // 4 times
                    $(totalNewItemsAt1[newItemIndex]).val(item);
                    $(totalNewItemsAt2[newItemIndex]).val(itemAt2);
                    newItemIndex++;
                });
            });
        }
        $(document).ready(function () {
            $(document).on('click', '.price-pop', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                alert(id)
                $('#keeping_id').val(id);
                $('#varientPop').modal();

            });
            $('#price-form').submit(function (e) {
                e.preventDefault();
                var id = $('#keeping_id').val();

                $.ajax({
                    type: "POST",
                    data: $(this).serialize(),
                    url: "{{url('store/'.$storeBrandId.'/admin/update-price')}}",
                    success: function (response) {
                        $('#start_date-' + id).text($('#start_date').val());
                        $('#price-' + id).text($('#price-u').val());
                        $('#varientPop').modal('toggle');
                    }, error: function (XMLHttpRequest, textStatus, errorThrown) {
                        var $alert = [
                            '<div class="alert alert-danger  avatar-alert alert-dismissable">',
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>',
                            ( XMLHttpRequest.responseText || XMLHttpRequest.statusText),
                            '</div>'
                        ].join('');
                        $('#error').empty().html($alert);
                        return false;

                    }
                })
            });
        })
        /*$('#varientPop').on('shown.bs.modal', function (e) {
         alert('here')
         })*/
    </script>

    <!-- Modal -->
    <div class="modal fade" id="varientPop" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Variant</h4>
                </div>
                <form action="" id="price-form" method="post">
                    <div class="modal-body">
                        <div id="error">

                        </div>
                        <input type="hidden" name="keeping_id" id="keeping_id">
                        <div class='form-group'>
                            <label for='dummy'>Price:</label>
                            <input type='text' name='price' step="any" min="1" class='form-control last_name' id='price-u' placeholder='0.0'
                                   required>
                        </div>
                        <div class='form-group'>
                            <label for='date'>Start Date:</label>
                            <input type='date' name='start_date' class='form-control date date-picker' id='start_date'>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type='submit' name='submit' class='btn btn-default'>Submit</button>
                    </div>
                </form>


            </div>

        </div>
    </div>
@endsection
