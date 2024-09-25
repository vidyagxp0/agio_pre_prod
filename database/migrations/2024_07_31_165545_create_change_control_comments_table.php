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
        Schema::create('change_control_comments', function (Blueprint $table) {
            $table->id();
            $table->integer('cc_id')->nullable();
            $table->string('QaHeadToQaFinalBy')->nullable();
            $table->string('QaHeadToQaFinalOn')->nullable();
            $table->longText('QaHeadToQaFinalComment')->nullable();

            $table->string('QaFinalToCftBy')->nullable();
            $table->string('QaFinalToCftOn')->nullable();
            $table->longText('QaFinalToCftComment')->nullable();

            $table->string('cftToQaInitialBy')->nullable();
            $table->string('cftToQaInitialOn')->nullable();
            $table->longText('cftToQaInitialComment')->nullable();

            $table->string('QaInitialToHodBy')->nullable();
            $table->string('QaInitialToHodOn')->nullable();
            $table->longText('QaInitialToHodComment')->nullable();

            $table->string('HodToOpenedBy')->nullable();
            $table->string('HodToOpenedOn')->nullable();
            $table->longText('HodToOpenedComment')->nullable();

            $table->string('openedToCancelBy')->nullable();
            $table->string('openedToCancelOn')->nullable();
            $table->longText('openedToCancelComment')->nullable();
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
        Schema::dropIfExists('change_control_comments');
    }
};
