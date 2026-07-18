<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentGridData extends Model
{
    use HasFactory;

    protected $table = 'document_distribution_grid';

    protected $guarded = [];

    protected $casts = [
        'issuance_date' => 'date',
        'retrieval_date' => 'date',
        'destruction_date' => 'date',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function printHistory()
    {
        return $this->belongsTo(
            PrintHistory::class,
            'print_history_id'
        );
    }
}