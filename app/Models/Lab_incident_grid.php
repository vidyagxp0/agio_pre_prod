<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab_incident_grid extends Model
{
    use HasFactory;
    protected $table ='lab_incident_grids';
    protected $fillable=[
        'lab_incidents_id','identifier',
        'sr_no_IIR_GI','name_of_product_IIR_GI','b_no_IIR_GI','remarks_IIR_GI','sr_no_SSFI','name_of_product_SSFI','b_no_SSFI','remarks_SSFI'
    ];
    protected $casts=[
        'lab_incidents_id'=>'array',
        'identifier'=>'array',
        'sr_no_IIR_GI'=>'array',
        'name_of_product_IIR_GI'=>'array',
        'b_no_IIR_GI'=>'array',
        'remarks_IIR_GI'=>'array',
        'sr_no_SSFI'=>'array',
        'name_of_product_SSFI'=>'array',
        'b_no_SSFI'=>'array',
        'remarks_SSFI'=>'array',
    ];
}
