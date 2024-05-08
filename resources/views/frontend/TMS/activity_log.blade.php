@extends('frontend.rcms.layout.main_rcms')
@section('rcms_container')
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" ></script>
    <script>
        function openTab(tabName, ele) {
            let buttons = document.querySelector('.process-groups').children;
            let tables = document.querySelector('.process-tables-list').children;
            for (let element of Array.from(buttons)) {
                element.classList.remove('active');
            }
            ele.classList.add('active')
            for (let element of Array.from(tables)) {
                element.classList.remove('active');
                if (element.getAttribute('id') === tabName) {
                    element.classList.add('active');
                }
            }
        }
    </script>
    {{-- <script>
        function updateQueryOptions() {
            var scopeSelect = document.getElementById('scope');
            var querySelect = document.getElementById('query');
            var scopeValue = scopeSelect.value;

            querySelect.innerHTML = '';

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

            } else if (scopeValue === 'lab_incident') {
                querySelect.options.add(new Option('Opened', '1'));
                querySelect.options.add(new Option('Pending Incident Review ', '2'));
                querySelect.options.add(new Option('Pending Investigation', '3'));
                querySelect.options.add(new Option('Pending Activity Completion', '4'));
                querySelect.options.add(new Option('Pending CAPA', '5'));
                querySelect.options.add(new Option('Pending QA Review', '6'));
                querySelect.options.add(new Option('Pending QA Head Approve', '7'));
                querySelect.options.add(new Option('Close - done', '8'));

            } else if (scopeValue === 'risk_assement') {
                querySelect.options.add(new Option('Opened', '1'));
                querySelect.options.add(new Option('Risk Analysis & Work Group Assignment', '2'));
                querySelect.options.add(new Option('Risk Processing & Action Plan', '3'));
                querySelect.options.add(new Option('Pending HOD Approval ', '4'));
                querySelect.options.add(new Option('Actions Items in Progress', '5'));
                querySelect.options.add(new Option('Residual Risk Evaluation', '6'));
                querySelect.options.add(new Option('Close - done', '7'));

            } else if (scopeValue === 'root_cause_analysis') {
                querySelect.options.add(new Option('Opened', '1'));
                querySelect.options.add(new Option('Investigation in Progress', '2'));
                querySelect.options.add(new Option('Pending Group Review Discussion', '3'));
                querySelect.options.add(new Option('Pending Group Review', '4'));
                querySelect.options.add(new Option('Pending QA Review', '5'));
                querySelect.options.add(new Option('Close - done', '6'));

            } else if (scopeValue === 'management_review') {
                querySelect.options.add(new Option('Opened', '1'));
                querySelect.options.add(new Option('In Progress', '2'));
                querySelect.options.add(new Option('Close - done', '3'));

            }

            else if (scopeValue === 'extension') {
                querySelect.options.add(new Option('Opened', '1'));
                querySelect.options.add(new Option('Close - Cancel', '2'));
                querySelect.options.add(new Option('Close - done', '3'));

            }

            // Add more conditions based on other scope values

        }
    </script> --}}
    <style>
        header .header_rcms_bottom {
            display: none;
        }
        .filter-sub{
            display: flex;
    gap: 16px;
    /* justify-content: center; */
    margin-left: 13px
        }
    </style>
    <div id="rcms-desktop">

        <div class="process-groups">
            <div class="active" onclick="openTab('internal-audit', this)">Training Log </div>
            
        </div>

        <div class="main-content">
            <div class="container-fluid">
                <div class="process-tables-list">

                    <div class="process-table active" id="internal-audit">

                        <div class="scope-bar">
                            {{-- <div class="group-input">
                                <label for="query">Criteria</label>
                                <select id="query" name="stage">
                                    <option value="all_records">All Records</option>
                                    <option value="1">Closed Records</option>
                                    <option value="2">Opened Records</option>
                                    <option value="3">Cancelled Records</option>
                                    <option value="4">Overdue Records</option>
                                    <option value="5">Assigned To Me</option>
                                    <option value="6">Records Created Today</option>
                                </select>
                            </div> --}}
                            <button style="width: 70px;" onclick="window.print()" class="print-btn theme-btn-1">Print</button>
                        </div>

                        <div class="table-block">
                            <div class="table-responsive" style="height: 300px">
                            <table class="table table-bordered" style="width: 120%;">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th><div class="dropdown">
                                            <a class=" dropdown-toggle" type="button" data-toggle="dropdown">Employee Name
                                            &nbsp; &nbsp;&nbsp; &nbsp;<span class="caret"></span></a>
                                            <ul style="width: 180px;" class="dropdown-menu">
                                              <div class="filter-main">
                                                <div class="filter-sub">
                                                    <input type="checkbox">
                                                <li><a href="#">Employee Name</a></li>
                                                </div>
                                                <div class="filter-sub">
                                                    <input type="checkbox">
                                                <li><a href="#">Employee Name</a></li>
                                                </div>
                                                <div class="filter-sub">
                                                    <input type="checkbox">
                                                <li><a href="#">Employee Name</a></li>
                                                </div>
                                                <div class="filter-sub">
                                                    <input type="checkbox">
                                                <li><a href="#">Employee Name</a></li>
                                                </div>
                                              </div>
                                            </ul>
                                          </div></th>
                                          <th><div class="dropdown">
                                            <a class=" dropdown-toggle" type="button" data-toggle="dropdown">Document Title
                                            &nbsp; &nbsp;&nbsp; &nbsp;<span class="caret"></span></a>
                                            <ul style="width: 180px;" class="dropdown-menu">
                                              <div class="filter-main">
                                                <div class="filter-sub">
                                                    <input type="checkbox">
                                                <li><a href="#">Document Title</a></li>
                                                </div>
                                                <div class="filter-sub">
                                                    <input type="checkbox">
                                                <li><a href="#">Document Title</a></li>
                                                </div>
                                                <div class="filter-sub">
                                                    <input type="checkbox">
                                                <li><a href="#">Document Title</a></li>
                                                </div>
                                                <div class="filter-sub">
                                                    <input type="checkbox">
                                                <li><a href="#">Document Title</a></li>
                                                </div>
                                              </div>
                                            </ul>
                                          </div></th>

                                        <th><div class="dropdown">
                                            <a class=" dropdown-toggle" type="button" data-toggle="dropdown">Trainig Plan Name
                                            &nbsp; &nbsp;&nbsp; &nbsp;<span class="caret"></span></a>
                                            <ul style="width: 190px;" class="dropdown-menu">
                                              <div class="filter-main">
                                                <div class="filter-sub">
                                                    <input type="checkbox">
                                                <li><a href="#">Trainig Plan Name</a></li>
                                                </div>
                                                <div class="filter-sub">
                                                    <input type="checkbox">
                                                <li><a href="#">Trainig Plan Name</a></li>
                                                </div>
                                                <div class="filter-sub">
                                                    <input type="checkbox">
                                                <li><a href="#">Trainig Plan Name</a></li>
                                                </div>
                                                <div class="filter-sub">
                                                    <input type="checkbox">
                                                <li><a href="#">Trainig Plan Name</a></li>
                                                </div>
                                              </div>
                                            </ul>
                                          </div></th>
                                          <th><div class="dropdown">
                                            <a class=" dropdown-toggle" type="button" data-toggle="dropdown">Status
                                            &nbsp; &nbsp;&nbsp; &nbsp;<span class="caret"></span></a>
                                            <ul style="width: 180px;" class="dropdown-menu">
                                              <div class="filter-main">
                                                <div class="filter-sub">
                                                    <input type="checkbox">
                                                <li><a href="#">Pass</a></li>
                                                </div>
                                                <div class="filter-sub">
                                                    <input type="checkbox">
                                                <li><a href="#">Fail</a></li>
                                                </div>
                                                <div class="filter-sub">
                                                    <input type="checkbox">
                                                <li><a href="#">Panding/Training</a></li>
                                                </div>
                                               
                                              </div>
                                            </ul>
                                          </div></th>
                                        
                                        <th style="width: 10%;">Due Date</th>
                                        <th style="width: 15%;">Training Completion Date</th>
                                        <th><div class="dropdown">
                                            <a class=" dropdown-toggle" type="button" data-toggle="dropdown">Classroom Trainer
                                            &nbsp; &nbsp;&nbsp; &nbsp;<span class="caret"></span></a>
                                            <ul style="width: 180px;" class="dropdown-menu">
                                              <div class="filter-main">
                                                <div class="filter-sub">
                                                    <input type="checkbox">
                                                <li><a href="#">ClassRoom Trainer</a></li>
                                                </div>
                                                <div class="filter-sub">
                                                    <input type="checkbox">
                                                <li><a href="#">ClassRoom Trainer</a></li>
                                                </div>
                                                <div class="filter-sub">
                                                    <input type="checkbox">
                                                <li><a href="#">ClassRoom Trainer</a></li>
                                                </div>
                                               
                                              </div>
                                            </ul>
                                          </div></th>
                                          <th><div class="dropdown">
                                            <a class=" dropdown-toggle" type="button" data-toggle="dropdown">Training Coordinator
                                            &nbsp; &nbsp;&nbsp; &nbsp;<span class="caret"></span></a>
                                            <ul style="width: 180px;" class="dropdown-menu">
                                              <div class="filter-main">
                                                <div class="filter-sub">
                                                    <input type="checkbox">
                                                <li><a href="#">Training Coordinator</a></li>
                                                </div>
                                                <div class="filter-sub">
                                                    <input type="checkbox">
                                                <li><a href="#">Training Coordinator</a></li>
                                                </div>
                                                <div class="filter-sub">
                                                    <input type="checkbox">
                                                <li><a href="#">Training Coordinator</a></li>
                                                </div>
                                               
                                              </div>
                                            </ul>
                                          </div></th>
                                       

                                    </tr>
                                </thead>

                                <tbody>
                                        <tr>
                                           
                                           <td></td>
                                           <td></td>
                                           <td></td>
                                           <td></td>
                                           <td></td>
                                           <td></td>
                                           <td></td>
                                           <td></td>
                                           <td></td>

                                        </tr>

                                </tbody>
                            </table>
                        </div>
                        </div>
                        
                       
                    </div>

                    
                </div>
            </div>
        </div>

    </div>

    <script>
        VirtualSelect.init({
            ele: '#Facility, #Group, #Audit, #Auditee ,#capa_related_record ,#classRoom_training' 
        });
    </script>
    
@endsection
