<div class="col-md-3">
    <div class="row">
        <div class="categories-box">
            <div class="main-title">
                <h2>Categories</h2>
                <!--<a href="javascript:void(0)">See all</a>-->
            </div>
            <ul>
                @if(isset($categories))
                    @if(is_object($categories))
                        @foreach($categories as $category)
                            <?php
                                $productCount = superParentHasProducts($category->id);
                                if($productCount == 0){continue;}
                             ?>
                            <li class="sub-menu">
                              <a href="{{url("category/".$category->slug)}}">
                                  <div class="category-icon"><img src="{!! asset('local/public/assets/categories-icon/'.$category->category_icon_url) !!}"  width="auto" height="auto"/></div>
                                  <div class="category-name">{{$category->name}}</div>
                              </a>
                              <div class="sub-menu-box hidden-xs animated fadeIn">
                                  <?php $subCategories = getSubCategories($category->id) ?>

                                  <?php    $i=0;
                                  echo "<ul>";
                                  foreach($subCategories as $subCategory) :
                                  if($i%8==0&&$i!=0) echo "</ul><ul>"; ?>

                                  <li>
                                      <a href="{{url('category/'.$subCategory->slug)}}">
                                          {{$subCategory->name}}
                                      </a>
                                  </li>

                                  <?php    $i+=1;
                                  endforeach;
                                  echo "</ul>"; ?>


                                   </div>

                            </li>
                        @endforeach
                        @else
                        <li><a href="{{url("/")}}">No Category found</a></li>
                    @endif
                @endif
            </ul>
        </div>
    </div>
</div>
