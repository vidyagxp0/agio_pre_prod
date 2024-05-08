<?php

namespace App\Imports;

use App\Models\Annexure;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Document;
use App\Models\DocumentContent;
use App\Models\RecordNumber;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;

class DocumentsImport implements ToArray, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function array(array $array)
    {
        foreach ($array as $data) {
            $counter = DB::table('record_numbers')->value('counter');

            $table1Data = [
                'originator_id' => $data['originator_id'],
                'division_id'    => $data['division_id'],
                'record'    => $counter,
                'process_id' => $data['process_id'],
                'document_name' => $data['document_name'],
                'short_description' => $data['short_description'],
                'due_date' => $data['due_date'],
                'description' => $data['description'],
                'department_id' => $data['department_id'],
                'document_type_id' => $data['document_type_id'],
                'document_language_id' => $data['document_language_id'],
                'keywords' => $data['keywords'],
                'effectve_date' => $data['effectve_date'],
                'next_review_date' => $data['next_review_date'],
                'review_period' => $data['review_period'],
                'attach_draft_doocument' => $data['attach_draft_doocument'],
                'attach_effective_docuement' => $data['attach_effective_docuement'],
                'reviewers' => $data['reviewers'],
                'approvers' => $data['approvers'],
                'reviewers_group' => $data['reviewers_group'],
                'approver_group' => $data['approver_group'],
                'revision_summary' => $data['revision_summary'],
                'stage' => $data['stage'],
                'status' => $data['status'],
                'training_required' => $data['training_required'],
                'document' => $data['document']
            ];
            $table1 = Document::create($table1Data);
            $counter = DB::table('record_numbers')->value('counter');
            $newCounter = $counter + 1;
            DB::table('record_numbers')->update(['counter' => $newCounter]);
            $table2Data = [
                'document_id' => $table1->id,
                'purpose' => $data['purpose'], 'scope' => $data['scope'], 'procedure' => $data['procedure'],
            ];

            DocumentContent::create($table2Data);

            $table3Data = [
                'document_id' => $table1->id,
                'sno' => null,
                'annexure_no' => null,
                'annexure_title' => null
            ];
            Annexure::create($table3Data);
        }
    }
}
