<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use App\Models\Deviation;
use App\Models\Capa;
use App\Models\CC;
use App\Models\Observation;
use App\Models\errata;
use App\Models\FailureInvestigation;
use App\Models\lab_incidents_grid;
use App\Models\MarketComplaintGrids;
use App\Models\NonConformance;
use App\Models\OOS_micro;
use App\Models\LabIncident;
use App\Models\Ootc;
use App\Models\OOS;
use App\Models\MarketComplaint;
use App\Models\OutOfCalibration;
use App\Models\Incident;
use App\Models\RiskManagement;
use App\Models\InternalAudit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\ActionItem;
use App\Models\EffectivenessCheck;
use App\Models\AuditProgram;
use App\Models\extension_new;
use App\Models\Auditee;
use App\Models\ManagementReview;
use App\Models\Resampling;
use App\Models\RootCauseAnalysis;
use App\Models\ChangeProposalJust;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

class LogController extends Controller
{
    public function index($slug)
    {
        switch ($slug) {
            case 'capa':
                $capa = Capa::get();
                
                return view('frontend.forms.Logs.capa_log',compact('capa'));
                break;
            case 'deviation':
                $deviation = Deviation::get();
                // dd($deviation);
                return view('frontend.forms.Logs.deviation_log', compact('deviation'));
                break;

            case 'change-control':
                $ccontrol = CC::get();
                    
                   
                    return view('frontend.forms.Logs.ChangeControlLog',compact('ccontrol'));
                    break;

            case 'change-proposal-and-justification':

                $changeProposalJustification = ChangeProposalJust::get();
             
    
                return view('frontend.forms.Logs.changeProposalJustification',compact('changeProposalJustification'));   

                break;

                
            case 'errata':
                        $erratalog = errata::get();
                            
                           
                            return view('frontend.forms.Logs.errata_log',compact('erratalog'));
                            break;

             case 'observation':
                        $observations = Observation::get();
                        // dd($observations);
                            
                           
                            return view('frontend.forms.Logs.observationlogs',compact('observations'));
                            break;                
        
            case 'failure-investigation':
                        $failure = FailureInvestigation::get();
                                    
                                   
              return view('frontend.forms.Logs.failure_investigation_log',compact('failure'));
              break;        
            

                case 'lab-incident':
                
                    $labincident =LabIncident::with([
                        'incidentInvestigationReports',
                        'division'  
                    ])->get();
               
        
                
                                        
                    return view('frontend.forms.Logs.laboratoryIncidentLog',compact('labincident'));
                    break;        
                

            //  case 'market-complaint':
                
            //     $marketcomplaint = MarketComplaint::with('product_details')->get();
                
            //         return view('frontend.forms.Logs.Market-complaint-registerLog',compact('marketcomplaint'));
                        
            //         break;        
               
            
             case 'actionitem':
                    $actions = ActionItem::get();
                    //  dd($actions);
                    return view('frontend.forms.Logs.actionItemlogs', compact('actions'));
                break;

            case 'effectiveness-check':
                    $effectiveneses = EffectivenessCheck::get();
                    //  dd($effectiveneses);
                    return view('frontend.forms.Logs.effectivenesslogs', compact('effectiveneses'));
                break;   


            case 'extension':
                    $extension_news = extension_new::get();
                    //  dd($effectiveneses);
                     return view('frontend.forms.Logs.Extensionlogs', compact('extension_news'));
                break;  
                
            case 'external-audit':
                    $external_audits = Auditee::get();
                    //  dd($effectiveneses);
                     return view('frontend.forms.Logs.external_auditlogs', compact('external_audits'));
                break;   
    

            case 'managementreview':
                    $ManagementReviews = ManagementReview::get();
                    //  dd($ManagementReviews);
                      return view('frontend.forms.Logs.ManagementReviewlogs', compact('ManagementReviews'));
                break;   

            case 'auditprogram':
                    $AuditPrograms = AuditProgram::get();
                    
                    return view('frontend.forms.Logs.auditProgramlogs', compact('AuditPrograms'));
                break;

             case 'auditprogram':
                    $AuditPrograms = AuditProgram::get();
                    
                    return view('frontend.forms.Logs.auditProgramlogs', compact('AuditPrograms'));
                break;
    

            case 'market-complaint':
                    $marketcomplaint = MarketComplaint::with([
                        'product_details',
                        'division'   
                    ])->get();

                    return view('frontend.forms.Logs.Market-complaint-registerLog', compact('marketcomplaint'));
                break;

            case 'ooc':
            
                $oocs = OutOfCalibration::with('InstrumentDetails', 'assignedUser')->get();
                
                $users = User::all();
                
        
                    return view('frontend.forms.Logs.OOC_log' , compact('oocs','users'));
              
                                              
            case 'oos':
            
                // $oots =  OOS::get();

                $oots = OOS::get();
                // $oosmicro = OOS_micro::get();
            
                 // foreach($oots as $oo)
            // {
                // return $oo;

            //     $gridata=$oo->ProductGridOot;
            //     foreach ($gridata['data'] as $data) {
            //         $ootss=[];
            //         return[
            //             'item_product_code'=>$data['item_product_code']
            //         ];
            //     }
            // }
            
            // foreach($oots['data'] as $aaaa) {
            //     return $aaaa;
            // }
            
            
                
            // $oosmicro = OOS_micro::get();

            return view('frontend.forms.Logs.OOS_OOT_log' , compact('oots'));



            case 'resampling':

                
                $Resamplings = Resampling::get();
              
                

                 return view('frontend.forms.Logs.Resamplinglogs',compact('Resamplings'));

            case 'root-cause-analysis':

                
                $root_cause_analysises = RootCauseAnalysis::get();
              
            //   dd($root_cause_analysises);
                return view('frontend.forms.Logs.rootcauseanalysislogs',compact('root_cause_analysises'));



            case 'risk-management':

                
                $riskmanagements = RiskManagement::get();
            //  dd($riskmanagements);
                return view('frontend.forms.Logs.riskmanagementLog',compact('riskmanagements'));


             
            case 'internal-audit':
                $internal_audi = InternalAudit::get();
                
                return view('frontend.forms.Logs.Internal_audit_Log',compact('internal_audi'));
         
            case 'non-conformance':
                $nonconformance = NonConformance::get();

                return view('frontend.forms.Logs.non_conformance_log',compact('nonconformance'));
               
             case 'incident':
                // $Inc = Incident::with(['Grid' => function ($query) {
                //     $query->where('type','Product')->take(3);
                // }] )->take(3)->get();

               $Inc= Incident::get();
                
                // foreach($Inc as $ias)
                // foreach ($ias->Grid as $a)
                // return $a->product_name;
                return view('frontend.forms.Logs.incidentLog',compact('Inc'));
            return $slug;
                   
            default:

                break;
        }
    }

    public function print(Request $request, $slug)
    {
        $printData = $this->getPrintLogData(
            $slug,
            $request
        );

        if (!$printData) {
            abort(404, 'Invalid log type.');
        }

        return view(
            'frontend.forms.Logs.print-log',
            [
                'slug' => $slug,
                'title' => $printData['title'],
                'headers' => $printData['headers'],
                'rows' => $printData['rows'],
                'filters' => $printData['filters'] ?? [],
                'printedOn' => Carbon::now()->format(
                    'd-M-Y h:i A'
                ),
            ]
        );
    }

    private function getPrintLogData(string $slug, Request $request): ?array {

        switch ($slug) {

            /*
            |--------------------------------------------------------------------------
            | Change Control
            |--------------------------------------------------------------------------
            */

            case 'change-control':

            $query = CC::query();

            /*
            |--------------------------------------------------------------------------
            | Department filter
            |--------------------------------------------------------------------------
            */

            $departments = $request->input('department', []);

            if (is_string($departments)) {
                $departments = array_filter(
                    explode(',', $departments)
                );
            }

            if (!empty($departments)) {
                $query->whereIn(
                    'Initiator_Group',
                    $departments
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Division filter
            |--------------------------------------------------------------------------
            */

            if ($request->filled('division_id')) {
                $query->where(
                    'division_id',
                    $request->division_id
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Date filters
            |--------------------------------------------------------------------------
            */

            if ($request->filled('date_from')) {
                $query->whereDate(
                    'created_at',
                    '>=',
                    $request->date_from
                );
            }

            if ($request->filled('date_to')) {
                $query->whereDate(
                    'created_at',
                    '<=',
                    $request->date_to
                );
            }

            $records = $query->orderBy('id', 'Asc')->get();

            $rows = $records->values()->map(function ($record, $index) {

                    $divisionCode = !empty($record->division_id) ? \Helpers::divisionNameForQMS($record->division_id) : '';

                    $recordYear = !empty($record->created_at) ? \Carbon\Carbon::parse($record->created_at)->format('Y') : '';

                    $recordSequence = str_pad($record->record ?? $record->id, 4, '0', STR_PAD_LEFT);

                    $recordNumber = $divisionCode . '/CC/' . $recordYear . '/' . $recordSequence;

                    $description = $record->short_description ?? $record->Short_description ?? $record->description ?? 'Not Applicable';

                    $proposedChange = $record->proposed_change ?? $record->Proposed_Change ?? $record->proposed_changes ?? 'Not Applicable';

                    $natureOfChange = $record->doc_change ?? $record->doc_change ?? $record->doc_change ?? 'Not Applicable';

                    return [
                        'serial' => $index + 1,

                        'date_of_initiation' => !empty($record->created_at) ? \Carbon\Carbon::parse($record->created_at)->format('d-M-Y') : 'Not Applicable',

                        'record_number' => $recordNumber,

                        'division' => !empty($record->division_id) ? \Helpers::getDivisionName($record->division_id) : 'Not Applicable',

                        'department' => $record->Initiator_Group ?? $record->initiator_group ?? 'Not Applicable',

                        'initiator' => !empty($record->initiator_id) ? \Helpers::getInitiatorName($record->initiator_id) : 'Not Applicable',

                        'description' => strip_tags((string) $description),

                        'proposed_change' => strip_tags((string) $proposedChange),

                        'nature_of_change' => strip_tags((string) $natureOfChange),

                        'due_date' => !empty($record->due_date) ? \Helpers::getdateFormat( $record->due_date) : 'Not Applicable',

                        'status' => $record->status ?? 'Not Applicable',
                    ];
                });

            return [
                'title' => 'Change Control Log',

                'headers' => [
                    'serial' => 'Sr. No.',
                    'date_of_initiation' => 'Date of Initiation',
                    'record_number' => 'Change Control No.',
                    'division' => 'Division',
                    'department' => 'Department',
                    'initiator' => 'Initiator',
                    'description' => 'Description of Change Control',
                    'proposed_change' => 'Proposed Change',
                    'nature_of_change' => 'Nature of Change',
                    'due_date' => 'Due Date',
                    'status' => 'Status',
                ],

                'rows' => $rows,

                'filters' => [ 'Department' => !empty($departments) ? implode(', ', $departments) : 'All',

                    'Division' => $request->filled('division_id') ? \Helpers::getDivisionName( $request->division_id ) : 'All',

                    'Start Date' => $request->date_from ?: 'All',

                    'End Date' => $request->date_to ?: 'All',
                ],
            ];

            /*
            |--------------------------------------------------------------------------
            | CAPA
            |--------------------------------------------------------------------------
            */

            case 'capa':

            $query = Capa::query()->with(['division', 'initiator',]);

            /*
            |--------------------------------------------------------------------------
            | Department filter
            |--------------------------------------------------------------------------
            */

            $departments = $request->input('department', []);

            if (is_string($departments)) {
                $departments = array_filter(explode(',', $departments));
            }

            if (!empty($departments)) {
                $query->whereIn('initiator_Group', $departments);
            }

            /*
            |--------------------------------------------------------------------------
            | Division filter
            |--------------------------------------------------------------------------
            */

            if ($request->filled('division_id')) {
                $query->where('division_id', $request->division_id);
            }

            /*
            |--------------------------------------------------------------------------
            | Date filters
            |--------------------------------------------------------------------------
            */

            if ($request->filled('date_from')) {
                $query->whereDate('created_at', '>=', $request->date_from);
            }

            if ($request->filled('date_to')) {
                $query->whereDate('created_at', '<=', $request->date_to);
            }

            $records = $query->orderBy('id', 'Asc')->get();

            $rows = $records->values()->map(function ($record, $index) {

                    $recordYear = !empty($record->created_at) ? \Carbon\Carbon::parse($record->created_at)->format('Y') : date('Y');

                    $divisionName = $record->division->name ?? 'Null';

                    $recordNumber = $divisionName . '/CAPA/' . $recordYear . '/' . str_pad($record->record ?? 0, 4, '0', STR_PAD_LEFT);

                    return [
                        'serial' => $index + 1,

                        'date_of_initiation' => $record->intiation_date ?? '-',

                        'record_number' => $recordNumber,

                        'short_description' => strip_tags((string) ($record->short_description ?? '-' )),

                        'initiator' => $record->initiator->name ?? '-',

                        'department' => $record->initiator_Group ?? '-',

                        'division' => $record->division->name ?? '-',

                        'capa_type' => $record->capa_type ?? '-',

                        'parent_type' => $record->parent_type ?? '-',

                        'due_date' => !empty($record->due_date) ? \Carbon\Carbon::parse($record->due_date)->format('d-M-Y') : '-',

                        'status' => $record->status ?? '-',
                    ];
                });

            return [
                'title' =>'CAPA Log',

                'headers' => [
                    'serial' => 'Sr. No.',

                    'date_of_initiation' => 'Date of Initiation',

                    'record_number' => 'CAPA No.',

                    'short_description' => 'CAPA Description',

                    'initiator' => 'Initiator',

                    'department' => 'Department Name',

                    'division' => 'Division',

                    'capa_type' => 'Type of CAPA',

                    'parent_type' => 'Source Document No.',

                    'due_date' => 'Due Date',

                    'status' => 'Status',
                ],

                'rows' => $rows,

                'filters' => [
                    'Department' => !empty($departments) ? implode(', ', $departments) : 'All',

                    'Division' => $request->filled('division_id') ? \Helpers::getDivisionName($request->division_id) : 'All',

                    'Start Date' => $request->date_from ?: 'All',

                    'End Date' => $request->date_to ?: 'All',
                ],
            ];

            /*
            |--------------------------------------------------------------------------
            | Deviation
            |--------------------------------------------------------------------------
            */

            case 'deviation':

                $query = Deviation::query();

                if ($request->filled('department')) {
                    $query->where('Initiator_Group', $request->department);
                }

                if ($request->filled('division_id')) {
                    $query->where('division_id', $request->division_id);
                }

                if ($request->filled('date_from')) {
                    $query->whereDate('created_at', '>=', $request->date_from);
                }

                if ($request->filled('date_to')) {
                    $query->whereDate('created_at', '<=', $request->date_to);
                }

                $records = $query->with('division')->orderBy('id', 'Asc')->get();

                $rows = $records->map(function ($record, $index) {

                    $recordYear = !empty($record->created_at)
                        ? \Carbon\Carbon::parse(
                            $record->created_at
                        )->format('Y')
                        : date('Y');

                    $recordNumber =
                        ($record->division->name ?? '-')
                        . '/DEV/'
                        . $recordYear
                        . '/'
                        . str_pad(
                            $record->record,
                            4,
                            '0',
                            STR_PAD_LEFT
                        );

                    return [

                        'serial' => $index + 1,

                        'date_of_initiation' =>
                            $record->intiation_date,

                        'record_number' =>
                            $recordNumber,

                        'description' =>
                            $record->short_description,

                        'division' =>
                            $record->division->name ?? '-',

                        'department' =>
                            $record->Initiator_Group,

                        'category' =>
                            $record->Deviation_category
                            ?: 'NA',

                        'related_to' =>
                            $record->audit_type,

                        'due_date' =>
                            $record->due_date
                                ? \Carbon\Carbon::parse(
                                    $record->due_date
                                )->format('d-M-Y')
                                : 'NA',

                        'status' =>
                            $record->status,
                    ];

                });

                return [

                    'title' => 'Deviation Log',

                    'headers' => [

                        'serial' => 'Sr.No.',

                        'date_of_initiation' =>
                            'Date of Initiation',

                        'record_number' =>
                            'Deviation No.',

                        'description' =>
                            'Description of Deviation',

                        'division' =>
                            'Division',

                        'department' =>
                            'Department',

                        'category' =>
                            'Initial Deviation Category',

                        'related_to' =>
                            'Deviation Related To',

                        'due_date' =>
                            'Due Date',

                        'status' =>
                            'Status',

                    ],

                    'rows' => $rows,

                    'filters' => [

                        'Department' =>
                            $request->department ?: 'All',

                        'Division' =>
                            $request->filled('division_id')
                                ? \Helpers::getDivisionName(
                                    $request->division_id
                                )
                                : 'All',

                        'Start Date' =>
                            $request->date_from ?: 'All',

                        'End Date' =>
                            $request->date_to ?: 'All',

                    ],

                ];


                /*
                |--------------------------------------------------------------------------
                | Root Cause Analysis
                |--------------------------------------------------------------------------
                */

                case 'RootCauseAnalysis':

                    $query = RootCauseAnalysis::query()->with('division');

                    if ($request->filled('department')) {
                        $query->where('initiator_Group', $request->department);
                    }

                    if ($request->filled('division_id')) {
                        $query->where('division_id', $request->division_id);
                    }

                    if ($request->filled('date_from')) {
                        $query->whereDate('created_at', '>=', $request->date_from);
                    }

                    if ($request->filled('date_to')) {
                        $query->whereDate('created_at', '<=', $request->date_to);
                    }

                    $records = $query->orderBy('id', 'Asc')->get();

                    $rows = $records->values()->map(function ($record, $index) {

                        $recordYear = !empty($record->intiation_date) ? \Carbon\Carbon::parse($record->intiation_date)->format('Y') : date('Y');

                        $recordSequence = str_pad($record->record ?? 0, 4, '0', STR_PAD_LEFT);

                        $divisionName = !empty($record->division_id) ? \Helpers::getDivisionName($record->division_id) : '-';

                        $recordNumber = $divisionName . '/RCA/' . $recordYear . '/' . $recordSequence;

                        /*
                        |--------------------------------------------------------------------------
                        | Dates
                        |--------------------------------------------------------------------------
                        */

                        $initiationDate = !empty($record->intiation_date) ? \Carbon\Carbon::parse($record->intiation_date)->format('d-M-Y') : 'NA';

                        $dueDate = !empty($record->due_date) ? \Carbon\Carbon::parse($record->due_date)->format('d-M-Y') : 'NA';

                        return [

                            'serial' => $index + 1,

                            'date_of_initiation' => $initiationDate,

                            'rca_number' => $recordNumber,

                            'division' => $divisionName,

                            'originator' => !empty($record->initiator_id) ? \Helpers::getInitiatorName($record->initiator_id) : 'Not Available',

                            'department' => $record->initiator_Group ?? '-',

                            'short_description' => strip_tags((string)($record->short_description ?? '-')),

                            'assign_to' => !empty($record->assign_to) ? \Helpers::getInitiatorName($record->assign_to) : '-',

                            'qa_reviewer' => !empty($record->qa_reviewer) ? \Helpers::getInitiatorName($record->qa_reviewer) : '-',

                            'due_date' => $dueDate,

                            'initiated_through' => $record->initiated_through ?? '-',

                            'department_name' => $record->department ?? '-',

                            'status' => $record->status ?? '-',

                        ];
                    });

                    return [

                        'title' => 'RootCauseAnalysis',

                        'headers' => [

                            'serial' => 'Sr. No.',

                            'date_of_initiation' => 'Date of Initiation',

                            'rca_number' => 'Record Number',

                            'division' => 'Site/Location Code',

                            'originator' => 'Initiator',

                            'department' => 'Initiator Department',

                            'short_description' => 'Short Description',

                            'assign_to' => 'Name of Responsible Department Head',

                            'qa_reviewer' => 'QA Reviewer',

                            'due_date' => 'Due Date',

                            'initiated_through' => 'Initiated Through',

                            'department_name' => 'Responsible Department',

                            'status' => 'Status',

                        ],

                        'rows' => $rows,

                        'filters' => [

                            'Department' => $request->department ?: 'All',

                            'Division' => $request->filled('division_id') ? \Helpers::getDivisionName($request->division_id) : 'All',

                            'Start Date' => $request->date_from ?: 'All',

                            'End Date' => $request->date_to ?: 'All',

                        ],
                    ];


            /*
            |--------------------------------------------------------------------------
            | OOS
            |--------------------------------------------------------------------------
            */

            case 'OOS_OOT':

                $query = OOS::query()->with('division');

                if ($request->filled('department')) {
                    $query->where('initiator_group', $request->department);
                }

                if ($request->filled('division_id')) {
                    $query->where('division_id', $request->division_id);
                }

                if ($request->filled('date_from')) {
                    $query->whereDate('created_at', '>=', $request->date_from);
                }

                if ($request->filled('date_to')) {
                    $query->whereDate('created_at', '<=', $request->date_to);
                }

                $records = $query->orderBy('id', 'Asc')->get();

                $rows = $records->values()->map(function ($record, $index) {

                    /*
                    |--------------------------------------------------------------------------
                    | OOS Number
                    |--------------------------------------------------------------------------
                    */

                    $recordYear = !empty($record->created_at) ? \Carbon\Carbon::parse($record->created_at)->format('Y') : date('Y');

                    $recordSequence = str_pad($record->record_number ?? 1, 4, '0', STR_PAD_LEFT );

                    $divisionName = !empty($record->division_id) ? \Helpers::getDivisionName($record->division_id) : '-';

                    $recordNumber = $divisionName . '/' . ($record->Form_type ?? 'OOS') . '/' . $recordYear . '/' . $recordSequence;

                    /*
                    |--------------------------------------------------------------------------
                    | Dates
                    |--------------------------------------------------------------------------
                    */

                    $initiationDate = !empty($record->intiation_date) ? \Carbon\Carbon::parse($record->intiation_date)->format('d-M-Y') : 'NA';

                    $dueDate = !empty($record->due_date) ? \Carbon\Carbon::parse($record->due_date)->format('d-M-Y') : 'NA';

                    $finalApprovalDate = !empty($record->Final_Approval_on) ? \Carbon\Carbon::parse($record->Final_Approval_on)->format('d-M-Y') : 'NA';

                    return [

                        'serial' => $index + 1,

                        'date_of_initiation' => $initiationDate,

                        'oos_number' => $recordNumber,

                        'description' => strip_tags((string)($record->description_gi ?? '-')),

                        'source_document_type' => $record->source_document_type_gi ?? 'Not Available',

                        'product_material_name' => $record->product_material_name_gi ?? '-',

                        'due_date' => $dueDate,

                        'final_approval_date' => $finalApprovalDate,

                        'status' => $record->status ?? '-',

                    ];
                });

                return [

                    'title' => 'OOS Log',

                    'headers' => [

                        'serial' => 'Sr. No.',

                        'date_of_initiation' => 'Date of Initiation',

                        'oos_number' => 'Record No.',

                        'description' => 'Short Description',

                        'source_document_type' => 'Type of Document',

                        'product_material_name' => 'Product / Material Name',

                        'due_date' => 'Due Date',

                        'final_approval_date' => 'Closure Date',

                        'status' => 'Status',

                    ],

                    'rows' => $rows,

                    'filters' => [

                        'Department' => $request->department ?: 'All',

                        'Division' => $request->filled('division_id') ? \Helpers::getDivisionName($request->division_id) : 'All',

                        'Start Date' => $request->date_from ?: 'All',

                        'End Date' => $request->date_to ?: 'All',

                    ],
                ];



            /*
            |--------------------------------------------------------------------------
            | Market Complaint
            |--------------------------------------------------------------------------
            */

                case 'MarketComplaint':

                    $query = MarketComplaint::query()->with(['division', 'product_details']);

                    if ($request->filled('department')) {
                        $query->where('initiator_group', $request->department);
                    }

                    if ($request->filled('division_id')) {
                        $query->where('division_id', $request->division_id);
                    }

                    if ($request->filled('date_from')) {
                        $query->whereDate('created_at', '>=', $request->date_from);
                    }

                    if ($request->filled('date_to')) {
                        $query->whereDate('created_at', '<=', $request->date_to);
                    }

                    $records = $query->orderByDesc('id')->get();

                    $rows = collect();
                    $serial = 1;

                    foreach ($records as $record) {

                        /*
                        |--------------------------------------------------------------------------
                        | Record Number
                        |--------------------------------------------------------------------------
                        */

                        $recordYear = !empty($record->intiation_date) ? \Carbon\Carbon::parse($record->intiation_date)->format('Y') : date('Y');

                        $recordSequence = str_pad($record->record ?? 0, 4, '0', STR_PAD_LEFT);

                        $divisionName = $record->division->name ?? '-';

                        $recordNumber = $divisionName . '/MC/' . $recordYear . '/' . $recordSequence;

                        /*
                        |--------------------------------------------------------------------------
                        | Dates
                        |--------------------------------------------------------------------------
                        */

                        $initiationDate = !empty($record->intiation_date) ? \Carbon\Carbon::parse($record->intiation_date)->format('d-M-Y') : 'NA';

                        $dueDate = !empty($record->due_date_gi) ? \Carbon\Carbon::parse($record->due_date_gi)->format('d-M-Y') : 'NA';

                        /*
                        |--------------------------------------------------------------------------
                        | Product Details Grid
                        |--------------------------------------------------------------------------
                        */

                        foreach ($record->product_details as $grid) {

                            $gridData = is_array($grid->data) ? $grid->data : [];

                            foreach ($gridData as $data) {

                                $rows->push([

                                    'serial' => $serial++,

                                    'date_of_initiation' => $initiationDate,

                                    'market_complaint_no' => $recordNumber,

                                    'originator' => \Helpers::getInitiatorName($record->initiator_id) ?? '-',

                                    'department' => $record->initiator_group ?? '-',

                                    'division' => $divisionName,

                                    'complaint_category' => $record->categorization_of_complaint_gi ?? '-',

                                    'due_date' => $dueDate,

                                    'status' => $record->status ?? '-',

                                ]);
                            }
                        }
                    }

                    return [

                        'title' => 'Market Complaint Log',

                        'headers' => [

                            'serial' => 'Sr. No.',

                            'date_of_initiation' => 'Date of Initiation',

                            'market_complaint_no' => 'Complaint No.',

                            'originator' => 'Originator',

                            'department' => 'Department',

                            'division' => 'Division',

                            'complaint_category' => 'Category of complaint',

                            'due_date' => 'Due Date',

                            'status' => 'Status',
                        ],

                        'rows' => $rows,

                        'filters' => [

                            'Department' => $request->department ?: 'All',

                            'Division' => $request->filled('division_id') ? \Helpers::getDivisionName($request->division_id) : 'All',

                            'Start Date' => $request->date_from ?: 'All',

                            'End Date' => $request->date_to ?: 'All',
                        ],
                    ];



            /*
            |--------------------------------------------------------------------------
            | Out Of Calibration
            |--------------------------------------------------------------------------
            */

                case 'OutOfCalibration':

                    $query = OutOfCalibration::query()->with(['division', 'initiator']);

                    if ($request->filled('department')) {
                        $query->where('Initiator_Group', $request->department);
                    }

                    if ($request->filled('division_id')) {
                        $query->where('division_id', $request->division_id);
                    }

                    if ($request->filled('date_from')) {
                        $query->whereDate('created_at', '>=', $request->date_from);
                    }

                    if ($request->filled('date_to')) {
                        $query->whereDate('created_at', '<=', $request->date_to);
                    }

                    $records = $query->orderBy('id', 'Asc')->get();

                    $rows = $records->values()->map(function ($record, $index) {

                        /*
                        |--------------------------------------------------------------------------
                        | OOC Number
                        |--------------------------------------------------------------------------
                        */

                        $recordYear = !empty($record->intiation_date) ? \Carbon\Carbon::parse($record->intiation_date)->format('Y') : date('Y');

                        $recordSequence = str_pad($record->record ?? 0, 4, '0', STR_PAD_LEFT );

                        $divisionName = !empty($record->division_id) ? \Helpers::getDivisionName($record->division_id) : '-';

                        $recordNumber = $divisionName . '/OOC/' . $recordYear . '/' . $recordSequence;

                        /*
                        |--------------------------------------------------------------------------
                        | Dates
                        |--------------------------------------------------------------------------
                        */

                        $initiationDate = !empty($record->intiation_date) ? \Carbon\Carbon::parse($record->intiation_date)->format('d-M-Y') : 'NA';

                        $dueDate = !empty($record->ooc_due_date) ? \Carbon\Carbon::parse($record->ooc_due_date)->format('d-M-Y') : 'Not Applicable';

                        return [

                            'serial' => $index + 1,

                            'date_of_initiation' => $initiationDate,

                            'ooc_number' => $recordNumber,

                            'division' => $divisionName,

                            'description' => strip_tags((string)($record->description_ooc ?? 'Not Available')),

                            'originator' => $record->initiator->name ?? '-',

                            'department' => $record->Initiator_Group ?? '-',

                            'assign_to' => !empty($record->assign_to) ? \Helpers::getInitiatorName($record->assign_to) : '-',

                            'qa_assign_person' => !empty($record->qa_assign_person) ? \Helpers::getInitiatorName($record->qa_assign_person) : '-',

                            'due_date' => $dueDate,

                            'status' => $record->status ?? '-',

                        ];
                    });

                    return [

                        'title' => 'Out Of Calibration Log',

                        'headers' => [

                            'serial' => 'Sr. No.',

                            'date_of_initiation' => 'Date of Initiation',

                            'ooc_number' => 'Record Number',

                            'division' => 'Site/Location Code',

                            'description' => 'Short Description',

                            'originator' => 'Originator',

                            'department' => 'Department',

                            'assign_to' => 'HOD Person',

                            'qa_assign_person' => 'QA Person',

                            'due_date' => 'Due Date',

                            'status' => 'Status',

                        ],

                        'rows' => $rows,

                        'filters' => [

                            'Department' => $request->department ?: 'All',

                            'Division' => $request->filled('division_id') ? \Helpers::getDivisionName($request->division_id) : 'All',

                            'Start Date' => $request->date_from ?: 'All',

                            'End Date' => $request->date_to ?: 'All',

                        ],
                    ];

                /*
                |--------------------------------------------------------------------------
                | Observation
                |--------------------------------------------------------------------------
                */

                    case 'Observation':

                        $query = Observation::query();

                        if ($request->filled('department')) {
                            $query->where('initiator_group', $request->department);
                        }

                        if ($request->filled('division_id')) {
                            $query->where('division_code', $request->division_id);
                        }

                        if ($request->filled('date_from')) {
                            $query->whereDate('created_at', '>=', $request->date_from);
                        }

                        if ($request->filled('date_to')) {
                            $query->whereDate('created_at', '<=', $request->date_to);
                        }

                        $records = $query->orderBy('id', 'Asc')->get();

                        $rows = $records->values()->map(function ($record, $index) {

                            /*
                            |--------------------------------------------------------------------------
                            | Observation Number
                            |--------------------------------------------------------------------------
                            */

                            $recordYear = !empty($record->intiation_date) ? \Carbon\Carbon::parse($record->intiation_date)->format('Y') : date('Y');

                            $recordSequence = str_pad($record->record ?? 0, 4, '0', STR_PAD_LEFT);

                            $divisionName = !empty($record->division_code) ? \Helpers::getDivisionName($record->division_code) : '-';

                            $recordNumber = $divisionName . '/OBS/' . $recordYear . '/' . $recordSequence;

                            /*
                            |--------------------------------------------------------------------------
                            | Dates
                            |--------------------------------------------------------------------------
                            */

                            $initiationDate = !empty($record->intiation_date) ? \Carbon\Carbon::parse($record->intiation_date)->format('d-M-Y') : 'NA';

                            $dueDate = !empty($record->due_date) ? \Carbon\Carbon::parse($record->due_date)->format('d-M-Y') : 'NA';

                            $recommendationDueDate = !empty($record->recomendation_capa_date_due) ? \Carbon\Carbon::parse($record->recomendation_capa_date_due)->format('d-M-Y') : 'NA';

                            return [

                                'serial' => $index + 1,

                                'date_of_initiation' => $initiationDate,

                                'observation_no' => $recordNumber,

                                'division' => $divisionName,

                                'originator' => !empty($record->initiator_id) ? \Helpers::getInitiatorName($record->initiator_id) : 'Not Available',

                                'assign_to' => !empty($record->assign_to) ? \Helpers::getInitiatorName($record->assign_to) : '-',

                                'due_date' => $dueDate,

                                'short_description' => strip_tags((string)($record->short_description ?? '-')),

                                'recommendation_capa_due_date' => $recommendationDueDate,

                                'status' => $record->status ?? '-',
                            ];
                        });

                        return [

                            'title' => 'Observation Log',

                            'headers' => [

                                'serial' => 'Sr. No.',

                                'date_of_initiation' => 'Date of Initiation',

                                'observation_no' => 'Record Number',

                                'division' => 'Site/Location Code',

                                'originator' => 'Initiator',

                                'assign_to' => 'Auditee Department Head',

                                'due_date' => 'Observation Report Due Date',

                                'short_description' => 'Short Description',

                                'recommendation_capa_due_date' => 'Response Due Date',

                                'status' => 'Status',
                            ],

                            'rows' => $rows,

                            'filters' => [

                                'Department' => $request->department ?: 'All',

                                'Division' => $request->filled('division_id')
                                    ? \Helpers::getDivisionName($request->division_id)
                                    : 'All',

                                'Start Date' => $request->date_from ?: 'All',

                                'End Date' => $request->date_to ?: 'All',
                            ],
                        ];
                /*
                |--------------------------------------------------------------------------
                | Resampling
                |--------------------------------------------------------------------------
                */

                    case 'Resampling':

                        $query = Resampling::query()->with('division');

                        if ($request->filled('department')) {
                            $query->where('departments', $request->department);
                        }

                        if ($request->filled('division_id')) {
                            $query->where('division_id', $request->division_id);
                        }

                        if ($request->filled('date_from')) {
                            $query->whereDate('created_at', '>=', $request->date_from);
                        }

                        if ($request->filled('date_to')) {
                            $query->whereDate('created_at', '<=', $request->date_to);
                        }

                        $records = $query->orderBy('id', 'Asc')->get();

                        $rows = $records->values()->map(function ($record, $index) {

                            $recordYear = !empty($record->intiation_date) ? \Carbon\Carbon::parse($record->intiation_date)->format('Y') : date('Y');

                            $recordSequence = str_pad($record->record ?? 0, 4, '0', STR_PAD_LEFT);

                            $divisionName = !empty($record->division_id) ? \Helpers::getDivisionName($record->division_id) : '-';

                            $recordNumber = $divisionName . '/Resampling/' . $recordYear . '/' . $recordSequence;

                            $initiationDate = !empty($record->intiation_date) ? \Carbon\Carbon::parse($record->intiation_date)->format('d-M-Y') : 'NA';

                            $dueDate = !empty($record->due_date) ? \Carbon\Carbon::parse($record->due_date)->format('d-M-Y') : 'NA';

                            return [

                                'serial' => $index + 1,

                                'date_of_initiation' => $initiationDate,

                                'resampling_no' => $recordNumber,

                                'division' => $divisionName,

                                'originator' => !empty($record->initiator_id) ? \Helpers::getInitiatorName($record->initiator_id) : 'Not Available',

                                'assign_to' => !empty($record->assign_to) ? \Helpers::getInitiatorName($record->assign_to) : '-',

                                'due_date' => $dueDate,

                                'short_description' => strip_tags((string)($record->short_description ?? '-')),

                                'hod_person' => !empty($record->hod_preson) ? \Helpers::getInitiatorName($record->hod_preson) : '-',

                                'department' => !empty($record->departments) ? \Helpers::getFullDepartmentName($record->departments) : '-',

                                'status' => $record->status ?? '-',

                            ];
                        });

                        return [

                            'title' => 'Resampling Log',

                            'headers' => [

                                'serial' => 'Sr. No.',

                                'date_of_initiation' => 'Date of Initiation',

                                'resampling_no' => 'Record Number',

                                'division' => 'Site/Location Code',

                                'originator' => 'Initiator',

                                'assign_to' => 'Assign To',

                                'due_date' => 'Due Date',

                                'short_description' => 'Short Description',

                                'hod_person' => 'HOD Person',

                                'department' => 'Responsible Department',

                                'status' => 'Status',
                            ],

                            'rows' => $rows,

                            'filters' => [

                                'Department' => $request->department ?: 'All',

                                'Division' => $request->filled('division_id') ? \Helpers::getDivisionName($request->division_id) : 'All',

                                'Start Date' => $request->date_from ?: 'All',

                                'End Date' => $request->date_to ?: 'All',
                            ],
                        ];

            /*
            |--------------------------------------------------------------------------
            | Management Review
            |--------------------------------------------------------------------------
            */

                case 'ManagementReview':

                    $query = ManagementReview::query()->with('division');

                    if ($request->filled('department')) {
                        $query->where('initiator_Group', $request->department);
                    }

                    if ($request->filled('division_id')) {
                        $query->where('division_id', $request->division_id);
                    }

                    if ($request->filled('date_from')) {
                        $query->whereDate('created_at', '>=', $request->date_from);
                    }

                    if ($request->filled('date_to')) {
                        $query->whereDate('created_at', '<=', $request->date_to);
                    }

                    $records = $query->orderBy('id', 'Asc')->get();

                    $rows = $records->values()->map(function ($record, $index) {

                        /*
                        |--------------------------------------------------------------------------
                        | Management Review Number
                        |--------------------------------------------------------------------------
                        */

                        $recordYear = !empty($record->intiation_date) ? \Carbon\Carbon::parse($record->intiation_date)->format('Y') : date('Y');

                        $recordSequence = str_pad($record->record ?? 0, 4, '0', STR_PAD_LEFT);

                        $divisionName = !empty($record->division_id) ? \Helpers::getDivisionName($record->division_id) : '-';

                        $recordNumber = $divisionName . '/MR/' . $recordYear . '/' . $recordSequence;

                        /*
                        |--------------------------------------------------------------------------
                        | Dates
                        |--------------------------------------------------------------------------
                        */

                        $initiationDate = !empty($record->intiation_date) ? \Carbon\Carbon::parse($record->intiation_date)->format('d-M-Y') : 'NA';

                        $startDate = !empty($record->start_date) ? \Carbon\Carbon::parse($record->start_date)->format('d-M-Y') : 'NA';

                        /*
                        |--------------------------------------------------------------------------
                        | Initiator
                        |--------------------------------------------------------------------------
                        */

                        $initiator = !empty($record->initiator_id) ? \Helpers::getInitiatorName($record->initiator_id) : 'Not Available';

                        return [

                            'serial' => $index + 1,

                            'date_of_initiation' => $initiationDate,

                            'management_review_no' => $recordNumber,

                            'division' => $divisionName,

                            'originator' => $initiator,

                            'department' => $record->initiator_Group ?? '-',

                            'short_description' => strip_tags((string)($record->short_description ?? '-')),

                            'summary_recommendation' => $record->summary_recommendation ?? '-',

                            'review_period_monthly' => $record->review_period_monthly ?? '-',

                            'start_date' => $startDate,

                            'status' => $record->status ?? '-',
                        ];
                    });

                    return [

                        'title' => 'Management Review Log',

                        'headers' => [

                            'serial' => 'Sr. No.',

                            'date_of_initiation' => 'Date of Initiation',

                            'management_review_no' => 'Record Number',

                            'division' => 'Site/Location Code',

                            'originator' => 'Initiator',

                            'department' => 'Initiator Department',

                            'short_description' => 'Short Description',

                            'summary_recommendation' => 'Type',

                            'review_period_monthly' => 'Review Period',

                            'start_date' => 'Proposed Scheduled Start Date',

                            'status' => 'Status',
                        ],

                        'rows' => $rows,

                        'filters' => [

                            'Department' => $request->department ?: 'All',

                            'Division' => $request->filled('division_id') ? \Helpers::getDivisionName($request->division_id) : 'All',

                            'Start Date' => $request->date_from ?: 'All',

                            'End Date' => $request->date_to ?: 'All',
                        ],
                    ];
                            
           /*
            |--------------------------------------------------------------------------
            | Audit Program
            |--------------------------------------------------------------------------
            */

            case 'AuditProgram':

                $query = AuditProgram::query()->with('division');

                if ($request->filled('department')) {
                    $query->where('Initiator_Group', $request->department);
                }

                if ($request->filled('division_id')) {
                    $query->where('division_id', $request->division_id);
                }

                if ($request->filled('date_from')) {
                    $query->whereDate('created_at', '>=', $request->date_from);
                }

                if ($request->filled('date_to')) {
                    $query->whereDate('created_at', '<=', $request->date_to);
                }

                $records = $query->orderBy('id', 'Asc')->get();

                $rows = $records->values()->map(function ($record, $index) {

                    /*
                    |--------------------------------------------------------------------------
                    | Audit Program Number
                    |--------------------------------------------------------------------------
                    */

                    $recordYear = !empty($record->intiation_date) ? \Carbon\Carbon::parse($record->intiation_date)->format('Y') : date('Y');

                    $recordSequence = str_pad($record->record ?? 0, 4, '0', STR_PAD_LEFT);

                    $divisionCode = $record->division_code ?? '-';

                    $recordNumber = $divisionCode . '/AP/' . $recordYear . '/' . $recordSequence;

                    /*
                    |--------------------------------------------------------------------------
                    | Division Name
                    |--------------------------------------------------------------------------
                    */

                    $divisionName = !empty($record->division_id) ? \Helpers::getDivisionName($record->division_id) : '-';

                    /*
                    |--------------------------------------------------------------------------
                    | Initiator
                    |--------------------------------------------------------------------------
                    */

                    $initiator = !empty($record->initiator_id) ? \Helpers::getInitiatorName($record->initiator_id) : 'Not Available';

                    /*
                    |--------------------------------------------------------------------------
                    | Initiation Date
                    |--------------------------------------------------------------------------
                    */

                    $initiationDate = !empty($record->intiation_date) ? \Carbon\Carbon::parse($record->intiation_date)->format('d-M-Y') : 'NA';

                    return [

                        'serial' => $index + 1,

                        'date_of_initiation' => $initiationDate,

                        'audit_program_no' => $recordNumber,

                        'division' => $divisionName,

                        'originator' => $initiator,

                        'department' => $record->Initiator_Group ?? '-',

                        'short_description' => strip_tags((string)($record->short_description ?? '-')),

                        'assign_to' => $record->assign_to ?? '-',

                        'assign_to_department' => $record->assign_to_department ?? '-',

                        'type' => $record->type ?? '-',

                        'year' => $record->year ?? '-',

                        'related_url' => $record->related_url ?? '-',

                        'status' => $record->status ?? '-',
                    ];
                });

                return [

                    'title' => 'Audit Program Log',

                    'headers' => [

                        'serial' => 'Sr. No.',

                        'date_of_initiation' => 'Date of Initiation',

                        'audit_program_no' => 'Audit Program No.',

                        'division' => 'Division',

                        'originator' => 'Originator',

                        'department' => 'Department',

                        'short_description' => 'Short Description',

                        'assign_to' => 'Assign To',

                        'assign_to_department' => 'Assign To Department',

                        'type' => 'Type',

                        'year' => 'Year',

                        'related_url' => 'Related URL',

                        'status' => 'Status',
                    ],

                    'rows' => $rows,

                    'filters' => [

                        'Department' => $request->department ?: 'All',

                        'Division' => $request->filled('division_id') ? \Helpers::getDivisionName($request->division_id) : 'All',

                        'Start Date' => $request->date_from ?: 'All',

                        'End Date' => $request->date_to ?: 'All',
                    ],
                ];

            /*
            |--------------------------------------------------------------------------
            | Internal Audit
            |--------------------------------------------------------------------------
            */

            case 'InternalAudit':

                $query = InternalAudit::query()
                    ->with(['division', 'initiator']);

                if ($request->filled('department')) {
                    $query->where('Initiator_Group', $request->department);
                }

                if ($request->filled('division_id')) {
                    $query->where('division_id', $request->division_id);
                }

                if ($request->filled('date_from')) {
                    $query->whereDate('created_at', '>=', $request->date_from);
                }

                if ($request->filled('date_to')) {
                    $query->whereDate('created_at', '<=', $request->date_to);
                }

                $records = $query->orderBy('id', 'Asc')->get();

                $rows = $records->values()->map(function ($record, $index) {

                    /*
                    |--------------------------------------------------------------------------
                    | Internal Audit Number
                    |--------------------------------------------------------------------------
                    */

                    $recordYear = !empty($record->created_at) ? \Carbon\Carbon::parse($record->created_at)->format('Y') : date('Y');

                    $recordSequence = str_pad($record->record ?? 0, 4, '0', STR_PAD_LEFT);

                    $divisionName = $record->division->name ?? '-';

                    $recordNumber = $divisionName . '/IA/' . $recordYear . '/' . $recordSequence;

                    /*
                    |--------------------------------------------------------------------------
                    | Dates
                    |--------------------------------------------------------------------------
                    */

                    $initiationDate = !empty($record->intiation_date) ? \Carbon\Carbon::parse($record->intiation_date)->format('d-M-Y') : 'NA';

                    $dueDate = !empty($record->due_date) ? \Carbon\Carbon::parse($record->due_date)->format('d-M-Y') : 'NA';

                    /*
                    |--------------------------------------------------------------------------
                    | Initiator
                    |--------------------------------------------------------------------------
                    */

                    $initiator = $record->initiator->name ?? '-';

                    return [

                        'serial' => $index + 1,

                        'date_of_initiation' => $initiationDate,

                        'internal_audit_no' => $recordNumber,

                        'originator' => $initiator,

                        'short_description' => strip_tags(
                            (string)($record->short_description ?? '-')
                        ),

                        'audit_category' => $record->Audit_Category ?? 'NA',

                        'department' => $record->Initiator_Group ?? '-',

                        'division' => $divisionName,

                        'due_date' => $dueDate,

                        'audit_lead_more_info_reqd_on' => $record->audit_lead_more_info_reqd_on ?? 'NA',

                        'status' => $record->status ?? '-',
                    ];
                });

                return [

                    'title' => 'Internal Audit Log',

                    'headers' => [

                        'serial' => 'Sr. No.',

                        'date_of_initiation' => 'Date of Initiation',

                        'internal_audit_no' => 'Record Number',

                        'originator' => 'Initiator',

                        'short_description' => 'Short Description',

                        'audit_category' => 'Audit Category',

                        'department' => 'Initiator Department',

                        'division' => 'Site/Location Code',

                        'due_date' => 'Due Date',

                       
                        'status' => 'Status',
                    ],

                    'rows' => $rows,

                    'filters' => [

                        'Department' => $request->department ?: 'All',

                        'Division' => $request->filled('division_id') ? \Helpers::getDivisionName($request->division_id) : 'All',

                        'Start Date' => $request->date_from ?: 'All',

                        'End Date' => $request->date_to ?: 'All',
                    ],
                ];



         /*
        |--------------------------------------------------------------------------
        | External Audit
        |--------------------------------------------------------------------------
        */

        case 'ExternalAudit':

            $query = Auditee::query()->with('division');

            if ($request->filled('department')) {
                $query->where('Initiator_Group', $request->department);
            }

            if ($request->filled('division_id')) {
                $query->where('division_id', $request->division_id);
            }

            if ($request->filled('date_from')) {
                $query->whereDate('created_at', '>=', $request->date_from);
            }

            if ($request->filled('date_to')) {
                $query->whereDate('created_at', '<=', $request->date_to);
            }

            $records = $query->orderBy('id', 'Asc')->get();

            $rows = $records->values()->map(function ($record, $index) {

                /*
                |--------------------------------------------------------------------------
                | External Audit Number
                |--------------------------------------------------------------------------
                */

                    $recordYear = !empty($record->intiation_date) ? \Carbon\Carbon::parse($record->intiation_date)->format('Y') : date('Y');

                    $recordSequence = str_pad($record->record ?? 0, 4, '0', STR_PAD_LEFT);

                    $divisionName = !empty($record->division_id) ? \Helpers::getDivisionName($record->division_id) : '-';

                    $recordNumber = $divisionName . '/EA/' . $recordYear . '/' . $recordSequence;

                    /*
                    |--------------------------------------------------------------------------
                    | Dates
                    |--------------------------------------------------------------------------
                    */

                    $initiationDate = !empty($record->intiation_date) ? \Carbon\Carbon::parse($record->intiation_date)->format('d-M-Y') : 'NA';

                    $dueDate = !empty($record->due_date) ? \Carbon\Carbon::parse($record->due_date)->format('d-M-Y') : 'NA';

                    $startDate = !empty($record->start_date_gi) ? \Carbon\Carbon::parse($record->start_date_gi)->format('d-M-Y') : 'NA';

                    $endDate = !empty($record->end_date_gi) ? \Carbon\Carbon::parse($record->end_date_gi)->format('d-M-Y') : 'NA';

                    /*
                    |--------------------------------------------------------------------------
                    | Initiator
                    |--------------------------------------------------------------------------
                    */

                    $initiator = !empty($record->initiator_id) ? \Helpers::getInitiatorName($record->initiator_id) : 'Not Available';

                    return [

                        'serial' => $index + 1,

                        'date_of_initiation' => $initiationDate,

                        'external_audit_no' => $recordNumber,

                        'division' => $divisionName,

                        'originator' => $initiator,

                        'department' => $record->Initiator_Group ?? 'Not Available',

                        'due_date' => $dueDate,

                        'short_description' => strip_tags((string)($record->short_description ?? '-')),

                        'initiated_through' => $record->initiated_through ?? '-',

                        'audit_type' => $record->audit_type ?? '-',

                        'external_agencies' => $record->external_agencies ?? '-',

                        'start_date' => $startDate,

                        'end_date' => $endDate,

                        'status' => $record->status ?? '-',
                    ];
                });

                return [

                    'title' => 'External Audit Log',

                    'headers' => [

                        'serial' => 'Sr. No.',

                        'date_of_initiation' => 'Date of Initiation',

                        'external_audit_no' => 'External Audit No.',

                        'division' => 'Division',

                        'originator' => 'Originator',

                        'department' => 'Department',

                        'due_date' => 'Due Date',

                        'short_description' => 'Short Description',

                        'initiated_through' => 'Initiated Through',

                        'audit_type' => 'Audit Type',

                        'external_agencies' => 'External Agencies',

                        'start_date' => 'Start Date',

                        'end_date' => 'End Date',

                        'status' => 'Status',
                    ],

                    'rows' => $rows,

                    'filters' => [

                        'Department' => $request->department ?: 'All',

                        'Division' => $request->filled('division_id') ? \Helpers::getDivisionName($request->division_id) : 'All',

                        'Start Date' => $request->date_from ?: 'All',

                        'End Date' => $request->date_to ?: 'All',
                    ],
                ];
            /*
            |--------------------------------------------------------------------------
            | Incident
            |--------------------------------------------------------------------------
            */

            case 'incident':

                $query = Incident::query()->with('division');

                if ($request->filled('department')) {
                    $query->where('Initiator_Group', $request->department);
                }

                if ($request->filled('division_id')) {
                    $query->where('division_id', $request->division_id);
                }

                if ($request->filled('date_from')) {
                    $query->whereDate('created_at', '>=', $request->date_from);
                }

                if ($request->filled('date_to')) {
                    $query->whereDate('created_at', '<=', $request->date_to);
                }

                $records = $query->orderBy('id', 'Asc')->get();

                $rows = $records->values()->map(function ($record, $index) {

                        /*
                        |--------------------------------------------------------------------------
                        | Incident Record Number
                        |--------------------------------------------------------------------------
                        */

                        $recordYear = !empty($record->created_at) ? \Carbon\Carbon::parse($record->created_at)->format('Y') : date('Y');

                        $recordSequence = str_pad($record->record ?? 0, 4, '0', STR_PAD_LEFT);

                        $divisionName = $record->division->name ?? '-';

                        $recordNumber = $divisionName . '/INC/' . $recordYear . '/' . $recordSequence;

                        /*
                        |--------------------------------------------------------------------------
                        | Remaining fields
                        |--------------------------------------------------------------------------
                        */

                        $initiator = !empty($record->initiator_id) ? \Helpers::getInitiatorName($record->initiator_id) : 'Not Available';

                        $dueDate = !empty($record->due_date) ? \Helpers::getdateFormat($record->due_date) : '-';

                        return [
                            'serial' => $index + 1,

                            'date_of_initiation' => $record->intiation_date ?? 'Not Available',

                            'record_number' => $recordNumber,

                            'originator' => $initiator,

                            'department' => $record->Initiator_Group ?? 'Not Available',

                            'division' => $divisionName,

                            'short_description' =>
                                strip_tags((string) ($record->short_description ?? 'Not Available')),

                            'incident_related_to' =>
                                $record->audit_type
                                ?? 'Not Available',

                            'due_date' =>
                                $dueDate,

                            'status' =>
                                $record->status
                                ?? 'Not Available',
                        ];
                    });

                return [
                    'title' =>
                        'Incident Log',

                    'headers' => [
                        'serial' =>
                            'Sr. No.',

                        'date_of_initiation' =>
                            'Date of Initiation',

                        'record_number' =>
                            'Incident No.',

                        'originator' =>
                            'Originator',

                        'department' =>
                            'Department',

                        'division' =>
                            'Division',

                        'short_description' =>
                            'Short Description',

                        'incident_related_to' =>
                            'Incident Related To',

                        'due_date' =>
                            'Due Date',

                        'status' =>
                            'Status',
                    ],

                    'rows' =>
                        $rows,

                    'filters' => [
                        'Department' =>
                            $request->department
                            ?: 'All',

                        'Division' =>
                            $request->filled('division_id')
                                ? \Helpers::getDivisionName(
                                    $request->division_id
                                )
                                : 'All',

                        'Start Date' =>
                            $request->date_from
                            ?: 'All',

                        'End Date' =>
                            $request->date_to
                            ?: 'All',
                    ],
                ];


            /*
            |--------------------------------------------------------------------------
            | Change Proposal and Justification
            |--------------------------------------------------------------------------
            */

            case 'change-proposal-and-justification':

                $query = ChangeProposalJust::query();

                /*
                |--------------------------------------------------------------------------
                | Filters
                |--------------------------------------------------------------------------
                */

                if ($request->filled('department')) {
                    $query->where(
                        'department',
                        $request->department
                    );
                }

                if ($request->filled('division_id')) {
                    $query->where(
                        'division_id',
                        $request->division_id
                    );
                }

                if ($request->filled('date_from')) {
                    $query->whereDate(
                        'created_at',
                        '>=',
                        $request->date_from
                    );
                }

                if ($request->filled('date_to')) {
                    $query->whereDate(
                        'created_at',
                        '<=',
                        $request->date_to
                    );
                }

                $records = $query
                    ->orderBy('id', 'asc')
                    ->get();

                $rows = $records
                    ->values()
                    ->map(function ($record, $index) {

                        /*
                        |--------------------------------------------------------------------------
                        | Record number
                        |--------------------------------------------------------------------------
                        */

                        $recordYear = !empty($record->created_at)
                            ? \Carbon\Carbon::parse(
                                $record->created_at
                            )->format('Y')
                            : date('Y');

                        $recordSequence = str_pad(
                            $record->record ?? 0,
                            4,
                            '0',
                            STR_PAD_LEFT
                        );

                        $divisionCode =
                            $record->division_code
                            ?? '-';

                        $recordNumber =
                            $divisionCode
                            . '/CPJ/'
                            . $recordYear
                            . '/'
                            . $recordSequence;

                        /*
                        |--------------------------------------------------------------------------
                        | Basic fields
                        |--------------------------------------------------------------------------
                        */

                        $shortDescription =
                            $record->cpdescription
                            ?? $record->short_description
                            ?? $record->description
                            ?? 'Not Applicable';

                        $department =
                            $record->department
                            ?? $record->Initiator_Group
                            ?? $record->initiator_group
                            ?? 'Not Applicable';

                        /*
                        |--------------------------------------------------------------------------
                        | QA reviewer
                        |--------------------------------------------------------------------------
                        |
                        | Database me reviewer ka direct name stored hai:
                        | qa_cqa_Review_Complete_By = "Sonali Nehare"
                        |
                        | Isliye getInitiatorName() call nahi karna.
                        |
                        */

                        $qaReviewerName =
                            $record->qa_cqa_Review_Complete_By
                            ?? '-';

                        /*
                        * DD ke according date field me double underscore hai:
                        * qa_cqa__Review_Complete_On
                        */
                        $qaReviewerDate =
                            $record->qa_cqa__Review_Complete_On
                            ?? null;

                        $qaReviewer = $qaReviewerName;

                        if (
                            !empty($qaReviewerName) &&
                            $qaReviewerName !== '-' &&
                            !empty($qaReviewerDate)
                        ) {
                            try {
                                $formattedReviewerDate =
                                    \Carbon\Carbon::parse(
                                        $qaReviewerDate
                                    )->format('d-M-Y');

                                $qaReviewer =
                                    $qaReviewerName
                                    . ' ('
                                    . $formattedReviewerDate
                                    . ')';
                            } catch (\Throwable $exception) {
                                /*
                                * Date parse fail ho to name aur raw date show karenge.
                                */
                                $qaReviewer =
                                    $qaReviewerName
                                    . ' ('
                                    . $qaReviewerDate
                                    . ')';
                            }
                        }

                        return [
                            'serial' =>
                                $index + 1,

                            /*
                            * Screen Blade intiation_date use karti hai,
                            * created_at nahi.
                            */
                            'date_of_initiation' =>
                                !empty($record->intiation_date)
                                    ? \Carbon\Carbon::parse(
                                        $record->intiation_date
                                    )->format('d-M-Y')
                                    : 'NA',

                            'record_number' =>
                                $recordNumber,

                            'short_description' =>
                                strip_tags(
                                    (string) $shortDescription
                                ),

                            'initiator' =>
                                !empty($record->initiator_id)
                                    ? \Helpers::getInitiatorName(
                                        $record->initiator_id
                                    )
                                    : 'Not Available',

                            /*
                            * Screen par division_code dikh raha hai.
                            */
                            'division' =>
                                $divisionCode,

                            'department' =>
                                $department,

                            'due_date' =>
                                !empty($record->due_date)
                                    ? \Carbon\Carbon::parse(
                                        $record->due_date
                                    )->format('d-M-Y')
                                    : 'NA',

                            /*
                            * IMPORTANT:
                            * Header key bhi qa_reviewer hai,
                            * isliye row key exactly qa_reviewer hona chahiye.
                            */
                            'qa_reviewer' =>
                                $qaReviewer,

                            'status' =>
                                $record->status
                                ?? '-',
                        ];
                    });

                return [
                    'title' =>
                        'Change Proposal And Justification Log',

                    'headers' => [
                        'serial' =>
                            'Sr. No.',

                        'date_of_initiation' =>
                            'Date of Initiation',

                        'record_number' =>
                            'Record No.',

                        'short_description' =>
                            'Short Description',

                        'initiator' =>
                            'Initiator',

                        'division' =>
                            'Division',

                        'department' =>
                            'Department',

                        'due_date' =>
                            'Due Date',

                        'qa_reviewer' =>
                            'QA Reviewer',

                        'status' =>
                            'Status',
                    ],

                    'rows' =>
                        $rows,

                    'filters' => [
                        'Department' =>
                            $request->department
                            ?: 'All',

                        'Division' =>
                            $request->filled('division_id')
                                ? \Helpers::getDivisionName(
                                    $request->division_id
                                )
                                : 'All',

                        'Start Date' =>
                            $request->date_from
                            ?: 'All',

                        'End Date' =>
                            $request->date_to
                            ?: 'All',
                    ],
                ];
            /*
            |--------------------------------------------------------------------------
            | Observation
            |--------------------------------------------------------------------------
            */

            case 'observation':

                $records = Observation::orderBy(
                    'id',
                    'desc'
                )->get();

                return $this->prepareCommonPrintData(
                    'Observation Log',
                    $records,
                    'Observation'
                );


            /*
            |--------------------------------------------------------------------------
            | Errata
            |--------------------------------------------------------------------------
            */

            case 'errata':

                $query = errata::query();

                if ($request->filled('department')) {
                    $query->where(
                        'Initiator_Group',
                        $request->department
                    );
                }

                if ($request->filled('division_id')) {
                    $query->where(
                        'division_id',
                        $request->division_id
                    );
                }

                if ($request->filled('date_from')) {
                    $query->whereDate(
                        'created_at',
                        '>=',
                        $request->date_from
                    );
                }

                if ($request->filled('date_to')) {
                    $query->whereDate(
                        'created_at',
                        '<=',
                        $request->date_to
                    );
                }

                if ($request->filled('error_type')) {
                    $query->where(
                        'type_of_error',
                        $request->error_type
                    );
                }

                $records = $query
                    ->orderBy('id', 'Asc')
                    ->get();

                $rows = $records
                    ->values()
                    ->map(function ($record, $index) {

                        $recordYear = !empty($record->created_at)
                            ? \Carbon\Carbon::parse(
                                $record->created_at
                            )->format('Y')
                            : date('Y');

                        $divisionName = !empty($record->division_id)
                            ? \Helpers::getDivisionName(
                                $record->division_id
                            )
                            : '-';

                        $recordNumber =
                            $divisionName
                            . '/ERR/'
                            . $recordYear
                            . '/'
                            . str_pad(
                                $record->record ?? 0,
                                4,
                                '0',
                                STR_PAD_LEFT
                            );

                        $initiator = !empty($record->initiator_id)
                            ? \Helpers::getInitiatorName(
                                $record->initiator_id
                            )
                            : 'Not Available';

                        $departmentHeadId =
                            $record->department_head
                            ?? $record->department_head_id
                            ?? null;

                        $qaReviewerId =
                            $record->qa_reviewer
                            ?? $record->qa_reviewer_id
                            ?? null;

                        return [
                            'serial' =>
                                $index + 1,

                            'date_of_initiation' =>
                                !empty($record->intiation_date)
                                    ? \Helpers::getdateFormat(
                                        $record->intiation_date
                                    )
                                    : 'Not Available',

                            'record_number' =>
                                $recordNumber,

                            'short_description' =>
                                strip_tags(
                                    (string) (
                                        $record->short_description
                                        ?? 'Not Available'
                                    )
                                ),

                            'initiator' =>
                                $initiator,

                            'division' =>
                                $divisionName,

                            'department' =>
                                $record->Initiator_Group
                                ?? 'Not Available',

                            'type_of_error' =>
                                $record->type_of_error
                                ?? $record->error_type
                                ?? 'Not Available',

                            'department_head' =>
                                !empty($departmentHeadId)
                                    ? \Helpers::getInitiatorName(
                                        $departmentHeadId
                                    )
                                    : (
                                        $record->department_head_name
                                        ?? 'Not Available'
                                    ),

                            'qa_reviewer' =>
                                !empty($qaReviewerId)
                                    ? \Helpers::getInitiatorName(
                                        $qaReviewerId
                                    )
                                    : (
                                        $record->qa_reviewer_name
                                        ?? 'Not Available'
                                    ),

                            'status' =>
                                $record->status
                                ?? 'Not Available',
                        ];
                    });

                return [
                    'title' =>
                        'Errata Log',

                    'headers' => [
                        'serial' =>
                            'Sr. No.',

                        'date_of_initiation' =>
                            'Date of Initiation',

                        'record_number' =>
                            'Errata No.',

                        'short_description' =>
                            'Short Description',

                        'initiator' =>
                            'Initiator',

                        'division' =>
                            'Division',

                        'department' =>
                            'Department',

                        'type_of_error' =>
                            'Type of Error',

                        'department_head' =>
                            'Department Head',

                        'qa_reviewer' =>
                            'QA Reviewer',

                        'status' =>
                            'Status',
                    ],

                    'rows' =>
                        $rows,

                    'filters' => [
                        'Department' =>
                            $request->department
                            ?: 'All',

                        'Division' =>
                            $request->filled('division_id')
                                ? \Helpers::getDivisionName(
                                    $request->division_id
                                )
                                : 'All',

                        'Start Date' =>
                            $request->date_from
                            ?: 'All',

                        'End Date' =>
                            $request->date_to
                            ?: 'All',

                        'Type of Error' =>
                            $request->error_type
                            ?: 'All',
                    ],
                ];

            /*
            |--------------------------------------------------------------------------
            | Failure Investigation
            |--------------------------------------------------------------------------
            */

            case 'failure-investigation':

                $records = FailureInvestigation::orderBy(
                    'id',
                    'desc'
                )->get();

                return $this->prepareCommonPrintData(
                    'Failure Investigation Log',
                    $records,
                    'Failure Investigation'
                );


            /*
            |--------------------------------------------------------------------------
            | Laboratory Incident
            |--------------------------------------------------------------------------
            */

            case 'lab-incident':

                $query = LabIncident::query()
                    ->with('division');

                /*
                |--------------------------------------------------------------------------
                | Filters
                |--------------------------------------------------------------------------
                */

                if ($request->filled('department')) {
                    $query->where(
                        'initiator_Group',
                        $request->department
                    );
                }

                if ($request->filled('division_id')) {
                    $query->where(
                        'division_id',
                        $request->division_id
                    );
                }

                if ($request->filled('date_from')) {
                    $query->whereDate(
                        'created_at',
                        '>=',
                        $request->date_from
                    );
                }

                if ($request->filled('date_to')) {
                    $query->whereDate(
                        'created_at',
                        '<=',
                        $request->date_to
                    );
                }

                $records = $query
                    ->orderBy('id', 'Asc')
                    ->get();

                $rows = $records
                    ->values()
                    ->map(function ($record, $index) {

                        /*
                        |--------------------------------------------------------------------------
                        | Record number
                        |--------------------------------------------------------------------------
                        */

                        $recordYear = !empty($record->created_at)
                            ? \Carbon\Carbon::parse(
                                $record->created_at
                            )->format('Y')
                            : date('Y');

                        $divisionName = !empty($record->division_id)
                            ? \Helpers::getDivisionName(
                                $record->division_id
                            )
                            : '-';

                        $recordNumber =
                            $divisionName
                            . '/LI/'
                            . $recordYear
                            . '/'
                            . str_pad(
                                $record->record ?? 0,
                                4,
                                '0',
                                STR_PAD_LEFT
                            );

                        /*
                        |--------------------------------------------------------------------------
                        | Users
                        |--------------------------------------------------------------------------
                        */

                        $originator = !empty($record->initiator_id)
                            ? \Helpers::getInitiatorName(
                                $record->initiator_id
                            )
                            : 'Not Available';

                        $qcHead = !empty($record->investigator_qc)
                            ? \Helpers::getInitiatorName(
                                $record->investigator_qc
                            )
                            : '-';

                        $qaReviewer = !empty($record->qc_review_to)
                            ? \Helpers::getInitiatorName(
                                $record->qc_review_to
                            )
                            : '-';

                        return [
                            'serial' =>
                                $index + 1,

                            'date_of_initiation' =>
                                !empty($record->intiation_date)
                                    ? \Carbon\Carbon::parse(
                                        $record->intiation_date
                                    )->format('d-M-Y')
                                    : 'NA',

                            'record_number' =>
                                $recordNumber,

                            'originator' =>
                                $originator,

                            'division' =>
                                $divisionName,

                            'short_description' =>
                                strip_tags(
                                    (string) (
                                        $record->short_desc
                                        ?? '-'
                                    )
                                ),

                            'stage' =>
                                $record->stage_stage_gi
                                ?? '-',

                            'stability_condition' =>
                                $record->incident_stability_cond_gi
                                ?? '-',

                            'interval' =>
                                $record->incident_interval_others_gi
                                ?? '-',

                            'test' =>
                                $record->test_gi
                                ?? '-',

                            'date_of_analysis' =>
                                !empty($record->incident_date_analysis_gi)
                                    ? \Carbon\Carbon::parse(
                                        $record->incident_date_analysis_gi
                                    )->format('d-M-Y')
                                    : 'NA',

                            'specification_number' =>
                                $record->incident_specification_no_gi
                                ?? '-',

                            'stp_number' =>
                                $record->incident_stp_no_gi
                                ?? '-',

                            'qc_head' =>
                                $qcHead,

                            'qa_reviewer' =>
                                $qaReviewer,

                            'due_date' =>
                                !empty($record->due_date)
                                    ? \Carbon\Carbon::parse(
                                        $record->due_date
                                    )->format('d-M-Y')
                                    : 'NA',

                            'status' =>
                                $record->status
                                ?? '-',
                        ];
                    });

                return [
                    'title' =>
                        'Lab Incident Log',

                    'headers' => [
                        'serial' =>
                            'Sr. No.',

                        'date_of_initiation' =>
                            'Date of Initiation',

                        'record_number' =>
                            'Incident Report No.',

                        'originator' =>
                            'Originator',

                        'division' =>
                            'Division',

                        'short_description' =>
                            'Short Description',

                        'stage' =>
                            'Stage',

                        'stability_condition' =>
                            'Stability Condition (If Applicable)',

                        'interval' =>
                            'Interval (If Applicable)',

                        'test' =>
                            'Test',

                        'date_of_analysis' =>
                            'Date Of Analysis',

                        'specification_number' =>
                            'Specification Number',

                        'stp_number' =>
                            'STP Number',

                        'qc_head' =>
                            'QC Head/HOD Person',

                        'qa_reviewer' =>
                            'QA Reviewer',

                        'due_date' =>
                            'Due Date',

                        'status' =>
                            'Status',
                    ],

                    'rows' =>
                        $rows,

                    'filters' => [
                        'Department' =>
                            $request->department
                            ?: 'All',

                        'Division' =>
                            $request->filled('division_id')
                                ? \Helpers::getDivisionName(
                                    $request->division_id
                                )
                                : 'All',

                        'Start Date' =>
                            $request->date_from
                            ?: 'All',

                        'End Date' =>
                            $request->date_to
                            ?: 'All',
                    ],
                ];


            /*
            |--------------------------------------------------------------------------
            | Market Complaint
            |--------------------------------------------------------------------------
            */

            case 'market-complaint':

                $records = MarketComplaint::with([
                    'product_details',
                    'division',
                ])
                ->orderBy('id', 'Asc')
                ->get();

                return $this->prepareCommonPrintData(
                    'Market Complaint Log',
                    $records,
                    'Market Complaint'
                );


            /*
            |--------------------------------------------------------------------------
            | Action Item
            |--------------------------------------------------------------------------
            */

            case 'actionitem':

            $query = ActionItem::query();

            if ($request->filled('department')) {
                $query->where(
                    'Initiator_Group',
                    $request->department
                );
            }

            if ($request->filled('division_id')) {
                $query->where(
                    'division_id',
                    $request->division_id
                );
            }

            if ($request->filled('date_from')) {
                $query->whereDate(
                    'created_at',
                    '>=',
                    $request->date_from
                );
            }

            if ($request->filled('date_to')) {
                $query->whereDate(
                    'created_at',
                    '<=',
                    $request->date_to
                );
            }

            $records = $query->orderBy('id', 'Asc')->get();

            $rows = $records->values()->map(function ($record, $index) {

            $recordYear = !empty($record->created_at) ? \Carbon\Carbon::parse($record->created_at)->format('Y') : date('Y');

            $recordSequence = str_pad($record->record ?? 0, 4, '0', STR_PAD_LEFT );

            $divisionName = !empty($record->division_id) ? \Helpers::getDivisionName($record->division_id) : '-';

            $recordNumber = $divisionName . '/AI/' . $recordYear . '/' . $recordSequence;

                    $dateOfInitiation = !empty($record->created_at)
                        ? \Carbon\Carbon::parse(
                            $record->created_at
                        )->format('d-M-Y')
                        : 'Not Applicable';

                    $division = !empty($record->division_id)
                        ? \Helpers::getDivisionName(
                            $record->division_id
                        )
                        : 'Not Applicable';

                    $initiator = !empty($record->initiator_id)
                        ? \Helpers::getInitiatorName(
                            $record->initiator_id
                        )
                        : (
                            $record->initiator
                            ?? 'Not Applicable'
                        );

                    $assignedToId =
                        $record->assign_to
                        ?? $record->assigned_to
                        ?? null;

                    $assignedTo = !empty($assignedToId)
                        ? \Helpers::getInitiatorName(
                            $assignedToId
                        )
                        : 'Not Applicable';

                    $dueDate =
                        $record->due_date
                        ?? $record->Due_Date
                        ?? null;

                    $shortDescription =
                        $record->short_description
                        ?? $record->description
                        ?? 'Not Applicable';

                    $hodPersons =
                        $record->hod_preson
                        ?? $record->hod_preson
                        ?? $record->hod_preson
                        ?? 'Not Applicable';

                    $responsibleDepartment =
                        $record->departments
                        ?? $record->departments
                        ?? $record->department
                        ?? 'Not Applicable';

                    return [
                        'serial' => $index + 1,

                        'date_of_initiation' => $dateOfInitiation,

                        'record_number' => $recordNumber,

                        'site_location' => $division,

                        'initiator' => $initiator,

                        'assigned_to' => $assignedTo,

                        'due_date' =>
                            !empty($dueDate)
                                ? \Carbon\Carbon::parse(
                                    $dueDate
                                )->format('d-M-Y')
                                : 'Not Applicable',

                        'short_description' =>
                            strip_tags(
                                (string) $shortDescription
                            ),

                        'hod_persons' =>
                            $hodPersons,

                        'responsible_department' =>
                            $responsibleDepartment,

                        'status' =>
                            $record->status
                            ?? 'Not Applicable',
                    ];
                });

            return [
                'title' => 'Action Item Log',

                'headers' => [
                    'serial' =>
                        'Sr. No.',

                    'date_of_initiation' =>
                        'Date of Initiation',

                    'record_number' =>
                        'Record Number',

                    'site_location' =>
                        'Site/Location Code',

                    'initiator' =>
                        'Initiator',

                    'assigned_to' =>
                        'Assigned To',

                    'due_date' =>
                        'Due Date',

                    'short_description' =>
                        'Short Description',

                    'hod_persons' =>
                        'HOD Persons',

                    'responsible_department' =>
                        'Responsible Department',

                    'status' =>
                        'Status',
                ],

                'rows' => $rows,

                'filters' => [
                    'Department' =>
                        $request->department
                        ?: 'All',

                    'Division' =>
                        $request->filled('division_id')
                            ? \Helpers::getDivisionName(
                                $request->division_id
                            )
                            : 'All',

                    'Start Date' =>
                        $request->date_from
                        ?: 'All',

                    'End Date' =>
                        $request->date_to
                        ?: 'All',
                ],
            ];
            /*
            |--------------------------------------------------------------------------
            | Effectiveness Check
            |--------------------------------------------------------------------------
            */

            case 'effectiveness-check':

                $query = EffectivenessCheck::query();

                /*
                |--------------------------------------------------------------------------
                | Filters
                |--------------------------------------------------------------------------
                */

                if ($request->filled('department')) {
                    $query->where(
                        'Initiator_Group',
                        $request->department
                    );
                }

                if ($request->filled('division_id')) {
                    $query->where(
                        'division_id',
                        $request->division_id
                    );
                }

                if ($request->filled('date_from')) {
                    $query->whereDate(
                        'created_at',
                        '>=',
                        $request->date_from
                    );
                }

                if ($request->filled('date_to')) {
                    $query->whereDate(
                        'created_at',
                        '<=',
                        $request->date_to
                    );
                }

                $records = $query
                    ->orderBy('id', 'Asc')
                    ->get();

                $rows = $records
                    ->values()
                    ->map(function ($record, $index) {

                        /*
                        |--------------------------------------------------------------------------
                        | Record number
                        |--------------------------------------------------------------------------
                        */

                        $recordYear = !empty($record->created_at)
                            ? \Carbon\Carbon::parse(
                                $record->created_at
                            )->format('Y')
                            : date('Y');

                        $divisionName = !empty($record->division_id)
                            ? \Helpers::getDivisionName(
                                $record->division_id
                            )
                            : '-';

                        $recordNumber =
                            $divisionName
                            . '/EC/'
                            . $recordYear
                            . '/'
                            . str_pad(
                                $record->record ?? 0,
                                4,
                                '0',
                                STR_PAD_LEFT
                            );

                        /*
                        |--------------------------------------------------------------------------
                        | Users
                        |--------------------------------------------------------------------------
                        */

                        $initiator = !empty($record->initiator_id)
                            ? \Helpers::getInitiatorName(
                                $record->initiator_id
                            )
                            : 'Not Available';

                        $assignedTo = !empty($record->assign_to)
                            ? \Helpers::getInitiatorName(
                                $record->assign_to
                            )
                            : '-';

                        return [
                            'serial' =>
                                $index + 1,

                            'date_of_initiation' =>
                                !empty($record->intiation_date)
                                    ? \Carbon\Carbon::parse(
                                        $record->intiation_date
                                    )->format('d-M-Y')
                                    : 'NA',

                            'record_number' =>
                                $recordNumber,

                            'site_location' =>
                                $divisionName,

                            'initiator' =>
                                $initiator,

                            'assigned_to' =>
                                $assignedTo,

                            'due_date' =>
                                !empty($record->due_date)
                                    ? \Carbon\Carbon::parse(
                                        $record->due_date
                                    )->format('d-M-Y')
                                    : 'NA',

                            'short_description' =>
                                strip_tags(
                                    (string) (
                                        $record->short_description
                                        ?? '-'
                                    )
                                ),

                            'effectiveness_plan' =>
                                strip_tags(
                                    (string) (
                                        $record->Effectiveness_check_Plan
                                        ?? '-'
                                    )
                                ),

                            'status' =>
                                $record->status
                                ?? '-',
                        ];
                    });

                return [
                    'title' =>
                        'Effectiveness Check Log',

                    'headers' => [
                        'serial' =>
                            'Sr. No.',

                        'date_of_initiation' =>
                            'Date of Initiation',

                        'record_number' =>
                            'Record Number',

                        'site_location' =>
                            'Site/Location Code',

                        'initiator' =>
                            'Initiator',

                        'assigned_to' =>
                            'Assigned To',

                        'due_date' =>
                            'Due Date',

                        'short_description' =>
                            'Short Description',

                        'effectiveness_plan' =>
                            'Effectiveness Check Plan',

                        'status' =>
                            'Status',
                    ],

                    'rows' =>
                        $rows,

                    'filters' => [
                        'Department' =>
                            $request->department
                            ?: 'All',

                        'Division' =>
                            $request->filled('division_id')
                                ? \Helpers::getDivisionName(
                                    $request->division_id
                                )
                                : 'All',

                        'Start Date' =>
                            $request->date_from
                            ?: 'All',

                        'End Date' =>
                            $request->date_to
                            ?: 'All',
                    ],
                ];


            /*
            |--------------------------------------------------------------------------
            | Extension
            |--------------------------------------------------------------------------
            */

            case 'extension':

                $query = extension_new::query();

                /*
                |--------------------------------------------------------------------------
                | Filters
                |--------------------------------------------------------------------------
                */

                if ($request->filled('department')) {
                    $query->where(
                        'department',
                        $request->department
                    );
                }

                if ($request->filled('division_id')) {
                    $query->where(
                        'division_id',
                        $request->division_id
                    );
                }

                if ($request->filled('date_from')) {
                    $query->whereDate(
                        'created_at',
                        '>=',
                        $request->date_from
                    );
                }

                if ($request->filled('date_to')) {
                    $query->whereDate(
                        'created_at',
                        '<=',
                        $request->date_to
                    );
                }

                $records = $query
                    ->orderBy('id', 'Asc')
                    ->get();

                $rows = $records
                    ->values()
                    ->map(function ($record, $index) {

                        /*
                        |--------------------------------------------------------------------------
                        | Record number
                        |--------------------------------------------------------------------------
                        */

                        $recordYear = !empty($record->created_at)
                            ? \Carbon\Carbon::parse(
                                $record->created_at
                            )->format('Y')
                            : date('Y');

                        $divisionName = !empty($record->division_id)
                            ? \Helpers::getDivisionName(
                                $record->division_id
                            )
                            : '-';

                        $recordNumber =
                            $divisionName
                            . '/Ext/'
                            . $recordYear
                            . '/'
                            . str_pad(
                                $record->record ?? 0,
                                4,
                                '0',
                                STR_PAD_LEFT
                            );

                        /*
                        |--------------------------------------------------------------------------
                        | Users
                        |--------------------------------------------------------------------------
                        */

                        $initiator = !empty($record->initiator)
                            ? \Helpers::getInitiatorName(
                                $record->initiator
                            )
                            : 'Not Available';

                        $reviewer = !empty($record->reviewers)
                            ? \Helpers::getInitiatorName(
                                $record->reviewers
                            )
                            : '-';

                        $approver = !empty($record->approvers)
                            ? \Helpers::getInitiatorName(
                                $record->approvers
                            )
                            : '-';

                        return [
                            'serial' =>
                                $index + 1,

                            'date_of_initiation' =>
                                !empty($record->initiation_date)
                                    ? \Carbon\Carbon::parse(
                                        $record->initiation_date
                                    )->format('d-M-Y')
                                    : 'NA',

                            'record_number' =>
                                $recordNumber,

                            'site_location' =>
                                $divisionName,

                            'initiator' =>
                                $initiator,

                            'current_due_date' =>
                                !empty($record->current_due_date)
                                    ? \Carbon\Carbon::parse(
                                        $record->current_due_date
                                    )->format('d-M-Y')
                                    : 'NA',

                            'short_description' =>
                                strip_tags(
                                    (string) (
                                        $record->short_description
                                        ?? '-'
                                    )
                                ),

                            'extension_number' =>
                                $record->count
                                ?? '-',

                            'hod_review' =>
                                $reviewer,

                            'qa_approval' =>
                                $approver,

                            'status' =>
                                $record->status
                                ?? '-',
                        ];
                    });

                return [
                    'title' =>
                        'Extension Log',

                    'headers' => [
                        'serial' =>
                            'Sr. No.',

                        'date_of_initiation' =>
                            'Date of Initiation',

                        'record_number' =>
                            'Record Number',

                        'site_location' =>
                            'Site/Location Code',

                        'initiator' =>
                            'Initiator',

                        'current_due_date' =>
                            'Current Due Date (Parent)',

                        'short_description' =>
                            'Short Description',

                        'extension_number' =>
                            'Extension Number',

                        'hod_review' =>
                            'HOD Review',

                        'qa_approval' =>
                            'QA/CQA Approval',

                        'status' =>
                            'Status',
                    ],

                    'rows' =>
                        $rows,

                    'filters' => [
                        'Department' =>
                            $request->department
                            ?: 'All',

                        'Division' =>
                            $request->filled('division_id')
                                ? \Helpers::getDivisionName(
                                    $request->division_id
                                )
                                : 'All',

                        'Start Date' =>
                            $request->date_from
                            ?: 'All',

                        'End Date' =>
                            $request->date_to
                            ?: 'All',
                    ],
                ];


            /*
            |--------------------------------------------------------------------------
            | External Audit
            |--------------------------------------------------------------------------
            */

            case 'external-audit':

                $records = Auditee::orderBy(
                    'id',
                    'desc'
                )->get();

                return $this->prepareCommonPrintData(
                    'External Audit Log',
                    $records,
                    'External Audit'
                );


            /*
            |--------------------------------------------------------------------------
            | Management Review
            |--------------------------------------------------------------------------
            */

            case 'managementreview':

                $records = ManagementReview::orderBy(
                    'id',
                    'desc'
                )->get();

                return $this->prepareCommonPrintData(
                    'Management Review Log',
                    $records,
                    'Management Review'
                );


            /*
            |--------------------------------------------------------------------------
            | Audit Program
            |--------------------------------------------------------------------------
            */

            case 'auditprogram':

                $records = AuditProgram::orderBy(
                    'id',
                    'desc'
                )->get();

                return $this->prepareCommonPrintData(
                    'Audit Program Log',
                    $records,
                    'Audit Program'
                );


            /*
            |--------------------------------------------------------------------------
            | Out of Calibration
            |--------------------------------------------------------------------------
            */

            case 'ooc':

                $records = OutOfCalibration::with([
                    'InstrumentDetails',
                    'assignedUser',
                ])
                ->orderBy('id', 'Asc')
                ->get();

                return $this->prepareCommonPrintData(
                    'Out of Calibration Log',
                    $records,
                    'Out of Calibration'
                );


            /*
            |--------------------------------------------------------------------------
            | OOS / OOT
            |--------------------------------------------------------------------------
            */

            case 'oos':

                $records = OOS::orderBy(
                    'id',
                    'desc'
                )->get();

                return $this->prepareCommonPrintData(
                    'OOS / OOT Log',
                    $records,
                    'OOS'
                );


            /*
            |--------------------------------------------------------------------------
            | Resampling
            |--------------------------------------------------------------------------
            */

            case 'resampling':

                $records = Resampling::orderBy(
                    'id',
                    'desc'
                )->get();

                return $this->prepareCommonPrintData(
                    'Resampling Log',
                    $records,
                    'Resampling'
                );


            /*
            |--------------------------------------------------------------------------
            | Root Cause Analysis
            |--------------------------------------------------------------------------
            */

            case 'root-cause-analysis':

                $records = RootCauseAnalysis::orderBy(
                    'id',
                    'desc'
                )->get();

                return $this->prepareCommonPrintData(
                    'Root Cause Analysis Log',
                    $records,
                    'Root Cause Analysis'
                );


            /*
            |--------------------------------------------------------------------------
            | Risk Management
            |--------------------------------------------------------------------------
            */

            case 'risk-management':

                $query = RiskManagement::query();

                if ($request->filled('department')) {
                    $query->where(
                        'Initiator_Group',
                        $request->department
                    );
                }

                if ($request->filled('division_id')) {
                    $query->where(
                        'division_id',
                        $request->division_id
                    );
                }

                if ($request->filled('date_from')) {
                    $query->whereDate(
                        'created_at',
                        '>=',
                        $request->date_from
                    );
                }

                if ($request->filled('date_to')) {
                    $query->whereDate(
                        'created_at',
                        '<=',
                        $request->date_to
                    );
                }

                $records = $query
                    ->orderBy('id', 'Asc')
                    ->get();

                $rows = $records->values()->map(function ($record, $index) {

                    /*
                    |--------------------------------------------------------------------------
                    | Record Number
                    |--------------------------------------------------------------------------
                    */

                    $recordYear = !empty($record->created_at)
                        ? \Carbon\Carbon::parse(
                            $record->created_at
                        )->format('Y')
                        : date('Y');

                    $recordNumber =
                        ($record->division_code ?? '-')
                        . '/RA/'
                        . $recordYear
                        . '/'
                        . str_pad(
                            $record->record,
                            4,
                            '0',
                            STR_PAD_LEFT
                        );

                    return [

                        'serial' =>
                            $index + 1,

                        'date_of_initiation' =>
                            \Helpers::getdateFormat(
                                $record->intiation_date
                            ),

                        'record_number' =>
                            $recordNumber,

                        'short_description' =>
                            strip_tags(
                                $record->short_description
                            ),

                        'originator' =>
                            \Helpers::getInitiatorName(
                                $record->initiator_id
                            ) ?? 'Not Available',

                        'department' =>
                            $record->Initiator_Group,

                        'division' =>
                            $record->division_id
                                ? \Helpers::getDivisionName(
                                    $record->division_id
                                )
                                : '-',

                        'source_of_risk' =>
                            $record->source_of_risk,

                        'type' =>
                            $record->type,

                        'priority_level' =>
                            $record->priority_level,

                        'status' =>
                            $record->status,
                    ];

                });

                return [

                    'title' =>
                        'Risk Management Log',

                    'headers' => [

                        'serial' =>
                            'Sr.No.',

                        'date_of_initiation' =>
                            'Date of Initiation',

                        'record_number' =>
                            'Quality Risk Assessment No.',

                        'short_description' =>
                            'Short Description',

                        'originator' =>
                            'Originator',

                        'department' =>
                            'Initiator Department',

                        'division' =>
                            'Division',

                        'source_of_risk' =>
                            'Source of Risk / Opportunity',

                        'type' =>
                            'Type',

                        'priority_level' =>
                            'Priority Level',

                        'status' =>
                            'Status',

                    ],

                    'rows' =>
                        $rows,

                    'filters' => [

                        'Department' =>
                            $request->department ?: 'All',

                        'Division' =>
                            $request->filled('division_id')
                                ? \Helpers::getDivisionName(
                                    $request->division_id
                                )
                                : 'All',

                        'Start Date' =>
                            $request->date_from ?: 'All',

                        'End Date' =>
                            $request->date_to ?: 'All',

                    ],

                ];


            /*
            |--------------------------------------------------------------------------
            | Internal Audit
            |--------------------------------------------------------------------------
            */

            case 'internal-audit':

                $records = InternalAudit::orderBy(
                    'id',
                    'desc'
                )->get();

                return $this->prepareCommonPrintData(
                    'Internal Audit Log',
                    $records,
                    'Internal Audit'
                );


            /*
            |--------------------------------------------------------------------------
            | Non-Conformance
            |--------------------------------------------------------------------------
            */

            case 'non-conformance':

                $records = NonConformance::orderBy(
                    'id',
                    'desc'
                )->get();

                return $this->prepareCommonPrintData(
                    'Non-Conformance Log',
                    $records,
                    'Non-Conformance'
                );

            default:
                return null;
        }
    }

    private function prepareCommonPrintData(string $title, $records, string $recordType): array {

        $rows = collect($records)
            ->values()
            ->map(function ($record, $index) use (
                $recordType
            ) {

                /*
                * Different models me field names different hain,
                * isliye available field ko priority order se read kar rahe hain.
                */

                $recordNumber =
                    $record->record_number
                    ?? $record->record_no
                    ?? $record->record
                    ?? $record->id;

                $initiatorId =
                    $record->initiator_id
                    ?? $record->initiator
                    ?? null;

                $description =
                    $record->short_description
                    ?? $record->description
                    ?? $record->Description
                    ?? $record->title
                    ?? 'Not Applicable';

                $department =
                    $record->Initiator_Group
                    ?? $record->initiator_group
                    ?? $record->department
                    ?? 'Not Applicable';

                $divisionId =
                    $record->division_id
                    ?? null;

                $dueDate =
                    $record->due_date
                    ?? $record->Due_Date
                    ?? null;

                return [
                    'serial' => $index + 1,

                    'date_of_initiation' =>
                        !empty($record->created_at)
                            ? Carbon::parse(
                                $record->created_at
                            )->format('d-M-Y')
                            : 'Not Applicable',

                    'record_number' =>
                        $recordNumber,

                    'division' =>
                        !empty($divisionId)
                            ? \Helpers::getDivisionName(
                                $divisionId
                            )
                            : 'Not Applicable',

                    'department' =>
                        $department,

                    'initiator' =>
                        !empty($initiatorId)
                            ? \Helpers::getInitiatorName(
                                $initiatorId
                            )
                            : 'Not Applicable',

                    'description' =>
                        strip_tags((string) $description),

                    'due_date' =>
                        !empty($dueDate)
                            ? \Helpers::getdateFormat(
                                $dueDate
                            )
                            : 'Not Applicable',

                    'status' =>
                        $record->status
                        ?? 'Not Applicable',
                ];
            });

        return [
            'title' => $title,

            'headers' => [
                'serial' => 'Sr. No.',
                'date_of_initiation' =>
                    'Date of Initiation',
                'record_number' =>
                    'Record Number',
                'division' =>
                    'Division',
                'department' =>
                    'Department',
                'initiator' =>
                    'Initiator',
                'description' =>
                    'Description',
                'due_date' =>
                    'Due Date',
                'status' =>
                    'Status',
            ],

            'rows' => $rows,

            'filters' => [],
        ];
    }
}
