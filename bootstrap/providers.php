<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Application Service Providers
    |--------------------------------------------------------------------------
    |
    | Aquí se registran todos los service providers de tu aplicación. Laravel
    | cargará estos providers automáticamente cuando se inicie la aplicación.
    |
    */

    App\Providers\AppServiceProvider::class,
    App\Providers\AuthServiceProvider::class,   // 👈 Necesario para que funcionen los Gates (roles)

];
