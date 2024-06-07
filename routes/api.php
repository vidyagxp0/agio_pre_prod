<?php

use App\Http\Controllers\Api\ChartController;
use App\Http\Controllers\Api\HelperController;
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
 * CHARTS ROUTES
 */

 Route::get('/charts/process-charts', [ChartController::class, 'process_charts'])->name('api.process.chart');
 Route::get('/charts/documents-by-status', [ChartController::class, 'document_status_charts'])->name('api.document_by_status.chart');
 Route::get('/charts/deviation-by-classification', [ChartController::class, 'deviation_classification_charts'])->name('api.deviation.chart');
 Route::get('/charts/deviation-by-departments', [ChartController::class, 'deviation_departments_charts'])->name('api.deviation_departments.chart');
 Route::get('/charts/documents-by-originator', [ChartController::class, 'documents_originator_charts'])->name('api.document.originator.chart');
 Route::get('/charts/documents-by-type', [ChartController::class, 'documents_type_charts'])->name('api.document.type.chart');
 Route::get('/charts/documents-in-review/{months}', [ChartController::class, 'documents_review_charts'])->name('api.document.review.chart');
 Route::get('/charts/documents-in-stage/{stage}', [ChartController::class, 'documents_stage_charts'])->name('api.document.stage.chart'); 
 Route::get('/charts/documents-by-severity', [ChartController::class, 'deviationSeverityLevel'])->name('api.document_by_severity.chart');
 Route::get('/charts/documents-by-priority', [ChartController::class, 'documentByPriority'])->name('api.document_by_priority.chart');
 Route::get('/charts/documents-by-priority-rca', [ChartController::class, 'documentByPriorityRca'])->name('api.document_by_priority_rca.chart');
 
 Route::get('/charts/documents-by-delayed', [ChartController::class, 'documentDelayed'])->name('api.document_by_delayed.chart');
 Route::get('/charts/documents-by-site', [ChartController::class, 'siteWiseDocument'])->name('api.document_by_site.chart');


