<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('print_histories', function (Blueprint $table) {

            $table->unsignedBigInteger('document_request_id')
                ->nullable()
                ->after('document_id');

            $table->string('request_id')
                ->nullable()
                ->after('document_request_id');

            $table->text('document_number')->nullable();
            $table->string('issue_copies')->default(0)->nullable();
            $table->text('issued_copies')->nullable();
            $table->text('document_printed_copies')->nullable();
            $table->longText('print_reason')->nullable();
            $table->text('issued_reason')->nullable();
            $table->string('issuance_to')->nullable();
            $table->text('department')->nullable();
            $table->unsignedBigInteger('issued_by')
                ->nullable()
                ->after('user_id');

            $table->string('issued_by_name')
                ->nullable()
                ->after('issued_by');

            $table->date('issued_date')
                ->nullable()
                ->after('date');

            $table->string('issued_to_name')
                ->nullable();

            $table->string('issued_to_department')
                ->nullable()
                ->after('issued_to_name');

            $table->integer('total_issued_copies')
                ->nullable();

            $table->string('copy_number_range')
                ->nullable()
                ->after('total_issued_copies');
        });
    }

    public function down(): void
    {
        Schema::table('print_histories', function (Blueprint $table) {

            $table->dropColumn([
                'document_request_id',
                'request_id',
                'issued_by',
                'issued_by_name',
                'issued_date',
                'issued_to_name',
                'issued_to_department',
                'total_issued_copies',
                'copy_number_range',
            ]);
        });
    }
};