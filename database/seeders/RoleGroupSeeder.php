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
        //

//         $group  = new RoleGroup();
//         $group->id = 1;
//         $group->name = "KSA-Change Control- Initiator";
//         $group->description = "KSA-Change Control- Initiator";
//         $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
//         $group->save();

//         $group  = new RoleGroup();
//         $group->id = 2;
//         $group->name = "KSA-Change Control- HOD/Designee";
//         $group->description = "KSA-Change Control- HOD/Designee";
//         $group->permission = json_encode(['read' => true, 'create' => false, 'edit' => true, 'delete' => false]);
//         $group->save();

//         $group  = new RoleGroup();
//         $group->id = 3;
//         $group->name = "KSA-Change Control- QA";
//         $group->description = "KSA-Change Control- QA";
//         $group->permission = json_encode(['read' => true, 'create' => false, 'edit' => true, 'delete' => false]);
//         $group->save();

//         $group  = new RoleGroup();
//         $group->id = 4;
//         $group->name = "KSA-Change Control- CFT/SME";
//         $group->description = "KSA-Change Control- CFT/SME";
//         $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
//         $group->save();

//         $group  = new RoleGroup();
//         $group->id = 5;
//         $group->name = "KSA-Change Control- FP";
//         $group->description = "KSA-Change Control- FP";
//         $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
//         $group->save();

//         $group  = new RoleGroup();
//         $group->id = 6;
//         $group->name = "KSA-Change Control- View Only";
//         $group->description = "KSA-Change Control- View Only";
//         $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
//         $group->save();

//         $group  = new RoleGroup();
//         $group->id = 7;
//         $group->name = "Estonia-Change Control- Initiator";
//         $group->description = "Estonia-Change Control- Initiator";
//         $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
//         $group->save();

//         $group  = new RoleGroup();
//         $group->id = 8;
//         $group->name = "Estonia-Change Control- HOD/Designee";
//         $group->description = "Estonia-Change Control- HOD/Designee";
//         $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
//         $group->save();

//         $group  = new RoleGroup();
//         $group->id = 9;
//         $group->name = "Estonia-Change Control- QA";
//         $group->description = "Estonia-Change Control- QA";
//         $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
//         $group->save();

//         $group  = new RoleGroup();
//         $group->id = 10;
//         $group->name = "Estonia-Change Control- CFT/SME";
//         $group->description = "Estonia-Change Control- CFT/SME";
//         $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
//         $group->save();


//         $group  = new RoleGroup();
//         $group->id = 11;
//         $group->name = "Estonia-Change Control- FP";
//         $group->description = "Estonia-Change Control- FP";
//         $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
//         $group->save();

//         $group  = new RoleGroup();
//         $group->id = 12;
//         $group->name = "Estonia-Change Control- View Only";
//         $group->description = "Estonia-Change Control- View Only";
//         $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
//         $group->save();

//         $group  = new RoleGroup();
//         $group->id = 13;
//         $group->name = "Egypt-Change Control- Initiator";
//         $group->description = "Egypt-Change Control- Initiator";
//         $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
//         $group->save();

//         $group  = new RoleGroup();
//         $group->id = 14;
//         $group->name = "Egypt-Change Control- HOD/Designee";
//         $group->description = "Egypt-Change Control- HOD/Designee";
//         $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
//         $group->save();

//         $group  = new RoleGroup();
//         $group->id = 15;
//         $group->name = "Egypt-Change Control- QA";
//         $group->description = "Egypt-Change Control- QA";
//         $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
//         $group->save();

//         $group  = new RoleGroup();
//         $group->id = 16;
//         $group->name = "Egypt-Change Control- CFT/SME";
//         $group->description = "Egypt-Change Control- CFT/SME";
//         $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
//         $group->save();

//         $group  = new RoleGroup();
//         $group->id = 17;
//         $group->name = "Egypt-Change Control- FP";
//         $group->description = "Egypt-Change Control- FP";
//         $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
//         $group->save();

//         $group  = new RoleGroup();
//         $group->id = 18;
//         $group->name = "Egypt-Change Control- View Only";
//         $group->description = "Egypt-Change Control- View Only";
//         $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
//         $group->save();

//         $group  = new RoleGroup();
//         $group->id = 19;
//         $group->name = "Jordan-Change Control- Initiator";
//         $group->description = "Jordan-Change Control- Initiator";
//         $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
//         $group->save();

//         $group  = new RoleGroup();
//         $group->id = 20;
//         $group->name = "Jordan-Change Control- HOD/Designee";
//         $group->description = "Jordan-Change Control- HOD/Designee";
//         $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
//         $group->save();

//         $group  = new RoleGroup();
//         $group->id = 21;
//         $group->name = "Jordan-Change Control- QA";
//         $group->description = "Jordan-Change Control- QA";
//         $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
//         $group->save();

//         $group  = new RoleGroup();
//         $group->id = 22;
//         $group->name = "Jordan-Change Control- CFT/SME";
//         $group->description = "Jordan-Change Control- CFT/SME";
//         $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
//         $group->save();

//         $group  = new RoleGroup();
//         $group->id = 23;
//         $group->name = "Jordan-Change Control- FP";
//         $group->description = "Jordan-Change Control- FP";
//         $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
//         $group->save();

//         $group  = new RoleGroup();
//         $group->id = 24;
//         $group->name = "Jordan-Change Control- View Only";
//         $group->description = "Jordan-Change Control- View Only";
//         $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
//         $group->save();


//     $group = new RoleGroup();
// $group->id = 25;
// $group->name = "KSA-Extension- Initiator";
// $group->description = "KSA-Extension- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 26;
// $group->name = "KSA-Extension- Approver";
// $group->description = "KSA-Extension- Approver";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 27;
// $group->name = "KSA-Extension- FP";
// $group->description = "KSA-Extension- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 28;
// $group->name = "KSA-Extension- View Only";
// $group->description = "KSA-Extension- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 29;
// $group->name = "Estonia-Extension- Initiator";
// $group->description = "Estonia-Extension- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 30;
// $group->name = "Estonia-Extension- Approver";
// $group->description = "Estonia-Extension- Approver";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 31;
// $group->name = "Estonia-Extension- FP";
// $group->description = "Estonia-Extension- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 32;
// $group->name = "Estonia-Extension- View Only";
// $group->description = "Estonia-Extension- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 33;
// $group->name = "Estonia-Extension- Initiator";
// $group->description = "Estonia-Extension- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 34;
// $group->name = "Estonia-Extension- Approver";
// $group->description = "Estonia-Extension- Approver";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 35;
// $group->name = "Estonia-Extension- FP";
// $group->description = "Estonia-Extension- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 36;
// $group->name = "Estonia-Extension- View Only";
// $group->description = "Estonia-Extension- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 37;
// $group->name = "Jordan-Extension- Initiator";
// $group->description = "Jordan-Extension- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 38;
// $group->name = "Jordan-Extension- Approver";
// $group->description = "Jordan-Extension- Approver";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 39;
// $group->name = "Jordan-Extension- FP";
// $group->description = "Jordan-Extension- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 40;
// $group->name = "Jordan-Extension- View Only";
// $group->description = "Jordan-Extension- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 41;
// $group->name = "KSA-Action Item- Initiator";
// $group->description = "KSA-Action Item- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 42;
// $group->name = "KSA-Action Item- Action Owner";
// $group->description = "KSA-Action Item- Action Owner";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 43;
// $group->name = "KSA-Action Item- FP";
// $group->description = "KSA-Action Item- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 44;
// $group->name = "KSA-Action Item- View Only";
// $group->description = "KSA-Action Item- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 45;
// $group->name = "Estonia-Action Item- Initiator";
// $group->description = "Estonia-Action Item- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 46;
// $group->name = "Estonia-Action Item- Action Owner";
// $group->description = "Estonia-Action Item- Action Owner";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 47;
// $group->name = "Estonia-Action Item- FP";
// $group->description = "Estonia-Action Item- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 48;
// $group->name = "Estonia-Action Item- View Only";
// $group->description = "Estonia-Action Item- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 49;
// $group->name = "Egypt-Action Item- Initiator";
// $group->description = "Egypt-Action Item- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 50;
// $group->name = "Egypt-Action Item- Action Owner";
// $group->description = "Egypt-Action Item- Action Owner";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 51;
// $group->name = "Egypt-Action Item- FP";
// $group->description = "Egypt-Action Item- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 52;
// $group->name = "Egypt-Action Item- View Only";
// $group->description = "Egypt-Action Item- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 53;
// $group->name = "Jordan-Action Item- Initiator";
// $group->description = "Jordan-Action Item- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 54;
// $group->name = "Jordan-Action Item- Action Owner";
// $group->description = "Jordan-Action Item- Action Owner";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 55;
// $group->name = "Jordan-Action Item- FP";
// $group->description = "Jordan-Action Item- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 56;
// $group->name = "Jordan-Action Item- View Only";
// $group->description = "Jordan-Action Item- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();


// // Create seeders for KSA groups
// $group = new RoleGroup();
// $group->id = 57;
// $group->name = "KSA-Observation- Lead Auditor";
// $group->description = "KSA-Observation- Lead Auditor";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 58;
// $group->name = "KSA-Observation- Lead Auditee";
// $group->description = "KSA-Observation- Lead Auditee";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 59;
// $group->name = "KSA-Observation- QA";
// $group->description = "KSA-Observation- QA";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 60;
// $group->name = "KSA-Observation- FP";
// $group->description = "KSA-Observation- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 61;
// $group->name = "KSA-Observation- View Only";
// $group->description = "KSA-Observation- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// // Repeat the process for Estonia
// $group = new RoleGroup();
// $group->id = 62;
// $group->name = "Estonia-Observation- Lead Auditor";
// $group->description = "Estonia-Observation- Lead Auditor";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 63;
// $group->name = "Estonia-Observation- Lead Auditee";
// $group->description = "Estonia-Observation- Lead Auditee";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 64;
// $group->name = "Estonia-Observation- QA";
// $group->description = "Estonia-Observation- QA";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 65;
// $group->name = "Estonia-Observation- FP";
// $group->description = "Estonia-Observation- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 66;
// $group->name = "Estonia-Observation- View Only";
// $group->description = "Estonia-Observation- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// // Repeat the process for Egypt
// $group = new RoleGroup();
// $group->id = 67;
// $group->name = "Egypt-Observation- Lead Auditor";
// $group->description = "Egypt-Observation- Lead Auditor";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 68;
// $group->name = "Egypt-Observation- Lead Auditee";
// $group->description = "Egypt-Observation- Lead Auditee";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 69;
// $group->name = "Egypt-Observation- QA";
// $group->description = "Egypt-Observation- QA";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 70;
// $group->name = "Egypt-Observation- FP";
// $group->description = "Egypt-Observation- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 71;
// $group->name = "Egypt-Observation- View Only";
// $group->description = "Egypt-Observation- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// // Repeat the process for Jordan
// $group = new RoleGroup();
// $group->id = 72;
// $group->name = "Jordan-Observation- Lead Auditor";
// $group->description = "Jordan-Observation- Lead Auditor";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 73;
// $group->name = "Jordan-Observation- Lead Auditee";
// $group->description = "Jordan-Observation- Lead Auditee";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 74;
// $group->name = "Jordan-Observation- QA";
// $group->description = "Jordan-Observation- QA";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 75;
// $group->name = "Jordan-Observation- FP";
// $group->description = "Jordan-Observation- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 76;
// $group->name = "Jordan-Observation- View Only";
// $group->description = "Jordan-Observation- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();


// // Estonia
// $group = new RoleGroup();
// $group->id = 77;
// $group->name = "KSA-Root Cause Analysis- Initiator";
// $group->description = "KSA-Root Cause Analysis- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 78;
// $group->name = "KSA-Root Cause Analysis- QA";
// $group->description = "KSA-Root Cause Analysis- QA";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 79;
// $group->name = "KSA-Root Cause Analysis- FP";
// $group->description = "KSA-Root Cause Analysis- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 80;
// $group->name = "KSA-Root Cause Analysis- View Only";
// $group->description = "KSA-Root Cause Analysis- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// // Estonia
// $group = new RoleGroup();
// $group->id = 81;
// $group->name = "Estonia-Root Cause Analysis- Initiator";
// $group->description = "Estonia-Root Cause Analysis- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 82;
// $group->name = "Estonia-Root Cause Analysis- QA";
// $group->description = "Estonia-Root Cause Analysis- QA";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 83;
// $group->name = "Estonia-Root Cause Analysis- FP";
// $group->description = "Estonia-Root Cause Analysis- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 84;
// $group->name = "Estonia-Root Cause Analysis- View Only";
// $group->description = "Estonia-Root Cause Analysis- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// // Egypt
// $group = new RoleGroup();
// $group->id = 85;
// $group->name = "Egypt-Root Cause Analysis- Initiator";
// $group->description = "Egypt-Root Cause Analysis- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 86;
// $group->name = "Egypt-Root Cause Analysis- QA";
// $group->description = "Egypt-Root Cause Analysis- QA";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 87;
// $group->name = "Egypt-Root Cause Analysis- FP";
// $group->description = "Egypt-Root Cause Analysis- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 88;
// $group->name = "Egypt-Root Cause Analysis- View Only";
// $group->description = "Egypt-Root Cause Analysis- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// // Jordan
// $group = new RoleGroup();
// $group->id = 89;
// $group->name = "Jordan-Root Cause Analysis- Initiator";
// $group->description = "Jordan-Root Cause Analysis- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 90;
// $group->name = "Jordan-Root Cause Analysis- QA";
// $group->description = "Jordan-Root Cause Analysis- QA";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 91;
// $group->name = "Jordan-Root Cause Analysis- FP";
// $group->description = "Jordan-Root Cause Analysis- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 92;
// $group->name = "Jordan-Root Cause Analysis- View Only";
// $group->description = "Jordan-Root Cause Analysis- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// // KSA Risk Assessment
// $group = new RoleGroup();
// $group->id = 93;
// $group->name = "KSA-Risk Assessment- Initiator";
// $group->description = "KSA-Risk Assessment- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 94;
// $group->name = "KSA-Risk Assessment- HOD/Designee";
// $group->description = "KSA-Risk Assessment- HOD/Designee";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 95;
// $group->name = "KSA-Risk Assessment- Work Group";
// $group->description = "KSA-Risk Assessment- Work Group";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 96;
// $group->name = "KSA-Risk Assessment- QA";
// $group->description = "KSA-Risk Assessment- QA";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 97;
// $group->name = "KSA-Risk Assessment- FP";
// $group->description = "KSA-Risk Assessment- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 98;
// $group->name = "KSA-Risk Assessment- View Only";
// $group->description = "KSA-Risk Assessment- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// // Estonia
// $group = new RoleGroup();
// $group->id = 99;
// $group->name = "Estonia-Risk Assessment- Initiator";
// $group->description = "Estonia-Risk Assessment- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 100;
// $group->name = "Estonia-Risk Assessment- HOD/Designee";
// $group->description = "Estonia-Risk Assessment- HOD/Designee";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 101;
// $group->name = "Estonia-Risk Assessment- Work Group";
// $group->description = "Estonia-Risk Assessment- Work Group";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 102;
// $group->name = "Estonia-Risk Assessment- QA";
// $group->description = "Estonia-Risk Assessment- QA";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 103;
// $group->name = "Estonia-Risk Assessment- FP";
// $group->description = "Estonia-Risk Assessment- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 104;
// $group->name = "Estonia-Risk Assessment- View Only";
// $group->description = "Estonia-Risk Assessment- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// // Egypt
// $group = new RoleGroup();
// $group->id = 105;
// $group->name = "Egypt-Risk Assessment- Initiator";
// $group->description = "Egypt-Risk Assessment- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 106;
// $group->name = "Egypt-Risk Assessment- HOD/Designee";
// $group->description = "Egypt-Risk Assessment- HOD/Designee";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 107;
// $group->name = "Egypt-Risk Assessment- Work Group";
// $group->description = "Egypt-Risk Assessment- Work Group";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 108;
// $group->name = "Egypt-Risk Assessment- QA";
// $group->description = "Egypt-Risk Assessment- QA";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 109;
// $group->name = "Egypt-Risk Assessment- FP";
// $group->description = "Egypt-Risk Assessment- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 110;
// $group->name = "Egypt-Risk Assessment- View Only";
// $group->description = "Egypt-Risk Assessment- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// // Jordan
// $group = new RoleGroup();
// $group->id = 111;
// $group->name = "Jordan-Risk Assessment- Initiator";
// $group->description = "Jordan-Risk Assessment- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 112;
// $group->name = "Jordan-Risk Assessment- HOD/Designee";
// $group->description = "Jordan-Risk Assessment- HOD/Designee";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 113;
// $group->name = "Jordan-Risk Assessment- Work Group";
// $group->description = "Jordan-Risk Assessment- Work Group";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 114;
// $group->name = "Jordan-Risk Assessment- QA";
// $group->description = "Jordan-Risk Assessment- QA";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 115;
// $group->name = "Jordan-Risk Assessment- FP";
// $group->description = "Jordan-Risk Assessment- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 116;
// $group->name = "Jordan-Risk Assessment- View Only";
// $group->description = "Jordan-Risk Assessment- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// // KSA Management Review
// $group = new RoleGroup();
// $group->id = 117;
// $group->name = "KSA-Management Review- Initiator";
// $group->description = "KSA-Management Review- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 118;
// $group->name = "KSA-Management Review- Responsible Person";
// $group->description = "KSA-Management Review- Responsible Person";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 119;
// $group->name = "KSA-Management Review- FP";
// $group->description = "KSA-Management Review- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 120;
// $group->name = "KSA-Management Review- View Only";
// $group->description = "KSA-Management Review- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// // Estonia Management Review
// $group = new RoleGroup();
// $group->id = 121;
// $group->name = "Estonia-Management Review- Initiator";
// $group->description = "Estonia-Management Review- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 122;
// $group->name = "Estonia-Management Review- Responsible Person";
// $group->description = "Estonia-Management Review- Responsible Person";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 123;
// $group->name = "Estonia-Management Review- FP";
// $group->description = "Estonia-Management Review- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 124;
// $group->name = "Estonia-Management Review- View Only";
// $group->description = "Estonia-Management Review- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// // Egypt Management Review
// $group = new RoleGroup();
// $group->id = 125;
// $group->name = "Egypt-Management Review- Initiator";
// $group->description = "Egypt-Management Review- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 126;
// $group->name = "Egypt-Management Review- Responsible Person";
// $group->description = "Egypt-Management Review- Responsible Person";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 127;
// $group->name = "Egypt-Management Review- FP";
// $group->description = "Egypt-Management Review- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 128;
// $group->name = "Egypt-Management Review- View Only";
// $group->description = "Egypt-Management Review- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// // Jordan Management Review
// $group = new RoleGroup();
// $group->id = 129;
// $group->name = "Jordan-Management Review- Initiator";
// $group->description = "Jordan-Management Review- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 130;
// $group->name = "Jordan-Management Review- Responsible Person";
// $group->description = "Jordan-Management Review- Responsible Person";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 131;
// $group->name = "Jordan-Management Review- FP";
// $group->description = "Jordan-Management Review- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 132;
// $group->name = "Jordan-Management Review- View Only";
// $group->description = "Jordan-Management Review- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// // KSA
// $group = new RoleGroup();
// $group->id = 133;
// $group->name = "KSA-External Audit- Audit Manager";
// $group->description = "KSA-External Audit- Audit Manager";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 134;
// $group->name = "KSA-External Audit- Lead Auditor";
// $group->description = "KSA-External Audit- Lead Auditor";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 135;
// $group->name = "KSA-External Audit- Lead Auditee";
// $group->description = "KSA-External Audit- Lead Auditee";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 136;
// $group->name = "KSA-External Audit- FP";
// $group->description = "KSA-External Audit- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 137;
// $group->name = "KSA-External Audit- View Only";
// $group->description = "KSA-External Audit- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();


// // Estonia
// $group = new RoleGroup();
// $group->id = 138;
// $group->name = "Estonia-External Audit- Audit Manager";
// $group->description = "Estonia-External Audit- Audit Manager";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 139;
// $group->name = "Estonia-External Audit- Lead Auditor";
// $group->description = "Estonia-External Audit- Lead Auditor";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 140;
// $group->name = "Estonia-External Audit- Lead Auditee";
// $group->description = "Estonia-External Audit- Lead Auditee";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 141;
// $group->name = "Estonia-External Audit- FP";
// $group->description = "Estonia-External Audit- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 142;
// $group->name = "Estonia-External Audit- View Only";
// $group->description = "Estonia-External Audit- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// // Egypt
// $group = new RoleGroup();
// $group->id = 143;
// $group->name = "Egypt-External Audit- Audit Manager";
// $group->description = "Egypt-External Audit- Audit Manager";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 144;
// $group->name = "Egypt-External Audit- Lead Auditor";
// $group->description = "Egypt-External Audit- Lead Auditor";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 145;
// $group->name = "Egypt-External Audit- Lead Auditee";
// $group->description = "Egypt-External Audit- Lead Auditee";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 146;
// $group->name = "Egypt-External Audit- FP";
// $group->description = "Egypt-External Audit- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 147;
// $group->name = "Egypt-External Audit- View Only";
// $group->description = "Egypt-External Audit- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// // Jordan
// $group = new RoleGroup();
// $group->id = 148;
// $group->name = "Jordan-External Audit- Audit Manager";
// $group->description = "Jordan-External Audit- Audit Manager";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 149;
// $group->name = "Jordan-External Audit- Lead Auditor";
// $group->description = "Jordan-External Audit- Lead Auditor";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 150;
// $group->name = "Jordan-External Audit- Lead Auditee";
// $group->description = "Jordan-External Audit- Lead Auditee";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 151;
// $group->name = "Jordan-External Audit- FP";
// $group->description = "Jordan-External Audit- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 152;
// $group->name = "Jordan-External Audit- View Only";
// $group->description = "Jordan-External Audit- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// // Estonia
// $group = new RoleGroup();
// $group->id = 153;
// $group->name = "KSA-Internal Audit- Audit Manager";
// $group->description = "KSA-Internal Audit- Audit Manager";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 154;
// $group->name = "KSA-Internal Audit- Lead Auditor";
// $group->description = "KSA-Internal Audit- Lead Auditor";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 155;
// $group->name = "KSA-Internal Audit- Lead Auditee";
// $group->description = "KSA-Internal Audit- Lead Auditee";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 156;
// $group->name = "KSA-Internal Audit- FP";
// $group->description = "KSA-Internal Audit- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 157;
// $group->name = "KSA-Internal Audit- View Only";
// $group->description = "KSA-Internal Audit- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// // Estonia
// $group = new RoleGroup();
// $group->id = 158;
// $group->name = "Estonia-Internal Audit- Audit Manager";
// $group->description = "Estonia-Internal Audit- Audit Manager";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 159;
// $group->name = "Estonia-Internal Audit- Lead Auditor";
// $group->description = "Estonia-Internal Audit- Lead Auditor";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 160;
// $group->name = "Estonia-Internal Audit- Lead Auditee";
// $group->description = "Estonia-Internal Audit- Lead Auditee";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 161;
// $group->name = "Estonia-Internal Audit- FP";
// $group->description = "Estonia-Internal Audit- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 162;
// $group->name = "Estonia-Internal Audit- View Only";
// $group->description = "Estonia-Internal Audit- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// // Egypt
// $group = new RoleGroup();
// $group->id = 163;
// $group->name = "Egypt-Internal Audit- Audit Manager";
// $group->description = "Egypt-Internal Audit- Audit Manager";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 164;
// $group->name = "Egypt-Internal Audit- Lead Auditor";
// $group->description = "Egypt-Internal Audit- Lead Auditor";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 165;
// $group->name = "Egypt-Internal Audit- Lead Auditee";
// $group->description = "Egypt-Internal Audit- Lead Auditee";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 166;
// $group->name = "Egypt-Internal Audit- FP";
// $group->description = "Egypt-Internal Audit- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 167;
// $group->name = "Egypt-Internal Audit- View Only";
// $group->description = "Egypt-Internal Audit- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// // Jordan
// $group = new RoleGroup();
// $group->id = 168;
// $group->name = "Jordan-Internal Audit- Audit Manager";
// $group->description = "Jordan-Internal Audit- Audit Manager";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 169;
// $group->name = "Jordan-Internal Audit- Lead Auditor";
// $group->description = "Jordan-Internal Audit- Lead Auditor";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 170;
// $group->name = "Jordan-Internal Audit- Lead Auditee";
// $group->description = "Jordan-Internal Audit- Lead Auditee";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 171;
// $group->name = "Jordan-Internal Audit- FP";
// $group->description = "Jordan-Internal Audit- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 172;
// $group->name = "Jordan-Internal Audit- View Only";
// $group->description = "Jordan-Internal Audit- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();


// // KSA-Audit Program
// $group = new RoleGroup();
// $group->id = 173;
// $group->name = "KSA-Audit Program- Initiator";
// $group->description = "KSA-Audit Program- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 174;
// $group->name = "KSA-Audit Program- Audit Manager";
// $group->description = "KSA-Audit Program- Audit Manager";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 175;
// $group->name = "KSA-Audit Program- FP";
// $group->description = "KSA-Audit Program- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 176;
// $group->name = "KSA-Audit Program- View Only";
// $group->description = "KSA-Audit Program- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// // Estonia-Audit Program
// $group = new RoleGroup();
// $group->id = 177;
// $group->name = "Estonia-Audit Program- Initiator";
// $group->description = "Estonia-Audit Program- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 178;
// $group->name = "Estonia-Audit Program- Audit Manager";
// $group->description = "Estonia-Audit Program- Audit Manager";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 179;
// $group->name = "Estonia-Audit Program- FP";
// $group->description = "Estonia-Audit Program- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 180;
// $group->name = "Estonia-Audit Program- View Only";
// $group->description = "Estonia-Audit Program- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// // Egypt-Audit Program
// $group = new RoleGroup();
// $group->id = 181;
// $group->name = "Egypt-Audit Program- Initiator";
// $group->description = "Egypt-Audit Program- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 182;
// $group->name = "Egypt-Audit Program- Audit Manager";
// $group->description = "Egypt-Audit Program- Audit Manager";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 183;
// $group->name = "Egypt-Audit Program- FP";
// $group->description = "Egypt-Audit Program- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 184;
// $group->name = "Egypt-Audit Program- View Only";
// $group->description = "Egypt-Audit Program- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// // Jordan-Audit Program
// $group = new RoleGroup();
// $group->id = 185;
// $group->name = "Jordan-Audit Program- Initiator";
// $group->description = "Jordan-Audit Program- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 186;
// $group->name = "Jordan-Audit Program- Audit Manager";
// $group->description = "Jordan-Audit Program- Audit Manager";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 187;
// $group->name = "Jordan-Audit Program- FP";
// $group->description = "Jordan-Audit Program- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 188;
// $group->name = "Jordan-Audit Program- View Only";
// $group->description = "Jordan-Audit Program- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();


// // KSA
// $group = new RoleGroup();
// $group->id = 189;
// $group->name = "KSA-CAPA- Initiator";
// $group->description = "KSA-CAPA- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 190;
// $group->name = "KSA-CAPA- HOD/Designee";
// $group->description = "KSA-CAPA- HOD/Designee";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 191;
// $group->name = "KSA-CAPA- QA";
// $group->description = "KSA-CAPA- QA";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 192;
// $group->name = "KSA-CAPA- FP";
// $group->description = "KSA-CAPA- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 193;
// $group->name = "KSA-CAPA- View Only";
// $group->description = "KSA-CAPA- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// // Estonia
// $group = new RoleGroup();
// $group->id = 194;
// $group->name = "Estonia-CAPA- Initiator";
// $group->description = "Estonia-CAPA- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 195;
// $group->name = "Estonia-CAPA- HOD/Designee";
// $group->description = "Estonia-CAPA- HOD/Designee";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 196;
// $group->name = "Estonia-CAPA- QA";
// $group->description = "Estonia-CAPA- QA";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 197;
// $group->name = "Estonia-CAPA- FP";
// $group->description = "Estonia-CAPA- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 198;
// $group->name = "Estonia-CAPA- View Only";
// $group->description = "Estonia-CAPA- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// // Egypt
// $group = new RoleGroup();
// $group->id = 199;
// $group->name = "Egypt-CAPA- Initiator";
// $group->description = "Egypt-CAPA- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 200;
// $group->name = "Egypt-CAPA- HOD/Designee";
// $group->description = "Egypt-CAPA- HOD/Designee";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 201;
// $group->name = "Egypt-CAPA- QA";
// $group->description = "Egypt-CAPA- QA";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 202;
// $group->name = "Egypt-CAPA- FP";
// $group->description = "Egypt-CAPA- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 203;
// $group->name = "Egypt-CAPA- View Only";
// $group->description = "Egypt-CAPA- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// // Jordan
// $group = new RoleGroup();
// $group->id = 204;
// $group->name = "Jordan-CAPA- Initiator";
// $group->description = "Jordan-CAPA- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 205;
// $group->name = "Jordan-CAPA- HOD/Designee";
// $group->description = "Jordan-CAPA- HOD/Designee";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 206;
// $group->name = "Jordan-CAPA- QA";
// $group->description = "Jordan-CAPA- QA";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 207;
// $group->name = "Jordan-CAPA- FP";
// $group->description = "Jordan-CAPA- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 208;
// $group->name = "Jordan-CAPA- View Only";
// $group->description = "Jordan-CAPA- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// //KSA New Document
// $group = new RoleGroup();
// $group->id = 209;
// $group->name = "KSA-New Document- Initiator";
// $group->description = "KSA-New Document- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 210;
// $group->name = "KSA-New Document- Reviewer";
// $group->description = "KSA-New Document- Reviewer";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 211;
// $group->name = "KSA-New Document- Approver";
// $group->description = "KSA-New Document- Approver";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();


// $group = new RoleGroup();
// $group->id = 212;
// $group->name = "Estonia-New Document- Initiator";
// $group->description = "Estonia-New Document- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 213;
// $group->name = "Estonia-New Document- Reviewer";
// $group->description = "Estonia-New Document- Reviewer";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 214;
// $group->name = "Estonia-New Document- Approver";
// $group->description = "Estonia-New Document- Approver";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 215;
// $group->name = "Egypt-New Document- Initiator";
// $group->description = "Egypt-New Document- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 216;
// $group->name = "Egypt-New Document- Reviewer";
// $group->description = "Egypt-New Document- Reviewer";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 217;
// $group->name = "Egypt-New Document- Approver";
// $group->description = "Egypt-New Document- Approver";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();


// $group = new RoleGroup();
// $group->id = 218;
// $group->name = "Jordan-New Document- Initiator";
// $group->description = "Jordan-New Document- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 219;
// $group->name = "Jordan-New Document- Reviewer";
// $group->description = "Jordan-New Document- Reviewer";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 220;
// $group->name = "Jordan-New Document- Approver";
// $group->description = "Jordan-New Document- Approver";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// // KSA Lab Incident
// $group = new RoleGroup();
// $group->id = 221;
// $group->name = "KSA-Lab Incident- Initiator";
// $group->description = "KSA-Lab Incident- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 222;
// $group->name = "KSA-Lab Incident- HOD/Designee";
// $group->description = "KSA-Lab Incident- HOD/Designee";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 223;
// $group->name = "KSA-Lab Incident- QA";
// $group->description = "KSA-Lab Incident- QA";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 224;
// $group->name = "KSA-Lab Incident- FP";
// $group->description = "KSA-Lab Incident- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 225;
// $group->name = "KSA-Lab Incident- View Only";
// $group->description = "KSA-Lab Incident- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// // Estonia
// $group = new RoleGroup();
// $group->id = 226;
// $group->name = "Estonia-Lab Incident- Initiator";
// $group->description = "Estonia-Lab Incident- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 227;
// $group->name = "Estonia-Lab Incident- HOD/Designee";
// $group->description = "Estonia-Lab Incident- HOD/Designee";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 228;
// $group->name = "Estonia-Lab Incident- QA";
// $group->description = "Estonia-Lab Incident- QA";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 229;
// $group->name = "Estonia-Lab Incident- FP";
// $group->description = "Estonia-Lab Incident- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 230;
// $group->name = "Estonia-Lab Incident- View Only";
// $group->description = "Estonia-Lab Incident- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// // Egypt
// $group = new RoleGroup();
// $group->id = 231;
// $group->name = "Egypt-Lab Incident- Initiator";
// $group->description = "Egypt-Lab Incident- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 232;
// $group->name = "Egypt-Lab Incident- HOD/Designee";
// $group->description = "Egypt-Lab Incident- HOD/Designee";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 233;
// $group->name = "Egypt-Lab Incident- QA";
// $group->description = "Egypt-Lab Incident- QA";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 234;
// $group->name = "Egypt-Lab Incident- FP";
// $group->description = "Egypt-Lab Incident- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 235;
// $group->name = "Egypt-Lab Incident- View Only";
// $group->description = "Egypt-Lab Incident- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// // Jordan
// $group = new RoleGroup();
// $group->id = 236;
// $group->name = "Jordan-Lab Incident- Initiator";
// $group->description = "Jordan-Lab Incident- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 237;
// $group->name = "Jordan-Lab Incident- HOD/Designee";
// $group->description = "Jordan-Lab Incident- HOD/Designee";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 238;
// $group->name = "Jordan-Lab Incident- QA";
// $group->description = "Jordan-Lab Incident- QA";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 239;
// $group->name = "Jordan-Lab Incident- FP";
// $group->description = "Jordan-Lab Incident- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 240;
// $group->name = "Jordan-Lab Incident- View Only";
// $group->description = "Jordan-Lab Incident- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// // KSA Effectiveness Check
// $group = new RoleGroup();
// $group->id = 241;
// $group->name = "KSA-Effectiveness Check- Initiator";
// $group->description = "KSA-Effectiveness Check- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 242;
// $group->name = "KSA-Effectiveness Check- Supervisor";
// $group->description = "KSA-Effectiveness Check- Supervisor";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 243;
// $group->name = "KSA-Effectiveness Check- QA";
// $group->description = "KSA-Effectiveness Check- QA";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 244;
// $group->name = "KSA-Effectiveness Check- FP";
// $group->description = "KSA-Effectiveness Check- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 245;
// $group->name = "KSA-Effectiveness Check- View Only";
// $group->description = "KSA-Effectiveness Check- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// // Estonia
// $group = new RoleGroup();
// $group->id = 246;
// $group->name = "Estonia-Effectiveness Check- Initiator";
// $group->description = "Estonia-Effectiveness Check- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 247;
// $group->name = "Estonia-Effectiveness Check- Supervisor";
// $group->description = "Estonia-Effectiveness Check- Supervisor";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 248;
// $group->name = "Estonia-Effectiveness Check- QA";
// $group->description = "Estonia-Effectiveness Check- QA";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 249;
// $group->name = "Estonia-Effectiveness Check- FP";
// $group->description = "Estonia-Effectiveness Check- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 250;
// $group->name = "Estonia-Effectiveness Check- View Only";
// $group->description = "Estonia-Effectiveness Check- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// // Egypt
// $group = new RoleGroup();
// $group->id = 251;
// $group->name = "Egypt-Effectiveness Check- Initiator";
// $group->description = "Egypt-Effectiveness Check- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 252;
// $group->name = "Egypt-Effectiveness Check- Supervisor";
// $group->description = "Egypt-Effectiveness Check- Supervisor";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 253;
// $group->name = "Egypt-Effectiveness Check- QA";
// $group->description = "Egypt-Effectiveness Check- QA";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 254;
// $group->name = "Egypt-Effectiveness Check- FP";
// $group->description = "Egypt-Effectiveness Check- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 255;
// $group->name = "Egypt-Effectiveness Check- View Only";
// $group->description = "Egypt-Effectiveness Check- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// // Jordan
// $group = new RoleGroup();
// $group->id = 256;
// $group->name = "Jordan-Effectiveness Check- Initiator";
// $group->description = "Jordan-Effectiveness Check- Initiator";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 257;
// $group->name = "Jordan-Effectiveness Check- Supervisor";
// $group->description = "Jordan-Effectiveness Check- Supervisor";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 258;
// $group->name = "Jordan-Effectiveness Check- QA";
// $group->description = "Jordan-Effectiveness Check- QA";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 259;
// $group->name = "Jordan-Effectiveness Check- FP";
// $group->description = "Jordan-Effectiveness Check- FP";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

// $group = new RoleGroup();
// $group->id = 260;
// $group->name = "Jordan-Effectiveness Check- View Only";
// $group->description = "Jordan-Effectiveness Check- View Only";
// $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
// $group->save();

//         //New Document Trainer
//         $group = new RoleGroup();
//         $group->id = 261;
//         $group->name = "KSA-New Document-Trainer";
//         $group->description = "KSA-New Document-Trainer";
//         $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
//         $group->save();

//         $group = new RoleGroup();
//         $group->id = 262;
//         $group->name = "Estonia-New Document-Trainer";
//         $group->description = "Estonia-New Document-Trainer";
//         $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
//         $group->save();

//         $group = new RoleGroup();
//         $group->id = 263;
//         $group->name = "Egypt-New Document-Trainer";
//         $group->description = "Egypt-New Document-Trainer";
//         $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
//         $group->save();

//         $group = new RoleGroup();
//         $group->id = 264;
//         $group->name = "Jordan-New Document-Trainer";
//         $group->description = "Jordan-New Document-Trainer";
//         $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
//         $group->save();

//         $group = new RoleGroup();
//         $group->id = 265;
//         $group->name = "KSA-Lab Incident- QC Head/ Designee";
//         $group->description = "KSA-Lab Incident- QC Head/ Designee";
//         $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
//         $group->save();

//         $group = new RoleGroup();
//         $group->id = 266;
//         $group->name = "Estonia-Lab Incident- QC Head/ Designee";
//         $group->description = "Estonia-Lab Incident- QC Head/ Designee";
//         $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
//         $group->save();

//         $group = new RoleGroup();
//         $group->id = 267;
//         $group->name = "Egypt-Lab Incident- QC Head/ Designee";
//         $group->description = "Egypt-Lab Incident- QC Head/ Designee";
//         $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
//         $group->save();

//         $group = new RoleGroup();
//         $group->id = 268;
//         $group->name = "Jordan-Lab Incident- QC Head/ Designee";
//         $group->description = "Jordan-Lab Incident- QC Head/ Designee";
//         $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
//         $group->save();


        $sites = [
            'Corporate',
            'Plant'
        ];

        $processes = [
            'Effectiveness Check',
            'Change Control',
            'Lab Incident',
            'CAPA',
            'Audit Program',
            'Internal Audit',
            'External Audit',
            'Management Review',
            'Risk Assessment',
            'Action Item',
            'Extension',
            'Observation',
            'OOS Chemical',
            'OOT',
            'OOC',
            'Deviation',
            'New Document',
            'Market Complaint',
            'Non Conformance',
            'Incident',
            'Failure Investigation',
            'ERRATA',
            'OOS Microbiology'
        ];

        $roles = [
            'Initiator',
            'Reviewer',
            'Approver',
            'HOD/Designee',
            'QA',
            'CFT/SME',
            'Trainer',
            'FP',
            'View Only'
        ];

        $start_from_id = 1;

        foreach ($sites as $site)
        {
            foreach ($processes as $process)
            {
                foreach ($roles as $role)
                {
                    $group  = new RoleGroup();
                    $group->id = $start_from_id;
                    $group->name = "$site-$process- $role";
                    $group->description = "$site-$process- $role";
                    $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
                    $group->save();

                    $start_from_id++;
                }
            }
        }

        $new_divs = [
            'Corporate' => [
                'processes' => ['Employee'],
                'roles' => [
                    'HR',
                ]
            ]
        ];

        foreach ($new_divs as $division => $data)
        {
            foreach ($data['processes'] as $division_processs)
            {
                foreach ($data['roles'] as $division_role)
                {
                    $group  = new RoleGroup();
                    $group->id = $start_from_id;
                    $group->name = "$division-$division_processs- $division_role";
                    $group->description = "$site-$process- $role";
                    $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
                    $group->save();

                    $start_from_id++;
                }
            } 
        }

    }
}
