{{--

    * Created by   :  Muhammad Yasir
    * Project Name : shalmi
    * Product Name : PhpStorm
    * Date         : 28-Apr-16 12:15 PM
    * File Name    : 

--}}
<div class="col-md-3">
    <div class="row">
        <div class="filter-box">

              <!--<div class="filter-brand-logo">
                <div class="brand-image">
                    <img src="http://localhost/shalmi/local/public/assets/bootstrap/images/apple_416x416.jpg" class="img-responsive" alt="a">
                </div>
                <h1>apple</h1>
            </div>-->

          <ul class="nested-categories">
            <?php
            $breadCrumbsCats = getBreadCrumbsBySubCategoryId($category->id);
            $breadCrumbsCats = array_reverse($breadCrumbsCats);
            $subCategories = getSubByCatID($breadCrumbsCats[1]['id']);
            ?>
        	<li class="first">
            <a href="{{url('category/'.$breadCrumbsCats[0]["slug"])}}">{{$breadCrumbsCats[0]['name']}}</a>
            	<ul class="second">
                <li><a href="{{url('category/'.$breadCrumbsCats[1]["slug"])}}">{{$breadCrumbsCats[1]['name']}}</a></li>
                    <ul class="third">
                      @foreach($subCategories as $subCategory)
                        <li class="category_filter_item" id="{{$subCategory->slug}}">&gt; <a href="{{url('category/'.$subCategory->slug)}}">{{$subCategory->name}}</a>
                          @endforeach
                    </li>
                </ul>
            </li>
        </ul>
          <?php $categoryIds = getFilterCategoryIds($category->id)?>
          @foreach($categoryAttributes['storeAttributes'] as $categoryAttribute)
            <div class="main-title">
                <h2>{{$categoryAttribute->label}}</h2>
            </div>
            <ul>
              @foreach($categoryAttributes['storeAttributeValues'] as $categoryAttributeValue)
               @if($categoryAttribute->id == $categoryAttributeValue->store_attribute_id)
                <li>
                    <div class="checkbox checkbox-primary filter_checkbox">
                      <?php $checkThis = ''?>

                    @if(in_array($categoryAttributeValue->value.'-'.$categoryAttributeValue->id, $filters))
                          <?php $checkThis = 'checked="checked"'?>
                        @endif
                      <input id="{{$categoryAttributeValue->value.'_'.$categoryAttributeValue->id}}" class="filter_checkbox_input" type="checkbox" {{$checkThis}}>
                      <label for="{{$categoryAttributeValue->value.'_'.$categoryAttributeValue->id}}">{{$categoryAttributeValue->value}}({{countAttributeProducts($categoryIds, $categoryAttributeValue->id)}})</label>
                    </div>
                  </li>
                @endif
              @endforeach
            </ul>
            @endforeach
            <!--<div class="main-title">
                <h2>Sample code => Color</h2>
            </div>
            <ul>
                <li>
                	<div class="checkbox checkbox-primary">
                        <input id="checkbox5" type="checkbox">
                        <label for="checkbox5">Black (23)</label>
                    </div>
                </li>
                <li>
                	<div class="checkbox checkbox-primary">
                        <input id="checkbox6" type="checkbox">
                        <label for="checkbox6">Green (17)</label>
                    </div>
                </li>
                <li>
                	<div class="checkbox checkbox-primary">
                        <input id="checkbox7" type="checkbox">
                        <label for="checkbox7">Grey (54)</label>
                    </div>
                </li>
                <li>
                	<div class="checkbox checkbox-primary">
                        <input id="checkbox8" type="checkbox">
                        <label for="checkbox8">White (65)</label>
                    </div>
                </li>
            </ul>
            
            <div class="main-title">
                <h2>Size</h2>
            </div>
            <ul>
                <li>
                	<div class="checkbox checkbox-primary">
                        <input id="checkbox9" type="checkbox">
                        <label for="checkbox9">Small (1,908)</label>
                    </div>
                </li>
                <li>
                	<div class="checkbox checkbox-primary">
                        <input id="checkbox10" type="checkbox">
                        <label for="checkbox10">Medium (5,098)</label>
                    </div>
                </li>
                <li>
                	<div class="checkbox checkbox-primary">
                        <input id="checkbox11" type="checkbox">
                        <label for="checkbox11">Large (809)</label>
                    </div>
                </li>
                <li>
                	<div class="checkbox checkbox-primary">
                        <input id="checkbox12" type="checkbox">
                        <label for="checkbox12">One Size (100)</label>
                    </div>
                </li>
            </ul>-->

        </div>
    </div>
</div>

@section('footer-scripts')
<script>
  $(".filter_checkbox").click(function(evt){
    if(evt.target.id != ''){
      var filter = evt.target.id;

      var filtersSum = "?filters=";
      var countfilters = 0;
      $('.filter_checkbox_input:checked').each(function(index){
        countfilters++;
        var filter = this.id;
        filter = filter.split('_');

        if(countfilters > 1){
          filtersSum = filtersSum+","+filter[0]+"-"+filter[1];
        }else{
          filtersSum = filtersSum+filter[0]+"-"+filter[1];
        }

      });

      if(countfilters == 0){filtersSum = '';}
      var previousUrl      = window.location.href;
      previousUrl = previousUrl.split('?')[0];
      window.location.href = previousUrl+filtersSum;

    }
  });
  var previousUrl      = window.location.href;
  previousUrl = previousUrl.split('category/')[1];
  var activeCategory = previousUrl.split('?')[0];

  $("#"+activeCategory).addClass("active");

  if($("#"+activeCategory).hasClass("active")){
    $(".category_filter_item").hide();
    $("#"+activeCategory).show();
  }

  $("#"+activeCategory).css("color", "blue");
  $("#"+activeCategory+" a").css("color", "blue");
</script>
  @endsection
