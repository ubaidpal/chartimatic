<?php

namespace Cartimatic\Store\Http\admin;

use App\Http\Controllers\Controller;
use App\Repository\Eloquent\UsersRepository;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use app\Http\Requests;
//use App\StorageFile;
use App\User;
use Illuminate\Support\Facades\Auth;
use Cartimatic\Store\StoreProduct;
use Session;

class StoreAdminOrderController extends Controller {
	protected $storeRepository;
	protected $storeAdminOrderRepository;
	protected $storeAdminRepository;
	protected $user_id = null;

	/**
	 * @param \Cartimatic\Store\Repository\StoreRepository      $storeRepository
	 * @param \Cartimatic\Store\Repository\StoreAdminRepository $storeAdminRepository
	 * @param Request                                              $middleware
	 */
	public function __construct(
		\Cartimatic\Store\Repository\admin\StoreAdminOrderRepository $storeAdminOrderRepository,
		\Cartimatic\Store\Repository\StoreRepository $storeRepository,
		\Cartimatic\Store\Repository\admin\StoreAdminRepository $storeAdminRepository, Request $middleware
	) {
		parent::__construct();
		$this->storeRepository      = $storeRepository;
		$this->storeAdminOrderRepository      = $storeAdminOrderRepository;
		$this->storeAdminRepository = $storeAdminRepository;
		$this->user_id = Auth::user()->id;

		if(Auth::user()->user_type != \Config::get('constants.BRAND_USER')){
			abort(404);
		}
		/* $this->user_id = $middleware['middleware']['user_id'];
		 @$this->data->user = $middleware['middleware']['user'];
		 $this->is_api = $middleware['middleware']['is_api'];*/
	}

	public function getOrders( Request $request ) {	
		$status = $request->get('status');
		$data['status'] = $status;
		$order_status = null;
		if(!empty($status) && $status != 'All') {
			if($status == 'ORDER_DISPUTED'){
				$order_status[] = \Config::get('constants_brandstore.ORDER_STATUS.ORDER_DISPUTED');
				$order_status[] = \Config::get('constants_brandstore.ORDER_STATUS.ORDER_DISPUTED_CANCELLED');
				$order_status[] = \Config::get('constants_brandstore.ORDER_STATUS.ORDER_DISPUTED_REJECTED');
				$order_status[] = \Config::get('constants_brandstore.ORDER_STATUS.ORDER_DISPUTE_ACCEPTED');
			}else {
				$order_status[] = \Config::get('constants_brandstore.ORDER_STATUS.' . $status);
			}
		}
		$order_number = null;
		if(isset($request->order_number)){
			$order_number = $request->order_number;
		}
		$data['order_number'] = $order_number;
		$data['allOrders']   = $this->storeAdminOrderRepository->paginateUserOrders($this->user_id, $order_status, $order_number);
		$data['countOrdersStatusWise'] = $this->storeAdminOrderRepository->countOrdersStatusWise($this->user_id);
		
		$data['url_user_id'] = Auth::user()->username;
		return view('Store::admin.orders.orders', $data);
	}
}
