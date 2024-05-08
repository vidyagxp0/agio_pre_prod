<?php

namespace App\Http\Controllers\tms;

use App\Http\Controllers\Controller;
use App\Models\Question;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Question::where('trainer_id',Auth::user()->id)->orderByDesc('id')->paginate(10);
        return view('frontend.TMS.question',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->submit == "save"){

             if($request->type != "Exact Match Questions"){
                $this->validate($request,[
                   'type' =>'required',
                   'question'=>'required|max:255',
                   'options'=>'required',
                   'answers'=>'required',
                 ]);
             }
             else{
                $this->validate($request,[
                    'type' =>'required',
                    'question'=>'required|max:255',

                    'answers'=>'required',
                  ]);
             }
            $options = $request->options;
            $answers = $request->answers;

            //     foreach ($options as $key => $option) {
            //         if (in_array($option, $answers)) {
            //             $index = array_search($option, $answers);
            //             $answers[$index] = $key;
            //             break; // Exit loop once value is updated
            //         }
            //     }
            // $request->merge(['answers' => $answers]);
            $question = new Question();
            $question->trainer_id = Auth::user()->id;
            $question->type = $request->type;
            $question->question = $request->question;
            $question->options = serialize($request->options);
            $question->answers = serialize($request->answers);
            $question->save();
            toastr()->success('Question Created Successfuly !!');
            return back();
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::find($id);
        return view('frontend.TMS.edit-question',compact('question'));

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

            $question = Question::find($id);
            $question->trainer_id = Auth::user()->id;
            // $question->type = $request->type;
            $question->question = $request->question;
            $question->options = serialize($request->options);
            $question->answers = serialize($request->answers);
            $question->save();
            toastr()->success('Question Created Successfuly !!');
            return redirect()->route('question.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Question::find($id);
        $data->delete();
        toastr()->success('Question Deleted Successffully !!');
        return back();
    }
}
