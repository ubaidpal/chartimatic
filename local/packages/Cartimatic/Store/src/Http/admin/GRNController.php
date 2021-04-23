<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 29-Nov-16 12:55 PM
 * File Name    : GRNController.php
 */

namespace Cartimatic\Store\Http\admin;

use App\Http\Controllers\Controller;
use Cartimatic\Store\Repository\admin\GRNRepository;
use Cartimatic\Store\StoreProductKeeping;
use Illuminate\Http\Request;

class GRNController extends Controller
{
    private $request;
    private $user_id;
    private $user;
    private $grn;

    public function __construct(Request $request, GRNRepository $grn) {
        parent::__construct();
        $this->request = $request;
        $this->grn     = $grn;
        $this->user_id = $request[ 'middleware' ][ 'user_id' ];
        $this->user    = $request[ 'middleware' ][ 'user' ];
    }

    public function index() {

        $data[ 'grns' ]      = $this->grn->allGrn($this->user_id);
        $data[ 'suppliers' ] = $this->grn->getSuppliers($this->user_id);
        $data[ 'supplier' ]  = $this->request->get('supplier');
        $data[ 'start' ]     = $this->request->get('start');
        $data[ 'end' ]       = $this->request->get('end');
        return view('Store::admin.grn.all', $data);
    }

    public function generateGrn() {
        $data[ 'suppliers' ]    = $this->grn->getSuppliers($this->user_id);
        $data[ 'batch_number' ] = $this->grn->getBatchNo();
        //$data[ 'purchaseOrders' ] = $this->grn->getPurchaseOrders( $this->user_id);

        return view('Store::admin.grn.generate-grn', $data);
    }

    public function getPurchaseOrder() {
        return $data = $this->grn->getPurchaseOrder($this->request->get('id'));
    }

    public function getProductDetail() {
        return $data = $this->grn->getProductDetail($this->request->get('id'), $this->user_id);
    }

    public function getSupplierPurchaseOrders() {
        return $data = $this->grn->getPurchaseOrders($this->request->get('id'), $this->user_id);
    }

    public function saveGrn() {

        $messages = [
            'products.required' => 'Select at least one product',
        ];
        $this->validate($this->request, [
            'batch_number'     => 'required',
            'date'             => 'required|date',
            'bill_no'          => 'required',
            'bill_date'        => 'required|date',
            'due_date'         => 'required|date',
            'payment_mode'     => 'required',
            'loading'          => 'numeric',
            'freight'          => 'numeric',
            'other_expense'    => 'numeric',
            'adj_amount'       => 'numeric',
            'sales_tax'        => 'numeric',
            'sales_tax_amount' => 'numeric',
            'total_amount'     => 'numeric',
            'products'         => 'required',
        ], $messages);

        $this->grn->saveGrn($this->request->all(), $this->user_id);

        return redirect('admin/store/grn')->with('success', 'GRN added successfully');
    }

    public function edit($id) {
        $data[ 'suppliers' ] = $this->grn->getSuppliers($this->user_id);

        $data[ 'grn' ] = $this->grn->getGrnDetail($this->user_id, $id);
        $data[ 'po' ]  = $this->grn->getPurchaseOrders($data[ 'grn' ][ 'supplier_id' ], $this->user_id, FALSE);
        return view('Store::admin.grn.edit', $data);
    }

    public function deleteProduct() {
        return $this->grn->deleteProduct($this->request->all(), $this->user_id);
    }

    public function update() {
        $this->grn->update($this->request->all(), $this->user_id);
        return redirect('admin/store/grn')->with('success', 'GRN updated successfully');
    }

    public function generatePDF($id) {

        $data[ 'grn' ] = $this->grn->getGrnDetail($this->user_id, $id);
        //echo '<tt><pre>'; print_r($data); die;
        $pdf = \App::make('dompdf.wrapper');

        $html = view('Store::admin.grn.grn-pdf', $data)->render();
//echo $html; die;
        $pdf->loadHTML($html)->setPaper('a4');

        return $pdf->stream();
    }

    public function getUpload() {
        $data[ 'suppliers' ] = $this->grn->getSuppliers($this->user_id);
        return view('Store::admin.grn.upload', $data);
    }

    public function upload() {

        $validator = \Validator::make($this->request->all(), [
            //'supplier'     => 'required',
            'grn_file' => 'required|mimes:csv,txt'
        ]);
        if($validator->fails()) {
            return [
                'error'   => 1,
                'message' => $validator->errors()->get('grn_file')
            ];
        }
        return $this->grn->importFileData($this->user_id, $this->request);

    }

    public function barcodeSession() {
        $products = [];
        $quantity = [];
        if(!$this->request->has('products')) {
            return [
                'error'   => 1,
                'message' => 'Please add at least one product'
            ];
        }
        foreach ($this->request->get('products') as $index => $product) {
            foreach ($product as $key => $row) {
                $products[ $key ] = $row[ 'quantity' ];

            }
        }
        \Session::forget('barcode-products');
        \Session::set('barcode-products', $products);

        return [
            'error' => 0,
        ];
    }

    public function printBarcode() {
        $products = \Session::get('barcode-products');
        \Session::forget('barcode-products');
        $productId            = array_keys($products);
        $data[ 'productIds' ] = $products;
        $data[ 'products' ]   = StoreProductKeeping::with('value1')
                                                   ->with('value2')
                                                   ->with('product')
                                                   ->whereIn('id', $productId)
                                                   ->get()->toArray();

        $html    = view('Store::admin.grn.print-barcode', $data)->render();
        $printer = "COLOR-JET (HP Color LaserJet M750)";

        if($ph = printer_open($printer)) {
        $ph = printer_open($printer);
        echo $content = $html;
        printer_set_option($ph, PRINTER_MODE, "RAW");
        printer_write($ph, $content);
        printer_close($ph);
        \Session::forget('print_barcode');
        \Session::forget('product_id');

        //return redirect('store/seller/admin/manage-product');
        };
        //echo "<script>window.close();</script>";
       // die;

    }

}
