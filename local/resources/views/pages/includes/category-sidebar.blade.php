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
            <div class="main-title">
                <h2>Categories</h2>
                <a href="javascript:void(0)">See all</a>
            </div>
            <ul>
                @if(isset($categories))
                    @if(is_object($categories))
                        @foreach($categories as $category)
                            <?php
                                $productCount = superParentHasProducts($category->id);
                                if($productCount == 0){continue;}
                             ?>
                            <li><a href="{{url("category/".$category->slug)}}">{{$category->name.' ('.$productCount.')'}}</a></li>
                        @endforeach
                        @else
                        <li><a href="{{url("/")}}">No Category found</a></li>
                    @endif
                @endif
            </ul>
        </div>
    </div>
</div>
