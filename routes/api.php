<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->group(['prefix' => 'items', 'as' => 'item.'], function () use ($router) {
    $router->post('/', ['as' => 'store', 'uses' => 'ItemController@store']);
    $router->get('/finished', ['as' => 'index_finished', 'uses' => 'ItemController@indexFinished']);
    $router->get('/unfinished', ['as' => 'index_unfinished', 'uses' => 'ItemController@indexUnfinished']);
    $router->get('/{id}', ['as' => 'show', 'uses' => 'ItemController@show']);
    $router->put('/{id}/finish', ['as' => 'finish', 'uses' => 'ItemController@finish']);
});
