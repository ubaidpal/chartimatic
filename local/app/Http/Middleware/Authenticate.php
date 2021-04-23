<?php namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use App\Classes\UrlFilter;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use App\User;
use Auth;

class Authenticate
{

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard $auth
     *
     * @return void
     */
    public function __construct(Guard $auth) {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next) {
        \View::addLocation(realpath(base_path('resources/views')));
        if($this->auth->guest()) {
            if($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return view('auth.login');

            }
        }
        return $next($request);
    }

}
