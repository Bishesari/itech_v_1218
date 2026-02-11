<?php
use Illuminate\Support\Facades\Route;

Route::livewire('/login', 'pages::auth.login')->name('login')->middleware('guest');
Route::livewire('/role-select', 'pages::auth.role-select')->name('role-select')->middleware('auth');
