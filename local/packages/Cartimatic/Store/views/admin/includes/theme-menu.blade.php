<?php
$options = get_theme_menu($theme_id);
?>
@if(!empty($options))
@foreach($options as $option)
    <?php
    $type = get_menu_type($theme_id,$store_id,$option->id,'menu-type');
    ?>
    <div class="panel panel-default" id="item-{{$option->id}}">
        <div class="panel-heading clearfix">
            <label class="pull-left">{{ucfirst($option->value)}}</label>
            <a data-id="{{$option->id}}" href="#" class="pull-right text-danger remove-menu"><span class="glyphicon glyphicon-remove-circle"></span></a>
            <a data-id="{{$option->id}}" href="#" class="pull-right edit-menu-name"><span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;</a>
        </div>
        <div class="panel-body">
            @if(@$type->value == 'category')
            <div id="navigation_panel_{{$option->id}}">
                <div>
                    <label>Menu Item</label>
                    <input type="text" placeholder="Search Category" class="navigation-item-search form-control" data-option-id="{{$option->id}}">
                </div>
                <?php $myOptions = get_theme_menu_items($theme_id,$store_id,$option->id,'category-id'); ?>
                <div id="menu_items_{{$option->id}}">
                    @if(!empty($myOptions))
                        @foreach($myOptions as $myOption)
                         <div class="clearfix">

                             <?php
                             $category = getCategory($myOption->value);

                             ?>
                             <label class="pull-left">{{$category->name}}</label>
                             <a href="#" data-id="{{$myOption->id}}" class="pull-right text-danger remove-menu-item"><span class="glyphicon glyphicon-remove-circle"></span></a>
                         </div>
                        @endforeach
                    @endif
                </div>
            </div>
            @elseif(@$type->value == 'page')
                <div class="clearfix">
                    <?php $menu_items = get_theme_menu_items($theme_id,$store_id,$option->id,'page-id'); ?>
                    @if(!empty($menu_items))
                        @foreach($menu_items as $menu_item)
                        @if($menu_item->value == -1)
                        <div class="menu-page-display-{{$menu_item->id}}">
                            <label class="pull-left">Contact Us</label>
                            <a data-id="{{$menu_item->id}}" href="#" class="pull-right edit-menu-item-page"><span class="glyphicon glyphicon-edit"></span>&nbsp;  </a>
                        </div>
                        @else
                        <?php $the_page = getPage($menu_item->value); ?>
                        <div class="menu-page-display-{{$menu_item->id}}">
                            <label class="pull-left">{{$the_page->title}}</label>
                            <a data-id="{{$menu_item->id}}" href="#" class="pull-right edit-menu-item-page"><span class="glyphicon glyphicon-edit"></span>&nbsp;  </a>
                        </div>
                        @endif
                        <div class="menu-page-selection-{{$menu_item->id}} hide">
                            <div class="mb10">
                                <select class="form-control menu-item-page-select-{{$menu_item->id}}">
                                    <option value="-1" @if($menu_item->value == -1) selected @endif>Contact</option>
                                @if(!empty($pages))
                                    @foreach($pages as $page)
                                    <option value="{{$page->id}}" @if($page->id == $menu_item->value) selected @endif>{{$page->title}}</option>
                                    @endforeach
                                @endif
                                </select>
                            </div>
                            <div class="clearfix">
                                <button data-id="{{$menu_item->id}}" type="button" class="btn btn-primary btn-sm pull-right save-menu-item-page">Save</button>
                                <a data-id="{{$menu_item->id}}" href="#" class="btn btn-link pull-right cancel-menu-page-selection">Cancel</a>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            @endif
        </div>
    </div>
@endforeach
@endif