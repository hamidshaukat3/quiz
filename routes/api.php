<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\RolesController;
use App\Http\Controllers\API\PermissionController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\CurrencyController;
use App\Http\Controllers\API\OfflinePaymentController;
use App\Http\Controllers\API\TimeZoneController;
use App\Http\Controllers\API\LanguageController;
use App\Http\Controllers\API\WeekController;
use App\Http\Controllers\API\QuizController;
use Illuminate\Support\Facades\Broadcast;
use Spatie\Permission\Contracts\Role;

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

Route::controller(QuizController::class)->group(function () {
    Route::post('/quiz', 'store');
    Route::get('/quiz/{id}', 'loadQuiz');
});

