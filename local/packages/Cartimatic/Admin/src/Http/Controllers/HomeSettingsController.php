<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 28-Apr-16 5:17 PM
 * File Name    : HomeSettingsController.php
 */

namespace Cartimatic\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repository\Eloquent\GeneralRepository;
use App\Services\StorageManager;
use Cartimatic\Admin\Http\Banner;
use Cartimatic\Admin\Repositories\SettingsRepository;
use Cartimatic\Admin\Traits\Cropper;

class HomeSettingsController extends Controller
{
    /**
     * @var \Cartimatic\Admin\Repositories\SettingsRepository
     */
    private $settingsRepository;
    private $generalRepository;
    use Cropper;

    /**
     * HomeSettingsController constructor.
     *
     * @param \Cartimatic\Admin\Repositories\SettingsRepository $settingsRepository
     */
    public function __construct(SettingsRepository $settingsRepository, GeneralRepository $generalRepository) {
        $this->settingsRepository = $settingsRepository;
        $this->generalRepository  = $generalRepository;
    }

    public function index() {
        $data[ 'categoriesBlock' ] = $this->settingsRepository->getCategoryBlocks();
        $data['bestSellingProducts'] = $this->generalRepository->bestSellingProducts();
        $data[ 'slider' ]          = $this->settingsRepository->getSlider();
        return view('Admin::home.index', $data);
    }

    public function modal($type, $id = NULL) {
        if($type == 'items') {
            $banner               = $this->settingsRepository->getItemData($id);
            $data[ 'categories' ] = $this->settingsRepository->getChildCategories($banner->category_id);
        } elseif($type == \Config::get('admin_constants.BANNER_TYPES.BANNER_SLIDER')) {
            $data[ 'slider' ] = $this->settingsRepository->getSlider();
        } else {
            $data[ 'categories' ] = $this->settingsRepository->getCategoriesForBox();
        }

        $data[ 'categoryId' ] = $id;
        return view('Admin::modals.' . $type, $data);
    }

    public function postSettings() {
        $id = $this->settingsRepository->saveBlockCategory();
        return redirect('admin/home-page-settings#box-' . $id);
    }

    public function edit_item($id) {
        $data[ 'item' ] = $this->settingsRepository->getItemData($id);
        $parentBanner   = $this->settingsRepository->getItemData($data[ 'item' ]->parent_id);

        $data[ 'categories' ] = $this->settingsRepository->getChildCategories($parentBanner->category_id);

        $data[ 'categoryId' ] = $id;
        return view('Admin::modals.edit-item', $data);
    }

    public function upload_image() {
        $data = $this->crop('banners');

        if(\Input::has('slider_banner')) {
            $this->settingsRepository->saveSlider($data[ 'result' ]);
        } else {
            $this->settingsRepository->updateItemBanner($data[ 'result' ], \Input::get('itemId'));
        }
        $data[ 'image_path' ] = $data[ 'result' ];
        $data[ 'result' ]     = url('photo/' . $data[ 'result' ]);
        return $data;
    }

    public function getPhoto($type, $name) {
        $sm = new StorageManager();

        $file = $sm->getFile($type, $name);

        return response()->make($file)->header('Content-Type', urldecode($type));
    }

    public function uploadBannerSlider() {
        return $this->storeFile(\Input::file('slider_banner'), 'banners');
    }

    public function saveBannerSlider() {
        $this->settingsRepository->saveBannerSlider();
        return redirect()->back();
    }

    public function deleteSlider() {
        $this->settingsRepository->deleteSlider(\Input::get('id'));
    }

    public function publish($id) {
       return $this->settingsRepository->publishUnPublish($id);
    }
}
