<?php

use App\StoreOption;
use Cartimatic\Store\StoreDomain;

use Illuminate\Support\Facades\View;

function getAssetPath($theme = 'default') {
    $path = asset('local/themes/'.$theme.'/views');
    return $path;
}

function get_theme_option($theme_id,$key,$default,$return = false)
{
    $theme_options = getThemeID();
    $store_id = $theme_options['store_id'];
    $option = \App\StoreThemeOption::where('key','like',$key)
                                    ->where('store_id',$store_id)
                                    ->orderBy('updated_at','DESC')
                                    ->first();
    if(@$option->type == 'image') {
        echo url('local/public/theme/images/'.$option->value);
    }elseif(!empty(@$option->value)) {
        if($return) {
            return @$option->value;
        }
        echo @$option->value;

    }else{
        if($return) {
            return $default;
        }
        echo $default;
    }
}

function get_theme_options($theme_id,$key,$default,$return = false,$conditions = [])
{
    $theme_options = getThemeID();
    $store_id = $theme_options['store_id'];
    $query = \App\StoreThemeOption::where('store_id',$store_id)
                                    ->where('key','like',$key)
                                    ->orderBy('updated_at','DESC');
    if(!empty($conditions)) {
        $query->where($conditions);
    }
    $options  = $query->get();

    if(!$options->isEmpty()) {
        if($return) {
            return @$options;
        }
        echo $options;

    }else{
        if($return) {
            return $default;
        }
        echo $default;
    }
}

function get_theme_menu($theme_id)
{
    $theme_options = getThemeID();
    $store_id = $theme_options['store_id'];
    $query = \App\StoreThemeOption::where('store_id',$store_id)->where('key','like','menu-name')->orderBy('order_no','ASC');

    return $query->get();
}

function get_menu_type($theme_id,$store_id,$parent_id,$key)
{
    return \App\StoreThemeOption::where('store_id',$store_id)->where('parent_id',$parent_id)->where('key',$key)->first();
}

function get_theme_menu_items($theme_id,$store_id,$parent_id,$key)
{
    return \App\StoreThemeOption::where('store_id',$store_id)->where('parent_id',$parent_id)->where('key',$key)->get();
}

function get_theme_footer_nav()
{
    $theme_options = getThemeID();
    $store_id = $theme_options['store_id'];
    $query = \App\StoreThemeOption::where('store_id',$store_id)->where('key','like','footer-nav-name')->orderBy('order_no','ASC');

    return $query->get();
}

function get_theme_option_by_parent_id($theme_id,$parent_id) {
    return \App\StoreThemeOption::where('parent_id',$parent_id)->first();
}

function get_theme_options_by_parent_id($theme_id,$parent_id) {
    return \App\StoreThemeOption::where('parent_id',$parent_id)->get();
}

function get_theme_option_by_id($theme_id,$option_id) {
    return \App\StoreThemeOption::where('id',$option_id)->first();
}

function getPage($page_id)
{
    return \App\Page::where('id',$page_id)->first();
}
function getCategory($category_id)
{
    return \Cartimatic\Store\Category::where('id',$category_id)->first();
}

function getThemeID()
{
    $host = $_SERVER['HTTP_HOST'];
    $host = parse_url($host);
    $domain = StoreDomain::where('name','like',$host)->first();
    if(!empty($domain->id))
    {
        $store_id = $domain->store_id;
        $url = $domain->name;

        \Config::set('session.domain',NULL);
        \Config::set('session.cookie',$host);

        if(\Request::server("SERVER_NAME") == $domain->name && empty($domain->is_setup_completed))
        {
            $domain->is_setup_completed = 1;
            $domain->save();
        }

    }else {
        $host = explode('.', $host['path']);
        $url = isset($host[0]) ? $host[0] : null;

        $option = StoreOption::where('key', 'like', \Config::get('constants_theme.STORE_URL'))->where('value', 'like', $url)->first();

        $store_id = @$option->store_id;

        \Config::set('session.domain','.example.com');


    }
    $theme = StoreOption::where('key','like',\Config::get('constants_theme.STORE_SELECTED_THEME'))->where('store_id',$store_id)->first();

    return ['theme_id' => @$theme->value,'store_id' => @$theme->store_id,'store_url' => $url];
}
