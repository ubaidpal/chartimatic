{{--

    * Created by   :  Muhammad Yasir
    * Project Name : shalmi
    * Product Name : PhpStorm
    * Date         : 28-Apr-16 12:15 PM
    * File Name    : 

--}}
<div class="col-md-3">
    <div class="row">
        <div class="left-sidebar">
            <div class="panel-group category-products" id="accordian">
            @if($isSuperParent > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>
                            <a data-toggle="collapse" data-parent="#accordian" href="#{{$categorySlug}}">
                                <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                <a href="{{url('category/'.$categorySlug)}}">{{$categoryName}}</a>
                            </a>
                        </h4>
                    </div>
                    @if(isset($subCategories))
                      @if(is_object($subCategories))
                      <div id="{{$categorySlug}}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul class="mb20">
                              @foreach($subCategories as $subCategoryItem)
                                <?php if(isLeafCategory($subCategoryItem->id) == 0){
                                  if(hasProducts($subCategoryItem->id) == 0){
                                      continue;
                                  }
                                }else{
                                  if(parentHasProducts($subCategoryItem->id) == 0){
                                      continue;
                                  }
                                } ?>
                                  <li><a href="{{url("category/".$subCategoryItem->slug )}}">{{$subCategoryItem->name}}</a></li>
                              @endforeach
                            </ul>
                        </div>
                      </div>
                    @else
                </div>
                <div class="main-title">
                  <h2>No Category Found</h2>
                </div>
                 @endif
               @endif
            @else
                <!--show below when cat is superparent-->
              @if(isset($subCategories))
                  @if(is_object($subCategories))
                      @foreach($subCategories as $subCategoryItem)
                      <?php if(isLeafCategory($subCategoryItem->id) == 0){
                        if(hasProducts($subCategoryItem->id) == 0){continue;}
                      }else{
                        if(parentHasProducts($subCategoryItem->id) == 0){continue;}
                      } ?>
                  <div class="panel panel-default">
                      <div class="panel-heading">
                          <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordian" href="#{{$subCategoryItem->slug}}">
                                  <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                  <a href="{{url('category/'.$subCategoryItem->slug)}}">{{$subCategoryItem->name}}</a>
                              </a>
                          </h4>
                      </div>
                      <div id="{{$subCategoryItem->slug}}" class="panel-collapse collapse">
                          <div class="panel-body">
                            <ul class="mb20">
                                <?php $allSubCategories = getSubCategories($subCategoryItem->id);?>
                                @foreach($allSubCategories as $subCategory)
                                <?php
                                if(isLeafCategory($subCategory->id) == 0){
                                  if(hasProducts($subCategory->id) == 0){continue;}
                                }else{
                                  if(parentHasProducts($subCategory->id) == 0){continue;}
                                } ?>
                                  <li><a href="{{url("category/".$subCategory->slug )}}">{{$subCategory->name}}</a></li>
                                  <li><a href="{{url('category/'.$subCategoryItem->slug)}}">See all</a></li>
                                @endforeach
                            </ul>
                          </div>
                      </div>
                  </div>
                      @endforeach
                  @else
                  <div class="main-title">
                      <h2>No Category Found</h2>
                  </div>
                  @endif
              @endif
            @endif
            </div>
        </div>
    </div>
</div>
