@extends('layouts.default')

@section('content')
    @include('includes.category-sidebar')
    @include('includes.main-slider')

    <?php $totalLinksToBeShown = 13; //Links to be show to controll height of category blocks in main home page.
    $count = 0;?>
    @foreach($categoriesBlock as $block)

    <?php $cls = ($count%2 == 0) ? "" : "align-right"; $count++;?>
        <div class="col-md-12">
            <div class="row">
                <div class="specific-category {{$cls}}">
                    <div class="col-md-4 hidden-xs right">
                        <div class="row">
                            <div class="category-left-col">
                                <img src="{{url($block->banner_path)}}" class="img-responsive" alt="promotion banner">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="title-box">
                                        <h1><?php echo $catName = getCategoryName($block->category_id);
                                            $catSlug = getCategorySlug($block->category_id);  ?></h1>
                                        <a href="{{url('category/'.$catSlug)}}">See more</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-3 right hidden-xs">
                                <div class="row">
                                    <div class="products-category">
                                        <?php $countTotalLink = $singleCatCount = 0; ?>
                                        @foreach($block->categories as $category)
                                            <?php  $countTotalLink++; if($countTotalLink > $totalLinksToBeShown){continue;}?>
                                            <?php if($singleCatCount > 2){continue;}?>
                                            <div class="singal-category">
                                                <h6>{{$category->name}}</h6>
                                                <ul>
                                                    @foreach($category->childCategories as $catChild)
                                                        <?php $countTotalLink++; if($countTotalLink > $totalLinksToBeShown){continue;} ?>
                                                        <li>
                                                            <a href="{{url('category/'.$catChild->slug)}}">{{$catChild->name}}</a>
                                                        </li>
                                                        @if($countTotalLink == $totalLinksToBeShown)
                                                            <li>
                                                                <a style="color:#00aeef;" href="{{url('category/'.$catSlug)}}">See More</a>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <?php $singleCatCount++; ?>
                                        @endforeach
                                        <?php $countTotalLink = 0; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-9 col-sm-9">
                                <div class="row">
                                    <?php
                                    $totalItems = count($block->items);
                                    $remainingItems = 4 - $totalItems;
                                    ?>
                                    @foreach($block->items as $item)
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            <div class="row">
                                                <div class="thumbnail">
                                                    <div class="crop-avatar" data-aspect-ratio="7/8" data-height="256"
                                                         data-width="224" data-item-id="{{$item->id}}">
                                                        <!-- Current avatar -->
                                                        <div class="avatar-view" title="{{$item->title}}">

                                                                <a href="{{$item->object_value}}">
                                                                    <img src="{{$item->banner_path}}"
                                                                         alt="imagex_{{$item->title}}" >
                                                                </a>


                                                        </div>

                                                    </div>

                                                    <div class="caption">
                                                        <h3>{{$item->title}}</h3>

                                                        <p>{{$item->secondary_title}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    @for($l = 1; $l <= $remainingItems; $l++)
                                        <div class="col-md-4 col-sm-4">
                                            <div class="row">
                                                <div class="thumbnail">
                                                    <img src="{!! asset('local/public/assets/images/cartimatic/product-large-image.jpg') !!}"
                                                         alt="promotion banner">
                                                </div>
                                                <div class="caption">
                                                    <h3>Thumbnail label</h3>

                                                    <p>...</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @include('includes.best-products-carosell')
@endsection
