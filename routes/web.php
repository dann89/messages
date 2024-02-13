<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuysController;
use App\Http\Controllers\MessageController; // Assume this handles sending/viewing messages


Route::get('/send-message', [GuysController::class, 'showSendMessageForm'])->name('send-message-form');
Route::post('/send-messages', [GuysController::class, 'sendMessage'])->name('send-messages');

Route::get('/guys/create', [GuysController::class, 'create'])->name('guys.create');
Route::post('/guys', [GuysController::class, 'store'])->name('guys.store');

Route::get('/guys/{id}/edit', [GuysController::class, 'edit'])->name('guys.edit');
Route::put('/guys/{id}', [GuysController::class, 'update'])->name('guys.update');

Route::get('/guys', [GuysController::class, 'index'])->name('guys.index');


Route::get('/messages', [MessageController::class, 'showMessages'])->name('messages.index');

