<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 01-Jun-16 4:31 PM
 * File Name    : CategoryAttributeRepository.php
 */

namespace Cartimatic\Admin\Repositories;

use Cartimatic\Admin\Http\Controllers\CategoryAttributes;
use Cartimatic\Admin\Http\StoreAttribute;
use Cartimatic\Admin\Http\StoreAttributeValue;
use Cartimatic\Admin\Http\StoreCategoryAttribute;
use Cartimatic\Store\Category;
use Cartimatic\Store\StoreProductKeeping;
use Illuminate\Support\Facades\DB;

class CategoryAttributeRepository
{
    public function getCategories($cid) {
        $categories = Category::where('category_parent_id', $cid)->orderBy('name', 'ASC')->lists('name', 'id');

        return $categories;
    }

    public function getAttributes($catId, $parentCatId) {

        //$data[ 'allAttributes' ] = StoreAttribute::orderBy('label', 'ASC')->lists('label', 'id');
        /* $data[ 'selected' ]      = StoreCategoryAttribute::where(function ($query) use ($catId, $parentCatId) {
             $query->where('category_id', $catId);
             if($parentCatId != 0) {
                 $query->orWhere('category_id', $parentCatId);
             }

         })->lists('store_attribute_id');*/
        $categories              = $this->getParentCategoriesId($catId);
        $data[ 'allAttributes' ] = StoreCategoryAttribute::whereIn('category_id', $categories)->with('attribute')->groupBy('store_attribute_id')->get()->toArray();

        $checkCategoryAttributes = StoreCategoryAttribute::where('category_id', $catId)->lists('store_attribute_id');
        if(count($checkCategoryAttributes) != 0) {
            $data[ 'selected' ] = $checkCategoryAttributes;
        } else {
            $data[ 'selected' ] = [];
            foreach ($data[ 'allAttributes' ] as $allAttribute) {
                $data[ 'selected' ][] = $allAttribute[ 'store_attribute_id' ];
            }
        }

        return $data;
    }

    public function saveAttributes($catId, $attributes, $selectedAttributes, $lineItemAttributes='') {
        if(empty($selectedAttributes)) {
            $selectedAttributes = [];
        }
        $this->updateAttributes($catId, $selectedAttributes, $lineItemAttributes);

        if(!empty($attributes)) {
            foreach ($attributes as $k => $attribute) {
                if(!empty($attribute)){
                    $this->saveAttribute($catId, $attribute, $lineItemAttributes[$k]);
                }

            }
        }

        return 1;
    }

    private function saveAttribute($catId, $attribute, $lineItemAttribute='') {

        $result = $this->checkIfAttributeSaved($attribute, $catId);

        if(count($result) == 0) {
            $attributeClass        = new StoreAttribute();
            $attributeClass->label = $attribute;
            $attributeClass->is_line_item = $lineItemAttribute;
            $attributeClass->save();
            $id = $attributeClass->id;
            return $this->assignAttribute($catId, $id);
        } else {
            $isAssigned = $this->checkIfAttributeAssigned($catId,$result->id);
            if(empty($isAssigned)){
                $id = $result->id;
                return $this->assignAttribute($catId, $id);
            }

        }
    }

    private function assignAttribute($catId, $attribute_id) {
        $categoryAttribute                     = new StoreCategoryAttribute();
        $categoryAttribute->category_id        = $catId;
        $categoryAttribute->store_attribute_id = $attribute_id;
        $categoryAttribute->save();
        return TRUE;
    }

    private function deleteAttribute($catId, $attribute_id) {
        $attributeForDelete = StoreCategoryAttribute::where('category_id', $catId)->where('store_attribute_id', $attribute_id);
        $attributeForDelete->delete();
    }

    private function updateAttributes($catId, $selectedAttributes, $lineItemAttributes='') {
        $categoryAttributes = $this->getSingleCategoryAttribute($catId);

        if(count($categoryAttributes) == 0) {
            foreach ($selectedAttributes as $selectedAttribute) {
                $this->assignAttribute($catId, $selectedAttribute);
            }
        } else {
            foreach ($categoryAttributes as $categoryAttribute) {
                if(!in_array($categoryAttribute, $selectedAttributes)) {
                    $this->deleteAttribute($catId, $categoryAttribute);
                }
            }
        }

    }

    private function getSingleCategoryAttribute($catId) {
        return StoreCategoryAttribute::where('category_id', $catId)->lists('store_attribute_id');
    }

    public function getAttributeValues($catId) {
        $data[ 'attributeValues' ] = StoreCategoryAttribute::where('category_id', $catId)->with('attribute')->with('attributeValues')->get()->toArray();
        return $data;
    }

    //Start Child to till parent
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

    public function saveValues($data) {
        $values      = (isset($data[ 'values' ]) ? $data[ 'values' ] : 0);
        $codes      = (isset($data[ 'codes' ]) ? $data[ 'codes' ] : 0);
        $attributeId = $data[ 'attributeId' ];
        $is_default  = $data[ 'defaultAttr' ];
        $categoryId  = $data[ 'catId' ];
        $this->changeAttributeDefault($attributeId, $is_default, $categoryId);
        if($values != 0) {
            foreach ($values as $key => $value) {
                if(!empty($value)){
                    $this->saveValue($attributeId, $value, $is_default, $codes[$key]);
                }

            }
        }

        return TRUE;
    }

    private function saveValue($attributeId, $value, $is_default, $code='') {
        $ifSaved = $this->checkIfSaved($value, $attributeId);
        if($ifSaved == 0) {
            $storeAttributeValue = new StoreAttributeValue();

            $storeAttributeValue->store_attribute_id = $attributeId;
            $storeAttributeValue->value              = $value;
            $storeAttributeValue->code               = $code;
            $storeAttributeValue->save();
        }

        return TRUE;
    }

    private function checkIfSaved($value, $attributeId) {
        return StoreAttributeValue::where('value', $value)->where('store_attribute_id', $attributeId)->count();
    }

    public function getAttributesValues($attributeId) {
        return StoreAttributeValue::where('store_attribute_id', $attributeId)->lists('value', 'id');
    }

    public function deleteValue($valueId) {
      $keeping = StoreProductKeeping::select('id')->where('master_attribute_1_value', $valueId)->orWhere('master_attribute_2_value', $valueId)->first();
      if(!isset($keeping->id)){
        StoreAttributeValue::destroy($valueId);
        return 1;
      }
      return 0;
    }

    private function checkIfAttributeSaved($attribute, $catId) {
        $parentsCat = $this->getParentCategoriesId($catId);
        /*return StoreCategoryAttribute::whereIn('category_id', $parentsCat)->with(['attribute' => function($query) use($attribute){
            $query->where('label',$attribute);
        }])->get()->toArray();*/

        return \DB::table('store_category_attributes')
                  ->join('store_attributes', 'store_attributes.id', '=', 'store_category_attributes.store_attribute_id')
                  ->whereIn('store_category_attributes.category_id', $parentsCat)
                  ->where('store_attributes.label', $attribute)->select('store_attributes.id')->first();

        //return StoreAttribute::where('label', $attribute)->first();
    }

    private function changeAttributeDefault($attributeId, $is_default, $categoryId) {
        $categoryAttribute             = StoreCategoryAttribute::where('store_attribute_id', $attributeId)->where('category_id', $categoryId)->first();
        $categoryAttribute->is_default = $is_default;
        $categoryAttribute->save();
    }

    private function checkIfAttributeAssigned($catId, $id) {
      return  StoreCategoryAttribute::where('category_id', $id)->where('store_attribute_id', $id)->first();
    }

}
