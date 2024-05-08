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
        Schema::create('capa_grids', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('capa_id')->nullable();
            $table->string('type')->nullable();
            $table->text('product_name')->nullable();
            $table->string('batch_no')->nullable();
            $table->text('mfg_date')->nullable();
            $table->text('batch_desposition')->nullable();
            $table->text('batch_status')->nullable();
            $table->text('expiry_date')->nullable();
            $table->text('remark')->nullable();
            $table->longText('material_name')->nullable();
            $table->longText('material_batch_no')->nullable();
            $table->longText('material_mfg_date')->nullable();
            $table->longText('material_expiry_date')->nullable();
            $table->longText('material_batch_desposition')->nullable();
            $table->longText('material_remark')->nullable();
            $table->longText('material_batch_status')->nullable();

            $table->text('number')->nullable();
            $table->longText('equipment')->nullable();
            $table->longText('equipment_instruments')->nullable();
            $table->longText('equipment_comments')->nullable();
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
        Schema::dropIfExists('capa_grids');
    }
};
