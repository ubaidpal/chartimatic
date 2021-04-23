<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 23-Sep-16 4:22 PM
 * File Name    : DashboardController.php
 */

namespace Cartimatic\Store\Http\admin;

use App\Http\Controllers\Controller;
use Cartimatic\Store\Repository\admin\DashboardRepository;
use Illuminate\Http\Request;
use App\StoreOption;

class DashboardController extends Controller
{
    /**
     * @var \Illuminate\Http\Request
     */
    private $request;
    /**
     * @var \Cartimatic\Store\Repository\admin\DashboardRepository
     */
    private $dashboard;

    /**
     * DashboardController constructor.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Cartimatic\Store\Repository\admin\DashboardRepository $dashboard
     */
    public function __construct(Request $request, DashboardRepository $dashboard) {
        parent::__construct();
        $this->request = $request;
        $this->user_id = $request[ 'middleware' ][ 'user_id' ];
        $this->user    = $request[ 'middleware' ][ 'user' ];
        $this->dashboard = $dashboard;

    }

    public function index() {

        if(!$this->is_market_place)
        {
            if (!empty($this->store_db_name) && strtolower($this->store_db_name) != strtolower($this->store_name) && !$this->is_custom_domain)
            {

                return redirect()->to($this->store_url.'/admin/dashboard');
            }
        }
        $data = $this->dashboard->getData($this->user_id);
        return view('Store::admin.Dashboard.index', $data);
    }
}
