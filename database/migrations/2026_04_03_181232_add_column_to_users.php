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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('failed_attempts')->default(0)->after('password');
            $table->timestamp('locked_at')->nullable()->after('failed_attempts');
            $table->boolean('force_password_change')->default(1)->after('password');
            $table->timestamp('password_change_time')->nullable()->after('force_password_change');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['failed_attempts', 'locked_at', 'force_password_change']);
        });
    }
};
