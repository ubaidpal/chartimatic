<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 01-Jun-16 4:12 PM
 * File Name    : CategoryAttributes.php
 */

namespace Cartimatic\Admin\Http\Controllers;

use Cartimatic\Admin\Http\StoreAttributeValue;
use Cartimatic\Admin\Http\StoreCategoryAttribute;
use Cartimatic\Admin\Repositories\CategoryAttributeRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CategoryAttributes extends Controller
{
    protected $data;
    protected $categoryAttributeRepository;

    /**
     * CategoryAttributes constructor.
     */
    public function __construct(CategoryAttributeRepository $categoryAttributeRepository) {
        @$this->data->title = 'Category attributes';
        $this->categoryAttributeRepository = $categoryAttributeRepository;
    }

    public function index() {
        $this->data->categories = $this->categoryAttributeRepository->getCategories(0);
        $data                   = (array)$this->data;
        return view('Admin::Category.index', $data);
    }

    public function getCategories() {
        $catId = \Input::get('catId');
        return $this->categoryAttributeRepository->getCategories($catId);
    }

    public function getAttributes(Request $request) {
        return $this->categoryAttributeRepository->getAttributes($request->catId, $request->parentCatId);
    }

    public function saveAttributes(Request $request) {
        $this->categoryAttributeRepository->saveAttributes($request->get('catId'), $request->get('attributes'), $request->get('selectedAttributes'), $request->get('lineItemAttributes'));
        return $this->categoryAttributeRepository->getAttributeValues($request->get('catId'));
    }

    public function saveValues(Request $request) {
        $this->categoryAttributeRepository->saveValues($request->all());
        return $this->categoryAttributeRepository->getAttributesValues($request->get('attributeId'));
    }

    public function deleteValues(Request $request){
        return $this->categoryAttributeRepository->deleteValue($request->get('valueId'));
    }

  public function isAttrValueUniqueCode(Request $request)
  {
    $category_id = $request->category_id;
    $code = $request->code;
    $store_attribute_ids = [];
    $sameCodeAttValues = StoreAttributeValue::where('code', $code)->get();
    if(is_object($sameCodeAttValues)){
      $sameCodeAttValues = $sameCodeAttValues->toArray();
      $store_attribute_ids = array_column($sameCodeAttValues, 'store_attribute_id');
    }

    //$results = select * from store_attribute_values where code = '$code'
    //get array_column of store_attribute_id from $results and select store_category_attributes where category = $category_id
    $isUniqueCode = StoreCategoryAttribute::whereIn('store_attribute_id', $store_attribute_ids)->where('category_id', $category_id)->count();
    //if count is > 0 then it is already existing.
    if($isUniqueCode > 0){
      return 0;
    }
    return 1;
  }
}
