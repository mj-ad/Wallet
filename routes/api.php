<?php

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\WalletTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// users endpoints
Route::put('users/{id}',                  [UserController::class, 'update']);
Route::get('users/{id}',                  [UserController::class, 'show']);
Route::get('users',                       [UserController::class, 'index']);
Route::post('users',                      [UserController::class, 'store']);
Route::delete('users/{id}',               [UserController::class, 'destroy']);

// wallet types endpoints
Route::put('wallet_types/{id}',                  [WalletTypeController::class, 'update']);
Route::get('wallet_types/{id}',                  [WalletTypeController::class, 'show']);
Route::get('wallet_types',                       [WalletTypeController::class, 'index']);
Route::post('wallet_types',                      [WalletTypeController::class, 'store']);
Route::delete('wallet_types/{id}',               [WalletTypeController::class, 'destroy']);

// wallets endpoints
Route::put('wallets/{id}',                  [WalletController::class, 'update']);
Route::get('wallets/{id}',                  [WalletController::class, 'show']);
Route::get('wallets',                       [WalletController::class, 'index']);
Route::post('wallets',                      [WalletController::class, 'store']);
Route::delete('wallets/{id}',               [WalletController::class, 'destroy']);

//transactions endpoints
Route::get('transactions',                       [TransactionController::class, 'index']);
Route::post('transactions',                      [TransactionController::class, 'sendMoney']);
Route::delete('transactions/{id}',               [TransactionController::class, 'destroy']);
