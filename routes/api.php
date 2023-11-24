<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ContaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$router->group(['prefix' => '/conta'], function ($router) {
    $router->get('/', 'Api\V1\ContaController@index');
    $router->post('/', 'Api\V1\ContaController@create');
});

$router->group(['prefix' => '/transacao'], function ($router) {
    $router->post('/', 'Api\V1\TransacaoController@transacao');
});
