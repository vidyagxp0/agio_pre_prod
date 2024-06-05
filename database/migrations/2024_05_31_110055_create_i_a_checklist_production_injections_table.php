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
        Schema::create('i_a_checklist_production_injections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ia_id')->nullable();
            for ($i = 1; $i <= 41; $i++) {
                $table->text("response_injection_packing_$i")->nullable();
                 $table->text("remark_injection_packing_$i")->nullable();
            }
            for ($i = 1; $i <= 6; $i++) {
                $table->text("response_documentation_production_$i")->nullable();
                 $table->text("remark_documentation_production_$i")->nullable();
            }
            $table->string('response_injection_packing_comment')->nullable();
            $table->longText('remark_injection_packing_attachment')->nullable();
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
        Schema::dropIfExists('i_a_checklist_production_injections');
    }
};
