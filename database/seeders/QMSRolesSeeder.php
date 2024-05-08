<?php

namespace Database\Seeders;

use App\Models\QMSRoles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QMSRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $group  = new QMSRoles();
        $group->id = 1;
        $group->name = "Approver";
        $group->description = "Approver";
        $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
        $group->save();

        $group  = new QMSRoles();
        $group->id = 2;
        $group->name = "Reviewer";
        $group->description = "Reviewer";
        $group->permission = json_encode(['read' => true, 'create' => false, 'edit' => true, 'delete' => false]);
        $group->save();

        $group  = new QMSRoles();
        $group->id = 3;
        $group->name = "Initiator";
        $group->description = "Initiator or Originator";
        $group->permission = json_encode(['read' => true, 'create' => false, 'edit' => true, 'delete' => false]);
        $group->save();

        $group  = new QMSRoles();
        $group->id = 4;
        $group->name = "HOD/Designee";
        $group->description = "HOD/Designee";
        $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
        $group->save();

        $group  = new QMSRoles();
        $group->id = 5;
        $group->name = "CFT/SME";
        $group->description = "CFT/SME";
        $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
        $group->save();

        $group  = new QMSRoles();
        $group->id = 6;
        $group->name = "Trainer";
        $group->description = "Trainer";
        $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
        $group->save();

        $group  = new QMSRoles();
        $group->name = 7;
        $group->name = "QA";
        $group->description = "QA";
        $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
        $group->save();

        $group  = new QMSRoles();
        $group->id = 8;
        $group->name = "Action Owner";
        $group->description = "Action Owner";
        $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
        $group->save();

        $group  = new QMSRoles();
        $group->id = 9;
        $group->name = "QA Head Designee";
        $group->description = "QA Head Designee";
        $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
        $group->save();

        $group  = new QMSRoles();
        $group->id = 10;
        $group->name = "QC Head/ Designee";
        $group->description = "QC Head/ Designee";
        $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
        $group->save();


        $group  = new QMSRoles();
        $group->id = 11;
        $group->name = "Lead Auditee";
        $group->description = "Lead Auditee";
        $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
        $group->save();

        $group  = new QMSRoles();
        $group->id = 12;
        $group->name = "Lead Auditor";
        $group->description = "Lead Auditor";
        $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
        $group->save();

        $group  = new QMSRoles();
        $group->id = 13;
        $group->name = "Audit Manager";
        $group->description = "Audit Manager";
        $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
        $group->save();

        $group  = new QMSRoles();
        $group->id = 14;
        $group->name = "Supervisor";
        $group->description = "Supervisor";
        $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
        $group->save();

        $group  = new QMSRoles();
        $group->id = 15;
        $group->name = "Responsible Person";
        $group->description = "Responsible Person";
        $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
        $group->save();

        $group  = new QMSRoles();
        $group->id = 16;
        $group->name = "Work Group";
        $group->description = "Work Group (Risk Management Head)";
        $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
        $group->save();

        $group  = new QMSRoles();
        $group->id = 17;
        $group->name = "View Only";
        $group->description = "View Only";
        $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
        $group->save();

        $group  = new QMSRoles();
        $group->id = 18;
        $group->name = "FP";
        $group->description = "FP";
        $group->permission = json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]);
        $group->save();
    }
}
