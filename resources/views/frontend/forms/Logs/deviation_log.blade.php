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
            ele.classList.add('active');
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
    </style>

    <div id="rcms-desktop" style="font-family: Arial, sans-serif; margin: 0; padding: 0;">
        <div class="process-groups" style="display: flex; gap: 10px; margin-bottom: 10px;">
            <div class="active" onclick="openTab('internal-audit', this)" style="cursor: pointer; padding: 10px; background-color: #007bff; color: white; border-radius: 5px;">Deviation Log</div>
        </div>
        <div class="main-content" style="background-color: #f8f9fa; padding: 20px; border-radius: 5px;">
            <div class="container-fluid">
                <div class="process-tables-list">
                    <div class="process-table active" id="internal-audit">
                        <div class="mt-1 mb-2 bg-white" style="height: 65px;display: flex;align-items: center;padding: 10px;border-radius: 5px;box-shadow: 2px 3px 10px 5px rgba(0, 0, 0, 0.1);">
                                <button style="width: 70px;" class="print-btn btn btn-primary">Print</button>
                               
                                <div class="flex-grow-2" style="flex: 1;">
                                    <div class="filter-bar" style="display: flex; flex-wrap: wrap; gap: 10px;">
                                    <div class="filter-item" style="flex: 1; min-width: 200px;">
                                             <table><th><label for="process" style="margin-right:20%; flex: 1; min-width: 200px;">Department</label>
                                                <select name="Initiator_Group" id="initiator_group" class="form-control">
                                                <option value="">Enter Your Selection Here</option>
                                                <option value="CQA">Corporate Quality Assurance</option>
                                                <option value="QAB">Quality Assurance Biopharma</option>
                                                <option value="CQC">Central Quality Control</option>
                                                <option value="MANU">Manufacturing</option>
                                                <option value="PSG">Plasma Sourcing Group</option>
                                                <option value="CS">Central Stores</option>
                                                <option value="ITG">Information Technology Group</option>
                                                <option value="MM">Molecular Medicine</option>
                                                <option value="CL">Central Laboratory</option>
                                                <option value="TT">Tech team</option>
                                                <option value="QA">Quality Assurance</option>
                                                <option value="QM">Quality Management</option>
                                                <option value="IA">IT Administration</option>
                                                <option value="ACC">Accounting</option>
                                                <option value="LOG">Logistics</option>
                                                <option value="SM">Senior Management</option>
                                                <option value="BA">Business Administration</option>
                                            </select>
                                        </div></th><th>
                                        <div class="filter-item" style="flex: 1; min-width: 200px;">
                                            <label for="criteria" style="margin-right: 10px;">Division</label>
                                            <select class="custom-select" id="division_id">
                                                <option value="null">Select Option</option>
                                                <option value="1">Corporate</option>
                                                <option value="2">Plant</option>
                                            </select>
                                        </div></th>
                                        
                                        <th><div class="filter-item">
                                            <label for="date_from_dev">Date From</label>
                                            <input type="date" class="custom-select" id="date_from_dev">
                                        </div>
                                       </th><th>
                                        <div class="filter-item">
                                            <label for="date_to_dev">Date To</label>
                                            <input type="date" class="custom-select" id="date_to_dev">
                                        </div></th><th>
                                        <div class="filter-item" style="flex: 1; min-width: 200px;">
                                            <label for="originator" style="margin-right: 10px;">Deviation Related to</label>
                                            <select class="custom-select" id="deviationRelate">
                                                <option value="null">Select Option</option>
                                                <option value="Facility">Facility</option>
                                                <option value="Equipment/Instrument">Instrument</option>
                                                <option value="Documentationerror">Documentation error</option>
                                                <option value="STP/ADS_instruction">STP/ADS instruction</option>
                                                <option value="Packaging&Labelling">Packaging & Labelling</option>
                                                <option value="Material_System">Material System</option>
                                                <option value="Laboratory_Instrument/System">Laboratory Instrument/System</option>
                                                <option value="Utility_System">Utility System</option>
                                                <option value="Computer_System">Computer System</option>
                                                <option value="Document">Document</option>
                                                <option value="Data integrity">Data integrity</option>
                                                <option value="SOP Instruction">SOP Instruction</option>
                                                <option value="BMR/ECR Instruction">BMR/ECR Instruction</option>
                                                <option value="Water System">Water System</option>
                                                <option value="Anyother(specify)">Anyother(specify)</option>
                                            </select>
                                        </div></th>
                                        <th>
                                            
                                        <div class="filter-item" style="flex: 1; min-width: 200px;">
                                            <label for="datewise">Select Period</label>
                                            <select class="custom-select" id="datewise">
                                                <option value="all">Select</option>
                                                <option value="all">Yearly</option>
                                                <option value="all">Quarterly</option>
                                                <option value="all">Mothly</option>

                                            </select>
                                        </div>
                                        </th>

                                    </table> 
                                    </div>
                               
                                </div>
                            </div>
                            
                        </div>

                        <div class="table-block" style="background-color: white; padding: 10px; border-radius: 5px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                            <div class="table-responsive" style="height: 300px;">
                                <table class="table table-bordered" style="min-width: 120%; overflow-x: auto;">
                                    <thead style="background-color: #cecece;">
                                        <tr>
                                            <th style="width: 5%;">Sr.No.</th>
                                            <th>Date of Initiation</th>
                                            <th>Deviation No.</th>
                                            <th>Description of Deviation</th>
                                            <th>Division</th>
                                            <th>Department</th>
                                            <th>Initial Deviation Category</th>
                                            <th>Deviation Related to</th>
                                            <th>No. of Extension</th>
                                            <th>Closing Date</th>
                                            <th>Due Date</th>
                                            <th>Closed by</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableData">
                                        @include('frontend.forms.Logs.comps.deviation_data')
                                    </tbody>
                                </table>

                                <div class="d-flex justify-content-center" style="margin-top: 10px;">
                                    <div class="spinner-border text-primary" role="status" id="spinner">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>



      <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.2/axios.min.js" integrity="sha512-JSCFHhKDilTRRXe9ak/FJ28dcpOJxzQaCd3Xg8MyF6XFjODhy/YMCM8HW0TFDckNHWUewW+kfvhin43hKtJxAw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        VirtualSelect.init({
            ele: '#Facility, #Group, #Audit, #Auditee ,#capa_related_record ,#classRoom_training'
        });

        $('#spinner').hide();

        const filterData = {
            departmentDeviation: null,
            division_idDeviation: null,
            deviationDate:null,
            date_fromDeviation: null,
            date_toDeviation: null


        }

        $('#initiator_group').change(function() {
            filterData.departmentDeviation = $(this).val();
            filterRecords()
        })

         // Division ID change event

          $('#division_id').change(function() {
            filterData.division_idDeviation = $(this).val();
            filterRecords();
         });

         //deviationRelate

         $('#deviationRelate').change(function() {
            filterData.audit_type = $(this).val();
            filterRecords();
         });

         
         $('#date_from_dev').change(function() {
        filterData.date_fromDeviation = $(this).val();
        filterRecords();
        });

        $('#date_to_dev').change(function() {
            filterData.date_toDeviation = $(this).val();
            filterRecords();
        });




        async function filterRecords()
        {
            $('#tableData').html('');
            $('#spinner').show();
            
            try {


                const postUrl = "{{ route('api.deviation.filter') }}";

                const res = await axios.post(postUrl, filterData);

                if (res.data.status == 'ok') {
                    $('#tableData').html(res.data.body);
                }

            } catch (err) {
                console.log('Error in filterRecords', err.message);
            }
            
            $('#spinner').hide();
        }

        
    </script>
@endsection
