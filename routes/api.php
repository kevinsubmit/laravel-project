<?php

use Illuminate\Http\Request;

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

Route::group(['middleware' => ['api']], function () {
    // 活动数据（首页）
    Route::any('/activity', 'ApiController@activity');
    // 活动数据（优惠活动）
    Route::any('/activity_all', 'ApiController@activity_all');
    // 活动详情
    Route::any('/activity_info', 'ApiController@activity_info');
    // 点击量
    Route::any('/activity_page_view', 'ApiController@activity_page_view');
    // 赛事数据
    Route::any('/match', 'ApiController@match');
    // 行业资讯数据
    Route::any('/news', 'ApiController@news');
    // 行业资讯 资讯内容
    Route::any('/news_info', 'ApiController@news_info');
    // 域名
    Route::any('/domain', 'ApiController@domain');
    // 广告位
    Route::any('/advertising', 'ApiController@advertising');
    // 手机广告位
    Route::any('/advertising_tel', 'ApiController@advertising_tel');
    // 推荐活动
    Route::any('/recommend', 'ApiController@recommend');
    // 推荐活动搜索
    Route::any('/recommend_redi', 'ApiController@recommend_redi');
    // 公告(首页)
    Route::any('/bulletin', 'ApiController@bulletin');
    // 公告列表（所有）
    Route::any('/bulletin_all', 'ApiController@bulletin_all');
    // 活动轮播
    Route::any('/rotation', 'ApiController@rotation');
    // 赛事推荐
    Route::any('/match_info', 'ApiController@match_info');
    // 全讯网服务项目导航
    Route::any('/service_navigation', 'ApiController@service_navigation');
    // 导航网()
    Route::any('/navigation', 'ApiController@navigation');
    Route::any('/navigation_line', 'ApiController@navigation_line');
    Route::any('/navigation_detect', 'ApiController@navigation_detect');
    Route::any('/navigation_url', 'ApiController@navigation_url');
    Route::any('/navigation_head_link', 'ApiController@navigation_head_link');
    // 广告站登录注册域名
    Route::any('/advertising_url', 'ApiController@advertising_url');
});
