<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : kinnect2
 * Product Name : PhpStorm
 * Date         : 19-Apr-16 2:56 PM
 * File Name    : SettingsRepository.php
 */

namespace Cartimatic\Admin\Repositories;

use Bican\Roles\Models\Permission;
use Cartimatic\Admin\Http\Banner;
use Cartimatic\Admin\Http\DisplayCategory;
use Cartimatic\Admin\Traits\Uploader;
use Cartimatic\Store\StoreRequest;
use Guzzle\Tests\Plugin\Backoff\TruncatedBackoffStrategyTest;
use Illuminate\Http\Request;
use Cartimatic\Store\Category;
use Laravel\Socialite\Two\User;

class SettingsRepository
{
    use Uploader;

    public function getUsersPermissions($id) {
        $data  = \DB::table('permission_user')
                    ->join('permissions', 'permissions.id', '=', 'permission_user.permission_id')
                    ->where('permission_user.user_id', $id)
                    ->select('permissions.name', 'permissions.id')
                    ->get();
        $perms = [];
        foreach ($data as $item) {
            $perms[ $item->id ] = $item->name;
        }
        return $perms;
    }

    public function getAllPermissions() {
        return Permission::all()->keyBy('id');
    }

    public function updateUserPermissaions($user, $permissions) {
        $user->detachAllPermissions();

        foreach ($permissions as $permission) {
            $user->attachPermission($permission);
        }
    }

    public function getCategories() {
        return Category::orderBy('name', 'ASC')->lists('name', 'id');
    }

    public function getChildCategories($id) {

        return Category::orderBy('name', 'ASC')->where('category_parent_id', $id)->lists('name', 'id');
    }

    public function getCategoriesForBox() {
        $cat = Banner::where('banner_type', \Config::get('admin_constants.BANNER_TYPES.CATEGORY'))->lists('category_id');
        return Category::whereNotIn('id', $cat)->where('category_parent_id', 0)->orderBy('name', 'ASC')->lists('name', 'id');
    }

    public function saveCategories() {
        if(\Input::has('category_id')) {
            $this->saveDetail();
        } else {
            $categories = \Input::get('categories');
            foreach ($categories as $category) {
                $display = DisplayCategory::where('category_id', $category)->first();
                if(empty($display)) {
                    $display = new DisplayCategory();
                }

                $display->category_id = $category;
                $display->title       = \Input::get('title');
                $display->sub_title   = \Input::get('sub_title');
                $display->save();

            }
        }

    }

    public function saveBlockCategory() {
        if(\Input::has('parent_id')) {
            return $this->saveBanner();
        } else if(\Input::has('item_id')) {
            return $this->updateItem();
        } elseif(\Input::has('banner_id')) {
            return $this->updateCategory();
        }
        $check = $this->isCategorySaved(\Input::get('category'));

        if(!$check) {
            $banner              = new Banner();
            $banner->category_id = \Input::get('category');
            $banner->banner_type = 'category';
            $banner->save();
            return $banner->id;
        }

    }

    public function saveBanner() {

        $imageName = '';
        if(\Input::hasFile('image')) {

            $imageName = $this->storeFile(\Input::file('image'), \Config::get('constants.IMAGE_TYPES.BANNERS'));
        }
        $banner                  = new Banner();
        $banner->title           = \Input::get('title');
        $banner->secondary_title = \Input::get('sub_title');
        $banner->object_type     = \Input::get('url_type');
        if(\Input::get('url_type') == 'category') {

            $banner->object_value = $this->getCategoryUrl(\Input::get('category'));
        } else {
            $banner->object_value = \Input::get('url');
        }
        $banner->banner_type = 'item';
        $banner->banner_path = $imageName;
        $banner->parent_id   = \Input::get('parent_id');
        $banner->save();
        return $banner->parent_id;

    }

    public function getCategoryBlocks() {
        return Banner::whereNotNull('category_id')->with('items')->with('categories.childCategories')->orderBy('sort_order', 'ASC')->get();
    }

    private function isCategorySaved($categoryId) {
        $data = Banner::where('category_id', $categoryId)->first();
        if($data) {
            return $data;
        } else {
            return FALSE;
        }
    }

    public function getItemData($id) {
        return Banner::find($id);
    }

    private function updateItem() {
        $banner                  = Banner::find(\Input::get('item_id'));
        $banner->title           = \Input::get('title');
        $banner->secondary_title = \Input::get('sub_title');
        $banner->object_type     = \Input::get('url_type');

        if(\Input::get('url_type') == 'category') {
            $banner->object_value = $this->getCategoryUrl(\Input::get('category'));
        } else {
            $banner->object_value = \Input::get('url');
        }
        $banner->save();
        return $banner->parent_id;
    }

    public function updateItemBanner($bannerImage, $itemId) {
        $banner              = Banner::find($itemId);
        $banner->banner_path = $bannerImage;
        $banner->save();
        return TRUE;
    }

    private function updateCategory() {
        $bannerId            = \Input::get('banner_id');
        $banner              = Banner::find($bannerId);
        $banner->category_id = \Input::get('category');
        $banner->banner_path = '';
        $banner->save();

        Banner::where('parent_id', $bannerId)->delete();
        return $bannerId;
    }

    public function saveSlider($banner_path) {
        $banner              = new Banner();
        $banner->banner_type = \Input::get('slider_banner');
        $banner->banner_path = $banner_path;
        $banner->title       = \Input::get('slider_banner');
        $banner->description = \Input::get('detail');
        $banner->save();
        return TRUE;
    }

    public function saveBannerSlider() {
        $urls      = \Input::get('url');
        $images    = \Input::file('sliderImage');
        $sliderIds = \Input::get('slider_id');
        foreach ($urls as $key => $url) {

            if(isset($sliderIds[ $key ])) {
                $banner = Banner::find($sliderIds[ $key ]);
            } else {
                $banner = new Banner();
            }

            if(!empty($images[ $key ])) {

                $bannerPth           = $this->storeFile($images[ $key ], 'banners');
                $banner->banner_path = $bannerPth;
            }
            $banner->banner_type  = \Config::get('admin_constants.BANNER_TYPES.BANNER_SLIDER');
            $banner->object_type  = 'url';
            $banner->object_value = $url;

            $banner->save();
        }
    }

    public function getSlider() {
        return Banner::where('banner_type', \Config::get('admin_constants.BANNER_TYPES.BANNER_SLIDER'))->orderBy('sort_order', 'ASC')->get();
    }

    public function deleteSlider($id) {
        $banner = Banner::find($id);
        $file   = str_replace('/', DIRECTORY_SEPARATOR, $banner->banner_path);
        $path   = storage_path('app' . DIRECTORY_SEPARATOR . $file);
        if($this->getDisk()->exists($path)) {

            unlink($path);
        }
        $banner->delete();
    }

    public function publishUnPublish($id) {
        $data = Banner::find($id);
        if($data->status == 1) {
            $data->status = 0;
        } else {
            $data->status = 1;
        }

        $data->save();
        return $data->status;
    }

    private function getCategoryUrl($catId) {
        $category = Category::find($catId);
        return 'category/' . $category->slug;
    }

    public function getPendingRequests() {
        return StoreRequest::whereStatus(0)->with('user')->orderBy('id','DESC')->paginate(15);
    }
    public function getResolvedRequests() {
        return StoreRequest::whereStatus(1)->with('user')->orderBy('id','DESC')->paginate(15);
    }

    public function getStatusUpdate($id) {
        $data  = StoreRequest::where('id' ,$id )->first();
        $data->status = 1;
        $data->save();
        return $data->status;
    }
    public function getDescription($id) {
        $data  = StoreRequest::whereId($id)->first();
        return $data;
    }

}
