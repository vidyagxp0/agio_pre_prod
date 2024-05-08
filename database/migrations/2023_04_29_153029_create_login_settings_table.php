<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('login_settings', function (Blueprint $table) {
            $table->id();
            $table->integer("user_limit")->default(10);
            $table->integer("auto_logout_time")->default(15);
            $table->timestamps();
        });

        DB::table('login_settings')->insert(
            array(
                [
                    'user_limit' => 10,
                    'auto_logout_time' => 15,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('login_settings');
    }
};
