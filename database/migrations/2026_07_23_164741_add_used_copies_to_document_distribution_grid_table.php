<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table(
            'document_distribution_grid',
            function (Blueprint $table) {

                if (
                    !Schema::hasColumn(
                        'document_distribution_grid',
                        'used_copies'
                    )
                ) {
                    $table->integer('used_copies')
                        ->nullable()
                        ->after('retrieved_copies');
                }
            }
        );
    }

    public function down(): void
    {
        Schema::table(
            'document_distribution_grid',
            function (Blueprint $table) {

                if (
                    Schema::hasColumn(
                        'document_distribution_grid',
                        'used_copies'
                    )
                ) {
                    $table->dropColumn(
                        'used_copies'
                    );
                }
            }
        );
    }
};