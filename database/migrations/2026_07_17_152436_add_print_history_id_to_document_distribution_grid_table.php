<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('document_distribution_grid', function (Blueprint $table) {
            $table->unsignedBigInteger('print_history_id')
                ->nullable()
                ->after('document_id');
            $table->bigInteger('history_id')->nullable();  
            $table->string('history_type')->nullable();  

            $table->index(
                ['document_id', 'print_history_id'],
                'document_print_history_index'
            );
        });
    }

    public function down(): void
    {
        Schema::table('document_distribution_grid', function (Blueprint $table) {
            $table->dropIndex('document_print_history_index');
            $table->dropColumn('print_history_id');
        });
    }
};