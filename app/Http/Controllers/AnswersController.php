<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index(Question $question)
    {
      return $question->answers()->with("user")->simplePaginate(3);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Question $question
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, Request $request)
    {
       $request->validate([
           'body' => 'required'
       ]);
       $answer = $question->answers()->create([
           'body' => $request->body,
           'user_id' => Auth::id()
       ]);

       if (\request()->expectsJson()){
           return response()->json([
              "message" =>  "Your Answer Submitted",
               "answer" => $answer->load('user')
           ]);
       }

        return redirect()->back()->with('success' , "Your Answer Submitted");
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Question $question
     * @param  \App\Answer $answer
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);
        return view('Answers._edit', compact("question", "answer"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Question $question
     * @param  \App\Answer $answer
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);

        $answer->update($request->validate([
            'body' => 'required'
        ]));
        if ($request->expectsJson()){
            return response()->json([
                "message" => "Your Answer has been updated",
                "body_html" => $answer->body_html,
            ]);
        }
        return redirect()->route('questions.show', $question->slug)->with('success' , 'Your Answer has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Question $question
     * @param  \App\Answer $answer
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Question $question, Answer $answer)
    {
        $this->authorize('delete' , $answer);
        $answer->delete();

        if (\request()->expectsJson()){
            return response()->json([
                'message' => 'Your Answer has been removed'
            ]);
        }

        return redirect()->back()->with('success' , 'Your Answer has been removed');
    }
}
