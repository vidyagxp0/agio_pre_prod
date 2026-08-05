<style>
    .document-table {
        width: 100%;
        table-layout: fixed;
    }

    .document-table th,
    .document-table td {
        vertical-align: middle;
        padding: 8px;
    }

    .document-table .pr-id {
        width: 50px;
    }

    .document-table .doc-no {
        width: 110px;
    }

    .document-table .doc-title {
        width: 170px;
    }

    .document-table .doc-type {
        width: 100px;
    }

    .document-table .division {
        width: 70px;
    }

    .document-table .short-desc {
        width: 220px;
    }

    .document-table .create-date,
    .document-table .modify-date {
        width: 130px;
    }

    .document-table .assign-name {
        width: 110px;
    }

    .document-table .status {
        width: 90px;
    }

    .document-table .action {
        width: 80px;
    }

    .text-truncate-cell {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>

<div class="main-head">
    <div>Records</div>
    <div>
        {{ count($documents) }} Results {{ isset($count) ? ' out of Results ' . $count : 'found' }}
    </div>
</div>

<div class="table-list">

    <table class="table table-bordered document-table">

        <thead>

            <tr>

                <th class="pr-id" data-bs-toggle="modal" data-bs-target="#division-modal">
                    ID
                </th>

                <th class="doc-no">
                    Document No.
                </th>

                <th class="doc-title">
                    Document Title
                </th>

                <th class="doc-type">
                    Document Type
                </th>

                <th class="division">
                    Division
                </th>

                <th class="short-desc">
                    Short Description
                </th>

                <th class="create-date">
                    Create Date Time
                </th>

                <th class="assign-name">
                    Originator
                </th>

                <th class="modify-date">
                    Modify Date Time
                </th>

                <th class="status">
                    Status
                </th>

                <th class="action">
                    Action
                </th>

            </tr>

        </thead>

        <tbody id="searchTable">

            @if(count($documents) > 0)

                @foreach($documents as $doc)

                    <tr>

                        <td class="pr-id" style="text-decoration: underline;">
                            <a href="{{ route('documents.edit',$doc->id) }}">
                                {{ Helpers::recordFormat($doc->id) }}
                            </a>
                        </td>

                        <td class="doc-no text-truncate-cell"
                            title="{{ $doc->document_number }}">
                            {{ $doc->document_number ?? 'NA' }}
                        </td>

                        <td class="doc-title text-truncate-cell"
                            title="{{ $doc->document_name }}">
                            {{ $doc->document_name ?? 'NA' }}
                        </td>

                        <td class="doc-type text-truncate-cell"
                            title="{{ Helpers::getDocumentTypes()[$doc->document_type_id] }}">
                            {{ Helpers::getDocumentTypes()[$doc->document_type_id] ?? 'NA' }}
                        </td>

                        <td class="division text-truncate-cell"
                            title="{{ Helpers::getDivisionName($doc->division_id) }}">
                            {{ Helpers::getDivisionName($doc->division_id) ?? 'NA'  }}
                        </td>

                        <td class="short-desc text-truncate-cell"
                            title="{{ $doc->short_description }}">
                            {{ $doc->short_description ?? 'NA'  }}
                        </td>

                        <td class="create-date">
                            {{ \Carbon\Carbon::parse($doc->created_at)->format('d-M-Y h:i A') ?? 'NA' }}
                        </td>

                        <td class="assign-name text-truncate-cell"
                            title="{{ $doc->originator_name }}">
                            {{ $doc->originator_name ?? 'NA' }}
                        </td>

                        <td class="modify-date">
                            {{ \Carbon\Carbon::parse($doc->updated_at)->format('d-M-Y h:i A') }}
                        </td>

                        <td class="status">
                            {{ Helpers::getDocStatusByStage($doc->stage,$doc->training_required) ?? 'NA'  }}
                        </td>

                        <td class="action">

                            <div class="action-dropdown">

                                <div class="action-down-btn">
                                    Action
                                    <i class="fa-solid fa-angle-down"></i>
                                </div>

                                <div class="action-block">

                                    <a href="{{ url('doc-details',$doc->id) }}">
                                        View
                                    </a>

                                    @if($doc->status != 'Obsolete')

                                        <a href="{{ route('documents.edit',$doc->id) }}">
                                            Edit
                                        </a>

                                    @endif

                                </div>

                            </div>

                        </td>

                    </tr>

                @endforeach

            @else

                <tr>

                    <td colspan="11" class="text-center">
                        <h5>Data not Found</h5>
                    </td>

                </tr>

            @endif

        </tbody>

    </table>

    @if(isset($count))
        {!! $documents->links() !!}
    @endif

</div>
{{-- ========================================================== --}}
{{-- REQUEST DOCUMENT RECORDS TABLE --}}
{{-- ========================================================== --}}

<style>
    .request-document-table {
        width: 100%;
        table-layout: fixed;
    }

    .request-document-table th,
    .request-document-table td {
        vertical-align: middle;
        word-wrap: break-word;
    }

    .request-document-table .request-id {
        width: 80px;
    }

    .request-document-table .document-number {
        width: 110px;
    }

    .request-document-table .request-by {
        width: 80px;
    }

    .request-document-table .department {
        width: 120px;
    }

    .request-document-table .request-to {
        width: 100px;
    }

    .request-document-table .copies {
        width: 70px;
        text-align: center;
    }

    .request-document-table .reason {
        width: 240px;
    }

    .request-document-table .create-date {
        width: 120px;
    }

    .request-document-table .status {
        width: 80px;
    }

    .request-document-table .action {
        width: 65px;
    }

    .request-reason-text {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .request-document-table .sr-no {
        width: 55px;
        text-align: center;
    }
</style>

<div class="" style="    background: #4274da;
    text-align: left;
    padding: 5px 10px;
    color: white;
    font-size: 1.1rem;
    font-weight: bold;
    letter-spacing: 2px;">
    <div>Document Issuance Request Records</div>

    <div>
        {{ isset($requestDocuments) ? $requestDocuments->total() : 0 }}
        Results found
    </div>
</div>

<div class="table-list">

    <table class="table table-bordered request-document-table">

        <thead>
            <tr>
                <th class="sr-no">
                    Sr. No.
                </th>

                <th class="request-id">
                    Request ID
                </th>

                <th class="document-number">
                    Document Number
                </th>

                <th class="request-by">
                    Request By
                </th>

                <th class="department">
                    Department
                </th>

                <th class="request-to">
                    Request To
                </th>

                <th class="copies">
                    No. of Copies
                </th>

                <th class="reason">
                    Reason
                </th>

                <th class="create-date">
                    Request Date
                </th>

                <th class="status">
                    Status
                </th>

                <th class="action">
                    Action
                </th>
            </tr>
        </thead>

        <tbody>

            @if (isset($requestDocuments) && count($requestDocuments) > 0 )

                @foreach ($requestDocuments as $key => $requestDocument)

                    <tr>

                        <td>
                            {{ $requestDocuments->total() - (($requestDocuments->currentPage() - 1) * $requestDocuments->perPage()) - $key }}
                        </td>

                        <td class="request-id" style="">
                            <a href="{{ route('document-request.show', $requestDocument->id) }}">
                             {{ $requestDocument->request_id}}
                            </a>
                        </td>

                        <td class="document-number"> {{ $requestDocument->document_number ?? 'NA' }} 
                        </td>
                        <td class="request-by"> {{ $requestDocument->request_by_name ?? 'NA' }} 
                        </td>
                        <td class="department"> {{ $requestDocument->department ?? 'NA' }} 
                        </td>
                        <td class="request-to"> {{ $requestDocument->request_to_name ?? 'NA' }} 
                        </td> 
                        <td class="copies"> {{ $requestDocument->number_of_copies ?? '0' }} 
                        </td>
                        <td class="reason request-reason-text" title="{{ $requestDocument->reason }}" > {{ $requestDocument->reason ?? 'NA' }} 
                        </td>
                        <td class="create-date"> {{ $requestDocument->created_at ? \Carbon\Carbon::parse( $requestDocument->created_at )->format('d-M-Y h:i A') : 'NA' }} 
                        </td>
                        <td class="status"> {{ $requestDocument->status ?? 'Opened' }} 
                        </td>
                        <td class="action"> 
                            <div class="action-dropdown"> 
                                <div class="action-down-btn"> Action <i class="fa-solid fa-angle-down"></i> 
                                </div> 
                                <div class="action-block"> 
                                    <a href="{{ route( 'document-request.show', $requestDocument->id ) }}" > Edit </a> 
                                </div> 
                            </div> 
                        </td>
                    </tr>

                @endforeach

            @else

                <tr>
                    <td colspan="11" class="text-center">
                        <h5>Request Document Data Not Found</h5>
                    </td>
                </tr>

            @endif

        </tbody>

    </table>

    @if (isset($requestDocuments) && $requestDocuments->hasPages())
        <div class="mt-3">
            {!! $requestDocuments->links() !!}
        </div>
    @endif

</div>