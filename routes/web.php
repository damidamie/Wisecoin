<?php

use App\Http\Controllers\ExpenseCalendarController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\PlanningController;
use App\Http\Controllers\DashboardController;
use App\Models\Transaction;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('layouts.index');
})->name('index');

// Route::get('/', [DashboardController::class, 'dashboardMostExpensiveTransaction'])->name('index');

// Start Transaction
Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction');

Route::post('/transaction/store', [TransactionController::class, 'store'])->name('store.transaction');

Route::delete('/transaction/delete', [TransactionController::class, 'deleteTransaction'])->name('delete.transaction');
// End Transaction

// Start Wallet
// Show Wallet 
Route::get('/wallet', [WalletController::class, 'index'])->name('wallet');

// Create Monthly Expense
Route::post('/wallet/store_expense', [WalletController::class, 'storeMonthlyExpense'])->name('store.monthly_expense');

// Update Monthly Expense
Route::put('/wallet/update_expense', [WalletController::class, 'updateMonthlyExpense'])->name('update.monthly_expense');
// End Wallet

// Start Expense Calendar
Route::get('/calendar', [ExpenseCalendarController::class, 'index'])->name('calendar');
// End Expense Calendar

// Start Planning
Route::get('/planning', [PlanningController::class, 'index'])->name('planning');

Route::post('/planning/store', [PlanningController::class, 'store'])->name('store.planning');
// End Planning