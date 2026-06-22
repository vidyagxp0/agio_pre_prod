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
        Schema::table('download_histories', function (Blueprint $table) {
            $table->string('issue_copies')->default(0)->nullable();
            $table->longText('print_reason')->nullable();
            $table->text('document_printed_copies')->nullable();
            $table->string('issuance_to')->nullable();
            $table->text('issued_copies')->nullable();
            $table->text('issued_reason')->nullable();
            $table->text('department')->nullable();
            $table->text('document_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('download_histories', function (Blueprint $table) {
            //
        });
    }
};
