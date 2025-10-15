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

        /* Header Styling */
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
            margin-right: 180px
  
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

<body>
                @php
                    use Carbon\Carbon;
                @endphp
              
       <header>
        <table style="position:relative; top: 15px; padding:0;  ">
            <tr>
                <td class="w-100 head" style="font-size:15px;">
                   <strong>

                     CAPA Log Report 
                 </strong>
                </td>
                <td class="w-50" style="text-align: right;">
                    <div class="logo">
                        <img src="http://agio_pre_prod.test/user/images/agio.jpg" alt="Logo">
                    </div>
                </td>
            </tr>
        </table>

        {{-- <table style="position:relative; top: 15px; padding:0;  ">
            <tr>
                <td class="w-100 head" style="font-size:15px;">
                 <strong>

                     CAPA Log Report <br>
                 </strong>
                </td>
          
            </tr>
        </table> --}}
    </header>

    <!-- Table -->
    <table>
        <thead>
             <tr>
                                            <th style="width: 2px; background-color: #5c98e7" class="sortable" onclick="sortTable('id')">Sr. No.</th>
                                            <th style="background-color: #5c98e7; width: 10%;">Record No.</th>
                                            <th class="sortable" style="background-color: #5c98e7 " onclick="sortTable('id')">Capa No.</th>
                                            <th style="background-color: #5c98e7" class="sortable" onclick="sortTable('created_at')">Initiation Date</th>
                                            <!-- <th style="background-color: #5c98e7">Unique Id</th> -->
                                            <th style="background-color: #5c98e7" class="sortable" onclick="sortTable('Initiator_Group')">Division</th>
                                            <th style="background-color: #5c98e7" class="sortable" onclick="sortTable('Initiator_Group')">Department Name</th>
                                            <th style="background-color: #5c98e7">Short Description</th>
                                            <th  style="background-color: #5c98e7" class="sortable" onclick="sortTable('due_date')">Due Date</th>
                                            <th style="background-color: #5c98e7">Initiator</th>
                                            <th style="background-color: #5c98e7">Status</th>
                                            <th class="sortable" style="background-color: #5c98e7" onclick="sortTable('id')">Remark</th>
                                        </tr>
        </thead>
        
    </table>
    @foreach ($paginatedData as $pageIndex => $pageData)

    <div class="table-container" style = "margin:0; padding:0; width:100%" >
    <table>
            <tbody>
                @foreach ($pageData as $index => $doc)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    <!-- <a href="{{ route('capashow', $doc->id) }}" style="color:  rgb(2, 112, 116);" onmouseover="this.style.color='orange'" onmouseout="this.style.color='orange'">
               {{ $doc->division ? $doc->division->name : ' Not Applicable ' }}/CAPA/{{ date('Y') }}/{{ str_pad($doc->record, 4, '0', STR_PAD_LEFT) }}</a> -->
               <a href="{{ route('capashow', $doc->id) }}" target="_blank" style="color:rgb(2, 112, 116); font-weight: bold; font-size: 10px;">
                    @php
                        $nature = !empty($doc->capa) && count($doc->capa) > 0 
                            ? array_column($doc->capa->toArray(), 'changeControlNature')[0] 
                            : null;

                        $type = ($nature === 'Temporary') ? 'T' : (($nature === 'Permanent') ? 'P' : '-');
                    @endphp
                    MP/CAPA/25/{{ str_pad($doc->dashboard_unique_id, 4, '0', STR_PAD_LEFT) }} 
                </a>
               </td> 

                <td style=" width: 10%;"> 
                MP/CAPA{{ ($doc->CAPA) }}/{{ date('y') }}/{{ str_pad($index + 1, 4, '0', STR_PAD_LEFT) }}  
            </td>
                <td>
                    {{ $doc->intiation_date ? \Carbon\Carbon::parse($doc->intiation_date)->format('d-M-Y') : 'Not Applicable' }}
                </td>

                <!-- <td><a  href="{{ route('CC.show', $doc->id) }}" style="color: blue;"> -->
                            

                <td>{{ $doc->division ? $doc->division->name : ' Not Applicable ' }}</td>
                <td>{{ $doc->initiator_Group ?: ' Not Applicable ' }}</td>
                <td>{{ $doc->short_description ?: ' Not Applicable ' }}</td>
                <td>{{ $doc->due_date ? \Carbon\Carbon::parse($doc->due_date)->format('d-M-Y') : ' Not Applicable ' }}</td>
                <td>{{ $doc->initiator ? $doc->initiator->name : ' Not Applicable ' }}</td>
                <td>{{ $doc->status ?: ' Not Applicable ' }}</td>
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
                    <strong>Printed By:</strong> 
                    <td>{{ optional($doc->initiator)->name ?: 'Not Applicable' }}</td>
                </td>
                <td style="width: 33%; text-align: center;">
                <strong>Printed on:</strong> {{ date('d-M-Y h:i A') }}                </td>
                <td style="text-align: right;">Page {{ $pageIndex + 1 }} of {{ $totalPages }}</td>
            </tr>
        </table>
    </footer>


@if (!$loop->last)
            <div style="page-break-after: always;"></div>
        @endif
    @endforeach
</body>

</html>
