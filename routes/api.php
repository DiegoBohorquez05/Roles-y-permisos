<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login',[AuthController::class, 'login']);

Route::group(['prefix' => 'customers', 'middleware' => ['auth', 'role:admin']], function ($router){
    Route::post('', [CustomerController::class, 'create']);
    Route::get('', [CustomerController::class, 'index'])->withoutMiddleware(['role:admin'])->can('read customers');
    Route::get('/{id}', [CustomerController::class, 'show']);
    Route::put('/{id}', [CustomerController::class, 'update']);
    Route::post('/{id}', [CustomerController::class, 'destroy']);
});

Route::group(['prefix' => 'permissions', 'middleware' => ['auth', 'role:admin']], function($router){
    Route::get('list-roles-with-permissions', [PermissionController::class, 'listRolesWithPermissions']);
    Route::post('create-role', [PermissionController::class, 'createRole']);
    Route::delete('delete-role/{id}', [PermissionController::class, 'deleteRole']);
    Route::group(['prefix' => 'assign'], function ($router){
       Route::post('to-role', [PermissionController::class, 'assignPermission']);
    });
    Route::group(['prefix' => 'remove'], function ($router){
       Route::post('from-role', [PermissionController::class, 'removePermission']);
    });
});