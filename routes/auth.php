<?php

use App\Livewire\Auth\Login;
use Illuminate\Support\Facades\Route;

Route::get('/login',Login::class)->name('login')->middleware('guest');



?>