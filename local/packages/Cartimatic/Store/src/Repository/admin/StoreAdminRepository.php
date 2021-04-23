<?php

namespace Cartimatic\Store\Repository\admin;

use App\CalenderSeason;
use App\Country;
use App\LifeType;
use App\ProductGender;
use App\StorageFile;
use App\Unit;
use App\User;
use App\ValueAddition;
use Auth;
use Carbon\Carbon;
use Cartimatic\Admin\Http\StoreAttributeValue;
use Cartimatic\Admin\Http\StoreCategoryAttribute;
use Cartimatic\Admin\Http\TaxCategory;
use Cartimatic\Shop\Http\Models\Shop;
use Cartimatic\Store\Category;
use Cartimatic\Store\DeliveryCourier;
use Cartimatic\Store\ProductFavorites;
use Cartimatic\Store\Repository\StoreRepository;
use Cartimatic\Store\Scopes\IsDraftScope;
use Cartimatic\Store\StoreBrand;
use Cartimatic\Store\StoreGrn;
use Cartimatic\Store\StoreGrnProduct;
use Cartimatic\Store\StoreOrder;
use Cartimatic\Store\StoreOrderItems;
use Cartimatic\Store\StoreProduct;
use Cartimatic\Store\StoreProductAttribute;
use Cartimatic\Store\StoreProductAttributeValue;
use Cartimatic\Store\StoreProductFeature;
use Cartimatic\Store\StoreProductKeeping;
use Cartimatic\Store\StoreProductKeepingLog;
use Cartimatic\Store\StoreProductPriceLog;
use Cartimatic\Store\StoreProductReview;
use Cartimatic\Store\StoreProductSearch;
use Cartimatic\Store\StoreRequest;
use Cartimatic\Store\StoreShippingCost;
use Cartimatic\Store\StoreShippingCountries;
use Cartimatic\Store\StoreShippingCountry;
use Cartimatic\Store\StoreShippingRegion;
use Cartimatic\Store\StoreStorageFiles;
use Cartimatic\Store\StoreSupplier;
use Cartimatic\Store\StoreTransaction;
use DB;
use Form;
use Illuminate\Http\JsonResponse;
use Image;
use Input;
use Vinkla\Hashids\Facades\Hashids;

class StoreAdminRepository
{
    protected $store;

    protected $data;

    /**
     * @param $category_id
     *
     * @return null
     */
    public function is_category_owner($category_id, $user_id = 0) {
        $category = Category::find($category_id);

        if(isset($category->id)) {
            if($category->owner_id == $user_id) {
                return $category->id;
            }
        } else {
            return NULL;
        }
    }

    /**
     * @param $category_id
     */
    public function deleteCategory($category_id) {
        StoreProduct::where('sub_category_id', $category_id)->delete();
        StoreProduct::where('category_id', $category_id)->delete();
        Category::where('category_parent_id', $category_id)->delete();
        Category::where('id', $category_id)->delete();
    }

    public function searchFeedBack($search, $user_id) {
        $getFeedBack = StoreProductReview::where('owner_id', $user_id)
                                         ->where('description', 'LIKE', '%' . $search . '%')
                                         ->get();

        $html = '';

        foreach ($getFeedBack as $getFeedBacks):
            $html .= '<tr>';
            $html .= '<td> <a href="">
                     <img src="' . getImage('') . '"
                     class="thumbnail img-responsive">
                     </a></td>';
            $html .= '<td>' . $getFeedBacks->description . '</td>';
            $html .= '<td><a style="cursor:pointer;" data-toggle="confirmation" data-href="' . url('store/' . Auth::user()->username . '/admin/delete/feedback/' . $getFeedBacks->id) . '" id=' . $getFeedBacks->id . ' class="deleteProduct">Delete</a></td>';
            $html .= '</tr>';

        endforeach;
        return $html;
    }

    /**
     * @param $request
     *
     * @return int
     */
    public function store_category($request) {
        $newCategory = new Category();

        $category_slug = \Kinnect2::slugify($request->input('name'), ['table' => 'store_category', 'field' => 'name']);

        $newCategory->name     = $request->name;
        $newCategory->owner_id = Auth::user()->id;

        if($newCategory->save()) {
            return $newCategory->id;
        }

        return 0;
    }

    /**
     * @param $id
     *
     * @return int
     */
    public function get_category($id) {
        $categories = Category::where('category_parent_id', 0)->where('owner_id', $id)->get();

        if(count($categories) > 0) {
            return $categories;
        } else {
            return 0;
        }
    }

    /**
     * @param $id
     *
     * @return int
     */
    public function getAdvanceSearchCategories($id) {
        $catIds     = StoreProduct::where('owner_id', $id)->lists('category_id');
        $categories = Category::whereIn('id', $catIds)->select('name', 'id')->get();

        if(count($categories) > 0) {
            return $categories;
        } else {
            return 0;
        }
    }

    /**
     * @param $id
     *
     * @return int
     */
    public function getAdvanceSearchBrands($id) {
        $brandIds = StoreProduct::where('owner_id', $id)->lists('brand_id');
        $brands   = StoreBrand::where('is_deleted', 0)->whereIn('id', $brandIds)->select(['name', 'id'])->get();

        if(count($brands) > 0) {
            return $brands;
        } else {
            return 0;
        }
    }

    /**
     * @param $id
     *
     * @return int
     */
    public function getAdvanceSearchSuppliers($id) {
        $supplierIds = StoreProduct::where('owner_id', $id)->lists('supplier_id');
        $suppliers   = StoreSupplier::where('is_deleted', 0)->whereIn('id', $supplierIds)->select(['name', 'id'])->get();

        if(count($suppliers) > 0) {
            return $suppliers;
        } else {
            return 0;
        }
    }

    /**
     * @param $id
     *
     * @return int
     */
    public function getAdvancedSearchVariants($categories) {
        $catIds = array_column($categories->toArray(), 'id');

        $variants = StoreCategoryAttribute::whereIn('category_id', $catIds)->with('attribute')->with('attributeValues')->get()->toArray();

        $attributes = [];
        foreach ($variants as $j => $variant) {
            foreach ($variant[ 'attribute_values' ] as $l => $value) {
                $attributes[] = ['id' => $value[ 'id' ], 'attribute' => $variant[ 'attribute' ][ 'label' ] . ': ' . $value[ 'value' ]];
            }
        }

        if(count($attributes) > 0) {
            return $attributes;
        } else {
            return 0;
        }
    }

    /**
     * @param $id
     *
     * @return int
     */
    public function getCategoriesList($id) {

        $categoriesSelect = ['0' => 'Select Category *'];
        $categories       = DB::table('store_product_categories')->where('category_parent_id', 0)
                              ->where('owner_id', $id)
                              ->where('deleted_at', '=', NULL)
                              ->lists('name', 'id');

        if(count($categories) > 0) {
            $categories = $categoriesSelect + $categories;
            return $categories;
        } else {
            return 0;
        }

//        $categories = Category::where('category_parent_id', 0)->where('owner_id', $id)->lists('name', 'id');
//        if (count($categories) > 0) {
//            return $categories ;
//        } else {
//            return 0;
//        }
    }
    // ==================== Ubaid code ============================

    /**
     * @param $product_id
     *
     * @return int
     */
    public function getStoreProductKeyFeature($product_id) {

        $feature = DB::table('store_product_features')
                     ->where('pr_id', $product_id)
                     ->where('is_deleted', 0)
                     ->where('key_feature_type', 1)
                     ->get();
        if(count($feature) > 0) {
            return $feature;
        } else {
            return 0;
        }
    }

    public function getStoreImagePath($product_id) {

        $Product_Image = DB::table('store_product_images')
                           ->where('product_id', $product_id)
                           ->get();
        if(count($Product_Image) > 0) {
            return $Product_Image;
        } else {
            return 0;
        }
    }

    public function getStoreProductTechSpec($product_id) {

        $feature = DB::table('store_product_features')
                     ->where('pr_id', $product_id)
                     ->where('is_deleted', 0)
                     ->where('key_feature_type', 2)
                     ->get();
        if(count($feature) > 0) {
            return $feature;
        } else {
            return 0;
        }
    }

    /**
     * @param $product_id
     *
     * @return int
     */
    public function getStoreProductAttributes($product_id) {

        $attributes = DB::table('store_product_attributes')
                        ->where('is_deleted', 0)
                        ->where('product_id', $product_id)
                        ->get();

        if(count($attributes) > 0) {
            return $attributes;
        } else {
            return 0;
        }
    }

    /**
     * @param $id
     *
     * @return array|int
     */
    public function getAllCategories($id) {
        //if (Auth::user()->id == $id) {
        $categoriesSelect = ['0' => 'Select Category *'];
        $categories       = DB::table('store_product_categories')
                              ->where('category_parent_id', 0)
            //->where('owner_id', $id)
                              ->where('deleted_at', '=', NULL)
                              ->lists('name', 'id');

//			$categories = array_merge($categoriesSelect, $categories); //This will re-Adjust ids of option in select html tag
        $categories = $categoriesSelect + $categories;

        return $categories;
        //}

        // return 0;
    }

    /**
     * @param $request
     *
     * @return int
     */
    public function addProduct($request) {

        $product                  = new StoreProduct();
        $product->title           = $request->title;
        $product->length          = $request->length;
        $product->width           = $request->width;
        $product->height          = $request->height;
        $product->weight          = $request->weight;
        $product->price           = $request->price;
        $product->discount        = $request->discount;
        $product->quantity        = $request->quantity;
        $product->description     = $request->description;
        $product->category_id     = $request->category;
        $product->sub_category_id = $request->sub_category;
        $product->is_featured     = !empty($request->is_featured) ? 1 : 0;
        $product->owner_id        = Auth::user()->id;

        $product->save();

        $product_features_title  = $request->get('featuretitle');
        $product_features_detail = $request->get('keyfeaturedetail');

        if(!empty($product_features_title)) {
            foreach ($product_features_title as $key => $feature) {
                if(empty($product_features_title[ $key ]) || empty($product_features_detail[ $key ])) {
                    continue;
                }
                DB::table('store_product_features')->insert([
                    'pr_id'            => $product->id,
                    'title'            => $product_features_title[ $key ],
                    'detail'           => $product_features_detail[ $key ],
                    'key_feature_type' => 1,
                ]);
            }
        }

        $product_tech_title  = $request->get('techtitle');
        $product_tech_detail = $request->get('techspecs');

        if(!empty($product_tech_title)) {
            foreach ($product_tech_title as $key => $feature) {
                if(empty($product_tech_title[ $key ]) || empty($product_tech_detail[ $key ])) {
                    continue;
                }
                DB::table('store_product_features')->insert([
                    'pr_id'            => $product->id,
                    'title'            => $product_tech_title[ $key ],
                    'detail'           => $product_tech_detail[ $key ],
                    'key_feature_type' => 2,
                ]);
            }
        }

        $product_colors_title  = $request->get('colortitle');
        $product_colors_detail = $request->get('colordetail');

        if(!empty($product_colors_title)) {

            foreach ($product_colors_title as $key => $feature) {
                if(empty($product_colors_title[ $key ]) || empty($product_colors_detail[ $key ])) {
                    continue;
                }
                DB::table('store_product_attributes')->insert([
                    'product_id' => $product->id,
                    'attribute'  => $product_colors_title[ $key ],
                    'value'      => $product_colors_detail[ $key ],
                ]);
            }
        }

        $product_sizes_title  = $request->get('sizetitle');
        $product_sizes_detail = $request->get('sizedetail');

        if(!empty($product_sizes_title)) {
            foreach ($product_sizes_title as $key => $feature) {
                if(empty($product_sizes_title[ $key ]) || empty($product_sizes_detail[ $key ])) {
                    continue;
                }
                DB::table('store_product_attributes')->insert([
                    'product_id' => $product->id,
                    'attribute'  => $product_sizes_title[ $key ],
                    'value'      => $product_sizes_detail[ $key ],
                ]);
            }
        }

        if(isset($product->id)) {
            //Update images records
            // Create album for product

            // $album              = new Album();
//            $album = new StoreAlbums();
//
//            $album->title       = 'Product Album';
//            $album->description = $product->title . "'s album'";
//            $album->owner_type  = 'product';
//            $album->owner_id    = $product->id;
//            $album->category_id = 0;
//            $album->type        = 'product-profile';
//            $album->photo_id    = 0;
//
//            $album->save();

            //end of album creation

            $fileIds = explode(",", $request->images_ids);

            foreach ($fileIds as $fileId) {
                //$file = StorageFile::where('file_id', $fileId)->first();
                $file = StoreStorageFiles::where('file_id', $fileId)->first();
                // File name (To retrieve image with correct params)
                $file_name = time() . rand(1111111111, 9999999999);

                $folder_path   = "local/storage/app/photos/" . $product->owner_id;
                $file_name_new = $product->owner_id . "_" . $file_name . "." . $file->extension;

                if(isset($file->file_id)) {

                    if(file_exists("local/storage/app/photos/" . $file->storage_path) == TRUE) {

                        if(!file_exists($folder_path)) {
                            if(!mkdir($folder_path, 0777, TRUE)) {
                                $folder_path = '';
                            }
                        }

                        rename("local/storage/app/photos/" . $file->storage_path, $folder_path . "/" . $file_name_new);
                    }

                    // Saving photos
                    //$photoObj = new AlbumPhoto();
//                    $photoObj = new StoreAlbumPhotos();
//
//                    $photoObj->owner_type = 'product';
//                    $photoObj->owner_id   = $product->id;
//                    $photoObj->file_id    = $file->file_id;
//                    $photoObj->title      = $product->title;
                    // $photoObj->album_id   = $album->album_id;

//                    if ($photoObj->save()) {
                    $file->parent_id    = $product->id;//photo_id
                    $file->user_id      = $product->owner_id;
                    $file->storage_path = $product->owner_id . "/" . $file_name_new;
                    $file->name         = $file_name;
                    $file->mime_major   = 'image';

                    $file->save();

                    $imageFilePath = $product->owner_id . "/" . $file_name_new;

                    $this->resizeProductImage($imageFilePath, $file->file_id, $file->user_id, 'product', 'product_profile', '151', '210', $product->id);
                    $this->resizeProductImage($imageFilePath, $file->file_id, $file->user_id, 'product', 'product_thumb', '170', '170', $product->id);
                    $this->resizeProductImage($imageFilePath, $file->file_id, $file->user_id, 'product', 'product_icon', '54', '80', $product->id);
//                    }
                    //End of saving photos

                }

            }

//            $options = array(
//                          'type'         => \Config::get('constants_activity.OBJECT_TYPES.PRODUCT.ACTIONS.CREATE'),
//                          'subject'      => Auth::user()->id,
//                          'subject_type' => 'user',
//                          'object'       => $product->id,
//                          'object_type'  => \Config::get('constants_activity.OBJECT_TYPES.PRODUCT.NAME'),
//                          'body'         => '{item:$subject} added new product {item:$object}',
//                      );
//            \Event::fire(new ActivityLog($options));

            return $product->id;
        }

        return 0;
    }

    /**
     * @param string $file_path
     * @param string $parent_file_id
     * @param string $owner_id
     * @param string $owner_type
     * @param string $image_size_type
     * @param string $image_height
     * @param string $image_width
     *
     * @return int
     */
    public function resizeProductImage($file_path = '', $parent_file_id = '', $owner_id = '', $owner_type = '', $image_size_type = 'NULL', $image_height = '', $image_width = '', $product_id = '') {
        //Where file exists
        $file_path = "local/storage/app/photos/" . $file_path;

        if($file_path != '' AND $parent_file_id != '') {
            //making thumbs
            // File name (To retrieve image with correct params)
            $file_name = time() . rand(111111111, 9999999999);

            //Where file is going to be saved.
            $folder_path   = "local/storage/app/photos/" . $owner_id;
            $file_name_new = $owner_id . "_" . $file_name . ".jpg";

            // <editor-fold desc="resizing product image">
            $image1 = Image::make($file_path)->encode('jpg');
            $image1->resize($image_width, $image_height);

            $file_path = $folder_path . '/' . $file_name_new;

            if($image1->save($file_path)) {
                $this->addResizePhotoInStorageFile($parent_file_id, $owner_id . '/' . $file_name_new, $file_name_new, $image_size_type, $owner_id, $owner_type, $product_id);
            } else {
                return 0;
            }
            // </editor-fold>
        }
    }

    /**
     * @param $parent_file_id
     * @param $file_path
     * @param $file_name
     * @param $image_size_type
     * @param $owner_id
     * @param $owner_type
     */
    public function addResizePhotoInStorageFile($parent_file_id, $file_path, $file_name, $image_size_type, $owner_id, $owner_type, $product_id = '') {

        // $file = new StorageFile();
        $file = new StoreStorageFiles();

        $file->parent_file_id = $parent_file_id;
        $file->type           = $image_siupdateBasicProductInfoze_type;
        $file->parent_id      = $product_id;
        $file->parent_type    = 'album_photo';
        $file->user_id        = $owner_id;
        $file->storage_path   = $file_path;
        $file->name           = $file_name;
        $file->mime_type      = 'image/jpeg';
        $file->extension      = 'jpg';
        $file->mime_major     = 'image';

        $file->save();
    }

    public function saveBasicProductInfo($request, $userId) {
        if($request->id) {
            $product = StoreProduct::whereId($request->id)->withoutGlobalScope(IsDraftScope::class)->first();
        } else {
            $product = new StoreProduct();
        }

        $product->title                 = $request->title;
        $product->overview              = $request->overview;
        $product->affiliate             = (isset($request->affiliate)) ? 1 : 0;
        $product->affiliate_reward      = (isset($request->affiliate_reward)) ? $request->affiliate_reward : 0;
        $product->description           = $request->content;
        $product->category_id           = $request->category_id;
        $product->default_variation     = !empty($request->default_variation) ? 1 : 0;
        $product->is_featured           = !empty($request->is_featured) ? 1 : 0;
        $product->owner_id              = $userId;
        $product->product_code          = $request->product_code;
        $product->supplier_id           = $request->supplier;
        $product->brand_id              = $request->brand;
        $product->line_item_id          = $request->line_item_id;
        $product->season_id             = $request->season;
        $product->product_gender_id     = $request->product_gender;
        $product->value_addition_id     = $request->value_addition;
        $product->unit_id               = $request->unit_id;
        $product->conv_factor           = $request->conv_factor;
        $product->tax_code_id           = $request->tax_code_id;
        $product->price                 = $request->price;
        $product->life_type_id          = $request->life_type;
        $product->acquire_type          = $request->acquire_type;
        $product->purchase_type         = $request->purchase_type;
        $product->age_group_id          = $request->age_group;
        $product->manufacturing         = $request->manufacturing;
        $product->alternate_code        = $request->alternate_code;
        $product->sales_tax_purchase    = $request->sales_tax_purchase;
        $product->sales_tax_purchase_at = $request->sales_tax_purchase_at;
        $product->sales_tax_sales       = $request->sales_tax_sales;
        $product->sales_tax_sales_type  = $request->sales_tax_sales_type;

        // echo \DNS1D::getBarcodeHTML("4445645656", "C128"); die;

        $product->save();
        // \DNS1D::getBarcodePNGPath($barcode_id, "C128");
        return $product->id;
    }

    public function getCategoryAttributes($catId, $is_line_item = 0) {
        if($is_line_item > 0) {
            return StoreCategoryAttribute::where('is_line_item', $is_line_item)->where('category_id', $catId)->with('attribute')->with('attributeValues')->get()->toArray();
        }
        return StoreCategoryAttribute::where('category_id', $catId)->with('attribute')->with('attributeValues')->get()->toArray();

    }

    public function getProductCategorySelectedAttributes($product_id) {
        $ids = StoreProductAttribute::where('product_id', $product_id)->where('is_deleted', 0)->lists('id');
        return StoreProductAttributeValue::whereIn('store_product_attribute_id', $ids)->lists('store_attribute_value_id', 'store_attribute_value_id');
    }

    public function updateBasicProductInfo($request, $userId) {
        $product = StoreProduct::where('id', $request->get('product_id'))
                               ->where('owner_id', $userId)
                               ->withoutGlobalScope(IsDraftScope::class)
                               ->first();

        if(!empty($product->id)) {

            $product->overview         = $request->overview;
            $product->affiliate        = (isset($request->affiliate)) ? 1 : 0;
            $product->affiliate_reward = (isset($request->affiliate_reward)) ? $request->affiliate_reward : 0;
            $product->description      = $request->content;
            $product->save();

            return $product->id;
        }
        return FALSE;

    }

    public function saveSpecifications($request) {

        $specs = [];
        $i     = 0;
        for ($i; $i < sizeof($_POST[ "detail" ]); $i++) {
            $specs[ $i ][ "detail" ]           = $_POST[ "detail" ][ $i ];
            $specs[ $i ][ "title" ]            = $_POST[ "title" ][ $i ];
            $specs[ $i ][ "key_feature_type" ] = 1;
            $specs[ $i ][ "pr_id" ]            = $_POST[ "product_id" ];
        }
        DB::table('store_product_features')->where('pr_id', '=', $_POST[ "product_id" ])->delete();
        if(sizeof($specs) > 0) {
            DB::table('store_product_features')->insert($specs);
        }

        return $specs;
    }

    public function updateSpecifications($request) {

        DB::table('store_product_features')->where('pr_id', '=', $request->is_product_id_edit)->delete();
        $specs = [];
        $i     = 0;
        for ($i; $i < sizeof($_POST[ "detail" ]); $i++) {
            $specs[ $i ][ "detail" ]           = $_POST[ "detail" ][ $i ];
            $specs[ $i ][ "title" ]            = $_POST[ "title" ][ $i ];
            $specs[ $i ][ "key_feature_type" ] = 1;
            $specs[ $i ][ "pr_id" ]            = $request->is_product_id_edit;
        }
        if(sizeof($specs) > 0) {
            DB::table('store_product_features')->insert($specs);
        }

        return $specs;

    }

    public function saveInventoryPricing($request, $store_id) {
        $data          = [];
        $i             = 0;
        $twoTimesError = FALSE;
        $allVar        = [];
        foreach ($request->get('variation') as $item) {
            $allVar[] = $item[ 'variation1' ];
            $allVar[] = $item[ 'variation2' ];
        }

        $allVar = array_unique($allVar);
        $allVar = StoreAttributeValue::whereIn('id', $allVar)->get()->keyBy('id')->toArray();

        $product = StoreProduct::where('id', $_POST[ "product_id" ])->withoutGlobalScope(IsDraftScope::class)->first();
        //DB::table('store_products_keeping')->where('product_id', '=', $_POST[ "product_id" ])->delete();
        foreach ($request->get('variation') as $row) {
            $checkIsExist = $this->CheckIfVariationSaved($row[ 'variation1' ], $row[ 'variation2' ], $request->get('product_id'));

            if(!empty($checkIsExist)) {
                $keeping = $checkIsExist;
            } else {
                $keeping = new StoreProductKeeping();
            }

            $keeping->product_id               = $request->get('product_id');
            $keeping->master_attribute_1       = $request->get('master1');
            $keeping->master_attribute_2       = $request->get('master2');
            $keeping->master_attribute_1_value = $row[ 'variation1' ];
            $keeping->master_attribute_2_value = $row[ 'variation2' ];
            if($product->default_variation == 1) {
                $veri1            = \Config::get('constants_setting.DEFAULT_ATTRIBUTES.ATTRIBUTE_1.CODE');
                $veri2            = \Config::get('constants_setting.DEFAULT_ATTRIBUTES.ATTRIBUTE_2.CODE');
                $keeping->barcode = $product->product_code . '-' . $veri1 . '-' . $veri2;
            } else {
                $keeping->barcode = $product->product_code . '-' . $allVar[ $row[ 'variation1' ] ][ 'code' ] . '-' . $allVar[ $row[ 'variation2' ] ][ 'code' ];
            }

            if($keeping->save()) {
                if(isset($row[ 'price' ])) {
                    $data = [
                        'keeping_id' => $keeping->id,
                        'product_id' => $request->get('product_id'),
                        'price'      => $row[ 'price' ],
                        'start_date' => Carbon::now()->format('Y-m-d')
                    ];
                    $this->savePriceLog($data);
                }

            };

        }
        return $data;
    }

    private function CheckIfVariationSaved($variation1, $variation2, $product_id) {
        return StoreProductKeeping::where('master_attribute_1_value', $variation1)->where('master_attribute_2_value', $variation2)->whereProductId($product_id)->first();
    }

    private function savePriceLog($data) {
        $exist = $this->checkIfDatePriceExist($data[ 'keeping_id' ], $data[ 'start_date' ]);

        if(!empty($exist)) {
            $log = $exist;
        } else {
            $log = new StoreProductPriceLog();
        }
        $log->product_id = $data[ 'product_id' ];
        $log->keeping_id = $data[ 'keeping_id' ];
        $log->price      = $data[ 'price' ];
        $log->start_date = $data[ 'start_date' ];
        $log->save();
    }

    private function checkIfDatePriceExist($id, $date) {
        return StoreProductPriceLog::where('keeping_id', $id)->where('start_date', $date)->first();
    }

    public function updateInventoryPricing($request, $store_id) {
        //DB::table('store_products_keeping')->where('product_id', '=', $request->is_product_id_edit)->update(['deleted_at' => date("Y-m-d H:i:s")]);
        foreach ($request->price as $index => $item) {
            $quantity = '';
            if(isset($request->keeping_id[ $index ])) {
                $keepingRecord = $this->getProductKeepingById($request->keeping_id[ $index ]);
                if(!empty($keepingRecord)) {

                    if($request->quantity[ $index ] > $keepingRecord->quantity) {
                        $quantity = $request->quantity[ $index ] - $keepingRecord->quantity;
                        $keepingRecord->increment('quantity', $quantity);
                        $type = 'credit';
                    } elseif($request->quantity[ $index ] < $keepingRecord->quantity) {
                        $quantity = $keepingRecord->quantity - $request->quantity[ $index ];
                        $keepingRecord->decrement('quantity', $quantity);
                        $type = 'debit';
                    }
                    $transaction_type = 'update';
                } else {
                    $quantity      = $request->quantity[ $index ];
                    $keepingRecord = new StoreProductKeeping();
                    //$keepingRecord->quantity = $request->quantity[ $index ];
                    $keepingRecord->barcode = $this->getBarcode($request->barcode[ $index ]);
                    $type                   = 'credit';
                    $transaction_type       = 'add';
                }
            } else {
                $keepingRecord = new StoreProductKeeping();
                // $keepingRecord->quantity   = $request->quantity[ $index ];
                $keepingRecord->product_id = $request->is_product_id_edit;
                $keepingRecord->barcode    = $this->getBarcode($request->barcode[ $index ]);
                $type                      = 'credit';
                $transaction_type          = 'add';
                $quantity                  = $request->quantity[ $index ];

            }

            $keepingRecord->price = $request->price[ $index ];
            //$keepingRecord->cost_price               = $request->cost_price[ $index ];
            // $keepingRecord->quantity                 = $request->quantity[ $index ];
            //$keepingRecord->stock_alert_quantity     = $request->stock_alert_quantity[ $index ];
            // $keepingRecord->optimal_quantity         = $request->optimal_quantity[ $index ];
            //$keepingRecord->custom_product_id        = $request->custom_id[ $index ];
            $keepingRecord->master_attribute_1       = $request->master1;
            $keepingRecord->master_attribute_2       = $request->master1;
            $keepingRecord->master_attribute_1_value = $request->variation1[ $index ];
            $keepingRecord->master_attribute_2_value = $request->variation2[ $index ];
            // $keepingRecord->discount                 = $request->discount[ $index ];
            //$keepingRecord->package                  = $request->package[ $index ];
            // $keepingRecord->cost_price               = $request->cost_price[ $index ];

            $keepingRecord->save();

            if(isset($type)) {
                $logData = [
                    'type'               => $type,
                    'transaction_type'   => $transaction_type,
                    'product_keeping_id' => $keepingRecord->id,
                    'product_id'         => $request->is_product_id_edit,
                    'object_type'        => 'store',
                    'object_id'          => $store_id,
                    'quantity'           => $quantity,
                    'updated_at'         => Carbon::now()
                ];
                unset($type);
                //$this->addkeepingLogById($logData);

                $exist = $this->checkIfDatePriceExist($keepingRecord->id, Carbon::now()->format('Y-m-d'));

                if(!empty($exist)) {
                    $log = $exist;
                } else {
                    $log = new StoreProductPriceLog();
                }
                $log->product_id = $request->is_product_id_edit;
                $log->keeping_id = $keepingRecord->id;
                $log->price      = $keepingRecord->price;
                $log->start_date = Carbon::now();
                $log->save();

            }
        }

        return TRUE;

    }

    private function getProductKeepingById($keepingId) {
        return StoreProductKeeping::find($keepingId);
    }

    private function getBarcode($barcode, $digits = 8) {

        if(empty($barcode)) {
            $barcode1 = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
        } else {
            $check = $this->checkBarcode($barcode);
            if($check > 0) {
                $barcode1 = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
            } else {
                $barcode1 = $barcode;
            }
        }
        return $barcode1;
    }

    private function checkBarcode($barcode) {
        return StoreProductKeeping::whereBarcode($barcode)->count();
    }

    public function deleteKeeping($user_id, $id) {
        $keeping = StoreProductKeeping::find($id);
        if(!empty($keeping)) {
            if($keeping->quantity != -1) {
                return new JsonResponse('Not deleted. Dependent record exist!', 401);
            }
            $keeping->delete();
            return new JsonResponse('Deleted Successfully!', 200);
        } else {
            return new JsonResponse('Record not found', 401);
        }
    }

    public function updatePrice($user_id, $data) {
        $keeping = StoreProductKeeping::find($data[ 'keeping_id' ]);
        if(empty($keeping)) {
            return new JsonResponse('Record not found', 401);
        }

        $exist = $this->checkIfDatePriceExist($keeping->id, Carbon::parse($data[ 'start_date' ])->format('Y-m-d'));
        if(!empty($exist)) {
            $log = $exist;
        } else {
            $log = new StoreProductPriceLog();
        }
        $log->product_id = $keeping->product_id;
        $log->keeping_id = $keeping->id;
        $log->price      = $data[ 'price' ];
        $log->start_date = Carbon::parse($data[ 'start_date' ])->format('Y-m-d');
        if($log->save()) {
            return new JsonResponse('Saved', 200);
        } else {
            return new JsonResponse('Some thing went wrong. Try again', 401);
        }

    }

    public function updateShapingCost($request, $userId) {

        $product = StoreProduct::where('owner_id', $userId)->where('id', $request->product_id)->withoutGlobalScope(IsDraftScope::class)->first();

        if(!empty($product->id)) {
            $product->shipping_cost = $request->shipping_cost;
            if($request->get('is_published') == 1) {
                $product->is_published = 1;
            }

            $product->save();
        }
        return $request->product_id;
    }

    /**
     * @param $product_id
     *
     * @return mixed
     */
    public function getProductDetail($product_id) {
        return $product = StoreProduct::where('id', $product_id)->withoutGlobalScope(IsDraftScope::class)->first();
    }

    public function getDeletedProductDetail($product_id) {
        $product = StoreProduct::where('id', $product_id)->onlyTrashed()->first();
        return $product;
    }

    public function getProductKeepingDetail($product_id) {
        return $productKeepingDetail = DB::table('store_products_keeping')->where('product_id', $product_id)->get();
    }


// ==================== end of Ubaid Code =====================

// ==================== Mustabeen code ============================

    public function getProductMasterAttribute($product_id) {
        $data[ 'masterAttribut1' ] = $this->getProductMasterAttribute1($product_id);
        $data[ 'masterAttribut2' ] = $this->getProductMasterAttribute2($product_id);
        return $data;
    }

    public function getProductMasterAttribute1($product_id) {
        return $productKeepingDetail = DB::table('store_products_keeping')
                                         ->select('store_products_keeping.id as keeping_id', 'store_products_keeping.discount', 'store_products_keeping.quantity', 'store_products_keeping.price', 'store_attributes.id as attr_id', 'store_attributes.label', 'store_products_keeping.master_attribute_2_value as value_id_2', 'store_attribute_values.id as value_id', 'store_attribute_values.value')
                                         ->join('store_attributes', function ($join) {
                                             $join->on('store_products_keeping.master_attribute_1', '=', 'store_attributes.id');
                                         })
                                         ->join('store_attribute_values', function ($join) {
                                             $join->on('store_products_keeping.master_attribute_1_value', '=', 'store_attribute_values.id');
                                         })
                                         ->where('store_products_keeping.product_id', $product_id)
                                         ->whereNull('store_products_keeping.deleted_at')
                                         ->get();
    }

    public function getProductMasterAttribute2($product_id) {
        return $productKeepingDetail = DB::table('store_products_keeping')
                                         ->select('store_products_keeping.id as keeping_id', 'store_products_keeping.discount', 'store_products_keeping.quantity', 'store_products_keeping.price', 'store_attributes.id as attr_id', 'store_attributes.label', 'store_products_keeping.master_attribute_1_value as value_id_1', 'store_attribute_values.id as value_id', 'store_attribute_values.value')
                                         ->join('store_attributes', function ($join) {
                                             $join->on('store_products_keeping.master_attribute_2', '=', 'store_attributes.id');
                                         })
                                         ->join('store_attribute_values', function ($join) {
                                             $join->on('store_products_keeping.master_attribute_2_value', '=', 'store_attribute_values.id');
                                         })
                                         ->where('store_products_keeping.product_id', $product_id)
                                         ->whereNull('deleted_at')
                                         ->get();//master2
    }

    public function getRegion() {
        /* $region_id = DB::table('store_delivery_addresses')->lists( 'country_id', 'id' );

         foreach($region_id as $region_ids){
         $region = DB::table('countries')->where( 'id', $region_ids )->lists('id' ,'name');

         }*/
        $region = DB::table('countries')->get();

        return $region;
    }

    /**
     * @param $id
     *
     * @return int
     */
    public function get_sub_category($id) {
        if(Auth::user()->id == $id) {
            $data[ 'allCategories' ]    = Category::where('category_parent_id', '!=', 0)->where('owner_id', $id)->lists('name', 'id')->prepend('Select a category', '')->toArray();
            $data[ 'allSubCategories' ] = Category::where('category_parent_id', '!=', 0)->where('owner_id', $id)->get();

            return $data;
        }

        return 0;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getSubCategories($id) {
        $allSubCategories = Category::where('category_parent_id', '!=', 0)->where('owner_id', $id)->get();

        return $allSubCategories;
    }

    public function getSubCategoriesAjaxById($id, $sub_category) {

        $allSubCategories = Category::where('category_parent_id', '=', $sub_category)->where('owner_id', $id)->get();
        $allCategories    = Category::where('category_parent_id', '=', 0)->where('owner_id', $id)->lists('name', 'id');

        $html = '';
        foreach ($allSubCategories as $Subcategory):
            if(!isset($Subcategory->id)) {
                continue;
            }
            $html .= '<div class="categoryList" id="categoryList">
    <div>' . $Subcategory->name . '</div>';

            $html .= '<div class="actW">
            <a class="js-open-modal" data-modal-id="popup1-' . $Subcategory->id . '" title="Edit ' . $Subcategory->name . '">
                <span class="editProduct ml20 mr20"></span>
            </a>
            <a class="js-open-modal" data-modal-id="popup2-' . $Subcategory->id . '" title="Delete ' . $Subcategory->name . '" href="#">
                <span class="deleteProduct"></span>
            </a>
        </div>
        </div>';

            $html .= '
<form method="POST" action="' . url("store/" . Auth::user()->username . "/admin/edit/Subcategory/" . $Subcategory->id) . '" accept-charset="UTF-8">
        <div class="modal-box" id="popup1-' . $Subcategory->id . '" style="top: 128.333px; left: 770.5px; display: none;">
         <a href="#" class="js-modal-close close fltR">�</a>
             <div class="modal-body">
                 <div class="edit-photo-poup ">
                     <h3 style="color: #0080e8">Edit Category</h3>
                         <div class="m0">';
            $html .= '<div class="mb10">
                                         ' . Form::select('category_parent_id', $allCategories, $Subcategory->category_parent_id, ['id'    => 'select1',
                                                                                                                                   'class' => 'selectList m0',
                                                                                                                                   'type'  => 'required']) . '
                                    </div>';
            $html .= '</div>
                     <h3 style="color: #0080e8" class="mt10">Subcategory Name:</h3>
                     <input required="required" type="text" name="edited_name" value="' . $Subcategory->name . '" placeholder="" style="width:300px" class="storeInput">
                         <div class="form-container mt10">
                                 <div class="saveArea">
                                    ' . Form::submit('Update', ['class' => 'btn blue fltL']) . '
                                 </form>
                                 </div>
                         </div>
                 </div>
             </div>
         </div>
    </div>';
            $html .= '<form method="Get" action="' . url("store/" . Auth::user()->username . "/admin/delete/Subcategory/" . $Subcategory->id) . '" accept-charset="UTF-8">
<div class="modal-box" id="popup2-' . $Subcategory->id . '" style="top: 128.333px; left: 770.5px; display: none;">
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
                                              ' . Form::submit('Delete', ['class' => 'btn fltL blue mr10']) . '
                                              ' . Form::submit('Cancel', ['class' => 'btn blue js-modal-close fltL close']) . '
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

    public function getSubCategoriesId($request, $id) {
        $allSubCategories = Category::where('category_parent_id', '=', $request->category_parent_id)->where('owner_id', $id)->get();

        return $allSubCategories;
    }

    public function existingCategory($request, $user_id) {

        $existing = Category::where('name', $request->name)->count();

        if($existing > 0) {
            return TRUE;
        }

        return FALSE;
    }

    /**
     * @param $request
     *
     * @return bool|int
     */
    public function store_sub_category($request) {

        $newSubCategory           = new Category();
        $newSubCategory->name     = $request->name;
        $newSubCategory->owner_id = Auth::user()->id;
        if($request->category_parent_id == 0) {
            return FALSE;
        }
        $newSubCategory->category_parent_id = $request->category_parent_id;

        if($newSubCategory->save()) {
            return $newSubCategory->id;

        }

        return 0;
    }

    /**
     * @param $product_id
     *
     * @return null
     */
    public function getProductStoreName($product_id) {
        $product = StoreProduct::find($product_id);

        if(isset($product->id)) {

            $storeName = User::select('username')->where('id', $product->owner_id)->first();

            if(isset($storeName->username)) {
                return $storeName->username;
            }
        }

        return NULL;
    }

    /**
     * @param $product_id
     *
     * @return null
     */
    public function is_product_owner($product_id) {
        $product = StoreProduct::where('id', $product_id)->withoutGlobalScope(IsDraftScope::class)->first();

        if(isset($product->id)) {
            if($product->owner_id == (isset(Auth::user()->id) ? Auth::user()->id : -1)) {
                return $product->id;
            }
        } else {
            return NULL;
        }
    }

    /**
     * @param $product_id
     *
     * @return mixed
     */
    public function deleteProductKeepingRecord($product_id, $master_attribute_1, $master_attribute_1_value, $master_attribute_2, $master_attribute_2_value) {

        $is_last_variant = StoreProductKeeping::where('product_id', $product_id)->whereNull('deleted_at')->count();

        $is_deleted = StoreProductKeeping::where('product_id', $product_id)->
        where('master_attribute_1', $master_attribute_1)->where('master_attribute_1_value', $master_attribute_1_value)->
        where('master_attribute_2', $master_attribute_2)->where('master_attribute_2_value', $master_attribute_2_value)->delete();

        if($is_last_variant == 1) {
            $this->deleteProduct($product_id);
        }
        return $is_deleted;
    }

    /**
     * @param $product_id
     *
     * @return mixed
     */
    public function deleteProduct($product_id) {
        StoreProductAttribute::where('product_id', $product_id)->update(['is_deleted' => 1]);
        return StoreProduct::where('id', $product_id)->delete();
    }

    /**
     * @param $category_id
     * @param $Subcategory_id
     *
     * @return mixed
     */
    public function filtersProducts($category_id, $Subcategory_id) {
        $products = DB::table('store_products')
                      ->select('id', 'title', 'price', 'owner_id', 'quantity', 'sold', 'description as image')
                      ->where('category_id', $category_id)
                      ->where('sub_category_id', $Subcategory_id)
                      ->where('deleted_at', '=', NULL)
                      ->groupBy('store_products.id')
                      ->orderBy('id', 'DESC')
                      ->get();

        foreach ($products as $product) {
            $product->image = getProductPhotoSrc('', '', $product->id, 'product_icon');
        }

        return ($products);
    }

    public function wishList($favoriteIds, $perPage, $user_id) {

        $products = StoreProduct::select('store_products.id as product_id', 'store_products.title'
            , 'store_products.owner_id', 'users.id', 'users.name', 'users.username', 'store_product_images.product_id'
            , 'store_product_images.image_path', 'store_product_favorites.product_id', 'store_product_favorites.poster_id')
                                ->join('users', 'users.id', '=', 'store_products.owner_id')
                                ->join('store_product_images', 'store_product_images.product_id', '=', 'store_products.id')
                                ->join('store_product_favorites', 'store_product_favorites.product_id', '=', 'store_products.id')
                                ->where('store_product_favorites.poster_id', $user_id)
                                ->whereIn('store_products.id', $favoriteIds)
                                ->groupby('store_products.id')
                                ->paginate($perPage);

        return $products;
    }

    public function filtersWishAllList($user_id, $perPage) {

        $favoriteIds = ProductFavorites::where('poster_id', $user_id)
                                       ->lists('product_id');

        $products = StoreProduct::select('store_products.id', 'store_products.title'
            , 'store_products.owner_id', 'users.name', 'users.username', 'store_product_images.product_id'
            , 'store_product_images.image_path')
                                ->join('users', 'users.id', '=', 'store_products.owner_id')
                                ->join('store_product_images', 'store_product_images.product_id', '=', 'store_products.id')
                                ->groupby('store_products.id')
                                ->whereIn('store_products.id', $favoriteIds)->paginate($perPage);

        /*
                foreach ( $products as $product ) {
                    $product->image = getImage(null);
                    $product->store_name = getUserNameByUserId($product->owner_id);
                }*/

        $html = '';
        foreach ($products as $record):
            $html .= '<div class="order-list-wrapper" id="delete_wishList_' . $record->id . '">';
            $html .= '<div class="col-md-6">';

            $html .= '<div class="col-md-3">';
            $html .= '<div class="row">';
            if(isset($record->image_path)) {
                $html .= '<span><img alt="' . $record->title . '" class="img-responsive" src="' . getImage($record->image_path) . '"></span>';
            } else {
                $html .= '<span><img alt="' . $record->title . '" class="img-responsive" src="' . getImage(NULL) . '"></span>';
            }
            $html .= '</div>';
            $html .= '</div>';

            $html .= '<div class="col-md-9">';
            $html .= '<p class="product-det-txt">' . $record->title . '</p>';
            $html .= '<div class="per-piece">US $' . wishListPrice($record->id) . '<sub> / piece</sub></div>';
            $html .= '</div>';

            $html .= '</div>';

            $html .= '<div class="col-md-4">';
            $html .= '<div class="row">';
            $html .= '<div class="store-name">Store Name: ' . $record->name . '</div>';
            $html .= '<div><a href="' . url('store/' . $record->username) . '">View Profile</a></div>';
            $html .= '</div>';
            $html .= '</div>';

            $html .= '<div class="col-md-2">';
            $html .= '<div class="row">';
            $html .= '<div class="time"></div>';
            $html .= '<span><a href="#" class="delete-list delete" data-toggle="modal" data-target="#myModal" id="' . $record->id . '">Delete from wishList</a></span>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';

            $html .= '</div>';
        endforeach;
        return $html;

        // return ( $products );
    }

    public function filtersWishList($category_id, $user_id, $perPage) {

        if($category_id > 0) {

            $subCategoryIds = getSubCategoryIds($category_id, $category_tree_array = '');
            $subCatIds      = [];

            foreach ($subCategoryIds as $subCat) {
                array_push($subCatIds, $subCat[ 'id' ]);
            }
            $favoriteIds = ProductFavorites::where('poster_id', $user_id)->lists('product_id');

            $products = StoreProduct::select('store_products.id', 'store_products.title',
                'store_products.owner_id', 'store_products.category_id', 'users.name', 'users.username',
                'store_products.deleted_at', 'store_product_images.image_path')
                                    ->join('users', 'users.id', '=', 'store_products.owner_id')
                                    ->join('store_product_images', 'store_product_images.product_id', '=', 'store_products.id')
                                    ->whereIn('store_products.id', $favoriteIds)
                                    ->whereIn('store_products.category_id', $subCatIds)
                                    ->where('store_products.deleted_at', '=', NULL)
                                    ->orderBy('store_products.id', 'DESC')
                                    ->groupby('store_products.id')
                                    ->paginate($perPage);

        }

        $html = '';
        foreach ($products as $record):
            $html .= '<div class="order-list-wrapper" id="delete_wishList_' . $record->id . '">';
            $html .= '<div class="col-md-6">';
            $html .= '<div class="col-md-3">';
            if(isset($record->image_path)) {
                $html .= '<div class="row"><img alt="a" class="img-responsive" src="' . getImage($record->image_path) . '"></div>';
            } else {
                $html .= '<div class="row"><img alt="a" class="img-responsive" src="' . getImage(NULL) . '"></div>';
            }
            $html .= '</div>';
            $html .= '<div class="col-md-9">';
            $html .= '<p class="product-det-txt">' . $record->title . '</p>';
            $html .= '<div class="per-piece">US $' . wishListPrice($record->id) . '<sub>/ piece</sub></div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '<div class="col-md-4">';
            $html .= '<div class="row">';
            $html .= '<div class="store-name">Store Name: ' . $record->name . '</div>';
            $html .= '<div><a href="' . url('store/' . $record->username) . '">View Profile</a></div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '<div class="col-md-2">';
            $html .= '<div class="row">';
            $html .= '<div class="time"></div>';
            $html .= '<span><a href="#" class="delete-list delete" data-toggle="modal" data-target="#myModal" id="' . $record->id . '">Delete from wishList</a></span>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
        endforeach;
        return $html;

        // return ( $products );
    }

    /**
     * @param $name
     * @param $category_id
     */
    public function editCat($name, $category_id) {
        $category             = Category::where('id', $category_id)->first();
        $category->name       = $name;
        $category->updated_at = Carbon::now();
        $category->save();
    }

    /**
     * @param $name
     * @param $category_id
     * @param $parent_id
     */
    public function editSubCat($name, $category_id, $parent_id) {
        $category                     = Category::where('id', $category_id)->first();
        $category->name               = $name;
        $category->category_parent_id = $parent_id;
        $category->updated_at         = Carbon::now();
        $category->save();
    }

    /**
     * @param $request
     *
     * @return int
     */
    public function updateProduct($request, $isUpdate) {

        $product = $this->_updateProduct($request);

        if(count($product) > 0) {
            $this->_updateProductFeatures($request);

            $this->_updateProductAttributes($request);

            return $request->product_id;

        } else {
            //not updated
            return 0;
        }
    }

    /**
     * @param $request
     *
     * @return mixed
     */
    public function _updateProduct($request) {
        return $product = DB::table('store_products')->where('id', $request->product_id)->where('owner_id', Auth::user()->id)
                            ->update([
                                'title'           => $request->title,
                                'length'          => $request->length,
                                'width'           => $request->width,
                                'height'          => $request->height,
                                'price'           => $request->price,
                                'discount'        => $request->discount,
                                'quantity'        => $request->quantity,
                                'description'     => $request->description,
                                'category_id'     => $request->category,
                                'sub_category_id' => $request->sub_category,
                                'is_featured'     => !empty($request->is_featured) ? 1 : 0
                            ]);
    }

    /**
     * @param $request
     *
     * @return int
     */
    public function _updateProductFeatures($request) {

        $product_feature_id      = $request->get('featureID');
        $product_features_title  = $request->get('featuretitle');
        $product_features_detail = $request->get('keyfeaturedetail');

        $feature_ids = [];
        if(!empty($product_features_title)) {
            foreach ($product_features_title as $key => $feature) {
                $spfObj  = new StoreProductFeature();
                $already = NULL;
                if(isset($product_feature_id[ $key ])) {
                    $already = StoreProductFeature::where('id', $product_feature_id[ $key ])->first();

                    if(!empty($already->id)) {
                        $already->pr_id            = $request->get('product_id');
                        $already->title            = $product_features_title[ $key ];
                        $already->detail           = $product_features_detail[ $key ];
                        $already->key_feature_type = 1;
                        $already->save();

                        $feature_ids[] = $already->id;
                    }
                }

                if(empty($already->id)) {

                    $spfObj->pr_id            = $request->get('product_id');
                    $spfObj->title            = $product_features_title[ $key ];
                    $spfObj->detail           = $product_features_detail[ $key ];
                    $spfObj->key_feature_type = 1;
                    $spfObj->save();

                    $feature_ids[] = $spfObj->id;
                }
            }
        }

        $product_tech_ids    = $request->get('techID');
        $product_tech_title  = $request->get('techtitle');
        $product_tech_detail = $request->get('techspecs');

        if(!empty($product_tech_title)) {
            foreach ($product_tech_title as $key => $feature) {
                $spfObj  = new StoreProductFeature();
                $already = NULL;
                if(isset($product_tech_ids[ $key ])) {
                    $already = StoreProductFeature::where('id', $product_tech_ids[ $key ])->first();

                    if($already->id) {
                        $already->pr_id            = $request->get('product_id');
                        $already->title            = $product_tech_title[ $key ];
                        $already->detail           = $product_tech_detail[ $key ];
                        $already->key_feature_type = 2;
                        $already->save();

                        $feature_ids[] = $already->id;
                    }
                }

                if(empty($already->id)) {

                    $spfObj->pr_id            = $request->get('product_id');
                    $spfObj->title            = $product_tech_title[ $key ];
                    $spfObj->detail           = $product_tech_detail[ $key ];
                    $spfObj->key_feature_type = 2;
                    $spfObj->save();

                    $feature_ids[] = $spfObj->id;
                }
            }
        }
        if(!empty($feature_ids)) {
            StoreProductFeature::where('pr_id', $request->get('product_id'))
                               ->whereNotIn('id', $feature_ids)
                               ->update(['is_deleted' => 1]);
        } else {
            StoreProductFeature::where('pr_id', $request->get('product_id'))->update(['is_deleted' => 1]);
        }

        return 1;
    }

    /**
     * @param $request
     *
     * @return int
     */
    public function _updateProductAttributes($request) {
        $product_color_id      = $request->get('colorID');
        $product_colors_title  = $request->get('colortitle');
        $product_colors_detail = $request->get('colordetail');

        $attributeID = [];
        foreach ($product_colors_title as $key => $feature) {
            $spaOBJ  = new StoreProductAttribute();
            $already = NULL;
            if(isset($product_color_id[ $key ])) {
                $already = $spaOBJ->where('id', $product_color_id[ $key ])->first();
                if(!empty($already->id)) {
                    $already->product_id = $request->get('product_id');
                    $already->attribute  = $product_colors_title[ $key ];
                    $already->value      = $product_colors_detail[ $key ];
                    $already->save();
                    $attributeID[] = $already->id;
                }
            }

            if(empty($already->id)) {
                $spaOBJ->product_id = $request->get('product_id');
                $spaOBJ->attribute  = $product_colors_title[ $key ];
                $spaOBJ->value      = $product_colors_detail[ $key ];
                $spaOBJ->save();

                $attributeID[] = $spaOBJ->id;
            }
        }

        $product_size_id      = $request->get('sizeID');
        $product_sizes_title  = $request->get('sizetitle');
        $product_sizes_detail = $request->get('sizedetail');

        foreach ($product_sizes_title as $key => $feature) {
            $spaOBJ  = new StoreProductAttribute();
            $already = NULL;
            if(isset($product_size_id[ $key ])) {
                $already = $spaOBJ->where('id', $product_size_id[ $key ])->first();
                if(!empty($already->id)) {
                    $already->product_id = $request->get('product_id');
                    $already->attribute  = $product_sizes_title[ $key ];
                    $already->value      = $product_sizes_detail[ $key ];
                    $already->save();
                    $attributeID[] = $already->id;
                }
            }

            if(empty($already->id)) {
                $spaOBJ->product_id = $request->get('product_id');
                $spaOBJ->attribute  = $product_sizes_title[ $key ];
                $spaOBJ->value      = $product_sizes_detail[ $key ];
                $spaOBJ->save();

                $attributeID[] = $spaOBJ->id;
            }
        }

        if(!empty($attributeID)) {
            StoreProductAttribute::where('product_id', $request->get('product_id'))
                                 ->whereNotIn('id', $attributeID)
                                 ->update(['is_deleted' => 1]);
        } else {
            StoreProductAttribute::where('product_id', $request->get('product_id'))->update(['is_deleted' => 1]);
        }

        return 1;
    }

    public function _uploadProductNewPhotos($request, $album = '') {
        $owner_id = Auth::user()->id;

        $fileIds = explode(",", $request->images_ids);
        foreach ($fileIds as $fileId) {
            if(strpos($fileId, 'no_deletion_') !== FALSE) {
                continue;
            }

            //$file = StorageFile::where('file_id', $fileId)->first();
            $file          = StoreStorageFiles::where('file_id', $fileId)->first();
            $alreadyExists = StoreStorageFiles::where('parent_file_id', $fileId)->first();

            if(isset($alreadyExists->parent_file_id)) {
                continue;
            }

            // File name (To retrieve image with correct params)
            $file_name = time() . rand(111111111, 9999999999);

            $folder_path = "local/storage/app/photos/" . $owner_id;
            if(isset($file->extension)) {
                $fileExtension = $file->extension;
            } else {
                $fileExtension = '.jpeg';
            }
            $file_name_new = $owner_id . "_" . $file_name . "." . $fileExtension;

            if(isset($file->file_id)) {

                if(file_exists("local/storage/app/photos/" . $file->storage_path) == TRUE) {

                    if(!file_exists($folder_path)) {
                        if(!mkdir($folder_path, 0777, TRUE)) {
                            $folder_path = '';
                        }
                    }

                    rename("local/storage/app/photos/" . $file->storage_path, $folder_path . "/" . $file_name_new);
                }

                // Saving photos
//				$photoObj = new StoreAlbumPhotos();
//
//				$photoObj->owner_type = 'product';
//				$photoObj->owner_id   = $request->product_id;
//				$photoObj->file_id    = $file->file_id;
//				$photoObj->title      = $request->title;
//				$photoObj->album_id   = $album->album_id;
//
//				if ( $photoObj->save() ) {
                $file->parent_id    = $request->product_id;//photo_id
                $file->user_id      = $owner_id;
                $file->storage_path = $owner_id . "/" . $file_name_new;
                $file->name         = $file_name;
                $file->mime_major   = 'image';

                $file->save();

                $imageFilePath = $owner_id . "/" . $file_name_new;

                $this->resizeProductImage($imageFilePath, $file->file_id, $file->user_id, 'product', 'product_profile', '151', '210', $request->product_id);
                $this->resizeProductImage($imageFilePath, $file->file_id, $file->user_id, 'product', 'product_thumb', '170', '170', $request->product_id);
                $this->resizeProductImage($imageFilePath, $file->file_id, $file->user_id, 'product', 'product_icon', '54', '80', $request->product_id);
//				}
                //End of saving photos
            }
        }
    }

    /**
     * @param $request
     * @param $product_id
     *
     * @return int
     */
    public function storeReview($request, $product_id, $returnReviewObject = NULL, $user_id = 0) {
        $review = new StoreProductReview();

        if($user_id == 0) {
            $user_id = Auth::user()->id;
        }

        if(isset($request->description)) {
            $description = $request->description;
        } else {
            $description = $request->review_description;
        }

        $review->description = $description;
        $review->owner_id    = $user_id;
        $review->product_id  = $product_id;
        $review->rating      = $request->stars_rating;
        if($review->save()) {
            if($returnReviewObject == 1) {
                return $review;
            }
            return $review->id;
        }

        return 0;
    }

    /**
     * @param $id
     *
     * @return int
     */
    public function getReviews($id) {
        $reviews = DB::table('store_product_reviews')->where('product_id', $id)->get();

        if(count($reviews) > 0) {
            return $reviews;
        } else {
            return 0;
        }
    }

    public function getOrdersOfCustomerIds($user_id) {
        return $finishedOrders = DB::table('store_orders')->where('customer_id', $user_id)->where('status', \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DELIVERED"))->lists('id');
    }

    /**
     * @param $id
     *
     * @return int
     */
    public function isAbleToReview($user_id, $product_id) {
        $finishedOrders = $this->getOrdersOfCustomer($user_id);

        if(count($finishedOrders) > 0) {
            foreach ($finishedOrders as $finishedOrder) {
                $reviewProduct = DB::table('store_order_items')->where('product_id', $product_id)->where('order_id', $finishedOrder->id)->first();

                if(isset($reviewProduct->id)) {
                    return $reviewProduct->id;
                }
            }
        } else {
            return 0;
        }
    }

    public function getOrdersOfCustomer($user_id) {
        return $finishedOrders = DB::table('store_orders')->where('customer_id', $user_id)->where('status', \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DELIVERED"))->get();
    }

    /**
     * @param $id
     *
     * @return int
     */
    public function isReviewed($owner_id, $product_id) {
        $productReview = DB::table('store_product_reviews')
                           ->where('owner_id', $owner_id)
                           ->where('product_id', $product_id)
                           ->first();

        if(isset($productReview->id)) {
            return $productReview->id;
        } else {
            return 0;
        }
    }

    /**
     * @param $id
     *
     * @return int
     */
    public function getProductAttributes($product_id) {
        $productAttributes = DB::table('store_product_attributes')
                               ->where('product_id', $product_id)
                               ->where('is_deleted', 0)
                               ->get();

        if(count($productAttributes)) {
            return $productAttributes;
        } else {
            return 0;
        }
    }

    /**
     * @param $id
     *
     * @return int
     */
    public function key_feature($id) {
        $key_features = DB::table('store_product_features')
                          ->where('is_deleted', 0)
                          ->where('key_feature_type', 1)
                          ->where('pr_id', $id)
                          ->get();

        if(count($key_features) > 0) {
            return $key_features;
        } else {
            return 0;
        }
    }

    /**
     * @param $id
     *
     * @return int
     */
    public function tech_spechs($id) {
        $tech_features = DB::table('store_product_features')
                           ->where('is_deleted', 0)
                           ->where('key_feature_type', 2)
                           ->where('pr_id', $id)
                           ->get();

        if(count($tech_features) > 0) {
            return $tech_features;
        } else {
            return 0;
        }
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getCatOwnerId($id) {
        $cat = Category::where('id', $id)->first();

        return $cat->owner_id;
    }


// ==================== End of Mustabeen code ============================

// ==================== Zahid code ============================

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getProOwnerId($id) {
        $cat = StoreProduct::where('id', $id)->withoutGlobalScope(IsDraftScope::class)->first();

        return $cat->owner_id;
    }

    /**
     * @param $id
     *
     * @return int
     */
    public function getAllProductByBrandId($id, $product_name = NULL, $is_published = '', $is_deleted = '', $out_of_stock = '', $product_category = NULL, $limit = 25) {
        if(Auth::user()->id == $id) {
            $products = StoreProduct::select('store_products.*'
                //,'ss.name as supplier_name', 'ss.contact_no as supplier_contact_no', 'sb.name as brand_name', 'sb.contact_no as brand_contact_no'
                , 'sk.id as keeping_id', 'sk.quantity', 'sk.custom_product_id', 'sk.barcode', 'sk.price', 'sk.cost_price', 'sk.stock_alert_quantity', 'sk.master_attribute_1', 'sk.master_attribute_1_value', 'sk.master_attribute_2', 'sk.master_attribute_2_value'
            )->where('store_products.owner_id', $id)->withoutGlobalScope(IsDraftScope::class);
            //$products->join('store_brands as sb', 'store_products.brand_id', '=', 'sb.id');
            //$products->join('store_suppliers as ss', 'store_products.supplier_id', '=', 'ss.id');
            $products->join('store_products_keeping as sk', 'store_products.id', '=', 'sk.product_id');

            $products->whereNull('sk.deleted_at');

            if($out_of_stock != '') {
                $products->where('sk.quantity', '<', DB::raw('sk.stock_alert_quantity'));
            }

            if($product_name != NULL) {
                $products->where('store_products.title', 'like', '%' . $product_name . "%");
            }

            if($product_category != NULL) {
                $products->where('store_products.category_id', $product_category);
            }

            if($is_published != '') {
                $products->where('store_products.is_published', '=', $is_published);
            }

            if($is_deleted != '') {
                $products->withTrashed();
                $products->whereNotNull('store_products.deleted_at');
            } else {
                $products->whereNull('store_products.deleted_at');
            }

            $products->orderBy('store_products.id', 'desc');
            $products->groupBy('sk.id');

            $results = $products->paginate($limit);

            $productInfo         = [];
            $productInfoArrayIds = array();
            foreach ($results as $p) {
                $productInfo[ $p->id ][ 'product_info' ]            = [
                    'id'               => $p->id,
                    'title'            => $p->title,
                    'is_featured'      => $p->is_featured,
                    'is_published'     => $p->is_published,
                    'affiliate'        => $p->affiliate,
                    'affiliate_reward' => $p->affiliate_reward,
                    'category_id'      => $p->category_id];
                $productInfo[ $p->id ][ 'items' ][ $p->keeping_id ] = $p;
            }

            $productsForCategory = StoreProduct::select('store_products.category_id')->where('store_products.owner_id', $id)->get();
            foreach ($productsForCategory as $p) {
                $productInfoArrayIds[] = $p->category_id;
            }
            $data[ 'ownerProductCategories' ] = Category::select('id', 'name')->whereIn('id', array_unique($productInfoArrayIds))->get();
            $data[ 'allProducts' ]            = $results;
            $data[ 'allProductSubItems' ]     = $productInfo;
            return $data;
        }

        return 0;
    }

    public function getAllProductByBrandIdAdvSrch($id, $product_name = '', $brand_ids = '', $suppliers_ids = '', $category_ids = '', $attribute_ids = '', $price_range = '', $limit = 25) {
        if(Auth::user()->id == $id) {
            $products = StoreProduct::select('store_products.*'
                //,'ss.name as supplier_name', 'ss.contact_no as supplier_contact_no', 'sb.name as brand_name', 'sb.contact_no as brand_contact_no'
                , 'sk.id as keeping_id', 'sk.quantity', 'sk.custom_product_id', 'sk.barcode', 'sk.price', 'sk.cost_price', 'sk.stock_alert_quantity', 'sk.master_attribute_1', 'sk.master_attribute_1_value', 'sk.master_attribute_2', 'sk.master_attribute_2_value'
            )->where('store_products.owner_id', $id)->withoutGlobalScope(IsDraftScope::class);
            //$products->join('store_brands as sb', 'store_products.brand_id', '=', 'sb.id');
            //$products->join('store_suppliers as ss', 'store_products.supplier_id', '=', 'ss.id');
            $products->join('store_products_keeping as sk', 'store_products.id', '=', 'sk.product_id');
            $products->whereNull('sk.deleted_at');
            ($product_name != '') ? $products->where('store_products.title', 'like', '%' . $product_name . "%") : '';
            ($brand_ids != '') ? $products->whereIn('store_products.brand_id', $brand_ids) : '';
            ($suppliers_ids != '') ? $products->whereIn('store_products.supplier_id', $suppliers_ids) : '';
            ($category_ids != '') ? $products->whereIn('store_products.category_id', $category_ids) : '';
            ($attribute_ids != '') ? $products->whereIn('sk.master_attribute_1_value', $attribute_ids) : '';
            ($attribute_ids != '') ? $products->orWhereIn('sk.master_attribute_2_value', $attribute_ids) : '';

            if(isset($price_range[ 'min' ])) {
                foreach ($price_range[ 'min' ] as $k => $price) :
                    $products->whereBetween('sk.price', [$price, $price_range[ 'max' ][ $k ]]);
                endforeach;
            }

            $products->whereNull('store_products.deleted_at');
            $products->orderBy('store_products.id', 'desc');
            $products->groupBy('sk.id');

            $results = $products->paginate($limit);

            $productInfo         = [];
            $productInfoArrayIds = array();
            foreach ($results as $p) {
                $productInfo[ $p->id ][ 'product_info' ]            = [
                    'id'               => $p->id,
                    'title'            => $p->title,
                    'is_featured'      => $p->is_featured,
                    'is_published'     => $p->is_published,
                    'affiliate'        => $p->affiliate,
                    'affiliate_reward' => $p->affiliate_reward,
                    'category_id'      => $p->category_id];
                $productInfo[ $p->id ][ 'items' ][ $p->keeping_id ] = $p;
            }

            $productsForCategory = StoreProduct::select('store_products.category_id')->where('store_products.owner_id', $id)->get();
            foreach ($productsForCategory as $p) {
                $productInfoArrayIds[] = $p->category_id;
            }
            $data[ 'ownerProductCategories' ] = Category::select('id', 'name')->whereIn('id', array_unique($productInfoArrayIds))->get();
            $data[ 'allProducts' ]            = $results;
            $data[ 'allProductSubItems' ]     = $productInfo;
            return $data;
        }

        return 0;
    }

    public function getAllProductByBrandIdNoCondition($id) {
        if(Auth::user()->id == $id) {
            $products = StoreProduct::select('store_products.*'
                , 'store_products.sold as keeping_id', 'store_products.sold as quantity', 'store_products.sold as custom_product_id', 'store_products.sold as barcode', 'store_products.sold as price', 'store_products.sold  as cost_price', 'store_products.sold as stock_alert_quantity', 'store_products.sold as master_attribute_1', 'store_products.sold as master_attribute_1_value', 'store_products.sold as master_attribute_2', 'store_products.sold as master_attribute_2_value'
            )->where('store_products.owner_id', $id)
                                    ->withoutGlobalScope(IsDraftScope::class);

            $products->whereNull('store_products.deleted_at');

            $products->orderBy('store_products.id', 'desc');

            $results = $products->paginate(20);

            $productInfo         = [];
            $productInfoArrayIds = array();
            foreach ($results as $p) {
                $productInfo[ $p->id ][ 'product_info' ]            = [
                    'id'               => $p->id,
                    'title'            => $p->title,
                    'is_featured'      => $p->is_featured,
                    'is_published'     => $p->is_published,
                    'affiliate'        => $p->affiliate,
                    'affiliate_reward' => $p->affiliate_reward,
                    'category_id'      => $p->category_id];
                $productInfo[ $p->id ][ 'items' ][ $p->keeping_id ] = $p;
            }

            $productsForCategory = StoreProduct::select('store_products.category_id')->where('store_products.owner_id', $id)->get();
            foreach ($productsForCategory as $p) {
                $productInfoArrayIds[] = $p->category_id;
            }
            $data[ 'ownerProductCategories' ] = Category::select('id', 'name')->whereIn('id', array_unique($productInfoArrayIds))->get();
            $data[ 'allProducts' ]            = $results;
            $data[ 'allProductSubItems' ]     = $productInfo;
            return $data;
        }

        return 0;
    }

    public function storeBrand($brand_id) {
        return $brand = User::where('id', $brand_id)->orWhere('username', $brand_id)->first();
    }

    public function getTotalEarnings() {

        $allOrders = $this->getFinishedOrdersCurrentUser();

        $data[ 'totalSales' ]     = '';
        $data[ 'thisMonthSales' ] = '';
        //To manipulate monthly sale

        $data[ 'now_date' ] = Carbon::now()->toDateTimeString();
        $data[ 'to_date' ]  = Carbon::now()->addMonth(-1)->toDateTimeString();

        foreach ($allOrders as $order) {
            $data[ 'totalSales' ] = $data[ 'totalSales' ] + $order->total_price;

            $data[ 'created_at' ] = $order->created_at->toDateTimeString();
            $data[ 'month_name' ] = Carbon::now()->format('F');

            if($data[ 'created_at' ] >= $data[ 'to_date' ] AND $data[ 'created_at' ] <= $data[ 'now_date' ]) {
                $data[ 'thisMonthSales' ] = $data[ 'thisMonthSales' ] + $order->total_price;
            }
        }

        return $data;
    }

    public function getFinishedOrdersCurrentUser($user_id = 0) {
        return StoreOrder::where('seller_id', $user_id)->where('status', \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DELIVERED"))->orderBy('id', 'DESC')->get();
    }

    public function getTotalQuantityOfProductsCurrentUser($user_id = 0) {
        $productIds = StoreProduct::where('owner_id', $user_id)->lists('id');
        return StoreProductKeeping::whereIn('product_id', $productIds)->sum('quantity');
    }

    public function getFinishedOrdersCurrentUserBuyer($user_id = 0) {
        return StoreOrder::where('customer_id', $user_id)->where('status', \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DELIVERED"))->orderBy('id', 'DESC')->get();
    }

    public function getFinishedOrdersCurrentUserBuyerPaginated($user_id = 0) {
        return StoreOrder::where('customer_id', $user_id)->where('status', \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DELIVERED"))->orderBy('id', 'DESC')->paginate(25);
    }

    public function AddDeliverCourierInfo($formData) {

        $deliverCourier = new DeliveryCourier();

        $deliverCourier->seller_id               = $formData->seller_id;
        $deliverCourier->order_id                = $formData->order_id;
        $deliverCourier->courier_service_name    = $formData->courier_service_name;
        $deliverCourier->courier_service_url     = $formData->courier_service_url;
        $deliverCourier->order_tracking_number   = $formData->order_tracking_number;
        $deliverCourier->delivery_estimated_time = $formData->delivery_estimated_time;

        $originalDate = $formData->date_to_be_delivered;
        $newDate      = date("Y-m-d", strtotime($originalDate));

        $deliverCourier->date_to_be_delivered  = $newDate;
        $deliverCourier->delivery_charges_paid = $formData->delivery_charges_paid;

        $deliverCourier->save();

        return $deliverCourier->id;
    }

    public function getTotalSalesCurrentUser($user_id) {
        $sale         = \Config::get('constants_brandstore.STATEMENT_TYPES.SALE');
        $shipping_fee = \Config::get('constants_brandstore.STATEMENT_TYPES.ORDER_SHIPPING_FEE');
        return StoreTransaction::where('user_id', $user_id)
                               ->whereIn('type', [$sale, $shipping_fee])
                               ->sum('amount');
    }

    public function getCurrentMonthSalesCurrentUser($user_id) {
        $sale         = \Config::get('constants_brandstore.STATEMENT_TYPES.SALE');
        $shipping_fee = \Config::get('constants_brandstore.STATEMENT_TYPES.ORDER_SHIPPING_FEE');
        $allSales     = StoreTransaction::where('user_id', $user_id)->whereIn('type', [$sale, $shipping_fee])->get();

        $data[ 'thisMonthSales' ] = '';
        $data[ 'now_date' ]       = Carbon::now()->toDateTimeString();
        $data[ 'to_date' ]        = Carbon::now()->addMonth(-1)->toDateTimeString();

        foreach ($allSales as $sale) {
            $data[ 'created_at' ] = $sale->created_at->toDateTimeString();
            $data[ 'month_name' ] = Carbon::now()->format('F');

            if($data[ 'created_at' ] >= $data[ 'to_date' ] AND $data[ 'created_at' ] <= $data[ 'now_date' ]) {
                $data[ 'thisMonthSales' ] = $data[ 'thisMonthSales' ] + $sale->amount;
            }
        }

        return $data;
    }

    public function updateProductQuantityByOperation($product_id, $operation, $quantityTobeUpdated) {

        $product = StoreProduct::find($product_id);

        if($operation == '-') {
            $quantityTobeUpdated = $product->quantity - $quantityTobeUpdated;
        }

        if($operation == '+') {
            $quantityTobeUpdated = $product->quantity + $quantityTobeUpdated;
        }

        $product->quantity = $quantityTobeUpdated;

        $product->save();
    }

    public function updateProductSoldProductByOperation($product_id, $operation, $quantityTobeUpdated) {

        $product = StoreProduct::find($product_id);

        if($operation == '-') {
            $quantityTobeUpdated = $product->sold - $quantityTobeUpdated;
        }

        if($operation == '+') {
            $quantityTobeUpdated = $product->sold + $quantityTobeUpdated;
        }

        $product->sold = $quantityTobeUpdated;

        $product->save();
    }

    public function getCurrentUserProductsReviews($user_id) {
        $orderIds   = $this->getCurrentUserFinishedOrdersIds();
        $productIds = $this->getCurrentUserFinishedOrderProductIds($orderIds);
        $reviews    = DB::table('store_product_reviews')->whereIn('product_id', $productIds)->get();

        if(count($reviews) > 0) {
            return $reviews;
        } else {
            return 0;
        }
    }

    public function getCurrentUserFinishedOrdersIds($user_id = 0) {
        return StoreOrder::where('seller_id', $user_id)->where('status', \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DELIVERED"))->lists('id');
    }

    public function getCurrentUserFinishedOrderProductIds($orderIds) {
        return StoreOrderItems::whereIn('order_id', $orderIds)->lists('id');
    }

    public function getCurrentBuyerUserProductsReviews($user_id, $perPage = NULL) {
        if($perPage < 1) {
            $perPage = 10;
        }
        $orderIds   = $this->getCurrentBuyerUserFinishedOrdersIds();
        $productIds = $this->getCurrentUserFinishedOrderProductIds($orderIds);
        $reviews    = DB::table('store_product_reviews')->whereIn('product_id', $productIds)->paginate($perPage);

        if(count($reviews) > 0) {
            return $reviews;
        } else {
            return 0;
        }
    }

    public function getCurrentBuyerUserFinishedOrdersIds($user_id = 0) {
        return StoreOrder::where('customer_id', $user_id)->where('status', \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DELIVERED"))->lists('id');
    }

    public function saveProductsReviews($request, $user_id) {

        $reviews = DB::table('store_product_reviews')
                     ->where('id', $request->product_id)
                     ->where('owner_id', $user_id)
                     ->update([
                         'description' => $request->desc,
                         'rating'      => $request->stars_rating,
                         'updated_at'  => Carbon::now()
                     ]);

        if(count($reviews) > 0) {
            return $reviews;
        } else {
            return 0;
        }
    }

    public function updateFeedBack($request) {
        $review = StoreProductReview::find($request->review_id);

        if(isset($review->id)) {

            $review->description = $request->description;
            $review->rating      = $request->stars_rating;
            $review->is_revised  = 1;

            $review->save();

            return $review;
        }

        return 0;
    }

    public function getAllRegions() {
        return $costRegions = StoreShippingRegion::get();
    }

    public function getProductRegionsCost($product_id) {
        return $regionsCost = StoreShippingCost::where('product_id', $product_id)->get();
    }

    public function addRegionCost($request) {

        if(isset($request->product_id)) {
            $this->deleteAllRegionsCostByProductId($request->product_id);
            $this->deletShippingCountryByProductID($request->product_id);
            $status  = $request->get('status');
            $country = $request->get('country');
            $cost    = $request->get('cost');

            foreach ($status as $key => $value) {
                if($value == 0) {
                    continue;
                }
                $region_id = $this->getRegionIDByName($key);
                if(isset($country[ $key ])) {
                    $countries = $country[ $key ];
                } else {
                    $countries = $this->getRegionCountries($key);
                }

                foreach ($countries as $index => $country_id) {
                    $shippingCountry = new StoreShippingCountry();

                    $shippingCountry->product_id = $request->product_id;
                    $shippingCountry->country_id = $country_id;
                    $shippingCountry->region_id  = $region_id;

                    $shippingCountry->save();
                }
                $shippingCost = new StoreShippingCost();

                $shippingCost->product_id    = $request->product_id;
                $shippingCost->region_id     = $region_id;
                $shippingCost->shipping_cost = $cost[ $key ];
                $shippingCost->status        = $value;

                $shippingCost->save();
            }
            return 1;
        }

        return 0;

    }

    public function deleteAllRegionsCostByProductId($product_id) {
        return $regionsCost = StoreShippingCost::where('product_id', $product_id)->delete();
    }

    public function deletShippingCountryByProductID($product_id) {
        return StoreShippingCountry::where('product_id', $product_id)->delete();
    }

    public function getRegionIDByName($name) {
        $region = StoreShippingRegion::where('name', 'like', $name)->select('id', 'name')->first();

        return @$region->id;
    }

// ==================== End of Zahid code ============================

    public function getRegionCountries($region) {

        return Country::where('region', 'like', $region)->lists('id', 'id');
    }

    public function sendReviewReviseRequest($review_id) {
        $review = StoreProductReview::find($review_id);

        if(isset($review->id)) {

            $review->is_revise_request = 1;

            $review->save();

            return $review->id;
        }

        return 0;
    }

    public function updateStatement($type, $parent_type, $parent_id, $transaction_type, $currency = NULL, $user_id = NULL, $amount = NULL) {
        $sale         = \Config::get('constants_brandstore.STATEMENT_TYPES.SALE');
        $shipping_fee = \Config::get('constants_brandstore.STATEMENT_TYPES.ORDER_SHIPPING_FEE');
        if($type == $sale || $type == $shipping_fee) {
            $order = StoreOrder::where('id', $parent_id)->first();

            $user_id = $order->seller_id;
            if($type == $sale) {
                $amount = $order->total_price - $order->total_shiping_cost;
                $amount = $amount - $order->total_discount;
            } elseif($type == $shipping_fee) {
                $amount = $order->total_shiping_cost;
                if(empty($amount) || $amount == '0.00') {
                    return FALSE;
                }
            }
        }

        $already_exists = StoreTransaction::where('parent_type', $parent_type)
                                          ->where('type', $type)
                                          ->where('parent_id', $parent_id)
                                          ->where('transaction_type', $transaction_type)
                                          ->where('user_id', $user_id)
                                          ->count();

        if($already_exists || empty($amount) || $amount == '0.00') {
            return FALSE;
        }

        $stObj                   = new StoreTransaction();
        $stObj->type             = $type;
        $stObj->parent_type      = $parent_type;
        $stObj->parent_id        = $parent_id;
        $stObj->user_id          = $user_id;
        $stObj->amount           = str_replace(',', '', $amount);
        $stObj->transaction_type = $transaction_type;
        $stObj->currency         = $currency;
        $stObj->save();
    }

    public function regionsSelectedCountries($product_id) {

    }

    public function statement($store_id, $transaction_type) {
        $store    = $this->isStoreBrand($store_id);
        $store_id = $store->id;
        if(Input::has('to')) {
            $to = Carbon::parse(Input::get('to'))->format('Y-m-d H:i:s');
        } else {
            $to = Carbon::now();
        }

        if(Input::has('from')) {
            $from = Carbon::parse(Input::get('from'))->format('Y-m-d H:i:s');
        } else {
            $from = Carbon::now()->subDay(30);
        }
        $statementFor = 0;
        if(Input::has('statement_for')) {
            $statementFor = Input::get(('statement_for'));
        }

        $data[ 'transactions' ] = $this->get_transactions($store_id, $from, $to, $transaction_type, $statementFor);

        $data[ 'earning' ]           = $this->totalEarning($store_id);
        $data[ 'beginning_balance' ] = $this->beginning_balance($store_id, $from);
        $data[ 'from' ]              = $from;
        $data[ 'to' ]                = $to;
        $data[ 'transaction_type' ]  = $transaction_type;

        return $data;
    }

    public function isStoreBrand($brand_id) {
        return $brand = User::select([
            'user_type',
            'id',
        ])->where('id', $brand_id)->orWhere('username', $brand_id)->first();
    }

    private function get_transactions($store_id, $from, $to, $transaction_type = '', $statementFor) {
        $query = StoreTransaction::where('user_id', $store_id)
                                 ->where('created_at', '>', $from)->where('created_at', '<', $to)
                                 ->orderBy('created_at', 'DESC');
        if(!empty($transaction_type)) {
            $query->where('transaction_type', 'like', $transaction_type);
        }

        if($statementFor === "ware-house") {
            $query->where('object_type', 'store');
        } elseif($statementFor != 0) {
            $query->where('object_type', 'shop')
                  ->where('parent_type', 'shop_order')
                  ->where('object_id', $statementFor);
        }

        return $query->get();
    }

    private function totalEarning($store_id) {

        $storeRepo = new StoreRepository();
        return $storeRepo->getAvailableBalance($store_id);

    }

    private function beginning_balance($store_id, $from) {
        //return StoreOrder::where('seller_id', $store_id)->where('status', \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DELIVERED"))->sum('total_price');
        $earning = StoreTransaction::where('user_id', $store_id)
                                   ->where(function ($query) {
                                       $query->where('type', \Config::get("constants_brandstore.STATEMENT_TYPES.SALE"))
                                             ->orWhere('type', \Config::get("constants_brandstore.STATEMENT_TYPES.ORDER_SHIPPING_FEE"));
                                   })
                                   ->where('created_at', '<', $from)
                                   ->sum('amount');

        $withdraw = StoreTransaction::where('user_id', $store_id)
                                    ->where(function ($query) {
                                        $query->where('type', '!=', \Config::get("constants_brandstore.STATEMENT_TYPES.SALE"))
                                              ->where('type', '!=', \Config::get("constants_brandstore.STATEMENT_TYPES.ORDER_SHIPPING_FEE"));
                                    })
                                    ->where('created_at', '<', $from)
                                    ->sum('amount');
        return $earning - $withdraw;
    }

    public function getSameNameSubCategory($owner_id, $category_id, $subcategory_name) {
        $sub_categories = Category::where('category_parent_id', $category_id)
                                  ->where('name', '=', $subcategory_name)
                                  ->where('owner_id', $owner_id)
                                  ->get();

        if(count($sub_categories) > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function getAllCountries() {
        return Country::select(['id', 'name', 'iso'])->get();
    }

    public function getCountriesByRegion($region) {
        return Country::where('region', 'like', $region)->select('id', 'name', 'iso')->get();
    }

    public function searchFilter($categoryId = '', $searchProductQuery = '', $store_id = NULL) {

        $searchedProducts      = '';
        $searchedProductsCache = '';
        //if($categoryId == 0) {
        $query = StoreProduct::select('id as product_id', 'title', 'category_id', 'owner_id', DB::raw('COUNT(title) as count'))
                             ->where('title', 'LIKE', '%' . $searchProductQuery . '%')
                             ->whereNull('deleted_at')
                             ->orderBy('id', 'asc')
                             ->whereNull('deleted_at')
                             ->groupBy('category_id')
                             ->take(10);
        if(!empty($store_id)) {
            $query->where('owner_id', $store_id);
        }

        $searchedProducts = $query->get()->toArray();

        if(count($searchedProducts) > 0) {
            $productCatIds = [];
            $catInfo       = [];

            foreach ($searchedProducts as $key => $searchedProduct) {
                $is_exists = \Cartimatic\Store\StoreProductKeeping::where('product_id', $searchedProduct[ 'product_id' ])->count();
                if($is_exists == 0) {
                    unset($searchedProducts[ $key ]);
                }
                if(!in_array($searchedProduct[ 'category_id' ], $productCatIds)) {
                    $currentCatSLug = getCategorySlug($searchedProduct[ 'category_id' ]);
                    $breadCrumb     = getBreadCrumbsBySubCategoryId($searchedProduct[ 'category_id' ]);
                    $breadCrumb     = array_reverse($breadCrumb);
                    if(isset($breadCrumb[ 0 ])) {
                        $catInfo[ $searchedProduct[ 'category_id' ] ] = array_merge($breadCrumb[ 0 ], ["product_cat_slug" => $currentCatSLug]);
                        array_push($productCatIds, $searchedProduct[ 'category_id' ]);
                    }
                }
            }

            //Getting unique category_id
            if(count($searchedProducts) < 1) {
                return 0;
            }
            $data[ 'searchedProducts' ] = $searchedProducts;
            $data[ 'catInfo' ]          = $catInfo;

            return $data;
        } else {
            return 0;
        }
        //
        /*}
        $orderProductDetail = StoreProduct::select( 'id as product_id', 'title', 'category_id', 'owner_id',
                              DB::raw( 'COUNT(title) as count' ));
        $orderProductDetail->where('title', 'LIKE', $searchProductQuery . '%')->whereNull( 'deleted_at' );
        if($categoryId > 0) {

            $subCategoryIds = getSubCategoryIds($categoryId, $category_tree_array = '');
            $subCatIds      = [];

            foreach ($subCategoryIds as $subCat) {
                array_push($subCatIds, $subCat[ 'id' ]);
            }

            $orderProductDetail->whereIn('category_id', $subCatIds);

        }
        $orderProductDetail->orderBy( 'id', 'asc' )->groupBy( 'category_id' );
        $searchedProducts = $orderProductDetail->take(10)->get();*/

        /* $searchedProducts = $searchedProducts->toArray();

         $searchedProductsCache = StoreProductSearch::
         select('product_id as id', 'product_name as title' , DB::raw('COUNT(*) as count' ))
                                                    ->where('product_name', 'LIKE', '%' . $searchProductQuery . '%')
                                                     ->orderBy('id', 'asc')
                                                     ->groupBy('product_id')
                                                    ->get();


         $searchedProductsCache = $searchedProductsCache->toArray();

         $searchedProducts = $searchedProducts + $searchedProductsCache;*/

        /*if(count($searchedProducts) > 0) {
            return $searchedProducts;
        } else {
            return 0;
        }*/

    }

    public function searchRecords($categoryId = 0, $searchProductQuery = '') {

        $orderProductDetail = DB::table('store_products');
        $orderProductDetail->where('title', 'LIKE', '%' . $searchProductQuery . '%');
        $orderProductDetail->whereNull('deleted_at');

        if($categoryId > 0) {
            $subCategoryIds = getSubCategoryIds($categoryId, $category_tree_array = '');
            $subCatIds      = [];

            foreach ($subCategoryIds as $subCat) {
                array_push($subCatIds, $subCat[ 'id' ]);
            }

            $orderProductDetail->whereIn('category_id', $subCatIds);
        }

        $orderProductDetail = $orderProductDetail->get();

        /*if($orderProductDetail > 0) {

            $ProductDetail = DB::table('store_products')->select('id', 'title' , 'description' , 'owner_id')
                               ->where('title', 'LIKE', '%' . $searchProductQuery . '%')->first();

            if(count($ProductDetail) > 0) {

                $record = DB::table('store_product_search')->select('id', 'product_name')
                            ->where('product_name', 'LIKE', '%' . $searchProductQuery . '%')->get();

                if(count($record) > 0) {
                    $visitor = DB::table('store_product_search')
                                 ->where('product_name', 'LIKE', '%' . $searchProductQuery . '%')->increment('counter');

                    return $orderProductDetail;
                } else {

                    DB::table('store_product_search')->insert([
                        'product_id'   => $ProductDetail->id,
                        'product_name' => $ProductDetail->title,
                        'description'  => $ProductDetail->description,
                        'owner_id'     => $ProductDetail->owner_id,
                        'created_at'   => Carbon::now(),
                    ]);

                }

                return $orderProductDetail;
            }
        }*/
        return $orderProductDetail;

    }

    public function searchHotUrl($request) {

        $SearchUrl = DB::table('store_product_search')->select('id', 'product_name as title', 'description', 'owner_id')->where('store_product_search.product_id', '=', $request->product_id)->get();
        return $SearchUrl;
    }

    public function hotSearch() {
        /*  return StoreProductSearch::select('product_id as product_id', 'product_name as title', 'counter' ,DB::raw('MAX(counter) as counter'))->orderBy('product_name', 'DESC')->groupBy('counter')->take(10)->get();*/
        return StoreProductSearch::select('product_id as product_id', 'product_name as title', 'counter', DB::raw('store_product_search.*, counter.*, COUNT(*) as counter'))->orderBy('product_name', 'DESC')->groupBy('product_id')->take(10)->get();

    }

    public function saveShippingCost($data) {
        $product                = StoreProduct::find($data->product_id);
        $product->shipping_cost = $data->shipping_cost;
        $product->save();
        return TRUE;
    }

    public function saveProductAttributes($data) {
        $attributes = $data[ 'attributeId' ];
        $this->deleteAlreadyProductAttribute($data[ 'product_id' ]);
        foreach ($attributes as $attribute) {
            $id = $this->saveProductAttribute($attribute, $data[ 'product_id' ]);
            $this->saveProductAttributeValues($id, $data[ 'attributeValues-' . $attribute ]);
        }
    }

    public function deleteAlreadyProductAttribute($productId) {
        return StoreProductAttribute::where('product_id', $productId)->update(['is_deleted' => 1]);
    }

    //Start Child to till parent

    public function saveProductAttribute($attribute, $productId) {
        $storeProductAttribute                     = new StoreProductAttribute();
        $storeProductAttribute->store_attribute_id = $attribute;
        $storeProductAttribute->product_id         = $productId;
        $storeProductAttribute->save();
        return $storeProductAttribute->id;

    }

    public function saveProductAttributeValues($id, $attributeValues) {
        if($attributeValues != NULL) {
            foreach ($attributeValues as $attributeValue) {
                if($attributeValue != NULL) {
                    $this->saveAttributeValue($id, $attributeValue);
                }
            }
            return TRUE;
        }
        return FALSE;
    }

    private function saveAttributeValue($id, $attributeValue = '') {
        $attributeValueObj                             = new StoreProductAttributeValue();
        $attributeValueObj->store_product_attribute_id = $id;
        $attributeValueObj->store_attribute_value_id   = $attributeValue;
        $attributeValueObj->save();
        return TRUE;
    }

    public function getAllShop($storeID) {
        return Shop::whereStoreId($storeID)->orderBy('location', 'asc')->get();
    }

    public function getAllShopList($storeID) {
        $shop  = Shop::whereStoreId($storeID)->orderBy('location', 'asc')->lists('shop_name', 'id')->toArray();
        $array = ['0' => 'All', 'ware-house' => 'Web Only'];
        return array_merge($array, $shop);
    }

    public function getProductWithAttributes($id) {
        $data = StoreProduct::whereId($id)
                            ->with('category')
                            ->with('productKeeping.master1')
                            ->with('productKeeping.value1')
                            ->with('productKeeping.master2')
                            ->with('productKeeping.value2')
                            ->orderBy('id', 'DESC')
                            ->first();
        return $data;
    }

    public function getProductVariants($product_id = 0) {
        $products = StoreProduct::select('store_products.*', 'store_products.id as product_id '
            , 'sk.id as keeping_id', 'sk.quantity', 'sk.discount', 'sk.custom_product_id', 'sk.barcode', 'sk.price', 'sk.cost_price', 'sk.stock_alert_quantity', 'sk.master_attribute_1', 'sk.master_attribute_1_value', 'sk.master_attribute_2', 'sk.master_attribute_2_value'
        )->where('store_products.id', $product_id);

        $products->join('store_products_keeping as sk', 'store_products.id', '=', 'sk.product_id');

        $products->whereNull('sk.deleted_at');
        $products->groupBy('sk.id');
        $results = $products->get();

        foreach ($results as $p) {
            $p->attribute_label_1 = getAttributeLabel($p->master_attribute_1);
            $p->attribute_label_2 = getAttributeLabel($p->master_attribute_2);
            $p->attribute_1_value = getAttributeValueLabel($p->master_attribute_1_value);
            $p->attribute_2_value = getAttributeValueLabel($p->master_attribute_2_value);
        }

        return $results;
    }

    public function addRequest($data, $user_id) {
        $detail = $data->request_detail;
        //$detail = htmlentities(strip_tags($detail));

        $detail = filter_var($detail, FILTER_SANITIZE_STRING);

        $request          = new StoreRequest();
        $request->user_id = $user_id;
        $request->detail  = trim(preg_replace('/\s+/', ' ', $detail));
        $request->save();
    }

    public function getAllRequests($userId) {
        return StoreRequest::whereUserId($userId)->orderBy('updated_at', 'DESC')->get();
    }

    public function getSuppliers($user_id) {
        return StoreSupplier::where('is_deleted', 0)->where('store_id', $user_id)->pluck('name', 'id');
    }

    public function getBrands($user_id) {
        return StoreBrand::where('is_deleted', 0)->where('store_id', $user_id)->pluck('name', 'id');
    }

    public function getCalenderSeason($user_id) {
        return CalenderSeason::whereNull('deleted_at')->where('store_id', $user_id)->pluck('name', 'id');
    }

    public function getProductGender($user_id) {
        return ProductGender::whereNull('deleted_at')->where('store_id', $user_id)->pluck('name', 'id');
    }

    public function getValueAddition($user_id) {
        return ValueAddition::whereNull('deleted_at')->where('store_id', $user_id)->pluck('name', 'id');
    }

    public function getLifeType($user_id) {
        return LifeType::whereNull('deleted_at')->where('store_id', $user_id)->pluck('name', 'id');
    }

    public function addOpeningStock($user_id, $data) {
        $productId = Hashids::connection('store')->decode($data[ 'product_id' ])[ 0 ];
        $keepings  = StoreProductKeeping::whereProductId($productId)->get();

        if(!isset(\Session::get('SYSTEM_CONFIGURATION')[ 'STOCK_OPENING' ])) {
            return \Response::json('Please map opening stock supplier', 422);
        }
        foreach ($keepings as $keeping) {
            if($keeping->quantity != -1) {
                return \Response::json('Transaction exists against this product, opening can\'t be entered', 422);
            }
        }

        $this->addOpening($data, $keepings, $user_id);
    }

    private function addOpening($data, $keepings, $user_id) {
        $totalQty = 0;

        foreach ($data[ 'products' ] as $key => $product) {
            if(!is_null($product) && $product > 0) {
                $totalQty          = $totalQty + $product;
                $keeping           = StoreProductKeeping::find($key);
                $keeping->quantity = $product;
                $totalQty          = $totalQty + $product;
                if($keeping->save()) {
                    $this->saveLog($key, $product, Hashids::connection('store')->decode($data[ 'product_id' ])[ 0 ], 'opening_stock', $user_id);
                };
            }
        }
        if($totalQty > 0) {
            $this->saveGrn($data, $user_id, $keepings);
            return TRUE;
        }

    }

    private function saveLog($keepingId, $quantity, $productId, $type = 'opening_stock', $store_id) {
        /*$log = new StoreProductsQuantityLog();

        $log->product_id = $productId;
        $log->keeping_id = $keepingId;
        $log->quantity   = $quantity;
        $log->type       = $type;
        $log->save();*/

        $keepingLog                     = new StoreProductKeepingLog();
        $keepingLog->product_id         = $productId;
        $keepingLog->object_type        = 'store';
        $keepingLog->object_id          = $store_id;
        $keepingLog->quantity           = $quantity;
        $keepingLog->type               = 'credit';
        $keepingLog->transaction_type   = 'add';
        $keepingLog->product_keeping_id = $keepingId;
        $keepingLog->save();

        return TRUE;
    }

    public function saveGrn($data, $user_id, $keepings) {
        $grn = new StoreGrn();

        $po_amount = 0;

        $grn->object_type  = 'products';
        $grn->object_value = 0;

        $grn->store_id    = $user_id;
        $grn->supplier_id = \Session::get('SYSTEM_CONFIGURATION')[ 'STOCK_OPENING' ];
        $grn->date        = Carbon::now();
        //$grn->bill_no          = $data[ 'bill_no' ];
        $grn->bill_date    = Carbon::now();
        $grn->due_date     = Carbon::now();
        $grn->payment_mode = 'cash';
        //$grn->comment          = $data[ 'comment' ];
        //$grn->invoice_number   = $data[ 'invoice_number' ];
        //$grn->invoice_amount   = $po_amount;
        $grn->loading_expense  = 0;
        $grn->freight_expense  = 0;
        $grn->other_expense    = 0;
        $grn->adj_amount       = 0;
        $grn->sales_tax        = 0;
        $grn->sales_tax_amount = 0;

        $total = $grn->loading_expense + $grn->freight_expense + $grn->other_expense + $grn->adj_amount + $po_amount;
        $tax   = 0;
        if($grn->sales_tax != 0) {
            $tax   = ($total * $grn->sales_tax) / 100;
            $total = $total + $tax;
        }
        $grn->sales_tax_amount = $tax;
        $grn->total_amount     = $total;

        if($grn->save()) {
            $quantity            = $this->saveGrnProducts($grn->id, $keepings, $data);
            $grn->total_quantity = $quantity;
            $grn->save();
        };

        return TRUE;

    }

    private function saveGrnProducts($id, $products, $data) {
        $keepingProducts = $products->keyBy('id')->toArray();
        $quantity        = 0;
        if(!empty($data[ 'products' ])) {
            foreach ($data[ 'products' ] as $index => $product) {
                if(!is_null($product) && $product > 0) {
                    $grnProduct                     = new StoreGrnProduct();
                    $grnProduct->grn_id             = $id;
                    $grnProduct->product_id         = $keepingProducts[ $index ][ 'product_id' ];
                    $grnProduct->product_keeping_id = $index;
                    $grnProduct->quantity           = $product;
                    $grnProduct->price              = $keepingProducts[ $index ][ 'price' ];

                    $grnProduct->save();
                    $quantity = $product + $quantity;
                }

            }
        }
        return $quantity;
    }

    public function getProductKeepings($productId) {
        $product  = $product = StoreProduct::whereId($productId)->withoutGlobalScope(IsDraftScope::class)->first();
        $allKeep  = [];
        $keepings = $this->getStoreProductKeeping($productId);
        if($product->default_variation == 1) {
            $k[] = \Config::get('constants_setting.DEFAULT_ATTRIBUTES.ATTRIBUTE_1.NAME');
            $k[] = \Config::get('constants_setting.DEFAULT_ATTRIBUTES.ATTRIBUTE_1.NAME');
            $k[] = $keepings[ 0 ][ 'cost_price' ];
            $k[] = $keepings[ 0 ][ 'price_log' ][ 'price' ];
            $k[] = '<input type="number" class="form-control" value="" name="products[' . $keepings[ 0 ][ 'id' ] . ']">';
            $k[] = '0.00';

            $allKeep[] = $k;
            return $allKeep;
        }

        foreach ($keepings as $keeping) {
            $k = [];
            if($keeping[ 'master_attribute_1' ] == -1 || $keeping[ 'master_attribute_2' ] == -1) {
                continue;
            }
            $k[] = $keeping[ 'value1' ][ 'value' ];
            $k[] = $keeping[ 'value2' ][ 'value' ];
            $k[] = $keeping[ 'cost_price' ];
            $k[] = $keeping[ 'price_log' ][ 'price' ];
            $k[] = '<input type="number" class="form-control" value="" name="products[' . $keeping[ 'id' ] . ']">';
            $k[] = '0.00';

            $allKeep[] = $k;
        }
        return $allKeep;
    }

    /**
     * @param $product_id
     *
     * @return int
     */
    public function getStoreProductKeeping($product_id) {

        $Product_Keeping = StoreProductKeeping::where('product_id', $product_id)
                                              ->with('value1')
                                              ->with('value2')
                                              ->with(['priceLog' => function ($query) {
                                                  //$query->where('start_date', '<=', Carbon::now()->format('Y-m-d'));
                                                  $query->orderBy('id', 'DESC');
                                              }])
                                              ->where('deleted_at', NULL)
                                              ->get();
        if(count($Product_Keeping) > 0) {
            return $Product_Keeping->toArray();
        } else {
            return 0;
        }
    }

    public function getUnits($store_id) {
        return Unit::where('store_id', $store_id)->whereNull('deleted_at')->get();
    }

    public function getTaxCodes($store_id) {
        return TaxCategory::where('store_id', $store_id)->whereNull('deleted_at')->get();
    }

    public function getProductVariations($user_id, $data) {
        $product_id        = $data[ 'product_id' ];
        $default_attribute = $data[ 'default_attribute' ];

        $keepings        = $this->getStoreProductKeeping($product_id);
        $savedAttributes = $this->getProductDefaultAttributes($product_id);
        return $data = $this->parseVariations($keepings, $savedAttributes, $default_attribute, $product_id);

    }

    public function getProductDefaultAttributes($productID) {
        $data = StoreProductAttribute::where("is_deleted", '!=', 1)->where('product_id', $productID)->with('defaults.attribute')->groupBy(['product_id', 'store_attribute_id'])->with('productAttribute.attributeValues')->get()->toArray();

        $productCategory = StoreProduct::where('id', $productID)->withoutGlobalScope(IsDraftScope::class)->first();

        return $this->parseDefaultAttributeData($data, $productCategory->category_id);
        /* $data = DB::table('store_category_attributes')
             ->join('store_attributes','store_category_attributes.store_attribute_id', '=', 'store_attributes.id')
             ->join('store_product_attributes','store_product_attributes.store_attributes.id', '=', 'store_product_attributes.store_attribute_id')
             ->*/
    }

    private function parseDefaultAttributeData($data, $catID) {
        $parentsCat = $this->getParentCategoriesId($catID);
        $defaults   = [];

        foreach ($data as $item) {
            $value = [];
            if(!empty($item[ 'defaults' ]) && in_array($catID, $parentsCat)) {
                $value[ 'attributeDetail' ] = $item[ 'defaults' ][ 'attribute' ];
                //$value['attribute_values'] = $item['attribute_values'];
                if(!empty($item[ 'product_attribute' ])) {
                    foreach ($item[ 'product_attribute' ] as $attr) {
                        $value[ 'attribute_values' ][] = $attr[ 'attribute_values' ];
                    }
                }
                $defaults[] = $value;
            }

        }
        return $defaults;
    }

    function getParentCategoriesId($child = 0, $category_tree_array = '') {
        if(!is_array($category_tree_array))
            $category_tree_array = array();

        $resCategories = $this->getParentChildCategories($child);

        if(count($resCategories) > 0) {
            foreach ($resCategories as $rowCategory) {
                $category_tree_array[] = $rowCategory[ 'id' ];
                $category_tree_array   = $this->getParentCategoriesId($rowCategory[ 'category_parent_id' ], $category_tree_array);
            }
        }

        return $category_tree_array;
    }

    function getParentChildCategories($child) {
        return $sub_categories = Category::select('id', 'category_parent_id')
                                         ->where('id', $child)
                                         ->orderBy('id', 'ASC')
                                         ->get();
    }

    private function parseVariations($keepings, $savedAttributes, $default_attribute, $product_id) {
        if($default_attribute == 1) {
            $variation[ 'is_new' ]     = 1;
            $variation[ 'start_date' ] = Carbon::now()->format('d-m-Y');
            if(!empty($keepings)) {
                $variation[ 'is_new' ]     = 0;
                $variation[ 'price' ]      = $keepings[ 0 ][ 'price_log' ][ 'price' ];
                $variation[ 'start_date' ] = Carbon::parse($keepings[ 0 ][ 'price_log' ][ 'start_date' ])->format('d-m-Y');
                $variation[ 'keeping_id' ] = $keepings[ 0 ][ 'id' ];
            }
            $variation[ 'value1' ]   = \Config::get('constants_setting.DEFAULT_ATTRIBUTES.ATTRIBUTE_1.NAME');
            $variation[ 'value2' ]   = \Config::get('constants_setting.DEFAULT_ATTRIBUTES.ATTRIBUTE_2.NAME');
            $variation[ 'value1Id' ] = \Config::get('constants_setting.DEFAULT_ATTRIBUTES.ATTRIBUTE_1.ID');
            $variation[ 'value2Id' ] = \Config::get('constants_setting.DEFAULT_ATTRIBUTES.ATTRIBUTE_2.ID');

            $all[ 'attribute1' ]   = 'Color';
            $all[ 'attribute2' ]   = 'Size';
            $all[ 'variations' ][] = $variation;
            $all[ 'attribute1Id' ] = -1;
            $all[ 'attribute2Id' ] = -1;
            return $all;
        }
        if($keepings != 0) {
            $keepingsData = $this->parseKeepings($keepings);
        }
        $product = StoreProduct::whereId($product_id)->withoutGlobalScope(IsDraftScope::class)->first();
        $all     = [];

        if(isset($savedAttributes[ 0 ]) && isset($savedAttributes[ 1 ])) {
            $all[ 'attribute1' ]   = $savedAttributes[ 0 ][ 'attributeDetail' ][ 'label' ];
            $all[ 'attribute2' ]   = $savedAttributes[ 1 ][ 'attributeDetail' ][ 'label' ];
            $all[ 'attribute1Id' ] = $savedAttributes[ 0 ][ 'attributeDetail' ][ 'id' ];
            $all[ 'attribute2Id' ] = $savedAttributes[ 1 ][ 'attributeDetail' ][ 'id' ];
            $variation             = [];
            foreach ($savedAttributes[ 0 ][ 'attribute_values' ] as $savedAttribute1) {

                foreach ($savedAttributes[ 1 ][ 'attribute_values' ] as $savedAttribute2) {
                    $variation[ 'is_new' ]     = 1;
                    $key                       = $savedAttribute1[ 'id' ] . '-' . $savedAttribute2[ 'id' ];
                    $key2                      = $savedAttribute2[ 'id' ] . '-' . $savedAttribute1[ 'id' ];
                    $variation[ 'start_date' ] = Carbon::now()->format('d-m-Y');
                    $variation[ 'price' ]    = $product->price;
                    if($keepings != 0 && (isset($keepingsData[ $key ]))) {
                        $variation[ 'is_new' ]     = 0;
                        $variation[ 'keeping_id' ] = $keepingsData[ $key ][ 'id' ];
                        $variation[ 'quantity' ]   = $keepingsData[ $key ][ 'quantity' ];
                        $variation[ 'price' ]      = $keepingsData[ $key ][ 'price_log' ][ 'price' ];
                        $variation[ 'start_date' ] = Carbon::parse($keepingsData[ $key ][ 'price_log' ][ 'start_date' ])->format('d-m-Y');
                    } elseif($keepings != 0 && (isset($keepingsData[ $key2 ]))) {
                        $variation[ 'is_new' ]     = 0;
                        $variation[ 'keeping_id' ] = $keepingsData[ $key2 ][ 'id' ];
                        $variation[ 'quantity' ]   = $keepingsData[ $key2 ][ 'quantity' ];
                        $variation[ 'price' ]      = $keepingsData[ $key2 ][ 'price_log' ][ 'price' ];
                        $variation[ 'start_date' ] = Carbon::parse($keepingsData[ $key ][ 'price_log' ][ 'start_date' ])->format('d-m-Y');
                    }
                    $variation[ 'value1' ]   = $savedAttribute1[ 'value' ];
                    $variation[ 'value2' ]   = $savedAttribute2[ 'value' ];
                    $variation[ 'value1Id' ] = $savedAttribute1[ 'id' ];
                    $variation[ 'quantity' ] = -1;
                    $variation[ 'value2Id' ] = $savedAttribute2[ 'id' ];

                    $all[ 'variations' ][]   = $variation;
                }

            }
        }

        return $all;
    }

    private function parseKeepings($keepings) {
        $allKeepings = [];
        foreach ($keepings as $keeping) {
            $keepingP[ $keeping[ 'master_attribute_1_value' ] . '-' . $keeping[ 'master_attribute_2_value' ] ] = $keeping;
            //$allKeepings[] = $keepingP;
        }
        return $keepingP;
    }

    private function addProductQuantityLog($keepings, $store_id) {
        if(!empty($keepings)) {
            foreach ($keepings as $keeping) {
                $exist = $this->checkIfDatePriceExist($keeping->id, Carbon::now()->format('Y-m-d'));

                if(!empty($exist)) {
                    $log = $exist;
                } else {
                    $log = new StoreProductPriceLog();
                }

                $log->product_id = $keeping->product_id;
                $log->keeping_id = $keeping->id;
                $log->price      = $keeping->price;
                $log->start_date = Carbon::now();
                $log->save();
            }
        }
    }

    private function addkeepingLogById($logData) {
        StoreProductKeepingLog::insert($logData);
    }

    private function addKeepingLog($keepings, $store_id) {

        foreach ($keepings as $keeping) {
            $keepingLog = $this->checkIfSaved($keeping->id, $keeping->product_id);
            if(empty($keepingLog)) {
                $keepingLog = new StoreProductKeepingLog();
            }

            $keepingLog->product_id         = $keeping->product_id;
            $keepingLog->object_type        = 'store';
            $keepingLog->object_id          = $store_id;
            $keepingLog->quantity           = $keeping->quantity;
            $keepingLog->type               = 'credit';
            $keepingLog->transaction_type   = 'add';
            $keepingLog->product_keeping_id = $keeping->id;
            $keepingLog->save();
        }
    }

    private function checkIfSaved($id, $product_id) {
        return StoreProductKeepingLog::whereProductId($product_id)->where('product_keeping_id', $id)->first();
    }

}

