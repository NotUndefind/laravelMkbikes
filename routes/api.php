<?php

use App\Http\Controllers\BikesUsedController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\ContactMailController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\TransformController;
use Illuminate\Support\Facades\Route;

// Routes api methods
Route::get('repair', [RepairController::class, 'getRepairApi'])->name('api.repair');
Route::get('rental', [RentalController::class, 'getRentalApi'])->name('api.rental');
Route::get('transform', [TransformController::class, 'getTransformApi'])->name('api.transform');
Route::get('brands', [BrandsController::class, 'getBrandsApi'])->name('api.brands');
Route::get('news', [NewsController::class, 'getNewsApi'])->name('api.news');
Route::get('bikesUsed', [BikesUsedController::class, 'getBikesUsedApi'])->name('api.bikesUsed');

Route::post('mail/send', [ContactMailController::class, 'sendEmail'])->name('mail.send');

Route::post('newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('subscribe');
