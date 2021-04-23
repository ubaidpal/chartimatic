<?php

namespace Cartimatic\Store\Http\admin;

use App\AgeGroup;
use App\CalenderSeason;
use App\Http\Controllers\Controller;
use App\LifeType;
use App\LineItems;
use App\ProductGender;
use App\ProductTemplate;
use App\StoreGroup;
use App\Unit;
use App\ValueAddition;
use Cartimatic\Admin\Http\StoreAttribute;
use Cartimatic\Admin\Http\StoreAttributeValue;
use Cartimatic\Admin\Http\TaxCategory;
use Cartimatic\Admin\Repositories\TaxCategoryRepository;
use Cartimatic\Store\StoreBrand;
use Cartimatic\Store\StoreProduct;
use Cartimatic\Store\StoreProductGroup;
use Cartimatic\Store\StoreProductKeeping;
use Cartimatic\Store\StorePurchaseOrder;
use Cartimatic\Store\StorePurchaseOrderProducts;
use Cartimatic\Store\StoreSupplier;
use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Input;

class StoreManagementController extends Controller {

	protected $data;
	protected $taxCategoryRepository;
    /**
     * StoreManagementController constructor.
     */
    public function __construct(Request $request,TaxCategoryRepository $taxCategoryRepository)
    {
        parent::__construct();
        $this->request = $request;
        $this->user_id = $request[ 'middleware' ][ 'user_id' ];
        $this->user    = $request[ 'middleware' ][ 'user' ];
	    @$this->data->title = 'Tax Categories';
	    $this->taxCategoryRepository = $taxCategoryRepository;
    }

    public function suppliers($store_id)
    {
        $data['store_id'] = $store_id;
        $suppliers = StoreSupplier::where('is_deleted',0)->where('store_id',$this->user_id)->orderBy('id','DESC')->paginate();
        $data['suppliers'] = $suppliers;

        return view('Store::admin.store_management.suppliers',$data);
    }

    public function addSupplier($store_id,$supplier_id = null)
    {
        $data['store_id'] = $store_id;

        $supplier = [];
        if(!empty($supplier_id))
        {
            $supplier = StoreSupplier::where('id',$supplier_id)->first();
        }

        $data['supplier'] = $supplier;

        return view('Store::admin.store_management.add-supplier',$data);
    }
    public function postSupplier($store_id)
    {
        $supplier_id = \Request::get('supplier-id');
        $rules = ['name' => 'required'];
        $code = trim(\Request::get('code'));

        if(!empty($code))
        {
            $rules['code'] = 'unique:store_suppliers,code,'.$supplier_id.',id,store_id,'.$this->user_id;
        }

        $validator = \Validator::make(['name' => \Request::get('name'),'code' => $code],$rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->getMessageBag())->withInput();
        }

        if(empty($supplier_id)) {

            $supplierObj = new StoreSupplier();

            $supplierObj->store_id = $this->user_id;
            $supplierObj->name = \Request::get('name');
            $supplierObj->contact_no = \Request::get('contact_no');
            $supplierObj->code = \Request::get('code');
            $supplierObj->address = \Request::get('address');
            $supplierObj->city = \Request::get('city');
            $supplierObj->phone_1 = \Request::get('phone_1');
            $supplierObj->phone_2 = \Request::get('phone_2');
            $supplierObj->mobile = \Request::get('mobile');
            $supplierObj->email = \Request::get('email');
            $supplierObj->fax = \Request::get('fax');
            $supplierObj->ntn = \Request::get('ntn');
            $supplierObj->opening_balance = \Request::get('opening_balance');
            $supplierObj->opening_date = \Request::get('opening_date');
            $supplierObj->end_date = \Request::get('end_date');
            $supplierObj->comments = \Request::get('comments');
            $supplierObj->gl_account = (\Request::get('gl_account') == '')?'n/a':\Request::get('gl_account');

            $supplierObj->save();

        }else{

            $supplier = StoreSupplier::where('id',$supplier_id)->where('store_id',$this->user_id)->first();

            if(!empty($supplier->id)) {
                $supplier->name = \Request::get('name');
                $supplier->contact_no = \Request::get('contact_no');
                $supplier->code = \Request::get('code');
                $supplier->address = \Request::get('address');
                $supplier->city = \Request::get('city');
                $supplier->phone_1 = \Request::get('phone_1');
                $supplier->phone_2 = \Request::get('phone_2');
                $supplier->mobile = \Request::get('mobile');
                $supplier->email = \Request::get('email');
                $supplier->fax = \Request::get('fax');
                $supplier->ntn = \Request::get('ntn');
                $supplier->opening_balance = \Request::get('opening_balance');
                $supplier->opening_date = \Request::get('opening_date');
                $supplier->end_date = \Request::get('end_date');
                $supplier->comments = \Request::get('comments');
                $supplier->gl_account = (\Request::get('gl_account') == '')?'n/a':\Request::get('gl_account');

                $supplier->save();
            }
        }
        return redirect()->to('store/'.$store_id.'/admin/suppliers');
    }
    public function deleteSupplier($store_id,$supplier_id)
    {
	    $product_exist = DB::table( 'store_products' )->where('supplier_id' , $supplier_id)->first();

	    if(count($product_exist) > 0){
		    Session::flash('message', 'Record is not deleted!!!');
		    return redirect()->back();
	    }
        $supplier = StoreSupplier::where('id',$supplier_id)->where('store_id',$this->user_id)->first();
        if(!empty($supplier->id))
        {
            $supplier->is_deleted = 1;
            $supplier->save();
        }

        return redirect()->back();
    }

    public function brands($store_id)
    {
        $data['store_id'] = $store_id;
        $suppliers = StoreBrand::where('is_deleted',0)->where('store_id',$this->user_id)->orderBy('id','DESC')->paginate();
        $data['suppliers'] = $suppliers;

        return view('Store::admin.store_management.brands',$data);
    }

    public function addBrand($store_id,$supplier_id = null)
    {
        $data['store_id'] = $store_id;

        $supplier = [];
        if(!empty($supplier_id))
        {
            $supplier = StoreBrand::where('id',$supplier_id)->first();
        }

        $data['supplier'] = $supplier;

        return view('Store::admin.store_management.add-brand',$data);
    }
    public function postBrand($store_id)
    {

        $supplier_id = \Request::get('supplier-id');
        $rules = ['name' => 'required'];

        $code = trim(\Request::get('code'));

        if(!empty($code))
        {
            $rules['code'] = 'unique:store_brands,code,'.$supplier_id.',id,store_id,'.$this->user_id;
        }

        $validator = \Validator::make(['name' => \Request::get('name'),'code' => $code],$rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->getMessageBag())->withInput();
        }

        if(empty($supplier_id)) {

            $brandObj = new StoreBrand();

          $brandObj->store_id = $this->user_id;
          $brandObj->name = \Request::get('name');
          $brandObj->code = $code;
          $brandObj->contact_no = \Request::get('contact_no');
          $brandObj->address = \Request::get('address');
          $brandObj->city = \Request::get('city');
          $brandObj->phone_1 = \Request::get('phone_1');
          $brandObj->phone_2 = \Request::get('phone_2');
          $brandObj->mobile = \Request::get('mobile');
          $brandObj->email = \Request::get('email');
          $brandObj->fax = \Request::get('fax');
          $brandObj->ntn = \Request::get('ntn');
          $brandObj->opening_balance = \Request::get('opening_balance');
          $brandObj->opening_date = \Request::get('opening_date');
          $brandObj->end_date = \Request::get('end_date');
          $brandObj->comments = \Request::get('comments');
          $brandObj->gl_account = (\Request::get('gl_account') == '')?'n/a':\Request::get('gl_account');

          $brandObj->save();
        }else{

            $brand = StoreBrand::where('id',$supplier_id)->where('store_id',$this->user_id)->first();

            if(!empty($brand->id)) {
              $brand->name = \Request::get('name');
              $brand->code = $code;
              $brand->contact_no = \Request::get('contact_no');
              $brand->address = \Request::get('address');
              $brand->city = \Request::get('city');
              $brand->phone_1 = \Request::get('phone_1');
              $brand->phone_2 = \Request::get('phone_2');
              $brand->mobile = \Request::get('mobile');
              $brand->email = \Request::get('email');
              $brand->fax = \Request::get('fax');
              $brand->ntn = \Request::get('ntn');
              $brand->opening_balance = \Request::get('opening_balance');
              $brand->opening_date = \Request::get('opening_date');
              $brand->end_date = \Request::get('end_date');
              $brand->comments = \Request::get('comments');
              $brand->gl_account = (\Request::get('gl_account') == '')?'n/a':\Request::get('gl_account');

              $brand->save();
            }
        }
        return redirect()->to('store/'.$store_id.'/admin/brands');
    }
    public function deleteBrand($store_id,$supplier_id)
    {
        $supplier = StoreBrand::where('id',$supplier_id)->where('store_id',$this->user_id)->first();
        if(!empty($supplier->id))
        {
            $supplier->is_deleted = 1;
            $supplier->save();
        }

        return redirect()->back();
    }

    public function productGroups($store_id)
    {
        $data['store_id'] = $store_id;
        $suppliers = StoreProductGroup::where('is_deleted',0)->where('store_id',$this->user_id)->paginate();
        $data['suppliers'] = $suppliers;

        return view('Store::admin.store_management.product-groups',$data);
    }
/**************************************productTemplate******************************************/
	public function productTemplate($store_id)
	{
		$data['store_id'] = $store_id;
		$productTemplate = ProductTemplate::where('deleted_at',Null)->where('store_id',$this->user_id)->orderBy('sort_number', 'asc')->paginate();
		$data['productTemplate'] = $productTemplate;
		return view('Store::admin.productTemplate.product-template',$data);
	}


	public function savedProductTemplate(Request $request ,$store_id)
	{

		$this->validate($request, [
			'category_id' => 'required',
			'name'        => 'required',
			'code'        => 'required',
			'sort_number' => 'numeric',
		]);

		$productTemp = ProductTemplate::where( 'deleted_at', null )->where( 'code', $request->code )->where('store_id',$this->user_id)->orWhere( 'name', $request->name )->first();

		if(count($productTemp) > 0){
			if($productTemp->code == $request->code &&  $productTemp->category_id == $request->category_id && $productTemp->store_id == $this->user_id ){
				$data = $this->productTemplateChkCondition($store_id,$request);
				Session::flash('message', 'The Product Code Must be Different');
				return view('Store::admin.productTemplate.product-template',$data);
			}elseif ($productTemp->name == $request->name &&  $productTemp->category_id == $request->category_id && $productTemp->store_id == $this->user_id) {
				$data = $this->productTemplateChkCondition( $store_id, $request );
				Session::flash('message', 'The Product Name Must be Different');
				return view('Store::admin.productTemplate.product-template',$data);
			}elseif ($productTemp->name == $request->name &&  $productTemp->code == $request->code &&  $productTemp->category_id == $request->category_id && $productTemp->store_id == $this->user_id) {
				$data = $this->productTemplateChkCondition( $store_id, $request );
				Session::flash('message', 'The Product Code or Name Must be Different');
				return view('Store::admin.productTemplate.product-template',$data);
			}
		}

		$data['store_id'] = $store_id;
		$productTemplate = new ProductTemplate();
		$productTemplate->category_id = $request->category_id;
		$productTemplate->name = $request->name;
		$productTemplate->code = $request->code;
		$productTemplate->store_id = $this->user_id;
		if(count($request->sort_number) > 0){
			$productTemplate->sort_number = $request->sort_number;
		}else{
			$productTemplate->sort_number = 0;
		}
		$productTemplate->save();

		$productTemplate = ProductTemplate::where('deleted_at',Null)->orderBy('sort_number', 'asc')->where('store_id',$this->user_id)->paginate();
		$data['productTemplate'] = $productTemplate;
		$data['parent_category_id'] = $request->category_id;
		Session::flash('success', 'Record Add Successfully!!!');
		return view('Store::admin.productTemplate.product-template',$data);
	}

	public function productTemplateChkCondition($store_id,$request  ) {
		$data['store_id'] = $store_id;
		$productTemplate = ProductTemplate::where('deleted_at',Null)->where('store_id',$this->user_id)->orderBy('sort_number', 'asc')->paginate();
		$data['productTemplate'] = $productTemplate;
		$data['parent_category_id'] = $request->category_id;
		$data['name'] = $request->name;
		$data['code'] = $request->code;
		$data['sort_number'] = $request->sort_number;
		return $data;

	}

	public function deleteProductTemplate($store_id , $product_id)
	{
		$productDelete = ProductTemplate::where('id',$product_id)->delete();
		if($productDelete > 0){
			$data['store_id'] = $store_id;
			$productTemplate = ProductTemplate::where('deleted_at',Null)->orderBy('sort_number', 'asc')->paginate();
			$data['productTemplate'] = $productTemplate;
			Session::flash('success', 'Delete Record Successfully!!!');
			return view('Store::admin.productTemplate.product-template',$data);
		}

	}
	public function editProductTemplate($store_id ,$product_id)
	{
			$data['store_id'] = $store_id;
			$productTemplate =  ProductTemplate::where('id',$product_id)->where('deleted_at',Null)->first();
			$data['productTemplate'] = $productTemplate;
			return view('Store::admin.productTemplate.product-template-update',$data);

	}

	public function updateProductTemplate(Request $request ,$store_id ,$product_id)
	{
		$this->validate($request, [
			'category_id' => 'required',
			'sort_number' => 'numeric',
		]);


		$productTemplate =  ProductTemplate::where('id',$product_id)->where('deleted_at',Null)->first();
		$productTemplate->category_id = $request->category_id;
		$productTemplate->store_id = $this->user_id;
		if(count($request->sort_number) > 0){
			$productTemplate->sort_number = $request->sort_number;
		}else{
			$productTemplate->sort_number = 0;
		}
		$productTemplate->save();
		if($productTemplate->save()){
			/*$data['store_id'] = $store_id;
			$productTemplate = ProductTemplate::where('deleted_at',Null)->orderBy('sort_number', 'asc')->where('store_id',$this->user_id)->paginate();
			$data['productTemplate'] = $productTemplate;
			return view('Store::admin.productTemplate.product-template',$data);
			*/
			Session::flash('success', 'Record Update Successfully!!!');
			return redirect()->to('store/'.$store_id.'/admin/productTemplate');

		}

	}
	public function productTemplateFilter() {

		$category_id = Input::get( 'category' );
		$store_id = Input::get( 'store_id' );

		if($category_id > 0){
			$products = $this->filtersTemplate($category_id,$store_id);
			return $products;

		}else{
			$products = $this->fullFiltersTemplate($store_id);

			return $products;

		}


	}
	public function filtersTemplate($category_id,$store_id) {

		$productTemplate = ProductTemplate::where('deleted_at',Null)->orderBy('sort_number', 'asc')->
			where('category_id' ,$category_id)->where('store_id',$this->user_id)->paginate();

		if(count($productTemplate) > 0){
		$html = '';
		foreach ($productTemplate as $record):
			$html .= '<tr>';
			$html .= ' <td>'.$record->name.'</td>';
			$html .= ' <td>'.$record->code.'</td>';
			$html .= ' <td>'.$record->sort_number.'</td>';
			/*$html .= '<td><a href="'.url('store/'.$store_id.'/admin/editProductTemplate/'.$record->id).'" title="Edit">
                                                    <i class="fa fa-edit fa-2x"></i>
                                                </a>
                                                <a data-toggle="confirmation" data-href="'.url('store/'.$store_id.'/admin/deleteProductTemplate/'.$record->id).'" title="Delete">
                                                    <i class="fa fa-trash fa-2x"></i>
                                                </a>
                                                </td>';*/

			$html .= '</tr>';
		endforeach;
		return $html;
		}else{
			return $html = '<tr><td>No Product Found</td></tr>';
		}

	}
	public function fullFiltersTemplate($store_id) {
		$productFullTemplate = ProductTemplate::where('deleted_at',Null)->where('store_id',$this->user_id)->orderBy('sort_number', 'asc')->paginate();
		if(count($productFullTemplate) > 0) {
			$html = '';
			foreach ( $productFullTemplate as $record ):
				$html .= '<tr>';
				$html .= ' <td>' . $record->name . '</td>';
				$html .= ' <td>' . $record->code . '</td>';
				$html .= ' <td>' . $record->sort_number . '</td>';
				/*$html .= '<td><a href="' . url( 'store/' . $store_id . '/admin/editProductTemplate/' . $record->id ) . '" title="Edit">
                                                    <i class="fa fa-edit fa-2x"></i>
                                                </a>
                                                <a data-toggle="confirmation" data-href="' . url( 'store/' . $store_id . '/admin/deleteProductTemplate/' . $record->id ) . '" title="Delete">
                                                    <i class="fa fa-trash fa-2x"></i>
                                                </a>
                                                </td>';*/

				$html .= '</tr>';
			endforeach;

			return $html;
		}else{
			return $html = '<tr><td>No Product Found</td></tr>';
		}
	}
/**************************************End ProductTemplate******************************************/

/******************************************unit***************************************************/

	public function unit($store_id)
	{
		$data['store_id'] = $store_id;
		$unit = Unit::where('deleted_at',Null)->orderBy('sort_number', 'asc')->where('store_id',$this->user_id)->paginate();
		$data['Unit'] = $unit;
		return view('Store::admin.unit.unit',$data);
	}

	public function savedUnit(Request $request ,$store_id)
	{

		$this->validate($request, [
			'name'        => 'required',
			'code'        => 'required',
			'sort_number' => 'numeric',

		]);

		$productUnit = Unit::where('deleted_at',Null)->where('code', $request->code)->orWhere('name', $request->name)->where('store_id',$this->user_id)->first();

		if(count($productUnit) > 0){

			if($productUnit->code == $request->code  && $productUnit->store_id == $this->user_id){
				$data = $this->UnitCheckCondition($store_id,$request);
				Session::flash('message', 'The Unit Code or Name Must be Different');
				return view('Store::admin.unit.unit',$data);
			}elseif ($productUnit->name == $request->name && $productUnit->store_id == $this->user_id ) {
				$data = $this->UnitCheckCondition( $store_id, $request );
				Session::flash('message', 'The Unit Code or Name Must be Different');
				return view('Store::admin.unit.unit',$data);
			}elseif ($productUnit->name == $request->name &&  $productUnit->code == $request->store_id && $productUnit->store_id == $this->user_id) {
				$data = $this->UnitCheckCondition( $store_id, $request );
				Session::flash('message', 'The Unit Code or Name Must be Different');
				return view('Store::admin.unit.unit',$data);
			}

		}


		$data['store_id'] = $store_id;
		$productTemplate = new Unit();
		$productTemplate->name = $request->name;
		$productTemplate->code = $request->code;
		$productTemplate->store_id = $this->user_id;
		if(count($request->sort_number) > 0){
			$productTemplate->sort_number = $request->sort_number;
		}else{
			$productTemplate->sort_number = 0;
		}
		$productTemplate->comments = $request->comments;
		$productTemplate->save();

		$productTemplate = Unit::where('deleted_at',Null)->orderBy('sort_number', 'asc')->paginate();
		$data['Unit'] = $productTemplate;
		$data['parent_category_id'] = $request->category_id;
		Session::flash('success', 'Record Add Successfully!!!');
		return view('Store::admin.unit.unit',$data);
	}

	public function UnitCheckCondition($store_id,$request) {
		$data['store_id'] = $store_id;
		$getUnit = Unit::where('deleted_at',Null)->orderBy('sort_number', 'asc')->where('store_id',$this->user_id)->paginate();
		$data['Unit'] = $getUnit;
		$data['name'] = $request->name;
		$data['code'] = $request->code;
		$data['sort_number'] = $request->sort_number;
		$data['comments'] = $request->comments;
		return $data;
	}

	public function deleteUnit($store_id , $product_id)
	{
		$product_exist = DB::table( 'store_products' )->where('unit_id' , $product_id)->first();

		if(count($product_exist) > 0){
			Session::flash('message', 'Record is not deleted!!!');
			return redirect()->back();
		}

		$productDelete = Unit::where('id',$product_id)->delete();
		if($productDelete > 0){
			$data['store_id'] = $store_id;
			$Unit = Unit::where('deleted_at',Null)->orderBy('sort_number', 'asc')->paginate();
			$data['Unit'] = $Unit;
			Session::flash('success', 'Delete Record Successfully!!!');
			return view('Store::admin.unit.unit',$data);
		}

	}

	public function editUnit($store_id ,$product_id)
	{
		$data['store_id'] = $store_id;
		$Unit =  Unit::where('id',$product_id)->where('deleted_at',Null)->first();
		$data['Unit'] = $Unit;
		return view('Store::admin.unit.unit-update',$data);

	}

	public function updateUnit(Request $request ,$store_id ,$product_id)
	{
		$this->validate($request, [

			'sort_number' => 'numeric',
		]);

		$unit =  Unit::where('id',$product_id)->where('deleted_at',Null)->first();
		$unit->store_id = $this->user_id;
		if(count($request->sort_number) > 0){
			$unit->sort_number = $request->sort_number;
		}else{
			$unit->sort_number = 0;
		}
		$unit->comments = $request->comments;
		$unit->save();
		if($unit->save()){
			Session::flash('success', 'Record Update Successfully!!!');
			return redirect()->to('store/'.$store_id.'/admin/unit');
		}

	}
/******************************************End unit***************************************************/

/******************************************Product Group***************************************************/

	public function productGroup($store_id)
	{
		$data['store_id'] = $store_id;
		$storeGroup = StoreGroup::where('deleted_at',Null)->orderBy('sort_number', 'asc')->where('store_id',$this->user_id)->paginate();
		$data['storeGroup'] = $storeGroup;
		return view('Store::admin.productGroup.product-group',$data);
	}


	public function savedProductGroup(Request $request ,$store_id)
	{

		$this->validate($request, [
			'category_id' => 'required',
			'name'        => 'required',
			'code'        => 'required',
			'sort_number' => 'numeric',
		]);

		$storeGroup = StoreGroup::where( 'deleted_at', null )->where( 'code', $request->code )->where('store_id',$this->user_id)->orWhere( 'name', $request->name )->first();

		if(count($storeGroup) > 0){
			if($storeGroup->code == $request->code &&  $storeGroup->category_id == $request->category_id
		&&  $storeGroup->store_id == $this->user_id){
				$data = $this->storeCheckCondition($store_id,$request);
				Session::flash('message', 'The Product Code Must be Different');
				return view('Store::admin.productGroup.product-group',$data);
			}elseif ($storeGroup->name == $request->name &&  $storeGroup->category_id == $request->category_id &&  $storeGroup->store_id == $this->user_id) {
				$data = $this->storeCheckCondition( $store_id, $request );
				Session::flash('message', 'The Product Name Must be Different');
				return view('Store::admin.productGroup.product-group',$data);
			}elseif ($storeGroup->name == $request->name &&  $storeGroup->code == $request->code &&  $storeGroup->category_id == $request->category_id &&  $storeGroup->store_id == $this->user_id) {
				$data = $this->storeCheckCondition( $store_id, $request );
				Session::flash('message', 'The Product Code or Name Must be Different');
				return view('Store::admin.productGroup.product-group',$data);
			}
		}

			$data['store_id'] = $store_id;
			$storeGrp = new StoreGroup();
			$storeGrp->category_id = $request->category_id;
			$storeGrp->name = $request->name;
			$storeGrp->code = $request->code;
			$storeGrp->store_id = $this->user_id;
			if(count($request->sort_number) > 0){
				$storeGrp->sort_number = $request->sort_number;
			}else{
				$storeGrp->sort_number = 0;
			}

			$storeGrp->comments = $request->comments;
			$storeGrp->save();

			$storeGroup = StoreGroup::where('deleted_at',Null)->where('store_id',$this->user_id)->orderBy('sort_number', 'asc')->paginate();
			$data['storeGroup'] = $storeGroup;
			$data['parent_category_id'] = $request->category_id;
			Session::flash('success', 'Record Add Successfully!!!');
			return view('Store::admin.productGroup.product-group',$data);

	}

	public function storeCheckCondition($store_id,$request) {
		$data['store_id'] = $store_id;
		$storeGroup = StoreGroup::where('deleted_at',Null)->orderBy('sort_number', 'asc')->where('store_id',$this->user_id)->paginate();
		$data['storeGroup'] = $storeGroup;
		$data['parent_category_id'] = $request->category_id;
		$data['name'] = $request->name;
		$data['code'] = $request->code;
		$data['sort_number'] = $request->sort_number;
		$data['comments'] = $request->comments;
		return $data;
	}

	public function deleteProductGroups($store_id , $product_id)
	{
		$productDelete = StoreGroup::where('id',$product_id)->delete();
		if($productDelete > 0){
			$data['store_id'] = $store_id;
			$storeGrp = StoreGroup::where('deleted_at',Null)->orderBy('sort_number', 'asc')->paginate();
			$data['storeGroup'] = $storeGrp;
			Session::flash('success', 'Delete Record Successfully!!!');
			return view('Store::admin.productGroup.product-group',$data);
		}

	}

	public function editProductGroups($store_id ,$product_id)
	{
		$data['store_id'] = $store_id;
		$storeGroup =  StoreGroup::where('id',$product_id)->where('deleted_at',Null)->first();
		$data['storeGroup'] = $storeGroup;
		return view('Store::admin.productGroup.product-group-update',$data);

	}

	public function updateProductGroups(Request $request ,$store_id ,$product_id)
	{
		$this->validate($request, [
			'category_id' => 'required',
			'sort_number' => 'numeric',
		]);

		$storeGroup = StoreGroup::where( 'deleted_at', null )->where( 'code', $request->code )->where('store_id',$this->user_id)->orWhere( 'name', $request->name )->first();


		$storeGrp =  StoreGroup::where('id',$product_id)->where('deleted_at',Null)->first();
		$storeGrp->category_id = $request->category_id;
		$storeGrp->store_id = $this->user_id;
		if(count($request->sort_number) > 0){
			$storeGrp->sort_number = $request->sort_number;
		}else{
			$storeGrp->sort_number = 0;
		}
		$storeGrp->comments = $request->comments;
		$storeGrp->save();
		if($storeGrp->save()){

			Session::flash('success', 'Record Update Successfully!!!');
			return redirect()->to('store/'.$store_id.'/admin/productGroup');

		}

	}
	public function productGroupsFilter() {

		$category_id = Input::get( 'category' );
		$store_id = Input::get( 'store_id' );

		if($category_id > 0){
			$products = $this->productFiltersTemplate($category_id,$store_id);
			return $products;

		}else{
			$products = $this->productFullGroupFilter($store_id);

			return $products;

		}


	}

	public function productFiltersTemplate($category_id,$store_id) {

		$productTemplate = StoreGroup::where('deleted_at',Null)->where('store_id',$this->user_id)->orderBy('sort_number', 'asc')->
		where('category_id' ,$category_id)->paginate();

		if(count($productTemplate) > 0){
			$html = '';
			foreach ($productTemplate as $record):
				$html .= '<tr>';
				$html .= ' <td>'.$record->name.'</td>';
				$html .= ' <td>'.$record->code.'</td>';
				$html .= ' <td>'.$record->sort_number.'</td>';
				$html .= ' <td>' . $record->comments . '</td>';
				$html .= '<td><a href="'.url('store/'.$store_id.'/admin/editProductGroups/'.$record->id).'" title="Edit">
                                                    <i class="fa fa-edit fa-2x"></i>
                                                </a>
                                                <a data-toggle="confirmation" data-href="'.url('store/'.$store_id.'/admin/deleteProductGroups/'.$record->id).'" title="Delete">
                                                    <i class="fa fa-trash fa-2x"></i>
                                                </a>
                                                </td>';

				$html .= '</tr>';
			endforeach;
			return $html;
		}else{
			return $html = '<tr><td>No Product Found</td></tr>';
		}

	}
	public function productFullGroupFilter($store_id) {
		$productFullTemplate = StoreGroup::where('deleted_at',Null)->where('store_id',$this->user_id)->orderBy('sort_number', 'asc')->paginate();
		if(count($productFullTemplate) > 0) {
			$html = '';
			foreach ( $productFullTemplate as $record ):
				$html .= '<tr>';
				$html .= ' <td>' . $record->name . '</td>';
				$html .= ' <td>' . $record->code . '</td>';
				$html .= ' <td>' . $record->sort_number . '</td>';
				$html .= ' <td>' . $record->comments . '</td>';
				$html .= '<td><a href="' . url( 'store/' . $store_id . '/admin/editProductGroups/' . $record->id ) . '" title="Edit">
                                                    <i class="fa fa-edit fa-2x"></i>
                                                </a>
                                                <a data-toggle="confirmation" data-href="' . url( 'store/' . $store_id . '/admin/deleteProductGroups/' . $record->id ) . '" title="Delete">
                                                    <i class="fa fa-trash fa-2x"></i>
                                                </a>
                                                </td>';

				$html .= '</tr>';
			endforeach;

			return $html;
		}else{
			return $html = '<tr><td>No Product Found</td></tr>';
		}
	}
/******************************************End Product Group***************************************************/


	/**************************************line Item******************************************/
	public function lineItem($store_id)
	{
		$data['store_id'] = $store_id;
		$lineItems = LineItems::where('deleted_at',Null)->where('store_id',$this->user_id)->orderBy('sort_number', 'asc')->paginate();
		$data['lineItems'] = $lineItems;
		return view('Store::admin.lineItems.line-items',$data);
	}


	public function savedLineItem(Request $request ,$store_id)
	{

		$this->validate($request, [
			'name'        => 'required',
			'code'        => 'required',
			'sort_number' => 'numeric',
		]);

		$LineItems = LineItems::where( 'deleted_at', null )->where( 'code', $request->code )->where('store_id',$this->user_id)->orWhere( 'name', $request->name )->first();

		if(count($LineItems) > 0){
			if($LineItems->code == $request->code &&  $LineItems->store_id == $this->user_id){
				$data = $this->lineItemChkCondition($store_id,$request);
				Session::flash('message', 'The Product Code Must be Different');
				return view('Store::admin.lineItems.line-items',$data);
			}elseif ($LineItems->name == $request->name &&  $LineItems->store_id == $this->user_id) {
				$data = $this->lineItemChkCondition( $store_id, $request );
				Session::flash('message', 'The Product Name Must be Different');
				return view('Store::admin.lineItems.line-items',$data);
			}elseif ($LineItems->name == $request->name &&  $LineItems->code == $request->code &&  $LineItems->store_id == $this->user_id) {
				$data = $this->lineItemChkCondition( $store_id, $request );
				Session::flash('message', 'The Product Code or Name Must be Different');
				return view('Store::admin.lineItems.line-items',$data);
			}
		}

		$data['store_id'] = $store_id;
		$lineItems = new LineItems();
		$lineItems->name = $request->name;
		$lineItems->code = $request->code;
		$lineItems->store_id = $this->user_id;
		$lineItems->comments = $request->comments;
		if(isset($request->size_color)){
			$lineItems->size_color = 1;
		}else{
			$lineItems->size_color = 0;
		}
		if(isset($request->one_load_item)){
			$lineItems->one_load_item = 1;
		}else{
			$lineItems->one_load_item = 0;
		}
		if(count($request->sort_number) > 0){
			$lineItems->sort_number = $request->sort_number;
		}else{
			$lineItems->sort_number = 0;
		}
		$lineItems->save();

		$lineItems = LineItems::where('deleted_at',Null)->where('store_id',$this->user_id)->orderBy('sort_number', 'asc')->paginate();
		$data['lineItems'] = $lineItems;
		Session::flash('success', 'Record Add Successfully!!!');
		return view('Store::admin.lineItems.line-items',$data);
	}

	public function lineItemChkCondition($store_id,$request  ) {
		$data['store_id'] = $store_id;
		$lineItems = LineItems::where('deleted_at',Null)->orderBy('sort_number', 'asc')->paginate();
		$data['lineItems'] = $lineItems;
		$data['name'] = $request->name;
		$data['code'] = $request->code;
		$data['sort_number'] = $request->sort_number;
		$data['comments'] = $request->comments;
		if(isset($request->size_color)){
			$color = 1;
		}else{
			$color = 0;
		}
		$data['size_color'] = $color;

		if(isset($request->one_load_item)){
			$loadItem = 1;
		}else{
			$loadItem = 0;
		}
		$data['one_load_item'] = $loadItem;
		return $data;

	}

	public function deleteLineItem($store_id , $product_id)
	{
		$productDelete = LineItems::where('id',$product_id)->delete();
		if($productDelete > 0){
			$data['store_id'] = $store_id;
			$lineItems = LineItems::where('deleted_at',Null)->orderBy('sort_number', 'asc')->paginate();
			$data['lineItems'] = $lineItems;
			Session::flash('success', 'Delete Record Successfully!!!');
			return view('Store::admin.lineItems.line-items',$data);
		}

	}
	public function editLineItem($store_id ,$product_id)
	{
		$data['store_id'] = $store_id;
		$lineItems =  LineItems::where('id',$product_id)->where('deleted_at',Null)->first();
		$data['lineItems'] = $lineItems;
		return view('Store::admin.lineItems.line-items-update',$data);

	}

	public function updateLineItem(Request $request ,$store_id ,$product_id)
	{
		$this->validate($request, [
			'sort_number' => 'numeric',
		]);


		$lineItems =  LineItems::where('id',$product_id)->where('deleted_at',Null)->first();
		$lineItems->store_id = $this->user_id;
		$lineItems->comments = $request->comments;
		if(isset($request->size_color)){
			$lineItems->size_color = 1;
		}else{
			$lineItems->size_color = 0;
		}
		if(isset($request->one_load_item)){
			$lineItems->one_load_item = 1;
		}else{
			$lineItems->one_load_item = 0;
		}
		if(count($request->sort_number) > 0){
			$lineItems->sort_number = $request->sort_number;
		}else{
			$lineItems->sort_number = 0;
		}
		$lineItems->save();
		if($lineItems->save()){
			Session::flash('success', 'Record Update Successfully!!!');
			return redirect()->to('store/'.$store_id.'/admin/lineItem');
		}

	}


	/**************************************End line Item******************************************/

	/**************************************Age Group******************************************/
	public function ageGroup($store_id)
	{
		$data['store_id'] = $store_id;
		$ageGroups = AgeGroup::where('deleted_at',Null)->where('store_id',$this->user_id)->orderBy('sort_number', 'asc')->paginate();
		$data['ageGroup'] = $ageGroups;
		return view('Store::admin.ageGroup.age-group',$data);
	}


public function savedAgeGroup(Request $request ,$store_id)
{

	$this->validate($request, [
		'category_id' => 'required',
		'name'        => 'required',
		'code'        => 'required',
		'sort_number' => 'numeric',
	]);

	$ageGroup = AgeGroup::where( 'deleted_at', null )->where( 'code', $request->code )->orWhere( 'name', $request->name )->first();

	if(count($ageGroup) > 0){
		if($ageGroup->code == $request->code &&  $ageGroup->category_id == $request->category_id && $ageGroup->store_id == $this->user_id){
			Session::flash('message', 'The Product Code Must be Different');
			return redirect()->back();
		}elseif ($ageGroup->name == $request->name &&  $ageGroup->category_id == $request->category_id && $ageGroup->store_id == $this->user_id) {
			Session::flash('message', 'The Product Name Must be Different');
			return redirect()->back();
		}elseif ($ageGroup->name == $request->name &&  $ageGroup->code == $request->code &&  $ageGroup->category_id == $request->category_id && $ageGroup->store_id == $this->user_id) {
			Session::flash('message', 'The Product Code or Name Must be Different');
			return redirect()->back();
		}
	}

	$data['store_id'] = $store_id;
	$ageGroup = new AgeGroup();
	$ageGroup->category_id = $request->category_id;
	$ageGroup->name = $request->name;
	$ageGroup->code = $request->code;
	$ageGroup->comments = $request->comments;
	$ageGroup->store_id = $this->user_id;
	if(count($request->sort_number) > 0){
		$ageGroup->sort_number = $request->sort_number;
	}else{
		$ageGroup->sort_number = 0;
	}
	$ageGroup->save();

	$ageGroup = AgeGroup::where('deleted_at',Null)->orderBy('sort_number', 'asc')->where('store_id' , $this->user_id)->paginate();
	$data['ageGroup'] = $ageGroup;
	$data['parent_category_id'] = $request->category_id;
	Session::flash('success', 'Record Add Successfully!!!');
	return view('Store::admin.ageGroup.age-group',$data);
}


public function deleteAgeGroup($store_id , $product_id)
{
	$product_exist = DB::table( 'store_products' )->where('age_group_id' , $product_id)->first();

	if(count($product_exist) > 0){
		Session::flash('message', 'Record is not deleted!!!');
		return redirect()->back();
	}

	$productDelete = AgeGroup::where('id',$product_id)->delete();
	if($productDelete > 0){
		$data['store_id'] = $store_id;
		$ageGroup = AgeGroup::where('deleted_at',Null)->orderBy('sort_number', 'asc')->paginate();
		$data['ageGroup'] = $ageGroup;
		Session::flash('success', 'Delete Record Successfully!!!');
		return view('Store::admin.ageGroup.age-group',$data);
	}

}
public function editAgeGroup($store_id ,$product_id)
{
	$data['store_id'] = $store_id;
	$ageGroup =  AgeGroup::where('id',$product_id)->where('deleted_at',Null)->first();
	$data['ageGroup'] = $ageGroup;
	return view('Store::admin.ageGroup.age-group-update',$data);

}

public function updateAgeGroup(Request $request ,$store_id ,$product_id)
{
	$this->validate($request, [
		'category_id' => 'required',
		'sort_number' => 'numeric',
	]);


	$ageGroup =  AgeGroup::where('id',$product_id)->where('deleted_at',Null)->first();
	$ageGroup->category_id = $request->category_id;
	$ageGroup->comments = $request->comments;
	$ageGroup->store_id = $this->user_id;
	if(count($request->sort_number) > 0){
		$ageGroup->sort_number = $request->sort_number;
	}else{
		$ageGroup->sort_number = 0;
	}
	$ageGroup->save();
	if($ageGroup->save()){
		Session::flash('success', 'Record Update Successfully!!!');
		return redirect()->to('store/'.$store_id.'/admin/ageGroup');
	}

}
public function ageGroupFilter() {

	$category_id = Input::get( 'category' );
	$store_id = Input::get( 'store_id' );

	if($category_id > 0){
		$products = $this->ageGroupFilters($category_id,$store_id);
		return $products;

	}else{
		$products = $this->fullAgeGroupFilters($store_id);

		return $products;

	}


}
public function ageGroupFilters($category_id,$store_id) {

	$productTemplate = AgeGroup::where('deleted_at',Null)->orderBy('sort_number', 'asc')->
	where('category_id' ,$category_id)->where('store_id' , $this->user_id)->paginate();

	if(count($productTemplate) > 0){
		$html = '';
		foreach ($productTemplate as $record):
			$html .= '<tr>';
			$html .= ' <td>'.$record->name.'</td>';
			$html .= ' <td>'.$record->code.'</td>';
			$html .= ' <td>'.$record->sort_number.'</td>';
			$html .= ' <td>'.$record->comments.'</td>';
			$html .= '<td><a href="'.url('store/'.$store_id.'/admin/editAgeGroup/'.$record->id).'" title="Edit">
                                                    <i class="fa fa-edit fa-2x"></i>
                                                </a>
                                                <a data-toggle="confirmation" data-href="'.url('store/'.$store_id.'/admin/deleteAgeGroup/'.$record->id).'" title="Delete">
                                                    <i class="fa fa-trash fa-2x"></i>
                                                </a>
                                                </td>';

			$html .= '</tr>';
		endforeach;
		return $html;
	}else{
		return $html = '<tr><td>No Product Found</td></tr>';
	}

}
public function fullAgeGroupFilters($store_id) {
	$productFullTemplate = AgeGroup::where('deleted_at',Null)->where('store_id' , $this->user_id)->orderBy('sort_number', 'asc')->paginate();
	if(count($productFullTemplate) > 0) {
		$html = '';
		foreach ( $productFullTemplate as $record ):
			$html .= '<tr>';
			$html .= ' <td>' . $record->name . '</td>';
			$html .= ' <td>' . $record->code . '</td>';
			$html .= ' <td>' . $record->sort_number . '</td>';
			$html .= ' <td>'.$record->comments.'</td>';
			$html .= '<td><a href="' . url( 'store/' . $store_id . '/admin/editAgeGroup/' . $record->id ) . '" title="Edit">
												<i class="fa fa-edit fa-2x"></i>
											</a>
											<a data-toggle="confirmation" data-href="' . url( 'store/' . $store_id . '/admin/deleteAgeGroup/' . $record->id ) . '" title="Delete">
												<i class="fa fa-trash fa-2x"></i>
											</a>
											</td>';

			$html .= '</tr>';
		endforeach;

		return $html;
	}else{
		return $html = '<tr><td>No Product Found</td></tr>';
	}
}
/**************************************End Age Group******************************************/

    public function addProductGroup($store_id,$supplier_id = null)
    {
        $data['store_id'] = $store_id;

        $supplier = [];
        if(!empty($supplier_id))
        {
            $supplier = StoreProductGroup::where('id',$supplier_id)->first();
        }

        $data['supplier'] = $supplier;

        return view('Store::admin.store_management.add-product-group',$data);
    }
    public function postProductGroup($store_id)
    {
        $validator = \Validator::make(['name' => \Request::get('name')],['name' => 'required']);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->getMessageBag());
        }

        $supplier_id = \Request::get('supplier-id');

        if(empty($supplier_id)) {

            $supplierObj = new StoreProductGroup();

            $supplierObj->store_id = $this->user_id;
            $supplierObj->name = \Request::get('name');
            $supplierObj->contact_no = \Request::get('contact_no');

            $supplierObj->save();

        }else{

            $supplier = StoreProductGroup::where('id',$supplier_id)->where('store_id',$this->user_id)->first();

            if(!empty($supplier->id)) {
                $supplier->name = \Request::get('name');
                $supplier->contact_no = \Request::get('contact_no');
                $supplier->save();
            }
        }
        return redirect()->to('store/'.$store_id.'/admin/productGroups');
    }
    public function deleteProductGroup($store_id,$supplier_id)
    {
        $supplier = StoreProductGroup::where('id',$supplier_id)->where('store_id',$this->user_id)->first();
        if(!empty($supplier->id))
        {
            $supplier->is_deleted = 1;
            $supplier->save();
        }

        return redirect()->back();
    }
    public function purchaseOrder($store_id)
    {
        $po_id = \Request::get('po');

        $po = [];

        if(!empty($po_id))
        {
            $po = StorePurchaseOrder::where('id',$po_id)->where('status','open')->where('store_id',$this->user_id)->first();

            $poProducts = StorePurchaseOrderProducts::where('purchase_order_id',$po->id)->where('is_deleted',0)->get();
            $data['poProducts'] = $poProducts;
        }

        $data['po'] = $po;
        $data['store_id'] = $store_id;
        $suppliers = StoreSupplier::where('store_id',$this->user_id)->where('is_deleted',0)->orderBy('name','ASC')->pluck('name','id');
        $data['suppliers'] = $suppliers;
        return view('Store::admin.store_management.purchase-order',$data);
    }
    public function postPurchaseOrder($store_id)
    {
        $po_id = \Request::get('po_id');
        $supplier = \Request::get('supplier');
        $reference_no = \Request::get('reference_no');
        $invoice_date = \Request::get('invoice_date');
        $delivery_date = \Request::get('delivery_date');
        $destination_address = \Request::get('destination_address');
        $items = \Request::get('items');

        $validtor = \Validator::make([
            'supplier' => $supplier,
            'invoice_date' => $invoice_date,
            'delivery_date' => $delivery_date,
            'items' => $items
        ],[
            'supplier' => 'required',
            'invoice_date' => 'required|date',
            'delivery_date' => 'required|date',
            'items' => 'required|array'
        ]);

        if($validtor->fails())
        {
            return redirect()->back()->withErrors($validtor->errors())->withInput();
        }

        if(empty($po_id)) {
            $spo = new StorePurchaseOrder();

            $spo->store_id = $this->user_id;
            $spo->supplier_id = $supplier;
        }else{
            $spo = StorePurchaseOrder::where('id',$po_id)->where('store_id',$this->user_id)->first();
        }

        $spo->reference_no = $reference_no;
        $spo->invoice_date = !empty($invoice_date) ? date('Y-m-d', strtotime($invoice_date)) : null;
        $spo->delivery_date = !empty($delivery_date) ? date('Y-m-d', strtotime($delivery_date)) : null;
        $spo->destination_address = $destination_address;
        $spo->status = 'open';

        if($spo->save())
        {
            $po_total = 0.00;
            $spop_ids = [];
            foreach ($items as $keeping_id => $item)
            {

                $po_product_id = isset($item['id']) ? $item['id'] : null;

                if(empty($po_product_id))
                {
                    $spop = new StorePurchaseOrderProducts();
                    $spop->name = $item['name'];
                    $spop->master_attribute_1 = $item['master_attribute_1'];
                    $spop->master_attribute_2 = $item['master_attribute_2'];
                }else{
                    $spop = StorePurchaseOrderProducts::where('id',$po_product_id)->where('purchase_order_id',$spo->id)->first();
                }

                $spop->product_id = $item['product_id'];
                $spop->quantity = $item['quantity'];
                $spop->product_keeping_id = $item['keeping_id'];
                $spop->unit_price = $item['unit_price'];

                $spop->comments = $item['comments'];
                $spop->purchase_order_id = $spo->id;

                $spop->save();

                $spop_ids[$spop->id] = $spop->id;

                $po_total += $item['unit_price'] * $item['quantity'];
            }

            if(!empty($spop_ids))
            {
                StorePurchaseOrderProducts::where('purchase_order_id',$spo->id)->whereNotIn('id',$spop_ids)->update(['is_deleted' => 1]);
            }

            $spo->po_total = $po_total;

            $spo->save();
        }
        return redirect()->to('store/'.$store_id.'/admin/purchase-orders');
    }
    public function searchProducts()
    {
        $term = \Request::get('term');

        $products = StoreProduct::where(function ($query) use ($term) {
                                        $query->where('title','LIKE',"{$term}%");
                                        $query->orWhere('product_code','LIKE',"{$term}%");
                                    })->where('owner_id',$this->user_id)->select(['id','title'])->get();
        $po_products = [];
        foreach ($products as $product)
        {
            $productKeepings = StoreProductKeeping::where('product_id',$product->id)->whereNull('deleted_at')->get();

            foreach ($productKeepings as $keeping)
            {
                $po_product = [];
                $po_product['labelcolor'] = $keeping->labelcolor;
                $po_product['labelsize'] = $keeping->labelsize;
                $po_product['cost_price'] = $keeping->cost_price;

                $po_product['keeping_id'] = $keeping->id;
                $po_product['master_attribute_1'] = StoreAttribute::where('id',$keeping->master_attribute_1)->value('label');
                $po_product['master_attribute_2'] = StoreAttribute::where('id',$keeping->master_attribute_2)->value('label');

                $po_product['master_attribute_1_value'] = StoreAttributeValue::where('id',$keeping->master_attribute_1_value)->value('value');
                $po_product['master_attribute_2_value'] = StoreAttributeValue::where('id',$keeping->master_attribute_2_value)->value('value');

                $po_product['title'] = $product->title;
                $po_product['id'] = $product->id;
                $po_products[] = $po_product;
            }
        }

        return response()->json($po_products);
    }
    public function getPurchaseOrders($store_id)
    {
        $supplier_id = \Request::get('supplier_id');

        $invoice_date_start = \Request::get('invoice_date_start');
        $invoice_date_end = \Request::get('invoice_date_end');

        $suppliers = StoreSupplier::where('store_id',$this->user_id)->where('is_deleted',0)->orderBy('name','ASC')->pluck('name','id');
        $data['suppliers'] = $suppliers;
        $query = StorePurchaseOrder::where('store_id',$this->user_id)->orderBy('id','DESC');

        if(!empty($supplier_id))
        {
            $query = $query->where('supplier_id',$supplier_id);
        }

        if(!empty($invoice_date_start))
        {
            $start_date = date('Y-m-d',strtotime($invoice_date_start));
            $query->where('invoice_date','>=',$start_date);
        }

        if(!empty($invoice_date_end))
        {
            $end_date = date('Y-m-d',strtotime($invoice_date_end));
            $query->where('invoice_date','<=',$end_date);
        }

        $purchase_orders = $query->paginate();

        $data['purchase_orders'] = $purchase_orders;
        $data['store_id'] = $store_id;
        $data['supplier_id'] = $supplier_id;
        $data['invoice_date_start'] = $invoice_date_start;
        $data['invoice_date_end'] = $invoice_date_end;

        return view('Store::admin.store_management.purchase-orders',$data);
    }
    public function generatePDF()
    {
        $po_id = \Request::get('po');

        $po = StorePurchaseOrder::where('id',$po_id)->where('status','open')->where('store_id',$this->user_id)->first();
        $data['po'] = $po;
        $poProducts = StorePurchaseOrderProducts::where('purchase_order_id',$po->id)->where('is_deleted',0)->get();
        $data['poProducts'] = $poProducts;

        $pdf = App::make('dompdf.wrapper');

        $html = \View::make('Store::admin.store_management.po-pdf',$data);

        $pdf->loadHTML($html)->setPaper('a4');

        return $pdf->stream();
    }
    public function upload() {

        $validator = \Validator::make ($this->request->all(), [
            'po_file' => 'required|mimes:csv,txt'
        ]);

        if($validator->fails()) {
            return [
                'error' => 1,
                'message' => $validator->errors()->get('po_file')
            ];
        }

        return $this->importFileData($this->user_id, $this->request);
    }
    public function importFileData($user_id, $data) {
        $extension = $data->file('po_file')->getClientOriginalExtension();
        $file_name = 'grn_files/' . random_id(1) . '.' . $extension;
        $path      = storage_path() . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'po_file';
        if(!\File::exists($path)) {
            \File::makeDirectory($path, 0775, TRUE);
        }
        \Storage::disk('local')->put($file_name, \File::get($data->file('po_file')));

        $dataCsv = $this->csvToArray(url('local/storage/app/' . $file_name));

        return $this->getProducts($dataCsv);

    }
    public function csvToArray($filename = '', $delimiter = ',') {
        $header = NULL;
        $data   = array();
        if(($handle = fopen($filename, 'r')) !== FALSE) {

            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {

                if(!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);

            }
            fclose($handle);
        }

        return $data;
    }
    private function getProducts($dataCsv) {

        $barcode = array_map(function ($ar) {
            return $ar[ 'Barcode' ];
        }, $dataCsv);
        $csv     = [];

        foreach ($dataCsv as $item) {
            $csv[ $item[ 'Barcode' ] ] = $item[ 'Quantity' ];
        }

        $data = StoreProductKeeping::whereIn('barcode', $barcode)->get();

        return $this->parseCsvProducts($data, $csv);
    }
    private function parseCsvProducts($productKeepings, $csv) {
        $allProducts = [];

        foreach ($productKeepings as $keeping)
        {
            $po_product = [];
            $po_product['labelcolor'] = $keeping->labelcolor;
            $po_product['labelsize'] = $keeping->labelsize;
            $po_product['cost_price'] = $keeping->cost_price;
            $po_product['quantity'] = $csv[$keeping->barcode];

            $po_product['keeping_id'] = $keeping->id;
            $po_product['master_attribute_1'] = StoreAttribute::where('id',$keeping->master_attribute_1)->value('label');
            $po_product['master_attribute_2'] = StoreAttribute::where('id',$keeping->master_attribute_2)->value('label');

            $po_product['master_attribute_1_value'] = StoreAttributeValue::where('id',$keeping->master_attribute_1_value)->value('value');
            $po_product['master_attribute_2_value'] = StoreAttributeValue::where('id',$keeping->master_attribute_2_value)->value('value');

            $po_product['title'] = StoreProduct::where('id',$keeping->product_id)->value('title');
            $po_product['id'] = $keeping->product_id;
            $allProducts[] = $po_product;
        }

        return $allProducts;
    }

	public function allTaxCategories() {
		@$this->data->title = 'All Tax Categories';

		$this->data->tax_categories = $this->taxCategoryRepository->getCategories(25 ,$this->user_id);
		$data                   = (array)$this->data;
		return view('Admin::TaxCategory.index', $data);
    }

	public function getAddTaxCategories()
	{
		@$this->data->title = 'Create Tax Category';
		$data                   = (array)$this->data;
		return view('Admin::TaxCategory.create', $data);
	}

	public function addTaxCategories(Request $request)
	{
		$this->validate($request, [
			'name'     => 'required',
			'value'    => 'required|integer',
			'tax_code' => 'required',

		]);
		$taxCategory = TaxCategory::where( 'deleted_at', null )->where( 'tax_code', $request->tax_code )->orWhere( 'name', $request->name )->first();

		if(count($taxCategory) > 0){
			if($taxCategory->tax_code == $request->tax_code && $taxCategory->store_id == $this->user_id){
				Session::flash('message', 'The Tax Code Must be Different');
				return redirect()->back();
			}elseif ($taxCategory->name == $request->name &&  $taxCategory->store_id == $this->user_id) {
				Session::flash('message', 'The Tax Name Must be Different');
				return redirect()->back();
			}elseif ($taxCategory->name == $request->name &&  $taxCategory->tax_code == $request->tax_code &&  $taxCategory->category_id == $request->category_id && $taxCategory->store_id == $this->user_id) {
				Session::flash('message', 'The Tax Code or Tax Name Must be Different');
				return redirect()->back();
			}
		}

		$saved = $this->taxCategoryRepository->storeTaxCategory($request->all() ,$this->user_id);
		if($saved == 1){$msg = 'Tax Category Record Added Successfully.';}else{$msg='Tax Category Record was not added please try again.';}
		Session::flash('success', 'The Record add Successfully');
		return redirect()->back();
	}

	public function deleteTaxCategories(Request $request)
	{
		$product_exist = DB::table( 'store_products' )->where('tax_code_id' , $request->tax_category_id)->first();

		if(count($product_exist) > 0){
			$msg = 'Tax Category is not deleted.';
			return redirect()->back()->with('info', $msg);
		}

		$is_deleted = $this->taxCategoryRepository->deleteTaxCategory($request->tax_category_id);
		if($is_deleted == 1){$msg = 'Tax Category Record Deleted Successfully.';}else{$msg='Tax Category Record was not deleted please try again.';}
		return redirect()->back()->with('info', $msg);
	}

	public function getEditTaxCategories(Request $request)
	{
		$tax_category = $this->taxCategoryRepository->findTaxCategory($request->tax_category_id);
		return view('Admin::TaxCategory.edit')->with('tax_category', $tax_category);
	}

	public function updateEditTaxCategories(Request $request)
	{
		$this->validate($request, [
			'value'    => 'required|integer',

		]);

		$tax_category = $this->taxCategoryRepository->findTaxCategory($request->tax_category_id);
		$input = $request->except(['_token', 'tax_category_id']);

		$tax_category = $this->taxCategoryRepository->updateTaxCategory($request->tax_category_id, $input);
		return redirect()->back()->with('info', 'Tax category updated successfully.');
	}

	/**************************************Calender Season******************************************/
	public function calenderSeason($store_id)
	{
		$data['store_id'] = $store_id;
		$calenderSeason = CalenderSeason::where('deleted_at',Null)->where('store_id',$this->user_id)->orderBy('sort_number', 'asc')->paginate();
		$data['calenderSeason'] = $calenderSeason;
		return view('Store::admin.calenderSeason.calender-season',$data);
	}


	public function addCalenderSeason(Request $request ,$store_id)
	{

		$this->validate($request, [
			'name'        => 'required',
			'code'        => 'required',
			'sort_number' => 'numeric',
		]);

		$calenderSeason = CalenderSeason::where( 'deleted_at', null )->where( 'code', $request->code )->where('store_id',$this->user_id)->orWhere( 'name', $request->name )->first();

		if(count($calenderSeason) > 0){
			if($calenderSeason->code == $request->code &&  $calenderSeason->store_id == $this->user_id){
				Session::flash('message', 'The Product Code Must be Different');
				return redirect()->back();
			}elseif ($calenderSeason->name == $request->name &&  $calenderSeason->store_id == $this->user_id) {
				Session::flash('message', 'The Product Name Must be Different');
				return redirect()->back();
			}elseif ($calenderSeason->name == $request->name &&  $calenderSeason->code == $request->code &&  $calenderSeason->store_id == $this->user_id) {
				$data = $this->lineItemChkCondition( $store_id, $request );
				Session::flash('message', 'The Product Code or Name Must be Different');
				return redirect()->back();
			}
		}

		$data['store_id'] = $store_id;
		$calenderSeason = new CalenderSeason();
		$calenderSeason->name = $request->name;
		$calenderSeason->code = $request->code;
		$calenderSeason->store_id = $this->user_id;
		$calenderSeason->comments = $request->comments;
		$calenderSeason->start_season = $request->opening_date;
		$calenderSeason->end_season = $request->end_date;

		$calenderSeason->save();

		$calenderSeason = CalenderSeason::where('deleted_at',Null)->where('store_id',$this->user_id)->orderBy('sort_number', 'asc')->paginate();
		$data['calenderSeason'] = $calenderSeason;
		Session::flash('success', 'Record Add Successfully!!!');
		return view('Store::admin.calenderSeason.calender-season',$data);
	}

	public function deleteCalenderSeason($store_id , $product_id)
	{
		$product_exist = DB::table( 'store_products' )->where('season_id' , $product_id)->first();

		if(count($product_exist) > 0){
			Session::flash('message', 'Record is not deleted!!!');
			return redirect()->back();
		}

		$productDelete = CalenderSeason::where('id',$product_id)->delete();
		if($productDelete > 0){
			$data['store_id'] = $store_id;
			$calenderSeason = CalenderSeason::where('deleted_at',Null)->orderBy('sort_number', 'asc')->paginate();
			$data['calenderSeason'] = $calenderSeason;
			Session::flash('success', 'Delete Record Successfully!!!');
			return view('Store::admin.calenderSeason.calender-season',$data);
		}

	}

	public function getEditCalenderSeason($store_id ,$product_id)
	{
		$data['store_id'] = $store_id;
		$calenderSeason =  CalenderSeason::where('id',$product_id)->where('deleted_at',Null)->first();
		$data['calenderSeason'] = $calenderSeason;
		return view('Store::admin.calenderSeason.calender-season-update',$data);

	}

	public function updateCalenderSeason(Request $request ,$store_id ,$product_id)
	{
		$this->validate($request, [
			'sort_number' => 'numeric',
		]);


		$calenderSeason =  CalenderSeason::where('id',$product_id)->where('deleted_at',Null)->first();
		$calenderSeason->store_id = $this->user_id;
		$calenderSeason->comments = $request->comments;
		$calenderSeason->start_season = $request->opening_date;
		$calenderSeason->end_season = $request->end_date;

		if(count($request->sort_number) > 0){
			$calenderSeason->sort_number = $request->sort_number;
		}else{
			$calenderSeason->sort_number = 0;
		}
		$calenderSeason->save();
		if($calenderSeason->save()){

			Session::flash('success', 'Record Update Successfully!!!');
			return redirect('store/'.$store_id.'/admin/calenderSeason');
		}

	}
	/**************************************End Calender Season******************************************/

	/******************************************Life Type***************************************************/

	public function lifeType($store_id)
	{
		$data['store_id'] = $store_id;
		$unit = LifeType::where('deleted_at',Null)->orderBy('sort_number', 'asc')->where('store_id',$this->user_id)->paginate();
		$data['lifeType'] = $unit;
		return view('Store::admin.lifeType.life-type',$data);
	}
	public function savedLifeType(Request $request ,$store_id)
	{

		$this->validate($request, [
			'name'        => 'required',
			'code'        => 'required',
			'sort_number' => 'numeric',

		]);

		$lifeType = LifeType::where('deleted_at',Null)->where('code', $request->code)->orWhere('name', $request->name)->where('store_id',$this->user_id)->first();

		if(count($lifeType) > 0){

			if($lifeType->code == $request->code  && $lifeType->store_id == $this->user_id){
				Session::flash('message', 'The Unit Code or Name Must be Different');
				return redirect()->back();
			}elseif ($lifeType->name == $request->name && $lifeType->store_id == $this->user_id ) {
				Session::flash('message', 'The Unit Code or Name Must be Different');
				return redirect()->back();
			}elseif ($lifeType->name == $request->name &&  $lifeType->code == $request->store_id && $lifeType->store_id == $this->user_id) {
				Session::flash('message', 'The Unit Code or Name Must be Different');
				return redirect()->back();
			}

		}


		$data['store_id'] = $store_id;
		$lifeType = new LifeType();
		$lifeType->name = $request->name;
		$lifeType->code = $request->code;
		$lifeType->store_id = $this->user_id;
		if(count($request->sort_number) > 0){
			$lifeType->sort_number = $request->sort_number;
		}else{
			$lifeType->sort_number = 0;
		}
		$lifeType->comments = $request->comments;
		$lifeType->save();

		$lifeType = LifeType::where('deleted_at',Null)->orderBy('sort_number', 'asc')->paginate();
		$data['lifeType'] = $lifeType;
		$data['parent_category_id'] = $request->category_id;
		Session::flash('success', 'Record Add Successfully!!!');
		return view('Store::admin.lifeType.life-type',$data);
	}

	public function deleteLifeType($store_id , $product_id)
	{
		$product_exist = DB::table( 'store_products' )->where('life_type_id' , $product_id)->first();

		if(count($product_exist) > 0){
			Session::flash('message', 'Record is not deleted!!!');
			return redirect()->back();
		}
		$productDelete = LifeType::where('id',$product_id)->delete();
		if($productDelete > 0){
			$data['store_id'] = $store_id;
			$lifeType = LifeType::where('deleted_at',Null)->orderBy('sort_number', 'asc')->paginate();
			$data['lifeType'] = $lifeType;
			Session::flash('success', 'Delete Record Successfully!!!');
			return view('Store::admin.lifeType.life-type',$data);
		}

	}

	public function editLifeType($store_id ,$product_id)
	{
		$data['store_id'] = $store_id;
		$lifeType =  LifeType::where('id',$product_id)->where('deleted_at',Null)->first();
		$data['lifeType'] = $lifeType;
		return view('Store::admin.lifeType.life-type-update',$data);

	}

	public function updateLifeType(Request $request ,$store_id ,$product_id)
	{
		$this->validate($request, [

			'sort_number' => 'numeric',
		]);

		$unit =  LifeType::where('id',$product_id)->where('deleted_at',Null)->first();
		$unit->store_id = $this->user_id;
		if(count($request->sort_number) > 0){
			$unit->sort_number = $request->sort_number;
		}else{
			$unit->sort_number = 0;
		}
		$unit->comments = $request->comments;
		$unit->save();
		if($unit->save()){
			Session::flash('success', 'Record Update Successfully!!!');
			return redirect()->to('store/'.$store_id.'/admin/lifeType');
		}

	}
	/******************************************End Life Type***************************************************/

	/******************************************product Gender***************************************************/

	public function productGender($store_id)
	{
		$data['store_id'] = $store_id;
		$productGender = ProductGender::where('deleted_at',Null)->orderBy('sort_number', 'asc')->where('store_id',$this->user_id)->paginate();
		$data['productGender'] = $productGender;
		return view('Store::admin.productGender.product-gender',$data);
	}
	public function savedProductGender(Request $request ,$store_id)
	{

		$this->validate($request, [
			'name'        => 'required',
			'code'        => 'required',
			'sort_number' => 'numeric',

		]);

		$productGender = ProductGender::where('deleted_at',Null)->where('code', $request->code)->orWhere('name', $request->name)->where('store_id',$this->user_id)->first();

		if(count($productGender) > 0){

			if($productGender->code == $request->code  && $productGender->store_id == $this->user_id){
				Session::flash('message', 'The Unit Code or Name Must be Different');
				return redirect()->back();
			}elseif ($productGender->name == $request->name && $productGender->store_id == $this->user_id ) {
				Session::flash('message', 'The Unit Code or Name Must be Different');
				return redirect()->back();
			}elseif ($productGender->name == $request->name &&  $productGender->code == $request->store_id && $productGender->store_id == $this->user_id) {
				Session::flash('message', 'The Unit Code or Name Must be Different');
				return redirect()->back();
			}

		}


		$data['store_id'] = $store_id;
		$productGender = new ProductGender();
		$productGender->name = $request->name;
		$productGender->code = $request->code;
		$productGender->store_id = $this->user_id;
		if(count($request->sort_number) > 0){
			$productGender->sort_number = $request->sort_number;
		}else{
			$productGender->sort_number = 0;
		}
		$productGender->comments = $request->comments;
		$productGender->save();

		$productGender = ProductGender::where('deleted_at',Null)->orderBy('sort_number', 'asc')->paginate();
		$data['productGender'] = $productGender;
		Session::flash('success', 'Record Add Successfully!!!');
		return view('Store::admin.productGender.product-gender',$data);
	}

	public function deleteProductGender($store_id , $product_id)
	{
		$product_exist = DB::table( 'store_products' )->where('product_gender_id' , $product_id)->first();

		if(count($product_exist) > 0){
			Session::flash('message', 'Record is not deleted!!!');
			return redirect()->back();
		}
		$productDelete = ProductGender::where('id',$product_id)->delete();
		if($productDelete > 0){
			$data['store_id'] = $store_id;
			$productGender = ProductGender::where('deleted_at',Null)->orderBy('sort_number', 'asc')->paginate();
			$data['productGender'] = $productGender;
			Session::flash('success', 'Delete Record Successfully!!!');
			return view('Store::admin.productGender.product-gender',$data);
		}

	}

	public function editProductGender($store_id ,$product_id)
	{
		$data['store_id'] = $store_id;
		$productGender =  ProductGender::where('id',$product_id)->where('deleted_at',Null)->first();
		$data['productGender'] = $productGender;
		return view('Store::admin.productGender.product-gender-update',$data);

	}

	public function updateProductGender(Request $request ,$store_id ,$product_id)
	{
		$this->validate($request, [

			'sort_number' => 'numeric',
		]);

		$unit =  ProductGender::where('id',$product_id)->where('deleted_at',Null)->first();
		$unit->store_id = $this->user_id;
		if(count($request->sort_number) > 0){
			$unit->sort_number = $request->sort_number;
		}else{
			$unit->sort_number = 0;
		}
		$unit->comments = $request->comments;
		$unit->save();
		if($unit->save()){
			Session::flash('success', 'Record Update Successfully!!!');
			return redirect()->to('store/'.$store_id.'/admin/productGender');
		}

	}

	/******************************************End Product Gender***************************************************/

	/******************************************Value Addition***************************************************/

	public function valueAddition($store_id)
	{
		$data['store_id'] = $store_id;
		$valueAddition = ValueAddition::where('deleted_at',Null)->orderBy('sort_number', 'asc')->where('store_id',$this->user_id)->paginate();
		$data['valueAddition'] = $valueAddition;
		return view('Store::admin.valueAddition.value-addition',$data);
	}
	public function savedValueAddition(Request $request ,$store_id)
	{

		$this->validate($request, [
			'name'        => 'required',
			'code'        => 'required',
			'sort_number' => 'numeric',

		]);

		$valueAddition = ValueAddition::where('deleted_at',Null)->where('code', $request->code)->orWhere('name', $request->name)->where('store_id',$this->user_id)->first();

		if(count($valueAddition) > 0){

			if($valueAddition->code == $request->code  && $valueAddition->store_id == $this->user_id){
				Session::flash('message', 'The Unit Code or Name Must be Different');
				return redirect()->back();
			}elseif ($valueAddition->name == $request->name && $valueAddition->store_id == $this->user_id ) {
				Session::flash('message', 'The Unit Code or Name Must be Different');
				return redirect()->back();
			}elseif ($valueAddition->name == $request->name &&  $valueAddition->code == $request->store_id && $valueAddition->store_id == $this->user_id) {
				Session::flash('message', 'The Unit Code or Name Must be Different');
				return redirect()->back();
			}

		}


		$data['store_id'] = $store_id;
		$valueAddition = new ValueAddition();
		$valueAddition->name = $request->name;
		$valueAddition->code = $request->code;
		$valueAddition->store_id = $this->user_id;
		if(count($request->sort_number) > 0){
			$valueAddition->sort_number = $request->sort_number;
		}else{
			$valueAddition->sort_number = 0;
		}
		$valueAddition->comments = $request->comments;
		$valueAddition->save();

		$valueAddition = ValueAddition::where('deleted_at',Null)->orderBy('sort_number', 'asc')->paginate();
		$data['valueAddition'] = $valueAddition;
		Session::flash('success', 'Record Add Successfully!!!');
		return view('Store::admin.valueAddition.value-addition',$data);
	}

	public function deleteValueAddition($store_id , $product_id)
	{
		$product_exist = DB::table( 'store_products' )->where('value_addition_id' , $product_id)->first();

		if(count($product_exist) > 0){
			Session::flash('message', 'Record is not deleted!!!');
			return redirect()->back();
		}
		$productDelete = ValueAddition::where('id',$product_id)->delete();
		if($productDelete > 0){
			$data['store_id'] = $store_id;
			$valueAddition = ValueAddition::where('deleted_at',Null)->orderBy('sort_number', 'asc')->paginate();
			$data['valueAddition'] = $valueAddition;
			Session::flash('success', 'Delete Record Successfully!!!');
			return redirect()->to('store/'.$store_id.'/admin/valueAddition');
		}

	}

	public function editValueAddition($store_id ,$product_id)
	{
		$data['store_id'] = $store_id;
		$valueAddition =  ValueAddition::where('id',$product_id)->where('deleted_at',Null)->first();
		$data['valueAddition'] = $valueAddition;
		return view('Store::admin.valueAddition.value-addition-update',$data);

	}

	public function updateValueAddition(Request $request ,$store_id ,$product_id)
	{
		$this->validate($request, [

			'sort_number' => 'numeric',
		]);

		$unit =  ValueAddition::where('id',$product_id)->where('deleted_at',Null)->first();
		$unit->store_id = $this->user_id;
		if(count($request->sort_number) > 0){
			$unit->sort_number = $request->sort_number;
		}else{
			$unit->sort_number = 0;
		}
		$unit->comments = $request->comments;
		$unit->save();
		if($unit->save()){
			Session::flash('success', 'Record Update Successfully!!!');
			return redirect()->to('store/'.$store_id.'/admin/valueAddition');
		}

	}

	/******************************************End Value Addition***************************************************/

    public function subscription()
    {
        $data = [];
        return view('Store::admin.subscription.index',$data);
    }
    public function pickSubscriptionPlan($type)
    {
        $data = [];
        return view('Store::admin.subscription.choose',$data);
    }
    public function bankTransfer($type)
    {
        $data = [];
        return view('Store::admin.subscription.bank-transfer',$data);
    }
    public function salesChannel()
    {
        $data = [];
        return view('Store::admin.subscription.sales-channels',$data);
    }
    public function generalSettings()
    {
        $data = [];
        return view('Store::admin.subscription.general-settings',$data);
    }
}
