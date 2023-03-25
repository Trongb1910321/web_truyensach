<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DanhmucController;
use App\Http\Controllers\TruyenController;
use App\Http\Controllers\ChapterController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\TheloaiController;
use App\Http\Controllers\SachController;
use App\Http\Controllers\ThongkeController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\CustomAuthController;

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

// Route::get('/', function () {
//     return view('layout');
// });
// Route::get('/', [IndexController::class,'home']);
// Route::get('/dashboard', [IndexController::class,'home']);
Route::get('/danh-muc/{slug}', [IndexController::class,'danhmuc']);
Route::get('/xem-truyen/{slug}', [IndexController::class,'xemtruyen'])->name('xemtruyen');
Route::get('/xem-sach/{slug}', [IndexController::class,'xemsach'])->name('xemsach');
Route::get('/xem-chapter/{slug}', [IndexController::class,'xemchapter']);
Route::get('/the-loai/{slug}', [IndexController::class,'theloai']);
Route::get('/doc-sach', [IndexController::class,'docsach']);
Route::post('/xemsachnhanh', [IndexController::class,'xemsachnhanh']);

Route::post('/tim-kiem', [IndexController::class,'timkiem']);
Route::post('/timkiem-ajax', [IndexController::class,'timkiem_ajax']);
Route::get('/tag/{tag}', [IndexController::class,'tag']);
Route::post('/truyennoibat', [TruyenController::class,'truyennoibat']);
Route::post('/tabs-danhmuc', [IndexController::class,'tabs_danhmuc']);
Route::get('/kytu/{kytu}', [IndexController::class,'kytu']);

// Route::get('/login_custom', [CustomAuthController::class, 'login']);
Route::get('/registration_custom', [CustomAuthController::class, 'registration']);
Route::post('/register-user', [CustomAuthController::class, 'registerUser'])->name('register-user');
Route::post('/login-user', [CustomAuthController::class, 'loginUser'])->name('login-user');
// Route::get('/dashboard', [CustomAuthController::class,'dashboard']);
Route::get('/dashboard', [IndexController::class,'home']);
Auth::routes();

// Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/home', [IndexController::class, 'home'])->name('home');
Route::get('/', [IndexController::class, 'home'])->name('home');
// Route::get('/login', function () {
//     return view('auth.login');
// });
// Route::post('/login', [LoginController::class,'authenticated'])->name('login');
Route::get('/logout', [LoginController::class,'logout'])->name('logout');
Route::prefix('admincp')->middleware(['auth','isAdmin'])->group(function () {

    Route::get('home', [HomeController::class, 'index'])->name('admin.home');
});

Route::resource('/danhmuc', DanhmucController::class);
Route::resource('/truyen', TruyenController::class);
Route::resource('/sach', SachController::class);
Route::resource('/chapter', ChapterController::class);
Route::resource('/theloai', TheloaiController::class);
Route::resource('/thongke', ThongkeController::class);

// Route::prefix('truyen')->name('truyen.')->group(function(){
//     Route::get('/',[TruyenController::class,'index'])->name('index');
// });
Route::get('/custom_error', function(){
    return Artisan::call('php artisan vendor:publish --tag==laravel-errors');
});


