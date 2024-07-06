<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddColumnErrataNew extends Model
{
    use HasFactory;
    protected $table = 'add_column_errata_news';
    protected $fillable=[
        'erratanew_id',
        'department_head_to',
        'document_title',
        'qa_reviewer',
        'reference'
    ];


    public function errata()
    {
        return $this->belongsTo(Errata::class, 'erratanew_id','id');
    }

}
