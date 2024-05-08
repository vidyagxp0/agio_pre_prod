<?php

namespace Database\Seeders;

use App\Models\DocumentLanguage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $department  = new DocumentLanguage();
        $department->lname = "English";
        $department->lcode = "EN";
        $department->save();

        // $department  = new DocumentLanguage();
        // $department->lname = "Korean";
        // $department->lcode = "KN";
        // $department->save();
    }
}
