<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('capas', function (Blueprint $table) {
            $table->longText('hod_remarks')->nullable();
            $table->string('hod_attachment')->nullable();
            $table->string('qa_attachment')->nullable();
            $table->string('capafileattachement')->nullable();
            $table->text('investigation')->nullable();
            $table->text('rcadetails')->nullable();


            


            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('capas', function (Blueprint $table) {
            //
        });
    }
};
