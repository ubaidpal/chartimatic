<div class="content">
  <div class="container">
    <div class="content-mid">
      <h3>Featured Items</h3>
      <label class="line"></label>
      <?php $options = get_theme_options($theme_id, 'product-id', null, true); $countRowProducts = 0; ?>
      @if(!empty($options))
        <div class="mid-popular">
          @foreach($options as $index => $option)
            <?php
            $product = getProductDetailsByID($option->value);
            $category = getCategoryById($product->category_id);
            $countRowProducts++;
            ?>
            @if($countRowProducts > 4)
              <div class="clearfix"></div>

        </div>
        <div class="mid-popular">
          @endif
          <div class="col-md-3 item-grid simpleCart_shelfItem">
            <div class=" mid-pop">
              <div class="pro-img">
                <img width="233" height="323"  src="{{getRandomImageOfProduct($option->value)}}" class="img-responsive" alt="">
                <div class="zoom-icon ">
                  <a class="picture" href="{{getRandomImageOfProduct($option->value)}}" rel="title"><i
                        class="glyphicon glyphicon-search icon "></i></a>
                  <a href="{{url('view-product/'.$product->id)}}"><i class="glyphicon glyphicon-menu-right icon"></i></a>
                </div>
              </div>
              <div class="mid-1">
                <div class="women">
                  <div class="women-top">
                    <span>{{$product->title}}</span>
                    <h6><a href="{{url('view-product/'.$product->id)}}">On the other</a></h6>
                  </div>
                  <div class="img item_add">
                    <a href="#"><img src="{{getAssetPath($theme)}}/images/ca.png" alt=""></a>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <div class="mid-2">
                  <p><!--<label>$100.00</label>--><em class="item_price">${{wishListPrice($option->value)}}</em></p>
                  <div class="block">
                    <div class="starbox small ghosting">
                      <div class="positioner">
                        <div class="stars">
                          <div class="ghost" style="display: none; width: 42.5px;"></div>
                          <div class="colorbar" style="width: 42.5px;"></div>
                          <div class="star_holder">
                            <div class="star star-0"></div>
                            <div class="star star-1"></div>
                            <div class="star star-2"></div>
                            <div class="star star-3"></div>
                            <div class="star star-4"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
          @endif
        </div>
    </div>
  </div>
</div>
