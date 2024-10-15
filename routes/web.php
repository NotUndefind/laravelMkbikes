<?php

use App\Mail\ContactSupport;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\Dashboard::class, 'index'])->name('dashboard.index')->middleware('auth');

// Auth
Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'doLogin']);

// Dashboard views
Route::get('/dashboard', [\App\Http\Controllers\Dashboard::class, 'index'])->name('dashboard.index')->middleware('auth');

// Controllers index methods
Route::get('/dashboard/brand', [\App\Http\Controllers\BrandsController::class, 'index'])->name('brand.index')->middleware('auth');
Route::get('/dashboard/repair', [\App\Http\Controllers\RepairController::class, 'index'])->name('repair.index')->middleware('auth');
Route::get('/dashboard/transform', [\App\Http\Controllers\TransformController::class, 'index'])->name('transform.index')->middleware('auth');
Route::get('/dashboard/rental', [\App\Http\Controllers\RentalController::class, 'index'])->name('rental.index')->middleware('auth');
Route::get('/dashboard/bikesUsed', [\App\Http\Controllers\BikesUsedController::class, 'index'])->name('bikesUsed.index')->middleware('auth');
Route::get('/dashboard/news', [\App\Http\Controllers\NewsController::class, 'index'])->name('news.index')->middleware('auth');

// Controllers add methods
Route::post('/brand/add', [\App\Http\Controllers\BrandsController::class, 'addBrand'])->name('brand.addBrand')->middleware('auth');
Route::post('/repair/add', [\App\Http\Controllers\RepairController::class, 'addRepair'])->name('repair.addRepair')->middleware('auth');
Route::post('/transform/add', [\App\Http\Controllers\TransformController::class, 'addTransform'])->name('transform.addTransform')->middleware('auth');
Route::post('/rental/add', [\App\Http\Controllers\RentalController::class, 'addRental'])->name('rental.addRental')->middleware('auth');
Route::post('/bikesUsed/add', [\App\Http\Controllers\BikesUsedController::class, 'addBikeUsed'])->name('bikesUsed.addBikeUsed')->middleware('auth');
Route::post('/news/add', [\App\Http\Controllers\NewsController::class, 'addNews'])->name('news.addNews')->middleware('auth');

// Controllers edit methods
Route::put('/brand/update', [\App\Http\Controllers\BrandsController::class, 'updateBrand'])->name('brand.updateBrand')->middleware('auth');
Route::put('/repair/update', [\App\Http\Controllers\RepairController::class, 'updateRepair'])->name('repair.updateRepair')->middleware('auth');
Route::put('/transform/update', [\App\Http\Controllers\TransformController::class, 'updateTransform'])->name('transform.updateTransform')->middleware('auth');
Route::put('rental/update', [\App\Http\Controllers\RentalController::class, 'updateRental'])->name('rental.updateRental')->middleware('auth');
Route::put('/bikesUsed/update', [\App\Http\Controllers\BikesUsedController::class, 'updateBikeUsed'])->name('bikesUsed.updateBikeUsed')->middleware('auth');
Route::put('/news/update', [\App\Http\Controllers\NewsController::class, 'updateNews'])->name('news.updateNews')->middleware('auth');

// Controllers delete methods
Route::delete('/brand/{id}', [\App\Http\Controllers\BrandsController::class, 'deleteBrand'])->name('brand.deleteBrand')->middleware('auth');
Route::delete('/repair/{id}', [\App\Http\Controllers\RepairController::class, 'deleteRepair'])->name('repair.deleteRepair')->middleware('auth');
Route::delete('/transform/{id}', [\App\Http\Controllers\TransformController::class, 'deleteTransform'])->name('transform.deleteTransform')->middleware('auth');
Route::delete('/rental/{id}', [\App\Http\Controllers\RentalController::class, 'deleteRental'])->name('rental.deleteRental')->middleware('auth');
Route::delete('/bikesUsed/{id}', [\App\Http\Controllers\BikesUsedController::class, 'deleteBikeUsed'])->name('bikesUsed.deleteBikeUsed')->middleware('auth');
Route::delete('/news/{id}', [\App\Http\Controllers\NewsController::class, 'deleteNews'])->name('news.deleteNews')->middleware('auth');

//Newsletter
Route::get('/newsletter', [\App\Http\Controllers\NewsletterController::class, 'index'])->name('newsletter.index')->middleware('auth');
Route::post('/newsletter/send', [\App\Http\Controllers\NewsletterController::class, 'sendNewsletter'])->name('newsletter.send')->middleware('auth');
Route::post('/newsletter/subscribe', [\App\Http\Controllers\NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/newsletter/unsubscribe/{email}', [\App\Http\Controllers\NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');
