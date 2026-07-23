<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('document_distribution_grid', function (Blueprint $table) {

            if (!Schema::hasColumn(
                'document_distribution_grid',
                'request_id'
            )) {
                $table->string('request_id')
                    ->nullable()
                    ->after('history_id');
            }

            if (!Schema::hasColumn(
                'document_distribution_grid',
                'copy_number'
            )) {
                $table->integer('copy_number')
                    ->nullable()
                    ->after('request_id');
            }

            if (!Schema::hasColumn(
                'document_distribution_grid',
                'retrieval_status'
            )) {
                $table->string('retrieval_status')
                    ->nullable()
                    ->after('copy_number');
            }
        });
    }

    public function down(): void
    {
        Schema::table('document_distribution_grid', function (Blueprint $table) {

            if (Schema::hasColumn(
                'document_distribution_grid',
                'request_id'
            )) {
                $table->dropColumn('request_id');
            }

            if (Schema::hasColumn(
                'document_distribution_grid',
                'copy_number'
            )) {
                $table->dropColumn('copy_number');
            }

            if (Schema::hasColumn(
                'document_distribution_grid',
                'retrieval_status'
            )) {
                $table->dropColumn('retrieval_status');
            }
        });
    }
};