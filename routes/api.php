<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [\App\Http\Controllers\AuthController::class, 'user']);
    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);

    //data
    //task
    Route::get('tasks', [\App\Http\Controllers\API\TodoController::class, 'index']);
    Route::get('tasks/order/priority', [\App\Http\Controllers\API\TodoController::class, 'sortPriority']);
    Route::get('task/show/{task}', [\App\Http\Controllers\API\TodoController::class, 'show']);
    Route::put('task/changeps/{task}', [\App\Http\Controllers\API\TodoController::class, 'changePosition']);
    Route::post('store/task', [\App\Http\Controllers\API\TodoController::class, 'store']);


    Route::put('store/task/finished/{task}', [\App\Http\Controllers\API\TodoController::class, 'finished']);
    Route::put('store/task/update/{task}', [\App\Http\Controllers\API\TodoController::class, 'update']);

    Route::delete('store/task/delete/{task}', [\App\Http\Controllers\API\TodoController::class, 'destroy']);

    //subtask

    Route::post('store/subtask/task/{id}', [\App\Http\Controllers\API\SubtaskController::class, 'store']);

    Route::put('finished/subtask/{subtask}', [\App\Http\Controllers\API\SubtaskController::class, 'finished']);

    Route::put('update/subtask/{subtask}', [\App\Http\Controllers\API\SubtaskController::class, 'update']);

    Route::delete('destroy/subtask/{subtask}', [\App\Http\Controllers\API\SubtaskController::class, 'destroy']);

    //today

    Route::get('tasks/today', [\App\Http\Controllers\API\TodoController::class, 'today']);
    Route::post('tasks/calendar', [\App\Http\Controllers\API\TodoController::class, 'calendar']);
    //chapter

    Route::get('chapters', [\App\Http\Controllers\API\ChapterController::class, 'index']);
    Route::post('store/chapter', [\App\Http\Controllers\API\ChapterController::class, 'store']);
    Route::put('update/chapter/{chapter}', [\App\Http\Controllers\API\ChapterController::class, 'update']);
    Route::delete('destroy/chapter/{chapter}', [\App\Http\Controllers\API\ChapterController::class, 'destroy']);
});

Route::get('data', [AuthController::class, 'data']);