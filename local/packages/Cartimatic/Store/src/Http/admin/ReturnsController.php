<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 26-Sep-16 12:34 PM
 * File Name    : ReturnsController.php
 */

namespace Cartimatic\Store\Http\admin;

use App\Http\Controllers\Controller;
use Cartimatic\Store\Repository\admin\ReturnsRepository;
use Illuminate\Http\Request;
use Psy\Util\Json;

class ReturnsController extends Controller
{
    private $request;
    private $user_id;
    private $user;
    /**
     * @var \Cartimatic\Store\Repository\admin\ReturnsRepository
     */
    private $return;

    public function __construct(Request $request, ReturnsRepository $return) {
        parent::__construct();
        $this->setRequest($request);
        $this->setUserId($request[ 'middleware' ][ 'user_id' ]);
        $this->setUser($request[ 'middleware' ][ 'user' ]);
        $this->return = $return;
    }

    public function index($type) {
        if($type== 'all'){
            $typeKey = 'all';
        }else{
            $typeKey =  \Config::get('constants_brandstore.RETURNS.'.strtoupper($type));
        }
        $data[ 'title' ] = 'Damage and Lost';
        $data[ 'page_title' ] = $type;
        $data[ 'items' ] = $this->return->getAllDamageLost($this->getUserId(),$typeKey, $type);
        //echo '<tt><pre>'; print_r($data); die;
        return view('Store::admin.returns.index', $data);
    }

    public function getDetail() {
        $data = $this->return->getDetail($this->getUserId(),$this->getRequest()->id);
        return \Response::json($data);
    }

    public function updateStatus() {
        $data = $this->return->updateStatus($this->getUserId(),$this->getRequest()->all());
        return redirect()->back()->with($data['type'], $data['message']);
    }
    /**
     * @param array $middleware
     */
    public function setMiddleware($middleware) {
        $this->middleware = $middleware;
    }

    /**
     * @param \Illuminate\Http\Request $request
     */
    public function setRequest($request) {
        $this->request = $request;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user) {
        $this->user = $user;
    }

    /**
     * @return \Illuminate\Http\Request
     */
    public function getRequest() {
        return $this->request;
    }

    /**
     * @return mixed
     */
    public function getUserId() {
        return $this->user_id;
    }

    /**
     * @return mixed
     */
    public function getUser() {
        return $this->user;
    }
}
