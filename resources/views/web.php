<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WebController;


// website routes
Route::get('/',[LoginController::class,'loginView']);
Route::post('/check-login',[LoginController::class,'checklogin'])->name('check-logn');
Route::post('/account-login',[LoginController::class,'account_login'])->name('account-login');
Route::get('/dashboard',[WebController::class,'indexView'])->name('dashboard.view');
Route::get('/purchase-entry',[WebController::class,'purchaseEntryView']);
Route::get('/sales-entry',[WebController::class,'salesEntryView']);
Route::get('/purchase-entries',[WebController::class,'purchaseEntriesView']);
Route::get('/sales-entries',[WebController::class,'salesEntriesView']);
Route::get('/manage-stock',[WebController::class,'manageStockView']);
Route::get('/khatabook',[WebController::class,'khatabookView']);
Route::get('/settings',[WebController::class,'settingsView']);
Route::get('/reset-password',[WebController::class,'resetPasswordView']);
Route::post('/password-check',[WebController::class,'passwordChek'])->name('password-check');
Route::post('/save-reset-password',[WebController::class,'saveresetpassword'])->name('save-reset-password');
Route::get('/forgot-password',[WebController::class,'forgotPasswordView']);
Route::get('/logout',[WebController::class,'logoutView']);
Route::get('/add-new-shop',[WebController::class,'addNewShopView']);
Route::get('/manage-users',[WebController::class,'manageUsersView']);
Route::get('/edit-purchase',[WebController::class,'editPurchaseView']);
Route::get('/edit-sale',[WebController::class,'editSaleView']);
