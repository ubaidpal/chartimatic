<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 16-Aug-16 4:47 PM
 * File Name    : ReportsRepository.php
 */

namespace Cartimatic\Store\Repository;

use Carbon\Carbon;
use Cartimatic\Shop\Http\Models\Returns;
use Cartimatic\Shop\Http\Models\ShopProductKeeping;
use Cartimatic\Store\StoreOrder;
use Cartimatic\Store\StoreProduct;

class ReportsRepository
{

    /**
     * @param $userId
     */
    public function getAllProducts($userId) {
        return $products = StoreProduct::whereOwnerId($userId)->orderBy('id', 'DESC')->with('category')->get();
    }

    public function parseProductsData($data) {
        $products   = [];
        $categories = [];
        foreach ($data as $row) {
            $products[ $row->category_id ][]  = $row;
            if($row->category_id != 0){
                $categories[ $row->category->id ] = [
                    'id'   => $row->category->id,
                    'name' => $row->category->name,
                ];
            }

        }
        return [
            'products'   => $products,
            'categories' => $categories,
        ];
    }

    public function getProduct($id) {
        return StoreProduct::find($id);
    }

    public function getAllShopByProduct($id) {
        return ShopProductKeeping::whereProductId($id)->with('product')->with('shop')->get();
    }

    public function getAllOrders($userId, $start_date, $end_date) {

        $query = StoreOrder::whereSellerId($userId)
                           ->whereStatus(6)
                           ->with('orderItems')
                           ->with('customer')
                           ->with('shop')
                           ->orderBy('updated_at', 'DESC');
        if(!empty($start_date) && !empty($end_date)) {
            $query->whereDate('created_at', '>=', Carbon::parse($start_date)->format('Y-m-d H:i:s'))
                  ->whereDate('created_at', '<=', Carbon::parse($end_date)->format('Y-m-d H:i:s'));
        }

        return $query->get();

    }

    public function getAllDamageLost($store_id) {
        return $query = Returns::whereStoreId($store_id)
                                  ->with('shop')
                                  ->with('product')
                                  ->with('keeping.value1')
                                  ->with('keeping.value2')
                                  ->with('keeping.master1')
                                  ->with('keeping.master2')
                                  ->with(['productLog' => function ($query) {
                                      $query->where('type', 'debit')
                                            ->where('transaction_type', 'return');
                                      // ->where('product_id','=','shop_damage_lost.product_id');
                                  }])
                                  ->groupBy('product_id', 'store_keeping_id')
            //->select(\DB::raw('sum(quantity) AS quantity'),'*')
                                  ->get(['*', \DB::raw('sum(quantity) AS total')]);

    }

    public function parseProductDetailData($shopProducts) {
        $all = [];
        $shop = [];
        foreach ($shopProducts as $shopProduct) {
            $shop[]                         = $shopProduct->shop->id;
            $all[ $shopProduct->shop->id ][] = $shopProduct;
        }
        $data = [
            'data'    => $all,
            'shop_ids' => array_unique($shop)
        ];
        return $data['shop'] = $this->parseDataByShop($data);

    }

    private function parseDataByShop($data) {
        $allShop  = [];
        $product = [];
        foreach ($data[ 'shop_ids' ] as $item) {
            $product = $data[ 'data' ][ $item ][ 0 ]->shop;

            $product[ 'productKeeping' ] = $this->parseProductKeepings($data[ 'data' ][ $item ]);

            $allShop[] = $product;
        }

        return $allShop;
    }

    private function parseProductKeepings($items) {
        $keepings = [];
        foreach ($items as $item) {
            unset($item->product);
            unset($item->shop);
            $item->master1;
            $item->master2;
            $item->value1;
            $item->value2;
            $keepings[] = $item;
        }
        return $keepings;
    }
}
