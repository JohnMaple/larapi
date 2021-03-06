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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

// 测试api
Route::prefix('v1')->name('api.v1.')->group(function() {
    Route::get('version', function() {
        return 'this is version v1';
    })->name('version');
});

Route::prefix('v2')->name('api.v2.')->group(function() {
    Route::get('version', function() {
        return 'this is version v2';
    })->name('version');
});

Route::prefix('v1')->name('api.v1.')->group(function() {
    Route::get('version', function() {
        abort(403, 'test');
        return 'this is version v1';
    })->name('version');
});

Route::prefix('v1')->namespace('Api')->name('api.v1.')->group(function () {
    // 访问频率限制
    Route::middleware('throttle:' . config('api.rate_limits.sign'))->group(function () {
        // 图片验证码
        Route::post('captchas', 'CaptchasController@store')->name('captchas.store');

        // 短信验证码
        Route::post('verificationCodes', 'VerificationCodesController@store')->name('verificationCodes.store');

        // 用户注册
        Route::post('users', 'UsersController@store')->name('users.store');
    });

    Route::middleware('throttle:' . config('api.rate_limits.access'))->group(function () {

    });


});


