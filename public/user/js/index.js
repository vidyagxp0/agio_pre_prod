// ============================== MULTI SELESTOR
$(document).ready(function () {
    let multipleCancelButton = new Choices("#choices-multiple-remove-button", {
        removeItemButton: true,
    });
});

function addMultipleFiles(input, block_id) {
    let block = document.getElementById(block_id);
    block.innerHTML = "";
    let files = input.files;
    for (let i = 0; i < files.length; i++) {
        let div = document.createElement('div');
        div.innerHTML += files[i].name;
        let viewLink = document.createElement("a");
        viewLink.href = URL.createObjectURL(files[i]);
        viewLink.textContent = "<View>";

        let fileClone = files[i].slice();
        viewLink.addEventListener('click',function(e){
            e.preventDefault();
            window.open(viewLink.href,'_blank');
        });
        div.appendChild(viewLink);
        block.appendChild(div);
    }
}

// ========================= GOOGLE LANGUAGE TRANSLATOR
function googleTranslateElementInit() {
    new google.translate.TranslateElement(
        { pageLanguage: "en" },
        "google_translate_element"
    );
}

window.onload = function () {
    document.querySelector("#preloader").style.display = "none";
};

// ========================= DASHBOARD CHART 1

var options = {
    maintainAspectRatio: false,
    scales: {
        y: {
            stacked: true,
            grid: {
                display: true,
                color: "#4274da36",
            },
        },
        x: {
            grid: {
                display: false,
            },
        },
    },
};
new Chart("chart", {
    type: "bar",
    options: options,
    data: data,
});

var options2 = {
    maintainAspectRatio: false,
    scales: {
        y: {
            stacked: true,
            grid: {
                display: true,
                color: "#4274da36",
            },
        },
        x: {
            grid: {
                display: false,
            },
        },
    },
};
new Chart("chart2", {
    type: "doughnut",
    options: options2,
    data: data2,
});

var options3 = {
    maintainAspectRatio: false,
    scales: {
        y: {
            stacked: true,
            grid: {
                display: true,
                color: "#4274da36",
            },
        },
        x: {
            grid: {
                display: false,
            },
        },
    },
};
new Chart("chart3", {
    type: "polarArea",
    options: options3,
    data: data3,
});

var options4 = {
    maintainAspectRatio: false,
    scales: {
        y: {
            stacked: true,
            grid: {
                display: true,
                color: "#4274da36",
            },
        },
        x: {
            grid: {
                display: false,
            },
        },
    },
};
new Chart("chart4", {
    type: "line",
    options: options4,
    data: data4,
});

function addRevRow(tableID) {
    var table = document.getElementById(tableID);
    var row = table.insertRow(-1);
    var id = 1;
    var id1 = 1;
    var id2 = 1;

    var cell1 = row.insertCell(0);
    var element1 = document.createElement("input");
    element1.type = "text";
    element1.id = "rev-num" + id;
    id += 1;
    cell1.appendChild(element1);

    var cell2 = row.insertCell(1);
    var element2 = document.createElement("input");
    element2.type = "text";
    element2.id = "control" + id1;
    id1 += 1;
    cell2.appendChild(element2);

    var cell3 = row.insertCell(2);
    var element3 = document.createElement("input");
    element3.type = "text";
    element3.id = "change" + id2;
    id2 += 1;
    cell3.appendChild(element3);
}

function addAnnRow(tableID) {
    var table = document.getElementById(tableID);
    var row = table.insertRow(-1);
    var id = 1;
    var id1 = 1;
    var id2 = 1;

    var cell1 = row.insertCell(0);
    var element1 = document.createElement("input");
    element1.type = "text";
    element1.id = "s" + id;
    id += 1;
    cell1.appendChild(element1);

    var cell2 = row.insertCell(1);
    var element2 = document.createElement("input");
    element2.type = "text";
    element2.id = "ann" + id1;
    id1 += 1;
    cell2.appendChild(element2);

    var cell3 = row.insertCell(2);
    var element3 = document.createElement("input");
    element3.type = "text";
    element3.id = "title" + id2;
    id2 += 1;
    cell3.appendChild(element3);
}

function addTrainRow(tableID) {
    var table = document.getElementById(tableID);
    var row = table.insertRow(-1);

    var cell1 = row.insertCell(0);
    var element1 = document.createElement("input");
    element1.type = "text";
    cell1.appendChild(element1);

    var cell2 = row.insertCell(1);
    var element2 = document.createElement("input");
    element2.type = "text";
    cell2.appendChild(element2);

    var cell3 = row.insertCell(2);
    var element3 = document.createElement("input");
    element3.type = "text";
    cell3.appendChild(element3);

    var cell4 = row.insertCell(3);
    var element4 = document.createElement("input");
    element4.type = "text";
    cell4.appendChild(element4);

    var cell5 = row.insertCell(4);
    var element5 = document.createElement("input");
    element5.type = "text";
    cell5.appendChild(element5);

    var cell6 = row.insertCell(5);
    var element6 = document.createElement("button");
    element6.className = "removeTrainRow";
    element6.innerHTML = "Remove";

    cell6.appendChild(element6);
}

// ================================= ADD DOCUMENT DETAILS ROW
function addDocDetail(tableId) {
    var table = document.getElementById(tableId);
    var currentRowCount = table.rows.length;

    // Create a new row and set its attributes
    var newRow = table.insertRow(currentRowCount);
    newRow.setAttribute("id", "row" + currentRowCount);

    // Add cells to the row and set their attributes
    var cell1 = newRow.insertCell(0);
    cell1.innerHTML = currentRowCount;

    var cell2 = newRow.insertCell(1);
    cell2.innerHTML =
        "<input type='text' name='' id='cur-doc-" + currentRowCount + "'>";

    var cell3 = newRow.insertCell(2);
    cell3.innerHTML =
        "<input type='text' id='cur-ver-" + currentRowCount + "'>";

    var cell4 = newRow.insertCell(3);
    cell4.innerHTML =
        "<input type='text' id='new-doc-" + currentRowCount + "'>";

    var cell5 = newRow.insertCell(4);
    cell5.innerHTML =
        "<input type='text' id='new-ver-" + currentRowCount + "'>";

    // Update the sr no. in the first cell of all rows
    for (var i = 1; i < currentRowCount; i++) {
        var row = table.rows[i];
        row.cells[0].innerHTML = i;
    }
}

function addIndividualRisk(tableId) {
    var table = document.getElementById(tableId);
    var currentRowCount = table.rows.length;
    var newRow = table.insertRow(currentRowCount);
    newRow.setAttribute("id", "row" + currentRowCount);
    var cell1 = newRow.insertCell(0);
    cell1.innerHTML = currentRowCount;

    var cell2 = newRow.insertCell(1);
    cell2.innerHTML =
        "<input type='text' id='cur-doc-" + currentRowCount + "'>";

    var cell3 = newRow.insertCell(2);
    cell3.innerHTML =
        "<input type='text' id='cur-ver-" + currentRowCount + "'>";

    var cell4 = newRow.insertCell(3);
    cell4.innerHTML =
        "<input type='text' id='new-doc-" + currentRowCount + "'>";

    var cell5 = newRow.insertCell(4);
    cell5.innerHTML =
        "<input type='text' id='new-ver-" + currentRowCount + "'>";

    var cell6 = newRow.insertCell(5);
    cell6.innerHTML =
        "<input type='text' id='cur-doc-" + currentRowCount + "'>";

    var cell7 = newRow.insertCell(6);
    cell7.innerHTML =
        "<input type='text' id='cur-ver-" + currentRowCount + "'>";

    var cell8 = newRow.insertCell(7);
    cell8.innerHTML =
        "<input type='text' id='new-doc-" + currentRowCount + "'>";

    var cell9 = newRow.insertCell(8);
    cell9.innerHTML =
        "<input type='text' id='new-ver-" + currentRowCount + "'>";
    for (var i = 1; i < currentRowCount; i++) {
        var row = table.rows[i];
        row.cells[0].innerHTML = i;
    }
}

function addAffectedDocuments(tableId) {
    var table = document.getElementById(tableId);
    var currentRowCount = table.rows.length;
    var newRow = table.insertRow(currentRowCount);
    newRow.setAttribute("id", "row" + currentRowCount);
    var cell1 = newRow.insertCell(0);
    cell1.innerHTML = currentRowCount;

    var cell2 = newRow.insertCell(1);
    cell2.innerHTML =
        "<input type='text' id='cur-doc-" + currentRowCount + "'>";

    var cell3 = newRow.insertCell(2);
    cell3.innerHTML =
        "<input type='text' id='cur-ver-" + currentRowCount + "'>";

    var cell4 = newRow.insertCell(3);
    cell4.innerHTML =
        "<input type='text' id='new-doc-" + currentRowCount + "'>";

    var cell5 = newRow.insertCell(4);
    cell5.innerHTML =
        "<input type='text' id='new-ver-" + currentRowCount + "'>";

    var cell6 = newRow.insertCell(5);
    cell6.innerHTML =
        "<input type='text' id='cur-doc-" + currentRowCount + "'>";

    var cell7 = newRow.insertCell(6);
    cell7.innerHTML =
        "<input type='text' id='cur-ver-" + currentRowCount + "'>";

    var cell8 = newRow.insertCell(7);
    cell8.innerHTML =
        "<input type='text' id='new-doc-" + currentRowCount + "'>";
    for (var i = 1; i < currentRowCount; i++) {
        var row = table.rows[i];
        row.cells[0].innerHTML = i;
    }
}

// ================================ EIGHT INPUTS
function addRiskAssessment(tableId) {
    var table = document.getElementById(tableId);
    var currentRowCount = table.rows.length;
    var newRow = table.insertRow(currentRowCount);
    newRow.setAttribute("id", "row" + currentRowCount);
    var cell1 = newRow.insertCell(0);
    cell1.innerHTML = currentRowCount;

    var cell2 = newRow.insertCell(1);
    cell2.innerHTML = "<input name='risk_factor[]' type='text'>";

    var cell3 = newRow.insertCell(2);
    cell3.innerHTML = "<input name='risk_element[]' type='text'>";

    var cell4 = newRow.insertCell(3);
    cell4.innerHTML = "<input name='problem_cause[]' type='text'>";

    var cell5 = newRow.insertCell(4);
    cell5.innerHTML = "<input name='existing_risk_control[]' type='text'>";

    var cell6 = newRow.insertCell(5);
    cell6.innerHTML =
        "<select onchange='calculateInitialResult(this)' class='fieldR' name='initial_severity[]'><option value=''>-- Select --</option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option></select>";

    var cell7 = newRow.insertCell(6);
    cell7.innerHTML =
        "<select onchange='calculateInitialResult(this)' class='fieldP' name='initial_probability[]'><option value=''>-- Select --</option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option></select>";

    var cell8 = newRow.insertCell(7);
    cell8.innerHTML =
        "<select onchange='calculateInitialResult(this)' class='fieldN' name='initial_detectability[]'><option value=''>-- Select --</option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option></select>";

    var cell9 = newRow.insertCell(8);
    cell9.innerHTML = "<input name='initial_rpn[]' ='text' class='initial-rpn'>";

    var cell10 = newRow.insertCell(9);
    cell10.innerHTML =
        "<select name='risk_acceptance[]'><option value=''>-- Select --</option><option value='N'>N</option><option value='Y'>Y</option></select>";

    var cell11 = newRow.insertCell(10);
    cell11.innerHTML = "<input name='risk_control_measure[]' type='text'>";

    var cell12 = newRow.insertCell(11);
    cell12.innerHTML =
        "<select onchange='calculateResidualResult(this)' class='residual-fieldR' name='residual_severity[]'><option value=''>-- Select --</option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option></select>";

    var cell13 = newRow.insertCell(12);
    cell13.innerHTML =
        "<select onchange='calculateResidualResult(this)' class='residual-fieldP' name='residual_probability[]'><option value=''>-- Select --</option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option></select>";

    var cell14 = newRow.insertCell(13);
    cell14.innerHTML =
        "<select onchange='calculateResidualResult(this)' class='residual-fieldN' name='residual_detectability[]'><option value=''>-- Select --</option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option></select>";

    var cell15 = newRow.insertCell(14);
    cell15.innerHTML = "<input name='residual_rpn[]'  type='text' class='residual-rpn' >";

    var cell16 = newRow.insertCell(15);
    cell16.innerHTML =
        "<select name='risk_acceptance2[]'><option value=''>-- Select --</option><option value='N'>N</option><option value='Y'>Y</option></select>";

    var cell17 = newRow.insertCell(16);
    cell17.innerHTML = "<input name='mitigation_proposal[]' type='text'>";
    for (var i = 1; i < currentRowCount; i++) {

        var row = table.rows[i];
        row.cells[0].innerHTML = i;
    }
}

// ================================ EIGHT INPUTS
// function addRootCauseAnalysisRiskAssessment(tableId) {
//     var table = document.getElementById(tableId);
//     var currentRowCount = table.rows.length;
//     var newRow = table.insertRow(currentRowCount);
//     newRow.setAttribute("id", "row" + currentRowCount);
//     var cell1 = newRow.insertCell(0);
//     cell1.innerHTML = currentRowCount;

//     var cell2 = newRow.insertCell(1);
//     cell2.innerHTML = "<input name='risk_factor[]' type='text'>";

//     var cell3 = newRow.insertCell(2);
//     cell3.innerHTML = "<input name='risk_element[]' type='text'>";

//     var cell4 = newRow.insertCell(3);
//     cell4.innerHTML = "<input name='problem_cause[]' type='text'>";

//     var cell5 = newRow.insertCell(4);
//     cell5.innerHTML = "<input name='existing_risk_control[]' type='text'>";

//     var cell6 = newRow.insertCell(5);
//     cell6.innerHTML =
//         "<select onchange='calculateInitialResult(this)' class='fieldR' name='initial_severity[]'><option value=''>-- Select --</option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option></select>";

//     var cell7 = newRow.insertCell(6);
//     cell7.innerHTML =
//         "<select onchange='calculateInitialResult(this)' class='fieldP' name='initial_probability[]'><option value=''>-- Select --</option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option></select>";

//     var cell8 = newRow.insertCell(7);
//     cell8.innerHTML =
//         "<select onchange='calculateInitialResult(this)' class='fieldN' name='initial_detectability[]'><option value=''>-- Select --</option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option></select>";

//     var cell9 = newRow.insertCell(8);
//     cell9.innerHTML = "<input name='initial_rpn[]' type='text' class='initial-rpn'  >";

//     var cell10 = newRow.insertCell(9);
//     cell10.innerHTML =
//         "<select name='risk_acceptance[]'><option value=''>-- Select --</option><option value='N'>N</option><option value='Y'>Y</option></select>";

//     var cell11 = newRow.insertCell(10);
//     cell11.innerHTML = "<input name='risk_control_measure[]' type='text'>";

//     var cell12 = newRow.insertCell(11);
//     cell12.innerHTML =
//         "<select onchange='calculateResidualResult(this)' class='residual-fieldR' name='residual_severity[]'><option value=''>-- Select --</option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option></select>";

//     var cell13 = newRow.insertCell(12);
//     cell13.innerHTML =
//         "<select onchange='calculateResidualResult(this)' class='residual-fieldP' name='residual_probability[]'><option value=''>-- Select --</option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option></select>";

//     var cell14 = newRow.insertCell(13);
//     cell14.innerHTML =
//         "<select onchange='calculateResidualResult(this)' class='residual-fieldN' name='residual_detectability[]'><option value=''>-- Select --</option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option></select>";

//     var cell15 = newRow.insertCell(14);
//     cell15.innerHTML = "<input name='residual_rpn[]' type='text' class='residual-rpn' >";

//     var cell16 = newRow.insertCell(15);
//     cell16.innerHTML =
//         "<select name='risk_acceptance2[]'><option value=''>-- Select --</option><option value='N'>N</option><option value='Y'>Y</option></select>";

//     var cell17 = newRow.insertCell(16);
//     cell17.innerHTML = "<input name='mitigation_proposal[]' type='text'>";

//     var cell18 = newRow.insertCell(17);
//     cell18.innerHTML = "<button type='text' class='removeBtn' name='Action[]' readonly>Remove</button>";

//     for (var i = 1; i < currentRowCount; i++) {
//         var row = table.rows[i];
//         row.cells[0].innerHTML = i;
//     }
// }

// function addDistributionRetrieval(tableId) {
//     let table = document.getElementById(tableId);
//     let currentRowCount = table.rows.length;
//     let newRow = table.insertRow(currentRowCount);
//     newRow.setAttribute("id", "row" + currentRowCount);

//     let cell1 = newRow.insertCell(0);
//     cell1.innerHTML = currentRowCount;

//     let cell2 = newRow.insertCell(1);
//     cell2.innerHTML = `<input type="text" name="distribution[${currentRowCount}][document_title]">`;

//     let cell3 = newRow.insertCell(2);
//     cell3.innerHTML = `<input type="number" name="distribution[${currentRowCount}][document_number]">`;

//     let cell4 = newRow.insertCell(3);
//     cell4.innerHTML = `<input type="text" name="distribution[${currentRowCount}][document_printed_by]">`;

//     let cell5 = newRow.insertCell(4);
//     cell5.innerHTML = `<input type="text" name="distribution[${currentRowCount}][document_printed_on]">`;

//     let cell6 = newRow.insertCell(5);
//     cell6.innerHTML = `<input type="number" name="distribution[${currentRowCount}][document_printed_copies]">`;

//     let cell7 = newRow.insertCell(6);
//     cell7.innerHTML = '<div class="group-input new-date-data-field mb-0"> <div class="input-date "><div class="calenderauditee"><input type="text" id="issuance_date' + currentRowCount +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="distribution['+ currentRowCount +'][issuance_date]" class="hide-input" oninput="handleDateInput(this, `issuance_date' + currentRowCount +'`)" /></div></div></div>';

//     let cell8 = newRow.insertCell(7)
//     cell8.innerHTML = `<select id="select-state" placeholder="Select..."
//         name="distribution[${currentRowCount}][issuance_to]">
//         <option value='0'>-- Select --</option>
//         <option value='1'>Amit Guru</option>
//         <option value='2'>Shaleen Mishra</option>
//         <option value='3'>Madhulika Mishra</option>
//         <option value='4'>Amit Patel</option>
//         <option value='5'>Harsh Mishra</option>
//     </select>`

//     let cell9 = newRow. insertCell(8)
//     cell9.innerHTML = `<select id="select-state" placeholder="Select..."
//         name="distribution[${currentRowCount}][location]">
//         <option value='0'>-- Select --</option>
//         <option value='1'>Tech Team</option>
//         <option value='2'>Quality Assurance</option>
//         <option value='3'>Quality Management</option>
//         <option value='4'>IT Administration</option>
//         <option value='5'>Business Administration</option>
//     </select>`

//     let cell10 = newRow.insertCell(9);
//     cell10.innerHTML = `<input type="number" name="distribution[${currentRowCount}][issued_copies]">`;

//     let cell11 = newRow.insertCell(10);
//     cell11.innerHTML = `<input type="text" name="distribution[${currentRowCount}][issued_reason]">`;

//     let cell12 = newRow.insertCell(11);
//     cell12.innerHTML = '<div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"><input type="text" id="retrieval_date' + currentRowCount +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="distribution['+currentRowCount+'][retrieval_date]" class="hide-input" oninput="handleDateInput(this, `retrieval_date' + currentRowCount +'`)" /></div></div></div>';

//     let cell13 = newRow.insertCell(12)
//     cell13.innerHTML = `<select id="select-state" placeholder="Select..."
//         name="distribution[${currentRowCount}][retrieval_by]">
//         <option value="">Select a value</option>
//         <option value='1'>Amit Guru</option>
//         <option value='2'>Shaleen Mishra</option>
//         <option value='3'>Madhulika Mishra</option>
//         <option value='4'>Amit Patel</option>
//         <option value='5'>Harsh Mishra</option>
//     </select>`;

//     let cell14 = newRow.insertCell(13)
//     cell14.innerHTML = `<select id="select-state" placeholder="Select..."
//         name="distribution[${currentRowCount}][retrieved_department]">
//         <option value='0'>-- Select --</option>
//         <option value='1'>Tech Team</option>
//         <option value='2'>Quality Assurance</option>
//         <option value='3'>Quality Management</option>
//         <option value='4'>IT Administration</option>
//         <option value='5'>Business Administration</option>
//     </select>`;

//     let cell15 = newRow.insertCell(14);
//     cell15.innerHTML = `<input type="number" name="distribution[${currentRowCount}][retrieved_copies]">`;

//     let cell16 = newRow.insertCell(15);
//     cell16.innerHTML = `<input type="text" name="distribution[${currentRowCount}][retrieved_reason]">`;

//     let cell17 = newRow.insertCell(16);
//     cell17.innerHTML = `<input type="text" name="distribution[${currentRowCount}][remark]">`;

//     var cell18 = newRow.insertCell(17);
//     cell18.innerHTML = "<button class='removeTrainRow'>Remove</button>";

//     cell18.appendChild(element18);

//     for (let i = 1; i < currentRowCount; i++) {
//         let row = table.rows[i];
//         row.cells[0].innerHTML = i;
//     }
// }

function addManagementReviewParticipants(tableId) {
    let table = document.getElementById(tableId);
    let currentRowCount = table.rows.length;
    let newRow = table.insertRow(currentRowCount);
    newRow.setAttribute("id", "row" + currentRowCount);

    let cell1 = newRow.insertCell(0);
    cell1.innerHTML = currentRowCount;

    let cell2 = newRow.insertCell(1)
   // cell2.innerHTML = "<select><option value='0'>-- Select --</option><option value='1'>Amit Guru</option><option value='2'>Shaleen Mishra</option><option value='3'>Madhulika Mishra</option><option value='4'>Amit Patel</option><option value='5'>Harsh Mishra</option></select>"
    cell2.innerHTML = "<input type='text' name='invited_Person[]'>";
    let cell3 = newRow.insertCell(2)
   // cel3.innerHTML = "<select><option value='0'>-- Select --</option><option value='1'>Amit Guru</option><option value='2'>Shaleen Mishra</option><option value='3'>Madhulika Mishra</option><option value='4'>Amit Patel</option><option value='5'>Harsh Mishra</option></select>"
    cell3.innerHTML = "<input type='text' name='designee[]'>";
    let cell4 = newRow.insertCell(3)
   // cell4.innerHTML = "<select><option value='0'>-- Select --</option><option value='QA'>Quality Assurance</option><option value='QC'>Quality Control</option><option value='Prod'>Production</option></select>"
    cell4.innerHTML = "<input type='text' name='department[]'>";
    let cell5 = newRow.insertCell(4)
   // cell5.innerHTML = "<select><option value='0'>-- Select --</option><option value='Yes'>Yes</option><option value='No'>No</option></select>"
    cell5.innerHTML = "<input type='text' name='meeting_Attended[]'>";
    let cell6 = newRow.insertCell(5)
  //  cell6.innerHTML = "<select><option value='0'>-- Select --</option><option value='1'>Amit Guru</option><option value='2'>Shaleen Mishra</option><option value='3'>Madhulika Mishra</option><option value='4'>Amit Patel</option><option value='5'>Harsh Mishra</option></select>"
    cell6.innerHTML = "<input type='text' name='designee_Name[]'>";
    let cell7 = newRow.insertCell(6)
   // cell7.innerHTML = "<select><option value='0'>-- Select --</option><option value='QA'>Quality Assurance</option><option value='QC'>Quality Control</option><option value='Prod'>Production</option></select>"
    cell7.innerHTML = "<input type='text' name='designee_Department[]'>";
    let cell8 = newRow.insertCell(7);
    cell8.innerHTML = "<input type='text' name='remarks[]'>";

    for (let i = 1; i < currentRowCount; i++) {
        let row = table.rows[i];
        row.cells[0].innerHTML = i;
    }
}

// ================================ EIGHT INPUTS
function add11Input(tableId) {
    var table = document.getElementById(tableId);
    var currentRowCount = table.rows.length;
    var newRow = table.insertRow(currentRowCount);
    newRow.setAttribute("id", "row" + currentRowCount);
    var cell1 = newRow.insertCell(0);
    cell1.innerHTML = currentRowCount;

    var cell2 = newRow.insertCell(1);
    cell2.innerHTML = "<input type='text'>";

    var cell3 = newRow.insertCell(2);
    cell3.innerHTML = "<input type='text'>";

    var cell4 = newRow.insertCell(3);
    cell4.innerHTML = "<input type='text'>";

    var cell5 = newRow.insertCell(4);
    cell5.innerHTML = "<input type='text'>";

    var cell6 = newRow.insertCell(5);
    cell6.innerHTML = "<input type='text'>";

    var cell7 = newRow.insertCell(6);
    cell7.innerHTML = "<input type='text'>";

    var cell8 = newRow.insertCell(7);
    cell8.innerHTML = "<input type='text'>";

    var cell9 = newRow.insertCell(8);
    cell9.innerHTML = "<input type='text'>";

    var cell10 = newRow.insertCell(9);
    cell10.innerHTML = "<input type='text'>";

    var cell11 = newRow.insertCell(10);
    cell11.innerHTML = "<input type='text'>";

    var cell12 = newRow.insertCell(11);
    cell12.innerHTML = "<input type='text'>";
    for (var i = 1; i < currentRowCount; i++) {
        var row = table.rows[i];
        row.cells[0].innerHTML = i;
    }
}

// ================================ EIGHT INPUTS
function add10Input(tableId) {
    var table = document.getElementById(tableId);
    var currentRowCount = table.rows.length;
    var newRow = table.insertRow(currentRowCount);
    newRow.setAttribute("id", "row" + currentRowCount);
    var cell1 = newRow.insertCell(0);
    cell1.innerHTML = currentRowCount;

    var cell2 = newRow.insertCell(1);
    cell2.innerHTML = "<input type='text'>";

    var cell3 = newRow.insertCell(2);
    cell3.innerHTML = "<input type='text'>";

    var cell4 = newRow.insertCell(3);
    cell4.innerHTML = "<input type='text'>";

    var cell5 = newRow.insertCell(4);
    cell5.innerHTML = "<input type='text'>";

    var cell6 = newRow.insertCell(5);
    cell6.innerHTML = "<input type='text'>";

    var cell7 = newRow.insertCell(6);
    cell7.innerHTML = "<input type='text'>";

    var cell8 = newRow.insertCell(7);
    cell8.innerHTML = "<input type='text'>";

    var cell9 = newRow.insertCell(8);
    cell9.innerHTML = "<input type='text'>";

    var cell10 = newRow.insertCell(9);
    cell10.innerHTML = "<input type='text'>";

    var cell11 = newRow.insertCell(10);
    cell11.innerHTML = "<input type='text'>";
    cell12.innerHTML = "<input type='text'>";
    for (var i = 1; i < currentRowCount; i++) {
        var row = table.rows[i];
        row.cells[0].innerHTML = i;
    }
}

// ================================ EIGHT INPUTS
// function add9Input(tableId) {
//     var table = document.getElementById(tableId);
//     var currentRowCount = table.rows.length;
//     var newRow = table.insertRow(currentRowCount);
//     newRow.setAttribute("id", "row" + currentRowCount);
//     var cell1 = newRow.insertCell(0);
//     cell1.innerHTML = currentRowCount;

//     var cell2 = newRow.insertCell(1);
//     cell2.innerHTML = "<input type='text'>";

//     var cell3 = newRow.insertCell(2);
//     cell3.innerHTML = "<input type='text'>";

//     var cell4 = newRow.insertCell(3);
//     cell4.innerHTML = "<input type='text'>";

//     var cell5 = newRow.insertCell(4);
//     cell5.innerHTML = "<input type='date'>";

//     var cell6 = newRow.insertCell(5);
//     cell6.innerHTML = "<input type='text'>";

//     var cell7 = newRow.insertCell(6);
//     cell7.innerHTML = "<input type='date'>";

//     var cell8 = newRow.insertCell(7);
//     cell8.innerHTML = "<input type='text'>";

//     var cell9 = newRow.insertCell(8);
//     cell9.innerHTML = "<input type='text'>";

//     var cell10 = newRow.insertCell(9);
//     cell10.innerHTML = "<input type='date'>";
//     for (var i = 1; i < currentRowCount; i++) {
//         var row = table.rows[i];
//         row.cells[0].innerHTML = i;
//     }
// }

// ================================ EIGHT INPUTS
function add8Input(tableId) {
    var table = document.getElementById(tableId);
    var currentRowCount = table.rows.length;
    var newRow = table.insertRow(currentRowCount);
    newRow.setAttribute("id", "row" + currentRowCount);
    var cell1 = newRow.insertCell(0);
    cell1.innerHTML = currentRowCount;

    var cell2 = newRow.insertCell(1);
    cell2.innerHTML = "<input type='text'>";

    var cell3 = newRow.insertCell(2);
    cell3.innerHTML = "<input type='text'>";

    var cell4 = newRow.insertCell(3);
    cell4.innerHTML = "<input type='text'>";

    var cell5 = newRow.insertCell(4);
    cell5.innerHTML = "<input type='text'>";

    var cell6 = newRow.insertCell(5);
    cell6.innerHTML = "<input type='text'>";

    var cell7 = newRow.insertCell(6);
    cell7.innerHTML = "<input type='text'>";

    var cell8 = newRow.insertCell(7);
    cell8.innerHTML = "<input type='text'>";

    var cell9 = newRow.insertCell(8);
    cell9.innerHTML = "<input type='text'>";
    for (var i = 1; i < currentRowCount; i++) {
        var row = table.rows[i];
        row.cells[0].innerHTML = i;
    }
}

// ================================ SEVEN INPUTS
function add7Input(tableId) {
    var table = document.getElementById(tableId);
    var currentRowCount = table.rows.length;
    var newRow = table.insertRow(currentRowCount);
    newRow.setAttribute("id", "row" + currentRowCount);
    var cell1 = newRow.insertCell(0);
    cell1.innerHTML = currentRowCount;

    var cell2 = newRow.insertCell(1);
    cell2.innerHTML = "<input type='text'>";

    var cell3 = newRow.insertCell(2);
    cell3.innerHTML = "<input type='text'>";

    var cell4 = newRow.insertCell(3);
    cell4.innerHTML = "<input type='text'>";

    var cell5 = newRow.insertCell(4);
    cell5.innerHTML = "<input type='text'>";

    var cell6 = newRow.insertCell(5);
    cell6.innerHTML = "<input type='text'>";

    var cell7 = newRow.insertCell(6);
    cell7.innerHTML = "<input type='text'>";

    var cell8 = newRow.insertCell(7);
    cell8.innerHTML = "<input type='text'>";
    for (var i = 1; i < currentRowCount; i++) {
        var row = table.rows[i];
        row.cells[0].innerHTML = i;
    }
}

// ================================ SIX INPUTS
function add6Input(tableId) {
    var table = document.getElementById(tableId);
    var currentRowCount = table.rows.length;
    var newRow = table.insertRow(currentRowCount);
    newRow.setAttribute("id", "row" + currentRowCount);
    var cell1 = newRow.insertCell(0);
    cell1.innerHTML = currentRowCount;

    var cell2 = newRow.insertCell(1);
    cell2.innerHTML = "<input type='text'>";

    var cell3 = newRow.insertCell(2);
    cell3.innerHTML = "<input type='text'>";

    var cell4 = newRow.insertCell(3);
    cell4.innerHTML = "<input type='text'>";

    var cell5 = newRow.insertCell(4);
    cell5.innerHTML = "<input type='text'>";

    var cell6 = newRow.insertCell(5);
    cell6.innerHTML = "<input type='text'>";

    var cell7 = newRow.insertCell(6);
    cell7.innerHTML = "<input type='text'>";
    for (var i = 1; i < currentRowCount; i++) {
        var row = table.rows[i];
        row.cells[0].innerHTML = i;
    }
}

// ================================ FIVE INPUTS
function add5Input(tableId) {
    var table = document.getElementById(tableId);
    var currentRowCount = table.rows.length;
    var newRow = table.insertRow(currentRowCount);
    newRow.setAttribute("id", "row" + currentRowCount);
    var cell1 = newRow.insertCell(0);
    cell1.innerHTML = currentRowCount;

    var cell2 = newRow.insertCell(1);
    cell2.innerHTML = "<input type='text' name='auditees'>";

    var cell3 = newRow.insertCell(2);
    cell3.innerHTML = "<input type='text' name='date_start'>";

    var cell4 = newRow.insertCell(3);
    cell4.innerHTML = "<input type='text' name='date_end'>";

    var cell5 = newRow.insertCell(4);
    cell5.innerHTML = "<input type='text' name='lead_investigator'>";

    var cell6 = newRow.insertCell(5);
    cell6.innerHTML = "<input type='text' name='comment'>";
    for (var i = 1; i < currentRowCount; i++) {
        var row = table.rows[i];
        row.cells[0].innerHTML = i;
    }
}

// ================================ FOUR INPUTS
// function add4Input(tableId) {
//     var table = document.getElementById(tableId);
//     var currentRowCount = table.rows.length;
//     var newRow = table.insertRow(currentRowCount);
//     newRow.setAttribute("id", "row" + currentRowCount);
//     var cell1 = newRow.insertCell(0);
//     cell1.innerHTML = currentRowCount;

//     var cell2 = newRow.insertCell(1);
//     cell2.innerHTML = "<input type='text' name='Root_Cause_Category[]'>";

//     var cell3 = newRow.insertCell(2);
//     cell3.innerHTML = "<input type='text' name='Root_Cause_Sub_Category[]'>";

//     var cell4 = newRow.insertCell(3);
//     cell4.innerHTML = "<input type='text' name='Probability[]'>";

//     var cell5 = newRow.insertCell(4);
//     cell5.innerHTML = "<input type='text' name='Remarks[]'>";

//     let cell6 = newRow.insertCell(5);
//     cell6.innerHTML = "<button type='text' class='removeRowBtn' name='Action[]' readonly>Remove</button>";

//     for (var i = 1; i < currentRowCount; i++) {
//         var row = table.rows[i];
//         row.cells[0].innerHTML = i;
//     }
// }

// ================================ THREE INPUTS
function add3Input(tableId) {
    var table = document.getElementById(tableId);
    var currentRowCount = table.rows.length;
    var newRow = table.insertRow(currentRowCount);
    newRow.setAttribute("id", "row" + currentRowCount);
    var cell1 = newRow.insertCell(0);
    cell1.innerHTML = currentRowCount;

    var cell2 = newRow.insertCell(1);
    cell2.innerHTML = "<input type='text'>";

    var cell3 = newRow.insertCell(2);
    cell3.innerHTML = "<input type='text'>";

    var cell4 = newRow.insertCell(3);
    cell4.innerHTML = "<input type='text'>";
    for (var i = 1; i < currentRowCount; i++) {
        var row = table.rows[i];
        row.cells[0].innerHTML = i;
    }
}

// ================================ TWO INPUTS
function add2Input(tableId) {
    var table = document.getElementById(tableId);
    var currentRowCount = table.rows.length;
    var newRow = table.insertRow(currentRowCount);
    newRow.setAttribute("id", "row" + currentRowCount);
    var cell1 = newRow.insertCell(0);
    cell1.innerHTML = currentRowCount;

    var cell2 = newRow.insertCell(1);
    cell2.innerHTML = "<input type='text' name='Question[]' >";

    var cell3 = newRow.insertCell(2);
    cell3.innerHTML = "<input type='text' name='Response[]'>";
    for (var i = 1; i < currentRowCount; i++) {
        var row = table.rows[i];
        row.cells[0].innerHTML = i;
    }
}

// ================================ PR TABS
// function openData(evt, dataname) {
//     var i, tabcontent, tablinks;
//     tabcontent = document.getElementsByClassName("tabcontent");
//     for (i = 0; i < tabcontent.length; i++) {
//         tabcontent[i].style.display = "none";
//     }
//     tablinks = document.getElementsByClassName("tablinks");
//     for (i = 0; i < tablinks.length; i++) {
//         tablinks[i].className = tablinks[i].className.replace(" active", "");
//     }
//     document.getElementById(dataname).style.display = "block";
//     evt.currentTarget.className += " active";
// }
// document.getElementById("defaultOpen").click();

function openDivision(evt, cityName) {

    $(".process_id_reset").prop("checked", false);

    var i, divisioncontent, divisionlinks;

    divisioncontent = document.getElementsByClassName("divisioncontent");
    for (i = 0; i < divisioncontent.length; i++) {
        divisioncontent[i].style.display = "none";
    }

    divisionlinks = document.getElementsByClassName("divisionlinks");
    for (i = 0; i < divisionlinks.length; i++) {
        divisionlinks[i].className = divisionlinks[i].className.replace(
            " active",
            ""
        );
    }

    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

 
function handleDateInput(element, textInputID) {
    let textInput = document.getElementById(textInputID)
    const date = new Date(element.value);
    const months = [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec",];
    const month = months[date.getMonth()];
    const day = date.getDate();
    const year = date.getFullYear();
    textInput.setAttribute('value', `${day}-${month}-${year}`)
  }
 
  function isStartDateLessThanEndDate(startDate, endDate) {
    // Convert date strings to Date objects
    const startDateObj = new Date(startDate);
    const endDateObj = new Date(endDate); 
    // Compare the dates
    return startDateObj <= endDateObj;
  }
  
  function checkDate(textInputID,textInputID2){
    const startDate = $('#'+textInputID).val();  // Replace with your start date
    const endDate = $('#'+textInputID2).val();    // Replace with your end date 
    if ((startDate.trim() !== '') && (endDate.trim() !== '')) {
        let endDataStr = textInputID2.replace(/_checkdate/g, ""); 
        if (isStartDateLessThanEndDate(startDate, endDate)) {
            console.log("Start date is less than end date.");
            //let textInput = document.getElementById(endDataStr)
            // const date = new Date(element.value);
            // const months = [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec",];
            // const month = months[date.getMonth()];
            // const day = date.getDate();
            // const year = date.getFullYear();
            // textInput.setAttribute('value', `${day}-${month}-${year}`)
        } else { 
        alert("Start date is not less than end date.");
        let textInput = document.getElementById(endDataStr)
        textInput.setAttribute('value', ``)
        console.log("Start date is not less than end date.");
      }
    }
  }
