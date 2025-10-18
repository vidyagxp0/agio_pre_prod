<!DOCTYPE html>
<html>

<head>
    <style>
        @page {
            margin: 20px;
        }

        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fa;
            color: #1f1515;
        }

        /* Container for table and header */
        .table-container {
            position: relative;
            top: 2%;
            padding: 2%;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            width: 98%;
            margin-left: 1%;
            margin-right: 1%;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        th, td {
            border: 1px solid #000; /* Black border */
            padding: 12px 15px;
            text-align: center;
            font-size: 14px;
            color: #000;
        }

        th {
            background-color: #929090;
            color: #fff;
            font-weight: bold;
            text-align: center;
        }

        td {
            background-color: #f9f9f9;
        }

        tr:nth-child(even) td {
            background-color: #f2f2f2;
        }

        footer {
            position: relative;
            padding: 20px 0;
            text-align: center;
            font-size: 12px;
            margin-top: 30px;
        }

        footer td {
            padding: 8px;
        }

        .footer-table td {
            padding-left: 15px;
            padding-right: 15px;
        }

        header {
            width: 100%;
            background-color: #fff;
            padding: 20px 0;
            border-bottom: 2px solid #e0e0e0;
        }

        header table {
            width: 100%;
            padding: 0 20px;
        }

        header .w-50 {
            width: 50%;
            text-align: left;
        }

        .logo img {
            max-width: 150px;
            max-height: 80px;
            margin-right: 180px;
        }

        .header-title {
            font-size: 22px;
            font-weight: bold;
            color: #000;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            th, td {
                font-size: 12px;
                padding: 8px;
            }

            .logo img {
                max-width: 120px;
            }

            .header-title {
                font-size: 18px;
            }
        }

        .page-number:before {
            content: "Page : " counter(page);
        }
    </style>
</head>
  <header>
        <table style="position:relative; top: 15px; padding:0;  ">
            <tr>
                <td class="w-100 head" style="font-size:20px;">
                  

                </td>
                <td class="w-50" style="text-align: right;">
                    <div class="logo">
                        <img src="https://agio_pre_prod.test/user/images/agio.jpg" alt="Logo">
                    </div>
                </td>
            </tr>
        </table>

        <table style="position:relative; top: 15px; padding:0;  ">
            <tr>
                <td class="w-100 head" style="font-size:15px;">
                  <strong>

                      Change Control Log Report <br>
                  </strong>
                </td>

            </tr>
        </table>
    </header>
<body>

    @php
        use Carbon\Carbon;
    @endphp

    @foreach ($paginatedData as $pageIndex => $pageData)
        
            <!-- Table Container -->
                <table>
                    <thead>
                       <tr>
                                        <th class="sortable" style="background-color: #5c98e7 ; width: 2%;" onclick="sortTable('id')">Sr. No.</th>
                                        <th class="sortable" style="background-color: #5c98e7; width: 10%;" onclick="sortTable('id')">Record No.</th>
                                        <th class="sortable" style="background-color: #5c98e7; width: 12%;" onclick="sortTable('id')">Change Control No.</th>
                                        <th class="sortable" style="background-color: #5c98e7" onclick="sortTable('id')">Initiator Department</th>
                                        <th class="sortable" style="background-color: #5c98e7" onclick="sortTable('id')">Date of Initiation</th>
                                        <th class="sortable" style="background-color: #5c98e7" onclick="sortTable('id')">Change Control Nature</th>
                                        <th class="sortable" style="background-color: #5c98e7" onclick="sortTable('id')">Short Description</th>
                                        <th class="sortable" style="background-color: #5c98e7" onclick="sortTable('id')">Accepted <br> / Rejected</th>
                                        <th class="sortable" style="background-color: #5c98e7" onclick="sortTable('id')">Approval <br> / Rejected Date</th>
                                        <th class="sortable" style="background-color: #5c98e7" onclick="sortTable('id')">Closure Date</th>
                                        <th class="sortable" style="background-color: #5c98e7" onclick="sortTable('id')">Due Date</th>
                                        <th class="sortable" style="background-color: #5c98e7" onclick="sortTable('id')">Review of <br> Implementation <br> On</th>
                           
                                    </th>
                                    <th class="sortable" style="background-color: #5c98e7" onclick="sortTable('id')">Remark</th>
                                </tr>
                    </thead>
                    <tbody>
                       @foreach ($pageData as $index => $doc)
 <tr>
        <td>{{ $index + 1 }}</td>
        <td>
        <a href="{{ route('CC.show', $doc->id) }}" target="_blank" style="color:rgb(2, 112, 116); font-weight: bold; font-size: 10px;">
            @php
                $nature = !empty($doc->cc_field) && count($doc->cc_field) > 0 
                    ? array_column($doc->cc_field->toArray(), 'changeControlNature')[0] 
                    : null;

                $type = ($nature === 'Temporary') ? 'T' : (($nature === 'Permanent') ? 'P' : 'N/A');
            @endphp
            MP/CC/{{ $type }}/25/{{ str_pad($doc->dashboard_unique_id, 4, '0', STR_PAD_LEFT) }} 
        </a>
</td>

        <td>
        @php
                $nature = !empty($doc->cc_field) && count($doc->cc_field) > 0 
                    ? array_column($doc->cc_field->toArray(), 'changeControlNature')[0] 
                    : null;

                $type = ($nature === 'Temporary') ? 'T' : (($nature === 'Permanent') ? 'P' : 'N/A');
            @endphp
                MP/CC/{{$type}}/{{ date('y') }}/{{ str_pad($index + 1, 4, '0', STR_PAD_LEFT) }}  {{-- Serial Number replace kiya --}}
         
        </td>
        <td>{{ Helpers::getFullDepartmentName($doc->Initiator_Group) ?: 'Data Not Yet Available' }}</td>
        <td>{{ $doc->intiation_date ? Carbon::parse($doc->intiation_date)->format('d-M-Y') : 'Data Not Yet Available' }}</td>
        <td>
            {{ $doc->cc_field && count($doc->cc_field) > 0 ? implode(', ', array_column($doc->cc_field->toArray(), 'changeControlNature')) : 'Data Not Yet Available' }}
        </td>
        <td>{{ $doc->short_description ?: 'Data Not Yet Available' }}</td>

        <td>
            @if($doc->approved_by)
                Approved
            @elseif ($doc->RA_review_completed_by)
                Rejected
            @else
               Not Yet Available
            @endif
        </td>

        <td>{{ $doc->approved_on ?: 'Data Not Yet Available' }}</td> 
        <td>{{ $doc->RA_review_completed_on ? Carbon::parse($doc->RA_review_completed_on)->format('d-M-Y') : 'Data Not Yet Available' }}</td>
        <td>
            @if (!empty($doc->due_date) && strtotime($doc->due_date) !== false)
                {{ \Carbon\Carbon::parse($doc->due_date)->format('d-M-Y') }}
            @else
                Data Not Yet Available
            @endif
        </td>
                <td>{{ $doc->closure_approved_on ? Carbon::parse($doc->closure_approved_on)->format('d-M-Y') : 'Data Not Yet Available' }}</td>
        <td>{{ $doc->submit_comment ?: 'Data Not Yet Available' }}</td>
    </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Footer -->
            <footer style="position: fixed; bottom: 0; left: 0; right: 0; background: #fff; border-top: 1px solid #000000; padding-top: 10px;">
                <table class="footer-table" style="width: 100%; text-align: center;">
                    <tr>
                        <td style="width: 33%; text-align: left;">
                            <strong>Printed By:</strong> {{ optional($doc->initiator)->name ?: 'Not Applicable' }}
                        </td>
                        <td style="width: 33%; text-align: center;">
                              <strong>Printed on:</strong> {{ date('d-M-Y H:I A') }}
                        </td>
                    </tr>
                </table>
            </footer>

            @if (!$loop->last)
                <div style="page-break-after: always;"></div>
            @endif
        </div>
    @endforeach

</body>

</html>
