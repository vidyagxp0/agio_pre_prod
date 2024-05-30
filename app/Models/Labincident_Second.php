<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Labincident_Second extends Model
{
    use HasFactory;
    protected $table ='labincident_tab_sec';
    protected $fillable = [
            'involved_ssfi',
            'stage_stage_ssfi',
            'Incident_stability_cond_ssfi',
            'Incident_interval_ssfi',
            'test_ssfi',
            'Incident_date_analysis_ssfi',
            'Incident_specification_ssfi',
            'Incident_stp_ssfi',
            'Incident_date_incidence_ssfi',
            'Description_incidence_ssfi',
            'Detail_investigation_ssfi',
            'proposed_corrective_ssfi',
            'root_cause_ssfi',
            'incident_summary_ssfi',
            'system_suitable_attachments',
            'closure_incident_c',
            'affected_document_closure',
            'qc_hear_remark_c',
            'qa_hear_remark_c',
            'closure_attachment_c',
        ];
    }
