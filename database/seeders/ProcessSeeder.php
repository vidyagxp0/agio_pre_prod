<?php

namespace Database\Seeders;

use App\Models\Process;
use App\Models\QMSProcess;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProcessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $process  = new Process();
        $process->division_id = 1;
        $process->process_name = "New Document";
        $process->save();


        $process  = new Process();
        $process->division_id = 2;
        $process->process_name = "New Document";
        $process->save();


        $processNames = [
            "Extension",
            "Praveen Agio",
            "Action Item",
            "Resampling",
            "Observation",
            "Root Cause Analysis",
            "Risk Assessment",
            "Management Review",
            "External Audit",
            "Internal Audit",
            "Audit Program",
            "CAPA",
            "Change Control",
            "New Document",
            "Lab Incident",
            "Effectiveness Check",
            "OOS/OOT",
            // "OOT",
            "OOC",
            "Deviation",
            //new added
            "Market Complaint",
            "Non Conformance",
            "Incident",
            "Failure Investigation",
            "ERRATA",
            // "OOS Microbiology"
        ];

        // Loop through each process name
        foreach ($processNames as $index => $processName) {
            for ($divisionId = 1; $divisionId <= 2; $divisionId++) {
                $process = new QMSProcess();
                $process->division_id = $divisionId;
                $process->process_name = $processName;
                $process->save();
            }
        }
    }
}