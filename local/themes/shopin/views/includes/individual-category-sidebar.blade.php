{{--

    * Created by   :  Muhammad Yasir
    * Project Name : shalmi
    * Product Name : PhpStorm
    * Date         : 28-Apr-16 12:15 PM
    * File Name    : 

--}}
<div class="span3">
    <div class="row">
        <div class="brand-categories-box">
        @if($isSuperParent > 0)
              <div class="main-title">
              <h2><a href="{{url('category/'.$categorySlug)}}">{{$categoryName}}</a></h2>
              <!--<a href="javascript:void(0)">See all</a>-->
            </div>
            @if(isset($subCategories))
              @if(is_object($subCategories))
                <ul class="mb20">
                  @foreach($subCategories as $subCategoryItem)
                    <?php if(isLeafCategory($subCategoryItem->id) == 0){
                      if(hasProducts($subCategoryItem->id) == 0){continue;}
                    }else{
                      if(parentHasProducts($subCategoryItem->id) == 0){continue;}
                    } ?>
                      <li><a href="{{url("category/".$subCategoryItem->slug )}}">{{$subCategoryItem->name}}</a></li>
                  @endforeach
                </ul>
              @else
                <div class="main-title">
                  <h2>No Category Found</h2>
                </div>
                @endif
                @endif
        @else<!--show below when cat is superparent-->
          @if(isset($subCategories))
              @if(is_object($subCategories))
                  @foreach($subCategories as $subCategoryItem)
                  <?php if(isLeafCategory($subCategoryItem->id) == 0){
                    if(hasProducts($subCategoryItem->id) == 0){continue;}
                  }else{
                    if(parentHasProducts($subCategoryItem->id) == 0){continue;}
                  } ?>

                  <div class="main-title">
                    <h2><a href="{{url('category/'.$subCategoryItem->slug)}}">{{$subCategoryItem->name}}</a></h2>
                      <a href="{{url('category/'.$subCategoryItem->slug)}}">See all</a>
                  </div>
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
                  @endforeach
                  </ul>
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
