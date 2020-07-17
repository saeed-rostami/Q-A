<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;

class AcceptAnswer extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Answer $answer
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Answer $answer)
    {
        $this->authorize('accept' , $answer);
        $answer->question->acceptBestAnswer($answer);
        if (\request()->expectsJson()){
           return response()->json([
               'message' => 'You Have Accepted this answer as best Answer'
            ]);
        }
        return redirect()->back();
    }
}
