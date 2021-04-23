<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 01-Jun-16 4:12 PM
 * File Name    : CategoryAttributes.php
 */

namespace Cartimatic\Admin\Http\Controllers;

use Cartimatic\Admin\Repositories\TaxCategoryRepository;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class TaxCategory extends Controller
{
    protected $data;
    protected $taxCategoryRepository;

    /**
     * CategoryAttributes constructor.
     */
    public function __construct(TaxCategoryRepository $taxCategoryRepository) {
        @$this->data->title = 'Tax Categories';
        $this->taxCategoryRepository = $taxCategoryRepository;
    }

    public function index() {
        @$this->data->title = 'All Tax Categories';

        $this->data->tax_categories = $this->taxCategoryRepository->getCategories(25);
        $data                   = (array)$this->data;
        return view('Admin::TaxCategory.index', $data);
    }

    public function create()
    {
        @$this->data->title = 'Create Tax Category';
        $data                   = (array)$this->data;
        return view('Admin::TaxCategory.create', $data);
    }

    public function store(Request $request)
    {
        $saved = $this->taxCategoryRepository->storeTaxCategory($request->all());
        if($saved == 1){$msg = 'Tax Category Record Added Successfully.';}else{$msg='Tax Category Record was not added please try again.';}
        return redirect()->back()->with('info', $msg);
    }

    public function edit(Request $request)
    {
        $tax_category = $this->taxCategoryRepository->findTaxCategory($request->tax_category_id);
        return view('Admin::TaxCategory.edit')->with('tax_category', $tax_category);
    }

    public function update(Request $request)
    {
        $tax_category = $this->taxCategoryRepository->findTaxCategory($request->tax_category_id);
        $input = $request->except(['_token', 'tax_category_id']);

        $tax_category = $this->taxCategoryRepository->updateTaxCategory($request->tax_category_id, $input);
        return redirect()->back()->with('info', 'Tax category updated successfully.');
    }

    public function delete(Request $request)
    {
        $is_deleted = $this->taxCategoryRepository->deleteTaxCategory($request->tax_category_id);
        if($is_deleted == 1){$msg = 'Tax Category Record Deleted Successfully.';}else{$msg='Tax Category Record was not deleted please try again.';}
        return redirect()->back()->with('info', $msg);
    }
}
