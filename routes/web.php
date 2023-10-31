<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CEOController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    //Artisan::call('route:cache');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return '<h1>Cache cleared</h1>';
});

// Route::get('/', function () {
//     // return redirect()->route('login');
// });

Route::middleware('auth')->group(function () {
    //ceo revenue start
    Route::get('ceo-revenue', [CEOController::class, 'index'])->name('ceo-revenue');
    Route::get('ceo-revenue-model', [CEOController::class, 'revenueModel'])->name('ceo-revenue-model');
    Route::post('ceo-revenue-getData', [CEOController::class, 'getData'])->name('ceo-revenue-getData');
    Route::post('ceo-sales-getData', [CEOController::class, 'perAgentConversion'])->name('ceo-sales-getData');
    //ceo revenue end

    Route::get('student-profile', [HomeController::class, 'studentProfile'])->name('student-profile');

    Route::get('exam-toppers', [HomeController::class, 'examToppers'])->name('exam-toppers');

    Route::get('mentors-interView', [HomeController::class, 'mentorsInterView'])->name('mentors-interView');

    Route::get('faculty-session', [HomeController::class, 'facultySession'])->name('faculty-session');

    Route::get('finance', [HomeController::class, 'finance'])->name('finance');

    Route::get('marketing', [HomeController::class, 'marketing'])->name('marketing');

    Route::get('forum', [HomeController::class, 'forum'])->name('forum');

    Route::get('CATKingOne', [HomeController::class, 'CATKingOne'])->name('CATKingOne');
});

// Auth::routes();

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('check.login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
