<?php

namespace App\Http\Middleware;

use App\Classes\UrlFilter;
use Cartimatic\POS\Http\Models\POS;
use Closure;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use Symfony\Component\Console\Helper\Table;

class POSMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next) {

        $data[ 'middleware' ][ 'is_api' ]    = self::is_api();
        $data[ 'middleware' ][ 'is_public' ] = TRUE;

        \Config::set('auth.providers.users.table', 'pos');
        \Config::set('auth.providers.users.model', POS::class);
        //return \Config::get('auth.ta')
        if(\Input::has('access_token')) {
            $data[ 'middleware' ][ 'user_id' ] = self::get_user_detail()[ 'user_id' ];
            $data[ 'middleware' ][ 'user' ]    = self::get_user_detail()[ 'user' ];
        }

        $request->merge($data);
        return $next($request);
    }

    private function is_api() {
        return UrlFilter::filter();
    }

    private function get_user_detail() {
        $is_api = self::is_api();
        if($is_api) {
            $user_id = \DB::table('oauth_access_tokens')->where('oauth_access_tokens.id', \Input::get('access_token'))
                          ->join('oauth_sessions', 'oauth_sessions.id', '=', 'oauth_access_tokens.session_id')
                          ->first();
            $user_id = $user_id->owner_id;
            $user    = POS::findOrNew($user_id);
        } else {
            if(\Auth::check()) {
                $user                  = \Auth::user();
                $user[ 'user_detail' ] = $user;
                $user_id               = $user->id;
            }
            /* if(Auth::check()) {
                 $user = Auth::user();
                 if($user->user_type == \Config::get('constants.BRAND_USER')) {
                     $user['user_detail'] = $user->brand_detail;
                 } else {
                     $user['user_detail'] = $user->consumer_detail;
                 }
                 $user_id = $user->id;
             }*/
        }

        if(isset($user_id)) {
            return ['user_id' => $user_id, 'user' => $user,];
        }
    }

}
