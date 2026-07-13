@extends(request()->has('ajax_load') ? 'frontend.rcms.layout.empty' : 'frontend.rcms.layout.main_rcms')

@if (!request()->has('ajax_load'))
<script>
    // Function to update the options of the second dropdown based on the selection in the first dropdown
    function updateQueryOptions() {
        var scopeSelect = document.getElementById('scope');
        var querySelect = document.getElementById('query');
        var scopeValue = scopeSelect.value;

        // Clear existing options in the query dropdown
        querySelect.innerHTML = '';

        // Add options based on the selected scope
        if (scopeValue === 'external_audit') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Audit Preparation', '2'));
            querySelect.options.add(new Option('Pending Audit', '3'));
            querySelect.options.add(new Option('Pending Response', '4'));
            querySelect.options.add(new Option('CAPA Execution in Progress', '5'));
            querySelect.options.add(new Option('Closed - Done', '6'));


        } else if (scopeValue === 'internal_audit') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Audit Preparation', '2'));
            querySelect.options.add(new Option('Pending Audit', '3'));
            querySelect.options.add(new Option('Pending Response', '4'));
            querySelect.options.add(new Option('CAPA Execution in Progress', '5'));
            querySelect.options.add(new Option('Closed - Done', '6'));

        } else if (scopeValue === 'capa') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Pending CAPA Plan', '2'));
            querySelect.options.add(new Option('CAPA In Progress', '3'));
            querySelect.options.add(new Option('Pending Approval', '4'));
            querySelect.options.add(new Option('Pending Actions Completion', '5'));
            querySelect.options.add(new Option('Closed - Done', '6'));

        } else if (scopeValue === 'audit_program') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Pending Approval', '2'));
            querySelect.options.add(new Option('Pending Audit', '3'));
            querySelect.options.add(new Option('Closed - Done', '4'));

        } else if (scopeValue === 'lab_incident') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Pending Incident Review ', '2'));
            querySelect.options.add(new Option('Pending Investigation', '3'));
            querySelect.options.add(new Option('Pending Activity Completion', '4'));
            querySelect.options.add(new Option('Pending CAPA', '5'));
            querySelect.options.add(new Option('Pending QA Review', '6'));
            querySelect.options.add(new Option('Pending QA Head Approve', '7'));
            querySelect.options.add(new Option('Close - Done', '8'));

        } else if (scopeValue === 'risk_assement') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Risk Analysis & Work Group Assignment', '2'));
            querySelect.options.add(new Option('Risk Processing & Action Plan', '3'));
            querySelect.options.add(new Option('Pending HOD Approval ', '4'));
            querySelect.options.add(new Option('Actions Items in Progress', '5'));
            querySelect.options.add(new Option('Residual Risk Evaluation', '6'));
            querySelect.options.add(new Option('Close - Done', '7'));

        } else if (scopeValue === 'root_cause_analysis') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Investigation in Progress', '2'));
            querySelect.options.add(new Option('Pending Group Review Discussion', '3'));
            querySelect.options.add(new Option('Pending Group Review', '4'));
            querySelect.options.add(new Option('Pending QA Review', '5'));
            querySelect.options.add(new Option('Close - Done', '6'));

        } else if (scopeValue === 'Out_Of_Calibration') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('In Progress', '2'));
            querySelect.options.add(new Option('Close - Done', '3'));

        } else if (scopeValue === 'management_review') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('In Progress', '2'));
            querySelect.options.add(new Option('Close - Done', '3'));

        } else if (scopeValue === 'extension') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Pending Approval', '2'));
            querySelect.options.add(new Option('Close - Done', '3'));

        } else if (scopeValue === 'documents') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Close - Cancel', '2'));
            querySelect.options.add(new Option('Close - Done', '3'));

        } else if (scopeValue === 'observation') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Pending CAPA Plan', '2'));
            querySelect.options.add(new Option('Pending Approval', '3'));
            querySelect.options.add(new Option('Pending Final Approval', '4'));
            querySelect.options.add(new Option('Close - Done', '5'));
        } else if (scopeValue === 'action_item') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Work in Progress', '2'));
            querySelect.options.add(new Option('Close - Done', '3'));

        } else if (scopeValue === 'effectiveness_check') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Check Effectiveness', '2'));
            querySelect.options.add(new Option('Close - Done', '3'));


        } else if (scopeValue === 'CC') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Under HOD Review', '2'));
            querySelect.options.add(new Option('Pending QA Review', '3'));
            querySelect.options.add(new Option('CFT Review', '4'));
            querySelect.options.add(new Option('Pending Change Implementation', '5'));
            querySelect.options.add(new Option('Close - Done', '6'));
        }
        // else if (scopeValue === 'OOS Cemical') {
        //     querySelect.options.add(new Option('Opened', '1'));
        //     querySelect.options.add(new Option('Under HOD Review', '2'));
        //     querySelect.options.add(new Option('Pending QA Review', '3'));
        //     querySelect.options.add(new Option('CFT Review', '4'));
        //     querySelect.options.add(new Option('Pending Change Implementation', '5'));
        //     querySelect.options.add(new Option('Close - Done', '6'));
        // }



        // Add more conditions based on other scope values

    }
</script>
<style>
    #short_width {
        display: table-cell;
        width: 600px !important;
        /* white-space: nowrap; */
        overflow: hidden !important;
        text-overflow: ellipsis;
          word-break: break-all !important;
    }

    .table-container {
        overflow: auto;
        /* max-height: 350px;
  max-height: 350px; */
    }

    .table-header11 {
        position: sticky;
        top: 0;
        background-color: white;
        z-index: 1;
    }

    .table-body-new {
        margin-top: 30px;
    }

    .td_c {
        width: 100px !important;
    }

    @keyframes shimmer {
        0% {
            background-position: -450px 0;
        }
        100% {
            background-position: 450px 0;
        }
    }
    .skeleton-row td {
        padding: 15px 10px;
        vertical-align: middle;
        background: #fff !important;
    }
    .skeleton-bar {
        height: 14px;
        border-radius: 4px;
        background: linear-gradient(to right, #f6f7f8 8%, #edeef1 18%, #f6f7f8 33%);
        background-size: 800px 104px;
        animation: shimmer 1.5s infinite linear;
    }
</style>
@endif
@section('rcms_container')
    @if (!request()->has('ajax_load'))
    <div id="rcms-dashboard">
        <div class="container-fluid">
            <div class="dash-grid">


                <div>
                    <div class="inner-block scope-table" style="height: calc(100vh - 170px); padding: 0;">
                        <div class="grid-block">
                            <div class="group-input">
                                <label for="scope">Process</label>
                                <select id="scope" name="form">
                                    <option value="">All Records</option>
                                     @php
                                         if (!isset($uniqueProcessNames)) {
                                             $uniqueProcessNames = DB::table('q_m_s_processes')->select('process_name')->distinct()->pluck('process_name');
                                         }
                                     @endphp
                                     @foreach ($uniqueProcessNames as $ultraprocess)
                                         <option value={{ $ultraprocess }}>{{ $ultraprocess }}</option>
                                     @endforeach
                                </select>
                            </div>
                            <div class="group-input">
                                <label for="query">Criteria</label>
                                <select id="query" name="stage">
                                    <option value="">All Records</option>
                                    <option value="Closed">Closed Records</option>
                                    <option value="Opened">Opened Records</option>
                                    <option value="Cancelled">Cancelled Records</option>
                                    <option value="">Initial Deviation Category= Minor</option>
                                    <option value="">Initial Deviation Category= Major</option>
                                    <option value="">Initial Deviation Category= Critical</option>
                                    <option value="">Post Categorization Of Deviation= Minor</option>
                                    <option value="">Post Categorization Of Deviation= Major</option>
                                    <option value="">Post Categorization Of Deviation= Critical</option>
                                </select>
                            </div>
                            <div class="item-btn" onclick="window.print()">Print</div>
                        </div>
                        <div class="main-scope-table table-container">
                            <table class="table table-bordered" id="auditTable">
                                <thead class="table-header11">
                                    <tr>
                                        <th style="width: 5%">ID</th>
                                        <th style="width: 6%">Record No.</th>
                                        <th style="width: 5%">Parent ID</th>
                                        <th style="width: 5%">Division</th>
                                        <th style="width: 8%">Process</th>
                                        <th style="width: 45%">Short Description</th>
                                        <th style="width: 6%">Date Opened</th>
                                        <th style="width: 8%">Originator</th>
                                        <th style="width: 6%"> Due Date</th>
                                        <th style="width: 10%">Status</th>
                                    </tr>
                                </thead>
                                <tbody id="searchTable">
    @endif
                                    @if (!request()->has('ajax_load'))
                                        @for ($i = 0; $i < 6; $i++)
                                            <tr class="skeleton-row">
                                                <td><div class="skeleton-bar" style="width: 50px;"></div></td>
                                                <td><div class="skeleton-bar" style="width: 150px;"></div></td>
                                                <td><div class="skeleton-bar" style="width: 80px;"></div></td>
                                                <td><div class="skeleton-bar" style="width: 100px;"></div></td>
                                                <td><div class="skeleton-bar" style="width: 120px;"></div></td>
                                                <td><div class="skeleton-bar" style="width: 320px;"></div></td>
                                                <td><div class="skeleton-bar" style="width: 110px;"></div></td>
                                                <td><div class="skeleton-bar" style="width: 120px;"></div></td>
                                                <td><div class="skeleton-bar" style="width: 100px;"></div></td>
                                                <td><div class="skeleton-bar" style="width: 80px;"></div></td>
                                            </tr>
                                        @endfor
                                    @endif
                                    @php
                                        $modelsConfig = [
                                            ['class' => \App\Models\CC::class, 'type' => 'Change-Control', 'prefix' => 'CC'],
                                            ['class' => \App\Models\ActionItem::class, 'type' => 'Action-Item', 'prefix' => 'AI'],
                                            ['class' => \App\Models\extension_new::class, 'type' => 'Extension', 'prefix' => 'Ext'],
                                            ['class' => \App\Models\EffectivenessCheck::class, 'type' => 'Effectiveness-Check', 'prefix' => 'EC'],
                                            ['class' => \App\Models\InternalAudit::class, 'type' => 'Internal-Audit', 'prefix' => 'IA'],
                                            ['class' => \App\Models\Capa::class, 'type' => 'Capa', 'prefix' => 'CAPA'],
                                            ['class' => \App\Models\RiskManagement::class, 'type' => 'risk-assesment', 'prefix' => 'RA'],
                                            ['class' => \App\Models\ManagementReview::class, 'type' => 'Management-Review', 'prefix' => 'MR'],
                                            ['class' => \App\Models\LabIncident::class, 'type' => 'Lab-Incident', 'prefix' => 'LI'],
                                            ['class' => \App\Models\Auditee::class, 'type' => 'External-Audit', 'prefix' => 'EA'],
                                            ['class' => \App\Models\AuditProgram::class, 'type' => 'Audit-Program', 'prefix' => 'AuditProgram'],
                                            ['class' => \App\Models\RootCauseAnalysis::class, 'type' => 'Root-Cause-Analysis', 'prefix' => 'RCA'],
                                            ['class' => \App\Models\Observation::class, 'type' => 'Observation', 'prefix' => 'OBS'],
                                            ['class' => \App\Models\OOS::class, 'type' => 'OOS/OOT', 'prefix' => 'OOS'],
                                            ['class' => \App\Models\MarketComplaint::class, 'type' => 'Market Complaint', 'prefix' => 'MC'],
                                            ['class' => \App\Models\Ootc::class, 'type' => 'OOT', 'prefix' => 'OOT'],
                                            ['class' => \App\Models\errata::class, 'type' => 'ERRATA', 'prefix' => 'ERRATA'],
                                            ['class' => \App\Models\OOS_micro::class, 'type' => 'OOS Microbiology', 'prefix' => 'OOSMicro'],
                                            ['class' => \App\Models\Deviation::class, 'type' => 'Deviation', 'prefix' => 'DEV'],
                                            ['class' => \App\Models\OutOfCalibration::class, 'type' => 'Out Of Calibration', 'prefix' => 'OOC'],
                                            ['class' => \App\Models\Incident::class, 'type' => 'Incident', 'prefix' => 'INC'],
                                            ['class' => \App\Models\Resampling::class, 'type' => 'Resampling', 'prefix' => 'Resampling'],
                                            ['class' => \App\Models\ChangeProposalJust::class, 'type' => 'Change Proposal And Justification', 'prefix' => 'CPJ'],
                                            ['class' => \App\Models\FailureInvestigation::class, 'type' => 'Failure Investigation', 'prefix' => 'FI'],
                                            ['class' => \App\Models\NonConformance::class, 'type' => 'Non Conformance', 'prefix' => 'NC'],
                                        ];

                                        if (request()->has('ajax_load')) {
                                            $limit = 10000; // optimized: initial ajax load limit

                                            $allRawData = [];
                                            $allDivisions = \Illuminate\Support\Facades\Cache::remember('qms_dashboard_divisions', 3600, function () {
                                                return DB::table('q_m_s_divisions')->pluck('name', 'id')->toArray();
                                            });

                                            foreach ($modelsConfig as $cfg) {
                                                $records = $cfg['class']::orderByDesc('id')->limit($limit)->get();
                                                foreach ($records as $rec) {
                                                    $divId = $rec->division_id ?? ($rec->division_code ?? ($rec->site_location_code ?? null));
                                                    $divName = $allDivisions[$divId] ?? 'Plant';
                                                    $year = $rec->created_at ? date('Y', strtotime($rec->created_at)) : date('Y');
                                                    $recordNoStr = str_pad($rec->record ?? ($rec->record_number ?? 0), 4, '0', STR_PAD_LEFT);
                                                    
                                                    $finalPrefix = $cfg['prefix'];
                                                    if ($cfg['type'] == 'OOS/OOT') {
                                                        $finalPrefix = $rec->Form_type ?? 'OOS';
                                                    }
                                                    
                                                    $recordNumber = $divName . '/' . $finalPrefix . '/' . $year . '/' . $recordNoStr;

                                                    $allRawData[] = (object)[
                                                        'id' => $rec->id,
                                                        'parent_id' => $rec->parent_id ?? ($rec->parent_record ?? null),
                                                        'parent_type' => $rec->parent_type ?? null,
                                                        'record' => $rec->record ?? ($rec->record_number ?? null),
                                                        'type' => $cfg['type'],
                                                        'division_id' => $divId,
                                                        'short_description' => $rec->short_description ?? ($rec->short_desc ?? ($rec->description_gi ?? ($rec->description_ooc ?? ($rec->cpdescription ?? '-')))),
                                                        'initiator_id' => $rec->initiator_id ?? ($rec->initiator ?? null),
                                                        'initiated_through' => $rec->initiated_through ?? ($rec->initiated_through_gi ?? ($rec->initiated_by ?? '-')),
                                                        'intiation_date' => $rec->intiation_date ?? null,
                                                        'stage' => $rec->status ?? null,
                                                        'date_open' => $rec->created_at ? ($rec->created_at instanceof \Carbon\Carbon ? $rec->created_at->toDateTimeString() : \Carbon\Carbon::parse($rec->created_at)->toDateTimeString()) : \Carbon\Carbon::now()->toDateTimeString(),
                                                        'date_close' => $rec->updated_at ? ($rec->updated_at instanceof \Carbon\Carbon ? $rec->updated_at->toDateTimeString() : \Carbon\Carbon::parse($rec->updated_at)->toDateTimeString()) : null,
                                                        'due_date' => $rec->due_date ?? ($rec->due_date_gi ?? null),
                                                        'dashboard_unique_id' => $rec->dashboard_unique_id ?? null,
                                                        'record_number' => $recordNumber,
                                                    ];
                                                }
                                            }

                                            $sortedData = collect($allRawData)->sortByDesc('date_open')->values()->toArray();
                                            $tablesData = $sortedData;
                                            $total_count = count($sortedData);
                                        } else {
                                            $datag = isset($datag) ? $datag : collect([]);
                                            $table = json_encode($datag);
                                            $tables = json_decode($table);
                                            if (is_array($tables)) {
                                                $tables = (object)['data' => $tables];
                                            }
                                            if (!isset($tables->data)) {
                                                $tables = (object)['data' => []];
                                            }
                                            $tablesData = is_array($tables->data) ? $tables->data : (is_object($tables->data) ? (array)$tables->data : []);
                                            $total_count = count($tablesData);
                                        }

                                        /*
                                        |--------------------------------------------------------------------------
                                        | Store dashboard unique ID in the respective process table
                                        |--------------------------------------------------------------------------
                                        | This keeps the new optimized dashboard behaviour same as the old Blade.
                                        | Example: Change Control table ID 96 can store dashboard_unique_id 175,
                                        | so its child record displays Parent ID 0175.
                                        */
                                        $dashboardTableMap = [
                                            'Change-Control' => 'c_c_s',
                                            'Internal-Audit' => 'internal_audits',
                                            'Market Complaint' => 'marketcompalints',
                                            'Risk-Assesment' => 'risk_management',
                                            'risk-assesment' => 'risk_management',
                                            'Lab-Incident' => 'lab_incidents',
                                            'Incident' => 'incidents',
                                            'Change Proposal And Justification' => 'change_proposal_justs',
                                            'Out Of Calibration' => 'out_of_calibrations',
                                            'External-Audit' => 'auditees',
                                            'Audit-Program' => 'audit_programs',
                                            'Observation' => 'observations',
                                            'Action-Item' => 'action_items',
                                            'Extension' => 'extension_news',
                                            'Effectiveness-Check' => 'effectiveness_checks',
                                            'Capa' => 'capas',
                                            'CAPA' => 'capas',
                                            'OOS/OOT' => 'o_o_s',
                                            'OOT' => 'ootcs',
                                            'ERRATA' => 'errata',
                                            'Management-Review' => 'management_reviews',
                                            'Deviation' => 'deviations',
                                            'Failure Investigation' => 'failure_investigations',
                                            'Root-Cause-Analysis' => 'root_cause_analyses',
                                            'Resampling' => 'resamplings',
                                            'Non Conformance' => 'non_conformances',
                                            'OOS Microbiology' => 'oos_micros',
                                        ];

                                        $sortedDashboardData = collect($tablesData)
                                            ->sortByDesc('date_open')
                                            ->values();

                                        $total_count = $sortedDashboardData->count();

                                        foreach ($sortedDashboardData as $dashboardIndex => $dashboardRecord) {
                                            $dashboardUniqueId = $total_count - $dashboardIndex;
                                            $dashboardTable = $dashboardTableMap[$dashboardRecord->type] ?? null;

                                            if (
                                                $dashboardTable &&
                                                \Illuminate\Support\Facades\Schema::hasTable($dashboardTable) &&
                                                \Illuminate\Support\Facades\Schema::hasColumn($dashboardTable, 'dashboard_unique_id')
                                            ) {
                                                DB::table($dashboardTable)
                                                    ->where('id', $dashboardRecord->id)
                                                    ->where(function ($query) use ($dashboardUniqueId) {
                                                        $query->whereNull('dashboard_unique_id')
                                                            ->orWhere('dashboard_unique_id', '!=', $dashboardUniqueId);
                                                    })
                                                    ->update([
                                                        'dashboard_unique_id' => $dashboardUniqueId,
                                                    ]);
                                            }

                                            // Keep the same value available in the current request as well.
                                            $dashboardRecord->dashboard_unique_id = $dashboardUniqueId;
                                        }

                                        $tablesData = $sortedDashboardData->all();

                                        $allUserRoles = DB::table('user_roles')
                                            ->where('user_id', Auth::user()->id)
                                            ->get(['q_m_s_divisions_id', 'q_m_s_roles_id'])
                                            ->groupBy('q_m_s_divisions_id')
                                            ->map(function($items) {
                                                return $items->pluck('q_m_s_roles_id')->toArray();
                                            })
                                            ->toArray();

                                        $allUserNames = \Illuminate\Support\Facades\Cache::remember('qms_dashboard_user_names', 3600, function () {
                                            return DB::table('users')->pluck('name', 'id')->toArray();
                                        });

                                        $parentTableMap = [
                                            // Change Control
                                            'Change Control'      => 'c_c_s',
                                            'Change-Control'      => 'c_c_s',
                                            'Change_control'      => 'c_c_s',
                                            'CC'                  => 'c_c_s',

                                            // CAPA
                                            'CAPA'                => 'capas',
                                            'Capa'                => 'capas',
                                            'capa'                => 'capas',

                                            // Deviation
                                            'Deviation'           => 'deviations',
                                            'deviation'           => 'deviations',

                                            // Root Cause Analysis
                                            'RCA'                 => 'root_cause_analyses',
                                            'Root Cause Analysis' => 'root_cause_analyses',
                                            'Root-Cause-Analysis' => 'root_cause_analyses',

                                            // Lab Incident
                                            'Lab Incident'        => 'lab_incidents',
                                            'Lab-Incident'        => 'lab_incidents',

                                            // OOS / OOT
                                            'OOS Chemical'        => 'o_o_s',
                                            'OOS Micro'           => 'o_o_s',
                                            'OOT'                 => 'o_o_s',
                                            'OOS/OOT'             => 'o_o_s',

                                            // Effectiveness Check
                                            'EffectivenessCheck'  => 'effectiveness_checks',
                                            'Effectiveness Check' => 'effectiveness_checks',
                                            'Effectiveness-Check' => 'effectiveness_checks',

                                            // Observation
                                            'Observation'         => 'observations',

                                            // Audit Program
                                            'Audit_Program'       => 'audit_programs',
                                            'Audit Program'       => 'audit_programs',
                                            'Audit-Program'       => 'audit_programs',

                                            // Market Complaint
                                            'Market Complaint'    => 'marketcompalints',

                                            // Risk Assessment
                                            'Risk Assessment'     => 'risk_management',
                                            'Risk-Assesment'      => 'risk_management',
                                            'risk-assesment'      => 'risk_management',

                                            // Incident
                                            'Incident'            => 'incidents',

                                            // Internal Audit
                                            'Internal Audit'      => 'internal_audits',
                                            'Internal-Audit'      => 'internal_audits',
                                            'Internal_audit'      => 'internal_audits',

                                            // External Audit
                                            'External Audit'      => 'auditees',
                                            'External-Audit'      => 'auditees',
                                            'External_audit'      => 'auditees',

                                            // Management Review
                                            'Management Review'   => 'management_reviews',
                                            'Management-Review'   => 'management_reviews',

                                            // Out Of Calibration
                                            'OOC'                 => 'out_of_calibrations',
                                            'Out Of Calibration'  => 'out_of_calibrations',

                                            // Action Item
                                            'Action Item'         => 'action_items',
                                            'Action_item'         => 'action_items',
                                            'Action-Item'         => 'action_items',

                                            // Extension
                                            'Extension'           => 'extension_news',
                                            'extension'           => 'extension_news',

                                            // Errata
                                            'ERRATA'              => 'errata',

                                            // Resampling
                                            'Resampling'          => 'resamplings',

                                            // Non Conformance
                                            'Non Conformance'     => 'non_conformances',

                                            // Failure Investigation
                                            'Failure Investigation' => 'failure_investigations',

                                            // Change Proposal And Justification
                                            'Change Proposal And Justification' => 'change_proposal_justs',
                                            'Change Proposal & Justification'   => 'change_proposal_justs',
                                            'CPJ'                               => 'change_proposal_justs',
                                        ];

                                        /*
                                        |--------------------------------------------------------------------------
                                        | Collect parent IDs table-wise
                                        |--------------------------------------------------------------------------
                                        | Same result as old Blade, but without one query per dashboard row.
                                        */
                                        $parentIdsByTable = [];

                                        foreach ($tablesData as $dashboardRecord) {
                                            $parentId = $dashboardRecord->parent_id ?? null;
                                            $parentType = trim((string) ($dashboardRecord->parent_type ?? ''));

                                            if (empty($parentId) || empty($parentType)) {
                                                continue;
                                            }

                                            $parentTable = $parentTableMap[$parentType] ?? null;

                                            if (!$parentTable) {
                                                continue;
                                            }

                                            $parentIdsByTable[$parentTable][] = $parentId;
                                        }

                                        /*
                                        |--------------------------------------------------------------------------
                                        | Fetch dashboard unique IDs in batches
                                        |--------------------------------------------------------------------------
                                        */
                                       $parentUniqueIdsByTable = [];

foreach ($parentIdsByTable as $parentTable => $parentIds) {

    $parentIds = array_values(
        array_unique(
            array_filter($parentIds, function ($value) {
                return $value !== null && $value !== '';
            })
        )
    );

    if (
        empty($parentIds) ||
        !\Illuminate\Support\Facades\Schema::hasTable($parentTable) ||
        !\Illuminate\Support\Facades\Schema::hasColumn($parentTable, 'dashboard_unique_id')
    ) {
        continue;
    }

    $query = DB::table($parentTable)
        ->select('id', 'dashboard_unique_id');

    /*
    |--------------------------------------------------------------------------
    | parent_id may contain actual table ID or process record number
    |--------------------------------------------------------------------------
    */
    if (\Illuminate\Support\Facades\Schema::hasColumn($parentTable, 'record')) {

        $query->addSelect('record');

        $query->where(function ($q) use ($parentIds) {
            $q->whereIn('id', $parentIds)
              ->orWhereIn('record', $parentIds);
        });

    } elseif (\Illuminate\Support\Facades\Schema::hasColumn($parentTable, 'record_number')) {

        $query->addSelect('record_number');

        $query->where(function ($q) use ($parentIds) {
            $q->whereIn('id', $parentIds)
              ->orWhereIn('record_number', $parentIds);
        });

    } else {

        $query->whereIn('id', $parentIds);
    }

    $parentRecords = $query->get();

    $parentUniqueIdsByTable[$parentTable] = [];

    foreach ($parentRecords as $parentRecord) {

        if (empty($parentRecord->dashboard_unique_id)) {
            continue;
        }

        // Mapping when parent_id stores database ID.
        $parentUniqueIdsByTable[$parentTable][(string) $parentRecord->id]
            = $parentRecord->dashboard_unique_id;

        // Mapping when parent_id stores record number.
        if (
            isset($parentRecord->record) &&
            $parentRecord->record !== null &&
            $parentRecord->record !== ''
        ) {
            $parentUniqueIdsByTable[$parentTable][(string) $parentRecord->record]
                = $parentRecord->dashboard_unique_id;
        }

        // Some tables use record_number instead of record.
        if (
            isset($parentRecord->record_number) &&
            $parentRecord->record_number !== null &&
            $parentRecord->record_number !== ''
        ) {
            $parentUniqueIdsByTable[$parentTable][(string) $parentRecord->record_number]
                = $parentRecord->dashboard_unique_id;
        }
    }
}
                                        $allDivisions = \Illuminate\Support\Facades\Cache::remember('qms_dashboard_divisions', 3600, function () {
                                            return DB::table('q_m_s_divisions')->pluck('name', 'id')->toArray();
                                        });
                                    @endphp

                                    @if (request()->has('ajax_load'))
                                        @php
                                            if (ob_get_length()) ob_clean();
                                        @endphp
                                    @endif

                                    @foreach (collect($tablesData)->sortByDesc('date_open') as $datas)
                                        @php
                                            $userRoles = $allUserRoles[$datas->division_id] ?? [];

                                            $stagesToHide = [
                                                'Closed-Cancelled',
                                                'Closed - Cancelled',
                                                'Closed - Done',
                                                'Closed Done',
                                                'Closed-Reject',
                                                'Closed - Rejected',
                                                'Closed – Effective',
                                                'Closed – Not Effective',
                                            ];

                                            $hideRecord = in_array($datas->stage, $stagesToHide);
                                            $userHasAllowedRole = in_array(1, $userRoles);
                                        @endphp

                                        <tr>
                                                    <td>
                                                        @if ($datas->type == 'Change-Control')
                                                            <a href="{{ route('CC.show', $datas->id) }}"
                                                              style="display: inline-block; 
                                                        padding: 6px 12px; 
                                                        background-color: #0f43cf; 
                                                        color: white; 
                                                        text-decoration: none; 
                                                        border-radius: 4px; 
                                                        border: 1px solid #0f43cf; 
                                                        font-weight: bold; 
                                                        text-align: center;">
                                                                {{ str_pad($total_count - $loop->index, 4, '0', STR_PAD_LEFT) }}
                                                            </a>
                                                            <a href="{{ url('rcms/qms-dashboard', $datas->id) }}/CC">
                                                                <div class="icon" onclick="showChild()"
                                                                    data-bs-toggle="tooltip" title="Related Records">
                                                                    {{-- <img src="{{ asset('user/images/single.png') }}" alt="..."
                                                                class="w-100 h-100"> --}}
                                                                </div>
                                                            </a>
                                                            {{-- -----------------------by pankaj-------------------- --}}
                                                        @elseif ($datas->type == 'Internal-Audit')
                                                            <a href="{{ route('showInternalAudit', $datas->id) }}"
                                                              style="display: inline-block; 
                                                        padding: 6px 12px; 
                                                        background-color: #0f43cf; 
                                                        color: white; 
                                                        text-decoration: none; 
                                                        border-radius: 4px; 
                                                        border: 1px solid #0f43cf; 
                                                        font-weight: bold; 
                                                        text-align: center;">
                                                                {{ str_pad($total_count - $loop->index, 4, '0', STR_PAD_LEFT) }}
                                                            </a>
                                                            @if (!empty($datas->parent_id))
                                                                <a
                                                                    href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/internal_audit">
                                                                    <div class="icon" onclick="showChild()"
                                                                        data-bs-toggle="tooltip" title="Related Records">
                                                                        {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                                    alt="..." class="w-100 h-100"> --}}
                                                                    </div>
                                                                </a>
                                                            @endif
                                                            {{-- market complaint --}}
                                                        @elseif ($datas->type == 'Market Complaint')
                                                            <a href="{{ route('marketcomplaint.marketcomplaint_view', $datas->id) }}"
                                                              style="display: inline-block; 
                                                        padding: 6px 12px; 
                                                        background-color: #0f43cf; 
                                                        color: white; 
                                                        text-decoration: none; 
                                                        border-radius: 4px; 
                                                        border: 1px solid #0f43cf; 
                                                        font-weight: bold; 
                                                        text-align: center;">
                                                                {{ str_pad($total_count - $loop->index, 4, '0', STR_PAD_LEFT) }}
                                                            </a>
                                                            @if (!empty($datas->parent_id))
                                                                <a
                                                                    href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/internal_audit">
                                                                    <div class="icon" onclick="showChild()"
                                                                        data-bs-toggle="tooltip" title="Related Records">
                                                                        {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                                    alt="..." class="w-100 h-100"> --}}
                                                                    </div>
                                                                </a>
                                                            @endif
                                                        @elseif ($datas->type == 'Risk-Assesment')
                                                            <a href="{{ route('showRiskManagement', $datas->id) }}"
                                                              style="display: inline-block; 
                                                        padding: 6px 12px; 
                                                        background-color: #0f43cf; 
                                                        color: white; 
                                                        text-decoration: none; 
                                                        border-radius: 4px; 
                                                        border: 1px solid #0f43cf; 
                                                        font-weight: bold; 
                                                        text-align: center;">
                                                                {{ str_pad($total_count - $loop->index, 4, '0', STR_PAD_LEFT) }}
                                                            </a>
                                                            @if (!empty($datas->parent_id))
                                                                <a
                                                                    href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/risk_assesment">
                                                                    <div class="icon" onclick="showChild()"
                                                                        data-bs-toggle="tooltip" title="Related Records">
                                                                        {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                                    alt="..." class="w-100 h-100"> --}}
                                                                    </div>
                                                                </a>
                                                            @endif
                                                    @elseif ($datas->type == 'risk-assesment')
                                                            <a href="{{ route('showRiskManagement', $datas->id) }}"
                                                              style="display: inline-block; 
                                                        padding: 6px 12px; 
                                                        background-color: #0f43cf; 
                                                        color: white; 
                                                        text-decoration: none; 
                                                        border-radius: 4px; 
                                                        border: 1px solid #0f43cf; 
                                                        font-weight: bold; 
                                                        text-align: center;">
                                                                {{ str_pad($total_count - $loop->index, 4, '0', STR_PAD_LEFT) }}
                                                            </a>
                                                            @if (!empty($datas->parent_id))
                                                                <a
                                                                    href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/risk_assesment">
                                                                    <div class="icon" onclick="showChild()"
                                                                        data-bs-toggle="tooltip" title="Related Records">
                                                                        {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                                    alt="..." class="w-100 h-100"> --}}
                                                                    </div>
                                                                </a>
                                                            @endif
                                                        @elseif ($datas->type == 'Lab-Incident')
                                                            <a href="{{ route('ShowLabIncident', $datas->id) }}"
                                                              style="display: inline-block; 
                                                        padding: 6px 12px; 
                                                        background-color: #0f43cf; 
                                                        color: white; 
                                                        text-decoration: none; 
                                                        border-radius: 4px; 
                                                        border: 1px solid #0f43cf; 
                                                        font-weight: bold; 
                                                        text-align: center;">
                                                                {{ str_pad($total_count - $loop->index, 4, '0', STR_PAD_LEFT) }}
                                                            </a>
                                                            @if (!empty($datas->parent_id))
                                                                <a
                                                                    href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/lab_incident">
                                                                    <div class="icon" onclick="showChild()"
                                                                        data-bs-toggle="tooltip" title="Related Records">
                                                                        {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                                    alt="..." class="w-100 h-100"> --}}
                                                                    </div>
                                                                </a>
                                                            @endif
                                                        @elseif ($datas->type == 'Incident')

                                                            <a href="{{ route('incident-show', $datas->id) }}"
                                                              style="display: inline-block; 
                                                        padding: 6px 12px; 
                                                        background-color: #0f43cf; 
                                                        color: white; 
                                                        text-decoration: none; 
                                                        border-radius: 4px; 
                                                        border: 1px solid #0f43cf; 
                                                        font-weight: bold; 
                                                        text-align: center;">
                                                                {{ str_pad($total_count - $loop->index, 4, '0', STR_PAD_LEFT) }}
                                                            </a>
                                                            @if (!empty($datas->parent_id))
                                                                <a
                                                                    href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/lab_incident">
                                                                    <div class="icon" onclick="showChild()"
                                                                        data-bs-toggle="tooltip" title="Related Records">
                                                                        {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                                    alt="..." class="w-100 h-100"> --}}
                                                                    </div>
                                                                </a>
                                                            @endif

                                                            {{-- Change proposal just --}}
                                                        @elseif ($datas->type == 'Change Proposal And Justification')

                                                            <a href="{{ route('cpshow', $datas->id) }}"
                                                              style="display: inline-block; 
                                                        padding: 6px 12px; 
                                                        background-color: #0f43cf; 
                                                        color: white; 
                                                        text-decoration: none; 
                                                        border-radius: 4px; 
                                                        border: 1px solid #0f43cf; 
                                                        font-weight: bold; 
                                                        text-align: center;">
                                                                {{ str_pad($total_count - $loop->index, 4, '0', STR_PAD_LEFT) }}
                                                            </a>
                                                            @if (!empty($datas->parent_id))
                                                                <a
                                                                    href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/lab_incident">
                                                                    <div class="icon" onclick="showChild()"
                                                                        data-bs-toggle="tooltip" title="Related Records">
                                                                        {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                                    alt="..." class="w-100 h-100"> --}}
                                                                    </div>
                                                                </a>
                                                            @endif
                                                        @elseif ($datas->type == 'Out Of Calibration')
                                                            <a href="{{ route('ShowOutofCalibration', $datas->id) }}"
                                                              style="display: inline-block; 
                                                        padding: 6px 12px; 
                                                        background-color: #0f43cf; 
                                                        color: white; 
                                                        text-decoration: none; 
                                                        border-radius: 4px; 
                                                        border: 1px solid #0f43cf; 
                                                        font-weight: bold; 
                                                        text-align: center;">
                                                                {{ str_pad($total_count - $loop->index, 4, '0', STR_PAD_LEFT) }}
                                                            </a>
                                                            @if (!empty($datas->parent_id))
                                                                <a
                                                                    href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/Out_Of_Calibration">
                                                                    <div class="icon" onclick="showChild()"
                                                                        data-bs-toggle="tooltip" title="Related Records">
                                                                        {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                                    alt="..." class="w-100 h-100"> --}}
                                                                    </div>
                                                                </a>
                                                            @endif
                                                        @elseif ($datas->type == 'External-Audit')
                                                            <a href="{{ route('showExternalAudit', $datas->id) }}"
                                                              style="display: inline-block; 
                                                        padding: 6px 12px; 
                                                        background-color: #0f43cf; 
                                                        color: white; 
                                                        text-decoration: none; 
                                                        border-radius: 4px; 
                                                        border: 1px solid #0f43cf; 
                                                        font-weight: bold; 
                                                        text-align: center;">
                                                                {{ str_pad($total_count - $loop->index, 4, '0', STR_PAD_LEFT) }}
                                                            </a>
                                                            @if (!empty($datas->parent_id))
                                                                <a
                                                                    href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/external_audit">
                                                                    <div class="icon" onclick="showChild()"
                                                                        data-bs-toggle="tooltip" title="Related Records">
                                                                        {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                                    alt="..." class="w-100 h-100"> --}}
                                                                    </div>
                                                                </a>
                                                            @endif
                                                        @elseif ($datas->type == 'Audit-Program') 
                                                            <a href="{{ route('ShowAuditProgram', $datas->id) }}"
                                                              style="display: inline-block; 
                                                        padding: 6px 12px; 
                                                        background-color: #0f43cf; 
                                                        color: white; 
                                                        text-decoration: none; 
                                                        border-radius: 4px; 
                                                        border: 1px solid #0f43cf; 
                                                        font-weight: bold; 
                                                        text-align: center;">
                                                                {{ str_pad($total_count - $loop->index, 4, '0', STR_PAD_LEFT) }}
                                                            </a>
                                                            @if (!empty($datas->parent_id))
                                                                <a
                                                                    href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/audit_program">
                                                                    <div class="icon" onclick="showChild()"
                                                                        data-bs-toggle="tooltip" title="Related Records">
                                                                        {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                                    alt="..." class="w-100 h-100"> --}}
                                                                    </div>
                                                                </a>
                                                            @endif
                                                        @elseif ($datas->type == 'Observation') 
                                                            <a href="{{ route('showobservation', $datas->id) }}"
                                                              style="display: inline-block; 
                                                        padding: 6px 12px; 
                                                        background-color: #0f43cf; 
                                                        color: white; 
                                                        text-decoration: none; 
                                                        border-radius: 4px; 
                                                        border: 1px solid #0f43cf; 
                                                        font-weight: bold; 
                                                        text-align: center;">
                                                                {{ str_pad($total_count - $loop->index, 4, '0', STR_PAD_LEFT) }}
                                                            </a>
                                                            @if (!empty($datas->parent_id))
                                                                <a
                                                                    href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/observation">
                                                                    <div class="icon" onclick="showChild()"
                                                                        data-bs-toggle="tooltip" title="Related Records">
                                                                        {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                                    alt="..." class="w-100 h-100"> --}}
                                                                    </div>
                                                                </a>
                                                            @endif
                                                        @elseif($datas->type == 'Action-Item')
                                                            <a href="{{ route('actionItem.show', $datas->id) }}"
                                                              style="display: inline-block; 
                                                        padding: 6px 12px; 
                                                        background-color: #0f43cf; 
                                                        color: white; 
                                                        text-decoration: none; 
                                                        border-radius: 4px; 
                                                        border: 1px solid #0f43cf; 
                                                        font-weight: bold; 
                                                        text-align: center;">
                                                                {{ str_pad($total_count - $loop->index, 4, '0', STR_PAD_LEFT) }}
                                                            </a>
                                                            @if (!empty($datas->parent_id))
                                                                <a
                                                                    href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/action_item">
                                                                    <div class="icon" onclick="showChild()"
                                                                        data-bs-toggle="tooltip" title="Related Records">
                                                                        {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                                    alt="..." class="w-100 h-100"> --}}
                                                                    </div>
                                                                </a>
                                                            @endif
                                                        @elseif($datas->type == 'Extension')
                                                            <a href="{{ url('extension_newshow', $datas->id) }}"
                                                              style="display: inline-block; 
                                                        padding: 6px 12px; 
                                                        background-color: #0f43cf; 
                                                        color: white; 
                                                        text-decoration: none; 
                                                        border-radius: 4px; 
                                                        border: 1px solid #0f43cf; 
                                                        font-weight: bold; 
                                                        text-align: center;">
                                                                {{ str_pad($total_count - $loop->index, 4, '0', STR_PAD_LEFT) }}
                                                            </a>
                                                            @if (!empty($datas->parent_id))
                                                                <a
                                                                    href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/extension">
                                                                    <div class="icon" onclick="showChild()"
                                                                        data-bs-toggle="tooltip" title="Related Records">
                                                                    </div>
                                                                </a>
                                                            @endif
                                                        @elseif($datas->type == 'Effectiveness-Check')
                                                            <a href="{{ route('effectiveness.show', $datas->id) }}"
                                                              style="display: inline-block; 
                                                        padding: 6px 12px; 
                                                        background-color: #0f43cf; 
                                                        color: white; 
                                                        text-decoration: none; 
                                                        border-radius: 4px; 
                                                        border: 1px solid #0f43cf; 
                                                        font-weight: bold; 
                                                        text-align: center;">
                                                                {{ str_pad($total_count - $loop->index, 4, '0', STR_PAD_LEFT) }}
                                                            </a>
                                                            @if (!empty($datas->parent_id))
                                                                <a
                                                                    href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/effectiveness_check">
                                                                    <div class="icon" onclick="showChild()"
                                                                        data-bs-toggle="tooltip" title="Related Records">
                                                                        {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                                    alt="..." class="w-100 h-100"> --}}
                                                                    </div>
                                                                </a>
                                                            @endif
                                                        @elseif($datas->type == 'Capa')
                                                            <a href="{{ route('capashow', $datas->id) }}"
                                                              style="display: inline-block; 
                                                        padding: 6px 12px; 
                                                        background-color: #0f43cf; 
                                                        color: white; 
                                                        text-decoration: none; 
                                                        border-radius: 4px; 
                                                        border: 1px solid #0f43cf; 
                                                        font-weight: bold; 
                                                        text-align: center;">
                                                                {{ str_pad($total_count - $loop->index, 4, '0', STR_PAD_LEFT) }}
                                                            </a>
                                                            @if (!empty($datas->parent_id))
                                                                <a
                                                                    href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/capa">
                                                                    <div class="icon" onclick="showChild()"
                                                                        data-bs-toggle="tooltip" title="Related Records">
                                                                        {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                                    alt="..." class="w-100 h-100"> --}}
                                                                    </div>
                                                                </a>
                                                            @endif
                                                         @elseif($datas->type == 'CAPA')
                                                            <a href="{{ route('capashow', $datas->id) }}"
                                                              style="display: inline-block; 
                                                        padding: 6px 12px; 
                                                        background-color: #0f43cf; 
                                                        color: white; 
                                                        text-decoration: none; 
                                                        border-radius: 4px; 
                                                        border: 1px solid #0f43cf; 
                                                        font-weight: bold; 
                                                        text-align: center;">
                                                                {{ str_pad($total_count - $loop->index, 4, '0', STR_PAD_LEFT) }}
                                                            </a>
                                                            @if (!empty($datas->parent_id))
                                                                <a
                                                                    href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/capa">
                                                                    <div class="icon" onclick="showChild()"
                                                                        data-bs-toggle="tooltip" title="Related Records">
                                                                        {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                                    alt="..." class="w-100 h-100"> --}}
                                                                    </div>
                                                                </a>
                                                            @endif
                                                        @elseif($datas->type == 'OOS/OOT')
                                                            <a href="{{ route('oos.oos_view', $datas->id) }}"
                                                              style="display: inline-block; 
                                                        padding: 6px 12px; 
                                                        background-color: #0f43cf; 
                                                        color: white; 
                                                        text-decoration: none; 
                                                        border-radius: 4px; 
                                                        border: 1px solid #0f43cf; 
                                                        font-weight: bold; 
                                                        text-align: center;">
                                                                {{ str_pad($total_count - $loop->index, 4, '0', STR_PAD_LEFT) }}
                                                            </a>
                                                            @if (!empty($datas->parent_id))
                                                                <a
                                                                    href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/errata">
                                                                    <div class="icon" onclick="showChild()"
                                                                        data-bs-toggle="tooltip" title="Related Records">
                                                                    </div>
                                                                </a>
                                                            @endif
                                                            {{-- @elseif($datas->type == 'OOS Chemical')
                                                    <a href="{{ route('oos.oos_view', $datas->id) }}" style="color: blue">
                                                        {{ str_pad(($total_count - $loop->index), 4, '0', STR_PAD_LEFT) }}
                                                    </a>
                                                    @if (!empty($datas->parent_id))
                                                        <a
                                                            href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/errata">
                                                            <div class="icon" onclick="showChild()"
                                                                data-bs-toggle="tooltip" title="Related Records">
                                                            </div>
                                                        </a>
                                                    @endif --}}
                                                        @elseif($datas->type == 'ERRATA')
                                                            <a href="{{ route('errata.show', $datas->id) }}"
                                                              style="display: inline-block; 
                                                        padding: 6px 12px; 
                                                        background-color: #0f43cf; 
                                                        color: white; 
                                                        text-decoration: none; 
                                                        border-radius: 4px; 
                                                        border: 1px solid #0f43cf; 
                                                        font-weight: bold; 
                                                        text-align: center;">
                                                                {{ str_pad($total_count - $loop->index, 4, '0', STR_PAD_LEFT) }}
                                                            </a>
                                                            @if (!empty($datas->parent_id))
                                                                <a
                                                                    href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/errata">
                                                                    <div class="icon" onclick="showChild()"
                                                                        data-bs-toggle="tooltip" title="Related Records">
                                                                        {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                                    alt="..." class="w-100 h-100"> --}}
                                                                    </div>
                                                                </a>
                                                            @endif
                                                            {{-- @elseif($datas->type == 'OOS Microbiology')
                                                    <a href="{{ route('oos_micro.edit', $datas->id) }}" style="color: blue">
                                                        {{ str_pad(($total_count - $loop->index), 4, '0', STR_PAD_LEFT) }}
                                                    </a>
                                                    @if (!empty($datas->parent_id))
                                                        <a href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/capa">
                                                            <div class="icon" onclick="showChild()"
                                                                data-bs-toggle="tooltip" title="Related Records">
                                                            </div>
                                                        </a>
                                                    @endif --}}
                                                        @elseif($datas->type == 'ERRATA')
                                                            <a href="{{ route('errata.show', $datas->id) }}">
                                                                {{ str_pad($total_count - $loop->index, 4, '0', STR_PAD_LEFT) }}{{ $datas->id }}
                                                            </a>
                                                            @if (!empty($datas->parent_id))
                                                                <a
                                                                    href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/management_review">
                                                                    <div class="icon" onclick="showChild()"
                                                                        data-bs-toggle="tooltip" title="Related Records">
                                                                        {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                                    alt="..." class="w-100 h-100"> --}}
                                                                    </div>
                                                                </a>
                                                            @endif
                                                        @elseif($datas->type == 'Management-Review')
                                                            <a href="{{ route('manageshow', $datas->id) }}"
                                                              style="display: inline-block; 
                                                        padding: 6px 12px; 
                                                        background-color: #0f43cf; 
                                                        color: white; 
                                                        text-decoration: none; 
                                                        border-radius: 4px; 
                                                        border: 1px solid #0f43cf; 
                                                        font-weight: bold; 
                                                        text-align: center;">
                                                                {{ str_pad($total_count - $loop->index, 4, '0', STR_PAD_LEFT) }}
                                                            </a>
                                                            @if (!empty($datas->parent_id))
                                                                <a
                                                                    href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/management_review">
                                                                    <div class="icon" onclick="showChild()"
                                                                        data-bs-toggle="tooltip" title="Related Records">
                                                                        {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                                    alt="..." class="w-100 h-100"> --}}
                                                                    </div>
                                                                </a>
                                                            @endif
                                                        @elseif($datas->type == 'Deviation')
                                                            <a href="{{ route('devshow', $datas->id) }}"
                                                              style="display: inline-block; 
                                                        padding: 6px 12px; 
                                                        background-color: #0f43cf; 
                                                        color: white; 
                                                        text-decoration: none; 
                                                        border-radius: 4px; 
                                                        border: 1px solid #0f43cf; 
                                                        font-weight: bold; 
                                                        text-align: center;">
                                                                {{ str_pad($total_count - $loop->index, 4, '0', STR_PAD_LEFT) }}
                                                            </a>
                                                            @if (!empty($datas->parent_id))
                                                                <a
                                                                    href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/deviation">
                                                                    <div class="icon" onclick="showChild()"
                                                                        data-bs-toggle="tooltip" title="Related Records">
                                                                        {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                                    alt="..." class="w-100 h-100"> --}}
                                                                    </div>
                                                                </a>
                                                            @endif
                                                        @elseif($datas->type == 'Deviation')
                                                            <a href="{{ route('devshow', $datas->id) }}"
                                                              style="display: inline-block; 
                                                        padding: 6px 12px; 
                                                        background-color: #0f43cf; 
                                                        color: white; 
                                                        text-decoration: none; 
                                                        border-radius: 4px; 
                                                        border: 1px solid #0f43cf; 
                                                        font-weight: bold; 
                                                        text-align: center;">
                                                                {{ str_pad($total_count - $loop->index, 4, '0', STR_PAD_LEFT) }}
                                                            </a>
                                                            @if (!empty($datas->parent_id))
                                                                <a
                                                                    href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/deviation">
                                                                    <div class="icon" onclick="showChild()"
                                                                        data-bs-toggle="tooltip" title="Related Records">
                                                                        {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                                    alt="..." class="w-100 h-100"> --}}
                                                                    </div>
                                                                </a>
                                                            @endif
                                                        @elseif($datas->type == 'Failure Investigation')
                                                            <a href="{{ route('failure-investigation-show', $datas->id) }}"
                                                              style="display: inline-block; 
                                                        padding: 6px 12px; 
                                                        background-color: #0f43cf; 
                                                        color: white; 
                                                        text-decoration: none; 
                                                        border-radius: 4px; 
                                                        border: 1px solid #0f43cf; 
                                                        font-weight: bold; 
                                                        text-align: center;">
                                                                {{ str_pad($total_count - $loop->index, 4, '0', STR_PAD_LEFT) }}
                                                            </a>
                                                            @if (!empty($datas->parent_id))
                                                                <a
                                                                    href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/deviation">
                                                                    <div class="icon" onclick="showChild()"
                                                                        data-bs-toggle="tooltip" title="Related Records">
                                                                        {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                                        alt="..." class="w-100 h-100"> --}}
                                                                    </div>
                                                                </a>
                                                            @endif
                                                        @elseif($datas->type == 'Non Conformance')
                                                            <a href="{{ route('non-conformance-show', $datas->id) }}"
                                                              style="display: inline-block; 
                                                        padding: 6px 12px; 
                                                        background-color: #0f43cf; 
                                                        color: white; 
                                                        text-decoration: none; 
                                                        border-radius: 4px; 
                                                        border: 1px solid #0f43cf; 
                                                        font-weight: bold; 
                                                        text-align: center;">
                                                                {{ str_pad($total_count - $loop->index, 4, '0', STR_PAD_LEFT) }}
                                                            </a>
                                                            @if (!empty($datas->parent_id))
                                                                <a
                                                                    href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/deviation">
                                                                    <div class="icon" onclick="showChild()"
                                                                        data-bs-toggle="tooltip" title="Related Records">
                                                                        {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                                        alt="..." class="w-100 h-100"> --}}
                                                                    </div>
                                                                </a>
                                                            @endif
                                                        @elseif($datas->type == 'Root-Cause-Analysis')
                                                            <a href="{{ route('root_show', $datas->id) }}"
                                                              style="display: inline-block; 
                                                        padding: 6px 12px; 
                                                        background-color: #0f43cf; 
                                                        color: white; 
                                                        text-decoration: none; 
                                                        border-radius: 4px; 
                                                        border: 1px solid #0f43cf; 
                                                        font-weight: bold; 
                                                        text-align: center;">
                                                                {{ str_pad($total_count - $loop->index, 4, '0', STR_PAD_LEFT) }}
                                                            </a>
                                                            @if (!empty($datas->parent_id))
                                                                <a
                                                                    href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/root_cause_analysis">
                                                                    <div class="icon" onclick="showChild()"
                                                                        data-bs-toggle="tooltip" title="Related Records">
                                                                        {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                                    alt="..." class="w-100 h-100"> --}}
                                                                    </div>
                                                                </a>
                                                            @endif
                                                        @elseif($datas->type == 'OOT')
                                                            <a href="{{ route('rcms/oot_view', $datas->id) }}"
                                                              style="display: inline-block; 
                                                        padding: 6px 12px; 
                                                        background-color: #0f43cf; 
                                                        color: white; 
                                                        text-decoration: none; 
                                                        border-radius: 4px; 
                                                        border: 1px solid #0f43cf; 
                                                        font-weight: bold; 
                                                        text-align: center;">
                                                                {{ str_pad($total_count - $loop->index, 4, '0', STR_PAD_LEFT) }}
                                                            </a>
                                                            @if (!empty($datas->parent_id))
                                                                <a
                                                                    href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/root_cause_analysis">
                                                                    <div class="icon" onclick="showChild()"
                                                                        data-bs-toggle="tooltip" title="Related Records">
                                                                        {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                                    alt="..." class="w-100 h-100"> --}}
                                                                    </div>
                                                                </a>
                                                            @endif
                                                        @elseif($datas->type == 'Resampling')
                                                            <a href="{{ url('resampling_view', $datas->id) }}"
                                                              style="display: inline-block; 
                                                        padding: 6px 12px; 
                                                        background-color: #0f43cf; 
                                                        color: white; 
                                                        text-decoration: none; 
                                                        border-radius: 4px; 
                                                        border: 1px solid #0f43cf; 
                                                        font-weight: bold; 
                                                        text-align: center;">
                                                                {{ str_pad($total_count - $loop->index, 4, '0', STR_PAD_LEFT) }}
                                                            </a>
                                                            @if (!empty($datas->parent_id))
                                                                <a
                                                                    href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/resampling">
                                                                    <div class="icon" onclick="showChild()"
                                                                        data-bs-toggle="tooltip" title="Related Records">
                                                                    </div>
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td id="viewdetails" class="viewdetails" data-id="{{ $datas->id }}"
                                                        data-type="{{ $datas->type }}" data-bs-toggle="modal"
                                                        data-bs-target="#record-modal">
                                                            {{ $datas->record_number ?? '-' }}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $parentId = $datas->parent_id ?? null;
                                                            $parentType = trim((string) ($datas->parent_type ?? ''));

                                                            $parentTable = $parentTableMap[$parentType] ?? null;

                                                            $parentDashboardId = null;

                                                            if ($parentId && $parentTable) {
                                                                $parentDashboardId =
                                                                    $parentUniqueIdsByTable[$parentTable][(string) $parentId] ?? null;
                                                            }
                                                        @endphp

                                                        @if (!empty($parentDashboardId))
                                                            {{ str_pad($parentDashboardId, 4, '0', STR_PAD_LEFT) }}
                                                     
                                                        @else
                                                            -
                                                        @endif
                                                    </td>

                                                    <td class="viewdetails" data-id="{{ $datas->id }}"
                                                        data-type="{{ $datas->type }}" data-bs-toggle="modal"
                                                        data-bs-target="#record-modal">
                                                         @if ($datas->division_id)
                                                             {{ $allDivisions[$datas->division_id] ?? 'Plant' }}
                                                         @else
                                                             -
                                                         @endif
                                                    </td>
                                                    <td class="viewdetails" data-id="{{ $datas->id }}"
                                                        data-type="{{ $datas->type }}" data-bs-toggle="modal"
                                                        data-bs-target="#record-modal"
                                                        style="{{ $datas->type == 'Capa' ? 'text-transform: uppercase' : '' }}">
                                                        {{ $datas->type }}
                                                    </td>

                                                    <td id="short_width" class="viewdetails" title="{{ $datas->short_description }}"
                                                        data-id="{{ $datas->id }}" data-type="{{ $datas->type }}"
                                                        data-bs-toggle="modal" data-bs-target="#record-modal">
                                                        {{ $datas->short_description }}
                                                    </td>
                                                    @php
                                                         $formattedDate = \Carbon\Carbon::parse($datas->date_open)->format('d-M-Y H:i:s');
                                                     @endphp

                                                    <td class="viewdetails" data-id="{{ $datas->id }}"
                                                        data-type="{{ $datas->type }}" data-bs-toggle="modal"
                                                        data-bs-target="#record-modal">
                                                        {{ $formattedDate }}
                                                    </td>
                                                    <td class="viewdetails" data-id="{{ $datas->id }}"
                                                        data-type="{{ $datas->type }}" data-bs-toggle="modal"
                                                        data-bs-target="#record-modal">
                                                        {{ $allUserNames[$datas->initiator_id] ?? '-' }}
                                                    </td>
                                                    <td class="viewdetails" data-id="{{ $datas->id }}"
                                                        data-type="{{ $datas->type }}" data-bs-toggle="modal"
                                                        data-bs-target="#record-modal">
                                                        @if (property_exists($datas, 'due_date'))
                                                            {{ $datas->type !== 'Extension' ? Helpers::getdateFormat($datas->due_date) : '' }}
                                                        @endif
                                                    </td>
                                                    <td class="viewdetails" data-id="{{ $datas->id }}"
                                                        data-type="{{ $datas->type }}" data-bs-toggle="modal"
                                                        data-bs-target="#record-modal">
                                                        {{ $datas->stage }}
                                                    </td>

                                                </tr>
                                        @endforeach
                                    @if (!request()->has('ajax_load'))
                                    </tbody>
                                </table>
                            </div>
                            {{-- <div class="scope-pagination">
                            {{ $datag->links() }}
                        </div>  --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-sm" id="record-modal">
            <div class="modal-contain">
                <div class="modal-dialog m-0">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body " id="auditTableinfo">
                            Please wait...
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <script>
            function showChild() {
                $(".child-row").toggle();
            }

            $(".view-list").hide();

            function toggleview() {
                $(".view-list").toggle();
            }

            $("#record-modal .drop-list").hide();

            function showAction() {
                $("#record-modal .drop-list").toggle();
            }
        </script>
        <script type='text/javascript'>
            $(document).ready(function() {
                // Dynamic lazy loader for loading remaining records
                const urlParams = new URLSearchParams(window.location.search);
                const limit = urlParams.get('limit');
                if (!limit || limit == '1' || limit == '50') {
                    // Load full 2000+ records asynchronously in background via AJAX bypassing controller slowness
                    $.ajax({
                        url: '/rcms/qms-dashboard?ajax_load=1&_t=' + new Date().getTime(),
                        type: 'GET',
                        success: function(response) {
                            var htmlContent = (response && response.html) ? response.html : response;
                            if (typeof htmlContent === 'string' && htmlContent.trim() !== '') {
                                $('#searchTable').empty().html(htmlContent);
                            }
                        },
                        error: function() {
                            $('#searchTable').html('<tr><td colspan="10" style="text-align: center; color: red; font-weight: bold; padding: 15px;">Failed to load records. Please refresh.</td></tr>');
                        }
                    });
                }

                $('#auditTable').on('click', '.viewdetails', function() {
                    var auditid = $(this).attr('data-id');
                    var formType = $(this).attr('data-type') == "OOS/OOT" ? "OOS_OOT" : $(this).attr(
                        'data-type');
                    if (auditid > 0) {
                        // AJAX request
                        var url = "{{ route('ccView', ['id' => ':auditid', 'type' => ':formType']) }}";
                        url = url.replace(':auditid', auditid).replace(':formType', formType);
                        // console.log('enter', url);

                        if (window.location.href.indexOf('mydemosoftware') !== -1) {
                                url = url.replace('http:', 'https:');
                            }
                        // Empty modal data
                        $('#auditTableinfo').empty();
                        $.ajax({
                            url: url,
                            dataType: 'json',
                            success: function(response) {
                                // Add employee details
                                $('#auditTableinfo').append(response.html);
                                // Display Modal
                                $('#record-modal').modal('show');
                            }
                        });
                    }
                });
            });
        </script>
    @endif
    @endsection
