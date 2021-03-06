<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'checkimfor' => \App\Http\Middleware\Checkimformations::class,
        'checkbeforeupdate' => \App\Http\Middleware\Checkbeforeupdate::class,
        'checkchangepass' => \App\Http\Middleware\Checkchangepass::class,
        'checkadvance' => \App\Http\Middleware\Checkadvance::class,
        'checklogin' => \App\Http\Middleware\Checklogin::class,
        'checkaddproject' => \App\Http\Middleware\Checkaddproject::class,
        'checkchangepassadmin' => \App\Http\Middleware\Checkchangepassadmin::class,
        'checkbeforeupdateadmin' => \App\Http\Middleware\Checkbeforeupdateadmin::class,
        'checkplanadd' => \App\Http\Middleware\Checkplanadd::class,
        'checkplanupdate' => \App\Http\Middleware\Checkplanupdate::class,
        'checkassignment' => \App\Http\Middleware\Checkassignment::class,
        'checkupdateproject' => \App\Http\Middleware\Checkupdateproject::class,
        'checkaddnotice' => \App\Http\Middleware\Checkaddnotice::class,
        'checkupdatenotice' => \App\Http\Middleware\Checkupdatenotice::class,
        'checkrefuse' => \App\Http\Middleware\Checkrefuse::class,
        'checkadminpayment' => \App\Http\Middleware\Checkadminpayment::class,
        'checkaddtemplate' => \App\Http\Middleware\Checkaddtemplates::class,
        'checkupdatetemplate' => \App\Http\Middleware\Checkupdatetemplates::class,
    ];
}
