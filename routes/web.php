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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

//Post Method
$router->post('/login','AllController@login');
$router->post('/inputNilai', 'AllController@inputNilai');
$router->post('/cekNilai', 'AllController@cekNilai');
$router->post('/cekIpk', 'AllController@cekIpk');

//Get Method
$router->get('/getMahasiswa', 'AllController@getMahasiswa');
$router->get('/getMatkul', 'AllController@getMatkul');
