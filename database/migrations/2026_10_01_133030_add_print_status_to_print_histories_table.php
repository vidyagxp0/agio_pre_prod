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
        Schema::table('print_histories', function (Blueprint $table) {
            // if (!Schema::hasColumn('print_histories', 'print_status')) {
            //     // Purani rows ke liye Completed, taki wo "used" hi rahein
            //     $table->string('print_status', 20)->default('Completed');
            // }
            // if (!Schema::hasColumn('print_histories', 'completed_at')) {
            //     $table->timestamp('completed_at')->nullable();
            // }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('print_histories', function (Blueprint $table) {
            // $table->dropColumn(['print_status', 'completed_at']);
        });
    }
};
