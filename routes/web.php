<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Customer routes
    Route::resource('customers', CustomerController::class);
    Route::patch('customers/{customer}/status', [CustomerController::class, 'updateStatus'])->name('customers.status');

    // Proposal routes
    Route::resource('proposals', ProposalController::class);
    Route::patch('proposals/{proposal}/status', [ProposalController::class, 'updateStatus'])->name('proposals.status');

    // Invoice routes
    Route::resource('invoices', InvoiceController::class);
    Route::patch('invoices/{invoice}/status', [InvoiceController::class, 'updateStatus'])->name('invoices.status');
    Route::post('invoices/{invoice}/send', [InvoiceController::class, 'sendInvoice'])->name('invoices.send');

    // Transaction routes
    Route::get('transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');
});

// Payment routes (accessible without auth for customers)
Route::get('payment/{invoice}', [PaymentController::class, 'checkout'])->name('payment.checkout');
Route::post('payment/{invoice}/process', [PaymentController::class, 'processPayment'])->name('payment.process');
Route::get('payment/{invoice}/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('payment/{invoice}/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
Route::post('stripe/webhook', [PaymentController::class, 'webhook'])->name('stripe.webhook');

require __DIR__.'/auth.php';