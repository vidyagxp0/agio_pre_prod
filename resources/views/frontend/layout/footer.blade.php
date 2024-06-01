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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js'></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{ asset('user/js/index.js') }}"></script>
<script src="{{ asset('user/js/validate.js') }}"></script>
<script src="{{ asset('user/js/countryState.js') }}"></script>
{{-- @toastr_js @toastr_render @jquery --}}

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
        cell9.innerHTML = `<select id="select-state" placeholder="Select..."
            name="distribution[${currentRowCount}][location]">
            <option value='0'>-- Select --</option>
            <option value="CQA">Corporate Quality Assurance</option>
            <option value="QAB" >Quality Assurance Biopharma</option>
            <option value="CQC" >Central Quality Control</option>
            <option value="MANU" >Manufacturing</option>
            <option value="PSG" >Plasma Sourcing Group</option>
            <option value="CS" >Central Stores</option>
            <option value="ITG" > Information Technology Group</option>
            <option value="MM" >Molecular Medicine</option>
            <option value="CL" > Central Laboratory</option>
            <option value="TT">Tech Team</option>
            <option value="QA"> Quality Assurance</option>
            <option value="Prod">Production</option>
            <option value="AM">Accounting Manager</option>
            <option value="QC">Quality Control</option>
            <option value="QM" > Quality Management</option>
            <option value="IA">IT Administration</option>
            <option value="ACC"> Accounting</option>
            <option value="LOG" > Logistics</option>
            <option value="SM" > Senior Management</option>
            <option value="BA" >Business Administration</option>
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



        $('#abbreviationbtnadd').click(function(e) {

            var html =
                '<div class="singleAbbreviationBlock"><div class="resrow row"><div class="col-10"><textarea name="abbreviation[]" class="myclassname"></textarea> </div> <div class="col-sm-1"> <button class="btn btn-dark subAbbreviationAdd">+</button> </div>  <div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#abbreviationdiv').append(html);

        });

        $(document).on('click', '.abbreviationbtnRemove', function(e) {
            e.preventDefault();
            $(this).closest('div.row').remove();
        })

        
       

        $('#Definitionbtnadd').click(function(e) {

            var html =
                '<div class="singleDefinitionBlock"><div class="resrow row"><div class="col-10"><textarea name="defination[]" class="myclassname"></textarea> </div><div class="col-sm-1"> <button class="btn btn-dark subDefinitionAdd">+</button> </div><div class="col-1"><button class="btn btn-danger removeAllBlocks">Remove</button></div></div></div>';

            $('#definitiondiv').append(html);

        });

        let subMaterialsAdd = 0;
        let subResponsibilityAdd = 0;
        let subAbbreviationAdd = 0;
        let subDefinitionAdd = 0;
        let subReferencesAdd = 0;
        let subAnnexureAdd = 0;
        let subReportingAdd = 0;

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
