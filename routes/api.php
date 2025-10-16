<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;




//route de connexions et de creation des utilisateurs

Route::prefix('v1')->group( function() {

    Route::post('/register', [AuthController::class, 'addusers']);
    Route::post('/login', [AuthController::class, 'login']);

});
