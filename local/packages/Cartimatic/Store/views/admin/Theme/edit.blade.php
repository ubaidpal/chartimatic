@extends('Store::layouts.store-admin')

@section('header-scripts')
{!! HTML::script('local/public/js/jquery.form.min.js') !!}
{!! HTML::script('local/public/assets/js/jquery-ui.min.js') !!}
{!! HTML::script('local/public/js/jquery.fileupload.js') !!}
{!! HTML::script('local/public/js/jquery.iframe-transport.js') !!}
{!! HTML::script('local/public/assets/js/jquery.validate.min.js') !!}
@endsection

@section('styles')
    {!! HTML::style('local/public/assets/css/jquery-ui.min.css') !!}
@endsection

@section('content')
    <div class="col-lg-9">
        <iframe scrolling="yes" id="theme_preview" width="100%" height="800"  src="{{$store_url}}" sandbox="allow-scripts" scrolling="no"></iframe>
    </div>
    <div class="col-lg-3">
        <div>
            <ul class="theme-options">
                <li>
                    <a href="#" data-id="color_panel" class="edit-options">Fonts & Colors</a>
                </li>
                <li>
                    <a href="#" data-id="menu_panel" class="edit-options">Top Navigation</a>
                </li>
                <li>
                    <a href="#" data-id="footer_panel" class="edit-options">Footer Navigation</a>
                </li>
                <li>
                    <a href="#" data-id="header_panel" class="edit-options">Header</a>
                </li>
                <li>
                    <a href="#" data-id="home_panel" class="edit-options">Home</a>
                </li>
                <li>
                    <a href="#" data-id="home_section_1" class="edit-options">Home Page - Silder</a>
                </li>
                <li>
                    <a href="#" data-id="home_section_2" class="edit-options">Home Page - Featured Products</a>
                </li>
                <li>
                    <a href="#" data-id="home_section_3" class="edit-options">Home Page - Content</a>
                </li>
                <li>
                    <a href="#" data-id="home_section_4" class="edit-options">Home Page - Custom</a>
                </li>
                <li>
                    <a href="#" data-id="social_media_links" class="edit-options">Social Media</a>
                </li>
                <li>
                    <a href="#" data-id="contact_us_page" class="edit-options">Contact us Page</a>
                </li>
            </ul>

            <div id="color_panel" class="hide theme-options-panel panel panel-default">
                <div class="panel-heading">
                    <a href="#" data-target="color_panel" class="theme-options-panel-header"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;<b>Fonts & Colors</b></a>
                </div>
                <div class="panel-body">
                    <form method="post" action="{{url('store/'.$username.'/admin/theme/saveThemeOption/'.$theme_id)}}" class="colorForm">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <label>Colors</label>
                            </div>
                            <div class="panel-body">
                                <div class="body-color-change">
                                    <input name="options[background-color]" type="text" class="basic" value="<?php get_theme_option($theme_id,'background-color','#ffffff')?>" />&nbsp;Background
                                </div>

                                <div class="text-color-change">
                                    <input type="text" name="options[color]" class="basic" value="<?php get_theme_option($theme_id,'color','#333') ?>">&nbsp;Text
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <label>Fonts</label>
                            </div>
                            <?php
                            $fonts_array = [];
                            $fonts_array['Sans-serif'] = [
                                    "Avant Garde" => "'Avant Garde', Avantgarde, 'Century Gothic', CenturyGothic, 'AppleGothic', sans-serif",
                                    "Gill Sans" => "'Gill Sans', 'Gill Sans MT', Calibri, sans-serif",
                                    "Helvetica Neue" => "'HelveticaNeue', 'Helvetica Neue', Helvetica, Arial, sans-serif",
                                    "Arial" => "Arial, 'Helvetica Neue', Helvetica, sans-serif",
                                    "Candara" => "Candara, Calibri, Segoe, 'Segoe UI', Optima, Arial, sans-serif",
                                    "Geneva" => "Geneva, Tahoma, Verdana, sans-serif",
                            ];
                            $fonts_array["Sans-serif | Google Web Fonts"] = [
                                    "Droid Sans" => "Google_Droid+Sans_400_sans",
                                    "Droid Sans Bold" => "Google_Droid+Sans_700_sans",
                                    "Lato" => "Google_Lato_400_sans",
                                    "Lato Bold" => "Google_Lato_700_sans",
                                    "Montserrat" => 'Google_Montserrat_400_sans',
                                    'Montserrat Bold' => 'Google_Montserrat_700_sans',
                                    'Open Sans' => 'Google_Open+Sans_400_sans',
                                    'Open Sans Bold' => 'Google_Open+Sans_700_sans',
                                    'PT Sans' => 'Google_PT+Sans_400_sans',
                                    'PT Sans Bold' => 'Google_PT+Sans_700_sans',
                                    'Roboto' => 'Google_Roboto_400_sans',
                                    'Roboto Bold' => 'Google_Roboto_700_sans',
                                    'Source Sans Pro' => 'Google_Source+Sans+Pro_400_sans',
                                    'Source Sans Pro Bold' => 'Google_Source+Sans+Pro_700_sans',
                                    'Ubuntu' => 'Google_Ubuntu_400_sans',
                                    'Ubuntu Bold' => 'Google_Ubuntu_700_sans',
                                    'Work Sans' => 'Google_Work+Sans_400_sans',
                                    'Work Sans Semi-Bold' => 'Google_Work+Sans_600_sans'
                            ];
                            $fonts_array['Serif'] = [
                                    'Big Caslon' => "'Big Caslon', 'Book Antiqua', 'Palatino Linotype', Georgia, serif",
                                    'Calisto MT' => "'Calisto MT', 'Bookman Old Style', Bookman, 'Goudy Old Style', Garamond, 'Hoefler Text', 'Bitstream Charter', Georgia, serif",
                                    'Baskerville' => "Baskerville, 'Baskerville Old Face', 'Hoefler Text', Garamond, 'Times New Roman', serif",
                                    'Garamond' => "Garamond, Baskerville, 'Baskerville Old Face', 'Hoefler Text', 'Times New Roman', serif",
                                    "Times New Roman" => "TimesNewRoman, 'Times New Roman', Times, Baskerville, Georgia, serif"
                            ];
                            $fonts_array['Serif | Google Web Fonts'] = [
                                    'Arvo' => 'Google_Arvo_400_serif',
                                    'Arvo Bold' => 'Google_Arvo_700_serif',
                                    'Crimson Text' => 'Google_Crimson+Text_400_serif',
                                    'Crimson Text Bold' => 'Google_Crimson+Text_700_serif',
                                    'Droid Serif' => 'Google_Droid+Serif_400_serif',
                                    'Droid Serif Bold' => 'Google_Droid+Serif_700_serif',
                                    'Lora' => 'Google_Lora_400_serif',
                                    'Lora Bold' => 'Google_Lora_700_serif',
                                    'Old Standard' => 'Google_Old+Standard+TT_400_serif',
                                    'Old Standard Bold' => 'Google_Old+Standard+TT_700_serif',
                                    'PT Serif' => 'Google_PT+Serif_400_serif',
                                    'PT Serif Bold' => 'Google_PT+Serif_700_serif',
                                    'Vollkorn' => 'Google_Vollkorn_400_serif',
                                    'Vollkorn Bold' => 'Google_Vollkorn_700_serif',

                            ];
                            ?>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Headings Font</label>
                                    <select name="options[headings-font-family]" class="form-control">
                                        <?php $headings_font_family = get_theme_option($theme_id,'headings-font-family','',true); ?>
                                        @foreach($fonts_array as $label => $fonts)
                                            <optgroup label="{{$label}}">
                                            @foreach($fonts as $name => $font)
                                                <option @if($headings_font_family == $font) selected @endif value="{{$font}}">{{$name}}</option>
                                            @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Body</label>
                                    <select name="options[base-font-family]" class="form-control">
                                        <?php $base_font_family = get_theme_option($theme_id,'base-font-family','',true); ?>
                                            @foreach($fonts_array as $label => $fonts)
                                                <optgroup label="{{$label}}">
                                                    @foreach($fonts as $name => $font)
                                                        <option @if($base_font_family == $font) selected @endif value="{{$font}}">{{$name}}</option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Body Font Size</label>
                                    <?php $base_font_size = get_theme_option($theme_id,'base-font-size','',true); ?>
                                    <select name="options[base-font-size]" class="form-control">
                                        <option value="10px" @if($base_font_size == '10px') selected @endif>
                                            10px
                                        </option>
                                        <option value="11px" @if($base_font_size == '11px') selected @endif>
                                            11px
                                        </option>
                                        <option value="12px" @if($base_font_size == '12px') selected @endif>
                                            12px
                                        </option>
                                        <option value="13px" @if($base_font_size == '13px') selected @endif>
                                            13px
                                        </option>
                                        <option value="14px" @if($base_font_size == '14px') selected @endif>
                                            14px
                                        </option>
                                        <option value="15px" @if($base_font_size == '15px') selected @endif>
                                            15px
                                        </option>
                                        <option value="16px" @if($base_font_size == '16px') selected @endif>
                                            16px
                                        </option>
                                        <option value="17px" @if($base_font_size == '17px') selected @endif>
                                            17px
                                        </option>
                                        <option value="18px" @if($base_font_size == '18px') selected @endif>
                                            18px
                                        </option>
                                        <option value="19px" @if($base_font_size == '19px') selected @endif>
                                            19px
                                        </option>
                                        <option value="20px" @if($base_font_size == '20px') selected @endif>
                                            20px
                                        </option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix">
                            <button type="submit" class="btn btn-primary pull-right">Save</button>
                        </div>
                    </form>
                </div>
            </div>

            <div id="header_panel" class="hide theme-options-panel panel panel-default">
                <div class="panel-heading">
                    <a href="#" data-target="header_panel" class="theme-options-panel-header"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;<b>Header</b></a>
                </div>
                <div class="panel-body" id="header_panel_container">
                    @include('Store::admin.includes.theme-header')
                </div>
            </div>

            <div id="home_panel" class="hide theme-options-panel panel panel-default">
                <div class="panel-heading">
                    <a href="#" data-target="home_panel" class="theme-options-panel-header"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;<b>Home</b></a>
                </div>
                <div class="panel-body">
                    @for($i = 1; $i <= 4; $i++)
                    <div class="mb20">
                        <label>Section {{$i}}</label>
                        <?php
                        $section = get_theme_option($theme_id,'section-'.$i,null,true);
                        ?>
                        <select class="form-control edit-input-option" name="section-{{$i}}" data-type="option">
                            <option value="none">None</option>
                            <option value="slider" @if($section == 'slider') selected @endif>Slider</option>
                            <option value="featured-products" @if($section == 'featured-products') selected @endif>Featured Products</option>
                            <option value="page-content" @if($section == 'page-content') selected @endif>Page Content</option>
                            <option value="custom-section" @if($section == 'custom-section') selected @endif>Custom</option>
                        </select>
                    </div>
                    @endfor

                </div>
            </div>

            <div id="home_section_1" class="hide theme-options-panel panel panel-default">
                <div class="panel-heading">
                    <a href="#" data-target="home_section_1" class="theme-options-panel-header"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;<b>Home Page - Slider</b></a>
                </div>
                <div class="panel-body">
                @for($i = 1; $i <= 6; $i++)
                <div>
                    <div class="slide-title">
                        <label>Slide {{$i}}</label>
                    </div>
                    <div>
                        <div class="checkbox">
                            <?php $img_enabled = get_theme_option($theme_id,'slider-img-'.$i.'-enable',0,true); ?>
                            <input @if($img_enabled == 1) checked @endif type="checkbox" class="edit-input-option" data-type="option" name="slider-img-{{$i}}-enable" value="1">&nbsp;Enable
                        </div>
                        <label>Image</label>
                        <div class="mb20">
                            <img class="slider-img-{{$i}} mb10" width="150" src="<?php get_theme_option($theme_id,'slider-img-'.$i,getAssetPath().'/images/home/slider-placeholder.jpg') ?>">
                            <input type="file" name="options[slider-img-{{$i}}]" class="update-img" data-key="slider-img-{{$i}}" data-target="slider-img-{{$i}}">
                        </div>
                        <div>
                            <label class="text-info">Image size should be 1140px x 441px</label>
                        </div>
                        <div class="mb10">
                            <label>Heading</label>
                            <input data-type="text" type="text" name="slider-img-{{$i}}-heading" class="edit-input-option form-control" value="<?php get_theme_option($theme_id,'slider-img-'.$i.'-heading','') ?>">
                        </div>
                        <div class="mb10">
                            <label>Sub Heading</label>
                            <input data-type="text" type="text" name="slider-img-{{$i}}-subheading" class="edit-input-option form-control" value="<?php get_theme_option($theme_id,'slider-img-'.$i.'-subheading','') ?>">
                        </div>
                        <div class="mb10">
                            <label>Description</label>
                            <textarea data-type="text" class="edit-input-option form-control" name="slider-img-{{$i}}-description"><?php get_theme_option($theme_id,'slider-img-'.$i.'-description','') ?></textarea>
                        </div>
                        <div class="mb20">
                            <label>Link</label>
                            <input data-type="text" type="text" name="slider-img-{{$i}}-link" class="edit-input-option form-control" value="<?php get_theme_option($theme_id,'slider-img-'.$i.'-link','') ?>">
                        </div>
                    </div>
                </div>
                @endfor
                </div>
            </div>

            <div id="home_section_2" class="hide theme-options-panel panel panel-default">
                <div class="panel-heading">
                    <a href="#" data-target="home_section_2" class="theme-options-panel-header"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;<b>Home Page - Featured Products</b></a>
                </div>
                <div class="panel-body">
                    <div class="mb20">
                        <label>Featured Product</label>
                        <input type="text" class="search-featured form-control" placeholder="Search product">
                    </div>
                    <div id="featured_products">
                        @include('Store::admin.includes.featured_products')
                    </div>
                </div>
            </div>

            <div id="home_section_3" class="hide theme-options-panel panel panel-default">

                <div class="panel-heading">
                    <a href="#" data-target="home_section_3" class="theme-options-panel-header"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;<b>Home Page - Content</b></a>
                </div>

                <div class="panel-body">
                    <?php
                    $page_id = get_theme_option($theme_id,'home-page-content-id',null,true);
                    ?>
                    <select name="home-page-content-id" class="form-control edit-input-option" data-type="text">
                        <option value="none">None</option>
                        <option value="-1" @if($page_id == -1) selected @endif>Contact Us</option>
                    @if(!$pages->isEmpty())
                        @foreach($pages as $page)
                            <option @if($page_id == $page->id) selected @endif value="{{$page->id}}">{{$page->title}}</option>
                        @endforeach
                    @endif
                    </select>
                </div>
            </div>

            <div id="home_section_4" class="hide theme-options-panel panel panel-default">

                <div class="panel-heading">
                    <a href="#" data-target="home_section_4" class="theme-options-panel-header"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;<b>Home Page - Custom</b></a>
                </div>

                <div class="panel-body">
                    <?php
                    $custom_option_name = get_theme_option($theme_id,'custom-section-name',null,true);
                    ?>

                    <form method="post" class="form-horizontal @if(!empty($custom_option_name)) hide @endif" action="{{url('store/'.$username.'/admin/theme/saveThemeOption/'.$theme_id)}}" id="addCustomSectionForm">
                        <input type="hidden" name="type" value="text">
                        <div class="form-group">
                            <input type="text" name="options[custom-section-name]" class="form-control custom-section-name-input" placeholder="Section name">
                        </div>
                        <div class="form-group clearfix">
                            <button type="submit" class="btn btn-primary btn-sm pull-right add-custom-section-name">Save</button>
                        </div>
                    </form>

                    <div class="clearfix custom-section-content-container @if(empty($custom_option_name)) hide @endif">
                        <div class="slide-title clearfix">
                            <label class="pull-left custom-section-name-label">{{$custom_option_name}}</label>
                            <div class="pull-right">
                                <a href="#" class="edit-custom-section"><span class="glyphicon glyphicon-edit"></span></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div>
                                <input type="text" class="form-control custom-section-search" placeholder="Search Product">
                            </div>
                            <div id="custom_section_products">

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div id="social_media_links" class="hide theme-options-panel panel panel-default">
                <div class="panel-heading">
                    <a href="#" data-target="social_media_links" class="theme-options-panel-header"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;<b>Social Media</b></a>
                </div>
                <div class="panel-body">
                    <form method="post" class="form-horizontal" action="{{url('store/'.$username.'/admin/theme/saveThemeOption/'.$theme_id)}}" id="addSocialMediaForm">
                        <input type="hidden" name="type" value="text">
                        <div class="form-group">
                            <label>Facebook</label>
                            <input type="text" name="options[social-media-facebook]" class="form-control" value="<?php get_theme_option($theme_id,'social-media-facebook','') ?>">
                        </div>

                        <div class="form-group">
                            <label>Twitter</label>
                            <input type="text" name="options[social-media-twitter]" class="form-control" value="<?php get_theme_option($theme_id,'social-media-twitter','') ?>">
                        </div>

                        <div class="form-group">
                            <label>Linkedin</label>
                            <input type="text" name="options[social-media-linkedin]" class="form-control" value="<?php get_theme_option($theme_id,'social-media-linkedin','') ?>">
                        </div>

                        <div class="form-group">
                            <label>dribble</label>
                            <input type="text" name="options[social-media-dribble]" class="form-control" value="<?php get_theme_option($theme_id,'social-media-dribble','') ?>">
                        </div>

                        <div class="form-group">
                            <label>Google Plus</label>
                            <input type="text" name="options[social-media-google-plus]" class="form-control" value="<?php get_theme_option($theme_id,'social-media-google-plus','') ?>">
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="options[phone-number]" class="form-control" value="<?php get_theme_option($theme_id,'phone-number','') ?>">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="options[email-address]" class="form-control" value="<?php get_theme_option($theme_id,'email-address','') ?>">
                        </div>
                        <div class="clearfix form-group">
                            <button type="submit" class="submitSocialMediaForm btn btn-primary btn-sm pull-right">Save</button>
                        </div>
                    </form>
                </div>
            </div>

            <div id="menu_panel" class="hide theme-options-panel panel panel-default">
                <div class="panel-heading">
                    <a href="#" data-target="menu_panel" class="theme-options-panel-header"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;<b>Top Navigation</b></a>
                </div>
                <div class="panel-body">
                    <form method="post" action="{{url('store/'.$username.'/admin/saveMenu/'.$theme_id)}}" id="saveMenuForm">
                        <div class="mb10">
                            <label>Menu Name</label>
                            <input placeholder="Please enter top menu name" type="text" name="menu-name" class="form-control input-menu-name" data-type="text">
                        </div>
                        <div class="mb10">
                            <label>Menu Type</label>
                            <select class="form-control" name="menu-type">
                                <option value="category">Category</option>
                                <option value="page">Page</option>
                            </select>
                        </div>
                        <div class="mb10 hide menu-page-container">
                            <label>Select Page</label>
                            <select class="form-control" name="page">
                                <option value="-1">Contact Us</option>
                            @if(!empty($pages))
                                @foreach($pages as $page)
                                    <option value="{{$page->id}}">{{$page->title}}</option>
                                @endforeach
                            @endif
                            </select>
                        </div>
                        <div class="clearfix">
                            <button type="submit" class="btn btn-primary btn-sm pull-right " data-target="input-menu-name">Save</button>
                        </div>
                    </form>
                    <div id="theme_menus">
                        @include('Store::admin.includes.theme-menu')
                    </div>
                </div>
            </div>

            <div id="footer_panel" class="hide theme-options-panel panel panel-default">
                <div class="panel-heading">
                    <a href="#" data-target="footer_panel" class="theme-options-panel-header"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;<b>Footer Navigation</b></a>
                </div>
                <div class="panel-body">
                    <div class="mb10">
                        <label>Nav Name</label>
                        <input placeholder="Footer navigation name" type="text" class="form-control footer-nav-option" name="footer-nav-name" data-type="footer-nav">
                    </div>
                    <div class="clearfix">
                        <button type="button" class="btn btn-primary btn-sm add-footer-nav pull-right">Save</button>
                    </div>

                    <div id="footer_nav" class="mt10">
                        @include('Store::admin.includes.footer-nav')
                    </div>
                </div>
            </div>

            <div id="contact_us_page" class="hide theme-options-panel panel panel-default">
                <div class="panel-heading">
                    <a href="#" data-target="contact_us_page" class="theme-options-panel-header"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;<b>Contact us Page</b></a>
                </div>
                <div class="panel-body clearfix">
                    <form class="form-horizontal" method="post" action="{{url('store/'.$username.'/admin/theme/saveThemeOption/'.$theme_id)}}" id="contactInfoForm">
                        <input type="hidden" name="type" value="text">
                        <div class="form-group">
                            <label>Contact Info</label>
                            <textarea name="options[contact-us-info]" class="form-control" rows="10">{{get_theme_option($theme_id,'contact-us-info',null)}}</textarea>
                        </div>
                        <div class="form-group clearfix">
                            <button type="submit" class="btn btn-primary btn-sm pull-right">Save</button>
                        </div>
                    </form>
                    <div class="mb10">
                        <label class="checkbox">
                            <?php $map_enabled = get_theme_option($theme_id,'contac-us-map-enable',null,true); ?>
                            <input type="checkbox" @if($map_enabled == 1) checked @endif class="edit-input-option" name="contac-us-map-enable">&nbsp;Enable
                        </label>
                    </div>
                    <div id="map"></div>

                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div id="add-item-junk" class="hide">
        <form method="post" action="#" class="form-horizontal">
            <input type="hidden" name="option_id" value=":OPTION_ID">
            <input type="hidden" name="item_id" value=":ITEM_ID">
            <div class="row">
                <div class="form-group">
                    <div class="col-sm-4 col-lg-4">
                        <input placeholder="Name" type="text" class="form-control" name="name" value=":OPTION_NAME">
                    </div>
                    <div class="col-sm-3 col-lg-3">
                        <select name="option" class="form-control option-selection-footer-nav">
                            <option value="page">Page</option>
                            <option value="link">Link</option>
                        </select>
                    </div>
                    <div class="col-sm-5 col-lg-5">
                        <div class="page-selection footer-nav-item-option">
                            <select name="page" class="form-control item-option-selection">
                                <option value="-1">Contact Us</option>
                            @if(!empty($pages))
                                @foreach($pages as $page)
                                <option value="{{$page->id}}">{{$page->title}}</option>
                                @endforeach
                            @endif
                            </select>
                        </div>
                        <div class="hide link-selection footer-nav-item-option">
                            <input type="text" placeholder="Link" name="link" class="form-control link-input">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary btn-sm pull-right save-nave-item-btn">Save</button>
                </div>
            </div>
        </form>
    </div>

    <div id="edit_item_junk" class="hide">
        <form method="post" action="#">
            <input type="hidden" value=":OPTION_ID" name="option_id">
            <div class="form-group">
                <input type="text" name="name" class="form-control" value=":OPTION_NAME">
            </div>
            <div class="form-group">
                <button type="button" class="pull-right btn btn-primary save-edit-theme-option">Save</button>
            </div>
        </form>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit</h4>
                </div>
                <div class="modal-body" id="edit_theme_option_container">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="editMenuModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control edit-menu-name-value" data-id="">
                    </div>
                    <div class="form-group clearfix">
                        <button type="button" class="btn btn-primary pull-right edit-menu-name-save">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="editCustomSectionName">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit</h4>
                </div>
                <div class="modal-body">
                    <form method="post" class="form-horizontal" action="{{url('store/'.$username.'/admin/theme/saveThemeOption/'.$theme_id)}}" id="editCustomSectionNameForm">
                        <input type="hidden" name="type" value="text">
                        <div class="form-group">
                            <input type="text" name="options[custom-section-name]" class="form-control edit-section-input-name" value="{{$custom_option_name}}">
                        </div>
                        <div class="form-group clearfix">
                            <button type="submit" class="btn btn-primary pull-right">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <style type="text/css">
        #map {
            height: 500px;
        }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqZWdUf_Yfegr_du7fvX24eXSWqHHFQTw" async defer></script>
    <script type="text/javascript">

        jQuery(document).on('change','.edit-input-option',function () {
           var inputType = $(this).attr('type');
           if(inputType == 'checkbox') {
               if($(this).is(':checked')) {
                   $(this).val(1);
               }else{
                   $(this).val(0);
               }
           }
           var myVal = $(this).val();
           var myInput = $(this).attr('name');
           var type = $(this).data('type');
           var data = {type:type};
           data['options['+myInput+']'] = myVal;
           jQuery.ajax({
               url : "{{url('store/'.$username.'/admin/theme/saveThemeOption/'.$theme_id)}}",
               method : 'post',
               data : data,
           }).success(function (data) {
               reloadIframe();
           })
        });
        jQuery(document).on('click','.save-menu-name',function (e) {
            e.preventDefault();
            var target = $(this).data('target');

            var myVal = $('.' + target).val();
            var myInput = $('.' + target).attr('name');
            var type = $('.' + target).data('type');
            var data = {type: type,menu:myVal};

            $('.' + target).val('');
            if(myVal != '') {
                saveThemeMenu(data);
            }

        });

        jQuery(document).on('click','.edit-options',function (e) {
            e.preventDefault();
            $('.theme-options').addClass('hide');
            var data_id = $(this).data('id');
            $('#'+data_id).removeClass('hide');

            if(data_id == 'contact_us_page')
            {
                initMap();
            }
        });

        var marker;
        <?php
        $map_lat = get_theme_option($theme_id,'contact-us-map-lat','59.325',true);
        $map_lng = get_theme_option($theme_id,'contact-us-map-lng','18.070',true);
        ?>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13,
                center: {
                    lat: {{$map_lat}},
                    lng: {{$map_lng}}
                }
            });

            marker = new google.maps.Marker({
                map: map,
                draggable: true,
                animation: google.maps.Animation.DROP,
                position: {lat: {{$map_lat}}, lng: {{$map_lng}}}
            });

            google.maps.event.addListener(marker, 'dragend', function(ev){
                var lng = ev.latLng.lng();
                var lat = ev.latLng.lat();

                var data = {type:'map-lat-lang'};
                data['options[contact-us-map-lat]'] = lat;
                data['options[contact-us-map-lng]'] = lng;

                jQuery.ajax({
                    url : "{{url('store/'.$username.'/admin/theme/saveThemeOption/'.$theme_id)}}",
                    method : 'post',
                    data : data,
                }).success(function (data) {
                    reloadIframe();
                });

            });
        }

        jQuery(document).on('click','.theme-options-panel-header',function (e) {
           e.preventDefault();
           var data_id = $(this).data('target');
            $('#'+data_id).addClass('hide');
            $('.theme-options').removeClass('hide');
        });

        jQuery(document).on('click','.add-footer-nav',function (e) {
            var myVal = $('.footer-nav-option').val();
            var myInput = $('.footer-nav-option').attr('name');
            var type = $('.footer-nav-option').data('type');
            var data = {type: type,name:myVal};
            $('.footer-nav-option').val('');
            if(myVal != '') {
                jQuery.ajax({
                    url: "{{url('store/'.$username.'/admin/saveFooterOption/'.$theme_id)}}",
                    method: 'post',
                    data: data
                }).success(function (data) {
                    $('#footer_nav').html(data.nav);
                    reloadIframe();
                });
            }
        });

        $(function () {

            $('#contactInfoForm').validate({
                rules : {
                    'options[contact-us-info]' : {required:true}
                }
            });

            $('#contactInfoForm').ajaxForm({
                beforeSubmit : function (arr, $form, options) {
                    if($('#contactInfoForm').valid())
                    {
                        return true;
                    }else {
                        return false;
                    }
                },
            });

            $('#saveMenuForm').validate({
                rules : {
                    'menu-name' : {required:true}
                }
            });

            $('#saveMenuForm').ajaxForm({
                beforeSubmit : function (arr, $form, options) {
                    if($('#saveMenuForm').valid())
                    {
                        return true;
                    }else {
                        return false;
                    }
                },
                success : function (responseText,statusText,xhr) {
                    $('#saveMenuForm')[0].reset();

                    $('#theme_menus').html(responseText.menus);
                }
            });

            $('#editCustomSectionNameForm').validate({
               rules : {
                   'options[custom-section-name]' : {required:true}
               }
            });

            $('#editCustomSectionNameForm').ajaxForm({
                beforeSubmit : function (arr, $form, options) {
                    if($('#editCustomSectionNameForm').valid()){
                        return true;
                    }else{
                        return false;
                    }
                },
                success : function (responseText,statusText,xhr) {
                    $('#editCustomSectionName').modal('hide');
                    $('.custom-section-name-label').text($('.edit-section-input-name').val());
                    reloadIframe();
                }
            });

            $('#addSocialMediaForm').ajaxForm();

            $('#addCustomSectionForm').validate({
                rules : {
                    'options[custom-section-name]' : {required:true}
                }
            });

            $('#addCustomSectionForm').ajaxForm({
                beforeSubmit : function (arr, $form, options) {
                    if($('#addCustomSectionForm').valid()){
                        return true;
                    }else{
                        return false;
                    }
                },
                success : function (responseText,statusText,xhr) {
                    jQuery('.custom-section-content-container').removeClass('hide');
                    jQuery('#addCustomSectionForm').addClass('hide');
                    $('.custom-section-name-label').text($('.custom-section-name-input').val());

                    $('.edit-section-input-name').val($('.custom-section-name-input').val());

                    reloadIframe();
                }
            });

           $('#theme_menus').sortable({
               update : function (event,ui) {
                   var data = $(this).sortable('serialize');
                   $.ajax({
                       url : '{{url('store/'.$username.'/admin/theme/reOrderMenu/'.$theme_id)}}',
                       data: data,
                       type: 'POST',
                   }).done(function (data) {
                       reloadIframe();
                   });
               }
           });

           $('#footer_nav').sortable({
               update : function (event,ui) {
                   var data = $(this).sortable('serialize');
                   $.ajax({
                       url : '{{url('store/'.$username.'/admin/theme/reOrderMenu/'.$theme_id)}}',
                       data: data,
                       type: 'POST',
                   }).done(function (data) {
                       reloadIframe();
                   });
               }
           });

           $('.basic').spectrum({
               preferredFormat: "hex",
               showInput: true
           });

           $('input[type="file"]').fileupload({
               url : "{{url('store/'.$username.'/admin/theme/saveThemeOption/'.$theme_id)}}",
               done : function (e,data) {
                   if(data.textStatus == 'success') {
                       if($(this).hasClass('update-img')) {
                           var key = $(this).data('key');
                           var target = $(this).data('target');
                           jQuery.ajax({
                               url : '{{url('store/'.$username.'/admin/theme/getThemeOption/'.$theme_id)}}',
                               data : {key:key,return:1}
                           }).done(function (data) {
                               img_url = data + '?clear=cache';
                               console.log(target);
                               console.log($('img.'+target).length);
                               $('img.'+target).attr('src',img_url);
                           });
                       }
                       reloadIframe();
                   }
               }
           });

            jQuery('.colorForm').ajaxForm({
               success:    function() {
                   reloadIframe();
               }
           });

           jQuery('.search-featured').autocomplete({
               source : '{{url('store/'.$username.'/admin/searchProduct/')}}',
               select: function( event, ui ) {
                   var product_id = ui.item.id;
                   ui.item.value = "";
                   jQuery.ajax({
                       url : "{{url('store/'.$username.'/admin/addFeaturedProduct/'.$theme_id)}}",
                       method : 'POST',
                       data : {product_id:product_id}
                   }).done(function (data) {
                       var myHtml = data.products;
                       jQuery('#featured_products').html(myHtml);
                   });
               }
           });

            jQuery('.custom-section-search').autocomplete({
                source : '{{url('store/'.$username.'/admin/searchProduct/')}}',
                select: function( event, ui ) {
                    var product_id = ui.item.id;
                    ui.item.value = "";
                    jQuery.ajax({
                        url : "{{url('store/'.$username.'/admin/addCustomSectionProduct/'.$theme_id)}}",
                        method : 'POST',
                        data : {product_id:product_id}
                    }).done(function (data) {
                        var myHtml = data.products;
                        jQuery('#custom_section_products').html(myHtml);
                    });
                }
            });

        });

        jQuery(document).on('keyup','.navigation-item-search',function (e) {
            jQuery(this).autocomplete({
                source : '{{url('store/'.$username.'/admin/searchProductCategory')}}',
                select : function (event,ui) {
                    var category_id = ui.item.id;
                    ui.item.value = "";
                    var option_id = $(this).data('option-id');

                    jQuery.ajax({
                        url : "{{url('store/'.$username.'/admin/addNavigationItem/'.$theme_id)}}",
                        method : "POST",
                        data : {category_id:category_id,option_id:option_id}
                    }).done(function (data) {
                        $('#theme_menus').html(data.menus);
                    });
                }
            });
        });

        reloadIframe = function () {
            var iframe = document.getElementById('theme_preview');
            iframe.src = iframe.src;
        };

        jQuery(document).on('click','.remove-featured',function (e) {
            e.preventDefault();
            if(confirm('Are you sure?')) {
                var option_id = $(this).data('id');
                jQuery.ajax({
                    url: "{{url('store/'.$username.'/admin/removeFeaturedProduct/'.$theme_id)}}",
                    method: "POST",
                    data: {option_id: option_id}
                }).done(function (data) {
                    jQuery('#featured_products').html(data.products);
                    reloadIframe();
                });
            }
        });

        jQuery(document).on('click','.remove-menu',function (e) {
            e.preventDefault();
            if(confirm('Are you sure?')) {
                var option_id = $(this).data('id');
                jQuery.ajax({
                    url: "{{url('store/'.$username.'/admin/removeMenu/'.$theme_id)}}",
                    method: "POST",
                    data: {option_id: option_id}
                }).done(function (data) {
                    $('#theme_menus').html(data.menus);
                    reloadIframe();
                });
            }
        });

        jQuery(document).on('click','.top-navigation-items',function (e) {
           e.preventDefault();
           var option_id = $(this).data('id');
           $('#navigation_panel_' + option_id).removeClass('hide');
        });

        jQuery(document).on('click','.remove-footer-nav',function (e) {
            e.preventDefault();
            if(confirm('Are you sure?')) {
                var option_id = $(this).data('id');

                jQuery.ajax({
                    url: "{{url('store/'.$username.'/admin/removeFooterNav/'.$theme_id)}}",
                    method: "POST",
                    data: {option_id: option_id}
                }).done(function (data) {
                    $('#footer_nav').html(data.nav);
                    reloadIframe();
                });

            }
        });

        jQuery(document).on('click','.add-footer-item',function (e) {
            e.preventDefault();
            var option_id = $(this).data('id');
            var myHtml = $('#add-item-junk').html();
            myHtml = myHtml.replace(/:OPTION_ID/i,option_id);
            myHtml = myHtml.replace(/:OPTION_NAME/i,'');
            myHtml = myHtml.replace(/:ITEM_ID/i,'');
            $('#add-footer-item-'+option_id).html(myHtml);
        });
        
        jQuery(document).on('change','.option-selection-footer-nav',function (e) {
            var myVal = $(this).val();
            $(this).parent().parent().find('.footer-nav-item-option').addClass('hide');
            $(this).parent().next().find('.'+myVal+'-selection').removeClass('hide');
        });
        
        jQuery(document).on('click','.save-nave-item-btn',function (e) {
            e.preventDefault();
            var $form = $(this).closest("form");
            var name = $(this).closest('form').find('input[name="name"]').val();
            var type = $(this).closest('form').find('select[name="option"]').val();
            var link = $(this).closest('form').find('input[name="link"]').val();
            if(type == 'link' && link == '')
            {
                return false;
            }
            if(name != '') {
                jQuery.ajax({
                    url: '{{url('store/'.$username.'/admin/addFooterNavItem/'.$theme_id)}}',
                    data: $form.serialize(),
                    method: 'POST',
                }).done(function (data) {
                    $('#footer_nav').html(data.nav);
                    $('#myModal').modal('hide');
                    reloadIframe();
                });
            }
        });

        jQuery(document).on('click','.edit-theme-option',function (e) {
            e.preventDefault();
            $('#myModal').modal();
            var option_id = $(this).data('id');
            var myValue = $(this).data('value');
            var myHtml = $('#edit_item_junk').html();
            myHtml = myHtml.replace(/:OPTION_ID/i,option_id);
            myHtml = myHtml.replace(/:OPTION_NAME/i,myValue);
            $('#edit_theme_option_container').html(myHtml);
        });

        jQuery(document).on('click','.save-edit-theme-option',function (e) {
            var $form = $(this).closest('form');

            jQuery.ajax({
                url : '{{url('store/'.$username.'/admin/editFooterNavItem/'.$theme_id)}}',
                data : $form.serialize(),
                method : 'POST'
            }).done(function (data) {
                $('#footer_nav').html(data.nav);
                $('#myModal').modal('hide');
                reloadIframe();
            });
        });

        jQuery(document).on('click','.edit-theme-item-option',function (e) {
            e.preventDefault();
            var option_id = $(this).data('option-id');
            var item_id = $(this).data('item-id');
            var option_name = $(this).data('option-value');
            var option_type = $(this).data('option-type');
            var item_value = $(this).data('item-value');
            var myHtml = $('#add-item-junk').html();
            myHtml = myHtml.replace(/:OPTION_NAME/i,option_name);
            myHtml = myHtml.replace(/:ITEM_ID/i,item_id);
            myHtml = myHtml.replace(/:OPTION_ID/i,option_id);
            $('#myModal').modal();
            $('#edit_theme_option_container').html(myHtml);
            $('#myModal').find('.option-selection-footer-nav').val(option_type);

            if(option_type == 'link') {
                $('#myModal').find('.link-input').val(item_value);
                $('#myModal').find('.link-selection').removeClass('hide');
                $('#myModal').find('.page-selection').addClass('hide');
            }else{
                $('#myModal').find('.item-option-selection').val(item_value);
                $('#myModal').find('.link-selection').addClass('hide');
                $('#myModal').find('.page-selection').removeClass('hide');
            }

        });
        jQuery(document).on('click','.remove-menu-item',function (e) {
            e.preventDefault();
            var option_id = $(this).data('id');

            if(confirm('Are you sure?')) {

                jQuery.ajax({
                    url : '{{url('store/'.$username.'/removeMenuItem/'.$theme_id)}}',
                    data : {option_id:option_id},
                    method : 'POST',
                }).done(function (data) {
                    $('#theme_menus').html(data.menus);
                    reloadIframe();
                });
            }
        });

        jQuery(document).on('click','.edit-menu-name',function (e) {
            var option_id = $(this).data('id');
            jQuery.ajax({
                url : '{{url('store/'.$username.'/admin/theme/getThemeOptionByID')}}/' + option_id,
            }).done(function (data) {
                $('.edit-menu-name-value').val(data.option.value).data('option-id',data.option.id);
            });

            $('#editMenuModal').modal('show');
        });

        jQuery(document).on('click','.edit-menu-name-save',function (e) {
            e.preventDefault();

            var myVal = $('.edit-menu-name-value').val();
            var option_id = $('.edit-menu-name-value').data('option-id');

            var data = {option_id: option_id,menu:myVal};

            if(myVal != '') {

                saveThemeMenu(data);

                $('#editMenuModal').modal('hide');
            }
        });

        jQuery(document).on('click','.remove-footer-nav-item',function (e) {
            if(confirm('Are you sure?'))
            {
                var option_id = $(this).data('option-id');
                $.ajax({
                    url: "{{url('store/'.$username.'/admin/removeFooterNavItem/'.$theme_id)}}",
                    method: "POST",
                    data: {option_id: option_id}
                }).done(function (data) {
                    $('#footer_nav').html(data.nav);
                    reloadIframe();
                });
            }
        });

        jQuery(document).on('click','.edit-custom-section',function (e) {
            e.preventDefault();
            $('#editCustomSectionName').modal('show');
        });

        jQuery(document).on('change','select[name="menu-type"]',function (e) {
            var myVal = $(this).val();

            if(myVal == 'page')
            {
                $('.menu-page-container').removeClass('hide');
            }else{
                $('.menu-page-container').addClass('hide');
            }
        });

        jQuery(document).on('click','.edit-menu-item-page',function(e){
            e.preventDefault();
            var item_id = $(this).data('id');
            $('.menu-page-display-'+item_id).addClass('hide');
            $('.menu-page-selection-'+item_id).removeClass('hide');
        });

        jQuery(document).on('click','.cancel-menu-page-selection',function (e) {
            e.preventDefault();
            var item_id = $(this).data('id');
            $('.menu-page-display-'+item_id).removeClass('hide');
            $('.menu-page-selection-'+item_id).addClass('hide');
        });

        jQuery(document).on('click','.save-menu-item-page',function (e) {
            e.preventDefault();
            var item_id = $(this).data('id');
            var page_id = $('.menu-item-page-select-'+item_id).val();
            data = {option_id:item_id,menu:page_id};
            saveThemeMenu(data);
        });

        saveThemeMenu = function (data) {

            jQuery.ajax({
                url: "{{url('store/'.$username.'/admin/saveThemeMenu/'.$theme_id)}}",
                method: 'post',
                data: data
            }).success(function (data) {
                $('#theme_menus').html(data.menus);
                reloadIframe();
            });
        }
    </script>
@endsection