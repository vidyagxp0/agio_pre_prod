<?php

namespace Database\Seeders;

use App\Models\Grouppermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $group  = new Grouppermission();
        $group->name = "Approver Group";
        $group->role_id = 1;
        $group->save();

        $group  = new Grouppermission();
        $group->name = "Reviewer Group";
        $group->role_id = 2;
        $group->save();
    }
}
