<?php

namespace App\Http\Controllers;

use App\Imports\DocumentsImport;
use App\Models\Annexure;
use App\Models\Department;
use App\Models\Division;
use App\Models\Document;
use App\Models\DocumentContent;

use App\Models\DocumentGrid;
use App\Models\DocumentGridData;
use App\Models\specifications;

//use App\Models\ContentsDocument;
use App\Models\DocumentHistory;
//use App\Models\ContentsDocument;
use App\Models\DocumentLanguage;
use App\Models\DocumentSubtype;
use App\Models\DocumentTraining;
use App\Models\DocumentType;
//use App\Models\DocumentTraningInformation;
use App\Models\DownloadControl;
use App\Models\DownloadHistory;
use App\Models\Grouppermission;
use App\Models\Keyword;
use App\Models\OpenStage;
use App\Models\TDSDocumentGrid;
use App\Models\PrintControl;
use App\Models\PrintHistory;
use App\Models\Process;
use App\Models\QMSDivision;
use App\Models\QMSProcess;
use App\Models\RoleGroup;
use App\Models\SetDivision;
use App\Models\Stage;
use App\Models\StageManage;
use App\Models\User;
use App\Services\DocumentService;
use Carbon\Carbon;
use Clegginabox\PDFMerger\PDFMerger;
use Dompdf\Dompdf;
use Dompdf\Options;
use Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Mpdf\Mpdf;
use PDF;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function division(Request $request)
    {


        $new = new SetDivision;
        $new->division_id = $request->division_id;



        $new->process_id = $request->process_id;
        $new->user_id = Auth::user()->id;
        $new->save();
        //return redirect()->route('documents.create');
        $id = $request->process_id;
        return redirect()->route('documents.create', compact('id'));
    }
    public function division_old(Request $request)
    {
        $new = new Document;
        $new->originator_id = $request->originator_id;
        $new->division_id = $request->division_id;

        $new->process_id = $request->process_id;
        $new->record = $request->record;
        $new->revised = $request->revised;
        $new->revised_doc = $request->revised_doc;
        $new->document_name = $request->document_name;
        $new->short_description = $request->short_description;
        $new->due_dateDoc = $request->due_dateDoc;
        $new->sop_type = $request->sop_type;
        $new->sop_type_short = $request->sop_type_short;
        $new->description = $request->description;
        $new->notify_to = json_encode($request->notify_to);
        $new->reference_record = $request->reference_record;
        $new->department_id = $request->department_id;
        $new->document_type_id = $request->document_type_id;
        $new->document_subtype_id = $request->document_subtype_id;
        $new->document_language_id = $request->document_language_id;
        $new->keywords = $request->keywords;
        $new->effective_date = $request->effective_date;
        $new->next_review_date = $request->next_review_date;
        $new->review_period = $request->review_period;
        $new->attach_draft_doocument = $request->attach_draft_doocument;
        $new->attach_effective_docuement = $request->attach_effective_docuement;
        $new->reviewers = $request->reviewers;
        $new->approvers = $request->approvers;
        $new->reviewers_group = $request->reviewers_group;
        $new->approver_group = $request->approver_group;
        $new->revision_summary = $request->revision_summary;
        $new->revision_type = $request->revision_type;
        $new->major = $request->major;
        $new->minor = $request->minor;
        $new->stage = $request->stage;
        $new->status = $request->status;
        $new->document = $request->document;
        $new->revision = $request->revision;
        $new->revision_policy = $request->revision_policy;
        $new->training_required = $request->training_required;
        $new->trainer = $request->trainer;
        $new->comments = $request->comments;

        $new->user_id = Auth::user()->id;
        $new->save();

        return redirect()->route('documents.create');
    }

    public function dcrDivision()
    {
        return redirect()->route('change-control.create');
    }
    public function index(Request $request)
    {
        $query = Document::join('users', 'documents.originator_id', 'users.id')
            // ->join('document_types', 'documents.document_type_id', 'document_types.id')
            ->join('divisions', 'documents.division_id', 'divisions.id')
            ->select('documents.*', 'users.name as originator_name', 'divisions.name as division_name')
            ->orderByDesc('documents.id');

        // Apply filters
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        if ($request->has('document_type_id')) {
            $query->where('document_type_id', $request->document_type_id);
        }
        if ($request->has('division_id')) {
            $query->where('division_id', $request->division_id);
        }
        if ($request->has('originator_id')) {
            $query->where('originator_id', $request->originator_id);
        }
        $count = $query->where('documents.originator_id', Auth::user()->id)->count();
        $documents = $query->paginate(10);

        // dd($request->all(), $query->paginate(10));
        $divisions = QMSDivision::where('status', '1')->select('id', 'name')->get();
        // $divisions = QMSDivision::where('status', '1')->select('id', 'name')->get();
        $documentValues = Document::withoutTrashed()->select('id', 'document_type_id')->get();
        $documentTypeIds = $documentValues->pluck('document_type_id')->unique()->toArray();
        $documentTypes = DocumentType::whereIn('id', $documentTypeIds)->select('id', 'name')->get();

        $documentStatus = Document::withoutTrashed()->select('id', 'status')->get();
        $documentStatusIds = $documentValues->pluck('document_type_id')->unique()->toArray();
        // dd($documentStatus);

        $OriValues = Document::withoutTrashed()->select('id', 'originator_id')->get();
        $OriTypeIds = $OriValues->pluck('originator_id')->unique()->toArray();
        $originator = User::whereIn('id', $OriTypeIds)->select('id', 'name')->get();

        // return $documents;

        // $count = Document::where('documents.originator_id', Auth::user()->id)->count();
        // $documents = Document::join('users', 'documents.originator_id', 'users.id')->join('document_types', 'documents.document_type_id', 'document_types.id')
        //     ->join('divisions', 'documents.division_id', 'divisions.id')
        //     ->select('documents.*', 'users.name as originator_name', 'document_types.name as document_type_name', 'divisions.name as division_name')->where('documents.originator_id', Auth::user()->id)->orderByDesc('documents.id')->paginate(10);
        return view('frontend.documents.index', compact('documents', 'count', 'divisions', 'originator', 'documentTypes', 'documentStatus'));
    }

    public function filterRecord(Request $request)
    {
        $res = [];

        $query = Document::query();

        if ($request->status && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        if ($request->document_type_id && !empty($request->document_type_id)) {
            $query->where('document_type_id', $request->document_type_id);
        }

        if ($request->documentTypes && !empty($request->division_id)) {
            $query->where('division_id', $request->division_id);
        }

        if ($request->originator_id && !empty($request->originator_id)) {
            $query->where('originator_id', $request->originator_id);
        }

        $documents = $query->get();

        foreach ($documents as $doc) {
            $doctype = DocumentType::where('id', $doc->document_type_id)->value('name');
            $originatorName = User::where('id', $doc->originator_id)->value('name');

            // Assign the retrieved names to the document object
            $doc['document_type_name'] = $doctype;
            $doc['originator_name'] = $originatorName;
        }

        $html = view('frontend.documents.comps.record_table', compact('documents'))->render();

        $res['html'] = $html;

        return response()->json($res);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reviseCreate()
    {
        //
        $division = SetDivision::where('user_id', Auth::id())->latest()->first();
        if (!empty($division)) {
            $division->dname = Division::where('id', $division->division_id)->value('name');
            $division->pname = Process::where('id', $division->process_id)->value('process_name');
            $process = QMSProcess::where([
                'process_name' => 'New Document',
                'division_id' => $division->division_id
            ])->first();
        }
        $users = User::all();
        if (!empty($users)) {
            foreach ($users as $data) {
                $data->role = RoleGroup::where('id', $data->role)->value('name');
            }
        }
        $document = Document::all();
        if (!empty($document)) {
            foreach ($document as $temp) {
                if (!empty($temp)) {
                    $temp->division = Division::where('id', $temp->division_id)->value('name');
                    $temp->typecode = DocumentType::where('id', $temp->document_type_id)->value('typecode');
                    $temp->year = Carbon::parse($temp->created_at)->format('Y');
                }
            }
        }
        // $departments = Department::all();
        $departments = Helper::getDepartments($departmentId);

        $documentTypes = DocumentType::all();
        $documentsubTypes = DocumentSubtype::all();
        $documentLanguages = DocumentLanguage::all();
        //$reviewer = User::get();
        $reviewer = DB::table('user_roles')
            ->join('users', 'user_roles.user_id', '=', 'users.id')
            ->select('user_roles.q_m_s_processes_id', 'users.id', 'users.role', 'users.name') // Include all selected columns in the select statement
            ->where('user_roles.q_m_s_processes_id', $process->id)
            ->where('user_roles.q_m_s_roles_id', 2)
            ->groupBy('user_roles.q_m_s_processes_id', 'users.id', 'users.role', 'users.name') // Include all selected columns in the group by clause
            ->get();
        $trainer = User::get();


        // $approvers = DB::table('user_roles')
        // ->join('users', 'user_roles.user_id', '=', 'users.id')
        // ->where('user_roles.q_m_s_processes_id', $process->id)
        // ->where('q_m_s_roles_id', 1)
        // ->get();;

        $approvers = DB::table('user_roles')
            ->join('users', 'user_roles.user_id', '=', 'users.id')
            ->select('user_roles.q_m_s_processes_id', 'users.id', 'users.role', 'users.name') // Include all selected columns in the select statement
            ->where('user_roles.q_m_s_processes_id', $process->id)
            ->where('user_roles.q_m_s_roles_id', 1)
            ->groupBy('user_roles.q_m_s_processes_id', 'users.id', 'users.role', 'users.name') // Include all selected columns in the group by clause
            ->get();

        $hods = DB::table('user_roles')
            ->join('users', 'user_roles.user_id', '=', 'users.id')
            ->select('user_roles.q_m_s_processes_id', 'users.id', 'users.role', 'users.name') // Include all selected columns in the select statement
            ->where('user_roles.q_m_s_processes_id', $process->id)
            ->where('user_roles.q_m_s_roles_id', 4)
            ->groupBy('user_roles.q_m_s_processes_id', 'users.id', 'users.role', 'users.name') // Include all selected columns in the group by clause
            ->get();



        $reviewergroup = Grouppermission::where('role_id', 2)->get();
        $approversgroup = Grouppermission::where('role_id', 1)->get();
        // Retrieve the current counter value
        $counter = DB::table('record_numbers')->value('counter');

        // Generate the record number with leading zeros
        $recordNumber = str_pad($counter + 1, 5, '0', STR_PAD_LEFT);

        $user = User::all();

        return view('frontend.documents.create', compact(
            'departments',
            'documentTypes',
            'documentLanguages',
            'user',
            'reviewer',
            'approvers',
            'hods',
            'reviewergroup',
            'approversgroup',
            'trainer',
            'document',
            'users',
            'recordNumber',
            'division',
            'documentsubTypes'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $division = SetDivision::where('user_id', Auth::id())->latest()->first();

        if (!empty($division)) {
            $division->dname = Division::where('id', $division->division_id)->value('name');
            $division->pname = Process::where('id', $division->process_id)->value('process_name');
            $process = QMSProcess::where([
                'process_name' => 'New Document',
                'division_id' => $division->division_id
            ])->first();
        } else {
            return "Division not found";
        }


        $users = User::all();
        if (!empty($users)) {
            foreach ($users as $data) {
                $data->role = RoleGroup::where('id', $data->role)->value('name');
            }
        }
        $document = Document::all();
        if (!empty($document)) {
            foreach ($document as $temp) {
                if (!empty($temp)) {
                    $temp->division = Division::where('id', $temp->division_id)->value('name');
                    $temp->typecode = DocumentType::where('id', $temp->document_type_id)->value('typecode');
                    $temp->year = Carbon::parse($temp->created_at)->format('Y');
                }
            }
        }

        $departments = Department::all();
        $documentTypes = DocumentType::all();
        $documentsubTypes = DocumentSubtype::all();
        $documentLanguages = DocumentLanguage::all();
        //$reviewer = User::get();
        $reviewer = DB::table('user_roles')
            ->join('users', 'user_roles.user_id', '=', 'users.id')
            ->select('user_roles.q_m_s_processes_id', 'users.id', 'users.role', 'users.name') // Include all selected columns in the select statement
            ->where('user_roles.q_m_s_processes_id', $process->id)
            ->where('user_roles.q_m_s_roles_id', 2)
            ->groupBy('user_roles.q_m_s_processes_id', 'users.id', 'users.role', 'users.name') // Include all selected columns in the group by clause
            ->get();


        //sdd($temp->division_id);
        $approvers = DB::table('user_roles')
            ->join('users', 'user_roles.user_id', '=', 'users.id')
            ->select('user_roles.q_m_s_processes_id', 'users.id', 'users.role', 'users.name') // Include all selected columns in the select statement
            ->where('user_roles.q_m_s_processes_id', $process->id)
            ->where('user_roles.q_m_s_roles_id', 1)
            ->groupBy('user_roles.q_m_s_processes_id', 'users.id', 'users.role', 'users.name') // Include all selected columns in the group by clause
            ->get();

        $hods = DB::table('user_roles')
            ->join('users', 'user_roles.user_id', '=', 'users.id')
            ->select('user_roles.q_m_s_processes_id', 'users.id', 'users.role', 'users.name') // Include all selected columns in the select statement
            ->where('user_roles.q_m_s_processes_id', $process->id)
            ->where('user_roles.q_m_s_roles_id', 4)
            ->groupBy('user_roles.q_m_s_processes_id', 'users.id', 'users.role', 'users.name') // Include all selected columns in the group by clause
            ->get();


        $trainer = User::get();

        $reviewergroup = Grouppermission::where('role_id', 2)->get();
        $approversgroup = Grouppermission::where('role_id', 1)->get();
        // Retrieve the current counter value
        $counter = DB::table('record_numbers')->value('counter');

        // Generate the record number with leading zeros
        $recordNumber = str_pad($counter + 1, 5, '0', STR_PAD_LEFT);

        $user = User::all();

        return view('frontend.documents.create', compact(
            'departments',
            'documentTypes',
            'documentLanguages',
            'user',
            'reviewer',
            'approvers',
            'hods',
            'reviewergroup',
            'approversgroup',
            'trainer',
            'document',
            'users',
            'recordNumber',
            'division',
            'documentsubTypes'
        ));
    }

    // documentExportPDF
    public function documentExportPDF()
    {
        $documents = Document::all();
    }

    // documentExportEXCEL
    public function documentExportEXCEL()
    {
        return Excel::download(new DocumentsExport, 'documents.csv');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->submit == 'save') {

            $document = new Document();

            $division = SetDivision::where('user_id', Auth::id())->latest()->first();

            if (empty($request->division_id) && empty($request->process_id)) {
                $document->division_id = $division->division_id;
                $document->process_id = $division->process_id;
            } else {
                $document->division_id = $request->division_id;
                $document->process_id = $request->process_id;
            }

            $document->record = DB::table('record_numbers')->value('counter') + 1;
            $document->originator_id = Auth::id();
            $document->legacy_number = $request->legacy_number;
            $document->document_name = $request->document_name;
            $document->short_description = $request->short_desc;
            $document->description = $request->description;
            $document->stage = 1;
            $document->status = Stage::where('id', 1)->value('name');
            $document->due_dateDoc = $request->due_dateDoc;
            $document->department_id = $request->department_id;
            $document->document_type_id = $request->document_type_id;
            $document->document_subtype_id = $request->document_subtype_id;
            $document->document_language_id = $request->document_language_id;
            $document->effective_date = $request->effective_date;
            //mfps
            $document->specification_mfps_no = $request->specification_mfps_no;
            $document->stp_mfps_no = $request->stp_mfps_no;
            //mfstp
            $document->specification_mfpstp_no = $request->specification_mfpstp_no;
            $document->stp_mfpstp_no = $request->stp_mfpstp_no;

            //tds
            $document->product_material_name = $request->product_material_name;
            $document->tds_no = $request->tds_no;
            $document->Reference_Standard = $request->Reference_Standard;
            $document->batch_no = $request->batch_no;
            $document->ar_no = $request->ar_no;
            $document->mfg_date = $request->mfg_date;
            $document->exp_date = $request->exp_date;
            $document->analysis_start_date = $request->analysis_start_date;
            $document->analysis_completion_date = $request->analysis_completion_date;
            $document->specification_no = $request->specification_no;
            $document->tds_remark = $request->tds_remark;
            $document->name_of_material_sample = $request->name_of_material_sample;
            $document->sample_reconcilation_batchNo = $request->sample_reconcilation_batchNo;
            $document->sample_reconcilation_arNo = $request->sample_reconcilation_arNo;
            $document->sample_quatity_received = $request->sample_quatity_received;
            $document->total_quantity_consumed = $request->total_quantity_consumed;
            $document->balance_quantity = $request->balance_quantity;
            $document->balance_quantity_destructed = $request->balance_quantity_destructed;



            // $document->effective_date = Carbon::parse($document->effective_date)->format('d-m-y');

            try {
                if ($request->effective_date) {
                    $next_review_date = Carbon::parse($request->effective_date)->addYears($request->review_period)->format('d-m-Y');
                    $document->next_review_date = $next_review_date;
                }
            } catch (\Exception $e) {
                //
            }

            $document->review_period = $request->review_period;
            $document->training_required = $request->training_required;
            $document->trainer = $request->trainer;
            $document->comments = $request->comments;
            $document->revision_type = $request->revision_type;
            $document->major = $request->major;
            $document->division_id = $request->division_id;

            $document->minor = $request->minor;
            $document->sop_type = $request->sop_type;
            $document->sop_type_short = $request->sop_type_short;
            $document->notify_to = json_encode($request->notify_to);

            $document->master_copy_number = $request->master_copy_number;
            $document->controlled_copy_number = $request->controlled_copy_number;
            $document->display_copy_number = $request->display_copy_number;
            $document->master_user_department = $request->master_user_department;
            $document->controlled_user_department = $request->controlled_user_department;
            $document->display_user_department = $request->display_user_department;


            // FPICVS SOP store
            $document->generic_name = $request->generic_name;
            $document->brand_name = $request->brand_name;
            $document->label_claim = $request->label_claim;
            $document->product_code = $request->product_code;
            $document->storage_condition = $request->storage_condition;
            $document->sample_quantity = $request->sample_quantity;
            $document->reserve_sample = $request->reserve_sample;
            $document->custom_sample = $request->custom_sample;
            $document->reference = $request->reference;
            $document->sampling_instructions = $request->sampling_instructions;

           //Cleaning Validation Specification

           $document->generic_name_cvs = $request->generic_name_cvs;
           $document->brand_name_cvs = $request->brand_name_cvs;
           $document->label_claim_cvs = $request->label_claim_cvs;
           $document->product_code_cvs = $request->product_code_cvs;
           $document->storage_condition_cvs = $request->storage_condition_cvs;
           $document->sample_quantity_cvs = $request->sample_quantity_cvs;
           $document->reserve_sample_cvs = $request->reserve_sample_cvs;
           $document->custom_sample_cvs = $request->custom_sample_cvs;
           $document->reference_cvs = $request->reference_cvs;
           $document->sampling_instructions_cvs = $request->sampling_instructions_cvs;


            // row  material store
            $document->cas_no_row_material = $request->cas_no_row_material;
            $document->molecular_formula_row_material = $request->molecular_formula_row_material;
            $document->molecular_weight_row_material = $request->molecular_weight_row_material;
            $document->storage_condition_row_material = $request->storage_condition_row_material;
            $document->retest_period_row_material = $request->retest_period_row_material;
            $document->sampling_procedure_row_material = $request->sampling_procedure_row_material;
            $document->item_code_row_material = $request->item_code_row_material;
            $document->sample_quantity_row_material = $request->sample_quantity_row_material;
            $document->reserve_sample_quantity_row_material = $request->reserve_sample_quantity_row_material;
            $document->retest_sample_quantity_row_material = $request->retest_sample_quantity_row_material;
            $document->sampling_instructions_row_material = $request->sampling_instructions_row_material;

            
            $document->name_pack_material = $request->name_pack_material;
            $document->standard_pack = $request->standard_pack;
            $document->sampling_plan = $request->sampling_plan;
            $document->sampling_instruction = $request->sampling_instruction;
            $document->sample_analysis = $request->sample_analysis;
            $document->control_sample = $request->control_sample;
            $document->safety_precaution = $request->safety_precaution;
            $document->storage_condition = $request->storage_condition;
            $document->approved_vendor = $request->approved_vendor;


            $document->stp_no = $request->stp_no;
 
            
            
            
            
            //$document->purpose = $request->purpose;

            if ($request->keywords) {
                $document->keywords = implode(',', $request->keywords);
            }

            // if ($request->notify_to) {
            //     $document->notify_to = implode(',', $request->notify_to);
            // }
            if ($request->reference_record) {
                $document->reference_record = implode(',', $request->reference_record);
            }

            if ($request->hasfile('attach_draft_doocument')) {

                $image = $request->file('attach_draft_doocument');

                $ext = $image->getClientOriginalExtension();

                $image_name = date('y-m-d') . '-' . rand() . '.' . $ext;

                $image->move('upload/document/', $image_name);

                $document->attach_draft_doocument = $image_name;
            }

            if ($request->hasfile('attach_effective_docuement')) {

                $image = $request->file('attach_effective_docuement');

                $ext = $image->getClientOriginalExtension();

                $image_name = date('y-m-d') . '-' . rand() . '.' . $ext;

                $image->move('upload/document/', $image_name);

                $document->attach_effective_docuement = $image_name;
            }

            // $document->revision_summary = $request->revision_summary;
            if (!empty($request->reviewers)) {
                $document->reviewers = implode(',', $request->reviewers);
            }
            if (!empty($request->approvers)) {
                $document->approvers = implode(',', $request->approvers);
            }
            if (!empty($request->hods)) {
                $document->hods = implode(',', $request->hods);
            }
            if (!empty($request->reviewers_group)) {
                $document->reviewers_group = implode(',', $request->reviewers_group);
            }
            if (!empty($request->approver_group)) {
                $document->approver_group = implode(',', $request->approver_group);
            }
            $document->save();

            // Grid here
            $tds_id = $document->id;
            $employeeJobGrid = TDSDocumentGrid::where(['tds_id' => $tds_id, 'identifier' => 'summaryResult'])->firstOrNew();
            $employeeJobGrid->tds_id = $tds_id;
            $employeeJobGrid->identifier = 'summaryResult';
            $employeeJobGrid->data = json_encode($request->summaryResult);
            $employeeJobGrid->save();

            $employeeJobGrid = TDSDocumentGrid::where(['tds_id' => $tds_id, 'identifier' => 'sampleReconcilation'])->firstOrNew();
            $employeeJobGrid->tds_id = $tds_id;
            $employeeJobGrid->identifier = 'sampleReconcilation';
            $employeeJobGrid->data = json_encode($request->sampleReconcilation);
            $employeeJobGrid->save();


            DocumentService::update_document_numbers();

            if ($document) {
                DocumentService::handleDistributionGrid($document, $request->distribution);
            }

            // Retrieve the current counter value
            $counter = DB::table('record_numbers')->value('counter');

            // Generate the record number with leading zeros
            $recordNumber = str_pad($counter, 5, '0', STR_PAD_LEFT);

            // Increment the counter value
            $newCounter = $counter + 1;
            DB::table('record_numbers')->update(['counter' => $newCounter]);
            if (!empty($request->keywords)) {
                foreach ($request->keywords as $key) {
                    $keyword = new Keyword();
                    $keyword->user_id = Auth::user()->id;
                    $keyword->document_id = $document->id;
                    $keyword->keyword = $key;
                    $keyword->save();
                }
            }
            if ($request->training_required == 'yes') {
                $trainning = new DocumentTraining();
                $trainning->document_id = $document->id;
                $trainning->trainer = $request->trainer;
                $trainning->cbt = $request->cbt;
                $trainning->type = $request->type;
                $trainning->comments = $request->comments;
                $trainning->save();
            }

            $annexure = new Annexure();
            $annexure->document_id = $document->id;
            if (!empty($request->serial_number)) {
                $annexure->sno = serialize($request->serial_number);
            }
            if (!empty($request->annexure_number)) {
                $annexure->annexure_no = serialize($request->annexure_number);
            }
            if (!empty($request->annexure_data)) {
                $annexure->annexure_title = serialize($request->annexure_data);
            }
            $annexure->save();

            $content = new DocumentContent();
            $content->document_id = $document->id;
            $content->purpose = $request->purpose;
            $content->scope = $request->scope;
            $content->procedure = $request->procedure;
            $content->revision_summary = $request->revision_summary;
            $content->safety_precautions = $request->safety_precautions;
            $content->hod_comments = $request->hod_comments;
            
            if ($request->has('hod_attachments') && $request->hasFile('hod_attachments')) {
                $files = [];

                foreach ($request->file('hod_attachments') as $file) {
                    $name = $request->name . '-hod_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }

                $content->hod_attachments = json_encode($files);
            }


            if (!empty($request->materials_and_equipments)) {
                $content->materials_and_equipments = serialize($request->materials_and_equipments);
            }
            if (!empty($request->responsibility)) {
                $content->responsibility = serialize($request->responsibility);
            }
            if (!empty($request->accountability)) {
                $content->accountability = serialize($request->accountability);
            }
            if (!empty($request->abbreviation)) {
                $content->abbreviation = serialize($request->abbreviation);
            }
            if (!empty($request->defination)) {
                $content->defination = serialize($request->defination);
            }
            if (!empty($request->reporting)) {
                $content->reporting = serialize($request->reporting);
            }
            if (!empty($request->references)) {
                $content->references = serialize($request->references);
            }
            if (!empty($request->ann)) {
                $content->ann = serialize($request->ann);
            }
            // if ($request->hasfile('references')) {

            //     $image = $request->file('references');

            //     $ext = $image->getClientOriginalExtension();

            //     $image_name = date('y-m-d').'-'.rand().'.'.$ext;

            //     $image->move('upload/document/', $image_name);

            //     $content->references = $image_name;
            // }
            if (!empty($request->ann)) {
                $content->ann = serialize($request->ann);
            }
            if (!empty($request->annexuredata)) {
                $content->annexuredata = serialize($request->annexuredata);
            }
            if (!empty($request->distribution)) {
                $content->distribution = serialize($request->distribution);
            }

            $griddata = $document->id;

            // Store data for Specification grid
            $SpecificationData = DocumentGrid::where(['document_type_id' => $griddata, 'identifier' => 'SPECIFICATION'])->firstOrNew();
            $SpecificationData->document_type_id = $griddata;
            $SpecificationData->identifier = 'SPECIFICATION';
            $SpecificationData->data = $request->specification_details;
            $SpecificationData->save();

         // specification   validation  grid
            $Specification_Validation_Data = DocumentGrid::where(['document_type_id' => $griddata, 'identifier' => 'SPECIFICATION_VALIDATION'])->firstOrNew();
            $Specification_Validation_Data->document_type_id = $griddata;
            $Specification_Validation_Data->identifier = 'SPECIFICATION_VALIDATION';
            $Specification_Validation_Data->data = $request->specification_validation_details;
            // dd($Specification_Validation_Data->data);
            $Specification_Validation_Data->save();
            $content->save();

            $specification_id = $document->id;
            //master finished product specification grid
            $specifications = specifications::where(['specification_id' => $specification_id, 'identifier' => 'specifications'])->firstOrNew();
            $specifications->specification_id = $specification_id;
            $specifications->identifier = 'specifications';
            $specifications->data = json_encode($request->specifications);
            $specifications->save();

            //master finished product standard testing procedure grid

            $specifications = specifications::where(['specification_id' => $specification_id, 'identifier' => 'specifications_testing'])->firstOrNew();
            $specifications->specification_id = $specification_id;
            $specifications->identifier = 'specifications_testing';
            $specifications->data = json_encode($request->specifications_testing);
            $specifications->save();
      
            // row matrial specification validation  grid
            $RowSpecification_Data = DocumentGrid::where(['document_type_id' => $griddata, 'identifier' => 'ROW_SPECIFICATION'])->firstOrNew();
            $RowSpecification_Data->document_type_id = $griddata;
            $RowSpecification_Data->identifier = 'ROW_SPECIFICATION';
            $RowSpecification_Data->data = $request->Row_Materail;
            $RowSpecification_Data->save();
            $content->save();


            $DocumentGridData = DocumentGrid ::where(['document_type_id' => $document->id, 'identifier' => 'Rowmaterialtest'])->firstOrNew();
            $DocumentGridData->document_type_id = $document->id;
            $DocumentGridData->identifier = 'Rowmaterialtest';
            $DocumentGridData->data = $request->test;
            $DocumentGridData->save();
        



            $PackingGridData = DocumentGrid ::where(['document_type_id' => $document->id, 'identifier' => 'Packingmaterialdata'])->firstOrNew();
            $PackingGridData->document_type_id = $document->id;
            $PackingGridData->identifier = 'Packingmaterialdata';
            $PackingGridData->data = $request->packingtest;
          //  dd($PackingGridData);
            $PackingGridData->save();

            $GtpGridData = DocumentGrid ::where(['document_type_id' => $document->id, 'identifier' => 'gtp'])->firstOrNew();
            $GtpGridData->document_type_id = $document->id;
            $GtpGridData->identifier = 'gtp';
            $GtpGridData->data = $request->gtp;
            // dd($GtpGridData);
            $GtpGridData->save();



            $ProductSpecification = DocumentGrid ::where(['document_type_id' => $document->id, 'identifier' => 'ProductSpecification'])->firstOrNew();
            $ProductSpecification->document_type_id = $document->id;
            $ProductSpecification->identifier = 'ProductSpecification';
            $ProductSpecification->data = $request->product;
          //  dd($ProductSpecification);
            $ProductSpecification->save();




            $MaterialSpecification = DocumentGrid ::where(['document_type_id' => $document->id, 'identifier' => 'MaterialSpecification'])->firstOrNew();
            $MaterialSpecification->document_type_id = $document->id;
            $MaterialSpecification->identifier = 'MaterialSpecification';
            $MaterialSpecification->data = $request->row_material;
            $MaterialSpecification->save();



            $Finished_Product = DocumentGrid ::where(['document_type_id' => $document->id, 'identifier' => 'Finished_Product'])->firstOrNew();
            $Finished_Product->document_type_id = $document->id;
            $Finished_Product->identifier = 'Finished_Product';
            $Finished_Product->data = $request->finished_product;
            $Finished_Product->save();

            $Inprocess_standard = DocumentGrid ::where(['document_type_id' => $document->id, 'identifier' => 'Inprocess_standard'])->firstOrNew();
            $Inprocess_standard->document_type_id = $document->id;
            $Inprocess_standard->identifier = 'Inprocess_standard';
            $Inprocess_standard->data = $request->inprocess_standard;
            $Inprocess_standard->save();

            $CLEANING_VALIDATION = DocumentGrid ::where(['document_type_id' => $document->id, 'identifier' => 'CLEANING_VALIDATION'])->firstOrNew();
            $CLEANING_VALIDATION->document_type_id = $document->id;
            $CLEANING_VALIDATION->identifier = 'CLEANING_VALIDATION';
            $CLEANING_VALIDATION->data = $request->cleaning_validation;
            $CLEANING_VALIDATION->save();


            $SpecificationData_CVS = DocumentGrid::where(['document_type_id' => $document->id, 'identifier' => 'SpecificationCleaningValidationSpecification'])->firstOrNew();;
            $SpecificationData_CVS->document_type_id = $document->id;
            $SpecificationData_CVS->identifier = 'SpecificationCleaningValidationSpecification';
            $SpecificationData_CVS->data = $request->specification_details_cvs;
            $SpecificationData_CVS->save();
            
            $Specification_Validation_Data_CVS = DocumentGrid::where(['document_type_id' => $document->id, 'identifier' => 'SPECIFICATION_VALIDATION_CleaningValidationSpecification'])->firstOrNew();;
            $Specification_Validation_Data_CVS->document_type_id = $document->id;
            $Specification_Validation_Data_CVS->identifier = 'SPECIFICATION_VALIDATION_CleaningValidationSpecification';
            $Specification_Validation_Data_CVS->data = $request->specification_validation_details_cvs;
            //dd($Specification_Validation_Data_CVS);
            $Specification_Validation_Data_CVS->save();
           



            toastr()->success('Document created');

            return redirect()->route('documents.index');
        } else {
            toastr()->error('Not working');

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::all();
        if (!empty($users)) {
            foreach ($users as $data) {
                $data->role = RoleGroup::where('id', $data->role)->value('name');
            }
        }

        $document_data = Document::all();
        if (!empty($document_data)) {
            foreach ($document_data as $temp) {
                if (!empty($temp)) {
                    $temp->division = Division::where('id', $temp->division_id)->value('name');
                    $temp->typecode = DocumentType::where('id', $temp->document_type_id)->value('typecode');
                    $temp->year = Carbon::parse($temp->created_at)->format('Y');
                }
            }
        }

        $print_history = PrintHistory::join('users', 'print_histories.user_id', 'users.id')->select('print_histories.*', 'users.name as user_name')->where('document_id', $id)->get();
        $document = Document::join('users', 'documents.originator_id', 'users.id')->leftjoin('document_types', 'documents.document_type_id', 'document_types.id')
            ->join('divisions', 'documents.division_id', 'divisions.id')->leftjoin('departments', 'documents.department_id', 'departments.id')
            ->select('documents.*', 'users.name as originator_name', 'document_types.name as document_type_name', 'divisions.name as division_name', 'departments.name as dept_name')->where('documents.id', $id)->first();
        $document->date = Carbon::parse($document->created_at)->format('d-M-Y');
        $document['document_content'] = DocumentContent::where('document_id', $id)->first();
        $document_distribution_grid = DocumentGridData::where('document_id', $id)->get();
        // $document->parent_child = json_decode($document->parent_child);
        $parentChildRecords = DB::table('action_items')->get();
        $specifications = specifications::where(['specification_id' => $document->id, 'identifier' => 'specifications'])->first();
        $specifications_testing = specifications::where(['specification_id' => $document->id, 'identifier' => 'specifications_testing'])->first();
        $specifications->data = json_decode($specifications->data, true);
        $specifications_testing->data = json_decode($specifications_testing->data, true);

        $document['division'] = Division::where('id', $document->division_id)->value('name');
        $year = Carbon::parse($document->created_at)->format('Y');
        $trainer = User::get();
        $trainingDoc = DocumentTraining::where('document_id', $id)->first();
        $history = DocumentHistory::where('document_id', $id)->get();
        $documentsubTypes = DocumentSubtype::all();
        // dd($document_distribution_grid);
        // $history = [];
        // foreach($historydata as $temp){
        //     array_push($history,$temp);
        // }
        $keywords = Keyword::where('document_id', $id)->get();
        $annexure = Annexure::where('document_id', $id)->first();

        $signature = StageManage::where('document_id', $id)->get();
        $reviewer = User::get();
        // $reviewer = DB::table('user_roles')
        //     ->join('users', 'user_roles.user_id', '=', 'users.id')
        //     ->select('user_roles.q_m_s_processes_id', 'users.id', 'users.role', 'users.name')
        //     ->where('user_roles.q_m_s_processes_id', 89)
        //     ->where('user_roles.q_m_s_roles_id', 2)
        //     ->groupBy('user_roles.q_m_s_processes_id', 'users.id', 'users.role', 'users.name')
        //     ->get();
        $approvers = User::get();
        // $approvers = DB::table('user_roles')
        //     ->join('users', 'user_roles.user_id', '=', 'users.id')
        //     ->select('user_roles.q_m_s_processes_id', 'users.id', 'users.role', 'users.name')
        //     ->where('user_roles.q_m_s_processes_id', 89)
        //     ->where('user_roles.q_m_s_roles_id', 1)
        //     ->groupBy('user_roles.q_m_s_processes_id', 'users.id', 'users.role', 'users.name')
        //     ->get();
        $reviewergroup = Grouppermission::where('role_id', 2)->get();
        $approversgroup = Grouppermission::where('role_id', 1)->get();
        $user = User::all();
        $departments = Department::all();
        $documentTypes = DocumentType::all();
        $documentLanguages = DocumentLanguage::all();


        /////////
        if ($document->revised == 'Yes') {
            $latestRevision = Document::where('revised_doc', $document->id)
                                    ->max('minor');
            $revisionNumber = $latestRevision ? (int)$latestRevision + 1 : 1;
            $revisionNumber = str_pad($revisionNumber, 2, '0', STR_PAD_LEFT);
        } else {
            $revisionNumber = '00';
        }

        // Filter documents by department_id and sop_type_short
        $departmentId = $document->department_id;
        $sopTypeShort = $document->sop_type_short;

        if (!$departmentId) {
            return redirect()->back()->withErrors(['error' => 'Department ID not associated with this document']);
        }

        $documents = Document::where('department_id', $departmentId)
            ->where('sop_type_short', $sopTypeShort)
            ->orderBy('id')
            ->get();

        $counter = 0;
        foreach ($documents as $doc) {
            $counter++;
            $doc->currentId = $counter;

            if ($doc->id == $id) {
                $currentId = $doc->currentId;
            }
        }

       

        $SpecificationData = DocumentGrid::where('document_type_id', $id)->where('identifier', 'SPECIFICATION')->first();
        $Specification_Validation_Data = DocumentGrid::where('document_type_id', $id)->where('identifier', 'SPECIFICATION_VALIDATION')->first();


        $hods = User::get();

        $testDataDecoded = DocumentGrid::where('document_type_id', $id)->where('identifier', "Rowmaterialtest")->first();
        $PackingGridData = DocumentGrid::where('document_type_id', $id)->where('identifier', "Packingmaterialdata")->first();
        $GtpGridData = DocumentGrid::where('document_type_id', $id)->where('identifier', "gtp")->first();
        // dd($GtpGridData);
        
        $ProductSpecification = DocumentGrid::where('document_type_id', $id)->where('identifier', "ProductSpecification")->first();
        $MaterialSpecification = DocumentGrid::where('document_type_id', $id)->where('identifier', "MaterialSpecification")->first();
     
        $Finished_Product = DocumentGrid::where('document_type_id', $id)->where('identifier', "Finished_Product")->first();
       

        $Inprocess_standard = DocumentGrid::where('document_type_id', $id)->where('identifier', "Inprocess_standard")->first();
        

        $CLEANING_VALIDATION = DocumentGrid::where('document_type_id', $id)->where('identifier', "CLEANING_VALIDATION")->first();
     

        $MaterialSpecification = DocumentGrid::where('document_type_id', $id)->where('identifier', "MaterialSpecification")->first();

        $sampleReconcilation = TDSDocumentGrid::where('tds_id', $id)->where('identifier', "sampleReconcilation")->first();
        

        if ($sampleReconcilation && !empty($sampleReconcilation->data)) {
            $sampleReconcilation->data = json_decode($sampleReconcilation->data, true);
        }

        

        //----------


        $SpecificationData_CVS = DocumentGrid::where('document_type_id', $id)->where('identifier', 'SpecificationCleaningValidationSpecification')->first();
        $Specification_Validation_Data_CVS = DocumentGrid::where('document_type_id', $id)->where('identifier', 'SPECIFICATION_VALIDATION_CleaningValidationSpecification')->first();







        $summaryResult = TDSDocumentGrid::where('tds_id', $id)->where('identifier', "summaryResult")->first();

        if ($summaryResult && !empty($summaryResult->data)) {
        $summaryResult->data = json_decode($summaryResult->data, true);
        }

      
        // $hods = DB::table('user_roles')
        //     ->join('users', 'user_roles.user_id', '=', 'users.id')
        //     ->select('user_roles.q_m_s_processes_id', 'users.id', 'users.role', 'users.name') // Include all selected columns in the select statement
        //     ->where('user_roles.q_m_s_processes_id', 89)
        //     ->where('user_roles.q_m_s_roles_id', 4)
        //     ->groupBy('user_roles.q_m_s_processes_id', 'users.id', 'users.role', 'users.name') // Include all selected columns in the group by clause
        //     ->get();

        return view('frontend.documents.edit', compact(
            'document',
            'departments',
            'documentTypes',
            'documentLanguages',
            'reviewer',
            'approvers',
            'hods',
            'reviewergroup',
            'approversgroup',
            'year',
            'print_history',
            'signature',
            'trainer',
            'document_data',
            'users',
            'trainingDoc',
            'history',
            'keywords',
            'annexure',
            'documentsubTypes',
            'document_distribution_grid',
            'specifications',
            'specifications_testing',
            'SpecificationData',
            'Specification_Validation_Data',
            'testDataDecoded',
            'PackingGridData',
            'MaterialSpecification',
            'ProductSpecification',
            'sampleReconcilation',
            'summaryResult',
            'Finished_Product',
            'Inprocess_standard',
            'CLEANING_VALIDATION',
            'GtpGridData',
            'currentId',
            'Specification_Validation_Data_CVS',
            'SpecificationData_CVS'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */

    public function update($id, Request $request)
    {
        $document = Document::find($id);
        $document->document_number = $request->document_number;
        $document->update();


        if ($request->submit == 'save') {
            $lastDocument = Document::find($id);
            $lastContent = DocumentContent::firstOrNew([
                'document_id' => $id
            ]);
            $lastTraining = DocumentTraining::where('document_id', $id)->first();
            $document = Document::find($id);
            if ($document->stage <= 7) {
                $document->document_name = $request->document_name;
                $document->short_description = $request->short_desc;
                $document->description = $request->description;

                $document->legacy_number = $request->legacy_number;
                $document->due_dateDoc = $request->due_dateDoc;
                $document->sop_type = $request->sop_type;
                $document->sop_type_short = $request->sop_type_short;
                $document->department_id = $request->department_id;
                $document->document_type_id = $request->document_type_id;
                $document->document_subtype_id = $request->document_subtype_id;
                $document->document_language_id = $request->document_language_id;

                //tds
                $document->product_material_name = $request->product_material_name;
                $document->tds_no = $request->tds_no;
                $document->Reference_Standard = $request->Reference_Standard;
                $document->batch_no = $request->batch_no;
                $document->ar_no = $request->ar_no;
                $document->mfg_date = $request->mfg_date;
                $document->exp_date = $request->exp_date;
                $document->analysis_start_date = $request->analysis_start_date;
                $document->analysis_completion_date = $request->analysis_completion_date;
                $document->specification_no = $request->specification_no;
                $document->tds_remark = $request->tds_remark;
                $document->name_of_material_sample = $request->name_of_material_sample;
                $document->sample_reconcilation_batchNo = $request->sample_reconcilation_batchNo;
                $document->sample_reconcilation_arNo = $request->sample_reconcilation_arNo;
                $document->sample_quatity_received = $request->sample_quatity_received;
                $document->total_quantity_consumed = $request->total_quantity_consumed;
                $document->balance_quantity = $request->balance_quantity;
                $document->balance_quantity_destructed = $request->balance_quantity_destructed;

                //mfps
                $document->specification_mfps_no = $request->specification_mfps_no;
                $document->stp_mfps_no = $request->stp_mfps_no;
                
                //mfpstp
                $document->stp_mfpstp_no = $request->stp_mfpstp_no;
                $document->specification_mfpstp_no = $request->specification_mfpstp_no;

                $document->name_pack_material = $request->name_pack_material;
                $document->standard_pack = $request->standard_pack;
                $document->sampling_plan = $request->sampling_plan;
                $document->sampling_instruction = $request->sampling_instruction;
                $document->sample_analysis = $request->sample_analysis;
                $document->control_sample = $request->control_sample;
                $document->safety_precaution = $request->safety_precaution;
                $document->storage_condition = $request->storage_condition;
                $document->approved_vendor = $request->approved_vendor;
                $document->stp_no = $request->stp_no;



                // Finished Product Specification
                $document->generic_name = $request->generic_name;
                $document->brand_name = $request->brand_name;
                $document->label_claim = $request->label_claim;
                $document->product_code = $request->product_code;
                $document->storage_condition = $request->storage_condition;
                $document->sample_quantity = $request->sample_quantity;
                $document->reserve_sample = $request->reserve_sample;
                $document->custom_sample = $request->custom_sample;
                $document->reference = $request->reference;
                $document->sampling_instructions = $request->sampling_instructions;


            //Cleaning Validation Specification

                $document->generic_name_cvs = $request->generic_name_cvs;
                $document->brand_name_cvs = $request->brand_name_cvs;
                $document->label_claim_cvs = $request->label_claim_cvs;
                $document->product_code_cvs = $request->product_code_cvs;
                $document->storage_condition_cvs = $request->storage_condition_cvs;
                $document->sample_quantity_cvs = $request->sample_quantity_cvs;
                $document->reserve_sample_cvs = $request->reserve_sample_cvs;
                $document->custom_sample_cvs = $request->custom_sample_cvs;
                $document->reference_cvs = $request->reference_cvs;
                $document->sampling_instructions_cvs = $request->sampling_instructions_cvs;



 
                // $document->effective_date = $request->effective_date ? $request->effective_date : $document->effectve_date;
                // try {
                //     $next_review_date = Carbon::parse($request->effective_date)->addYears($request->review_period)->format('Y-m-d');
                //     $document->next_review_date = $next_review_date;
                // } catch (\Exception $e) {
                //     //
                // }
                // $document->review_period = $request->review_period;
                $document->training_required = $request->training_required;
                $document->attach_draft_doocument = $request->attach_draft_doocument;
                $document->notify_to = json_encode($request->notify_to);

                $document->master_copy_number = $request->master_copy_number;
                $document->controlled_copy_number = $request->controlled_copy_number;
                $document->display_copy_number = $request->display_copy_number;
                $document->master_user_department = $request->master_user_department;
                $document->controlled_user_department = $request->controlled_user_department;
                $document->display_user_department = $request->display_user_department;

                if ($request->keywords) {
                    $document->keywords = implode(',', $request->keywords);
                }

                if (is_array($request->notify_to)) {
                    $document->notify_to = implode(',', $request->notify_to);
                }

                if ($request->reference_record) {
                    $document->reference_record = implode(',', $request->reference_record);
                }


                if ($request->hasfile('attach_draft_doocument')) {

                    $image = $request->file('attach_draft_doocument');

                    $ext = $image->getClientOriginalExtension();

                    $image_name = date('y-m-d') . '-' . rand() . '.' . $ext;

                    $image->move('upload/document/', $image_name);

                    $document->attach_draft_doocument = $image_name;
                }

                if ($request->hasfile('attach_effective_docuement')) {

                    $image = $request->file('attach_effective_docuement');

                    $ext = $image->getClientOriginalExtension();

                    $image_name = date('y-m-d') . '-' . rand() . '.' . $ext;

                    $image->move('upload/document/', $image_name);

                    $document->attach_effective_docuement = $image_name;
                }
                $document->revision_summary = $request->revision_summary;
                $document->revision_type = $request->revision_type;
                $document->major = $request->major;
                // $document->minor = $request->minor;


                if (!empty($request->reviewers)) {
                    $document->reviewers = implode(',', $request->reviewers);
                }
                if (!empty($request->approvers)) {
                    $document->approvers = implode(',', $request->approvers);
                }
                if (!empty($request->hods)) {
                    $document->hods = implode(',', $request->hods);
                }
                if (!empty($request->reviewers_group)) {
                    $document->reviewers_group = implode(',', $request->reviewers_group);
                }
                if (!empty($request->approver_group)) {
                    $document->approver_group = implode(',', $request->approver_group);
                }
            }

            $document->update();


            // Grid here
            $tds_id = $document->id;
            $employeeJobGrid = TDSDocumentGrid::where(['tds_id' => $tds_id, 'identifier' => 'summaryResult'])->firstOrNew();
            $employeeJobGrid->tds_id = $tds_id;
            $employeeJobGrid->identifier = 'summaryResult';
            $employeeJobGrid->data = json_encode($request->summaryResult);
            $employeeJobGrid->save();

            $employeeJobGrid = TDSDocumentGrid::where(['tds_id' => $tds_id, 'identifier' => 'sampleReconcilation'])->firstOrNew();
            $employeeJobGrid->tds_id = $tds_id;
            $employeeJobGrid->identifier = 'sampleReconcilation';
            $employeeJobGrid->data = json_encode($request->sampleReconcilation);
            $employeeJobGrid->save();

            DocumentService::handleDistributionGrid($document, $request->distribution);

            $existing_keywords = Keyword::where('document_id', $document->id)->get();

            foreach ($existing_keywords as $existing_keyword) {
                $existing_keyword->delete();
            }

            if (!empty($request->keywords)) {

                foreach ($request->keywords as $key) {
                    $keyword = new Keyword();
                    $keyword->user_id = Auth::user()->id;
                    $keyword->document_id = $document->id;
                    $keyword->keyword = $key;
                    $keyword->save();
                }
            }

            if ($request->training_required == 'yes') {
                $trainning = DocumentTraining::where('document_id', $id)->first();

                if (!$request->trainer) {
                    toastr()->error('Trainer not selected!');
                    return back();
                }

                if (empty($trainning)) {
                    $trainning = new DocumentTraining();
                    $trainning->document_id = $document->id;
                    $trainning->trainer = $request->trainer;
                    $trainning->cbt = $request->cbt;
                    $trainning->type = $request->type;
                    $trainning->comments = $request->comments;
                    $trainning->save();
                } else {
                    $trainning->document_id = $document->id;
                    $trainning->trainer = $request->trainer;
                    $trainning->cbt = $request->cbt;
                    $trainning->type = $request->type;
                    $trainning->comments = $request->comments;
                    $trainning->update();
                }
            }
            if ($lastDocument->document_name != $document->document_name || !empty($request->document_name_comment)) {
                $history = new DocumentHistory;
                $history->document_id = $id;
                $history->activity_type = 'Document Name';
                $history->previous = $lastDocument->document_name;
                $history->current = $document->document_name;
                $history->comment = $request->document_name_comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->save();
                $changeControl = OpenStage::where('title', $lastDocument->document_name)->first();
                if ($changeControl) {
                    $changeControl->title = $document->document_name;
                    $changeControl->update();
                }
            }
            if ($lastDocument->short_description != $document->short_description || !empty($request->short_desc_comment)) {
                $history = new DocumentHistory;
                $history->document_id = $id;
                $history->activity_type = 'Short Description';
                $history->previous = $lastDocument->short_description;
                $history->current = $document->short_description;
                $history->comment = $request->short_desc_comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->save();
            }
            if ($lastDocument->due_dateDoc != $document->due_dateDoc || !empty($request->due_dateDoc_comment)) {
                $history = new DocumentHistory;
                $history->document_id = $id;
                $history->activity_type = 'Due Date';
                $history->previous = $lastDocument->due_dateDoc;
                $history->current = $document->due_dateDoc;
                $history->comment = $request->due_dateDoc_comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->save();
            }
            if ($lastDocument->sop_type != $document->sop_type || !empty($request->sop_type_comment)) {
                $history = new DocumentHistory;
                $history->document_id = $id;
                $history->activity_type = 'SOP Type';
                $history->previous = $lastDocument->sop_type;
                $history->current = $document->sop_type;
                $history->comment = $request->sop_type_comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->save();
            }
            if ($lastDocument->reference_record != $document->reference_record || !empty($request->reference_record_comment)) {
                $history = new DocumentHistory;
                $history->document_id = $id;
                $history->activity_type = 'Reference Record';
                $history->previous = $lastDocument->reference_record;
                $history->current = $document->reference_record;
                $history->comment = $request->reference_record_comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->save();
            }
            if ($lastDocument->notify_to != $document->notify_to || !empty($request->notify_to_comment)) {
                $history = new DocumentHistory;
                $history->document_id = $id;
                $history->activity_type = 'Notify To';
                $history->previous = $lastDocument->notify_to;
                $history->current = $document->notify_to;
                $history->comment = $request->notify_to_comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->save();
            }
            if ($lastDocument->description != $document->description || !empty($request->description_comment)) {
                $history = new DocumentHistory;
                $history->document_id = $id;
                $history->activity_type = 'Description';
                $history->previous = $lastDocument->description;
                $history->current = $document->description;
                $history->comment = $request->description_comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->save();
            }


            if ($lastDocument->department_id != $document->department_id || !empty($request->department_id_comment)) {
                $history = new DocumentHistory;
                $history->document_id = $id;
                $history->activity_type = 'Department';
                $history->previous = Department::where('id', $lastDocument->department_id)->value('name');
                $history->current = Department::where('id', $document->department_id)->value('name');
                $history->comment = $request->department_id_comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->save();
            }
            // if ($lastDocument->document_type_id != $document->document_type_id || ! empty($request->document_type_id_comment)) {
            //     $history = new DocumentHistory;
            //     $history->document_id = $id;
            //     $history->activity_type = 'Document';
            //     $history->previous = DocumentType::where('id', $lastDocument->document_type_id)->value('name');
            //     $history->current = DocumentType::where('id', $document->document_type_id)->value('name');
            //     $history->comment = $request->document_type_id_comment;
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //     $history->origin_state = $lastDocument->status;
            //     $history->save();
            // }
            // if ($lastDocument->document_subtype_id != $document->document_subtype_id || ! empty($request->document_type_id_comment)) {
            //     $history = new DocumentHistory;
            //     $history->document_id = $id;
            //     $history->activity_type = 'Document Sub Type';
            //     $history->previous = DocumentType::where('id', $lastDocument->document_subtype_id)->value('name');
            //     $history->current = DocumentType::where('id', $document->document_subtype_id)->value('name');
            //     $history->comment = $request->document_subtype_id_comment;
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //     $history->origin_state = $lastDocument->status;
            //     $history->save();
            // }
            // if ($lastDocument->document_language_id != $document->document_language_id || ! empty($request->document_language_id_comment)) {
            //     $history = new DocumentHistory;
            //     $history->document_id = $id;
            //     $history->activity_type = 'Document Language';
            //     $history->previous = DocumentLanguage::where('id', $lastDocument->document_language_id)->value('name');
            //     $history->current = DocumentLanguage::where('id', $document->document_language_id)->value('name');
            //     $history->comment = $request->document_language_id_comment;
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //     $history->origin_state = $lastDocument->status;
            //     $history->save();
            // }
            if ($lastDocument->effective_date != $document->effective_date || !empty($request->effective_date_comment)) {
                $history = new DocumentHistory;
                $history->document_id = $id;
                $history->activity_type = 'Effective Date';
                $history->previous = $lastDocument->effective_date;
                $history->current = $document->effective_date;
                $history->comment = $request->effective_date_comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->save();
            }
            if ($lastDocument->next_review_date != $document->next_review_date || !empty($request->next_review_date_comment)) {
                $history = new DocumentHistory;
                $history->document_id = $id;
                $history->activity_type = 'Next-Review Date';
                $history->previous = $lastDocument->next_review_date;
                $history->current = $document->next_review_date;
                $history->comment = $request->next_review_date_comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->save();
            }
            if ($lastDocument->review_period != $document->review_period || !empty($request->review_period_comment)) {
                $history = new DocumentHistory;
                $history->document_id = $id;
                $history->activity_type = 'Review Period';
                $history->previous = $lastDocument->review_period;
                $history->current = $document->review_period;
                $history->comment = $request->review_period_comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->save();
            }
            if ($lastDocument->revision_type != $document->revision_type || !empty($request->revision_type_comment)) {
                $history = new DocumentHistory;
                $history->document_id = $id;
                $history->activity_type = 'Revision Type';
                $history->previous = $lastDocument->revision_type;
                $history->current = $document->revision_type;
                $history->comment = $request->revision_type_comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->save();
            }
            if ($lastDocument->major != $document->major || !empty($request->major_comment)) {
                $history = new DocumentHistory;
                $history->document_id = $id;
                $history->activity_type = 'Major';
                $history->previous = $lastDocument->major;
                $history->current = $document->major;
                $history->comment = $request->major_comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->save();
            }
            if ($lastDocument->minor != $document->minor || !empty($request->minor_comment)) {
                $history = new DocumentHistory;
                $history->document_id = $id;
                $history->activity_type = 'Minor';
                $history->previous = $lastDocument->minor;
                $history->current = $document->minor;
                $history->comment = $request->minor_comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->save();
            }
            if ($lastDocument->attach_draft_doocument != $document->attach_draft_doocument || !empty($request->attach_draft_doocument_comment)) {
                $history = new DocumentHistory;
                $history->document_id = $id;
                $history->activity_type = 'Draft Document';
                $history->previous = $lastDocument->attach_draft_doocument;
                $history->current = $document->attach_draft_doocument;
                $history->comment = $request->attach_draft_doocument_comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->save();
            }
            if ($lastDocument->attach_effective_docuement != $document->attach_effective_docuement || !empty($request->attach_effective_docuement_comment)) {
                $history = new DocumentHistory;
                $history->document_id = $id;
                $history->activity_type = 'Effective Document';
                $history->previous = $lastDocument->attach_effective_docuement;
                $history->current = $document->attach_effective_docuement;
                $history->comment = $request->attach_effective_docuement_comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->save();
            }
            if ($lastDocument->reviewers != $document->reviewers || !empty($request->reviewers_comment)) {
                $history = new DocumentHistory;
                $history->document_id = $id;
                $history->activity_type = 'Reviewers';
                $temp = explode(',', $lastDocument->reviewers);
                $revew = [];
                for ($i = 0; $i < count($temp); $i++) {
                    $dataRe = User::where('id', $temp[$i])->value('name');
                    array_push($revew, $dataRe);
                }
                $temped = explode(',', $document->reviewers);
                $revewnew = [];
                for ($i = 0; $i < count($temp); $i++) {
                    $dataRenew = User::where('id', $temped[$i])->value('name');
                    array_push($revewnew, $dataRenew);
                }

                $history->previous = implode(',', $revew);
                $history->current = implode(',', $revewnew);
                $history->comment = $request->reviewers_comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->save();
            }
            if ($lastDocument->approvers != $document->approvers || !empty($request->approvers_comment)) {
                $history = new DocumentHistory;
                $history->document_id = $id;
                $history->activity_type = 'Approvers';
                $temp = explode(',', $lastDocument->approvers);
                $revew = [];
                for ($i = 0; $i < count($temp); $i++) {
                    $dataRe = User::where('id', $temp[$i])->value('name');
                    array_push($revew, $dataRe);
                }
                $temped = explode(',', $document->approvers);
                $revewnew = [];
                for ($i = 0; $i < count($temp); $i++) {
                    $dataRenew = User::where('id', $temped[$i])->value('name');
                    array_push($revewnew, $dataRenew);
                }

                $history->previous = implode(',', $revew);
                $history->current = implode(',', $revewnew);
                $history->comment = $request->approvers_comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->save();
            }
            if ($lastDocument->reviewers_group != $document->reviewers_group || !empty($request->reviewers_group_comment)) {
                $history = new DocumentHistory;
                $history->document_id = $id;
                $history->activity_type = 'Reviewers Group';
                $temp = explode(',', $lastDocument->reviewers_group);
                $revew = [];
                for ($i = 0; $i < count($temp); $i++) {
                    $dataRe = Grouppermission::where('id', $temp[$i])->value('name');
                    array_push($revew, $dataRe);
                }
                $temped = explode(',', $document->reviewers_group);
                $revewnew = [];
                for ($i = 0; $i < count($temp); $i++) {
                    $dataRenew = Grouppermission::where('id', $temped[$i])->value('name');
                    array_push($revewnew, $dataRenew);
                }

                $history->previous = implode(',', $revew);
                $history->current = implode(',', $revewnew);
                $history->comment = $request->reviewers_group_comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->save();
            }
            if ($lastDocument->approver_group != $document->approver_group || !empty($request->approver_group_comment)) {
                $history = new DocumentHistory;
                $history->document_id = $id;
                $history->activity_type = 'Approver Group';
                $temp = explode(',', $lastDocument->approver_group);
                $revew = [];
                for ($i = 0; $i < count($temp); $i++) {
                    $dataRe = Grouppermission::where('id', $temp[$i])->value('name');
                    array_push($revew, $dataRe);
                }
                $temped = explode(',', $document->approver_group);
                $revewnew = [];
                for ($i = 0; $i < count($temp); $i++) {
                    $dataRenew = Grouppermission::where('id', $temped[$i])->value('name');
                    array_push($revewnew, $dataRenew);
                }

                $history->previous = implode(',', $revew);
                $history->current = implode(',', $revewnew);
                $history->comment = $request->approver_group_comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->save();
            }
            if ($lastDocument->revision_summary != $document->revision_summary || !empty($request->revision_summary_comment)) {
                $history = new DocumentHistory;
                $history->document_id = $id;
                $history->activity_type = 'Revision Summery';
                $history->previous = $lastDocument->revision_summary;
                $history->current = $document->revision_summary;
                $history->comment = $request->revision_summary_comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->save();
            }

            $annexure = Annexure::firstOrNew([
                'document_id' => $id
            ]);

            if (!empty($request->serial_number)) {
                $annexure->sno = serialize($request->serial_number);
            }
            if (!empty($request->annexure_number)) {
                $annexure->annexure_no = serialize($request->annexure_number);
            }
            if (!empty($request->annexure_data)) {
                $annexure->annexure_title = serialize($request->annexure_data);
            }
            $annexure->save();

            $documentcontet = DocumentContent::firstOrNew([
                'document_id' => $id
            ]);
            $documentcontet->purpose = $request->purpose;
            $documentcontet->scope = $request->scope;
            $documentcontet->procedure = $request->procedure;
            $documentcontet->revision_summary = $request->revision_summary;
            $documentcontet->safety_precautions = $request->safety_precautions;

            $documentcontet->responsibility = $request->responsibility ? serialize($request->responsibility) : serialize([]);
            $documentcontet->accountability = $request->accountability ? serialize($request->accountability) : serialize([]);
            $documentcontet->abbreviation = $request->abbreviation ? serialize($request->abbreviation) : serialize([]);
            $documentcontet->defination = $request->defination ? serialize($request->defination) : serialize([]);
            $documentcontet->reporting = $request->reporting ? serialize($request->reporting) : serialize([]);
            $documentcontet->materials_and_equipments = $request->materials_and_equipments ? serialize($request->materials_and_equipments) : serialize([]);
            $documentcontet->references = $request->references ? serialize($request->references) : serialize([]);
            $documentcontet->ann = $request->ann ? serialize($request->ann) : serialize([]);

            $documentcontet->hod_comments = $request->hod_comments;

            $files = $request->has('existing_hod_attachments') && is_array($request->existing_hod_attachments) ? array_keys($request->existing_hod_attachments) : [];

            if ($request->has('hod_attachments') && $request->hasFile('hod_attachments')) {
                foreach ($request->file('hod_attachments') as $file) {
                    $name = 'hod_attachments-' . rand(1, 100) . '-' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            $documentcontet->hod_attachments = json_encode($files);

            // if ($request->hasfile('references')) {

            //     $image = $request->file('references');

            //     $ext = $image->getClientOriginalExtension();

            //     $image_name = date('y-m-d').'-'.rand().'.'.$ext;

            //     $image->move('upload/document/', $image_name);

            //     $documentcontet->references = $image_name;
            // }
            if (!empty($request->ann)) {
                $documentcontet->ann = serialize($request->ann);
            }

            if (!empty($request->annexuredata)) {
                $documentcontet->annexuredata = serialize($request->annexuredata);
            }
            if (!empty($request->distribution)) {
                $documentcontet->distribution = serialize($request->distribution);
            }


            $documentcontet->save();

            $specification_id = $document->id;

            //Master Finished Product Specification grid
            $specifications = specifications::where(['specification_id' => $specification_id, 'identifier' => 'specifications'])->firstOrNew();
            $specifications->specification_id = $specification_id;
            $specifications->identifier = 'specifications';
            $specifications->data = json_encode($request->specifications);
            $specifications->save();
            
            //Master Finished Product Standard Testing Procedure grid
            $specifications = specifications::where(['specification_id' => $specification_id, 'identifier' => 'specifications_testing'])->firstOrNew();
            $specifications->specification_id = $specification_id;
            $specifications->identifier = 'specifications_testing';
            $specifications->data = json_encode($request->specifications_testing);
            $specifications->save();

            if ($lastContent->purpose != $documentcontet->purpose || !empty($request->purpose_comment)) {
                $history = new DocumentHistory;
                $history->document_id = $id;
                $history->activity_type = 'Purpose';
                $history->previous = $lastContent->purpose;
                $history->current = $documentcontet->purpose;
                $history->comment = $request->purpose_comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->save();
            }
            if ($lastContent->scope != $documentcontet->scope || !empty($request->scope_comment)) {
                $history = new DocumentHistory;
                $history->document_id = $id;
                $history->activity_type = 'Scope';
                $history->previous = $lastContent->scope;
                $history->current = $documentcontet->scope;
                $history->comment = $request->scope_comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->save();
            }
            if ($lastContent->responsibility != $documentcontet->responsibility || !empty($request->responsibility_comment)) {
                $history = new DocumentHistory;
                $history->document_id = $id;
                $history->activity_type = 'Responsibility';
                $history->previous = $lastContent->responsibility;
                $history->current = $documentcontet->responsibility;
                $history->comment = $request->responsibility_comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->save();
            }
            if ($lastContent->abbreviation != $documentcontet->abbreviation || !empty($request->abbreviation_comment)) {
                $history = new DocumentHistory;
                $history->document_id = $id;
                $history->activity_type = 'Abbreviation';
                $history->previous = $lastContent->abbreviation;
                $history->current = $documentcontet->abbreviation;
                $history->comment = $request->abbreviation_comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->save();
            }
            if ($lastContent->defination != $documentcontet->defination || !empty($request->defination_comment)) {
                $history = new DocumentHistory;
                $history->document_id = $id;
                $history->activity_type = 'Defination';
                $history->previous = $lastContent->defination;
                $history->current = $documentcontet->defination;
                $history->comment = $request->defination_comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->save();
            }
            if ($lastContent->materials_and_equipments != $documentcontet->materials_and_equipments || !empty($request->materials_and_equipments_comment)) {
                $history = new DocumentHistory;
                $history->document_id = $id;
                $history->activity_type = 'Materials and Equipments';
                $history->previous = $lastContent->materials_and_equipments;
                $history->current = $documentcontet->materials_and_equipments;
                $history->comment = $request->materials_and_equipments_comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->save();
            }

            if ($lastContent->procedure != $documentcontet->procedure || !empty($request->procedure_comment)) {
                $history = new DocumentHistory;
                $history->document_id = $id;
                $history->activity_type = 'Procedure';
                $history->previous = $lastContent->procedure;
                $history->current = $documentcontet->procedure;
                $history->comment = $request->procedure_comment;

                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->save();
            }
            if ($lastContent->reporting != $documentcontet->reporting || !empty($request->reporting_comment)) {
                $history = new DocumentHistory;
                $history->document_id = $id;
                $history->activity_type = 'Reporting';
                $history->previous = $lastContent->reporting;
                $history->current = $documentcontet->reporting;
                $history->comment = $request->reporting_comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->save();
            }
            if ($lastContent->references != $documentcontet->references || !empty($request->references_comment)) {
                $history = new DocumentHistory;
                $history->document_id = $id;
                $history->activity_type = 'References';
                $history->previous = $lastContent->references;
                $history->current = $documentcontet->references;
                $history->comment = $request->references_comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->save();
            }

            if ($lastContent->ann != $documentcontet->ann || !empty($request->ann_comment)) {
                $history = new DocumentHistory;
                $history->document_id = $id;
                $history->activity_type = 'Annexure';
                $history->previous = $lastContent->ann;
                $history->current = $documentcontet->ann;
                $history->comment = $request->ann_comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->save();
            }
            if ($lastContent->distribution != $documentcontet->distribution || !empty($request->distribution_comment)) {
                $history = new DocumentHistory;
                $history->document_id = $id;
                $history->activity_type = 'Distribution';
                $history->previous = $lastContent->distribution;
                $history->current = $documentcontet->distribution;
                $history->comment = $request->distribution_comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->save();
            }



            $DocumentGridData = DocumentGrid::firstOrNew(['document_type_id' =>$document->id, 'identifier' => 'Rowmaterialtest']);
            $DocumentGridData->document_type_id = $document->id;
            $DocumentGridData->identifier = 'Rowmaterialtest';
            $DocumentGridData->data = $request->test;
            $DocumentGridData->save();


            

            $PackingGridData = DocumentGrid::firstOrNew(['document_type_id' =>$document->id, 'identifier' => 'Packingmaterialdata']);
            $PackingGridData->document_type_id = $document->id;
            $PackingGridData->identifier = 'Packingmaterialdata';
            $PackingGridData->data = $request->packingtest;
            $PackingGridData->save();

            $GtpGridData = DocumentGrid::firstOrNew(['document_type_id' =>$document->id, 'identifier' => 'gtp']);
            $GtpGridData->document_type_id = $document->id;
            $GtpGridData->identifier = 'gtp';
            $GtpGridData->data = $request->gtp;
            $GtpGridData->save();



            $ProductSpecification = DocumentGrid::firstOrNew(['document_type_id' =>$document->id, 'identifier' => 'ProductSpecification']);
            $ProductSpecification->document_type_id = $document->id;
            $ProductSpecification->identifier = 'ProductSpecification';
            $ProductSpecification->data = $request->product;
            $ProductSpecification->save();



            $MaterialSpecification = DocumentGrid::firstOrNew(['document_type_id' =>$document->id, 'identifier' => 'MaterialSpecification']);
            $MaterialSpecification->document_type_id = $document->id;
            $MaterialSpecification->identifier = 'MaterialSpecification';
            $MaterialSpecification->data = $request->row_material;
            // dd($MaterialSpecification);
            $MaterialSpecification->save();




           
            $Finished_Product = DocumentGrid :: firstOrNew(['document_type_id' =>$document->id, 'identifier' => 'Finished_Product']);
            $Finished_Product->document_type_id = $document->id;
            $Finished_Product->identifier = 'Finished_Product';
            $Finished_Product->data = $request->item;
           // dd($Finished_Product);
            $Finished_Product->save();

            $Inprocess_standard = DocumentGrid :: firstOrNew(['document_type_id' =>$document->id, 'identifier' => 'Inprocess_standard']);
            $Inprocess_standard->document_type_id = $document->id;
            $Inprocess_standard->identifier = 'Inprocess_standard';
            $Inprocess_standard->data = $request->item;
            $Inprocess_standard->save();

            $CLEANING_VALIDATION = DocumentGrid :: firstOrNew(['document_type_id' =>$document->id, 'identifier' => 'CLEANING_VALIDATION']);
            $CLEANING_VALIDATION->document_type_id = $document->id;
            $CLEANING_VALIDATION->identifier = 'CLEANING_VALIDATION';
            $CLEANING_VALIDATION->data = $request->cleaning_validation;
            // dd($CLEANING_VALIDATION);
            $CLEANING_VALIDATION->save();




            $SpecificationData = DocumentGrid::firstOrNew(['document_type_id' => $document->id, 'identifier' => 'SPECIFICATION']);
            $SpecificationData->document_type_id = $document->id;
            $SpecificationData->identifier = 'SPECIFICATION';
            $SpecificationData->data = $request->specification_details;
            $SpecificationData->save();
            
            $Specification_Validation_Data = DocumentGrid::firstOrNew(['document_type_id' => $document->id, 'identifier' => 'SPECIFICATION_VALIDATION']);
            $Specification_Validation_Data->document_type_id = $document->id;
            $Specification_Validation_Data->identifier = 'SPECIFICATION_VALIDATION';
            $Specification_Validation_Data->data = $request->specification_validation_details;
            //dd($Specification_Validation_Data);
            $Specification_Validation_Data->save();



            $SpecificationData_CVS = DocumentGrid::firstOrNew(['document_type_id' => $document->id, 'identifier' => 'SpecificationCleaningValidationSpecification']);
            $SpecificationData_CVS->document_type_id = $document->id;
            $SpecificationData_CVS->identifier = 'SpecificationCleaningValidationSpecification';
            $SpecificationData_CVS->data = $request->specification_details_cvs;
            $SpecificationData_CVS->save();
            
            $Specification_Validation_Data_CVS = DocumentGrid::firstOrNew(['document_type_id' => $document->id, 'identifier' => 'SPECIFICATION_VALIDATION_CleaningValidationSpecification']);
            $Specification_Validation_Data_CVS->document_type_id = $document->id;
            $Specification_Validation_Data_CVS->identifier = 'SPECIFICATION_VALIDATION_CleaningValidationSpecification';
            $Specification_Validation_Data_CVS->data = $request->specification_validation_details_cvs;
            //dd($Specification_Validation_Data_CVS);
            $Specification_Validation_Data_CVS->save();
           


            toastr()->success('Document Updated');
            if (Helpers::checkRoles(3)) {
                return redirect('doc-details/' . $id);
            } else {
                return redirect('rev-details/' . $id);
            }
        } else {
            toastr()->error('Not working');

            return redirect()->back();
        }

        toastr()->success('Document Updated');

        return redirect()->route('documents.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $document = Document::find($id);
        $document->delete();
        toastr()->success('Deleted successfully');

        return redirect()->back();
    }

    public function createPDF($id)
    {
        $roles = explode(',', Auth::user()->role);
        $controls = PrintControl::whereIn('role_id', $roles)->first();

        $department = Department::find(Auth::user()->departmentid);
        $document = Document::find($id);

        if ($document->revised == 'Yes') {
            $latestRevision = Document::where('revised_doc', $document->id)
                                       ->max('minor');
            $revisionNumber = $latestRevision ? (int)$latestRevision + 1 : 1;
            $revisionNumber = str_pad($revisionNumber, 2, '0', STR_PAD_LEFT);
        } else {
            $revisionNumber = '00';
        }

        // department code wise number
        // $documents = Document::orderBy('department_id')->get();
        $departmentId = $document->department_id;

        if (!$departmentId) {
            return redirect()->back()->withErrors(['error' => 'Department ID not associated with this document']);
        }

        $documents = Document::where('department_id', $departmentId)->orderBy('id')->get();

        $counter = 0;
        foreach ($documents as $doc) {
            $counter++;
            $doc->currentId = $counter;


            if ($doc->id == $id) {
                $currentId = $doc->currentId;
            }
        }


        if ($controls) {
            set_time_limit(30);
            $document = Document::find($id);
            $data = Document::find($id);
            $data->department = Department::find($data->department_id);
            $data['originator'] = User::where('id', $data->originator_id)->value('name');
            $time = Carbon::now();
            $data['originator_email'] = User::where('id', $data->originator_id)->value('email');
            $data['document_type_name'] = DocumentType::where('id', $data->document_type_id)->value('name');
            $data['document_type_code'] = DocumentType::where('id', $data->document_type_id)->value('typecode');
            $data['document_division'] = Division::where('id', $data->division_id)->value('name');
            $data['document_content'] = DocumentContent::where('document_id', $id)->first();
            $data['year'] = Carbon::parse($data->created_at)->format('Y');
            // $document = Document::where('id', $id)->get();
            // $pdf = PDF::loadView('frontend.documents.pdfpage', compact('data'))->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);

            $pdf = App::make('dompdf.wrapper');
            $pdf = PDF::loadview('frontend.documents.pdfpage', compact('data', 'time', 'document','documents','currentId'))
                ->setOptions([
                    'defaultFont' => 'sans-serif',
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
                    'isPhpEnabled' => true,
                ]);
            $pdf->setPaper('A4');
            $pdf->render();
            $canvas = $pdf->getDomPDF()->getCanvas();
            $height = $canvas->get_height();
            $width = $canvas->get_width();

            $canvas->page_script('$pdf->set_opacity(0.1,"Multiply");');

            $canvas->page_text(
                $width / 4,
                $height / 2,
                $data->status,
                null,
                25,
                [0, 0, 0],
                2,
                6,
                -20
            );

            if ($controls->daily != 0) {
                $user = DownloadHistory::where('user_id', Auth::user()->id)->where('document_id', $id)->where('date', Carbon::now()->format('d-m-Y'))->count();
                if ($user + 1 <= $controls->daily) {
                    //Downlad History
                    $download = new DownloadHistory;
                    $download->document_id = $id;
                    $download->user_id = Auth::user()->id;
                    $download->role_id = Auth::user()->role;
                    $download->date = Carbon::now()->format('d-m-Y');
                    $download->save();

                    // download PDF file with download method

                    return $pdf->download('SOP' . $id . '.pdf');
                } else {
                    toastr()->error('You breach your daily download limit.');

                    return back();
                }
            } elseif ($controls->weekly != 0) {
                $weekDate = Carbon::now()->subDays(7)->format('d-m-Y');
                $user = DownloadHistory::where('user_id', Auth::user()->id)->where('document_id', $id)->whereBetween('date', [$weekDate, Carbon::now()->format('d-m-Y')])->count();
                if ($user + 1 <= $controls->weekly) {
                    //Downlad History
                    $download = new DownloadHistory;
                    $download->document_id = $id;
                    $download->user_id = Auth::user()->id;
                    $download->role_id = Auth::user()->role;
                    $download->date = Carbon::now()->format('d-m-Y');
                    $download->save();

                    // download PDF file with download method

                    return $pdf->download('SOP' . $id . '.pdf');
                } else {
                    toastr()->error('You breach your weekly download limit.');

                    return back();
                }
            } elseif ($controls->monthly != 0) {
                $weekDate = Carbon::now()->subDays(30)->format('d-m-Y');
                $user = DownloadHistory::where('user_id', Auth::user()->id)->where('document_id', $id)->whereBetween('date', [$weekDate, Carbon::now()->format('d-m-Y')])->count();
                if ($user + 1 <= $controls->monthly) {
                    //Downlad History
                    $download = new DownloadHistory;
                    $download->document_id = $id;
                    $download->user_id = Auth::user()->id;
                    $download->role_id = Auth::user()->role;
                    $download->date = Carbon::now()->format('d-m-Y');
                    $download->save();

                    // download PDF file with download method

                    return $pdf->download('SOP' . $id . '.pdf');
                } else {
                    toastr()->error('You breach your monthly download limit.');

                    return back();
                }
            } elseif ($controls->quatarly != 0) {
                $weekDate = Carbon::now()->subDays(90)->format('d-m-Y');
                $user = DownloadHistory::where('user_id', Auth::user()->id)->where('document_id', $id)->whereBetween('date', [$weekDate, Carbon::now()->format('d-m-Y')])->count();
                if ($user + 1 <= $controls->quatarly) {
                    //Downlad History
                    $download = new DownloadHistory;
                    $download->document_id = $id;
                    $download->user_id = Auth::user()->id;
                    $download->role_id = Auth::user()->role;
                    $download->date = Carbon::now()->format('d-m-Y');
                    $download->save();

                    // download PDF file with download method

                    return $pdf->download('SOP' . $id . '.pdf');
                } else {
                    toastr()->error('You breach your quaterly download limit.');

                    return back();
                }
            } elseif ($controls->yearly != 0) {
                $weekDate = Carbon::now()->subDays(365)->format('d-m-Y');
                $user = DownloadHistory::where('user_id', Auth::user()->id)->where('document_id', $id)->whereBetween('date', [$weekDate, Carbon::now()->format('d-m-Y')])->count();
                if ($user + 1 <= $controls->yearly) {
                    //Downlad History
                    $download = new DownloadHistory;
                    $download->document_id = $id;
                    $download->user_id = Auth::user()->id;
                    $download->role_id = Auth::user()->role;
                    $download->date = Carbon::now()->format('d-m-Y');
                    $download->save();

                    // download PDF file with download method

                    return $pdf->download('SOP' . $id . '.pdf');
                } else {
                    toastr()->error('You breach your yearly download limit.');

                    return back();
                }
            } else {
                toastr()->error('There is no controls provide for your role.');

                return back();
            }
        } else {
            toastr()->error('There is no controls provide for your role.');

            return back();
        }
    }

    // working code here
    // public function viewPdf($id)
    // {

    //     $depaArr = ['ACC' => 'Accounting', 'ACC3' => 'Accounting',];
    //     $data = Document::find($id);
    //     //$data->department = Department::find($data->department_id);
    //     $department = Department::find(Auth::user()->departmentid);
    //     $document = Document::find($id);

    //     if ($document->revised == 'Yes') {
    //         $latestRevision = Document::where('revised_doc', $document->id)
    //                                    ->max('minor');
    //         $revisionNumber = $latestRevision ? (int)$latestRevision + 1 : 1;
    //         $revisionNumber = str_pad($revisionNumber, 2, '0', STR_PAD_LEFT);
    //     } else {
    //         $revisionNumber = '00';
    //     }

    //     // department code wise number
    //     // $documents = Document::orderBy('department_id')->get();
    //     $departmentId = $document->department_id;

    //     if (!$departmentId) {
    //         return redirect()->back()->withErrors(['error' => 'Department ID not associated with this document']);
    //     }

    //     $documents = Document::where('department_id', $departmentId)->orderBy('id')->get();

    //     $counter = 0;
    //     foreach ($documents as $doc) {
    //         $counter++;
    //         $doc->currentId = $counter;


    //         if ($doc->id == $id) {
    //             $currentId = $doc->currentId;
    //         }
    //     }


    //     if ($department) {
    //         $data['department_name'] = $department->name;
    //     } else {
    //         $data['department_name'] = '';
    //     }
    //     $data->department = $department;

    //     $data['originator'] = User::where('id', $data->originator_id)->value('name');
    //     $data['originator_email'] = User::where('id', $data->originator_id)->value('email');
    //     $data['document_type_name'] = DocumentType::where('id', $data->document_type_id)->value('name');
    //     $data['document_type_code'] = DocumentType::where('id', $data->document_type_id)->value('typecode');

    //     $data['document_division'] = Division::where('id', $data->division_id)->value('name');
    //     $data['year'] = Carbon::parse($data->created_at)->format('Y');
    //     $data['document_content'] = DocumentContent::where('document_id', $id)->first();

    //     $documentContent = DocumentContent::where('document_id', $id)->first();
    //     $annexures = [];
    //     if (!empty($documentContent->annexuredata)) {
    //         $annexures = unserialize($documentContent->annexuredata);
    //     }


    //     // pdf related work
    //     $pdf = App::make('dompdf.wrapper');
    //     $time = Carbon::now();

    //     // return view('frontend.documents.pdfpage', compact('data', 'time', 'document'))->render();
    //     // $pdf = PDF::loadview('frontend.documents.new-pdf', compact('data', 'time', 'document'))
    //     $pdf = PDF::loadview('frontend.documents.pdfpage', compact('data', 'time', 'document','annexures','currentId','revisionNumber'))
    //         ->setOptions([
    //             'defaultFont' => 'sans-serif',
    //             'isHtml5ParserEnabled' => true,
    //             'isRemoteEnabled' => true,
    //             'isPhpEnabled' => true,
    //         ]);
    //     $pdf->setPaper('A4');
    //     $pdf->render();
    //     $canvas = $pdf->getDomPDF()->getCanvas();
    //     $canvas->set_default_view('FitB');
    //     $height = $canvas->get_height();
    //     $width = $canvas->get_width();

    //     $canvas->page_script('$pdf->set_opacity(0.1,"Multiply");');

    //     $canvas->page_text(
    //         $width / 4,
    //         $height / 2,
    //         Helpers::getDocStatusByStage($data->stage),
    //         null,
    //         25,
    //         [0, 0, 0],
    //         2,
    //         6,
    //         -20
    //     );

    //     if ($data->documents) {

    //         $pdfArray = explode(',', $data->documents);
    //         foreach ($pdfArray as $pdfFile) {
    //             $existingPdfPath = public_path('upload/PDF/' . $pdfFile);
    //             $permissions = 0644; // Example permission value, change it according to your needs
    //             if (file_exists($existingPdfPath)) {
    //                 // Create a new Dompdf instance
    //                 $options = new Options();
    //                 $options->set('chroot', public_path());
    //                 $options->set('isPhpEnabled', true);
    //                 $options->set('isRemoteEnabled', true);
    //                 $options->set('isHtml5ParserEnabled', true);
    //                 $options->set('allowedFileExtensions', ['pdf']); // Allow PDF file extension

    //                 $dompdf = new Dompdf($options);

    //                 chmod($existingPdfPath, $permissions);

    //                 // Load the existing PDF file
    //                 $dompdf->loadHtmlFile($existingPdfPath);

    //                 // Render the PDF
    //                 $dompdf->render();

    //                 // Output the PDF to the browser
    //                 $dompdf->stream();
    //             }
    //         }
    //     }

    //     return $pdf->stream('SOP' . $id . '.pdf');
    // }


    //working code according to document
    public function viewPdf($id)
    {

        $depaArr = ['ACC' => 'Accounting', 'ACC3' => 'Accounting',];
        $data = Document::find($id);
        //$data->department = Department::find($data->department_id);
        $department = Department::find(Auth::user()->departmentid);
        $document = Document::find($id);

            // Check revision
        if ($document->revised == 'Yes') {
            $latestRevision = Document::where('revised_doc', $document->id)
                                    ->max('minor');
            $revisionNumber = $latestRevision ? (int)$latestRevision + 1 : 1;
            $revisionNumber = str_pad($revisionNumber, 2, '0', STR_PAD_LEFT);
        } else {
            $revisionNumber = '00';
        }

        // Filter documents by department_id and sop_type_short
        $departmentId = $document->department_id;
        $sopTypeShort = $document->sop_type_short;

        if (!$departmentId) {
            return redirect()->back()->withErrors(['error' => 'Department ID not associated with this document']);
        }

        $documents = Document::where('department_id', $departmentId)
            ->where('sop_type_short', $sopTypeShort)
            ->orderBy('id')
            ->get();

        $counter = 0;
        foreach ($documents as $doc) {
            $counter++;
            $doc->currentId = $counter;

            if ($doc->id == $id) {
                $currentId = $doc->currentId;
            }
        }

        if ($department) {
            $data['department_name'] = $department->name;
        } else {
            $data['department_name'] = '';
        }
        $data->department = $department;

        $data['originator'] = User::where('id', $data->originator_id)->value('name');
        $data['originator_email'] = User::where('id', $data->originator_id)->value('email');
        $data['document_type_name'] = DocumentType::where('id', $data->document_type_id)->value('name');
        $data['document_type_code'] = DocumentType::where('id', $data->document_type_id)->value('typecode');

        $data['document_division'] = Division::where('id', $data->division_id)->value('name');
        $data['year'] = Carbon::parse($data->created_at)->format('Y');
        $data['document_content'] = DocumentContent::where('document_id', $id)->first();


        $Finished_Product = DocumentGrid::where('document_type_id', $id)->where('identifier', "Finished_Product")->first();
        $FinishedData = isset($Finished_Product->data) && is_string($Finished_Product->data) 
        ? json_decode($Finished_Product->data, true) :(is_array($Finished_Product->data) ? $Finished_Product->data:[]);

        $Inprocess_standard = DocumentGrid::where('document_type_id', $id)->where('identifier', "Inprocess_standard")->first();
        $Inprocess_standardData = isset($Inprocess_standard->data) && is_string($Inprocess_standard->data) 
        ? json_decode($Inprocess_standard->data, true) :(is_array($Inprocess_standard->data) ? $Inprocess_standard->data:[]);

        $CLEANING_VALIDATION = DocumentGrid::where('document_type_id', $id)->where('identifier', "CLEANING_VALIDATION")->first();
        $CLEANING_VALIDATIONData = isset($CLEANING_VALIDATION->data) && is_string($CLEANING_VALIDATION->data) 
        ? json_decode($CLEANING_VALIDATION->data, true) :(is_array($CLEANING_VALIDATION->data) ? $CLEANING_VALIDATION->data:[]);


        $testDataDecoded = DocumentGrid::where('document_type_id', $id)->where('identifier', "Rowmaterialtest")->first();
            $testData = isset($testDataDecoded->data) && is_string($testDataDecoded->data) 
            ? json_decode($testDataDecoded->data, true) :(is_array($testDataDecoded->data) ? $testDataDecoded->data:[]);
        
        
        $PackingGridData = DocumentGrid::where('document_type_id', $id)->where('identifier', "Packingmaterialdata")->first();
        $PackingDataGrid = isset($PackingGridData->data) && is_string($PackingGridData->data) 
            ? json_decode($PackingGridData->data, true) :(is_array($PackingGridData->data) ? $PackingGridData->data:[]);

        $GtpData = DocumentGrid::where('document_type_id', $id)->where('identifier', "gtp")->first();
        $GtpGridData = isset($GtpData->data) && is_string($GtpData->data) 
            ? json_decode($GtpData->data, true) :(is_array($GtpData->data) ? $GtpData->data:[]);

        $summaryResult = TDSDocumentGrid::where('tds_id', $id)->where('identifier', "summaryResult")->first();
        $SummaryDataGrid = isset($summaryResult->data) && is_string($summaryResult->data) 
            ? json_decode($summaryResult->data, true) :(is_array($summaryResult->data) ? $summaryResult->data:[]);

        $sampleReconcilation = TDSDocumentGrid::where('tds_id', $id)->where('identifier', "sampleReconcilation")->first();
        $sampleReconcilationDataGrid = isset($sampleReconcilation->data) && is_string($sampleReconcilation->data) 
            ? json_decode($sampleReconcilation->data, true) :(is_array($sampleReconcilation->data) ? $sampleReconcilation->data:[]);    

        $specificationsGridData = specifications::where('specification_id', $id)->where('identifier', "specifications_testing")->first();
        $SpecificationDataGrid = isset($specificationsGridData->data) && is_string($specificationsGridData->data) 
            ? json_decode($specificationsGridData->data, true) :(is_array($specificationsGridData->data) ? $specificationsGridData->data:[]);

        $specifications = specifications::where('specification_id', $id)->where('identifier', "specifications")->first();
        $SpecificationGrid = isset($specifications->data) && is_string($specifications->data) 
            ? json_decode($specifications->data, true) :(is_array($specifications->data) ? $specifications->data:[]);

        $ProductSpecification = DocumentGrid::where('document_type_id', $id)->where('identifier', "ProductSpecification")->first();
       
        $ProductSpecificationData = isset($ProductSpecification->data) && is_string($ProductSpecification->data) ? json_decode($ProductSpecification->data,true) : (is_array($ProductSpecification->data) ? $ProductSpecification->data :[]); 
        
        $MaterialSpecification = DocumentGrid::where('document_type_id', $id)->where('identifier', "MaterialSpecification")->first();
        $MaterialSpecificationData = isset($MaterialSpecification->data) && is_string($MaterialSpecification->data) ? json_decode($MaterialSpecification->data,true) : (is_array($MaterialSpecification->data) ? $MaterialSpecification->data : []);
      
        

        $Finished_product_specification  = DocumentGrid::where('document_type_id',$id)->where('identifier','SPECIFICATION')->first();
        $finishedProductSpecificationData = isset($Finished_product_specification->data) && is_string($Finished_product_specification->data) ? json_decode($Finished_product_specification->data) : (is_array($Finished_product_specification->data) ? $Finished_product_specification->data : []);
      
       
        $specificationValidation = DocumentGrid::where('document_type_id',$id)->where('identifier','SPECIFICATION_VALIDATION')->first();
        $specificationValidationData = isset($specificationValidation->data)&& is_string($specificationValidation->data) ? json_decode($specificationValidation->data,true) :(is_array($specificationValidation->data) ? $specificationValidation->data:[]);




        $Finished_product_specification_cvs  = DocumentGrid::where('document_type_id',$id)->where('identifier','SpecificationCleaningValidationSpecification')->first();
        $finishedProductSpecificationData_CVS = isset($Finished_product_specification_cvs->data) && is_string($Finished_product_specification_cvs->data) ? json_decode($Finished_product_specification_cvs->data) : (is_array($Finished_product_specification_cvs->data) ? $Finished_product_specification_cvs->data : []);
    
       
        $specificationValidation_cvs = DocumentGrid::where('document_type_id',$id)->where('identifier','SPECIFICATION_VALIDATION_CleaningValidationSpecification')->first();
        $specificationValidationData_cvs = isset($specificationValidation_cvs->data)&& is_string($specificationValidation_cvs->data) ? json_decode($specificationValidation_cvs->data,true) :(is_array($specificationValidation_cvs->data) ? $specificationValidation_cvs->data:[]);
       
      //  dd($specificationValidation);
       
       
        $documentContent = DocumentContent::where('document_id', $id)->first();
        $annexures = [];
        if (!empty($documentContent->annexuredata)) {
            $annexures = unserialize($documentContent->annexuredata);
        }
        if (empty($data->document_type_id)) {
            return redirect()->back()->withErrors(['error' => 'Document type ID is missing']);
        }

        $viewName = match ($data->document_type_id) {
            'SOP' => 'frontend.documents.pdfpage',
            'BOM' => 'frontend.documents.bom-pdf',
            'FPS' => 'frontend.documents.finished-product-pdf',
            'INPS' => 'frontend.documents.inprocess_s-pdf',
            'CVS' => 'frontend.documents.cleaning_validation_s-pdf',
            'RAWMS' => 'frontend.documents.raw_ms-pdf',
            'PAMS' => 'frontend.documents.package_ms-pdf',
            'PIAS' => 'frontend.documents.product_item-pdf',
            'MFPS' => 'frontend.documents.mfps-pdf',
            'MFPSTP' => 'frontend.documents.mfpstp-pdf',
            'FPSTP' => 'frontend.documents.finished-product-stp-pdf',
            'INPSTP' => 'frontend.documents.inprocess-stp-pdf',
            'CVSTP' => 'frontend.documents.cleaning-validation-stp-pdf',
            'RMSTP' => 'frontend.documents.raw_mstp-pdf',
            'BMR' => 'frontend.documents.bmr-pdf',
            'BPR' => 'frontend.documents.bpr-pdf',
            'SPEC' => 'frontend.documents.spec-pdf',
            'STP' => 'frontend.documents.stp-pdf',
            'TDS' => 'frontend.documents.tds-pdf',
            'GTP' => 'frontend.documents.gtp-pdf',
            'PROTO' => 'frontend.documents.proto-pdf',
            'STUDY' => 'frontend.documents.reports.study_report',
            'TEMPMAPPING' => 'frontend.documents.reports.temperatur-mapping-report',
            'REPORT' => 'frontend.documents.report-pdf',
            'PROVALIDRE' => 'frontend.documents.reports.process-validation-report',
            'PROCUMREPORT' => 'frontend.documents.reports.procumreport',
            'REQULIFICATION'=>'frontend.documents.reports.requlification',
            'SMF' => 'frontend.documents.smf-pdf',
            'VMP' => 'frontend.documents.vmp-pdf',
            'QM' => 'frontend.documents.qm-pdf',
            default => 'frontend.documents.pdfpage',
        };

        // pdf related work
        $pdf = App::make('dompdf.wrapper');
        $time = Carbon::now();

        try {
            $pdf = PDF::loadview($viewName, compact('data', 'time', 'document', 'annexures', 'currentId', 'revisionNumber','testData','PackingDataGrid','sampleReconcilationDataGrid','SummaryDataGrid','SpecificationGrid','SpecificationDataGrid','ProductSpecificationData','MaterialSpecificationData','FinishedData','Inprocess_standardData','CLEANING_VALIDATIONData','GtpGridData','finishedProductSpecificationData','specificationValidationData','finishedProductSpecificationData_CVS','specificationValidationData_cvs'))
                ->setOptions([
                    'defaultFont' => 'sans-serif',
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
                    'isPhpEnabled' => true,
                ]);
        $pdf->setPaper('A4');
        $pdf->render();
        $canvas = $pdf->getDomPDF()->getCanvas();
        $canvas->set_default_view('FitB');
        $height = $canvas->get_height();
        $width = $canvas->get_width();

        $canvas->page_script('$pdf->set_opacity(0.1,"Multiply");');

        // $canvas->page_text(
        //     $width / 4,
        //     $height / 2,
        //     Helpers::getDocStatusByStage($data->stage),
        //     null,
        //     25,
        //     [0, 0, 0],
        //     2,
        //     6,
        //     -20
        // );

        $canvas->page_text(
            $width / 2.4,
            $height / 2,
            Helpers::getDocStatusByStage($data->stage),
            null,
            25,
            [0, 0, 0],
            2,
            6,
            -20
        );


        if ($data->documents) {

            $pdfArray = explode(',', $data->documents);
            foreach ($pdfArray as $pdfFile) {
                $existingPdfPath = public_path('upload/PDF/' . $pdfFile);
                $permissions = 0644; // Example permission value, change it according to your needs
                if (file_exists($existingPdfPath)) {
                    // Create a new Dompdf instance
                    $options = new Options();
                    $options->set('chroot', public_path());
                    $options->set('isPhpEnabled', true);
                    $options->set('isRemoteEnabled', true);
                    $options->set('isHtml5ParserEnabled', true);
                    $options->set('allowedFileExtensions', ['pdf']); // Allow PDF file extension

                    $dompdf = new Dompdf($options);

                    chmod($existingPdfPath, $permissions);

                    // Load the existing PDF file
                    $dompdf->loadHtmlFile($existingPdfPath);

                    // Render the PDF
                    $dompdf->render();

                    // Output the PDF to the browser
                    $dompdf->stream();
                }
            }
        }

          return $pdf->stream($data['document_type_code'] . '_' . $id . '.pdf');
        } catch (\Exception $e) {
            \Log::error('PDF Generation Error: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'PDF generation failed']);
        }
    }


    public function annexureviewPdf($id)
    {

        $depaArr = ['ACC' => 'Accounting', 'ACC3' => 'Accounting',];
        $data = Document::find($id);
        //$data->department = Department::find($data->department_id);
        $department = Department::find(Auth::user()->departmentid);
        $document = Document::find($id);

        if ($document->revised == 'Yes') {
            $latestRevision = Document::where('revised_doc', $document->id)
                                       ->max('minor');
            $revisionNumber = $latestRevision ? (int)$latestRevision + 1 : 1;
            $revisionNumber = str_pad($revisionNumber, 2, '0', STR_PAD_LEFT);
        } else {
            $revisionNumber = '00';
        }

        // department code wise number
        // $documents = Document::orderBy('department_id')->get();
        $departmentId = $document->department_id;

        if (!$departmentId) {
            return redirect()->back()->withErrors(['error' => 'Department ID not associated with this document']);
        }

        $documents = Document::where('department_id', $departmentId)->orderBy('id')->get();

        $counter = 0;
        foreach ($documents as $doc) {
            $counter++;
            $doc->currentId = $counter;


            if ($doc->id == $id) {
                $currentId = $doc->currentId;
            }
        }


        if ($department) {
            $data['department_name'] = $department->name;
        } else {
            $data['department_name'] = '';
        }
        $data->department = $department;

        $data['originator'] = User::where('id', $data->originator_id)->value('name');
        $data['originator_email'] = User::where('id', $data->originator_id)->value('email');
        $data['document_type_name'] = DocumentType::where('id', $data->document_type_id)->value('name');
        $data['document_type_code'] = DocumentType::where('id', $data->document_type_id)->value('typecode');

        $data['document_division'] = Division::where('id', $data->division_id)->value('name');
        $data['year'] = Carbon::parse($data->created_at)->format('Y');
        $data['document_content'] = DocumentContent::where('document_id', $id)->first();

        $documentContent = DocumentContent::where('document_id', $id)->first();
        $annexures = [];
        if (!empty($documentContent->annexuredata)) {
            $annexures = unserialize($documentContent->annexuredata);
        }


        // pdf related work
        $pdf = App::make('dompdf.wrapper');
        $time = Carbon::now();

        // return view('frontend.documents.pdfpage', compact('data', 'time', 'document'))->render();
        // $pdf = PDF::loadview('frontend.documents.new-pdf', compact('data', 'time', 'document'))
        $pdf = PDF::loadview('frontend.documents.annexure-pdf', compact('data', 'time', 'document','annexures','currentId','revisionNumber'))
            ->setOptions([
                'defaultFont' => 'sans-serif',
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'isPhpEnabled' => true,
            ]);
        $pdf->setPaper('A4');
        $pdf->render();
        $canvas = $pdf->getDomPDF()->getCanvas();
        $canvas->set_default_view('FitB');
        $height = $canvas->get_height();
        $width = $canvas->get_width();

        $canvas->page_script('$pdf->set_opacity(0.1,"Multiply");');

        $canvas->page_text(
            $width / 2.4,
            $height / 2,
            Helpers::getDocStatusByStage($data->stage),
            null,
            25,
            [0, 0, 0],
            2,
            6,
            -20
        );

        if ($data->documents) {

            $pdfArray = explode(',', $data->documents);
            foreach ($pdfArray as $pdfFile) {
                $existingPdfPath = public_path('upload/PDF/' . $pdfFile);
                $permissions = 0644; // Example permission value, change it according to your needs
                if (file_exists($existingPdfPath)) {
                    // Create a new Dompdf instance
                    $options = new Options();
                    $options->set('chroot', public_path());
                    $options->set('isPhpEnabled', true);
                    $options->set('isRemoteEnabled', true);
                    $options->set('isHtml5ParserEnabled', true);
                    $options->set('allowedFileExtensions', ['pdf']); // Allow PDF file extension

                    $dompdf = new Dompdf($options);

                    chmod($existingPdfPath, $permissions);

                    // Load the existing PDF file
                    $dompdf->loadHtmlFile($existingPdfPath);

                    // Render the PDF
                    $dompdf->render();

                    // Output the PDF to the browser
                    $dompdf->stream();
                }
            }
        }

        return $pdf->stream('SOP' . $id . '.pdf');
    }

    public function printPDF($id)
    {
        $roles = explode(',', Auth::user()->role);
        $controls = PrintControl::whereIn('role_id', $roles)->first();

        $department = Department::find(Auth::user()->departmentid);
        $document = Document::find($id);

        if ($document->revised == 'Yes') {
            $latestRevision = Document::where('revised_doc', $document->id)
                                       ->max('minor');
            $revisionNumber = $latestRevision ? (int)$latestRevision + 1 : 1;
            $revisionNumber = str_pad($revisionNumber, 2, '0', STR_PAD_LEFT);
        } else {
            $revisionNumber = '00';
        }

        // department code wise number
        // $documents = Document::orderBy('department_id')->get();
        $departmentId = $document->department_id;

        if (!$departmentId) {
            return redirect()->back()->withErrors(['error' => 'Department ID not associated with this document']);
        }

        $documents = Document::where('department_id', $departmentId)->orderBy('id')->get();

        $counter = 0;
        foreach ($documents as $doc) {
            $counter++;
            $doc->currentId = $counter;


            if ($doc->id == $id) {
                $currentId = $doc->currentId;
            }
        }


        if ($controls) {
            set_time_limit(30);
            $document = Document::find($id);
            $data = Document::find($id);
            $data->department = Department::find($data->department_id);
            $data['originator'] = User::where('id', $data->originator_id)->value('name');
            $data['originator_email'] = User::where('id', $data->originator_id)->value('email');
            $data['document_content'] = DocumentContent::where('document_id', $id)->first();
            $data['document_type_name'] = DocumentType::where('id', $data->document_type_id)->value('name');
            $data['document_type_code'] = DocumentType::where('id', $data->document_type_id)->value('typecode');
            $data['document_division'] = Division::where('id', $data->division_id)->value('name');

            $data['year'] = Carbon::parse($data->created_at)->format('Y');
            // $document = Document::where('id', $id)->get();
            // $pdf = PDF::loadView('frontend.documents.pdfpage', compact('data'))->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
            $documentContent = DocumentContent::where('document_id', $id)->first();
            $annexures = [];
            if (!empty($documentContent->annexuredata)) {
                $annexures = unserialize($documentContent->annexuredata);
            }

            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.documents.pdfpage', compact('data', 'time', 'document','annexures','currentId','documents'))
                ->setOptions([
                    'defaultFont' => 'sans-serif',
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
                    'isPhpEnabled' => true,
                ]);
            $pdf->setPaper('A4');

            $pdf->render();
            $canvas = $pdf->getDomPDF()->getCanvas();
            $height = $canvas->get_height();
            $width = $canvas->get_width();

            $canvas->page_script('$pdf->set_opacity(0.1,"Multiply");');

            $canvas->page_text(
                $width / 4,
                $height / 2,
                $data->status,
                null,
                25,
                [0, 0, 0],
                2,
                6,
                -20
            );

            if ($controls->daily != 0) {
                $user = PrintHistory::where('user_id', Auth::user()->id)->where('document_id', $id)->where('date', Carbon::now()->format('d-m-Y'))->count();
                if ($user + 1 <= $controls->daily) {
                    //Downlad History
                    $download = new PrintHistory;
                    $download->document_id = $id;
                    $download->user_id = Auth::user()->id;
                    $download->role_id = Auth::user()->role;
                    $download->date = Carbon::now()->format('d-m-Y');
                    $download->save();

                    // download PDF file with download method

                    return $pdf->stream('SOP' . $id . '.pdf');
                } else {
                    toastr()->error('You breach your daily print limit.');

                    return back();
                }
            } elseif ($controls->weekly != 0) {
                $weekDate = Carbon::now()->subDays(7)->format('d-m-Y');
                $user = PrintHistory::where('user_id', Auth::user()->id)->where('document_id', $id)->whereBetween('date', [$weekDate, Carbon::now()->format('d-m-Y')])->count();
                if ($user + 1 <= $controls->weekly) {
                    //Downlad History
                    $download = new PrintHistory;
                    $download->document_id = $id;
                    $download->user_id = Auth::user()->id;
                    $download->role_id = Auth::user()->role;
                    $download->date = Carbon::now()->format('d-m-Y');
                    $download->save();

                    // download PDF file with download method
                    return $pdf->stream('SOP' . $id . '.pdf');
                } else {
                    toastr()->error('You breach your weekly print limit.');

                    return back();
                }
            } elseif ($controls->monthly != 0) {
                $weekDate = Carbon::now()->subDays(30)->format('d-m-Y');
                $user = PrintHistory::where('user_id', Auth::user()->id)->where('document_id', $id)->whereBetween('date', [$weekDate, Carbon::now()->format('d-m-Y')])->count();
                if ($user + 1 <= $controls->monthly) {
                    //Downlad History
                    $download = new PrintHistory;
                    $download->document_id = $id;
                    $download->user_id = Auth::user()->id;
                    $download->role_id = Auth::user()->role;
                    $download->date = Carbon::now()->format('d-m-Y');
                    $download->save();

                    // download PDF file with download method

                    return $pdf->download('SOP' . $id . '.pdf');
                } else {
                    toastr()->error('You breach your monthly print limit.');

                    return back();
                }
            } elseif ($controls->quatarly != 0) {
                $weekDate = Carbon::now()->subDays(90)->format('d-m-Y');
                $user = PrintHistory::where('user_id', Auth::user()->id)->where('document_id', $id)->whereBetween('date', [$weekDate, Carbon::now()->format('d-m-Y')])->count();
                if ($user + 1 <= $controls->quatarly) {
                    //Downlad History
                    $download = new PrintHistory;
                    $download->document_id = $id;
                    $download->user_id = Auth::user()->id;
                    $download->role_id = Auth::user()->role;
                    $download->date = Carbon::now()->format('d-m-Y');
                    $download->save();

                    // download PDF file with download method

                    return $pdf->stream('SOP' . $id . '.pdf');
                } else {
                    toastr()->error('You breach your quaterly print limit.');

                    return back();
                }
            } elseif ($controls->yearly != 0) {
                $weekDate = Carbon::now()->subDays(365)->format('d-m-Y');
                $user = PrintHistory::where('user_id', Auth::user()->id)->where('document_id', $id)->whereBetween('date', [$weekDate, Carbon::now()->format('d-m-Y')])->count();
                if ($user + 1 <= $controls->yearly) {
                    //Downlad History
                    $download = new PrintHistory;
                    $download->document_id = $id;
                    $download->user_id = Auth::user()->id;
                    $download->role_id = Auth::user()->role;
                    $download->date = Carbon::now()->format('d-m-Y');
                    $download->save();

                    // download PDF file with download method

                    return $pdf->stream('SOP' . $id . '.pdf');
                } else {
                    toastr()->error('You breach your yearly print limit.');

                    return back();
                }
            } else {
                toastr()->error('There is no controls provide for your role.');

                return back();
            }
        } else {
            toastr()->error('There is no controls provide for your role.');

            return back();
        }
    }

    public function printAnnexurePDF($id)
    {
        $roles = explode(',', Auth::user()->role);
        $controls = PrintControl::whereIn('role_id', $roles)->first();

        $department = Department::find(Auth::user()->departmentid);
        $document = Document::find($id);

        if ($document->revised == 'Yes') {
            $latestRevision = Document::where('revised_doc', $document->id)
                                       ->max('minor');
            $revisionNumber = $latestRevision ? (int)$latestRevision + 1 : 1;
            $revisionNumber = str_pad($revisionNumber, 2, '0', STR_PAD_LEFT);
        } else {
            $revisionNumber = '00';
        }

        // department code wise number
        // $documents = Document::orderBy('department_id')->get();
        $departmentId = $document->department_id;

        if (!$departmentId) {
            return redirect()->back()->withErrors(['error' => 'Department ID not associated with this document']);
        }

        $documents = Document::where('department_id', $departmentId)->orderBy('id')->get();

        $counter = 0;
        foreach ($documents as $doc) {
            $counter++;
            $doc->currentId = $counter;


            if ($doc->id == $id) {
                $currentId = $doc->currentId;
            }
        }


        if ($controls) {
            set_time_limit(30);
            $document = Document::find($id);
            $data = Document::find($id);
            $data->department = Department::find($data->department_id);
            $data['originator'] = User::where('id', $data->originator_id)->value('name');
            $data['originator_email'] = User::where('id', $data->originator_id)->value('email');
            $data['document_content'] = DocumentContent::where('document_id', $id)->first();
            $data['document_type_name'] = DocumentType::where('id', $data->document_type_id)->value('name');
            $data['document_type_code'] = DocumentType::where('id', $data->document_type_id)->value('typecode');
            $data['document_division'] = Division::where('id', $data->division_id)->value('name');

            $data['year'] = Carbon::parse($data->created_at)->format('Y');
            // $document = Document::where('id', $id)->get();
            // $pdf = PDF::loadView('frontend.documents.pdfpage', compact('data'))->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
            $documentContent = DocumentContent::where('document_id', $id)->first();
            $annexures = [];
            if (!empty($documentContent->annexuredata)) {
                $annexures = unserialize($documentContent->annexuredata);
            }

            

            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.documents.annexure-pdf', compact('data', 'time', 'document','annexures','currentId','documents'))
                ->setOptions([
                    'defaultFont' => 'sans-serif',
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
                    'isPhpEnabled' => true,
                ]);
            $pdf->setPaper('A4');

            $pdf->render();
            $canvas = $pdf->getDomPDF()->getCanvas();
            $height = $canvas->get_height();
            $width = $canvas->get_width();

            $canvas->page_script('$pdf->set_opacity(0.1,"Multiply");');

            $canvas->page_text(
                $width / 4,
                $height / 2,
                $data->status,
                null,
                25,
                [0, 0, 0],
                2,
                6,
                -20
            );

            if ($controls->daily != 0) {
                $user = PrintHistory::where('user_id', Auth::user()->id)->where('document_id', $id)->where('date', Carbon::now()->format('d-m-Y'))->count();
                if ($user + 1 <= $controls->daily) {
                    //Downlad History
                    $download = new PrintHistory;
                    $download->document_id = $id;
                    $download->user_id = Auth::user()->id;
                    $download->role_id = Auth::user()->role;
                    $download->date = Carbon::now()->format('d-m-Y');
                    $download->save();

                    // download PDF file with download method

                    return $pdf->stream('SOP' . $id . '.pdf');
                } else {
                    toastr()->error('You breach your daily print limit.');

                    return back();
                }
            } elseif ($controls->weekly != 0) {
                $weekDate = Carbon::now()->subDays(7)->format('d-m-Y');
                $user = PrintHistory::where('user_id', Auth::user()->id)->where('document_id', $id)->whereBetween('date', [$weekDate, Carbon::now()->format('d-m-Y')])->count();
                if ($user + 1 <= $controls->weekly) {
                    //Downlad History
                    $download = new PrintHistory;
                    $download->document_id = $id;
                    $download->user_id = Auth::user()->id;
                    $download->role_id = Auth::user()->role;
                    $download->date = Carbon::now()->format('d-m-Y');
                    $download->save();

                    // download PDF file with download method
                    return $pdf->stream('SOP' . $id . '.pdf');
                } else {
                    toastr()->error('You breach your weekly print limit.');

                    return back();
                }
            } elseif ($controls->monthly != 0) {
                $weekDate = Carbon::now()->subDays(30)->format('d-m-Y');
                $user = PrintHistory::where('user_id', Auth::user()->id)->where('document_id', $id)->whereBetween('date', [$weekDate, Carbon::now()->format('d-m-Y')])->count();
                if ($user + 1 <= $controls->monthly) {
                    //Downlad History
                    $download = new PrintHistory;
                    $download->document_id = $id;
                    $download->user_id = Auth::user()->id;
                    $download->role_id = Auth::user()->role;
                    $download->date = Carbon::now()->format('d-m-Y');
                    $download->save();

                    // download PDF file with download method

                    return $pdf->download('SOP' . $id . '.pdf');
                } else {
                    toastr()->error('You breach your monthly print limit.');

                    return back();
                }
            } elseif ($controls->quatarly != 0) {
                $weekDate = Carbon::now()->subDays(90)->format('d-m-Y');
                $user = PrintHistory::where('user_id', Auth::user()->id)->where('document_id', $id)->whereBetween('date', [$weekDate, Carbon::now()->format('d-m-Y')])->count();
                if ($user + 1 <= $controls->quatarly) {
                    //Downlad History
                    $download = new PrintHistory;
                    $download->document_id = $id;
                    $download->user_id = Auth::user()->id;
                    $download->role_id = Auth::user()->role;
                    $download->date = Carbon::now()->format('d-m-Y');
                    $download->save();

                    // download PDF file with download method

                    return $pdf->stream('SOP' . $id . '.pdf');
                } else {
                    toastr()->error('You breach your quaterly print limit.');

                    return back();
                }
            } elseif ($controls->yearly != 0) {
                $weekDate = Carbon::now()->subDays(365)->format('d-m-Y');
                $user = PrintHistory::where('user_id', Auth::user()->id)->where('document_id', $id)->whereBetween('date', [$weekDate, Carbon::now()->format('d-m-Y')])->count();
                if ($user + 1 <= $controls->yearly) {
                    //Downlad History
                    $download = new PrintHistory;
                    $download->document_id = $id;
                    $download->user_id = Auth::user()->id;
                    $download->role_id = Auth::user()->role;
                    $download->date = Carbon::now()->format('d-m-Y');
                    $download->save();

                    // download PDF file with download method

                    return $pdf->stream('SOP' . $id . '.pdf');
                } else {
                    toastr()->error('You breach your yearly print limit.');

                    return back();
                }
            } else {
                toastr()->error('There is no controls provide for your role.');

                return back();
            }
        } else {
            toastr()->error('There is no controls provide for your role.');

            return back();
        }
    }



    public function import(Request $request)
    {
        // $request->validate([
        //     'file' => 'required|mimes:xlsx,xls,csv,pdf'
        // ]);
        if ($request->hasFile('files')) {
            $uploadedFiles = $request->file('files');
            foreach ($uploadedFiles as $uploadedFile) {
                $extension = $uploadedFile->getClientOriginalExtension();
                if ($extension === 'pdf') {
                    // Process PDF file
                    $originalName = $uploadedFile->getClientOriginalName();
                    $destinationPath = public_path('upload/PDF');

                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }

                    // $file = $request->file('file');
                    $storedFileName = $uploadedFile->storeAs('upload/PDF', $originalName);

                    toastr()->success('PDF file uploaded successfully!');
                } elseif ($extension === 'csv' || $extension === 'xls' || $extension === 'xlsx') {
                    $import = new DocumentsImport();
                    Excel::import($import, $uploadedFile);

                    toastr()->success('CSV file imported successfully!');
                } else {
                    toastr()->error('Invalid file format. Only PDF and CSV files are allowed.');
                }
            }

            return back();
        }

        toastr()->error('No files uploaded!');

        return back();
    }

    // public function revision(Request $request, $id)
    // {

    //     $document = Document::find($id);

    //     $revisionExists = Document::where([
    //         'document_type_id' => $document->document_type_id,
    //         'document_number' => $document->document_number,
    //         'major' => $request->major,
    //         'minor' => $request->minor
    //     ])->first();

    //     if ($revisionExists) {
    //         toastr()->error('Same version of document is already revised!!');
    //         return redirect()->back();
    //     } else {
    //         $document->revision = 'Yes';
    //         $document->revision_policy = $request->revision;
    //         $document->update();
    //         $newdoc = new Document();
    //         $newdoc->originator_id = $document->originator_id;
    //         $newdoc->division_id = $document->division_id;
    //         $newdoc->process_id = $document->process_id;
    //         $newdoc->revised = 'Yes';
    //         $newdoc->revised_doc = $document->id;
    //         $newdoc->document_name = $document->document_name;
    //         $newdoc->major = $request->major;
    //         $newdoc->minor = $document->minor + 1;
    //         $newdoc->sop_type = $request->sop_type;
    //         $newdoc->short_description = $document->short_description;
    //         $newdoc->due_dateDoc = $document->due_dateDoc;
    //         $newdoc->description = $document->description;
    //         $newdoc->notify_to = json_encode($document->notify_to);
    //         $newdoc->reference_record = $document->reference_record;
    //         $newdoc->department_id = $document->department_id;
    //         $newdoc->document_type_id = $document->document_type_id;
    //         $newdoc->document_subtype_id = $document->document_subtype_id;
    //         $newdoc->document_language_id = $document->document_language_id;
    //         $newdoc->keywords = $document->keywords;
    //         // $newdoc->effective_date = $document->effective_date;
    //         $newdoc->next_review_date = $document->next_review_date;
    //         // $newdoc->review_period = $document->review_period;
    //         $newdoc->attach_draft_doocument = $document->attach_draft_doocument;
    //         $newdoc->attach_effective_docuement = $document->attach_effective_docuement;
    //         $newdoc->approvers = $document->approvers;
    //         $newdoc->reviewers = $document->reviewers;
    //         $newdoc->approver_group = $document->approver_group;
    //         $newdoc->reviewers_group = $document->reviewers_group;
    //         $newdoc->revision_summary = $document->revision_summary;
    //         $newdoc->training_required = $document->training_required;
    //         $newdoc->trainer = $request->trainer;
    //         $newdoc->hods = $document->hods;
    //         $newdoc->document_number = $document->document_number;
    //         $newdoc->comments = $request->comments;
    //         //$newdoc->purpose = $request->purpose;
    //         $newdoc->stage = 1;
    //         $newdoc->status = Stage::where('id', 1)->value('name');
    //         $newdoc->save();

    //         $doc_content = new DocumentContent();
    //         $doc_content->document_id = $newdoc->id;
    //         $doc_content->purpose = $doc_content->purpose;
    //         $doc_content->scope = $doc_content->scope;
    //         $doc_content->responsibility = $doc_content->responsibility;
    //         $doc_content->abbreviation = $doc_content->abbreviation;
    //         $doc_content->defination = $doc_content->defination;
    //         $doc_content->materials_and_equipments = $doc_content->materials_and_equipments;
    //         $doc_content->procedure = $doc_content->procedure;
    //         $doc_content->reporting = $doc_content->reporting;
    //         $doc_content->references = $doc_content->references;
    //         $doc_content->ann = $doc_content->ann;
    //         $doc_content->distribution = $doc_content->distribution;
    //         $doc_content->save();

    //         if ($document->training_required == 'yes') {
    //             $docTrain = DocumentTraining::where('document_id', $document->id)->first();
    //             if (!empty($docTrain)) {
    //                 $trainning = new DocumentTraining();
    //                 $trainning->document_id = $newdoc->id;
    //                 $trainning->trainer = $docTrain->trainer;
    //                 $trainning->cbt = $docTrain->cbt;
    //                 $trainning->type = $docTrain->type;
    //                 $trainning->comments = $docTrain->comments;
    //                 $trainning->save();
    //             }
    //         }

    //         $annexure = Annexure::where('document_id', $id)->first();
    //         $new_annexure = new Annexure();
    //         $new_annexure->document_id = $newdoc->id;
    //         $new_annexure->sno = $annexure->sno;
    //         $new_annexure->annexure_no = $annexure->annexure_no;
    //         $new_annexure->annexure_title = $annexure->annexure_title;
    //         $new_annexure->save();

    //         toastr()->success('Document is revised, you can change the body!!');
    //         return redirect()->route('documents.edit', $newdoc->id);
    //     }
    // }

        public function revision(Request $request, $id)
        {

            $document = Document::find($id);

            if (!$document) {
                toastr()->error('Document not found!');
                return redirect()->back();
            }
        
            // **Step 1: Find the latest revised_doc for this document_number**
            $lastRevision = Document::where('record', $document->record)
                                     ->whereNotNull('revised_doc') 
                                     ->orderBy('revised_doc', 'desc') // Get the highest revised_doc
                                     ->first();
        
            // **Step 2: Determine the next revision number**
            $nextRevision = $lastRevision ? $lastRevision->revised_doc + 1 : 1; 
        
            // **Step 3: Update major & minor version**
            $requestedMajor = (int)$document->major;
            $requestedMinor = (int)$document->minor;
        
            if ($requestedMinor < 9) {
                $requestedMinor += 1;
            } else {
                $requestedMinor = 1;
                $requestedMajor += 1;
            }
        
            // **Step 4: Check if this version already exists**
            $revisionExists = Document::where([
                'document_type_id' => $document->document_type_id,
                'document_number' => $document->document_number,
                'major' => $requestedMajor,
                'minor' => $requestedMinor
            ])->first();
        
            if ($revisionExists) {
                toastr()->error('A document with this version already exists!');
                return redirect()->back();
            }
        
            // **Step 5: Mark original document as revised**
            $document->revision = 'Yes';
            $document->revision_policy = $request->revision;
            $document->update();
        
            // **Step 6: Create a new revision**
            $newdoc = $document->replicate();
            $newdoc->revised = 'Yes';
            $newdoc->revised_doc = $nextRevision;  // **This will be incremented correctly**
            $newdoc->major = $requestedMajor;
            $newdoc->minor = $requestedMinor;
            $newdoc->reason = $request->reason;
            $newdoc->trainer = $request->trainer;
            $newdoc->comments = $request->comment;
            $newdoc->stage = 1;
            $newdoc->status = Stage::where('id', 1)->value('name');
            $newdoc->save();


            \Log::info("New Document Saved: Major: $newdoc->major, Minor: $newdoc->minor");

            $docContent = DocumentContent::where('document_id', $document->id)->first();
            if ($docContent) {
                $newDocContent = $docContent->replicate();
                $newDocContent->document_id = $newdoc->id;
                $newDocContent->save();
            }

            $annexure = Annexure::where('document_id', $document->id)->first();
            if ($annexure) {
                $newAnnexure = $annexure->replicate();
                $newAnnexure->document_id = $newdoc->id;
                $newAnnexure->save();
            }

            if ($document->training_required == 'yes') {
                $docTrain = DocumentTraining::where('document_id', $document->id)->first();
                if ($docTrain) {
                    $newTraining = $docTrain->replicate();
                    $newTraining->document_id = $newdoc->id;
                    $newTraining->save();
                }
            }

            $distribution_grid = DocumentGridData::where('document_id', $document->id)->first();
            if ($distribution_grid) {
                $distribution = $distribution_grid->replicate();
                $distribution->document_id = $newdoc->id;
                $distribution->save();
            }
            $specification_id = $document->id;
            $specifications = specifications::where(['specification_id' => $specification_id, 'identifier' => 'specifications'])->first();
            if ($specifications) {
                $distribution = $specifications->replicate();
                $distribution->identifier = 'specifications';
                $distribution->specification_id = $newdoc->id;
                $distribution->save();
            }

            $specifications_testing = specifications::where(['specification_id' => $specification_id, 'identifier' => 'specifications_testing'])->first();
            if ($specifications_testing) {
                $distribution = $specifications_testing->replicate();
                $distribution->identifier = 'specifications_testing';
                $distribution->specification_id = $newdoc->id;
                $distribution->save();
            }





                    
                
            $DocumentGridData = DocumentGrid::where(['document_type_id' =>$document->id, 'identifier' => 'Rowmaterialtest'])->first();

            $DocumentGridData = $DocumentGridData->replicate();
            $DocumentGridData->document_type_id = $newdoc->id;
            $DocumentGridData->identifier = 'Rowmaterialtest';
        
            $DocumentGridData->save();




            $PackingGridData = DocumentGrid::where(['document_type_id' =>$document->id, 'identifier' => 'Packingmaterialdata'])->first();
            $PackingGridData = $PackingGridData->replicate();
            $PackingGridData->document_type_id = $newdoc->id;
            $PackingGridData->identifier = 'Packingmaterialdata';
        
            $PackingGridData->save();

            $GtpGridData = DocumentGrid::where(['document_type_id' =>$document->id, 'identifier' => 'gtp'])->first();
            $GtpGridData = $GtpGridData->replicate();
            $GtpGridData->document_type_id = $newdoc->id;
            $GtpGridData->identifier = 'gtp';
        
            $GtpGridData->save();



            $ProductSpecification = DocumentGrid::where(['document_type_id' =>$document->id, 'identifier' => 'ProductSpecification'])->first();
            $ProductSpecification = $ProductSpecification->replicate();
            $ProductSpecification->document_type_id = $newdoc->id;
            $ProductSpecification->identifier = 'ProductSpecification';
            
            $ProductSpecification->save();



            $MaterialSpecification = DocumentGrid::where(['document_type_id' =>$document->id, 'identifier' => 'MaterialSpecification'])->first();
            $MaterialSpecification = $MaterialSpecification->replicate();
            $MaterialSpecification->document_type_id = $newdoc->id;
            $MaterialSpecification->identifier = 'MaterialSpecification';
        
            // dd($MaterialSpecification);
            $MaterialSpecification->save();





            $Finished_Product = DocumentGrid::where(['document_type_id' =>$document->id, 'identifier' => 'Finished_Product'])->first();
            $Finished_Product = $Finished_Product->replicate();
            $Finished_Product->document_type_id = $newdoc->id;
            $Finished_Product->identifier = 'Finished_Product';
            
            // dd($Finished_Product);
            $Finished_Product->save();

            $Inprocess_standard = DocumentGrid::where(['document_type_id' =>$document->id, 'identifier' => 'Inprocess_standard'])->first();
            $Inprocess_standard = $Inprocess_standard->replicate();
            $Inprocess_standard->document_type_id = $newdoc->id;
            $Inprocess_standard->identifier = 'Inprocess_standard';
        
            $Inprocess_standard->save();

            $CLEANING_VALIDATION = DocumentGrid::where(['document_type_id' =>$document->id, 'identifier' => 'CLEANING_VALIDATION'])->first();
            $CLEANING_VALIDATION = $CLEANING_VALIDATION->replicate();
            $CLEANING_VALIDATION->document_type_id = $newdoc->id;
            $CLEANING_VALIDATION->identifier = 'CLEANING_VALIDATION';
        
            // dd($CLEANING_VALIDATION);
            $CLEANING_VALIDATION->save();
        
        DocumentService::update_document_numbers();

        $CLEANING_VALIDATION = DocumentGrid::where(['document_type_id' =>$document->id, 'identifier' => 'CLEANING_VALIDATION'])->first();
        $CLEANING_VALIDATION = $CLEANING_VALIDATION->replicate();
        $CLEANING_VALIDATION->document_type_id = $newdoc->id;
        $CLEANING_VALIDATION->identifier = 'CLEANING_VALIDATION';
       // dd($CLEANING_VALIDATION);
        $CLEANING_VALIDATION->save();


        $SpecificationData = DocumentGrid::where(['document_type_id' =>$document->id, 'identifier' => 'SPECIFICATION'])->first();
        $SpecificationData = $SpecificationData->replicate();
        
        $SpecificationData->document_type_id = $newdoc->id;
        $SpecificationData->identifier = 'SPECIFICATION';
        $SpecificationData->save();
        
        $Specification_Validation_Data = DocumentGrid::where(['document_type_id' =>$document->id, 'identifier' => 'SPECIFICATION_VALIDATION'])->first();
       
        $Specification_Validation_Data = $Specification_Validation_Data->replicate();
        $Specification_Validation_Data->document_type_id = $newdoc->id;
        $Specification_Validation_Data->identifier = 'SPECIFICATION_VALIDATION';
        //dd($Specification_Validation_Data);
        $Specification_Validation_Data->save();
       
    // Cleaning Specification Validation
        $SpecificationData_cvs = DocumentGrid::where(['document_type_id' =>$document->id, 'identifier' => 'SpecificationCleaningValidationSpecification'])->first();
        $SpecificationData_cvs = $SpecificationData_cvs->replicate();
        
        $SpecificationData_cvs->document_type_id = $newdoc->id;
        $SpecificationData_cvs->identifier = 'SpecificationCleaningValidationSpecification';
        $SpecificationData_cvs->save();
        
        $Specification_Validation_Data_cvs = DocumentGrid::where(['document_type_id' =>$document->id, 'identifier' => 'SPECIFICATION_VALIDATION_CleaningValidationSpecification'])->first();
       
        $Specification_Validation_Data_cvs = $Specification_Validation_Data_cvs->replicate();
        $Specification_Validation_Data_cvs->document_type_id = $newdoc->id;
        $Specification_Validation_Data_cvs->identifier = 'SPECIFICATION_VALIDATION_CleaningValidationSpecification';
        //dd($Specification_Validation_Data_cvs);
        $Specification_Validation_Data_cvs->save();
      

    
    DocumentService::update_document_numbers();

        toastr()->success('Document has been revised successfully! You can now edit the content.');
        return redirect()->route('documents.edit', $newdoc->id);
    }


    public function printPDFAnx($id)
    {

        $issue_copies = request('issue_copies');
        $print_reason = request('print_reason');

        if (intval($issue_copies) < 1)
        {
            return "Cannot issue less than 1 copies! Requested $issue_copies no. of copies.";
        }

        $roles = Auth::user()->userRoles()->select('role_id')->distinct()->pluck('role_id')->toArray();
        $controls = PrintControl::whereIn('role_id', $roles)->first();

        if ($controls) {
            set_time_limit(30);
            $document = Document::find($id);
            $data = Document::find($id);
            $data->department = Department::find($data->department_id);
            $data['originator'] = User::where('id', $data->originator_id)->value('name');
            $data['originator_email'] = User::where('id', $data->originator_id)->value('email');
            $data['document_content'] = DocumentContent::where('document_id', $id)->first();
            $data['document_type_name'] = DocumentType::where('id', $data->document_type_id)->value('name');
            $data['document_type_code'] = DocumentType::where('id', $data->document_type_id)->value('typecode');
            $data['document_division'] = Division::where('id', $data->division_id)->value('name');
            $data['issue_copies'] = $issue_copies;


            $data['year'] = Carbon::parse($data->created_at)->format('Y');
            // $document = Document::where('id', $id)->get();
            // $pdf = PDF::loadView('frontend.documents.pdfpage', compact('data'))->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);

            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();

            $pdf = PDF::loadview('frontend.documents.pdfpage', compact('data', 'time', 'document', 'issue_copies', 'print_reason'))
                ->setOptions([
                    'defaultFont' => 'sans-serif',
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
                    'isPhpEnabled' => true,
                ]);

            $pdf->setPaper('A4');
            $pdf->render();
            $canvas = $pdf->getDomPDF()->getCanvas();
            $canvas2 = $pdf->getDomPDF()->getCanvas();
            $height = $canvas->get_height();
            $width = $canvas->get_width();


            $canvas2->page_script(function ($pageNumber, $pageCount, $canvas, $fontMetrics) use ($issue_copies, $canvas2) {
                // $page_switch_at = floor($pageCount/$issue_copies);

                $current_copy = round($pageNumber/$issue_copies) < 1 ? 1 : ceil($pageNumber/$issue_copies);
                $current_copy = $current_copy > $issue_copies ? $issue_copies : $current_copy;
                $text = "Issued Copy $current_copy of $issue_copies";
                $pageWidth = $canvas->get_width();
                $pageHeight = $canvas->get_height();
                $size = 10;
                $width = $fontMetrics->getTextWidth($text, null, $size);
                $canvas2->text($pageWidth - $width - 50, $pageHeight - 30, $text, null, $size);
            });

            $canvas->page_script('$pdf->set_opacity(0.1,"Multiply");');
            $canvas->page_text(
                $width / 4,
                $height / 2,
                $data->status,
                null,
                25,
                [0, 0, 0],
                2,
                6,
                -20
            );


            if ($controls->daily != 0) {
                $user = PrintHistory::where('user_id', Auth::user()->id)->where('document_id', $id)->where('date', Carbon::now()->format('d-m-Y'))->count();
                if ($user + 1 <= $controls->daily) {
                    //Downlad History
                    $download = new PrintHistory;
                    $download->document_id = $id;
                    $download->user_id = Auth::user()->id;
                    $download->role_id = Auth::user()->role;
                    $download->date = Carbon::now()->format('d-m-Y');
                    $download->print_reason = $print_reason;
                    $download->issue_copies = $issue_copies;
                    $download->save();

                    // download PDF file with download method

                    return $pdf->stream('SOP'.$id.'.pdf');
                } else {
                    toastr()->error('You breach your daily print limit.');

                    return back();
                }
            } elseif ($controls->weekly != 0) {
                $weekDate = Carbon::now()->subDays(7)->format('d-m-Y');
                $user = PrintHistory::where('user_id', Auth::user()->id)->where('document_id', $id)->whereBetween('date', [$weekDate, Carbon::now()->format('d-m-Y')])->count();
                if ($user + 1 <= $controls->weekly) {
                    //Downlad History
                    $download = new PrintHistory;
                    $download->document_id = $id;
                    $download->user_id = Auth::user()->id;
                    $download->role_id = Auth::user()->role;
                    $download->date = Carbon::now()->format('d-m-Y');
                    $download->print_reason = $print_reason;
                    $download->issue_copies = $issue_copies;
                    $download->save();

                    // download PDF file with download method
                    return $pdf->stream('SOP'.$id.'.pdf');
                } else {
                    toastr()->error('You breach your weekly print limit.');

                    return back();
                }
            } elseif ($controls->monthly != 0) {
                $weekDate = Carbon::now()->subDays(30)->format('d-m-Y');
                $user = PrintHistory::where('user_id', Auth::user()->id)->where('document_id', $id)->whereBetween('date', [$weekDate, Carbon::now()->format('d-m-Y')])->count();
                if ($user + 1 <= $controls->monthly) {
                    //Downlad History
                    $download = new PrintHistory;
                    $download->document_id = $id;
                    $download->user_id = Auth::user()->id;
                    $download->role_id = Auth::user()->role;
                    $download->date = Carbon::now()->format('d-m-Y');
                    $download->print_reason = $print_reason;
                    $download->issue_copies = $issue_copies;
                    $download->save();

                    // download PDF file with download method

                    return $pdf->stream('SOP'.$id.'.pdf');
                } else {
                    toastr()->error('You breach your monthly print limit.');

                    return back();
                }
            } elseif ($controls->quatarly != 0) {
                $weekDate = Carbon::now()->subDays(90)->format('d-m-Y');
                $user = PrintHistory::where('user_id', Auth::user()->id)->where('document_id', $id)->whereBetween('date', [$weekDate, Carbon::now()->format('d-m-Y')])->count();
                if ($user + 1 <= $controls->quatarly) {
                    //Downlad History
                    $download = new PrintHistory;
                    $download->document_id = $id;
                    $download->user_id = Auth::user()->id;
                    $download->role_id = Auth::user()->role;
                    $download->date = Carbon::now()->format('d-m-Y');
                    $download->print_reason = $print_reason;
                    $download->issue_copies = $issue_copies;
                    $download->save();

                    // download PDF file with download method

                    return $pdf->stream('SOP'.$id.'.pdf');
                } else {
                    toastr()->error('You breach your quaterly print limit.');

                    return back();
                }
            } elseif ($controls->yearly != 0) {
                $weekDate = Carbon::now()->subDays(365)->format('d-m-Y');
                $user = PrintHistory::where('user_id', Auth::user()->id)->where('document_id', $id)->whereBetween('date', [$weekDate, Carbon::now()->format('d-m-Y')])->count();
                if ($user + 1 <= $controls->yearly) {
                    //Downlad History
                    $download = new PrintHistory;
                    $download->document_id = $id;
                    $download->user_id = Auth::user()->id;
                    $download->role_id = Auth::user()->role;
                    $download->date = Carbon::now()->format('d-m-Y');
                    $download->print_reason = $print_reason;
                    $download->issue_copies = $issue_copies;
                    $download->save();

                    // download PDF file with download method

                    return $pdf->stream('SOP'.$id.'.pdf');
                } else {
                    toastr()->error('You breach your yearly print limit.');

                    return back();
                }
            } else {
                toastr()->error('There is no controls provide for your role.');

                return back();
            }
        } else {
            toastr()->error('There is no controls provide for your role.');

            return back();
        }
    }

    public function printAnnexure($documentId, $annexure_number)
    {
        try {
            $document = Document::findOrFail($documentId);
            // dd($document);
            if ( $document->doc_content && !empty($document->doc_content->annexuredata) )
            {
                $annexure_data = unserialize($document->doc_content->annexuredata);

                $annexure_data = $annexure_data[$annexure_number-1];

                $document = Document::find($documentId);
                $data = Document::find($documentId);
                $data->department = Department::find($data->department_id);
                $data['originator'] = User::where('id', $data->originator_id)->value('name');
                $data['originator_email'] = User::where('id', $data->originator_id)->value('email');
                $data['document_content'] = DocumentContent::where('document_id', $documentId)->first();
                $data['document_type_name'] = DocumentType::where('id', $data->document_type_id)->value('name');
                $data['document_type_code'] = DocumentType::where('id', $data->document_type_id)->value('typecode');
                $data['document_division'] = Division::where('id', $data->division_id)->value('name');
                $data['year'] = Carbon::parse($data->created_at)->format('Y');
                $pdf = App::make('dompdf.wrapper');
                $time = Carbon::now();
                $pdf = PDF::loadview('frontend.documents.reports.annexure_report', compact('data', 'time', 'document', 'annexure_number', 'annexure_data'))
                ->setOptions([
                    'defaultFont' => 'sans-serif',
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
                    'isPhpEnabled' => true,
                ]);
                $pdf->setPaper('A4');
                $pdf->render();
                $canvas = $pdf->getDomPDF()->getCanvas();
                $height = $canvas->get_height();
                $width = $canvas->get_width();

                $canvas->page_script('$pdf->set_opacity(0.1,"Multiply");');

                $canvas->page_text(
                    $width / 4,
                    $height / 2,
                    $data->status,
                    null,
                    25,
                    [0, 0, 0],
                    2,
                    6,
                    -20
                );

                return $pdf->stream('SOP'.$documentId.'.pdf');

            } else {
                throw new \Exception('Annexure Data Not Found');
            }

        } catch(\Exception $e) {
            return $e->getMessage();
        }

    }
}
