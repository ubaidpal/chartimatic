<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 21-Dec-16 12:17 PM
 * File Name    : StoreConfigurationsController.php
 */

namespace Cartimatic\Store\Http\admin;

use App\Http\Controllers\Controller;
use Cartimatic\Store\Repository\StoreConfigurationsRepository;
use Illuminate\Http\Request;

class StoreConfigurationsController extends Controller
{
    /**
     * @var \Illuminate\Http\Request
     */
    private $request;
    /**
     * @var \Cartimatic\Store\Repository\StoreConfigurationsRepository
     */
    private $configuration;
    private $user_id;
    private $user;

    /**
     * StoreConfigurationsController constructor.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Cartimatic\Store\Repository\StoreConfigurationsRepository $configuration
     */
    public function __construct(Request $request, StoreConfigurationsRepository $configuration) {
        parent::__construct();
        $this->request       = $request;
        $this->configuration = $configuration;
        $this->user_id       = $request[ 'middleware' ][ 'user_id' ];
        $this->user          = $request[ 'middleware' ][ 'user' ];
    }

    public function configuration() {
        $data[ 'suppliers' ] = $this->configuration->getSuppliers($this->user_id);
        return view('Store::admin.Configurations.config', $data);
    }

    public function save() {
        $this->validate($this->request, [
            \Config::get('store_configuration.CURRENCY.NAME')              => 'required',
            \Config::get('store_configuration.PRODUCT_VARIABLE_CODE.NAME') => 'required|numeric|min:7',
            \Config::get('store_configuration.PRODUCT_VARIABLE_1.NAME')    => 'required',
            \Config::get('store_configuration.PRODUCT_VARIABLE_2.NAME')    => 'required',
            \Config::get('store_configuration.PRODUCT_VARIABLE_3.NAME')    => 'required',
            \Config::get('store_configuration.PRODUCT_VARIABLE_4.NAME')    => 'required',
            \Config::get('store_configuration.PRODUCT_VARIABLE_5.NAME')    => 'required',
            \Config::get('store_configuration.DECIMAL_POINTS_VALUE.NAME')  => 'required',
            \Config::get('store_configuration.STOCK_OPENING.NAME')         => 'required',
        ]);

        $this->configuration->save($this->request->except(['middleware', '_token']), $this->user_id);

        return redirect()->back()->with('success', 'Store configuration saved successfully');
    }

}
