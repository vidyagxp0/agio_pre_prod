<?php

namespace Database\Seeders;

use App\Models\RoleGroup;
use Illuminate\Database\Seeder;

class NewDocumentQaRoleSeeder extends Seeder
{
    public function run()
    {
        $sites = ['Corporate', 'Plant'];

        foreach ($sites as $site) {
            $name = "$site-New Document-QA";

            RoleGroup::firstOrCreate(
                ['name' => $name],
                [
                    'description' => $name,
                    'permission'  => json_encode(['read' => true, 'create' => true, 'edit' => true, 'delete' => true]),
                ]
            );
        }
    }
}