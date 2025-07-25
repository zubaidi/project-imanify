<?php

use App\Http\Controllers\AllItemController;
use App\Http\Controllers\AllTool;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DescriptionItemController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return 'Maw cari apa luwh';
// });

Route::redirect('/', '/dashboard');

Route::get('/login', [LoginController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');
Route::get('/register', [LoginController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [LoginController::class, 'register'])->middleware('guest');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::prefix('dashboard')->middleware('auth')->group(function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::prefix('all-items')->group(function() {
        Route::get('/', [AllItemController::class, 'index'])->name('all-items');
        Route::get('/create', [AllItemController::class, 'showCreateItem'])->name('all-items.create');
        Route::post('/create', [AllItemController::class, 'createItem']);
        Route::get('/edit/{id}', [AllItemController::class, 'showEditItem'])->name('all-items.edit');
        Route::post('/edit/{id}', [AllItemController::class, 'editItem']);
        Route::delete('/delete/{id}', [AllItemController::class, 'deleteItem'])->name('all-items.delete');
        Route::get('/view-pdf', [AllItemController::class, 'handleViewPDF'])->name('all-items.view-pdf');
        Route::get('/download-pdf', [AllItemController::class, 'handleDownloadPDF'])->name('all-items.download-pdf');
        Route::get('/get-api', [AllItemController::class, 'handleAPI']);
    });
    Route::prefix('description-items')->group(function() {
        Route::get('/', [DescriptionItemController::class, 'index'])->name('description-items');
        Route::get('/create', [DescriptionItemController::class, 'showCreateDescriptionItem'])->name('description-items.create');
        Route::post('/create', [DescriptionItemController::class, 'createDescriptionItem']);
        Route::get('/edit/{id}', [DescriptionItemController::class, 'showEditDescriptionItem'])->name('description-items.edit');
        Route::put('/edit/{id}', [DescriptionItemController::class, 'editDescriptionItem']);
        Route::delete('/delete/{id}', [DescriptionItemController::class, 'deleteDescriptionItem'])->name('description-items.delete');
        Route::get('/view-pdf', [DescriptionItemController::class, 'handleViewPDF'])->name('description-items.view-pdf');
        Route::get('/download-pdf', [DescriptionItemController::class, 'handleDownloadPDF'])->name('description-items.donwload-pdf');
    });
    Route::prefix('all-tools')->group(function() {
        Route::get('/place', [AllTool::class, 'place'])->name('all-tools.place');
    });
    Route::prefix('borrowing')->group(function(){
        Route::get('/', [BorrowingController::class, 'index'])->name('borrowing');
        Route::get('/create',[BorrowingController::class, 'showCreateBorrowing']);
        Route::post('/create', [BorrowingController::class, 'createBorrowing'])->name('borrowing.create');
        Route::get('/edit/{id}', [BorrowingController::class, 'showEditBorrowing'])->name('borrowing.edit');
        Route::put('/edit/{id}', [BorrowingController::class, 'editBorrowing']);
        Route::delete('/delete/{id}', [BorrowingController::class, 'deleteBorrowing'])->name('borrowing.delete');
        Route::get('/view-pdf', [BorrowingController::class, 'handleViewPDF'])->name('borrowing.view-pdf');
        Route::get('/download-pdf', [BorrowingController::class, 'handleDownloadPDF'])->name('borrowing.donwload-pdf');
    });
});
