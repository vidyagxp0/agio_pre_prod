<?php

use App\Http\Controllers\rcms\ActionItemController;
use App\Http\Controllers\rcms\AuditeeController;
use App\Http\Controllers\rcms\CCController;
use App\Http\Controllers\rcms\DashboardController;
use App\Http\Controllers\rcms\EffectivenessCheckController;
use App\Http\Controllers\rcms\ExtensionController;
use App\Http\Controllers\rcms\InternalauditController;
use App\Http\Controllers\rcms\LabIncidentController;
use App\Http\Controllers\rcms\ObservationController;
use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\rcms\AuditProgramController;
use App\Http\Controllers\rcms\CapaController;
use App\Http\Controllers\rcms\FormDivisionController;
use App\Http\Controllers\rcms\ManagementReviewController;
use App\Http\Controllers\rcms\OOTController;
use App\Http\Controllers\rcms\OOSController;
use App\Http\Controllers\rcms\MarketComplaintController;
use App\Http\Controllers\rcms\RootCauseController;
use App\Http\Controllers\RiskManagementController;
use App\Models\EffectivenessCheck;
use Illuminate\Support\Facades\Route;

// ============================================
//                   RCMS
//============================================

Route::group(['prefix' => 'rcms'], function () {
    Route::view('rcms', 'frontend.rcms.main-screen');
    Route::get('rcms_login', [UserLoginController::class, 'userlogin']);
    Route::view('rcms_dashboard', 'frontend.rcms.dashboard');
    Route::view('form-division', 'frontend.forms.form-division');
    Route::get('/logout', [UserLoginController::class, 'rcmslogout'])->name('rcms.logout');

    Route::middleware(['rcms'])->group(
        function () {
            Route::resource('CC', CCController::class);
            Route::resource('actionItem', ActionItemController::class);
            Route::post('action-stage-cancel/{id}', [ActionItemController::class, 'actionStageCancel']);
            Route::get('action-item-audittrialshow/{id}', [ActionItemController::class, 'actionItemAuditTrialShow'])->name('showActionItemAuditTrial');
            Route::get('action-item-audittrialdetails/{id}', [ActionItemController::class, 'actionItemAuditTrialDetails'])->name('showaudittrialactionItem');
            Route::get('actionitemSingleReport/{id}', [ActionItemController::class, 'singleReport'])->name('actionitemSingleReport');
            Route::get('actionitemAuditReport/{id}', [ActionItemController::class, 'auditReport'])->name('actionitemAuditReport');
            Route::get('effective-audit-trial-show/{id}', [EffectivenessCheckController::class, 'effectiveAuditTrialShow'])->name('show_effective_AuditTrial');
            Route::get('effective-audit-trial-details/{id}', [EffectivenessCheckController::class, 'effectiveAuditTrialDetails'])->name('show_audittrial_effective');
            Route::get('effectiveSingleReport/{id}', [EffectivenessCheckController::class, 'singleReport'])->name('effectiveSingleReport');
            Route::get('effectiveAuditReport/{id}', [EffectivenessCheckController::class, 'auditReport'])->name('effectiveAuditReport');

            // ------------------extension _child---------------------------
            Route::post('extension_child/{id}', [ExtensionController::class, 'extension_child'])->name('extension_child');
            Route::resource('extension', ExtensionController::class);
            Route::post('send-extension/{id}', [ExtensionController::class, 'stageChange']);
            Route::post('send-reject-extention/{id}', [ExtensionController::class, 'stagereject']);
            Route::post('send-cancel-extention/{id}', [ExtensionController::class, 'stagecancel']);
            Route::get('extension-audit-trial/{id}', [ExtensionController::class, 'extensionAuditTrial']);
            Route::get('extension-audit-trial-details/{id}', [ExtensionController::class, 'extensionAuditTrialDetails']);
            Route::get('extensionSingleReport/{id}', [ExtensionController::class, 'singleReport'])->name('extensionSingleReport');
            Route::get('extensionAuditReport/{id}', [ExtensionController::class, 'auditReport'])->name('extensionAuditReport');


            Route::post('send-At/{id}', [ActionItemController::class, 'stageChange']);
            Route::post('send-rejection-field/{id}', [CCController::class, 'stagereject']);
            Route::post('send-cft-field/{id}', [CCController::class, 'stageCFTnotReq']);

            Route::post('send-cancel/{id}', [CCController::class, 'stagecancel']);
            Route::post('send-cc/{id}', [CCController::class, 'stageChange']);
            Route::post('child/{id}', [CCController::class, 'child']);
            Route::get('qms-dashboard', [DashboardController::class, 'index']);
            Route::get('qms-dashboard/{id}/{process}', [DashboardController::class, 'dashboard_child']);
            Route::get('qms-dashboard_new/{id}/{process}', [DashboardController::class, 'dashboard_child_new']);
            Route::get('audit-trial/{id}', [CCController::class, 'auditTrial']);
            Route::get('audit-detail/{id}', [CCController::class, 'auditDetails']);
            Route::get('summary/{id}', [CCController::class, 'summery_pdf']);
            Route::get('audit/{id}', [CCController::class, 'audit_pdf']);

            Route::get('ccView/{id}/{type}', [DashboardController::class, 'ccView'])->name('ccView');
            Route::view('summary_pdf', 'frontend.change-control.summary_pdf');
            Route::view('audit_trial_pdf', 'frontend.change-control.audit_trial_pdf');
            Route::view('change_control_single_pdf', 'frontend.change-control.change_control_single_pdf');
            Route::get('change_control_family_pdf', [CCController::class, 'parent_child']);

            Route::get('change_control_single_pdf/{id}', [CCController::class, 'single_pdf']);
            Route::get('eCheck/{id}', [CCController::class, 'eCheck']);
            Route::resource('effectiveness', EffectivenessCheckController::class);
            Route::post('send-effectiveness/{id}', [EffectivenessCheckController::class, 'stageChange']);
            Route::post('effectiveness-reject/{id}', [EffectivenessCheckController::class, 'reject']);
            Route::post('cancel/{id}',[EffectivenessCheckController::class,'cancel'])->name('moreinfo_effectiveness');
            Route::view('helpdesk-personnel', 'frontend.rcms.helpdesk-personnel');
            Route::view('send-notification', 'frontend.rcms.send-notification');
            Route::get('new-change-control', [CCController::class, 'changecontrol']);

            //----------------------------------------------By Pankaj-----------------------

            Route::post('audit', [InternalauditController::class, 'create'])->name('createInternalAudit');
            Route::get('internalAuditShow/{id}', [InternalauditController::class, 'internalAuditShow'])->name('showInternalAudit');
            Route::post('update/{id}', [InternalauditController::class, 'update'])->name('updateInternalAudit');
            Route::post('InternalAuditStateChange/{id}', [InternalauditController::class, 'InternalAuditStateChange'])->name('AuditStateChange');
            Route::get('InternalAuditTrialShow/{id}', [InternalauditController::class, 'InternalAuditTrialShow'])->name('ShowInternalAuditTrial');
            Route::get('InternalAuditTrialDetails/{id}', [InternalauditController::class, 'InternalAuditTrialDetails'])->name('showaudittrialinternalaudit');

            //-------------------------

            Route::post('labcreate', [LabIncidentController::class, 'create'])->name('labIncidentCreate');
            Route::get('LabIncidentShow/{id}', [LabIncidentController::class, 'LabIncidentShow'])->name('ShowLabIncident');
            Route::post('LabIncidentStateChange/{id}', [LabIncidentController::class, 'LabIncidentStateChange'])->name('StageChangeLabIncident');
            Route::post('RejectStateChangeEsign/{id}', [LabIncidentController::class, 'RejectStateChange'])->name('RejectStateChange');
            Route::post('updateLabIncident/{id}', [LabIncidentController::class, 'updateLabIncident'])->name('LabIncidentUpdate');
            Route::post('LabIncidentCancel/{id}', [LabIncidentController::class, 'LabIncidentCancel'])->name('LabIncidentCancel');
            Route::post('LabIncidentChildCapa/{id}', [LabIncidentController::class, 'lab_incident_capa_child'])->name('lab_incident_capa_child');
            Route::post('LabIncidentChildRoot/{id}', [LabIncidentController::class, 'lab_incident_root_child'])->name('lab_incident_root_child');
            Route::get('LabIncidentAuditTrial/{id}', [LabIncidentController::class, 'LabIncidentAuditTrial'])->name('audittrialLabincident');
            Route::get('auditDetailsLabIncident/{id}', [LabIncidentController::class, 'auditDetailsLabIncident'])->name('LabIncidentauditDetails');
            Route::post('root_cause_analysis/{id}', [LabIncidentController::class, 'root_cause_analysis'])->name('Child_root_cause_analysis');
            Route::get('LabIncidentSingleReport/{id}', [LabIncidentController::class, 'singleReport'])->name('LabIncidentSingleReport');
            Route::get('LabIncidentAuditReport/{id}', [LabIncidentController::class, 'auditReport'])->name('LabIncidentAuditReport');
            //------------------------------------

            
            Route::post('create', [AuditProgramController::class, 'create'])->name('createAuditProgram');
            Route::get('AuditProgramShow/{id}', [AuditProgramController::class, 'AuditProgramShow'])->name('ShowAuditProgram');
            Route::post('AuditStateChange/{id}', [AuditProgramController::class, 'AuditStateChange'])->name('StateChangeAuditProgram');
            Route::post('AuditRejectStateChange/{id}', [AuditProgramController::class, 'AuditRejectStateChange'])->name('AuditProgramStateRecject');
            Route::post('UpdateAuditProgram/{id}', [AuditProgramController::class, 'UpdateAuditProgram'])->name('AuditProgramUpdate');
            Route::get('AuditProgramTrialShow/{id}', [AuditProgramController::class, 'AuditProgramTrialShow'])->name('showAuditProgramTrial');
            Route::get('auditProgramDetails/{id}', [AuditProgramController::class, 'auditProgramDetails'])->name('auditProgramAuditTrialDetails');
            Route::post('child_audit_program/{id}', [AuditProgramController::class, 'child_audit_program'])->name('auditProgramChild');
            Route::post('AuditProgramCancel/{id}', [AuditProgramController::class, 'AuditProgramCancel'])->name('AuditProgramCancel');
            Route::get('auditProgramSingleReport/{id}', [AuditProgramController::class, 'singleReport'])->name('auditProgramSingleReport');
            Route::get('auditProgramAuditReport/{id}', [AuditProgramController::class, 'auditReport'])->name('auditProgramAuditReport');




            Route::get('observationshow/{id}', [ObservationController::class, 'observationshow'])->name('showobservation');
            Route::post('observationstore', [ObservationController::class, 'observationstore'])->name('observationstore');
            Route::post('observationupdate/{id}', [ObservationController::class, 'observationupdate'])->name('observationupdate');
            Route::post('observation_send_stage/{id}', [ObservationController::class, 'observation_send_stage'])->name('observation_change_stage');
            Route::post('RejectStateChange/{id}', [ObservationController::class, 'RejectStateChange'])->name('RejectStateChangeObservation');
            Route::post('observation_child/{id}', [ObservationController::class, 'observation_child'])->name('observationchild');
            Route::post('boostStage/{id}', [ObservationController::class, 'boostStage'])->name('updatestageobservation');
            Route::get('ObservationAuditTrialShow/{id}', [ObservationController::class, 'ObservationAuditTrialShow'])->name('ShowObservationAuditTrial');
            Route::get('ObservationAuditTrialDetails/{id}', [ObservationController::class, 'ObservationAuditTrialDetails'])->name('showaudittrialobservation');


            //----------------------------------------------By PRIYA SHRIVASTAVA------------------
            Route::post('formDivision', [FormDivisionController::class, 'formDivision'])->name('formDivision');
            Route::get('ExternalAuditSingleReport/{id}', [AuditeeController::class, 'singleReport'])->name('ExternalAuditSingleReport');
            Route::get('ExternalAuditTrialReport/{id}', [AuditeeController::class, 'auditReport'])->name('ExternalAuditTrialReport');
            Route::get('capaSingleReport/{id}', [CapaController::class, 'singleReport'])->name('capaSingleReport');
            Route::get('capaAuditReport/{id}', [CapaController::class, 'auditReport'])->name('capaAuditReport');
            Route::get('riskSingleReport/{id}', [RiskManagementController::class, 'singleReport'])->name('riskSingleReport');
            Route::get('riskAuditReport/{id}', [RiskManagementController::class, 'auditReport'])->name('riskAuditReport');
            Route::get('rootSingleReport/{id}', [RootCauseController::class, 'singleReport'])->name('rootSingleReport');
            Route::get('rootAuditReport/{id}', [RootCauseController::class, 'auditReport'])->name('rootAuditReport');
            Route::get('managementReview/{id}', [ManagementReviewController::class, 'managementReport'])->name('managementReport');
            Route::get('managementReviewReport/{id}', [ManagementReviewController::class, 'managementReviewReport'])->name('managementReviewReport');
            Route::post('child_management_Review/{id}', [ManagementReviewController::class, 'child_management_Review'])->name('childmanagementReview');
            Route::get('internalSingleReport/{id}', [InternalauditController::class, 'singleReport'])->name('internalSingleReport');
            Route::get('internalauditReport/{id}', [InternalauditController::class, 'auditReport'])->name('internalauditReport');


            /**
             * OOT
             */
            Route::group(['prefix' => 'oot', 'as' => 'oot.'], function() {
                Route::get('/', [OOTController::class, 'index'])->name('index');
                Route::post('/ootstore', [OOTController::class, 'store'])->name('ootstore');
            });

            /**
             * OOS
             */
            Route::group(['prefix' => 'oos', 'as' => 'oos.'], function() {
            Route::get('/',[OOSController::class, 'index'])->name('index');
            Route::post('/oosstore', [OOSController::class, 'store'])->name('oosstore');
            Route::get('oos_view/{id}', [OOSController::class, 'show'])->name('oos_view');
            Route::post('oosupdate/{id}', [OOSController::class, 'update'])->name('oosupdate');

            });

            /**
             * market coplaint
             */
            Route::group(['prefix' => 'marketcomplaint', 'as' => 'marketcomplaint.'], function() {
                Route::get('/market_complaint_new',[MarketComplaintController::class, 'index'])->name('market_complaint_new');
                Route::post('/marketcomplaint/store', [MarketComplaintController::class, 'store'])->name('mcstore');
                Route::get('/marketcomplaint_view/{id}', [MarketComplaintController::class, 'show'])->name('marketcomplaint_view');
                Route::get('/marketcomplaintupdate/{id}', [MarketComplaintController::class, 'update'])->name('marketcomplaintupdate');

   
            });

        }
    );
});
