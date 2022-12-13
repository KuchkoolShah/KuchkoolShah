<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('welcome');
});

 Auth::routes(['verify' => true]);

//Route::get('/' , [App\Http\Controllers\Auth\LoginController::class , 'showLoginForm']);

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'admin'], function () {
        Route::group(['middleware'=>'admin.guest'], function () {
        Route::view('login', 'admin.login')->name('admin.login');
        Route::post('login', [App\Http\Controllers\AdminController::class,'login'])->name('admin.auth'); });

        Route::group(['middleware'=>'admin.auth'], function () {
        Route::view('dashboard', 'admin.home')->name('admin.home');
        Route::post('logout', [App\Http\Controllers\AdminController::class,'logout'])->name('admin.logout');
        Route::resource('/apk', 'ApkController');
        Route::get('/apk', [App\Http\Controllers\ApkController::class, 'Show_allapk'])->name('showall.apk');
        Route::get('/form/{id}', [App\Http\Controllers\ApkController::class, 'increment_form'])->name('apk.imcrement');
        Route::post('/apk/increment/{id}', [App\Http\Controllers\ApkController::class, 'increment'])->name('apk.countstore');
        Route::get('/search/', [App\Http\Controllers\ApkController::class,'search'])->name('search');
        Route::get('profile/states/{id?}', 'Admin\ProfileController@getStates')->name('profile.states');
        Route::get('profile/cities/{id?}', 'Admin\ProfileController@getCities')->name('profile.cities');
        Route::resource('/student','Admin\StudentController');
        Route::resource('/user','Admin\HomeController');
        Route::resource('/country','Admin\CountryController');
        Route::resource('/state','Admin\StateController');
        Route::resource('/city','Admin\CityController');
        Route::resource('/profile','Admin\ProfileController');
        Route::resource('/category','Admin\CategoryController');
        Route::get('/fetch-students',  [App\Http\Controllers\Admin\StudentController::class, 'fetchstudent']);
      });
});


Route::group(['prefix'=>'editor'], function () {
    Route::group(['middleware'=>'editor.guest'], function () {
        Route::view('login', 'editor.login')->name('editor.login');
        Route::post('login', [App\Http\Controllers\EditorController::class,'login'])->name('editor.auth'); });

    Route::group(['middleware'=>'editor.auth'], function () {
    Route::view('editoring', 'editor.home')->name('admin.home');
    });
});

// Route::namespace("editor")->prefix('editor')->group(function(){
// 	//Route::get('/', [App\Http\Controllers\ApkController::class,'index'])->name('editor.home');
// 	Route::namespace('Auth')->group(function(){
// 		//Route::get('/login', 'LoginController@showLoginForm')->name('editor.login');
//         Route::view('login', 'editor.login')->name('editor.login');

// 		//Route::post('/login', 'LoginController@login');
// 		//Route::post('logout', 'LoginController@logout')->name('editor.logout');
// 	});
// });




 //Route::get('/', [App\Http\Controllers\ApkController::class, 'apk_index']);
//Route::Put('/apk/increment_count/{id}', [App\Http\Controllers\ApkController::class, 'increment_count'])->name('apk.countstoreCount');
