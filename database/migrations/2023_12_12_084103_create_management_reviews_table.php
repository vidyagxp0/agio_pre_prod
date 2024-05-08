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
        Schema::create('management_reviews', function (Blueprint $table) {
            $table->id();
            // $table->integer('record_number')->nullable();
            $table->text('Operations')->nullable();
            $table->text('requirement_products_services')->nullable();
            $table->text('design_development_product_services')->nullable();
            $table->text('control_externally_provide_services')->nullable();
            $table->text('production_service_provision')->nullable();
            $table->text('release_product_services')->nullable();
            $table->text('control_nonconforming_outputs')->nullable();
            $table->text('risk_opportunities')->nullable();
            $table->text('external_supplier_performance')->nullable();
            $table->text('customer_satisfaction_level')->nullable();
            $table->text('budget_estimates')->nullable();
            $table->text('completion_of_previous_tasks')->nullable();
            $table->text('production_new')->nullable();
            $table->text('plans_new')->nullable();
            // $table->text('action-item-details')->nullable();
            $table->text('forecast_new')->nullable();
            $table->text('due_date_extension')->nullable();
            $table->text('next_managment_review_date')->nullable();
            $table->text('summary_recommendation')->nullable();
            $table->text('conclusion_new')->nullable();
            $table->text('additional_suport_required')->nullable();
            $table->integer('serial_number')->nullable();
            $table->date('date')->nullable();
            $table->string('topic')->nullable();
            $table->string('responsible')->nullable();
            $table->string('start_time')->nullable();
            $table->string('comment')->nullable();
            $table->string('monitoring')->nullable();
            $table->string('measurement')->nullable();
            $table->string('analysis')->nullable();
            $table->string('evaluation')->nullable();

            $table->string('invited_Person')->nullable();
            $table->string('designee')->nullable();
            $table->string('department')->nullable();
            $table->string('meeting_Attended')->nullable();
            $table->string('designee_Name')->nullable();
            $table->string('designee_Department')->nullable();
            $table->string('remarks')->nullable();

            $table->string('short_desc')->nullable();
            $table->string('site')->nullable();
            $table->string('responsible_person')->nullable();
            $table->string('current_status')->nullable();
            $table->string('remark')->nullable();
            $table->date('date_due')->nullable();
            $table->date('date_closed')->nullable();

            $table->string('Details')->nullable();
            $table->string('capa_type')->nullable();
            $table->string('site2')->nullable();
            $table->string('responsible_person2')->nullable();
            $table->string('current_status2')->nullable();
            $table->date('date_closed2')->nullable();
            $table->string('remark2')->nullable();
        

            $table->text('assign_to')->nullable();
            $table->text('initiator_id')->nullable();
            $table->text('initiator_Group')->nullable();
            $table->text('initiator_group_code')->nullable();

            $table->string('division_id')->nullable();
            $table->string('form_type')->nullable();
            $table->integer('record')->nullable();
            $table->integer('parent_id')->nullable();
            $table->string('parent_type')->nullable();
            $table->string('division_code')->nullable();
            $table->text('short_description')->nullable();
            $table->string('assigned_to')->nullable();
            $table->string('due_date')->nullable();
            $table->string('intiation_date')->nullable();
            $table->string('type')->nullable();
            $table->text('priority_level')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->longtext('attendees')->nullable();
            $table->text('agenda')->nullable();
            $table->text('performance_evaluation')->nullable();
            $table->text('management_review_participants')->nullable();
            $table->text('action_item_details')->nullable();
            $table->text('capa_detail_details')->nullable();
            $table->text('description')->nullable();
            $table->text('attachment')->nullable();
            $table->string('inv_attachment')->nullable();
            $table->string('closure_attachments')->nullable();
            $table->string('file_attchment_if_any')->nullable();
            $table->date('actual_start_date')->nullable();
            $table->date('actual_end_date')->nullable();
            $table->string('meeting_minute')->nullable();
            $table->string('decision')->nullable();
            $table->string('zone')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('site_name')->nullable();
            $table->string('building')->nullable();
            $table->string('floor')->nullable();
            $table->string('room')->nullable();
            $table->string('status')->nullable();
            $table->integer('stage')->nullable();
            // $table->date('updated_at')->nullable();
            // $table->date('created_at')->nullable();
            // $table->date('origin_state')->nullable();
            $table->string('Submited_by')->nullable();
            $table->string('Submited_on')->nullable();
            


            $table->string('completed_by')->nullable();
            $table->string('completed_on')->nullable();
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
        Schema::dropIfExists('management_reviews');
    }
};
