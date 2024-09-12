<?php

use App\Http\Controllers\ErrataController;
use App\Http\Controllers\ExtensionNewController;
use App\Http\Controllers\InductionTrainingController;
use App\Http\Controllers\rcms\ActionItemController;
use App\Http\Controllers\rcms\AuditeeController;
use App\Http\Controllers\rcms\CCController;
use App\Http\Controllers\rcms\DashboardController;
use App\Http\Controllers\rcms\EffectivenessCheckController;
use App\Http\Controllers\rcms\ExtensionController;
use App\Http\Controllers\rcms\InternalauditController;
use App\Http\Controllers\rcms\LabIncidentController;
use App\Http\Controllers\rcms\ObservationController;
use App\Http\Controllers\rcms\IncidentController;
use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\rcms\AuditProgramController;
use App\Http\Controllers\rcms\CapaController;
use App\Http\Controllers\rcms\FormDivisionController;
use App\Http\Controllers\rcms\ManagementReviewController;
use App\Http\Controllers\rcms\OOTController;
use App\Http\Controllers\rcms\OOSController;
use App\Http\Controllers\rcms\MarketComplaintController;
use App\Http\Controllers\rcms\FailureInvestigationController;
use App\Http\Controllers\OOSMicroController;
use App\Http\Controllers\rcms\NonConformaceController;
use App\Http\Controllers\rcms\RootCauseController;
use App\Http\Controllers\RiskManagementController;
use App\Http\Controllers\rcms\DeviationController;
use App\Http\Controllers\rcms\LogController;
use App\Http\Controllers\rcms\OOCController;
use App\Http\Controllers\tms\EmployeeController;
use App\Http\Controllers\tms\JobTrainingController;
use App\Http\Controllers\tms\TrainerController;
use App\Models\EffectivenessCheck;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResamplingController;


// ============================================
//                   RCMS
//============================================

Route::group(['prefix' => 'rcms'], function () {
    Route::view('rcms', 'frontend.rcms.main-screen');
    Route::get('rcms_login', [UserLoginController::class, 'userlogin']);
    Route::view('rcms_dashboard', 'frontend.rcms.dashboard');
    Route::view('form-division', 'frontend.forms.form-division');
    Route::get('/logout', [UserLoginController::class, 'rcmslogout'])->name('rcms.logout');

    Route::get('/qms-logs/{slug}', [LogController::class, 'index'])->name('rcms.logs.show');



    Route::middleware(['rcms'])->group(
        function () {
            Route::post('job_trainer_send/{id}', [JobTrainingController::class, 'sendStage']);
            Route::get('traineraudittrail/{id}', [TrainerController::class, 'trainerAuditTrial'])->name('trainer.audittrail');
            // Route::get('auditDetailsTrainer/{id}', [TrainerController::class, 'auditDetailstrainer'])->name('trainerauditDetails');
            Route::get('employeeaudittrail/{id}', [EmployeeController::class, 'AuditTrial'])->name('audittrail');
            // Route::get('auditDetailsEmployee/{id}', [EmployeeController::class, 'auditDetailsEmployee'])->name('employeeauditDetails');
            Route::get('job_traineeaudittrail/{id}', [JobTrainingController::class, 'jobAuditTrial'])->name('job_audittrail');
            // Route::get('auditDetailsEmployee/{id}', [JobTrainingController::class, 'auditDetailsJobTrainee'])->name('jobTraineeauditDetails');
            Route::get('induction_traineeaudittrail/{id}', [InductionTrainingController::class, 'inductionAuditTrial'])->name('induction_audittrail');
            // Route::get('auditDetailsEmployee/{id}', [InductionTrainingController::class, 'auditDetailsInduction'])->name('InductionauditDetails');
            Route::post('employee_Child/{id}', [EmployeeController::class, 'Employee_Child'])->name('employee.child');
            Route::resource('CC', CCController::class);
            Route::post('send-initiator/{id}', [CCController::class, 'sendToInitiator']);
            Route::post('send-hod/{id}', [CCController::class, 'sendToHod']);
            Route::post('send-initialQA/{id}', [CCController::class, 'sendToInitialQA']);
            Route::post('send-cft-from-QA/{id}', [CCController::class, 'sendToCft']);

            Route::resource('actionItem', ActionItemController::class);
            Route::post('action-stage-cancel/{id}', [ActionItemController::class, 'actionStageCancel']);
            Route::get('action-item-audittrialshow/{id}', [ActionItemController::class, 'actionItemAuditTrialShow'])->name('showActionItemAuditTrial');
            Route::get('action-item-audittrialdetails/{id}', [ActionItemController::class, 'actionItemAuditTrialDetails'])->name('showaudittrialactionItem');
            Route::get('actionitemSingleReport/{id}', [ActionItemController::class, 'singleReport'])->name('actionitemSingleReport');
            Route::get('actionitemAuditReport/{id}', [ActionItemController::class, 'auditReport'])->name('actionitemAuditReport');
            Route::get('actionitemauditTrailPdf/{id}', [ActionItemController::class, 'auditTrailPdf'])->name('actionitemauditTrailPdf');

            Route::get('effective-audit-trial-show/{id}', [EffectivenessCheckController::class, 'effectiveAuditTrialShow'])->name('show_effective_AuditTrial');
            Route::get('effective-audit-trial-details/{id}', [EffectivenessCheckController::class, 'effectiveAuditTrialDetails'])->name('show_audittrial_effective');
            Route::get('effectiveSingleReport/{id}', [EffectivenessCheckController::class, 'singleReport'])->name('effectiveSingleReport');
            Route::get('effectiveAuditReport/{id}', [EffectivenessCheckController::class, 'auditReport'])->name('effectiveAuditReport');
            Route::post('send-not-effective/{id}', [EffectivenessCheckController::class, 'sendToNotEffective'])->name('send-not-effective');
            Route::post('closed-cancelled/{id}', [EffectivenessCheckController::class, 'closedCancelled'])->name('closed-cancelled');



            // ------------------extension _child---------------------------
            Route::post('extension_child/{id}', [ExtensionController::class, 'extension_child'])->name('extension_child');
            Route::resource('extension', ExtensionController::class);
            Route::post('send-extension/{id}', [ExtensionController::class, 'stageChange']);
            Route::post('send-reject-extention/{id}', [ExtensionController::class, 'stagereject']);
            Route::post('send-cancel-extention/{id}', [ExtensionController::class, 'stagecancel']);
            Route::get('extension-audit-trial/{id}', [ExtensionController::class, 'extensionAuditTrial']);
            Route::get('extension-audit-trial-details/{id}', [ExtensionController::class, 'extensionAuditTrialDetails']);
            Route::get('extensionSingleReport/{id}', [ExtensionController::class, 'singleReport'])->name('extensionSingleReport');
            Route::get('extensionAuditReport/{id}', [ExtensionNewController::class, 'auditReport'])->name('extensionAuditReport');


            Route::post('send-At/{id}', [ActionItemController::class, 'stageChange']);
            Route::post('send-rejection-field/{id}', [CCController::class, 'stagereject']);
            Route::post('send-cft-field/{id}', [CCController::class, 'stageCFTnotReq']);

            Route::post('send-cancel/{id}', [CCController::class, 'stagecancel']);
            Route::post('send-cc/{id}', [CCController::class, 'stageChange']);
            Route::post('child/{id}', [CCController::class, 'child']);
            Route::get('qms-dashboard', [DashboardController::class, 'index'])->name('qms.dashboard');
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
            Route::post('moreinfo_effectiveness/{id}',[EffectivenessCheckController::class,'cancel'])->name('moreinfo_effectiveness');
            Route::post('effectiveness_child/{id}', [EffectivenessCheckController::class, 'effectiveness_child'])->name('effectiveness_child');

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
            Route::get('internalObservationSingleReport/{id}', [InternalauditController::class, 'observationSingleReport']);

            //-------------------------

            Route::post('labcreate', [LabIncidentController::class, 'create'])->name('labIncidentCreate');
            Route::get('LabIncidentShow/{id}', [LabIncidentController::class, 'LabIncidentShow'])->name('ShowLabIncident');
            Route::post('LabIncidentStateChange/{id}', [LabIncidentController::class, 'LabIncidentStateChange'])->name('StageChangeLabIncident');
            Route::post('LabIncidentStateTwo/{id}', [LabIncidentController::class, 'LabIncidentStateTwo'])->name('StageChangeLabtwo');
            Route::post('RejectStateChangeEsign/{id}', [LabIncidentController::class, 'RejectStateChange'])->name('RejectStateChange');
            Route::post('updateLabIncident/{id}', [LabIncidentController::class, 'updateLabIncident'])->name('LabIncidentUpdate');
            Route::post('LabIncidentCancel/{id}', [LabIncidentController::class, 'LabIncidentCancel'])->name('LabIncidentCancel');
            Route::post('LabIncidentChildCapa/{id}', [LabIncidentController::class, 'lab_incident_capa_child'])->name('lab_incident_capa_child');
            Route::post('LabIncidentChildRoot/{id}', [LabIncidentController::class, 'lab_incident_root_child'])->name('lab_incident_root_child');
            Route::post('labincidentRiskChild/{id}', [LabIncidentController::class, 'labincidentRiskChild'])->name('labincidentRisk_Child');
            Route::get('LabIncidentAuditTrial/{id}', [LabIncidentController::class, 'LabIncidentAuditTrial'])->name('audittrialLabincident');
            Route::get('auditDetailsLabIncident/{id}', [LabIncidentController::class, 'auditDetailsLabIncident'])->name('LabIncidentauditDetails');
            Route::post('root_cause_analysis/{id}', [LabIncidentController::class, 'root_cause_analysis'])->name('Child_root_cause_analysis');
            Route::get('LabIncidentSingleReport/{id}', [LabIncidentController::class, 'singleReport'])->name('LabIncidentSingleReport');
            Route::get('LabIncidentAuditReport/{id}', [LabIncidentController::class, 'auditReport'])->name('LabIncidentAuditReport');
            Route::post('labExtChild/{id}', [LabIncidentController::class, 'lab_incident_extension_child'])->name('lab_incident_extension_child');
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
            Route::post('observation_cancel-model/{id}', [ObservationController::class, 'ObservationCancel'])->name('observation_cancel-model');

            Route::post('observation_child/{id}', [ObservationController::class, 'observation_child'])->name('observation_child');
            Route::post('observation_capanot_stage/{id}', [ObservationController::class, 'CapanotStage'])->name('observation_capanot_stage');
            Route::get('Observation_AuditTrial_Show/{id}', [ObservationController::class, 'ObservationAuditTrialShow'])->name('ShowObservationAuditTrial');
            Route::get('ObservationAuditTrialDetails/{id}', [ObservationController::class, 'ObservationAuditTrialDetails'])->name('showaudittrialobservation');
            Route::get('ObservationSingleReport/{id}', [ObservationController::class, 'ObservationSingleReport']);
            Route::get('ObservationAuditTrialShow/{id}', [ObservationController::class, 'ObservationAuditTrailPdf'])->name('Observationaudit.pdf');


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
            Route::post('management/cftnotrequired/{id}', [ManagementReviewController::class, 'managementIsCFTRequired'])->name('managementIsCFTRequired');
            // Route::get('oos_micro/audit_report/{id}', [OOSMicroController::class, 'auditReport'])->name('audit_report');
            // Route::get('oos_micro/single_report/{id}', [OOSMicroController::class, 'singleReport'])->name('oos_micro/single_report');

            Route::post('errata/stages/{id}',[ErrataController::class, 'stageChange'])->name('errata.stage');
            Route::post('errata/stagesreject/{id}',[ErrataController::class, 'stageReject'])->name('errata.stagereject');
            Route::get('errata_audit/{id}', [ErrataController::class, 'auditTrailPdf'])->name('errataaudit.pdf');
            Route::get('errata_single_pdf/{id}',[ErrataController::class, 'singleReports']);


            /********************* Deviation Routes Starts *******************/

            Route::get('deviation', [DeviationController::class, 'deviation'])->name('deviation');
            Route::get('DeviationAuditTrialPdf/{id}', [DeviationController::class, 'deviationAuditTrailPdf']);
            Route::post('deviationstore', [DeviationController::class, 'store'])->name('deviationstore');
            Route::get('devshow/{id}', [DeviationController::class, 'devshow'])->name('devshow');
            Route::post('deviationupdate/{id}', [DeviationController::class, 'update'])->name('deviationupdate');
            Route::post('deviation/reject/{id}', [DeviationController::class, 'deviation_reject'])->name('deviation_reject');
            Route::post('deviation/cancel/{id}', [DeviationController::class, 'deviationCancel'])->name('deviationCancel');
            Route::post('deviation/cftnotrequired/{id}', [DeviationController::class, 'deviationIsCFTRequired'])->name('deviationIsCFTRequired');
            Route::post('deviation/check/{id}', [DeviationController::class, 'check'])->name('check');
            Route::post('deviation/check2/{id}', [DeviationController::class, 'check2'])->name('check2');
            Route::post('deviation/check3/{id}', [DeviationController::class, 'check3'])->name('check3');
            Route::post('deviation/pending_initiator_update/{id}', [DeviationController::class, 'pending_initiator_update'])->name('pending_initiator_update');
            Route::post('deviation/stage/{id}', [DeviationController::class, 'deviation_send_stage'])->name('deviation_send_stage');
            Route::post('deviation/cftnotreqired/{id}', [DeviationController::class, 'cftnotreqired'])->name('cftnotreqired');
            Route::post('deviation/Qa/{id}', [DeviationController::class, 'deviation_qa_more_info'])->name('deviation_qa_more_info');
            Route::get('deviationSingleReport/{id}', [DeviationController::class, 'singleReport'])->name('deviationSingleReport');

            Route::post('dev-launch-extension-deviation/{id}', [DeviationController::class, 'launchExtensionDeviation'])->name('dev-launch-extension-deviation');
            Route::post('dev-launch-extension-capa/{id}', [DeviationController::class, 'launchExtensionCapa'])->name('dev-launch-extension-capa');
            Route::post('dev-launch-extension-qrm/{id}', [DeviationController::class, 'launchExtensionQrm'])->name('dev-launch-extension-qrm');
            Route::post('dev-launch-extension-investigation/{id}', [DeviationController::class, 'launchExtensionInvestigation'])->name('dev-launch-extension-investigation');
            Route::post('deviation/ReqCancel/{id}', [DeviationController::class, 'Request_Cancel'])->name('Request_Cancel');
            /********************* Deviation Routes Ends *******************/

            Route::get('action-items-create', [ActionItemController::class, 'showAction']);

            /********************* Non Conformance Routes Starts *******************/

            Route::get('non-conformance', [NonConformaceController::class, 'index']);
            Route::post('nonConformaceStore', [NonConformaceController::class, 'store'])->name('nonConformaceStore');
            Route::get('non-conformance-show/{id}', [NonConformaceController::class, 'show'])->name('non-conformance-show');
            Route::post('non-conformance-update/{id}', [NonConformaceController::class, 'update'])->name('non-conformance-update');
            Route::post('non_conformance_reject/{id}', [NonConformaceController::class, 'nonConformaceReject'])->name('non_conformance_reject');
            Route::post('nonConformaceCancel/{id}', [NonConformaceController::class, 'nonConformaceCancel'])->name('nonConformaceCancel');
            Route::post('nonConformaceIsCFTRequired/{id}', [NonConformaceController::class, 'nonConformaceCftNotrequired'])->name('nonConformaceIsCFTRequired');
            Route::post('nonConformaceCheck/{id}', [NonConformaceController::class, 'nonConformaceCheck'])->name('nonConformaceCheck');
            Route::post('nonConformaceCheck2/{id}', [NonConformaceController::class, 'nonConformaceCheck2'])->name('nonConformaceCheck2');
            Route::post('nonConformaceCheck3/{id}', [NonConformaceController::class, 'nonConformaceCheck3'])->name('nonConformaceCheck3');
            Route::post('nonConformaceStageChange/{id}', [NonConformaceController::class, 'non_conformance_send_stage'])->name('nonConformaceStageChange');
            Route::post('nonConformaceCftnotreqired/{id}', [NonConformaceController::class, 'cftnotreqired'])->name('nonConformaceCftnotreqired');
            Route::post('nonConformaceQaMoreInfo/{id}', [NonConformaceController::class, 'failure_inv_qa_more_info'])->name('nonConformaceQaMoreInfo');

            Route::get('non-conformance-audit-trail/{id}', [NonConformaceController::class, 'NonConformaceAuditTrail'])->name('non-conformance-audit-trail');
            Route::get('non-conformance-audit-pdf/{id}', [NonConformaceController::class, 'NonConformaceAuditTrailPdf'])->name('non-conformance-audit-pdf');
            Route::get('non-conformance-single-report/{id}', [NonConformaceController::class, 'singleReport'])->name('non-conformance-single-report');

            Route::post('launch-extension-non-conformance/{id}', [NonConformaceController::class, 'launchExtensionDeviation'])->name('launch-extension-non-conformance');
            Route::post('launch-extension-capa/{id}', [NonConformaceController::class, 'launchExtensionCapa'])->name('launch-extension-capa');
            Route::post('launch-extension-qrm/{id}', [NonConformaceController::class, 'launchExtensionQrm'])->name('launch-extension-qrm');
            Route::post('launch-extension-investigation/{id}', [NonConformaceController::class, 'launchExtensionInvestigation'])->name('launch-extension-investigation');

            /********************* Non Conformance Routes Ends *******************/

            /********************* Fallure Investigation Routes Starts *******************/

            Route::get('failure-investigation', [FailureInvestigationController::class, 'index']);
            Route::post('failureInvestigationStore', [FailureInvestigationController::class, 'store'])->name('failureInvestigationStore');
            Route::get('failure-investigation-show/{id}', [FailureInvestigationController::class, 'show'])->name('failure-investigation-show');
            Route::post('failure-investigation-update/{id}', [FailureInvestigationController::class, 'update'])->name('failure-investigation-update');
            Route::post('failure_investigation_reject/{id}', [FailureInvestigationController::class, 'failureInvestigationReject'])->name('failure_investigation_reject');
            Route::post('failureInvestigationCancel/{id}', [FailureInvestigationController::class, 'failureInvestigationCancel'])->name('failureInvestigationCancel');
            Route::post('failureInvestigationIsCFTRequired/{id}', [FailureInvestigationController::class, 'failureInvestigationCftNotrequired'])->name('failureInvestigationIsCFTRequired');
            Route::post('failureInvestigationCheck/{id}', [FailureInvestigationController::class, 'failureInvestigationCheck'])->name('failureInvestigationCheck');
            Route::post('failureInvestigationCheck2/{id}', [FailureInvestigationController::class, 'failureInvestigationCheck2'])->name('failureInvestigationCheck2');
            Route::post('failureInvestigationCheck3/{id}', [FailureInvestigationController::class, 'failureInvestigationCheck3'])->name('failureInvestigationCheck3');
            Route::post('failureInvestigationStageChange/{id}', [FailureInvestigationController::class, 'failure_investigation_send_stage'])->name('failureInvestigationStageChange');
            Route::post('failureInvestigationCftnotreqired/{id}', [FailureInvestigationController::class, 'cftnotreqired'])->name('failureInvestigationCftnotreqired');
            Route::post('failureInvestigationQaMoreInfo/{id}', [FailureInvestigationController::class, 'failure_inv_qa_more_info'])->name('failureInvestigationQaMoreInfo');

            Route::get('failure-investigation-audit-trail/{id}', [FailureInvestigationController::class, 'failureInvestigationAuditTrail'])->name('failure-investigation-audit-trail');
            Route::get('failure-investigation-audit-pdf/{id}', [FailureInvestigationController::class, 'failureInvestigationAuditTrailPdf'])->name('failure-investigation-audit-pdf');
            Route::get('failure-investigation-single-report/{id}', [FailureInvestigationController::class, 'singleReport'])->name('failure-investigation-single-report');

            Route::post('launch-extension-failure-investigation/{id}', [FailureInvestigationController::class, 'launchExtensionDeviation'])->name('launch-extension-failure-investigation');
            Route::post('launch-extension-capa/{id}', [FailureInvestigationController::class, 'launchExtensionCapa'])->name('launch-extension-capa');
            Route::post('launch-extension-qrm/{id}', [FailureInvestigationController::class, 'launchExtensionQrm'])->name('launch-extension-qrm');
            Route::post('launch-extension-investigation/{id}', [FailureInvestigationController::class, 'launchExtensionInvestigation'])->name('launch-extension-investigation');

            /********************* Fallure Investigation Routes Ends *******************/
                    //  ========== Resampling======================
            Route::get('resamplingSingleReport/{id}', [ResamplingController::class, 'singleReport'])->name('resamplingSingleReport');
            Route::get('resamplingAuditReport/{id}', [ResamplingController::class, 'auditReport'])->name('resamplingAuditReport');

            // =====================extesnion new report and audit trail ===============
            Route::get('singleReportNew/{id}', [ExtensionNewController::class, 'singleReport'])->name('singleReportNew');
            Route::get('audit_trailNew/{id}', [ExtensionNewController::class, 'extensionNewAuditTrail']);
            //----------------------------------- OOT ----------------------------------//

            Route::get('oot/', [OOTController::class, 'index']);
            Route::post('oot/create', [OOTController::class, 'store'])->name('oot.store');
            Route::get('oot_view/{id}', [OOTController::class,'ootShow'])->name('rcms/oot_view');
            Route::post('oot/update/{id}',[OOTController::class, 'update'])->name('update');
            // Route::get('oot_audit/{id}',[OOTController::class,'OotAuditTrial']);
            Route::post('oot/stage/{id}',[OOTController::class,'oot_send_stage'])->name('ootStage');
            Route::get('oot_audit_history/{id}', [OOTController::class, 'OotAuditTrial']);
            Route::get('rcms/auditdetails/{id}', [OOTController::class, 'OotAuditDetail'])->name('auditdetails');
            Route::get('ootcSingleReport/{id}', [OOTController::class, 'singleReport']);
            Route::post('OOTChildExtensionOOT/{id}', [OOTController::class, 'OOTChildExtensionOOT'])->name('OOTChildExtensionOOT');

            Route::post('sendstage/{id}',[OOTController::class,'oot_send_stage']);
            Route::post('cancel/{id}', [OOTController::class, 'ootCancel']);
            Route::post('RejectStateChangeNew/{id}', [OOTController::class, 'RejectStateChangeNew'])->name('RejectStateChangeNew');
            Route::post('OOTChildRoot/{id}', [OOTController::class, 'OOTChildRoot'])->name('o_o_t_root_child');
            Route::post('oo_t_capa_child/{id}', [OOTController::class, 'oo_t_capa_child'])->name('oo_t_capa_child');




            Route::post('thirdStage/{id}', [OOTController::class, 'stageChange']);
            Route::post('reject/{id}', [OOTController::class, 'oot_reject']);
            Route::get('audit_pdf/{id}',[OOTController::class,'auditTiailPdf']);


            Route::get('OOCSingleReport/{id}',[OOCController::class, 'singleReports']);
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
                Route::post('sendstage/{id}',[OOSController::class,'send_stage'])->name('send_stage');
                Route::post('requestmoreinfo_back_stage/{id}',[OOSController::class,'requestmoreinfo_back_stage'])->name('requestmoreinfo_back_stage');
                Route::post('assignable_send_stage/{id}',[OOSController::class,'assignable_send_stage'])->name('assignable_send_stage');
                Route::post('cancel_stage/{id}', [OOSController::class, 'cancel_stage'])->name('cancel_stage');
                Route::post('Done_stage/{id}', [OOSController::class, 'Done_stage'])->name('Done_stage');
                Route::post('Done_One_stage/{id}', [OOSController::class, 'Done_One_stage'])->name('Done_One_stage');
                Route::post('Done_Two_stage/{id}', [OOSController::class, 'Done_Two_stage'])->name('Done_Two_stage');
                Route::post('thirdStage/{id}', [OOSController::class, 'stageChange'])->name('thirdStage');
                Route::post('reject_stage/{id}', [OOSController::class, 'reject_stage'])->name('reject_stage');
                Route::get('capa', [CapaController::class, 'capa'])->name('capa');
                Route::post('child/{id}', [OOSController::class, 'child'])->name('child');
                Route::get('AuditTrial/{id}', [OOSController::class, 'AuditTrial'])->name('audit_trial');
                Route::get('auditDetails/{id}', [OOSController::class, 'auditDetails'])->name('audit_details');
                Route::get('audit_report/{id}', [OOSController::class, 'auditReport'])->name('audit_report');
                Route::get('single_report/{id}', [OOSController::class, 'singleReport'])->name('single_report');
            });


            /**
             * oos micro
             */

             Route::group(['prefix' => 'oos_micro', 'as' => 'oos_micro.'], function() {
                Route::get('/', [OOSMicroController::class, 'index'])->name('index');
                Route::post('/store', [OOSMicroController::class, 'store'])->name('store');
                Route::get('edit/{id}',[OOSMicroController::class, 'edit'])->name('edit');
                Route::post('update/{id}',[OOSMicroController::class, 'update'])->name('update');
                Route::post('sendstage/{id}',[OOSMicroController::class,'send_stage'])->name('send_stage');
                Route::post('requestmoreinfo_back_stage/{id}',[OOSMicroController::class,'requestmoreinfo_back_stage'])->name('requestmoreinfo_back_stage');
                Route::post('child/{id}', [OOSMicroController::class, 'child'])->name('child');
                Route::post('assignable_send_stage/{id}',[OOSMicroController::class,'assignable_send_stage'])->name('assignable_send_stage');
                Route::post('cancel_stage/{id}', [OOSMicroController::class, 'cancel_stage'])->name('cancel_stage');;
                Route::post('Done_stage/{id}', [OOSMicroController::class, 'Done_stage'])->name('Done_stage');
                Route::post('Done_One_stage/{id}', [OOSMicroController::class, 'Done_One_stage'])->name('Done_One_stage');
                Route::post('Done_Two_stage/{id}', [OOSMicroController::class, 'Done_Two_stage'])->name('Done_Two_stage');
                Route::post('thirdStage/{id}', [OOSMicroController::class, 'stageChange'])->name('thirdStage');
                Route::post('reject_stage/{id}', [OOSMicroController::class, 'reject_stage'])->name('reject_stage');
                Route::get('AuditTrial/{id}', [OOSMicroController::class, 'AuditTrial'])->name('audit_trial');
                Route::get('auditDetails/{id}', [OOSMicroController::class, 'auditDetails'])->name('audit_details');
                Route::get('audit_report/{id}', [OOSMicroController::class, 'auditReport'])->name('audit_report');
                Route::get('single_report/{id}', [OOSMicroController::class, 'singleReport'])->name('single_report');
            });

            /**
             * market coplaint
             */
            Route::group(['prefix' => 'marketcomplaint', 'as' => 'marketcomplaint.'], function() {
                Route::get('/market_complaint_new',[MarketComplaintController::class, 'index'])->name('market_complaint_new');
                Route::post('/marketcomplaint/store', [MarketComplaintController::class, 'store'])->name('mcstore');
                Route::get('/marketcomplaint_view/{id}', [MarketComplaintController::class, 'show'])->name('marketcomplaint_view');
                Route::put('/marketcomplaintupdate/{id}', [MarketComplaintController::class, 'update'])->name('marketcomplaintupdate');
                Route::post('mar_comp_stagechange/{id}',[MarketComplaintController::class,'marketComplaintStateChange'])->name('mar_comp_stagechange');
                Route::post('mar_comp_reject_stateChange/{id}', [MarketComplaintController::class, 'marketComplaintRejectState'])->name('mar_comp_reject_stateChange');
                Route::post('MarketComplaintCancel/{id}', [MarketComplaintController::class, 'MarketComplaintCancel'])->name('MarketComplaintCancel');

                Route::get('auditDetailsMarket/{id}', [MarketComplaintController::class, 'auditDetailsMarket'])->name('marketauditDetails');

                Route::get('MarketComplaintAuditReport/{id}', [MarketComplaintController::class, 'MarketAuditTrial'])->name('MarketComplaintAuditReport');
                Route::get('MarketAuditReport/{id}', [MarketComplaintController::class, 'auditReport'])->name('marketAuditReport');
                Route::get('marketauditTrailPdf/{id}', [MarketComplaintController::class, 'auditTrailPdf'])->name('marketauditTrailPdf');
                Route::post('MarketComplaintC_AChild/{id}', [MarketComplaintController::class, 'MarketComplaintCapa_ActionChild'])->name('capa_action_child');
                Route::post('MarketComplaintRCA_ActionChild/{id}', [MarketComplaintController::class, 'MarketComplaintRca_actionChild'])->name('rca_action_child');
                Route::post('MarketComplaintRegul_Effec_Child/{id}', [MarketComplaintController::class, 'MarketComplaintRegu_Effec_Child'])->name('Regu_Effec_child');
                Route::get('acknoledgment_report/{id}',[MarketComplaintController::class,'AcknoledgmentReport'])->name('acknoledgment_report');

            });
            // Route::get('rcms/marketComplaintSingleReport/{id}', [MarketComplaintController::class, 'singleReport']);
            Route::get('pdf-report/{id}', [MarketComplaintController::class, 'singleReport']);


            /********************* Incident Routes Starts *******************/

            Route::get('incident', [IncidentController::class, 'index'])->name('incident');
            Route::post('incident-store', [IncidentController::class, 'store'])->name('incident-store');
            Route::get('incident-show/{id}', [IncidentController::class, 'incidentShow'])->name('incident-show');
            Route::post('incident-update/{id}', [IncidentController::class, 'update'])->name('incident-update');
            Route::post('incident-reject/{id}', [IncidentController::class, 'incidentReject'])->name('incident-reject');
            Route::post('incident-cancel/{id}', [IncidentController::class, 'incidentCancel'])->name('incident-cancel');
            Route::post('incidentIsCFTRequired/{id}', [IncidentController::class, 'incidentIsCFTRequired'])->name('incidentIsCFTRequired');
            Route::post('incidentCheck/{id}', [IncidentController::class, 'incidentCheck'])->name('incidentCheck');
            Route::post('incidentCheck2/{id}', [IncidentController::class, 'incidentCheck2'])->name('incidentCheck2');
            Route::post('incidentCheck3/{id}', [IncidentController::class, 'incidentCheck3'])->name('incidentCheck3');
            Route::post('new_incident_stage/{id}', [IncidentController::class, 'new_incident_stage'])->name('new_incident_stage');
            Route::post('incidentStageChange/{id}', [IncidentController::class, 'incident_send_stage'])->name('incidentStageChange');
            Route::post('incidentCftnotreqired/{id}', [IncidentController::class, 'cftnotreqired'])->name('incidentCftnotreqired');
            Route::post('incidentQaMoreInfo/{id}', [IncidentController::class, 'incident_qa_more_info'])->name('incidentQaMoreInfo');

            Route::get('incident-audit-trail/{id}', [IncidentController::class, 'incidentAuditTrail'])->name('incident-audit-trail');
            Route::get('incident-audit-pdf/{id}', [IncidentController::class, 'incidentAuditTrailPdf'])->name('incident-audit-pdf');
            Route::get('incident-single-report/{id}', [IncidentController::class, 'singleReport'])->name('incident-single-report');

            Route::post('launch-extension-incident/{id}', [IncidentController::class, 'launchExtensionIncident'])->name('launch-extension-incident');
            Route::post('launch-extension-capa/{id}', [IncidentController::class, 'launchExtensionCapa'])->name('launch-extension-capa');
            Route::post('launch-extension-qrm/{id}', [IncidentController::class, 'launchExtensionQrm'])->name('launch-extension-qrm');
            Route::post('launch-extension-investigation/{id}', [IncidentController::class, 'launchExtensionInvestigation'])->name('launch-extension-investigation');

            /********************* Incident Routes Ends *******************/
            Route::post('send-qa-approval/{id}', [CCController::class, 'sentToQAHeadApproval'])->name('send-qa-approval');
            Route::post('send-reject/{id}', [CCController::class, 'reject'])->name('send-reject');
            Route::post('send-post-implementation/{id}', [CCController::class, 'sentoPostImplementation'])->name('send-post-implementation');
            Route::post('moreinfoState_actionitem/{id}', [ActionItemController::class, 'actionmoreinfo']);
            Route::post('LabIncidentStateCancel/{id}', [LabIncidentController::class, 'LabIncidentStateCancel'])->name('StageChangeLabcancel');

        }
    );
});
