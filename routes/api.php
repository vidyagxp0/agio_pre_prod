<?php

use App\Http\Controllers\Api\HelperController;
use App\Http\Controllers\Api\LogFilterController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\UserLoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;


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

Route::post('userLogin', [UserLoginController::class, 'loginapi']);
Route::get('/analyticsData', [DashboardController::class, 'analyticsData']);

Route::get('dashboardStatus', [ApiController::class, 'dashboardStatus']);
Route::get('getProfile', [ApiController::class, 'getProfile']);
Route::get('capaStatus', [ApiController::class, 'capaStatus']);

Route::post('/filter-records', [DocumentController::class, 'filterRecord'])->name('record.filter');

Route::post('upload-files', [HelperController::class, 'upload_file'])->name('api.upload.file');

/**
 * Log Api Routes
 */

Route::post('/filter-deviation', [LogFilterController::class, 'deviation_filter'])->name('api.deviation.filter');
Route::post('/change-control', [LogFilterController::class, 'changecontrol_filter'])->name('api.cccontrol.filter');
Route::post('/errata',[LogFilterController::class,'errata_filter'])->name('api.errata.filter');
Route::post('/failure-investigation',[LogFilterController::class,'failureInv_filter'])->name('api.failureInv.filter');
Route::post('/inernal-audit',[LogFilterController::class,'internal_audit_filter'])->name('api.internalaudit.filter');
Route::post('/lab-incident',[LogFilterController::class,'labincident_filter'])->name('api.laboratoryincident.filter');
Route::post('/marketcomplaint_data',[LogFilterController::class,'marketcomplaint_filter'])->name('api.marketcomplaint.filter');
Route::post('/ooc',[LogFilterController::class,'ooc_filter'])->name('api.ooc.filter');
Route::post('/capa',[LogFilterController::class,'capa_filter'])->name('api.capa.filter');







