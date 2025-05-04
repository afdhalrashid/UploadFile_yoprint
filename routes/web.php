<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\FileUploader;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/upload', FileUploader::class);
