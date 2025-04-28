<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
  });

Route::get('/test', function () {
  return view('vue');
});

Route::prefix('api/v1/')->group(function () {
  Route::get('/test', function () {
    return response()->json(['message' => 'Hello, World from api!']);
  });
  Route::delete('/test', function () {
    return response()->json(['message' => 'Deleting']);
  });
});
