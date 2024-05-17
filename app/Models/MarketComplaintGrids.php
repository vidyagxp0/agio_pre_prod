<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketComplaintGrids extends Model
{
    protected $table='marketcomplaint_grids';
    use HasFactory;
protected $fillable = [

    'identifers','data'
    // 'marketcomplaint_id',
    //     'identifier',
    //     'info_product_name',
    //     'info_batch_no',
    //     'info_mfg_date',
    //     'info_expiry_date',
    //     'info_batch_size',
    //     'info_pack_size',
    //     'info_dispatch_quantity',
    //     'info_remarks',
    //     'product_name_tr',
    //     'batch_no_tr',
    //     'manufacturing_location_tr',
    //     'remarks_tr',
    //     'name_inv_tem',
    //     'department_inv_tem',
    //     'remarks_inv_tem',
    //     'possiblity_bssd',
    //     'factscontrols_bssd',
    //     'probable_cause_bssd',
    //     'remarks_bssd',
    //     'names_tm',
    //     'department_tm',
    //     'sign_tm',
    //     'date_tm',
    //     'names_rrv',
    //     'department_rrv',
    //     'sign_rrv',
    //     'date_rrv',
    //     'product_name_pmd',
    //     'batch_no_pmd',
    //     'mfg_date_pmd',
    //     'expiry_date_pmd',
    //     'batch_size_pmd',
    //     'pack_profile_pmd',
    //     'released_quantity_pmd',
    //     'remarks_pmd',
    //     'requirements_pai',
    //     'expec_date_of_inves_completion_pai',
    //     'remarks_pai'
];

    protected $casts = [
        'data' => 'array'
        // 'aainfo_product_name' => 'array',
        // 'info_batch_no' => 'array',
        // 'info_mfg_date' => 'array',
        // 'info_expiry_date' => 'array',
        // 'info_batch_size' => 'array',
        // 'info_pack_size' => 'array',
        // 'info_dispatch_quantity' => 'array',
        // 'info_remarks' => 'array',
        
        
        // 'product_name_tr' => 'array',
        // 'batch_no_tr' => 'array',
        // 'manufacturing_location_tr' => 'array',
        // 'remarks_tr' => 'array',
        
        // 'name_inv_tem' => 'array',
        // 'department_inv_tem' => 'array',
        // 'remarks_inv_tem' => 'array',
        
        // 'possiblity_bssd' => 'array',
        // 'factscontrols_bssd' => 'array',
        // 'probable_cause_bssd' => 'array',
        // 'remarks_bssd' => 'array',
        // 'names_tm' => 'array',
        // 'department_tm' => 'array',
        // 'sign_tm' => 'array',
        // 'date_tm' => 'array',
        
        
        // 'names_rrv' => 'array',
        // 'department_rrv' => 'array',
        // 'sign_rrv' => 'array',
        // 'date_rrv' => 'array',
        // 'product_name_pmd' => 'array',
        // 'batch_no_pmd' => 'array',
        // 'mfg_date_pmd' => 'array',
        // 'expiry_date_pmd' => 'array',
        // 'batch_size_pmd' => 'array',
        // 'pack_profile_pmd' => 'array',
        // 'released_quantity_pmd' => 'array',
        // 'remarks_pmd' => 'array'
        

    ];
}
