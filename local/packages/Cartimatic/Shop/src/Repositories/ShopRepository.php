<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 10-Aug-16 11:20 AM
 * File Name    : ShopRepository.php
 */

namespace Cartimatic\Shop\Repositories;

use App\Events\CreateNotification;
use App\Events\SendEmail;
use App\Services\StorageManager;
use Carbon\Carbon;
use Cartimatic\Shop\Http\Models\Shop;
use Cartimatic\Shop\Http\Models\ShopProductKeeping;
use Cartimatic\Shop\Http\Models\Returns;
use Cartimatic\Store\Employee;
use Cartimatic\Store\StoreDrawer;
use Cartimatic\Store\StoreOrder;
use Cartimatic\Store\StoreOrderItems;
use Cartimatic\Store\StoreProduct;
use Cartimatic\Store\StoreProductKeeping;
use Cartimatic\Store\StoreProductKeepingLog;
use Cartimatic\Store\StoreTransaction;

class ShopRepository
{
    /**
     * @return mixed
     */
    public function model() {
        return Shop::class;
    }

    /**
     * @param $all
     */
    public function create($data, $store, $id = NULL) {
        $logo       = '';

        $isAssigned = $this->isAssigned($data[ 'manager_id' ]);
        if($data->hasFile('logo') && !empty($data->file('logo'))) {
            $logo = $this->storeFile($data->file('logo'));
        }

        $manager = Employee::find($data[ 'manager_id' ]);
        $subject = "You are Pointed as Shop Manager";
        if(is_null($id)) {
            $shop = new Shop();

        } else {
            $shop = Shop::find($id);
	        if ( isset( $manager->id ) ) {
		        if ( $manager->id == $shop->manager_id ) {
			        $subject = "You are Pointed as Shop Manager";
		        }
	        }
        }

	    $shop->city          = $data['city'];
	    //$shop->manager_id    = $data['manager_id'];

	    $shop->location    = $data['location'];
	    if(isset($data['code'])){
		    $shop->code        = $data['code'];
	    }
	    $shop->shop_name   = $data['shop'];
	    $shop->address     = $data['address'];
	    $shop->store_id    = $store->id;
	    $shop->priority    = $data['priority'];
	    $shop->shop_group  = $data['shop_group'];
	    $shop->shop_name   = $data['shop_name'];
	    $shop->shop_region = $data['shop_region'];
	    $shop->phone_1     = $data['phone_1'];
	    $shop->phone_2     = $data['phone_2'];
	    $shop->comments    = $data['comments'];
	    $shop->opening_date    = $data['opening_date'];
	    $shop->end_date    = $data['end_date'];

	    $shop->clear_history = $data['clear_history'];
	    $shop->email         = $data['email'];
        if(!empty($data[ 'password' ])) {
          $shop->password = bcrypt($data[ 'password' ]);
        }
      $shop->logo = $logo;

      $shop->save();
        //$employee = Employee::find($data[ 'manager_id' ]);

        /*$emailData = array(
            'subject'  => $subject,
            'message'  => "You are pointed as Shop manager on $shop->location , $shop->city Branch ",
            'from'     => \Config::get('admin_constants.FEEDBACK_EMAIL'),
            'name'     => $employee->name,
            'template' => 'shop-manager',
            'to'       => $employee->email,
            'password' => $data[ 'password' ],
            'email'    => $employee->email,
            'store'    => $store->displayname,
        );
        \Event::fire(new SendEmail($emailData));
      */
    }

    public function isAssigned($manager_id) {
      return false;
        return Shop::whereManagerId($manager_id)->count();
    }

	public function isCode($Code ,$user_id) {

		return Shop::where('code' ,$Code)->where('store_id' ,$user_id)->first();
	}
    private function storeFile($file) {

        $extension      = $file->getClientOriginalExtension();
        $storageManager = new StorageManager();
        $path           = 'shop_logo/';
        $fileName       = $storageManager->getFilename($extension);
        $storageManager->saveFile($path . $fileName, $file);
        $storageManager->generateThumbs($fileName, 100, 100, 'shop_logo', '100x100');
        return $path . $fileName;
    }

    public function getManagers($userId) {

        return Employee:://whereEmployeeType(\Config::get('admin_constants.EMPLOYEES.Shop MANAGER'))
        whereEmployerId($userId)
                       ->orderBy('name', 'ASC')
                       ->lists('name', 'id');
    }

    public function getAll($storeID) {
        return Shop::whereStoreId($storeID)->with('manager')->orderBy('id', 'DESC')->get();
    }

    public function getAllProducts($storeId) {
        /*$data =  StoreProduct::whereOwnerId($storeId)
            ->with('category')
            ->with('attributes.productAttribute.attributeValues')
            ->orderBy('id', 'DESC')
            ->get();*/
        $data = StoreProduct::whereOwnerId($storeId)
                            ->with('category')
                            ->with('productKeeping.master1')
                            ->with('productKeeping.value1')
                            ->with('productKeeping.master2')
                            ->with('productKeeping.value2')
                            ->orderBy('id', 'DESC')
                            ->get();
        //echo '<tt><pre>'; print_r($data); die;
        return $this->parseProductsData($data);
    }

    private function parseProductsData($data) {
        $products   = [];
        $categories = [];
        foreach ($data as $row) {
            $products[ $row->category_id ][] = $this->parseSingleProductData($row);
            if($row->category_id != 0) {
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

    private function parseSingleProductData($row) {
        $keeping = $row->productKeeping;
        unset($row->productKeeping);
        $data[ 'product' ] = $row;
        if(!empty($row->category)) {
            $data[ 'category' ] = [
                'id'   => $row->category->id,
                'name' => $row->category->name,
            ];
        }

        unset($row->category);
        $data[ 'attributes' ] = $this->parseAttributes($keeping);
        return $data;

    }

    private function parseAttributes($attributes) {
        $allAttributes = [];

        foreach ($attributes as $attribute) {

            $data[ 'keeping_id' ]           = $attribute->id;
            $data[ 'id' ]                   = $attribute->id;
            $data[ 'total' ]                = $attribute->quantity;
            $data[ 'price' ]                = $attribute->price;
            $data[ 'custom_id' ]            = $attribute->custom_product_id;
            $data[ 'barcode' ]              = $attribute->barcode;
            $data[ 'cost_price' ]           = $attribute->cost_price;
            $data[ 'discount' ]             = $attribute->discount;
            $data[ 'stock_alert_quantity' ] = $attribute->stock_alert_quantity;
            if(!empty($attribute->master1)) {
                $data[ 'attribute_1' ] = $attribute->master1->label;
            }
            if(!empty($attribute->value1)) {
                $data[ 'attribute_1_value' ] = $attribute->value1->value;
            }
            if(!empty($attribute->master2)) {
                $data[ 'attribute_2' ] = $attribute->master2->label;
            }
            if(!empty($attribute->value2)) {
                $data[ 'attribute_2_value' ] = $attribute->value2->value;
            }

            $allAttributes[ $attribute->id ] = $data;
        }
        return $allAttributes;
    }

    public function pushItems($getUserId, $data) {
        //  echo '<tt><pre>'; print_r($data); die;
        $products = $data->product_id;
        foreach ($products as $product) {
            list($product_id, $keeping_id) = explode('-', $product);
            if($data[ 'quantity-' . $keeping_id ] > 0) {
                $this->saveItems($data->shop_id, $data[ 'quantity-' . $keeping_id ], $keeping_id, $getUserId);
            }
        }
        return TRUE;
    }

    private function saveItems($shop_id, $quantity, $keeping_id, $storeId) {

        $keepingData = StoreProductKeeping::find($keeping_id);
        if(!empty($keepingData)) {

            // Check if store_product_keeping id already exist. If exist then update it otherwise add new
            $shopProductKeeping = ShopProductKeeping::whereStoreProductKeepingId($keeping_id)
                                                  ->whereShopId($shop_id)
                                                  ->first();

            if(empty($shopProductKeeping)) {
                $shopProductKeeping                   = new ShopProductKeeping();
              $shopProductKeeping->quantity         = $quantity;
              $shopProductKeeping->updated_quantity = $quantity;
            } else {
              $shopProductKeeping->quantity         = $quantity + $shopProductKeeping->quantity;
              $shopProductKeeping->updated_quantity = $quantity;
            }

          $shopProductKeeping->product_id               = $keepingData->product_id;
          $shopProductKeeping->barcode                  = $keepingData->barcode;
          $shopProductKeeping->custom_product_id        = $keepingData->custom_product_id;
          $shopProductKeeping->master_attribute_1       = $keepingData->master_attribute_1;
          $shopProductKeeping->master_attribute_2       = $keepingData->master_attribute_2;
          $shopProductKeeping->master_attribute_1_value = $keepingData->master_attribute_1_value;
          $shopProductKeeping->master_attribute_2_value = $keepingData->master_attribute_2_value;
          $shopProductKeeping->price                    = $keepingData->price;
          $shopProductKeeping->cost_price               = $keepingData->cost_price;
          $shopProductKeeping->discount                 = $keepingData->discount;
          $shopProductKeeping->package                  = $keepingData->package;
          $shopProductKeeping->labelcolor               = $keepingData->labelcolor;
          $shopProductKeeping->labelpackage             = $keepingData->labelpackage;
          $shopProductKeeping->labelsize                = $keepingData->labelsize;
          $shopProductKeeping->shop_id                   = $shop_id;
          $shopProductKeeping->store_product_keeping_id = $keepingData->id;
          $shopProductKeeping->status                   = 0;
          $shopProductKeeping->save();

            $keepingData->quantity = $keepingData->quantity - $quantity;

            $logData = [
                'type'               => 'debit',
                'transaction_type'   => 'sent-to-shop',
                'product_keeping_id' => $keepingData->id,
                'product_id'         => $keepingData->product_id,
                'object_type'        => 'store',
                'object_id'          => $storeId,
                'quantity'           => $quantity,
                'updated_at'         => Carbon::now()
            ];

            $this->addKeepingLogById($logData);

            $logData = [
                'type'                     => 'credit',
                'transaction_type'         => 'add',
                'product_keeping_id'       => $shopProductKeeping->id,
                'store_product_keeping_id' => $keepingData->id,
                'product_id'               => $keepingData->product_id,
                'object_type'              => 'shop',
                'object_id'                => $shop_id,
                'quantity'                 => $quantity,
                'updated_at'               => Carbon::now()
            ];

            $this->addKeepingLogById($logData);

            $keepingData->save();
            return TRUE;
        }
        return FALSE;
    }

    public function addKeepingLogById($logData) {
        StoreProductKeepingLog::insert($logData);
    }

    public function getInventory($id) {
        return ShopProductKeeping::whereShopId($id)
                                ->with('product.category')
                                ->with('master1')
                                ->with('value1')
                                ->with('master2')
                                ->with('value2')
                                ->orderBy('id', 'DESC')
                                ->get();
    }

    public function APIGetInventory($id) {
        return ShopProductKeeping::whereShopId($id)
                                ->whereStatus(0)
                                ->with('product.category')
                                ->with('master1')
                                ->with('value1')
                                ->with('master2')
                                ->with('value2')
                                ->orderBy('id', 'DESC')
                                ->get();
    }

    public function parseInventory($products, $forWeb = FALSE) {
        $all        = [];
        $productIds = [];
        foreach ($products as $product) {
            $p = $product;
            if(isset($product->product->id)) {
                $all[ $product->product->id ][] = $p;
                $productIds[]                   = $product->product->id;
            }

        }

        $data = [
            'data'        => $all,
            'product_ids' => array_unique($productIds)
        ];

        if($forWeb) {
            $allProducts = $this->parseDataByJob($data);
            $products    = [];
            $categories  = [];
            //echo '<tt><pre>'; print_r($allProducts); die;
            foreach ($allProducts as $row) {
                $products[ $row->category_id ][] = $row;
                if($row->category_id != 0) {
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
        return $this->parseDataByJob($data);

    }

    private function parseDataByJob($data) {
        $allProduct = [];
        $product    = [];
        foreach ($data[ 'product_ids' ] as $item) {
            $product                     = $data[ 'data' ][ $item ][ 0 ]->product;
            $product[ 'product_image' ]  = getRandomImageOfProduct($product->id);
            $product[ 'productKeeping' ] = $this->parseProductKeepings($data[ 'data' ][ $item ]);

            $allProduct[] = $product;
        }

        return $allProduct;
    }

    private function parseProductKeepings($items) {
        $keepings = [];
        foreach ($items as $item) {
            unset($item->product);
            // unset($item->master1);
            // unset($item->master2);
            // unset($item->value1);
            //  unset($item->value2);
            $keepings[] = $item;

        }
        return $keepings;
    }

    public function updateSyncStatus($data, $user) {
        $items = $data[ 'keepings' ];
        if(is_array($items)) {
            foreach ($items as $item) {
                $this->updateStatus($item);
            }
        } else {
            $this->updateStatus($items);
        }

        $attributes = array(
            'resource_id' => $user->store_id,
            'subject_id'  => $user->id,
            'object_id'   => $user->id,
            'object_type' => \Config::get('constant_notifications.OBJECT_TYPES.PUSHED.NAME'),
            'type'        => \Config::get('constant_notifications.OBJECT_TYPES.PUSHED.ACTIONS.RECEIVED'),
        );

        \Event::fire(new CreateNotification($attributes));
    }

    private function updateStatus($item) {
        $shop = ShopProductKeeping::find($item);

        $shop->status           = 1;
        $shop->updated_quantity = 0;
        $shop->save();
        return TRUE;
    }

    /**
     * @param $userId
     * @param $data
     */
    public function syncOrders($user, $data, $vendorId) {
        foreach ($data as $order) {
            $orderId = $this->saveOrder($order, $vendorId, $user->id);
            $this->saveOrderItems($order[ 'prouducts' ], $orderId, $user->id);
            $transactionData = [
                'user_id'          => $vendorId,
                'type'             => \Config::get('constants_brandstore.STATEMENT_TYPES.SALE'),
                'parent_type'      => 'shop_order',
                'parent_id'        => $orderId,
                'object_type'      => 'shop',
                'object_id'        => $user->id,
                'amount'           => $order[ 'total' ],
                'transaction_type' => 'credit',
                'created_at'       => Carbon::now(),
                'updated_at'       => Carbon::now(),
            ];
            $this->saveStoreTransaction($transactionData);
        }
        $attributes = array(
            'resource_id' => $user->store_id,
            'subject_id'  => $user->id,
            'object_id'   => '',
            'object_type' => \Config::get('constant_notifications.OBJECT_TYPES.ORDER.NAME'),
            'type'        => \Config::get('constant_notifications.OBJECT_TYPES.ORDER.ACTIONS.SYNCED'),
        );

        \Event::fire(new CreateNotification($attributes));
        return TRUE;
    }

    private function saveOrder($order, $vendorId, $userId) {
        if(!empty($order)) {
            $orderObj                 = new StoreOrder();
            $orderObj->seller_id      = $vendorId;
            $orderObj->order_number   = $order[ 'receipt_no' ];
            $orderObj->cash_price     = $order[ 'cash_amount' ];
            $orderObj->card_price     = $order[ 'card_amount' ];
            $orderObj->payment_type   = $order[ 'payment_type' ];
            $orderObj->drawer_id      = $order[ 'drawer_id' ];
            $orderObj->status         = \Config::get('constants_brandstore.ORDER_STATUS.ORDER_DELIVERED');
            $orderObj->total_quantity = $order[ 'total_items' ];
            $orderObj->total_price    = $order[ 'total' ];
            $orderObj->approved_date  = Carbon::now()->format('Y-m-d H:i:s');
            $orderObj->total_discount = $order[ 'discount' ];
            $orderObj->shop_order_id   = $order[ 'id' ];
            $orderObj->customer_name  = $order[ 'customer_name' ];
            $orderObj->shop_id         = $userId;
            $orderObj->created_at     = Carbon::parse($order[ 'created_at' ])->format('Y-m-d H:i:s');
            $orderObj->received_date  = Carbon::parse($order[ 'created_at' ])->format('Y-m-d H:i:s');
            $orderObj->shiping_date   = Carbon::parse($order[ 'created_at' ])->format('Y-m-d H:i:s');
            $orderObj->save();
            return $orderObj->id;
        }
        return FALSE;
    }

    private function saveOrderItems($products, $orderId, $shop_id) {
        foreach ($products as $prouduct) {
            $orderProducts                     = new StoreOrderItems();
            $orderProducts->order_id           = $orderId;
            $orderProducts->product_keeping_id = $prouduct[ 'store_product_keeping_id' ];
            $orderProducts->product_id         = $prouduct[ 'shop_product_id' ];
            $orderProducts->product_price      = $prouduct[ 'unit_price' ];
            $orderProducts->product_discount   = $prouduct[ 'discount' ];
            $orderProducts->quantity           = $prouduct[ 'quantity' ];
            $orderProducts->created_at         = Carbon::parse($prouduct[ 'created_at' ])->format('Y-m-d H:i:s');
            $orderProducts->save();

            // Update Quantity in ShopProductKeeping
            $this->updateShopKeepingQuantity($shop_id, $prouduct[ 'shop_product_id' ], $prouduct[ 'store_product_keeping_id' ], $prouduct[ 'quantity' ], 'less');
        }
    }

    public function updateShopKeepingQuantity($shop_id, $product_id, $store_product_keeping_id, $quantity, $type = 'add') {
        $shopProductKeeping = ShopProductKeeping::whereId($store_product_keeping_id)
                                              ->whereShopId($shop_id)
                                              ->whereProductId($product_id)
                                              ->first();

        if(!empty($shopProductKeeping)) {
            if($type == 'add') {
                $quantity = $shopProductKeeping->quantity + $quantity;
            } else {
                $quantity = $shopProductKeeping->quantity - $quantity;
            }
            $shopProductKeeping->quantity = $quantity;
            $shopProductKeeping->save();
        }
        // echo '<tt><pre>'; print_r($shopProductKeeping->store_product_keeping_id); die;
        return $shopProductKeeping->store_product_keeping_id;

    }

    private function saveStoreTransaction($transactionData) {
        StoreTransaction::create($transactionData);
    }

    public function getVendorId($getUserId) {
        return Shop::find($getUserId)->store_id;
    }

    public function getShopSales($id, $start_date, $end_date) {
        $query = StoreOrder::whereShopId($id)
                           ->whereStatus(6)
                           ->with('orderItems')
            //->with('customer')
                           ->orderBy('updated_at', 'DESC');
        if(!empty($start_date) && !empty($end_date)) {
            $query->where('created_at', '>=', Carbon::parse($start_date)->format('Y-m-d H:i:s'))
                  ->where('created_at', '<=', Carbon::parse($end_date)->format('Y-m-d H:i:s'));
        }
        return $query->paginate(40);
    }

    /**
     * @param $getUserId
     * @param $data
     * @param $vendorId
     *
     * @return bool
     */
    public function syncDamageLost($getUserId, $data, $vendorId) {

        //if($data[ 'type' ] == 'damage') {
        $damageLose = new Returns();

        $damageLose->store_id         = $vendorId;
        $damageLose->shop_id           = $getUserId;
        $damageLose->quantity         = $data[ 'quantity' ];
        $damageLose->product_id       = $data[ 'product_id' ];
        $damageLose->store_keeping_id = $data[ 'store_product_keeping_id' ];
        $damageLose->description      = $data[ 'description' ];
        $damageLose->return_type      = $data[ 'type' ];
        $damageLose->save();

        $attributes = array(
            'resource_id' => $vendorId,
            'subject_id'  => $getUserId,
            'object_id'   => '',
            'object_type' => \Config::get('constant_notifications.OBJECT_TYPES.DAMAGE.NAME'),
            'type'        => \Config::get('constant_notifications.OBJECT_TYPES.DAMAGE.ACTIONS.DAMAGE'),
        );

        \Event::fire(new CreateNotification($attributes));
        // }
        /*$store_keeping_id = $this->updateShopKeepingQuantity($getUserId, $data[ 'product_id' ], $data[ 'store_product_keeping_id' ], $data[ 'quantity' ], 'less');

        $returnsType = \Config::get('constants_brandstore.RETURNS');
        $returnsType = array_flip($returnsType);

        $keepData = [
            'product_id'         => $data[ 'product_id' ],
            'product_keeping_id' => $data[ 'store_product_keeping_id' ],
            'object_type'        => 'shop',
            'object_id'          => $getUserId,
            'quantity'           => $data[ 'quantity' ],
            'transaction_type'   => strtolower($returnsType[$data['type']]),
            'type'               => 'debit',
        ];

        $this->addKeepingLogById($keepData);*/

        if($data[ 'type' ] == \Config::get('constants_brandstore.RETURNS.NORMAL') || $data[ 'type' ] == \Config::get('constants_brandstore.RETURNS.SEASONAL')) {
            $keepData = [
                'product_id'         => $data[ 'product_id' ],
                'product_keeping_id' => $data[ 'store_product_keeping_id' ],
                'object_type'        => 'store',
                'object_id'          => $vendorId,
                'quantity'           => $data[ 'quantity' ],
                'transaction_type'   => 'return-from-shop',
                'type'               => 'credit',
            ];
            // $this->addKeepingLogById($keepData);
            //$this->updateStoreKeepingQuantity($store_keeping_id, $data[ 'quantity' ], 'add');
            $attributes = array(
                'resource_id' => $vendorId,
                'subject_id'  => $getUserId,
                'object_id'   => '',
                'object_type' => \Config::get('constant_notifications.OBJECT_TYPES.RETURN.NAME'),
                'type'        => \Config::get('constant_notifications.OBJECT_TYPES.RETURN.ACTIONS.RETURN'),
            );

            \Event::fire(new CreateNotification($attributes));
        }

        return TRUE;

    }

    public function saveDrawerData($drawers, $store_id, $shop_id) {
        foreach ($drawers as $drawer) {
            $this->saveDrawer($drawer, $store_id, $shop_id);
        }
    }

    private function saveDrawer($drawer, $store_id, $shop_id) {
        $drawerObj = new StoreDrawer();

        $drawerObj->store_id        = $store_id;
        $drawerObj->shop_id          = $shop_id;
        $drawerObj->shop_drawer_id   = $drawer[ 'id' ];
        $drawerObj->opening_balance = $drawer[ 'opening_balance' ];
        $drawerObj->closing_balance = $drawer[ 'closing_balance' ];
        $drawerObj->status          = $drawer[ 'status' ];
        $drawerObj->is_sync         = 1;
        //$drawerObj->created_at      = date('Y-m-d H:i:s', strtotime($drawer['created_at']));
        //$drawerObj->updated_at      = date('Y-m-d H:i:s', strtotime($drawer['updated_at']));
        $drawerObj->created_at = Carbon::parse($drawer[ 'created_at' ])->format('Y-m-d H:i:s');
        $drawerObj->updated_at = Carbon::parse($drawer[ 'updated_at' ])->format('Y-m-d H:i:s');
        $drawerObj->save();

    }

    public function isAssignedUpdate($manager_id, $shopId) {
        return Shop::whereManagerId($manager_id)->where('id', '<>', $shopId)->count();
    }

    public function updateStoreKeepingQuantity($keeping_id, $quantity, $type = 'add') {
        $keepingData = StoreProductKeeping::find($keeping_id);

        if($type == 'add') {
            $quantity = $keepingData->quantity + $quantity;
        } else {
            $quantity = $keepingData->quantity - $quantity;
        }

        $keepingData->quantity = $quantity;
        $keepingData->save();
    }

    private function parseProductAttributes($items) {

        $attributes = [];
        foreach ($items as $item) {
            $data              = '';
            $data[ 'master1' ] = $item->master1;
            $data[ 'master2' ] = $item->master2;
            $data[ 'value1' ]  = $item->value1;
            $data[ 'value2' ]  = $item->value2;
            $attributes[]      = $data;
        }
        return $attributes;
    }

}
