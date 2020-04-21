<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


/*Route::prefix('v1')->name('api.v1.')->group(function() {
    Route::get('weChat', 'V1\WeChatController@serve')->name('weChat');

    //我的兴趣


    Route::group(['middleware' => ['web', 'wechat.oauth']], function () {

         Route::get('/members','V1\MemberController@index')->name('members');
    });
});*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\V1',
],function($api) {
    $api->get('weChat', 'WeChatController@serve')->name('weChat');
});




