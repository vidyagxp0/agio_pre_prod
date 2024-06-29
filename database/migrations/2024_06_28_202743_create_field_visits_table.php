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
        Schema::create('field_visits', function (Blueprint $table) {
            $table->id();
            $table->integer('record')->nullable();
            $table->text('division_code')->nullable();
            $table->text('initiator')->nullable();
            $table->text('intiation_date')->nullable();
            $table->text('date')->nullable();
            $table->text('time')->nullable();
            $table->text('brand_name')->nullable();
            $table->text('field_visitor')->nullable();
            $table->text('region')->nullable();
            $table->text('exact_location')->nullable();
            $table->text('exact_address')->nullable();
            $table->text('page_section')->nullable();
            $table->text('photos')->nullable();
            $table->text('store_lighting')->nullable();
            $table->text('lighting_products')->nullable();
            $table->text('store_vibe')->nullable();
            $table->text('fragrance_in_store')->nullable();
            $table->text('music_inside_store')->nullable();
            $table->text('space_utilization')->nullable();
            $table->text('store_layout')->nullable();
            $table->text('floors')->nullable();
            $table->text('ac')->nullable();
            $table->text('mannequin_display')->nullable();
            $table->text('seating_area')->nullable();
            $table->text('product_visiblity')->nullable();
            $table->text('store_signage')->nullable();
            $table->text('independent_washroom')->nullable();
            $table->text('any_remarks')->nullable();
            $table->text('page_section1')->nullable();
            $table->text('staff_behaviour')->nullable();
            $table->text('well_groomed')->nullable();
            $table->text('standard_staff_uniform')->nullable();
            $table->text('trial_room_assistance')->nullable();
            $table->text('number_customer')->nullable();
            $table->text('handel_customer')->nullable();
            $table->text('knowledge_of_merchandise')->nullable();
            $table->text('awareness_of_brand')->nullable();
            $table->text('proactive')->nullable();
            $table->text('customer_satisfaction')->nullable();
            $table->text('billing_counter_experience')->nullable();
            $table->text('remarks_on_staff_observation')->nullable();
            $table->text('page_sacetion_2')->nullable();
            $table->text('any_offers')->nullable();
            $table->text('current_offer')->nullable();
            $table->text('exchange_policy')->nullable();
            $table->text('discount_offer')->nullable();
            $table->text('reward_point_given')->nullable();
            $table->text('use_of_influencer')->nullable();
            $table->text('age_group_of_customer')->nullable();
            $table->text('alteration_facility_in_store')->nullable();
            $table->text('any_remarks_sale')->nullable();
            $table->text('page_section_3')->nullable();
            $table->text('sub_brand_offered')->nullable();
            $table->text('colour_palette')->nullable();
            $table->text('number_of_colourways')->nullable();
            $table->text('size_availiblity')->nullable();
            $table->text('engaging_price')->nullable();
            $table->text('merchadise_available')->nullable();
            $table->text('types_of_fabric')->nullable();
            $table->text('prints_observed')->nullable();
            $table->text('embroideries_observed')->nullable();
            $table->text('quality_of_garments')->nullable();
            $table->text('remarks_on_product_observation')->nullable();
            $table->text('page_section_4')->nullable();
            $table->text('entrance_of_the_store')->nullable();
            $table->text('story_telling')->nullable();
            $table->text('stock_display')->nullable();
            $table->text('spacing_of_clothes')->nullable();
            $table->text('how_many_no_of_customers')->nullable();
            $table->text('page_section_5')->nullable();
            $table->text('brand_tagline')->nullable();
            $table->text('type_of_ball')->nullable();
            $table->text('page_section_6')->nullable();
            $table->text('number_of_trial_rooms_')->nullable();
            $table->text('hygiene_')->nullable();
            $table->text('ventilation_')->nullable();
            $table->text('queue_outside_the_trial_room')->nullable();
            $table->text('mirror_size')->nullable();
            $table->text('trial_room_lighting')->nullable();
            $table->text('trial_room_available')->nullable();
            $table->text('seating_around_trial_room')->nullable();
            $table->text('cloth_hanger')->nullable();
            $table->text('any_remarks_on_the_trail_room')->nullable();
            $table->text('comments_on_hte_overall_store')->nullable();
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
        Schema::dropIfExists('field_visits');
    }
};
