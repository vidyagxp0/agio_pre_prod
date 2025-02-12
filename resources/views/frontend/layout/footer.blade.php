{{-- ======================================
            ADVANCED SEARCH MODAL
======================================= --}}
<div class="modal modal-lg fade" id="advanced-search">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Advanced Search</h4>
            </div>
            <form action="{{ url('advanceSearch') }}" method="get">
                @csrf
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="advanced-table">
                        <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th>Field</th>
                                    <th>Operator</th>
                                    <th>Value</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select class="select-option" name="field[]">
                                            <option value="document_name">Short Description</option>
                                            {{-- <option value="short_description">Short Description</option> --}}
                                            option value="short_description">Keywords</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="select-option" name="operator">
                                            <option value="contains">Contains</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="value[]" class="text-input">
                                    </td>
                                    <td>
                                        <button class="deleteBtn" onclick="deleteRow(this)">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" onclick="addRow()">Add Row</button>

                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit">Search</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div>
</div>




{{-- ======================================
                SCRIPT TAGS
======================================= --}}
<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.0/jquery-ui.min.js" integrity="sha512-MlEyuwT6VkRXExjj8CdBKNgd+e2H+aYZOCUaCrt9KRk6MlZDOs91V1yK22rwm8aCIsb5Ec1euL8f0g58RKT/Pg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js'></script>
<script src="{{ asset('user/js/index.js') }}"></script>
<script src="{{ asset('user/js/validate.js') }}"></script>
<script src="{{ asset('user/js/countryState.js') }}"></script>
{{-- @toastr_js @toastr_render @jquery --}}
@yield('footer_cdn')
<script>

    var users = @if(isset($users)) @json($users) @else [] @endif;
    var departments = @if(isset($departments)) @json($departments) @else [] @endif;

    function addRow() {
        var table = document.getElementById("myTable");
        var row = table.insertRow(-1);

        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);

        var select1 = document.createElement("select");
        select1.className = "select-option";
        select1.name = "field";
        var option1 = document.createElement("option");
        option1.text = "Document Name";
        var option2 = document.createElement("option");
        option2.text = "Short Description";
        select1.appendChild(option1);
        select1.appendChild(option2);
        cell1.appendChild(select1);

        var select2 = document.createElement("select");
        select2.className = "select-option";
        select2.name = "operator";
        var optionA = document.createElement("option");
        optionA.text = "Contains";
        select2.appendChild(optionA);
        cell2.appendChild(select2);

        var input = document.createElement("input");
        input.type = "text";
        input.name = "value[]";
        input.className = "text-input";
        cell3.appendChild(input);

        var deleteBtn = document.createElement("button");
        deleteBtn.className = "deleteBtn";
        deleteBtn.innerHTML = "Delete";
        deleteBtn.onclick = function() {
            deleteRow(this);
        };
        cell4.appendChild(deleteBtn);
    }

    function deleteRow(btn) {
        var row = btn.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }


    function addDistributionRetrieval(tableId) {
        let table = document.getElementById(tableId);
        let currentRowCount = table.rows.length;
        let newRow = table.insertRow(currentRowCount);
        newRow.setAttribute("id", "row" + currentRowCount);

        let cell1 = newRow.insertCell(0);
        cell1.innerHTML = currentRowCount;

        let cell2 = newRow.insertCell(1);
        cell2.innerHTML = `<textarea style="overflow: hidden;
    border: none; width: 10rem;" name="distribution[${currentRowCount}][document_title]"></textarea>`;

        let cell3 = newRow.insertCell(2);
        cell3.innerHTML = `<textarea style="overflow: hidden;
    border: none; width: 6rem;" type="text" name="distribution[${currentRowCount}][document_number]"></textarea>`;

        let cell4 = newRow.insertCell(3);
        cell4.innerHTML = `<textarea style="overflow: hidden;
    border: none; width: 6rem;" type="text" name="distribution[${currentRowCount}][document_printed_by]"></textarea>`;

        let cell5 = newRow.insertCell(4);
        cell5.innerHTML = `<textarea style="overflow: hidden;
    border: none; width: 6rem;" type="text" name="distribution[${currentRowCount}][document_printed_on]"> </textarea>`;

        let cell6 = newRow.insertCell(5);
        cell6.innerHTML = `<textarea style="overflow: hidden;
    border: none; width: 6rem;" type="text" name="distribution[${currentRowCount}][document_printed_copies]"> </textarea>`;

        let cell7 = newRow.insertCell(6);
        cell7.innerHTML = '<div class="group-input new-date-data-field mb-0"> <div class="input-date "><div class="calenderauditee"><input style="width: 6rem;" type="text" id="issuance_date' + currentRowCount +'" readonly placeholder="DD-MMM-YYYY" /><input style="width:4rem" type="date" name="distribution['+ currentRowCount +'][issuance_date]" class="hide-input" oninput="handleDateInput(this, `issuance_date' + currentRowCount +'`)" /></div></div></div>';

        let cell8 = newRow.insertCell(7)
        cell8.innerHTML = `<select style="
     width: 6rem;" id="select-state" placeholder="Select..."
            name="distribution[${currentRowCount}][issuance_to]">
            <option value='0'>-- Select --</option>
            ${users.map(user => `<option value="${user.id}">${user.name}</option>`).join('')}
        </select>`


        let cell9 = newRow. insertCell(8)
        cell9.innerHTML = `<select style="
    width: 6rem;" id="select-state" placeholder="Select..."
            name="distribution[${currentRowCount}][location]">
            <option value='0'>-- Select --</option>
            ${departments.map(department => `<option value="${department.id}">${department.name}</option>`).join(' ')}
        </select>`

        let cell10 = newRow.insertCell(9);
        cell10.innerHTML = `<textarea style="overflow: hidden;
    border: none; width: 6rem;" type="text" name="distribution[${currentRowCount}][issued_copies]"></textarea>`;

        let cell11 = newRow.insertCell(10);
        cell11.innerHTML = `<textarea style="overflow: hidden;
    border: none; width: 6rem;" type="text" name="distribution[${currentRowCount}][issued_reason]"></textarea>`;

        let cell12 = newRow.insertCell(11);
        cell12.innerHTML = '<div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"><input style=" width: 6rem;" type="text" id="retrieval_date' + currentRowCount +'" readonly placeholder="DD-MMM-YYYY" /><input style=" width: 4rem;" type="date" name="distribution['+currentRowCount+'][retrieval_date]" class="hide-input" oninput="handleDateInput(this, `retrieval_date' + currentRowCount +'`)" /></div></div></div>';

        let cell13 = newRow.insertCell(12)
        cell13.innerHTML = `<select style="
   width: 6rem;" id="select-state" placeholder="Select..."
            name="distribution[${currentRowCount}][retrieval_by]">
            <option value='0'>-- Select --</option>
            ${users.map(user => `<option value="${user.id}">${user.name}</option>`).join('')}
        </select>`

        let cell14 = newRow.insertCell(13)
        cell14.innerHTML = `<select style="
    width: 6rem;" id="select-state" placeholder="Select..."
            name="distribution[${currentRowCount}][retrieved_department]">
            <option value='0'>-- Select --</option>
            ${departments.map(department => `<option value="${department.id}">${department.name}</option>`).join(' ')}
        </select>`;

        let cell15 = newRow.insertCell(14);
        cell15.innerHTML = `<textarea style="overflow: hidden;
    border: none; width: 6rem;" type="text" name="distribution[${currentRowCount}][retrieved_copies]"></textarea>`;

        let cell16 = newRow.insertCell(15);
        cell16.innerHTML = `<textarea style="overflow: hidden;
    border: none; width: 6rem;" type="text" name="distribution[${currentRowCount}][retrieved_reason]"></textarea>`;

        let cell17 = newRow.insertCell(16);
        cell17.innerHTML = `<textarea style="overflow: hidden;
    border: none; width: 6rem;" type="text" name="distribution[${currentRowCount}][remark]"></textarea>`;

        var cell18 = newRow.insertCell(17);
        cell18.innerHTML = "<button class='removeTrainRow'>Remove</button>";

        cell18.appendChild(element18);

        for (let i = 1; i < currentRowCount; i++) {
            let row = table.rows[i];
            row.cells[0].innerHTML = i;
        }
    }




    const commentSections = $('.comment');
    commentSections.each(function() {
        const inputField = $(this).find('.input-field');
        const timestamp = $(this).find('.timestamp');
        const button = $(this).find('.button');

        button.on('click', function() {
            timestamp.show();
            inputField.show();
            button.hide();
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.filter-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function(e) {
                const targetId = e.target.dataset.target;
                const targetElement = document.getElementById(targetId);

                if (e.target.checked) {
                    targetElement.style.display = 'block';
                } else {
                    targetElement.style.display = 'none';
                }
            });
        });
    });


    $(document).ready(function() {
        $('#tms-all-block').show();
        $('input[type=radio][name=dash-tabs]').change(function() {
            $('input[type=radio][name=dash-tabs]').change(function() {
                if (this.checked) {
                    var target = $(this).data('target');
                    $('.tms-block').hide();
                    $('#' + target).show();
                    $('.tab-btn').removeClass('active');
                    $(this).closest('.tab-btn').addClass('active');
                }
            });
        });
    });


    $(document).ready(function() {



        $('#responsibilitybtnadd').click(function(e) {

            var html =
                '<div class="singleResponsibilityBlock"><div class="resrow row"><div class="col-10"><textarea name="responsibility[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subResponsibilityAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#responsibilitydiv').append(html);

        });

        // temperautr maping code script
        $('#ProtocolApproval_TemperMapbtnadd').click(function(e) {

        var html =
            '<div class="singleProtocolApproval_TemperMapBlock"><div class="resrow row"><div class="col-10"><textarea name="ProtocolApproval_TemperMap[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subProtocolApproval_TemperMapAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#ProtocolApproval_TemperMapdiv').append(html);

        });

        $('#Objective_TemperMapbtnadd').click(function(e) {

        var html =
            '<div class="singleObjective_TemperMapBlock"><div class="resrow row"><div class="col-10"><textarea name="Objective_TemperMap[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subObjective_TemperMapAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#Objective_TemperMapdiv').append(html);

        });

        $('#Scope_TemperMapbtnadd').click(function(e) {

        var html =
            '<div class="singleScope_TemperMapBlock"><div class="resrow row"><div class="col-10"><textarea name="Scope_TemperMap[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subScope_TemperMapAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#Scope_TemperMapdiv').append(html);

        });

        $('#AreaValidated_TemperMapbtnadd').click(function(e) {

        var html =
            '<div class="singleAreaValidated_TemperMapBlock"><div class="resrow row"><div class="col-10"><textarea name="AreaValidated_TemperMap[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subAreaValidated_TemperMapAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#AreaValidated_TemperMapdiv').append(html);

        });

        $('#ValidationTeamResponsibilities_TemperMapbtnadd').click(function(e) {

        var html =
            '<div class="singleValidationTeamResponsibilities_TemperMapBlock"><div class="resrow row"><div class="col-10"><textarea name="ValidationTeamResponsibilities_TemperMap[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subValidationTeamResponsibilities_TemperMapAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#ValidationTeamResponsibilities_TemperMapdiv').append(html);

        });


        $('#Reference_TemperMapbtnadd').click(function(e) {

        var html =
            '<div class="singleReference_TemperMapBlock"><div class="resrow row"><div class="col-10"><textarea name="Reference_TemperMap[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subReference_TemperMapAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#Reference_TemperMapdiv').append(html);

        });

        $('#DocumentFollowed_TemperMapbtnadd').click(function(e) {

        var html =
            '<div class="singleDocumentFollowed_TemperMapBlock"><div class="resrow row"><div class="col-10"><textarea name="DocumentFollowed_TemperMap[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subDocumentFollowed_TemperMapAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#DocumentFollowed_TemperMapdiv').append(html);

        });

        $('#StudyRationale_TemperMapbtnadd').click(function(e) {

        var html =
            '<div class="singleStudyRationale_TemperMapBlock"><div class="resrow row"><div class="col-10"><textarea name="StudyRationale_TemperMap[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subStudyRationale_TemperMapAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#StudyRationale_TemperMapdiv').append(html);

        });


        $('#Procedure_TemperMapbtnadd').click(function(e) {

        var html =
            '<div class="singleProcedure_TemperMapBlock"><div class="resrow row"><div class="col-10"><textarea name="Procedure_TemperMap[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subProcedure_TemperMapAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#Procedure_TemperMapdiv').append(html);

        });

        $('#CriteriaRevalidation_TemperMapbtnadd').click(function(e) {

        var html =
            '<div class="singleCriteriaRevalidation_TemperMapBlock"><div class="resrow row"><div class="col-10"><textarea name="CriteriaRevalidation_TemperMap[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subCriteriaRevalidation_TemperMapAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#CriteriaRevalidation_TemperMapdiv').append(html);

        });

        $('#MaterialDocumentRequired_TemperMapbtnadd').click(function(e) {

        var html =
            '<div class="singleMaterialDocumentRequired_TemperMapBlock"><div class="resrow row"><div class="col-10"><textarea name="MaterialDocumentRequired_TemperMap[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subMaterialDocumentRequired_TemperMapAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#MaterialDocumentRequired_TemperMapdiv').append(html);

        });

        $('#AcceptanceCriteria_TemperMapbtnadd').click(function(e) {

        var html =
            '<div class="singleAcceptanceCriteria_TemperMapBlock"><div class="resrow row"><div class="col-10"><textarea name="AcceptanceCriteria_TemperMap[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subAcceptanceCriteria_TemperMapAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#AcceptanceCriteria_TemperMapdiv').append(html);

        });

        $('#TypeofValidation_TemperMapbtnadd').click(function(e) {

        var html =
            '<div class="singleTypeofValidation_TemperMapBlock"><div class="resrow row"><div class="col-10"><textarea name="TypeofValidation_TemperMap[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subTypeofValidation_TemperMapAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#TypeofValidation_TemperMapdiv').append(html);

        });

        $('#ObservationResult_TemperMapbtnadd').click(function(e) {

        var html =
            '<div class="singleObservationResult_TemperMapBlock"><div class="resrow row"><div class="col-10"><textarea name="ObservationResult_TemperMap[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subObservationResult_TemperMapAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#ObservationResult_TemperMapdiv').append(html);

        });

        $('#Abbreviations_TemperMapbtnadd').click(function(e) {

        var html =
            '<div class="singleAbbreviations_TemperMapBlock"><div class="resrow row"><div class="col-10"><textarea name="Abbreviations_TemperMap[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subAbbreviations_TemperMapAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#Abbreviations_TemperMapdiv').append(html);

        });


        $('#DeviationAny_TemperMapbtnadd').click(function(e) {

        var html =
            '<div class="singleDeviationAny_TemperMapBlock"><div class="resrow row"><div class="col-10"><textarea name="DeviationAny_TemperMap[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subDeviationAny_TemperMapAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#DeviationAny_TemperMapdiv').append(html);

        });

        $('#ChangeControl_TemperMapbtnadd').click(function(e) {

        var html =
            '<div class="singleChangeControl_TemperMapBlock"><div class="resrow row"><div class="col-10"><textarea name="ChangeControl_TemperMap[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subChangeControl_TemperMapAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#ChangeControl_TemperMapdiv').append(html);

        });

        $('#Summary_TemperMapbtnadd').click(function(e) {

        var html =
            '<div class="singleSummary_TemperMapBlock"><div class="resrow row"><div class="col-10"><textarea name="Summary_TemperMap[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subSummary_TemperMapAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#Summary_TemperMapdiv').append(html);

        });

        $('#Conclusion_TemperMapbtnadd').click(function(e) {

        var html =
            '<div class="singleConclusion_TemperMapBlock"><div class="resrow row"><div class="col-10"><textarea name="Conclusion_TemperMap[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subConclusion_TemperMapAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#Conclusion_TemperMapdiv').append(html);

        });

        $('#AttachmentList_TemperMapbtnadd').click(function(e) {

        var html =
            '<div class="singleAttachmentList_TemperMapBlock"><div class="resrow row"><div class="col-10"><textarea name="AttachmentList_TemperMap[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subAttachmentList_TemperMapAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#AttachmentList_TemperMapdiv').append(html);

        });

        $('#PostApproval_TemperMapbtnadd').click(function(e) {

        var html =
            '<div class="singlePostApproval_TemperMapBlock"><div class="resrow row"><div class="col-10"><textarea name="PostApproval_TemperMap[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subPostApproval_TemperMapAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#PostApproval_TemperMapdiv').append(html);

        });

        // hold time  study report

        $('#Purpose_HoTiStRebtnadd').click(function(e) {

        var html =
            '<div class="singlePurpose_HoTiStReBlock"><div class="resrow row"><div class="col-10"><textarea name="Purpose_HoTiStRe[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subPurpose_HoTiStReAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#Purpose_HoTiStRediv').append(html);

        });

        $('#Scope_HoTiStRebtnadd').click(function(e) {

        var html =
            '<div class="singleScope_HoTiStReBlock"><div class="resrow row"><div class="col-10"><textarea name="Scope_HoTiStRe[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subScope_HoTiStReAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#Scope_HoTiStRediv').append(html);

        });

        $('#BatchDetails_HoTiStRebtnadd').click(function(e) {

        var html =
            '<div class="singleBatchDetails_HoTiStReBlock"><div class="resrow row"><div class="col-10"><textarea name="BatchDetails_HoTiStRe[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subBatchDetails_HoTiStReAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#BatchDetails_HoTiStRediv').append(html);

        });

        $('#ReferenceDocument_HoTiStRebtnadd').click(function(e) {

        var html =
            '<div class="singleReferenceDocument_HoTiStReBlock"><div class="resrow row"><div class="col-10"><textarea name="ReferenceDocument_HoTiStRe[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subReferenceDocument_HoTiStReAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#ReferenceDocument_HoTiStRediv').append(html);

        });

        $('#ResultBulkStage_HoTiStRebtnadd').click(function(e) {

        var html =
            '<div class="singleResultBulkStage_HoTiStReBlock"><div class="resrow row"><div class="col-10"><textarea name="ResultBulkStage_HoTiStRe[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subResultBulkStage_HoTiStReAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#ResultBulkStage_HoTiStRediv').append(html);

        });

        $('#DeviationIfAny_HoTiStRebtnadd').click(function(e) {

        var html =
            '<div class="singleDeviationIfAny_HoTiStReBlock"><div class="resrow row"><div class="col-10"><textarea name="DeviationIfAny_HoTiStRe[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subDeviationIfAny_HoTiStReAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#DeviationIfAny_HoTiStRediv').append(html);

        });

        $('#Summary_HoTiStRebtnadd').click(function(e) {

        var html =
            '<div class="singleSummary_HoTiStReBlock"><div class="resrow row"><div class="col-10"><textarea name="Summary_HoTiStRe[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subSummary_HoTiStReAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#Summary_HoTiStRediv').append(html);

        });

        $('#Conclusion_HoTiStRebtnadd').click(function(e) {

        var html =
            '<div class="singleConclusion_HoTiStReBlock"><div class="resrow row"><div class="col-10"><textarea name="Conclusion_HoTiStRe[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subConclusion_HoTiStReAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#Conclusion_HoTiStRediv').append(html);

        });

        $('#ReportApproval_HoTiStRebtnadd').click(function(e) {

        var html =
            '<div class="singleReportApproval_HoTiStReBlock"><div class="resrow row"><div class="col-10"><textarea name="ReportApproval_HoTiStRe[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subReportApproval_HoTiStReAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#ReportApproval_HoTiStRediv').append(html);

        });







        $('#accountabilitybtnadd').click(function(e) {

            var html =
                '<div class="singleAccountabilityBlock"><div class="resrow row"><div class="col-10"><textarea name="accountability[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subAccountabilityAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#accountabilitydiv').append(html);

        });

        // Process Validation Protocol
        $('#responsibilityprvpbtnadd').click(function(e) {

            var html =
                '<div class="singleResponsibilityPrvpBlock"><div class="resrow row"><div class="col-10"><textarea name="responsibilityprvp[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subResponsibilityprvpAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#responsibilityprvpdiv').append(html);

        });

        $('#accountabilityprvpbtnadd').click(function(e) {

            var html =
                '<div class="singleAccountabilityPrvpBlock"><div class="resrow row"><div class="col-10"><textarea name="prvp_rawmaterial[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subAccountabilityprvpAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#accountabilityprvpdiv').append(html);

        });

        $('#referencesprvpbtadd').click(function(e) {

            var html =
                '<div class="singleReferencesPrvpBlock"><div class="resrow row"><div class="col-10"><textarea name="pripackmaterial[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subReferencesPrvpAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#referencesprvpdiv').append(html);

        });


        $('#abbreviationprvpbtnadd').click(function(e) {

            var html =
                '<div class="singleAbbreviationPrvpBlock"><div class="resrow row"><div class="col-10"><textarea name="equipCaliQuali[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subAbbreviationPrvpAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#abbreviationprvpdiv').append(html);

        });

        $('#DefinitionPrvpbtnadd').click(function(e) {

            var html =
                '<div class="singleDefinitionPrvpBlock"><div class="resrow row"><div class="col-10"><textarea name="rationale_critical[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subDefinitionPrvpAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#definitionprvpdiv').append(html);

        });

        $('#materialsgeneralbtnadd').click(function(e) {

            var html =
                '<div class="singleMaterialGeneralBlock"><div class="resrow row"><div class="col-10"><textarea name="general_instrument[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subMaterialsGenAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#materialsGeneraldiv').append(html);

        });


        $('#processflowbtnadd').click(function(e) {

            var html =
                '<div class="singleProcessFlowBlock"><div class="resrow row"><div class="col-10"><textarea name="process_flow[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subProcessFlowAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#processFlowdiv').append(html);

        });

        $('#diagrammaticbtnadd').click(function(e) {
            var html =
                '<div class="singleDiagrammaticBlock"><div class="resrow row"><div class="col-10"><textarea name="diagrammatic[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subDiagrammaticAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#diagrammaticdiv').append(html);
        });

        $('#criticalprocessbtnadd').click(function(e) {
            var html =
                '<div class="singleCriticalBlock"><div class="resrow row"><div class="col-10"><textarea name="critical_process[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subCriticalAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#criticaldiv').append(html);
        });

        $('#productacceptancebtnadd').click(function(e) {
            var html =
                '<div class="singleProductAccpBlock"><div class="resrow row"><div class="col-10"><textarea name="product_acceptance[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subProductAccpAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#productaccpdiv').append(html);
        });

        $('#cleaningvalibtnadd').click(function(e) {
            var html =
                '<div class="singleCleaningValiBlock"><div class="resrow row"><div class="col-10"><textarea name="cleaning_validation[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subCleaningValiAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#cleaningvalidiv').append(html);
        });

        $('#stabilitystudybtnadd').click(function(e) {
            var html =
                '<div class="singleStabilityStudyBlock"><div class="resrow row"><div class="col-10"><textarea name="stability_study[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subStabilityAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#stabilitystudydiv').append(html);
        });

        $('#deviationbtnadd').click(function(e) {
            var html =
                '<div class="singleDeviationBlock"><div class="resrow row"><div class="col-10"><textarea name="deviation[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subDeviationAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#deviationdiv').append(html);
        });

        $('#changecontrolbtnadd').click(function(e) {
            var html =
                '<div class="singleChangeControlBlock"><div class="resrow row"><div class="col-10"><textarea name="change_control[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subChangeControlAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#changecontroldiv').append(html);
        });

        $('#summaryprvpbtnadd').click(function(e) {
            var html =
                '<div class="singleSummaryBlock"><div class="resrow row"><div class="col-10"><textarea name="summary_prvp[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subSummaryPrvpAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#summaryprvpdiv').append(html);
        });

        $('#conclusionprvpbtnadd').click(function(e) {
            var html =
                '<div class="singleConclusionBlock"><div class="resrow row"><div class="col-10"><textarea name="conclusion_prvp[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subConclusionPrvpAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#conclusionprvpdiv').append(html);
        });

        $('#trainingprvpbtnadd').click(function(e) {
            var html =
                '<div class="singleTrainingBlock"><div class="resrow row"><div class="col-10"><textarea name="training_prvp[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subTrainingPrvpAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#trainingprvpdiv').append(html);
        });

        $('#abbreviationbtnadd').click(function(e) {

            var html =
                '<div class="singleAbbreviationBlock"><div class="resrow row"><div class="col-10"><textarea name="abbreviation[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subAbbreviationAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#abbreviationdiv').append(html);

        });

       

        $(document).on('click', '.abbreviationbtnRemove', function(e) {
            e.preventDefault();
            $(this).closest('div.row').remove();
        })


        //ashish code 



        $('#purpose_pvrbtnadd').click(function(e) {

    var html =
        '<div class="singlepurpose_pvrBlock"><div class="resrow row"><div class="col-10"><textarea name="purpose_pvr[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subpurpose_pvrAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#purpose_pvrdiv').append(html);

    });


    $('#scope_pvrbtnadd').click(function(e) {

    var html =
        '<div class="singlescope_pvrBlock"><div class="resrow row"><div class="col-10"><textarea name="scope_pvr[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subscope_pvrAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#scope_pvrdiv').append(html);

    });




    $('#batchdetail_pvrbtnadd').click(function(e) {

        var html =
            '<div class="singlebatchdetail_pvrBlock"><div class="resrow row"><div class="col-10"><textarea name="batchdetail_pvr[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subbatchdetail_pvrAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#batchdetail_pvrdiv').append(html);

        });

        $('#refrence_document_pvrbtnadd').click(function(e) {

            var html =
                '<div class="singlerefrence_document_pvrBlock"><div class="resrow row"><div class="col-10"><textarea name="refrence_document_pvr[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subrefrence_document_pvrAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#refrence_document_pvrdiv').append(html);

            });



    $('#refrence_documentbtnadd').click(function(e) {

        var html =
            '<div class="singlerefrence_documentBlock"><div class="resrow row"><div class="col-10"><textarea name="refrence_document[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subrefrence_documentAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#refrence_documentdiv').append(html);

        });


        
    $('#active_raw_material_pvrbtnadd').click(function(e) {

    var html =
    '<div class="singleactive_raw_material_pvrBlock"><div class="resrow row"><div class="col-10"><textarea name="active_raw_material_pvr[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subactive_raw_material_pvrAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#active_raw_material_pvrdiv').append(html);

    });


                    
    $('#primary_packingmaterial_pvrbtnadd').click(function(e) {

    var html =
    '<div class="singleprimary_packingmaterial_pvrBlock"><div class="resrow row"><div class="col-10"><textarea name="primary_packingmaterial_pvr[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subprimary_packingmaterial_pvrAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#primary_packingmaterial_pvrdiv').append(html);

    });


    $('#used_equipment_calibration_pvrbtnadd').click(function(e) {

    var html =
    '<div class="singleused_equipment_calibration_pvrBlock"><div class="resrow row"><div class="col-10"><textarea name="used_equipment_calibration_pvr[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subused_equipment_calibration_pvrAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#used_equipment_calibration_pvrdiv').append(html);

    });


    $('#result_of_intermediate_pvrbtnadd').click(function(e) {

    var html =
    '<div class="singleresult_of_intermediate_pvrBlock"><div class="resrow row"><div class="col-10"><textarea name="result_of_intermediate_pvr[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subresult_of_intermediate_pvrAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#result_of_intermediate_pvrdiv').append(html);

    });


    $('#result_of_finished_product_pvrbtnadd').click(function(e) {

    var html =
    '<div class="singleresult_of_finished_product_pvrBlock"><div class="resrow row"><div class="col-10"><textarea name="result_of_finished_product_pvr[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subresult_of_finished_product_pvrAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#result_of_finished_product_pvrdiv').append(html);

    });



    $('#result_of_packing_finished_pvrbtnadd').click(function(e) {

    var html =
    '<div class="singleresult_of_packing_finished_pvrBlock"><div class="resrow row"><div class="col-10"><textarea name="result_of_packing_finished_pvr[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subresult_of_packing_finished_pvrAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#result_of_packing_finished_pvrdiv').append(html);

    });



    $('#criticalprocess_parameter_pvrbtnadd').click(function(e) {

    var html =
    '<div class="singlecriticalprocess_parameter_pvrBlock"><div class="resrow row"><div class="col-10"><textarea name="criticalprocess_parameter_pvr[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subcriticalprocess_parameter_pvrAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#criticalprocess_parameter_pvrdiv').append(html);

    });




    $('#yield_at_various_stage_pvrbtnadd').click(function(e) {

    var html =
    '<div class="singleyield_at_various_stage_pvrBlock"><div class="resrow row"><div class="col-10"><textarea name="yield_at_various_stage_pvr[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subyield_at_various_stage_pvrAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#yield_at_various_stage_pvrdiv').append(html);

    });



    $('#hold_time_study_pvrbtnadd').click(function(e) {

    var html =
    '<div class="singlehold_time_study_pvrBlock"><div class="resrow row"><div class="col-10"><textarea name="hold_time_study_pvr[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subhold_time_study_pvrAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#hold_time_study_pvrdiv').append(html);

    });



    $('#cleaningvalidation_pvrbtnadd').click(function(e) {

    var html =
    '<div class="singlecleaningvalidation_pvrBlock"><div class="resrow row"><div class="col-10"><textarea name="cleaningvalidation_pvr[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subcleaningvalidation_pvrAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#cleaningvalidation_pvrdiv').append(html);

    });



    $('#stability_study_pvrbtnadd').click(function(e) {

        var html =
        '<div class="singlestability_study_pvrBlock"><div class="resrow row"><div class="col-10"><textarea name="stability_study_pvr[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark substability_study_pvrAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#stability_study_pvrdiv').append(html);

        });



        $('#deviation_if_any_pvrbtnadd').click(function(e) {

        var html =
        '<div class="singledeviation_if_any_pvrBlock"><div class="resrow row"><div class="col-10"><textarea name="deviation_if_any_pvr[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subdeviation_if_any_pvrAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#deviation_if_any_pvrdiv').append(html);

        });



        $('#changecontrol_pvrbtnadd').click(function(e) {

        var html =
        '<div class="singlechangecontrol_pvrBlock"><div class="resrow row"><div class="col-10"><textarea name="changecontrol_pvr[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subchangecontrol_pvrAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#changecontrol_pvrdiv').append(html);

        });




        $('#summary_pvrbtnadd').click(function(e) {

        var html =
        '<div class="singlesummary_pvrBlock"><div class="resrow row"><div class="col-10"><textarea name="summary_pvr[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subsummary_pvrAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#summary_pvrdiv').append(html);

        });



        $('#conclusion_pvrbtnadd').click(function(e) {

        var html =
        '<div class="singleconclusion_pvrBlock"><div class="resrow row"><div class="col-10"><textarea name="conclusion_pvr[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subconclusion_pvrAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#conclusion_pvrdiv').append(html);

        });




        $('#proposed_parameter_upcoming_batch_pvrbtnadd').click(function(e) {

        var html =
        '<div class="singleproposed_parameter_upcoming_batch_pvrBlock"><div class="resrow row"><div class="col-10"><textarea name="proposed_parameter_upcoming_batch_pvr[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subproposed_parameter_upcoming_batch_pvrAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#proposed_parameter_upcoming_batch_pvrdiv').append(html);

        });




        $('#report_approval_pvrbtnadd').click(function(e) {

        var html =
        '<div class="singlereport_approval_pvrBlock"><div class="resrow row"><div class="col-10"><textarea name="report_approval_pvr[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subreport_approval_pvrAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#report_approval_pvrdiv').append(html);

        });





        $('#Definitionbtnadd').click(function(e) {

            var html =
                '<div class="singleDefinitionBlock"><div class="resrow row"><div class="col-10"><textarea name="defination[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subDefinitionAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#definitiondiv').append(html);

        });
        

        

        $('#responsibilityhtpsbtnadd').click(function(e) {

           var html =
               '<div class="ResponsibilityBlock"><div class="resrow row"><div class="col-10"><textarea name="htsp_responsibility[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subresponsibilityhtpsAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

         $('#responsibilityhtpsdiv').append(html);

        });


        $('#Specificationsbtnadd').click(function(e) {

              var html =
            '<div class="SpecificationsBlock"><div class="resrow row"><div class="col-10"><textarea name="htsp_specifications[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subSpecificationsAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

         $('#Specificationsdiv').append(html);

       });


        $('#Samplinghtpsbtnadd').click(function(e) {

             var html =
               '<div class="SamplinghtpsBlock"><div class="resrow row"><div class="col-10"><textarea name="htsp_sampling_analysis[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subSamplinghtpsAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

                 $('#Samplinghtpsdiv').append(html);

                });

        $('#Environmentalhtspbtnadd').click(function(e) {

              var html =
                 '<div class="EnvironmentalhtspBlock"><div class="resrow row"><div class="col-10"><textarea name="htsp_environmental_conditions[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subEnvironmentalhtspAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

           $('#Environmentalhtspdiv').append(html);

        });

          $('#Samplehtpsbtnadd').click(function(e) {

                  var html =
                '<div class="SamplehtpsBlock"><div class="resrow row"><div class="col-10"><textarea name="htsp_sample_quantity_calculation[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subSamplehtpsAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

               $('#Samplehtpsdiv').append(html);

        });

          $('#Deviationhtpsbtnadd').click(function(e) {

         var html =
       '<div class="DeviationhtpsBlock"><div class="resrow row"><div class="col-10"><textarea name="htsp_deviation[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subDeviationhtpsAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#Deviationhtpsdiv').append(html);

      });

      $('#Summaryhtpsbtnadd').click(function(e) {

            var html =
          '<div class="SummaryhtpsBlock"><div class="resrow row"><div class="col-10"><textarea name="htsp_summary[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subSummaryhtpsAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

         $('#Summaryhtpsdiv').append(html);

      });

     $('#Conclusionhtpsbtnadd').click(function(e) {

        var html =
       '<div class="ConclusionhtpsBlock"><div class="resrow row"><div class="col-10"><textarea name="htsp_conclusion[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subConclusionhtpseAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

       $('#Conclusionhtpsdiv').append(html);

      });

      $('#reasonforvalidationpvpbtnadd').click(function(e) {

        var html =
            '<div class="reasonforvalidationpvpBlock"><div class="resrow row"><div class="col-10"><textarea name="reasonfor_validationpvp[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subreasonforvalidationpvpAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#reasonforvalidationpvpdiv').append(html);

        });


                $('#responsibilitypvpbtnadd').click(function(e) {

        var html =
            '<div class="responsibilitypvpBlock"><div class="resrow row"><div class="col-10"><textarea name="pvp_responsibility[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subresponsibilitypvpAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#responsibilitypvpdiv').append(html);

        });

        $('#validationpvpbtnadd').click(function(e) {

        var html =
            '<div class="validationpvpBlock"><div class="resrow row"><div class="col-10"><textarea name="pvp_validationpvp[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subvalidationpvpAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#validationpvpdiv').append(html);

        });

        $('#descriptionsoppvpbtnadd').click(function(e) {

        var html =
            '<div class="descriptionsoppvpBlock"><div class="resrow row"><div class="col-10"><textarea name="descriptionsop_pvp[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subdescriptionsoppvpAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#descriptionsoppvpdiv').append(html);

        });

        $('#packingmaterialpvpbtnadd').click(function(e) {

        var html =
            '<div class="packingmaterialpvpBlock"><div class="resrow row"><div class="col-10"><textarea name="packingmaterial_pvp[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subpackingmaterialpvpAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#packingmaterialpvpdiv').append(html);

        });

        $('#equipmentpvpbtnadd').click(function(e) {

        var html =
            '<div class="equipmentpvpBlock"><div class="resrow row"><div class="col-10"><textarea name="equipment_pvp[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subequipmentpvpAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#equipmentpvpdiv').append(html);

        });

        $('#rationalepvpbtnadd').click(function(e) {

        var html =
            '<div class="rationalepvpBlock"><div class="resrow row"><div class="col-10"><textarea name="rationale_pvp[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subrationalepvpAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#rationalepvpdiv').append(html);

        });

        $('#samplingpvpbtnadd').click(function(e) {

        var html =
            '<div class="samplingpvpBlock"><div class="resrow row"><div class="col-10"><textarea name="sampling_pvp[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subsamplingpvpAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#samplingpvpdiv').append(html);

        });

        $('#Criticalpvpbtnadd').click(function(e) {

        var html =
            '<div class="CriticalpvpBlock"><div class="resrow row"><div class="col-10"><textarea name="critical_pvp[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subCriticalpvpAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#Criticalpvpdiv').append(html);

        });

        $('#ProductAcceptancepvpbtnadd').click(function(e) {

        var html =
            '<div class="ProductAcceptancepvpBlock"><div class="resrow row"><div class="col-10"><textarea name="product_acceptancepvp[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subProductAcceptancepvpAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#ProductAcceptancepvpdiv').append(html);

        });

        $('#Holdtimepvpbtnadd').click(function(e) {

        var html =
            '<div class="HoldtimepvpBlock"><div class="resrow row"><div class="col-10"><textarea name="Holdtime_pvp[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subHoldtimepvpAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#Holdtimepvpdiv').append(html);

        });

        $('#Cleaningvalidationpvpbtnadd').click(function(e) {

        var html =
            '<div class="CleaningvalidationpvpBlock"><div class="resrow row"><div class="col-10"><textarea name="cleaning_validationpvp[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subCleaningvalidationpvpAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#Cleaningvalidationpvpdiv').append(html);

        });

        $('#Stabilitystudypvpbtnadd').click(function(e) {

        var html =
            '<div class="StabilitystudypvpBlock"><div class="resrow row"><div class="col-10"><textarea name="Stability_studypvp[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subStabilitystudypvpAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#Stabilitystudypvpdiv').append(html);

        });

        $('#Deviationpvpbtnadd').click(function(e) {

        var html =
            '<div class="htspdescriptionBlock"><div class="resrow row"><div class="col-10"><textarea name="htsp_description_of_sop[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subhtspdescriptionAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#htspdescriptiondiv').append(html);

        });

        $('#Deviationpvpbtnadd').click(function(e) {

        var html =
            '<div class="DeviationpvpBlock"><div class="resrow row"><div class="col-10"><textarea name="Deviation_pvp[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subDeviationpvpAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#Deviationpvpdiv').append(html);

        });




        $('#Changecontrolpvpbtnadd').click(function(e) {

        var html =
            '<div class="ChangecontrolpvpBlock"><div class="resrow row"><div class="col-10"><textarea name="Change_controlpvp[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subChangecontrolpvpAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#Changecontrolpvpdiv').append(html);

        });



        $('#Summarypvpbtnadd').click(function(e) {

        var html =
            '<div class="SummarypvpBlock"><div class="resrow row"><div class="col-10"><textarea name="Summary_pvp[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subSummarypvpAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#Summarypvpdiv').append(html);

        });


        $('#Conclusionpvpbtnadd').click(function(e) {

        var html =
            '<div class="ConclusionpvpBlock"><div class="resrow row"><div class="col-10"><textarea name="Conclusion_pvp[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subConclusionpvpAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#Conclusionpvpdiv').append(html);

        });

        $('#htspdescriptionbtnadd').click(function(e) {

          var html =
              '<div class="htspdescriptionBlock"><div class="resrow row"><div class="col-10"><textarea name="htsp_description_of_sop[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subhtspdescriptionAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#htspdescriptiondiv').append(html);

        });

        $('#objective_cvpdbtnadd').click(function(e) {

var html =
'<div class="singleobjective_cvpdBlock"><div class="resrow row"><div class="col-10"><textarea name="objective_cvpd[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subobjective_cvpdAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

$('#objective_cvpddiv').append(html);

});



$('#scope_cvpdbtnadd').click(function(e) {

var html =
'<div class="singlescope_cvpdBlock"><div class="resrow row"><div class="col-10"><textarea name="scope_cvpd[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subscope_cvpdAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

$('#scope_cvpddiv').append(html);

});


$('#purpose_cvpdbtnadd').click(function(e) {

    var html =
    '<div class="singlepurpose_cvpdBlock"><div class="resrow row"><div class="col-10"><textarea name="purpose_cvpd[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subpurpose_cvpdAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#purpose_cvpddiv').append(html);

    });


    $('#responsibilities_cvpdbtnadd').click(function(e) {

    var html =
    '<div class="singleresponsibilities_cvpdBlock"><div class="resrow row"><div class="col-10"><textarea name="responsibilities_cvpd[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subresponsibilities_cvpdAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#responsibilities_cvpddiv').append(html);

    });


    $('#oscope_cvpdbtnadd').click(function(e) {

    var html =
    '<div class="singleoscope_cvpdBlock"><div class="resrow row"><div class="col-10"><textarea name="oscope_cvpd[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark suboscope_cvpdAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#oscope_cvpddiv').append(html);

    });


    $('#identification_sensitive_product_contamination_cvpdbtnadd').click(function(e) {

    var html =
    '<div class="singleidentification_sensitive_product_contamination_cvpdBlock"><div class="resrow row"><div class="col-10"><textarea name="identification_sensitive_product_contamination_cvpd[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subidentification_sensitive_product_contamination_cvpdAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#identification_sensitive_product_contamination_cvpddiv').append(html);

    });

    $('#matrix_worstcase_approach_cvpdbtnadd').click(function(e) {

    var html =
    '<div class="singlematrix_worstcase_approach_cvpdBlock"><div class="resrow row"><div class="col-10"><textarea name="matrix_worstcase_approach_cvpd[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark submatrix_worstcase_approach_cvpdAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#matrix_worstcase_approach_cvpddiv').append(html);

    });


    $('#acceptance_criteria_cvpdbtnadd').click(function(e) {

    var html =
    '<div class="singleacceptance_criteria_cvpdBlock"><div class="resrow row"><div class="col-10"><textarea name="acceptance_criteria_cvpd[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subacceptance_criteria_cvpdAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#acceptance_criteria_cvpddiv').append(html);

    });

    $('#list_equipment_internal_surface_cvpdbtnadd').click(function(e) {

    var html =
    '<div class="singlelist_equipment_internal_surface_cvpdBlock"><div class="resrow row"><div class="col-10"><textarea name="list_equipment_internal_surface_cvpd[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark sublist_equipment_internal_surface_cvpdAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#list_equipment_internal_surface_cvpddiv').append(html);

    });

    $('#identification_clean_surfaces_cvpdbtnadd').click(function(e) {

    var html =
    '<div class="singleidentification_clean_surfaces_cvpdBlock"><div class="resrow row"><div class="col-10"><textarea name="identification_clean_surfaces_cvpd[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subidentification_clean_surfaces_cvpdAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#identification_clean_surfaces_cvpddiv').append(html);

    });





    $('#sampling_method_cvpdbtnadd').click(function(e) {

    var html =
    '<div class="singlesampling_method_cvpdBlock"><div class="resrow row"><div class="col-10"><textarea name="sampling_method_cvpd[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subsampling_method_cvpdAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#sampling_method_cvpddiv').append(html);

    });


    $('#recovery_studies_cvpdbtnadd').click(function(e) {

    var html =
    '<div class="singlerecovery_studies_cvpdBlock"><div class="resrow row"><div class="col-10"><textarea name="recovery_studies_cvpd[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subrecovery_studies_cvpdAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#recovery_studies_cvpddiv').append(html);

    });



    $('#calculating_carry_over_cvpdbtnadd').click(function(e) {

    var html =
    '<div class="singlecalculating_carry_over_cvpdBlock"><div class="resrow row"><div class="col-10"><textarea name="calculating_carry_over_cvpd[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subcalculating_carry_over_cvpdAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#calculating_carry_over_cvpddiv').append(html);

    });

    $('#calculating_rinse_analysis_cvpdbtnadd').click(function(e) {

    var html =
    '<div class="singlecalculating_rinse_analysis_cvpdBlock"><div class="resrow row"><div class="col-10"><textarea name="calculating_rinse_analysis_cvpd[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subcalculating_rinse_analysis_cvpdAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#calculating_rinse_analysis_cvpddiv').append(html);

    });


    $('#general_procedure_clean_cvpddbtnadd').click(function(e) {

    var html =
    '<div class="singlegeneral_procedure_clean_cvpddBlock"><div class="resrow row"><div class="col-10"><textarea name="general_procedure_clean_cvpdd[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subgeneral_procedure_clean_cvpddAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#general_procedure_clean_cvpdddiv').append(html);

    });



    $('#analytical_method_validation_cvpdbtnadd').click(function(e) {

    var html =
    '<div class="singleanalytical_method_validation_cvpdBlock"><div class="resrow row"><div class="col-10"><textarea name="analytical_method_validation_cvpd[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subanalytical_method_validation_cvpdAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#analytical_method_validation_cvpddiv').append(html);

    });


    $('#list_cleaning_sop_cvpdbtnadd').click(function(e) {

    var html =
    '<div class="singlelist_cleaning_sop_cvpdBlock"><div class="resrow row"><div class="col-10"><textarea name="list_cleaning_sop_cvpd[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark sublist_cleaning_sop_cvpdAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#list_cleaning_sop_cvpddiv').append(html);

    });


    $('#clean_validation_exercise_cvpdbtnadd').click(function(e) {

    var html =
    '<div class="singleclean_validation_exercise_cvpdBlock"><div class="resrow row"><div class="col-10"><textarea name="clean_validation_exercise_cvpd[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subclean_validation_exercise_cvpdAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#clean_validation_exercise_cvpddiv').append(html);

    });


    $('#evaluation_analytical_result_cvpdbtnadd').click(function(e) {

    var html =
    '<div class="singleevaluation_analytical_result_cvpdBlock"><div class="resrow row"><div class="col-10"><textarea name="evaluation_analytical_result_cvpd[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subevaluation_analytical_result_cvpdAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#evaluation_analytical_result_cvpddiv').append(html);

    });


    $('#summary_conclusion_cvpdbtnadd').click(function(e) {

    var html =
    '<div class="singlesummary_conclusion_cvpdBlock"><div class="resrow row"><div class="col-10"><textarea name="summary_conclusion_cvpd[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subsummary_conclusion_cvpdAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#summary_conclusion_cvpddiv').append(html);

    });


    $('#training_cvpdbtnadd').click(function(e) {

    var html =
    '<div class="singletraining_cvpdBlock"><div class="resrow row"><div class="col-10"><textarea name="training_cvpd[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subtraining_cvpdAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#training_cvpddiv').append(html);

    });


    //   -------------Packing validation tabs start report by kp-----------


    $('#Purpose_PaVaReKpbtnadd').click(function(e) {

var html =
    '<div class="singlePurpose_PaVaReKpBlock"><div class="resrow row"><div class="col-10"><textarea name="Purpose_PaVaReKp[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subPurpose_PaVaReKpAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

$('#Purpose_PaVaReKpdiv').append(html);

});

$('#Scope_PaVaReKpbtnadd').click(function(e) {

var html =
    '<div class="singleScope_PaVaReKpBlock"><div class="resrow row"><div class="col-10"><textarea name="Scope_PaVaReKp[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subScope_PaVaReKpAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

$('#Scope_PaVaReKpdiv').append(html);

});

$('#BatchDetails_PaVaReKpbtnadd').click(function(e) {

var html =
    '<div class="singleBatchDetails_PaVaReKpBlock"><div class="resrow row"><div class="col-10"><textarea name="BatchDetails_PaVaReKp[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subBatchDetails_PaVaReKpAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

$('#Scope_PaVaReKpdiv').append(html);

});

$('#ReferenceDocument_PaVaReKpbtnadd').click(function(e) {

var html =
    '<div class="singleReferenceDocument_PaVaReKpBlock"><div class="resrow row"><div class="col-10"><textarea name="ReferenceDocument_PaVaReKp[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subReferenceDocument_PaVaReKpAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

$('#ReferenceDocument_PaVaReKpdiv').append(html);

});


$('#PackingMaterialApprovalVendDeat_PaVaReKpbtnadd').click(function(e) {

var html =
    '<div class="singlePackingMaterialApprovalVendDeat_PaVaReKpBlock"><div class="resrow row"><div class="col-10"><textarea name="PackingMaterialApprovalVendDeat_PaVaReKp[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subPackingMaterialApprovalVendDeat_PaVaReKpAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

$('#PackingMaterialApprovalVendDeat_PaVaReKpdiv').append(html);

});

$('#UsedEquipmentCalibrationQualiSta_PaVaReKpbtnadd').click(function(e) {

var html =
    '<div class="singleUsedEquipmentCalibrationQualiSta_PaVaReKpBlock"><div class="resrow row"><div class="col-10"><textarea name="UsedEquipmentCalibrationQualiSta_PaVaReKp[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subUsedEquipmentCalibrationQualiSta_PaVaReKpAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

$('#UsedEquipmentCalibrationQualiSta_PaVaReKpdiv').append(html);

});

$('#ResultOfPacking_PaVaReKpbtnadd').click(function(e) {

var html =
    '<div class="singleResultOfPacking_PaVaReKpBlock"><div class="resrow row"><div class="col-10"><textarea name="ResultOfPacking_PaVaReKp[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subResultOfPacking_PaVaReKpAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

$('#ResultOfPacking_PaVaReKpdiv').append(html);

});

$('#CriticalProcessParameters_PaVaReKpbtnadd').click(function(e) {

var html =
    '<div class="singleCriticalProcessParameters_PaVaReKpBlock"><div class="resrow row"><div class="col-10"><textarea name="CriticalProcessParameters_PaVaReKp[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subCriticalProcessParameters_PaVaReKpAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

$('#ResultOfPacking_PaVaReKpdiv').append(html);

});

$('#yield_PaVaReKpbtnadd').click(function(e) {

var html =
    '<div class="singleyield_PaVaReKpBlock"><div class="resrow row"><div class="col-10"><textarea name="yield_PaVaReKp[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subyield_PaVaReKpAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

$('#yield_PaVaReKpdiv').append(html);

});


$('#HoldTimeStudy_PaVaReKpbtnadd').click(function(e) {

var html =
    '<div class="singleHoldTimeStudy_PaVaReKpBlock"><div class="resrow row"><div class="col-10"><textarea name="HoldTimeStudy_PaVaReKp[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subHoldTimeStudy_PaVaReKpAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

$('#HoldTimeStudy_PaVaReKpdiv').append(html);

});

$('#CleaningValidation_PaVaReKpbtnadd').click(function(e) {

var html =
    '<div class="singleCleaningValidation_PaVaReKpBlock"><div class="resrow row"><div class="col-10"><textarea name="CleaningValidation_PaVaReKp[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subCleaningValidation_PaVaReKpAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

$('#CleaningValidation_PaVaReKpdiv').append(html);

});


$('#StabilityStudy_PaVaReKpbtnadd').click(function(e) {

var html =
    '<div class="singleStabilityStudy_PaVaReKpBlock"><div class="resrow row"><div class="col-10"><textarea name="StabilityStudy_PaVaReKp[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subStabilityStudy_PaVaReKpAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

$('#StabilityStudy_PaVaReKpdiv').append(html);

});


$('#DeviationIfAny_PaVaReKpbtnadd').click(function(e) {

var html =
    '<div class="singleDeviationIfAny_PaVaReKpBlock"><div class="resrow row"><div class="col-10"><textarea name="DeviationIfAny_PaVaReKp[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subDeviationIfAny_PaVaReKpAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

$('#DeviationIfAny_PaVaReKpdiv').append(html);

});


$('#ChangeControlifany_PaVaReKpbtnadd').click(function(e) {

var html =
    '<div class="singleChangeControlifany_PaVaReKpBlock"><div class="resrow row"><div class="col-10"><textarea name="ChangeControlifany_PaVaReKp[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subChangeControlifany_PaVaReKpAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

$('#ChangeControlifany_PaVaReKpdiv').append(html);

});



$('#Summary_PaVaReKpbtnadd').click(function(e) {

    var html =
        '<div class="singleSummary_PaVaReKpBlock"><div class="resrow row"><div class="col-10"><textarea name="Summary_PaVaReKp[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subSummary_PaVaReKpAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#Summary_PaVaReKpdiv').append(html);

    });


    $('#Conclusion_PaVaReKpbtnadd').click(function(e) {

    var html =
        '<div class="singleConclusion_PaVaReKpBlock"><div class="resrow row"><div class="col-10"><textarea name="Conclusion_PaVaReKp[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subConclusion_PaVaReKpAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#Conclusion_PaVaReKpdiv').append(html);

    });


    $('#ProposedParameters_PaVaReKpbtnadd').click(function(e) {

    var html =
        '<div class="singleProposedParameters_PaVaReKpBlock"><div class="resrow row"><div class="col-10"><textarea name="ProposedParameters_PaVaReKp[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subProposedParameters_PaVaReKpAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#ProposedParameters_PaVaReKpdiv').append(html);

    });

    $('#ReportApproval_PaVaReKpbtnadd').click(function(e) {

    var html =
        '<div class="singleReportApproval_PaVaReKpBlock"><div class="resrow row"><div class="col-10"><textarea name="ReportApproval_PaVaReKp[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subReportApproval_PaVaReKpAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#ReportApproval_PaVaReKpdiv').append(html);

    });

    //   -------------Packing validation tabs end report by kp-----------


    

    //   -------------Format for commpressed air and nitrogen gas system protocal tabs start report by kp-----------

    $('#Protocolapproval_FoCompAaNirogenkpbtnadd').click(function(e) {

    var html =
        '<div class="singleProtocolapproval_FoCompAaNirogenkpBlock"><div class="resrow row"><div class="col-10"><textarea name="Protocolapproval_FoCompAaNirogenkp[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subProtocolapproval_FoCompAaNirogenkpAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#Protocolapproval_FoCompAaNirogenkpdiv').append(html);

    });

    $('#Objective_FoCompAaNirogenkpbtnadd').click(function(e) {

    var html =
        '<div class="singleObjective_FoCompAaNirogenkpBlock"><div class="resrow row"><div class="col-10"><textarea name="Objective_FoCompAaNirogenkp[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subObjective_FoCompAaNirogenkpAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#Objective_FoCompAaNirogenkpdiv').append(html);

    });


    $('#Purpose_FoCompAaNirogenkpbtnadd').click(function(e) {

    var html =
        '<div class="singleExcutionTeamResp_FoCompAaNirogenkpBlock"><div class="resrow row"><div class="col-10"><textarea name="Purpose_FoCompAaNirogenkp[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subPurpose_FoCompAaNirogenkpAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#Purpose_FoCompAaNirogenkpdiv').append(html);

    });


    $('#Scope_FoCompAaNirogenkpbtnadd').click(function(e) {

    var html =
        '<div class="singleScope_FoCompAaNirogenkpBlock"><div class="resrow row"><div class="col-10"><textarea name="Scope_FoCompAaNirogenkp[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subScope_FoCompAaNirogenkpAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#Scope_FoCompAaNirogenkpdiv').append(html);

    });

    $('#ExcutionTeamResp_FoCompAaNirogenkpbtnadd').click(function(e) {

    var html =
        '<div class="singleExcutionTeamResp_FoCompAaNirogenkpBlock"><div class="resrow row"><div class="col-10"><textarea name="ExcutionTeamResp_FoCompAaNirogenkp[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subExcutionTeamResp_FoCompAaNirogenkpAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#ExcutionTeamResp_FoCompAaNirogenkpdiv').append(html);

    });

    $('#Abbreviations_FoCompAaNirogenkpbtnadd').click(function(e) {

    var html =
        '<div class="singleAbbreviations_FoCompAaNirogenkpBlock"><div class="resrow row"><div class="col-10"><textarea name="Abbreviations_FoCompAaNirogenkp[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subAbbreviations_FoCompAaNirogenkpAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#Abbreviations_FoCompAaNirogenkpdiv').append(html);

    });


    $('#EquipmentSystemIde_FoCompAaNirogenkpbtnadd').click(function(e) {

    var html =
        '<div class="singleEquipmentSystemIde_FoCompAaNirogenkpBlock"><div class="resrow row"><div class="col-10"><textarea name="EquipmentSystemIde_FoCompAaNirogenkp[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subEquipmentSystemIde_FoCompAaNirogenkpAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#EquipmentSystemIde_FoCompAaNirogenkpdiv').append(html);

    });


    $('#DocumentFollowed_FoCompAaNirogenkpbtnadd').click(function(e) {

    var html =
        '<div class="singleDocumentFollowed_FoCompAaNirogenkpBlock"><div class="resrow row"><div class="col-10"><textarea name="DocumentFollowed_FoCompAaNirogenkp[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subDocumentFollowed_FoCompAaNirogenkpAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#DocumentFollowed_FoCompAaNirogenkpdiv').append(html);

    });

    $('#GenralConsPre_FoCompAaNirogenkpbtnadd').click(function(e) {

    var html =
        '<div class="singleGenralConsPre_FoCompAaNirogenkpBlock"><div class="resrow row"><div class="col-10"><textarea name="GenralConsPre_FoCompAaNirogenkp[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subGenralConsPre_FoCompAaNirogenkpAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#GenralConsPre_FoCompAaNirogenkpdiv').append(html);

    });

    $('#RevalidCrite_FoCompAaNirogenkpbtnadd').click(function(e) {

    var html =
        '<div class="singleRevalidCrite_FoCompAaNirogenkpBlock"><div class="resrow row"><div class="col-10"><textarea name="RevalidCrite_FoCompAaNirogenkp[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subRevalidCrite_FoCompAaNirogenkpAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#RevalidCrite_FoCompAaNirogenkpdiv').append(html);

    });

    $('#Precautions_FoCompAaNirogenkpbtnadd').click(function(e) {

    var html =
        '<div class="singlePrecautions_FoCompAaNirogenkpBlock"><div class="resrow row"><div class="col-10"><textarea name="Precautions_FoCompAaNirogenkp[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subPrecautions_FoCompAaNirogenkpAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#Precautions_FoCompAaNirogenkpdiv').append(html);

    });

    $('#RevalidProcess_FoCompAaNirogenkpbtnadd').click(function(e) {

    var html =
        '<div class="singleRevalidProcess_FoCompAaNirogenkpBlock"><div class="resrow row"><div class="col-10"><textarea name="RevalidProcess_FoCompAaNirogenkp[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subRevalidProcess_FoCompAaNirogenkpAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#RevalidProcess_FoCompAaNirogenkpdiv').append(html);

    });

    $('#AcceptanceCrite_FoCompAaNirogenkpbtnadd').click(function(e) {

    var html =
        '<div class="singleAcceptanceCrite_FoCompAaNirogenkpBlock"><div class="resrow row"><div class="col-10"><textarea name="AcceptanceCrite_FoCompAaNirogenkp[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subAcceptanceCrite_FoCompAaNirogenkpAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#AcceptanceCrite_FoCompAaNirogenkpdiv').append(html);

    });

    $('#Annexure_FoCompAaNirogenkpbtnadd').click(function(e) {

    var html =
        '<div class="singleAnnexure_FoCompAaNirogenkpBlock"><div class="resrow row"><div class="col-10"><textarea name="Annexure_FoCompAaNirogenkp[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subAnnexure_FoCompAaNirogenkpAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

    $('#Annexure_FoCompAaNirogenkpdiv').append(html);

    });



        //cleaning validation Report doc


        $('#objective_cvrdbtnadd').click(function(e) {

        var html =
        '<div class="singleobjective_cvrdBlock"><div class="resrow row"><div class="col-10"><textarea name="objective_cvrd[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subobjective_cvrdAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#objective_cvrddiv').append(html);

        });



        $('#scope_cvrdbtnadd').click(function(e) {

        var html =
        '<div class="singlescope_cvrdBlock"><div class="resrow row"><div class="col-10"><textarea name="scope_cvrd[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subscope_cvrdAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#scope_cvrddiv').append(html);

        });

        $('#purpose_cvrdbtnadd').click(function(e) {

        var html =
        '<div class="singlepurpose_cvrdBlock"><div class="resrow row"><div class="col-10"><textarea name="purpose_cvrd[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subpurpose_cvrdAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#purpose_cvrddiv').append(html);

        });




        $('#responsibilities_cvrdbtnadd').click(function(e) {

        var html =
        '<div class="singleresponsibilities_cvrdBlock"><div class="resrow row"><div class="col-10"><textarea name="responsibilities_cvrd[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subresponsibilities_cvrdAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#responsibilities_cvrddiv').append(html);

        });



        $('#analysis_methodology_cvrdbtnadd').click(function(e) {

        var html =
        '<div class="singleanalysis_methodology_cvrdBlock"><div class="resrow row"><div class="col-10"><textarea name="analysis_methodology_cvrd[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subanalysis_methodology_cvrdAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#analysis_methodology_cvrddiv').append(html);

        });




        $('#recovery_study_report_cvrdbtnadd').click(function(e) {

        var html =
        '<div class="singlerecovery_study_report_cvrdBlock"><div class="resrow row"><div class="col-10"><textarea name="recovery_study_report_cvrd[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subrecovery_study_report_cvrdAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#recovery_study_report_cvrddiv').append(html);

        });




        $('#acceptance_critria_cvrdbtnadd').click(function(e) {

        var html =
        '<div class="singleacceptance_critria_cvrdBlock"><div class="resrow row"><div class="col-10"><textarea name="acceptance_critria_cvrd[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subacceptance_critria_cvrdAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#acceptance_critria_cvrddiv').append(html);

        });



        $('#analytical_report_cvrdbtnadd').click(function(e) {

        var html =
        '<div class="singleanalytical_report_cvrdBlock"><div class="resrow row"><div class="col-10"><textarea name="analytical_report_cvrd[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subanalytical_report_cvrdAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#analytical_report_cvrddiv').append(html);

        });




        $('#physical_procedure_conformance_check_cvrdbtnadd').click(function(e) {

        var html =
        '<div class="singlephysical_procedure_conformance_check_cvrdBlock"><div class="resrow row"><div class="col-10"><textarea name="physical_procedure_conformance_check_cvrd[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subphysical_procedure_conformance_check_cvrdAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#physical_procedure_conformance_check_cvrddiv').append(html);

        });

        // Process Validation Interim Report
        // Critical process parameters & Critical quality attributes
        $('#Critical_quality_pvirbtnadd').click(function(e) {

        var html =
            '<div class="singleCriticalPvirBlock"><div class="resrow row"><div class="col-10"><textarea name="critical_pvir[]" class="myclassname1"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subcritical_quality_pvirAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#critical_quality_pvirpdiv').append(html);

        });

        // Results of In process data
        $('#In_process_data_pvirbtnadd').click(function(e) {

        var html =
            '<div class="single_In_process_data_PvirBlock"><div class="resrow row"><div class="col-10"><textarea name="In_process_data_pvir[]" class="myclassname2"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subIn_process_data_pvirAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#In_process_data_pvirdiv').append(html);

        });

        // Yield at various stages
        $('#various_stages_pvirbtnadd').click(function(e) {

        var html =
            '<div class="singlevarious_stages_PvirBlock"><div class="resrow row"><div class="col-10"><textarea name="various_stages_pvir[]" class="myclassname3"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subvarious_stages_pvirAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#various_stages_pvirdiv').append(html);

        });

        // Deviation (If any)
        $('#deviation_pvirbtnadd').click(function(e) {

        var html =
            '<div class="singleDeviationBlock"><div class="resrow row"><div class="col-10"><textarea name="deviation_pvir[]" class="myclassname4"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subdeviation_pvirAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#deviation_pvirdiv').append(html);

        });

        // Change Control ( If any)
        $('#change_controlpvirbtnadd').click(function(e) {

        var html =
            '<div class="singlechange_controlPvirBlock"><div class="resrow row"><div class="col-10"><textarea name="change_controlpvir[]" class="myclassname5"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subchange_controlpvirAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#change_controlpvirdiv').append(html);

        });

        // Summary
        $('#Summarypvirbtnadd').click(function(e) {

        var html =
            '<div class="singleSummaryPvirBlock"><div class="resrow row"><div class="col-10"><textarea name="Summary_pvir[]" class="myclassname5"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subSummarypvirAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#Summarypvirdiv').append(html);

        });

        // Conclusion
        $('#conclusionpvirbtnadd').click(function(e) {

        var html =
            '<div class="single_Conclusion_pvirBlock"><div class="resrow row"><div class="col-10"><textarea name="conclusion_pvir[]" class="myclassname5"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subConclusion_pvirAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#conclusion_pvirdiv').append(html);

        });

        // Report Approval
        $('#report_approvalpvirbtnadd').click(function(e) {

        var html =
            '<div class="singlereport_approvalPvirBlock"><div class="resrow row"><div class="col-10"><textarea name="report_approvalpvir[]" class="myclassname5"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subreport_approvalpvirAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#report_approvalpvirdiv').append(html);

        });


        $('#formatidentificationbtnadd').click(function(e) {

        var html =
            '<div class="singleformatidentificationBlock"><div class="resrow row"><div class="col-10"><textarea name="formatidentification[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subformatidentificationAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#formatidentificationdiv').append(html);

        });


        $('#executiontteambtnadd').click(function(e) {

        var html =
            '<div class="singleexecutiontteamBlock"><div class="resrow row"><div class="col-10"><textarea name="executiontteam[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subexecutiontteamAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#executiontteamdiv').append(html);

        });

        $('#formatdocumentsbtnadd').click(function(e) {

        var html =
            '<div class="singleformatdocumentsBlock"><div class="resrow row"><div class="col-10"><textarea name="formatdocuments[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subformatdocumentsAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#formatdocumentsdiv').append(html);

        });

        $('#revalidationtypebtadd').click(function(e) {

        var html =
            '<div class="singlerevalidationtypeBlock"><div class="resrow row"><div class="col-10"><textarea name="revalidationtype[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subrevalidationtypeAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#revalidationtypediv').append(html);

        });

        $('#RevalidationCriteriabtadd').click(function(e) {

        var html =
            '<div class="singleRevalidationCriteriaBlock"><div class="resrow row"><div class="col-10"><textarea name="RevalidationCriteria[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subRevalidationCriteriaAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#RevalidationCriteriadiv').append(html);

        });

        $('#generalconsiderationbtadd').click(function(e) {

        var html =
            '<div class="singlegeneralconsiderationBlock"><div class="resrow row"><div class="col-10"><textarea name="generalconsideration[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subgeneralconsiderationAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#generalconsiderationdiv').append(html);

        });

        $('#precautionsbtnadd').click(function(e) {

        var html =
            '<div class="singleprecautionsBlock"><div class="resrow row"><div class="col-10"><textarea name="precautions[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subprecautionsAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#precautionsdiv').append(html);

        });

        $('#calibrationstatusbtnadd').click(function(e) {

        var html =
            '<div class="singlecalibrationstatusBlock"><div class="resrow row"><div class="col-10"><textarea name="calibrationstatus[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subcalibrationstatusAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#calibrationstatusdiv').append(html);

        });

        $('#testobservationbtnadd').click(function(e) {

        var html =
            '<div class="singletestobservationBlock"><div class="resrow row"><div class="col-10"><textarea name="testobservation[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subtestobservationAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#testobservationdiv').append(html);

        });

        $('#formatannexurebtadd').click(function(e) {

        var html =
            '<div class="singleformatannexureBlock"><div class="resrow row"><div class="col-10"><textarea name="formatannexure[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subformatannexureAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#formatannexurediv').append(html);

        });

        $('#formatdeviationbtadd').click(function(e) {

        var html =
            '<div class="singleformatdeviationBlock"><div class="resrow row"><div class="col-10"><textarea name="formatdeviation[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subformatdeviationAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#formatdeviationdiv').append(html);

        });

        $('#formatccbtadd').click(function(e) {

        var html =
            '<div class="singleformatccBlock"><div class="resrow row"><div class="col-10"><textarea name="formatcc[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subformatccAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#formatccdiv').append(html);

        });

        $('#formatsummarybtadd').click(function(e) {

        var html =
            '<div class="singleformatsummaryBlock"><div class="resrow row"><div class="col-10"><textarea name="formatsummary[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subformatsummaryAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#formatsummarydiv').append(html);

        });

        $('#formatconclusionbtadd').click(function(e) {

        var html =
            '<div class="singleformatconclusionBlock"><div class="resrow row"><div class="col-10"><textarea name="formatconclusion[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subformatconclusionAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#formatconclusiondiv').append(html);

        });

        $('#eqpresponsibilitybtnadd').click(function(e) {

            var html =
                '<div class="singleEqpresponsibilityBlock"><div class="resrow row"><div class="col-10"><textarea name="eqpresponsibility[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subEqpResponsibilityAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#eqpresponsibilitydiv').append(html);

        });

        $('#eqpdetailsbtnadd').click(function(e) {

            var html =
                '<div class="singleEqpDetailsBlock"><div class="resrow row"><div class="col-10"><textarea name="eqpdetails[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subEqpDetailsAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#eqpdetailsdiv').append(html);

        });

        $('#eqpsamplingbtnadd').click(function(e) {

            var html =
                '<div class="singleEqpSamplingBlock"><div class="resrow row"><div class="col-10"><textarea name="eqpsampling[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subEqpSamplingAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#eqpsamplingdiv').append(html);

        });

        $('#Samplingprocedurebtadd').click(function(e) {

            var html =
                '<div class="singleSamplingprocedureBlock"><div class="resrow row"><div class="col-10"><textarea name="Samplingprocedure[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subSamplingprocedureAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#Samplingprocedurediv').append(html);

        });

        $('#AcceptenceCriteriabtadd').click(function(e) {

            var html =
                '<div class="singleAcceptenceCriteriaBlock"><div class="resrow row"><div class="col-10"><textarea name="AcceptenceCriteria[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subAcceptenceCriteriaAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#AcceptenceCriteriadiv').append(html);

        });
        $('#EnvironmentalConditionsbtadd').click(function(e) {

            var html =
                '<div class="singleEnvironmentalConditionsBlock"><div class="resrow row"><div class="col-10"><textarea name="EnvironmentalConditions[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subEnvironmentalConditionsAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#EnvironmentalConditionsdiv').append(html);

        });

        $('#eqpdetailsdeviationbtnadd').click(function(e) {

            var html =
                '<div class="singleEqpdetailsdeviationBlock"><div class="resrow row"><div class="col-10"><textarea name="eqpdetailsdeviation[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subEqpdetailsdeviationAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#eqpdetailsdeviationdiv').append(html);

        });

        $('#eqpdetailschangecontrolbtnadd').click(function(e) {

            var html =
                '<div class="singleEqpdetailschangecontrolBlock"><div class="resrow row"><div class="col-10"><textarea name="eqpdetailschangecontrol[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subEqpdetailschangecontrolAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#eqpdetailschangecontroldiv').append(html);

        });

        $('#eqpdetailssummarybtnadd').click(function(e) {

            var html =
                '<div class="singleEqpdetailssummaryBlock"><div class="resrow row"><div class="col-10"><textarea name="eqpdetailssummary[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subEqpdetailssummaryAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#eqpdetailssummarydiv').append(html);

        });

        $('#eqpdetailsconclusionbtadd').click(function(e) {

            var html =
                '<div class="singleEqpdetailsconclusionBlock"><div class="resrow row"><div class="col-10"><textarea name="eqpdetailsconclusion[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subeqpdetailsconclusionAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#eqpdetailsconclusiondiv').append(html);

        });

        $('#eqpdetailstrainingbtadd').click(function(e) {

            var html =
                '<div class="singleEqpdetailstrainingBlock"><div class="resrow row"><div class="col-10"><textarea name="eqpdetailstraining[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subeqpdetailstrainingAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#eqpdetailstrainingdiv').append(html);

        });



        $('#conclusion_cvrdbtnadd').click(function(e) {

        var html =
        '<div class="singleconclusion_cvrdBlock"><div class="resrow row"><div class="col-10"><textarea name="conclusion_cvrd[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subconclusion_cvrdAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

        $('#conclusion_cvrddiv').append(html);

        });




        //happy
        let subEqpResponsibilityAdd= 0;
        let subEqpDetailsAdd= 0;
        let subEqpSamplingAdd= 0;
        let subSamplingprocedureAdd= 0;
        let subAcceptenceCriteriaAdd= 0;
        let subEnvironmentalConditionsAdd= 0;
        let subEqpdetailsdeviationAdd= 0;
        let subEqpdetailschangecontrolAdd= 0;
        let subEqpdetailssummaryAdd= 0;
        let subeqpdetailsconclusionAdd= 0;
        let subeqpdetailstrainingAdd= 0;

        let subformatconclusionAdd= 0;
        let subformatsummaryAdd= 0;
        let subformatccAdd= 0;
        let subformatdeviationAdd= 0;
        let subformatannexureAdd= 0;
        let subtestobservationAdd= 0;
        let subcalibrationstatusAdd= 0;
        let subprecautionsAdd= 0;
        let subgeneralconsiderationAdd= 0;
        let subRevalidationCriteriaAdd= 0;
        let subrevalidationtypeAdd= 0;
        let subformatdocumentsAdd= 0;
        let subexecutiontteamAdd= 0;
        let subformatidentificationAdd= 0;
       

        //Process validation interim report
        let subcritical_quality_pvirAdd = 0;
        let subIn_process_data_pvirAdd = 0;
        let subvarious_stages_pvirAdd = 0;
        let subdeviation_pvirAdd = 0;
        let subchange_controlpvirAdd = 0;
        let subSummarypvirAdd = 0;
        let subConclusion_pvirAdd = 0;
        let subreport_approvalpvirAdd = 0;
        

        let subPurpose_PaVaReKpAdd = 0;
        let subScope_PaVaReKpAdd = 0;
        let subBatchDetails_PaVaReKpAdd = 0;
        let subReferenceDocument_PaVaReKpAdd = 0;
        let subPackingMaterialApprovalVendDeat_PaVaReKpAdd = 0;
        let subUsedEquipmentCalibrationQualiSta_PaVaReKpAdd = 0;
        let subResultOfPacking_PaVaReKpAdd = 0;
        let subCriticalProcessParameters_PaVaReKpAdd = 0;
        let subyield_PaVaReKpAdd = 0;
        let subHoldTimeStudy_PaVaReKpAdd = 0;
        let subCleaningValidation_PaVaReKpAdd = 0;
        let subStabilityStudy_PaVaReKpAdd = 0;
        let subDeviationIfAny_PaVaReKpAdd = 0;
        let subChangeControlifany_PaVaReKpAdd = 0;
        let subSummary_PaVaReKpAdd = 0;
        let subConclusion_PaVaReKpAdd = 0;
        let subProposedParameters_PaVaReKpAdd = 0;
        let subReportApproval_PaVaReKpAdd = 0;
        let subProtocolapproval_FoCompAaNirogenkpAdd = 0;
        let subObjective_FoCompAaNirogenkpAdd = 0;
        let subPurpose_FoCompAaNirogenkpAdd = 0;
        let subScope_FoCompAaNirogenkpAdd = 0;
        let subExcutionTeamResp_FoCompAaNirogenkpAdd = 0;
        let subAbbreviations_FoCompAaNirogenkpAdd = 0;
        let subDocumentFollowed_FoCompAaNirogenkpAdd = 0;
        let subGenralConsPre_FoCompAaNirogenkpAdd = 0;
        let subRevalidCrite_FoCompAaNirogenkpAdd = 0;
        let subPrecautions_FoCompAaNirogenkpAdd = 0;
        let subRevalidProcess_FoCompAaNirogenkpAdd = 0;
        let subAcceptanceCrite_FoCompAaNirogenkpAdd = 0;
        let subAnnexure_FoCompAaNirogenkpAdd = 0;


        let subMaterialsAdd = 0;
        let subResponsibilityAdd = 0;
        let subProtocolApproval_TemperMapAdd = 0;
        let subObjective_TemperMapAdd = 0;
        let subScope_TemperMapAdd = 0;
        let subAreaValidated_TemperMapAdd = 0;
        let subValidationTeamResponsibilities_TemperMapAdd = 0;
        let subDocumentFollowed_TemperMapAdd = 0;
        let subStudyRationale_TemperMapAdd = 0;
        let subProcedure_TemperMapAdd = 0;
        let subCriteriaRevalidation_TemperMapAdd = 0;
        let subMaterialDocumentRequired_TemperMapAdd = 0;
        let subAcceptanceCriteria_TemperMapAdd = 0;
        let subTypeofValidation_TemperMapAdd = 0;
        let subReference_TemperMapAdd = 0;
        let subObservationResult_TemperMapAdd = 0;
        let subAbbreviations_TemperMapAdd = 0;
        let subDeviationAny_TemperMapAdd = 0;
        let subChangeControl_TemperMapAdd = 0;
        let subSummary_TemperMapAdd = 0;
        let subConclusion_TemperMapAdd = 0;
        let subAttachmentList_TemperMapAdd = 0;
        let subPostApproval_TemperMapAdd = 0;
        let subPurpose_HoTiStReAdd = 0;
        let subScope_HoTiStReAdd = 0;
        let subBatchDetails_HoTiStReAdd = 0;
        let subReferenceDocument_HoTiStReAdd = 0;
        let subResultBulkStage_HoTiStReAdd = 0;
        let subDeviationIfAny_HoTiStReAdd = 0;
        let subSummary_HoTiStReAdd = 0;
        let subConclusion_HoTiStReAdd = 0;
        let subReportApproval_HoTiStReAdd = 0;
        let subAbbreviationAdd = 0;
        let subDefinitionAdd = 0;
        let subReferencesAdd = 0;
        let subAnnexureAdd = 0;
        let subReportingAdd = 0;
        let subResponsibilityprvpAdd = 0;
        let subAccountabilityprvpAdd = 0;
        let subDefinitionPrvpAdd = 0;
        let subresponsibilityhtpsAdd=0;
        let subhtspdescriptionAdd=0;
        let subSpecificationsAdd=0;
        let subSamplinghtpsAdd=0;
        let subEnvironmentalhtspAdd=0;
        let subSamplehtpsAdd=0;
        let subDeviationhtpsAdd=0;
        let subSummaryhtpsAdd=0;
        let subConclusionhtpseAdd=0;

        let subscope_pvrAdd=0;
        let subpurpose_pvrAdd=0;
        let subbatchdeatails_pvrAdd=0;
        let subbatchdetail_pvrAdd=0;
        let subrefrence_document_pvrAdd=0;
        let subrefrence_documentAdd=0;
        let subactive_raw_material_pvrAdd=0;
        let subprimary_packingmaterial_pvrAdd=0;
        let subused_equipment_calibration_pvrAdd=0;
        let subresult_of_intermediate_pvrAdd=0;
        let subresult_of_finished_product_pvrAdd=0;
        let subresult_of_packing_finished_pvrAdd=0;
        let subcriticalprocess_parameter_pvrAdd=0;
        let subyield_at_various_stage_pvrAdd=0;
        let subhold_time_study_pvrAdd=0;
        let subcleaningvalidation_pvrAdd=0;
        let substability_study_pvrAdd=0;
        let subdeviation_if_any_pvrAdd=0;
        let subchangecontrol_pvrAdd=0;

        let subsummary_pvrAdd=0;
        let subconclusion_pvrAdd=0;
        let subproposed_parameter_upcoming_batch_pvrAdd=0;
        let subreport_approval_pvrAdd=0;
        

        let subResponsibilitiesAdd = 0;
        let subReferencesssAdd = 0;
        let subAssessmentAdd = 0;
        let subStrategyAdd = 0;
        let subSummaryAdd = 0;
        let subConclusionAdd = 0;
        let substResponsibilityAdd= 0;
        let substdefinationAdd= 0;
        let substreferencesAdd= 0;
        let substbackgroundAdd= 0;
        let substassessmentAdd= 0;
        let subststrategyAdd= 0;
        let substsummaryAdd= 0;
        let substconclusionAdd= 0;
        let substannexureAdd= 0;
        let substReferencedocunumAdd= 0;
        let subEuipmentResponsibilityAdd= 0;
        let subEqpAnalyticalReportAdd= 0;
        let subEqpdeviationAdd= 0;
        let subEqpchangecontrolAdd= 0;
        let subEqpsummaryAdd= 0;
        let subeqpconclusionAdd= 0;
        let subeqpreportapprovalAdd= 0;

        let subreasonforvalidationpvpAdd = 0;
        let subresponsibilitypvpAdd = 0;
        let subvalidationpvpAdd = 0;
        let subdescriptionsoppvpAdd = 0;
        let subpackingmaterialpvpAdd = 0;
        let subequipmentpvpAdd = 0;
        let subrationalepvpAdd= 0;
        let subsamplingpvpAdd= 0;
        let subCriticalpvpAdd= 0;
        let subProductAcceptancepvpAdd= 0;
        let subHoldtimepvpAdd= 0;
        let subCleaningvalidationpvpAdd= 0;
        let subStabilitystudypvpAdd= 0;
        let subDeviationpvpAdd= 0;
        let subChangecontrolpvpAdd= 0;
        let subSummarypvpAdd= 0;
        let subConclusionpvpAdd= 0;

        let subobjective_cvpdAdd=0;
        let subscope_cvpdAdd=0;
        let subpurpose_cvpdAdd=0;
        let subresponsibilities_cvpdAdd=0;
        let subidentification_sensitive_product_contamination_cvpdAdd=0;
        let submatrix_worstcase_approach_cvpdAdd=0;
        let subacceptance_criteria_cvpdAdd=0;
        let sublist_equipment_internal_surface_cvpdAdd=0;
        let subidentification_clean_surfaces_cvpdAdd=0;
        let subsampling_method_cvpdAdd=0;
        let subrecovery_studies_cvpdAdd=0;
        let subcalculating_carry_over_cvpdAdd=0;
        let subcalculating_rinse_analysis_cvpdAdd=0;
        let subgeneral_procedure_clean_cvpdAdd=0;
        let subanalytical_method_validation_cvpdAdd=0;
        let sublist_cleaning_sop_cvpdAdd=0;
        let subclean_validation_exercise_cvpdAdd=0;
        let subevaluation_analytical_result_cvpdAdd=0;
        let subsummary_conclusion_cvpdAdd=0;
        let subtraining_cvpdAdd=0;

        let subobjective_cvrdAdd=0;
        let subscope_cvrdAdd=0;
        let subpurpose_cvrdAdd=0;
        let subresponsibilities_cvrdAdd=0;
        let subanalysis_methodology_cvrdAdd=0;
        let subrecovery_study_report_cvrdAdd=0;
        let subacceptance_critria_cvrdAdd=0;
        let subanalytical_report_cvrdAdd=0;
        let subphysical_procedure_conformance_check_cvrdAdd=0;
        let subconclusion_cvrdAdd=0;
        




        $(document).on('click', '.removeAllBlocks', function(e) {
            e.preventDefault();
            var targetBlock = $(this).parents('div:eq(2)');

            var targetClass = targetBlock.attr('class').split(' ').filter(c => c.includes('Block'))[0];

            console.log('targetBlock', targetBlock)
            console.log('targetClass', targetClass)

            var subClassPattern = 'sub' + targetClass.charAt(0).toUpperCase() + targetClass.slice(1);
            var nextSingleBlock = targetBlock.nextAll('.' + targetClass).first();
            var nextSubBlocks;

            if (nextSingleBlock.length > 0) {
                nextSubBlocks = targetBlock.nextUntil(nextSingleBlock, 'div[class*="' + subClassPattern + '"]');
            } else {
                nextSubBlocks = targetBlock.nextAll('div[class*="' + subClassPattern + '"]');
            }

            nextSubBlocks.remove();

            targetBlock.remove();
        });

        $(document).on('click', '.subMaterialsAdd', function(e) {
            e.preventDefault();
            subMaterialsAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="materials_and_equipments[sub_'+ subMaterialsAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleMaterialBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleMaterialBlock', '.subSingleMaterialBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleMaterialBlock">' + html + '</div>');
            }

        });
        $(document).on('click', '.subhtspdescriptionAdd', function(e) {
            e.preventDefault();
            subhtspdescriptionAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="htsp_description_of_sop[sub_'+ subhtspdescriptionAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.htspdescriptionBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.htspdescriptionBlock', '.subhtspdescriptionBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subhtspdescriptionBlock">' + html + '</div>');
            }

        });
      

        $(document).on('click', '.subresponsibilityhtpsAdd', function(e) {
            e.preventDefault();
            subresponsibilityhtpsAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="htsp_responsibility[sub_'+ subresponsibilityhtpsAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.ResponsibilityBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.ResponsibilityBlock', '.subResponsibilityBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subResponsibilityBlock">' + html + '</div>');
            }

        });

        $(document).on('click', '.subSpecificationsAdd', function(e) {
            e.preventDefault();
            subSpecificationsAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="htsp_specifications[sub_'+ subSpecificationsAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.SpecificationsBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.SpecificationsBlock', '.subSpecificationsBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSpecificationsBlock">' + html + '</div>');
            }

        });

        $(document).on('click', '.subSamplinghtpsAdd', function(e) {
            e.preventDefault();
            subSamplinghtpsAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="htsp_sampling_analysis[sub_'+ subSamplinghtpsAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.SamplinghtpsBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.SamplinghtpsBlock', '.subSamplinghtpsBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSamplinghtpsBlock">' + html + '</div>');
            }

        });


        // packing validation report by kp
        $(document).on('click', '.subPurpose_PaVaReKpAdd', function(e) {
            e.preventDefault();
            subPurpose_PaVaReKpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="Purpose_PaVaReKp[sub_'+ subPurpose_PaVaReKpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlePurpose_PaVaReKpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlePurpose_PaVaReKpBlock', '.subsinglePurpose_PaVaReKpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsinglePurpose_PaVaReKpBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subScope_PaVaReKpAdd', function(e) {
            e.preventDefault();
            subScope_PaVaReKpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="Scope_PaVaReKp[sub_'+ subScope_PaVaReKpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleScope_PaVaReKpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleScope_PaVaReKpBlock', '.subsingleScope_PaVaReKpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleScope_PaVaReKpBlock">' + html + '</div>');
            }
        });


        $(document).on('click', '.subBatchDetails_PaVaReKpAdd', function(e) {
            e.preventDefault();
            subBatchDetails_PaVaReKpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="BatchDetails_PaVaReKp[sub_'+ subBatchDetails_PaVaReKpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleBatchDetails_PaVaReKpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleBatchDetails_PaVaReKpBlock', '.subsingleBatchDetails_PaVaReKpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleBatchDetails_PaVaReKpBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subReferenceDocument_PaVaReKpAdd', function(e) {
            e.preventDefault();
            subReferenceDocument_PaVaReKpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="ReferenceDocument_PaVaReKp[sub_'+ subReferenceDocument_PaVaReKpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleReferenceDocument_PaVaReKpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleReferenceDocument_PaVaReKpBlock', '.subsingleReferenceDocument_PaVaReKpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleReferenceDocument_PaVaReKpBlock">' + html + '</div>');
            }
        });


        $(document).on('click', '.subPackingMaterialApprovalVendDeat_PaVaReKpAdd', function(e) {
            e.preventDefault();
            subPackingMaterialApprovalVendDeat_PaVaReKpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="PackingMaterialApprovalVendDeat_PaVaReKp[sub_'+ subPackingMaterialApprovalVendDeat_PaVaReKpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlePackingMaterialApprovalVendDeat_PaVaReKpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlePackingMaterialApprovalVendDeat_PaVaReKpBlock', '.subsinglePackingMaterialApprovalVendDeat_PaVaReKpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsinglePackingMaterialApprovalVendDeat_PaVaReKpBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subUsedEquipmentCalibrationQualiSta_PaVaReKpAdd', function(e) {
            e.preventDefault();
            subUsedEquipmentCalibrationQualiSta_PaVaReKpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="UsedEquipmentCalibrationQualiSta_PaVaReKp[sub_'+ subUsedEquipmentCalibrationQualiSta_PaVaReKpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleUsedEquipmentCalibrationQualiSta_PaVaReKpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleUsedEquipmentCalibrationQualiSta_PaVaReKpBlock', '.subsingleUsedEquipmentCalibrationQualiSta_PaVaReKpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleUsedEquipmentCalibrationQualiSta_PaVaReKpBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subResultOfPacking_PaVaReKpAdd', function(e) {
            e.preventDefault();
            subResultOfPacking_PaVaReKpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="ResultOfPacking_PaVaReKp[sub_'+ subResultOfPacking_PaVaReKpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleResultOfPacking_PaVaReKpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleResultOfPacking_PaVaReKpBlock', '.subsingleResultOfPacking_PaVaReKpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleResultOfPacking_PaVaReKpBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subCriticalProcessParameters_PaVaReKpAdd', function(e) {
            e.preventDefault();
            subCriticalProcessParameters_PaVaReKpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="CriticalProcessParameters_PaVaReKp[sub_'+ subCriticalProcessParameters_PaVaReKpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleCriticalProcessParameters_PaVaReKpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleCriticalProcessParameters_PaVaReKpBlock', '.subsingleCriticalProcessParameters_PaVaReKpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleCriticalProcessParameters_PaVaReKpBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subyield_PaVaReKpAdd', function(e) {
            e.preventDefault();
            subyield_PaVaReKpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="yield_PaVaReKp[sub_'+ subyield_PaVaReKpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleyield_PaVaReKpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleyield_PaVaReKpBlock', '.subsingleyield_PaVaReKpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleyield_PaVaReKpBlock">' + html + '</div>');
            }
        });


        $(document).on('click', '.subHoldTimeStudy_PaVaReKpAdd', function(e) {
            e.preventDefault();
            subHoldTimeStudy_PaVaReKpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="HoldTimeStudy_PaVaReKp[sub_'+ subHoldTimeStudy_PaVaReKpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleHoldTimeStudy_PaVaReKpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleHoldTimeStudy_PaVaReKpBlock', '.subsingleHoldTimeStudy_PaVaReKpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleHoldTimeStudy_PaVaReKpBlock">' + html + '</div>');
            }
        });


        $(document).on('click', '.subCleaningValidation_PaVaReKpAdd', function(e) {
            e.preventDefault();
            subCleaningValidation_PaVaReKpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="CleaningValidation_PaVaReKp[sub_'+ subCleaningValidation_PaVaReKpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleCleaningValidation_PaVaReKpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleCleaningValidation_PaVaReKpBlock', '.subsingleCleaningValidation_PaVaReKpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleCleaningValidation_PaVaReKpBlock">' + html + '</div>');
            }
        });


        $(document).on('click', '.subStabilityStudy_PaVaReKpAdd', function(e) {
            e.preventDefault();
            subStabilityStudy_PaVaReKpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="StabilityStudy_PaVaReKp[sub_'+ subStabilityStudy_PaVaReKpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleStabilityStudy_PaVaReKpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleStabilityStudy_PaVaReKpBlock', '.subsingleStabilityStudy_PaVaReKpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleStabilityStudy_PaVaReKpBlock">' + html + '</div>');
            }
        });


        $(document).on('click', '.subDeviationIfAny_PaVaReKpAdd', function(e) {
            e.preventDefault();
            subDeviationIfAny_PaVaReKpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="DeviationIfAny_PaVaReKp[sub_'+ subDeviationIfAny_PaVaReKpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleDeviationIfAny_PaVaReKpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleDeviationIfAny_PaVaReKpBlock', '.subsingleDeviationIfAny_PaVaReKpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleDeviationIfAny_PaVaReKpBlock">' + html + '</div>');
            }
        });



        $(document).on('click', '.subChangeControlifany_PaVaReKpAdd', function(e) {
            e.preventDefault();
            subChangeControlifany_PaVaReKpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="ChangeControlifany_PaVaReKp[sub_'+ subChangeControlifany_PaVaReKpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleChangeControlifany_PaVaReKpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleChangeControlifany_PaVaReKpBlock', '.subsingleChangeControlifany_PaVaReKpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleChangeControlifany_PaVaReKpBlock">' + html + '</div>');
            }
        });


        $(document).on('click', '.subSummary_PaVaReKpAdd', function(e) {
            e.preventDefault();
            subSummary_PaVaReKpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="Summary_PaVaReKp[sub_'+ subSummary_PaVaReKpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleSummary_PaVaReKpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleSummary_PaVaReKpBlock', '.subsingleSummary_PaVaReKpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleSummary_PaVaReKpBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subConclusion_PaVaReKpAdd', function(e) {
            e.preventDefault();
            subConclusion_PaVaReKpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="Conclusion_PaVaReKp[sub_'+ subConclusion_PaVaReKpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleConclusion_PaVaReKpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleConclusion_PaVaReKpBlock', '.subsingleConclusion_PaVaReKpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleConclusion_PaVaReKpBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subProposedParameters_PaVaReKpAdd', function(e) {
            e.preventDefault();
            subProposedParameters_PaVaReKpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="ProposedParameters_PaVaReKp[sub_'+ subProposedParameters_PaVaReKpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleProposedParameters_PaVaReKpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleProposedParameters_PaVaReKpBlock', '.subsingleProposedParameters_PaVaReKpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleProposedParameters_PaVaReKpBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subReportApproval_PaVaReKpAdd', function(e) {
            e.preventDefault();
            subReportApproval_PaVaReKpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="ReportApproval_PaVaReKp[sub_'+ subReportApproval_PaVaReKpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleReportApproval_PaVaReKpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleReportApproval_PaVaReKpBlock', '.subsingleReportApproval_PaVaReKpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleReportApproval_PaVaReKpBlock">' + html + '</div>');
            }
        });


        //Process Validation Interim Report

        // Critical process parameters & Critical quality attributes


        $(document).on('click', '.subcritical_quality_pvirAdd', function(e) {
            e.preventDefault();
            subcritical_quality_pvirAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="critical_pvir[sub_'+ subcritical_quality_pvirAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger purpose_pvrbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleCriticalPvirBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleCriticalPvirBlock', '.subsingleCriticalPvirBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleCriticalPvirBlock">' + html + '</div>');
            }

        });

        // Results of In process data

        $(document).on('click', '.subIn_process_data_pvirAdd', function(e) {
            e.preventDefault();
            subIn_process_data_pvirAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="In_process_data_pvir[sub_'+ subIn_process_data_pvirAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.single_In_process_data_PvirBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.single_In_process_data_PvirBlock', '.subsingle_In_process_data_PvirBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingle_In_process_data_PvirBlock">' + html + '</div>');
            }
        });

         // Yield at various stages

        $(document).on('click', '.subvarious_stages_pvirAdd', function(e) {
            e.preventDefault();
            subvarious_stages_pvirAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="various_stages_pvir[sub_'+ subvarious_stages_pvirAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlevarious_stages_PvirBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlevarious_stages_PvirBlock', '.subsinglevarious_stages_PvirBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsinglevarious_stages_PvirBlock">' + html + '</div>');
            }
        });

         // Deviation (If any)

        $(document).on('click', '.subdeviation_pvirAdd', function(e) {
            e.preventDefault();
            subdeviation_pvirAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="deviation_pvir[sub_'+ subdeviation_pvirAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleDeviationBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleDeviationBlock', '.subsingleDeviationBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleDeviationBlock">' + html + '</div>');
            }
        });

       // Change Control ( If any)

        $(document).on('click', '.subchange_controlpvirAdd', function(e) {
            e.preventDefault();
            subchange_controlpvirAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="change_controlpvir[sub_'+ subchange_controlpvirAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlechange_controlPvirBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlechange_controlPvirBlock', '.subsinglechange_controlPvirBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsinglechange_controlPvirBlock">' + html + '</div>');
            }
        });

         // Summary

        $(document).on('click', '.subSummarypvirAdd', function(e) {
            e.preventDefault();
            subSummarypvirAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="Summary_pvir[sub_'+ subSummarypvirAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleSummaryPvirBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleSummaryPvirBlock', '.subsingleSummaryPvirBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleSummaryPvirBlock">' + html + '</div>');
            }
        });

      
      // Conclusion

        $(document).on('click', '.subConclusion_pvirAdd', function(e) {
            e.preventDefault();
            subConclusion_pvirAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="conclusion_pvir[sub_'+ subConclusion_pvirAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.single_Conclusion_pvirBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.single_Conclusion_pvirBlock', '.subsingle_Conclusion_pvirBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingle_Conclusion_pvirBlock">' + html + '</div>');
            }
        });


         // Report Approval

        $(document).on('click', '.subreport_approvalpvirAdd', function(e) {
            e.preventDefault();
            subreport_approvalpvirAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="report_approvalpvir[sub_'+ subreport_approvalpvirAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlereport_approvalPvirBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlereport_approvalPvirBlock', '.subsinglereport_approvalPvirBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsinglereport_approvalPvirBlock">' + html + '</div>');
            }
        });

      // ----------------------stat----format for comppress air and nitrogen tab start  gas sys protocal by kppatel--------------

        $(document).on('click', '.subProtocolapproval_FoCompAaNirogenkpAdd', function(e) {
            e.preventDefault();
            subProtocolapproval_FoCompAaNirogenkpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="Protocolapproval_FoCompAaNirogenkp[sub_'+ subProtocolapproval_FoCompAaNirogenkpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleProtocolapproval_FoCompAaNirogenkpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleProtocolapproval_FoCompAaNirogenkpBlock', '.subsingleProtocolapproval_FoCompAaNirogenkpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleProtocolapproval_FoCompAaNirogenkpBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subObjective_FoCompAaNirogenkpAdd', function(e) {
            e.preventDefault();
            subObjective_FoCompAaNirogenkpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="Objective_FoCompAaNirogenkp[sub_'+ subObjective_FoCompAaNirogenkpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleObjective_FoCompAaNirogenkpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleObjective_FoCompAaNirogenkpBlock', '.subsingleObjective_FoCompAaNirogenkpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleObjective_FoCompAaNirogenkpBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subPurpose_FoCompAaNirogenkpAdd', function(e) {
            e.preventDefault();
            subPurpose_FoCompAaNirogenkpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="Purpose_FoCompAaNirogenkp[sub_'+ subPurpose_FoCompAaNirogenkpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlePurpose_FoCompAaNirogenkpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlePurpose_FoCompAaNirogenkpBlock', '.subsinglePurpose_FoCompAaNirogenkpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsinglePurpose_FoCompAaNirogenkpBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subScope_FoCompAaNirogenkpAdd', function(e) {
            e.preventDefault();
            subScope_FoCompAaNirogenkpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="Scope_FoCompAaNirogenkp[sub_'+ subScope_FoCompAaNirogenkpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleScope_FoCompAaNirogenkpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleScope_FoCompAaNirogenkpBlock', '.subsingleScope_FoCompAaNirogenkpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleScope_FoCompAaNirogenkpBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subExcutionTeamResp_FoCompAaNirogenkpAdd', function(e) {
            e.preventDefault();
            subExcutionTeamResp_FoCompAaNirogenkpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="ExcutionTeamResp_FoCompAaNirogenkp[sub_'+ subExcutionTeamResp_FoCompAaNirogenkpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleExcutionTeamResp_FoCompAaNirogenkpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleExcutionTeamResp_FoCompAaNirogenkpBlock', '.subsingleExcutionTeamResp_FoCompAaNirogenkpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleExcutionTeamResp_FoCompAaNirogenkpBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subAbbreviations_FoCompAaNirogenkpAdd', function(e) {
            e.preventDefault();
            subAbbreviations_FoCompAaNirogenkpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="Abbreviations_FoCompAaNirogenkp[sub_'+ subAbbreviations_FoCompAaNirogenkpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleAbbreviations_FoCompAaNirogenkpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleAbbreviations_FoCompAaNirogenkpBlock', '.subsingleAbbreviations_FoCompAaNirogenkpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleAbbreviations_FoCompAaNirogenkpBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subDocumentFollowed_FoCompAaNirogenkpAdd', function(e) {
            e.preventDefault();
            subDocumentFollowed_FoCompAaNirogenkpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="DocumentFollowed_FoCompAaNirogenkp[sub_'+ subDocumentFollowed_FoCompAaNirogenkpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleDocumentFollowed_FoCompAaNirogenkpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleDocumentFollowed_FoCompAaNirogenkpBlock', '.subsingleDocumentFollowed_FoCompAaNirogenkpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleDocumentFollowed_FoCompAaNirogenkpBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subGenralConsPre_FoCompAaNirogenkpAdd', function(e) {
            e.preventDefault();
            subGenralConsPre_FoCompAaNirogenkpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="GenralConsPre_FoCompAaNirogenkp[sub_'+ subGenralConsPre_FoCompAaNirogenkpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleGenralConsPre_FoCompAaNirogenkpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleGenralConsPre_FoCompAaNirogenkpBlock', '.subsingleGenralConsPre_FoCompAaNirogenkpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleGenralConsPre_FoCompAaNirogenkpBlock">' + html + '</div>');
            }
        });


        $(document).on('click', '.subRevalidCrite_FoCompAaNirogenkpAdd', function(e) {
            e.preventDefault();
            subRevalidCrite_FoCompAaNirogenkpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="RevalidCrite_FoCompAaNirogenkp[sub_'+ subRevalidCrite_FoCompAaNirogenkpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleRevalidCrite_FoCompAaNirogenkpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleRevalidCrite_FoCompAaNirogenkpBlock', '.subsingleRevalidCrite_FoCompAaNirogenkpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleRevalidCrite_FoCompAaNirogenkpBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subPrecautions_FoCompAaNirogenkpAdd', function(e) {
            e.preventDefault();
            subPrecautions_FoCompAaNirogenkpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="Precautions_FoCompAaNirogenkp[sub_'+ subPrecautions_FoCompAaNirogenkpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlePrecautions_FoCompAaNirogenkpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlePrecautions_FoCompAaNirogenkpBlock', '.subsinglePrecautions_FoCompAaNirogenkpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsinglePrecautions_FoCompAaNirogenkpBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subRevalidProcess_FoCompAaNirogenkpAdd', function(e) {
            e.preventDefault();
            subRevalidProcess_FoCompAaNirogenkpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="RevalidProcess_FoCompAaNirogenkp[sub_'+ subRevalidProcess_FoCompAaNirogenkpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleRevalidProcess_FoCompAaNirogenkpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleRevalidProcess_FoCompAaNirogenkpBlock', '.subsingleRevalidProcess_FoCompAaNirogenkpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleRevalidProcess_FoCompAaNirogenkpBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subAcceptanceCrite_FoCompAaNirogenkpAdd', function(e) {
            e.preventDefault();
            subAcceptanceCrite_FoCompAaNirogenkpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="AcceptanceCrite_FoCompAaNirogenkp[sub_'+ subAcceptanceCrite_FoCompAaNirogenkpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleAcceptanceCrite_FoCompAaNirogenkpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleAcceptanceCrite_FoCompAaNirogenkpBlock', '.subsingleAcceptanceCrite_FoCompAaNirogenkpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleAcceptanceCrite_FoCompAaNirogenkpBlock">' + html + '</div>');
            }
        });


        $(document).on('click', '.subAnnexure_FoCompAaNirogenkpAdd', function(e) {
            e.preventDefault();
            subAnnexure_FoCompAaNirogenkpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="Annexure_FoCompAaNirogenkp[sub_'+ subAnnexure_FoCompAaNirogenkpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleAnnexure_FoCompAaNirogenkpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleAnnexure_FoCompAaNirogenkpBlock', '.subsingleAnnexure_FoCompAaNirogenkpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleAnnexure_FoCompAaNirogenkpBlock">' + html + '</div>');
            }
        });


        $(document).on('click', '.subEnvironmentalhtspAdd', function(e) {
            e.preventDefault();
            subEnvironmentalhtspAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="htsp_environmental_conditions[sub_'+ subEnvironmentalhtspAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.EnvironmentalhtspBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.EnvironmentalhtspBlock', '.subEnvironmentalhtspBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subEnvironmentalhtspBlock">' + html + '</div>');
            }

        });

        $(document).on('click', '.subSamplehtpsAdd', function(e) {
            e.preventDefault();
            subSamplehtpsAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="htsp_sample_quantity_calculation[sub_'+ subSamplehtpsAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.SamplehtpsBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.SamplehtpsBlock', '.subSamplehtpsBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSamplehtpsBlock">' + html + '</div>');
            }

        });


        
        $(document).on('click', '.subDeviationhtpsAdd', function(e) {
            e.preventDefault();
            subDeviationhtpsAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="htsp_deviation[sub_'+ subDeviationhtpsAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.DeviationhtpsBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.DeviationhtpsBlock', '.subDeviationhtpsBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subDeviationhtpsBlock">' + html + '</div>');
            }

        });

        $(document).on('click', '.subSummaryhtpsAdd', function(e) {
            e.preventDefault();
            subSummaryhtpsAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="htsp_summary[sub_'+ subSummaryhtpsAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.SummaryhtpsBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.SummaryhtpsBlock', '.subSummaryhtpsBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSummaryhtpsBlock">' + html + '</div>');
            }

        });


        $(document).on('click', '.subreasonforvalidationpvpAdd', function(e) {
            e.preventDefault();
            subreasonforvalidationpvpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="reasonfor_validationpvp[sub_'+ subreasonforvalidationpvpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.reasonforvalidationpvpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.reasonforvalidationpvpBlock', '.subreasonforvalidationpvpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subreasonforvalidationpvpBlock">' + html + '</div>');
            }

        });

        $(document).on('click', '.subStabilitystudypvpAdd', function(e) {
            e.preventDefault();
            subStabilitystudypvpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="Stability_studypvp[sub_'+ subStabilitystudypvpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.StabilitystudypvpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.StabilitystudypvpBlock', '.subStabilitystudypvpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subStabilitystudypvpBlock">' + html + '</div>');
            }

        });


        $(document).on('click', '.subresponsibilitypvpAdd', function(e) {
            e.preventDefault();
            subresponsibilitypvpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="pvp_responsibility[sub_'+ subresponsibilitypvpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.responsibilitypvpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.responsibilitypvpBlock', '.subresponsibilitypvpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subresponsibilitypvpBlock">' + html + '</div>');
            }

        });


        $(document).on('click', '.subvalidationpvpAdd', function(e) {
            e.preventDefault();
            subvalidationpvpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="pvp_validationpvp[sub_'+ subvalidationpvpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.validationpvpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.validationpvpBlock', '.subvalidationpvpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subvalidationpvpBlock">' + html + '</div>');
            }

        });


        $(document).on('click', '.subdescriptionsoppvpAdd', function(e) {
            e.preventDefault();
            subdescriptionsoppvpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="descriptionsop_pvp[sub_'+ subdescriptionsoppvpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.descriptionsoppvpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.descriptionsoppvpBlock', '.subdescriptionsoppvpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subdescriptionsoppvpBlock">' + html + '</div>');
            }

        });

        $(document).on('click', '.subpackingmaterialpvpAdd', function(e) {
            e.preventDefault();
            subpackingmaterialpvpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="packingmaterial_pvp[sub_'+ subpackingmaterialpvpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.packingmaterialpvpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.packingmaterialpvpBlock', '.subpackingmaterialpvpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subpackingmaterialpvpBlock">' + html + '</div>');
            }

        });

        $(document).on('click', '.subequipmentpvpAdd', function(e) {
            e.preventDefault();
            subequipmentpvpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="equipment_pvp[sub_'+ subequipmentpvpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.equipmentpvpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.equipmentpvpBlock', '.subequipmentpvpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subequipmentpvpBlock">' + html + '</div>');
            }

        });

        $(document).on('click', '.subrationalepvpAdd', function(e) {
            e.preventDefault();
            subrationalepvpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="rationale_pvp[sub_'+ subrationalepvpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.rationalepvpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.rationalepvpBlock', '.subrationalepvpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subrationalepvpBlock">' + html + '</div>');
            }

        });

        $(document).on('click', '.subsamplingpvpAdd', function(e) {
            e.preventDefault();
            subsamplingpvpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="sampling_pvp[sub_'+ subsamplingpvpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.samplingpvpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.samplingpvpBlock', '.subsamplingpvpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsamplingpvpBlock">' + html + '</div>');
            }

        });

        $(document).on('click', '.subCriticalpvpAdd', function(e) {
            e.preventDefault();
            subCriticalpvpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="critical_pvp[sub_'+ subCriticalpvpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.CriticalpvpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.CriticalpvpBlock', '.subCriticalpvpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subCriticalpvpBlock">' + html + '</div>');
            }

        });

        $(document).on('click', '.subProductAcceptancepvpAdd', function(e) {
            e.preventDefault();
            subProductAcceptancepvpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="product_acceptancepvp[sub_'+ subProductAcceptancepvpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.ProductAcceptancepvpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.ProductAcceptancepvpBlock', '.subProductAcceptancepvpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subProductAcceptancepvpBlock">' + html + '</div>');
            }

        });

        $(document).on('click', '.subHoldtimepvpAdd', function(e) {
            e.preventDefault();
            subHoldtimepvpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="Holdtime_pvp[sub_'+ subHoldtimepvpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.HoldtimepvpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.HoldtimepvpBlock', '.subHoldtimepvpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subHoldtimepvpBlock">' + html + '</div>');
            }

        });




        $(document).on('click', '.subCleaningvalidationpvpAdd', function(e) {
            e.preventDefault();
            subCleaningvalidationpvpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="cleaning_validationpvp[sub_'+ subCleaningvalidationpvpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.CleaningvalidationpvpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.CleaningvalidationpvpBlock', '.subCleaningvalidationpvpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subCleaningvalidationpvpBlock">' + html + '</div>');
            }

        });

        $(document).on('click', '.subDeviationpvpAdd', function(e) {
            e.preventDefault();
            subDeviationpvpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="Deviation_pvp[sub_'+ subDeviationpvpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.DeviationpvpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.DeviationpvpBlock', '.subDeviationpvpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subDeviationpvpBlock">' + html + '</div>');
            }

        });




        $(document).on('click', '.subChangecontrolpvpAdd', function(e) {
            e.preventDefault();
            subChangecontrolpvpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="Change_controlpvp[sub_'+ subChangecontrolpvpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.ChangecontrolpvpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.ChangecontrolpvpBlock', '.subChangecontrolpvpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subChangecontrolpvpBlock">' + html + '</div>');
            }

        });




        $(document).on('click', '.subSummarypvpAdd', function(e) {
            e.preventDefault();
            subSummarypvpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="Summary_pvp[sub_'+ subSummarypvpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.SummarypvpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.SummarypvpBlock', '.subSummarypvpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSummarypvpBlock">' + html + '</div>');
            }

        });




        $(document).on('click', '.subConclusionpvpAdd', function(e) {
            e.preventDefault();
            subConclusionpvpAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="Conclusion_pvp[sub_'+ subConclusionpvpAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.ConclusionpvpBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.ConclusionpvpBlock', '.subConclusionpvpBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subConclusionpvpBlock">' + html + '</div>');
            }

        });


        $(document).on('click', '.subAccountabilityAdd', function(e) {
            e.preventDefault();
            subAccountabilityAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="accountability[sub_'+ subAccountabilityAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleAccountabilityBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleAccountabilityBlock', '.subSingleAccountabilityBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleAccountabilityBlock">' + html + '</div>');
            }

        });


        $(document).on('click', '.subConclusionhtpseAdd', function(e) {
            e.preventDefault();
            subConclusionhtpseAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="htsp_conclusion[sub_'+ subConclusionhtpseAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.ConclusionhtpsBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.ConclusionhtpsBlock', '.subConclusionhtpsBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subConclusionhtpsBlock">' + html + '</div>');
            }

        });


        $(document).on('click', '.subResponsibilityAdd', function(e) {
            e.preventDefault();
            subResponsibilityAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="responsibility[sub_'+ subResponsibilityAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleResponsibilityBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleResponsibilityBlock', '.subSingleResponsibilityBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleResponsibilityBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subProtocolApproval_TemperMapAdd', function(e) {
            e.preventDefault();
            subProtocolApproval_TemperMapAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="ProtocolApproval_TemperMap[sub_'+ subProtocolApproval_TemperMapAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleProtocolApproval_TemperMapBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleProtocolApproval_TemperMapBlock', '.subsingleProtocolApproval_TemperMapBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleProtocolApproval_TemperMapBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subObjective_TemperMapAdd', function(e) {
            e.preventDefault();
            subObjective_TemperMapAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="Objective_TemperMap[sub_'+ subObjective_TemperMapAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleObjective_TemperMapBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleObjective_TemperMapBlock', '.subsingleObjective_TemperMapBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleObjective_TemperMapBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subScope_TemperMapAdd', function(e) {
            e.preventDefault();
            subScope_TemperMapAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="Scope_TemperMap[sub_'+ subScope_TemperMapAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleScope_TemperMapBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleScope_TemperMapBlock', '.subsingleScope_TemperMapBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleScope_TemperMapBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subAreaValidated_TemperMapAdd', function(e) {
            e.preventDefault();
            subAreaValidated_TemperMapAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="AreaValidated_TemperMap[sub_'+ subAreaValidated_TemperMapAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleAreaValidated_TemperMapBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleAreaValidated_TemperMapBlock', '.subsingleAreaValidated_TemperMapBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleAreaValidated_TemperMapBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subValidationTeamResponsibilities_TemperMapAdd', function(e) {
            e.preventDefault();
            subValidationTeamResponsibilities_TemperMapAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="ValidationTeamResponsibilities_TemperMap[sub_'+ subValidationTeamResponsibilities_TemperMapAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleValidationTeamResponsibilities_TemperMapBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleValidationTeamResponsibilities_TemperMapBlock', '.subsingleValidationTeamResponsibilities_TemperMapBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleValidationTeamResponsibilities_TemperMapBlock">' + html + '</div>');
            }
        });


        //saurav 
        $(document).on('click', '.subResponsibilitiesAdd', function(e) {
            e.preventDefault();
            subResponsibilitiesAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="responsibilities[sub_'+ subResponsibilitiesAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleResponsibilitiesBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleResponsibilitiesBlock', '.subSingleResponsibilitiesBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleResponsibilitiesBlock">' + html + '</div>');
            }
        });


        $(document).on('click', '.substResponsibilityAdd', function(e) {
            e.preventDefault();
            substResponsibilityAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="stresponsibility[sub_'+ substResponsibilityAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleStResponsibilityBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleStResponsibilityBlock', '.subSingleStResponsibilityBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleStResponsibilityBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.substdefinationAdd', function(e) {
            e.preventDefault();
            substdefinationAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="stdefination[sub_'+ substdefinationAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlestdefinationBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlestdefinationBlock', '.subSinglestdefinationBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSinglestdefinationBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.substreferencesAdd', function(e) {
            e.preventDefault();
            substreferencesAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="streferences[sub_'+ substreferencesAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlestreferencesBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlestreferencesBlock', '.subSinglestreferencesBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSinglestreferencesBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.substbackgroundAdd', function(e) {
            e.preventDefault();
            substbackgroundAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="stbackground[sub_'+ substbackgroundAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlestbackgroundBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlestbackgroundBlock', '.subSinglestbackgroundBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSinglestbackgroundBlock">' + html + '</div>');
            }
        });


        $(document).on('click', '.substassessmentAdd', function(e) {
            e.preventDefault();
            substassessmentAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="stassessment[sub_'+ substassessmentAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlestassessmentBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlestassessmentBlock', '.subSinglestassessmentBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSinglestassessmentBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subststrategyAdd', function(e) {
            e.preventDefault();
            subststrategyAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="ststrategy[sub_'+ subststrategyAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleststrategyBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleststrategyBlock', '.subSingleststrategyBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleststrategyBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.substsummaryAdd', function(e) {
            e.preventDefault();
            substsummaryAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="stsummary[sub_'+ substsummaryAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlestsummaryBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlestsummaryBlock', '.subsinglestsummaryBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsinglestsummaryBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.substconclusionAdd', function(e) {
            e.preventDefault();
            substconclusionAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="stconclusion[sub_'+ substconclusionAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlestconclusionBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlestconclusionBlock', '.subsinglestconclusionBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsinglestconclusionBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.substannexureAdd', function(e) {
            e.preventDefault();
            substannexureAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="stannexure[sub_'+ substannexureAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlestannexureBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlestannexureBlock', '.subsinglestannexureBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsinglestannexureBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.substReferencedocunumAdd', function(e) {
            e.preventDefault();
            substReferencedocunumAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="Referencedocunum[sub_'+ substReferencedocunumAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleReferencedocunumBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleReferencedocunumBlock', '.subsingleReferencedocunumBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleReferencedocunumBlock">' + html + '</div>');
            }
        });


        $(document).on('click', '.subAssessmentAdd', function(e) {
            e.preventDefault();
            subAssessmentAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="assessment[sub_'+ subAssessmentAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleAssessmentBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleAssessmentBlock', '.subSingleAssessmentBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleAssessmentBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subStrategyAdd', function(e) {
            e.preventDefault();
            subStrategyAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="strategy[sub_'+ subStrategyAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleStrategyBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleStrategyBlock', '.subSingleStrategyBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleStrategyBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subSummaryAdd', function(e) {
            e.preventDefault();
            subSummaryAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="summary_and_findings[sub_'+ subSummaryAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleSummaryBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleSummaryBlock', '.subSingleSummaryBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleSummaryBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subConclusionAdd', function(e) {
            e.preventDefault();
            subConclusionAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="conclusion_and_recommendations[sub_'+ subConclusionAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleConclusionBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleConclusionBlock', '.subSingleConclusionBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleConclusionBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subReferencesssAdd', function(e) {
            e.preventDefault();
            subReferencesssAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="referencesss[sub_'+ subReferencesssAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleReferencesssBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleReferencesssBlock', '.subSingleReferencesssBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleReferencesssBlock">' + html + '</div>');
            }
        });


        $(document).on('click', '.subEuipmentResponsibilityAdd', function(e) {
            e.preventDefault();
            subEuipmentResponsibilityAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="euipmentresponsibility[sub_'+ subEuipmentResponsibilityAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleEuipmentResponsibilityBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleEuipmentResponsibilityBlock', '.subSingleEuipmentResponsibilityBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleEuipmentResponsibilityBlock">' + html + '</div>');
            }
        });


        $(document).on('click', '.subEqpAnalyticalReportAdd', function(e) {
            e.preventDefault();
            subEqpAnalyticalReportAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="eqpAnalyticalReport[sub_'+ subEqpAnalyticalReportAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleEqpAnalyticalReportBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleEqpAnalyticalReportBlock', '.subSingleEqpAnalyticalReportBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleEqpAnalyticalReportBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subEqpdeviationAdd', function(e) {
            e.preventDefault();
            subEqpdeviationAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="eqpdeviation[sub_'+ subEqpdeviationAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleEqpdeviationBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleEqpdeviationBlock', '.subSingleEqpdeviationBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleEqpdeviationBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subEqpchangecontrolAdd', function(e) {
            e.preventDefault();
            subEqpchangecontrolAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="eqpchangecontrol[sub_'+ subEqpchangecontrolAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleEqpchangecontrolBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleEqpchangecontrolBlock', '.subSingleEqpchangecontrolBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleEqpchangecontrolBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subEqpsummaryAdd', function(e) {
            e.preventDefault();
            subEqpsummaryAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="eqpsummary[sub_'+ subEqpsummaryAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleEqpsummaryBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleEqpsummaryBlock', '.subSingleEqpsummaryBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleEqpsummaryBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subeqpconclusionAdd', function(e) {
            e.preventDefault();
            subeqpconclusionAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="eqpconclusion[sub_'+ subeqpconclusionAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleEqpconclusionBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleEqpconclusionBlock', '.subSingleEqpconclusionBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleEqpconclusionBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subeqpreportapprovalAdd', function(e) {
            e.preventDefault();
            subeqpreportapprovalAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="eqpreportapproval[sub_'+ subeqpreportapprovalAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleEqpreportapprovalBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleEqpreportapprovalBlock', '.subSingleEqpreportapprovalBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleEqpreportapprovalBlock">' + html + '</div>');
            }
        });


        $(document).on('click', '.subReference_TemperMapAdd', function(e) {
            e.preventDefault();
            subReference_TemperMapAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="Reference_TemperMap[sub_'+ subReference_TemperMapAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleReference_TemperMapBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleReference_TemperMapBlock', '.subsingleReference_TemperMapBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleReference_TemperMapBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subDocumentFollowed_TemperMapAdd', function(e) {
            e.preventDefault();
            subDocumentFollowed_TemperMapAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="DocumentFollowed_TemperMap[sub_'+ subDocumentFollowed_TemperMapAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleDocumentFollowed_TemperMapBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleDocumentFollowed_TemperMapBlock', '.subsingleDocumentFollowed_TemperMapBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleDocumentFollowed_TemperMapBlock">' + html + '</div>');
            }
        });


        $(document).on('click', '.subStudyRationale_TemperMapAdd', function(e) {
            e.preventDefault();
            subStudyRationale_TemperMapAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="StudyRationale_TemperMap[sub_'+ subStudyRationale_TemperMapAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleStudyRationale_TemperMapBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleStudyRationale_TemperMapBlock', '.subsingleStudyRationale_TemperMapBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleStudyRationale_TemperMapBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subProcedure_TemperMapAdd', function(e) {
            e.preventDefault();
            subProcedure_TemperMapAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="Procedure_TemperMap[sub_'+ subProcedure_TemperMapAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleProcedure_TemperMapBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleProcedure_TemperMapBlock', '.subsingleProcedure_TemperMapBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleProcedure_TemperMapBlock">' + html + '</div>');
            }
        });


        $(document).on('click', '.subCriteriaRevalidation_TemperMapAdd', function(e) {
            e.preventDefault();
            subCriteriaRevalidation_TemperMapAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="CriteriaRevalidation_TemperMap[sub_'+ subCriteriaRevalidation_TemperMapAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleCriteriaRevalidation_TemperMapBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleCriteriaRevalidation_TemperMapBlock', '.subsingleCriteriaRevalidation_TemperMapBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleCriteriaRevalidation_TemperMapBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subMaterialDocumentRequired_TemperMapAdd', function(e) {
            e.preventDefault();
            subMaterialDocumentRequired_TemperMapAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="MaterialDocumentRequired_TemperMap[sub_'+ subMaterialDocumentRequired_TemperMapAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleMaterialDocumentRequired_TemperMapBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleMaterialDocumentRequired_TemperMapBlock', '.subsingleMaterialDocumentRequired_TemperMapBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleMaterialDocumentRequired_TemperMapBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subAcceptanceCriteria_TemperMapAdd', function(e) {
            e.preventDefault();
            subAcceptanceCriteria_TemperMapAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="AcceptanceCriteria_TemperMap[sub_'+ subAcceptanceCriteria_TemperMapAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleAcceptanceCriteria_TemperMapBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleAcceptanceCriteria_TemperMapBlock', '.subsingleAcceptanceCriteria_TemperMapBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleAcceptanceCriteria_TemperMapBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subTypeofValidation_TemperMapAdd', function(e) {
            e.preventDefault();
            subTypeofValidation_TemperMapAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="TypeofValidation_TemperMap[sub_'+ subTypeofValidation_TemperMapAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleTypeofValidation_TemperMapBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleTypeofValidation_TemperMapBlock', '.subsingleTypeofValidation_TemperMapBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleTypeofValidation_TemperMapBlock">' + html + '</div>');
            }
        });


        $(document).on('click', '.subObservationResult_TemperMapAdd', function(e) {
            e.preventDefault();
            subObservationResult_TemperMapAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="ObservationResult_TemperMap[sub_'+ subObservationResult_TemperMapAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleObservationResult_TemperMapBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleObservationResult_TemperMapBlock', '.subsingleObservationResult_TemperMapBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleObservationResult_TemperMapBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subAbbreviations_TemperMapAdd', function(e) {
            e.preventDefault();
            subAbbreviations_TemperMapAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="Abbreviations_TemperMap[sub_'+ subAbbreviations_TemperMapAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleAbbreviations_TemperMapBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleAbbreviations_TemperMapBlock', '.subsingleAbbreviations_TemperMapBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleAbbreviations_TemperMapBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subDeviationAny_TemperMapAdd', function(e) {
            e.preventDefault();
            subDeviationAny_TemperMapAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="DeviationAny_TemperMap[sub_'+ subDeviationAny_TemperMapAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleDeviationAny_TemperMapBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleDeviationAny_TemperMapBlock', '.subsingleDeviationAny_TemperMapBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleDeviationAny_TemperMapBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subChangeControl_TemperMapAdd', function(e) {
            e.preventDefault();
            subChangeControl_TemperMapAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="ChangeControl_TemperMap[sub_'+ subChangeControl_TemperMapAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleChangeControl_TemperMapBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleChangeControl_TemperMapBlock', '.subsingleChangeControl_TemperMapBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleChangeControl_TemperMapBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subSummary_TemperMapAdd', function(e) {
            e.preventDefault();
            subSummary_TemperMapAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="Summary_TemperMap[sub_'+ subSummary_TemperMapAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleSummary_TemperMapBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleSummary_TemperMapBlock', '.subsingleSummary_TemperMapBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleSummary_TemperMapBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subConclusion_TemperMapAdd', function(e) {
            e.preventDefault();
            subConclusion_TemperMapAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="Conclusion_TemperMap[sub_'+ subConclusion_TemperMapAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleConclusion_TemperMapBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleConclusion_TemperMapBlock', '.subsingleConclusion_TemperMapBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleConclusion_TemperMapBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subobjective_cvpdAdd', function(e) {
            e.preventDefault();
            subobjective_cvpdAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="objective_cvpd[sub_'+ subobjective_cvpdAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger objective_cvpdbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleobjective_cvpdBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleobjective_cvpdBlock', '.subSingleobjective_cvpdBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleobjective_cvpdBlock">' + html + '</div>');
            }
        });


        $(document).on('click', '.subscope_cvpdAdd', function(e) {
            e.preventDefault();
            subscope_cvpdAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="scope_cvpd[sub_'+ subscope_cvpdAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger scope_cvpdbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlescope_cvpdBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlescope_cvpdBlock', '.subSinglescope_cvpdBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSinglescope_cvpdBlock">' + html + '</div>');
            }
        });


        $(document).on('click', '.subpurpose_cvpdAdd', function(e) {
            e.preventDefault();
            subpurpose_cvpdAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="purpose_cvpd[sub_'+ subpurpose_cvpdAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger purpose_cvpdbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlepurpose_cvpdBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlepurpose_cvpdBlock', '.subSinglepurpose_cvpdBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSinglepurpose_cvpdBlock">' + html + '</div>');
            }
        });



        
        $(document).on('click', '.subresponsibilities_cvpdAdd', function(e) {
            e.preventDefault();
            subresponsibilities_cvpdAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="responsibilities_cvpd[sub_'+ subresponsibilities_cvpdAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger responsibilities_cvpdbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleresponsibilities_cvpdBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleresponsibilities_cvpdBlock', '.subSingleresponsibilities_cvpdBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleresponsibilities_cvpdBlock">' + html + '</div>');
            }
        });



        ////////////////////////


        
        $(document).on('click', '.subidentification_sensitive_product_contamination_cvpdAdd', function(e) {
            e.preventDefault();
            subidentification_sensitive_product_contamination_cvpdAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="identification_sensitive_product_contamination_cvpd[sub_'+ subidentification_sensitive_product_contamination_cvpdAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger identification_sensitive_product_contamination_cvpdbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleidentification_sensitive_product_contamination_cvpdBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleidentification_sensitive_product_contamination_cvpdBlock', '.subSingleidentification_sensitive_product_contamination_cvpdBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleidentification_sensitive_product_contamination_cvpdBlock">' + html + '</div>');
            }
        });

        
        $(document).on('click', '.submatrix_worstcase_approach_cvpdAdd', function(e) {
            e.preventDefault();
            submatrix_worstcase_approach_cvpdAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="matrix_worstcase_approach_cvpd[sub_'+ submatrix_worstcase_approach_cvpdAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger matrix_worstcase_approach_cvpdbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlematrix_worstcase_approach_cvpdBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlematrix_worstcase_approach_cvpdBlock', '.subSinglematrix_worstcase_approach_cvpdBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSinglematrix_worstcase_approach_cvpdBlock">' + html + '</div>');
            }
        });


        
        $(document).on('click', '.subacceptance_criteria_cvpdAdd', function(e) {
            e.preventDefault();
            subacceptance_criteria_cvpdAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="acceptance_criteria_cvpd[sub_'+ subacceptance_criteria_cvpdAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger acceptance_criteria_cvpdbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleacceptance_criteria_cvpdBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleacceptance_criteria_cvpdBlock', '.subSingleacceptance_criteria_cvpdBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleacceptance_criteria_cvpdBlock">' + html + '</div>');
            }
        });


        
        $(document).on('click', '.sublist_equipment_internal_surface_cvpdAdd', function(e) {
            e.preventDefault();
            sublist_equipment_internal_surface_cvpdAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="list_equipment_internal_surface_cvpd[sub_'+ sublist_equipment_internal_surface_cvpdAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger list_equipment_internal_surface_cvpdbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlelist_equipment_internal_surface_cvpdBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlelist_equipment_internal_surface_cvpdBlock', '.subSinglelist_equipment_internal_surface_cvpdBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSinglelist_equipment_internal_surface_cvpdBlock">' + html + '</div>');
            }
        });


        
        $(document).on('click', '.subidentification_clean_surfaces_cvpdAdd', function(e) {
            e.preventDefault();
            subidentification_clean_surfaces_cvpdAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="identification_clean_surfaces_cvpd[sub_'+ subidentification_clean_surfaces_cvpdAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger identification_clean_surfaces_cvpdbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleidentification_clean_surfaces_cvpdBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleidentification_clean_surfaces_cvpdBlock', '.subSingleidentification_clean_surfaces_cvpdBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleidentification_clean_surfaces_cvpdBlock">' + html + '</div>');
            }
        });


        
        $(document).on('click', '.subsampling_method_cvpdAdd', function(e) {
            e.preventDefault();
            subsampling_method_cvpdAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="sampling_method_cvpd[sub_'+ subsampling_method_cvpdAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger sampling_method_cvpdbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlesampling_method_cvpdBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlesampling_method_cvpdBlock', '.subSinglesampling_method_cvpdBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSinglesampling_method_cvpdBlock">' + html + '</div>');
            }
        });

        
        $(document).on('click', '.subrecovery_studies_cvpdAdd', function(e) {
            e.preventDefault();
            subrecovery_studies_cvpdAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="recovery_studies_cvpd[sub_'+ subrecovery_studies_cvpdAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger recovery_studies_cvpdbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlerecovery_studies_cvpdBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlerecovery_studies_cvpdBlock', '.subSinglerecovery_studies_cvpdBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSinglerecovery_studies_cvpdBlock">' + html + '</div>');
            }
        });


        
        $(document).on('click', '.subcalculating_carry_over_cvpdAdd', function(e) {
            e.preventDefault();
            subcalculating_carry_over_cvpdAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="calculating_carry_over_cvpd[sub_'+ subcalculating_carry_over_cvpdAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger calculating_carry_over_cvpdbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlecalculating_carry_over_cvpdBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlecalculating_carry_over_cvpdBlock', '.subSinglecalculating_carry_over_cvpdBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSinglecalculating_carry_over_cvpdBlock">' + html + '</div>');
            }
        });

        
        $(document).on('click', '.subcalculating_rinse_analysis_cvpdAdd', function(e) {
            e.preventDefault();
            subcalculating_rinse_analysis_cvpdAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="calculating_rinse_analysis_cvpd[sub_'+ subcalculating_rinse_analysis_cvpdAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger calculating_rinse_analysis_cvpdbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlecalculating_rinse_analysis_cvpdBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlecalculating_rinse_analysis_cvpdBlock', '.subSinglecalculating_rinse_analysis_cvpdBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSinglecalculating_rinse_analysis_cvpdBlock">' + html + '</div>');
            }
        });


        
        $(document).on('click', '.subgeneral_procedure_clean_cvpdAdd', function(e) {
            e.preventDefault();
            subgeneral_procedure_clean_cvpdAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="general_procedure_clean_cvpd[sub_'+ subgeneral_procedure_clean_cvpdAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger general_procedure_clean_cvpdbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlegeneral_procedure_clean_cvpdBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlegeneral_procedure_clean_cvpdBlock', '.subSinglegeneral_procedure_clean_cvpdBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSinglegeneral_procedure_clean_cvpdBlock">' + html + '</div>');
            }
        });

        
        $(document).on('click', '.subanalytical_method_validation_cvpdAdd', function(e) {
            e.preventDefault();
            subanalytical_method_validation_cvpdAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="analytical_method_validation_cvpd[sub_'+ subanalytical_method_validation_cvpdAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger analytical_method_validation_cvpdbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleanalytical_method_validation_cvpdBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleanalytical_method_validation_cvpdBlock', '.subSingleanalytical_method_validation_cvpdBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleanalytical_method_validation_cvpdBlock">' + html + '</div>');
            }
        });

        
        $(document).on('click', '.sublist_cleaning_sop_cvpdAdd', function(e) {
            e.preventDefault();
            sublist_cleaning_sop_cvpdAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="list_cleaning_sop_cvpd[sub_'+ sublist_cleaning_sop_cvpdAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger list_cleaning_sop_cvpdbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlelist_cleaning_sop_cvpdBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlelist_cleaning_sop_cvpdBlock', '.subSinglelist_cleaning_sop_cvpdBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSinglelist_cleaning_sop_cvpdBlock">' + html + '</div>');
            }
        });












        $(document).on('click', '.subclean_validation_exercise_cvpdAdd', function(e) {
            e.preventDefault();
            subclean_validation_exercise_cvpdAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="clean_validation_exercise_cvpd[sub_'+ subclean_validation_exercise_cvpdAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger clean_validation_exercise_cvpdbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleclean_validation_exercise_cvpdBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleclean_validation_exercise_cvpdBlock', '.subSingleclean_validation_exercise_cvpdBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleclean_validation_exercise_cvpdBlock">' + html + '</div>');
            }
        });


        $(document).on('click', '.subevaluation_analytical_result_cvpdAdd', function(e) {
            e.preventDefault();
            subevaluation_analytical_result_cvpdAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="evaluation_analytical_result_cvpd[sub_'+ subevaluation_analytical_result_cvpdAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger evaluation_analytical_result_cvpdbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleevaluation_analytical_result_cvpdBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleevaluation_analytical_result_cvpdBlock', '.subSingleevaluation_analytical_result_cvpdBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleevaluation_analytical_result_cvpdBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subsummary_conclusion_cvpdAdd', function(e) {
            e.preventDefault();
            subsummary_conclusion_cvpdAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="summary_conclusion_cvpd[sub_'+ subsummary_conclusion_cvpdAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger summary_conclusion_cvpdbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlesummary_conclusion_cvpdBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlesummary_conclusion_cvpdBlock', '.subSinglesummary_conclusion_cvpdBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSinglesummary_conclusion_cvpdBlock">' + html + '</div>');
            }
        });



        $(document).on('click', '.subtraining_cvpdAdd', function(e) {
            e.preventDefault();
            subtraining_cvpdAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="training_cvpd[sub_'+ subtraining_cvpdAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger training_cvpdbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singletraining_cvpdBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singletraining_cvpdBlock', '.subSingletraining_cvpdBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingletraining_cvpdBlock">' + html + '</div>');
            }
        });


         // cleaning validation Report.doc

         
        $(document).on('click', '.subobjective_cvrdAdd', function(e) {
            e.preventDefault();
            subobjective_cvrdAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="objective_cvrd[sub_'+ subobjective_cvrdAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleobjective_cvrdBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleobjective_cvrdBlock', '.subSingleobjective_cvrdBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleobjective_cvrdBlock">' + html + '</div>');
            }
        });


        
        $(document).on('click', '.subscope_cvrdAdd', function(e) {
            e.preventDefault();
            subscope_cvrdAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="scope_cvrd[sub_'+ subscope_cvrdAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlescope_cvrdBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlescope_cvrdBlock', '.subSinglescope_cvrdBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSinglescope_cvrdBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subpurpose_cvrdAdd', function(e) {
            e.preventDefault();
            subpurpose_cvrdAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="purpose_cvrd[sub_'+ subpurpose_cvrdAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlepurpose_cvrdBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlepurpose_cvrdBlock', '.subSinglepurpose_cvrdBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSinglepurpose_cvrdBlock">' + html + '</div>');
            }
        });


        
        $(document).on('click', '.subresponsibilities_cvrdAdd', function(e) {
            e.preventDefault();
            subresponsibilities_cvrdAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="responsibilities_cvrd[sub_'+ subresponsibilities_cvrdAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleresponsibilities_cvrdBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleresponsibilities_cvrdBlock', '.subSingleresponsibilities_cvrdBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleresponsibilities_cvrdBlock">' + html + '</div>');
            }
        });


        
        $(document).on('click', '.subanalysis_methodology_cvrdAdd', function(e) {
            e.preventDefault();
            subanalysis_methodology_cvrdAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="analysis_methodology_cvrd[sub_'+ subanalysis_methodology_cvrdAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleanalysis_methodology_cvrdBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleanalysis_methodology_cvrdBlock', '.subSingleanalysis_methodology_cvrdBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleanalysis_methodology_cvrdBlock">' + html + '</div>');
            }
        });


        
        $(document).on('click', '.subrecovery_study_report_cvrdAdd', function(e) {
            e.preventDefault();
            subrecovery_study_report_cvrdAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="recovery_study_report_cvrd[sub_'+ subrecovery_study_report_cvrdAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlerecovery_study_report_cvrdBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlerecovery_study_report_cvrdBlock', '.subSinglerecovery_study_report_cvrdBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSinglerecovery_study_report_cvrdBlock">' + html + '</div>');
            }
        });



         
        $(document).on('click', '.subacceptance_critria_cvrdAdd', function(e) {
            e.preventDefault();
            subacceptance_critria_cvrdAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="acceptance_critria_cvrd[sub_'+ subacceptance_critria_cvrdAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleacceptance_critria_cvrdBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleacceptance_critria_cvrdBlock', '.subSingleacceptance_critria_cvrdBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleacceptance_critria_cvrdBlock">' + html + '</div>');
            }
        });


        
        $(document).on('click', '.subanalytical_report_cvrdAdd', function(e) {
            e.preventDefault();
            subanalytical_report_cvrdAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="analytical_report_cvrd[sub_'+ subanalytical_report_cvrdAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleanalytical_report_cvrdBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleanalytical_report_cvrdBlock', '.subSingleanalytical_report_cvrdBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleanalytical_report_cvrdBlock">' + html + '</div>');
            }
        });


          
        $(document).on('click', '.subphysical_procedure_conformance_check_cvrdAdd', function(e) {
            e.preventDefault();
            subphysical_procedure_conformance_check_cvrdAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="physical_procedure_conformance_check_cvrd[sub_'+ subphysical_procedure_conformance_check_cvrdAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlephysical_procedure_conformance_check_cvrdBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlephysical_procedure_conformance_check_cvrdBlock', '.subSinglephysical_procedure_conformance_check_cvrdBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSinglephysical_procedure_conformance_check_cvrdBlock">' + html + '</div>');
            }
        });


        //happy
        $(document).on('click', '.subEqpResponsibilityAdd', function(e) {
            e.preventDefault();
            subEqpResponsibilityAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="eqpresponsibility[sub_'+ subEqpResponsibilityAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleEqpresponsibilityBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleEqpresponsibilityBlock', '.subSingleEqpresponsibilityBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleEqpresponsibilityBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subEqpDetailsAdd', function(e) {
            e.preventDefault();
            subEqpDetailsAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="eqpdetails[sub_'+ subEqpDetailsAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleEqpDetailsBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleEqpDetailsBlock', '.subSingleEqpDetailsBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleEqpDetailsBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subEqpSamplingAdd', function(e) {
            e.preventDefault();
            subEqpSamplingAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="eqpsampling[sub_'+ subEqpSamplingAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleEqpSamplingBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleEqpSamplingBlock', '.subSingleEqpSamplingBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleEqpSamplingBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subSamplingprocedureAdd', function(e) {
            e.preventDefault();
            subSamplingprocedureAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="Samplingprocedure[sub_'+ subSamplingprocedureAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleSamplingprocedureBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleSamplingprocedureBlock', '.subSingleSamplingprocedureBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleSamplingprocedureBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subAcceptenceCriteriaAdd', function(e) {
            e.preventDefault();
            subAcceptenceCriteriaAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="AcceptenceCriteria[sub_'+ subAcceptenceCriteriaAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleAcceptenceCriteriaBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleAcceptenceCriteriaBlock', '.subSingleAcceptenceCriteriaBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleAcceptenceCriteriaBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subEnvironmentalConditionsAdd', function(e) {
            e.preventDefault();
            subEnvironmentalConditionsAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="EnvironmentalConditions[sub_'+ subEnvironmentalConditionsAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleEnvironmentalConditionsBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleEnvironmentalConditionsBlock', '.subSingleEnvironmentalConditionsBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleEnvironmentalConditionsBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subEqpdetailsdeviationAdd', function(e) {
            e.preventDefault();
            subEqpdetailsdeviationAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="eqpdetailsdeviation[sub_'+ subEqpdetailsdeviationAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleEqpdetailsdeviationBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleEqpdetailsdeviationBlock', '.subSingleEqpdetailsdeviationBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleEqpdetailsdeviationBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subEqpdetailschangecontrolAdd', function(e) {
            e.preventDefault();
            subEqpdetailschangecontrolAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="eqpdetailschangecontrol[sub_'+ subEqpdetailschangecontrolAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleEqpdetailschangecontrolBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleEqpdetailschangecontrolBlock', '.subSingleEqpdetailschangecontrolBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleEqpdetailschangecontrolBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subEqpdetailssummaryAdd', function(e) {
            e.preventDefault();
            subEqpdetailssummaryAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="eqpdetailssummary[sub_'+ subEqpdetailssummaryAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleEqpdetailssummaryBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleEqpdetailssummaryBlock', '.subSingleEqpdetailssummaryBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleEqpdetailssummaryBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subeqpdetailsconclusionAdd', function(e) {
            e.preventDefault();
            subeqpdetailsconclusionAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="eqpdetailsconclusion[sub_'+ subeqpdetailsconclusionAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleEqpdetailsconclusionBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleEqpdetailsconclusionBlock', '.subSingleEqpdetailsconclusionBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleEqpdetailsconclusionBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subeqpdetailstrainingAdd', function(e) {
            e.preventDefault();
            subeqpdetailstrainingAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="eqpdetailstraining[sub_'+ subeqpdetailstrainingAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleEqpdetailstrainingBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleEqpdetailstrainingBlock', '.subSingleEqpdetailstrainingBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleEqpdetailstrainingBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subformatidentificationAdd', function(e) {
            e.preventDefault();
            subformatidentificationAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="formatidentification[sub_'+ subformatidentificationAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleformatidentificationBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleformatidentificationBlock', '.subsingleformatidentificationBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleformatidentificationBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subexecutiontteamAdd', function(e) {
            e.preventDefault();
            subexecutiontteamAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="executiontteam[sub_'+ subexecutiontteamAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleexecutiontteamBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleexecutiontteamBlock', '.subsingleexecutiontteamBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleexecutiontteamBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subformatdocumentsAdd', function(e) {
            e.preventDefault();
            subformatdocumentsAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="formatdocuments[sub_'+ subformatdocumentsAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleformatdocumentsBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleformatdocumentsBlock', '.subsingleformatdocumentsBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleformatdocumentsBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subrevalidationtypeAdd', function(e) {
            e.preventDefault();
            subrevalidationtypeAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="revalidationtype[sub_'+ subrevalidationtypeAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlerevalidationtypeBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlerevalidationtypeBlock', '.subsinglerevalidationtypeBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsinglerevalidationtypeBlock">' + html + '</div>');
            }
        });


        $(document).on('click', '.subRevalidationCriteriaAdd', function(e) {
            e.preventDefault();
            subRevalidationCriteriaAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="RevalidationCriteria[sub_'+ subRevalidationCriteriaAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleRevalidationCriteriaBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleRevalidationCriteriaBlock', '.subsingleRevalidationCriteriaBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleRevalidationCriteriaBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subgeneralconsiderationAdd', function(e) {
            e.preventDefault();
            subgeneralconsiderationAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="generalconsideration[sub_'+ subgeneralconsiderationAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlegeneralconsiderationBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlegeneralconsiderationBlock', '.subsinglegeneralconsiderationBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsinglegeneralconsiderationBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subprecautionsAdd', function(e) {
            e.preventDefault();
            subprecautionsAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="precautions[sub_'+ subprecautionsAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleprecautionsBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleprecautionsBlock', '.subsingleprecautionsBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleprecautionsBlock">' + html + '</div>');
            }
        });


        $(document).on('click', '.subcalibrationstatusAdd', function(e) {
            e.preventDefault();
            subcalibrationstatusAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="calibrationstatus[sub_'+ subcalibrationstatusAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlecalibrationstatusBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlecalibrationstatusBlock', '.subsinglecalibrationstatusBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsinglecalibrationstatusBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subtestobservationAdd', function(e) {
            e.preventDefault();
            subtestobservationAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="testobservation[sub_'+ subtestobservationAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singletestobservationBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singletestobservationBlock', '.subsingletestobservationBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingletestobservationBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subformatannexureAdd', function(e) {
            e.preventDefault();
            subformatannexureAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="formatannexure[sub_'+ subformatannexureAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleformatannexureBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleformatannexureBlock', '.subsingleformatannexureBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleformatannexureBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subformatdeviationAdd', function(e) {
            e.preventDefault();
            subformatdeviationAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="formatdeviation[sub_'+ subformatdeviationAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleformatdeviationBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleformatdeviationBlock', '.subsingleformatdeviationBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleformatdeviationBlock">' + html + '</div>');
            }
        });


        $(document).on('click', '.subformatccAdd', function(e) {
            e.preventDefault();
            subformatccAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="formatcc[sub_'+ subformatccAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleformatccBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleformatccBlock', '.subsingleformatccBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleformatccBlock">' + html + '</div>');
            }
        });


        $(document).on('click', '.subformatsummaryAdd', function(e) {
            e.preventDefault();
            subformatsummaryAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="formatsummary[sub_'+ subformatsummaryAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleformatsummaryBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleformatsummaryBlock', '.subsingleformatsummaryBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleformatsummaryBlock">' + html + '</div>');
            }
        });


        $(document).on('click', '.subformatconclusionAdd', function(e) {
            e.preventDefault();
            subformatconclusionAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="formatconclusion[sub_'+ subformatconclusionAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleformatconclusionBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleformatconclusionBlock', '.subsingleformatconclusionBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleformatconclusionBlock">' + html + '</div>');
            }
        });


        
        $(document).on('click', '.subconclusion_cvrdAdd', function(e) {
            e.preventDefault();
            subconclusion_cvrdAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="conclusion_cvrd[sub_'+ subconclusion_cvrdAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleconclusion_cvrdBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleconclusion_cvrdBlock', '.subSingleconclusion_cvrdBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleconclusion_cvrdBlock">' + html + '</div>');
            }
        });




        // saurav code start
        $('#responsibilitiesbtnadd').click(function(e) {

            var html =
                '<div class="singleResponsibilitiesBlock"><div class="resrow row"><div class="col-10"><textarea name="responsibilities[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark subResponsibilitiesAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#responsibilitiesdiv').append(html);

            });


            $('#stresponsibilitybtnadd').click(function(e) {

            var html =
                '<div class="singleStResponsibilityBlock"><div class="resrow row"><div class="col-10"><textarea name="stresponsibility[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark substResponsibilityAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#stresponsibilitydiv').append(html);

            });

            $('#stdefinationbtnadd').click(function(e) {

            var html =
                '<div class="singlestdefinationBlock"><div class="resrow row"><div class="col-10"><textarea name="stdefination[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark substdefinationAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#stdefinationdiv').append(html);

            });

            $('#streferencesbtadd').click(function(e) {

            var html =
                '<div class="singlestreferencesBlock"><div class="resrow row"><div class="col-10"><textarea name="streferences[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark substreferencesAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#streferencesdiv').append(html);

            });

            $('#stbackgroundbtnadd').click(function(e) {

            var html =
                '<div class="singlestbackgroundBlock"><div class="resrow row"><div class="col-10"><textarea name="stbackground[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark substbackgroundAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#stbackgrounddiv').append(html);

            });

            $('#stassessmentbtnadd').click(function(e) {

            var html =
                '<div class="singlestassessmentBlock"><div class="resrow row"><div class="col-10"><textarea name="stassessment[]" class="myclassname"> </textarea> </div><div class="col-1"><button class="btn btn-dark substassessmentAdd">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#stassessmentdiv').append(html);

            });

            $('#assessmentbtnadd').click(function(e) {

            var html =
                '<div class="singleAssessmentBlock"><div class="resrow row"><div class="col-10"><textarea name="assessment[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subAssessmentAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#assessmentdiv').append(html);

            });

            $('#newSummarybtnadd').click(function(e) {

            var html =
                '<div class="singleSummaryBlock"><div class="resrow row"><div class="col-10"><textarea name="summary_and_findings[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subSummaryAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#summarydiv').append(html);

            });

            $('#Strategybtnadd').click(function(e) {

            var html =
                '<div class="singleStrategyBlock"><div class="resrow row"><div class="col-10"><textarea name="strategy[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subStrategyAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#strategydiv').append(html);

            });


            $('#ststrategybtadd').click(function(e) {

            var html =
                '<div class="singleststrategyBlock"><div class="resrow row"><div class="col-10"><textarea name="ststrategy[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subststrategyAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#ststrategyBlock').append(html);

            });

            $('#stsummarybtadd').click(function(e) {

            var html =
            '<div class="singlestsummaryBlock"><div class="resrow row"><div class="col-10"><textarea name="stsummary[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark substsummaryAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#stsummarydiv').append(html);

            });

            $('#stconclusionbtadd').click(function(e) {

            var html =
                '<div class="singlestconclusionBlock"><div class="resrow row"><div class="col-10"><textarea name="stconclusion[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark substconclusionAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#stconclusiondiv').append(html);

            });

            $('#stannexurebtadd').click(function(e) {

            var html =
                '<div class="singlestannexureBlock"><div class="resrow row"><div class="col-10"><textarea name="stannexure[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark substannexureAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#stannexurediv').append(html);

            });

            $('#Referencedocunumadd').click(function(e) {

            var html =
                '<div class="singleReferencedocunumBlock"><div class="resrow row"><div class="col-10"><textarea name="Referencedocunum[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark substReferencedocunumAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#Referencedocunumdiv').append(html);

            });


            $('#conclusionbtnadd').click(function(e) {

            var html =
                '<div class="singleConclusionBlock"><div class="resrow row"><div class="col-10"><textarea name="conclusion_and_recommendations[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subConclusionAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#conclusiondiv').append(html);

            });

            $('#euipmentresponsibilitybtnadd').click(function(e) {

            var html =
                '<div class="singleEuipmentResponsibilityBlock"><div class="resrow row"><div class="col-10"><textarea name="euipmentresponsibility[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subEuipmentResponsibilityAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#euipmentresponsibilitydiv').append(html);

            });

            $('#eqpAnalyticalReportbtnadd').click(function(e) {

            var html =
                '<div class="singleEqpAnalyticalReportBlock"><div class="resrow row"><div class="col-10"><textarea name="eqpAnalyticalReport[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subEqpAnalyticalReportAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#eqpAnalyticalReportdiv').append(html);

            });

            $('#eqpdeviationbtadd').click(function(e) {

            var html =
                '<div class="singleEqpdeviationBlock"><div class="resrow row"><div class="col-10"><textarea name="eqpdeviation[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subEqpdeviationAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#eqpdeviationdiv').append(html);

            });

            $('#eqpchangecontrolbtnadd').click(function(e) {

            var html =
                '<div class="singleEqpchangecontrolBlock"><div class="resrow row"><div class="col-10"><textarea name="eqpchangecontrol[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subEqpchangecontrolAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#eqpchangecontroldiv').append(html);

            });

            $('#eqpsummarybtnadd').click(function(e) {

            var html =
                '<div class="singleEqpsummaryBlock"><div class="resrow row"><div class="col-10"><textarea name="eqpsummary[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subEqpsummaryAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#eqpsummarydiv').append(html);

            });

            $('#eqpconclusionbtadd').click(function(e) {

            var html =
                '<div class="singleEqpconclusionBlock"><div class="resrow row"><div class="col-10"><textarea name="eqpconclusion[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subeqpconclusionAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#eqpconclusiondiv').append(html);

            });

            $('#eqpreportapprovalbtadd').click(function(e) {

            var html =
                '<div class="singleEqpreportapprovalBlock"><div class="resrow row"><div class="col-10"><textarea name="eqpreportapproval[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subeqpreportapprovalAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#eqpreportapprovaldiv').append(html);

            });

            $('#referencesssbtadd').click(function(e) {

            var html =
                '<div class="singleReferencesssBlock"><div class="resrow row"><div class="col-10"><textarea name="referencesss[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subReferencesssAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#referencesssdiv').append(html);

            });

        // saurav code end 


        //ashish subcategory
        $(document).on('click', '.subpurpose_pvrAdd', function(e) {
            e.preventDefault();
            subpurpose_pvrAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="purpose_pvr[sub_'+ subpurpose_pvrAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger purpose_pvrbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlepurpose_pvrBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlepurpose_pvrBlock', '.subsinglepurpose_pvrBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsinglepurpose_pvrBlock">' + html + '</div>');
            }

        });


        $(document).on('click', '.subscope_pvrAdd', function(e) {
            e.preventDefault();
            subscope_pvrAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="scope_pvr[sub_'+ subscope_pvrAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger scope_pvrbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlescope_pvrBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlescope_pvrBlock', '.subSinglescope_pvrBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSinglescope_pvrBlock">' + html + '</div>');
            }
        });



        $(document).on('click', '.subbatchdetail_pvrAdd', function(e) {
            e.preventDefault();
            subbatchdetail_pvrAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="batchdetail_pvr[sub_'+ subbatchdetail_pvrAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger batchdetail_pvrbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlebatchdetail_pvrBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlebatchdetail_pvrBlock', '.subSinglebatchdetail_pvrBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSinglebatchdetail_pvrBlock">' + html + '</div>');
            }
        });
       



        $(document).on('click', '.subrefrence_document_pvrAdd', function(e) {
            e.preventDefault();
            subrefrence_document_pvrAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="refrence_document_pvr[sub_'+ subrefrence_document_pvrAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger refrence_document_pvrbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlerefrence_document_pvrBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlerefrence_document_pvrBlock', '.subSinglerefrence_document_pvrBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSinglerefrence_document_pvrBlock">' + html + '</div>');
            }
        });
       







        $(document).on('click', '.subrefrence_documentAdd', function(e) {
            e.preventDefault();
            subrefrence_documentAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="refrence_document[sub_'+ subrefrence_documentAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger refrence_documentbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlerefrence_documentBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlerefrence_documentBlock', '.subSinglerefrence_documentBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSinglerefrence_documentBlock">' + html + '</div>');
            }
        });


        
        $(document).on('click', '.subactive_raw_material_pvrAdd', function(e) {
            e.preventDefault();
            subactive_raw_material_pvrAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="active_raw_material_pvr[sub_'+ subactive_raw_material_pvrAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger active_raw_material_pvrbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleactive_raw_material_pvrBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleactive_raw_material_pvrBlock', '.subsingleactive_raw_material_pvrBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleactive_raw_material_pvrBlock">' + html + '</div>');
            }
        });




        $(document).on('click', '.subprimary_packingmaterial_pvrAdd', function(e) {
            e.preventDefault();
            subprimary_packingmaterial_pvrAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="primary_packingmaterial_pvr[sub_'+ subprimary_packingmaterial_pvrAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger primary_packingmaterial_pvrbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleprimary_packingmaterial_pvrBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleprimary_packingmaterial_pvrBlock', '.subsingleprimary_packingmaterial_pvrBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleprimary_packingmaterial_pvrBlock">' + html + '</div>');
            }
        });


        $(document).on('click', '.subused_equipment_calibration_pvrAdd', function(e) {
            e.preventDefault();
            subused_equipment_calibration_pvrAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="used_equipment_calibration_pvr[sub_'+ subused_equipment_calibration_pvrAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger used_equipment_calibration_pvrbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleused_equipment_calibration_pvrBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleused_equipment_calibration_pvrBlock', '.subSingleused_equipment_calibration_pvrBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleused_equipment_calibration_pvrBlock">' + html + '</div>');
            }
        });



        $(document).on('click', '.subresult_of_intermediate_pvrAdd', function(e) {
            e.preventDefault();
            subresult_of_intermediate_pvrAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="result_of_intermediate_pvr[sub_'+ subresult_of_intermediate_pvrAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger result_of_intermediate_pvrbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleresult_of_intermediate_pvrBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleresult_of_intermediate_pvrBlock', '.subSingleresult_of_intermediate_pvrBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleresult_of_intermediate_pvrBlock">' + html + '</div>');
            }
        });



        $(document).on('click', '.subresult_of_finished_product_pvrAdd', function(e) {
            e.preventDefault();
            subresult_of_finished_product_pvrAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="result_of_finished_product_pvr[sub_'+ subresult_of_finished_product_pvrAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger result_of_finished_product_pvrbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleresult_of_finished_product_pvrBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleresult_of_finished_product_pvrBlock', '.subSingleresult_of_finished_product_pvrBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleresult_of_finished_product_pvrBlock">' + html + '</div>');
            }
        });


        $(document).on('click', '.subresult_of_packing_finished_pvrAdd', function(e) {
            e.preventDefault();
            subresult_of_packing_finished_pvrAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="result_of_packing_finished_pvr[sub_'+ subresult_of_packing_finished_pvrAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger result_of_packing_finished_pvrbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleresult_of_packing_finished_pvrBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleresult_of_packing_finished_pvrBlock', '.subSingleresult_of_packing_finished_pvrBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleresult_of_packing_finished_pvrBlock">' + html + '</div>');
            }
        });
        


        $(document).on('click', '.subcriticalprocess_parameter_pvrAdd', function(e) {
            e.preventDefault();
            subcriticalprocess_parameter_pvrAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="criticalprocess_parameter_pvr[sub_'+ subcriticalprocess_parameter_pvrAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger criticalprocess_parameter_pvrbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlecriticalprocess_parameter_pvrBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlecriticalprocess_parameter_pvrBlock', '.subSinglecriticalprocess_parameter_pvrBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSinglecriticalprocess_parameter_pvrBlock">' + html + '</div>');
            }
        });



        $(document).on('click', '.subyield_at_various_stage_pvrAdd', function(e) {
            e.preventDefault();
            subyield_at_various_stage_pvrAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="yield_at_various_stage_pvr[sub_'+ subyield_at_various_stage_pvrAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger yield_at_various_stage_pvrbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleyield_at_various_stage_pvrBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleyield_at_various_stage_pvrBlock', '.subSingleyield_at_various_stage_pvrBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleyield_at_various_stage_pvrBlock">' + html + '</div>');
            }
        });



        $(document).on('click', '.subhold_time_study_pvrAdd', function(e) {
            e.preventDefault();
            subhold_time_study_pvrAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="hold_time_study_pvr[sub_'+ subhold_time_study_pvrAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger hold_time_study_pvrbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlehold_time_study_pvrBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlehold_time_study_pvrBlock', '.subSinglehold_time_study_pvrBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSinglehold_time_study_pvrBlock">' + html + '</div>');
            }
        });

        
        $(document).on('click', '.subcleaningvalidation_pvrAdd', function(e) {
            e.preventDefault();
            subcleaningvalidation_pvrAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="cleaningvalidation_pvr[sub_'+ subcleaningvalidation_pvrAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger cleaningvalidation_pvrbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlecleaningvalidation_pvrBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlecleaningvalidation_pvrBlock', '.subSinglecleaningvalidation_pvrBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSinglecleaningvalidation_pvrBlock">' + html + '</div>');
            }
        });


        
        $(document).on('click', '.substability_study_pvrAdd', function(e) {
            e.preventDefault();
            substability_study_pvrAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="stability_study_pvr[sub_'+ substability_study_pvrAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger stability_study_pvrbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlestability_study_pvrBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlestability_study_pvrBlock', '.subSinglestability_study_pvrBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSinglestability_study_pvrBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subdeviation_if_any_pvrAdd', function(e) {
            e.preventDefault();
            subdeviation_if_any_pvrAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="deviation_if_any_pvr[sub_'+ subdeviation_if_any_pvrAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger deviation_if_any_pvrbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singledeviation_if_any_pvrBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singledeviation_if_any_pvrBlock', '.subSingledeviation_if_any_pvrBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingledeviation_if_any_pvrBlock">' + html + '</div>');
            }
        });

        
        $(document).on('click', '.subchangecontrol_pvrAdd', function(e) {
            e.preventDefault();
            subchangecontrol_pvrAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="changecontrol_pvr[sub_'+ subchangecontrol_pvrAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger changecontrol_pvrbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlechangecontrol_pvrBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlechangecontrol_pvrBlock', '.subSinglechangecontrol_pvrBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSinglechangecontrol_pvrBlock">' + html + '</div>');
            }
        });




        $(document).on('click', '.subsummary_pvrAdd', function(e) {
            e.preventDefault();
            subsummary_pvrAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="summary_pvr[sub_'+ subsummary_pvrAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger summary_pvrbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlesummary_pvrBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlesummary_pvrBlock', '.subSinglesummary_pvrBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSinglesummary_pvrBlock">' + html + '</div>');
            }
        });



        $(document).on('click', '.subconclusion_pvrAdd', function(e) {
            e.preventDefault();
            subconclusion_pvrAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="conclusion_pvr[sub_'+ subconclusion_pvrAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger conclusion_pvrbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleconclusion_pvrBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleconclusion_pvrBlock', '.subSingleconclusion_pvrBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleconclusion_pvrBlock">' + html + '</div>');
            }
        });
        $(document).on('click', '.subproposed_parameter_upcoming_batch_pvrAdd', function(e) {
            e.preventDefault();
            subproposed_parameter_upcoming_batch_pvrAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="proposed_parameter_upcoming_batch_pvr[sub_'+ subproposed_parameter_upcoming_batch_pvrAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger proposed_parameter_upcoming_batch_pvrbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleproposed_parameter_upcoming_batch_pvrBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleproposed_parameter_upcoming_batch_pvrBlock', '.subSingleproposed_parameter_upcoming_batch_pvrBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleproposed_parameter_upcoming_batch_pvrBlock">' + html + '</div>');
            }
        });
        $(document).on('click', '.subreport_approval_pvrAdd', function(e) {
            e.preventDefault();
            subreport_approval_pvrAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="report_approval_pvr[sub_'+ subreport_approval_pvrAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger report_approval_pvrbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlereport_approval_pvrBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlereport_approval_pvrBlock', '.subSinglereport_approval_pvrBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSinglereport_approval_pvrBlock">' + html + '</div>');
            }
        });




        $(document).on('click', '.subAttachmentList_TemperMapAdd', function(e) {
            e.preventDefault();
            subAttachmentList_TemperMapAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="AttachmentList_TemperMap[sub_'+ subAttachmentList_TemperMapAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleAttachmentList_TemperMapBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleAttachmentList_TemperMapBlock', '.subsingleAttachmentList_TemperMapBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleAttachmentList_TemperMapBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subPostApproval_TemperMapAdd', function(e) {
            e.preventDefault();
            subPostApproval_TemperMapAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="PostApproval_TemperMap[sub_'+ subPostApproval_TemperMapAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlePostApproval_TemperMapBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlePostApproval_TemperMapBlock', '.subsinglePostApproval_TemperMapBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsinglePostApproval_TemperMapBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subPurpose_HoTiStReAdd', function(e) {
            e.preventDefault();
            subPurpose_HoTiStReAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="Purpose_HoTiStRe[sub_'+ subPurpose_HoTiStReAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singlePurpose_HoTiStReBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singlePurpose_HoTiStReBlock', '.subsinglePurpose_HoTiStReBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsinglePurpose_HoTiStReBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subScope_HoTiStReAdd', function(e) {
            e.preventDefault();
            subScope_HoTiStReAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="Scope_HoTiStRe[sub_'+ subScope_HoTiStReAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleScope_HoTiStReBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleScope_HoTiStReBlock', '.subsingleScope_HoTiStReBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleScope_HoTiStReBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subBatchDetails_HoTiStReAdd', function(e) {
            e.preventDefault();
            subBatchDetails_HoTiStReAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="BatchDetails_HoTiStRe[sub_'+ subBatchDetails_HoTiStReAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleBatchDetails_HoTiStReBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleBatchDetails_HoTiStReBlock', '.subsingleBatchDetails_HoTiStReBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleBatchDetails_HoTiStReBlock">' + html + '</div>');
            }
        });



        $(document).on('click', '.subReferenceDocument_HoTiStReAdd', function(e) {
            e.preventDefault();
            subReferenceDocument_HoTiStReAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="ReferenceDocument_HoTiStRe[sub_'+ subReferenceDocument_HoTiStReAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleReferenceDocument_HoTiStReBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleReferenceDocument_HoTiStReBlock', '.subsingleReferenceDocument_HoTiStReBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleReferenceDocument_HoTiStReBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subResultBulkStage_HoTiStReAdd', function(e) {
            e.preventDefault();
            subResultBulkStage_HoTiStReAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="ResultBulkStage_HoTiStRe[sub_'+ subResultBulkStage_HoTiStReAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleResultBulkStage_HoTiStReBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleResultBulkStage_HoTiStReBlock', '.subsingleResultBulkStage_HoTiStReBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleResultBulkStage_HoTiStReBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subDeviationIfAny_HoTiStReAdd', function(e) {
            e.preventDefault();
            subDeviationIfAny_HoTiStReAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="DeviationIfAny_HoTiStRe[sub_'+ DeviationIfAny_HoTiStRebtnadd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleDeviationIfAny_HoTiStReBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleDeviationIfAny_HoTiStReBlock', '.subsingleDeviationIfAny_HoTiStReBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleDeviationIfAny_HoTiStReBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subSummary_HoTiStReAdd', function(e) {
            e.preventDefault();
            subSummary_HoTiStReAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="Summary_HoTiStRe[sub_'+ subSummary_HoTiStReAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleSummary_HoTiStReBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleSummary_HoTiStReBlock', '.subsingleSummary_HoTiStReBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleSummary_HoTiStReBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subConclusion_HoTiStReAdd', function(e) {
            e.preventDefault();
            subConclusion_HoTiStReAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="Conclusion_HoTiStRe[sub_'+ subConclusion_HoTiStReAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleConclusion_HoTiStReBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleConclusion_HoTiStReBlock', '.subsingleConclusion_HoTiStReBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleConclusion_HoTiStReBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subReportApproval_HoTiStReAdd', function(e) {
            e.preventDefault();
            subReportApproval_HoTiStReAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="ReportApproval_HoTiStRe[sub_'+ subReportApproval_HoTiStReAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleReportApproval_HoTiStReBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleReportApproval_HoTiStReBlock', '.subsingleReportApproval_HoTiStReBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subsingleReportApproval_HoTiStReBlock">' + html + '</div>');
            }
        });




        $(document).on('click', '.subAbbreviationAdd', function(e) {
            e.preventDefault();
            subAbbreviationAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="abbreviation[sub_'+ subAbbreviationAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleAbbreviationBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleAbbreviationBlock', '.subSingleAbbreviationBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleAbbreviationBlock">' + html + '</div>');
            }
        });


       




        $(document).on('click', '.subDefinitionAdd', function(e) {
            e.preventDefault();
            subDefinitionAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="defination[sub_'+ subDefinitionAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleDefinitionBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleDefinitionBlock', '.subSingleDefinitionBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleDefinitionBlock">' + html + '</div>');
            }
        });

        $(document).on('click', '.subReferencesAdd', function(e) {
            e.preventDefault();
            subReferencesAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="references[sub_'+ subReferencesAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleReferencesBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleReferencesBlock', '.subSingleReferencesBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleReferencesBlock">' + html + '</div>');
            }
        });


       

        $(document).on('click', '.subAnnexureAdd', function(e) {
            e.preventDefault();
            subAnnexureAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="ann[sub_'+ subAnnexureAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleAnnexureBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleAnnexureBlock', '.subSingleAnnexureBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleAnnexureBlock">' + html + '</div>');
            }
        });

       




        $(document).on('click', '.subReportingAdd', function(e) {
            e.preventDefault();
            subReportingAdd = Math.round(Math.random() * 10000);
            var html =
                '<div class="resrow row"><div class="col-6"><textarea name="reporting[sub_'+ subReportingAdd +']" class="myclassname"></textarea></div><div class="col-1"><button class="btn btn-danger abbreviationbtnRemove">Remove</button></div></div>';

            var closestSingleBlock = $(this).closest('.singleReportingBlock');

            var nextSubBlocks = closestSingleBlock.nextUntil('.singleReportingBlock', '.subSingleReportingBlock');

            if (nextSubBlocks.length > 0) {
                nextSubBlocks.last().append(html);
            } else {
                closestSingleBlock.after('<div class="subSingleReportingBlock">' + html + '</div>');
            }
        });


        $(document).on('click', '.DefinitionbtnRemove', function() {
            $(this).closest('div.row').remove();
        })

        $(document).on('click', '.removeTrainRow', function() {
            $(this).closest('tr').remove();
        })

        $('#reportingbtadd').click(function(e) {

            var html =
                '<div class="singleReportingBlock"><div class="resrow row"><div class="col-10"><textarea name="reporting[]" class="myclassname"></textarea></div> <div class="col-sm-1"> <button class="btn btn-dark subReportingAdd">+</button> </div> <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#reportingdiv').append(html);

        });

        $('#referencesbtadd').click(function(e) {

            var html =
                '<div class="singleReferencesBlock"><div class="resrow row"><div class="col-10"><textarea name="references[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subReferencesAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#referencesdiv').append(html);

        });




        $('#annbtadd').click(function(e) {

            var html =
            `<div class="singleAnnexureBlock">
                <div class="resrow row">
                    <div class="col-10">
                        <textarea name="ann[]" class="myclassname"></textarea>
                    </div>
                    <div class="col-sm-1">
                        <button class="btn btn-dark subAnnexureAdd">+</button>
                    </div>
                    <div class="col-1">
                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                    </div>
                </div>
            </div>`;

            $('#anndiv').append(html);

        });

        $('#distributionbtnadd').click(function(e) {

            var html =
              '<div class="resrow"><input type="text" name="distribution[]" class="myclassname"></div>';

            $('#distributiondiv').append(html);

        });

        $('#materialsbtadd').click(function(e) {

            var html =
                '<div class="singleMaterialBlock"><div class="resrow row"><div class="col-10"><textarea name="materials_and_equipments[]" class="myclassname"></textarea> </div><div class="col-1"><button type="button" class="subMaterialsAdd" name="button">+</button></div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('.materialsBlock').append(html);

        });

        $('#currentpracticeadd').click(function(e) {

            var html =
                '<div class="resrow"><input type="text" name="currentpractice[]" class="myclassname"></div>';

            $('#currentpracticediv').append(html);

        });

        $('#proposedchangeadd').click(function(e) {

            var html =
                '<div class="resrow"><input type="text" name="proposedchange[]" class="myclassname"></div>';

            $('#proposedchangediv').append(html);

        });

        $('#reasonchangeadd').click(function(e) {

            var html =
                '<div class="resrow"><input type="text" name="reasonchange[]" class="myclassname"></div>';

            $('#reasonchangediv').append(html);

        });

        $('#super-com-add').click(function(e) {

            var html =
                '<div class="resrow"><input type="text" name="super-com[]" class="myclassname"></div>';

            $('#super-com-div').append(html);

        });

        $('#optionsbtnadd').click(function(e) {

            var html =
                '<div class="row"><div class="col-10"><div class="option-group"><input type="text" name="options[]"><input type="radio" name="answer" value="0"></div></div><div class="col-2"><a class="btn btn-dark option-remove-btn">&times;</a></div></div>';

            $('#optionsdiv').append(html);

        });

        $(document).on('click', '.option-remove-btn', function() {
            $(this).closest('div.row').remove()
        })

        $('#multi_optionsbtnadd').click(function(e) {

            var html =
                '<div class="row"><div class="col-10"><div class="option-group"><input type="text" name="options[]"><input type="checkbox" name="answer" value="0"></div></div><div class="col-2"><a class="btn btn-dark option-remove-btn">&times;</a></div></div>';

            $('#multi_optionsdiv').append(html);

        });

        $('#answersbtnadd').click(function(e) {

            var html =
                '<input type="text" name="answers[]">';

            $('#answersdiv').append(html);

        });


        $('#othercomadd').click(function(e) {

            var html =
                '<div class="resrow"><input type="text" name="othercom[]" class="myclassname"></div>';

            $('#othercomdiv').append(html);

        });

        $('#cancellation').click(function(e) {

            var html =
                '<div class="resrow"><input type="text" name="cancellation[]" class="myclassname"></div>';

            $('#cancellation').append(html);

        });


        $('.deleterowres').click(function(e) {
            alert('hi');
        });


        $('#initiator-group').change(function() {
            var departmentCode = $(this).find(':selected').val();
            if (departmentCode !== undefined) {
                $('#initiator-code').text(departmentCode);
            }
        });

        $('.material-info').change(function() {

            var departmentCode = $(this).find(':selected').attr('data-id');
            var mat = $(this).find(':selected').val();
            var cus = $(this).find(':selected').attr('data-value');
            if (departmentCode !== undefined) {

                $('.material-name').text(departmentCode);
                $('.material-market').text(mat);
                $('.material-customer').text(cus);
            }
        });


        $('.product-info').change(function() {

            var departmentCode = $(this).find(':selected').attr('data-id');
            var mat = $(this).find(':selected').val();
            var cus = $(this).find(':selected').attr('data-value');
            var profor = $(this).find(':selected').attr('data-price');
            if (departmentCode !== undefined) {

                $('.product-name').text(departmentCode);
                $('.product-market').text(mat);
                $('.product-customer').text(cus);
                $('.product-for').text(profor);
            }
        });

        $('#depart-name').change(function() {
            var departmentCode = $(this).find(':selected').attr('data-id');
            if (departmentCode !== undefined) {
                $('#department-code').text(departmentCode);
            }
        });

        $('#doc-type').change(function() {
            var typeCode = $(this).find(':selected').attr('data-id');
            if (typeCode !== undefined) {
                $('#document_type_code').text(typeCode);
            }
        });

        $('#doc-subtype').change(function() {
            var typeCode = $(this).find(':selected').attr('data-id');
            if (typeCode !== undefined) {
                $('#document_subtype_code').text(typeCode);
            }
        });
        $('#doc-lang').change(function() {
            var docLang = $(this).find(':selected').attr('data-id');
            if (docLang !== undefined) {
                $('#document_language').text(docLang);
            }
        });

        $("#submit-division").click(function() {
            $("#division-modal").addClass("d-none");
        });
        $("#set-division").click(function() {
            $("#division-modal").removeClass("d-none");
        });
        // -------------by pankaj---------

        // -------------by pankaj---------


        $('#question-bank').change(function() {
            var departmentCode = $(this).find(':selected').attr('data-id');
            var myarr = departmentCode;
            var url = "{{ route('data', [':myarr']) }}";
            url = url.replace(':myarr', myarr);
            // url = url.replace('http:', 'https:');
            $('#question-list').empty();
            $.ajax({
                url: url,
                dataType: 'json',
                success: function(response) {

                    $('#question-list').append(response.htmls);

                }
            });
        });

        var selectQuestion = $('#selectQuestion').attr('data-id');
        var quesData = selectQuestion;
        var url = "{{ route('questiondata', [':quesData']) }}";
        url = url.replace(':quesData', quesData);
        // url = url.replace('http:', 'https:');
        $('#selected-list').empty();
        $.ajax({
            url: url,
            dataType: 'json',
            success: function(response) {

                $('#selected-list').append(response.htmls);

            }
        });

        var question = $('#data-question').attr('data-id');
        var question = question;
        var url = "{{ route('datag', [':question']) }}";
        url = url.replace(':question', question);
        // url = url.replace('http:', 'https:');
        $('#selected-question').empty();
        $.ajax({
            url: url,
            dataType: 'json',
            success: function(response) {

                $('#selected-question').append(response.htmls);

            }
        });



        $('#quize').change(function() {
            var effective = $(this).find(':selected').attr('data-id');
            if (effective !== undefined) {
                $('#effective').val(effective);
            }
        });

        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#searchTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });


        $("#query").on("change", function() {

            var value = $(this).val().toLowerCase();
            if(value!==''){
                $("#searchTable tr").filter(function() {
                    $(this).toggle(true)
                    var selectedText = $("#scope option:selected").val();
                    // alert(selectedText);
                    if(selectedText!==''){
                        $(this).toggle(($(this).text().toLowerCase().indexOf(selectedText) && $(this).text().toLowerCase().indexOf(value)) > -1)
                    }else{
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    }
                });

            }else{
                var selectedText = $("#scope option:selected").val();

                if(selectedText!==''){
                    $("#searchTable tr").filter(function() {
                        $(this).toggle(true)
                        $(this).toggle($(this).text().toLowerCase().indexOf(selectedText) > -1)
                    });
                }
                else{
                    $("#searchTable tr").filter(function() {
                        $(this).toggle(true)
                    });
                }

            }
        });

        $("#scope").on("change", function() {

            var value = $(this).val().toLowerCase();
            if(value!==''){

                $("#searchTable tr").filter(function() {
                    $(this).toggle(true)
                    var selectedText = $("#query option:selected").val();
                    if(selectedText!==''){
                        $(this).toggle(($(this).text().toLowerCase().indexOf(selectedText) && $(this).text().toLowerCase().indexOf(value)) > -1)
                    }else{
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    }
                });


            }else{

                $("#searchTable tr").filter(function() {
                    $(this).toggle(true)
                });
                var selectedText = $("#query option:selected").val();

                if(selectedText!==''){
                    $("#searchTable tr").filter(function() {
                        $(this).toggle(true)
                        $(this).toggle($(this).text().toLowerCase().indexOf(selectedText) > -1)
                    });
                }


            }
        });

        $('#annexurebtnadd').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number[]" value="' + serialNumber + '"></td>' +
                    '<td><input type="text" name="annexure_number[]"></td>' +
                    '<td><input type="text" name="annexure_data[]"></td>' +
                    '</tr>';

                return html;
            }
            var tableBody = $('#annexure tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });

        $('#DocDetailbtn').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input disabled  type="text" name="serial_number[]" value="' + serialNumber + '"></td>' +
                    '<td><input type="text" name="current_doc_number[]"></td>' +
                    '<td><input type="text" name="current_version[]"></td>' +
                    '<td><input type="text" name="new_doc_number[]"></td>' +
                    '<td><input type="text" name="new_version[]"></td>' +
                    '</tr>';

                return html;
            }
            var tableBody = $('#doc-detail tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });

        $('#addAffectedDocumentsbtn').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber + '"></td>' +
                    '<td><input type="text" name="affected_documents[]"></td>' +
                    '<td><input type="text" name="document_name[]"></td>' +
                    '<td><input type="number" name="document_no[]"></td>' +
                     '<td><input type="text" name="version_no[]"></td>' +
                    // '<td><input type="date" name="implementation_date[]"></td>'
                    '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"><input type="text" id="implementation_date' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="implementation_date[]" class="hide-input" oninput="handleDateInput(this, `implementation_date' + serialNumber +'`)" /></div></div></div></td>'+

                   '<td><input type="text" name="new_document_no[]"></td>' +
                    '<td><input type="text" name="new_version_no[]"></td>' +
                    '</tr>';

                return html;
            }
            var tableBody = $('#affected-documents tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });

        $('#addProductDetail').click(function(e) {
            @php
                $product = DB::table('products')->get();
                $material = DB::table('materials')->get();
            @endphp

            function generateTableRow(serialNumber) {

                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number[]" value="' + serialNumber + '"></td>' +
                    '<td><input type="text" name="plant"></td>' +
                    '<td><input type="text" name="product_code"></td>' +
                    '<td><input type="text" name="product_name"></td>' +
                    '<td><input type="text" name="market"></td>' +
                    '<td><input type="text" name="customer"></td>' +
                    '<td><input type="text" name="product_for"></td>' +
                    '</tr>';

                return html;
            }
            var tableBody = $('#product-detail tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });

        $('#addMaterialDetail').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number[]" value="' + serialNumber + '"></td>' +
                    '<td><input type="text" name="plant"></td>' +
                    '<td><input type="text" name="material_code"></td>' +
                    '<td><input type="text" name="material_name"></td>' +
                    '<td><input type="text" name="market"></td>' +
                    '<td><input type="text" name="customer"></td>' +
                    '</tr>';

                return html;
            }
            var tableBody = $('#material-detail tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
        // -----------------------------------------root cuase analysis  table------------------------

        //--------------------------Root CAuse Analysis-----------------------

        $('#Chemical-Analysis1').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number[]" value="' + serialNumber + '"></td>' +
                    '<td><input type="text" name="questions[]"></td>' +
                    '<td><input type="text" name="response[]"></td>'
                '</tr>';
                return html;
            }
            var tableBody = $('#review_analyst_knowledge tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
        //--------------------------Root CAuse Analysis 2-----------------------

        $('#Chemical-Analysis2').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number2[]" value="' + serialNumber +
                    '"></td>' +
                    '<td><input type="text" name="questions2[]"></td>' +
                    '<td><input type="text" name="response2[]"></td>'
                '</tr>';
                return html;
            }
            var tableBody = $('#review_analyst_knowledge2 tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
        //--------------------------Root CAuse Analysis 3-----------------------

        $('#Chemical-Analysis3').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number3[]" value="' + serialNumber +
                    '"></td>' +
                    '<td><input type="text" name="questions3[]"></td>' +
                    '<td><input type="text" name="response3[]"></td>'
                '</tr>';
                return html;
            }
            var tableBody = $('#review_analyst_knowledge3 tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
        //--------------------------Root CAuse Analysis 4-----------------------

        $('#Chemical-Analysis4').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number4[]" value="' + serialNumber +
                    '"></td>' +
                    '<td><input type="text" name="questions4[]"></td>' +
                    '<td><input type="text" name="response4[]"></td>'
                '</tr>';
                return html;
            }
            var tableBody = $('#review_analyst_knowledge4 tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
        //--------------------------Root CAuse Analysis 5-----------------------

        $('#Chemical-Analysis5').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number5[]" value="' + serialNumber +
                    '"></td>' +
                    '<td><input type="text" name="questions5[]"></td>' +
                    '<td><input type="text" name="response5[]"></td>'
                '</tr>';
                return html;
            }
            var tableBody = $('#review_analyst_knowledge5 tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
        //--------------------------Root CAuse Analysis 6-----------------------

        $('#Chemical-Analysis6').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number6[]" value="' + serialNumber +
                    '"></td>' +
                    '<td><input type="text" name="questions6[]"></td>' +
                    '<td><input type="text" name="response6[]"></td>'
                '</tr>';
                return html;
            }
            var tableBody = $('#review_analyst_knowledge6 tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
        //--------------------------Root CAuse Analysis 7-----------------------

        $('#Chemical-Analysis7').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number7[]" value="' + serialNumber +
                    '"></td>' +
                    '<td><input type="text" name="questions7[]"></td>' +
                    '<td><input type="text" name="response7[]"></td>'
                '</tr>';
                return html;
            }
            var tableBody = $('#review_analyst_knowledge7 tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
        //--------------------------Root CAuse Analysis 8-----------------------

        $('#Chemical-Analysis8').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number8[]" value="' + serialNumber +
                    '"></td>' +
                    '<td><input type="text" name="questions8[]"></td>' +
                    '<td><input type="text" name="response8[]"></td>'
                '</tr>';
                return html;
            }
            var tableBody = $('#review_analyst_knowledge8 tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
        //--------------------------Root CAuse Analysis 9-----------------------

        $('#Chemical-Analysis9').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number9[]" value="' + serialNumber +
                    '"></td>' +
                    '<td><input type="text" name="questions9[]"></td>' +
                    '<td><input type="text" name="response9[]"></td>'
                '</tr>';
                return html;
            }
            var tableBody = $('#review_analyst_knowledge9 tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
        //--------------------------Root CAuse Analysis 10-----------------------

        $('#Chemical-Analysis10').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number10[]" value="' + serialNumber +
                    '"></td>' +
                    '<td><input type="text" name="questions10[]"></td>' +
                    '<td><input type="text" name="response10[]"></td>'
                '</tr>';
                return html;
            }
            var tableBody = $('#review_analyst_knowledge10 tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
        //--------------------------Root CAuse Analysis 11-----------------------

        $('#Chemical-Analysis11').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number11[]" value="' + serialNumber +
                    '"></td>' +
                    '<td><input type="text" name="questions11[]"></td>' +
                    '<td><input type="text" name="response11[]"></td>'
                '</tr>';
                return html;
            }
            var tableBody = $('#review_analyst_knowledge11 tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
        //--------------------------Root CAuse Analysis 12-----------------------

        $('#Chemical-Analysis12').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number12[]" value="' + serialNumber +
                    '"></td>' +
                    '<td><input type="text" name="questions12[]"></td>' +
                    '<td><input type="text" name="response12[]"></td>'
                '</tr>';
                return html;
            }
            var tableBody = $('#review_analyst_knowledge12 tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
        //--------------------------Root CAuse Analysis 13-----------------------

        $('#Chemical-Analysis13').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number13[]" value="' + serialNumber +
                    '"></td>' +
                    '<td><input type="text" name="questions13[]"></td>' +
                    '<td><input type="text" name="response13[]"></td>'
                '</tr>';
                return html;
            }
            var tableBody = $('#review_analyst_knowledge13 tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
        //--------------------------Root CAuse Analysis 14-----------------------

        $('#Chemical-Analysis14').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number14[]" value="' + serialNumber +
                    '"></td>' +
                    '<td><input type="text" name="questions14[]"></td>' +
                    '<td><input type="text" name="response14[]"></td>'
                '</tr>';
                return html;
            }
            var tableBody = $('#review_analyst_knowledge14 tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
        // ------------------------------Observation--------------------------
        $('#observation-table').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number[]" value="' + serialNumber + '"></td>' +
                    '<td><input type="text" name="action[]"></td>' +
                     '<td><input type="text" name="responsible[]"></td>' +
                    // '<td><input type="text" name="deadline[]"></td>' +
'<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"><input type="text" id="deadline' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="deadline[]" class="hide-input" oninput="handleDateInput(this, `deadline' + serialNumber +'`)" /></div></div></div></td>' +

                    '<td><input type="text" name="item_status[]"></td>'
                '</tr>';
                return html;
            }
            var tableBody = $('#observation tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });

        // -------------------------agenda--------------------
        $('#agenda').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number[]" value="' + serialNumber + '"></td>' +
                    // '<td><input type="date" name="date[]"></td>' +
                    '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"><input type="text" id="deadline'+ serialNumber +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="deadline[]" class="hide-input" oninput="handleDateInput(this, `deadline' + serialNumber +'`)" /></div></div></div></td>' +
                    '<td><input type="text" name="topic[]"></td>' +
                    '<td><input type="text" name="responsible[]"></td>' +
                    '<td><input type="time" name="start_time[]"></td>' +
                    '<td><input type="time" name="end_time[]"></td>' +
                    '<td><input type="text" name="comment[]"></td>' +
                    '</tr>';
                return html;
            }
            var tableBody = $('#agenda_body tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });

        // --------------------------------Capa Grids--------------------
        $('#product').click(function(e) {

            function generateTableRow(serialNumber) {
                var html = '<tr>' +
                    '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber + '"></td>' +
                    '<td><select name="product_name[]" id="product_name">' +
                    '<option value="">-- Select value --</option>' +
                    '<option value="PLACEBEFOREBIMATOPROSTOPH.SOLO.01%W/">PLACEBEFOREBIMATOPROSTOPH.SOLO.01%W/</option>' +
                    '<option value="BIMATOPROSTANDTIMOLOLMALEATEEDSOLUTION">BIMATOPROSTANDTIMOLOLMALEATEEDSOLUTION</option>' +
                    '<option value="CAFFEINECITRATEORALSOLUTION USP 60MG/3ML">CAFFEINECITRATEORALSOLUTION USP 60MG/3ML</option>' +
                    '<option value="BRIMONIDINE TART. OPH SOL 0.1%W/V (CB)">BRIMONIDINE TART. OPH SOL 0.1%W/V (CB)</option>' +
                    '<option value="DORZOLAMIDEPFREE20MG/MLEDSOLSINGLEDOSECO">DORZOLAMIDEPFREE20MG/MLEDSOLSINGLEDOSECO</option>' +
                    '</select></td>' +
                    '<td><select name="product_batch_no[]" id="batch_no">' +
                    '<option value="">select value</option>' +
                    '<option value="DCAU0030">DCAU0030</option>' +
                    '<option value="BDZH0007">BDZH0007</option>' +
                    '<option value="BDZH0006">BDZH0006</option>' +
                    '<option value="BJJH0004A">BJJH0004A</option>' +
                    '<option value="DCAU0036">DCAU0036</option>' +
                    '</select></td>' +
                    '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"><input type="text" id="product_mfg_date' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="product_mfg_date[]" class="hide-input" oninput="handleDateInput(this, `product_mfg_date' + serialNumber +'`)" /></div></div></div></td>' +
                    '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"><input type="text" id="product_expiry_date' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="product_expiry_date[]" class="hide-input" oninput="handleDateInput(this, `product_expiry_date' + serialNumber +'`)" /></div></div></div></td>' +
                    '<td><input type="text" name="product_batch_desposition[]"></td>' +
                    '<td><input type="text" name="product_remark[]"></td>' +
                    '<td><select name="product_batch_status[]" id="batch_status">' +
                    '<option value="">-- Select value --</option>' +
                    '<option value="Hold">Hold</option>' +
                    '<option value="Release">Release</option>' +
                    '<option value="quarantine">Quarantine</option>' +
                    '</select></td>' +
                    '</tr>';

                return html;
            }
            var tableBody = $('#product_details tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
        $('#material ').click(function(e) {
            function generateTableRow(serialNumber) {
                var html = '<tr>' +
                    '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber + '"></td>' +
                    // '<td><select name="material_name[]" id="material_name">' +
                    // '<option value="">-- Select value --</option>' +
                    // '<option value="PLACEBEFOREBIMATOPROSTOPH.SOLO.01%W/">PLACEBEFOREBIMATOPROSTOPH.SOLO.01%W/</option>' +
                    // '<option value="BIMATOPROSTANDTIMOLOLMALEATEEDSOLUTION">BIMATOPROSTANDTIMOLOLMALEATEEDSOLUTION</option>' +
                    // '<option value="CAFFEINECITRATEORALSOLUTION USP 60MG/3ML">CAFFEINECITRATEORALSOLUTION USP 60MG/3ML</option>' +
                    // '<option value="BRIMONIDINE TART. OPH SOL 0.1%W/V (CB)">BRIMONIDINE TART. OPH SOL 0.1%W/V (CB)</option>' +
                    // '<option value="DORZOLAMIDEPFREE20MG/MLEDSOLSINGLEDOSECO">DORZOLAMIDEPFREE20MG/MLEDSOLSINGLEDOSECO</option>' +
                    // '</select></td>' +
                    '<td><input type="text" name="material_name[]"></td>' +
                    // '<td><select name="material_batch_no[]" id="batch_no">' +
                    // '<option value="">select value</option>' +
                    // '<option value="DCAU0030">DCAU0030</option>' +
                    // '<option value="BDZH0007">BDZH0007</option>' +
                    // '<option value="BDZH0006">BDZH0006</option>' +
                    // '<option value="BJJH0004A">BJJH0004A</option>' +
                    // '<option value="DCAU0036">DCAU0036</option>' +
                    // '</select></td>' +
                    '<td><input type="text" name="material_batch_no[]"></td>' +
                    // '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"><input type="text" id="material_mfg_date' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="material_mfg_date[]" class="hide-input" oninput="handleDateInput(this, `material_mfg_date' + serialNumber +'`)" /></div></div></div></td>' +
                    // '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"><input type="text" id="material_expiry_date' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="material_expiry_date[]" class="hide-input" oninput="handleDateInput(this, `material_expiry_date' + serialNumber +'`)" /></div></div></div></td>' +
                    '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="material_mfg_date' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="material_mfg_date[]" id="material_mfg_date' + serialNumber +'_checkdate"  class="hide-input" oninput="handleDateInput(this, `material_mfg_date' + serialNumber +'`);checkDate(`material_mfg_date' + serialNumber +'_checkdate`,`material_expiry_date' + serialNumber +'_checkdate`)" /></div></div></div></td>' +
                    '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="material_expiry_date' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="material_expiry_date[]" id="material_expiry_date'+ serialNumber +'_checkdate" class="hide-input" oninput="handleDateInput(this, `material_expiry_date' + serialNumber +'`);checkDate(`material_mfg_date' + serialNumber +'_checkdate`,`material_expiry_date' + serialNumber +'_checkdate`)" /></div></div></div></td>' +

                    '<td><input type="text" name="material_batch_desposition[]"></td>' +
                    '<td><input type="text" name="material_remark[]"></td>' +
                    '<td><select name="material_batch_status[]" id="batch_status">' +
                    '<option value="">-- Select value --</option>' +
                    '<option value="Hold">Hold</option>' +
                    '<option value="Release">Release</option>' +
                    '<option value="quarantine">Quarantine</option>' +
                    '</select></td>' +
                    '</tr>';

                return html;
            }
            var tableBody = $('#material_details tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
        $('#equipment ').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber + '"></td>' +
                    '<td><input type="text" name="equipment[]"></td>' +
                    '<td><input type="text" name="equipment_instruments[]"></td>' +
                    '<td><input type="text" name="equipment_comments[]"></td>' +
                    '</tr>';
                return html;
            }
            var tableBody = $('#equipment_details tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });

        // $('#action_plan').click(function(e) {
        //     function generateTableRow(serialNumber) {
        //         var html =
        //             '<tr>' +
        //             '<td><input type="text" name="serial_number[]" value="' + serialNumber + '"></td>' +
        //             '<td><input type="text" name="action[]"></td>' +
        //             '<td><select name="responsible[]">' +
        //                 '<option value="">Select a value</option>';

        //             for (var i = 0; i < users.length; i++) {
        //                 html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
        //             }

        //             html += '</select></td>' +
        //             '<td><input type="text" name="deadline[]"></td>' +
        //             '<td><input type="text" name="item_static[]"></td>' +
        //             '</tr>';
        //         return html;
        //     }
        //     var tableBody = $('#action_plan_details tbody');
        //     var rowCount = tableBody.children('tr').length;
        //     var newRow = generateTableRow(rowCount + 1);
        //     tableBody.append(newRow);
        // });

        $('#action_plan2').click(function(e) {
            function generateTableRow(serialNumber) {
                var html =
                    '<tr>' +
                    '<td><input type="text" name="serial_number[]" value="' + serialNumber + '"></td>' +
                    '<td><input type="text" name="mitigation_steps[]"></td>' +
                    '<td><input type="text" name="deadline2[]"></td>' +
                    '<td><select name="responsible_person[]">' +
                        '<option value="">Select a value</option>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +
                    '<td><input type="text" name="status[]"></td>' +
                    '<td><input type="text" name="remark[]"></td>' +
                    '</tr>';
                return html;
            }
            var tableBody = $('#action_plan_details2 tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
        // ---------------------------------------------------
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
    integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script>
    // document.querySelector("#next_review_date").addEventListener("click", function() {
    //     console.log('change')
    //     var effectveDate = document.querySelector("#effective_date").value;
    //     var years = Number(document.querySelector("#review_period").value);
    //     var dueDateElement = document.querySelector("#next_review_date");

    //     console.log('effectveDate', effectveDate);

    //     if (!isNaN(years) && effectveDate.length) {
    //         effectveDate = effectveDate.split("-");
    //         effectveDate = new Date(effectveDate[0], effectveDate[1] - 1, effectveDate[2]);
    //         effectveDate.setFullYear(effectveDate.getFullYear() + years);
    //         // dueDateElement.valueAsDate = null;
    //         // dueDateElement.valueAsDate = effectveDate;
    //         $('.new_review_date_hide').val(effectveDate)
    //         $('.new_review_date_show').val(effectveDate)
    //         $('.new_review_date_hide').trigger('input')
    //     }
    // });

    function calculateNextReviewDate(dateString, years) {
        var effectveDate = document.querySelector("#effective_date").value;
        var years = Number(document.querySelector("#review_period").value);
        var dueDateElement = document.querySelector("#next_review_date");

        var date = moment(effectveDate, "DD-MMM-YYYY");
        var newEffectiveDate = date.add(parseInt(years), 'years');
        newEffectiveDate = newEffectiveDate.format('DD-MMM-YYYY')

        console.log('newEffectiveDate', newEffectiveDate)

        if (!isNaN(years) && effectveDate.length) {
            // effectveDate = effectveDate.split("-");
            // effectveDate = new Date(effectveDate[0], effectveDate[1] - 1, effectveDate[2]);
            // effectveDate.setFullYear(effectveDate.getFullYear() + years);
            // dueDateElement.valueAsDate = null;
            // dueDateElement.valueAsDate = effectveDate;
            $('.new_review_date_hide').val(newEffectiveDate)
            $('.new_review_date_show').val(newEffectiveDate)
            $('.new_review_date_hide').trigger('input')
        }
    }

    $('#review_period').change(function() {
        console.log('change')
        calculateNextReviewDate()
    })

    $('input[name=effective_date]').change(function() {
        console.log('change')
        calculateNextReviewDate()
    })
</script>

<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>

<script>
    // Get the textarea element
    var textArea = document.getElementById('textArea');
    // Get the paragraph element to display character count
    var charCountDisplay = document.getElementById('charCount');

    // Function to count characters in the textarea
    function countCharacters() {
      var text = textArea.value;
      // Display the character count
      charCountDisplay.textContent = 'Character count: ' + text.length;
    }

    // Add an event listener to the textarea to trigger character count on input
    textArea.addEventListener('input', function() {
      countCharacters();
      // Limit the text to 2500 characters
      if (textArea.value.length > 2500) {
        textArea.value = textArea.value.slice(0, 2500);
        countCharacters(); // Update character count after truncation
      }
    });

    // Call the countCharacters function initially to display character count for any existing text
    countCharacters();
  </script>



</body>

</html>
