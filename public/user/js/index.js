
function addRiskAssessment(tableId) {
    var table = document.getElementById(tableId);
    var currentRowCount = table.rows.length;
    var newRow = table.insertRow(currentRowCount);
    newRow.setAttribute("id", "row" + currentRowCount);

    var cell1 = newRow.insertCell(0);
    cell1.innerHTML = currentRowCount;

    var cell2 = newRow.insertCell(1);
    cell2.innerHTML = "<input name='risk_factor[]' type='text'>";

    var cell4 = newRow.insertCell(2);
    cell4.innerHTML = "<input name='problem_cause[]' type='text'>";

    var cell5 = newRow.insertCell(3);
    cell5.innerHTML = "<input name='existing_risk_control[]' type='text'>";

    var cell6 = newRow.insertCell(4);
    cell6.innerHTML =
        "<select onchange='calculateInitialResult(this)' class='fieldR' name='initial_severity[]'>" +
        "<option value=''>-- Select --</option>" +
        "<option value='1'>1-Insignificant</option>" +
        "<option value='2'>2-Minor</option>" +
        "<option value='3'>3-Major</option>" +
        "<option value='4'>4-Critical</option>" +
        "<option value='5'>5-Catastrophic</option>" +
        "</select>";

    var cell7 = newRow.insertCell(5);
    cell7.innerHTML =
        "<select onchange='calculateInitialResult(this)' class='fieldP' name='initial_probability[]'>" +
        "<option value=''>-- Select --</option>" +
        "<option value='1'>1-Very rare</option>" +
        "<option value='2'>2-Unlikely</option>" +
        "<option value='3'>3-Possibly</option>" +
        "<option value='4'>4-Likely</option>" +
        "<option value='5'>5-Almost certain (every time)</option>" +
        "</select>";

    var cell8 = newRow.insertCell(6);
    cell8.innerHTML =
        "<select onchange='calculateInitialResult(this)' class='fieldN' name='initial_detectability[]'>" +
        "<option value=''>-- Select --</option>" +
        "<option value='1'>1-Always detected</option>" +
        "<option value='2'>2-Likely to detect</option>" +
        "<option value='3'>3-Possible to detect</option>" +
        "<option value='4'>4-Unlikely to detect</option>" +
        "<option value='5'>5-Not detectable</option>" +
        "</select>";

    var cell9 = newRow.insertCell(7);
    cell9.innerHTML = "<input name='initial_rpn[]' type='text' class='initial-rpn'>";

    var cell11 = newRow.insertCell(8);
    cell11.innerHTML = "<input name='risk_control_measure[]' type='text'>";

    var cell12 = newRow.insertCell(9);
    cell12.innerHTML =
        "<select onchange='calculateResidualResult(this)' class='residual-fieldR' name='residual_severity[]'>" +
        "<option value=''>-- Select --</option>" +
        "<option value='1'>1-Insignificant</option>" +
        "<option value='2'>2-Minor</option>" +
        "<option value='3'>3-Major</option>" +
        "<option value='4'>4-Critical</option>" +
        "<option value='5'>5-Catastrophic</option>" +
        "</select>";

    var cell13 = newRow.insertCell(10);
    cell13.innerHTML =
        "<select onchange='calculateResidualResult(this)' class='residual-fieldP' name='residual_probability[]'>" +
        "<option value=''>-- Select --</option>" +
        "<option value='1'>1-Very rare</option>" +
        "<option value='2'>2-Unlikely</option>" +
        "<option value='3'>3-Possibly</option>" +
        "<option value='4'>4-Likely</option>" +
        "<option value='5'>5-Almost certain (every time)</option>" +
        "</select>";

    var cell14 = newRow.insertCell(11);
    cell14.innerHTML =
        "<select onchange='calculateResidualResult(this)' class='residual-fieldN' name='residual_detectability[]'>" +
        "<option value=''>-- Select --</option>" +
        "<option value='1'>1-Always detected</option>" +
        "<option value='2'>2-Likely to detect</option>" +
        "<option value='3'>3-Possible to detect</option>" +
        "<option value='4'>4-Unlikely to detect</option>" +
        "<option value='5'>5-Not detectable</option>" +
        "</select>";

    var cell15 = newRow.insertCell(12);
    cell15.innerHTML = "<input name='residual_rpn[]' type='text' class='residual-rpn' readonly>";

    var cell10 = newRow.insertCell(13);
    cell10.innerHTML =
        "<select name='risk_acceptance[]' class='risk-acceptance' readonly>" +
        "<option value=''>-- Select --</option>" +
        "<option value='Low'>Low</option>" +
        "<option value='Medium'>Medium</option>" +
        "<option value='High'>High</option>" +
        "</select>";

    var cell16 = newRow.insertCell(14);
    cell16.innerHTML =
        "<select name='risk_acceptance2[]'><option value=''>-- Select --</option><option value='N'>N</option><option value='Y'>Y</option></select>";

    var cell17 = newRow.insertCell(15);
    cell17.innerHTML = "<input name='mitigation_proposal[]' type='text'>";

    var cell18 = newRow.insertCell(16);
    cell18.innerHTML = "<button class='btn btn-dark removeBtn' onclick='removeRow(this)'>Remove</button>";

    // Update row numbers
    for (var i = 1; i <= currentRowCount; i++) {
        var row = table.rows[i];
        row.cells[0].innerHTML = i;
    }

    initializeRiskAcceptance();
}

function calculateResidualResult(element) {
    var row = element.closest('tr');
    var severity = parseInt(row.querySelector('.residual-fieldR').value) || 0;
    var probability = parseInt(row.querySelector('.residual-fieldP').value) || 0;
    var detectability = parseInt(row.querySelector('.residual-fieldN').value) || 0;

    var rpn = severity * probability * detectability;

    row.querySelector('.residual-rpn').value = rpn;

    // Update risk acceptance based on the new RPN value
    updateRiskAcceptance(row);
}

function updateRiskAcceptance(row) {
    var rpnValue = parseInt(row.querySelector('.residual-rpn').value, 10);
    var selectElement = row.querySelector('.risk-acceptance');

    if (!isNaN(rpnValue)) {
        if (rpnValue >= 1 && rpnValue <= 24) {
            selectElement.value = 'Low';
        } else if (rpnValue >= 25 && rpnValue <= 74) {
            selectElement.value = 'Medium';
        } else if (rpnValue >= 75 && rpnValue <= 125) {
            selectElement.value = 'High';
        } else {
            selectElement.value = '';
        }
    } else {
        selectElement.value = '';
    }
}

// Function to ensure risk acceptance is properly initialized
function initializeRiskAcceptance() {
    var riskAcceptanceElements = document.querySelectorAll('.risk-acceptance');
    riskAcceptanceElements.forEach(function(element) {
        var row = element.closest('tr');
        updateRiskAcceptance(row);
    });
}



