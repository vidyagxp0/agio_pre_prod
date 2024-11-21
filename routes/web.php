

<?php

use App\Http\Controllers\ActionItemController;
use App\Http\Controllers\Ajax\AjaxController;
use App\Http\Controllers\OpenStageController;
use App\Http\Controllers\rcms\InternalauditController;
use App\Http\Controllers\rcms\RootCauseController;
use App\Http\Controllers\TMSController;
use App\Http\Controllers\RiskManagementController;
use App\Http\Controllers\ChangeControlController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DocumentDetailsController;
use App\Http\Controllers\rcms\DesktopController;
use App\Http\Controllers\rcms\MarketComplaintController;
use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\MytaskController;
use App\Http\Controllers\CabinateController;
use App\Http\Controllers\rcms\{CCController,DeviationController, IncidentController};
use App\Http\Controllers\rcms\EffectivenessCheckController;
use App\Http\Controllers\rcms\ObservationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentContentController;
use App\Http\Controllers\ErrataController;
use App\Http\Controllers\ExtensionNewController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ResamplingController;
use App\Http\Controllers\InductionTrainingcontroller;
use App\Http\Controllers\OOSMicroController;
use App\Http\Controllers\rcms\AuditeeController;
use App\Http\Controllers\rcms\NonConformaceController;
use App\Http\Controllers\rcms\CapaController;
use App\Http\Controllers\rcms\FailureInvestigationController;
use App\Http\Controllers\rcms\LabIncidentController;
use App\Http\Controllers\rcms\AuditProgramController;
use App\Http\Controllers\rcms\ExtensionController;
use App\Http\Controllers\rcms\ManagementReviewController;
use App\Http\Controllers\rcms\OOCController;
use App\Http\Controllers\rcms\OOSController;
use App\Http\Controllers\rcms\RcmsDashboardController;
use App\Http\Controllers\tms\EmployeeController;
use App\Http\Controllers\JobDescriptionController;

use App\Http\Controllers\tms\QuestionBankController;
use App\Http\Controllers\tms\QuestionController;
use App\Http\Controllers\tms\QuizeController;
use App\Http\Controllers\rcms\OOTController;
use App\Http\Controllers\tms\TrainerController;
use App\Http\Controllers\tms\TNIController;

use App\Imports\DocumentsImport;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tms\JobTrainingController;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//!---------------- EMP login  ---------------------------//
Route::group(['middleware' => ['auth:employee']], function () {
    // All employee authenticated routes here
    Route::resource('TMS', TMSController::class);
Route::get('induction_training_certificate/{id}', [InductionTrainingcontroller::class, 'showCertificate']);

    Route::get('/logout-employee', [UserLoginController::class, 'logoutEmployee'])->name('logout-employee');
    Route::get('/tms-training', [TMSController::class, 'TMSTraining'])->name('tms.training');
    Route::get('induction_training-details/{id}', [InductionTrainingcontroller::class, 'viewrendersopinduction']);

});

//!---------------- EMP login  ---------------------------//

Route::resource('TMS', TMSController::class);

Route::get('/', [UserLoginController::class, 'userlogin']);
Route::get('/login', [UserLoginController::class, 'userlogin'])->name('login');
Route::post('/logincheck', [UserLoginController::class, 'logincheck']);
Route::get('/logout', [UserLoginController::class, 'logout'])->name('logout');
Route::post('/rcms_check', [UserLoginController::class, 'rcmscheck']);
Route::post('CC-effectiveness-check/{id}', [CCController::class, 'changeControlEffectivenessCheck'])->name('CC-effectiveness-check');
//Route::get('/', [UserLoginController::class, 'userlogin']);
Route::get('/error', function () {
    return view('error');
})->name('error.route');

//!---------------- starting login  ---------------------------//

Route::get('/', [UserLoginController::class, 'userlogin']);
Route::view('forgot-password', 'frontend.forgot-password');
// Route::view('dashboard', 'frontend.dashboard');


Route::get('data-fields', function () {
    return view('frontend.change-control.data-fields');
});
Route::middleware(['auth', 'prevent-back-history', 'user-activity'])->group(function () {
    Route::resource('change-control', OpenStageController::class);
    Route::get('change-control-audit/{id}', [OpenStageController::class, 'auditTrial']);
    Route::get('change-control-audit-detail/{id}', [OpenStageController::class, 'auditDetails']);
    Route::post('division/change/{id}', [OpenStageController::class, 'division'])->name('division_change');
    Route::get('send-notification/{id}', [OpenStageController::class, 'notification']);
    Route::resource('documents', DocumentController::class);
    Route::post('revision/{id}', [DocumentController::class, 'revision']);
    Route::get('/documentExportPDF', [DocumentController::class, 'documentExportPDF'])->name('documentExportPDF');
    Route::get('/documentExportEXCEL', [DocumentController::class, 'documentExportEXCEL'])->name('documentExportEXCEL');
    Route::post('/import', [DocumentController::class, 'import'])->name('csv.import');
    Route::post('/importpdf', [ImportController::class, 'PDFimport']);
    Route::post('division_submit', [DocumentController::class, 'division'])->name('division_submit');
    //Route::post('set/division', [DocumentController::class, 'division'])->name('division_submit');
    Route::post('dcrDivision', [DocumentController::class, 'dcrDivision'])->name('dcrDivision_submit');
    Route::get('documents/generatePdf/{id}', [DocumentController::class, 'createPDF']);

    Route::get('documents/reviseCreate/{id}', [DocumentController::class, 'revise_create']);
    Route::get('documents/printPDFAnx/{id}', [DocumentController::class, 'printPDFAnx'])->name('document.print.pdf');
    Route::get('documents/printAnnexure/{document}/{annexure}', [DocumentController::class, 'printAnnexure'])->name('document.print.annexure');
    Route::get('documents/printPDF/{id}', [DocumentController::class, 'printPDF']);
    Route::get('documents/viewpdf/{id}', [DocumentController::class, 'viewPdf']);
    Route::resource('documentsContent', DocumentContentController::class);
    Route::get('doc-details/{id}', [DocumentDetailsController::class, 'viewdetails']);
    Route::put('sendforstagechanage', [DocumentDetailsController::class, 'sendforstagechanage']);
    Route::get('notification/{id}', [DocumentDetailsController::class, 'notification']);
    Route::get('/get-data', [DocumentDetailsController::class, 'getData'])->name('get.data');
    Route::post('/send-notification', [DocumentDetailsController::class, 'sendNotification']);
    Route::get('/search', [DocumentDetailsController::class, 'search']);
    Route::get('/advanceSearch', [DocumentDetailsController::class, 'searchAdvance']);
    Route::get('auditPrint/{id}', [DocumentDetailsController::class, 'printAudit']);
    Route::get('mytaskdata', [MytaskController::class, 'index']);
    Route::get('mydms', [CabinateController::class, 'index']);
    Route::get('email', [CabinateController::class, 'email']);
    Route::get('rev-details/{id}', [MytaskController::class, 'reviewdetails']);
    Route::post('send-change-control/{id}', [ChangeControlController::class, 'statechange']);
    Route::get('audit-trial/{id}', [DocumentDetailsController::class, 'auditTrial']);
    Route::get('audit-individual/{id}/{user}', [DocumentDetailsController::class, 'auditTrialIndividual']);
    Route::get('audit-detail/{id}', [DocumentDetailsController::class, 'auditDetails'])->name('audit-detail');
    Route::post('update-doc/{id}', [DocumentDetailsController::class, 'updatereviewers'])->name('update-doc');
    Route::get('audit-details/{id}', [DocumentDetailsController::class, 'getAuditDetail'])->name('audit-details');
    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::get('analytics', [DashboardController::class, 'analytics']);
    Route::post('subscribe', [DashboardController::class, 'subscribe']);
   

    Route::get('TMS-details/{id}/{sopId}', [TMSController::class, 'viewTraining']);
    Route::get('training/{id}/', [TMSController::class, 'training']);
    Route::get('trainingQuestion/{id}/', [TMSController::class, 'trainingQuestion']);
    Route::get('training-notification/{id}', [TMSController::class, 'notification']);
    Route::post('trainingComplete/{id}', [TMSController::class, 'trainingStatus']);
    Route::get('training-overall-status/{id}', [TMSController::class, 'trainingOverallStatus']);
    //Route::post('trainingSubmitData/{id}', [TMSController::class, 'trainingSubmitData']);
    Route::get('tms-audit/{id}', [TMSController::class, 'auditTrial']);
    Route::get('tms-audit-detail/{id}', [TMSController::class, 'auditDetails']);
    // Route::post('import', function () {
    //     Excel::import(new DocumentsImport, request()->file('file'));
    //     return redirect()->back()->with('success', 'Data Imported Successfully');
    // });
    Route::get('example/{id}/', [TMSController::class, 'example']);

    // Questions Part
    Route::resource('question', QuestionController::class);
    Route::get('questiondata/{id}', [QuestionBankController::class, 'datag'])->name('questiondata');
    Route::resource('question-bank', QuestionBankController::class);
    Route::resource('quize', QuizeController::class);
    Route::get('data/{id}', [QuizeController::class, 'datag'])->name('data');
    Route::get('datag/{id}', [QuizeController::class, 'data'])->name('datag');
    //-----------------------QMS----------------
    Route::get('qms-dashboard', [RcmsDashboardController::class, 'index']);
});

// ====================================Capa=======================
Route::get('capa', [CapaController::class, 'capa']);
Route::post('capastore', [CapaController::class, 'capastore'])->name('capastore');
Route::post('capaUpdate/{id}', [CapaController::class, 'capaUpdate'])->name('capaUpdate');
Route::get('capashow/{id}', [CapaController::class, 'capashow'])->name('capashow');
Route::post('capa/stage/{id}', [CapaController::class, 'capa_send_stage'])->name('capa_send_stage');
Route::post('capa/cancel/{id}', [CapaController::class, 'capaCancel'])->name('capaCancel');
Route::post('capa/reject/{id}', [CapaController::class, 'capa_reject'])->name('capa_reject');
Route::post('capa/Qa/{id}', [CapaController::class, 'capa_qa_more_info'])->name('capa_qa_more_info');
Route::get('CapaAuditTrial/{id}', [CapaController::class, 'CapaAuditTrial']);
Route::get('auditDetailsCapa/{id}', [CapaController::class, 'auditDetailsCapa'])->name('showCapaAuditDetails');
Route::post('capa_child/{id}', [CapaController::class, 'child_change_control'])->name('capa_child_changecontrol');
Route::post('effectiveness_check/{id}', [CapaController::class, 'effectiveness_check'])->name('capa_effectiveness_check');

// ==============================management review ==========================manage

Route::post('managestore', [ManagementReviewController::class, 'managestore'])->name('managestore');
Route::post('manageUpdate/{id}', [ManagementReviewController::class, 'manageUpdate'])->name('manageUpdate');
Route::get('manageshow/{id}', [ManagementReviewController::class, 'manageshow'])->name('manageshow');
Route::post('manage/stage/{id}', [ManagementReviewController::class, 'manage_send_stage'])->name('manage_send_stage');
Route::post('manage/cancel/{id}', [ManagementReviewController::class, 'manageCancel'])->name('manageCancel');
Route::post('manage/reject/{id}', [ManagementReviewController::class, 'manage_reject'])->name('manage_reject');
Route::post('manage_send_more_require_stage/{id}', [ManagementReviewController::class, 'manage_send_more_require_stage'])->name('manage_send_more_require_stage');
Route::post('manage/Qa/{id}', [ManagementReviewController::class, 'manage_qa_more_info'])->name('manage_qa_more_info');
Route::get('ManagementReviewAuditTrial/{id}', [ManagementReviewController::class, 'ManagementReviewAuditTrial']);
Route::get('ManagementReviewAuditDetails/{id}', [ManagementReviewController::class, 'ManagementReviewAuditDetails']);
Route::get('/management/{id}',[ManagementReviewController::class,'audit_trail_managementReview_filter'])->name('api.management-review.filter');


/********************************************* Deviation Starts *******************************************/

Route::post('deviation_child/{id}', [DeviationController::class, 'deviation_child_1'])->name('deviation_child_1');

Route::get('DeviationAuditTrial/{id}', [DeviationController::class, 'DeviationAuditTrial']);
Route::post('DeviationAuditTrial/{id}', [DeviationController::class, 'store_audit_review'])->name('store_audit_review');
Route::get('/Deviation/{id}',[DeviationController::class,'audit_trail_filter'])->name('api.Deviation.filter');

/********************************************* Deviation Ends *******************************************/

/********************************************* Deviation Starts *******************************************/

Route::post('failure_investigation_child_1/{id}', [FailureInvestigationController::class, 'failure_investigation_child_1'])->name('failure_investigation_child_1');
Route::post('non_conformances_child_1/{id}', [NonConformaceController::class, 'non_conformances_child_1'])->name('non_conformances_child_1');
Route::post('incident_child_1/{id}', [IncidentController::class, 'incident_child_1'])->name('incident_child_1');
/********************************************* Deviation Ends *******************************************/

// ==============================end ==============================
//! ============================================
//!                    Risk Management
//! ============================================
Route::get('risk-management', [RiskManagementController::class, 'risk']);
Route::get('RiskManagement/{id}', [RiskManagementController::class, 'show'])->name('showRiskManagement');
Route::post('risk_store', [RiskManagementController::class, 'store'])->name('risk_store');
Route::post('riskAssesmentUpdate/{id}', [RiskManagementController::class, 'riskUpdate'])->name('riskUpdate');
Route::post('riskAssesmentStateChange{id}', [RiskManagementController::class, 'riskAssesmentStateChange'])->name('riskAssesmentStateUpdate');
Route::post('reject_Risk/{id}', [RiskManagementController::class, 'RejectStateChange'])->name('reject_Risk');

Route::get('riskAuditTrial/{id}', [RiskManagementController::class, 'riskAuditTrial']);
Route::get('auditDetailsrisk/{id}', [RiskManagementController::class, 'auditDetailsrisk'])->name('showriskAuditDetails');
Route::post('child/{id}', [RiskManagementController::class, 'child'])->name('riskAssesmentChild');
Route::post('riskassesmentCancel/{id}', [RiskManagementController::class, 'riskassesmentCancel'])->name('riskassesmentCancel');

Route::post('RMAuditReview/{id}', [RiskManagementController::class, 'rm_AuditReview'])->name('RMAuditReview');
Route::get('ra_filter/{id}', [RiskManagementController::class, 'audit_filter'])->name('ra_filter');





// ======================================================


// ====================================root cause analysis=======================
Route::get('root-cause-analysis', [RootCauseController::class, 'rootcause']);
Route::post('rootstore', [RootCauseController::class, 'root_store'])->name('root_store');
Route::post('rootUpdate/{id}', [RootCauseController::class, 'root_update'])->name('root_update');
Route::get('rootshow/{id}', [RootCauseController::class, 'root_show'])->name('root_show');
Route::post('root/stage/{id}', [RootCauseController::class, 'root_send_stage'])->name('root_send_stage');
Route::post('root/cancel/{id}', [RootCauseController::class, 'root_Cancel'])->name('root_Cancel');
Route::post('root/reject/{id}', [RootCauseController::class, 'root_reject'])->name('root_reject');
Route::get('rootAuditTrial/{id}', [RootCauseController::class, 'rootAuditTrial']);
Route::get('auditDetailsRoot/{id}', [RootCauseController::class, 'auditDetailsroot'])->name('showrootAuditDetails');



// ====================================InternalauditController=======================
Route::post('internalauditreject/{id}', [InternalauditController::class, 'RejectStateChange']);
Route::post('nocapastate/{id}', [InternalauditController::class, 'noCapastate']);
Route::post('InternalAuditCancel/{id}', [InternalauditController::class, 'InternalAuditCancel']);
Route::post('InternalAuditChild/{id}', [InternalauditController::class, 'internal_audit_child'])->name('internal_audit_child');
Route::post('multiple_child/{id}', [InternalauditController::class, 'multiple_child'])->name('multiple_child');
Route::post('internalAuditReview/{id}', [InternalauditController::class, 'internalAuditReview'])->name('internalAuditReview');
// external audit----------------------------

Route::get('show/{id}', [AuditeeController::class, 'show'])->name('showExternalAudit');
Route::post('auditee_store', [AuditeeController::class, 'store'])->name('auditee_store');
Route::post('update/{id}', [AuditeeController::class, 'update'])->name('updateExternalAudit');
Route::post('ExternalAuditStateChange/{id}', [AuditeeController::class, 'ExternalAuditStateChange'])->name('externalAuditStateChange');
Route::post('RejectStateAuditee/{id}', [AuditeeController::class, 'RejectStateChange'])->name('RejectStateAuditee');
Route::post('CancelStateExternalAudit/{id}', [AuditeeController::class, 'externalAuditCancel'])->name('CancelStateExternalAudit');
Route::get('ExternalAuditTrialShow/{id}', [AuditeeController::class, 'AuditTrialExternalShow'])->name('ShowexternalAuditTrial');
Route::get('ExternalAuditTrialDetails/{id}', [AuditeeController::class, 'AuditTrialExternalDetails'])->name('ExternalAuditTrialDetailsShow');
Route::post('child_external/{id}', [AuditeeController::class, 'child_external'])->name('childexternalaudit');
Route::post('UpdateStateAuditee/{id}', [AuditeeController::class, 'UpdateStateChange'])->name('UpdateStateAuditee');

//----------------------Lab Incident view-----------------
Route::get('lab-incident', [LabIncidentController::class, 'labincident']);
//Route::post('RejectStateChange/{id}', [RootCauseController::class, 'RejectStateChange'])->name('RejectStateChange');
// Route::post('RejectStateChange/{id}', [LabIncidentController::class, 'RejectStateChange']);
// Route::post('LabIncidentStateChange/{id}', [LabIncidentController::class, 'LabIncidentStateChange'])->name('StageChangeLabIncident');
Route::post('RejectStateChange/{id}', [LabIncidentController::class, 'RejectStateChange']);
Route::post('StageChangeLabIncident/{id}', [LabIncidentController::class, 'LabIncidentStateChange']);
Route::post('LabIncidentCancel/{id}', [LabIncidentController::class, 'LabIncidentCancelStage']);
Route::get('/labincident/{id}',[LabIncidentController::class,'audit_trail_filter_lab_incident'])->name('lab_incident_filter');
Route::post('storereview/{id}', [LabIncidentController::class, 'store_audit_review_lab'])->name('store_audit_reviewlab');
Route::get('audit-program', [AuditProgramController::class, 'auditprogram']);
Route::get('/audit_program/{id}',[AuditProgramController::class,'audit_trail_filter_audit_program'])->name('audit_program_filter');


//---------------------------Market Complaint  -------------------------//

Route::post('McAuditTrial/{id}', [MarketComplaintController::class, 'mc_AuditReview'])->name('McAuditTrial');
Route::get('mcFilter/{id}',[MarketComplaintController::class,'audit_filter'])->name('mc_filter');
Route::post('mC/cftnotrequired/{id}', [MarketComplaintController::class, 'MarkComplaintCFTRequired'])->name('MarkComplaintCFTRequired');




Route::get('/observation/{id}',[ObservationController::class,'audit_trail_filter_observation'])->name('observation_filter');




Route::get('data-fields', function () {
    return view('frontend.data-fields');
});
Route::view('emp', 'emp');

Route::view('tasks', 'frontend.tasks');
Route::view('tasks', 'frontend.T');

Route::view('review-details', 'frontend.documents.review-details');
Route::view('audit-trial-inner', 'frontend.documents.audit-trial-inner');
Route::view('new-pdf', 'frontend.documents.new-pdf');
Route::view('new-login', 'frontend.new-login');

// ============================================
//                    TMS
// ============================================
Route::view('activity_log', 'frontend.TMS.activity_log');

Route::view('helpdesk-personnel', 'frontend.helpdesk-personnel');

// Route::view('send-notification', 'frontend.send-notification');

Route::view('designate-proxy', 'frontend.designate-proxy');

Route::view('person-details', 'frontend.person-details');

Route::view('basic-search', 'frontend.basic-search');

//! ============================================ //
//!                    TMS
//! ============================================ //

Route::view('create-training', 'frontend.TMS.create-training');

Route::view('example', 'frontend.TMS.example');

Route::view('create-quiz', 'frontend.TMS.create-quiz');

Route::view('document-view', 'frontend.TMS.document-view');

Route::view('training-page', 'frontend.TMS.training-page');

Route::view('question-training', 'frontend.TMS.question-training');

Route::view('edit-question', 'frontend.TMS.edit-question');

Route::view('change-control-list', 'frontend.change-control.change-control-list');

Route::view('change-control-list-print', 'frontend.change-control.change-control-list-print');

Route::view('change-control-view', 'frontend.change-control.change-control-view');

Route::view('reviewer-panel', 'frontend.change-control.reviewer-panel');

Route::view('change-control-form', 'frontend.change-control.data-fields');

//Route::view('new-change-control', 'frontend.change-control.new-change-control');
Route::get("new-change-control", [CCController::class, "changecontrol"]);

Route::view('audit-pdf', 'frontend.documents.audit-pdf');

// Route::view('employee_new', 'frontend.TMS.Employee.employee_new')->name('employee_new');

Route::view('trainer_qualification', 'frontend.TMS.Trainer_qualification.trainer_qualification')->name('trainer_qualification');


//---------------- Job Description--------------------------
Route::get('/employees/{id}', [JobDescriptionController::class, 'getEmployeeData']);
Route::get('job_description',[JobDescriptionController::class ,'index'])->name('job_description');
Route::get('job_description/show/{id}',[JobDescriptionController::class ,'edit'])->name('job_description_view');
Route::post('job_descriptioncreate', [JobDescriptionController::class, 'store'])->name('job_descriptioncreate');
Route::put('job_descriptionupdate/{id}', [JobDescriptionController::class, 'update'])->name('job_descriptionupdate');
Route::post('tms/jobDescription/cancelstages/{id}',[JobDescriptionController::class ,'cancelStages']);




// ====================induction training =================

// // Route::view('induction_training', 'frontend.TMS.Induction_training.induction_training')->name('induction_training');
// Route::view('job_training', 'frontend.TMS.Job_Training.job_training')->name('job_training');
Route::get('job_training',[JobTrainingController::class ,'index'])->name('job_training');
Route::get('job_training/show/{id}',[JobTrainingController::class ,'edit'])->name('job_training_view');
Route::post('tms/jobTraining/cancelstage/{id}',[JobTrainingController::class ,'cancelStage']);
Route::get('/get-sop-description/{id}', [JobTrainingController::class, 'getSopDescription']);

Route::get('/fetch-questions/{documentId}', [JobTrainingController::class, 'fetchQuestions']);

Route::get('trainingQuestions/{id}/', [JobTrainingController::class, 'trainingQuestions']);


Route::post('job_trainingcreate', [JobTrainingController::class, 'store'])->name('job_trainingcreate');
// Route::post('check_answer_otj/{id}', [JobTrainingController::class, 'checkAnswerOtj'])->name('check_answer_otj');
Route::put('job_trainingupdate/{id}', [JobTrainingController::class, 'update'])->name('job_trainingupdate');
Route::get('/employees/{id}', [JobTrainingController::class, 'getEmployeeDetail']);
Route::get('job_training-details/{id}', [JobTrainingController::class, 'viewrendersop']);
Route::get('question_training/{id}', [JobTrainingController::class, 'questionrendersop']);
Route::get('on_the_job_question_training/{id}/{job_id}', [JobTrainingController::class, 'questionshow']);
Route::get('job_training_certificate/{id}', [JobTrainingController::class, 'showJobCertificate']);

Route::post('/check-answer-otj', [JobTrainingController::class, 'checkAnswerOtj'])->name('check_answer_otj');
Route::post('/check-answer-induction', [InductionTrainingcontroller::class, 'checkAnswerInduction'])->name('check_answer_induction');


Route::get('induction_training-details/{id}', [InductionTrainingcontroller::class, 'viewrendersopinduction']);
Route::get('induction_question_training/{id}/{induction_id}', [InductionTrainingcontroller::class, 'inductionquestionshow']);
Route::get('induction_training_certificate/{id}', [InductionTrainingcontroller::class, 'showCertificate']);
Route::get('induction_training', [InductionTrainingcontroller::class, 'index'])->name('induction_training.index');
Route::get('induction_training/show/{id}', [InductionTrainingcontroller::class, 'edit'])->name('induction_training_view');
Route::post('induction_training', [InductionTrainingcontroller::class, 'store'])->name('induction_training.store');
Route::put('induction_training/{id}', [InductionTrainingcontroller::class, 'update'])->name('induction_training.update');
//new route 
Route::get('/employees/{id}', [InductionTrainingcontroller::class, 'getEmployeeDetails']);

Route::get('/fetch-question/{documentId}', [InductionTrainingcontroller::class, 'fetchQuestion']);
Route::get('/documents/view/{id}', [InductionTrainingcontroller::class, 'viewSop'])->name('documents.view');




//! ============================================
//!                    RCMS
//! ============================================
Route::get('chart-data', [DesktopController::class, 'fetchChartData']);

Route::view('rcms_login', 'frontend.rcms.login');

Route::view('rcms_dashboard', 'frontend.rcms.dashboard');
Route::get('rcms_desktop', [DesktopController::class, 'rcms_desktop']);
Route::post('dashboard_search', [DesktopController::class, 'dashboard_search'])->name('dashboard_search');
Route::post('dashboard_search', [DesktopController::class, 'main_dashboard_search'])->name('main_dashboard_search');
// Route::view('rcms_desktop', 'frontend.rcms.desktop');

Route::view('rcms_reports', 'frontend.rcms.reports');

Route::view('Quality-Dashboard-Report', 'frontend.rcms.Quality-Dashboard');

Route::view('Supplier-Dashboard-Report', 'frontend.rcms.Supplier-Dashboard');

Route::view('QMSDashboardFormat', 'frontend.rcms.QMSDashboardFormat');



//! ============================================
//!                    FORMS
//! ============================================


Route::view('deviation', 'frontend.forms.deviation');

Route::view('extension_form', 'frontend.forms.extension');

Route::view('cc-form', 'frontend.forms.change-control');

Route::view('audit-management', 'frontend.forms.audit-management');

Route::view('out-of-specification', 'frontend.forms.out-of-specification');

// Route::view('risk-management', 'frontend.forms.risk-management');


Route::view('action-item', 'frontend.forms.action-item');

// Route::view('effectiveness-check', 'frontend.forms.effectiveness-check');
Route::get('effectiveness-check', [EffectivenessCheckController::class, 'effectiveness_check']);

Route::view('quality-event', 'frontend.forms.quality-event');

Route::view('vendor-entity', 'frontend.forms.vendor-entity');

// Route::view('auditee', 'frontend.forms.auditee');
Route::get('auditee', [AuditeeController::class, 'external_audit']);


Route::get('meeting', [ManagementReviewController::class, 'meeting']);

// Route::view('market-complaint', 'frontend.forms.market-complaint');

//Route::view('lab-incident', 'frontend.forms.lab-incident');

Route::view('classroom-training', 'frontend.forms.classroom-training');

Route::view('employee', 'frontend.forms.employee');

Route::view('requirement-template', 'frontend.forms.requirement-template');

Route::view('scar', 'frontend.forms.scar');

Route::view('external-audit', 'frontend.forms.external-audit');

Route::view('contract', 'frontend.forms.contract');

Route::view('supplier', 'frontend.forms.supplier');

Route::view('supplier-initiated-change', 'frontend.forms.supplier-initiated-change');

Route::view('supplier-investigation', 'frontend.forms.supplier-investigation');

Route::view('supplier-issue-notification', 'frontend.forms.supplier-issue-notification');

Route::view('supplier-audit', 'frontend.forms.supplier-audit');

// Route::view('audit', 'frontend.forms.audit');
Route::get('audit', [InternalauditController::class, 'internal_audit']);

Route::view('supplier-questionnaire', 'frontend.forms.supplier-questionnaire');

Route::view('substance', 'frontend.forms.substance');

Route::view('supplier-action-item', 'frontend.forms.supplier-action-item');

Route::view('registration-template', 'frontend.forms.registration-template');

Route::view('project', 'frontend.forms.project');

Route::get('extension', [ExtensionController::class, 'extension_child']);

//Route::view('observation', 'frontend.forms.observation');
Route::get('observation', [ObservationController::class, 'observation']);

Route::view('new-root-cause-analysis', 'frontend.forms.new-root-cause-analysis');

Route::view('help-desk-incident', 'frontend.forms.help-desk-incident');

Route::view('review-management-report', 'frontend.review-management.review-management-report');



//  ===================== OOS OOT OOC Form Route====================================
Route::view('OOT_form', 'frontend.OOT.OOT_form');
Route::get('out_of_calibration', [OOCController::class, 'index'])->name('ooc.index');
Route::get('OOC/view', [OOCController::class, 'edit'])->name('ooc.edit');
Route::post('ooccreate', [OOCController::class, 'create'])->name('oocCreate');
Route::get('OutofCalibrationShow/{id}', [OOCController::class, 'OutofCalibrationShow'])->name('ShowOutofCalibration');
Route::post('updateOutOfCalibration/{id}', [OOCController::class, 'updateOutOfCalibration'])->name('OutOfCalibrationUpdate');
Route::post('OOCStateChange/{id}', [OOCController::class, 'OOCStateChange'])->name('StageChangeOOC');
Route::post('OOCStateChangetwo/{id}', [OOCController::class, 'OOCStateChangetwo'])->name('StageChangeOOCtwo');
Route::post('OOCStateCancel/{id}', [OOCController::class, 'OOCStateCancel'])->name('OOCCancel');
Route::post('RejectoocStateChange/{id}', [OOCController::class, 'RejectoocStateChange'])->name('RejectStateChangeOOC');
Route::post('RejectStateChangeTwo/{id}', [OOCController::class, 'RejectStateChangeTwo'])->name('RejectStateChangeTwo');
Route::post('OOCChildRoot/{id}', [OOCController::class, 'OOCChildRoot'])->name('o_o_c_root_child');
Route::post('OOCChildCapa/{id}', [OOCController::class, 'oo_c_capa_child'])->name('oo_c_capa_child');
Route::post('OOCChildExtension/{id}', [OOCController::class, 'OOCChildExtension'])->name('OOCChildExtension');
Route::post('OOCChildAction/{id}', [OOCController::class, 'OOCChildAction'])->name('OOCChildAction');
Route::get('OOCAuditTrial/{id}', [OOCController::class, 'OOCAuditTrial'])->name('audittrialooc');
Route::get('auditDetailsooc/{id}', [OOCController::class, 'auditDetailsooc'])->name('OOCauditDetails');
Route::get('/rcms/ooc_Audit_Report/{id}', [OOCController::class, 'auditReportooc'])->name('ooc_Audit_Report');
Route::post('OOCAuditReview/{id}', [OOCController::class, 'OOCAuditReview'])->name('OOCAuditReview');






Route::get('out_of_calibration_ooc', [OOCController::class, 'ooc']);


// Route::get('oos_form', [OOSController::class, 'index'])->name('oos.index');
// Route::get('oos_micro', [OOSMicroController::class, 'index'])->name('oos_micro.index');



//============================================ OOS MICRO ROUTE CLOSE ===================================
// Route::view('market_complaint_new', 'frontend.market_complaint.market_complaint_new')->name('market_complaint_new');


// ====================OOS/OOT======================================
Route::view('oos_oot_form', 'frontend.forms.OOS\OOT.oos_oot');
// ====================OOS/OOT======================================



// =================LOGS=========================================

Route::view('change_control_log', 'frontend.forms.Logs.changeControlLog');
Route::view('market_complaint_log', 'frontend.forms.Logs.Market-Complaint-registerLog');
Route::view('incident_log', 'frontend.forms.Logs.incidentLog');
Route::view('risk_management_log', 'frontend.forms.Logs.riskmanagementLog');
Route::view('errata_log', 'frontend.forms.Logs.errata_log');
Route::view('laboratory_log', 'frontend.forms.Logs.laboratoryIncidentLog');
Route::view('capa_log', 'frontend.forms.Logs.capa_log');
Route::view('non_conformance_log', 'frontend.forms.Logs.non_conformance_log');
Route::view('deviation_log', 'frontend.forms.Logs.deviation_log');
Route::view('OOC_log', 'frontend.forms.Logs.OOC_log');
Route::view('OOS_OOT_log', 'frontend.forms.Logs.OOS_OOT_log');
Route::view('Failure_invst_log', 'frontend.forms.Logs.Failure_investigation_Log');
Route::view('internal_audit_log', 'frontend.forms.Logs.Internal_audit_Log');

// =================LOGS=========================================




// ====================OOS/OOT======================================
Route::view('oos_oot_form', 'frontend.forms.OOS\OOT.oos_oot');
// ====================OOS/OOT======================================



/**
 * AJAX ROUTES
 */

Route::get('/sop/users/{id?}', [AjaxController::class, 'getSopTrainingUsers'])->name('sop_training_users');

// ========================Errata==================================
// Route::view('errata_new', 'frontend.errata.errata_new')->name('errata_new');
Route::view('errata_view', 'frontend.errata.errata_view');

// <<<<<<< HEAD

// ================EMPLOYEE & TRAINER===================
Route::get('employee_new', [EmployeeController::class, 'createEmp'])->name('employee_new');
Route::post('/tms/employee', [EmployeeController::class, 'store'])->name('employee.store');
Route::post('/tms/trainer', [TrainerController::class, 'store'])->name('trainer.store');
Route::post('/tms/employee/{id}', [EmployeeController::class, 'update'])->name('employee.update');
Route::post('/tms/trainer/{id}', [TrainerController::class, 'update'])->name('trainer.update');
Route::get('employee_view/{id}', [EmployeeController::class, 'show'])->name('employee.show');
Route::get('trainer_qualification_view/{id}', [TrainerController::class, 'show'])->name('trainer_qualification.show');
Route::post('/tms/employee/sendstage/{id}', [EmployeeController::class, 'sendStage']);
Route::post('/tms/trainer/sendstage/{id}', [TrainerController::class, 'sendStage']);
Route::post('/tms/trainer/rejectStage/{id}', [TrainerController::class, 'rejectStage']);
Route::get('/getEmployeeDetails/{id}', [TrainerController::class, 'getEmployeeDetails']);

Route::get('/fetch-questionss/{documentId}', [TrainerController::class, 'fetchQuestionss']);
// Route::get('/training-questions/{id}', [TrainerController::class, 'trainingQuestion']);
Route::post('/save-answers', [TrainerController::class, 'saveAnswers']);
Route::get('/get-questions/{documentId}', [TrainerController::class, 'getQuestions']);




//new one
Route::post('tms/induction/sendstage/{id}', [InductionTrainingcontroller::class, 'sendStage']);
Route::post('tms/induction/cancelstage/{id}', [InductionTrainingcontroller::class, 'cancelStage']);

// =======
Route::post('tni', [TNIController::class, 'store'])->name('tni.store');
Route::get('Tni_create', [TNIController::class, 'index'])->name('Tni_create');
// Route::get('Tni_view/{id}', [EmployeeController::class, 'show'])->name('employee.show');
// Route::post('/tms/employee/{id}', [TNIController::class, 'update'])->name('employee.update');
Route::view('Tni_view', 'frontend.TMS.TNI_TNA.Tni_view');

//=== 
Route::post('errata/create{id}', [ErrataController::class, 'create'])->name('errata.create');
Route::post('errata/store', [ErrataController::class, 'store'])->name('errata.store');
Route::get('errata/show/{id}', [ErrataController::class, 'show'])->name('errata.show');
// Route::get('errata/edit/{id}', [ErrataController::class, 'edit'])->name('errata.edit');
Route::put('errata/update/{id}', [Erratacontroller::class, 'update'])->name('errata.update');
Route::get('errataaudittrail/{id}', [ErrataController::class, 'AuditTrial'])->name('errata.audittrail');
Route::get('errataAuditInner/{id}', [ErrataController::class, 'auditDetailsErrata'])->name('errataauditdetails');
Route::post('/errata/cancel/{id}', [ErrataController::class, 'erratacancelstage'])->name('errata.cancel');
Route::get('errata_new', [ErrataController::class, 'index'])->name('errata_new');
Route::get('/errata/{id}',[Erratacontroller::class,'audit_trail_filter'])->name('api.ERRATA.filter');
// ----------------------Stages----------------------------------------

// extensionchild========================
// Route::view('extension_new', 'frontend.extension.extension_new');
// Route::view('extension_view', 'frontend.extension.extension_view');
Route::get('extension-new', [ExtensionNewController::class, 'index']);
Route::post('extension_new', [ExtensionNewController::class, 'store'])->name('extension_new.store');
Route::get('extension_newshow/{id}', [ExtensionNewController::class, 'show']);

Route::put('extension_new/{id}', [ExtensionNewController::class, 'update'])->name('extension_new.update');
Route::post('extension_send_stage/{id}', [ExtensionNewController::class, 'sendstage'])->name('extension_send_stage');
Route::post('extension_reject_stage/{id}', [ExtensionNewController::class, 'rejectStage'])->name('extension_reject_stage');
Route::post('moreinfoState_extension/{id}', [ExtensionNewController::class, 'moreinfoStateChange'])->name('moreinfoState_extension');
Route::post('RejectState_extension/{id}', [ExtensionNewController::class, 'reject'])->name('RejectState_extension');
Route::post('send-cqa/{id}', [ExtensionNewController::class, 'sendCQA'])->name('send-cqa');
Route::post('send-approved/{id}', [ExtensionNewController::class, 'sendApproved'])->name('send-approved');
Route::get('extension-filter-data/{id}', [ExtensionNewController::class, 'audit_trail_filter'])->name('extension-filter');
// Route::get('RejectState_extension/{id}', [ExtensionNewController::class, 'reject'])->name('RejectState_extension');



Route::get('trainer_qualification', [TrainerController::class, 'index'])->name('trainer_qualification');

//=====================================================================
// >>>>>>> B-backup

Route::post('RCAChildRoot/{id}', [RootCauseController::class, 'RCAChildRoot'])->name('R_C_A_root_child');

// =====================resampling========
Route::get('resampling-action-task-create', [ResamplingController::class, 'showAction']);
Route::get('resampling_view/{id}', [ResamplingController::class, 'show']);
Route::post('resampling' , [ResamplingController::class,'store'])->name('resampling_create');
Route::post('resampling-actionView/{id}' , [ResamplingController::class,'update'])->name('resampling-update');
Route::post('resapling-stage-cancel/{id}', [ResamplingController::class, 'resamplingStageCancel'])->name('resapling-stage-cancel');
Route::get('resampling-audittrialshow/{id}', [ResamplingController::class, 'resamplingAuditTrialShow'])->name('resampling-audittrialshow');
Route::post('send-resampling/{id}', [ResamplingController::class, 'stageChange'])->name('send-resampling');
Route::post('moreinfoState_resampling/{id}', [ResamplingController::class, 'resamplingmoreinfo'])->name('moreinfoState_resampling');


// ============================================
