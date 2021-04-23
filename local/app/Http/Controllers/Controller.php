<?php namespace App\Http\Controllers;

use App\Http\Requests\Request;
use App\StoreOption;
use App\StoreTheme;
use Cartimatic\Store\StoreDomain;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Foundation\Bus\DispatchesJobs as DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

    public $theme_id = null;
    public $store_id = 0;
    public $store_name = null;
    public $is_market_place = false;
    public $store_db_name = null;
    public $store_url = null;
    public $is_custom_domain = false;
    public $url_protocol = 'http://';

    function __construct()
    {
        $this->initStore();

    }
    protected function initStore()
    {
        if(\Request::server("SERVER_NAME") == env('MARKET_PLACE_URL','localhost'))
        {
            $this->is_market_place = true;
        }

        if (!$this->is_market_place)
        {
            $theme = $this->getThemeID();
            $this->theme_id = $theme['theme_id'];
            $this->store_id = $theme['store_id'];
            $this->store_name = $theme['store_url'];
        }

        if(!empty(\Auth::user()->id))
        {
            $this->setStoreUrl();
        }

        $this->setTheme();
        \View::share('theme_id',$this->theme_id);
        \View::share('store_id',$this->store_id);
        \View::share('store_name',$this->store_name);
        \View::share('store_db_name',$this->store_db_name);
        \View::share('is_market_place',$this->is_market_place);
        \View::share('url_protocol',$this->url_protocol);
        \View::share('store_url',$this->store_url);
        \Config::set('constants_theme.SELECTED_THEME_ID',$this->theme_id);
    }
    protected function redirectToStore()
    {
        if (!empty($this->store_db_name) && strtolower($this->store_db_name) != strtolower($this->store_name))
        {
            return redirect()->to($this->store_url);
        }
    }
    protected function getThemeID()
    {
        return getThemeID();
    }
    public function getThemePath()
    {
        $theme = $this->getThemePathByID($this->theme_id);

        if(!empty($theme)){
            $path = base_path().'/themes/'.$theme.'/views';
        }else{
            $path = base_path().'/resources/views';
        }
        \View::share('theme',$theme);
        return $path;
    }
    function getThemePathByID($theme_id){
        $theme =  \App\StoreTheme::where('id',$theme_id)->first();
        return @$theme->path;
    }
    protected function setTheme() {

        $path = $this->getThemePath();

        \View::addLocation($path);
    }
    protected function setStoreUrl()
    {
        $domain = StoreDomain::where('store_id',\Auth::user()->store_id)->where('is_setup_completed',1)->first();
        $option = StoreOption::where('store_id', \Auth::user()->store_id)->where('key', 'like', \Config::get('constants_theme.STORE_URL'))->first();
        $this->store_db_name = @$option->value;

        if(!empty($domain->name))
        {
            $this->store_url = $this->url_protocol.$domain->name;
            $this->is_custom_domain = true;
        }else {
            $url = \Config::get('app.url');

            $this->store_url = $this->url_protocol . $this->store_db_name . '.' . $url;

        }
    }
}
