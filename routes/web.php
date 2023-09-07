<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// use UniSharp\LaravelFilemanager\Lfm;

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
    return redirect()->action([UserController::class, 'index']);
});
Route::get('/home', function () {
    return redirect()->action([UserController::class, 'index']);
});

// Routes for Authentication
Auth::routes();

// Routes for "user" module
Route::prefix('user')->name('user.')->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');

    Route::get('/edit-profile', [UserController::class, 'editProfile'])->name('editProfile');
    Route::post('/edit-profile', [UserController::class, 'handleEditProfile'])->name('handleEditProfile');

    Route::get('/change-password', [UserController::class, 'changePassword'])->name('changePassword');
    Route::post('/change-password', [UserController::class, 'handleChangePassword'])->name('handleChangePassword');
});


// File Manager
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});