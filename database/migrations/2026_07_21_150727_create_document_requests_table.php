<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('document_requests', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | General Information
            |--------------------------------------------------------------------------
            */

            $table->integer('record')->nullable();

            $table->string('request_id')->nullable();

            // Current logged-in user ID
            $table->unsignedBigInteger('request_by')->nullable();

            // Current logged-in user's department name
            $table->string('department')->nullable();

            // Current user's division
            $table->unsignedBigInteger('division_id')->nullable();

            $table->date('initiation_date')->nullable();

            // Selected document ID
            $table->unsignedBigInteger('document_id')->nullable();

            // Selected Request To user ID
            $table->unsignedBigInteger('request_to')->nullable();

            $table->integer('number_of_copies')->nullable();

            $table->longText('reason')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Comment Tab
            |--------------------------------------------------------------------------
            */

            $table->longText('comment')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Process Fields
            |--------------------------------------------------------------------------
            */

            $table->string('status')->default('Opened');

            $table->integer('stage')->default(1);
             $table->string('form_type')->nullable();


            /*
            |--------------------------------------------------------------------------
            | Activity Log Fields
            |--------------------------------------------------------------------------
            */

            $table->string('submitted_by')->nullable();

            $table->string('submitted_on')->nullable();

            $table->longText('submitted_comment')->nullable();

            $table->string('cancelled_by')->nullable();

            $table->string('cancelled_on')->nullable();

            $table->longText('cancelled_comment')->nullable();

            $table->string('acknowledge_complete_by')->nullable();

            $table->string('acknowledge_complete_on')->nullable();

            $table->longText('acknowledge_complete_comment')->nullable();

            $table->string('completed_by')->nullable();

            $table->string('completed_on')->nullable();

            $table->longText('complete_comment')->nullable();

            $table->string('verification_complete_by')->nullable();

            $table->string('verification_complete_on')->nullable();

            $table->longText('verification_complete_comment')->nullable();


            $table->string('stagebackfirstby')->nullable();

            $table->string('stagebackfirst_on')->nullable();

            $table->longText('stagebackfirst_comment')->nullable();

           
             $table->string('stagecancelfirstby')->nullable();

            $table->string('stagecancelfirst_on')->nullable();

            $table->longText('stagecancelfirst_comment')->nullable();


            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('document_requests');
    }
};