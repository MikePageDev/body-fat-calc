<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BodyStatsController;

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

Route::get('/', [BodyStatsController::class, 'index'])->name('body_stats.index');
Route::post('/result', [BodyStatsController::class, 'result'])->name('body_stats.result');
Route::post('/save', [BodyStatsController::class, 'save'])->name('body_stats.save');