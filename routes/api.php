<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tool API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. They are protected
| by your tool's "Authorize" middleware by default. Now, go build!
|
*/

 Route::get('language-translation', function (Request $request) {
     return response()->json(['status' => 'success']);
 });
Route::get('/translations/get-translation', \Tradein\LanguageTranslation\Http\TranslationController::class . '@index');
Route::post('/translations/save-translation', \Tradein\LanguageTranslation\Http\TranslationController::class . '@save');
