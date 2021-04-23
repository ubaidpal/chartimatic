<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 09-Aug-16
 * Time: 11:38 AM
 */

namespace Cartimatic\Shop\Http\Controllers;

use App\Http\Controllers\Controller;
use Cartimatic\Shop\Http\Models\Lesson;
use Cartimatic\Shop\Http\Models\Shop;
use Cartimatic\Shop\Repositories\ShopRepository;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    protected $shopRepository;
    protected $user_id;
    protected $user;
    protected $is_api;
    /**
     * @var \Request
     */
    private $request;
    /**
     * @var \Cartimatic\Shop\Repositories\ShopRepository
     */

    /**
     * ShopController constructor.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Cartimatic\Shop\Repositories\ShopRepository $shopRepository
     *
     */
    public function __construct(Request $request, ShopRepository $shopRepository) {
        parent::__construct();
        $this->request       = $request;
        $this->shopRepository = $shopRepository;
        $this->setUserId($request[ 'middleware' ][ 'user_id' ]);
        $this->user   = $request[ 'middleware' ][ 'user' ];
        $this->is_api = $request[ 'middleware' ][ 'is_api' ];

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $data[ 'shops' ] = $this->shopRepository->getAll($this->getUserId());
        return view('Shop::index', $data);

    }

    /**
     * @return mixed
     */
    public function getUserId() {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function create() {
        $data[ 'managers' ] = $this->shopRepository->getManagers($this->getUserId());
        return view('Shop::create', $data);
    }

    public function store() {
        //echo \DNS1D::getBarcodeHTML("4445645656", "EAN5");
        $this->validate($this->request, [
            'shop_name'      => 'required',
            'city'          => 'required',
            'code'        => 'required',
        ]);

        $isAssigned = $this->shopRepository->isAssigned($this->request->manager_id);
	    $isCode = $this->shopRepository->isCode($this->request->code ,$this->user_id);
        if($isAssigned > 0) {
            return redirect()->back()->withInput()->with('error', 'Manager already assigned to other Shop');
        }else if (count($isCode) > 0){
	        return redirect()->back()->withInput()->with('error', 'The Product Code Must be Different');
        }

        $this->shopRepository->create($this->request, $this->user);
        return redirect('admin/store/shop')->with('success', 'Shop added Successfully');
    }

    public function edit($id) {
        $data[ 'managers' ] = $this->shopRepository->getManagers($this->getUserId());
        $data[ 'shop' ]      = Shop::find($id);
        return view('Shop::edit', $data);
    }

    public function update($id) {
        //echo \DNS1D::getBarcodeHTML("4445645656", "EAN5");
        $this->validate($this->request, [
	        'shop_name'      => 'required',
	        'city'          => 'required',

        ]);

        $isAssigned = $this->shopRepository->isAssignedUpdate($this->request->manager_id, $id);
        if($isAssigned > 0) {
            return redirect()->back()->withInput()->with('error', 'Manager already assigned to other Shop');
        }

        $this->shopRepository->create($this->request, $this->user, $id);
        return redirect('admin/store/shop')->with('success', 'Shop Updated Successfully');
    }

    public function pushItems($id) {
        $data = $this->shopRepository->getAllProducts($this->getUserId());
        //echo '<tt><pre>'; print_r($data ); die;
        $data[ 'shop' ]    = Shop::find($id);
        $data[ 'shop_id' ] = $id;
        return view('Shop::push-items', $data);
    }

    public function bulkAddItems() {
        return view('Shop::bulk-add-items');
    }

    public function manageInventory($id = NULL) {

        if($this->is_api) {
            if(!\Input::has('shop_id')) {
                return \Api::invalid_param();
            } else {
                $id = \Input::get('shop_id');
            }
        }

        $shop           = Shop::find($id);
        $data[ 'shop' ] = $shop;
        if(empty($shop)) {
            if($this->is_api) {
                return \Api::other_error('Shop not found');
            };
            return redirect()->back()->with('error', 'Shop not found');
        } elseif($shop->store_id != $this->getUserId() && !$this->is_api) {

            return redirect()->back()->with('error', 'You cannot view inventory. Permission prohibited!');
        }

        //  echo '<tt><pre>'; print_r($data['products']);die;
        if($this->is_api) {
            $data[ 'products' ] = $this->shopRepository->APIGetInventory($id);
            if(empty($data[ 'products' ])) {
                return \Api::result_not_found();
            }
            $data = $this->shopRepository->parseInventory($data[ 'products' ]);
            return \Api::success_list($data);
        }
        $data[ 'products' ] = $this->shopRepository->getInventory($id);
        $data               = $this->shopRepository->parseInventory($data[ 'products' ], TRUE);
        $data[ 'shop' ]      = $shop;

        //echo '<tt><pre>'; print_r($data[ 'products' ]); die;
        ///$data = $this->shopRepository->parseInventory($data['products']);
        return view('Shop::manage-inventory', $data);
    }

    public function viewSales($id) {
        $shop = Shop::find($id);
        if($shop->store_id != $this->getUserId() && !$this->is_api) {

            return redirect()->back()->with('error', 'You cannot view sales. Permission prohibited!');
        }

        $start_date = '';
        $end_date   = '';
        if($this->request->has('start_date')) {
            $start_date = $this->request->start_date;
        }
        if($this->request->has('end_date')) {
            $end_date = $this->request->end_date;
        }

        if(!empty($start_date) && !empty($end_date)) {
            if($start_date > $end_date) {

                return redirect()->back()->with('error', 'Start date must be less than End date');
            }
        }

        $data[ 'orders' ] = $this->shopRepository->getShopSales($id, $start_date, $end_date);
        //echo '<tt><pre>'; print_r($data); die;
        $data[ 'shop' ]        = $shop;
        $data[ 'start_date' ] = $start_date;
        $data[ 'end_date' ]   = $end_date;
        return view('Shop::view-sales', $data);
    }

    public function salesHistory() {
        return view('Shop::sales-history');
    }

    public function allProducts() {
        return view('Shop::all-products');
    }

    public function productsByShop() {
        return view('Shop::products-by-Shop');
    }

    public function lost() {
        return view('Shop::lost');
    }

    public function shoptPushItems() {
        $referrer = \URL::previous();
        $shop      = Shop::find($this->request->shop_id);

        if(empty($shop)) {
            return redirect()->back()->with('error', 'Shop not found');
        } elseif($shop->store_id != $this->getUserId()) {
            return redirect()->back()->with('error', 'You cannot push item to specified store. Not allowed!');
        }
        if(!$this->request->has('product_id')) {
            return redirect()->back()->with('error', 'Please select at least one product');
        }
        $this->shopRepository->pushItems($this->getUserId(), $this->request);
        if(strpos($referrer, 'manage-product') !== FALSE) {
            return redirect()->back()->with('success', 'Items pushed successfully.');

        }
        //return redirect('admin/store/shop/manage-inventory/' . $this->request->shop_id)->with('success', 'Items pushed successfully.');
        return redirect()->back()->with('success', 'Items pushed successfully.');
    }

    public function updateSyncStatus() {
        if(!$this->request->has('keepings')) {
            return \Api::invalid_param();
        }
        $data = $this->request->all();
        $this->shopRepository->updateSyncStatus($data, $this->user);
        return \Api::success_with_message('Synced successfully');
    }

    public function syncOrders() {
        if(!$this->request->has('orders')) {
            return \Api::invalid_param();
        }
        $data     = $this->request->orders;
        $vendorId = $this->shopRepository->getVendorId($this->getUserId());
        $data     = $this->shopRepository->syncOrders($this->user, $data, $vendorId);
        return \Api::success_with_message('Orders synced successfully');
    }

    public function syncDamageLost() {
        if(!$this->request->has('product')) {
            return \Api::invalid_param();
        }

        $data     = $this->request->product;
        $vendorId = $this->shopRepository->getVendorId($this->getUserId());
        $this->shopRepository->syncDamageLost($this->getUserId(), $data, $vendorId);
        if($data[ 'type' ] == 'return') {
            return \Api::success_with_message('Product returned successfully');
        }
        return \Api::success_with_message('Damage lose saved successfully');
    }

    public function syncDrawer() {

        if(!$this->request->has('drawers')) {
            return \Api::invalid_param();
        }
        $this->shopRepository->saveDrawerData($this->request->drawers, $this->user->store_id, $this->user_id);
        return \Api::success_with_message('Saved Successfully');
    }
}
