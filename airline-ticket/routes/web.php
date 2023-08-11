<?php

/** @var \Laravel\Lumen\Routing\Router $router */

// use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});
// Route::prefix('auth')->group(function () {
//     Route::post('/create', function () {
//         // Route assigned name "admin.users"...
//         var_dump('something');
//     } );
// });
$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('create', [
        'uses' => 'AuthController@create'
    ]);
    $router->post('login', [
        'uses' => 'AuthController@login'
    ]);
});
$router->group(['prefix' => 'info'], function () use ($router) {
    $router->get('all', [
        'uses' => 'FlightController@show'
    ]);
    $router->post('find', [
        'uses' => 'FlightController@find'
    ]);
    $router->post('detail', [
        'uses' => 'FlightController@detail'
    ]);
});