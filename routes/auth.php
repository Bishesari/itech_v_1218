<?php
use Illuminate\Support\Facades\Route;

Route::livewire('/role-select', 'pages::auth.role-select')->name('role-select')->middleware('auth');
