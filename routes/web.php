<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\HomeController;

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
    return view('login');
})->name('login');

Route::get('google', [LoginController::class, 'loginWithGoogle'])->name('login');
Route::get('/auth/google/callback', [LoginController::class, 'callbackFromGoogle']);

Route::group(['middleware' => 'checklogin'], function () {
    Route::get('/home', [SkillController::class, 'index'])->name('home');
    Route::post('/addskill', [SkillController::class, 'update']);
    Route::get('/skills/delete/{id}', [SkillController::class, 'delete']);
    Route::get('/getdata', [SkillController::class, 'getdata']);
    Route::get('/skillmatrix', [HomeController::class, 'index'])->name('skillmatrix');
    Route::get('/loadSkillMatrix', [HomeController::class, 'getdata']);
    Route::post('/storelevel', [SkillController::class, 'store'])->name('storelevel');
    Route::post('/skills/create', [SkillController::class, 'store']);
});
