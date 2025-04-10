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
        Schema::table('marketcompalints', function (Blueprint $table) {
            $table->longtext('investigation_attach')->nullable();
        });

        
    DB::statement('UPDATE marketcompalints SET investigation_attach = initial_attachment_hodsr');

    Schema::table('marketcompalints', function (Blueprint $table) {
        $table->dropColumn('initial_attachment_hodsr');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('marketcompalints', function (Blueprint $table) {
            //
        });
    }
};
