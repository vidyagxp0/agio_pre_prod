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

              Schema::create('table_cc_impactassement', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cc_id');
            for ($i = 1; $i <= 89; $i++) {
                $table->text("response_$i")->nullable();

                $table->text("remark_$i")->nullable();
            }
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
        Schema::dropIfExists('table_cc_impactassement');

    }
};
