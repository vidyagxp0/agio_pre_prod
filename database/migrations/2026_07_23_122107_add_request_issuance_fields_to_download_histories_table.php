<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('download_histories', function (Blueprint $table) {

            $table->unsignedBigInteger('document_request_id')
                ->nullable()
                ->after('document_id');

            $table->string('request_id')
                ->nullable()
                ->after('document_request_id');

            $table->unsignedBigInteger('issued_by')
                ->nullable()
                ->after('user_id');

            $table->string('issued_by_name')
                ->nullable()
                ->after('issued_by');

            $table->string('issued_to_name')
                ->nullable()
                ->after('issuance_to');

            $table->string('issued_to_department')
                ->nullable()
                ->after('issued_to_name');

            $table->date('issued_date')
                ->nullable()
                ->after('date');

            $table->integer('total_issued_copies')
                ->nullable()
                ->after('issued_copies');

            $table->string('copy_number_range')
                ->nullable()
                ->after('total_issued_copies');
        });
    }

    public function down(): void
    {
        Schema::table('download_histories', function (Blueprint $table) {

            $table->dropColumn([
                'document_request_id',
                'request_id',
                'issued_by',
                'issued_by_name',
                'issued_to_name',
                'issued_to_department',
                'issued_date',
                'total_issued_copies',
                'copy_number_range',
            ]);
        });
    }
};