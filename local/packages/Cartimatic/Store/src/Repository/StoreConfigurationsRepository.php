<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 21-Dec-16 12:17 PM
 * File Name    : StoreConfigurationsRepository.php
 */

namespace Cartimatic\Store\Repository;

use App\StoreOption;
use Cartimatic\Store\StoreSupplier;

class StoreConfigurationsRepository
{

    public function getSuppliers($user_id) {
        return StoreSupplier::where('store_id', $user_id)->pluck('name', 'id');
    }

    public function save($data, $user_id) {
        $all = [];
        foreach ($data as $key => $value) {
            $all[$key] = $value;
            $this->saveConfig($key, $value, $user_id);
        }
        \Session::forget('SYSTEM_CONFIGURATION');
        \Session::put('SYSTEM_CONFIGURATION',$all);
        //echo '<tt><pre>'; print_r(\Session::get('SYSTEM_CONFIGURATION')['PRODUCT_VARIABLE_CODE']); die;
        return TRUE;
    }

    private function saveConfig($key, $value, $user_id) {
        $is_saved = $this->isConfigSaved($key, $value, $user_id);

        if(!empty($is_saved)) {
            $storeOptions = $is_saved;
        } else {
            $storeOptions = new StoreOption();
        }

        $storeOptions->store_id = $user_id;
        $storeOptions->key      = $key;
        $storeOptions->value    = $value;
        if($storeOptions->save()) {
            return TRUE;
        }
        return FALSE;

    }

    private function isConfigSaved($key, $value, $user_id) {
        return StoreOption::where('store_id', $user_id)->where('key', $key)->first();
    }
}
