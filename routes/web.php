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
Route::any('/post1','TestController@post1');
Route::any('/post2','TestController@post2');
Route::any('/post3','TestController@post3');

Route::any('/geturl','TestController@getUrl');
});

Route::prefix('api')->middleware('ApiFilter')->group(function(){
Route::any('/user/info','Api\UserController@info');
Route::any('/user/reg','Api\UserController@reg');

});
Route::any('/weather','Api\UserController@weather');

Route::any('/detail','GoodsController@detail');
Route::any('/detail1','GoodsController@detail1');

Route::any('/redis/str','TestController@RedisStr1');
Route::any('/redis/str2','TestController@RedisStr2');

Route::any('/redis/count1','TestController@count1');
Route::any('/api2','TestController@api2')->middleware('ApiFilter');
Route::any('/api3','TestController@api3');
Route::any('/md5test1','TestController@md5Test1');
Route::any('/verify','TestController@verifySign');
Route::any('/lucky','TestController@lucky');

Route::any('/decrypt1','TestController@decrypt1');

Route::any('/decr','TestController@decr');

