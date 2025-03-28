<center><h3>praveen chandel</h3></center>
@extends('frontend.layout.main')
@section('container')
    {{-- ======================================
                CHANGE CONTROL LIST
    ======================================= --}}
    <div id="change-control-list">
        <div class="container-fluid">

            <div class="inner-block control-list">
                <div class="main-head">
                    <div>Praveen chandel</div>
                    <button onclick="window.print();return false;" class="button_theme1 new-doc-btn">Print</button>


                </div>
                <div class="group-input">
                                <label for="scope">Process</label>
                                <select id="scope" name="form">
                                    <option value="">All Records</option>
                                   
                                        <option value= ""></option>
                                   
                                </select>
                            </div>

                <div class="list">
                    <div class="control-table table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Reocrd No.</th>
                                    <th>Title</th>
                                    <th>Current Status</th>
                                    <th>Originator</th>
                                    <th>Date Opened</th>
                                    {{--  <th>Due Date</th>  --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                            
                                          
                              
                            <tbody id="searchTable">
                                @foreach ($hero as $datas)
                                    <tr>
                                        <td>{{ $datas->id }}</td>
                                        <td>{{ str_pad($datas->record, 5, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ $datas->short_description }}</td>
                                        <td>{{ $datas->status }}</td>
                                        <td>{{ $datas->originator }}</td>
                                        <td>{{ $datas->created_at }}</td>
                                        {{--  <td>{{ $datas->due_date }}</td>  --}}
                                        <td>
                                            <div class="action-btns">
                                                <a href=""><i
                                                        class="fa-solid fa-eye"></i></a>
                                                {{--  <a href=""><i
                                                            class="fa-solid fa-edit"></i></a>  --}}
                                            </div>



                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <table>
                             <!-- short description -->
                             <form action="{{route('check.save')}}" method="post">
                                @csrf
                             <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description">Short Description<span
                                                class="text-danger">*</span></label><span id="rchars">255</span>
                                        Characters remaining
                                        <input id="docname" type="text" name="short_description"
                                           
                                            value="" maxlength="255" required>
                                    </div>
                                    {{-- @error('short_description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror --}}
                                </div>
                              
                                                <!-- initiator -->
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator"><b>Initiator</b></label>
                                        {{-- <input type="hidden" value="{{ Auth::user()->name }}" name="initiator" id="initiator"> --}}
                                        <input disabled type="text" name="initiator" id="initiator"
                                            value="">
                                    </div>

                                </div> 
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number"><b>Record Number</b></label>
                                        <input  type="text" name="record_number"
                                            value="">
                                    </div>
                                    
                                </div>
                                <div class="group-input">
                                    <label for="audit-agenda-grid">
                                        Observation
                                        <button type="button" name="details" id="Details-add">+</button>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="Details-table">
                                            <thead>
                                                <tr>
                                                    <th style="width: 8%">Sr.No</th>
                                                    <th style="width: 80%">Observation</th>
                                                    <th style="width: 12%">Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td><input disabled type="text" name="observation[0][serial]"
                                                        value="1"></td>
                                                <td><input type="text" name="observation[0][non_compliance]"></td>
                                                <td><button type="text" class="removeRowBtn">Remove</button></td>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                <script>
                                        $(document).ready(function() {
                                            $('#Details-add').click(function(e) {
                                                function generateTableRow(serialNumber) {
                                                    var html = '';
                                                    html += '<tr>' +
                                                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                                                        '"></td>' +
                                                        '<td><input type="text" name="observation[' + serialNumber +
                                                        '][non_compliance]"></td>' +
                                                        '<td><button type="text" class="removeRowBtn" >Remove</button></td>' +
                                                        '</tr>';

                                                    return html;
                                                }

                                                var tableBody = $('#Details-table tbody');
                                                var rowCount = tableBody.children('tr').length;
                                                var newRow = generateTableRow(rowCount + 1);
                                                tableBody.append(newRow);
                                            });
                                        });
                                    </script>

                                <button class="btn-btn-danger">save</button>
                            </form>
                        </table>
                    </div>
                </div>
            </div>



        </div>
    </div>
@endsection
