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
        Schema::create('group_comments', function (Blueprint $table) {
            $table->id();
            $table->integer('cc_id');
            $table->text('qa_comments')->nullable();
            $table->text('qa_commentss')->nullable();
            $table->text('designee_comments')->nullable();
            $table->text('Warehouse_comments')->nullable();
            $table->text('Engineering_comments')->nullable();
            $table->text('Instrumentation_comments')->nullable();
            $table->text('Validation_comments')->nullable();
            $table->Text('Others_comments')->nullable();
            $table->text('Group_comments')->nullable();
            $table->text('group_attachments')->nullable();
            $table->text('cft_comments')->nullable();
            $table->text('cft_attchament')->nullable();

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
        Schema::dropIfExists('group_comments');
    }
};
