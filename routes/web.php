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

//Route::get('/', function () {
//    echo date('Y-m-d H:i:s' );
//    //echo '<pre>';print_r($_COOKIE);echo '</pre>';
//    //return view('welcome');
//});
Route::group([
    'prefix'    => '/admin/',
],function(){
    return 'aaa';
});

Route::get('/admin*',function(){
    return '403';
});
//Route::get('/','Home\IndexController@index');

Route::get('/info',function(){
    phpinfo();
});
Route::get('/adduser','User\UserController@add');
Route::get('/adduser','Users\UsersController@add');
Route::get('user','user\User@test');
Route::get('vip/{id}','vip\vip@vip');
Route::get('user/add','user\User@add');
Route::get('users/add','users\User@add');
Route::get('user/update/{id}','user\User@update');
Route::get('user/update/{id}','user\User@update');
Route::get('user/delete/{id}','user\User@delete');
Route::get('/month/{m}/date/{d}','user\User@md');
//路由跳转
Route::redirect('/hello1','/world1',301);
Route::get('/world1','Test\TestController@world1');

Route::get('hello2','Test\TestController@hello2');
Route::get('world2','Test\TestController@world2');
//view视图
Route::view('/mvc','mvc');
Route::view('/error','error',['code'=>40300]);

//路由参数
Route::get('/user/test','User\UserController@test');
//Route::get('/user/{uid}','User\UserController@user');
Route::get('/month/{m}/date/{d}','Test\TestController@md');
Route::get('/name/{str?}','Test\TestController@showName');

// Query Builder
Route::get('/query/get','Test\TestController@query1');
Route::get('/query/where','Test\TestController@query2');


//Route::match(['get','post'],'/test/abc','Test\TestController@abc');
Route::any('/test/abc','Test\TestController@abc');


Route::get('/view/test1','Test\TestController@viewtest1');
Route::get('/view/test2','Test\TestController@viewtest2');

//用户注册
Route::get('/user/reg','User\UserController@reg');
Route::post('/user/reg','User\UserController@doReg');

Route::get('/user/login','User\UserController@login');           //用户登录
Route::post('/user/login','User\UserController@doLogin');        //用户登录
Route::get('/user/center','User\UserController@center');      //个人中心


//模板引入静态文件
Route::get('/mvc/test1','Mvc\MvcController@test1');

Route::get('/mvc/bst','Mvc\MvcController@bst');


//Cookie
//Route::get('/test/cookie','Test\TestController@cookieTest');

//Test
Route::any('/test/guzzle','Test\TestController@guzzleTest');
Route::get('/test/cookie1','Test\TestController@cookieTest1');
Route::get('/test/cookie2','Test\TestController@cookieTest2');
Route::get('/test/session','Test\TestController@sessionTest');
Route::get('/test/mid1','Test\TestController@mid1')->middleware('check.uid');        //中间件测试
Route::get('/test/check_cookie','Test\TestController@checkCookie')->middleware('check.cookie');        //中间件测试


//购物车
//Route::get('/cart','Cart\IndexController@index')->middleware('check.uid');
Route::get('/cart','Cart\IndexController@index')->middleware('check.login.token');
Route::get('/cart/add/{goods_id}','Cart\IndexController@add')->middleware('check.login.token');      //添加商品
Route::get('/cart/del/{goods_id}','Cart\IndexController@del')->middleware('check.login.token');  //删除商品
Route::post('/cart/add2','Cart\IndexController@add2')->middleware('check.login.token');      //添加商品
Route::get('/cart/del2/{goods_id}','Cart\IndexController@del2')->middleware('check.login.token');      //删除商品

//商品
Route::get('/goods/list','Goods\IndexController@goodsList');          //商品列表
Route::get('/goods/{goods_id}','Goods\IndexController@index');          //商品详情


//订单
Route::get('/order/add','Order\IndexController@add');           //下单
Route::get('/order/list','Order\IndexController@orderList');           //订单列表
Route::get('/order/del/{id}','Order\IndexController@del');                      //删除


//支付
Route::get('/pay/o/{oid}','Pay\AlipayController@pay');        //订单支付
Route::get('/pay/alipay/test','Pay\AlipayController@test');         //测试
Route::post('/pay/alipay/notify','Pay\AlipayController@aliNotify');        //支付宝支付 异步通知回调
Route::get('/pay/alipay/return','Pay\AlipayController@aliReturn');        //支付宝支付 同步通知回调

Route::get('/crontab/delete_orders','Crontabs\IndexController@deleteOrders');        //删除过期订单

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//文件上传
Route::get('/upload','Goods\IndexController@uploadIndex');
Route::post('/goods/upload/pdf','Goods\IndexController@uploadPDF');

//座位号
Route::get('/seat/seat','Seat\SeatController@seat');

//微信
Route::get('/weixin/refresh_token','Weixin\WeixinController@refreshToken');     //刷新token
Route::get('/weixin/test/token','Weixin\WeixinController@test');
Route::get('/weixin/valid','Weixin\WeixinController@validToken');
Route::get('/weixin/valid1','Weixin\WeixinController@validToken1');
Route::post('/weixin/valid1','Weixin\WeixinController@wxEvent');        //接收微信服务器事件推送
Route::post('/weixin/valid','Weixin\WeixinController@validToken');

Route::get('/weixin/create_menu','Weixin\WeixinController@createMenu');   //创建菜单

Route::get('/form/show','Weixin\WeixinController@formShow');     //表单测试
Route::post('/form/test','Weixin\WeixinController@formTest');     //表单测试

Route::get('/weixin/material/list','Weixin\WeixinController@materialList');     //获取永久素材列表
//Route::get('/weixin/material/upload','Weixin\WeixinController@upMaterial');     //上传永久素材
Route::post('/weixin/material','Weixin\WeixinController@materialTest');     //创建菜单

Route::get('/form/fs','Weixin\WeixinController@formFs');     //微信互聊
Route::post('/form/hll','Weixin\WeixinController@formHl');     //微信互聊

//微信聊天
Route::get('/weixin/kefu/chat','Weixin\WeixinController@chatView');     //客服聊天
Route::get('/weixin/chat/get_msg','Weixin\WeixinController@getChatMsg');     //获取用户聊天信息


//微信支付
Route::get('/weixin/pay/test','Weixin\PayController@test');     //微信支付测试
Route::post('/weixin/pay/notice','Weixin\PayController@notice');     //微信支付通知回调
Route::get('/weixin/o/{oid}','Weixin\PayController@test')->middleware('check.login.token');         //订单支付

Route::get('/weixin/login','Weixin\WeixinController@login');        //微信登录
Route::get('/weixin/getcode','Weixin\WeixinController@getCode');        //接收code

Route::get('/weixin/jssdk','Weixin\WeixinController@jssdktest');    //微信安全域名

//月考
Route::get('/weixin/yk','Weixin\WxykController@yk');
Route::get('/weixin/ddd','Weixin\WxykController@ddd');
Route::get('/weixin/ccc','Weixin\WxykController@ccc');
Route::get('/weixin/token','Weixin\WxykController@token'); //token
Route::get('/weixin/createss','Weixin\WxykController@createss');


//加密解密

Route::get('/gggg/k','Api\ApiController@mds');

Route::get('/','Test\IndexController@index')->middleware('check.cookie');
