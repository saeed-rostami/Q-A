<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;

class VoteAnswersController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    /**
     * Handle the incoming request.
     *
     * @param Answer $answer
//     * @return \Illuminate\Http\Response
     */
    public function __invoke(Answer $answer)
    {
        $vote = (int) \request()->vote;
        $votesCount = auth()->user()->voteAnswer($answer, $vote);

        if (\request()->expectsJson()){
            return response()->json([
               "message" => "Thanks For feedback",
                "votesCount" => $votesCount
            ]);
        }

        return redirect()->back();
    }
}
