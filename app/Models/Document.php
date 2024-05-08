<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['originator_id',
    'division_id',
    'process_id',
    'document_name',
    'short_description',
    'due_date',
    'description',
    'department_id',
    'document_type_id',
    'document_language_id',
    'keywords',
    'effectve_date' ,
    'next_review_date',
    'review_period',
    'attach_draft_doocument',
    'attach_effective_docuement',
    'reviewers',
    'approvers',
    'reviewers_group',
    'approver_group',
    'revision_summary',
    'stage',
    'status',
    'training_required',
    'documents'
];

    public function originator()
    {
        return $this->belongsTo(User::class, 'originator_id');
    }

}
