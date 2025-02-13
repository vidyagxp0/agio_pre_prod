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

            $document->tds_name_code = $request->tds_name_code;
            $document->total_no_pages = $request->total_no_pages;




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
            $document->fsproduct_name = $request->fsproduct_name;
            $document->generic_name = $request->generic_name;
            $document->brand_name = $request->brand_name;
            $document->label_claim = $request->label_claim;
            $document->product_code = $request->product_code;
            $document->fsstorage_condition = $request->fsstorage_condition;
            $document->sample_quantity = $request->sample_quantity;
            $document->reserve_sample = $request->reserve_sample;
            $document->custom_sample = $request->custom_sample;
            $document->reference = $request->reference;
            $document->sampling_instructions = $request->sampling_instructions;

           //Cleaning Validation Specification
           $document->product_name_cvs = $request->product_name_cvs;
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

           //Inprocess Validation specification
           $document->product_name_inps = $request->product_name_inps;
           $document->generic_name_inps = $request->generic_name_inps;
           $document->brand_name_inps = $request->brand_name_inps;
           $document->label_claim_inps = $request->label_claim_inps;
           $document->product_code_inps = $request->product_code_inps;
           $document->storage_condition_inps = $request->storage_condition_inps;
           $document->sample_quantity_inps = $request->sample_quantity_inps;
           $document->reserve_sample_inps = $request->reserve_sample_inps;
           $document->custom_sample_inps = $request->custom_sample_inps;
           $document->reference_inps = $request->reference_inps;
           $document->sampling_instructions_inps = $request->sampling_instructions_inps;


            // row  material store
            $document->material_name = $request->material_name;
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
            $document->rawmaterials_specifications = $request->rawmaterials_specifications;


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

            //gtp
            $content->gtp_product_material_name = $request->gtp_product_material_name;
            $content->gtp_test = $request->gtp_test;

            //tds
            $content->tds_result = $request->tds_result;
            $content->tds_test_wise = $request->tds_test_wise;


            //PRVProtocol
            $content->generic_prvp = $request->generic_prvp;
            $content->prvp_product_code = $request->prvp_product_code;
            $content->prvp_std_batch = $request->prvp_std_batch;
            $content->prvp_category = $request->prvp_category;
            $content->prvp_label_claim = $request->prvp_label_claim;
            $content->prvp_market = $request->prvp_market;
            $content->prvp_shelf_life = $request->prvp_shelf_life;
            $content->prvp_bmr_no = $request->prvp_bmr_no;
            $content->prvp_mfr_no = $request->prvp_mfr_no;

            $content->prvp_purpose = $request->prvp_purpose;
            $content->prvp_scope = $request->prvp_scope;
            $content->reason_validation = $request->reason_validation;
            $content->validation_po_prvp = $request->validation_po_prvp;
            $content->description_sop_prvp = $request->description_sop_prvp;
            $content->prvp_procedure = $request->prvp_procedure;


            // packing validation repo kp
            $content->generic_PacValRep = $request->generic_PacValRep;
            $content->PacValRep_product_code = $request->PacValRep_product_code;
            $content->PacValRep_std_batch = $request->PacValRep_std_batch;
            $content->PacValRep_category = $request->PacValRep_category;
            $content->PacValRep_label_claim = $request->PacValRep_label_claim;
            $content->PacValRep_market = $request->PacValRep_market;
            $content->PacValRep_shelf_life = $request->PacValRep_shelf_life;
            $content->PacValRep_bmr_no = $request->PacValRep_bmr_no;
            $content->PacValRep_mpr_no = $request->PacValRep_mpr_no;


            // htsp
            $content->htsp_purpose = $request->htsp_purpose;
            $content->htsp_scope = $request->htsp_scope;

            // pvp
            $content->pvp_purpose = $request->pvp_purpose;
            $content->pvp_scope = $request->pvp_scope;




             //study report
            $content->study_purpose = $request->study_purpose;
            $content->study_scope = $request->study_scope;
            $content->study_attachments = $request->study_attachments;
  
            // study protocol
            $content->stprotocol_purpose = $request->stprotocol_purpose;
            $content->stprotocol_scope = $request->stprotocol_scope;

            //Equipment hold time study

            $content->equipment_objective = $request->equipment_objective;
            $content->equipment_scope = $request->equipment_scope;
            $content->equipment_purpose = $request->equipment_purpose;
            
            
            if ($request->has('hod_attachments') && $request->hasFile('hod_attachments')) {
                $files = [];

                foreach ($request->file('hod_attachments') as $file) {
                    $name = $request->name . '-hod_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }

                $content->hod_attachments = json_encode($files);
            }


          // ----------- process validation interim report  start--------------------------

          $content->pvir_dosage_form = $request->pvir_dosage_form;
          $content->pvir_process_validation_interim_report = $request->pvir_process_validation_interim_report;
          $content->pvir_product_name = $request->pvir_product_name;
          $content->pvir_report_no = $request->pvir_report_no;
          $content->pvir_batch_no = $request->pvir_batch_no;
          $content->generic_pvir = $request->generic_pvir;
          $content->pvir_product_code = $request->pvir_product_code;
          $content->pvir_std_batch = $request->pvir_std_batch;
          $content->pvir_category = $request->pvir_category;
          $content->pvir_label_claim = $request->pvir_label_claim;
          $content->pvir_market = $request->pvir_market;
          $content->pvir_shelf_life = $request->pvir_shelf_life;
          $content->pvir_bmr_no = $request->pvir_bmr_no;
          $content->pvir_mfr_no = $request->pvir_mfr_no;

          if (!empty($request->pvir_attachment)) {
             $files = [];
             if ($request->hasfile('pvir_attachment')) {
                 foreach ($request->file('pvir_attachment') as $file) {
                     $name = $request->name . 'pvir_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                     $file->move('upload/', $name);
                     $files[] = $name;
                 }
             }
             $content->pvir_attachment = json_encode($files);
         }

    //Equipment hold time study protocol

    $content->eqp_approval = $request->eqp_approval;
    $content->eqp_objective = $request->eqp_objective;
    $content->eqp_scope = $request->eqp_scope;


    if (!empty($request->eqpresponsibility)) {
        $content->eqpresponsibility = serialize($request->eqpresponsibility);
    }
    if (!empty($request->eqpdetails)) {
        $content->eqpdetails = serialize($request->eqpdetails);
    }

    if (!empty($request->eqpsampling)) {
        $content->eqpsampling = serialize($request->eqpsampling);
    }

    if (!empty($request->Samplingprocedure)) {
        $content->Samplingprocedure = serialize($request->Samplingprocedure);
    }

    if (!empty($request->AcceptenceCriteria)) {
        $content->AcceptenceCriteria = serialize($request->AcceptenceCriteria);
    }

    if (!empty($request->EnvironmentalConditions)) {
        $content->EnvironmentalConditions = serialize($request->EnvironmentalConditions);
    }

    if (!empty($request->eqpdetailsdeviation)) {
        $content->eqpdetailsdeviation = serialize($request->eqpdetailsdeviation);
    }

    if (!empty($request->eqpdetailschangecontrol)) {
        $content->eqpdetailschangecontrol = serialize($request->eqpdetailschangecontrol);
    }

    if (!empty($request->eqpdetailssummary)) {
        $content->eqpdetailssummary = serialize($request->eqpdetailssummary);
    }

    if (!empty($request->eqpdetailsconclusion)) {
        $content->eqpdetailsconclusion = serialize($request->eqpdetailsconclusion);
    }

    if (!empty($request->eqpdetailstraining)) {
        $content->eqpdetailstraining = serialize($request->eqpdetailstraining);
    }


    //Format For Compressed Air And Nitrogen Gas System Report

    $content->format_approval = $request->format_approval;
    $content->format_objective = $request->format_objective;
    $content->format_scope = $request->format_scope;
    if (!empty($request->formatidentification)) {
        $content->formatidentification = serialize($request->formatidentification);
    }

    if (!empty($request->executiontteam)) {
        $content->executiontteam = serialize($request->executiontteam);
    }

    if (!empty($request->formatdocuments)) {
        $content->formatdocuments = serialize($request->formatdocuments);
    }

    if (!empty($request->revalidationtype)) {
        $content->revalidationtype = serialize($request->revalidationtype);
    }
    if (!empty($request->RevalidationCriteria)) {
        $content->RevalidationCriteria = serialize($request->RevalidationCriteria);
    }

    if (!empty($request->generalconsideration)) {
        $content->generalconsideration = serialize($request->generalconsideration);
    }


    if (!empty($request->precautions)) {
        $content->precautions = serialize($request->precautions);
    }

    if (!empty($request->calibrationstatus)) {
        $content->calibrationstatus = serialize($request->calibrationstatus);
    }


    if (!empty($request->testobservation)) {
        $content->testobservation = serialize($request->testobservation);
    }

    if (!empty($request->formatannexure)) {
        $content->formatannexure = serialize($request->formatannexure);
    }

    if (!empty($request->formatdeviation)) {
        $content->formatdeviation = serialize($request->formatdeviation);
    }

    if (!empty($request->formatcc)) {
        $content->formatcc = serialize($request->formatcc);
    }

    if (!empty($request->formatsummary)) {
        $content->formatsummary = serialize($request->formatsummary);
    }

    if (!empty($request->formatconclusion)) {
        $content->formatconclusion = serialize($request->formatconclusion);
    }



            if (!empty($request->critical_pvir)) {
                $content->critical_pvir = serialize($request->critical_pvir);
            }
            if (!empty($request->In_process_data_pvir)) {
                $content->In_process_data_pvir = serialize($request->In_process_data_pvir);
            }

            if (!empty($request->various_stages_pvir)) {
                $content->various_stages_pvir = serialize($request->various_stages_pvir);
            }

            if (!empty($request->deviation_pvir)) {
                $content->deviation_pvir = serialize($request->deviation_pvir);
            }

            if (!empty($request->change_controlpvir)) {
                $content->change_controlpvir = serialize($request->change_controlpvir);
            }

            if (!empty($request->Summary_pvir)) {
                $content->Summary_pvir = serialize($request->Summary_pvir);
            }
            if (!empty($request->conclusion_pvir)) {
                $content->conclusion_pvir = serialize($request->conclusion_pvir);
            }
            if (!empty($request->report_approvalpvir)) {
                $content->report_approvalpvir = serialize($request->report_approvalpvir);
            }


            if (!empty($request->euipmentresponsibility)) {
                $content->euipmentresponsibility = serialize($request->euipmentresponsibility);
            }

            if (!empty($request->eqpAnalyticalReport)) {
                $content->eqpAnalyticalReport = serialize($request->eqpAnalyticalReport);
            }

            if (!empty($request->eqpdeviation)) {
                $content->eqpdeviation = serialize($request->eqpdeviation);
            }

            
            if (!empty($request->eqpchangecontrol)) {
                $content->eqpchangecontrol = serialize($request->eqpchangecontrol);
            }

            if (!empty($request->eqpsummary)) {
                $content->eqpsummary = serialize($request->eqpsummary);
            }

            if (!empty($request->eqpconclusion)) {
                $content->eqpconclusion = serialize($request->eqpconclusion);
            }

            if (!empty($request->eqpreportapproval)) {
                $content->eqpreportapproval = serialize($request->eqpreportapproval);
            }

            if (!empty($request->stresponsibility)) {
                $content->stresponsibility = serialize($request->stresponsibility);
            }

            if (!empty($request->stdefination)) {
                $content->stdefination = serialize($request->stdefination);
            }

            if (!empty($request->streferences)) {
                $content->streferences = serialize($request->streferences);
            }

            if (!empty($request->stbackground)) {
                $content->stbackground = serialize($request->stbackground);
            }

            if (!empty($request->stassessment)) {
                $content->stassessment = serialize($request->stassessment);
            }

            if (!empty($request->ststrategy)) {
                $content->ststrategy = serialize($request->ststrategy);
            }

            if (!empty($request->stsummary)) {
                $content->stsummary = serialize($request->stsummary);
            }

            if (!empty($request->stconclusion)) {
                $content->stconclusion = serialize($request->stconclusion);
            }

            if (!empty($request->stannexure)) {
                $content->stannexure = serialize($request->stannexure);
            }
            if (!empty($request->Referencedocunum)) {
                $content->Referencedocunum = serialize($request->Referencedocunum);
            }


            if (!empty($request->responsibilities)) {
                $content->responsibilities = serialize($request->responsibilities);
            }

            if (!empty($request->referencesss)) {
                $content->referencesss = serialize($request->referencesss);
            }

            if (!empty($request->assessment)) {
                $content->assessment = serialize($request->assessment);
            }

            if (!empty($request->strategy)) {
                $content->strategy = serialize($request->strategy);
            }

            if (!empty($request->summary_and_findings)) {
                $content->summary_and_findings = serialize($request->summary_and_findings);
            }

            if (!empty($request->conclusion_and_recommendations)) {
                $content->conclusion_and_recommendations = serialize($request->conclusion_and_recommendations);
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

        // temperture mapping tabs datafileds store
        if (!empty($request->ProtocolApproval_TemperMap)) {
            $content->ProtocolApproval_TemperMap = serialize($request->ProtocolApproval_TemperMap);
        }
        if (!empty($request->Objective_TemperMap)) {
            $content->Objective_TemperMap = serialize($request->Objective_TemperMap);
        }
        if (!empty($request->Scope_TemperMap)) {
            $content->Scope_TemperMap = serialize($request->Scope_TemperMap);
        }
        if (!empty($request->AreaValidated_TemperMap)) {
            $content->AreaValidated_TemperMap = serialize($request->AreaValidated_TemperMap);
        }
        if (!empty($request->ValidationTeamResponsibilities_TemperMap)) {
            $content->ValidationTeamResponsibilities_TemperMap = serialize($request->ValidationTeamResponsibilities_TemperMap);
        }
        if (!empty($request->Reference_TemperMap)) {
            $content->Reference_TemperMap = serialize($request->Reference_TemperMap);
        }
        if (!empty($request->DocumentFollowed_TemperMap)) {
            $content->DocumentFollowed_TemperMap = serialize($request->DocumentFollowed_TemperMap);
        }
        if (!empty($request->StudyRationale_TemperMap)) {
            $content->StudyRationale_TemperMap = serialize($request->StudyRationale_TemperMap);
        }
        if (!empty($request->Procedure_TemperMap)) {
            $content->Procedure_TemperMap = serialize($request->Procedure_TemperMap);
        }
        if (!empty($request->CriteriaRevalidation_TemperMap)) {
            $content->CriteriaRevalidation_TemperMap = serialize($request->CriteriaRevalidation_TemperMap);
        }
        if (!empty($request->MaterialDocumentRequired_TemperMap)) {
            $content->MaterialDocumentRequired_TemperMap = serialize($request->MaterialDocumentRequired_TemperMap);
        }
        if (!empty($request->AcceptanceCriteria_TemperMap)) {
            $content->AcceptanceCriteria_TemperMap = serialize($request->AcceptanceCriteria_TemperMap);
        }
        if (!empty($request->TypeofValidation_TemperMap)) {
            $content->TypeofValidation_TemperMap = serialize($request->TypeofValidation_TemperMap);
        }
        if (!empty($request->ObservationResult_TemperMap)) {
            $content->ObservationResult_TemperMap = serialize($request->ObservationResult_TemperMap);
        }
        if (!empty($request->Abbreviations_TemperMap)) {
            $content->Abbreviations_TemperMap = serialize($request->Abbreviations_TemperMap);
        }
        if (!empty($request->DeviationAny_TemperMap)) {
            $content->DeviationAny_TemperMap = serialize($request->DeviationAny_TemperMap);
        }
        if (!empty($request->ChangeControl_TemperMap)) {
            $content->ChangeControl_TemperMap = serialize($request->ChangeControl_TemperMap);
        }
        if (!empty($request->Summary_TemperMap)) {
            $content->Summary_TemperMap = serialize($request->Summary_TemperMap);
        }
        if (!empty($request->Conclusion_TemperMap)) {
            $content->Conclusion_TemperMap = serialize($request->Conclusion_TemperMap);
        }
        if (!empty($request->AttachmentList_TemperMap)) {
            $content->AttachmentList_TemperMap = serialize($request->AttachmentList_TemperMap);
        }
        if (!empty($request->PostApproval_TemperMap)) {
            $content->PostApproval_TemperMap = serialize($request->PostApproval_TemperMap);
        }


        // ----------------Start-------packing validation rwport tABS store -------------------

        if (!empty($request->Purpose_PaVaReKp)) {
            $content->Purpose_PaVaReKp = serialize($request->Purpose_PaVaReKp);
        }
        if (!empty($request->Scope_PaVaReKp)) {
            $content->Scope_PaVaReKp = serialize($request->Scope_PaVaReKp);
        }
        if (!empty($request->BatchDetails_PaVaReKp)) {
            $content->BatchDetails_PaVaReKp = serialize($request->BatchDetails_PaVaReKp);
        }
        if (!empty($request->ReferenceDocument_PaVaReKp)) {
            $content->ReferenceDocument_PaVaReKp = serialize($request->ReferenceDocument_PaVaReKp);
        }
        if (!empty($request->PackingMaterialApprovalVendDeat_PaVaReKp)) {
            $content->PackingMaterialApprovalVendDeat_PaVaReKp = serialize($request->PackingMaterialApprovalVendDeat_PaVaReKp);
        }
        if (!empty($request->UsedEquipmentCalibrationQualiSta_PaVaReKp)) {
            $content->UsedEquipmentCalibrationQualiSta_PaVaReKp = serialize($request->UsedEquipmentCalibrationQualiSta_PaVaReKp);
        }
        if (!empty($request->ResultOfPacking_PaVaReKp)) {
            $content->ResultOfPacking_PaVaReKp = serialize($request->ResultOfPacking_PaVaReKp);
        }
        if (!empty($request->CriticalProcessParameters_PaVaReKp)) {
            $content->CriticalProcessParameters_PaVaReKp = serialize($request->CriticalProcessParameters_PaVaReKp);
        }
        if (!empty($request->yield_PaVaReKp)) {
            $content->yield_PaVaReKp = serialize($request->yield_PaVaReKp);
        }
        if (!empty($request->HoldTimeStudy_PaVaReKp)) {
            $content->HoldTimeStudy_PaVaReKp = serialize($request->HoldTimeStudy_PaVaReKp);
        }
        if (!empty($request->CleaningValidation_PaVaReKp)) {
            $content->CleaningValidation_PaVaReKp = serialize($request->CleaningValidation_PaVaReKp);
        }
        if (!empty($request->StabilityStudy_PaVaReKp)) {
            $content->StabilityStudy_PaVaReKp = serialize($request->StabilityStudy_PaVaReKp);
        }
        if (!empty($request->DeviationIfAny_PaVaReKp)) {
            $content->DeviationIfAny_PaVaReKp = serialize($request->DeviationIfAny_PaVaReKp);
        }
        if (!empty($request->ChangeControlifany_PaVaReKp)) {
            $content->ChangeControlifany_PaVaReKp = serialize($request->ChangeControlifany_PaVaReKp);
        }
        if (!empty($request->Summary_PaVaReKp)) {
            $content->Summary_PaVaReKp = serialize($request->Summary_PaVaReKp);
        }
        if (!empty($request->Conclusion_PaVaReKp)) {
            $content->Conclusion_PaVaReKp = serialize($request->Conclusion_PaVaReKp);
        }
        if (!empty($request->ProposedParameters_PaVaReKp)) {
            $content->ProposedParameters_PaVaReKp = serialize($request->ProposedParameters_PaVaReKp);
        }

        if (!empty($request->ReportApproval_PaVaReKp)) {
            $content->ReportApproval_PaVaReKp = serialize($request->ReportApproval_PaVaReKp);
        }
        // ---------------END--------packing validation rwport tABS store -------------------

        // ---------------start--------Format air and nitrogen es systs protocal tABS store -------------------


        if (!empty($request->Protocolapproval_FoCompAaNirogenkp)) {
            $content->Protocolapproval_FoCompAaNirogenkp = serialize($request->Protocolapproval_FoCompAaNirogenkp);
        }
        if (!empty($request->Objective_FoCompAaNirogenkp)) {
            $content->Objective_FoCompAaNirogenkp = serialize($request->Objective_FoCompAaNirogenkp);
        }
        if (!empty($request->Purpose_FoCompAaNirogenkp)) {
            $content->Purpose_FoCompAaNirogenkp = serialize($request->Purpose_FoCompAaNirogenkp);
        }
        if (!empty($request->Scope_FoCompAaNirogenkp)) {
            $content->Scope_FoCompAaNirogenkp = serialize($request->Scope_FoCompAaNirogenkp);
        }
        if (!empty($request->ExcutionTeamResp_FoCompAaNirogenkp)) {
            $content->ExcutionTeamResp_FoCompAaNirogenkp = serialize($request->ExcutionTeamResp_FoCompAaNirogenkp);
        }
        if (!empty($request->Abbreviations_FoCompAaNirogenkp)) {
            $content->Abbreviations_FoCompAaNirogenkp = serialize($request->Abbreviations_FoCompAaNirogenkp);
        }
        if (!empty($request->EquipmentSystemIde_FoCompAaNirogenkp)) {
            $content->EquipmentSystemIde_FoCompAaNirogenkp = serialize($request->EquipmentSystemIde_FoCompAaNirogenkp);
        }
        if (!empty($request->DocumentFollowed_FoCompAaNirogenkp)) {
            $content->DocumentFollowed_FoCompAaNirogenkp = serialize($request->DocumentFollowed_FoCompAaNirogenkp);
        }
        if (!empty($request->GenralConsPre_FoCompAaNirogenkp)) {
            $content->GenralConsPre_FoCompAaNirogenkp = serialize($request->GenralConsPre_FoCompAaNirogenkp);
        }
        if (!empty($request->RevalidCrite_FoCompAaNirogenkp)) {
            $content->RevalidCrite_FoCompAaNirogenkp = serialize($request->RevalidCrite_FoCompAaNirogenkp);
        }
        if (!empty($request->Precautions_FoCompAaNirogenkp)) {
            $content->Precautions_FoCompAaNirogenkp = serialize($request->Precautions_FoCompAaNirogenkp);
        }
        if (!empty($request->RevalidProcess_FoCompAaNirogenkp)) {
            $content->RevalidProcess_FoCompAaNirogenkp = serialize($request->RevalidProcess_FoCompAaNirogenkp);
        }
        if (!empty($request->AcceptanceCrite_FoCompAaNirogenkp)) {
            $content->AcceptanceCrite_FoCompAaNirogenkp = serialize($request->AcceptanceCrite_FoCompAaNirogenkp);
        }
        if (!empty($request->Annexure_FoCompAaNirogenkp)) {
            $content->Annexure_FoCompAaNirogenkp = serialize($request->Annexure_FoCompAaNirogenkp);
        }


        // hold sutdy time report tabs store
        if (!empty($request->Purpose_HoTiStRe)) {
            $content->Purpose_HoTiStRe = serialize($request->Purpose_HoTiStRe);
        }
        if (!empty($request->Scope_HoTiStRe)) {
            $content->Scope_HoTiStRe = serialize($request->Scope_HoTiStRe);
        }
        if (!empty($request->BatchDetails_HoTiStRe)) {
            $content->BatchDetails_HoTiStRe = serialize($request->BatchDetails_HoTiStRe);
        }
        if (!empty($request->ReferenceDocument_HoTiStRe)) {
            $content->ReferenceDocument_HoTiStRe = serialize($request->ReferenceDocument_HoTiStRe);
        }
        if (!empty($request->ResultBulkStage_HoTiStRe)) {
            $content->ResultBulkStage_HoTiStRe = serialize($request->ResultBulkStage_HoTiStRe);
        }
        if (!empty($request->DeviationIfAny_HoTiStRe)) {
            $content->DeviationIfAny_HoTiStRe = serialize($request->DeviationIfAny_HoTiStRe);
        }
        if (!empty($request->Summary_HoTiStRe)) {
            $content->Summary_HoTiStRe = serialize($request->Summary_HoTiStRe);
        }
        if (!empty($request->Conclusion_HoTiStRe)) {
            $content->Conclusion_HoTiStRe = serialize($request->Conclusion_HoTiStRe);
        }
        if (!empty($request->ReportApproval_HoTiStRe)) {
            $content->ReportApproval_HoTiStRe = serialize($request->ReportApproval_HoTiStRe);
        }








        //-----------------------Process Validation Report--------------------------------------- 

            $content->generic_pvr = $request->generic_pvr;
            $content->product_code_pvr = $request->product_code_pvr;
            $content->std_batch_pvr = $request->std_batch_pvr;
            $content->category_pvr = $request->category_pvr;
            $content->label_claim_pvr = $request->label_claim_pvr;
        
            $content->market_pvr = $request->market_pvr;
            $content->shelf_life_pvr = $request->shelf_life_pvr;
            $content->bmr_no_pvr = $request->bmr_no_pvr;
            $content->mfr_no_pvr = $request->mfr_no_pvr;
            
    
           if (!empty($request->purpose_pvr)) {
                $content->purpose_pvr = serialize($request->purpose_pvr);
            }
            if (!empty($request->scope_pvr)) {
                $content->scope_pvr = serialize($request->scope_pvr);
            }
            if (!empty($request->batchdetail_pvr)) {
                $content->batchdetail_pvr = serialize($request->batchdetail_pvr);
            }

            if (!empty($request->refrence_document_pvr)) {
                $content->refrence_document_pvr = serialize($request->refrence_document_pvr);
            }
            if (!empty($request->active_raw_material_pvr)) {
                $content->active_raw_material_pvr = serialize($request->active_raw_material_pvr);
            }
            if (!empty($request->primary_packingmaterial_pvr)) {
                $content->primary_packingmaterial_pvr = serialize($request->primary_packingmaterial_pvr);
            }
            if (!empty($request->used_equipment_calibration_pvr)) {
                $content->used_equipment_calibration_pvr = serialize($request->used_equipment_calibration_pvr);
            }
            if (!empty($request->result_of_intermediate_pvr)) {
                $content->result_of_intermediate_pvr = serialize($request->result_of_intermediate_pvr);
            }
            if (!empty($request->result_of_finished_product_pvr)) {
                $content->result_of_finished_product_pvr = serialize($request->result_of_finished_product_pvr);
            }

            if (!empty($request->result_of_packing_finished_pvr)) {
                $content->result_of_packing_finished_pvr = serialize($request->result_of_packing_finished_pvr);
            }
            if (!empty($request->criticalprocess_parameter_pvr)) {
                $content->criticalprocess_parameter_pvr = serialize($request->criticalprocess_parameter_pvr);
            }
            if (!empty($request->yield_at_various_stage_pvr)) {
                $content->yield_at_various_stage_pvr = serialize($request->yield_at_various_stage_pvr);
            }
            if (!empty($request->hold_time_study_pvr)) {
                $content->hold_time_study_pvr = serialize($request->hold_time_study_pvr);
            }
            if (!empty($request->cleaningvalidation_pvr)) {
                $content->cleaningvalidation_pvr = serialize($request->cleaningvalidation_pvr);
            }
            if (!empty($request->stability_study_pvr)) {
                $content->stability_study_pvr = serialize($request->stability_study_pvr);
            }
            if (!empty($request->deviation_if_any_pvr)) {
                $content->deviation_if_any_pvr = serialize($request->deviation_if_any_pvr);
            }
            if (!empty($request->changecontrol_pvr)) {
                $content->changecontrol_pvr = serialize($request->changecontrol_pvr);
            }

           if (!empty($request->summary_pvr)) {
                $content->summary_pvr = serialize($request->summary_pvr);
            }
            if (!empty($request->conclusion_pvr)) {
                $content->conclusion_pvr = serialize($request->conclusion_pvr);
            }
            if (!empty($request->proposed_parameter_upcoming_batch_pvr)) {
                $content->proposed_parameter_upcoming_batch_pvr = serialize($request->proposed_parameter_upcoming_batch_pvr);
            }
            if (!empty($request->report_approval_pvr)) {
                $content->report_approval_pvr = serialize($request->report_approval_pvr);
            }

        //-----------------------END Process Validation Report--------------------------------------- 



        //-----------------------Cleaning Validation protocol-doc --------------------------------------- 

    
            
            if (!empty($request->objective_cvpd)) {
                    $content->objective_cvpd = serialize($request->objective_cvpd);
                }
                if (!empty($request->scope_cvpd)) {
                    $content->scope_cvpd = serialize($request->scope_cvpd);
                }
                if (!empty($request->purpose_cvpd)) {
                    $content->purpose_cvpd = serialize($request->purpose_cvpd);
                }

                if (!empty($request->responsibilities_cvpd)) {
                    $content->responsibilities_cvpd = serialize($request->responsibilities_cvpd);
                }
                if (!empty($request->identification_sensitive_product_contamination_cvpd)) {
                    $content->identification_sensitive_product_contamination_cvpd = serialize($request->identification_sensitive_product_contamination_cvpd);
                }
                if (!empty($request->matrix_worstcase_approach_cvpd)) {
                    $content->matrix_worstcase_approach_cvpd = serialize($request->matrix_worstcase_approach_cvpd);
                }
                if (!empty($request->acceptance_criteria_cvpd)) {
                    $content->acceptance_criteria_cvpd = serialize($request->acceptance_criteria_cvpd);
                }
                if (!empty($request->list_equipment_internal_surface_cvpd)) {
                    $content->list_equipment_internal_surface_cvpd = serialize($request->list_equipment_internal_surface_cvpd);
                }
                if (!empty($request->identification_clean_surfaces_cvpd)) {
                    $content->identification_clean_surfaces_cvpd = serialize($request->identification_clean_surfaces_cvpd);
                }

                if (!empty($request->sampling_method_cvpd)) {
                    $content->sampling_method_cvpd = serialize($request->sampling_method_cvpd);
                }
                if (!empty($request->recovery_studies_cvpd)) {
                    $content->recovery_studies_cvpd = serialize($request->recovery_studies_cvpd);
                }
                if (!empty($request->calculating_carry_over_cvpd)) {
                    $content->calculating_carry_over_cvpd = serialize($request->calculating_carry_over_cvpd);
                }
                if (!empty($request->calculating_rinse_analysis_cvpd)) {
                    $content->calculating_rinse_analysis_cvpd = serialize($request->calculating_rinse_analysis_cvpd);
                }
                if (!empty($request->general_procedure_clean_cvpd)) {
                    $content->general_procedure_clean_cvpd = serialize($request->general_procedure_clean_cvpd);
                }
                if (!empty($request->analytical_method_validation_cvpd)) {
                    $content->analytical_method_validation_cvpd = serialize($request->analytical_method_validation_cvpd);
                }
                if (!empty($request->list_cleaning_sop_cvpd)) {
                    $content->list_cleaning_sop_cvpd = serialize($request->list_cleaning_sop_cvpd);
                }
                if (!empty($request->clean_validation_exercise_cvpd)) {
                    $content->clean_validation_exercise_cvpd = serialize($request->clean_validation_exercise_cvpd);
                }

            if (!empty($request->evaluation_analytical_result_cvpd)) {
                    $content->evaluation_analytical_result_cvpd = serialize($request->evaluation_analytical_result_cvpd);
                }
                if (!empty($request->summary_conclusion_cvpd)) {
                    $content->summary_conclusion_cvpd = serialize($request->summary_conclusion_cvpd);
                }
                if (!empty($request->training_cvpd)) {
                    $content->training_cvpd = serialize($request->training_cvpd);
                }
              

             // cleaning validation report-doc

             if (!empty($request->objective_cvrd)) {
                $content->objective_cvrd = serialize($request->objective_cvrd);
            }
            if (!empty($request->scope_cvrd)) {
                $content->scope_cvrd = serialize($request->scope_cvrd);
            }
            if (!empty($request->purpose_cvrd)) {
                $content->purpose_cvrd = serialize($request->purpose_cvrd);
            }

            if (!empty($request->responsibilities_cvrd)) {
                $content->responsibilities_cvrd = serialize($request->responsibilities_cvrd);
            }
            if (!empty($request->analysis_methodology_cvrd)) {
                $content->analysis_methodology_cvrd = serialize($request->analysis_methodology_cvrd);
            }
            if (!empty($request->recovery_study_report_cvrd)) {
                $content->recovery_study_report_cvrd = serialize($request->recovery_study_report_cvrd);
            }
            if (!empty($request->acceptance_critria_cvrd)) {
                $content->acceptance_critria_cvrd = serialize($request->acceptance_critria_cvrd);
            }
            if (!empty($request->analytical_report_cvrd)) {
                $content->analytical_report_cvrd = serialize($request->analytical_report_cvrd);
            }
            if (!empty($request->physical_procedure_conformance_check_cvrd)) {
                $content->physical_procedure_conformance_check_cvrd = serialize($request->physical_procedure_conformance_check_cvrd);
            }
            if (!empty($request->conclusion_cvrd)) {
                $content->conclusion_cvrd = serialize($request->conclusion_cvrd);
            }


        //-----------------------END Cleaning validation protocol doc--------------------------------------- 

            // if ($request->hasfile('references')) {

            if (!empty($request->ann)) {
                $content->ann = serialize($request->ann);
            }
            if (!empty($request->annexuredata)) {
                $content->annexuredata = serialize($request->annexuredata);
            }
            if (!empty($request->distribution)) {
                $content->distribution = serialize($request->distribution);
            }

            // Process Validation Protocol
            if (!empty($request->responsibilityprvp)) {
                $content->responsibilityprvp = serialize($request->responsibilityprvp);
            }

            if (!empty($request->prvp_rawmaterial)) {
                $content->prvp_rawmaterial = serialize($request->prvp_rawmaterial);
            }

            if (!empty($request->pripackmaterial)) {
                $content->pripackmaterial = serialize($request->pripackmaterial);
            }

            if (!empty($request->equipCaliQuali)) {
                $content->equipCaliQuali = serialize($request->equipCaliQuali);
            }

            if (!empty($request->rationale_critical)) {
                $content->rationale_critical = serialize($request->rationale_critical);
            }

            if (!empty($request->general_instrument)) {
                $content->general_instrument = serialize($request->general_instrument);
            }

            if (!empty($request->process_flow)) {
                $content->process_flow = serialize($request->process_flow);
            }

            if (!empty($request->diagrammatic)) {
                $content->diagrammatic = serialize($request->diagrammatic);
            }

            if (!empty($request->critical_process)) {
                $content->critical_process = serialize($request->critical_process);
            }

            if (!empty($request->product_acceptance)) {
                $content->product_acceptance = serialize($request->product_acceptance);
            }

            if (!empty($request->holdtime_study)) {
                $content->holdtime_study = serialize($request->holdtime_study);
            }

            if (!empty($request->cleaning_validation)) {
                $content->cleaning_validation = serialize($request->cleaning_validation);
            }

            if (!empty($request->stability_study)) {
                $content->stability_study = serialize($request->stability_study);
            }

            if (!empty($request->deviation)) {
                $content->deviation = serialize($request->deviation);
            }
            if (!empty($request->change_control)) {
                $content->change_control = serialize($request->change_control);
            }
            if (!empty($request->summary_prvp)) {
                $content->summary_prvp = serialize($request->summary_prvp);
            }
            if (!empty($request->conclusion_prvp)) {
                $content->conclusion_prvp = serialize($request->conclusion_prvp);
            }
            if (!empty($request->training_prvp)) {
                $content->training_prvp = serialize($request->training_prvp);
            }


            // htps
            if (!empty($request->htsp_responsibility)) {
                $content->htsp_responsibility = serialize($request->htsp_responsibility);
            }
            if (!empty($request->htsp_description_of_sop)) {
                $content->htsp_description_of_sop = serialize($request->htsp_description_of_sop);
            }

            if (!empty($request->htsp_specifications)) {
                $content->htsp_specifications = serialize($request->htsp_specifications);
            }

            if (!empty($request->htsp_sampling_analysis)) {
                $content->htsp_sampling_analysis = serialize($request->htsp_sampling_analysis);
            }

            if (!empty($request->htsp_environmental_conditions)) {
                $content->htsp_environmental_conditions = serialize($request->htsp_environmental_conditions);
            }

            if (!empty($request->htsp_sample_quantity_calculation)) {
                $content->htsp_sample_quantity_calculation = serialize($request->htsp_sample_quantity_calculation);
            }
            if (!empty($request->htsp_deviation)) {
                $content->htsp_deviation = serialize($request->htsp_deviation);
            }
            if (!empty($request->htsp_summary)) {
                $content->htsp_summary = serialize($request->htsp_summary);
            }
            if (!empty($request->htsp_conclusion)) {
                $content->htsp_conclusion = serialize($request->htsp_conclusion);
            }


            // pvp

            if (!empty($request->reasonfor_validationpvp)) {
                $content->reasonfor_validationpvp = serialize($request->reasonfor_validationpvp);
            }
            if (!empty($request->pvp_responsibility)) {
                $content->pvp_responsibility = serialize($request->pvp_responsibility);
            }

            if (!empty($request->pvp_validationpvp)) {
                $content->pvp_validationpvp = serialize($request->pvp_validationpvp);
            }

            if (!empty($request->descriptionsop_pvp)) {
                $content->descriptionsop_pvp = serialize($request->descriptionsop_pvp);
            }

            if (!empty($request->packingmaterial_pvp)) {
                $content->packingmaterial_pvp = serialize($request->packingmaterial_pvp);
            }

            if (!empty($request->equipment_pvp)) {
                $content->equipment_pvp = serialize($request->equipment_pvp);
            }
            if (!empty($request->rationale_pvp)) {
                $content->rationale_pvp = serialize($request->rationale_pvp);
            }
            if (!empty($request->sampling_pvp)) {
                $content->sampling_pvp = serialize($request->sampling_pvp);
            }
            if (!empty($request->critical_pvp)) {
                $content->critical_pvp = serialize($request->critical_pvp);
            }
            if (!empty($request->product_acceptancepvp)) {
                $content->product_acceptancepvp = serialize($request->product_acceptancepvp);
            }
            if (!empty($request->Holdtime_pvp)) {
                $content->Holdtime_pvp = serialize($request->Holdtime_pvp);
            }

            if (!empty($request->cleaning_validationpvp)) {
                $content->cleaning_validationpvp = serialize($request->cleaning_validationpvp);
            }

            if (!empty($request->Stability_studypvp)) {
                $content->Stability_studypvp = serialize($request->Stability_studypvp);
            }

            if (!empty($request->Deviation_pvp)) {
                $content->Deviation_pvp = serialize($request->Deviation_pvp);
            }

            if (!empty($request->Change_controlpvp)) {
                $content->Change_controlpvp = serialize($request->Change_controlpvp);
            }
            if (!empty($request->Summary_pvp)) {
                $content->Summary_pvp = serialize($request->Summary_pvp);
            }
            if (!empty($request->Conclusion_pvp)) {
                $content->Conclusion_pvp = serialize($request->Conclusion_pvp);
            }
            





            $content->save();


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
            $Specification_Validation_Data->save();

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
            $RowSpecification_Data = DocumentGrid::where(['document_type_id' => $griddata, 'identifier' => 'Row_Materail'])->firstOrNew();
            $RowSpecification_Data->document_type_id = $griddata;
            $RowSpecification_Data->identifier = 'Row_Materail';
            $RowSpecification_Data->data = $request->Row_Materail;
            $RowSpecification_Data->save();


            $DocumentGridData = DocumentGrid ::where(['document_type_id' => $document->id, 'identifier' => 'Rowmaterialtest'])->firstOrNew();
            $DocumentGridData->document_type_id = $document->id;
            $DocumentGridData->identifier = 'Rowmaterialtest';
            $DocumentGridData->data = $request->test;
            $DocumentGridData->save();

            $CalibrationQualificationstatus = DocumentGrid::where(['document_type_id' => $document->id, 'identifier' => 'CalibrationQualificationStatus'])->firstOrNew();
            $CalibrationQualificationstatus->document_type_id = $document->id;
            $CalibrationQualificationstatus->identifier = 'CalibrationQualificationStatus';
            $CalibrationQualificationstatus->data = $request->qualitycontrol_1;
            $CalibrationQualificationstatus->save();




            $PackingGridData = DocumentGrid ::where(['document_type_id' => $document->id, 'identifier' => 'Packingmaterialdata'])->firstOrNew();
            $PackingGridData->document_type_id = $document->id;
            $PackingGridData->identifier = 'Packingmaterialdata';
            $PackingGridData->data = $request->packingtest;
            $PackingGridData->save();

            $GtpGridData = DocumentGrid ::where(['document_type_id' => $document->id, 'identifier' => 'gtp'])->firstOrNew();
            $GtpGridData->document_type_id = $document->id;
            $GtpGridData->identifier = 'gtp';
            $GtpGridData->data = $request->gtp;
            $GtpGridData->save();

            $RevisionData = DocumentGrid ::where(['document_type_id' => $document->id, 'identifier' => 'revision_history'])->firstOrNew();
            $RevisionData->document_type_id = $document->id;
            $RevisionData->identifier = 'revision_history';
            $RevisionData->data = $request->revision_history;
            $RevisionData->save();


            $ProductSpecification = DocumentGrid ::where(['document_type_id' => $document->id, 'identifier' => 'ProductSpecification'])->firstOrNew();
            $ProductSpecification->document_type_id = $document->id;
            $ProductSpecification->identifier = 'ProductSpecification';
            $ProductSpecification->data = $request->product;
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
            $Specification_Validation_Data_CVS->save();



           $SpecificationData_invs = DocumentGrid::where(['document_type_id' => $document->id, 'identifier' => 'specificationInprocessValidationSpecification'])->firstOrNew();;
           $SpecificationData_invs->document_type_id = $document->id;
           $SpecificationData_invs->identifier = 'specificationInprocessValidationSpecification';
           $SpecificationData_invs->data = $request->specification_details_inps;
           $SpecificationData_invs->save();

           $Specification_Validation_Data_invs = DocumentGrid::where(['document_type_id' => $document->id, 'identifier' => 'SPECIFICATION_VALIDATION_Inprocess_Validation_Specification'])->firstOrNew();;
           $Specification_Validation_Data_invs->document_type_id = $document->id;
           $Specification_Validation_Data_invs->identifier = 'SPECIFICATION_VALIDATION_Inprocess_Validation_Specification';
           $Specification_Validation_Data_invs->data = $request->specification_validation_details_inps;
           $Specification_Validation_Data_invs->save();




           if (!empty($request->file_attach)) {
            $files = [];
            if ($request->hasfile('file_attach')) {
                foreach ($request->file('file_attach') as $file) {

                    $name = $request->name . 'file_attach' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }

            }
            $document->file_attach = json_encode($files);
        }



        if (!empty($request->attach_cvpd)) {
            $files = [];
            if ($request->hasfile('attach_cvpd')) {
                foreach ($request->file('attach_cvpd') as $file) {

                    $name = $request->name . 'attach_cvpd' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }

            }
            $document->attach_cvpd = json_encode($files);
        }


        if (!empty($request->attachment_srt)) {
            $files = [];
            if ($request->hasfile('attachment_srt')) {
                foreach ($request->file('attachment_srt') as $file) {

                    $name = $request->name . 'attachment_srt' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }

            }
            $document->attachment_srt = json_encode($files);
        }
       
        if (!empty($request->attachment_spt)) {
            $files = [];
            if ($request->hasfile('attachment_spt')) {
                foreach ($request->file('attachment_spt') as $file) {

                    $name = $request->name . 'attachment_spt' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }

            }
            $document->attachment_spt = json_encode($files);
        }
       
        if (!empty($request->attachment_ehtsr)) {
            $files = [];
            if ($request->hasfile('attachment_ehtsr')) {
                foreach ($request->file('attachment_ehtsr') as $file) {

                    $name = $request->name . 'attachment_ehtsr' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }

            }
            $document->attachment_ehtsr = json_encode($files);
        }

        if (!empty($request->attachment_ehtsprt)) {
            $files = [];
            if ($request->hasfile('attachment_ehtsprt')) {
                foreach ($request->file('attachment_ehtsprt') as $file) {

                    $name = $request->name . 'attachment_ehtsprt' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }

            }
            $document->attachment_ehtsprt = json_encode($files);
        }
        if (!empty($request->attachment_ehtsr)) {
            $files = [];
            if ($request->hasfile('attachment_ehtsr')) {
                foreach ($request->file('attachment_ehtsr') as $file) {

                    $name = $request->name . 'attachment_ehtsr' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }

            }
            $document->attachment_ehtsr = json_encode($files);
        }


        $document->save();


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
            $revisionNumber = str_pad($document->revised_doc, 2, '0', STR_PAD_LEFT);
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
        $CalibrationQualificationstatus = DocumentGrid::where('document_type_id', $id)->where('identifier', "CalibrationQualificationStatus")->first();


        $hods = User::get();

        $testDataDecoded = DocumentGrid::where('document_type_id', $id)->where('identifier', "Rowmaterialtest")->first();
        $PackingGridData = DocumentGrid::where('document_type_id', $id)->where('identifier', "Packingmaterialdata")->first();
        $GtpGridData = DocumentGrid::where('document_type_id', $id)->where('identifier', "gtp")->first();

        $RevisionHistoryData = DocumentGrid::where('document_type_id', $id)->where('identifier', "revision_history")->first();
        
        // dd($GtpGridData);

        $ProductSpecification = DocumentGrid::where('document_type_id', $id)->where('identifier', "ProductSpecification")->first();
        $MaterialSpecification = DocumentGrid::where('document_type_id', $id)->where('identifier', "MaterialSpecification")->first();

        $Finished_Product = DocumentGrid::where('document_type_id', $id)->where('identifier', "Finished_Product")->first();
         
        // $RowSpecification_Data = DocumentGrid::where('document_type_id', $id)->where('identifier', "Row_Materail")->first();

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

        $SpecificationData_invs = DocumentGrid::where('document_type_id', $id)->where('identifier', 'specificationInprocessValidationSpecification')->first();
        $Specification_Validation_Data_invs = DocumentGrid::where('document_type_id', $id)->where('identifier', 'SPECIFICATION_VALIDATION_Inprocess_Validation_Specification')->first();


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



        // dd($document);
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
            'SpecificationData_CVS','SpecificationData_invs','Specification_Validation_Data_invs','revisionNumber','RevisionHistoryData',
            'CalibrationQualificationstatus'
            
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

                //raw material specification
                $document->material_name = $request->material_name;
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
                $document->rawmaterials_specifications = $request->rawmaterials_specifications;
    



            // Finished Product Specification
                $document->fsproduct_name = $request->fsproduct_name;
                $document->generic_name = $request->generic_name;
                $document->brand_name = $request->brand_name;
                $document->label_claim = $request->label_claim;
                $document->product_code = $request->product_code;
                $document->fsstorage_condition = $request->fsstorage_condition;
                $document->sample_quantity = $request->sample_quantity;
                $document->reserve_sample = $request->reserve_sample;
                $document->custom_sample = $request->custom_sample;
                $document->reference = $request->reference;
                $document->sampling_instructions = $request->sampling_instructions;


            //Cleaning Validation Specification
                $document->product_name_cvs = $request->product_name_cvs;
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

            //Inprocess Validation specification
                $document->product_name_inps = $request->product_name_inps;
                $document->generic_name_inps = $request->generic_name_inps;
                $document->brand_name_inps = $request->brand_name_inps;
                $document->label_claim_inps = $request->label_claim_inps;
                $document->product_code_inps = $request->product_code_inps;
                $document->storage_condition_inps = $request->storage_condition_inps;
                $document->sample_quantity_inps = $request->sample_quantity_inps;
                $document->reserve_sample_inps = $request->reserve_sample_inps;
                $document->custom_sample_inps = $request->custom_sample_inps;
                $document->reference_inps = $request->reference_inps;
                $document->sampling_instructions_inps = $request->sampling_instructions_inps;




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
                $document->tds_name_code = $request->tds_name_code;
                $document->total_no_pages = $request->total_no_pages;


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

            // packing validation repo kp
            $documentcontet->generic_PacValRep = $request->generic_PacValRep;
            $documentcontet->PacValRep_product_code = $request->PacValRep_product_code;
            $documentcontet->PacValRep_std_batch = $request->PacValRep_std_batch;
            $documentcontet->PacValRep_category = $request->PacValRep_category;
            $documentcontet->PacValRep_label_claim = $request->PacValRep_label_claim;
            $documentcontet->PacValRep_market = $request->PacValRep_market;
            $documentcontet->PacValRep_shelf_life = $request->PacValRep_shelf_life;
            $documentcontet->PacValRep_bmr_no = $request->PacValRep_bmr_no;
            $documentcontet->PacValRep_mpr_no = $request->PacValRep_mpr_no;

            //study report start
            $documentcontet->study_purpose = $request->study_purpose;
            $documentcontet->study_scope = $request->study_scope;
            $documentcontet->study_attachments = $request->study_attachments;


            //--------------------------- Process Validation Interim Update start ------------------------------------------------------
                        
            $documentcontet->pvir_dosage_form = $request->pvir_dosage_form;
            $documentcontet->pvir_process_validation_interim_report = $request->pvir_process_validation_interim_report;
            $documentcontet->pvir_product_name = $request->pvir_product_name;
            $documentcontet->pvir_report_no = $request->pvir_report_no;
            $documentcontet->pvir_batch_no = $request->pvir_batch_no;
            $documentcontet->generic_pvir = $request->generic_pvir;
            $documentcontet->pvir_product_code = $request->pvir_product_code;
            $documentcontet->pvir_std_batch = $request->pvir_std_batch;
            $documentcontet->pvir_category = $request->pvir_category;
            $documentcontet->pvir_label_claim = $request->pvir_label_claim;
            $documentcontet->pvir_market = $request->pvir_market;
            $documentcontet->pvir_shelf_life = $request->pvir_shelf_life;
            $documentcontet->pvir_bmr_no = $request->pvir_bmr_no;
            $documentcontet->pvir_mfr_no = $request->pvir_mfr_no;

            if (!empty($request->pvir_attachment)) {
                $files = [];
                if ($request->hasfile('pvir_attachment')) {
                    foreach ($request->file('pvir_attachment') as $file) {
                        $name = $request->name . 'pvir_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }
                $documentcontet->pvir_attachment = json_encode($files);
            }

            $documentcontet->critical_pvir = $request->critical_pvir ? serialize($request->critical_pvir) : serialize([]);
            $documentcontet->In_process_data_pvir = $request->In_process_data_pvir ? serialize($request->In_process_data_pvir) : serialize([]);
            $documentcontet->various_stages_pvir = $request->various_stages_pvir ? serialize($request->various_stages_pvir) : serialize([]);
            $documentcontet->deviation_pvir = $request->deviation_pvir ? serialize($request->deviation_pvir) : serialize([]);
            $documentcontet->change_controlpvir = $request->change_controlpvir ? serialize($request->change_controlpvir) : serialize([]);
            $documentcontet->Summary_pvir = $request->Summary_pvir ? serialize($request->Summary_pvir) : serialize([]);
            $documentcontet->conclusion_pvir = $request->conclusion_pvir ? serialize($request->conclusion_pvir) : serialize([]);
            $documentcontet->report_approvalpvir = $request->report_approvalpvir ? serialize($request->report_approvalpvir) : serialize([]);

            //--------------------------- Process Validation Interim Update end ------------------------------------------------------


             //Equipment hold time study protocol

             $documentcontet->eqp_approval = $request->eqp_approval;
             $documentcontet->eqp_objective = $request->eqp_objective;
             $documentcontet->eqp_scope = $request->eqp_scope;
 
             if (!empty($request->eqpresponsibility)) {
                 $documentcontet->eqpresponsibility = serialize($request->eqpresponsibility);
             }
             if (!empty($request->eqpdetails)) {
                 $documentcontet->eqpdetails = serialize($request->eqpdetails);
             }
 
             if (!empty($request->eqpsampling)) {
                 $documentcontet->eqpsampling = serialize($request->eqpsampling);
             }
 
             if (!empty($request->Samplingprocedure)) {
                 $documentcontet->Samplingprocedure = serialize($request->Samplingprocedure);
             }
 
             if (!empty($request->AcceptenceCriteria)) {
                 $documentcontet->AcceptenceCriteria = serialize($request->AcceptenceCriteria);
             }
 
             if (!empty($request->EnvironmentalConditions)) {
                 $documentcontet->EnvironmentalConditions = serialize($request->EnvironmentalConditions);
             }
 
             if (!empty($request->eqpdetailsdeviation)) {
                 $documentcontet->eqpdetailsdeviation = serialize($request->eqpdetailsdeviation);
             }
 
             if (!empty($request->eqpdetailschangecontrol)) {
                 $documentcontet->eqpdetailschangecontrol = serialize($request->eqpdetailschangecontrol);
             }
 
             if (!empty($request->eqpdetailssummary)) {
                 $documentcontet->eqpdetailssummary = serialize($request->eqpdetailssummary);
             }
 
             if (!empty($request->eqpdetailsconclusion)) {
                 $documentcontet->eqpdetailsconclusion = serialize($request->eqpdetailsconclusion);
             }
 
             if (!empty($request->eqpdetailstraining)) {
                 $documentcontet->eqpdetailstraining = serialize($request->eqpdetailstraining);
             }
 
             //Format For Compressed Air And Nitrogen Gas System Report
 
             $documentcontet->format_approval = $request->format_approval;
             $documentcontet->format_objective = $request->format_objective;
             $documentcontet->format_scope = $request->format_scope;
 
             if (!empty($request->formatidentification)) {
                 $documentcontet->formatidentification = serialize($request->formatidentification);
             }
 
             if (!empty($request->executiontteam)) {
                 $documentcontet->executiontteam = serialize($request->executiontteam);
             }
 
             if (!empty($request->formatdocuments)) {
                 $documentcontet->formatdocuments = serialize($request->formatdocuments);
             }
 
             if (!empty($request->revalidationtype)) {
                 $documentcontet->revalidationtype = serialize($request->revalidationtype);
             }
             if (!empty($request->RevalidationCriteria)) {
                 $documentcontet->RevalidationCriteria = serialize($request->RevalidationCriteria);
             }
 
             if (!empty($request->generalconsideration)) {
                 $documentcontet->generalconsideration = serialize($request->generalconsideration);
             }
 
            
             if (!empty($request->precautions)) {
                 $documentcontet->precautions = serialize($request->precautions);
             }
 
             if (!empty($request->calibrationstatus)) {
                 $documentcontet->calibrationstatus = serialize($request->calibrationstatus);
             }
 
            
             if (!empty($request->testobservation)) {
                 $documentcontet->testobservation = serialize($request->testobservation);
             }
 
             if (!empty($request->formatannexure)) {
                 $documentcontet->formatannexure = serialize($request->formatannexure);
             }
 
             if (!empty($request->formatdeviation)) {
                 $documentcontet->formatdeviation = serialize($request->formatdeviation);
             }
 
             if (!empty($request->formatcc)) {
                 $documentcontet->formatcc = serialize($request->formatcc);
             }
 
             if (!empty($request->formatsummary)) {
                 $documentcontet->formatsummary = serialize($request->formatsummary);
             }
 
             if (!empty($request->formatconclusion)) {
                 $documentcontet->formatconclusion = serialize($request->formatconclusion);
             }
 


            if (!empty($request->responsibilities)) {
                $documentcontet->responsibilities = serialize($request->responsibilities);
            }

            if (!empty($request->referencesss)) {
                $documentcontet->referencesss = serialize($request->referencesss);
            }

            if (!empty($request->assessment)) {
                $documentcontet->assessment = serialize($request->assessment);
            }

            if (!empty($request->strategy)) {
                $documentcontet->strategy = serialize($request->strategy);
            }

            if (!empty($request->summary_and_findings)) {
                $documentcontet->summary_and_findings = serialize($request->summary_and_findings);
            }

            if (!empty($request->conclusion_and_recommendations)) {
                $documentcontet->conclusion_and_recommendations = serialize($request->conclusion_and_recommendations);
            }
            //study report end

            //study protocol start
            $documentcontet->stprotocol_purpose = $request->stprotocol_purpose;
            $documentcontet->stprotocol_scope = $request->stprotocol_scope;

            if (!empty($request->stresponsibility)) {
                $documentcontet->stresponsibility = serialize($request->stresponsibility);
            }

            if (!empty($request->stdefination)) {
                $documentcontet->stdefination = serialize($request->stdefination);
            }

            if (!empty($request->streferences)) {
                $documentcontet->streferences = serialize($request->streferences);
            }

            if (!empty($request->stbackground)) {
                $documentcontet->stbackground = serialize($request->stbackground);
            }

            if (!empty($request->stassessment)) {
                $documentcontet->stassessment = serialize($request->stassessment);
            }

            if (!empty($request->ststrategy)) {
                $documentcontet->ststrategy = serialize($request->ststrategy);
            }

            if (!empty($request->stsummary)) {
                $documentcontet->stsummary = serialize($request->stsummary);
            }

            if (!empty($request->stconclusion)) {
                $documentcontet->stconclusion = serialize($request->stconclusion);
            }

            if (!empty($request->stannexure)) {
                $documentcontet->stannexure = serialize($request->stannexure);
            }
            if (!empty($request->Referencedocunum)) {
                $documentcontet->Referencedocunum = serialize($request->Referencedocunum);
            }
            //study protocol end


            $documentcontet->equipment_objective = $request->equipment_objective;
            $documentcontet->equipment_scope = $request->equipment_scope;
            $documentcontet->equipment_purpose = $request->equipment_purpose;

            if (!empty($request->euipmentresponsibility)) {
                $documentcontet->euipmentresponsibility = serialize($request->euipmentresponsibility);
            }

            if (!empty($request->eqpAnalyticalReport)) {
                $documentcontet->eqpAnalyticalReport = serialize($request->eqpAnalyticalReport);
            }

            if (!empty($request->eqpdeviation)) {
                $documentcontet->eqpdeviation = serialize($request->eqpdeviation);
            }

            
            if (!empty($request->eqpchangecontrol)) {
                $documentcontet->eqpchangecontrol = serialize($request->eqpchangecontrol);
            }

            if (!empty($request->eqpsummary)) {
                $documentcontet->eqpsummary = serialize($request->eqpsummary);
            }

            if (!empty($request->eqpconclusion)) {
                $documentcontet->eqpconclusion = serialize($request->eqpconclusion);
            }

            if (!empty($request->eqpreportapproval)) {
                $documentcontet->eqpreportapproval = serialize($request->eqpreportapproval);
            }
        
           
            //Process Validation Protocol
            $documentcontet->generic_prvp = $request->generic_prvp;
            $documentcontet->prvp_product_code = $request->prvp_product_code;
            $documentcontet->prvp_std_batch = $request->prvp_std_batch;
            $documentcontet->prvp_category = $request->prvp_category;
            $documentcontet->prvp_label_claim = $request->prvp_label_claim;
            $documentcontet->prvp_market = $request->prvp_market;
            $documentcontet->prvp_shelf_life = $request->prvp_shelf_life;
            $documentcontet->prvp_bmr_no = $request->prvp_bmr_no;
            $documentcontet->prvp_mfr_no = $request->prvp_mfr_no;

            $documentcontet->prvp_purpose = $request->prvp_purpose;
            $documentcontet->prvp_scope = $request->prvp_scope;
            $documentcontet->reason_validation = $request->reason_validation;
            $documentcontet->validation_po_prvp = $request->validation_po_prvp;
            $documentcontet->description_sop_prvp = $request->description_sop_prvp;
            $documentcontet->prvp_procedure = $request->prvp_procedure;

            //gtp
            $documentcontet->gtp_product_material_name = $request->gtp_product_material_name;
            $documentcontet->gtp_test = $request->gtp_test;

            //tds
            $documentcontet->tds_result = $request->tds_result;
            $documentcontet->tds_test_wise = $request->tds_test_wise;

             // htsp
             $documentcontet->htsp_purpose = $request->htsp_purpose;
             $documentcontet->htsp_scope = $request->htsp_scope;

            //  pvp
            $documentcontet->pvp_purpose = $request->pvp_purpose;
            $documentcontet->pvp_scope = $request->pvp_scope;

          // htsp
             $documentcontet->htsp_responsibility = $request->htsp_responsibility ? serialize($request->htsp_responsibility) : serialize([]);
             $documentcontet->htsp_description_of_sop = $request->htsp_description_of_sop ? serialize($request->htsp_description_of_sop) : serialize([]);
             $documentcontet->htsp_specifications = $request->htsp_specifications ? serialize($request->htsp_specifications) : serialize([]);
             $documentcontet->htsp_sampling_analysis = $request->htsp_sampling_analysis ? serialize($request->htsp_sampling_analysis) : serialize([]);
             $documentcontet->htsp_environmental_conditions = $request->htsp_environmental_conditions ? serialize($request->htsp_environmental_conditions) : serialize([]);
             $documentcontet->htsp_sample_quantity_calculation = $request->htsp_sample_quantity_calculation ? serialize($request->htsp_sample_quantity_calculation) : serialize([]);
             $documentcontet->htsp_deviation = $request->htsp_deviation ? serialize($request->htsp_deviation) : serialize([]);
             $documentcontet->htsp_summary = $request->htsp_summary ? serialize($request->htsp_summary) : serialize([]);
             $documentcontet->htsp_conclusion = $request->htsp_conclusion ? serialize($request->htsp_conclusion) : serialize([]);

            //  pvp
             $documentcontet->reasonfor_validationpvp = $request->reasonfor_validationpvp ? serialize($request->reasonfor_validationpvp) : serialize([]);
             $documentcontet->pvp_responsibility = $request->pvp_responsibility ? serialize($request->pvp_responsibility) : serialize([]);
             $documentcontet->pvp_validationpvp = $request->pvp_validationpvp ? serialize($request->pvp_validationpvp) : serialize([]);
             $documentcontet->descriptionsop_pvp = $request->descriptionsop_pvp ? serialize($request->descriptionsop_pvp) : serialize([]);
             $documentcontet->packingmaterial_pvp = $request->packingmaterial_pvp ? serialize($request->packingmaterial_pvp) : serialize([]);
             $documentcontet->equipment_pvp = $request->equipment_pvp ? serialize($request->equipment_pvp) : serialize([]);
             $documentcontet->rationale_pvp = $request->rationale_pvp ? serialize($request->rationale_pvp) : serialize([]);
             $documentcontet->sampling_pvp = $request->sampling_pvp ? serialize($request->sampling_pvp) : serialize([]);
             $documentcontet->critical_pvp = $request->critical_pvp ? serialize($request->critical_pvp) : serialize([]);
             $documentcontet->product_acceptancepvp = $request->product_acceptancepvp ? serialize($request->product_acceptancepvp) : serialize([]);
             $documentcontet->Holdtime_pvp = $request->Holdtime_pvp ? serialize($request->Holdtime_pvp) : serialize([]);
             $documentcontet->cleaning_validationpvp = $request->cleaning_validationpvp ? serialize($request->cleaning_validationpvp) : serialize([]);
             $documentcontet->Stability_studypvp = $request->Stability_studypvp ? serialize($request->Stability_studypvp) : serialize([]);
             $documentcontet->Deviation_pvp = $request->Deviation_pvp ? serialize($request->Deviation_pvp) : serialize([]);
             $documentcontet->Change_controlpvp = $request->Change_controlpvp ? serialize($request->Change_controlpvp) : serialize([]);
             $documentcontet->Summary_pvp = $request->Summary_pvp ? serialize($request->Summary_pvp) : serialize([]);
             $documentcontet->Conclusion_pvp = $request->Conclusion_pvp ? serialize($request->Conclusion_pvp) : serialize([]);


                        // ---------------packing valodation update tabs by kppatel---------------
            $documentcontet->Purpose_PaVaReKp = $request->Purpose_PaVaReKp ? serialize($request->Purpose_PaVaReKp) : serialize([]);
            $documentcontet->Scope_PaVaReKp = $request->Scope_PaVaReKp ? serialize($request->Scope_PaVaReKp) : serialize([]);
            $documentcontet->BatchDetails_PaVaReKp = $request->BatchDetails_PaVaReKp ? serialize($request->BatchDetails_PaVaReKp) : serialize([]);
            $documentcontet->ReferenceDocument_PaVaReKp = $request->ReferenceDocument_PaVaReKp ? serialize($request->ReferenceDocument_PaVaReKp) : serialize([]);
            $documentcontet->PackingMaterialApprovalVendDeat_PaVaReKp = $request->PackingMaterialApprovalVendDeat_PaVaReKp ? serialize($request->PackingMaterialApprovalVendDeat_PaVaReKp) : serialize([]);
            $documentcontet->UsedEquipmentCalibrationQualiSta_PaVaReKp = $request->UsedEquipmentCalibrationQualiSta_PaVaReKp ? serialize($request->UsedEquipmentCalibrationQualiSta_PaVaReKp) : serialize([]);
            $documentcontet->ResultOfPacking_PaVaReKp = $request->ResultOfPacking_PaVaReKp ? serialize($request->ResultOfPacking_PaVaReKp) : serialize([]);
            $documentcontet->CriticalProcessParameters_PaVaReKp = $request->CriticalProcessParameters_PaVaReKp ? serialize($request->CriticalProcessParameters_PaVaReKp) : serialize([]);
            $documentcontet->yield_PaVaReKp = $request->yield_PaVaReKp ? serialize($request->yield_PaVaReKp) : serialize([]);
            $documentcontet->HoldTimeStudy_PaVaReKp = $request->HoldTimeStudy_PaVaReKp ? serialize($request->HoldTimeStudy_PaVaReKp) : serialize([]);
            $documentcontet->CleaningValidation_PaVaReKp = $request->CleaningValidation_PaVaReKp ? serialize($request->CleaningValidation_PaVaReKp) : serialize([]);
            $documentcontet->StabilityStudy_PaVaReKp = $request->StabilityStudy_PaVaReKp ? serialize($request->StabilityStudy_PaVaReKp) : serialize([]);
            $documentcontet->DeviationIfAny_PaVaReKp = $request->DeviationIfAny_PaVaReKp ? serialize($request->DeviationIfAny_PaVaReKp) : serialize([]);
            $documentcontet->ChangeControlifany_PaVaReKp = $request->ChangeControlifany_PaVaReKp ? serialize($request->ChangeControlifany_PaVaReKp) : serialize([]);
            $documentcontet->Summary_PaVaReKp = $request->Summary_PaVaReKp ? serialize($request->Summary_PaVaReKp) : serialize([]);
            $documentcontet->Conclusion_PaVaReKp = $request->Conclusion_PaVaReKp ? serialize($request->Conclusion_PaVaReKp) : serialize([]);
            $documentcontet->ProposedParameters_PaVaReKp = $request->ProposedParameters_PaVaReKp ? serialize($request->ProposedParameters_PaVaReKp) : serialize([]);
            $documentcontet->ReportApproval_PaVaReKp = $request->ReportApproval_PaVaReKp ? serialize($request->ReportApproval_PaVaReKp) : serialize([]);

            //   --starts---------------formate air and nitrogen protcal update tab start

            $documentcontet->Protocolapproval_FoCompAaNirogenkp = $request->Protocolapproval_FoCompAaNirogenkp ? serialize($request->Protocolapproval_FoCompAaNirogenkp) : serialize([]);
            $documentcontet->Objective_FoCompAaNirogenkp = $request->Objective_FoCompAaNirogenkp ? serialize($request->Objective_FoCompAaNirogenkp) : serialize([]);
            $documentcontet->Purpose_FoCompAaNirogenkp = $request->Purpose_FoCompAaNirogenkp ? serialize($request->Purpose_FoCompAaNirogenkp) : serialize([]);
            $documentcontet->Scope_FoCompAaNirogenkp = $request->Scope_FoCompAaNirogenkp ? serialize($request->Scope_FoCompAaNirogenkp) : serialize([]);
            $documentcontet->ExcutionTeamResp_FoCompAaNirogenkp = $request->ExcutionTeamResp_FoCompAaNirogenkp ? serialize($request->ExcutionTeamResp_FoCompAaNirogenkp) : serialize([]);
            $documentcontet->Abbreviations_FoCompAaNirogenkp = $request->Abbreviations_FoCompAaNirogenkp ? serialize($request->Abbreviations_FoCompAaNirogenkp) : serialize([]);
            $documentcontet->EquipmentSystemIde_FoCompAaNirogenkp = $request->EquipmentSystemIde_FoCompAaNirogenkp ? serialize($request->EquipmentSystemIde_FoCompAaNirogenkp) : serialize([]);
            $documentcontet->DocumentFollowed_FoCompAaNirogenkp = $request->DocumentFollowed_FoCompAaNirogenkp ? serialize($request->DocumentFollowed_FoCompAaNirogenkp) : serialize([]);
            $documentcontet->GenralConsPre_FoCompAaNirogenkp = $request->GenralConsPre_FoCompAaNirogenkp ? serialize($request->GenralConsPre_FoCompAaNirogenkp) : serialize([]);
            $documentcontet->RevalidCrite_FoCompAaNirogenkp = $request->RevalidCrite_FoCompAaNirogenkp ? serialize($request->RevalidCrite_FoCompAaNirogenkp) : serialize([]);
            $documentcontet->Precautions_FoCompAaNirogenkp = $request->Precautions_FoCompAaNirogenkp ? serialize($request->Precautions_FoCompAaNirogenkp) : serialize([]);
            $documentcontet->RevalidProcess_FoCompAaNirogenkp = $request->RevalidProcess_FoCompAaNirogenkp ? serialize($request->RevalidProcess_FoCompAaNirogenkp) : serialize([]);
            $documentcontet->AcceptanceCrite_FoCompAaNirogenkp = $request->AcceptanceCrite_FoCompAaNirogenkp ? serialize($request->AcceptanceCrite_FoCompAaNirogenkp) : serialize([]);
            $documentcontet->Annexure_FoCompAaNirogenkp = $request->Annexure_FoCompAaNirogenkp ? serialize($request->Annexure_FoCompAaNirogenkp) : serialize([]);
                        

            $documentcontet->responsibilityprvp = $request->responsibilityprvp ? serialize($request->responsibilityprvp) : serialize([]);
            $documentcontet->prvp_rawmaterial = $request->prvp_rawmaterial ? serialize($request->prvp_rawmaterial) : serialize([]);
            $documentcontet->pripackmaterial = $request->pripackmaterial ? serialize($request->pripackmaterial) : serialize([]);
            $documentcontet->equipCaliQuali = $request->equipCaliQuali ? serialize($request->equipCaliQuali) : serialize([]);
            $documentcontet->rationale_critical = $request->rationale_critical ? serialize($request->rationale_critical) : serialize([]);
            $documentcontet->general_instrument = $request->general_instrument ? serialize($request->general_instrument) : serialize([]);
            $documentcontet->process_flow = $request->process_flow ? serialize($request->process_flow) : serialize([]);
            $documentcontet->diagrammatic = $request->diagrammatic ? serialize($request->diagrammatic) : serialize([]);
            $documentcontet->critical_process = $request->critical_process ? serialize($request->critical_process) : serialize([]);
            $documentcontet->product_acceptance = $request->product_acceptance ? serialize($request->product_acceptance) : serialize([]);
            $documentcontet->holdtime_study = $request->holdtime_study ? serialize($request->holdtime_study) : serialize([]);
            $documentcontet->cleaning_validation = $request->cleaning_validation ? serialize($request->cleaning_validation) : serialize([]);
            $documentcontet->stability_study = $request->stability_study ? serialize($request->stability_study) : serialize([]);
            $documentcontet->deviation = $request->deviation ? serialize($request->deviation) : serialize([]);
            $documentcontet->change_control = $request->change_control ? serialize($request->change_control) : serialize([]);
            $documentcontet->summary_prvp = $request->summary_prvp ? serialize($request->summary_prvp) : serialize([]);
            $documentcontet->conclusion_prvp = $request->conclusion_prvp ? serialize($request->conclusion_prvp) : serialize([]);
            $documentcontet->training_prvp = $request->training_prvp ? serialize($request->training_prvp) : serialize([]);


            
            //////PRVP End /////////////////

         //---------------------------process Validation Report--------------------------------------------

            $documentcontet->generic_pvr = $request->generic_pvr;
            $documentcontet->product_code_pvr = $request->product_code_pvr;
            $documentcontet->std_batch_pvr = $request->std_batch_pvr;
            $documentcontet->category_pvr = $request->category_pvr;
            $documentcontet->label_claim_pvr = $request->label_claim_pvr;
            $documentcontet->market_pvr = $request->market_pvr;
            $documentcontet->shelf_life_pvr = $request->shelf_life_pvr;
            $documentcontet->bmr_no_pvr = $request->bmr_no_pvr;
            $documentcontet->mfr_no_pvr = $request->mfr_no_pvr;
           
            $documentcontet->purpose_pvr = $request->purpose_pvr ? serialize($request->purpose_pvr) : serialize([]);
            $documentcontet->scope_pvr = $request->scope_pvr ? serialize($request->scope_pvr) : serialize([]);
            $documentcontet->batchdetail_pvr = $request->batchdetail_pvr ? serialize($request->batchdetail_pvr) : serialize([]);

            $documentcontet->refrence_document_pvr = $request->refrence_document_pvr ? serialize($request->refrence_document_pvr) : serialize([]);
            $documentcontet->active_raw_material_pvr = $request->active_raw_material_pvr ? serialize($request->active_raw_material_pvr) : serialize([]);
            $documentcontet->primary_packingmaterial_pvr = $request->primary_packingmaterial_pvr ? serialize($request->primary_packingmaterial_pvr) : serialize([]);
            $documentcontet->used_equipment_calibration_pvr = $request->used_equipment_calibration_pvr ? serialize($request->used_equipment_calibration_pvr) : serialize([]);

            
            $documentcontet->result_of_intermediate_pvr = $request->result_of_intermediate_pvr ? serialize($request->result_of_intermediate_pvr) : serialize([]);
            $documentcontet->result_of_finished_product_pvr = $request->result_of_finished_product_pvr ? serialize($request->result_of_finished_product_pvr) : serialize([]);
            $documentcontet->result_of_packing_finished_pvr = $request->result_of_packing_finished_pvr ? serialize($request->result_of_packing_finished_pvr) : serialize([]);
            $documentcontet->criticalprocess_parameter_pvr = $request->criticalprocess_parameter_pvr ? serialize($request->criticalprocess_parameter_pvr) : serialize([]);
            $documentcontet->yield_at_various_stage_pvr = $request->yield_at_various_stage_pvr ? serialize($request->yield_at_various_stage_pvr) : serialize([]);
            $documentcontet->hold_time_study_pvr = $request->hold_time_study_pvr ? serialize($request->hold_time_study_pvr) : serialize([]);

            $documentcontet->cleaningvalidation_pvr = $request->cleaningvalidation_pvr ? serialize($request->cleaningvalidation_pvr) : serialize([]);
            $documentcontet->stability_study_pvr = $request->stability_study_pvr ? serialize($request->stability_study_pvr) : serialize([]);
            $documentcontet->deviation_if_any_pvr = $request->deviation_if_any_pvr ? serialize($request->deviation_if_any_pvr) : serialize([]);
            $documentcontet->changecontrol_pvr = $request->changecontrol_pvr ? serialize($request->changecontrol_pvr) : serialize([]);
            $documentcontet->summary_pvr = $request->summary_pvr ? serialize($request->summary_pvr) : serialize([]);
            $documentcontet->conclusion_pvr = $request->conclusion_pvr ? serialize($request->conclusion_pvr) : serialize([]);

            $documentcontet->proposed_parameter_upcoming_batch_pvr = $request->proposed_parameter_upcoming_batch_pvr ? serialize($request->proposed_parameter_upcoming_batch_pvr) : serialize([]);
            $documentcontet->report_approval_pvr = $request->report_approval_pvr ? serialize($request->report_approval_pvr) : serialize([]);

        //---------------------------process Validation Report--------------------------------------------


        //-----------------------Cleaning Validation protocol-doc --------------------------------------- 

            $documentcontet->objective_cvpd = $request->objective_cvpd ? serialize($request->objective_cvpd) : serialize([]);
            $documentcontet->scope_cvpd = $request->scope_cvpd ? serialize($request->scope_cvpd) : serialize([]);
            $documentcontet->purpose_cvpd = $request->purpose_cvpd ? serialize($request->purpose_cvpd) : serialize([]);

            $documentcontet->responsibilities_cvpd = $request->responsibilities_cvpd ? serialize($request->responsibilities_cvpd) : serialize([]);
            $documentcontet->identification_sensitive_product_contamination_cvpd = $request->identification_sensitive_product_contamination_cvpd ? serialize($request->identification_sensitive_product_contamination_cvpd) : serialize([]);
            $documentcontet->matrix_worstcase_approach_cvpd = $request->matrix_worstcase_approach_cvpd ? serialize($request->matrix_worstcase_approach_cvpd) : serialize([]);
            $documentcontet->acceptance_criteria_cvpd = $request->acceptance_criteria_cvpd ? serialize($request->acceptance_criteria_cvpd) : serialize([]);


            $documentcontet->list_equipment_internal_surface_cvpd = $request->list_equipment_internal_surface_cvpd ? serialize($request->list_equipment_internal_surface_cvpd) : serialize([]);
            $documentcontet->identification_clean_surfaces_cvpd = $request->identification_clean_surfaces_cvpd ? serialize($request->identification_clean_surfaces_cvpd) : serialize([]);
            $documentcontet->sampling_method_cvpd = $request->sampling_method_cvpd ? serialize($request->sampling_method_cvpd) : serialize([]);
            $documentcontet->recovery_studies_cvpd = $request->recovery_studies_cvpd ? serialize($request->recovery_studies_cvpd) : serialize([]);
            $documentcontet->calculating_carry_over_cvpd = $request->calculating_carry_over_cvpd ? serialize($request->calculating_carry_over_cvpd) : serialize([]);
            $documentcontet->calculating_rinse_analysis_cvpd = $request->calculating_rinse_analysis_cvpd ? serialize($request->calculating_rinse_analysis_cvpd) : serialize([]);

            $documentcontet->general_procedure_clean_cvpd = $request->general_procedure_clean_cvpd ? serialize($request->general_procedure_clean_cvpd) : serialize([]);
            $documentcontet->analytical_method_validation_cvpd = $request->analytical_method_validation_cvpd ? serialize($request->analytical_method_validation_cvpd) : serialize([]);
            $documentcontet->list_cleaning_sop_cvpd = $request->list_cleaning_sop_cvpd ? serialize($request->list_cleaning_sop_cvpd) : serialize([]);
            $documentcontet->clean_validation_exercise_cvpd = $request->clean_validation_exercise_cvpd ? serialize($request->clean_validation_exercise_cvpd) : serialize([]);
            $documentcontet->evaluation_analytical_result_cvpd = $request->evaluation_analytical_result_cvpd ? serialize($request->evaluation_analytical_result_cvpd) : serialize([]);
            $documentcontet->summary_conclusion_cvpd = $request->summary_conclusion_cvpd ? serialize($request->summary_conclusion_cvpd) : serialize([]);

            $documentcontet->training_cvpd = $request->training_cvpd ? serialize($request->training_cvpd) : serialize([]);
        //-----------------------END Cleaning validation protocol doc--------------------------------------- 
        //-----------------------Cleaning Validation Report-doc --------------------------------------- 

            $documentcontet->objective_cvrd = $request->objective_cvrd ? serialize($request->objective_cvrd) : serialize([]);
            $documentcontet->scope_cvrd = $request->scope_cvrd ? serialize($request->scope_cvrd) : serialize([]);
            $documentcontet->purpose_cvrd = $request->purpose_cvrd ? serialize($request->purpose_cvrd) : serialize([]);
            $documentcontet->responsibilities_cvrd = $request->responsibilities_cvrd ? serialize($request->responsibilities_cvrd) : serialize([]);
            $documentcontet->analysis_methodology_cvrd = $request->analysis_methodology_cvrd ? serialize($request->analysis_methodology_cvrd) : serialize([]);
            $documentcontet->recovery_study_report_cvrd = $request->recovery_study_report_cvrd ? serialize($request->recovery_study_report_cvrd) : serialize([]);
            $documentcontet->acceptance_critria_cvrd = $request->acceptance_critria_cvrd ? serialize($request->acceptance_critria_cvrd) : serialize([]);
            $documentcontet->analytical_report_cvrd = $request->analytical_report_cvrd ? serialize($request->analytical_report_cvrd) : serialize([]);
            $documentcontet->physical_procedure_conformance_check_cvrd = $request->physical_procedure_conformance_check_cvrd ? serialize($request->physical_procedure_conformance_check_cvrd) : serialize([]);
            $documentcontet->conclusion_cvrd = $request->conclusion_cvrd ? serialize($request->conclusion_cvrd) : serialize([]);
        //---------------------- END-Cleaning Validation Report-doc --------------------------------------- 

            $documentcontet->responsibility = $request->responsibility ? serialize($request->responsibility) : serialize([]);
            $documentcontet->accountability = $request->accountability ? serialize($request->accountability) : serialize([]);
            $documentcontet->abbreviation = $request->abbreviation ? serialize($request->abbreviation) : serialize([]);
            $documentcontet->defination = $request->defination ? serialize($request->defination) : serialize([]);
            $documentcontet->reporting = $request->reporting ? serialize($request->reporting) : serialize([]);
            $documentcontet->materials_and_equipments = $request->materials_and_equipments ? serialize($request->materials_and_equipments) : serialize([]);
            $documentcontet->references = $request->references ? serialize($request->references) : serialize([]);
            $documentcontet->ann = $request->ann ? serialize($request->ann) : serialize([]);

            // temperture maping tabs updated
            $documentcontet->ProtocolApproval_TemperMap = $request->ProtocolApproval_TemperMap ? serialize($request->ProtocolApproval_TemperMap) : serialize([]);
            $documentcontet->Objective_TemperMap = $request->Objective_TemperMap ? serialize($request->Objective_TemperMap) : serialize([]);
            $documentcontet->Scope_TemperMap = $request->Scope_TemperMap ? serialize($request->Scope_TemperMap) : serialize([]);
            $documentcontet->AreaValidated_TemperMap = $request->AreaValidated_TemperMap ? serialize($request->AreaValidated_TemperMap) : serialize([]);
            $documentcontet->ValidationTeamResponsibilities_TemperMap = $request->ValidationTeamResponsibilities_TemperMap ? serialize($request->ValidationTeamResponsibilities_TemperMap) : serialize([]);
            $documentcontet->Reference_TemperMap = $request->Reference_TemperMap ? serialize($request->Reference_TemperMap) : serialize([]);
            $documentcontet->DocumentFollowed_TemperMap = $request->DocumentFollowed_TemperMap ? serialize($request->DocumentFollowed_TemperMap) : serialize([]);
            $documentcontet->StudyRationale_TemperMap = $request->StudyRationale_TemperMap ? serialize($request->StudyRationale_TemperMap) : serialize([]);
            $documentcontet->Procedure_TemperMap = $request->Procedure_TemperMap ? serialize($request->Procedure_TemperMap) : serialize([]);
            $documentcontet->CriteriaRevalidation_TemperMap = $request->CriteriaRevalidation_TemperMap ? serialize($request->CriteriaRevalidation_TemperMap) : serialize([]);
            $documentcontet->MaterialDocumentRequired_TemperMap = $request->MaterialDocumentRequired_TemperMap ? serialize($request->MaterialDocumentRequired_TemperMap) : serialize([]);
            $documentcontet->AcceptanceCriteria_TemperMap = $request->AcceptanceCriteria_TemperMap ? serialize($request->AcceptanceCriteria_TemperMap) : serialize([]);
            $documentcontet->TypeofValidation_TemperMap = $request->TypeofValidation_TemperMap ? serialize($request->TypeofValidation_TemperMap) : serialize([]);
            $documentcontet->ObservationResult_TemperMap = $request->ObservationResult_TemperMap ? serialize($request->ObservationResult_TemperMap) : serialize([]);
            $documentcontet->Abbreviations_TemperMap = $request->Abbreviations_TemperMap ? serialize($request->Abbreviations_TemperMap) : serialize([]);
            $documentcontet->DeviationAny_TemperMap = $request->DeviationAny_TemperMap ? serialize($request->DeviationAny_TemperMap) : serialize([]);
            $documentcontet->ChangeControl_TemperMap = $request->ChangeControl_TemperMap ? serialize($request->ChangeControl_TemperMap) : serialize([]);
            $documentcontet->Summary_TemperMap = $request->Summary_TemperMap ? serialize($request->Summary_TemperMap) : serialize([]);
            $documentcontet->Conclusion_TemperMap = $request->Conclusion_TemperMap ? serialize($request->Conclusion_TemperMap) : serialize([]);
            $documentcontet->AttachmentList_TemperMap = $request->AttachmentList_TemperMap ? serialize($request->AttachmentList_TemperMap) : serialize([]);
            $documentcontet->PostApproval_TemperMap = $request->PostApproval_TemperMap ? serialize($request->PostApproval_TemperMap) : serialize([]);

            // hold time  study report  updated

            $documentcontet->Purpose_HoTiStRe = $request->Purpose_HoTiStRe ? serialize($request->Purpose_HoTiStRe) : serialize([]);
            $documentcontet->Scope_HoTiStRe = $request->Scope_HoTiStRe ? serialize($request->Scope_HoTiStRe) : serialize([]);
            $documentcontet->BatchDetails_HoTiStRe = $request->BatchDetails_HoTiStRe ? serialize($request->BatchDetails_HoTiStRe) : serialize([]);
            $documentcontet->ReferenceDocument_HoTiStRe = $request->ReferenceDocument_HoTiStRe ? serialize($request->ReferenceDocument_HoTiStRe) : serialize([]);
            $documentcontet->ResultBulkStage_HoTiStRe = $request->ResultBulkStage_HoTiStRe ? serialize($request->ResultBulkStage_HoTiStRe) : serialize([]);
            $documentcontet->DeviationIfAny_HoTiStRe = $request->DeviationIfAny_HoTiStRe ? serialize($request->DeviationIfAny_HoTiStRe) : serialize([]);
            $documentcontet->Summary_HoTiStRe = $request->Summary_HoTiStRe ? serialize($request->Summary_HoTiStRe) : serialize([]);
            $documentcontet->Conclusion_HoTiStRe = $request->Conclusion_HoTiStRe ? serialize($request->Conclusion_HoTiStRe) : serialize([]);
            $documentcontet->ReportApproval_HoTiStRe = $request->ReportApproval_HoTiStRe ? serialize($request->ReportApproval_HoTiStRe) : serialize([]);

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
          //  dd($documentcontet);

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

            $RowSpecification_Data = DocumentGrid::where(['document_type_id' => $document->id, 'identifier' => 'Row_Materail'])->firstOrNew();
            $RowSpecification_Data->document_type_id = $document->id;
            $RowSpecification_Data->identifier = 'Row_Materail';
            $RowSpecification_Data->data = $request->Row_Materail;
            $RowSpecification_Data->save();

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

            $CalibrationQualificationstatus = DocumentGrid::where(['document_type_id' => $document->id, 'identifier' => 'CalibrationQualificationStatus'])->firstOrNew();
            $CalibrationQualificationstatus->document_type_id = $document->id;
            $CalibrationQualificationstatus->identifier = 'CalibrationQualificationStatus';
            $CalibrationQualificationstatus->data = $request->qualitycontrol_1;
            $CalibrationQualificationstatus->save();



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


            $RevisionData = DocumentGrid ::where(['document_type_id' => $document->id, 'identifier' => 'revision_history'])->firstOrNew();
            $RevisionData->document_type_id = $document->id;
            $RevisionData->identifier = 'revision_history';
            $RevisionData->data = $request->revision_history;
            $RevisionData->save();


            $ProductSpecification = DocumentGrid::firstOrNew(['document_type_id' =>$document->id, 'identifier' => 'ProductSpecification']);
            $ProductSpecification->document_type_id = $document->id;
            $ProductSpecification->identifier = 'ProductSpecification';
            $ProductSpecification->data = $request->product;
            $ProductSpecification->save();



            $MaterialSpecification = DocumentGrid::firstOrNew(['document_type_id' =>$document->id, 'identifier' => 'MaterialSpecification']);
            $MaterialSpecification->document_type_id = $document->id;
            $MaterialSpecification->identifier = 'MaterialSpecification';
            $MaterialSpecification->data = $request->row_material;
            $MaterialSpecification->save();


            $Finished_Product = DocumentGrid :: firstOrNew(['document_type_id' =>$document->id, 'identifier' => 'Finished_Product']);
            $Finished_Product->document_type_id = $document->id;
            $Finished_Product->identifier = 'Finished_Product';
            $Finished_Product->data = $request->item;
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
            $Specification_Validation_Data_CVS->save();


            $SpecificationData_invs = DocumentGrid::firstOrNew(['document_type_id' => $document->id, 'identifier' => 'specificationInprocessValidationSpecification']);
            $SpecificationData_invs->document_type_id = $document->id;
            $SpecificationData_invs->identifier = 'specificationInprocessValidationSpecification';
            $SpecificationData_invs->data = $request->specification_details_inps;
            $SpecificationData_invs->save();

            $Specification_Validation_Data_invs = DocumentGrid::firstOrNew(['document_type_id' => $document->id, 'identifier' => 'SPECIFICATION_VALIDATION_Inprocess_Validation_Specification']);
            $Specification_Validation_Data_invs->document_type_id = $document->id;
            $Specification_Validation_Data_invs->identifier = 'SPECIFICATION_VALIDATION_Inprocess_Validation_Specification';
            $Specification_Validation_Data_invs->data = $request->specification_validation_details_inps;
            $Specification_Validation_Data_invs->save();


            if (!empty($request->file_attach) || !empty($request->deleted_file_attach)) {
                $existingFiles = json_decode($document->file_attach, true) ?? [];
    
                // Handle deleted files
                if (!empty($request->deleted_file_attach)) {
                    $filesToDelete = explode(',', $request->deleted_file_attach);
                    $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
                        return !in_array($file, $filesToDelete);
                    });
                }
    
                // Handle new files
                $newFiles = [];
                if ($request->hasFile('file_attach')) {
                    foreach ($request->file('file_attach') as $file) {
                        $name = $request->name . 'file_attach' . uniqid() . '.' . $file->getClientOriginalExtension();
                        $file->move(public_path('upload/'), $name);
                        $newFiles[] = $name;
                    }
                }
    
                // Merge existing and new files
                $allFiles = array_merge($existingFiles, $newFiles);
                $document->file_attach = json_encode($allFiles);
            }
    
    
            if (!empty($request->attach_cvpd) || !empty($request->deleted_attach_cvpd)) {
                $existingFiles = json_decode($document->attach_cvpd, true) ?? [];
    
                // Handle deleted files
                if (!empty($request->deleted_attach_cvpd)) {
                    $filesToDelete = explode(',', $request->deleted_attach_cvpd);
                    $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
                        return !in_array($file, $filesToDelete);
                    });
                }
    
                // Handle new files
                $newFiles = [];
                if ($request->hasFile('attach_cvpd')) {
                    foreach ($request->file('attach_cvpd') as $file) {
                        $name = $request->name . 'attach_cvpd' . uniqid() . '.' . $file->getClientOriginalExtension();
                        $file->move(public_path('upload/'), $name);
                        $newFiles[] = $name;
                    }
                }
    
                // Merge existing and new files
                $allFiles = array_merge($existingFiles, $newFiles);
                $document->attach_cvpd = json_encode($allFiles);
            }
    
           $document->save();
    











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



        // 🔹 SOP Number Generate Karna
    if ($document->revised == 'Yes') {
        $revisionNumber = str_pad($document->revised_doc, 2, '0', STR_PAD_LEFT);
    } else {
        $revisionNumber = '00';
    }

    if (in_array($document->sop_type_short, ['EOP', 'IOP'])) {
        $sopNumber = "{$document->department_id}/{$document->sop_type_short}/" . str_pad($currentId, 3, '0', STR_PAD_LEFT) . "-{$revisionNumber}";
    } else {
        $sopNumber = "{$document->sop_type_short}/{$document->department_id}/" . str_pad($currentId, 3, '0', STR_PAD_LEFT) . "-{$revisionNumber}";
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

        $RevisionData = DocumentGrid::where('document_type_id', $id)->where('identifier', "revision_history")->first();
        $RevisionGridData = isset($RevisionData->data) && is_string($RevisionData->data) 
            ? json_decode($RevisionData->data, true) :(is_array($RevisionData->data) ? $RevisionData->data:[]);

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

        $CalibrationQualificationstatus = DocumentGrid::where('document_type_id', $id)->where('identifier', "CalibrationQualificationStatus")->first();


        $calibrationdata = isset($CalibrationQualificationstatus->data) && is_string($CalibrationQualificationstatus->data) ? json_decode($CalibrationQualificationstatus->data) : (is_array($CalibrationQualificationstatus->data) ? $CalibrationQualificationstatus->data : []);


        $Finished_product_specification_cvs  = DocumentGrid::where('document_type_id',$id)->where('identifier','SpecificationCleaningValidationSpecification')->first();
        $finishedProductSpecificationData_CVS = isset($Finished_product_specification_cvs->data) && is_string($Finished_product_specification_cvs->data) ? json_decode($Finished_product_specification_cvs->data) : (is_array($Finished_product_specification_cvs->data) ? $Finished_product_specification_cvs->data : []);

        $specificationValidation_cvs = DocumentGrid::where('document_type_id',$id)->where('identifier','SPECIFICATION_VALIDATION_CleaningValidationSpecification')->first();
        $specificationValidationData_cvs = isset($specificationValidation_cvs->data)&& is_string($specificationValidation_cvs->data) ? json_decode($specificationValidation_cvs->data,true) :(is_array($specificationValidation_cvs->data) ? $specificationValidation_cvs->data:[]);


        //  dd($specificationValidation);


       $specificationValidation_inps = DocumentGrid::where('document_type_id',$id)->where('identifier','specificationInprocessValidationSpecification')->first();
        $data_inproces_specification = isset($specificationValidation_inps->data)&& is_string($specificationValidation_inps->data) ? json_decode($specificationValidation_inps->data,true) :(is_array($specificationValidation_inps->data) ? $specificationValidation_inps->data:[]);


        $specificationValidation_inps = DocumentGrid::where('document_type_id',$id)->where('identifier','SPECIFICATION_VALIDATION_Inprocess_Validation_Specification')->first();
        $specificationValidationData_inps = isset($specificationValidation_inps->data)&& is_string($specificationValidation_inps->data) ? json_decode($specificationValidation_inps->data,true) :(is_array($specificationValidation_inps->data) ? $specificationValidation_inps->data:[]);



        $documentContent = DocumentContent::where('document_id', $id)->first();
        // dd($documentContent);
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
            'STUDYPROTOCOL' => 'frontend.documents.protocol.study_protocol',
            'STUDY' => 'frontend.documents.reports.study_report',
            'EQUIPMENTHOLDREPORT' => 'frontend.documents.reports.equipment_hold_report',
            'TEMPMAPPING' => 'frontend.documents.reports.temperatur-mapping-report',
            'REPORT' => 'frontend.documents.report-pdf',
            'PROVALIDRE' => 'frontend.documents.reports.process-validation-report',
            'PROCUMREPORT' => 'frontend.documents.reports.procumreport',
            'REQULIFICATION'=>'frontend.documents.reports.requlification',
            'EQUIPMENTHOLDPROTOCOL' => 'frontend.documents.protocol.equipment_hold_protocol',
            'ANNEQUALPROTO' => 'frontend.documents.protocol.annexure_for_qualification_protocol',
            'ANNEQUALREPORT' =>'frontend.documents.reports.annexure_for_qualification_report',
            'AAEUSERREQUESPECI' => 'frontend.documents.reports.annexure_for_user_requirement_specification_report',
            'PROVALIPROTOCOL'=>'frontend.documents.protocol.provaliprotocol',
            'REQULIFICATIONPROTOCOL'=>'frontend.documents.protocol.requliprotocol',
            'REPORTFORMEDIAFILL'=>'frontend.documents.reports.reportformediafill',
            'PROTOCOLFORMEDIAFILL'=>'frontend.documents.protocol.protocolformediafill',
            'ANNACINQULIPROTOCOL'=>'frontend.documents.protocol.anacinquliprotocol',
            'ANNACOPERQULIPROTOCOL'=>'frontend.documents.protocol.anacoperaquliprotocol',
            'ANNACPERMQULIPROTOCOL'=>'frontend.documents.protocol.anacperquliprotocol',
            'PROVALIINTERRE'=>'frontend.documents.reports.process-interim-report',
            'PACKVALIREPORT'=>'frontend.documents.reports.pack-vali-report',
            'PACKVALIPROTOCOL'=>'frontend.documents.protocol.packvaliprotocol',
            'HOLDTIMESTUDYREPORT'=>'frontend.documents.reports.hold-time-study-report',
            'HOLDTIMESTUDYPROTOCOL'=>'frontend.documents.protocol.hold-time-study-protocol',
            'FOCONITOGENREPORT'=>' frontend.documents.reports.for-com-air-nitogen-report',
            'FOCONITOGENPROTOCOL'=>'frontend.documents.protocol.for-com-air-nitogen-protocol',
            'STABILITYPROTOCOL'=>'frontend.documents.protocol.stability-protocol',
            'CLEAVALIPROTODOC' => 'frontend.documents.protocol.cleaning_validation_protocoldoc',
            'CLEAVALIREPORTDOC' => 'frontend.documents.reports.cleaning_validation_reportdoc',
            'SMF' => 'frontend.documents.smf-pdf',
            'VMP' => 'frontend.documents.vmp-pdf',
            'QM' => 'frontend.documents.qm-pdf',
            default => 'frontend.documents.pdfpage',
        };

        // pdf related work
        $pdf = App::make('dompdf.wrapper');
        $time = Carbon::now();

        try {
            $pdf = PDF::loadview($viewName, compact('data', 'time', 'document', 'annexures', 'currentId', 'revisionNumber','testData','PackingDataGrid','sampleReconcilationDataGrid','SummaryDataGrid','SpecificationGrid','SpecificationDataGrid','ProductSpecificationData','MaterialSpecificationData','FinishedData','Inprocess_standardData','CLEANING_VALIDATIONData','GtpGridData','finishedProductSpecificationData','specificationValidationData','finishedProductSpecificationData_CVS','specificationValidationData_cvs','data_inproces_specification','specificationValidationData_inps','RevisionGridData','calibrationdata','documentContent'))
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

        // 🔹 SOP Number (Same As viewPDF)
        if ($document->revised == 'Yes') {
            $revisionNumber = str_pad($document->revised_doc, 2, '0', STR_PAD_LEFT);
        } else {
            $revisionNumber = '00';
        }

        if (in_array($document->sop_type_short, ['EOP', 'IOP'])) {
            $sopNumber = "{$document->department_id}/{$document->sop_type_short}/" . str_pad($currentId, 3, '0', STR_PAD_LEFT) . "-{$revisionNumber}";
        } else {
            $sopNumber = "{$document->sop_type_short}/{$document->department_id}/" . str_pad($currentId, 3, '0', STR_PAD_LEFT) . "-{$revisionNumber}";
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
                'STUDYPROTOCOL' => 'frontend.documents.protocol.study_protocol',
                'STUDY' => 'frontend.documents.reports.study_report',
                'EQUIPMENTHOLDREPORT' => 'frontend.documents.reports.equipment_hold_report',
                'TEMPMAPPING' => 'frontend.documents.reports.temperatur-mapping-report',
                'REPORT' => 'frontend.documents.report-pdf',
                'PROVALIDRE' => 'frontend.documents.reports.process-validation-report',
                'PROCUMREPORT' => 'frontend.documents.reports.procumreport',
                'REQULIFICATION'=>'frontend.documents.reports.requlification',
                'EQUIPMENTHOLDPROTOCOL' => 'frontend.documents.protocol.equipment_hold_protocol',
                'ANNEQUALPROTO' => 'frontend.documents.protocol.annexure_for_qualification_protocol',
                'ANNEQUALREPORT' =>'frontend.documents.reports.annexure_for_qualification_report',
                'AAEUSERREQUESPECI' => 'frontend.documents.reports.annexure_for_user_requirement_specification_report',
                'PROVALIPROTOCOL'=>'frontend.documents.protocol.provaliprotocol',
                'REQULIFICATIONPROTOCOL'=>'frontend.documents.protocol.requliprotocol',
                'REPORTFORMEDIAFILL'=>'frontend.documents.reports.reportformediafill',
                'PROTOCOLFORMEDIAFILL'=>'frontend.documents.protocol.protocolformediafill',
                'ANNACINQULIPROTOCOL'=>'frontend.documents.protocol.anacinquliprotocol',
                'ANNACOPERQULIPROTOCOL'=>'frontend.documents.protocol.anacoperaquliprotocol',
                'ANNACPERMQULIPROTOCOL'=>'frontend.documents.protocol.anacperquliprotocol',
                'PROVALIINTERRE'=>'frontend.documents.reports.process-interim-report',
                'PACKVALIREPORT'=>'frontend.documents.reports.pack-vali-report',
                'PACKVALIPROTOCOL'=>'frontend.documents.protocol.packvaliprotocol',
                'HOLDTIMESTUDYREPORT'=>'frontend.documents.reports.hold-time-study-report',
                'HOLDTIMESTUDYPROTOCOL'=>'frontend.documents.protocol.hold-time-study-protocol',
                'FOCONITOGENREPORT'=>' frontend.documents.reports.for-com-air-nitogen-report',
                'FOCONITOGENPROTOCOL'=>'frontend.documents.protocol.for-com-air-nitogen-protocol',
                'STABILITYPROTOCOL'=>'frontend.documents.protocol.stability-protocol',
                'CLEAVALIPROTODOC' => 'frontend.documents.protocol.cleaning_validation_protocoldoc',
                'CLEAVALIREPORTDOC' => 'frontend.documents.reports.cleaning_validation_reportdoc',
                'SMF' => 'frontend.documents.smf-pdf',
                'VMP' => 'frontend.documents.vmp-pdf',
                'QM' => 'frontend.documents.qm-pdf',
                default => 'frontend.documents.pdfpage',
            };

            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();


            $pdf = PDF::loadview($viewName, compact('data', 'time', 'document','annexures','currentId','documents','sopNumber'))
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



        // Inprocess  Validation Specification
        $SpecificationData_inps = DocumentGrid::where(['document_type_id' =>$document->id, 'identifier' => 'specificationInprocessValidationSpecification'])->first();
        $SpecificationData_inps = $SpecificationData_inps->replicate();

        $SpecificationData_inps->document_type_id = $newdoc->id;
        $SpecificationData_inps->identifier = 'specificationInprocessValidationSpecification';
        $SpecificationData_inps->save();

        $Specification_Validation_Data_inps = DocumentGrid::where(['document_type_id' =>$document->id, 'identifier' => 'SPECIFICATION_VALIDATION_Inprocess_Validation_Specification'])->first();

        $Specification_Validation_Data_inps = $Specification_Validation_Data_inps->replicate();
        $Specification_Validation_Data_inps->document_type_id = $newdoc->id;
        $Specification_Validation_Data_inps->identifier = 'SPECIFICATION_VALIDATION_Inprocess_Validation_Specification';
        //dd($Specification_Validation_Data_inps);
        $Specification_Validation_Data_inps->save();



       //---------------------------------------------------------------------------------------------



       $SpecificationData_invs = DocumentGrid::where(['document_type_id' => $document->id, 'identifier' => 'specificationInprocessValidationSpecification'])->firstOrNew();;
       $SpecificationData_invs->document_type_id = $document->id;
       $SpecificationData_invs->identifier = 'specificationInprocessValidationSpecification';
       $SpecificationData_invs->data = $request->specification_details_inps;
       $SpecificationData_invs->save();

       $Specification_Validation_Data_invs = DocumentGrid::where(['document_type_id' => $document->id, 'identifier' => 'SPECIFICATION_VALIDATION_Inprocess_Validation_Specification'])->firstOrNew();;
       $Specification_Validation_Data_invs->document_type_id = $document->id;
       $Specification_Validation_Data_invs->identifier = 'SPECIFICATION_VALIDATION_Inprocess_Validation_Specification';
       $Specification_Validation_Data_invs->data = $request->specification_validation_details_inps;
       $Specification_Validation_Data_invs->save();





        //--------------------------------------------------------------------------------------------



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
