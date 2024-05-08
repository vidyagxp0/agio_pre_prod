
<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\DepartmentController;
use App\Http\Controllers\admin\DocumentlanguageController;
use App\Http\Controllers\admin\DistributionListController;
use App\Http\Controllers\admin\GroupPermissionController;
use App\Http\Controllers\admin\PrintControlController;
use App\Http\Controllers\admin\DownloadControlController;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\admin\UserManagementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DivisionController;
use App\Http\Controllers\admin\DocSubtypeController;
use App\Http\Controllers\admin\DocumentTypeController;
use App\Http\Controllers\admin\RoleGroupController;
use App\Http\Controllers\admin\ProcessController;
use App\Http\Controllers\admin\RiskLevelController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\MaterialController;
use App\Http\Controllers\admin\QMSDivisionController;
use App\Http\Controllers\admin\QMSProcessController;

//!---------- start Admin panel ----------------------------//


Route::group(['prefix' => 'admin'], function () {

    Route::view('login', 'admin.auth.login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('logout', [LoginController::class, 'logout']);



    Route::middleware(['admin'])->group(
        function () {

            Route::get('dashboard', [DashboardController::class, 'dashboard']);

            Route::resource('department', DepartmentController::class);
            Route::resource('document_subtypes', DocSubtypeController::class);

            Route::resource('document_types', DocumentTypeController::class);
            Route::resource('documentlanguage', DocumentlanguageController::class);
            Route::resource('distributionlist', DistributionListController::class);
            Route::resource('GroupPermission', GroupPermissionController::class);
            Route::resource('division', DivisionController::class);
            Route::resource('process', ProcessController::class);
            Route::resource('risk-level', RiskLevelController::class);
            Route::resource('user_management', UserManagementController::class);
            Route::resource('role_groups', RoleGroupController::class);
            Route::resource('printcontrol', PrintControlController::class);
            Route::resource('downloadcontrol', DownloadControlController::class);
               Route::resource('product', ProductController::class);
            Route::resource('material', MaterialController::class);
            Route::resource('qms-division', QMSDivisionController::class);
            Route::resource('qms-process', QMSProcessController::class);
        }
    );
});



//!---------- Admin panel ----------------------------//
