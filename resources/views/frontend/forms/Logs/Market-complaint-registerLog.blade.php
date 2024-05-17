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
            margin-left: 13px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
              border: 1px solid lightgrey;
            padding: 8px;
            text-align: left;
        }

        th[colspan] {
            text-align: center;
        }
    </style>
    <div id="rcms-desktop">

        <div class="process-groups">
            <div class="active" onclick="openTab('internal-audit', this)">Market Complaint Log</div>
        </div>

        <div class="main-content">
            <div class="container-fluid">
                <div class="process-tables-list">
                    <div class="process-table active" id="internal-audit">
                        <div class="scope-bar">
                            <button style="width: 70px;" class="print-btn theme-btn-1">Print</button>
                        </div>
                        <div class="table-block" style="">
                            <div class="table-responsive" style="height: 73vh">
                                <table>
                                    <tr>
                                        <th rowspan="2">Sr. No.</th>
                                        <th rowspan="2">Complaint No.</th>
                                        <th rowspan="2">Date of receipt</th>
                                        <th colspan="4">Product Details</th>
                                        <th rowspan="2">Nature of complaint</th>
                                        <th rowspan="2">Category of complaint</th>
                                        <th rowspan="2">Details of Complaint</th>
                                        <th rowspan="2">Response / Report sent on (Date)</th>
                                    </tr>
                                    <tr>
                                        <th>Product Name & strength</th>
                                        <th>Batch No.</th>
                                        <th>Mfg. Date</th>
                                        <th>Exp. Date</th>
                                    </tr>
                                    <!-- Add data rows here -->
                                    <tr>
                                        <td>1</td>
                                        <td>001</td>
                                        <td>2024-05-01</td>
                                        <td>Product A</td>
                                        <td>12345</td>
                                        <td>2023-01-01</td>
                                        <td>2025-01-01</td>
                                        <td>Defective packaging</td>
                                        <td>Quality</td>
                                        <td>Packaging was damaged upon receipt</td>
                                        <td>2024-05-05</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>002</td>
                                        <td>2024-05-02</td>
                                        <td>Product B</td>
                                        <td>67890</td>
                                        <td>2023-02-01</td>
                                        <td>2025-02-01</td>
                                        <td>Color inconsistency</td>
                                        <td>Quality</td>
                                        <td>Product color did not match the description</td>
                                        <td>2024-05-06</td>
                                    </tr> <tr>
                                        <td>2</td>
                                        <td>002</td>
                                        <td>2024-05-02</td>
                                        <td>Product B</td>
                                        <td>67890</td>
                                        <td>2023-02-01</td>
                                        <td>2025-02-01</td>
                                        <td>Color inconsistency</td>
                                        <td>Quality</td>
                                        <td>Product color did not match the description</td>
                                        <td>2024-05-06</td>
                                    </tr> <tr>
                                        <td>2</td>
                                        <td>002</td>
                                        <td>2024-05-02</td>
                                        <td>Product B</td>
                                        <td>67890</td>
                                        <td>2023-02-01</td>
                                        <td>2025-02-01</td>
                                        <td>Color inconsistency</td>
                                        <td>Quality</td>
                                        <td>Product color did not match the description</td>
                                        <td>2024-05-06</td>
                                    </tr> <tr>
                                        <td>2</td>
                                        <td>002</td>
                                        <td>2024-05-02</td>
                                        <td>Product B</td>
                                        <td>67890</td>
                                        <td>2023-02-01</td>
                                        <td>2025-02-01</td>
                                        <td>Color inconsistency</td>
                                        <td>Quality</td>
                                        <td>Product color did not match the description</td>
                                        <td>2024-05-06</td>
                                    </tr>
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
