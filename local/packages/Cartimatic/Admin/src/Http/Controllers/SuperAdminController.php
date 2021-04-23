<?php

namespace Cartimatic\Admin\Http\Controllers;

use Cartimatic\Admin\Repositories\SuperAdminRepository;
use App\User;
use Auth;
use Cartimatic\Admin\Traits\Cropper;
use DB;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Cartimatic\Store\Category;
use Cartimatic\Store\StoreClaim;
use Cartimatic\Store\StoreClaimFeeTransaction;
use Cartimatic\Store\StoreDispute;
use Cartimatic\Store\StoreOrder;
use Cartimatic\Store\StoreProduct;
use Cartimatic\Store\StoreReversal;
use Cartimatic\Store\StoreTransaction;
use stdClass;

class SuperAdminController extends Controller
{
    use Cropper;
    protected $adminData;
    /**
     * @var SuperAdminRepository
     */
    private $superAdminRepository;

    /**
     * SuperAdminController constructor.
     */
    public function __construct(SuperAdminRepository $superAdminRepository) {
        $this->adminData                 = $data = new StdClass();
        $this->adminData->title          = "Dashboard - Super Admin";
        $this->superAdminRepository = $superAdminRepository;
        $this->user_id = Auth::id();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $sales[] = \Config::get('constants_brandstore.STATEMENT_TYPES.SALE');
        $sales[] = \Config::get('constants_brandstore.STATEMENT_TYPES.ORDER_SHIPPING_FEE');
        $sales[] =\Config::get('constants_brandstore.STATEMENT_TYPES.DISPUTE_PARTIAL_TRANSFER');
        $data['totalSaleSum']     = StoreTransaction::whereIn('type',$sales)->sum( 'amount' );
        $data['totalWithdrawSum'] = StoreTransaction::where('type',\Config::get('constants_brandstore.STATEMENT_TYPES.WITHDRAW'))->sum( 'amount' );

        $data['totalDisputeFees'] =  StoreClaimFeeTransaction::sum('amount');
        $withdrawal_fee = \Config::get('constants_brandstore.STATEMENT_TYPES.WITHDRAW_FEE');
        $data['withdrawalFees'] = StoreTransaction::where('type',$withdrawal_fee)->sum('amount');

        $data['totalReversals'] = StoreReversal::sum('amount');

        $data['totalBrandsCount'] = User::where( 'user_type', '=', \Config::get('constants.BRAND_USER') )->count();
        $data['totalConsumersCount'] = User::where( 'user_type', '=', \Config::get('constants.REGULAR_USER'))->count();
        $data['totalProductsCount'] = StoreProduct::count();

        // <editor-fold desc="Claims">
        $data['openClaimsCount']  = StoreClaim::
        where('status', '=', \Config::get('admin_constants.CLAIM_STATUS.NOT_ASSIGNED'))
            ->orWhere('status', '=', \Config::get('admin_constants.CLAIM_STATUS.ASSIGNED'))
            ->count();

        $data['resolvedClaimsCount']  = StoreClaim::
        where('status', '=', \Config::get('admin_constants.CLAIM_STATUS.RESOLVED'))
            ->count();
        // </editor-fold>

        // <editor-fold desc="Disputes">
        $data['openDisputeCount']  = StoreDispute::
        where('status', '!=', \Config::get('constants_brandstore.DISPUTE_STATUS.RESOLVED'))
            ->where('status', '!=', \Config::get('constants_brandstore.DISPUTE_STATUS.DISPUTE_CANCELLED_BUYER'))
            ->orWhere('status' , NULL)
            ->count();

        $data['acceptedDisputeCount']  = StoreDispute::
        where('status', \Config::get('constants_brandstore.DISPUTE_STATUS.DISPUTE_ACCEPTED'))
            ->count();

        $data['rejectedDisputeCount']  = StoreDispute::
        where('status', \Config::get('constants_brandstore.DISPUTE_STATUS.DISPUTE_CANCELLED_SELLER'))
            ->count();


        // </editor-fold>

        // <editor-fold desc="Top Ten Brands">

        $topTenBrands = StoreOrder::select('seller_id')->get();

        $topTenBrandsInfoIds = [];
        foreach($topTenBrands as $topTenBrandsOrders){
            if(isset($topTenBrandsInfo[$topTenBrandsOrders->seller_id])){
                $topTenBrandsInfoIds[$topTenBrandsOrders->seller_id] = $topTenBrandsInfoIds[$topTenBrandsOrders->seller_id] + 1;
            }else{
                $topTenBrandsInfoIds[$topTenBrandsOrders->seller_id] = 1;
            }
        }

        $data['topTenBrandsInfo'] = [];
        $topTenBrandsCount =0;

        foreach($topTenBrandsInfoIds as $key => $orderCount){
            $topTenBrandsCount++;

            if($topTenBrandsCount > 10){break;}

            $userInfo = getUserEmailAndUsername($key);

            if(isset($userInfo->email) AND isset($userInfo->username)){
                array_push($data['topTenBrandsInfo'], ucfirst($userInfo->username)."+_+".$userInfo->email);
            }
        }

        $data['allCategoriesTree'] = $cats = $this->categoryParentChildTree();

        $data['topTenBrands'] = $data['topTenBrandsInfo'];
        // </editor-fold>

        return view( "Admin::dashboard", $data )->with( 'title', 'Admin - Dashboard' );
        /*$this->data->members_count = $this->superAdminRepository->members_count();
        $this->data->brands_count  = $this->superAdminRepository->type_count(\Config::get('constants.BRAND_USER'));
        $this->data->users_count   = $this->superAdminRepository->type_count(\Config::get('constants.REGULAR_USER'));
        $this->data->login_count   = $this->superAdminRepository->all_login();
        $this->data->today_login   = $this->superAdminRepository->today_login();
        echo '<tt><pre>';
        print_r($this->data);
        die;*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategories($message = NULL) {

        $user_id = $this->user_id;
        $data['allCategories']     = $this->superAdminRepository->get_category($user_id);
        $data['allCategoriesTree'] = $cats = $this->categoryParentChildTree();

        $data['allCategoriesList']    = $this->superAdminRepository->getOnlyParentCategoriesList($user_id);

        return view('Admin::Category.categories', $data);

    }
    public function storeCategories(Request $request) {
        $category_name = $request->name;
        $user_id = $this->user_id;

        $existingCategoryName = $this->superAdminRepository->existingCategory($category_name, $user_id);
        if ($existingCategoryName == true) {
            return redirect()->back()->with('data', ['info' => 'Subcategory or Category already exist try another one..']);
        } else {
            $this->superAdminRepository->store_category($request);
            return redirect()->back()->with(
              "info", "Successfully Add Category"
              );
        }

    }

    public function updateCategoriesImage() {
        $data = $this->upload_image();
        $user_id        = Input::get('itemId');
        $imageUpdate    = $this->superAdminRepository->updateMainCategoryImage($data['image_path'],$user_id );

        return $data;

    }

    public function editCategory(Request $request) {
        $name        = Input::get('edited_name');
        $category_id = $request->category_id;

        //  $owner_id = $this->storeAdminRepository->getCatOwnerId($category_id);
        if ($this->superAdminRepository->is_category_owner($category_id)) {
            $this->superAdminRepository->editCat($name, $category_id);

            return redirect('admin/categories')->with('data' , ['info' => 'Update Category Successfully..']);

        }

        return redirect('admin/categories');
    }

    public function upload_image() {

        $data = $this->crop('admin_main_categories');

        $data['image_path'] = $data[ 'result' ];

        $data[ 'result' ] = url('photo/' . $data[ 'result' ]);
        return $data;
    }

    public function deleteCategory(Request $request) {

        $category_id = $request->category_id;

        if ($this->superAdminRepository->is_category_owner($category_id)) {
            $this->superAdminRepository->deleteCategory($category_id);

           // return redirect('admin/categories');
            return redirect()->back();

        }

        return redirect('admin/categories')->with("info", "Oops Category Successfully Delete");;
    }
    public function getSubCategory( $message = NULL) {

        $user_id = $this->user_id;

        $previousAddedMainCategoryId = explode('_', $message);
        if (isset($previousAddedMainCategoryId[1])) {
            $previousAddedMainCategoryId = $previousAddedMainCategoryId[1];
        } else {
            $previousAddedMainCategoryId = 0;
        }

        $data['previousAddedMainCategoryId'] = $previousAddedMainCategoryId;


        $data['allSubCategories'] = $this->superAdminRepository->getSubCategories($user_id);
        $data['allCategories']    = $this->superAdminRepository->getCategoriesList($user_id);

        if ($data != 0) {
            return view('Admin::Category.subCategories', $data);
        }

        return redirect()->back();

        //return view('Admin::Category.subCategories', $data);

    }
    public function getSubCategoriesAjax() {

        $sub_category = Input::get('sub_category');
        $id           = $this->user_id;
        $data         = $this->superAdminRepository->getSubCategoriesAjaxById($id, $sub_category);

        return $data;
    }

    public function getCategoriesAjaxly(Request $request)
    {
        $parent_id = $request->parent_id;
        return $data         = $this->superAdminRepository->getCategoriesAjaxById($parent_id);
    }

    public function storeSubCategories(Request $request) {

        $sub_cat_name = $request->sub_cate;
        $user_id = $this->user_id;
        $existingSubCategoryName = $this->superAdminRepository->existingCategory($sub_cat_name, $user_id);
    if ($existingSubCategoryName == true) {
        return redirect('admin/subCategory/Not-Found')->with('data', ['info' => 'Subcategory or Category already exist try another one.']);
    } else {
        $this->superAdminRepository->store_sub_category($request);

        return redirect('admin/subCategory/' . $request->category_parent_id)
            ->with('data', ['info' => 'Record Saved Successfully.']);

    }

}

    public function storeMainSubCategories(Request $request , $Parent_id) {
        $sub_cat_name = $request->sub_cate;
        $user_id = $this->user_id;
        $existingSubCategoryName = $this->superAdminRepository->existingCategory($sub_cat_name, $user_id);
        if ($existingSubCategoryName == true) {
            return redirect()->back()->with('data', ['info' => 'Subcategory or Category already exist try another one..']);
        } else {

            $category_id = $this->superAdminRepository->storeSubMainCategory($request,$Parent_id);

            $category = $this->superAdminRepository->getSingleCategory($category_id);

            return redirect()->back()->with(
              "data", ['info' => "Successfully Add Sub Category", 'category_id' => $category->id,  'category_parent' => $category->category_parent_id]);

        }

    }
    public function deleteSubCat(Request $request) {

        $Subcategory_id = Input::get('subCategoriesId');

        $this->superAdminRepository->is_category_owner( $Subcategory_id );
          $this->superAdminRepository->deleteSubCategory( $Subcategory_id );

            return 1;


    }
    public function updateSubCategory(Request $request) {

        $sub_category_id = $request->su_cat_id_update;
        $name        = $request->sub_cate;

        // $owner_id = $this->storeAdminRepository->getCatOwnerId($category_id);
        if ($this->superAdminRepository->is_category_owner($sub_category_id)) {
            $this->superAdminRepository->updateSubCat($name, $sub_category_id);


            return redirect()->back()->with('data', ['info' => 'Record Updated Successfully..']);


        }

        return redirect('admin/subCategory') ->with('data', ['info' => 'Record Not Updated..']);
    }




    public function editSubCategory(Request $request) {

        $category_id = $request->category_id;
        $name        = Input::get('edited_name');

        $parent_id = Input::get('category_parent_id');

        // $owner_id = $this->storeAdminRepository->getCatOwnerId($category_id);
        if ($this->superAdminRepository->is_category_owner($category_id)) {
            $this->superAdminRepository->editSubCat($name, $category_id, $parent_id);


            return redirect('admin/subCategory') ->with('data', ['info' => 'Record Updated Successfully.']);


        }

        return redirect('admin/subCategory') ->with('data', ['info' => 'Record Not Updated..']);
    }


    public function deleteSubCategory(Request $request) {

        $category_id = $request->category_id;

        if ($this->superAdminRepository->is_category_owner($category_id)) {
            $this->superAdminRepository->deleteCategory($category_id);

            return redirect('admin/subCategory/Deleted')->with('data', ['info' => 'Subcategory delete Successfully.']);

        }

        return redirect('admin/subCategory/Not-Deleted')->with('data', ['info' => 'Subcategory not delete Successfully.']);
    }

    public function checkIfAlreadySubCatAjax(Request $request)
    {
        return $this->superAdminRepository->getSameNameSubCategory( $request->owner_id, $request->category_id, $request->subcategory_name );
    }
    public function create() {
        //
    }
    public function storeSubCat(Request $request) {
        $sub_cat_name = $request->sub_cate;
        $user_id = $this->user_id;
        $existingSubCategoryName = $this->superAdminRepository->existingCategory($sub_cat_name, $user_id);
        if ($existingSubCategoryName) {
            return redirect()->back()->with('data', ['info' => 'Subcategory or Category already exist try another one..']);
        } else {
            $category_id = $this->superAdminRepository->store_sub_category($request);
            $category = $this->superAdminRepository->getSingleCategory($category_id);
            $breadCrumbsCats = getBreadCrumbsBySubCategoryId($category->id);
            $breadCrumbsCats = array_reverse($breadCrumbsCats);

            return redirect()->back()->with(
              "data", ['info' => "Successfully Add Sub Category", 'category_id' => $category->id,  'category_parent' => $breadCrumbsCats[0]['id']]);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    function categoryParentChildTree($parent = 0, $spacing = '', $category_tree_array = '') {
        if (!is_array($category_tree_array))
            $category_tree_array = array();

        $resCategories = $this->superAdminRepository->getParentChildCategories($parent);

        if (count($resCategories) > 0) {
            foreach($resCategories as $rowCategory) {
                $category_tree_array[] = array("id" => $rowCategory['id'], "name" => $spacing . $rowCategory['name']);

                $category_tree_array = $this->categoryParentChildTree($rowCategory['id'], '&nbsp;&nbsp;&nbsp;&nbsp;'.$spacing . '-&nbsp;', $category_tree_array);
            }
        }
        return $category_tree_array;
    }
}
