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
        Schema::table('change_control_comments', function (Blueprint $table) {
              $table->string('send_to_pending_initiator_by')->nullable();
                $table->string('send_to_pending_initiator_on')->nullable();
                $table->Text('send_to_pending_initiator_comment')->nullable();
                 $table->string('QaClouseToPostImplementationBy')->nullable();
                $table->string('QaClouseToPostImplementationOn')->nullable();
                $table->Text('QaClouseToPostImplementationComment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('change_control_comments', function (Blueprint $table) {
            //
        });
    }
};
