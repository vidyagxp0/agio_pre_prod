<?php

namespace App\Exports;

use App\Models\Document;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DocumentsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Document::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Originator ID',
            'Division ID',
            'Process ID',
            'Document Name',
            'Short Description',
            'Due Date',
            'Description',
            'Notify To',
            'Reference Record',
            'Department ID',
            'Document Type ID',
            'Document Language ID',
            'Keywords',
            'Effective Date',
            'Next Review Date',
            'Review Period',
            'Attach Draft Document',
            'Attach Effective Document',
            'Reviewers',
            'Approvers',
            'Reviewers Group',
            'Approver Group',
            'Revision Summary',
            'Stage',
            'Status',
            'Training Required',
            'Created At',
            'Updated At',
            'Deleted At',
        ];
    }
}
