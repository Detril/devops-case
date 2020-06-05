<?php

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

$router->get('/health', function () use ($router) {
    return 'Ok';
});

$router->group(['prefix' => 'api/v1'], function () use ($router) {
    $router->get('links', 'LinkController@index');
    $router->post('links', 'LinkController@create');
    $router->put('links/{id}', 'LinkController@update');
});
