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
$router->group(['prefix' => 'api/ajax'], function () use ($router) {
	$router->post('lead/save', 'LeadController@save');
});

$router->group(['prefix' => 'api/lead'], function () use ($router) {
	$router->get('create', 'LeadController@create');
	$router->get('inbox', 'LeadController@inbox');
});

$router->group(['prefix' => 'auth'], function () use ($router) {
	 $router->post('/login', 'UserControllers\UserController@userLogin');
});
