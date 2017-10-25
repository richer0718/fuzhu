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
    return redirect('/home');
});

//玩家获取
Route::get('/getData', 'Admin\IndexController@getData');
Route::any('/chaxunRes', 'Admin\IndexController@chaxunRes');
Route::any('/customer/yanzhengma', 'Admin\IndexController@yanzhengma');


//后台
Route::get('/admin/index', 'Admin\IndexController@index');
Route::get('/admin/login', 'Admin\IndexController@login');
Route::any('/admin/loginRes', 'Admin\IndexController@loginRes');
Route::any('/admin/loginout', 'Admin\IndexController@loginout');


Route::group(['as' => 'admin_number','middleware' => ['checkadminlogin']], function () {
    Route::any('/admin/number', 'Admin\NumberController@index');
});
Route::group(['as' => 'daili','middleware' => ['checkadminlogin']], function () {
    Route::any('/admin/daili', 'Admin\DaiLiController@index');
    Route::any('/admin/remark', 'Admin\DaiLiController@remark');
    Route::any('/admin/addDailiRes', 'Admin\DaiLiController@addDailiRes');
    Route::any('/admin/editDailiRes', 'Admin\DaiLiController@editDailiRes');
    Route::any('/admin/editDaili/{id}', 'Admin\DaiLiController@editDaili');
    Route::any('/admin/chongzhi/{id}', 'Admin\DaiLiController@chongzhi');
    Route::any('/admin/recharge_log', 'Admin\DaiLiController@recharge_log');
    Route::any('/admin/stopreg', 'Admin\DaiLiController@stopreg');
    Route::any('/admin/recharge', 'Admin\DaiLiController@recharge');
    Route::any('/admin/dongjie/{id}', 'Admin\DaiLiController@dongjie');
    Route::any('/admin/huifu/{id}', 'Admin\DaiLiController@huifu');
    Route::any('/admin/changeReg/{data}', 'Admin\DaiLiController@changeReg');
});
Route::group(['as' => 'notice','middleware' => ['checkadminlogin']], function () {
    Route::any('/admin/notice', 'Admin\NoticeController@index');
    Route::any('/admin/addNotice', 'Admin\NoticeController@addNotice');
    Route::any('/admin/addNoticeRes', 'Admin\NoticeController@addNoticeRes');
    Route::any('/admin/editNoticeRes', 'Admin\NoticeController@editNoticeRes');
    Route::any('/admin/edit/{id}', 'Admin\NoticeController@edit');
    Route::any('/admin/detail/{id}', 'Admin\NoticeController@detail');
    Route::any('/admin/delete_notice/{id}', 'Admin\NoticeController@delete_notice');
});


Route::group(['prefix' => 'api'], function () {
    Route::any('getNumberData/{number}/{area}', 'Admin\ApiController@getNumberData');
    Route::any('getCode/{number}/{area}', 'Admin\ApiController@getCode');
    Route::any('updateNumber/{number}/{area}/{save_time}/{map}/{mode}/{status}/{device}', 'Admin\ApiController@updateNumber');
    Route::any('recoverPoint/{number}/{area}/{point}/{remark}', 'Admin\ApiController@recoverPoint');
    Route::any('getLongNumber/{daili}/{number}/{point}/{save_time}', 'Admin\ApiController@getLongNumber');
    Route::any('getXishuByCode/{code}', 'Admin\ApiController@getXishuByCode');
});



//代理
Route::get('/manage/login', 'Manage\IndexController@login');
Route::any('/manage/loginRes', 'Manage\IndexController@loginRes');
Route::any('/manage/loginout', 'Manage\IndexController@loginout');
Route::any('/manage/regRes', 'Manage\IndexController@regRes');
Route::any('/manage/findPass', 'Manage\IndexController@findPass');
Route::any('/manage/topdetail', 'Manage\IndexController@topdetail');

//挂机账号
Route::group(['as' => 'number_guaji','middleware' => ['checklogin']], function () {

    Route::any('/manage/number', 'Manage\NumberController@index');
    Route::any('/manage/addNumber', 'Manage\NumberController@addNumber');
    Route::any('/manage/addNumberRes', 'Manage\NumberController@addNumberRes');
    Route::any('/manage/rechargeRes', 'Manage\NumberController@rechargeRes');
    Route::any('/manage/rechargeConfirm', 'Manage\NumberController@rechargeConfirm');
    Route::any('/manage/stopNumber', 'Manage\NumberController@stopNumber');
    Route::any('/manage/yanzhengma', 'Manage\NumberController@yanzhengma');
    Route::any('/manage/delete_number/{id}', 'Manage\NumberController@delete_number');
});
//历史账号
Route::group(['as' => 'number_history','middleware' => ['checklogin']], function () {
    Route::any('/manage/number/{url_statuss}', 'Manage\NumberController@index') -> where('url_statuss','1');
    Route::any('/manage/uploadNumber/{id}', 'Manage\NumberController@uploadNumber');
});
//长期账号
Route::group(['as' => 'number_long','middleware' => ['checklogin']], function () {
    Route::any('/manage/number/{url_status}', 'Manage\NumberController@index')->where('url_status','2');
});

Route::group(['as' => 'manage_notice','middleware' => ['checklogin']], function () {
    Route::any('/manage/manage_notice', 'Manage\NoticeController@index');
    Route::any('/manage/detail/{id}', 'Manage\NoticeController@detail');
});

//日志
Route::group(['as' => 'number_log','middleware' => ['checklogin']], function () {
    Route::any('/manage/log', 'Manage\NumberController@log');
});









