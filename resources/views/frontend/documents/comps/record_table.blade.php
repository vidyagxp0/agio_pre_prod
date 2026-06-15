<style>
    .document-table {
        width: 100%;
        table-layout: fixed;
    }

    .document-table th,
    .document-table td {
        vertical-align: middle;
    }

    .document-table .pr-id {
        width: 40px;
    }

    .document-table .doc-type {
        width: 18%;
    }

    .document-table .division {
        width: 60px;
    }

    .document-table .short-desc {
        width: 32%;
    }

    .document-table .create-date,
    .document-table .modify-date {
        width: 90px;
    }

    .document-table .assign-name {
        width: 90px;
    }

    .document-table .status {
        width: 50px;
    }

    .document-table .action {
        width: 50px;
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
        {{ count($documents) }} Results {{ isset($count) ? ' out of Results  ' .  $count : 'found' }}
    </div>
</div>
<div class="table-list">
    <table class="table table-bordered document-table">
        <thead>
            <th class="pr-id" data-bs-toggle="modal" data-bs-target="#division-modal">
                ID
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
        </thead>
        <tbody id="searchTable">
            @if (count($documents) > 0)
            @foreach ($documents as $doc)
            {{-- {{dd($doc);}} --}}
            <tr>
                <td class="pr-id" style="text-decoration:underline"><a href="{{ route('documents.edit', $doc->id) }}">
                        {{ Helpers::recordFormat($doc->id)}}
                    </a>
                </td>
                <td class="division">
                    {{ Helpers::getDocumentTypes()[$doc->document_type_id] }}
                </td>

                <td class="division">
                    {{ Helpers::getDivisionName($doc->division_id) }}
                </td>

                <td style="display: ;
                width: 305px;
                white-space: ;
                overflow: hidden !important;
                text-overflow: ellipsis" class="short-desc">
                    {{ $doc->short_description }}
                </td>
                <td class="create-date">
                    {{ \Carbon\Carbon::parse($doc->created_at)->format('d-M-Y h:i A') }}
                </td>
                <td class="assign-name">
                    {{ $doc->originator_name }}
                </td>
                <td class="modify-date">
                    {{\Carbon\Carbon::parse($doc->updated_at)->format('d-M-Y h:i A') }}
                </td>
                <td class="status">
                    {{ Helpers::getDocStatusByStage($doc->stage, $doc->training_required) }}
                </td>
                <td class="action">
                    <div class="action-dropdown">
                        <div class="action-down-btn">Action <i class="fa-solid fa-angle-down"></i></div>
                        <div class="action-block">
                            <a href="{{ url('doc-details', $doc->id) }}">View
                            </a>

                            @if ($doc->status != 'Obsolete')
                            <a href="{{ route('documents.edit', $doc->id) }}">Edit</a>

                            @endif

                            <!--<form-->
                            <!--    action="{{ route('documents.destroy', $doc->id) }}"-->
                            <!--    method="post">-->
                            <!--    @csrf-->
                            <!--    @method('DELETE')-->
                            <!--    <button type="submit">Delete</button>-->
                            <!--</form>-->

                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
            @else
            <center>
                <h5>Data not Found</h5>
            </center>
            @endif

        </tbody>
    </table>
    @if (isset($count))
    {!! $documents->links() !!}
    @endif
</div>