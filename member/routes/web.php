<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

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

// 首页
Route::get('/', function () {
    return view('index');
});

// 登录
Route::get('/login',function(){
    return view('login',['id'=>3]);
});

// 旧验证码
Route::get('/code',function(){
    return view('code');
});

// post登录
Route::post('/userLogin',[LoginController::class,'login']);

// 获取验证码
Route::get('/captchaShow',[App\Http\Controllers\CaptController::class,'captchaShow']);

// 退出登录
Route::get('/logout',[LoginController::class,'logout']);

// 后台管理员首页
// Route::get('/admin/index',function(){
//     return view('admin.index');
// })->middleware('checkAdminLogin');

// （中间组件middleware 验证权限）
// 后台管理员控制器
Route::get('/admin',[\App\Http\Controllers\AdminController::class,'index'])->middleware('checkAdminLogin');

// 注册页面首页
Route::get('/register',function(){
    return view('register.singup');
});

// 注册功能后端控制器
Route::post('/postRegister',[\App\Http\Controllers\PostRegister::class,'index']);

// 用户名是否存在：先布置路由再php artisan make:controller checkUsername会报错
Route::get('/checkUsername',[\App\Http\Controllers\checkUsername::class],'checkUsername');