<?php

use App\Models\post;
use App\Http\Controllers\PostCo;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RuteController;
use App\Http\Controllers\GunungController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\InfoController;

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
    return view('beranda',[
        "title"=>"Beranda"
    ]);
    
});


Route::get('/info gunung',[PostCo::class,'index']);

Route::get('/post/{id}',[PostCo::class,'show']);


Route::get('/booking', function () {
    return view('booking',[
        "title"=>"Booking"
    ]);
});

Route::get('/sop', function () {
    return view('tentang Kami',[
        "title"=>"SOP | Suka Gunung"
    ]);
});

Route::get('/login', [LoginController::class, 'index']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'index']);

Route::post('do_register',[RegisterController::class, 'register'])->name('register');
Route::post('do_login',[LoginController::class, 'login'])->name('login');
Route::get('home',[LoginController::class, 'dashboard'])->name('home');
Route::prefix('admin')->group(function () {
    //CRUD User
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::post('/users/add', [UserController::class, 'add'])->name('add');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('edit');
    Route::post('/users/update/{id}', [UserController::class, 'update'])->name('update');
    Route::delete('/users/delete/{id}', [UserController::class, 'delete'])->name('delete');
    //CRUD Rute
    Route::get('/rute',[RuteController::class, 'index'])->name('rute');
    Route::post('/rute/add', [RuteController::class, 'add'])->name('add_rute');
    Route::get('/rute/edit/{id}', [RuteController::class, 'edit'])->name('edit_rute');
    Route::post('/rute/update/{id}', [RuteController::class, 'update'])->name('update_rute');
    Route::delete('/rute/delete/{id}', [RuteController::class, 'delete'])->name('delete_rute');
    //CRUD Gunung
    Route::get('/gunung',[GunungController::class, 'index'])->name('gunung');
    Route::post('/gunung/add', [GunungController::class, 'add'])->name('add_gunung');
    Route::get('/gunung/edit/{id}', [GunungController::class, 'edit'])->name('edit_gunung');
    Route::post('/gunung/update/{id}', [GunungController::class, 'update'])->name('update_gunung');
    Route::delete('/gunung/delete/{id}', [GunungController::class, 'delete'])->name('delete_gunung');
    //Admin Gunung
    Route::get('/mt',[GunungController::class, 'home'])->name('home_mt');
    Route::get('/booking',[BookingController::class,'booking'])->name('admin_booking');
    Route::get('/payment',[BookingController::class,'pay'])->name('admin_payment');
    Route::get('/validate/payment/{id}',[BookingController::class,'validate_pay'])->name('validate_payment');
    Route::get('/info/gunung',[InfoController::class,'index'])->name('info');
    Route::post('/info/add',[InfoController::class,'add_info'])->name('add_info');
    Route::get('/info/edit/{id}',[InfoController::class,'edit_info'])->name('edit_info');
    Route::post('/info/update/{id}',[InfoController::class,'update_info'])->name('update_info');
    Route::delete('/info/delete/{id}',[InfoController::class,'delete_info'])->name('delete_info');

});

Route::prefix('users')->group(function () {
    Route::get('/home',[UserController::class, 'home'])->name('user_home');
    Route::get('/booking',[BookingController::class, 'index'])->name('booking');
    Route::post('/create/booking',[BookingController::class, 'create_booking'])->name('create_booking');
    Route::get('/cancel/booking',[BookingController::class, 'cancel_booking'])->name('cancel_booking');
    Route::post('/payment/booking',[BookingController::class, 'payment'])->name('payment_booking');
});

Route::get('/', function(){
    return view('cover.index');
});