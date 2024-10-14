<!DOCTYPE html>
<html>
<head>
    
    <style>
        @page {
            margin: 20px; /* Set page margin */
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .table-container {
            position:relative;
            top : 3%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: auto; /* Allow table to adjust column widths automatically */
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            font-size: 12px; /* Reduce font size to ensure columns fit */
        }

        th {
            background-color: #f2f2f2;
        }

        /* Ensure that the second part of the table starts on a new page */
        .page-break {
            page-break-before: always;
        }

        .w-30 {
    width: 200px; /* Fixed width of 150 pixels */
}

.w-40 {
    width: 100px; /* Fixed width of 200 pixels */
}

    </style>
</head>
<header>
        <table>
            <tr>
                <td class="w-50 head">
               <strong> CAPA Log Report </strong>
                </td>

                <td class="w-50">
                <div class="logo">
                    <img src="https://www.agio-pharma.com/wp-content/uploads/2019/10/logo-agio.png" alt="" class="w-100 h-100" style="height: 100px; scale: 1;" >
                </div>
            </td>
            </tr>
            </table>
    </header>

<body>
    <!-- <h2 style="text-align: center;">Corrective and Preventive Action Log Report</h2> -->

    <div class="table-container">
        <!-- First table with first 6 columns -->
        <table>
            <thead>
                <tr>
                <th style="width: 5%;">Sr.No.</th>
                <th>CAPA No.</th>
                <th>Intiation Date</th>
                <th>Source Details</th>
                <th>Department</th>
                <th>CAPA Details</th>
                <th>TCD Of CAPA</th>
                <th>Recorded By</th>
                <th>CAPA Extension Date</th>
                <th>Action Implementation Date</th>
                <th>CAPA Closing Date</th>
                <th>Effectiveness Verified By QA/CQA</th>
                </tr>
            </thead>
            <tbody>
                @php
                    use Carbon\Carbon;
                    use App\Models\extension_new; 
                @endphp
                @foreach ($filteredData as $capalog)
                @php

                   $parent = $capalog->id;
                   $extensions = extension_new::where(['parent_id' => $parent, 'parent_type' => 'CAPA'])->get();
                   $cc = $filtercapa->firstWhere('capa_id', $capalog->id); // Assuming 'capa_id' is the key linking them
                   

                        // Unserialize the Action_implementation_date if $cc exists
                if ($cc && isset($cc['Action_implementaion_date'])) {
                    $actionDate = unserialize($cc['Action_implementaion_date']);
                    $actionDate = is_array($actionDate) && isset($actionDate[0]) ? $actionDate[0] : 'Not Applicable';
                } else {
                    $actionDate = 'Not Applicable';
                }

                // Ensure that there's at least one extension, or use a placeholder
        $extensionCount = max(1, count($extensions));
    

                @endphp
                @for($i = 0; $i < $extensionCount; $i++)
    
                <tr>
                @if($i == 0)
                <td rowspan="{{ $extensionCount }}">{{$loop->index + 1}}</td>
                <td rowspan="{{ $extensionCount }}">{{$capalog->division ? $capalog->division->name : 'Not Applicable'}}/CAPA/{{ date('Y') }}/{{ str_pad($capalog->record, 4, '0', STR_PAD_LEFT)}}</td>
                <td rowspan="{{ $extensionCount }}">{{$capalog->intiation_date ? Carbon::parse($capalog->intiation_date)->format('d-M-Y') : 'Not Applicable'}}</td>
                <td rowspan="{{ $extensionCount }}">{{$capalog->initiated_through ? $capalog->initiated_through : '-' }}</td>
                <td rowspan="{{ $extensionCount }}">{{ Helpers::getFullDepartmentName($capalog->initiator_Group) ? Helpers::getFullDepartmentName($capalog->initiator_Group) : 'Not Applicable' }}</td>
                <td rowspan="{{ $extensionCount }}">{{$capalog->short_description}}</td>
                <td rowspan="{{ $extensionCount }}">{{$capalog->due_date ? Carbon::parse($capalog->due_date)->format('d-M-Y') : 'Not Applicable'}}</td>
                <td rowspan="{{ $extensionCount }}">{{$capalog->initiator ? $capalog->initiator->name : '-'}}</td>
                @endif    


                    @if(isset($extensions[$i]))
                        <td>{{$extensions[$i]->initiation_date ? Carbon::parse($extensions[$i]->initiation_date)->format('d-M-Y') : '-' }}</td>
                    @else
                        <td>-</td> {{-- If there are no extensions, fill the column with a placeholder --}}
                    @endif

                    <td rowspan="{{ $extensionCount }}"> @if($actionDate != 'Not Applicable' && $actionDate) {{ \Carbon\Carbon::parse($actionDate)->format('d-M-Y') }} @else {{ $actionDate }} @endif </td>
                <td rowspan="{{ $extensionCount }}">{{$capalog->qah_approval_completed_on ? Carbon::parse($capalog->qah_approval_completed_on)->format('d-M-Y') : 'Not Applicable'}}</td>
                <td rowspan="{{ $extensionCount }}">{{$capalog->CAPA_effectiveness_verified_by ? $capalog->CAPA_effectiveness_verified_by : '-'}}</td>    
          
        </tr>
        @endfor
                @endforeach
            </tbody>
        </table>
    </div>

    


    
    <footer>
        <table style ="    position:relative;
        top:95%;">
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
</html>
