<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Get Product List (localhost:8000/api/product/list)
Route::get('product/list',[RouteController::class,'getProduct']);

// Get Category List (localhost:8000/api/category/list)
Route::get('category/list',[RouteController::class,'getCategory']);

// Get User List (localhost:8000/api/user/list)
Route::get('user/list',[RouteController::class,'getUsers']);

// Create New Category (localhost:8000/api/category/create)
Route::post('category/create',[RouteController::class,'createCategory']);

// Update Category (localhost:8000/api/category/update)
Route::post('category/update',[RouteController::class,'updateCategory']);

// Send Message to Admin (localhost:8000/api/message/send)
Route::post('message/send',[RouteController::class,'sendMessage']);

// Delete Category (localhost:8000/api/category/delete)
Route::get('category/delete/{id}',[RouteController::class,'deleteCategory']);

// Delete Category (localhost:8000/api/category/delete)
Route::post('category/delete',[RouteController::class,'categoryDelete']);
