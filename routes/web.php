<?php

use App\Http\Controllers\TarefasController;
use Illuminate\Support\Facades\Route;

Route::controller(TarefasController::class)->group(function (){
    Route::get('/','index');
    Route::post('/store','store');
    Route::post('/update/{task}','update');
    Route::post('/update_order','update_order');
    Route::post('/destroy/{id}','destroy');
});
