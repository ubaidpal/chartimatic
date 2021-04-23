<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 16-Aug-16 4:44 PM
 * File Name    : ReportsController.php
 */

namespace Cartimatic\Store\Http\admin;

use App\Http\Controllers\Controller;
use Cartimatic\Store\Repository\ReportsRepository;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    /**
     * @var \Illuminate\Http\Request
     */
    private $request;
    /**
     * @var \Cartimatic\Store\Repository\ReportsRepository
     */
    private $report;
    private $user_id;
    private $user;
    private $is_api;

    /**
     * ReportsController constructor.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Cartimatic\Store\Repository\ReportsRepository $report
     */
    public function __construct(Request $request, ReportsRepository $report) {
        parent::__construct();
        $this->request = $request;
        $this->report  = $report;
        $this->user_id = $request[ 'middleware' ][ 'user_id' ];
        $this->user    = $request[ 'middleware' ][ 'user' ];
        $this->is_api  = $request[ 'middleware' ][ 'is_api' ];
    }

    public function products() {
        $data[ 'products' ] = $this->report->getAllProducts($this->getUserId());
        $data               = $this->report->parseProductsData($data[ 'products' ]);
        $data[ 'title' ]    = 'All Products';

        return view('Store::reports.products', $data);
    }

    public function productDetail($id) {
        $data[ 'title' ]       = 'Product Detail';
        $data[ 'product' ]     = $this->report->getProduct($id);
        $data[ 'shopProducts' ] = $this->report->getAllShopByProduct($id);
        $data[ 'shopProducts' ] = $this->report->parseProductDetailData($data[ 'shopProducts' ]);

        return view('Store::reports.product-detail', $data);
    }

    /**
     * @return mixed
     */
    public function getUserId() {
        return $this->user_id;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sales() {

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

        $data[ 'title' ]      = 'All Orders';
        $data[ 'orders' ]     = $this->report->getAllOrders($this->getUserId(), $start_date, $end_date);
        $data[ 'start_date' ] = $start_date;
        $data[ 'end_date' ]   = $end_date;
        return view('Store::reports.sales', $data);
    }

    public function lost() {
        $data[ 'title' ] = 'Damage and Lost';
        $data[ 'items' ] = $this->report->getAllDamageLost($this->getUserId());
        //echo '<tt><pre>'; print_r($data['items']); die;
        return view('Store::reports.lost', $data);
    }

}
