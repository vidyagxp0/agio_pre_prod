<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Document;
use App\Models\Department;
use App\Models\Training;
use App\Models\QMSDivision;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\DocumentType;
use App\Models\Division;
use App\Models\UserRole;
use App\Models\DocumentTraining;
use App\Http\Controllers\Controller;
use App\Models\DocumentHistory;
use App\Models\Question;
use App\Models\Quize;
use App\Models\RoleGroup;
use App\Models\TrainingAudit;
use App\Models\TrainingHistory;
use App\Models\TrainingStatus;
use App\Models\Employee;
use App\Models\TrainerQualification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Helpers;

class TMSController extends Controller
{
    public function index(){

        // return dd(Helpers::checkRoles(6));

        if(Helpers::checkRoles(6)){
            $documents = DocumentTraining::where('trainer', Auth::user()->id)->with('root_document')->orderByDesc('id')->get();
           if($documents){
               foreach($documents as $temp){

                $temp->training = Document::find($temp->document_id);
                if($temp->training){
                    $temp->document_type_name = DocumentType::where('id',$temp->training->document_type_id)->value('name');
                    $temp->typecode = DocumentType::where('id',$temp->training->document_type_id)->value('typecode');
                    // $temp->division_name = QMSDivision::where('id',$temp->training->id)->value('name');
                    // $temp->division_name= {{ Helpers::getDivisionName($_GET['id'])}
                    $temp->division_name = Helpers::getDivisionName( $temp->training->division_id);
                    $temp->year = Carbon::parse($temp->training->created_at)->format('Y');
                    $temp->major = $temp->training->major;
                    $temp->minor = $temp->training->minor;


                }


            }
           }

            $due = DocumentTraining::where('trainer',Auth::user()->id)->where('status',"Past-due")->orderByDesc('id')->get();
            if(!empty($due)){
                foreach($due as $temp){
                $temp->training = Document::find($temp->document_id);
                if($temp->training){
                $temp->document_type_name = DocumentType::where('id',$temp->training->document_type_id)->value('name');
                $temp->typecode = DocumentType::where('id',$temp->training->document_type_id)->value('typecode');
                // $temp->division_name = QMSDivision::where('id',$temp->training->id)->value('name');
                $temp->division_name = Helpers::getDivisionName($temp->training->id);
                }
            }

            }

            $pending = DocumentTraining::where('trainer',Auth::user()->id)->where('status',"Pending")->orderByDesc('id')->get();
            if($pending){
                foreach($pending as $temp){

                $temp->training = Document::find($temp->document_id);
                 if($temp->training){
                $temp->document_type_name = DocumentType::where('id',$temp->training->document_type_id)->value('name');
                $temp->typecode = DocumentType::where('id',$temp->training->document_type_id)->value('typecode');
                // $temp->division_name = QMSDivision::where('id',$temp->training->division_id)->value('name');
                $temp->division_name = Helpers::getDivisionName($temp->training->id);
                 }
            }


            }

            $complete = DocumentTraining::where('trainer',Auth::user()->id)->where('status',"Complete")->orderByDesc('id')->get();
            if($complete){
                 foreach($complete as $temp){

                $temp->training = Document::find($temp->document_id);
                 if($temp->training){
                $temp->document_type_name = DocumentType::where('id',$temp->training->document_type_id)->value('name');
                $temp->typecode = DocumentType::where('id',$temp->training->document_type_id)->value('typecode');
                // $temp->division_name = QMSDivision::where('id',$temp->training->id)->value('name');
                $temp->division_name = Helpers::getDivisionName($temp->training->id);
                 }
            }
            }

            $documents2 =[];
            if (Helpers::checkRoles(1) || Helpers::checkRoles(2) || Helpers::checkRoles(3) || Helpers::checkRoles(4)|| Helpers::checkRoles(5) || Helpers::checkRoles(7) || Helpers::checkRoles(8))
            {
                $train = [];

           $training = Training::all();
           foreach($training as $temp){
           $data = explode(',',$temp->trainees);
           if(count($data) > 0){
            foreach($data as $datas){
                if($datas == Auth::user()->id){
                    array_push($train,$temp);
                }
            }
           }
           }

           if(count($train)>0){
            foreach($train as $temp){
                $explode = explode(',',$temp->sops);
                foreach($explode as $data_temp){
                    $doc = Document::find($data_temp);
                    array_push($documents2,$doc);
                }
            }
           }
           if(!empty($documents2)){
            foreach($documents2 as $temp){
                if($temp){
                    $temp->traningstatus = DocumentTraining::where('document_id',$temp->id)->first();

                }
            }
           }
            }

            $employees = Employee::get();
            // dd($employees);

            $trainers = TrainerQualification::get();
            // dd($trainers);
            return view('frontend.TMS.dashboard', compact('documents2','documents','due','pending','complete', 'employees', 'trainers'));
        }
        else{
            $train = [];

           $training = Training::all();
           foreach($training as $temp){
           $data = explode(',',$temp->trainees);
           if(count($data) > 0){
            foreach($data as $datas){
                if($datas == Auth::user()->id){
                    array_push($train,$temp);
                }
            }
           }
           }
           $documents =[];
           if(count($train)>0){
            foreach($train as $temp){
                $explode = explode(',',$temp->sops);
                foreach($explode as $data_temp){
                    $doc = Document::find($data_temp);
                    array_push($documents,$doc);
                }
            }
           }
           if(!empty($documents)){
            foreach($documents as $temp){
                if($temp){
                    $temp->traningstatus = DocumentTraining::where('document_id',$temp->id)->first();

                }
            }
           }
           $documents2 =$documents;
           return view('frontend.TMS.dashboard',compact('documents','documents2'));

        }
    }
    public function create(){
        if(Helpers::checkRoles(6) || Helpers::checkRoles(3)){

            $quize = Quize::where('trainer_id', Auth::user()->id)->get();
            $due = DocumentTraining::where('trainer', Auth::user()->id)->whereIn('status', ["Past-due", 'Assigned', 'Complete'])->get();
            $traineesPerson = UserRole::where(['q_m_s_roles_id' => 6])->distinct()->pluck('user_id');

            foreach($due as $temp){
                $temp->training = Document::find($temp->document_id);
                if($temp->training){
                    $temp->originator = User::where('id',$temp->training->originator_id)->value('name');
                    $temp->document_type_name = DocumentType::where('id',$temp->training->document_type_id)->value('name');
                    $temp->typecode = DocumentType::where('id',$temp->training->document_type_id)->value('typecode');
                    // $temp->division_name = QMSDivision::where('id',$temp->training->division_id)->value('name');
                    $temp->division_name = Helpers::getDivisionName($temp->training->division_id);
                    $temp->major = $temp->training->major;
                    $temp->minor = $temp->training->minor;
                    $temp->year = Carbon::parse($temp->training->created_at)->format('Y');
                }
            }

            $users = User::where('role', '!=', 6)->get();

            foreach($users as $data){
                $data->department = Department::where('id',$data->departmentid)->value('name');
            }

            return view('frontend.TMS.create-training',compact('due','users','quize', 'traineesPerson'));
        }else{
            abort(404);
        }
    }
    public function store(Request $request){
        if(Helpers::checkRoles(6)){
            $this->validate($request,[
                'traning_plan_name' =>'required|unique:trainings,traning_plan_name',
                'training_plan_type'=>'required',
                'effective_criteria'=>'required',
                'sops'=>'required',
                'trainees'=>'required',
              ]);
            $training = new Training();
            $training->trainner_id = Auth::user()->id;
            $training->traning_plan_name = $request->traning_plan_name;
            $training->training_plan_type = $request->training_plan_type;
            $training->effective_criteria = $request->effective_criteria;
            $training->trainee_criteria = $request->trainee_criteria;
            $training->quize = $request->quize;
            $training->training_start_date = $request->training_start_date;
            $training->training_end_date = $request->training_end_date;
            $training->assessment_required = $request->assessment_required;
            $training->desc = $request->desc;

            $training->sops = !empty($request->sops) ? implode(',', $request->sops) : '';
            $training->classRoom_training = !empty($request->classRoom_training) ? implode(',', $request->classRoom_training) : '';
            $training->trainees = !empty($request->trainees) ? implode(',', $request->trainees) : '';

            if (!empty($request->training_attachment) && $request->file('training_attachment')) {
                $files = [];
                foreach ($request->file('training_attachment') as $file) {
                    $name = $request->traning_plan_name . 'training_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] =  $name; // Store the file path
                }
                // Save the file paths in the database
                $training->training_attachment = json_encode($files);
            }

            $training->save();
            $TrainingHistory = new TrainingHistory();
            $TrainingHistory->plan_id = $training->id;
            $TrainingHistory->sop_id = $training->sops;
            $TrainingHistory->activity_type = "Training plan created !";
            $TrainingHistory->previous = "Null";
            $TrainingHistory->current = $training->traning_plan_name;
            $TrainingHistory->comment = $request->document_name_comment;
            $TrainingHistory->user_id = Auth::user()->id;
            $TrainingHistory->user_name = Auth::user()->name;
            $TrainingHistory->origin_state = "Assigned";
            $TrainingHistory->save();


            foreach($request->sops as $data){
                $sop =  DocumentTraining::where('document_id',$data)->first();
                $sop->status = "Assigned";
                $sop->training_plan = $training->id;
                $sop->update();
                $history = new DocumentHistory();
                $history->document_id = $data;
                $history->activity_type = "Training Assigned";
                $history->previous = "No training plan";
                $history->current = $training->training_plan_name;
                $history->comment = "Training Assigned by training coordinator " . Auth::user()->name;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = "Pending-Training";
                $history->save();

            }
            foreach($request->trainees as $trainee){
                $user = User::find($trainee);
                try {
                    Mail::send('mail.assign-training', ['document' => $training],
                      function ($message) use ($user) {
                              $message->to($user->email)
                              ->subject("Training is assigned to you.");

                      });
                } catch (\Exception $e) {
                    // log later on
                }
            }
            toastr()->success('Training Plan created successfully');
            return redirect('TMS/show');
        }
    }
    public function show(){
        if(Helpers::checkRoles(6)){
            $trainning = Training::where('trainner_id',Auth::user()->id)->get();
            return view('frontend.TMS.manage-training',compact('trainning'));
        }
    }
    public function viewTraining($id,$sopId){
        $doc = Document::find($sopId);
        if(Helpers::checkRoles(6)){
            if (Helpers::checkRoles(1) || Helpers::checkRoles(2) || Helpers::checkRoles(3) || Helpers::checkRoles(4)|| Helpers::checkRoles(5) || Helpers::checkRoles(7) || Helpers::checkRoles(8))
            {
                $trainning = Training::find($id);
                $trainning->trainer = User::find($trainning->trainner_id);
                if(!empty($trainning->trainer)){
                    return view('frontend.TMS.document-view',compact('trainning','sopId', 'doc'));
                }

            }
            $trainning = Training::where('trainner_id',Auth::user()->id)->get();
            return view('frontend.TMS.manage-training',compact('trainning', 'doc'));
        }
        else{
            $trainning = Training::find($id);
            $trainning->trainer = User::find($trainning->trainner_id);
            return view('frontend.TMS.document-view',compact('trainning','sopId', 'doc'));
        }
    }
    public function training($id){

       $document = Document::find($id);
       $document_training = DocumentTraining::where('document_id',$id)->first();
       $training = Training::find($document_training->training_plan);
       $countAudit = TrainingAudit::where('trainee_id',Auth::user()->id)->where('sop_id',$id)->count();
       $audit = new TrainingAudit();
       $audit->trainee_id = Auth::user()->id;
       $audit->training_id = $document_training->training_plan;
       $audit->sop_id = $id;
       $audit->save();
       if($countAudit <= 2000 ){
            $TrainingHistory = new TrainingHistory();
            $TrainingHistory->plan_id = $training->id;
            $TrainingHistory->sop_id = $id;
            $TrainingHistory->activity_type = "Training Attempts of SOP " .$document->document_name;
            $TrainingHistory->previous = "SOP" .$training->status;
            $TrainingHistory->current ="Training Attempts of SOP " .$document->document_name;
            $TrainingHistory->comment = "NULL";
            $TrainingHistory->user_id = Auth::user()->id;
            $TrainingHistory->user_name = Auth::user()->name;
            $TrainingHistory->origin_state = "Assigned";
            $TrainingHistory->save();

        return view('frontend.TMS.training-page',compact('document','training'));
       }
       else{
        toastr()->warning('Your max attempts limit is breached');
        return back();
       }
    //    elseif($training->training_plan_type == "Read & Understand with Questions"){
    //     $quize = Quize::find($training->quize);
    //     $data = explode(',',$quize->question);
    //     $array = [];

    //     for($i = 0; $i<count($data); $i++){
    //         $question = Question::find($data[$i]);
    //         $question->id = $i+1;
    //         $json_option = unserialize($question->options);
    //         $options = [];
    //         foreach($json_option as $key => $value){
    //             $options[chr(97 + $key)] = $value;
    //         }
    //         $question->options = array($options);
    //         $ans = unserialize($question->answers);
    //         $question->answers = implode("", $ans);
    //         $question->score = 0;
    //         $question->status = "";
    //         // $json_answer = unserialize($question->answers);
    //         // $answers = [];
    //         // foreach($json_answer as $key => $value){
    //         //     $answers[chr(97 + $key)] = $value;
    //         // }
    //         // $question->answers = array($answers);
    //         array_push($array,$question);
    //     }
    //    $data_array = implode(',',$array);

    //     return view('frontend.TMS.question-training',compact('document','data_array','quize'));


    //    }

    }
    public function trainingQuestion($id){
        $document = Document::find($id);
        $document_training = DocumentTraining::where('document_id',$id)->first();
        $training = Training::find($document_training->training_plan);
        if($training->training_plan_type == "Read & Understand with Questions"){
            $quize = Quize::find($training->quize);
            $data = explode(',',$quize->question);
            $array = [];

            for($i = 0; $i<count($data); $i++){
                $question = Question::find($data[$i]);
                $question->id = $i+1;
                $json_option = unserialize($question->options);
                $options = [];
                foreach($json_option as $key => $value){
                    $options[chr(97 + $key)] = $value;
                }
                $question->options = array($options);
                $ans = unserialize($question->answers);
                $question->answers = implode("", $ans);
                $question->score = 0;
                $question->status = "";
                // $json_answer = unserialize($question->answers);
                // $answers = [];
                // foreach($json_answer as $key => $value){
                //     $answers[chr(97 + $key)] = $value;
                // }
                // $question->answers = array($answers);
                array_push($array,$question);
            }
             $data_array = implode(',',$array);

            return view('frontend.TMS.example',compact('document','data_array','quize'));


       }
       else{
        toastr()->error('Training not specified');
        return back();
       }
    }

    // public function trainingSubmitData(Request $request,$id){


    // }
    public function trainingStatus(Request $request,$id){

        if(Auth::user()->email == $request->email && Hash::check($request->password,Auth::user()->password)){
            $document = DocumentTraining::where('document_id',$id)->first();
            $document->train = Training::find($document->training_plan);
            $trainingStatus = new TrainingStatus();
            $trainingStatus->user_id = Auth::user()->id;
            $trainingStatus->sop_id = $id;
            $trainingStatus->training_id = $document->training_plan;
            $trainingStatus->status = "Complete";
            $trainingStatus->save();
            $TrainingHistory = new TrainingHistory();
            $TrainingHistory->plan_id =  $document->training_plan;
            $TrainingHistory->sop_id =  $id;
            $TrainingHistory->activity_type = "Training Complete by " . Auth::user()->name;
            $TrainingHistory->previous = "Assigned";
            $TrainingHistory->current ="Complete";
            $TrainingHistory->comment = "NULL";
            $TrainingHistory->user_id = Auth::user()->id;
            $TrainingHistory->user_name = Auth::user()->name;
            $TrainingHistory->origin_state = "Assigned";
            $TrainingHistory->save();
            $history = new DocumentHistory();
            $history->document_id = $id;
            $history->activity_type = "Training Complete";
            $history->previous ="Training pending";
            $history->current = "Training Completed by " .Auth::user()->name;
            $history->comment = "Training Completed by " .Auth::user()->name;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = "Pending-Training";
            $history->save();
            $criteria = $this->effective($id);
            if(count(TrainingStatus::where('sop_id',$id)->where('training_id',$document->training_plan)->where('status',"Complete")->get()) >= $criteria){
                $document = DocumentTraining::where('document_id',$id)->first();
                $document->status = "Complete";
                $document->update();
                $history = new DocumentHistory();
                $history->document_id = $id;
                $history->activity_type = "Training Complete";
                $history->previous ="Training pending";
                $history->current = "Training Completed by " ."All trainees";
                $history->comment = "Training Completed by " ."All trainees";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = "Pending-Training";
                $history->save();
                $TrainingHistory = new TrainingHistory();
                $TrainingHistory->plan_id =  $document->training_plan;
                $TrainingHistory->sop_id =  $id;
                $TrainingHistory->activity_type = "Training Complete for one Document ";
                $TrainingHistory->previous = "Assigned";
                $TrainingHistory->current ="Complete";
                $TrainingHistory->comment = "NULL";
                $TrainingHistory->user_id = Auth::user()->id;
                $TrainingHistory->user_name = Auth::user()->name;
                $TrainingHistory->origin_state = "Assigned";
                $TrainingHistory->save();
                $document->doc = Document::find($id);
                $document->doc->stage = 10;
                $document->doc->status = "Effective";
                $document->doc->update();
                $user_data = User::find($document->doc->originator_id);
                try {
                    Mail::send('mail.complete-training', ['document' => $document],
                      function ($message) use ($user_data) {
                              $message->to($user_data->email)
                              ->subject("Training is Completed.");

                      });
                } catch (\Exception $e) {
                    // log
                }

                try {
                    Mail::send('mail.effective', ['document' => $document],
                    function ($message) use ($user_data) {
                            $message->to($user_data->email)
                            ->subject("Document Effective Now.");
                    });
                } catch (\Exception $e) {
                    // log
                }

                $doc = Training::find($document->training_plan);
                $sop = explode(',',$doc->sops);

                if(count($sop) > 0){
                    $trainingArray = [];
                    foreach($sop as $sops){
                        $documentTrain = DocumentTraining::where('document_id',$sops)->where('status',"Complete")->first();
                        array_push($trainingArray,$documentTrain);
                    }
                    if(count($trainingArray) == count($sop)){
                        $document->train = Training::find($document->training_plan);
                        $document->train->status = "Complete";
                        $document->train->update();
                        $user = User::find($document->train->trainner_id);
                        try {
                            Mail::send('mail.training', ['document' => $document],
                              function ($message) use ($user) {
                                      $message->to($user->email)
                                      ->subject("Training is Completed.");

                              });
                        } catch (\Exception $e) {
                            //
                        }
                              $TrainingHistory = new TrainingHistory();
                              $TrainingHistory->plan_id =  $document->training_plan;
                              $TrainingHistory->sop_id =  $document->train->sops;
                              $TrainingHistory->activity_type = "Training Complete for all SOPs";
                              $TrainingHistory->previous = "Assigned";
                              $TrainingHistory->current ="Complete";
                              $TrainingHistory->comment = "NULL";
                              $TrainingHistory->user_id = Auth::user()->id;
                              $TrainingHistory->user_name = Auth::user()->name;
                              $TrainingHistory->origin_state = "Assigned";
                              $TrainingHistory->save();
                    }
                }
                toastr()->success('Training Complete Successfully !!');
                return redirect()->route('TMS.index');
            }
            else{
                $user = User::find($document->train->trainner_id);
                 try {
                    Mail::send('mail.training', ['document' => $document],
                    function ($message) use ($user) {
                            $message->to($user->email)
                            ->subject("Training is Completed by ".Auth::user()->name. " .");

                    });
                 } catch (\Exception $e) {
                    //
                 }
                  toastr()->success('Training Complete Successfully !!');
                  return redirect()->route('TMS.index');
            }



        }
        else{
            toastr()->error('E-signature not match');
            return back();
        }

     }

     public function effective($id){
        $documentTraining = DocumentTraining::where('document_id', $id)->first();
        $training = Training::find($documentTraining->training_plan);

        $trainees = explode(',',$training->trainees);
        $criteria = (count($trainees) * ($training->effective_criteria)/100);
        return $criteria;
     }

     public function notification($id){
        $document = Training::find($id);
        $document->trainner_id = User::where('id',$document->trainner_id)->first();
        $document->trainees = explode(',',$document->trainees);
        return view('frontend.training-notification',compact('document'));
    }



    public function edit($id){
        $train = Training::find($id);
        $traineesPerson = UserRole::where(['q_m_s_roles_id' => 6])->distinct()->pluck('user_id');

        if(Helpers::checkRoles(6)){

            $quize = Quize::where('trainer_id', Auth::user()->id)->get();
            $due = DocumentTraining::where('trainer',Auth::user()->id)->where('status',"Past-due")->get();
            foreach($due as $temp){
                $temp->training = Document::find($temp->document_id);
                if($temp->training){
                $temp->originator = User::where('id',$temp->training->originator_id)->value('name');
                $temp->document_type_name = DocumentType::where('id',$temp->training->document_type_id)->value('name');
                $temp->typecode = DocumentType::where('id',$temp->training->document_type_id)->value('typecode');
                // $temp->division_name = QMSDivision::where('id',$temp->training->division_id)->value('name');
                $temp->division_name = Helpers::getDivisionName($temp->training->id);

                }
            }
            $users = User::where('role', '!=', 6)->get();
            foreach($users as $data){
                $data->department = Department::where('id',$data->departmentid)->value('name');
            }
            return view('frontend.TMS.edit-training',compact('due','users','quize','train', 'traineesPerson'));
        }
    }

    public function update(Request $request, $id){
        $last = Training::find($id);
        if(Helpers::checkRoles(6)){
            $this->validate($request,[
                'traning_plan_name' =>'required|unique:trainings,traning_plan_name',
                'training_plan_type'=>'required',
                'effective_criteria'=>'required',
              ]);
            $training = Training::find($id);
            $training->trainner_id = Auth::user()->id;
            $training->traning_plan_name = $request->traning_plan_name;
            $training->training_plan_type = $request->training_plan_type;
            $training->effective_criteria = $request->effective_criteria;
            $training->trainee_criteria = $request->trainee_criteria;
            $training->quize = $request->quize;
            $training->training_start_date = $request->training_start_date;
            $training->training_end_date = $request->training_end_date;
            $training->assessment_required = $request->assessment_required;
            // $training->sops = implode(',',$request->sops);
            // $training->classRoom_training = implode(',',$request->classRoom_training);
            // $training->trainees = implode(',',$request->trainees);
            if($request->classRoom_training){
                $training->classRoom_training = implode(',',$request->classRoom_training);
            }
            if($request->sops){
                $training->sops = implode(',',$request->sops);
            }
            if($request->trainees){
                $training->trainees = implode(',',$request->trainees);
            }
            if (!empty ($request->training_attachment)) {
                $files = [];

                if ($training->training_attachment) {
                    $files = is_array(json_decode($training->training_attachment)) ? $training->training_attachment : [];
                }

                if ($request->hasfile('training_attachment')) {
                    foreach ($request->file('training_attachment') as $file) {
                        $name = $request->traning_plan_name . 'training_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $file->move('upload/', $name);
                        $files[] = $name;
                    }
                }
                $training->training_attachment = json_encode($files);
            }
            $training->save();
            if($training->traning_plan_name !== $last->traning_plan_name || !empty($request->traning_plan_comment)){
                $TrainingHistory = new TrainingHistory();
                $TrainingHistory->plan_id = $training->id;
                $TrainingHistory->sop_id = $training->sops;
                $TrainingHistory->activity_type = "Training plan Name";
                $TrainingHistory->previous = $last->traning_plan_name;
                $TrainingHistory->current = $training->traning_plan_name;
                $TrainingHistory->comment = $request->traning_plan_comment;
                $TrainingHistory->user_id = Auth::user()->id;
                $TrainingHistory->user_name = Auth::user()->name;
                $TrainingHistory->origin_state = "Assigned";
                $TrainingHistory->save();
            }
            if($training->training_plan_type !== $last->training_plan_type || !empty($request->training_plan_type_comment)){
                $TrainingHistory = new TrainingHistory();
                $TrainingHistory->plan_id = $training->id;
                $TrainingHistory->sop_id = $training->sops;
                $TrainingHistory->activity_type = "Training plan Type";
                $TrainingHistory->previous = $last->training_plan_type;
                $TrainingHistory->current = $training->training_plan_type;
                $TrainingHistory->comment = $request->training_plan_type_comment;
                $TrainingHistory->user_id = Auth::user()->id;
                $TrainingHistory->user_name = Auth::user()->name;
                $TrainingHistory->origin_state = "Assigned";
                $TrainingHistory->save();
            }
            if($training->effective_criteria !== $last->effective_criteria || !empty($request->effective_criteria_comment)){
                $TrainingHistory = new TrainingHistory();
                $TrainingHistory->plan_id = $training->id;
                $TrainingHistory->sop_id = $training->sops;
                $TrainingHistory->activity_type = "Effective criteria";
                $TrainingHistory->previous = $last->effective_criteria;
                $TrainingHistory->current = $training->effective_criteria;
                $TrainingHistory->comment = $request->effective_criteria_comment;
                $TrainingHistory->user_id = Auth::user()->id;
                $TrainingHistory->user_name = Auth::user()->name;
                $TrainingHistory->origin_state = "Assigned";
                $TrainingHistory->save();
            }

            if($training->quize !== $last->quize || !empty($request->quize_comment)){
                $TrainingHistory = new TrainingHistory();
                $TrainingHistory->plan_id = $training->id;
                $TrainingHistory->sop_id = $training->sops;
                $TrainingHistory->activity_type = "Quize";
                $TrainingHistory->previous = $last->quize;
                $TrainingHistory->current = $training->quize;
                $TrainingHistory->comment = $request->quize_comment;
                $TrainingHistory->user_id = Auth::user()->id;
                $TrainingHistory->user_name = Auth::user()->name;
                $TrainingHistory->origin_state = "Assigned";
                $TrainingHistory->save();
            }

            if($training->sops !== $last->sops || !empty($request->sops_comment)){
                $TrainingHistory = new TrainingHistory();
                $TrainingHistory->plan_id = $training->id;
                $TrainingHistory->sop_id = $training->sops;
                $TrainingHistory->activity_type = "Sops";
                $TrainingHistory->previous = $last->sops;
                $TrainingHistory->current = $training->sops;
                $TrainingHistory->comment = $request->sops_comment;
                $TrainingHistory->user_id = Auth::user()->id;
                $TrainingHistory->user_name = Auth::user()->name;
                $TrainingHistory->origin_state = "Assigned";
                $TrainingHistory->save();
            }

            if($training->trainees !== $last->trainees || !empty($request->trainees_comment)){
                $TrainingHistory = new TrainingHistory();
                $TrainingHistory->plan_id = $training->id;
                $TrainingHistory->sop_id = $training->trainees;
                $TrainingHistory->activity_type = "Trainees";
                $TrainingHistory->previous = $last->trainees;
                $TrainingHistory->current = $training->trainees;
                $TrainingHistory->comment = $request->trainees_comment;
                $TrainingHistory->user_id = Auth::user()->id;
                $TrainingHistory->user_name = Auth::user()->name;
                $TrainingHistory->origin_state = "Assigned";
                $TrainingHistory->save();
            }
            if($last->sops){
                $sop_data = explode(',',$last->sops);
                foreach($sop_data as $data){
                    if($training->traning_plan_name !== $last->traning_plan_name || !empty($request->traning_plan_comment)){
                        $history = new DocumentHistory();
                        $history->document_id = $data;
                        $history->activity_type = "Training plan Name";
                        $history->previous = $last->traning_plan_name;
                        $history->current = $training->training_plan_name;
                        $history->comment = $request->traning_plan_comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = "Pending-Training";
                        $history->save();
                    }
                    if($training->training_plan_type !== $last->training_plan_type || !empty($request->training_plan_type_comment)){
                        $history = new DocumentHistory();
                        $history->document_id = $data;
                        $history->activity_type = "Training plan Type";
                        $history->previous = $last->training_plan_type;
                        $history->current = $training->training_plan_type;
                        $history->comment = $request->training_plan_type_comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = "Pending-Training";
                        $history->save();
                    }

                    if($training->effective_criteria !== $last->effective_criteria || !empty($request->effective_criteria_comment)){
                        $history = new DocumentHistory();
                        $history->document_id = $data;
                        $history->activity_type = "Effective criteria";
                        $history->previous = $last->effective_criteria;
                        $history->current = $training->effective_criteria;
                        $history->comment = $request->effective_criteria_comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = "Pending-Training";
                        $history->save();
                    }

                    if($training->quize !== $last->quize || !empty($request->quize_comment)){
                        $history = new DocumentHistory();
                        $history->document_id = $data;
                        $history->activity_type = "quize";
                        $history->previous = $last->quize;
                        $history->current = $training->quize;
                        $history->comment = $request->quize_comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = "Pending-Training";
                        $history->save();
                    }

                    if($training->trainees !== $last->trainees || !empty($request->trainees_comment)){
                        $history = new DocumentHistory();
                        $history->document_id = $data;
                        $history->activity_type = "Trainees";
                        $history->previous = $last->trainees;
                        $history->current = $training->trainees;
                        $history->comment = $request->trainees_comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = "Pending-Training";
                        $history->save();
                    }

                }
            }

            if($request->trainees){
                foreach($request->trainees as $trainee){
                    $user = User::find($trainee);
                    try {
                        Mail::send('mail.assign-training', ['document' => $training],
                        function ($message) use ($user) {
                                $message->to($user->email)
                                ->subject("Training is assigned to you.");

                        });
                    } catch (\Exception $e) {
                        //
                    }
                }
           }
            toastr()->success('Training Plan created successfully');
            return redirect('TMS/show');
        }
    }


    function auditTrial($id){
        $audit = TrainingHistory::where('plan_id',$id)->orderByDESC('id')->get()->unique('activity_type');
        $today = Carbon::now()->format('d-m-y');
        $document = Training::find($id);

        $document->originator = User::where('id',$document->trainner_id)->value('name');
        return view('frontend.TMS.audit-trial',compact('audit','document','today'));
      }

      function auditDetails($id){
        $detail = TrainingHistory::find($id);
        $detail_data = TrainingHistory::where('activity_type', $detail->activity_type)->where('plan_id',$detail->plan_id)->latest()->get();
        $doc = Training::where('id',$detail->plan_id)->first();

        $doc->origiator_name = User::find($doc->trainner_id);
      return view('frontend.change-control.audit-trial-inner',compact('detail','doc','detail_data'));
    }







    //---------------------------------------------------EXAMPLE---------------------------

    public function example($id){
        $document = Document::find($id);
        $document_training = DocumentTraining::where('document_id',$id)->first();
        $training = Training::find($document_training->training_plan);
        if($training->training_plan_type == "Read & Understand with Questions"){
            $quize = Quize::find($training->quize);
            $data = explode(',',$quize->question);

            $data_array = [];
            for($i = 0; $i < count($data); $i++){
                //question
                $question = Question::find($data[$i]);
                $question->id = $i+1;

                //Options
                $json_option = unserialize($question->options);
                $options = [];
                foreach($json_option as $key => $value){
                    if(!is_null($value)){
                        array_push($options,$value);
                    }
                }
                $question->choices =$options;
                //Answers
                $json_answer = unserialize($question->answers);
                $answers = [];


                if($question->type == "Exact Match Questions"){
                    foreach($json_answer as $key => $value){
                       $answers = $value;
                    }
                }
                elseif($question->type == "Multi Selection Questions"){
                    foreach($json_answer as $key => $value){
                        foreach($options as $key1 => $option){
                            if($key1 == $value){
                            array_push($answers,$key);
                            }
                        }

                    }
                }
                elseif($question->type == "Single Selection Questions"){

                    foreach($json_answer as $key => $value){
                        foreach($options as $key1 => $option){
                            if($key1 == $value){
                              $answers = intval($value);

                            }
                        }

                    }
                }

                 $question->answer = $answers;
                array_push($data_array,$question);
            }
            //  $data_array = implode(',',$array);
             return $data_array;
        //    return view('frontend.TMS.example',compact('document','data_array','quize'));


       }
       else{
        toastr()->error('Training not specified');
        return back();
       }
    }

    public function trainingOverallStatus($id){
        $training = Training::where('id', $id)->latest()->first();

        if (!$training) {
            toastr()->error('Training plan not found');
            return back();
        }

        // Extract SOP IDs from the comma-separated string
        $sopIds = explode(',', $training->sops);
        $userIds = explode(',', $training->trainees);

        // Query SOP records
        $sops = Document::whereIn('id', $sopIds)->get();
        $trainingUsers = User::whereIn('id', $userIds)->get();

        // dd($trainingUsers);

        // Query Training Status records for the given training ID and SOP IDs
        $trainingStatus = TrainingStatus::where('training_id', $id)
                                         ->whereIn('sop_id', $sopIds)
                                         ->get();

        return view('frontend.TMS.training-overall-status',compact('trainingStatus','sops','training','trainingUsers'));
    }
}
