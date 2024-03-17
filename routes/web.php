<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

$router->get('/', function ()  use ($router)
{
    return $router->app->version();
});

$router->get('/test', function () {
    return 'Test';
});
//mandatory param
$router->get('moderator/{id}', function ($id) {
    return 'User '.$id;
});
/////optinal parameters
$router->get('admin[/{name}]', function ($name = null) {
    return $name;
});
//multi mandatory params parameters
$router->get('posts/{postId}/comments/{commentId}', function ($postId, $commentId) {
    return 'post num '.$postId;
});
//Regular expression force hime to enter name in characters
$router->get('asd/{name:[A-Za-z]+}', function ($name) {
    return $name;

});
//named routes//
$router->get('dataa', ['as' => 'profile', function () {
    return route('profile');
}]);
//route prefix
$router->group(['prefix' => 'user'], function () use ($router) {
    $router->get('getAll', function () {
        return 'getAllUsers' ;
    });
    $router->post('adddUSer', function () {
        return 'adddUSer' ;
    });
});
//MiddleWare
$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/', function () {
        // Uses Auth Middleware
    });

    $router->get('senior/profile', function () {
        // Uses Auth Middleware
    });
});
///////
//Namespaces
$router->group(['namespace' => 'Admin'], function() use ($router)
{
    // Using The "App\Http\Controllers\Admin" Namespace...
    $router->group(['namespace' => 'User'], function() use ($router) {
        // Using The "App\Http\Controllers\Admin\User" Namespace...
    });
});
//using middleWare
$router->get('age' ,['middleware' => 'age:10', function () {
    print  ('hello from route age  ');
}]);

$router->get('user/profile', function () {
    return $router->app->version();
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

/*$router->group(['middleware' => ['token','xapikey','ipWhitelist'], function () use ($router) {
    $router->get('/', function () {
        return $router->app->version();
    });*/
    $router->get('/userpost/{id}', ['middleware' => 'auth', function (Request $request, $id)
    {
        $user = Auth::user();
        $user = $request->user();
    }]);
    $router->get('showadmin/{id}', 'AdminController@show');
//HTTP Requests
