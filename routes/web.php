<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\TransactionController;

Route::get('/', [UserController::class, 'index'])->name('index');// نمایش فرم ورود ایمیل
Route::post('/email', [UserController::class, 'emailVerify'])->name('email.submit'); // ارسال فرم ایمیل
Route::get('/dashboard/{id}', [UserController::class, 'dashboard'])->name('dashboard'); // داشبورد کاربر

Route::get('/logout', [UserController::class, 'logout'])->name('logout'); //خروج کاربر

// روت‌های مربوط به کیف پول
Route::prefix('wallet')->group(function () {
    Route::get('/create', [WalletController::class, 'create'])->name('wallet.create'); // صفحه ایجاد کیف پول
    Route::post('/', [WalletController::class, 'store'])->name('wallet.store'); // ایجاد کیف پول جدید
});

// روت‌های مربوط به تراکنش‌ها
Route::prefix('transactions')->group(function () {
    Route::get('/', [TransactionController::class, 'index'])->name('transactions.index'); // نمایش لیست تراکنش‌های کاربر
    Route::get('/create', [TransactionController::class, 'create'])->name('transaction.create'); // صفحه ارسال وجه
    Route::post('/', [TransactionController::class, 'store'])->name('transaction.store'); // ذخیره تراکنش جدید
});

Route::middleware([AdminMiddleware::class])->get('/admin', [AdminController::class, 'index'])->name('admin.index'); // داشبورد ادمین

// روت های مربوط به پنل ادمین
Route::prefix('admin')->middleware([AdminMiddleware::class])->group(function () {
    Route::get('/wallets', [AdminController::class, 'walletIndex'])->name('admin.wallets.index'); // نمایش کیف پول ها
    Route::get('/users', [AdminController::class, 'userIndex'])->name('admin.users.index'); // نمایش کاربران
    Route::post('/users/{user}/update-role', [AdminController::class, 'userUpdateRole'])->name('admin.users.updateRole');//تغییر نفش کاربر
    Route::delete('/users/{user}', [AdminController::class, 'userDestroy'])->name('admin.users.destroy'); // حذف کاربر
    Route::get('/transactions', [AdminController::class, 'transactionIndex'])->name('admin.transactions.index'); // نمایش تراکنش ها
    Route::get('/pending-transactions', [AdminController::class, 'pendingTransactionIndex'])->name('pending.transactions.index'); // نمایش تراکنش های در انتظار تایید
    Route::post('/transactions/{transaction}/approve', [AdminController::class, 'transactionApprove'])->name('pending.transactions.approve'); // تایید تراکنش در انتظار
    Route::post('/transactions/{transaction}/reject', [AdminController::class, 'transactionReject'])->name('pending.transactions.reject'); // رد تراکنش در انتظار
});

