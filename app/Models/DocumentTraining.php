<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentTraining extends Model
{
    use HasFactory;

    public function root_document()
    {
        return $this->belongsTo(Document::class, 'document_id');
    }
}
