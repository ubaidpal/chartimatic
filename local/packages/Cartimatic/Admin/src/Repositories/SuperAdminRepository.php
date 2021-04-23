<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : kinnect2
 * Product Name : PhpStorm
 * Date         : 09-Mar-2016 8:21 PM
 * File Name    : SuperAdminRepository.php
 */

namespace Cartimatic\Admin\Repositories;


use App\User;
use Auth;
use Carbon\Carbon;

use Cartimatic\Store\Category;
use DB;
use Cartimatic\Store\StoreProduct;
use Vinkla\Hashids\Facades\Hashids;

class SuperAdminRepository
{
    public function __construct() {

    }

    public function members_count() {
        return User::where('user_type', \Config::get('constants.REGULAR_USER'))->orWhere('user_type', \Config::get('constants.BRAND_USER'))->count();
    }

    public function type_count($type) {
        return User::where('user_type',$type)->count();
    }

    public function all_login() {
        return User::sum('login_counter');
    }

    public function today_login() {
        return User::where('lastlogin_date', '>=', \Carbon\Carbon::now()->format('Y-m-d'))
                            ->groupBy('date')
            ->orderBy('date', 'DESC')
            ->first(array(
                \DB::raw('Date(lastlogin_date) as date'),
                \DB::raw('COUNT(*) as "login"')
            ))->login;
    }


    public function get_category($id) {
        $categories = Category::where('category_parent_id', 0)->where('owner_id', $id)->get();

        if (count($categories) > 0) {
            return $categories;
        } else {
            return 0;
        }
    }

    public function existingCategory( $cat_name, $user_id ) {

        $existing = Category::where('name', $cat_name)->count();

        if($existing > 0){
            return true;
        }

        return false;
    }

    public function getSingleCategory( $id ) {

        $cat = Category::where('id', $id)->first();

        if(isset($cat->id)){
            return $cat;
        }

        return false;
    }


    public function store_category($request) {
        $newCategory = new Category();
        $category_slug = \Kinnect2::slugify($request->name, ['table' => 'store_product_categories', 'field' => 'slug']);

        $newCategory->name     = $request->name;
        $newCategory->slug     = $category_slug;
        $newCategory->category_image     = $request->category_image;
        $newCategory->category_icon_url     = $request->category_icon_url;
        $newCategory->owner_id = Auth::user()->id;

        if ($newCategory->save()) {
            return $newCategory->id;
        }

        return 0;
    }

    public function updateMainCategoryImage($category_image,$cat_id) {

       $imageUpdate = Category::find($cat_id);
        $imageUpdate->category_image = $category_image;
        if ($imageUpdate->save()) {
            return $imageUpdate->id;
        }

        return 0;
    }
    public function is_category_owner($category_id) {
        $category = Category::find($category_id);

        if (isset($category->id)) {
            if ($category->owner_id == Auth::user()->id) {
                return $category->id;
            }
        } else {
            return NULL;
        }
    }
    public function editCat( $name, $category_id ) {
        $category             = Category::where( 'id', $category_id )->first();
        $category->name       = $name;
        $category->updated_at = Carbon::now();
        $category->save();
    }
    public function deleteCategory($category_id) {
        StoreProduct::where('sub_category_id', $category_id)->delete();
        StoreProduct::where('category_id', $category_id)->delete();
        Category::where('category_parent_id', $category_id)->delete();
        Category::where('id', $category_id)->delete();
    }
    public function deleteSubCategory($category_id) {
       Category::where('id', $category_id)->delete();
        Category::where('category_parent_id', $category_id)->delete();
    }

    public function getCategoriesAjaxById($parent_id) {
        return $allSubCategories = Category::select('id', 'name')
                            ->where( 'category_parent_id', '=', $parent_id )
                            ->get();
    }

    public function getSubCategoriesAjaxById( $id,$sub_category) {

        $allSubCategories = Category::where( 'category_parent_id', '=', $sub_category )->where( 'owner_id', $id )->get();
        $allCategories = Category::where( 'category_parent_id', '=', 0 )->where( 'owner_id', $id )->lists('name', 'id');

        $html ='';
        foreach($allSubCategories as $Subcategory):
            if(!isset($Subcategory->id)){continue;}
            $html .= '<div class="categoryList" id="categoryList">
    <div>'.$Subcategory->name.'</div>';

            $html .= '<div class="actW">
            <a class="js-open-modal" data-modal-id="popup1-'.$Subcategory->id.'" title="Edit '.$Subcategory->name.'">
                <span class="editProduct ml20 mr20"></span>
            </a>
            <a class="js-open-modal" data-modal-id="popup2-'.$Subcategory->id.'" title="Delete '.$Subcategory->name.'" href="#">
                <span class="deleteProduct"></span>
            </a>
        </div>
        </div>';

            $html .= '
<form method="POST" action="'.url("admin/edit/Subcategories/".$Subcategory->id).'" accept-charset="UTF-8">
        <div class="modal-box" id="popup1-'.$Subcategory->id.'" style="top: 128.333px; left: 770.5px; display: none;">
         <a href="#" class="js-modal-close close fltR">�</a>
             <div class="modal-body">
                 <div class="edit-photo-poup ">
                     <h3 style="color: #0080e8">Edit Category</h3>
                         <div class="m0">';
            $html .='<div class="mb10">
                                         '.\Form::select('category_parent_id', $allCategories, $Subcategory->category_parent_id, ['id'=>'select1' ,
                                                                                                                                 'class' => 'selectList m0',
                                                                                                                                 'type' => 'required']).'
                                    </div>';
            $html .='</div>
                     <h3 style="color: #0080e8" class="mt10">Subcategory Name:</h3>
                     <input required="required" type="text" name="edited_name" value="'.$Subcategory->name.'" placeholder="" style="width:300px" class="storeInput">
                         <div class="form-container mt10">
                                 <div class="saveArea">
                                    '.\Form::submit('Update', ['class' => 'btn blue fltL']) .'
                                 </form>
                                 </div>
                         </div>
                 </div>
             </div>
         </div>
    </div>';
            $html .= '<form method="Get" action="'. url( "admin/delete/Subcategories/".$Subcategory->id ) . '" accept-charset="UTF-8">
<div class="modal-box" id="popup2-'. $Subcategory->id.'" style="top: 128.333px; left: 770.5px; display: none;">
         <a href="#" class="js-modal-close close fltR">�</a>
         <div class="modal-body">
             <div class="edit-photo-poup">
                         <h3 style="color: #0080e8">Delete Category</h3>
                         <p class="mt10" style="width: 315px;line-height: normal">Are You Sure You Want To delete This Sub-category? All the Sub-categories and products will also be deleted</p>
                         <div class="m0">
                                <div class="wall-photos">
                                     <div class="photoDetail">
                                         <div class="form-container">
                                             <div class="saveArea">
                                              ' . \Form::submit( 'Delete', [ 'class' => 'btn fltL blue mr10' ] ) . '
                                              ' . \Form::submit( 'Cancel', [ 'class' => 'btn blue js-modal-close fltL close' ] ) . '
                                               </form>
                                             </div>
                                         </div>
                                     </div>
                                </div>
                         </div>
                  </div>
            </div>
         </div>';
        endforeach;

        return $html;
    }
    public function getSubCategories( $id ) {
        $allSubCategories = Category::where( 'category_parent_id', '!=', 0 )->where( 'owner_id', $id )->get();

        return $allSubCategories;
    }
    public function getCategoriesList($id) {

        $categoriesSelect = ['0' => 'Select Category *'];
        $categories       = DB::table('store_product_categories')
                            //->where('category_parent_id', 0)
                            ->where('owner_id', $id)
                            ->where('deleted_at', '=', null)
                            ->lists('name', 'id');

        if (count($categories) > 0) {
            $categories       = $categoriesSelect + $categories;
            return $categories;
        } else {
            return 0;
        }

    }

    public function getOnlyParentCategoriesList($id) {

        $categoriesSelect = ['0' => 'Select Category *'];
        $categories       = DB::table('store_product_categories')
            //->where('category_parent_id', 0)
                              ->where('owner_id', $id)
                              ->where('category_parent_id', 0)
                              ->where('deleted_at', '=', null)
                              ->lists('name', 'id');

        if (count($categories) > 0) {
            $categories       = $categoriesSelect + $categories;
            return $categories;
        } else {
            return 0;
        }

    }
    public function store_sub_category( $request ) {

        $newSubCategory = new Category();
        $category_slug = \Kinnect2::slugify($request->sub_cate, ['table' => 'store_product_categories', 'field' => 'slug']);

        $newSubCategory->name     = $request->sub_cate;
        $newSubCategory->slug     = $category_slug;
        $newSubCategory->owner_id = Auth::user()->id;
        if ( $request->su_cat_id == 0 ) {
            return false;
        }
        $newSubCategory->category_parent_id =$request->su_cat_id;

        if ( $newSubCategory->save() ) {
            return $newSubCategory->id;

        }

        return 0;
    }

    public function storeSubMainCategory( $request ,$Parent_id) {

        $newSubCategory = new Category();

        $category_slug = \Kinnect2::slugify($request->sub_cate, ['table' => 'store_product_categories', 'field' => 'slug']);

        $newSubCategory->name     = $request->sub_cate;
        $newSubCategory->slug     = $category_slug;
        $newSubCategory->owner_id = Auth::user()->id;
        if ( $Parent_id == 0 ) {
            return false;
        }
        $newSubCategory->category_parent_id = $Parent_id;

        if ( $newSubCategory->save() ) {
            return $newSubCategory->id;

        }

        return 0;
    }

    public function editSubCat( $name, $category_id, $parent_id ) {
        $category                     = Category::where( 'id', $category_id )->first();
        $category->name               = $name;
        $category->category_parent_id = $parent_id;
        $category->updated_at         = Carbon::now();
        $category->save();
    }

    public function updateSubCat( $name, $sub_category_id) {
        $category                     = Category::where( 'id', $sub_category_id )->first();
        $category->name               = $name;
        $category->updated_at         = Carbon::now();
        $category->save();
    }


    public function getSameNameSubCategory( $owner_id, $category_id, $subcategory_name ) {
        $sub_categories = Category::where( 'category_parent_id', $category_id )
                                  ->where( 'name', '=', $subcategory_name)
                                  ->where( 'owner_id', $owner_id)
                                  ->get();

        if ( count( $sub_categories ) > 0 ) {
            return 1;
        } else {
            return 0;
        }
    }

    public function getParentChildCategories($parent)
    {
        return $sub_categories = Category::select('id', 'name', 'category_parent_id')
            ->where( 'category_parent_id', $parent)
            ->orderBy('id', 'ASC')
            ->get();
    }
}
