<?php

use App\Livewire\CityIndex;
use App\Livewire\CountryIndex;
use App\Livewire\DepartmentIndex;
use App\Livewire\EmployeeIndex;
use App\Livewire\Home;
use App\Livewire\StateIndex;
use App\Livewire\UserIndex;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::get('/', Home::class)->name('home');
    Route::get('/users', UserIndex::class)->name('users');
    Route::get('/employees', EmployeeIndex::class)->name('employees');
    Route::get('/cities', CityIndex::class)->name('cities');
    Route::get('/countries', CountryIndex::class)->name('countries');
    Route::get('/states', StateIndex::class)->name('states');
    Route::get('/departments', DepartmentIndex::class)->name('departments');
    
});


require __DIR__.'/auth.php';