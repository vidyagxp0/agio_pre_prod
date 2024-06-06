@extends('frontend.rcms.layout.main_rcms')
@section('rcms_container')
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
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

    <style>
        header .header_rcms_bottom {
            display: none;
        }

        .filter-sub {
            display: flex;
            gap: 16px;
            margin-left: 13px
        }
    </style>
    <style>
        .filter-bar {
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
        }

        .filter-item {
            display: flex;
            align-items: center;
            margin-right: 20px;
        }

        .table-responsive {
            height: 100vh;
            overflow-x: scroll;

        }

        .filter-item label {
            margin-right: 10px;
        }

        table {
            overflow: scroll
        }
    </style>
    <div id="rcms-desktop">

        <div class="process-groups">
            <div class="active" onclick="openTab('internal-audit', this)">Capa Log </div>
        </div>
        <div class="main-content">
            <div class="container-fluid">
                <div class="process-tables-list">
                    <div class="process-table active" id="internal-audit">
                        <div class="mt-1 mb-2 bg-white " style="height: 65px">
                            <div class="d-flex align-items-center">
                                <div class="scope-bar ml-3">
                                    <button style="width: 70px;margin-left:5px"
                                        class="print-btn btn btn-primary">Print</button>
                                </div>
                                <div class="flex-grow-2" style="margin-left:-50px; margin-bottom:12px">
                                    <div class="filter-bar d-flex justify-content-between">
                                        <div class="filter-item">
                                            <label for="process">Department</label>
                                            
                                            
                                            <select class="custom-select" id="process">
                                               <option value="select">--  Select Option  --</option>
                                                <option value="CQA">
                                                           Corporate
                                                            Quality Assurance</option>
                                                        <option value="QAB">Quality
                                                            Assurance Biopharma</option>
                                                        <option value="CQC">Central
                                                            Quality Control</option>
                                                        <option value="CQC">Manufacturing
                                                        </option>
                                                        <option value="PSG">Plasma
                                                            Sourcing Group</option>
                                                        <option value="CS">Central
                                                            Stores</option>
                                                        <option value="ITG">Information
                                                            Technology Group</option>
                                                        <option value="MM">Molecular
                                                            Medicine</option>
                                                        <option value="CL">Central
                                                            Laboratory</option>
                                                        <option value="TT">Tech
                                                            Team</option>
                                                        <option value="QA">Quality
                                                            Assurance</option>
                                                        <option value="QM">Quality
                                                            Management</option>
                                                        <option value="IA">IT
                                                            Administration</option>
                                                        <option value="ACC">Accounting
                                                        </option>
                                                        <option value="LOG">Logistics
                                                        </option>
                                                        <option value="SM">Senior
                                                            Management</option>
                                                        <option value="BA">Business
                                                            Administration</option>

                                            </select>
                                        </div>
                                        <div class="filter-item">
                                            <label for="criteria">Division</label>
                                            <select class="custom-select" id="criteria">
                                                <option value="select">--Select--</option>
                                                <option value="corporate">Corporate</option>
                                                <option value="plant">Plant</option>

                                            </select>
                                        </div>
                                        <div class="filter-item">
                                            <label for="division">Date From</label>
                                            {{-- <select class="custom-select" id="division"> --}}
                                                 <input type="date" class="custom-select" id="dateFrom" name="dateFrom">

                                            {{-- </select> --}}
                                        </div>
                                        <div class="filter-item">
                                            <label for="originator">Date To</label>
                                                <input type="date" class="custome-select" id="dateTo" name="dateTo">
                                            </select>
                                        </div> 
                                        <div class="filter-item">
                                            <label for="originator">CAPA Type</label>
                                            <select class="custom-select" id="originator">
                                                <option value="--select--">Select Option</option>
                                                <option value="Corrective Action">Corrective Action</option>
                                                <option value="Preventive Action">Preventive Action</option>
                                                <option value="Corrective & Preventive Action">Corrective & Preventive Action</option>

                                            </select>
                                        </div>
                                        <div class="filter-item">
                                            <label for="datewise">Select Period</label>
                                            <select class="custom-select" id="datewise">
                                                <option value="all">Select</option>
                                                <option value="all">Yearly</option>
                                                <option value="all">Quarterly</option>
                                                <option value="all">Mothly</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-block">
                            <div class="table-responsive" style="height: 300px">
                                <table class="table table-bordered" style="width: 120%;">
                                    <thead>
                                       
                                    <tr>
                                        <th style="width: 5%;">Sr.No.</th>
                                        <th>Date of Initiation</th>
                                        <th>CAPA No.</th>
                                        <th>CAPA Description</th>
                                        <th>Initiator</th>
                                        <th>Department</th>
                                        <th>Division</th>
                                        <th>Type of CAPA</th>
                                        <th>Source Document no.</th>
                                        <th>Due Date</th>
                                        <th>Status</th>                                       
                                    </tr>
                                    </thead>

                                    <tbody>
                                       @foreach ($capa as $capalog)
                                       <tr>

                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$capalog->intiation_date}}</td>
                                        <td>{{Helpers::getDivisionName($capalog->division_id) }}/CP/{{ date('Y') }}/{{ str_pad($capalog->record, 4, '0', STR_PAD_LEFT)}}</td>
                                        <td>{{$capalog->short_description}}</td>
                                        <td>{{Auth::user()->name}}</td>
                                        <td>{{$capalog->initiator_Group}} </td>
                                        <td>{{Helpers::getDivisionName(session()->get('division'))}}</td>
                                        <td>{{$capalog->capa_type}}</td>
                                        <td>{{ $capalog->parent_type ?? 'null' }}</td>
                                        <td>{{$capalog->due_date}}</td>
                                        <td>{{$capalog->status}}</td>


                                    </tr>

                                           
                                       @endforeach
                                    </tbody>
                                </table>
                            </div>
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
