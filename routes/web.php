<?php

use App\Http\Controllers\FrondEndController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('login',[FrondEndController::class,'login'])->name('user.login');
Route::post('do-login',[FrondEndController::class,'doLogin'])->name('user.do.login');
Route::get('signup',[FrondEndController::class,'signup'])->name('user.signup');
Route::post('do-signup',[FrondEndController::class,'doSignup'])->name('user.do.signup');

Route::group(['middleware' => 'user_auth'], function(){
    Route::get('/',[FrondEndController::class,'home'])->name('home');
    Route::post('add-task',[TaskController::class,'addTask'])->name('add.task');
    Route::post('update-task',[TaskController::class,'updateTask'])->name('update.task');
    Route::get('delete-task/{task_id}',[TaskController::class,'deleteTask'])->name('delete.task');
    Route::get('logout',[FrondEndController::class,'logout'])->name('user.logout');
});

