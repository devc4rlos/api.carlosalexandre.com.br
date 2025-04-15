<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('v1.contacts'));
