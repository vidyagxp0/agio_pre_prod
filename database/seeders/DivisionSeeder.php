<?php

namespace Database\Seeders;

use App\Models\Division;
use App\Models\QMSDivision;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $division = new Division();
        $division->name = "QMS-Global";
        $division->save();

        $division = new Division();
        $division->name = "QMS-Jordan";
        $division->save();

        $division = new Division();
        $division->name = "QMS-India";
        $division->save();

        $division = new Division();
        $division->name = "QMS-Asia";
        $division->save();

        $division = new Division();
        $division->name = "QMS-APAC";
        $division->save();

        $division = new Division();
        $division->name = "DMS-EMEA";
        $division->save();

        $division = new Division();
        $division->name = "DMS-North America";
        $division->save();

        // ---------------------------------------------

        $division = new QMSDivision();
        $division->name = "Corporate";
        $division->status = 1;
        $division->save();

        $division = new QMSDivision();
        $division->name = "Plant";
        $division->status = 1;
        $division->save();

        // $division = new QMSDivision();
        // $division->name = "KSA";
        // $division->status = 0;
        // $division->save();

        // $division = new QMSDivision();
        // $division->name = "Egypt";
        // $division->status = 0;
        // $division->save();

        // $division = new QMSDivision();
        // $division->name = "Estonia";
        // $division->status = 0;
        // $division->save();

        // $division = new QMSDivision();
        // $division->name = "EHS - North America";
        // $division->status = 0;
        // $division->save();

        // $division = new QMSDivision();
        // $division->name = "Global";
        // $division->status = 0;
        // $division->save();

        // $division = new QMSDivision();
        // $division->name = "Jordan";
        // $division->status = 0;
        // $division->save();

        // $division = new QMSDivision();
        // $division->name = "India";
        // $division->status = 0;
        // $division->save();

        // $division = new QMSDivision();
        // $division->name = "QMS - Asia";
        // $division->status = 0;
        // $division->save();

        // $division = new QMSDivision();
        // $division->name = "QMS - EMEA";
        // $division->status = 0;
        // $division->save();

        // $division = new QMSDivision();
        // $division->name = "SQM - APAC";
        // $division->status = 0;
        // $division->save();

        // $division = new QMSDivision();
        // $division->name = "QMS - South America";
        // $division->status = 0;
        // $division->save();
    }
}
