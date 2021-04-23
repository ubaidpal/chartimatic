<?php

namespace App\Http\Middleware;

use Closure;
use App\Classes\UrlFilter;
use App\User;



class ApiPrivateMiddleware {
    /**
     * DataProcess constructor.
     *
     */
    public function __construct() {

    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param Friend $friendshipRepository
     *
     * @return mixed
     */
    public function handle($request, Closure $next) {

        header("Access-Control-Allow-Origin: *");


        $data['api_private_middleware']['is_api']  = self::is_api();

        $request->merge($data);

        return $next($request);
    }

    private function is_api() {
        return UrlFilter::filter();
    }

}
