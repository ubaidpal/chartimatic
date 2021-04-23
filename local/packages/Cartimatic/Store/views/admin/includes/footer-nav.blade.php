<?php $options = get_theme_footer_nav($theme_id); ?>

@if(!empty($options) && !$options->isEmpty())
    @foreach($options as $option)
        <div class="panel panel-default" id="item-{{$option->id}}">
            <div class="panel-heading clearfix">
                <label class="pull-left">{{$option->value}}</label>
                <a href="#" data-id="{{$option->id}}" class="pull-right remove-footer-nav"><span class="glyphicon glyphicon-remove-circle text-danger"></span></a>
                <a href="#" data-value="{{$option->value}}" data-id="{{$option->id}}" class="pull-right edit-theme-option" style="margin-right: 5px;"><span class="glyphicon glyphicon-edit"></span></a>
            </div>
            <div class="panel-body">
                <?php $items = get_theme_options($theme_id,'footer-nav-item-name',null,true,['parent_id' => $option->id]); ?>
                @if(!empty($items))
                    @foreach($items as $item)
                        <div class="clearfix">
                            <div class="col-sm-4 col-lg-4">{{$item->value}}</div>
                            <?php $myOption = get_theme_option_by_parent_id($theme_id,$item->id,null,true) ?>
                            <div class="col-sm-3 col-lg-3">{{ucfirst($myOption->key)}}</div>
                            <div class="col-sm-5 col-lg-5">
                            @if($myOption->key == 'page')
                                <?php $page = getPage($myOption->value) ?>
                                <span>{{$page->title}}</span>
                            @elseif($myOption->key == 'link')
                                <span>{{$myOption->value}}</span>
                            @endif
                            <a href="#" data-option-id="{{$item->id}}" class="pull-right text-danger remove-footer-nav-item"><span class="glyphicon glyphicon-remove-circle"></span></a>
                            <a href="#" data-item-value="{{$myOption->value}}" data-option-type="{{$myOption->key}}" data-option-value="{{$item->value}}" data-item-id="{{$item->id}}" data-option-id="{{$myOption->id}}" class="pull-right edit-theme-item-option" style="margin-right: 5px;"><span class="glyphicon glyphicon-edit"></span></a>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div id="add-footer-item-{{$option->id}}">
                </div>
            </div>
            <div class="panel-footer clearfix">
                <a href="#" data-id="{{$option->id}}" class="btn btn-default pull-right btn-sm add-footer-item">Add Item</a>
            </div>
        </div>
    @endforeach
@endif
