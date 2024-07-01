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
        Schema::create('field_visit_grids', function (Blueprint $table) {
            $table->id();
                $table->unsignedBigInteger('fv_id')->nullable();
                $table->string('identifier')->nullable();
                $table->longtext('data')->nullable();
                $table->timestamps();
            });
        }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('field_visit_grids');
    }
};
