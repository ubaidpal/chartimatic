@extends('Admin::layout.home-settings')

@section('styles')

  {!! HTML::style('local/public/assets/plugins/jquery-cropper/css/cropper.min.css') !!}
  {!! HTML::style('local/public/assets/plugins/jquery-cropper/css/main.css') !!}

@endsection
@section('content')

  @include('includes.category-sidebar')
  @include('Admin::include.main-slider')
  <a class="add-more-category-box btn btn-default" data-form="main-banner" data-header="Select Category"
     data-toggle="modal"
     data-target="#myModal"
     href="{{route('admin.modal',['category'])}}">Add More</a>
  @foreach($categoriesBlock as $block)
    <div class="col-md-12" id="box-{{$block->id}}">

      <div class="row">
        <div class="specific-category">
          <div class="col-md-4 hidden-sm">
            <div class="row">
              <div class="category-left-col">
                {{--<a data-form="main-banner" data-header="Promotional Banner" data-toggle="modal"
                   data-target="#myModal" href="{{route('admin.modal')}}"
                   style="position:absolute; right:0; top:0;">Edit</a>--}}


                <div class="crop-avatar" data-aspect-ratio="2/3" data-height="600" data-width="400"
                     data-item-id="{{$block->id}}">
                  <!-- Current avatar -->
                  <div class="avatar-view" title="Change the avatar">
                    <img src="{{url($block->banner_path)}}"
                         class="img-responsive" alt="promotion banner">
                  </div>
                </div>


              </div>
            </div>
          </div>
          <div class="col-md-8 col-sm-12">
            <div class="row">
              <div class="col-md-12">
                <div class="row">
                  <div class="title-box">
                    <h1>
                      {{ getCategoryName($block->category_id) }}
                      <a data-form="main-banner" data-header="Select Category" data-toggle="modal"
                         data-target="#myModal"
                         href="{{route('admin.modal',['category', $block->id])}}"
                         class="edit-item">Edit</a>
                    </h1>
                    <?php
                    $totalItems = count($block->items);
                    $remainingItems = 6 - $totalItems;
                    $itemBannerCount = itemBannerCount($block->id);
                    ?>
                    @if(!empty($block->banner_path) && $itemBannerCount== 4)

                      <a class="links change-status" href="javascript:void(0)"
                         data-href="{{route('admin.publish-block', $block->id)}}">
                        @if($block->status== 1)
                          UnPublish
                        @else
                          Publish
                        @endif
                      </a>


                    @endif
                  </div>
                </div>
              </div>

              <div class="col-md-3 col-sm-3">
                <div class="row">
                  <div class="products-category">
                    @foreach($block->categories as $category)
                      <div class="singal-category">
                        <h6>{{$category->name}}</h6>
                        <ul>
                          @foreach($category->childCategories as $catChild)
                            <li><a href="javascript:void(0)">{{$catChild->name}}</a></li>
                          @endforeach
                        </ul>
                      </div>
                    @endforeach

                  </div>
                </div>
              </div>

              <div class="col-md-9 col-sm-9">
                <div class="row">

                  @foreach($block->items as $item)
                    <?php
                    if (!empty($item->banner_path)) {
                      $itemBannerCount++;
                    }
                    ?>
                    <div class="col-md-4 col-sm-4">
                      <div class="row">
                        <div class="thumbnail">
                          <a data-form="main-banner" data-header="Select Category"
                             data-toggle="modal"
                             data-target="#myModal"
                             href="{{route('admin.modal.edit',[$item->id])}}"
                             class="edit-item">Edit</a>

                          <div class="crop-avatar" data-aspect-ratio="19/21" data-height="210"
                               data-width="190" data-item-id="{{$item->id}}">
                            <!-- Current avatar -->
                            <div class="avatar-view" title="Change the avatar">
                              <img title="{{$item->title}}" src="{{url($item->banner_path)}}"
                                   alt="Avatar">
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
                          <a data-form="main-banner" data-header="Select Category"
                             data-toggle="modal"
                             data-target="#myModal"
                             data-parentId="{{$block->id}}"
                             href="{{route('admin.modal',['items',$block->id])}}" class="add-item">Add</a>

                          <img src="{!! asset('local/public/assets/images/cartimatic/product-large-image.jpg') !!}"
                               alt="promotion banner">

                          <div class="caption">
                            <h3>Thumbnail label</h3>

                            <p>...</p>
                          </div>
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

@section('settings-footer-scripts')

  @include('Admin::modals.cropper', ['url'=> route('admin.upload-image')])

  {!! HTML::script('local/public/assets/plugins/jquery-cropper/js/cropper.min.js') !!}
  {!! HTML::script('local/public/assets/plugins/jquery-cropper/js/main.js') !!}
  {!! HTML::script('local/public/assets/bootstrap/javascripts/validator.js') !!}
  {!! HTML::script('local/public/assets/admin/home-settings.js') !!}
@endsection
