<?php
use Illuminate\Support\Facades\Route;

Route::livewire('/select-context', 'pages::auth.context-select')->middleware('auth')->name('context.select');
