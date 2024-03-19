<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PoliceController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\SuspectController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\ComplainantController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public routes
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [PoliceController::class, 'register']);

// Suspect routes
Route::get('/suspects', [SuspectController::class, 'index']);
Route::post('/suspects', [SuspectController::class, 'store']);
Route::get('/suspects/{id}', [SuspectController::class, 'show']);
Route::put('/suspects/{id}', [SuspectController::class, 'update']);
Route::delete('/suspects/{id}', [SuspectController::class, 'destroy']);

// Complaint routes
Route::get('/complaints', [ComplaintController::class, 'index']);
Route::post('/complaints', [ComplaintController::class, 'store']);
Route::get('/complaints/{id}', [ComplaintController::class, 'show']);
Route::put('/complaints/{id}', [ComplaintController::class, 'update']);
Route::delete('/complaints/{id}', [ComplaintController::class, 'destroy']);

// Complainant routes
Route::get('/complainants', [ComplainantController::class, 'index']);
Route::post('/complainants', [ComplainantController::class, 'store']);
Route::get('/complainants/{id}', [ComplainantController::class, 'show']);
Route::put('/complainants/{id}', [ComplainantController::class, 'update']);
Route::delete('/complainants/{id}', [ComplainantController::class, 'destroy']);


Route::get('/dashboard/cases-by-status', [DashboardController::class, 'casesByStatus']);
Route::get('/dashboard/cases-over-time', [DashboardController::class, 'casesOverTime'])->name('dashboard.casesOverTime');

