<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;

Route::get('/', [KaryawanController::class, 'index']);
Route::resource('karyawan', KaryawanController::class);
