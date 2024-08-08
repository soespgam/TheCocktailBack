<?php

use App\Http\Controllers\CocktailController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//user
Route::post('loginauth', [UserController::class, 'login'])->name('loginauth');
Route::get('logout', [UserController::class, 'logout'])->name('logout');
Route::post('register',[UserController::class, 'register'])->name('register');

Route::group(['middleware' => ["auth:sanctum"]], function () {
    //cocktails
    //api
    Route::get('getCocktailsApiByLetter/{letter}', [CocktailController::class, 'getCocktailsApiByLetter']); 
    Route::get('getCocktailsApiById/{id}', [CocktailController::class, 'getCocktailsApiById']); 

    //BD
    Route::get('cocktails_saved', [CocktailController::class, 'getCocktails']);
    Route::post('create-cocktail', [CocktailController::class, 'create']);
    Route::put('update-cocktail/{id}', [CocktailController::class, 'update']);
    Route::delete('delete-cocktail/{id}', [CocktailController::class, 'destroy']);  
});




