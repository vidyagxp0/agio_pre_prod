








@extends('frontend.layout.main')
@section('container')
    <div id="audit-trial">
        <div class="container-fluid">
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <title>VidyaGxP - Software</title>
                <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
            </head>

            <style>
                body {
                    font-family: 'Roboto', sans-serif;
                    margin: 0;
                    padding: 0;
                    /* min-width: 100vw; */
                    min-height: 100vh;
                }

                .w-10 {
                    width: 10%;
                }

                .w-20 {
                    width: 20%;
                }

                .w-30 {
                    width: 30%;
                }

                .w-40 {
                    width: 40%;
                }

                .w-50 {
                    width: 50%;
                }

                .w-60 {
                    width: 60%;
                }

                .w-70 {
                    width: 70%;
                }

                .w-80 {
                    width: 80%;
                }

                .w-90 {
                    width: 90%;
                }

                .w-100 {
                    width: 100%;
                }

                .h-100 {
                    height: 100%;
                }

                table,
                th,
                td {
                    border: 1px solid black;
                    border-collapse: collapse;
                    font-size: 0.9rem;
                }

                table {
                    width: 100%;
                }

                th,
                td {
                    padding: 10px;
                    text-align: left;
                    overflow:auto;
                    max-width: 150px;
                }

                header .head {
                    font-weight: bold;
                    text-align: center;
                    font-size: 1.2rem;
                }

                @page {
                    size: A4;
                    margin-top: 160px;
                    margin-bottom: 60px;
                }

                header {
                    /* position: fixed; */
                    top: -140px;
                    left: 0;
                    width: 100%;
                    display: block;
                }

                footer {
                    /* position: fixed; */
                    bottom: -40px;
                    left: 0;
                    width: 100%;
                }

                .inner-block {
                    padding: 10px;
                }

                .inner-block .head {
                    font-weight: bold;
                    font-size: 1.2rem;
                    margin-bottom: 5px;
                }

                .inner-block .division {
                    margin-bottom: 10px;
                }

                .first-table {
                    border-top: 1px solid black;
                    margin-bottom: 20px;
                }

                .first-table table td,
                .first-table table th,
                .first-table table {
                    border: 0;
                }

                .second-table td:nth-child(1)>div {
                    margin-bottom: 10px;
                }

                .second-table td:nth-child(1)>div:nth-last-child(1) {
                    margin-bottom: 0px;
                }

                .table_bg {
                    background: #4274da57;
                }

                .heading {
                    border: 1px solid black;
                    padding: 10px;
                    margin-bottom: 10px;
                    margin-top: 10px;
                    background: #4274da;
                    overflow: auto;
                    max-width: 100%;
                }

                .heading-new {
                    font-size: 27px;
                    color: #2f2f58;
                }

                .buttons-new {
                    display: flex;
                    justify-content: end;
                    gap: 10px;
                }
                .button_theme1 {
    height: 35px;
    padding: 4px 15px;
    font-size: 0.9rem;
    border: none;
    outline: none;
    color: #fff;
    background: #111;
    cursor: pointer;
    position: relative;
    z-index: 0;
    border-radius: 5px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
}

.button_theme1:hover {
    color: white;
    background: #111;
}

.button_theme1:before {
    content: '';
    background: linear-gradient(45deg, #ff0000, #ff7300, #fffb00, #48ff00, #00ffd5, #002bff, #7a00ff, #ff00c8, #ff0000);
    position: absolute;
    top: -2px;
    left: -2px;
    background-size: 400%;
    z-index: -1;
    filter: blur(5px);
    width: calc(100% + 4px);
    height: calc(100% + 4px);
    animation: glowing 20s linear infinite;
    opacity: 0;
    transition: opacity .3s ease-in-out;
    border-radius: 10px;
}

.button_theme1:active {
    color: #000
}

.button_theme1:active:after {
    background: transparent;
}

.button_theme1:hover:before {
    opacity: 1;
}

.button_theme1:after {
    z-index: -1;
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    background: #111;
    left: 0;
    top: 0;
    border-radius: 10px;
}

.filter-container {
            display: flex;
            align-items: center;
            gap: 10px; /* Space between elements */
            padding: 10px;
            background-color: #4274da;
            border-radius: 5px;
            margin: 20px;
            flex-wrap: wrap; /* Allow wrapping if needed */
        }

        .group-input {
            display: flex;
            flex-direction: column;
        }

        .group-input label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        .group-input input,
        .group-input select {
            padding: 5px;
            font-size: 14px;
            width: 375px; /* Set width for consistency */
        }

        .filter-button {
            padding: 8px 16px;
            background-color: #111;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 14px;
            border-radius: 5px;
            margin-top: 18px; /* Align button with inputs */
        }

        /* .filter-button:hover {
            background-color: #4682b4;
        } */
       
        
            </style>

            <body>
                <div style="display: flex; justify-content: flex-end;">
                    
                     <a class="text-white" href="{{ route('marketcomplaint.marketcomplaint_view',$document->id) }}"><button  class="button_theme1" style="margin-right: 10px"> Back  </button></a>
                     
                
                     <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> <button class="button_theme1">Exit</button>
                </a> </div>
                <header>
                    <table>
                        <tr>
                            <div class="logo">
                                <img src="https://development.vidyagxp.com/public/user/images/logo.png" alt=""
                                    class="w-100">
                            </div>
                        </tr>
                    </table>

                 

                    <table>
                        <div class="heading">

                            <div class="heading-new">
                                Audit Trail
                            </div>

                            <div> <strong>Record ID.</strong> {{ str_pad($document->record, 4, '0', STR_PAD_LEFT) }}</div>
                            <div style="margin-bottom: 5px;  font-weight: bold;"> Originator
                                :{{ $document->initiator ? $document->initiator : '' }}</div>
                            <div style="margin-bottom: 5px; font-weight: bold;">Short Description :
                                {{ $document->description_gi }}</div>
                                @php
                                use Carbon\Carbon;
                                @endphp
                            <div style="margin-bottom: 5px;  font-weight: bold;">Due Date : {{ Carbon::parse($document->due_date_gi)->format('j F Y') }}</div>
                            {{-- <div class="group-input">
                                <label for="query">Type</label>
                                <select id="query" name="type" onchange="toggleDateInputs(this.value)">
                                    <option value="">Select Type</option>
                                    <option value="date">Date</option>
                                </select>
                            </div> --}}
                            
                           
                    
                     </table>

        </header>
        <div class="filter-container">
            <div class="group-input">
                <label for="query">Type</label>
                <select id="query" name="type">
                    <option value="">Select Type</option>
                    <option value="cft">CFT Review</option>
                    <option value="notification">Notification</option>
                    <option value="business">Business Rules</option>
                    <option value="stage">Stage Change</option>
                    <option value="user_action">User Action</option>


                    <!-- Add more options as needed -->
                </select>
            </div>
        
            <div class="group-input">
                <label for="performed_by">Performed By</label>
                <select id="performed_by" name="performed_by">
                    @foreach($audit->unique('user_name') as $performer)
                        <option value="{{ $performer->user_name }}">{{ $performer->user_name }}</option>
                    @endforeach
                </select>
            </div>
            
        
            <div class="group-input">
                <label for="from_date">From Date</label>
                <input type="date" id="from_date" name="from_date"  >
            </div>
        
            <div class="group-input">
                <label for="to_date">To Date</label>
                <input type="date" id="to_date" name="to_date">
            </div>
        
            <button class="button_theme1" onclick="filterRecords()">Filter</button>
        </div>
        
        <div class="inner-block">
            <div class="second-table">
                <table>
                    <tr class="table_bg">
                        <th>S.No</th>
                        <th>Flow Changed From</th>
                        <th>Flow Changed To</th>
                        <th>Data Field</th>
                        <th>Action Type</th>
                        <th>Performer</th>
                    </tr>
        
                    @foreach ($audit as $audits => $dataDemo)
                        <tr class="record-row" data-type="{{ $dataDemo->type }}" data-performed-by="{{ $dataDemo->user_name }}" data-performed-on="{{ \Carbon\Carbon::parse($dataDemo->created_at)->format('Y-m-d') }}">
                            <td>{{ ($audit->currentPage() - 1) * $audit->perPage() + $audits + 1 }}</td>
                            <td><div><strong>Changed From :</strong>{{ $dataDemo->change_from }}</div></td>
                            <td><div><strong>Changed To :</strong>{{ $dataDemo->change_to }}</div></td>
                            <td>
                                <div><strong>Data Field Name :</strong>{{ $dataDemo->activity_type ? $dataDemo->activity_type : 'Not Applicable'  }}</div>
                                <div style="margin-top: 5px;">
                                    @if($dataDemo->activity_type == "Activity Log")
                                        <strong>Change From :</strong>{{ $dataDemo->change_from ? $dataDemo->change_from : 'Not Applicable' }}
                                    @else
                                        <strong>Change From :</strong>{{ $dataDemo->previous ? $dataDemo->previous : 'Null' }}
                                    @endif
                                </div>
                                <br>
                                <div>
                                    @if($dataDemo->activity_type == "Activity Log")
                                        <strong>Change To :</strong>{{ $dataDemo->change_to ? $dataDemo->change_to : 'Not Applicable' }}
                                    @else
                                        <strong>Change To :</strong>{{ $dataDemo->current ? $dataDemo->current : 'Not Applicable' }}
                                    @endif
                                </div>
                                
                                <div style="margin-top: 5px;"><strong>Change Type :</strong>{{ $dataDemo->action_name ? $dataDemo->action_name : 'Not Applicable' }}</div>
                            </td>
                            <td>
                                <div><strong>Action Name :</strong>{{ $dataDemo->action }}</div>
                            </td>
                            <td>
                                <div><strong>Performed By :</strong>{{ $dataDemo->user_name }}</div>
                                <div style="margin-top: 5px;">
                                    <strong>Performed On:</strong>
                                    {{ \Carbon\Carbon::parse($dataDemo->created_at)->format('j F Y H:i') }}
                                </div>
                                <div style="margin-top: 5px;"><strong>Comments :</strong>{{ $dataDemo->comment }}</div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        
        <!-- Pagination links -->
        <div style="float: inline-end; margin: 10px;">
            <style>
                .pagination>.active>span {
                    background-color: #4274da !important;
                    border-color: #4274da !important;
                    color: #fff !important;
                }

                .pagination>.active>span:hover {
                    background-color: #4274da !important;
                    border-color: #4274da !important;
                }

                .pagination>li>a,
                .pagination>li>span {
                    color: #4274da !important;
                }

                .pagination>li>a:hover {
                    background-color: #4274da !important;
                    border-color: #4274da !important;
                    color: #fff !important;
                }
            </style>
            {{ $audit->links() }}
        </div>

        </body>

        </html>

    </div>
    </div>

    <div class="modal fade" id="activity-modal">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">SOP-000{{ $document->id }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="info-list">
                        <div class="list-item">
                            <div class="head">Site/Division/Process</div>
                            <div>:</div>
                            <div>{{ $document->division }}/{{ $document->process }}</div>
                        </div>
                        <div class="list-item">
                            <div class="head">Document Stage</div>
                            <div>:</div>
                            <div>{{ $document->status }}</div>
                        </div>
                        <div class="list-item">
                            <div class="head">Originator</div>
                            <div>:</div>
                            <div>{{ $document->initiator }}</div>
                        </div>
                    </div>
                    <div id="auditTableinfo"></div>

                </div>

            </div>
        </div>
    </div>
    <script type='text/javascript'>
        $(document).ready(function() {

            $('#auditTable').on('click', '.viewdetails', function() {
                var auditid = $(this).attr('data-id');

                if (auditid > 0) {

                    // AJAX request
                    var url = "{{ route('audit-details', [':auditid']) }}";
                    url = url.replace(':auditid', auditid);

                    // Empty modal data
                    $('#auditTableinfo').empty();

                    $.ajax({
                        url: url,
                        dataType: 'json',
                        success: function(response) {

                            // Add employee details
                            $('#auditTableinfo').append(response.html);

                            // Display Modal
                            $('#activity-modal').modal('show');
                        }
                    });
                }
            });

        });
    </script>
<script>
     function formatDate(date) {
        const options = { day: 'numeric', month: 'long', year: 'numeric' };
        return new Intl.DateTimeFormat('en-GB', options).format(date);
    }

    // Function to filter records based on selected type, performer, and date range
    function filterRecords() {
        var fromDate = document.getElementById('from_date').value;
        var toDate = document.getElementById('to_date').value;
        var selectedType = document.getElementById('query').value;
        var selectedPerformer = document.getElementById('performed_by').value;

        var from = fromDate ? new Date(fromDate) : null;
        var to = toDate ? new Date(toDate) : null;

        // Get all records
        var records = document.querySelectorAll('.record-row');

        records.forEach(function(record) {
            var recordDate = new Date(record.getAttribute('data-performed-on'));
            var recordType = record.getAttribute('data-type');
            var recordPerformer = record.getAttribute('data-performed-by');

            // Check if record matches the selected type, performer, and date range
            var matchesType = selectedType ? recordType === selectedType : true;
            var matchesPerformer = selectedPerformer ? recordPerformer === selectedPerformer : true;
            var matchesDate = (!from || recordDate >= from) && (!to || recordDate <= to);

            if (matchesType && matchesPerformer && matchesDate) {
                record.style.display = 'table-row'; // Show the record
            } else {
                record.style.display = 'none'; // Hide the record
            }
        });
    }

     // Display formatted dates for filtering
     function displayFormattedDates() {
        var fromDate = document.getElementById('from_date').value;
        var toDate = document.getElementById('to_date').value;

        if (fromDate) {
            var from = new Date(fromDate);
            console.log("From Date: " + formatDate(from));
        }

        if (toDate) {
            var to = new Date(toDate);
            console.log("To Date: " + formatDate(to));
        }
    }

    // Call displayFormattedDates if needed
    document.getElementById('from_date').addEventListener('change', displayFormattedDates);
    document.getElementById('to_date').addEventListener('change', displayFormattedDates);
</script>
@endsection