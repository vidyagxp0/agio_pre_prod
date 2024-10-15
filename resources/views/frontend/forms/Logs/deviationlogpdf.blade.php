<!DOCTYPE html>
<html>

<head>
    <style>
        @page {
            margin: 20px;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .table-container {
            /* padding: 1%; */
            position:relative;
            top : 3%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: auto;
        }

        th, td {
            border: 1px solid ;
            padding: 8px;
            text-align: center;
            font-size: 12px;
        }


        th {
            background-color: #f2f2f2;
        }

        /* Ensure that the second part of the table starts on a new page */
        .page-break {
            page-break-before: always;
        }
        /* Set fixed widths for each class */
.w-30 {
    width: 200px; /* Fixed width of 150 pixels */
}

.w-40 {
    width: 100px; /* Fixed width of 200 pixels */
}

/* Optional: You can add this to prevent content overflow */
/* td { */
    /* white-space: nowrap; Prevents text from wrapping
    overflow: hidden;    Hides overflow content */
    /* text-overflow: ellipsis; Adds "..." if content is too long
} */

    </style>
</head>

<header>
    <table>
        <tr>
            <td class="w-50 head">
                <strong>Deviation Log Report</strong>
            </td>
            
            <td class="w-50">
                <div class="logo">
                <img src="https://www.agio-pharma.com/wp-content/uploads/2019/10/logo-agio.png" alt="" class="w-50 h-50" style="height: 100px; scale: 1;" >

                </div>
            </td>
        </tr>
       
        
    </table>
</header>

<body>
    <div class="table-container">
        <!-- First table -->
        <table>
            <thead>
                <tr>
                    <th rowspan="2">Sr.No.</th>
            <th rowspan="2">Initiation Date</th>
            <th rowspan="2">Deviation No.</th>
            <th rowspan="2">Brief Description of Deviation</th>
            <th rowspan="2">Deviation Number Allotted by</th>
            <th rowspan="2">Final Classification</th>
            <th colspan="2" style="text-align: center; font-size: 13px;">TCD of Extension</th>
            <th rowspan="2">Closure Date</th>
            <th rowspan="2">CAPA NO.</th>
            <th rowspan="2">Recorded By</th>
            <th rowspan="2">Remarks For Cancellation / Reopen The Deviation</th>
        </tr>
        <tr>
            <!-- Ist and IInd under TCD of Extension -->
           
            <th>Ist</th>
            <th>IInd</th>
        </tr>
            </thead>
            <tbody>
                        @php
                            use Carbon\Carbon;
                            use App\Models\extension_new; 
                        @endphp
                
                @foreach ($FilterDDD as $index => $deviations)
                @php
                    // Devi ka parent ID pakadne ka
                    $parent = $deviations->id;

                    // Sare extension uthane ka
                    $extensions = extension_new::where(['parent_id' => $parent, 'parent_type' => 'Deviation'])
                                                ->orderBy('id', 'asc') // ID ke hisaab se sort karne ka
                                                ->get();

                    // Sirf pehla do hi record chahiye
                    $limitedExtensions = $extensions->take(2); 
                    // Ensure that there's at least one extension, or use a placeholder
                    $extensionCount = max(1, count($extensions));
                @endphp

                <tr>

                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($deviations->initiation_date)->format('d-M-Y') }}</td>
                    <td>{{ $deviations->division ? $deviations->division->name : '-' }}/CC/{{ date('Y') }}/{{ str_pad($deviations->record, 4, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $deviations->description_of_deviation ? $deviations->description_of_deviation : '-' }}</td>
                    <td>{{ $deviations->qa_cqa_review_by ? $deviations->qa_cqa_review_by : '-' }}</td>
                    <td>{{ $deviations->final_classification_of_deviation }}</td>

                    @if(isset($limitedExtensions[0]))
                        <td>{{ $limitedExtensions[0]->current_due_date ? Carbon::parse($limitedExtensions[0]->current_due_date)->format('d-M-Y') : '-' }}</td>
                    @else
                        <td>-</td>
                    @endif   
                


                @if(isset($limitedExtensions[1]))
                    <td>{{ $limitedExtensions[1]->current_due_date ? Carbon::parse($limitedExtensions[1]->current_due_date)->format('d-M-Y') : '-' }}</td>
                @else
                    <td>-</td>
                @endif


    

                     <td >{{$deviations->qa_cqa_head_approval_on ? $deviations->qa_cqa_head_approval_on : 'closure date' }}</td>
                    <td > {{$deviations->reference_capa_number ? $deviations->reference_capa_number : 'Null' }}</td>
                    <td>{{ $deviations->initiator ? $deviations->initiator->name : '-' }}</td>
                    <td> @if($deviations->stage == 0) {{ $deviations->cancelled_comment ? $deviations->cancelled_comment : '-' }} @elseif($deviations->stage == 9) {{ $deviations->reopen_comment ? $deviations->reopen_comment : '-' }} @else Not Applicable @endif </td>
                    
                
                </tr>
   

                @endforeach
            </tbody>
        </table>
    </div>

   
    <footer>
        <table style="position:relative; top:95%;">
            <tr>
                <td class="w-30">
                    <strong>Printed By :</strong>
                </td>
                <td class="w-40">
                    <strong>Printed On :</strong>
                </td>
            </tr>
        </table>
    </footer>

    <style>
        header table,
        header th,
        header td,
        footer table,
        footer th,
        footer td,
        .border-table table,
        .border-table th,
        .border-table td {
            border: 1px solid black;
            border-collapse: collapse;
            font-size: 0.9rem;
            vertical-align: middle;
        }
    </style>
</body>

<script>
     function printTable() {
    const department = document.getElementById('initiator_group').value;
    const division = document.getElementById('division_id_cc').value;
    const dateFrom = document.getElementById('date_from_cc').value;
    const dateTo = document.getElementById('date_to_cc').value;
    const nchange = document.getElementById('naturechange').value;

    const url = `/api/Deviation-Log?department=${department}&division=${division}&date_from=${dateFrom}&date_to=${dateTo}&nchange=${nchange}`;
    window.open(url, '_blank');
}


    </script>

</html>
