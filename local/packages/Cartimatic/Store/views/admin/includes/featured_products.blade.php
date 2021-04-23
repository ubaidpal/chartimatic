<?php
$option_ids = get_theme_options($theme_id,'product-id',null,true);
?>
@if(!empty($option_ids))
@foreach($option_ids as $option)
    <?php $product = getProductDetailsByID($option->value); ?>
    <div class="clearfix">
        <label class="pull-left">{{$product->title}}</label>
        <a data-id="{{$option->id}}" href="#" class="pull-right text-danger remove-featured"><span class="glyphicon glyphicon-remove-circle"></span></a>
    </div>
@endforeach
@endif