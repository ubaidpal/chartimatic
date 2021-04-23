<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 16-Aug-16 12:29 PM
 * File Name    : AuthController.php
 */

namespace Cartimatic\Shop\Http\Controllers;

use App\Http\Controllers\Controller;
use Cartimatic\Shop\Repositories\AuthRepository;
use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class AuthController extends Controller
{
    /**
     * @var \Cartimatic\Shop\Repositories\AuthRepository
     */
    private $authRepository;

    /**
     * AuthController constructor.
     */
    public function __construct(AuthRepository $authRepository) {
        parent::__construct();
        $this->authRepository = $authRepository;
    }

    public function login(Request $request) {
        if(\Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = \Auth::user();
            if($user->is_sync) {
                return \Api::other_error('These credentials are already used by other Shop!');
            } else {
                $user->is_sync = TRUE;
                $user->save();
            }
            $access_token = Authorizer::issueAccessToken();
            // echo '<tt><pre>'; print_r($access_token); die;
            $data[ 'data' ]           = \Auth::user();
            $data[ 'data' ][ 'logo' ] = url('photo/' . \Auth::user()->logo);
            $data['access_token'] = $access_token;


            return \Api::success($data);
        } else {
            return \Api::invalid_param('Please provide valid credentials!');

        }
    }
}
