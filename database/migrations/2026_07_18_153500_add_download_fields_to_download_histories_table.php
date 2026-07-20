<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('download_histories', function (Blueprint $table) {
            if (!Schema::hasColumn('download_histories', 'print_reason')) {
                $table->longText('print_reason')->nullable();
            }

            if (!Schema::hasColumn('download_histories', 'document_printed_copies')) {
                $table->text('document_printed_copies')->nullable();
            }

            if (!Schema::hasColumn('download_histories', 'issuance_to')) {
                $table->string('issuance_to')->nullable();
            }

            if (!Schema::hasColumn('download_histories', 'issued_copies')) {
                $table->text('issued_copies')->nullable();
            }

            if (!Schema::hasColumn('download_histories', 'issued_reason')) {
                $table->text('issued_reason')->nullable();
            }

            if (!Schema::hasColumn('download_histories', 'department')) {
                $table->text('department')->nullable();
            }

            if (!Schema::hasColumn('download_histories', 'document_number')) {
                $table->text('document_number')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('download_histories', function (Blueprint $table) {
            if (Schema::hasColumn('download_histories', 'print_reason')) {
                $table->dropColumn('print_reason');
            }

            if (Schema::hasColumn('download_histories', 'document_printed_copies')) {
                $table->dropColumn('document_printed_copies');
            }

            if (Schema::hasColumn('download_histories', 'issuance_to')) {
                $table->dropColumn('issuance_to');
            }

            if (Schema::hasColumn('download_histories', 'issued_copies')) {
                $table->dropColumn('issued_copies');
            }

            if (Schema::hasColumn('download_histories', 'issued_reason')) {
                $table->dropColumn('issued_reason');
            }

            if (Schema::hasColumn('download_histories', 'department')) {
                $table->dropColumn('department');
            }

            if (Schema::hasColumn('download_histories', 'document_number')) {
                $table->dropColumn('document_number');
            }
        });
    }
};