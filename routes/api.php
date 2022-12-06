<?php

use App\Http\Controllers\inventorycontroller;
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

Route::post('/add',[inventorycontroller::class, 'createInventory']);
Route::get('/Read/{id}',[inventorycontroller::class, 'showInventory']);//->where('id', '[0-1000]+');
Route::post('/update/{id}',[inventorycontroller::class, 'updateInventory']);
Route::post('/delete/{id}',[inventorycontroller::class, 'destoryInventory']);