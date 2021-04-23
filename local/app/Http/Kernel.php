<?php namespace App\Http;

use App\Http\Middleware\ApiMiddleware;
use App\Http\Middleware\ApiPrivateMiddleware;
use App\Http\Middleware\POSMiddleware;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{

    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
        'Illuminate\Cookie\Middleware\EncryptCookies',
        'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
        'Illuminate\Session\Middleware\StartSession',
        'Illuminate\View\Middleware\ShareErrorsFromSession',
        //'App\Http\Middleware\VerifyCsrfToken',
        //\LucaDegasperi\OAuth2Server\Middleware\OAuthExceptionHandlerMiddleware::class,
        //	\App\Http\Middleware\DataProcess::class
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'                       => 'App\Http\Middleware\Authenticate',
        'auth.basic'                 => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
        'guest'                      => 'App\Http\Middleware\RedirectIfAuthenticated',
        'oauth'                      => \App\Http\Middleware\OAuthMiddleware::class,
        'oauth-user'                 => \LucaDegasperi\OAuth2Server\Middleware\OAuthUserOwnerMiddleware::class,
        'oauth-client'               => \LucaDegasperi\OAuth2Server\Middleware\OAuthClientOwnerMiddleware::class,
        'check-authorization-params' => \LucaDegasperi\OAuth2Server\Middleware\CheckAuthCodeRequestMiddleware::class,
        'data'                       => \App\Http\Middleware\DataProcess::class,
        'admin'                      => \App\Http\Middleware\AdminMiddleware::class,
        'role'                       => \Bican\Roles\Middleware\VerifyRole::class,
        'permission'                 => \Bican\Roles\Middleware\VerifyPermission::class,
        'level'                      => \Bican\Roles\Middleware\VerifyLevel::class,
        'api-middleware'             => ApiMiddleware::class,
        'api-private-middleware'     => ApiPrivateMiddleware::class,
        'pos-middleware'             => POSMiddleware::class

    ];

}
