<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->resource('categories', CategoryController::class);
    $router->resource('degrees', DegreesController::class);
    $router->resource('products', ProductController::class);
    $router->resource('welfares', WelfareController::class);
    $router->resource('welfare-types', WelfareTypeController::class);
    $router->resource('opinions', OpinionController::class);
    $router->resource('members', MemberController::class);
    $router->resource('advertisings', AdvertisingController::class);
    $router->resource('slides', SlideController::class);
    $router->resource('integral-logs', IntegralLogController::class);
    $router->resource('yidudian-logs', YidudianLogController::class);
    $router->resource('share-logs', ShareLogController::class);
    $router->any('settings', 'SettingController@settings')->name('admin.settings');
    $router->resource('addresses', AddressController::class);
    $router->resource('vouchers', VoucherController::class);
    $router->resource('friends', FriendsController::class);
    $router->resource('messages', MessagesController::class);
    $router->resource('message-pushes', MessagePushController::class);
    $router->resource('book-orders', BookOrderController::class);
    $router->resource('welfare-orders', WelfareOrderController::class);
    $router->resource('articles', ArticleController::class);

});
