<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <title>Vidyagxp - Software</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css"
        integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
    

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/nlsiabbt295w89cjmcocv6qjdg3k7ozef0q9meowv2nkwyd3/tinymce/6/tinymce.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link rel="stylesheet" href="{{ asset('user/css/virtual-select.min.css') }}">
    <script src="{{ asset('user/js/virtual-select.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.0/themes/base/jquery-ui.min.css" integrity="sha512-F8mgNaoH6SSws+tuDTveIu+hx6JkVcuLqTQ/S/KJaHJjGc8eUxIrBawMnasq2FDlfo7FYsD8buQXVwD+0upbcA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- @toastr_css --}}
</head>

<body>

    <style>
        #tms-dashboard {
    padding: 20px 0px;
    background: #4274da;
    min-height: 0 !important;
}
        #create-record-button {
            display: none;
            margin-left: auto;
        }
        .cctab {
        display: flex;
        justify-content: left;
        margin-bottom: 20px;
        padding: 10px;
    }

    .cctablinks {
        background-color: #ffffff;
        border-radius: 5px;
        padding: 6px 12px;
        margin: 0 5px;
        cursor: pointer;
        font-size: 16px;
        color: #333;
        border: none;
    }

    .cctablinks:hover {
        background-color: #ddd;
        color: #000;
    }

    .cctablinks.active {
        background-color: #3a424b;
        /* background-color: #007bff; */
        color: white;
    }

    .cctabcontent {
        padding: 20px;
        border: 1px solid #ccc;
        border-top: none;
    }
    </style>


    <header>

        {{-- Header Top --}}
                <div class="container-fluid header-top">
                    <div class="container">
                        <div class="text-center text-light">
                            <small>Agio</small>
                        </div>
                    </div>
                </div>

        {{-- Header Middle --}}
            <div class="container-fluid header-middle">
                <div>
                    <div class="middle-head">
                        <div class="logo-container">
                            <div class="logo">
                                <img src="{{ asset('user/images/vidhyaGxp.png') }}" alt="..." class="w-100 h-100"
                                    style="scale: 1">
                            </div>
                            <div class="logo">
                                <img src="{{ asset('user/images/agio.jpg') }}" alt="..." class="w-100 h-100">
                            </div>
                        </div>
                        <div class="search-bar">
                            <form action="#" class="w-100">
                                <label for="search"><i class="fa-solid fa-magnifying-glass"></i></label>
                                <input id="searchInput" type="text" name="search" placeholder="Search">
                                <div data-bs-toggle="modal" data-bs-target="#advanced-search">Advanced Search</div>
                            </form>
                        </div>
                        <div class="icon-grid">
                        
                            @if(Auth::guard('employee')->user())
                                <div class="icon-drop">
                                    <div class="icon">
                                        <i class="fa-solid fa-user-tie"></i>
                                            {{ Auth::guard('employee')->user()->employee_name }}
                                        <i class="fa-solid fa-angle-down"></i>
                                    </div>
                                    <div class="icon-block small-block">
                                        <div data-bs-toggle="modal" data-bs-target="#about-modal">About</div>
                                        <div><a href="{{ route('logout-employee') }}">Log Out</a></div>
                                    </div>
                                </div>
                            @else                        
                                <div class="icon-drop">
                                    <div class="icon">
                                        <i class="fa-solid fa-user-tie"></i>
                                        @if (Auth::user())
                                            {{ Auth::user()->name }}
                                        @else
                                            Amit Guru
                                        @endif
                                        <i class="fa-solid fa-angle-down"></i>
                                    </div>
                                    <div class="icon-block small-block">
                                        <div data-bs-toggle="modal" data-bs-target="#about-modal">About</div>
                                        <div><a href="/helpdesk-personnel">Helpdesk Personel</a></div>
                                        <div><a href="{{ route('logout') }}">Log Out</a></div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

 </header>


    <div id="tms-head">
        <div class="head">Training Management System</div>
        <div class="link-list">
         
           
        </div>
    </div>

{{-- ======================================
                    DASHBOARD
    ======================================= --}}

    <div id="tms-dashboard">
        <div class="container-fluid">
            <div class="dashboard-container">
                <div class="inner-block main-block">
                    <div class="top">
                        <div class="d-flex align-items-center">
                            <div class="icon">
                                <i class="fa-solid fa-gauge-high"></i>
                            </div>
                                    <div class="name">
                                        <div>Dashboard</div>
                                        <div>TMS Dashboard</div>
                                    </div>
                        </div>
                        <div class="doc-links d-flex">
                            <a href="javascript:window.location.reload(true)">Refresh</a>

                        </div>
                    </div>
                </div>
                    <div class="cctab">

                        <button class="cctablinks active" onclick="openCity(event, 'CCForm2')">Assigned To Me</button>

                    </div>





            </div>
        </div>
    </div>


    
    

    <style>



      .table thead th {
            background-color: #4274daba; 
            color: rgb(2, 2, 2); 
        }
        
        .inner-block {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
    
        .heading-tms {
            font-size: 19px;
            font-weight: bold;
            color: #030303;
            margin-bottom: 15px;
        }
    
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
    
        .table th,
        .table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    
        .table thead th {
            background-color: #4274daba;
            color: rgb(2, 2, 2);
        }
    
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
    
        /* Pagination Styles */
        .pagination {
            justify-content: center;
            margin-top: 15px;
        }
    
        .btn {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
         
        }
    
        .btn-outline {
            background-color: transparent;
            border: 1px solid #4274da;
            color: #4274da;
            transition: background-color 0.3s, color 0.3s;
        }
    
        .btn-outline:hover {
            background-color: #4274da;
            color: white;
        }
    
        /* Responsive Styles */
        @media (max-width: 768px) {
            .table th,
            .table td {
                padding: 8px;
                font-size: 14px;
            }
    
            .heading-tms {
                font-size: 20px;
            }
        }
    </style>
            <div id="CCForm2" class="inner-block tms-block cctabcontent" style="margin-top:50px;">
                <div class="heading-tms">Induction Training</div>
              
                @php
                            
                    $documentsCollection = collect($useDocFromInductionTraining);

                  
                    $currentPage = request()->get('page', 1);

                    $perPage = 5;

                    $paginatedData = $documentsCollection->forPage($currentPage, $perPage);

                    $totalPages = ceil($documentsCollection->count() / $perPage);
                @endphp

                <div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Emp Code</th>
                                <th>Employee Name</th>
                                <th>Designation</th>
                                <th>SOP No.</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Remaining Attempts</th>
                                <th>Training Completion date</th>
                                <th>Preview SOP</th>
                                <th>Quiz</th>
                                <th>Certificate</th>
                               
                            </tr>
                        </thead>
                        <tbody id="searchTable">
                        @foreach ($paginatedData as $temp)
                            @php
                                $getSOPNo = ['document_number_1', 'document_number_2', 'document_number_3', 'document_number_4', 'document_number_5','document_number_6', 'document_number_7', 'document_number_8', 'document_number_9', 'document_number_10', 'document_number_11', 'document_number_12', 'document_number_13', 'document_number_14', 'document_number_15','document_number_16'];
                                $dateValue = []; 

                                if ($temp) {
                                    foreach ($getSOPNo as $key => $document) {
                                      
                                        $startDateColumn = 'document_number_' .($key + 1);

                                      
                                        if (isset($temp->$startDateColumn) && !is_null($temp->$startDateColumn)) {
                                            $dateValue[] = $temp->$startDateColumn; 
                                        }
                                    }
                                }
                                $inductionResult = DB::table('emp_training_quiz_results')->where(['training_id' => $temp->id, 'training_type' => "Induction Training", 'emp_id' => Auth::guard('employee')->user()->full_employee_id, 'result' => 'Pass'])->latest()->first();
                             
                                $commaSeparatedStartDates = implode(', ', $dateValue);
                            @endphp
                            @if($temp->stage >= 2)
                                <tr>
                                    <td>{{ $temp->employee_id }}</td>
                                    <td>{{ Helpers::getEmpNameByCode($temp->employee_id) }}</td>
                                    <td>{{ $temp->designation }}</td>
                                    <td>{{ $commaSeparatedStartDates }}</td>
                                    <td>{{  Helpers::getdateFormat($temp->start_date) }}</td>
                                    <td>{{  Helpers::getdateFormat($temp->end_date) }}</td>
                                    <td>{{ $temp->attempt_count == -1 ? 0 : $temp->attempt_count }}</td>
                                    <td>{{ $inductionResult ? Helpers::getdateFormat1($inductionResult->created_at): "-" }}</td>
                                    <td><a href="{{ url("induction_training-details/$commaSeparatedStartDates") }}"><i class="fa-solid fa-eye"></i></a></td>
                                    <td>
                                            @if ($inductionResult && $inductionResult->result == "Pass")
                                                Pass
                                            @elseif($temp->attempt_count <= 0)
                                                Attempts completed (Failed)
                                            @else
                                                <button type="button" class="btn btn-outline" style="background-color: #4274da; color: white;" onclick="window.location.href='/induction_question_training/{{$commaSeparatedStartDates}}/{{$temp->id}}';">
                                                    Attempt Quiz
                                                </button>
                                            @endif
                                    </td>
                                    <td>
                                        @if($temp->stage >=6)
                                            <button type="button" class="btn btn-outline" style="background-color: #4274da; color: white;" 
                                                    onclick="window.location.href='/induction_training_certificate/{{$temp->employee_id}}';">
                                                <i class="fa fa-certificate"></i>
                                            </button>
                                        @endif 
                                    </td>
                                    
                                
                                </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination Links -->
                    <nav>
                        <ul class="pagination justify-content-center">
                            <!-- Previous Page Link -->
                            <li class="page-item {{ $currentPage == 1 ? 'disabled' : '' }}">
                                <a class="page-link" href="?page={{ $currentPage - 1 }}">Previous</a>
                            </li>

                            <!-- Page Number Links -->
                            @for ($page = 1; $page <= $totalPages; $page++)
                                <li class="page-item {{ $currentPage == $page ? 'active' : '' }}">
                                    <a class="page-link" href="?page={{ $page }}">{{ $page }}</a>
                                </li>
                            @endfor

                            <!-- Next Page Link -->
                            <li class="page-item {{ $currentPage == $totalPages ? 'disabled' : '' }}">
                                <a class="page-link" href="?page={{ $currentPage + 1 }}">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <div class="heading-tms">On The Job Training</div>
            
                    @php
                            
                    $documentsCollection = collect($useDocFromJobTraining);

                    $currentPage = request()->get('page', 1);

                    $perPage = 5;

                    $paginatedData = $documentsCollection->forPage($currentPage, $perPage);

                    $totalPages = ceil($documentsCollection->count() / $perPage);

                @endphp

                <div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Emp Code</th>
                                <th>Employee Name</th>
                                <th>SOP No.</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Remaining Attempts</th>
                                <th>My Training Completion date</th>
                                <th>Preview SOP</th>
                                <th>Quiz</th>
                                <th>Certificate</th>
                            </tr>
                        </thead>
                        <tbody id="searchTable">
                            @foreach ($paginatedData as $temp)
                            @php
                                $getSOPNo = ['reference_document_no_1', 'reference_document_no_2', 'reference_document_no_3', 'reference_document_no_4', 'reference_document_no_5'];
                                $dateValue = null; // Variable to store the date
                            if ($temp) {
                                        foreach ($getSOPNo as $key => $subject) {
                                            // Construct the corresponding startdate column name
                                            $startDateColumn = 'reference_document_no_' . ($key + 1); // This will create startdate_1, startdate_2, etc.

                                            // Check if the start date exists and is not null
                                            if (isset($temp->$startDateColumn) && !is_null($temp->$startDateColumn)) {
                                                $dateValue[] = $temp->$startDateColumn; // Add the date to the array
                                            }
                                        }
                                    }
                                    // Join the non-null start dates into a comma-separated string
                                    $commaSeparatedStartDates = implode(', ', $dateValue);
                                    $jobTrainingResult = DB::table('emp_training_quiz_results')->where(['training_id' => $temp->id, 'training_type' => "On The Job Training", 'emp_id' => Auth::guard('employee')->user()->full_employee_id, 'result' => 'Pass'])->latest()->first();
                                    
                            @endphp
                            @if($temp->stage >= 3)
                            <tr>
                                <td>{{ $temp->employee_id }}</td>
                                <td>{{ $temp->name }}</td>
                                <td>{{ $commaSeparatedStartDates }}</td>
                                <td>{{  Helpers::getdateFormat($temp->start_date) }}</td>
                                <td>{{  Helpers::getdateFormat($temp->end_date) }}</td>
                                <td>{{ $temp->attempt_count == -1 ? 0 : $temp->attempt_count }}</td>
                                <td>{{ $jobTrainingResult ? Helpers::getdateFormat1($jobTrainingResult->created_at): "-" }}</td>
                                <td><a href="{{ url('job_training-details', $commaSeparatedStartDates) }}"><i class="fa-solid fa-eye"></i></a></td>
                                
                                <td>
                                    @if ($jobTrainingResult && $jobTrainingResult->result == "Pass")
                                                Pass
                                            @elseif($temp->attempt_count <= 0)
                                                Attempts completed (Failed)
                                            @else
                                                <button type="button" class="btn btn-outline" style="background-color: #4274da; color: white;" onclick="window.location.href='/on_the_job_question_training/{{$commaSeparatedStartDates}}/{{$temp->id}}';">
                                                    Attempt Quiz
                                                </button>
                                            @endif

                                
                                </td>
                                @if($temp->stage >=5)
                                        <td>
                                            <button type="button" class="btn btn-outline" style="background-color: #4274da; color: white;"
                                                onclick="window.location.href='/job_training_certificate/{{$temp->id}}';"> 
                                                <i class="fa fa-certificate"></i>
                                            </button>
                                        </td>
                                    @endif   
                                                         
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination Links -->
                    <nav>
                        <ul class="pagination justify-content-center">
                            <!-- Previous Page Link -->
                            <li class="page-item {{ $currentPage == 1 ? 'disabled' : '' }}">
                                <a class="page-link" href="?page={{ $currentPage - 1 }}">Previous</a>
                            </li>

                            <!-- Page Number Links -->
                            @for ($page = 1; $page <= $totalPages; $page++)
                                <li class="page-item {{ $currentPage == $page ? 'active' : '' }}">
                                    <a class="page-link" href="?page={{ $page }}">{{ $page }}</a>
                                </li>
                            @endfor

                            <!-- Next Page Link -->
                            <li class="page-item {{ $currentPage == $totalPages ? 'disabled' : '' }}">
                                <a class="page-link" href="?page={{ $currentPage + 1 }}">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
   
                <div class="heading-tms">SOP Training</div>
                <br>
             @if (Helpers::checkRoles(1) || Helpers::checkRoles(2) || Helpers::checkRoles(3) || Helpers::checkRoles(4)|| Helpers::checkRoles(5) || Helpers::checkRoles(7) || Helpers::checkRoles(8))
                 <!-- <div>
                     <table class="table table-bordered">
                         <thead>
                             <tr>
                                 {{-- <th style="width:15%;">Document Number</th> --}}
                                 <th>Training Plan</th>
                                 <th>Document Title</th>
                                 <th>Trainer Name</th>
                                 <th>Overall Training Status</th>
                                 <th>Due Date</th>
                                 <th>My Training Completion date</th>
                                 <th></th>
                             </tr>
                         </thead>
                         <tbody id="searchTable">
                             @foreach ($documents2 as $temp)
                             @php
                                 $trainingStatusCheck = DB::table('training_statuses')
                                 ->where([
                                 'user_id' => Auth::user()->id,
                                 'sop_id' => $temp->id,
                                 'training_id' => $temp->traningstatus->training_plan,
                                 'status' => 'Complete'
                                 ])->first();
                                 $trainingPlanName = DB::table('trainings')
                                 ->where('id', $temp->traningstatus->training_plan)
                                 ->first();
                                 $traininerName = DB::table('users')
                                 ->where('id', $trainingPlanName->trainner_id)
                                 ->first();
                             @endphp
                             <tr>
                                 <td>{{ $trainingPlanName ? $trainingPlanName->traning_plan_name : ''}}</td>
                                 <td>{{ $temp->document_name }}</td>
                                 <td>{{ $traininerName ? $traininerName->name : ''}}</td>
                                 <td>{{ $temp->traningstatus->status }}</td>
                                 <td>{{ \Carbon\Carbon::parse($trainingPlanName->training_end_date) }}</td>
                                 <td>
                                     {{ $trainingStatusCheck ? \Carbon\Carbon::parse($trainingStatusCheck->created_at)->format('d M Y') : '-' }}
                                 </td>
                                 @if($trainingStatusCheck)
                                 <th>Completed</th>
                                 @else
                                 @if($temp->traningstatus->status == "Complete")
                                 <th>Training Criteria Met</th>
                                 @elseif( $trainingPlanName->training_end_date < now()) <th>Training Date Passed</th>

                                     @else
                                     <td><a href="{{ url('TMS-details', $temp->traningstatus->training_plan) }}/{{ $temp->id }}"><i class="fa-solid fa-eye"></i></a></td>
                                     @endif
                                     @endif
                             </tr>
                             @endforeach
                         </tbody>
                     </table>
                 </div> -->
                 @php
                     // Convert the array to a collection
                     $documentsCollection = collect($documents2);

                     // Set the current page from the URL or default to 1
                     $currentPage = request()->get('page', 1);

                     // Number of items per page
                     $perPage = 5;

                     // Slice the collection to get only the items for the current page
                     $paginatedData = $documentsCollection->forPage($currentPage, $perPage);

                     // Calculate total pages based on the total number of items and perPage limit
                     $totalPages = ceil($documentsCollection->count() / $perPage);
                 @endphp

                 <div>
                     <table class="table table-bordered">
                         <thead>
                             <tr>
                                 <th>Training Plan</th>
                                 <th>Document Title</th>
                                 <th>Trainer Name</th>
                                 <th>Overall Training Status</th>
                                 <th>Due Date</th>
                                 <th>My Training Completion date</th>
                                 <th></th>
                             </tr>
                         </thead>
                         <tbody id="searchTable">
                             @foreach ($paginatedData as $temp)
                             @php
                                 $trainingStatusCheck = DB::table('training_statuses')
                                     ->where([
                                         'user_id' => Auth::user()->id,
                                         'sop_id' => $temp->id,
                                         'training_id' => $temp->traningstatus->training_plan,
                                         'status' => 'Complete'
                                     ])->first();

                                 $trainingPlanName = DB::table('trainings')
                                     ->where('id', $temp->traningstatus->training_plan)
                                     ->first();

                                 $trainerName = DB::table('users')
                                     ->where('id', $trainingPlanName->trainner_id)
                                     ->first();
                             @endphp
                             <tr>
                                 <td>{{ $trainingPlanName ? $trainingPlanName->traning_plan_name : '' }}</td>
                                 <td>{{ $temp->document_name }}</td>
                                 <td>{{ $trainerName ? $trainerName->name : '' }}</td>
                                 <td>{{ $temp->traningstatus->status }}</td>
                                 <td>{{ \Carbon\Carbon::parse($trainingPlanName->training_end_date) }}</td>
                                 <td>{{ $trainingStatusCheck ? \Carbon\Carbon::parse($trainingStatusCheck->created_at)->format('d M Y') : '-' }}</td>
                                 @if($trainingStatusCheck)
                                 <th>Completed</th>
                                 @else
                                 @if($temp->traningstatus->status == "Complete")
                                 <th>Training Criteria Met</th>
                                 @elseif($trainingPlanName->training_end_date < now())
                                     <th>Training Date Passed</th>
                                 @else
                                 <td><a href="{{ url('TMS-details', $temp->traningstatus->training_plan) }}/{{ $temp->id }}"><i class="fa-solid fa-eye"></i></a></td>
                                 @endif
                                 @endif
                             </tr>
                             @endforeach
                         </tbody>
                     </table>

                     <!-- Pagination Links -->
                     <nav>
                         <ul class="pagination justify-content-center">
                             <!-- Previous Page Link -->
                             <li class="page-item {{ $currentPage == 1 ? 'disabled' : '' }}">
                                 <a class="page-link" href="?page={{ $currentPage - 1 }}">Previous</a>
                             </li>

                             <!-- Page Number Links -->
                             @for ($page = 1; $page <= $totalPages; $page++)
                                 <li class="page-item {{ $currentPage == $page ? 'active' : '' }}">
                                     <a class="page-link" href="?page={{ $page }}">{{ $page }}</a>
                                 </li>
                             @endfor

                             <!-- Next Page Link -->
                             <li class="page-item {{ $currentPage == $totalPages ? 'disabled' : '' }}">
                                 <a class="page-link" href="?page={{ $currentPage + 1 }}">Next</a>
                             </li>
                         </ul>
                     </nav>
                 </div>

             @endif

             
         </div>
            </div>
            
</body>
</html>