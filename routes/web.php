<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
$router->get('/test', function () {
    print  ('hello from route ');
});
//mandatory param
$router->get('user/{id}', function ($id) {
    return 'User '.$id;
});
//multi parameters
$router->get('posts/{postId}/comments/{commentId}', function ($postId, $commentId) {
    return 'post num '.$postId;
});
/////optinal parameters
$router->get('user[/{name}]', function ($name = null) {
    return $name;
});
//named routes///////////////////////////////////////////
$router->get('profile', ['as' => 'profile', function () {
    return route('profile');
}]);
//route prefix//route prefix//route prefix//route prefix//route prefix
$router->group(['prefix' => 'user'], function () use ($router) {
    $router->get('getAll', function () {
        // Matches The "/user/getAll" URL
        return 'getAllUsers' ;
    });
    $router->post('adddUSer', function () {
        // Matches The "/user/getAll" URL
        return 'adddUSer' ;
    });
});
//using middleWare
$router->get('age' ,['middleware' => 'age:10', function () {
    print  ('hello from route age  ');
}]);
*//*
$router->group(['middleware' => ['token','xapikey','ipWhitelist'], function () use ($router) {
    $router->get('/', function () {
        return $router->app->version();
    });

    $router->get('user/profile', function () {
        // Uses Auth Middleware
    });
});*/

$router->get('/', function () {
    print  ('hello from route ');
});
$router->post('/login', [
    'middleware' => [ 'xapikey' ,'ipWhitelist'],
    'uses' => 'AdminController@login'
]);
$router->post('/getQuestions', [
    'middleware' => ['token', 'xapikey' ,'ipWhitelist'],
    'uses' => 'AdminController@getQuestions'
]);
$router->post('/banIP', [
    'middleware' => [ 'xapikey' ,'ipWhitelist'],
    'uses' => 'AdminController@banIP'
]);
