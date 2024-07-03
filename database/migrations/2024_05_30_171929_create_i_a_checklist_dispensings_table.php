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
        Schema::create('i_a_checklist_dispensings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ia_id')->nullable();
            for ($i = 1; $i <= 14; $i++) {
                $table->text("response_dispensing_$i")->nullable();
                 $table->text("remark_dispensing_$i")->nullable();
            }
            for ($i = 1; $i <= 50; $i++) {
                $table->text("response_injection_$i")->nullable();
                 $table->text("remark_injection_$i")->nullable();
            }
            for ($i = 1; $i <= 7; $i++) {
                $table->text("response_documentation_$i")->nullable();
                 $table->text("remark_documentation_$i")->nullable();
            }

            $table->string('remark_documentation_name_comment')->nullable();
            $table->longText('remark_documentation_name_attachment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('i_a_checklist_dispensings');
    }
};
