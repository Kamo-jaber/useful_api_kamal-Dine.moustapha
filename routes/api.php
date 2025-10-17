<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\UserModuleController;




//route de connexions et de creation des utilisateurs

Route::prefix('v1')->group( function() {

    Route::post('/register', [AuthController::class, 'addusers']);
    Route::post('/login', [AuthController::class, 'login'])->name('login');



//route pour les modules
Route::middleware('auth:sanctum')->group(function () {



    Route::get('/modules', [ModuleController::class, 'getModules']);
    Route::post('/modules/{id}/activate', [UserModuleController::class, 'activeModule']);
    Route::post('/modules/{id}/desactivate', [UserModuleController::class, 'desactiveModule']);

});
});

