<?php

namespace App\Http\Controllers;
use App\Models\FieldVisit;
use App\Models\RecordNumber;
use App\Models\FieldVisitGrid;
use Carbon\Carbon;
use Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FieldVisitController extends Controller
{
    //

    public function index(){

        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        return view('frontend.field-visit.field_visit_new',compact('record_number'));
    }

    public function store(Request $request){
        $data = new FieldVisit();
        $data->stage = "1";
        $data->status = "Opened";
        $data->record = $request->record;
        $data->division_code = $request->division_code;
        $data->initiator = $request->initiator;
        $data->intiation_date = $request->intiation_date;
        $data->date = $request->date;
        $data->time = $request->time;
        $data->brand_name = $request->brand_name;
        $data->field_visitor = $request->field_visitor;
        $data->region = $request->region;
        $data->exact_location = $request->exact_location;
        $data->exact_address = $request->exact_address;
        $data->page_section = $request->page_section;
        $data->photos = $request->photos;
        $data->store_lighting = $request->store_lighting;
        $data->lighting_products = $request->lighting_products;
        $data->store_vibe = $request->store_vibe;
        $data->fragrance_in_store = $request->fragrance_in_store;
        $data->music_inside_store = $request->music_inside_store;
        $data->space_utilization = $request->space_utilization;
        $data->store_layout = $request->store_layout;
        $data->floors = $request->floors;
        $data->ac = $request->ac;
        $data->mannequin_display = $request->mannequin_display;
        $data->seating_area = $request->seating_area;
        $data->product_visiblity = $request->product_visiblity;
        $data->store_signage = $request->store_signage;
        $data->independent_washroom = $request->independent_washroom;
        $data->any_remarks = $request->any_remarks;
        $data->page_section1 = $request->page_section1;
        $data->staff_behaviour = $request->staff_behaviour;
        $data->well_groomed = $request->well_groomed;
        $data->standard_staff_uniform = $request->standard_staff_uniform;
        $data->trial_room_assistance = $request->trial_room_assistance;
        $data->number_customer = $request->number_customer;
        $data->handel_customer = $request->handel_customer;
        $data->knowledge_of_merchandise = $request->knowledge_of_merchandise;
        $data->awareness_of_brand = $request->awareness_of_brand;
        $data->proactive = $request->proactive;
        $data->customer_satisfaction = $request->customer_satisfaction;
        $data->billing_counter_experience = $request->billing_counter_experience;
        $data->remarks_on_staff_observation = $request->remarks_on_staff_observation;
        $data->page_sacetion_2 = $request->page_sacetion_2;
        $data->any_offers = $request->any_offers;
        $data->current_offer = $request->current_offer;
        $data->exchange_policy = $request->exchange_policy;
        $data->discount_offer = $request->discount_offer;
        $data->reward_point_given = $request->reward_point_given;
        $data->use_of_influencer = $request->use_of_influencer;
        $data->age_group_of_customer = $request->age_group_of_customer;
        $data->alteration_facility_in_store = $request->alteration_facility_in_store;
        $data->any_remarks_sale = $request->any_remarks_sale;
        $data->page_section_3 = $request->page_section_3;
        $data->sub_brand_offered = $request->sub_brand_offered;
        $data->colour_palette = $request->colour_palette;
        $data->number_of_colourways = $request->number_of_colourways;
        $data->size_availiblity = $request->size_availiblity;
        $data->engaging_price = $request->engaging_price;
        $data->merchadise_available = $request->merchadise_available;
        $data->types_of_fabric = $request->types_of_fabric;
        $data->prints_observed = $request->prints_observed;
        $data->embroideries_observed = $request->embroideries_observed;
        $data->quality_of_garments = $request->quality_of_garments;
        $data->remarks_on_product_observation = $request->remarks_on_product_observation;
        $data->page_section_4 = $request->page_section_4;
        $data->entrance_of_the_store = $request->entrance_of_the_store;
        $data->story_telling = $request->story_telling;
        $data->stock_display = $request->stock_display;
        $data->spacing_of_clothes = $request->spacing_of_clothes;
        $data->how_many_no_of_customers = $request->how_many_no_of_customers;
        $data->page_section_5 = $request->page_section_5;
        $data->brand_tagline = $request->brand_tagline;
        $data->type_of_ball = $request->type_of_ball;
        $data->page_section_6 = $request->page_section_6;
        $data->number_of_trial_rooms_ = $request->number_of_trial_rooms_;
        $data->hygiene_ = $request->hygiene_;
        $data->ventilation_ = $request->ventilation_;
        $data->queue_outside_the_trial_room = $request->queue_outside_the_trial_room;
        $data->mirror_size = $request->mirror_size;
        $data->trial_room_lighting = $request->trial_room_lighting;
        $data->trial_room_available = $request->trial_room_available;
        $data->seating_around_trial_room = $request->seating_around_trial_room;
        $data->cloth_hanger = $request->cloth_hanger;
        $data->any_remarks_on_the_trail_room = $request->any_remarks_on_the_trail_room;
        $data->comments_on_hte_overall_store = $request->comments_on_hte_overall_store;
        $data->save();

        //=========================================grid============================================

        $fieldvisit_id = $data->id;
        $newDataGridFiledVisit = FieldVisitGrid::where(['fv_id' => $fieldvisit_id, 'identifier' => 'details1'])->firstOrCreate();
        $newDataGridFiledVisit->fv_id = $fieldvisit_id;
        $newDataGridFiledVisit->identifier = 'details1';
        $newDataGridFiledVisit->data = $request->details1;
        $newDataGridFiledVisit->save();

        $fieldvisit_id = $data->id;
        $newDataGridFiledVisit = FieldVisitGrid::where(['fv_id' => $fieldvisit_id, 'identifier' => 'details2'])->firstOrCreate();
        $newDataGridFiledVisit->fv_id = $fieldvisit_id;
        $newDataGridFiledVisit->identifier = 'details2';
        $newDataGridFiledVisit->data = $request->details2;
        $newDataGridFiledVisit->save();

        //=========================================================================================

        return back();
    }

    public function show($id){
        $data = FieldVisit::find($id);
        $fieldvisit_id = $data->id;
        $grid_Data = FieldVisitGrid::where(['fv_id' => $fieldvisit_id, 'identifier' => 'details1'])->first();
        $grid_Data2 = FieldVisitGrid::where(['fv_id' => $fieldvisit_id, 'identifier' => 'details2'])->first();
         return view('frontend.field-visit.field_visit_view',compact('data','grid_Data','grid_Data2'));
    }


    public function update(Request $request, $id){

        $data = FieldVisit::find($id);
// dd($data);
        $data->date = $request->date;
        $data->time = $request->time;
        $data->brand_name = $request->brand_name;
        $data->field_visitor = $request->field_visitor;
        $data->region = $request->region;
        $data->exact_location = $request->exact_location;
        $data->exact_address = $request->exact_address;
        $data->page_section = $request->page_section;
        $data->photos = $request->photos;
        $data->store_lighting = $request->store_lighting;
        $data->lighting_products = $request->lighting_products;
        $data->store_vibe = $request->store_vibe;
        $data->fragrance_in_store = $request->fragrance_in_store;
        $data->music_inside_store = $request->music_inside_store;
        $data->space_utilization = $request->space_utilization;
        $data->store_layout = $request->store_layout;
        $data->floors = $request->floors;
        $data->ac = $request->ac;
        $data->mannequin_display = $request->mannequin_display;
        $data->seating_area = $request->seating_area;
        $data->product_visiblity = $request->product_visiblity;
        $data->store_signage = $request->store_signage;
        $data->independent_washroom = $request->independent_washroom;
        $data->any_remarks = $request->any_remarks;
        $data->page_section1 = $request->page_section1;
        $data->staff_behaviour = $request->staff_behaviour;
        $data->well_groomed = $request->well_groomed;
        $data->standard_staff_uniform = $request->standard_staff_uniform;
        $data->trial_room_assistance = $request->trial_room_assistance;
        $data->number_customer = $request->number_customer;
        $data->handel_customer = $request->handel_customer;
        $data->knowledge_of_merchandise = $request->knowledge_of_merchandise;
        $data->awareness_of_brand = $request->awareness_of_brand;
        $data->proactive = $request->proactive;
        $data->customer_satisfaction = $request->customer_satisfaction;
        $data->billing_counter_experience = $request->billing_counter_experience;
        $data->remarks_on_staff_observation = $request->remarks_on_staff_observation;
        $data->page_sacetion_2 = $request->page_sacetion_2;
        $data->any_offers = $request->any_offers;
        $data->current_offer = $request->current_offer;
        $data->exchange_policy = $request->exchange_policy;
        $data->discount_offer = $request->discount_offer;
        $data->reward_point_given = $request->reward_point_given;
        $data->use_of_influencer = $request->use_of_influencer;
        $data->age_group_of_customer = $request->age_group_of_customer;
        $data->alteration_facility_in_store = $request->alteration_facility_in_store;
        $data->any_remarks_sale = $request->any_remarks_sale;
        $data->page_section_3 = $request->page_section_3;
        $data->sub_brand_offered = $request->sub_brand_offered;
        $data->colour_palette = $request->colour_palette;
        $data->number_of_colourways = $request->number_of_colourways;
        $data->size_availiblity = $request->size_availiblity;
        $data->engaging_price = $request->engaging_price;
        $data->merchadise_available = $request->merchadise_available;
        $data->types_of_fabric = $request->types_of_fabric;
        $data->prints_observed = $request->prints_observed;
        $data->embroideries_observed = $request->embroideries_observed;
        $data->quality_of_garments = $request->quality_of_garments;
        $data->remarks_on_product_observation = $request->remarks_on_product_observation;
        $data->page_section_4 = $request->page_section_4;
        $data->entrance_of_the_store = $request->entrance_of_the_store;
        $data->story_telling = $request->story_telling;
        $data->stock_display = $request->stock_display;
        $data->spacing_of_clothes = $request->spacing_of_clothes;
        $data->how_many_no_of_customers = $request->how_many_no_of_customers;
        $data->page_section_5 = $request->page_section_5;
        $data->brand_tagline = $request->brand_tagline;
        $data->type_of_ball = $request->type_of_ball;
        $data->page_section_6 = $request->page_section_6;
        $data->number_of_trial_rooms_ = $request->number_of_trial_rooms_;
        $data->hygiene_ = $request->hygiene_;
        $data->ventilation_ = $request->ventilation_;
        $data->queue_outside_the_trial_room = $request->queue_outside_the_trial_room;
        $data->mirror_size = $request->mirror_size;
        $data->trial_room_lighting = $request->trial_room_lighting;
        $data->trial_room_available = $request->trial_room_available;
        $data->seating_around_trial_room = $request->seating_around_trial_room;
        $data->cloth_hanger = $request->cloth_hanger;
        $data->any_remarks_on_the_trail_room = $request->any_remarks_on_the_trail_room;
        $data->comments_on_hte_overall_store = $request->comments_on_hte_overall_store;
        $data->update();

                //=========================================grid============================================

                $fieldvisit_id = $data->id;
                $newDataGridFiledVisit = FieldVisitGrid::where(['fv_id' => $fieldvisit_id, 'identifier' => 'details1'])->firstOrCreate();
                $newDataGridFiledVisit->fv_id = $fieldvisit_id;
                $newDataGridFiledVisit->identifier = 'details1';
                $newDataGridFiledVisit->data = $request->details1;
                $newDataGridFiledVisit->save();

                $fieldvisit_id = $data->id;
                $newDataGridFiledVisit = FieldVisitGrid::where(['fv_id' => $fieldvisit_id, 'identifier' => 'details2'])->firstOrCreate();
                $newDataGridFiledVisit->fv_id = $fieldvisit_id;
                $newDataGridFiledVisit->identifier = 'details2';
                $newDataGridFiledVisit->data = $request->details2;
                $newDataGridFiledVisit->save();

                //=========================================================================================


        return back();
    }

    public function sendstage(Request $request,$id){
        try {
            if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
                $data = FieldVisit::find($id);
                // dd($data);
                $lastDocument = FieldVisit::find($id);

                if ($data->stage == 1) {

                    $data->stage = "2";
                    $data->status = "Pending Review";
                    $data->submit_by = Auth::user()->name;
                    $data->submit_on = Carbon::now()->format('d-M-Y');
                    $data->submit_comment = $request->comment;

                    // $history = new dataAuditTrail();
                    // $history->data_id = $id;
                    // $history->activity_type = 'Activity Log';
                    // $history->previous = "";
                    // $history->action='Submit';
                    // $history->current = $data->submit_by;
                    // $history->comment = $request->comment;
                    // $history->user_id = Auth::user()->id;
                    // $history->user_name = Auth::user()->name;
                    // $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    // $history->origin_state = $lastDocument->status;
                    // $history->change_to =   "HOD Review";
                    // $history->change_from = $lastDocument->status;
                    // $history->stage = 'Plan Proposed';
                    // $history->save();


                    // $list = Helpers::getHodUserList();
                    // foreach ($list as $u) {
                    //     if ($u->q_m_s_divisions_id == $data->division_id) {
                    //         $email = Helpers::getInitiatorEmail($u->user_id);
                    //         if ($email !== null) {

                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $data],
                    //                     function ($message) use ($email) {
                    //                         $message->to($email)
                    //                             ->subject("Activity Performed By " . Auth::user()->name);
                    //                     }
                    //                 );
                    //             } catch (\Exception $e) {
                    //                 //log error
                    //             }
                    //         }
                    //     }
                    // }

                    // $list = Helpers::getHeadoperationsUserList();
                    // foreach ($list as $u) {
                    //     if ($u->q_m_s_divisions_id == $data->division_id) {
                    //         $email = Helpers::getInitiatorEmail($u->user_id);
                    //         if ($email !== null) {

                    //             Mail::send(
                    //                 'mail.Categorymail',
                    //                 ['data' => $data],
                    //                 function ($message) use ($email) {
                    //                     $message->to($email)
                    //                         ->subject("Activity Performed By " . Auth::user()->name);
                    //                 }
                    //             );
                    //         }
                    //     }
                    // }
                    // dd($data);
                    $data->update();
                    return back();
                }
                if ($data->stage == 2) {
                    $data->stage = "3";
                    $data->status = "Close Done";
                    $data->pending_review_by = Auth::user()->name;
                    $data->pending_review_on = Carbon::now()->format('d-M-Y');
                    $data->pending_review_comment = $request->comment;

                    // $history = new dataAuditTrail();
                    // $history->data_id = $id;
                    // $history->activity_type = 'Activity Log';
                    // $history->previous = "";
                    // $history->current = $data->HOD_Review_Complete_By;
                    // $history->comment = $request->comment;
                    // $history->action= 'HOD Review Complete';
                    // $history->user_id = Auth::user()->id;
                    // $history->user_name = Auth::user()->name;
                    // $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    // $history->origin_state = $lastDocument->status;
                    // $history->change_to =   "QA Initial Review";
                    // $history->change_from = $lastDocument->status;
                    // $history->stage = 'Plan Approved';
                    // $history->save();

                    // dd($history->action);
                    // $list = Helpers::getQAUserList();
                    // foreach ($list as $u) {
                    //     if ($u->q_m_s_divisions_id == $data->division_id) {
                    //         $email = Helpers::getInitiatorEmail($u->user_id);
                    //         if ($email !== null) {
                    //             try {
                    //                 Mail::send(
                    //                     'mail.view-mail',
                    //                     ['data' => $data],
                    //                     function ($message) use ($email) {
                    //                         $message->to($email)
                    //                             ->subject("Activity Performed By " . Auth::user()->name);
                    //                     }
                    //                 );
                    //             } catch (\Exception $e) {
                    //                 //log error
                    //             }
                    //         }
                    //     }
                    // }


                    $data->update();
                    toastr()->success('Document Sent');
                    return back();
                }


            } else {
                toastr()->error('E-signature Not match');
                return back();
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function moreinforeject(Request $request, $id)
    {

        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            // return $request;
            $data = FieldVisit::find($id);
            $lastDocument = FieldVisit::find($id);
            $list = Helpers::getInitiatorUserList();


            if ($data->stage == 2) {

                $data->stage = "1";
                $data->status = "Opened";
                $data->review_completed_more_info_by = Auth::user()->name;
                $data->review_completed_more_info_on = Carbon::now()->format('d-M-Y');
                $data->review_completed_more_info_comment = $request->comment;

                $data->update();
                // $history = new dataHistory();
                // $history->type = "data";
                // $history->doc_id = $id;
                // $history->user_id = Auth::user()->id;
                // $history->user_name = Auth::user()->name;
                // $history->stage_id = $data->stage;
                // $history->status = "Opened";
                // foreach ($list as $u) {
                //     if ($u->q_m_s_divisions_id == $data->division_id) {
                //         $email = Helpers::getInitiatorEmail($u->user_id);
                //         if ($email !== null) {

                //             try {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $data],
                //                     function ($message) use ($email) {
                //                         $message->to($email)
                //                             ->subject("Activity Performed By " . Auth::user()->name);
                //                     }
                //                 );
                //             } catch (\Exception $e) {
                //                 //log error
                //             }
                //         }
                //     }
                // }
                // $history->save();

                toastr()->success('Document Sent');
                return back();
            }





        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function closecancel(Request $request, $id)
    {

        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            // return $request;
            $data = FieldVisit::find($id);
            $lastDocument = FieldVisit::find($id);
            $list = Helpers::getInitiatorUserList();


            if ($data->stage == 1) {

                $data->stage = "0";
                $data->status = "Opened";
                $data->close_cancel_by = Auth::user()->name;
                $data->close_cancel_on = Carbon::now()->format('d-M-Y');
                $data->close_cancel_comment = $request->comment;

                $data->update();
                // $history = new dataHistory();
                // $history->type = "data";
                // $history->doc_id = $id;
                // $history->user_id = Auth::user()->id;
                // $history->user_name = Auth::user()->name;
                // $history->stage_id = $data->stage;
                // $history->status = "Opened";
                // foreach ($list as $u) {
                //     if ($u->q_m_s_divisions_id == $data->division_id) {
                //         $email = Helpers::getInitiatorEmail($u->user_id);
                //         if ($email !== null) {

                //             try {
                //                 Mail::send(
                //                     'mail.view-mail',
                //                     ['data' => $data],
                //                     function ($message) use ($email) {
                //                         $message->to($email)
                //                             ->subject("Activity Performed By " . Auth::user()->name);
                //                     }
                //                 );
                //             } catch (\Exception $e) {
                //                 //log error
                //             }
                //         }
                //     }
                // }
                // $history->save();

                toastr()->success('Document Sent');
                return back();
            }





        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

}
