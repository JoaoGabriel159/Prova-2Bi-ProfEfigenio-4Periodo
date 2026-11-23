<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'sistema' => 'API Clínica Médica',
        'status' => 'online',
        'documentacao' => 'Consulte o README.md para os endpoints.'
    ]);
});
