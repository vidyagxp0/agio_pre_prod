
use App\Http\Controllers\rcms\OOSController;

/**
             * OOS chemical
             */
            Route::group(['prefix' => 'oos', 'as' => 'oos.'], function() {
            Route::get('/',[OOSController::class, 'index'])->name('index');
            Route::post('/oosstore', [OOSController::class, 'store'])->name('oosstore');
            Route::get('oos_view/{id}', [OOSController::class, 'show'])->name('oos_view');
            Route::post('oosupdate/{id}', [OOSController::class, 'update'])->name('oosupdate');

            Route::post('sendstage/{id}',[OOSController::class,'send_stage'])->name('send_stage');
            Route::post('requestmoreinfo_back_stage/{id}',[OOSController::class,'requestmoreinfo_back_stage'])->name('requestmoreinfo_back_stage');
            Route::post('assignable_send_stage/{id}',[OOSController::class,'assignable_send_stage'])->name('assignable_send_stage');
            Route::post('cancel_stage/{id}', [OOSController::class, 'cancel_stage'])->name('cancel_stage');;
            Route::post('thirdStage/{id}', [OOSController::class, 'stageChange'])->name('thirdStage');
            Route::post('reject_stage/{id}', [OOSController::class, 'reject_stage'])->name('reject_stage');
            Route::post('capa_child/{id}', [CapaController::class, 'child_change_control'])->name('capa_child_changecontrol');
            
            Route::get('AuditTrial/{id}', [OOSController::class, 'AuditTrial'])->name('audit_trial');
            Route::get('auditDetails/{id}', [OOSController::class, 'auditDetails'])->name('audit_details');
            Route::get('audit_report/{id}', [OOSController::class, 'auditReport'])->name('audit_report');
            Route::get('single_report/{id}', [OOSController::class, 'singleReport'])->name('single_report');

            });
