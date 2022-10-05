<?php

use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;


Route::get('/',[TasksController::class,'index']);
Route::post('/store',[TasksController::class,'store']);
Route::post('/update/{task}',[TasksController::class,'update']);
Route::post('/destroy/{id}',[TasksController::class,'destroy']);

