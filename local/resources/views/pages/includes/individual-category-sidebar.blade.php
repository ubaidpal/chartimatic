{{--

    * Created by   :  Muhammad Yasir
    * Project Name : shalmi
    * Product Name : PhpStorm
    * Date         : 28-Apr-16 12:15 PM
    * File Name    : 

--}}
<div class="col-md-3">
    <div class="row">
        <div class="categories-box">
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
                    <a href="javascript:void(0)">See all</a>
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
        </div>
    </div>
</div>
