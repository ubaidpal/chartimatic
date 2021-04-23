<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 29-Nov-16 2:52 PM
 * File Name    : GRNRepository.php
 */

namespace Cartimatic\Store\Repository\admin;

use Cartimatic\Store\StoreGrn;
use Cartimatic\Store\StoreGrnProduct;
use Cartimatic\Store\StoreProductKeeping;
use Cartimatic\Store\StorePurchaseOrder;
use Cartimatic\Store\StorePurchaseOrderProducts;
use Cartimatic\Store\StoreSupplier;

class GRNRepository
{

    public function getSuppliers($user_id) {
        return StoreSupplier::orderBy('name', 'ASC')->where('store_id', $user_id)->pluck('name', 'id');
    }

    public function getPurchaseOrders($id, $user_id, $status = TRUE) {
        $query = \DB::table('store_purchase_orders')
                    ->where('supplier_id', $id)
                    ->orderBy('created_at', 'DESC')
                    ->where('store_id', $user_id);
        if(!$status) {

            return $query->pluck('id', 'id');
        }
        $query->where('status', 'open');
        return $query->select(['id'])->get();

    }

    public function getPurchaseOrder($purchaseOrderId) {
        $data = StorePurchaseOrder::where('id', $purchaseOrderId)
                                  ->with('products.productDetail')
                                  ->with('products.productKeeping.value1')
                                  ->with('products.productKeeping.value2')
                                  ->first()
                                  ->toArray();
        return $this->parsePurchaseOrder($data);
    }

    private function parsePurchaseOrder($data) {

        $po_detail[ 'id' ]            = $data[ 'id' ];
        $po_detail[ 'store_id' ]      = $data[ 'store_id' ];
        $po_detail[ 'reference_no' ]  = $data[ 'reference_no' ];
        $po_detail[ 'invoice_date' ]  = $data[ 'invoice_date' ];
        $po_detail[ 'invoice_total' ] = $data[ 'po_total' ];
        $po_detail[ 'delivery_date' ] = $data[ 'delivery_date' ];
        $po_detail[ 'created_at' ]    = $data[ 'created_at' ];
        $purchaseOrder                = [];
        foreach ($data[ 'products' ] as $product) {
            $purchaseOrder[ 'products' ][] = $this->parseProduct($product);
        }
        return [
            'po_detail' => $po_detail,
            'products'  => $this->makeData($purchaseOrder)
        ];
    }

    private function parseProduct($product_detail, $is_po = true) {
        $product[ 'id' ]         = $product_detail[ 'product_detail' ][ 'id' ];
        $product[ 'title' ]      = $product_detail[ 'product_detail' ][ 'title' ];
        if($is_po){
            $product[ 'quantity' ]   = $product_detail[ 'quantity' ];
            $product[ 'unit_price' ] = $product_detail[ 'unit_price' ];
        }else{
            $product[ 'quantity' ]   = $product_detail[ 'quantity' ];
            $product[ 'unit_price' ] = $product_detail[ 'price' ];
        }

        // $product[ 'quantity_received' ] = $product_detail[ 'quantity' ];
        //foreach ($product_detail[ 'product_keeping' ] as $item) {
        $product[ 'product_keeping' ] = $this->parseProductVariants($product_detail[ 'product_keeping' ]);
        //}
        return $product;
    }

    private function parseProductVariants($item) {
        $variant[ 'id' ]                   = $item[ 'id' ];
        $variant[ 'price' ]                = $item[ 'price' ];
        $variant[ 'cost_price' ]           = $item[ 'cost_price' ];
        $variant[ 'stock_alert_quantity' ] = $item[ 'stock_alert_quantity' ];
        $variant[ 'quantity' ]             = $item[ 'quantity' ];
        $variant[ 'barcode' ]              = $item[ 'barcode' ];
        $variant[ 'custom_id' ]            = $item[ 'custom_product_id' ];
        $variant[ 'attri1' ]               = $item[ 'value1' ][ 'value' ];
        $variant[ 'attri2' ]               = $item[ 'value2' ][ 'value' ];
        return $variant;
    }

    private function makeData($purchaseOrder) {
        $products = [];
        if(empty($purchaseOrder[ 'products' ])) {
            return $products;
        }
        foreach ($purchaseOrder[ 'products' ] as $order) {
            $item = $order;
            //foreach ($order[ 'product_keeping' ] as $item) {
            $data       = [];
            $data[]     = $item[ 'product_keeping' ][ 'custom_id' ];
            $data[]     = $order[ 'title' ] . ' ' . strtoupper($item[ 'product_keeping' ][ 'attri1' ]) . '-' . strtoupper($item[ 'product_keeping' ][ 'attri2' ]);
            $data[]     = $item[ 'product_keeping' ][ 'barcode' ];
            $data[]     = '<input class="form-control" name="products[' . $order[ 'id' ] . '][' . $order[ 'product_keeping' ][ 'id' ] . '][quantity]" type="number" value="' . $item[ 'quantity' ] . '">';
            $data[]     = '<input class="form-control" name="products[' . $order[ 'id' ] . '][' . $order[ 'product_keeping' ][ 'id' ] . '][price]" type="number" value="' . $item[ 'unit_price' ] . '">';
            $data[]     = $item[ 'product_keeping' ][ 'cost_price' ];
            $data[]     = '<a class="remove-row" href="javascript:void(0)" title="Type for suggestions">
                                        <i class="fa fa-times-circle"></i>
                                    </a>';
            $products[] = $data;
            //}

        }
        return $products;
    }

    public function getProductDetail($id, $userID) {
        $data = StoreProductKeeping::whereId($id)
                                   ->with('productDetail')
                                   ->with('value1')
                                   ->with('value2')
                                   ->first()
                                   ->toArray();

        $data[ 'product_keeping' ] = $data;

        $data = $this->parseProduct($data, false);
        return $this->makeDataForKeeping($data);
    }

    private function makeDataForKeeping($product) {
        //$products = [];
        //foreach ($product[ 'product_keeping' ] as $item) {
        //$data   = [];
        $data[] = $product[ 'product_keeping' ][ 'custom_id' ];
        $data[] = $product[ 'title' ] . ' ' . strtoupper($product[ 'product_keeping' ][ 'attri1' ]) . '-' . strtoupper($product[ 'product_keeping' ][ 'attri2' ]);
        $data[] = $product[ 'product_keeping' ][ 'barcode' ];
        $data[] = '<input class="form-control" name="products[' . $product[ 'id' ] . '][' . $product[ 'product_keeping' ][ 'id' ] . '][quantity]" type="number" value="' . $product[ 'product_keeping' ][ 'quantity' ] . '">';
        $data[] = '<input class="form-control" name="products[' . $product[ 'id' ] . '][' . $product[ 'product_keeping' ][ 'id' ] . '][price]" type="number" value="' . $product[ 'product_keeping' ][ 'price' ] . '">';
        $data[] = $product[ 'product_keeping' ][ 'cost_price' ];
        $data[] = '<a class="remove-row" href="javascript:void(0)" title="Type for suggestions">
                                        <i class="fa fa-times-circle"></i>
                                    </a>';

        $products[] = $data;
        // }
        return $data;
    }

    public function saveGrn($data, $user_id) {
        $grn = new StoreGrn();

        $po_amount = 0;

        $grn->object_type  = 'products';
        $grn->object_value = 0;

        if(!empty($data[ 'purchase_order' ])) {
            $po = $this->getPurchaseOrderDetail($data[ 'purchase_order' ]);
            if(!empty($po)) {
                $po_amount = $po->po_total;
            }
            $grn->object_type  = 'purchase_order';
            $grn->object_value = $data[ 'purchase_order' ];
        }
        $grn->store_id         = $user_id;
        $grn->supplier_id      = (!empty($data[ 'supplier' ]) ? $data[ 'supplier' ] : 0);
        $grn->date             = $data[ 'date' ];
        $grn->bill_no          = $data[ 'bill_no' ];
        $grn->bill_date        = $data[ 'bill_date' ];
        $grn->due_date         = $data[ 'due_date' ];
        $grn->payment_mode     = $data[ 'payment_mode' ];
        $grn->comment          = $data[ 'comment' ];
        $grn->invoice_number   = $data[ 'invoice_number' ];
        $grn->invoice_amount   = $po_amount;
        $grn->loading_expense  = (!empty($data[ 'loading' ]) ? $data[ 'loading' ] : 0);
        $grn->freight_expense  = (!empty($data[ 'freight' ]) ? $data[ 'freight' ] : 0);
        $grn->other_expense    = (!empty($data[ 'other_expense' ]) ? $data[ 'other_expense' ] : 0);
        $grn->adj_amount       = (!empty($data[ 'adj_amount' ]) ? $data[ 'adj_amount' ] : 0);
        $grn->sales_tax        = (!empty($data[ 'sales_tax' ]) ? $data[ 'sales_tax' ] : 0);
        $grn->sales_tax_amount = $data[ 'sales_tax_amount' ];

        $total = $grn->loading_expense + $grn->freight_expense + $grn->other_expense + $grn->adj_amount + $po_amount;
        $tax   = 0;
        if($grn->sales_tax != 0) {
            $tax   = ($total * $grn->sales_tax) / 100;
            $total = $total + $tax;
        }
        $grn->sales_tax_amount = $tax;
        $grn->total_amount     = $total;

        if($grn->save()) {
            if(isset($po)) {
                $this->updatePurchaseOrderStatus($po);
                $quantity = $this->updatePoProducts($data[ 'purchase_order' ], $grn->id, $data[ 'products' ]);
            } else {
                $quantity = $this->saveGrnProducts($grn->id, $data[ 'products' ]);
            }

            $grn->total_quantity = $quantity;
            $grn->save();
        };

        return TRUE;

    }

    private function getPurchaseOrderDetail($purchase_order) {
        return StorePurchaseOrder::find($purchase_order);
    }

    private function updatePurchaseOrderStatus($po) {
        $po->status = 'close';
        $po->save();
    }

    private function updatePoProducts($purchase_order, $id, $products) {
        $quantity = 0;
        if(!empty($products)) {
            foreach ($products as $index => $product) {
                foreach ($product as $keep_id => $item) {
                    $grnProduct = StorePurchaseOrderProducts::where('purchase_order_id', $purchase_order)->where('product_keeping_id', $keep_id)->where('product_id', $index)->first();

                    if(!empty($grnProduct)) {
                        $grnProduct->grn_quantity = $item[ 'quantity' ];
                        $grnProduct->grn_price    = $item[ 'price' ];

                        $grnProduct->save();
                        $quantity = $item[ 'quantity' ] + $quantity;
                    } else {
                        $grnProduct                     = new StorePurchaseOrderProducts();
                        $grnProduct->purchase_order_id  = $purchase_order;
                        $grnProduct->product_id         = $index;
                        $grnProduct->product_keeping_id = $keep_id;
                        $grnProduct->quantity           = $item[ 'quantity' ];
                        $grnProduct->grn_quantity       = $item[ 'quantity' ];
                        $grnProduct->grn_price          = $item[ 'price' ];
                        $grnProduct->type               = 'grn';

                        $grnProduct->save();
                        $quantity = $item[ 'quantity' ] + $quantity;
                    }

                }
            }
        }
        return $quantity;
    }

    private function saveGrnProducts($id, $products) {
        $quantity = 0;
        if(!empty($products)) {
            foreach ($products as $index => $product) {
                foreach ($product as $keep_id => $item) {
                    $grnProduct                     = new StoreGrnProduct();
                    $grnProduct->grn_id             = $id;
                    $grnProduct->product_id         = $index;
                    $grnProduct->product_keeping_id = $keep_id;
                    $grnProduct->quantity           = $item[ 'quantity' ];
                    $grnProduct->price              = $item[ 'price' ];

                    $grnProduct->save();
                    $quantity = $item[ 'quantity' ] + $quantity;
                }
            }
        }
        return $quantity;
    }

    public function allGrn($user_id) {
        $query = StoreGrn::where('store_id', $user_id)
                         ->with('supplier')
                         ->orderBy('id', 'DESC');

        if(\Input::has('supplier')) {
            $query->where('supplier_id', \Input::get('supplier'));
        }

        if(\Input::has('start') && \Input::has('end')) {

            $query->whereBetween('created_at', [\Input::get('start'), \Input::get('end')]);
        }
        return $query->get();
    }

    public function getGrnDetail($user_id, $id) {
        $grn               = StoreGrn::where('id', $id)
                                     ->where('store_id', $user_id)
                                     ->with('products.product')
                                     ->with('products.productKeeping.value1')
                                     ->with('products.productKeeping.value2')
                                     ->with('po.products.productDetail')
                                     ->with('po.products.productKeeping.value1')
                                     ->with('po.products.productKeeping.value2')
                                     ->first()
                                     ->toArray();
        $grn[ 'products' ] = $this->parseGrnProducts($grn);
        unset($grn[ 'po' ]);
        return $grn;

    }

    private function parseGrnProducts($grn) {
        if($grn[ 'object_type' ] == 'purchase_order') {
            return $this->parsePurchaseOrderProducts($grn);
        } else {
            return $this->parseOtherProducts($grn);
        }
    }

    private function parsePurchaseOrderProducts($grn) {
        $products = [];
        foreach ($grn[ 'po' ][ 'products' ] as $product) {
            if($product[ 'grn_quantity' ] != 0) {
                $row                   = [];
                $row[ 'product_id' ]   = $product[ 'product_keeping' ][ 'custom_product_id' ];
                $row[ 'product_name' ] = $product[ 'product_detail' ][ 'title' ] . ' ' . strtoupper($product[ 'product_keeping' ][ 'value1' ][ 'value' ]) . '-' . strtoupper($product[ 'product_keeping' ][ 'value2' ][ 'value' ]);
                $row[ 'barcode' ]      = $product[ 'product_keeping' ][ 'barcode' ];
                $row[ 'quantity' ]     = $product[ 'grn_quantity' ];
                $row[ 'price' ]        = $product[ 'grn_price' ];
                $row[ 'cost_price' ]   = $product[ 'product_keeping' ][ 'cost_price' ];
                $row[ 'id' ]           = $product[ 'product_id' ];
                $row[ 'keeping_id' ]   = $product[ 'product_keeping_id' ];
                $products[]            = $row;
            }

        }

        return $products;
    }

    private function parseOtherProducts($grn) {
        $products = [];
        foreach ($grn[ 'products' ] as $product) {
            if($product[ 'quantity' ] != 0) {
                $row                   = [];
                $row[ 'product_id' ]   = $product[ 'product_keeping' ][ 'custom_product_id' ];
                $row[ 'product_name' ] = $product[ 'product' ][ 'title' ] . ' ' . strtoupper($product[ 'product_keeping' ][ 'value1' ][ 'value' ]) . '-' . strtoupper($product[ 'product_keeping' ][ 'value2' ][ 'value' ]);
                $row[ 'barcode' ]      = $product[ 'product_keeping' ][ 'barcode' ];
                $row[ 'quantity' ]     = $product[ 'quantity' ];
                $row[ 'price' ]        = $product[ 'price' ];
                $row[ 'cost_price' ]   = $product[ 'product_keeping' ][ 'cost_price' ];
                $row[ 'id' ]           = $product[ 'product_id' ];
                $row[ 'keeping_id' ]   = $product[ 'product_keeping_id' ];
                $products[]            = $row;
            }
        }
        return $products;
    }

    public function deleteProduct($data, $user_id) {
        $grn = StoreGrn::where('id', $data[ 'grn' ])->where('store_id', $user_id)->first();
        if(!empty($grn)) {
            if($grn->object_type == 'purchase_order') {
                $product = StorePurchaseOrderProducts::where('product_keeping_id', $data[ 'keeping' ])
                                                     ->where('product_id', $data[ 'id' ])
                                                     ->where('purchase_order_id', $grn->object_value)
                                                     ->first();

                $product->grn_quantity = 0;
                $product->save();
            } else {
                $product = StoreGrnProduct::where('product_id', $data[ 'id' ])
                                          ->where('product_keeping_id', $data[ 'keeping' ])
                                          ->where('grn_id', $data[ 'grn' ])->first();

                $product->quantity = 0;
                $product->save();
            }
            return [
                'error'   => 0,
                'message' => 'Deleted Successfully'
            ];
        } else {
            return [
                'error'   => 1,
                'message' => 'Permission denied'
            ];
        }
    }

    public function update($data, $user_id) {
        $grn = StoreGrn::where('id', $data[ 'grn_id' ])->where('store_id', $user_id)->first();
        if(empty($grn)) {
            return [
                'error'   => 1,
                'message' => 'Data not found'
            ];
        }

        $po_amount = 0;
        if($grn->object_type == 'purchase_order') {
            $po = $this->getPurchaseOrderDetail($grn->object_value);
            if(!empty($po)) {
                $po_amount = $po->po_total;
            }
        }
        $grn->store_id         = $user_id;
        $grn->supplier_id      = (!empty($data[ 'supplier' ]) ? $data[ 'supplier' ] : 0);
        $grn->date             = $data[ 'date' ];
        $grn->bill_no          = $data[ 'bill_no' ];
        $grn->bill_date        = $data[ 'bill_date' ];
        $grn->due_date         = $data[ 'due_date' ];
        $grn->payment_mode     = $data[ 'payment_mode' ];
        $grn->comment          = $data[ 'comment' ];
        $grn->invoice_number   = $data[ 'invoice_number' ];
        $grn->invoice_amount   = $po_amount;
        $grn->loading_expense  = (!empty($data[ 'loading' ]) ? $data[ 'loading' ] : 0);
        $grn->freight_expense  = (!empty($data[ 'freight' ]) ? $data[ 'freight' ] : 0);
        $grn->other_expense    = (!empty($data[ 'other_expense' ]) ? $data[ 'other_expense' ] : 0);
        $grn->adj_amount       = (!empty($data[ 'adj_amount' ]) ? $data[ 'adj_amount' ] : 0);
        $grn->sales_tax        = (!empty($data[ 'sales_tax' ]) ? $data[ 'sales_tax' ] : 0);
        $grn->sales_tax_amount = $data[ 'sales_tax_amount' ];

        $total = $grn->loading_expense + $grn->freight_expense + $grn->other_expense + $grn->adj_amount + $po_amount;
        $tax   = 0;
        if($grn->sales_tax != 0) {
            $tax   = ($total * $grn->sales_tax) / 100;
            $total = $total + $tax;
        }
        $grn->sales_tax_amount = $tax;
        $grn->total_amount     = $total;
        if($grn->save()) {
            if(isset($po)) {
                $quantity = $this->updatePoProducts($grn->object_value, $grn->id, $data[ 'products' ]);
            } else {
                $quantity = $this->updateGrnProducts($grn->id, $data[ 'products' ]);
            }

            $grn->total_quantity = $quantity;
            $grn->save();
        }
    }

    private function updateGrnProducts($id, $products) {
        $quantity = 0;
        if(!empty($products)) {
            foreach ($products as $index => $product) {
                foreach ($product as $keep_id => $item) {
                    $grnProduct = StoreGrnProduct::where('product_id', $index)->where('product_keeping_id', $keep_id)->where('grn_id', $id)->first();
                    if(!empty($grnProduct)) {
                        $grnProduct->quantity = $item[ 'quantity' ];
                        $grnProduct->price    = $item[ 'price' ];

                        $grnProduct->save();
                        $quantity = $item[ 'quantity' ] + $quantity;
                    } else {
                        $grnProduct                     = new StoreGrnProduct();
                        $grnProduct->grn_id             = $id;
                        $grnProduct->product_id         = $index;
                        $grnProduct->product_keeping_id = $keep_id;
                        $grnProduct->quantity           = $item[ 'quantity' ];
                        $grnProduct->price              = $item[ 'price' ];

                        $grnProduct->save();
                        $quantity = $item[ 'quantity' ] + $quantity;
                    }

                }
            }
        }
        return $quantity;
    }

    public function getBatchNo() {
        // return \DB::table('store_grns')->select(\DB::raw('SHOW TABLE STATUS'))->first();
        return \DB::select(\DB::raw("SHOW TABLE STATUS LIKE 'store_grns'"))[ 0 ]->Auto_increment;
    }

    public function importFileData($user_id, $data) {
        $extension = $data->file('grn_file')->getClientOriginalExtension();
        $file_name = 'grn_files/' . random_id(1) . '.' . $extension;
        $path      = storage_path() . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'grn_files';
        if(!\File::exists($path)) {
            \File::makeDirectory($path, 0775, TRUE);
        }
        \Storage::disk('local')->put($file_name, \File::get($data->file('grn_file')));

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
        $data = StoreProductKeeping::whereIn('barcode', $barcode)->with('product')->with('value1')->with('value2')->get()->toArray();
        return $this->parseCsvProducts($data, $csv);
    }

    private function parseCsvProducts($products, $csv) {
        $allProducts = [];
        foreach ($products as $item) {
            $data   = [];
            $data[] = $item[ 'custom_product_id' ];
            $data[] = $item[ 'product' ][ 'title' ] . ' ' . strtoupper($item[ 'value1' ][ 'value' ]) . '-' . strtoupper($item[ 'value2' ][ 'value' ]);
            $data[] = $item[ 'barcode' ];
            $data[] = '<input class="form-control" name="products[' . $item[ 'product' ][ 'id' ] . '][' . $item[ 'id' ] . '][quantity]" type="number" value="' . $csv[ $item[ 'barcode' ] ] . '">';
            $data[] = '<input class="form-control" name="products[' . $item[ 'product' ][ 'id' ] . '][' . $item[ 'id' ] . '][price]" type="number" value="' . $item[ 'price' ] . '">';
            $data[] = $item[ 'cost_price' ];
            $data[] = '<a class="remove-row" href="javascript:void(0)" title="Type for suggestions">
                                        <i class="fa fa-times-circle"></i>
                                    </a>';

            $allProducts[] = $data;
        }
        return $allProducts;
    }

    private function parseProducts($product_detail) {
        $product[ 'id' ]    = $product_detail[ 'product_detail' ][ 'id' ];
        $product[ 'title' ] = $product_detail[ 'product_detail' ][ 'title' ];
        // $product[ 'quantity_received' ] = $product_detail[ 'quantity' ];
        foreach ($product_detail[ 'product_keeping' ] as $item) {
            $product[ 'product_keeping' ][] = $this->parseProductVariants($item);
        }
        return $product;
    }

}
