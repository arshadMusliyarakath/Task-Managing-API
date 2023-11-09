<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('tasks', [ApiController::class, 'tasks']);
Route::post('add-task', [ApiController::class, 'addTask']);
Route::post('delete-task', [ApiController::class, 'deleteTask']);
Route::post('update-task', [ApiController::class, 'updateTask']);

