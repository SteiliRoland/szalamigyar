<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post("/register",[AuthController::class,"signup"]);
Route::post("/login",[AuthController::class,"signin"]);
Route::get("/",[ProductsController::class,"index"]);
Route::get("/products/show/{id}",[SzalamiController::class,"show"]);
Route::post("/logout",[AuthController::class,"logout"]);
Route::get( "/products/search/{termeknev}", [SzalamiController::class, "search" ]);
Route::get( "/products/materials/{szalamik}", [ SzalamiController::class, "materialsearch" ]);

Route::group( ["middleware" => ["auth:sanctum"]], function(){
    Route::post("/products",[SzalamiController::class,"store"]);
    Route::put("/products/{szalamik}",[SzalamiController::class,"update"]);
    Route::delete("/products/{id}",[SzalamiController::class,"destroy"]);
});
