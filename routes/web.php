<?php

use App\Http\Controllers\FriendController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [FriendController::class, 'noFriendshipUsers'])->name('home');
    Route::get('/friends', [FriendController::class, 'showAmigos'])->name('friends');
    Route::post('/send-request/{user}', [FriendController::class, 'sendFriendshipRequest'])->name('send-request');
    Route::post('/accept-request/{user}', [FriendController::class, 'acceptFriendshipRequest'])->name('accept-request');
    Route::post('/decline-request/{user}', [FriendController::class, 'declineFriendshipRequest'])->name('decline-request');
    Route::get('/messages/{user}', [MessageController::class, 'index'])->name('messages');
    Route::get('/getMessages/{user}', [MessageController::class, 'getMessagesByUser'])->name('getMessages');
    Route::post('/messages/{user}', [MessageController::class, 'store'])->name('messages.store');
});

Auth::routes();

