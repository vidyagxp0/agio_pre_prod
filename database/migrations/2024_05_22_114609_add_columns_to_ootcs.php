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
            $table->text('submited_by')->nullable();
            $table->text('submited_on')->nullable();
            $table->longText('a_l_comments')->nullable();
            $table->text('pls_submited_by')->nullable();   
            $table->text('pls_submited_on')->nullable();   
            $table->longText('pls_comments')->nullable();   
            $table->text('p_capa_submited_by')->nullable();   
            $table->text('p_capa_submited_on')->nullable();   
            $table->longText('p_capa_comments')->nullable();   
            $table->text('ppli_submited_by')->nullable();   
            $table->text('ppli_submited_on')->nullable();   
            $table->longText('ppli_comments')->nullable();   
            $table->text('pei_submited_on')->nullable();   
            $table->text('pei_submited_by')->nullable();   
            $table->longText('pei_comments')->nullable();   
            $table->text('final_appruv_submited_by')->nullable();   
            $table->text('final_approve_submited_on')->nullable();   
            $table->longText('final_capa_comments')->nullable();   
            $table->text('cancelled_by')->nullable();   
            $table->text('cancelled_on')->nullable();   
            $table->text('Final_Approval_By')->nullable();   
            $table->text('Final_Approval_on')->nullable();   


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
            //
        });
    }
};
