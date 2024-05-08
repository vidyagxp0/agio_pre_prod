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
        Schema::create('document_distribution_grid', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('document_id')->nullable();
            $table->longText('serial_number')->nullable();
            $table->longText('document_title')->nullable();
            $table->longText('document_number')->nullable();
            $table->longText('document_printed_by')->nullable();
            $table->longText('document_printed_on')->nullable();
            $table->longText('document_printed_copies')->nullable();
            $table->longText('issuance_date')->nullable();
            $table->longText('issuance_to')->nullable();
            $table->longText('location')->nullable();
            $table->longText('issued_copies')->nullable();
            $table->longText('issued_reason')->nullable();
            $table->longText('retrieval_date')->nullable();
            $table->longText('retrieval_by')->nullable();
            $table->longText('retrieved_department')->nullable();
            $table->longText('retrieved_copies')->nullable();
            $table->longText('retrieved_reason')->nullable();
            $table->longText('remark')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_distribution_grid');
    }
};
