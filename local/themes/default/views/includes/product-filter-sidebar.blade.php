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


            <?php
            $breadCrumbsCats = getBreadCrumbsBySubCategoryId($category->id);
            $breadCrumbsCats = array_reverse($breadCrumbsCats);
            $subCategories = getSubByCatID($breadCrumbsCats[1]['id']);
            ?>

            <div class="panel-group category-products" id="accordian">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#{{$breadCrumbsCats[1]["slug"]}}">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            <a href="{{url('category/'.$breadCrumbsCats[1]["slug"])}}">{{$breadCrumbsCats[1]['name']}}</a>
                        </a>
                    </h4>
                </div>

                <div id="{{$breadCrumbsCats[1]["slug"]}}" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                        @foreach($subCategories as $subCategory)
                        <li id="{{$subCategory->slug}}"><a href="{{url('category/'.$subCategory->slug)}}">{{$subCategory->name}}</a></li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            </div>
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

</script>
  @endsection
