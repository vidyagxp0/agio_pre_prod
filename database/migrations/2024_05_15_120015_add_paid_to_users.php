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
        Schema::table('ootcs', function (Blueprint $table) {
            $table->string('corrective_action')->nullable();
            $table->string('preventive_action')->nullable();
            $table->string('inv_comments')->nullable();
            $table->string('inv_file_attachment')->nullable();
            $table->string('reason_for_stability')->nullable();
            $table->string('description_of_oot_details')->nullable();
            $table->string('sta_bat_product_history')->nullable();
            $table->string('sta_bat_probable_cause')->nullable();
            $table->string('sta_bat_analyst_name')->nullable();
            $table->string('qa_head_designee')->nullable();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ootcs', function (Blueprint $table) {
            $table->dropColumn('corrective_action')->nullable();
            $table->dropColumn('preventive_action')->nullable();
            $table->dropColumn('inv_comments')->nullable();
            $table->dropColumn('inv_file_attachment')->nullable();
            $table->dropColumn('reason_for_stability')->nullable();
            $table->dropColumn('description_of_oot_details')->nullable();
            $table->dropColumn('sta_bat_product_history')->nullable();
            $table->dropColumn('sta_bat_probable_cause')->nullable();
            $table->dropColumn('sta_bat_analyst_name')->nullable();
            $table->dropColumn('qa_head_designee')->nullable();
        });
    }
};
