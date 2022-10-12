<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\RouteController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('productLists',[RouteController::class,'productLists']);
Route::get('categoryLists',[RouteController::class,'categoryLists']);
Route::get('contactLists',[RouteController::class,'contactLists']);
Route::get('orderApi',[RouteController::class,'orderApi']);
Route::get('orderLists',[RouteController::class,'orderLists']);
Route::get('userLists',[RouteController::class,'userLists']);

Route::get('Product/User/Lists',[RouteController::class,'productUserLists']);

//create api
Route::post('create/category',[RouteController::class,'categoryCreate']);
Route::post('create/contact',[RouteController::class,'contactCreate']);

//delete
Route::post('delete/category',[RouteController::class,'deleteCategory']);

//read
Route::get('detail/category/{id}',[RouteController::class,'detailCategory']);

//update
Route::post('update/category',[RouteController::class,'updateCategory']);

// 127.0.0.1:8000/api/productLists [GET]
// 127.0.0.1:8000/api/categoryLists [GET]
// 127.0.0.1:8000/api/contactLists [GET]
// 127.0.0.1:8000/api/orderApi [GET]
// 127.0.0.1:8000/api/orderLists [GET]
// 127.0.0.1:8000/api/userLists [GET]
// 127.0.0.1:8000/api/Product/User/Lists [GET]

//create
// 127.0.0.1:8000/api/create/category [POST]
// 127.0.0.1:8000/api/create/contact [POST]

//delete
// 127.0.0.1:8000/api/delete/category [POST]

//read
// 127.0.0.1:8000/api/detail/category [GET]

//update
// 127.0.0.1:8000/api/update/category [POST]
