<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\SimpleAuth;
use Illuminate\Support\Facades\Route;

Route::get('/profile', [UserController::class, 'showProfile'])->name('showProfile');
Route::patch('/profile-update', [UserController::class, 'updateUser'])->name('updateUser');

Route::middleware(SimpleAuth::class . ':user')->group(function() {
    Route::get('/', function(){
        return redirect('/home');
    });
    Route::get('/home', [ItemController::class, 'userPage'])->name('userPage');

    Route::get('/check-cart', [InvoiceController::class, 'checkCart'])->name('checkCart');
    Route::get('/shopping-cart/{id}', [InvoiceController::class, 'showInvoice'])->name('showInvoice');
    Route::post('/add-item', [InvoiceController::class, 'createInvoiceItem'])->name('createInvoiceItem');
    Route::patch('/update-cart-item/{id}', [InvoiceController::class, 'updateInvoiceItem'])->name('updateInvoiceItem');
    Route::delete('/delete-cart-item/{id}', [InvoiceController::class, 'deleteInvoiceItem'])->name('deleteInvoiceItem');
    Route::patch('/submit-order/{id}', [InvoiceController::class, 'submitInvoice'])->name('submitInvoice');

    Route::get('/history', [InvoiceController::class, 'showHistory'])->name('showHistory');
    Route::get('/invoice/{id}', [InvoiceController::class, 'showPrintInvoice'])->name('showPrintInvoice');
});

Route::middleware(SimpleAuth::class . ':admin')->group(function() {
    Route::get('/', function(){
        return redirect('/inventory');
    });
    Route::get('/inventory', [ItemController::class, 'adminPage'])->name('adminPage');

    Route::get('/create-item', [ItemController::class, 'showCreate']);
    Route::post('/create', [ItemController::class, 'createItem']);

    Route::get('/update-item/{id}', [ItemController::class, 'showUpdate'])->name('showUpdate');
    Route::patch('/update/{id}', [ItemController::class, 'updateItem'])->name('updateItem');

    Route::delete('/delete/{id}', [ItemController::class, 'deleteItem'])->name('deleteItem');

    Route::get('/categories', [CategoryController::class, 'showCategory']);
    Route::post('/create-category', [CategoryController::class, 'createCategory']);
    Route::post('/delete-category/{id}', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');
});

require __DIR__.'/auth.php';