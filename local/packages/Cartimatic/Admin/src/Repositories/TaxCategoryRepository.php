<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 01-Jun-16 4:31 PM
 * File Name    : CategoryAttributeRepository.php
 */

namespace Cartimatic\Admin\Repositories;


use Cartimatic\Admin\Http\TaxCategory;

class TaxCategoryRepository
{
    public function getCategories($limit = 25 ,$user_id) {
        return $categories = TaxCategory::where('store_id' ,$user_id)->paginate($limit);
    }

    public function storeTaxCategory($request=null ,$user_id)
    {
        $tax_category = new TaxCategory();

	    $tax_category->name       = $request['name'];
	    $tax_category->value      = $request['value'];
	    $tax_category->tax_code   = $request['tax_code'];
	    $tax_category->is_percent = $request['is_percent'];
	    $tax_category->store_id   = $user_id;

        $tax_category->save();

        return 1;
    }

    public function deleteTaxCategory($tax_category_id=0)
    {
        return TaxCategory::where('id', $tax_category_id)->delete();
    }

    public function findTaxCategory($tax_category_id=0)
    {
        return TaxCategory::where('id', $tax_category_id)->first();
    }

    public function updateTaxCategory($tax_category_id=0, $input=0)
    {
	    $tax_category =TaxCategory::where('id', $tax_category_id)->first();

	    //$tax_category->name       = $input['name'];
	    $tax_category->value      = $input['value'];
	    //$tax_category->tax_code   = $input['tax_code'];
	    $tax_category->is_percent = $input['is_percent'];
	    $tax_category->store_id   = $input['store_id'];
	    $tax_category->save();
	    return $tax_category;
    }
}
