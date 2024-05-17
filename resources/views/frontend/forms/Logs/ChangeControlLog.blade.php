

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
        .filter-item label {
            margin-right: 10px;
        }
    </style>
    <div id="rcms-desktop">

        <div class="process-groups">
            <div class="active" onclick="openTab('internal-audit', this)">Change Control Log </div>

        </div>


        <div class="main-content">
            <div class="container-fluid">
                <div class="process-tables-list">

                    <div class="process-table active" id="internal-audit">

                        <div class="">
                            <div class="d-flex align-items-center">
                                <div class="scope-bar ml-3">
                                    <button style="width: 70px;" class="print-btn btn btn-primary">Print</button>
                                </div>
                                <div class="flex-grow-2">
                                    <div class="filter-bar d-flex justify-content-between" >
                                        <div class="filter-item">
                                            <label for="process">Department</label>
                                            <select class="custom-select" id="process">
                                                <option value="all">All Records</option>
                                                <!-- Add other process options here -->
                                            </select>
                                        </div>
                                        <div class="filter-item">
                                            <label for="criteria">Status</label>
                                            <select class="custom-select" id="criteria">
                                                <option value="all">All Records</option>
                                                <!-- Add other criteria options here -->
                                            </select>
                                        </div>
                                        <div class="filter-item">
                                            <label for="division">Division</label>
                                            <select class="custom-select" id="division">
                                                <option value="all">All Records</option>
                                                <!-- Add other division options here -->
                                            </select>
                                        </div>
                                        <div class="filter-item">
                                            <label for="originator">Originator</label>
                                            <select class="custom-select" id="originator">
                                                <option value="all">All Records</option>
                                                <!-- Add other originator options here -->
                                            </select>
                                        </div>
                                        <div class="filter-item">
                                            <label for="datewise">Date-wise</label>
                                            <select class="custom-select" id="datewise">
                                                <option value="all">All Records</option>
                                                <!-- Add other date-wise options here -->
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-block" style="">
                            <div class="table-responsive" style="height: 73vh">
                                <table class="table table-bordered" style="width: 100%;">
                                    <tbody>
                                        <thead class="thead-dark">
                                            <tr>
                                                <th style="width: 5%;">Sr.No.</th>
                                                <th>Change Control No.</th>
                                                <th>Division</th>
                                                <th>Date of Initiation</th>
                                                <th>Initiator Name</th>
                                                <th>Department</th>
                                                <th>Description of Change Control</th>
                                                <th>Proposed Change </th>
                                                <th>Classification </th>
                                                <th>Approved / Reject </th>
                                                <th>No. of Extension </th>
                                                <th>Status </th>



                                            </tr>
                                        </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>2</td>
                                            <td>2</td>
                                            <td>2</td>
                                            <td>2</td>
                                            <td>2</td>
                                            <td>2</td>
                                            <td>2</td>
                                            <td>2</td>
                                            <td>2</td>
                                            <td>2</td>
                                            <td>2</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>3</td>
                                            <td>3</td>
                                            <td>3</td>
                                            <td>3</td>
                                            <td>3</td>
                                            <td>3</td>
                                            <td>3</td>
                                            <td>3</td>
                                            <td>3</td>
                                            <td>3</td>
                                            <td>3</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>4</td>
                                            <td>4</td>
                                            <td>4</td>
                                            <td>4</td>
                                            <td>4</td>
                                            <td>4</td>
                                            <td>4</td>
                                            <td>4</td>
                                            <td>4</td>
                                            <td>4</td>
                                            <td>4</td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>5</td>
                                            <td>5</td>
                                            <td>5</td>
                                            <td>5</td>
                                            <td>5</td>
                                            <td>5</td>
                                            <td>5</td>
                                            <td>5</td>
                                            <td>5</td>
                                            <td>5</td>
                                            <td>5</td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>6</td>
                                            <td>6</td>
                                            <td>6</td>
                                            <td>6</td>
                                            <td>6</td>
                                            <td>6</td>
                                            <td>6</td>
                                            <td>6</td>
                                            <td>6</td>
                                            <td>6</td>
                                            <td>6</td>
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
