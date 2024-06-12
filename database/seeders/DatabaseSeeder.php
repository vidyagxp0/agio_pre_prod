<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            LoginSeeder::class,
            RoleGroupSeeder::class,
            StageSeeder::class,
            GroupPermissionSeeder::class,
            DepartmentSeeder::class,
            DocumentLanguageSeeder::class,
            DocumentSeeder::class,
            DivisionSeeder::class,
            ProcessSeeder::class,
            UserLoginSeeder::class,
            QMSRolesSeeder::class,

        ]);
    }
}
