<?php

namespace Database\Seeders;

use App\Models\RoleGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sites = [
            'Corporate',
            'Plant',
        ];

      $processes_roles = [
            'Effectiveness Check' => ['Initiator', 'Supervisor', 'QA', 'View Only', 'FP', 'Closed Record'],
            'Root Cause Analysis' => ['Initiator', 'QA', 'View Only', 'FP', 'Closed Record'],
            'Change Control' => ['Initiator', 'HOD/Designee', 'QA', 'CFT', 'QA', 'Head QA/Designee', 'View Only', 'FP', 'Closed Record'],
            'Lab Incident' => ['Initiator', 'HOD/Supervisor/Designee', 'Head QA', 'Initiator', 'Head QA', 'View Only', 'FP', 'Closed Record'],
            'CAPA' => ['Initiator', 'HOD/Designee', 'QA', 'QA Head/Designee', 'View Only', 'FP', 'Closed Record'],
            'Audit Program' => ['Initiator', 'Audit Manager', 'View Only', 'FP', 'Closed Record'],
            'Internal Audit' => ['Initiator', 'Audit Manager', 'Lead Auditor', 'Lead Auditee', 'View Only', 'FP', 'Closed Record'],
            'External Audit' => ['Initiator', 'Audit Manager', 'Lead Auditor', 'Lead Auditee', 'View Only', 'FP', 'Closed Record'],
            'Management Review' => ['Initiator', 'Responsible Person', 'View Only', 'FP', 'Closed Record'],
            'Risk Assessment' => ['Initiator', 'HOD/Designee', 'Work Group (Risk Management Head)', 'HOD/Designee', 'QA', 'View Only', 'FP', 'Closed Record'],
            'Action Item' => ['Initiator', 'Action Owner', 'QA', 'View Only', 'FP', 'Closed Record'],
            'Resampling' => ['Initiator', 'Action Owner', 'QA', 'View Only', 'FP', 'Closed Record'],
            'Extension' => ['Initiator', 'Head QA/Designee', 'View Only', 'FP', 'Closed Record'],
            'Observation' => ['Initiator', 'Lead Auditor', 'Lead Auditee', 'QA', 'View Only', 'FP', 'Closed Record'],
            // 'OOS Chemical' => ['Initiator', 'Lab Supervisor', 'QC Head/Designee', 'Lab Supervisor', 'QA', 'Lab Supervisor', 'QA', 'Head QA/Designee', 'View Only', 'FP', 'Closed Record'],
            // 'OOT' => ['Initiator', 'HOD/Supervisor/Designee', 'Head QA', 'Initiator', 'Head QA/Designee', 'View Only', 'FP', 'Closed Record'],
            'OOC' => ['Initiator', 'HOD/Designee', 'QC Head', 'QA', 'QC Supervisor', 'Manufacturing QA', 'QA', 'QA Head/Designee', 'View Only', 'FP', 'Closed Record'],
            'Deviation' => ['Initiator', 'HOD/Designee', 'QA', 'CFT', 'QA', 'QA Head/Designee', 'Initiator', 'QA', 'View Only', 'FP', 'Closed Record'],
            'New Document' => ['Initiator', 'Author', 'HOD/Designee', 'Approver', 'Reviewer', 'View Only', 'FP', 'Trainer', 'Closed Record'],
            'Market Complaint' => ['Initiator', 'Supervisor', 'QA', 'Responsible Person', 'Supervisor', 'QA Head/Designee', 'Initiator', 'View Only', 'FP', 'Closed Record'],
            'Non Conformance' => ['Initiator', 'HOD/Designee', 'QA', 'CFT', 'QA', 'QA Head/Designee', 'Initiator', 'QA', 'View Only', 'FP', 'Closed Record'],
            'Incident' => ['Initiator', 'HOD/Designee', 'QA', 'CFT', 'QA', 'QA Head/Designee', 'Initiator', 'QA', 'View Only', 'FP', 'Closed Record'],
            'Failure Investigation' => ['Initiator', 'HOD/Designee', 'QA', 'CFT', 'QA', 'QA Head/Designee', 'Initiator', 'QA', 'View Only', 'FP', 'Closed Record'],
            'ERRATA' => ['Initiator', 'QA Reviewer', 'Initiator', 'Supervisor', 'HOD/Designee', 'QA Head/Designee', 'View Only', 'FP', 'Closed Record'],
            'OOS/OOT' => ['Initiator','HOD/Designee', 'Lab Supervisor', 'QC Head/Designee', 'Lab Supervisor', 'QA', 'Lab Supervisor','Production','Production Head', 'Head QA/Designee', 'View Only', 'FP', 'Closed Record'],
        ];

        $start_from_id = 1; // Initialize your starting ID

        foreach ($sites as $site) {
            foreach ($processes_roles as $process => $roles) {
                foreach ($roles as $role) {
                    $group = new RoleGroup();
                    $group->id = $start_from_id;
                    $group->name = "$site-$process-$role";
                    $group->description = "$site-$process-$role";
                    $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
                    $group->save();
                    $start_from_id++;
                }
            }
        }

        $cft_roles = [
            "Production",
            "Warehouse",
            "Quality Control",
            "Quality Assurance",
            "Engineering",
            "Analytical Development Laboratory",
            "Process Development Laboratory / Kilo Lab",
            "Technology Transfer / Design",
            "Environment, Health & Safety",
            "Human Resource & Administration",
            "Information Technology",
            "Project Management"
        ];

        $processes = [
            'Change Control',
            'Deviation',
            'Non Conformance',
            'Incident',
        ];

        $incrementCount = $start_from_id;

        foreach ($processes as $process) {
            foreach ($sites as $site) {
                foreach ($cft_roles as $role) {
                    $group = new RoleGroup();
                    $group->id = $incrementCount++;
                    $group->name = "$site-$process-$role";
                    $group->description = "$site-$process-$role";
                    $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
                    $group->save();
                }
            }
        }

        //failure
        $cft_roles1 = [
            "RA Review",
            "Production Tablet",
            "Production Liquid",
            "Production Injection",
            "Stores",
            "Research & Development",
            "Microbiology",
            "Regulatory Affair",
            "Corporate Quality Assurance",
            "Safety",
            "Contract Giver",
            "Quality Control",
            "Quality Assurance",
            "Engineering",
            "Human Resource & Administration",
            "Information Technology",
        ];

        $processes2 = [
            'Failure Investigation',
        ];

        $incrementCount1 = $incrementCount;

        foreach ($processes2 as $process) 
        {
            foreach ($sites as $site) {
                foreach ($cft_roles1 as $role) {
                    $group = new RoleGroup();
                    $group->id = $incrementCount++;
                    $group->name = "$site-$process-$role";
                    $group->description = "$site-$process-$role";
                    $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
                    $group->save();
                }
            }
        }



        $processes_roles3 = [
            'Effectiveness Check' => ['HOD/Designee', 'QA', 'CQA', 'QA Head/Designee'],
            'Root Cause Analysis' => ['HOD/Designee', 'QA', 'CQA', 'CQA Head', 'Head QA'],
            'Change Control' => ['QA', 'CQA', 'CFT', 'Head QA','CQA'],
            'Lab Incident' => ['QC Head', 'HOD/Designee', 'QA Reviewer'],
            'CAPA' => ['QA', 'CQA Reviewer', 'QA Approver', 'CQA Approver', 'QA', 'CQA', 'CQA Head', 'Head QA'],            
            'Audit Program' => ['QA', 'CQA', 'HOD/Designee', 'Head QA', 'CQA Head',],
            'Internal Audit' => ['Audit Manager', 'Lead Auditor', 'Lead Auditee', 'CQA', 'QA'],            
            'External Audit' => ['QA', 'CQA', 'CFT', 'CQA Head', 'QA Head Designee'],
            'Management Review' => ['QA', 'Head QA', 'CFT', 'HOD/Designee'],            
            'Risk Assessment' => ['HOD/Designee', 'CFT', 'CQA', 'QA', 'Head QA', 'CQA Head'],          
            'Action Item' => ['Initiator', 'QA', 'CQA',],
            'Resampling' => ['Initiator', 'Head QA', 'CQA Head', 'QA', 'CQA',],
            'Extension' => ['HOD/Designee', 'QA Approver', 'CQA Approver'],
            'Observation' => ['Lead Auditor', 'Lead Auditee', 'QA', 'Audit Manager', 'CQA'],            
            'OOS Chemical' => ['QA Head Designee', 'Production', 'Production Head', 'Head QA', 'FP', 'CQA Head'],
            'OOT' => ['QA Head Designee', 'Production', 'Production Head', 'Head QA', 'FP', 'CQA Head'],
            'OOC' => ['QA Head Designee', 'QA', 'Head QA'],
            'Deviation' => ['CQA'],
            'Market Complaint' => ['CQA','Head QA','CQA Head','CFT'],            
            'Incident' => ['QA Reviewer', 'Head QA'],            
            'ERRATA' => ['HOD/Designee','CQA','QA'],
        ];

        $start_from_idNew = 541;

        foreach ($sites as $site) {
            foreach ($processes_roles3 as $process => $roles) {
                foreach ($roles as $role) {
                    $group = new RoleGroup();
                    $group->id = $start_from_idNew;
                    $group->name = "$site-$process-$role";
                    $group->description = "$site-$process-$role";
                    $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
                    $group->save();
                    $start_from_idNew++;
                }
            }
        }
    }
}
