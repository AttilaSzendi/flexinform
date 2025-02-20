<?php

use Illuminate\Support\Facades\Route;

Route::get('/cars', function () {
    return response()->json([
        ['id' => 1, 'name' => 'Tesla Model S'],
        ['id' => 2, 'name' => 'Ford Mustang'],
        ['id' => 3, 'name' => 'BMW M3'],
    ]);
});
