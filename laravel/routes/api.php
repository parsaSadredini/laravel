<?php

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
    
//     return $request->user();
// });

Route::get('/category','CategoryController@get')->middleware(['auth:api', 'scope:SeeCategory']);
Route::get('/category/{id}','CategoryController@getById')->middleware(['auth:api', 'scope:SeeCategory']);
Route::post('/category','CategoryController@create')->middleware(['auth:api', 'scope:AddCategory']);
Route::put('/category/{category}','CategoryController@update')->middleware(['auth:api', 'scope:UpdateCategory']);
Route::delete('/category/{category}','CategoryController@delete')->middleware(['auth:api', 'scope:RemoveCategory']);

Route::get('/user','UserController@get')->middleware(['auth:api', 'scope:SeeUser']);
Route::get('/user/{id}','UserController@getById')->middleware(['auth:api', 'scope:SeeUser']);
Route::post('/user','UserController@create')->middleware(['auth:api', 'scope:AddUser']);
Route::put('/user/{user}','UserController@update')->middleware(['auth:api', 'scope:UpdateUser']);
Route::delete('/user/{user}','UserController@delete')->middleware(['auth:api', 'scope:RemoveUser']);
Route::post('/user/login','UserController@login');

Route::get('/role','RoleController@get')->middleware(['auth:api', 'scope:SeeRole']);
Route::get('/role/{id}','RoleController@getById')->middleware(['auth:api', 'scope:SeeRole']);
Route::post('/role','RoleController@create')->middleware(['auth:api', 'scope:AddRole']);
Route::put('/role/{role}','RoleController@update')->middleware(['auth:api', 'scope:UpdateRole']);
Route::delete('/role/{role}','RoleController@delete')->middleware(['auth:api', 'scope:RemoveRole']);

Route::get('/product','ProductController@get')->middleware(['auth:api', 'scope:SeeProduct']);
Route::get('/product/{id}','ProductController@getById')->middleware(['auth:api', 'scope:SeeProduct']);
Route::post('/product','ProductController@create')->middleware(['auth:api', 'scope:AddProduct']);
Route::put('/product/{product}','ProductController@update')->middleware(['auth:api', 'scope:UpdateProduct']);
Route::delete('/product/{product}','ProductController@delete')->middleware(['auth:api', 'scope:RemoveProduct']);

Route::post("member/signup","MemberController@SigUp");
Route::post("member/signin","MemberController@SigIn");
Route::get("shop/category","MemberController@GetGetegories");
Route::get("shop/cats/products/{category}","MemberController@GetProductByCategoryId");



Route::post('/login',function(){
    return "shit";
});
Route::post('register','HomeController@register');
