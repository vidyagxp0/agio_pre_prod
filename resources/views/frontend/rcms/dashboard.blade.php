@extends('frontend.rcms.layout.main_rcms')

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
    #short_width{
        display: inline-block;
    width: 520px !important;
    white-space: nowrap;
    overflow: hidden !important;
    text-overflow: ellipsis;
    }
</style>
@section('rcms_container')
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
                                    <option value="Internal-Audit">Internal Audit</option>
                                    <option value="External-Audit">External Audit</option>
                                    <option value="Capa">CAPA</option>
                                    <option value="Audit-Program">Audit Program</option>
                                    <option value="Lab Incident">Lab Incident</option>
                                    <option value="Risk Assesment">Risk Assesment</option>
                                    <option value="Root-Cause-Analysis">Root Cause Analysis</option>
                                    <option value="Management Review">Management Review</option>
                                    <option value="Document">Document</option>
                                    <option value="Extension">Extension</option>
                                    <option value="Observation">Observation</option>
                                    <option value="Change Control">Change Control</option>
                                    <option value="Action Item">Action Item</option>
                                    <option value="Effectiveness Check">Effectiveness Check</option>
                                    <option value="Deviation">Deviation</option>
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

                        <style>
                            .table-container {
                                overflow: auto;
                                max-height: 350px;
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
                        </style>
                        <div class="main-scope-table table-container">
                            <table class="table table-bordered" id="auditTable">
                                <thead class="table-header11">
                                    <tr>
                                        <th>ID</th>
                                        <th>Parent ID</th>
                                        <th>Division</th>
                                        <th>Process</th>
                                        <th>Initiated Through</th>
                                        <th class="td_desc">Short Description</th>
                                        <th>Date Opened</th>
                                        <th>Originator</th>
                                        <th> Due Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="searchTable">
                                    @php
                                        $table = json_encode($datag);
                                        $tables = json_decode($table);

                                    @endphp
                                    @foreach ($tables->data as $datas)
                                        <tr>
                                            <td>
                                                @if ($datas->type == 'Change-Control')
                                                    <a href="{{ route('CC.show', $datas->id) }}" style="color: blue">
                                                        {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                                    </a>
                                                    <a href="{{ url('rcms/qms-dashboard', $datas->id) }}/CC">
                                                        <div class="icon" onclick="showChild()" data-bs-toggle="tooltip"
                                                            title="Related Records">
                                                            {{-- <img src="{{ asset('user/images/single.png') }}" alt="..."
                                                                class="w-100 h-100"> --}}
                                                        </div>
                                                    </a>
                                                    {{-- -----------------------by pankaj-------------------- --}}
                                                @elseif ($datas->type == 'Internal-Audit')
                                                    <a href="{{ route('showInternalAudit', $datas->id) }}" style="color: blue">
                                                        {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
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
                                                    <a href="{{ route('marketcomplaint.marketcomplaint_view', $datas->id) }}">
                                                        {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}{{ $datas->id}}
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
                                                    <a href="{{ route('showRiskManagement', $datas->id) }}" style="color: blue">
                                                        {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
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
                                                    <a href="{{ route('ShowLabIncident', $datas->id) }}" style="color: blue">
                                                        {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
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
                                                @elseif ($datas->type == 'External-Audit')
                                                    <a href="{{ route('showExternalAudit', $datas->id) }}" style="color: blue">
                                                        {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
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
                                                    <a href="{{ route('ShowAuditProgram', $datas->id) }}" style="color: blue">
                                                        {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
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
                                                    <a href="{{ route('showobservation', $datas->id) }}" style="color: blue">
                                                        {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
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
                                                    {{-- ----------------------------------------------- --}}
                                                @elseif($datas->type == 'Action-Item')
                                                    <a href="{{ route('actionItem.show', $datas->id) }}" style="color: blue">
                                                        {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
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
                                                    <a href="{{ url('extension_newshow', $datas->id) }}" style="color: blue" style="color: blue">
                                                        {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
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
                                                    <a href="{{ route('effectiveness.show', $datas->id) }}" style="color: blue">
                                                        {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
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
                                                    <a href="{{ route('capashow', $datas->id) }}" style="color: blue">
                                                        {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                                    </a>
                                                    @if (!empty($datas->parent_id))
                                                        <a href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/capa">
                                                            <div class="icon" onclick="showChild()"
                                                                data-bs-toggle="tooltip" title="Related Records">
                                                                {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                                    alt="..." class="w-100 h-100"> --}}
                                                            </div>
                                                        </a>
                                                    @endif
                                                    @elseif($datas->type == 'OOS Chemical')
                                                    <a href="{{ route('oos.oos_view', $datas->id) }}">
                                                        {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}{{ $datas->id }}
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
                                                    @elseif($datas->type == 'errata')
                                                    <a href="{{ route('errata.show', $datas->id) }}">
                                                        {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}{{ $datas->id }}
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
                                                    <a href="{{ route('manageshow', $datas->id) }}" style="color: blue">
                                                        {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
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
                                                    <a href="{{ route('devshow', $datas->id) }}" style="color: blue">
                                                        {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
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
                                                    <a href="{{ route('root_show', $datas->id) }}" style="color: blue">
                                                        {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
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
                                                    <a href="{{ route('rcms/oot_view', $datas->id) }}">
                                                        {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
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
                                                @endif
                                            </td>
                                            @if ($datas->parent_id != null)
                                                        <td>
                                                            {{ str_pad($datas->parent_id, 4, '0', STR_PAD_LEFT) }}
                                                        </td>
                                                    @else
                                                        <td>
                                                            -
                                                        </td>
                                            @endif
                                            <td class="viewdetails" data-id="{{ $datas->id }}"
                                                data-type="{{ $datas->type }}" data-bs-toggle="modal"
                                                data-bs-target="#record-modal">
                                                @if ($datas->division_id)
                                                    {{ Helpers::getDivisionName($datas->division_id) }}
                                                @else
                                                    KSA
                                                @endif
                                            </td>
                                            <td class="viewdetails" data-id="{{ $datas->id }}"
                                                data-type="{{ $datas->type }}" data-bs-toggle="modal"
                                                data-bs-target="#record-modal">
                                                {{ $datas->type }}
                                            </td>


                                            <td class="viewdetails" data-id="{{ $datas->id }}"
                                                data-type="{{ $datas->type }}" data-bs-toggle="modal"
                                                data-bs-target="#record-modal">
                                                {{ ucwords(str_replace('_', ' ', $datas->initiated_through)) }}
                                            </td>

                                            <td class="viewdetails" data-id="{{ $datas->id }}"
                                                data-type="{{ $datas->type }}" data-bs-toggle="modal"
                                                data-bs-target="#record-modal">
                                                {{ $datas->short_description }}
                                            </td>
                                            <td class="viewdetails" data-id="{{ $datas->id }}"
                                                data-type="{{ $datas->type }}" data-bs-toggle="modal"
                                                data-bs-target="#record-modal">
                                                {{ $datas->date_open }}
                                            </td>
                                            <td class="viewdetails" data-id="{{ $datas->id }}"
                                                data-type="{{ $datas->type }}" data-bs-toggle="modal"
                                                data-bs-target="#record-modal">
                                                {{-- {{ $datas->assign_to }} --}}
                                                {{ Helpers::getInitiatorName($datas->initiator_id) }}
                                                {{-- {{ $datas->initiator_id }} --}}
                                            </td>
                                            <td class="viewdetails" data-id="{{ $datas->id }}"
                                                data-type="{{ $datas->type }}" data-bs-toggle="modal"
                                                data-bs-target="#record-modal">
                                                @if (property_exists($datas, 'due_date'))
                                                    {{ $datas->type !== 'Extension' ? Helpers::getDueDate($datas->due_date, false) : ''  }}
                                                @endif
                                            </td>
                                            <td class="viewdetails" data-id="{{ $datas->id }}"
                                                data-type="{{ $datas->type }}" data-bs-toggle="modal"
                                                data-bs-target="#record-modal">
                                                {{ $datas->stage }}
                                            </td>

                                        </tr>
                                    @endforeach
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
            $('#auditTable').on('click', '.viewdetails', function() {
                var auditid = $(this).attr('data-id');
                var formType = $(this).attr('data-type');
                if (auditid > 0) {
                    // AJAX request
                    var url = "{{ route('ccView', ['id' => ':auditid', 'type' => ':formType']) }}";
                    url = url.replace(':auditid', auditid).replace(':formType', formType);

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
@endsection
