@extends('layouts.shopper-main')
@section('content')

    <div class="span12">
        <div class="row">
            <div class="large-banner">
                <?php if(isset($category->category_image)){
                        $breadCrumbsCats = getBreadCrumbsBySubCategoryId($category->id);
                        $breadCrumbsCats = array_reverse($breadCrumbsCats);
                        $getImageSrc = url($breadCrumbsCats[0]['category_image']);
                }
                ?>

                <div class="bread-wrapper">
                    @include('includes.breadcrumbs', array('category'=> $category->id))
                </div>
            </div>
        </div>
    </div>

    @include('includes.individual-category-sidebar')

    <div class="span8">
        <div class="row">
            <div class="categories-list">
                @if(isset($subCategories))
                    @if(is_object($subCategories))
                        @foreach($subCategories as $subCategoryItem)
                            <?php
                            $childProductsCount = null;
                            $parentProductCount = null;

                            if(isLeafCategory($subCategoryItem->id) == 0){
                                $childProductsCount = hasProducts($subCategoryItem->id);
                                if($childProductsCount == 0){continue;}
                            }else{
                                $parentProductCount = parentHasProducts($subCategoryItem->id);
                                if($parentProductCount == 0){continue;}
                            } ?>
                            <div class="span2">
                                <div class="row">
                                    <div class="col-item">
                                        <!--<div class="shape discount">
                                            <div class="shape-text">
                                                20% off
                                            </div>
                                        </div>-->
                                        <div class="photo">
                                            <a href="{{url('category/'.$subCategoryItem->slug)}}">
                                                <img alt="a" class="img-responsive" src="{{getRandomImageOfProductBycatId($subCategoryItem->id)}}" onError="this.onerror=null;this.src='<?php echo url('local/storage/app/')?>/product-images/default.jpg';" src="{!! asset('local/public/assets/images/cartimatic/product-large-image.jpg') !!}" >
                                            </a>
                                        </div>
                                        <div class="info">
                                            <div class="row">
                                                <div class="span3">
                                                    <h5>{{$subCategoryItem->name}}</h5>
                                                </div>
                                                <div class="span3">
                                                    <h4>@if($childProductsCount != null){{$childProductsCount}}@else {{$parentProductCount}} @endif items</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <!--featured categories-->
    <div class="span12">
        <div class="row">
        @if(isset($featuredCategories))
            @if(is_object($featuredCategories))
            <?php $count = 0; ?>
            @foreach($featuredCategories as $subCategoryItem)
                <?php
                $childProductsCount = null;
                $parentProductCount = null;
                if($count > 0){
                    continue;
                }
                if(isLeafCategory($subCategoryItem->id) == 0){
                    $childProductsCount = hasProducts($subCategoryItem->id);
                    if($childProductsCount == 0){continue;}
                }else{
                    $parentProductCount = parentHasProducts($subCategoryItem->id);
                    if($parentProductCount == 0){continue;}
                }
                $count++;
                ?>
                <div class="specific-category">
                    <div>
                        <div class="row">
                            <div class="span12">
                                <div class="">
                                    <div class="title-box">
                                        <h1>{{$subCategoryItem->name}}</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="span12">
                                <div class="row">
                                    <?php $allSubCategories = getSubCategories($subCategoryItem->id);?>
                                    @foreach($allSubCategories as $subCategory)
                                        <?php

                                        if(isLeafCategory($subCategory->id) == 0){
                                            if(hasProducts($subCategory->id) == 0){continue;}
                                        }else{
                                            if(parentHasProducts($subCategory->id) == 0){continue;}
                                        } ?>
                                            <?php
                                            $childProductsCount = null;
                                            $childProductsCount = hasProducts($subCategory->id);
                                            if($childProductsCount == 0){continue;}
                                            ?>
                                    <a href="{{url("category/".strtolower($subCategory->slug ))}}" title="{{ucwords($subCategory->slug)}}">
                                        <div class="span6">
                                                <div>
                                                    <div class="thumbnail">
                                                        <img alt="promotion banner" src="{{getRandomImageOfProductBycatId($subCategory->id)}}" onError="this.onerror=null;this.src='<?php echo url('local/storage/app/')?>/product-images/default.jpg';" src="{!! asset('local/public/assets/images/cartimatic/product-large-image.jpg') !!}" >

                                                        <div class="caption">
                                                            <h3>{{$subCategory->name}}</h3>

                                                            <p>@if($childProductsCount != null){{$childProductsCount}}@else {{$parentProductCount}} @endif items</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        @endif
        </div>
    </div>
    <div class="clearfix"></div>
@endsection
