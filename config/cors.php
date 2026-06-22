<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */


    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    */

    // 🚀 Cambia esto para que acepte las peticiones de tu nuevo Angular 19 local
    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    // 🚀 La opción más rápida para desarrollo es poner el asterisco para abrirlo a todo:
    'allowed_origins' => ['*'],

    // Si prefieres mantenerlo seguro y estricto, pon la URL exacta de tu Angular 19:
    // 'allowed_origins' => ['http://localhost:4200'],

    'allowed_origins_patterns' => [],

    // 🚀 Asegúrate de que acepte todos los métodos (GET, POST, OPTIONS, etc.)
    'allowed_methods' => ['*'],

    // 🚀 Asegúrate de que acepte todas las cabeceras (Content-Type, Authorization)
    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,


];
