<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketComplaintGrids extends Model
{
    protected $table='marketcomplaint_grids';
    use HasFactory;
protected $fillable = [
    'mc_id',
    'identifers',
    'data'
    ];

    protected $casts = [
        'data' => 'array'
        // 'aainfo_product_name' => 'array',
           ];

      public function MarketComplaint()
           {
               return $this->hasMany(MarketComplaint::class, 'mc_id');
           }
           

           public function market_complaint()
{
    // Each grid belongs to a single MarketComplaint
    return $this->belongsTo(MarketComplaint::class, 'mc_id');
}

       
}
