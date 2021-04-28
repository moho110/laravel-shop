<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');

    //定义路由
    $router->get('shop/ad_positions', 'AdPositionsController@index');
    $router->get('shop/ads', 'AdsController@index');
    $router->get('shop/areas', 'AreasController@index');
    $router->get('shop/articles', 'ArticlesController@index');
    $router->get('shop/article_cats', 'ArticleCatsController@index');
    $router->get('shop/attributes', 'AttributesController@index');
    $router->get('shop/banks', 'BanksController@index');
    $router->get('shop/brands', 'BrandsController@index');
    $router->get('shop/carts', 'CartsController@index');
    $router->get('shop/cash_configs', 'CashConfigsController@index');
    $router->get('shop/cash_draws', 'CashDrawsController@index');
    $router->get('shop/cat_brands', 'CatBrandsController@index');
    $router->get('shop/crons', 'CronsController@index');
    $router->get('shop/data_cats', 'DataCatsController@index');
    $router->get('shop/datas', 'DatasController@index');
    $router->get('shop/express', 'ExpressController@index');
    $router->get('shop/favorites', 'FavoritesController@index');
    $router->get('shop/freight', 'FreightsController@index');
    $router->get('shop/friendlinks', 'FriendlinksController@index');
    $router->get('shop/goods', 'GoodsController@index');
    $router->get('shop/goods_appraises', 'GoodsAppraisesController@index');
    $router->get('shop/goods_attributes', 'GoodsAttributesController@index');
    $router->get('shop/goods_cats', 'GoodsCatsController@index');
    $router->get('shop/goods_consult', 'GoodsConsultController@index');
    $router->get('shop/goods_scores', 'GoodsScoresController@index');
    $router->get('shop/goods_specs', 'GoodsSpecsController@index');
    $router->get('shop/goods_virtuals', 'GoodsVirtualsController@index');
    $router->get('shop/home_menus', 'HomeMenusController@index');
    $router->get('shop/images', 'ImagesController@index');
    $router->get('shop/log_moneys', 'LogMoneysController@index');
    $router->get('shop/log_operates', 'LogOperatesController@index');
    $router->get('shop/log_orders', 'LogOrdersController@index');
    $router->get('shop/log_sms', 'LogSmsController@index');
    $router->get('shop/log_staff_logins', 'LogStaffLoginsController@index');
    $router->get('shop/log_user_logins', 'LogUserLoginsController@index');
    $router->get('shop/menus', 'MenusController@index');
    $router->get('shop/messages', 'MessagesController@index');
    $router->get('shop/navs', 'NavsController@index');
    $router->get('shop/orderids', 'OrderidsController@index');
    $router->get('shop/orders', 'OrdersController@index');
    $router->get('shop/order_goods', 'OrderGoodsController@index');
    $router->get('shop/order_refunds', 'OrderRefundsController@index');
    $router->get('shop/payments', 'PaymentsController@index');
    $router->get('shop/privileges', 'PrivilegesController@index');
    $router->get('shop/recommends', 'RecommendsController@index');
    $router->get('shop/roles', 'RolesController@index');
    $router->get('shop/staffs', 'StaffsController@index');
    $router->get('shop/spec_cats', 'SpecCatsController@index');
    $router->get('shop/spec_items', 'SpecItemsController@index');
    $router->get('shop/styles', 'StylesController@index');
    $router->get('shop/sys_configs', 'SysConfigsController@index');
    $router->get('shop/template_msgs', 'TemplateMsgsController@index');
    $router->get('shop/user_address', 'UserAddressController@index');
    $router->get('shop/user_ranks', 'UserRanksController@index');
    $router->get('shop/user_scores', 'UserScoresController@index');
    //定义资源
    $router->resource('shop/ad_positions',AdPositionsController::class);
    $router->resource('shop/ads',AdsController::class);
    $router->resource('shop/areas',AreasController::class);
    $router->resource('shop/articles',ArticlesController::class);
    $router->resource('shop/article_cats',ArticleCatsController::class);
    $router->resource('shop/attributes',AttributesController::class);
    $router->resource('shop/banks',BanksController::class);
    $router->resource('shop/brands',BrandsController::class);
    $router->resource('shop/carts',CartsController::class);
    $router->resource('shop/cash_configs',CashConfigsController::class);
    $router->resource('shop/cash_draws',CashDrawsController::class);
    $router->resource('shop/cat_brands',CatBrandsController::class);
    $router->resource('shop/crons',CronsController::class);
    $router->resource('shop/data_cats',DataCatsController::class);
    $router->resource('shop/datas',DatasController::class);
    $router->resource('shop/express',ExpressController::class);
    $router->resource('shop/favorites',FavoritesController::class);
    $router->resource('shop/freight',FreightsController::class);
    $router->resource('shop/friendlinks',FriendlinksController::class);
    $router->resource('shop/goods',GoodsController::class);
    $router->resource('shop/goods_appraises',GoodsAppraisesController::class);
    $router->resource('shop/goods_attributes',GoodsAttributesController::class);
    $router->resource('shop/goods_cats',GoodsCatsController::class);
    $router->resource('shop/goods_consult',GoodsConsultController::class);
    $router->resource('shop/goods_scores',GoodsScoresController::class);
    $router->resource('shop/goods_specs',GoodsSpecsController::class);
    $router->resource('shop/goods_virtuals',GoodsVirtualsController::class);
    $router->resource('shop/home_menus',HomeMenusController::class);
    $router->resource('shop/images',ImagesController::class);
    $router->resource('shop/log_moneys',LogMoneysController::class);
    $router->resource('shop/log_operates',LogOperatesController::class);
    $router->resource('shop/log_orders',LogOrdersController::class);
    $router->resource('shop/log_sms',LogSmsController::class);
    $router->resource('shop/log_staff_logins',LogStaffLoginsController::class);
    $router->resource('shop/log_user_logins',LogUserLoginsController::class);
    $router->resource('shop/menus',MenusController::class);
    $router->resource('shop/messages',MessagesController::class);
    $router->resource('shop/navs',NavsController::class);
    $router->resource('shop/orderids',OrderidsController::class);
    $router->resource('shop/orders',OrdersController::class);
    $router->resource('shop/order_goods',OrderGoodsController::class);
    $router->resource('shop/order_refunds',OrderRefundsController::class);
    $router->resource('shop/payments',PaymentsController::class);
    $router->resource('shop/privileges',PrivilegesController::class);
    $router->resource('shop/recommends',RecommendsController::class);
    $router->resource('shop/roles',RolesController::class);
    $router->resource('shop/staffs',StaffsController::class);
    $router->resource('shop/spec_cats',SpecCatsController::class);
    $router->resource('shop/spec_items',SpecItemsController::class);
    $router->resource('shop/styles',StylesController::class);
    $router->resource('shop/sys_configs',SysConfigsController::class);
    $router->resource('shop/user_address',UserAddressController::class);
    $router->resource('shop/template_msgs',TemplateMsgsController::class);
    $router->resource('shop/user_ranks',UserRanksController::class);
    $router->resource('shop/user_scores',UserScoresController::class);

});
