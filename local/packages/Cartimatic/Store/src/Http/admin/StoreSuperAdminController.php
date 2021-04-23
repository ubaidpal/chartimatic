<?php

namespace Cartimatic\Store\Http\admin;


use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use App\Services\StorageManager;
use Illuminate\Http\Request;
use app\Http\Requests;
//use App\StorageFile;
use App\User;
use File;
use Auth;
use DB;
use Cartimatic\Store\Repository\StoreRepository;
use Cartimatic\Store\StoreAlbumPhotos;
use Cartimatic\Store\StoreOrder;
use Cartimatic\Store\StoreOrderTransaction;
use Cartimatic\Store\StoreShippingCost;
use Cartimatic\Store\StoreStorageFiles;
use App\Events\ActivityLog;
use App\Classes\Worldpay;
use App\Classes\WorldpayException;
use App\Country;

class StoreSuperAdminController extends Controller
{
    protected $storeAdminRepository;
    protected $storeAdminOrderRepository;
    protected $storeProductStatRepository;

    /**
     * @param \Cartimatic\Store\Repository\StoreAdminRepository $storeAdminRepository
     * @param Request                                              $middleware
     */
    public function __construct(
        \Cartimatic\Store\Repository\admin\StoreAdminRepository $storeAdminRepository,
        \Cartimatic\Store\Repository\StoreProductStatRepository $storeProductStatRepository,
        \Cartimatic\Store\Repository\admin\StoreAdminOrderRepository $storeAdminOrderRepository, Request $middleware
    ) {
        parent::__construct();
        $this->storeAdminRepository       = $storeAdminRepository;
        $this->storeAdminOrderRepository  = $storeAdminOrderRepository;
        $this->storeProductStatRepository = $storeProductStatRepository;

        /* if(isset($middleware->storeBrandId)){
             if(ucwords($middleware->storeBrandId) != ucwords($this->user->username)) {
                 Redirect::to('/store/'.$middleware->storeBrandId)->send();
             }
         }*/
        $this->user_id = Auth::id();
        $this->user    = Auth::user();

        if(!$this->user->hasRole('super.admin')){
            abort(404);
        }
        /*@$this->data->user = $middleware['middleware']['user'];
        $this->is_api = $middleware['middleware']['is_api'];*/
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getCategories($id) {
        if(!$this->user->hasRole('super.admin')){
            return redirect('store/'.$this->user->username.'/admin/orders');
        }
        $brand = $this->storeAdminRepository->isStoreBrand($id);

        $data['allCategories'] = $this->storeAdminRepository->get_category($brand->id);

        $data['url_user_id'] = $brand->id;

        return view('Store::super-admin.Category.categories', $data);

    }

    /**
     * @param Request $request
     * @param         $id
     *
     * @return mixed
     */
    public function storeCategories(Request $request, $id) {
        if(!$this->user->hasRole('super.admin')){
            return redirect('store/'.$this->user->username.'/admin/orders');
        }
        $user_id = $this->user_id;

        $existingCategoryName = $this->storeAdminRepository->existingCategory($request,$user_id);
        if ($existingCategoryName == true) {
            return redirect('store/' . $this->user->username . '/admin/categories/Category-not-created')->with('info', 'Category or Subcategory already exist try another one.');
        } else {
            $this->storeAdminRepository->store_category($request);

            return redirect('store/{storeBrandId}/admin/categories/' . $id)->with("info", "Successfully Add");
        }

        //return redirect('store/{storeBrandId}/admin/categories/' . $id)->with("info", "No Record Added.");
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function deleteCategory(Request $request) {
        if(!$this->user->hasRole('super.admin')){
            return redirect('store/'.$this->user->username.'/admin/orders');
        }

        $category_id = $request->category_id;
        // $owner_id = $this->storeAdminRepository->getCatOwnerId($category_id);

        if ($this->storeAdminRepository->is_category_owner($category_id)) {
            $this->storeAdminRepository->deleteCategory($category_id);

            return redirect('store/' . $this->user->username . '/admin/categories/Category-deleted');

        }

        return redirect('store/' . $this->user->username . '/admin/categories/Category-deleted');
    }

     /**
     * @return int|string
     */
    public function getSubCategory() {

        $category_id = Input::get("category");
        if ($category_id > 0) {
            $users_record = DB::table('store_product_categories')
                ->where('category_parent_id', $category_id)
                ->where('deleted_at', '=' , null)
                ->select('name', 'id')
                ->get();

            return json_encode($users_record);
        }

        return 0;
    }

    /**
     * @param $category_id
     *
     * @return mixed
     */
    public function editCategory(Request $request) {
        $name        = Input::get('edited_name');
        $category_id = $request->category_id;

        //  $owner_id = $this->storeAdminRepository->getCatOwnerId($category_id);
        if ($this->storeAdminRepository->is_category_owner($category_id)) {
            $this->storeAdminRepository->editCat($name, $category_id);

            return redirect('store/' . $this->user->username . '/admin/categories/Category-updated');


        }

        return redirect('store/' . $this->user->username . '/admin/categories/Category-not-updated');
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getSubCategories($id, $message = NULL) {
        if(!$this->user->hasRole('super.admin')){
            return redirect('store/'.$this->user->username.'/admin/orders');
        }
        $previousAddedMainCategoryId = explode('_', $message);
        if (isset($previousAddedMainCategoryId[1])) {
            $previousAddedMainCategoryId = $previousAddedMainCategoryId[1];
        } else {
            $previousAddedMainCategoryId = 0;
        }

        $data['previousAddedMainCategoryId'] = $previousAddedMainCategoryId;

        $brand = $this->storeAdminRepository->isStoreBrand($id);

        $data['allSubCategories'] = $this->storeAdminRepository->getSubCategories($brand->id);
        $data['allCategories']    = $this->storeAdminRepository->getCategoriesList($brand->id);
        $data['url_user_id']      = $brand->id;
        if ($data != 0) {
            return view('Store::super-admin.Category.subCategories', $data);
        }

        return redirect()->back();
    }

    public function getSubCategoriesAjax() {

        $sub_category = Input::get('sub_category');
        $id           = Auth::user()->id;
        $data         = $this->storeAdminRepository->getSubCategoriesAjaxById($id, $sub_category);

        return $data;
    }

    /**
     * @param Request $request
     * @param         $id
     *
     * @return mixed
     */
    public function storeSubCategories(Request $request, $id) {
        if(!$this->user->hasRole('super.admin')){
            return redirect('store/'.$this->user->username.'/admin/orders');
        }
        $user_id = Auth::user()->id;
        $existingSubCategoryName = $this->storeAdminRepository->existingCategory($request,$user_id);
        if ($existingSubCategoryName == true) {
            return redirect('store/' . $this->user->username . '/admin/Subcategories/Sub-Category-not-created')->with('info', 'Subcategory or Category already exist try another one.');
        } else {
            // return redirect('store/Subcategories/'.$id.'/Sub-Category-created');
            $this->storeAdminRepository->store_sub_category($request);

            return redirect('store/' . $this->user->username . '/admin/Subcategories/Sub-Category-created_' . $request->category_parent_id)
                ->with('info', 'Record Saved Successfully.');

        }

        //  return redirect('store/' . $this->user->username . '/admin/Subcategories/Sub-Category-not-created');
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function deleteSubCategory(Request $request) {
        if(!$this->user->hasRole('super.admin')){
            return redirect('store/'.$this->user->username.'/admin/orders');
        }
        $category_id = $request->category_id;

        //  $owner_id = $this->storeAdminRepository->getCatOwnerId($category_id);

        if ($this->storeAdminRepository->is_category_owner($category_id)) {
            $this->storeAdminRepository->deleteCategory($category_id);

            return redirect("store/" . $this->user->username . "/admin/Subcategories");

        }

        return redirect("store/" . $this->user->username . "/admin/Subcategories");
    }


    /**
     * @param $category_id
     *
     * @return mixed
     */
    public function editSubCategory(Request $request) {
        if(!$this->user->hasRole('super.admin')){
            return redirect('store/'.$this->user->username.'/admin/orders');
        }
        $category_id = $request->category_id;
        $name        = Input::get('edited_name');

        $parent_id = Input::get('category_parent_id');

        // $owner_id = $this->storeAdminRepository->getCatOwnerId($category_id);
        if ($this->storeAdminRepository->is_category_owner($category_id)) {
            $this->storeAdminRepository->editSubCat($name, $category_id, $parent_id);

            return redirect("store/" . $this->user->username . "/admin/Subcategories/Sub-Categories-updated");


        }

        return redirect("store/" . $this->user->username . "/admin/Subcategories/Sub-Categories-not-updated");
    }
    
//    public function configuration(){
//
//        return view('Store::products.configuration');
//    }
}
