<?php

use App\Http\Controllers\TasksController;
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
Route::get('/',[TasksController::class,'index'])->name('index');
Route::post('/store',[TasksController::class,'store'])->name('store');
Route::post('/edit',[TasksController::class,'edit']);

# Route::post('/',TasksController::class);
