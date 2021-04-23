<?php

namespace Cartimatic\Store\Http;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use app\Http\Requests;
//use App\StorageFile;
use App\User;
use Illuminate\Support\Facades\Auth;
use Cartimatic\Store\Repository\DisputeRepository;
use Cartimatic\Store\StoreProduct;
use Session;

class StoreOrderController extends Controller
{
    protected $storeRepository;
    protected $storeOrderRepository;
    protected $user_id = NULL;
    private   $is_api = NULL;
    /**
     * @var DisputeRepository
     */
    private $disputeRepository;

    /**
     * @param \Cartimatic\Store\Repository\StoreRepository $storeRepository
     * @param Request $middleware
     */
    public function __construct(
        \Cartimatic\Store\Repository\StoreOrderRepository $storeOrderRepository,
        \Cartimatic\Store\Repository\StoreRepository $storeRepository,
        Request $middleware,
        DisputeRepository $disputeRepository
    ) {
        parent::__construct();
        $this->storeRepository      = $storeRepository;
        $this->storeOrderRepository = $storeOrderRepository;
        $this->user_id = $middleware['middleware']['user_id'];
        @$this->data->user = $middleware['middleware']['user'];
        $this->is_api = $middleware['middleware']['is_api'];
        $this->disputeRepository = $disputeRepository;

        if(!isset($this->user_id)){
            $this->user_id           = Auth::user()->id;
        }

    }

    public function getMyOrders($perPage=null) {

        $data[ 'url_user_id' ] = $this->user_id;
        $status                = \Request::get('status');
        $data[ 'status' ]      = $status;
        $order_status          = NULL;
        if(!empty($status) && $status != 'All') {
            if($status == 'ORDER_DISPUTED') {
                $order_status[] = \Config::get('constants_brandstore.ORDER_STATUS.ORDER_DISPUTED');
                $order_status[] = \Config::get('constants_brandstore.ORDER_STATUS.ORDER_DISPUTED_CANCELLED');
                $order_status[] = \Config::get('constants_brandstore.ORDER_STATUS.ORDER_DISPUTED_REJECTED');
                $order_status[] = \Config::get('constants_brandstore.ORDER_STATUS.ORDER_DISPUTE_ACCEPTED');
            } else {
                $order_status[] = \Config::get('constants_brandstore.ORDER_STATUS.' . $status);
            }
        }
        $data[ 'allOrders' ] = $this->storeOrderRepository->paginateUserOrders($this->user_id, $order_status, $perPage);

        if($this->is_api) {
            $data['allOrders'] = $this->storeOrderRepository->userOrdersToArray($this->user_id, $order_status);
        }
        $data[ 'countOrdersStatusWise' ] = $this->storeOrderRepository->countOrdersStatusWise($this->user_id);
        //$data['countRequestToRevise'] = $this->storeOrderRepository->countRequestToReviseCurrentUser();
        $data[ 'title' ] = 'Manage my orders';

        if($this->is_api){
            return \Api::success($data);
        }
        if(!empty($this->theme_id)){
            return view('orders.myOrders', $data);
        }else {
            return view('Store::orders.myOrders', $data);
        }
    }

    public function getMyOrdersApi(Request $request, $perPage=null) {

        $data[ 'url_user_id' ] = $this->user_id;

        $status                = null;

        if(isset($request->order_status)){
            $status                = $request->order_status;
        }

        $data['allOrders'] = $this->storeOrderRepository->userOrdersToArray($this->user_id, $status);

        $data[ 'title' ] = 'Orders';

        return \Api::success($data);

    }

    public function getMyOrderApi(Request $request) {

        $data[ 'url_user_id' ] = $this->user_id;

        $data['order_detail'] = $this->storeOrderRepository->userOrderToArray($this->user_id, $request->order_id);

        $data[ 'title' ] = 'Order Detail';

        return \Api::success($data);

    }

    public function getOrderDispute($id, $type = NULL) {
        $hasDispute = $this->disputeRepository->has_dispute($id);
        if($hasDispute) {
            if(\Auth::user()->user_type == 2){
                return redirect('store/dispute/detail/' . $hasDispute.'/admin');
            }
            return redirect('store/dispute/detail/' . $hasDispute);
        }
        $data[ 'url_user_id' ]  = Auth::user()->id;
        $data[ 'order' ]        = $this->storeOrderRepository->getOrder($id);
        $data[ 'deliveryInfo' ] = $this->storeOrderRepository->getOrderDeliveryInfo($id);

        $data[ 'countRequestToRevise' ] = $this->storeOrderRepository->countRequestToReviseCurrentUser($data[ 'url_user_id' ]);
        $data[ 'payment_received' ]     = $this->storeOrderRepository->paymentReceivedInfo();
        $data[ 'order_id' ]             = $id;
        return view('Store::orders.dispute', $data);

    }

    public function getOrderMangerPanel() {
        $data[ 'url_user_id' ]          = Auth::user()->id;
        $data[ 'allOrders' ]            = $this->storeOrderRepository->getAllOrdersCurrentUser();
        $data[ 'countRequestToRevise' ] = $this->storeOrderRepository->countRequestToReviseCurrentUser($data[ 'url_user_id' ]);
        return view('Store::orders.storeManagerPanelOrders', $data);
    }

    public function orderStatus($orderId, $param, $view) {
        $data[ 'order_id' ] = $orderId;
        $data[ 'param' ] = $param;
        return view('Store::modal.'.$view, $data);
	  }

    public function changeStatusApi(Request $request)
    {
        $order_status = $this->storeOrderRepository->updateOrderStatus($request->order_id, $this->user_id);

        return \Api::success($order_status);
    }
}
