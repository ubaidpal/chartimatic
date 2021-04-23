<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 26-Sep-16 12:41 PM
 * File Name    : ReturnsRepository.php
 */

namespace Cartimatic\Store\Repository\admin;

use Cartimatic\Shop\Http\Models\Returns;
use Cartimatic\Shop\Repositories\ShopRepository;

class ReturnsRepository
{
    public function getAllDamageLost($store_id, $typeKey, $type) {
        $query = Returns::whereStoreId($store_id)
                        ->with('shop')
                        ->with('product')
                        ->with('keeping.value1')
                        ->with('keeping.value2')
                        ->with('keeping.master1')
                        ->with('keeping.master2')
                        ->orderBy('id', 'DESC');
        /*->with(['productLog' => function ($query) use($type) {
            $query->where('type', 'debit')
                  ->where('transaction_type', $type);
            // ->where('product_id','=','shop_damage_lost.product_id');
        }])*/
        //->groupBy('product_id', 'store_keeping_id')
        //->select(\DB::raw('sum(quantity) AS quantity'),'*')
        //->get(['*', \DB::raw('sum(quantity) AS total')]);
        if($typeKey != 'all') {
            $query->whereReturnType($typeKey);
        }
        return $query->get();

    }

    public function getDetail($getUserId, $id) {
        $detail = Returns::find($id);
        if(empty($detail)) {
            return [
                'error'   => 1,
                'message' => 'Detail not found!',
                'data'    => NULL
            ];
        }
        if($detail->store_id == $getUserId) {
            return [
                'error'   => 0,
                'message' => '',
                'data'    => $detail
            ];
        } else {
            return [
                'error'   => 1,
                'message' => 'Permission denied!',
                'data'    => NULL
            ];
        }
    }

    public function updateStatus($getUserId, $data) {
        $detail = Returns::find($data[ 'return_id' ]);
        if(empty($detail)) {
            return [
                'type'    => 'error',
                'message' => 'Detail not found!',
                'data'    => NULL
            ];
        }
        if($detail->store_id == $getUserId) {

            $detail->status            = \Config::get('constants_brandstore.RETURN_STATUS.RECEIVED');
            $detail->detail            = $data[ 'detail' ];
            $detail->quantity_received = $data[ 'quantity_received' ];
            $detail->save();
            $shopRepo          = new ShopRepository();
            $store_keeping_id = $shopRepo->updateShopKeepingQuantity($detail->shop_id, $detail->product_id, $detail->store_keeping_id, $detail->quantity, 'less');
            $returnsType      = \Config::get('constants_brandstore.RETURNS');
            $returnsType      = array_flip($returnsType);

            $keepData = [
                'product_id'         => $detail->product_id,
                'product_keeping_id' => $detail->store_keeping_id,
                'object_type'        => 'shop',
                'object_id'          => $getUserId,
                'quantity'           => $detail->quantity,
                'transaction_type'   => strtolower($returnsType[ $detail->return_type ]),
                'type'               => 'debit',
            ];
            $shopRepo->addKeepingLogById($keepData);

            if($detail->return_type == \Config::get('constants_brandstore.RETURNS.NORMAL') || $detail->return_type == \Config::get('constants_brandstore.RETURNS.SEASONAL')) {
                $shopRepo->updateStoreKeepingQuantity($store_keeping_id, $detail->quantity, 'add');

            }
            return [
                'type'    => 'success',
                'message' => 'Received Successfully',
                'data'    => $detail
            ];
        } else {
            return [
                'type'    => 'error',
                'message' => 'Permission denied!',
                'data'    => NULL
            ];
        }
    }
}
