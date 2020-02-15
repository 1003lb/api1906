<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('php', function () {
  phpinfo();
});

Route::get('md5', function () {
  echo md5($_GET['s']);
  echo "<br>";
   echo sha1($_GET['s']);
});

Route::any('cs','TestController@index');

Route::prefix('test')->group(function(){
Route::any('/test001','TestController@test001');
Route::any('/test002','TestController@test002');
Route::any('/getAccessToken','TestController@getAccessToken');
Route::any('/curl1','TestController@curl1');
Route::any('/curl2','TestController@curl2');

Route::any('/guzzle1','TestController@guzzle1');
Route::any('/index','TestController@index');
Route::get('/get1','TestController@get1');
Route::post('/post1','TestController@post1');
Route::post('/post2','TestController@post2');
Route::post('/post3','TestController@post3');
Route::post('/post5','TestController@post5');
});

Route::prefix('api')->group(function(){
Route::any('/user/info','Api\UserController@info');
Route::any('/user/reg','Api\UserController@reg');

});
