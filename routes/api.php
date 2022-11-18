<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;


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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


//task_name =task_name
//user_id==userid


//store single todo task
Route::post('/todos', [TodoController::class, 'store']);

//get all Todo task
Route::get('/todos', [TodoController::class, 'index']);

//get single todo task
//task===id
Route::get('/todos/{task}', [TodoController::class, 'edit']);

//update single todo task
//task===id
Route::put('/todos/{task}', [TodoController::class, 'update']);

//delete single  todo task
//task===id
Route::delete('/todos/{task}', [TodoController::class, 'delete']);



//Api to search task by requesting keyword and show data with pagination
//example 
//search = task name
Route::get('/todosearch', [TodoController::class, 'search_filter']);

///mark complete task
//pass task with id
Route::put('/todos/task/complete', [TodoController::class, 'complete']);
