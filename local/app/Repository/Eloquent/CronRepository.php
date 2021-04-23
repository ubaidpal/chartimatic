<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 24-Nov-16 2:55 PM
 * File Name    : CronRepository.php
 */

namespace App\Repository\Eloquent;

use App\Events\SendEmail;
use App\Repository\RepositoryInterface;
use Cartimatic\Store\StoreProductKeeping;

class CronRepository extends Repository implements RepositoryInterface
{

    public function all() {
        // TODO: Implement all() method.
    }

    public function find($id) {
        // TODO: Implement find() method.
    }

    public function saveOrUpdate($id = NULL) {
        // TODO: Implement saveOrUpdate() method.
    }

    public function checkProducts() {

        $products = StoreProductKeeping::whereRaw('stock_alert_quantity >= quantity')
                                       ->where('alert_email_count', 0)
                                       ->where('stock_alert_quantity', '<>', 0)
                                       ->with('product.owner')
                                       ->get()
                                       ->toArray();
        return $products = $this->parseProducts($products);
    }

    private function parseProducts($products) {
        $all = [];
        foreach ($products as $product) {
            $all[ $product[ 'product' ][ 'owner' ][ 'id' ] ][] = $product;
            // $all[] = $p;
        }
        return $all;
    }

    public function sendAlertEmail($product) {
        $email = $product[ 0 ][ 'product' ][ 'owner' ][ 'email' ];
        $name  = $product[ 0 ][ 'product' ][ 'owner' ][ 'displayname' ];

        $emailData = array(
            'subject'  => 'Stock Alert',
            'message'  => 'Stock alert',
            'from'     => \Config::get('admin_constants.ORDER_STATUS_EMAIL'),
            'name'     => 'Cartimatic Admin',
            'template' => 'stock-alert',
            'to'       => $email,
            'seller'   => $name,
            'products' => $product

        );
        \Event::fire(new SendEmail($emailData));
    }

    public function updateEmailAlertCount($id) {
        $product = StoreProductKeeping::find($id);
        if(!empty($product)){
           $product->increment('alert_email_count');
        }
    }
}
