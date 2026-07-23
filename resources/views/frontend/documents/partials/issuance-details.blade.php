<style>
    .issuance-details-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 6px;
        font-size: 9px;
    }

    .issuance-details-table td {
        border: 1px solid #686868;
        padding: 4px 5px;
        vertical-align: middle;
    }

    .issuance-details-label {
        font-weight: bold;
        width: 18%;
        background: #f2f2f2;
    }

    .issuance-details-value {
        width: 32%;
    }
</style>

<table class="issuance-details-table">
    <tr>
        <td class="issuance-details-label">
            Request ID
        </td>

        <td class="issuance-details-value">
            {{ $requestId ?? 'N/A' }}
        </td>

        <td class="issuance-details-label">
            Copy No.
        </td>

        <td class="issuance-details-value">
            {{ $copyNumber ?? 1 }}
            of
            {{ $totalIssuedCopies ?? 1 }}
        </td>
    </tr>

    <tr>
        <td class="issuance-details-label">
            Issued By
        </td>

        <td class="issuance-details-value">
            {{ $issuedByName ?? 'N/A' }}
        </td>

        <td class="issuance-details-label">
            Issued Date
        </td>

        <td class="issuance-details-value">
            @if(!empty($issuedDate))
                {{ \Carbon\Carbon::parse($issuedDate)->format('d-M-Y') }}
            @else
                N/A
            @endif
        </td>
    </tr>

    <tr>
        <td class="issuance-details-label">
            Issued To
        </td>

        <td class="issuance-details-value">
            {{ $issuedToName ?? 'N/A' }}
        </td>

        <td class="issuance-details-label">
            Department
        </td>

        <td class="issuance-details-value">
            {{ $issuedToDepartment ?? 'N/A' }}
        </td>
    </tr>
</table>