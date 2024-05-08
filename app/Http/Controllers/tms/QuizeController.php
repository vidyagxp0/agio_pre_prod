<?php

namespace App\Http\Controllers\tms;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\QuestionBank;
use App\Models\Quize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Quize::where('trainer_id', Auth::user()->id)->orderbyDesc('id')->paginate(10);
        return view('frontend.TMS.manage-quizzes',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $questions = QuestionBank::withoutTrashed()->where('trainer_id', Auth::user()->id)->get();
        return view('frontend.TMS.create-quiz',compact('questions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' =>'required',
            'question_bank'=>'required|max:255',
            'questions'=>'required',
            'passing'=>'required',
          ]);
        $quize = new Quize();
        $quize->trainer_id = Auth::user()->id;
        $quize->title = $request->title;
        $quize->description = $request->description;
        $quize->category = $request->category;
        $quize->passing = $request->passing;
        $quize->question_bank = $request->question_bank;
        if(!empty($request->questions)){
        $quize->question = implode(',', $request->questions);
        }
        $quize->save();
        toastr()->success('Submit Successfully !!');
        return redirect()->route('quize.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $questions = QuestionBank::where('trainer_id', Auth::user()->id)->get();
        $quize = Quize::find($id);
        $ques = QuestionBank::where('id',$quize->question_bank)->value('questions');
        $data = explode(',',$ques);
        $array = [];
        for($i=0; $i<count($data); $i++){
         $question = Question::find($data[$i]);
         array_push($array,$question);
        }
        return view('frontend.TMS.edit-quiz',compact('questions','quize','array'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $quize = Quize::find($id);
        $quize->trainer_id = Auth::user()->id;
        $quize->title = $request->title;
        $quize->description = $request->description;
        $quize->category = $request->category;
        $quize->passing = $request->passing;
        $quize->question_bank = $request->question_bank;
        if(!empty($request->questions)){
        $quize->question = implode(',', $request->questions);
        }
        $quize->save();
        toastr()->success('Update Successfully !!');
        return redirect()->route('quize.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quize = Quize::find($id);
        $quize->delete();
        toastr()->success('Deleted Successfully !!');
        return back();
    }

    public function datag($id){
        $questions = QuestionBank::where('id',$id)->value('questions');
        $data = explode(',',$questions);
        $array = [];
        for($i=0; $i<count($data); $i++){
         $question = Question::find($data[$i]);
         array_push($array,$question);
        }
        $htmls =[];
        $html ='';
      foreach($array as $temp){
        $html =
        '
    <tr data-item="'.$temp->id.'">
        <td>'.$temp->question.'</td>
        <td>'.$temp->type.'</td>
    </tr>';
    array_push($htmls,$html);
      }
        $response['htmls'] = $htmls;

        return response()->json($response);
    }

    public function data($id){
        $questions = Quize::where('id',$id)->value('question');
        $data = explode(',',$questions);
        $array = [];
        for($i=0; $i<count($data); $i++){
         $question = Question::find($data[$i]);
         array_push($array,$question);
        }
        $htmls =[];
        $html ='';
      foreach($array as $temp){
        $html =
        '
    <tr data-item="'.$temp->id.'">
        <td>'.$temp->question.'</td>
        <td>'.$temp->type.'</td>
    </tr>';
    
    array_push($htmls,$html);
      }
        $response['htmls'] = $htmls;

        return response()->json($response);
    }
}
