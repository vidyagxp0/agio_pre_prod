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
    Schema::table('deviations', function (Blueprint $table) {
        $table->string('hod_file_attachment')->nullable(); // Use the same type and attributes as 'Audit_file'
    });

    DB::statement('UPDATE deviations SET hod_file_attachment = Audit_file');

    Schema::table('deviations', function (Blueprint $table) {
        $table->dropColumn('Audit_file');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deviations', function (Blueprint $table) {
            $table->renameColumn('hod_file_attachment','Audit_file');
        });
    }
};
