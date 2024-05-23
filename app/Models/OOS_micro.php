<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OOS_micro extends Model
{
    use HasFactory;

    protected $table = 'o_o_s__micros';

    //protected $fillable = ['reference_document_gi'];

    protected $casts = [
    'initial_attachment_gi'=>'array',
    'file_attachments_pli'=>'array',
    'supporting_attachment_plic'=>'array',
    'supporting_attachments_plir'=>'array',
    'supporting_attachments_plir'=>'array',
    'attachment_piii'=>'array',
    'attachments_piiqcr'=>'array',
    'additional_testing_attachment_atp'=>'array',
    'attachments_if_any_oosc'=>'array',
    'conclusion_attachment_ocr'=>'array',
    'cq_attachment_OOS_CQ'=>'array',
    'disposition_attachment_BI'=>'array',
    'reopen_attachment'=>'array',
    'attachment_details_cibet'=>'array',
    'attachment_details_cis'=>'array',
    'attachment_details_cimlbwt'=>'array',
    'attachment_details_cima'=>'array',
    'attachment_details_ciem'=>'array',
    'attachment_details_cimst'=>'array'
    ];

}
