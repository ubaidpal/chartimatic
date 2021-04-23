<?php

namespace Cartimatic\Store\Http\admin;

use App\AgeGroup;
use App\Classes\Worldpay;
use App\Classes\WorldpayException;
use App\Country;
use App\Http\Controllers\Controller;
use App\ProductTemplate;
use App\Repository\Eloquent\MessageRepository;
use App\Services\StorageManager;
use App\User;
use Auth;
use Carbon\Carbon;
use Cartimatic\Admin\Traits\Cropper;
use Cartimatic\Store\Category;
use Cartimatic\Store\Repository\admin\StoreAdminOrderRepository;
use Cartimatic\Store\Repository\admin\StoreAdminRepository;
use Cartimatic\Store\Repository\StoreProductStatRepository;
use Cartimatic\Store\Repository\StoreRepository;
use Cartimatic\Store\Scopes\IsDraftScope;
use Cartimatic\Store\StoreBrand;
use Cartimatic\Store\StoreOrder;
use Cartimatic\Store\StoreOrderTransaction;
use Cartimatic\Store\StoreProduct;
use Cartimatic\Store\StoreProductImage;
use Cartimatic\Store\StoreProductReview;
use Cartimatic\Store\StoreRequest;
use Cartimatic\Store\StoreStorageFiles;
use DB;
use File;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

//use App\StorageFile;

class StoreAdminController extends Controller
{
    use Cropper;
    protected $storeRepository;
    protected $storeAdminRepository;
    protected $storeAdminOrderRepository;
    protected $storeProductStatRepository;
    protected $user_id;

    /**
     * @param \Cartimatic\Store\Repository\admin\StoreAdminRepository $adminRepository
     * @param \Cartimatic\Store\Repository\StoreRepository $storeRepository
     * @param \Cartimatic\Store\Repository\StoreProductStatRepository $storeProductStatRepository
     * @param \Cartimatic\Store\Repository\admin\StoreAdminOrderRepository $storeAdminOrderRepository
     * @param Request $middleware
     *
     * @internal param \Cartimatic\Store\Repository\admin\StoreAdminRepository|\Cartimatic\Store\Repository\StoreAdminRepository
     *           $storeAdminRepository
     */
    public function __construct(StoreAdminRepository $adminRepository, StoreRepository $storeRepository, StoreProductStatRepository $storeProductStatRepository, StoreAdminOrderRepository $storeAdminOrderRepository, Request $middleware
    ) {
        parent::__construct();
        $this->storeRepository            = $storeRepository;
        $this->storeAdminRepository       = $adminRepository;
        $this->storeAdminOrderRepository  = $storeAdminOrderRepository;
        $this->storeProductStatRepository = $storeProductStatRepository;

        /* if(isset($middleware->storeBrandId)){
             if(ucwords($middleware->storeBrandId) != ucwords($this->user->username)) {
                 Redirect::to('/store/'.$middleware->storeBrandId)->send();
             }
         }*/
        $this->user_id = Auth::id();
        $this->user    = Auth::user();

        /*@$this->data->user = $middleware['middleware']['user'];
        $this->is_api = $middleware['middleware']['is_api'];*/
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getCategories($id) {
        if(!$this->user->hasRole('super.admin')) {
            return redirect('store/' . $this->user->username . '/admin/orders');
        }
        $brand = $this->storeAdminRepository->isStoreBrand($id);

        $data[ 'allCategories' ] = $this->storeAdminRepository->get_category($brand->id);

        $data[ 'url_user_id' ] = $brand->id;

        return view('Store::admin.Category.categories', $data);

    }

    /**
     * @param Request $request
     * @param         $id
     *
     * @return mixed
     */
    public function storeCategories(Request $request, $id) {
        if(!$this->user->hasRole('super.admin')) {
            return redirect('store/' . $this->user->username . '/admin/orders');
        }
        $user_id = $this->user_id;

        $existingCategoryName = $this->storeAdminRepository->existingCategory($request, $user_id);
        if($existingCategoryName === TRUE) {
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
        if(!$this->user->hasRole('super.admin')) {
            return redirect('store/' . $this->user->username . '/admin/orders');
        }

        $category_id = $request->category_id;
        // $owner_id = $this->storeAdminRepository->getCatOwnerId($category_id);

        if($this->storeAdminRepository->is_category_owner($category_id)) {
            $this->storeAdminRepository->deleteCategory($category_id);

            return redirect('store/' . $this->user->username . '/admin/categories/Category-deleted');

        }

        return redirect('store/' . $this->user->username . '/admin/categories/Category-deleted');
    }

    // ==================== Ubaid code ============================

    public function autoSaveNewProduct1(Request $request, $storeBrandId, $product_id) {
        $product = StoreProduct::where('id', $product_id)->withoutGlobalScope(IsDraftScope::class)->first();

        //$product->custom_id        = $request->custom_id;
        $product->title            = $request->title;
        $product->overview         = $request->overview;
        $product->affiliate_reward = $request->affiliate_reward;
        $product->description      = $request->description;

        $product->save();
    }

    public function addNewProduct1($storeBrandId) {
        $product = new StoreProduct();

        $product->title = '';

        $product->save();

        return redirect('store/' . $storeBrandId . '/admin/add-product1/' . $product->id);
    }

    /**
     * @return mixed
     */
    public function getAddProduct1($storeBrandId, $product_id) {
        $autoSavingProductInfo           = $this->getProductBasicInfo($product_id);
        $data[ 'autoSavingProductInfo' ] = $autoSavingProductInfo;

        $data[ 'storeBrandId' ] = $storeBrandId;

        $categories = Category::where('category_parent_id', 0)->get();

        $data[ 'categories' ]     = json_encode($categories);
        $data[ 'the_categories' ] = $categories;
        $data[ 'categoriesList' ] = $this->storeAdminRepository->getAllCategories($this->user->id);

        $last_child_id    = $data[ 'autoSavingProductInfo' ]->category_id;
        $line_item_childs = [];
        $execute          = TRUE;
        do {
            $category = Category::where('id', $last_child_id)->first();

            if(empty($category->category_parent_id)) {
                break;
            }
            $last_child_id                     = $category->category_parent_id;
            $childCategories                   = Category::where('category_parent_id', $category->category_parent_id)->get();
            $line_item_childs[ $category->id ] = $childCategories;
        } while ($execute);

        if(!empty($line_item_childs)) {
            $line_item_childs = array_reverse($line_item_childs, TRUE);
        }

        $data[ 'line_item_childs' ] = $line_item_childs;

        $data[ 'url_user_id' ] = $this->user_id;

        $data[ 'suppliers' ] = $this->storeAdminRepository->getSuppliers($this->user_id);

        $data[ 'seasons' ]             = $this->storeAdminRepository->getCalenderSeason($this->user_id);
        $data[ 'productGenders' ]      = $this->storeAdminRepository->getProductGender($this->user_id);
        $data[ 'valueAdditions' ]      = $this->storeAdminRepository->getValueAddition($this->user_id);
        $data[ 'brands' ]              = $this->storeAdminRepository->getBrands($this->user_id);
        $data[ 'units' ]               = $this->storeAdminRepository->getUnits($this->user_id);
        $data[ 'codes' ]               = $this->storeAdminRepository->getTaxCodes($this->user_id);
        $data[ 'lifeTypes' ]           = $this->storeAdminRepository->getLifeType($this->user_id);
        $data[ 'attributes' ]          = $this->storeAdminRepository->getCategoryAttributes($data[ 'autoSavingProductInfo' ]->category_id);
        $data[ 'selected_attributes' ] = $this->storeAdminRepository->getProductCategorySelectedAttributes($data[ 'autoSavingProductInfo' ]->id);
        $data[ 'Product_Keeping' ]     = $this->storeAdminRepository->getStoreProductKeeping($product_id);

        $data[ 'product' ][ 'id' ] = $product_id;

        return view('Store::admin.products.addProduct1', $data);
    }

    public function getProductBasicInfo($product_id) {
        return StoreProduct::select('*')
                           ->where('id', $product_id)->withoutGlobalScope(IsDraftScope::class)->withoutGlobalScope(IsDraftScope::class)->first();
    }

    public function getAddProduct() {
        $data[ 'categoriesList' ] = $this->storeAdminRepository->getAllCategories($this->user->id);
        $data[ 'url_user_id' ]    = $this->user_id;

        return view('Store::admin.products.addProduct', $data);
    }

    // Edit Product
    public function editSellerProduct(Request $request) {

        if($this->storeAdminRepository->is_product_owner($request->product_id)) {

            $data[ 'autoSavingProductInfo' ] = $this->getProductBasicInfo($request->product_id);

            $owner_id              = $this->storeAdminRepository->getProOwnerId($request->product_id);
            $data[ 'url_user_id' ] = $data[ 'storeBrandId' ] = $this->user->username;
            $data[ 'product' ]     = $this->storeAdminRepository->getProductDetail($request->product_id);

            $data[ 'features' ]        = $this->storeAdminRepository->getStoreProductKeyFeature($request->product_id);
            $data[ 'Product_Keeping' ] = $this->storeAdminRepository->getStoreProductKeeping($request->product_id);

            $data[ 'StoreImagePath' ]         = $this->storeAdminRepository->getStoreImagePath($request->product_id);
            $data[ 'techs' ]                  = $this->storeAdminRepository->getStoreProductTechSpec($request->product_id);
            $productAttributes                = $this->storeAdminRepository->getStoreProductAttributes($request->product_id);
            $data[ 'productAttributeColors' ] = [];
            $data[ 'productAttributeSizes' ]  = [];

            $categories = Category::where('category_parent_id', 0)->get();

            $data[ 'categories' ]     = json_encode($categories);
            $data[ 'the_categories' ] = $categories;

            $last_child_id    = $data[ 'autoSavingProductInfo' ]->category_id;
            $line_item_childs = [];
            $execute          = TRUE;
            do {
                $category = Category::where('id', $last_child_id)->first();

                if(empty($category->category_parent_id)) {
                    break;
                }
                $last_child_id                     = $category->category_parent_id;
                $childCategories                   = Category::where('category_parent_id', $category->category_parent_id)->get();
                $line_item_childs[ $category->id ] = $childCategories;
            } while ($execute);

            if(!empty($line_item_childs)) {
                $line_item_childs = array_reverse($line_item_childs, TRUE);
            }

            $data[ 'line_item_childs' ] = $line_item_childs;
            $data[ 'categoriesList' ]   = $this->storeAdminRepository->getAllCategories($owner_id);

            $data[ 'suppliers' ] = $this->storeAdminRepository->getSuppliers($this->user_id);
            $data[ 'brands' ]    = $this->storeAdminRepository->getBrands($this->user_id);

            $data[ 'seasons' ]        = $this->storeAdminRepository->getCalenderSeason($this->user_id);
            $data[ 'productGenders' ] = $this->storeAdminRepository->getProductGender($this->user_id);
            $data[ 'valueAdditions' ] = $this->storeAdminRepository->getValueAddition($this->user_id);
            $data[ 'brands' ]         = $this->storeAdminRepository->getBrands($this->user_id);
            $data[ 'lifeTypes' ]      = $this->storeAdminRepository->getLifeType($this->user_id);
            $data[ 'units' ]          = $this->storeAdminRepository->getUnits($this->user_id);
            $data[ 'codes' ]          = $this->storeAdminRepository->getTaxCodes($this->user_id);

            $data[ 'attributes' ]          = $this->storeAdminRepository->getCategoryAttributes($data[ 'autoSavingProductInfo' ]->category_id);
            $data[ 'selected_attributes' ] = $this->storeAdminRepository->getProductCategorySelectedAttributes($data[ 'autoSavingProductInfo' ]->id);

            $data[ 'edit' ] = TRUE;

            return view('Store::admin.products.addProduct1', $data);
        }

        return redirect()->back()->with('info', 'you are not authorized.');
    }
    //End Product

    /**
     * @param Request $request
     *
     * @return int
     */

    public function storeProduct(Request $request) {

        $product_id = $this->storeAdminRepository->addProduct($request);
        if($product_id > 0) {
            return $product_id;
        }
        return 0;
    }

    public function saveBasicProductInfo(Request $request) {
        $data = [];

        $rules     = array(
            'product_code' => 'required|unique:store_products,product_code,' . $request->get('id'),
        );
        $messages  = array(
            'unique' => 'The :attribute has already been taken.'
        );
        $validator = \Validator::make($request->all(), $rules, $messages);
        if($validator->fails()) {

            $error = ['error' => 1, 'message' => $validator->errors()->all()];
            return json_encode($error);
        }

        $product_id = $this->storeAdminRepository->saveBasicProductInfo($request, Auth::user()->id);
        if($product_id > 0) {
            $data[ "id" ] = $product_id;
        }

        $attributes = $request->get('attributes');
        if(!empty($attributes)) {
            $this->storeAdminRepository->deleteAlreadyProductAttribute($product_id);
            foreach ($attributes as $attribute_id => $values) {
                $id = $this->storeAdminRepository->saveProductAttribute($attribute_id, $product_id);
                $this->storeAdminRepository->saveProductAttributeValues($id, $values);
            }
        }

        if($request->has('print_barcode') && $request->get('print_barcode') == 1) {
            \Session::set('print_barcode', 1);
            \Session::set('product_id', $product_id);
            /* $handle = printer_open("https://172.20.134.46");
             $handle = printer_open();
             die;*/
        } else {
            \Session::forget('print_barcode');
            \Session::forget('product_id');
        }
        $data[ 'action' ] = $request->get('action');
        return json_encode($data);
    }

    public function getCategoriesJSON() {
        $cid        = isset($_POST[ "id" ]) ? $_POST[ "id" ] : 0;
        $categories = Category::where('category_parent_id', $cid)->get();
        return json_encode($categories);

    }

    public function getParentLineItemsJSON(Request $request) {
        $data = $this->storeAdminRepository->getCategoryAttributes($request->category_id);

        return json_encode($data);

    }

    public function shippingCost(Request $request) {
        $product_id = $this->storeAdminRepository->updateShapingCost($request, $this->user_id);

        return redirect('store/' . $this->user->username . '/admin/orders');
    }

    public function productAttributes(Request $request) {

        $this->storeAdminRepository->saveProductAttributes($request);
        return $this->storeAdminRepository->getProductDefaultAttributes($request->get('product_id'));
    }

    public function saveSpecifications(Request $request) {

        $this->storeAdminRepository->updateBasicProductInfo($request, $this->user_id);
        $data             = [];
        $specs            = $this->storeAdminRepository->saveSpecifications($request);
        $data[ 'action' ] = $request->get('description_action');
        return json_encode($data);

    }

    public function saveInventoryPricing(Request $request) {

        if(isset($request->is_product_id_edit)) {

            $product_id = $this->storeAdminRepository->updateInventoryPricing($request, $this->user_id);
            if($product_id > 0) {
                $data[ "id" ] = $product_id;
                return json_encode($data);
            }
        } else {

            $specs = $this->storeAdminRepository->saveInventoryPricing($request, $this->user_id);
            if($specs != 0) {
                $getKeeping = $this->storeAdminRepository->getProductKeepings($request->get('product_id'));
                return json_encode($getKeeping);
            }
            return json_encode($specs);
        }
    }

    public function uploadProductPicture() {
        $data = $this->crop(\Config::get('constants.IMAGE_TYPES.PRODUCT_IMAGES'), 90);
        if(Input::get('updateId') != -1) {
            $productImage = StoreProductImage::find(\Input::get('updateId'));
        } else {
            $productImage             = new StoreProductImage();
            $productImage->product_id = \Input::get('itemId');
        }

        $productImage->image_path = $data[ 'result' ];
        $productImage->save();

        $data[ 'image_path' ] = $data[ 'result' ];
        //$data[ 'result' ]     = url('photo/' . $data[ 'result' ]);
        $data[ 'result' ] = url($data[ 'result' ]);
        $data[ 'id' ]     = $productImage->id;
        return $data;
    }

    public function getFeedBack(Request $request) {
        $data[ 'url_user_id' ] = $user_id = $this->user_id;

        $data[ 'allOrders' ] = $this->storeAdminRepository->getFinishedOrdersCurrentUser($user_id);

        $data[ 'reviews' ] = $reviews = $this->storeAdminRepository->getCurrentUserProductsReviews($user_id);

        $user_id               = $this->user_id;
        $data[ 'getFeedBack' ] = StoreProductReview::where('owner_id', $user_id)
                                                   ->paginate(2);

        return view('Store::admin.feedback.feedBack', $data);
    }

    public function deleteFeedBack(Request $request) {

        StoreProductReview::where('id', $request->feedback_id)
                          ->delete();
        $user_id               = $this->user_id;
        $data[ 'getFeedBack' ] = StoreProductReview::where('owner_id', $user_id)
                                                   ->paginate(2);

        return view('Store::admin.feedback.feedBack', $data);

    }

    public function searchFeedBack() {

        $user_id = $this->user_id;
        $search  = Input::get('search');
        $html    = $this->storeAdminRepository->searchFeedBack($search, $user_id);
        return $html;

    }

    /**
     * @param Request $request
     *
     * @return int
     */
    public function storeProductUpdate(Request $request) {

        $product_id = $this->storeAdminRepository->updateProduct($request, 'update');

        if($product_id > 0) {
            return $product_id;
        }

        return 0;
    }

    /**
     * @param Request $request
     * @param         $id
     *
     * @return bool|int
     */

    public function product_image_ajax(Request $request) {

        $product_file = $request->file('product_image');
        $product_id   = $request->get('product_id');

        $sm   = new StorageManager();
        $data = $sm->storeFile($this->user_id, $product_file, 'album_photo');

        $sfObj                 = new StoreStorageFiles();
        $sfObj->parent_file_id = !empty($data[ 'parent_file_id' ]) ? $data[ 'parent_file_id' ] : NULL;
        $sfObj->type           = !empty($data[ 'type' ]) ? $data[ 'type' ] : NULL;
        $sfObj->parent_id      = isset($data[ 'parent_id' ]) ? $data[ 'parent_id' ] : $product_id;
        $sfObj->parent_type    = $data[ 'parent_type' ];
        $sfObj->user_id        = $data[ 'user_id' ];
        $sfObj->storage_path   = $data[ 'storage_path' ];
        $sfObj->extension      = $data[ 'extension' ];
        $sfObj->name           = $data[ 'name' ];
        $sfObj->mime_type      = $data[ 'mime_type' ];
        $sfObj->size           = $data[ 'size' ];
        $sfObj->hash           = $data[ 'hash' ];

        if(!$sfObj->save()) {
            $message = ['status' => 0];
        } else {

            if(!empty($product_id)) {
                $this->storeAdminRepository->resizeProductImage($sfObj->storage_path, $sfObj->file_id, $sfObj->user_id, 'product', 'product_profile', '151', '210', $product_id);
                $this->storeAdminRepository->resizeProductImage($sfObj->storage_path, $sfObj->file_id, $sfObj->user_id, 'product', 'product_thumb', '170', '170', $product_id);
                $this->storeAdminRepository->resizeProductImage($sfObj->storage_path, $sfObj->file_id, $sfObj->user_id, 'product', 'product_icon', '54', '80', $product_id);
            }

            $message = [
                'id'     => $sfObj->file_id,
                'path'   => \Config::get('constants_activity.PHOTO_URL') . $sfObj->storage_path . '?type=' . urlencode($sfObj->mime_type),
                'status' => 1
            ];
        }
        return response()->json($message);
    }

    /**
     * @param Request $request
     * @param         $id
     *
     * @return int
     */
    public function delete_product_image(Request $request, $id) {
        $file_id    = $request->image_id;
        $product_id = $request->product_id;

        if($file_id > 0) {

            $file = StoreProductImage::where('id', $file_id)
                                     ->where('product_id', $product_id)
                                     ->select(['id', 'image_path'])
                                     ->first();

            $sm = new StorageManager();

            if(!empty($file->image_path) && url($file->image_path)) {
                //$sm->deletFile(url($file->image_path));
                unlink($file->image_path);
                $file->delete();
                $status = 1;
            } else {
                $status = 0;
            }
        } else {
            $status = 0;
        }

        return response()->json(['status' => $status]);
    }

    /**
     * @return int|string
     */
    public function getSubCategory() {

        $category_id = Input::get("category");
        if($category_id > 0) {
            $users_record = DB::table('store_product_categories')
                              ->where('category_parent_id', $category_id)
                              ->where('deleted_at', '=', NULL)
                              ->select('name', 'id')
                              ->get();

            return json_encode($users_record);
        }

        return 0;
    }

    /**
     * @param $id
     * @param $product_id
     *
     * @return mixed
     */
    public function getProductDetail($id, $product_id) {

//        $id = $this->user_id;
        $country                 = Auth::user()->country;
        $brand                   = $this->storeAdminRepository->isStoreBrand($id);
        $data[ 'isStoreOwner' ]  = $this->storeAdminRepository->is_product_owner($product_id);
        $data[ 'storeName' ]     = $id;
        $data[ 'productDetail' ] = $product = $this->storeAdminRepository->getProductDetail($product_id);
        if(!isset($product->id)) {
            return redirect()->back()->with('info', 'no product found.');
        }
        $data[ 'key_feature' ] = $this->storeAdminRepository->key_feature($product_id);
        $data[ 'tech_spechs' ] = $this->storeAdminRepository->tech_spechs($product_id);
        $data[ 'reviews' ]     = $this->storeAdminRepository->getReviews($product_id);
        $data[ 'url_user_id' ] = $brand[ 'id' ];

        $data[ "user" ][ "country" ] = Country::where("id", $country)->first();

        $productAttributes = $data[ 'productAttributes' ] = $this->storeAdminRepository->getProductAttributes($product_id);

        $data[ 'productAttributeColors' ] = [];
        $data[ 'productAttributeSizes' ]  = [];

        if($productAttributes != 0) {
            foreach ($productAttributes as $productAttribute) {
                if($productAttribute->attribute === 'size') {
                    array_push($data[ 'productAttributeSizes' ], $productAttribute->value);
                }

                if($productAttribute->attribute === 'color') {
                    array_push($data[ 'productAttributeColors' ], $productAttribute->value);
                }
            }
        }

        return view("Store::admin.products.storeProductDetail", $data);
    }

    /**
     * @param $id
     *
     * @return int
     */
    public function deleteProductAjax($id) {
        $brand      = $this->storeAdminRepository->isStoreBrand($id);
        $product_id = Input::get('product_id');

        if($this->storeAdminRepository->is_product_owner($product_id)) {
            if(is_deletable_product($product_id) != 1) {
                return 0;
            }
            $this->storeAdminRepository->deleteProduct($product_id);

            return 1;
        }

        return 0;
    }

    /**
     * @param Request $request
     *
     * @return int
     */
    public function delete_edit_product_image(Request $request) {
        $file_id = $request->get('id');

        if($file_id > 0) {

            $files = StoreStorageFiles::select('file_id')->where('file_id', $file_id)->orWhere('parent_file_id', $file_id)->get();

            foreach ($files as $file):
                $file = StoreStorageFiles::where('file_id', $file->file_id)->first();

                $sm = new StorageManager();

                if(File::delete('local/storage/app/photos/' . $file->storage_path)) {
                    $file->delete();
                }
            endforeach;

            return 1;
        }

        return 0;
    }

    // ==================== End of Ubaid code ============================

    // ==================== Mustabeen code ============================
    public function searchMyOrders(Request $request) {
        $serchedOrders = $this->storeAdminOrderRepository->searchMyOrders($request->order_number, $request->product_name);

        return $serchedOrders;
    }

    public function searchMyReviews(Request $request) {
        $serchedOrders = $this->storeAdminOrderRepository->searchMyReviews($request->order_number, $request->product_name);

        return $serchedOrders;
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
        if($this->storeAdminRepository->is_category_owner($category_id)) {
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
        if(!$this->user->hasRole('super.admin')) {
            return redirect('store/' . $this->user->username . '/admin/orders');
        }
        $previousAddedMainCategoryId = explode('_', $message);
        if(isset($previousAddedMainCategoryId[ 1 ])) {
            $previousAddedMainCategoryId = $previousAddedMainCategoryId[ 1 ];
        } else {
            $previousAddedMainCategoryId = 0;
        }

        $data[ 'previousAddedMainCategoryId' ] = $previousAddedMainCategoryId;

        $brand = $this->storeAdminRepository->isStoreBrand($id);

        $data[ 'allSubCategories' ] = $this->storeAdminRepository->getSubCategories($brand->id);
        $data[ 'allCategories' ]    = $this->storeAdminRepository->getCategoriesList($brand->id);
        $data[ 'url_user_id' ]      = $brand->id;
        if($data != 0) {
            return view('Store::admin.Category.subCategories', $data);
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
        if(!$this->user->hasRole('super.admin')) {
            return redirect('store/' . $this->user->username . '/admin/orders');
        }
        $user_id = Auth::user()->id;

        $existingSubCategoryName = $this->storeAdminRepository->existingCategory($request, $user_id);
        if($existingSubCategoryName === TRUE) {
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
        if(!$this->user->hasRole('super.admin')) {
            return redirect('store/' . $this->user->username . '/admin/orders');
        }
        $category_id = $request->category_id;

        //  $owner_id = $this->storeAdminRepository->getCatOwnerId($category_id);

        if($this->storeAdminRepository->is_category_owner($category_id)) {
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
        if(!$this->user->hasRole('super.admin')) {
            return redirect('store/' . $this->user->username . '/admin/orders');
        }
        $category_id = $request->category_id;
        $name        = Input::get('edited_name');

        $parent_id = Input::get('category_parent_id');

        // $owner_id = $this->storeAdminRepository->getCatOwnerId($category_id);
        if($this->storeAdminRepository->is_category_owner($category_id)) {
            $this->storeAdminRepository->editSubCat($name, $category_id, $parent_id);

            return redirect("store/" . $this->user->username . "/admin/Subcategories/Sub-Categories-updated");

        }

        return redirect("store/" . $this->user->username . "/admin/Subcategories/Sub-Categories-not-updated");
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getProducts(Request $request, $id, $message = '') {
        if(\Session::has('print_barcode') && \Session::get('print_barcode')) {
            return redirect('print-barcode/' . \Session::get('product_id'));
            //$this->print_barcode(\Session::get('product_id'));
        }

        (isset($request->product_name)) ? $data[ 'product_name' ] = $request->product_name : $data[ 'product_name' ] = NULL;
        (isset($request->category_id)) ? $data[ 'category_id' ] = $request->category_id : $data[ 'category_id' ] = NULL;
        (isset($request->out_of_stock)) ? $data[ 'out_of_stock' ] = $request->out_of_stock : $data[ 'out_of_stock' ] = NULL;
        (isset($request->is_deleted)) ? $data[ 'is_deleted' ] = $request->is_deleted : $data[ 'is_deleted' ] = NULL;
        (isset($request->is_published)) ? $data[ 'is_published' ] = $request->is_published : $data[ 'is_published' ] = NULL;

        $data[ 'info' ]       = $message;
        $brand                = $this->storeAdminRepository->isStoreBrand($id);
        $data[ 'categories' ] = $this->storeAdminRepository->getAllCategories($brand->id);
        $price_range          = $this->preparePriceRange($request->adv_srch_price_range);

        (isset($request->is_adv_srch)) ? $productsInfo = $this->storeAdminRepository->getAllProductByBrandIdAdvSrch($brand->id, $request->adv_srch_product_name, $request->adv_srch_brands, $request->adv_srch_suppliers, $request->adv_srch_categories, $request->adv_srch_attributes, $price_range, 25) : $productsInfo = $this->storeAdminRepository->getAllProductByBrandId($brand->id, $data[ 'product_name' ], $data[ 'is_published' ], $data[ 'is_deleted' ], $data[ 'out_of_stock' ], $data[ 'category_id' ], 25);
        $data[ 'ownerProductCategories' ] = $productsInfo[ 'ownerProductCategories' ];
        $data[ 'AllProducts' ]            = $productsInfo[ 'allProducts' ];
        $data[ 'allProductSubItems' ]     = $productsInfo[ 'allProductSubItems' ];

        $data[ 'url_user_id' ] = $brand->id;
        $data[ 'poss' ]        = $this->storeAdminRepository->getAllShop($brand->id);

        if($data[ 'categories' ] != 0) {
            return view('Store::admin.products.manageProduct', $data);
        }

        return redirect(url('store/seller/admin/manage-product'));
    }

    public function preparePriceRange($adv_srch_price_range = '') {
        if($adv_srch_price_range == '') {
            return '';
        }
        $allPriceRange  = $this->getAdavnceSearchPriceRange();
        $range[ 'min' ] = $range[ 'max' ] = [];
        foreach ($adv_srch_price_range as $range_index) {
            $tmp              = explode('-', $allPriceRange[ $range_index - 1 ][ 'price' ]);
            $range[ 'min' ][] = trim($tmp[ 0 ]);
            if(!isset($tmp[ 1 ])) {
                $range[ 'max' ][] = '1000';
            } else {
                $range[ 'max' ][] = $tmp[ 1 ];
            }

        }
        return $range;
    }

    public function getAdavnceSearchPriceRange() {
        return [
            ['id' => 1, 'price' => '1 - 100'],
            ['id' => 2, 'price' => '101 - 200'],
            ['id' => 3, 'price' => '201 - 300'],
            ['id' => 4, 'price' => '301 - 400'],
            ['id' => 5, 'price' => '401 - 500'],
            ['id' => 6, 'price' => '501 - 600'],
            ['id' => 7, 'price' => '601 - 700'],
            ['id' => 8, 'price' => '701 - 800'],
            ['id' => 9, 'price' => '801 - 900'],
            ['id' => 10, 'price' => '901 - 1000'],
            ['id' => 11, 'price' => '> 10,000'],
        ];
    }

    /**
     * @param $id
     *
     * @return int|string
     */
    public function getProductsForSelection($id) {
        $brand          = $this->storeAdminRepository->isStoreBrand($id);
        $category_id    = Input::get("category");
        $Subcategory_id = Input::get("sub_category");
        if($category_id > 0) {
            if($Subcategory_id > 0) {
                $products = $this->storeAdminRepository->filtersProducts($category_id, $Subcategory_id);

                return json_encode($products);
            }
        }

        return 0;
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function deleteProduct(Request $request) {
        $product_id = $request->product_id;
        //$owner_id = $this->storeAdminRepository->getProOwnerId($product_id);

        if($this->storeAdminRepository->is_product_owner($product_id)) {
            if(is_deletable_product($product_id) != 1) {
                return redirect('store/' . $this->user->username . '/admin/manage-product/This product is using other modules so can not be deleted.');
            }
            if(isset($request->m_one) AND isset($request->m_one_value) AND
                isset($request->m_two) AND isset($request->m_two_value)
            ) {
                $is_deleted = $this->storeAdminRepository->deleteProductKeepingRecord($product_id, $request->m_one, $request->m_one_value, $request->m_two, $request->m_two_value);
            } else {
                $this->storeAdminRepository->deleteProduct($product_id);
            }
            return redirect('store/' . $this->user->username . '/admin/manage-product/Product-deleted');
        }

        return redirect('store/' . $this->user->username . '/admin/manage-product/Product-not-deleted');
    }

    public function checkIfAlreadySubCatAjax(Request $request) {
        return $this->storeAdminRepository->getSameNameSubCategory($request->owner_id, $request->category_id, $request->subcategory_name);
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function editProduct(Request $request) {

        //return 'this is not being used';
        if($this->storeAdminRepository->is_product_owner($request->product_id)) {
            return redirect('store/' . $this->user->username . '/admin/edit-product/' . $request->product_id);

            $owner_id              = $this->storeAdminRepository->getProOwnerId($request->product_id);
            $data[ 'url_user_id' ] = $this->user->username;
            $data[ 'product' ]     = $this->storeAdminRepository->getProductDetail($request->product_id);

            $data[ 'features' ] = $this->storeAdminRepository->getStoreProductKeyFeature($request->product_id);
            $data[ 'techs' ]    = $this->storeAdminRepository->getStoreProductTechSpec($request->product_id);

            $productAttributes = $this->storeAdminRepository->getStoreProductAttributes($request->product_id);

            $data[ 'productAttributeColors' ] = [];
            $data[ 'productAttributeSizes' ]  = [];

            if($productAttributes) {
                foreach ($productAttributes as $productAttribute) {
                    if($productAttribute->attribute === 'size') {
                        $data[ 'productAttributeSizes' ][ $productAttribute->id ] = $productAttribute->value;
                    }

                    if($productAttribute->attribute === 'color') {
                        $data[ 'productAttributeColors' ][ $productAttribute->id ] = $productAttribute->value;
                    }
                }
            }

            $data[ 'categories' ] = $this->storeAdminRepository->getAllCategories($owner_id);

            // echo '<tt><pre>'; print_r($data); die;
            die('edit here');
            return view('Store::admin.products.addProduct', $data);
        }

        return redirect()->back()->with('info', 'you are not authorized.');
    }

    /**
     * @param Request $request
     * @param null $product_id
     *
     * @return int
     */
    public function updateProduct(Request $request, $product_id = NULL) {
        $this->validate($request, [
            'category'     => 'required|integer',
            'sub_category' => 'required|integer',
            'title'        => 'required',
            'price'        => array('required', 'regex:/^\d*(\.\d{2})?$/'),
            'discount'     => array('required', 'regex:/^\d*(\.\d{2})?$/'),
            'quantity'     => 'required|min:1',
        ]);

        if($this->storeAdminRepository->updateProduct($request, $product_id) > 0) {
            return 1;
        }

        return 0;
    }

    /**
     * @param Request $request
     * @param null $product_id
     *
     * @return mixed
     */
    public function ProductReview(Request $request, $product_id = NULL) {
        $this->storeAdminRepository->storeReview($request, $product_id);

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param null $product_id
     *
     * @return mixed
     */
    public function ProductReviewAjax(Request $request, $product_id = NULL) {

        $review = $this->storeAdminRepository->storeReview($request, $product_id, 1);

        $data               = getReviewStatusForBuyer($review, $request->store_name, $request->order_id);
        $data[ 'order_id' ] = $request->order_id . $product_id;

        return $data;
    }

    public function getStoreEarnings() {
        $data[ 'url_user_id' ] = $this->user->username;

        $storeRepo                  = new StoreRepository();
        $data[ 'availableBalance' ] = $storeRepo->getAvailableBalance($this->user->id);

        $data[ 'totalSales' ]        = $this->storeAdminRepository->getTotalSalesCurrentUser($this->user->id);
        $data[ 'currentMonthSales' ] = $this->storeAdminRepository->getCurrentMonthSalesCurrentUser($this->user->id);

        return view('Store::admin.sales.storeTotalEarnings', $data);
    }

    public function updateOrderStatusAjax(Request $request) {
        $order_info = explode('_', $request->order_info);
        $status     = $order_info[ 1 ];
        $order_id   = $order_info[ 3 ];

        $isOrderSeller = $this->storeAdminOrderRepository->isOrderSeller($order_id, $this->user_id);
        if($isOrderSeller < 1) {
            return 'not authorized';
        }

        $newStatusData = $this->updateOrderStatus($order_id, $status, "seller");
        if(is_array($newStatusData)) {
            return array_merge($newStatusData, ['order_id' => $order_id]);
        } else {
            return 'something wrong happened try again.';
        }
    }

    public function updateOrderStatus($order_id, $status, $subject, $is_refunded = 0, $refund_amount = 0) {

        $is_updated = $this->storeAdminOrderRepository->updateOrderStatus($order_id, $status, $subject, $is_refunded, $refund_amount);
        $order      = $this->storeAdminOrderRepository->getOrderStatus($order_id);
        if($is_updated != '') {
            if($this->user->user_type == 1) {
                $data = getOrderStatusForBuyer($order_id, $order->status, $order);
            } else {
                $data = getOrderStatusForSeller($order_id, $order->status);
            }

            return $data;
        }

        return 'Please try again.';
    }

    public function cancelOrder(Request $request) {
        $status   = \Config::get('constants_brandstore.ORDER_STATUS.ORDER_CANCELED');
        $order_id = $request->order_id;

        $isOrderCustomer = $this->storeAdminOrderRepository->isOrderSeller($order_id, $this->user_id);
        if($isOrderCustomer < 1) {
            return 'This order does not belongs to you? Please contact to Admin if problem persists.';
        }
        $worldpay    = new Worldpay(\Config::get('constants_brandstore.WORLDPAY_SERVICE_KEY'));
        $transaction = StoreOrderTransaction::where('order_id', $order_id)
                                            ->select(['id', 'amount', 'total_amount', 'state', 'gateway_transaction_id'])
                                            ->first();

        if(empty($transaction->id)) {
            return ['message_text' => 'There is no transaction for this order', 'status' => 'error'];
        }
        $order = StoreOrder::where('id', $order_id)
                           ->select(['id', 'total_price', 'total_discount', 'customer_id', 'seller_id'])
                           ->first();
        if(empty($order->id)) {
            return ['message_text' => 'Invalid order', 'status' => 'error'];
        }
        $order_amount  = $order->total_price - $order->total_discount;
        $order_code    = $transaction->gateway_transaction_id;
        $amount        = str_replace(',', '', $transaction->amount);
        $refund_amount = $amount * 100;
        $newStatusData = NULL;
        try {
            if($order_amount == $amount) {
                $worldpay->refundOrder($order_code);
            } else {
                $worldpay->refundOrder($order_code, $refund_amount);
            }
            $is_refunded   = 1;
            $newStatusData = $this->updateOrderStatus($order_id, $status, 'seller', $is_refunded, $amount);

            $stRepositoryObj = new StoreRepository();

            $reversal[ 'parent_type' ] = 'store_order';
            $reversal[ 'parent_id' ]   = $order_id;
            $reversal[ 'user_id' ]     = $order->customer_id;
            $reversal[ 'seller_id' ]   = $order->seller_id;
            $reversal[ 'amount' ]      = $refund_amount;

            $stRepositoryObj->logStoreReversal($reversal);

        } catch (WorldpayException $e) {
            return ['message_text' => $e->getMessage(), 'status' => 'error'];
        } catch (Exception $e) {
            return ['message_text' => $e->getMessage(), 'status' => 'error'];
        }
        if(is_array($newStatusData)) {
            return array_merge($newStatusData, ['order_id' => $order_id, 'status' => 'success']);
        } else {
            return 'something wrong happened try again.';
        }
    }

    public function softDeleteOrder(Request $request) {
        $order_info = explode('_', $request->order_info);
        $order_id   = $order_info[ 1 ];

        $isOrderCustomer = $this->storeAdminOrderRepository->isOrderSeller($order_id, $this->user_id);
        if($isOrderCustomer < 1) {
            return 'This order does not belongs to you? Please contact to Admin if problem persists.';
        }

        $isOrderDeleted = $this->storeAdminOrderRepository->softDeleteOrder($order_id);

        if($isOrderDeleted > 0) {
            return $isOrderDeleted;
        } else {
            return "Something wrong happened please try again.";
        }
    }

    public function productListingAnalytics($id) {
        $brand                 = $this->storeAdminRepository->isStoreBrand($id);
        $data[ 'categories' ]  = $this->storeAdminRepository->getAllCategories($brand->id);
        $data[ 'AllProducts' ] = $this->storeAdminRepository->getAllProductByBrandId($brand->id);
        $data[ 'url_user_id' ] = $brand->id;
        if($data[ 'categories' ] != 0) {
            return view('Store::admin.product_analytics.productListingAnalytics', $data);
        }

        return redirect()->back();
    }

    public function getProductAnalytics(Request $request) {

        $data[ 'product_id' ]  = $product_id = $request->product_id;
        $data[ 'url_user_id' ] = $store_owner = $this->user->username;

        $is_owner = $this->storeAdminRepository->is_product_owner($product_id);
        if($is_owner < 1) {
            return redirect('store/' . $store_owner . '/admin/manage-product/Not-authorized')->with('info', 'Not authorized');
        }

        $data[ 'product' ] = $product = getProductDetailsByID($product_id);

        $data[ 'salePercent' ] = 100;

        $product_owner_id = $this->user_id;

        $product_statics      = $this->storeProductStatRepository->getProductViewStatics($product_id, $product_owner_id);
        $product_statics_hour = $this->storeProductStatRepository->getProductViewStaticsByHour($product_id, $product_owner_id);

        $product_statics_by_region = $this->storeProductStatRepository->getProductViewStaticsByRegion($product_id, $product_owner_id);

        $data[ 'myAllCountries' ] = $this->_preparedStatByRegion($product_statics_by_region);

        $data[ 'preparedStatViews' ]      = $this->_preparedStatViews($product_statics);
        $data[ 'preparedStatViewsHours' ] = $this->_preparedStatViewsHours($product_statics_hour);
//echo '<tt><pre>'; print_r( $data['preparedStatViewsHours']); die;
        $data[ 'product_statics_by_age' ] = $this->storeProductStatRepository->getProductViewStaticsByAge($product_id, $product_owner_id);

        $data[ 'region' ]   = $this->storeAdminRepository->getRegion();
        $data[ 'now_date' ] = Carbon::now()->toDateString();

        return view('Store::admin.product_analytics.productAnalytics', $data);

    }

    public function _preparedStatByRegion($product_statics_by_region) {
        $count          = 1;
        $myAllCountries = '';
        foreach ($product_statics_by_region as $region):
            if($count < 6) {
                if($count % 2 == 0) {
                    $color = "#78acc1";
                } else {
                    $color = "#c5d6dd";
                }
                $myAllCountries .= '{color: "' . $color . '", label: "' . $region->region . '",  y: ' . $region->count . '  }, ';
            }
            $count++;
        endforeach;

        return $myAllCountries;
    }

    private function _preparedStatViews($product_statics) {
        $count             = 1;
        $preparedStatViews = '';
        foreach ($product_statics as $product_stat_view) {

            if(isset($product_stat_view->date)) {
                $preparedStatViews .= '{label: "' . Carbon::parse($product_stat_view->date)->format('M d') . '" , y: ' . $product_stat_view->count . ' },';
            }
            $count++;
        }
        $count = 0;

        return $preparedStatViews;
    }

    private function _preparedStatViewsHours($product_statics) {

        /*$preparedStatViews = '';
        foreach ($product_statics as $product_stat_view) {

            $y = Carbon::parse($product_stat_view->created_at)->format('Y');
            $m = Carbon::parse($product_stat_view->created_at)->format('m');
            $d = Carbon::parse($product_stat_view->created_at)->format('d');
            $h = Carbon::parse($product_stat_view->created_at)->format('H');
            $i = Carbon::parse($product_stat_view->created_at)->format('i');
            if (isset($product_stat_view->hour)) {
                $preparedStatViews .= "{x: new Date(Date.UTC (" . $y . ", " . $m . ", " . $d . ", " . $h . ",0) ), y: " . $product_stat_view->count . " },";
            }

        }

        return $preparedStatViews;*/

        $preparedStatViews = [];
        foreach ($product_statics as $product_stat_view) {

            $y = Carbon::parse($product_stat_view->created_at)->format('Y');
            $m = Carbon::parse($product_stat_view->created_at)->format('m');
            $d = Carbon::parse($product_stat_view->created_at)->format('d');
            $h = ltrim(Carbon::parse($product_stat_view->created_at)->format('H'), '0');

            $i = Carbon::parse($product_stat_view->created_at)->format('i');
            if(isset($product_stat_view->hour)) {

                $data[ 'year' ]          = $y;
                $data[ 'month' ]         = $m;
                $data[ 'days' ]          = $d;
                $data[ 'hours' ]         = $h;
                $data[ 'min' ]           = $i;
                $data[ 'y' ]             = $product_stat_view->count;
                $preparedStatViews[ $h ] = $data;
                // $preparedStatViews .= "{x: new Date(Date.UTC (" . $y . ", " . $m . ", " . $d . ", " . $h . ",0) ), y: " . $product_stat_view->count . " },";
            }
        }

        $data = '';
        for ($i = 1; $i <= 24; $i++) {
            if($i <= 12) {
                $amPm = $i;//.' am';
            } else {
                $amPm = $i;//.' pm';
            }
            $hourData[ 'label' ] = $amPm;
            $hourData[ 'y' ]     = 0;

            if(isset($preparedStatViews[ $i ])) {
                $hourData[ 'y' ] = $preparedStatViews[ $i ][ 'y' ];
            }
            //$data[] = $hourData;
            $data .= '{label: "' . $hourData[ 'label' ] . '",  y: ' . $hourData[ 'y' ] . '  }, ';
        }
        //echo '<tt><pre>'; print_r($data); die;

        return $data;
    }

    public function getPageAnalytics(Request $request) {

        $data[ 'product_id' ]  = $product_id = $request->product_id;
        $data[ 'url_user_id' ] = $store_owner = $this->user->username;

        if($request->storeBrandId != $store_owner) {
            return redirect('store/' . $store_owner . '/admin/manage-product/Not-authorized')->with('info', 'Not authorized');
        }

        $data[ 'owner_id' ] = $owner_id = $this->user_id;

        $data[ 'product_statics_by_age' ]    = $this->storeProductStatRepository->getPageViewStaticsByAge($owner_id);
        $data[ 'totalProductSoldCount' ]     = count($this->storeAdminRepository->getFinishedOrdersCurrentUser($owner_id));
        $data[ 'totalProductQuantityCount' ] = $this->storeAdminRepository->getTotalQuantityOfProductsCurrentUser($owner_id);

        $product_statics_by_region = $this->storeProductStatRepository->getPageViewStaticsByRegion($owner_id);

        $data[ 'myAllCountries' ] = $this->_preparedStatByRegion($product_statics_by_region);

        $product_statics             = $this->storeProductStatRepository->getPageViewStatics($owner_id);
        $data[ 'preparedStatViews' ] = $this->_preparedStatViews($product_statics);

        $product_statics_hour             = $this->storeProductStatRepository->getPageViewStaticsByHour($owner_id);
        $data[ 'preparedStatViewsHours' ] = $this->_preparedStatViewsHours($product_statics_hour);

        $data[ 'now_date' ] = Carbon::now()->toDateString();

        return view('Store::admin.product_analytics.pageAnalytics', $data);
    }

    public function manageReviews($id, $message = NULL) {
        $data[ 'url_user_id' ] = $user_id = $this->user_id;

        $data[ 'allOrders' ] = $this->storeAdminRepository->getFinishedOrdersCurrentUser($user_id);

        $data[ 'reviews' ] = $reviews = $this->storeAdminRepository->getCurrentUserProductsReviews($user_id);

        return view('Store::admin.reviews.manageReviews', $data)->with('info', $message);
    }

    public function addCourierServiceInfo(Request $request) {

        $request->seller_id = $this->user_id;

        $status   = 5;
        $order_id = $request->order_id;

        $isOrderSeller = $this->storeAdminOrderRepository->isOrderSeller($order_id, $this->user_id);
        if($isOrderSeller < 1) {
            return 'not authorized';
        }

        $deliverCourier = $this->storeAdminRepository->AddDeliverCourierInfo($request);

        $newStatusData = $this->updateOrderStatus($order_id, $status, "seller");

        if(is_array($newStatusData)) {
            return array_merge($newStatusData, ['order_id' => $order_id]);
        } else {
            return 'something wrong happened try again.';
        }

        return $deliverCourier;
    }

    public function getOrderInvoice(Request $request) {

        $data[ 'order_id' ]    = $order_id = $request->order_id;
        $data[ 'url_user_id' ] = $store_owner = Auth::user()->username;

        $data[ 'order' ]          = $this->storeAdminOrderRepository->getOrderById($order_id);
        $data[ 'orderCourier' ]   = $order = $this->storeAdminOrderRepository->getOrderCourierByOrderId($order_id);
        $data[ 'orderAddresses' ] = $order = $this->storeAdminOrderRepository->getOrderAddressesByOrderId($data[ 'order' ]->delivery_address_id);
        $data[ 'orderPayments' ]  = $order = $this->storeAdminOrderRepository->getOrderPaymentByOrderId($order_id);

        if(!is_null($data[ 'order' ]->conv_id)) {
            $messageRepo        = new MessageRepository();
            $data[ 'messages' ] = $messageRepo->getConvAllMessages($data[ 'order' ]->conv_id, 'ASC');
        }
        return view('Store::admin.orders.orderInvoice', $data);
    }

    public function getAddProductShippingCost(Request $request) {
        $data[ 'url_user_id' ] = $store_owner = $this->user->username;
        $data[ 'user' ]        = $store_owner = $this->user;
        $product_id            = $request->product_id;

        $data[ 'product' ]    = $product = $this->storeAdminRepository->getProductDetail($product_id);
        $data[ 'allRegions' ] = $this->storeAdminRepository->getAllRegions();
        $data[ 'countries' ]  = $this->storeAdminRepository->getAllCountries();

        return view('Store::admin.products.addProductShippingCost', $data);

    }

    public function addProductShippingCost(Request $request) {
        $data[ 'url_user_id' ] = $store_owner = $this->user->username;

        $isAdded = $this->storeAdminRepository->addRegionCost($request);

        if($isAdded == 1) {
            return redirect('store/' . $store_owner . '/admin/manage-product/shipping cost added')->with('info', 'Shipping Cost(s) added successfully.');
        } else {
            return redirect('store/' . $store_owner . '/admin/add-product-shipping-cost/' . $request->product_id . '/shipping cost not added')->with('info', 'Shipping Cost(s) not added.');
        }
    }

    public function sendRequestToRvise(Request $request) {
        $isRequestSend = $this->storeAdminRepository->sendReviewReviseRequest($request->review_id);

        return redirect('store/' . $this->user->username . '/admin/feedback/request sent successfully');

    }

    public function statement(Request $request) {
        $transaction_type      = \Input::get('transaction_type');
        $data                  = $this->storeAdminRepository->statement($request->storeBrandId, $transaction_type);
        $data[ 'url_user_id' ] = $store_owner = $this->user->username;
        $data[ 'poss' ]        = $this->storeAdminRepository->getAllShopList($this->user_id);

        return view('Store::admin.sales.statement', $data);
    }

    public function number_views($product_owner_id, $product_id) {
        $product_owner_id = $this->user_id;
        $product_statics  = $this->storeProductStatRepository->getProductViewStatics($product_id, $product_owner_id);
        //echo '<tt><pre>'; print_r($product_statics);
        $data = [];
        foreach ($product_statics as $product_stat_view) {

            if(isset($product_stat_view->date)) {
                $preparedStatViews[ 'label' ] = Carbon::parse($product_stat_view->date)->format('M d');
                $preparedStatViews[ 'y' ]     = $product_stat_view->count;
                $data[]                       = $preparedStatViews;
            }
        }

        return $data; //$this->_preparedStatViews($product_statics);
    }

    public function number_sales($product_owner_id, $product_id) {
        $product_owner_id = $this->user_id;
        $product_statics  = $this->storeProductStatRepository->getProductViewStatics($product_id, $product_owner_id);
        //echo '<tt><pre>'; print_r($product_statics);
        $data = [];
        foreach ($product_statics as $product_stat_view) {

            if(isset($product_stat_view->date)) {
                $preparedStatViews[ 'label' ] = Carbon::parse($product_stat_view->date)->format('M d');
                $preparedStatViews[ 'y' ]     = $product_stat_view->count;
                $data[]                       = $preparedStatViews;
            }
        }

        return $data; //$this->_preparedStatViews($product_statics);
    }

    public function age_view($product_owner_id, $product_id) {
        $product_owner_id       = $this->user_id;
        $product_statics_by_age = $this->storeProductStatRepository->getProductViewStaticsByAge($product_id, $product_owner_id);

        $data[ 'label' ] = '10-25';
        $data[ 'color' ] = '#c5d6dd';
        $data[ 'y' ]     = $product_statics_by_age[ 'firstCountView' ];
        $setData[]       = $data;

        $data[ 'label' ] = '25-35';
        $data[ 'color' ] = '#78acc1';
        $data[ 'y' ]     = $product_statics_by_age[ 'secondCountView' ];
        $setData[]       = $data;

        $data[ 'label' ] = '35-45';
        $data[ 'color' ] = '#c5d6dd';
        $data[ 'y' ]     = $product_statics_by_age[ 'thirdCountView' ];
        $setData[]       = $data;

        $data[ 'label' ] = '45-55';
        $data[ 'color' ] = '#78acc1';
        $data[ 'y' ]     = $product_statics_by_age[ 'fourthCountView' ];
        $setData[]       = $data;

        $data[ 'label' ] = '> 55';
        $data[ 'color' ] = '#c5d6dd';
        $data[ 'y' ]     = $product_statics_by_age[ 'fifthCountView' ];
        $setData[]       = $data;
        return $setData; //$this->_preparedStatViews($product_statics);
    }

    public function gender_view($product_owner_id, $product_id) {
        $product_owner_id       = $this->user_id;
        $product_statics_by_age = $this->storeProductStatRepository->getProductViewStaticsByAge($product_id, $product_owner_id);

        $data[ 'color' ]      = '#c5d6dd';
        $data[ 'y' ]          = $product_statics_by_age[ 'maleCountView' ];
        $data[ 'legendText' ] = "Male " . round($product_statics_by_age[ 'maleCountViewPercent' ]) . '%';
        $data[ 'indexLabel' ] = "Male " . round($product_statics_by_age[ 'maleCountViewPercent' ]) . '%';
        $setData[]            = $data;

        $data[ 'color' ]      = '#dbbcce';
        $data[ 'y' ]          = $product_statics_by_age[ 'femaleCountView' ];
        $data[ 'legendText' ] = "Female " . round($product_statics_by_age[ 'femaleCountViewPercent' ]) . '%';
        $data[ 'indexLabel' ] = "Female " . round($product_statics_by_age[ 'femaleCountViewPercent' ]) . '%';
        $setData[]            = $data;

        return $setData; //$this->_preparedStatViews($product_statics);
    }

    public function country_view($product_owner_id, $product_id) {
        $product_owner_id          = $this->user_id;
        $product_statics_by_region = $this->storeProductStatRepository->getProductViewStaticsByRegion($product_id, $product_owner_id);
        $myAllCountries            = [];
        $count                     = 1;
        foreach ($product_statics_by_region as $region):

            if($count % 2 == 0) {
                $color = "#78acc1";
            } else {
                $color = "#c5d6dd";
            }
            $country[ 'color' ] = $color;
            $country[ 'label' ] = $region->region;
            $country[ 'y' ]     = $region->count;
            $myAllCountries[]   = $country;

            $count++;
        endforeach;

        return $myAllCountries;

    }

    public function peak_view($product_owner_id, $product_id) {
        $product_owner_id     = $this->user_id;
        $product_statics_hour = $this->storeProductStatRepository->getProductViewStaticsByHour($product_id, $product_owner_id);

        $preparedStatViews = [];
        foreach ($product_statics_hour as $product_stat_view) {

            $y = Carbon::parse($product_stat_view->created_at)->format('Y');
            $m = Carbon::parse($product_stat_view->created_at)->format('m');
            $d = Carbon::parse($product_stat_view->created_at)->format('d');
            $h = ltrim(Carbon::parse($product_stat_view->created_at)->format('H'), '0');

            $i = Carbon::parse($product_stat_view->created_at)->format('i');
            if(isset($product_stat_view->hour)) {

                $data[ 'year' ]          = $y;
                $data[ 'month' ]         = $m;
                $data[ 'days' ]          = $d;
                $data[ 'hours' ]         = $h;
                $data[ 'min' ]           = $i;
                $data[ 'y' ]             = $product_stat_view->count;
                $preparedStatViews[ $h ] = $data;
                // $preparedStatViews .= "{x: new Date(Date.UTC (" . $y . ", " . $m . ", " . $d . ", " . $h . ",0) ), y: " . $product_stat_view->count . " },";
            }
        }
        $data = [];
        for ($i = 01; $i <= 24; $i++) {
            if($i <= 12) {
                $amPm = $i;//.' am';
            } else {
                $amPm = $i;//.' pm';
            }
            $hourData[ 'label' ] = $amPm;
            $hourData[ 'y' ]     = 0;

            if(isset($preparedStatViews[ $i ])) {
                $hourData[ 'y' ] = $preparedStatViews[ $i ][ 'y' ];
            }
            $data[] = $hourData;
        }
        //echo '<tt><pre>'; print_r($data); die;

        return $data;
    }

    public function number_views_page_stat($product_owner_id, $product_id) {
        $product_owner_id = $this->user_id;
        $product_statics  = $this->storeProductStatRepository->getPageViewStatics($product_owner_id);
        //echo '<tt><pre>'; print_r($product_statics);
        $data = [];
        foreach ($product_statics as $product_stat_view) {

            if(isset($product_stat_view->date)) {
                $preparedStatViews[ 'label' ] = Carbon::parse($product_stat_view->date)->format('M d');
                $preparedStatViews[ 'y' ]     = $product_stat_view->count;
                $data[]                       = $preparedStatViews;
            }
        }

        return $data; //$this->_preparedStatViews($product_statics);
    }

    public function number_sales_page_stat($product_owner_id, $product_id) {
        $product_owner_id = $this->user_id;
        $product_statics  = $this->storeProductStatRepository->getPageViewStatics($product_owner_id);
        //echo '<tt><pre>'; print_r($product_statics);
        $data = [];
        foreach ($product_statics as $product_stat_view) {

            if(isset($product_stat_view->date)) {
                $preparedStatViews[ 'label' ] = Carbon::parse($product_stat_view->date)->format('M d');
                $preparedStatViews[ 'y' ]     = $product_stat_view->count;
                $data[]                       = $preparedStatViews;
            }
        }

        return $data; //$this->_preparedStatViews($product_statics);
    }

    public function age_view_page_stat($product_owner_id, $product_id) {
        $product_owner_id       = $this->user_id;
        $product_statics_by_age = $this->storeProductStatRepository->getPageViewStaticsByAge($product_owner_id);

        $data[ 'label' ] = '10-25';
        $data[ 'color' ] = '#c5d6dd';
        $data[ 'y' ]     = $product_statics_by_age[ 'firstCountView' ];
        $setData[]       = $data;

        $data[ 'label' ] = '25-35';
        $data[ 'color' ] = '#78acc1';
        $data[ 'y' ]     = $product_statics_by_age[ 'secondCountView' ];
        $setData[]       = $data;

        $data[ 'label' ] = '35-45';
        $data[ 'color' ] = '#c5d6dd';
        $data[ 'y' ]     = $product_statics_by_age[ 'thirdCountView' ];
        $setData[]       = $data;

        $data[ 'label' ] = '45-55';
        $data[ 'color' ] = '#78acc1';
        $data[ 'y' ]     = $product_statics_by_age[ 'fourthCountView' ];
        $setData[]       = $data;

        $data[ 'label' ] = '> 55';
        $data[ 'color' ] = '#c5d6dd';
        $data[ 'y' ]     = $product_statics_by_age[ 'fifthCountView' ];
        $setData[]       = $data;
        return $setData; //$this->_preparedStatViews($product_statics);
    }

    public function gender_view_page_stat($product_owner_id, $product_id) {
        $product_owner_id       = $this->user_id;
        $product_statics_by_age = $this->storeProductStatRepository->getPageViewStaticsByAge($product_owner_id);

        $data[ 'color' ]      = '#c5d6dd';
        $data[ 'y' ]          = $product_statics_by_age[ 'maleCountView' ];
        $data[ 'legendText' ] = "Male " . round($product_statics_by_age[ 'maleCountViewPercent' ]) . '%';
        $data[ 'indexLabel' ] = "Male " . round($product_statics_by_age[ 'maleCountViewPercent' ]) . '%';
        $setData[]            = $data;

        $data[ 'color' ]      = '#dbbcce';
        $data[ 'y' ]          = $product_statics_by_age[ 'femaleCountView' ];
        $data[ 'legendText' ] = "Female " . round($product_statics_by_age[ 'femaleCountViewPercent' ]) . '%';
        $data[ 'indexLabel' ] = "Female " . round($product_statics_by_age[ 'femaleCountViewPercent' ]) . '%';
        $setData[]            = $data;

        return $setData; //$this->_preparedStatViews($product_statics);
    }

    public function country_view_page_stat($product_owner_id, $product_id) {
        $product_owner_id          = $this->user_id;
        $product_statics_by_region = $this->storeProductStatRepository->getPageViewStaticsByRegion($product_owner_id);
        $myAllCountries            = [];
        $count                     = 1;
        foreach ($product_statics_by_region as $region):

            if($count % 2 == 0) {
                $color = "#78acc1";
            } else {
                $color = "#c5d6dd";
            }
            $country[ 'color' ] = $color;
            $country[ 'label' ] = $region->region;
            $country[ 'y' ]     = $region->count;
            $myAllCountries[]   = $country;

            $count++;
        endforeach;

        return $myAllCountries;

    }

    public function peak_view_page_stat($product_owner_id, $product_id) {
        $product_owner_id     = $this->user_id;
        $product_statics_hour = $this->storeProductStatRepository->getPageViewStaticsByHour($product_owner_id);

        $preparedStatViews = [];
        foreach ($product_statics_hour as $product_stat_view) {

            $y = Carbon::parse($product_stat_view->created_at)->format('Y');
            $m = Carbon::parse($product_stat_view->created_at)->format('m');
            $d = Carbon::parse($product_stat_view->created_at)->format('d');
            $h = ltrim(Carbon::parse($product_stat_view->created_at)->format('H'), '0');

            $i = Carbon::parse($product_stat_view->created_at)->format('i');
            if(isset($product_stat_view->hour)) {

                $data[ 'year' ]          = $y;
                $data[ 'month' ]         = $m;
                $data[ 'days' ]          = $d;
                $data[ 'hours' ]         = $h;
                $data[ 'min' ]           = $i;
                $data[ 'y' ]             = $product_stat_view->count;
                $preparedStatViews[ $h ] = $data;
                // $preparedStatViews .= "{x: new Date(Date.UTC (" . $y . ", " . $m . ", " . $d . ", " . $h . ",0) ), y: " . $product_stat_view->count . " },";
            }
        }
        $data = [];
        for ($i = 01; $i <= 24; $i++) {
            if($i <= 12) {
                $amPm = $i;//.' am';
            } else {
                $amPm = $i;//.' pm';
            }
            $hourData[ 'label' ] = $amPm;
            $hourData[ 'y' ]     = 0;

            if(isset($preparedStatViews[ $i ])) {
                $hourData[ 'y' ] = $preparedStatViews[ $i ][ 'y' ];
            }
            $data[] = $hourData;
        }
        //echo '<tt><pre>'; print_r($data); die;

        return $data;
    }

    public function getCountriesByRegion() {
        $region              = \Request::get('region');
        $data[ 'countries' ] = $this->storeAdminRepository->getCountriesByRegion($region);

        return response()->json($data);
    }

    public function myProducts() {
        $user_id  = Auth::id();
        $products = StoreProduct::where('owner_id', $user_id)->get();

        $products = DB::table('store_products')
                      ->join('contacts', 'users.id', '=', 'contacts.user_id')
                      ->select('users.*', 'contacts.phone', 'orders.price')
                      ->get();

        $data[ "products" ] = $products;
        return view('Store::admin.products.index', $data);
    }

    public function editBrandPageLayout($storeBrandId) {
        $brand = $this->storeRepository->isStoreBrand($storeBrandId);

        $data[ 'url_user_id' ] = $brand->id;

        $data[ 'allProducts' ] = $this->storeRepository->currentBrandProducts($brand->id, 10);
        $data[ 'storeOwner' ]  = getUserDetail($storeBrandId);

        //Adding profile view stat
        $this->storeRepository->addProfilePageStat($brand->id);
        $data[ 'user' ] = $this->user;
        return view('Store::admin.edit_brand_page', $data);
    }

    public function saveBrandPageLayout() {

        $user = User::find($this->user_id);

        if(\Input::get('itemId') == 'profile_photo') {
            $data                    = $this->crop('profile_photos', 90);
            $user->profile_photo_url = $data[ 'result' ];
        } else {
            $data                  = $this->crop('cover_photos', 90);
            $user->cover_photo_url = $data[ 'result' ];
        }

        $user->save();

        $data[ 'image_path' ] = $data[ 'result' ];
        $data[ 'result' ]     = url($data[ 'result' ]);
        return $data;
    }

    public function selectPOS(Request $request) {

        if($request->has('pos_id')) {
            return redirect('admin/store/pos/push-items/' . $request->pos_id);
        } else {
            return redirect()->back();
        }
    }

    public function saveProductPublish(Request $request) {
        $product = StoreProduct::where('id', $request->product_id)->withoutGlobalScope(IsDraftScope::class)->first();

        if(isset($product->id)) {
            $product->is_published  = 1;
            $product->shipping_cost = $request->shipping_cost;
            $product->save();
            return 1;
        }
        return 0;
    }

    public function getProductDetailForPushItems($id) {
        $data[ 'shops' ]   = $this->storeAdminRepository->getAllShop($this->user_id);
        $data[ 'product' ] = $this->storeAdminRepository->getProductWithAttributes($id);
        ///echo '<tt><pre>'; print_r($data['products']); die;
        return view('Store::admin.products.push-items', $data);
    }

    public function saveProductDraft(Request $request) {
        $product = StoreProduct::where('id', $request->product_id)->withoutGlobalScope(IsDraftScope::class)->first();
        if(isset($product->id)) {
            $product->is_published  = 0;
            $product->shipping_cost = $request->shipping_cost;
            $product->save();
            return 1;
        }
        return 0;
    }

    public function getProductsVariants(Request $request) {
        $data[ 'products' ] = $this->storeAdminRepository->getProductVariants($request->product_id);
        //echo '<tt><pre>'; print_r( $data[ 'products' ]); die;
        return view('Store::products.variants', $data);
    }

    public function saveRequest(Request $request) {
        $this->validate($request, [
            'request_detail' => 'required'
        ]);

        $this->storeAdminRepository->addRequest($request, $this->user_id);
        return redirect()->back()->with('success', 'Request added successfully. We can resolve this request within 7 days. Thanks');
    }

    public function allRequest() {
        $data[ 'title' ]    = 'All Requests';
        $data[ 'requests' ] = $this->storeAdminRepository->getAllRequests($this->user_id);
        return view('Store::requests.index', $data);
    }

    public function getEdit($id) {
        $request = StoreRequest::find($id);
        if(empty($request)) {
            return redirect()->back()->with('error', 'Request is not found');
        }
        if($request->user_id == $this->user_id) {
            if($request->status == 0) {
                $data[ 'title' ]   = 'Edit Request';
                $data[ 'request' ] = $request;
                return view('Store::requests.edit', $data);
            } else {
                return redirect()->back()->with('error', 'Request is resolved so you cannot edit this request');
            }

        } else {
            return redirect()->back()->with('error', 'Permission Denied!');

        }
    }

    public function updateRequest(Request $requestForm, $id) {
        $request = StoreRequest::find($id);
        if(empty($request)) {
            return redirect()->back()->with('error', 'Request is not found');
        }
        if($request->user_id == $this->user_id) {
            if($request->status == 0) {
                $request->detail = $requestForm->detail;
                $request->save();
                return redirect('admin/store/requests')->with('success', 'Request is updated successfully');
            } else {
                return redirect()->back()->with('error', 'Request is resolved so you cannot edit this request');
            }

        } else {
            return redirect()->back()->with('error', 'Permission Denied!');

        }
    }

    public function deleteRequest($id) {
        $request = StoreRequest::find($id);
        if(empty($request)) {
            return redirect()->back()->with('error', 'Request is not found');
        }
        if($request->user_id == $this->user_id) {
            if($request->status == 0) {
                $request->delete();
                return redirect('admin/store/requests')->with('success', 'Request is deleted successfully');
            } else {
                return redirect()->back()->with('error', 'Request is resolved so you cannot edit this request');
            }

        } else {
            return redirect()->back()->with('error', 'Permission Denied!');

        }
    }

    public function uploadImage() {
        if(\Request::file('image')->isValid()) {
            $sm        = new StorageManager();
            $file_name = $sm->getFilename('jpg');
            $path      = 'description-images' . DIRECTORY_SEPARATOR . $this->user_id;

            if(!$sm->pathExists($path)) {
                $sm->createDirectory($path);
            }
            $path .= DIRECTORY_SEPARATOR . $file_name;

            $sm->saveFile($path, \Request::file('image'));

            return response()->json(['path' => url('local/storage/app/description-images/' . $this->user_id . '/' . $file_name)]);
        }
    }

    public function print_barcode($product_id) {
        $data[ 'products' ] = StoreProduct::with('productKeeping.master1')
                                          ->with('productKeeping.value1')
                                          ->with('productKeeping.master2')
                                          ->with('productKeeping.value2')
                                          ->whereId($product_id)
                                          ->first();

        $html    = view('Store::admin.products.barcode', $data)->render();
        $printer = "COLOR-JET (HP Color LaserJet M750)";
        //if($ph = printer_open($printer)) {
        $ph = printer_open($printer);
        echo $content = $html;
        printer_set_option($ph, PRINTER_MODE, "RAW");
        printer_write($ph, $content);
        printer_close($ph);
        \Session::forget('print_barcode');
        \Session::forget('product_id');
        return redirect('store/seller/admin/manage-product');
        //};
    }

    public function getAdvancedSearchAttributes(Request $request) {
        $brand = $this->storeAdminRepository->isStoreBrand($this->user->id);
        if(!isset($brand->id)) {
            return 'not authorized';
        }
        $data[ 'brands' ]      = $this->getAdvanceSearchBrands($brand->id);
        $data[ 'suppliers' ]   = $this->getAdvanceSearchSuppliers($brand->id);
        $data[ 'categories' ]  = $this->getAdvancedSearchCategories($brand->id);
        $data[ 'variants' ]    = $this->getAdvancedSearchVariants($data[ 'categories' ]);
        $data[ 'price_range' ] = $this->getAdavnceSearchPriceRange();

        return json_encode($data);
    }

    public function getAdvanceSearchBrands($brand_id) {
        return $this->storeAdminRepository->getAdvanceSearchBrands($brand_id);
    }

    public function getAdvanceSearchSuppliers($brand_id) {
        return $this->storeAdminRepository->getAdvanceSearchSuppliers($brand_id);
    }

    public function getAdvancedSearchCategories($brand_id) {
        return $this->storeAdminRepository->getAdvanceSearchCategories($brand_id);
    }

    public function getAdvancedSearchVariants($categories) {
        return $this->storeAdminRepository->getAdvancedSearchVariants($categories);
    }

    public function deleteAllBackStageProducts(Request $request) {
        $p = StoreProduct::select('id')
                         ->whereRaw(DB::raw("DATEDIFF(now(), created_at) > 15"))
                         ->whereNull('slug')
                         ->whereOwnerId(0)
                         ->whereCategoryId(0)
                         ->withoutGlobalScope(SoftDeletes::class)
                         ->withoutGlobalScope(IsDraftScope::class)
                         ->forceDelete();
        dd('Total ' . $p . ' back stage product(s) are deleted.');
    }

    public function getProductCodeTemplates(Request $request) {
        $templates = ProductTemplate::where('store_id', $this->user_id)
                                    ->whereNull('deleted_at')
                                    ->orderBy('name', 'ASC')
                                    ->where('category_id', $request->get('categoryId'))
                                    ->get();

        return response()->json([
            'templates'      => $templates,
            'templateLength' => \Session::get('SYSTEM_CONFIGURATION')[ 'PRODUCT_VARIABLE_CODE' ]
        ]);
    }

    public function getCodeIncrement(Request $request) {
        $templateId = $request->get('id');
        $template   = ProductTemplate::find($templateId);
        $template->increment('incremented_value');
    }

    public function getItemsAgeGroup(Request $request) {

        $ageGroup = AgeGroup::whereNull('deleted_at')->where('store_id', $this->user_id)->where('category_id', $request->categoryId)->pluck('name', 'id');
        return json_encode($ageGroup);

    }

    public function getBrand(Request $request) {

        $brand = StoreBrand::where('is_deleted', 0)->where('store_id', $this->user_id)->where('category_id', $request->categoryId)->pluck('name', 'id');
        return json_encode($brand);

    }

    public function getCategoryAttributes() {
        $cat_id               = \Request::get('category_id');
        $data[ 'attributes' ] = $this->storeAdminRepository->getCategoryAttributes($cat_id);

        return response()->json($data);
    }

    public function addOpeningStock(Request $request) {
        $this->validate($request, [
            'products' => 'required'
        ]);

        return $this->storeAdminRepository->addOpeningStock($this->user_id, $request->all());
    }

    public function deleteKeeping(Request $request) {
        $this->validate($request, [
            'id' => 'required'
        ]);
        return $this->storeAdminRepository->deleteKeeping($this->user_id, $request->get('id'));
    }

    public function updatePrice(Request $request) {
        $this->validate($request, [
            'price'      => 'required',
            'start_date' => 'required',
            'keeping_id' => 'required',
        ]);

        /* if($request->get('start_date') < Carbon::now()->format('d-m-Y')){
             return new JsonResponse('Start date must not be smaller than current date!', 401);
         }*/
        return $this->storeAdminRepository->updatePrice($this->user_id, $request->all());
    }

    public function getVariations(Request $request) {
        $this->validate($request, [
            'product_id' => 'required',
        ]);

        return $this->storeAdminRepository->getProductVariations($this->user_id, $request->all());
    }
}

