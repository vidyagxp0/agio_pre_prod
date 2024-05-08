<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Document;
use App\Models\Grouppermission;
use Helpers;
use App\Models\DocumentType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CabinateController extends Controller
{

    public function index(){
        if(Helpers::checkRoles(3)){
            $draft = Document::where('originator_id',Auth::user()->id)->where('stage',1)->get();
            $draft_count = count($draft);
            foreach($draft as $temp){
                $temp->originator = User::find($temp->originator_id);
                $temp->type = DocumentType::find($temp->doc_type);
            }
            $under_review = Document::where('originator_id',Auth::user()->id)->where('stage',2)->get();
            foreach($under_review as $temp){
                $temp->originator = User::find($temp->originator_id);
                $temp->type = DocumentType::find($temp->doc_type);
            }
            $reviewed = Document::where('originator_id',Auth::user()->id)->where('stage',3)->get();
            foreach($reviewed as $temp){
                $temp->originator = User::find($temp->originator_id);
                $temp->type = DocumentType::find($temp->doc_type);
            }
            $under_approval = Document::where('originator_id',Auth::user()->id)->where('stage',4)->get();
            foreach($under_approval as $temp){
                $temp->originator = User::find($temp->originator_id);
                $temp->type = DocumentType::find($temp->doc_type);
            }
            $approved = Document::where('originator_id',Auth::user()->id)->where('stage',5)->get();
            foreach($approved as $temp){
                $temp->originator = User::find($temp->originator_id);
                $temp->type = DocumentType::find($temp->doc_type);
            }
            $effective = Document::where('originator_id',Auth::user()->id)->where('stage',8)->get();
            foreach($effective as $temp){
                $temp->originator = User::find($temp->originator_id);
                $temp->type = DocumentType::find($temp->doc_type);
            }
            return view('frontend.mydms',compact('draft','under_review','reviewed','under_approval','approved','effective','draft_count'));
        }
        if(Helpers::checkRoles(2)){
            $array1=[];
            $array2=[];
            $document = Document::where('stage', '>=', 2)->get();

            foreach($document as $data){
                $data->originator_name = User::where('id',$data->originator_id)->value('name');
                if($data->reviewers_group){
                    $datauser = explode(',',$data->reviewers_group);
                    for($i=0; $i<count($datauser); $i++){
                        $group = Grouppermission::where('id', $datauser[$i])->value('user_ids');
                        $ids = explode(',',$group);
                        for($j=0; $j<count($ids); $j++){
                            if($ids[$j]== Auth::user()->id){
                                array_push($array1,$data);
                            }
                        }
                    }
                }
                if($data->reviewers){
                    $datauser = explode(',',$data->reviewers);
                    for($i=0; $i<count($datauser); $i++){
                        if($datauser[$i]== Auth::user()->id){
                            array_push($array2,$data);
                        }
                    }
                }

            }
            $arrayTask =array_unique(array_merge($array1,$array2)) ;
            $draft = 0;
            $under_review =0;
            $reviewed = 0;
            $for_approval = 0;
            $effective = 0;
            foreach($arrayTask as $text){
                $text->originator = User::find($text->originator_id);
                if($text->stage == 1){
                    $draft ++ ;
                }
                if($text->stage == 2){
                    $under_review ++ ;
                }
                if($text->stage == 3){
                    $reviewed ++ ;
                }
                if($text->stage == 4){
                    $for_approval ++ ;
                }
                if($text->stage == 8){
                    $effective ++ ;
                }
            }

           return view('frontend.mydms',['task' =>$arrayTask, $draft, $under_review, $reviewed, $for_approval, $effective]);
        }
        if(Helpers::checkRoles(1)){
            $array1=[];
            $array2=[];
            $document = Document::where('stage', '>=', 4)->get();
            foreach($document as $data){
                $data->originator_name = User::where('id',$data->originator_id)->value('name');
                if($data->approver_group){
                    $datauser = explode(',',$data->approver_group);
                    for($i=0; $i<count($datauser); $i++){
                        $group = Grouppermission::where('id', $datauser[$i])->value('user_ids');
                        $ids = explode(',',$group);
                        for($j=0; $j<count($ids); $j++){
                            if($ids[$j]== Auth::user()->id){
                                array_push($array1,$data);
                            }
                        }
                    }
                }
                if($data->approvers){
                    $datauser = explode(',',$data->approvers);
                    for($i=0; $i<count($datauser); $i++){
                        if($datauser[$i]== Auth::user()->id){
                            array_push($array2,$data);
                        }
                    }
                }

            }
         $arrayTask =array_unique(array_merge($array1,$array2)) ;
         $draft = 0;
         $under_review =0;
         $reviewed = 0;
         $for_approval = 0;
         $effective = 0;
         foreach($arrayTask as $text){
             $text->originator = User::find($text->originator_id);
             if($text->stage == 1){
                 $draft ++ ;
             }
             if($text->stage == 2){
                 $under_review ++ ;
             }
             if($text->stage == 3){
                 $reviewed ++ ;
             }
             if($text->stage == 4){
                 $for_approval ++ ;
             }
             if($text->stage == 8){
                 $effective ++ ;
             }
         }

         return view('frontend.mydms',['task' =>$arrayTask,'draft' => $draft, 'under_review' => $under_review, $reviewed, $for_approval, $effective]);
        }
    }

    public function originator(){
            $draft = Document::where('originator_id',Auth::user()->id)->where('stage',1)->get();
            $draft_count = count($draft);
            foreach($draft as $temp){
                $temp->originator = User::find($temp->originator_id);
                $temp->type = DocumentType::find($temp->doc_type);
            }
            $under_review = Document::where('originator_id',Auth::user()->id)->where('stage',2)->get();
            foreach($under_review as $temp){
                $temp->originator = User::find($temp->originator_id);
                $temp->type = DocumentType::find($temp->doc_type);
            }
            $reviewed = Document::where('originator_id',Auth::user()->id)->where('stage',3)->get();
            foreach($reviewed as $temp){
                $temp->originator = User::find($temp->originator_id);
                $temp->type = DocumentType::find($temp->doc_type);
            }
            $under_approval = Document::where('originator_id',Auth::user()->id)->where('stage',4)->get();
            foreach($under_approval as $temp){
                $temp->originator = User::find($temp->originator_id);
                $temp->type = DocumentType::find($temp->doc_type);
            }
            $approved = Document::where('originator_id',Auth::user()->id)->where('stage',5)->get();
            foreach($approved as $temp){
                $temp->originator = User::find($temp->originator_id);
                $temp->type = DocumentType::find($temp->doc_type);
            }
            $effective = Document::where('originator_id',Auth::user()->id)->where('stage',8)->get();
            foreach($effective as $temp){
                $temp->originator = User::find($temp->originator_id);
                $temp->type = DocumentType::find($temp->doc_type);
            }
            return view('frontend.mydms',compact('draft','under_review','reviewed','under_approval','approved','effective','draft_count'));
    }
    public function reviewer(){

            $array1=[];
            $array2=[];
            $document = Document::where('stage', '>=', 2)->get();

            foreach($document as $data){
                $data->originator_name = User::where('id',$data->originator_id)->value('name');
                if($data->reviewers_group){
                    $datauser = explode(',',$data->reviewers_group);
                    for($i=0; $i<count($datauser); $i++){
                        $group = Grouppermission::where('id', $datauser[$i])->value('user_ids');
                        $ids = explode(',',$group);
                        for($j=0; $j<count($ids); $j++){
                            if($ids[$j]== Auth::user()->id){
                                array_push($array1,$data);
                            }
                        }
                    }
                }
                if($data->reviewers){
                    $datauser = explode(',',$data->reviewers);
                    for($i=0; $i<count($datauser); $i++){
                        if($datauser[$i]== Auth::user()->id){
                            array_push($array2,$data);
                        }
                    }
                }

            }
            $arrayTask =array_unique(array_merge($array1,$array2)) ;
            $draft = 0;
            $under_review =0;
            $reviewed = 0;
            $for_approval = 0;
            $effective = 0;
            foreach($arrayTask as $text){
                $text->originator = User::find($text->originator_id);
                if($text->stage == 1){
                    $draft ++ ;
                }
                if($text->stage == 2){
                    $under_review ++ ;
                }
                if($text->stage == 3){
                    $reviewed ++ ;
                }
                if($text->stage == 4){
                    $for_approval ++ ;
                }
                if($text->stage == 8){
                    $effective ++ ;
                }
            }

           return view('frontend.mydms',['task' =>$arrayTask, $draft, $under_review, $reviewed, $for_approval, $effective]);
    }

    public function approver(){
            $array1=[];
            $array2=[];
            $document = Document::where('stage', '>=', 4)->get();
            foreach($document as $data){
                $data->originator_name = User::where('id',$data->originator_id)->value('name');
                if($data->approver_group){
                    $datauser = explode(',',$data->approver_group);
                    for($i=0; $i<count($datauser); $i++){
                        $group = Grouppermission::where('id', $datauser[$i])->value('user_ids');
                        $ids = explode(',',$group);
                        for($j=0; $j<count($ids); $j++){
                            if($ids[$j]== Auth::user()->id){
                                array_push($array1,$data);
                            }
                        }
                    }
                }
                if($data->approvers){
                    $datauser = explode(',',$data->approvers);
                    for($i=0; $i<count($datauser); $i++){
                        if($datauser[$i]== Auth::user()->id){
                            array_push($array2,$data);
                        }
                    }
                }

            }
         $arrayTask =array_unique(array_merge($array1,$array2)) ;
         $draft = 0;
         $under_review =0;
         $reviewed = 0;
         $for_approval = 0;
         $effective = 0;
         foreach($arrayTask as $text){
             $text->originator = User::find($text->originator_id);
             if($text->stage == 1){
                 $draft ++ ;
             }
             if($text->stage == 2){
                 $under_review ++ ;
             }
             if($text->stage == 3){
                 $reviewed ++ ;
             }
             if($text->stage == 4){
                 $for_approval ++ ;
             }
             if($text->stage == 8){
                 $effective ++ ;
             }
         }

         return view('frontend.mydms',['task' =>$arrayTask,'draft' => $draft, 'under_review' => $under_review, $reviewed, $for_approval, $effective]);

    }

    public function email(){
        $data = "data";
            Mail::send('demo-mail',['data' => $data],
            function ($message) {
                    $message->to('amit.guru@mydemosoftware.com')
                            ->subject('Subscribe button testing !!');
            });
            return "mail sent";
    }
}
