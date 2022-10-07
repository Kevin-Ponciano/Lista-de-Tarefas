<?php

use App\Http\Controllers\TarefasController;
use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;


//Route::get('/',[TasksController::class,'index']);
//Route::post('/store',[TasksController::class,'store']);
//Route::post('/update/{task}',[TasksController::class,'update']);
//Route::post('/update_order',[TasksController::class,'update_order']);
//Route::post('/destroy/{id}',[TasksController::class,'destroy']);

Route::controller(TarefasController::class)->group(function (){
    Route::get('/','index');
    Route::post('/store','store');
    Route::post('/update/{task}','update');
    Route::post('/update_order','update_order');
    Route::post('/destroy/{id}','destroy');
});
