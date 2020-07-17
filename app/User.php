<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
    protected $appends = ['url' , 'avatar'];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

//question-relationship******
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

//url*****
    public function getUrlAttribute()
    {
        return '#';
    }

//answers-relationship
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

//avatar*****
    public function getAvatarAttribute()
    {
        $email = $this->email;
        $size = 32;

        return "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?s=" . $size;
    }

//    favorites******
    public function favorites()
    {
        return $this->belongsToMany(Question::class, 'favorites')->withTimestamps();
    }

//    votes****
    public function voteQuestions()
    {
        return $this->morphedByMany(Question::class, "votable");
    }

    public function voteAnswers()
    {
        return $this->morphedByMany(Answer::class, "votable");
    }

//    votes-logic***

    private function _vote($relationship, $model, $vote)
    {
        if ($relationship->where("votable_id", $model->id)->exists()) {
            $relationship->updateExistingPivot($model, ["vote" => $vote]);
        } else {
            $relationship->attach($model, ["vote" => $vote]);
        }
        $model->load('votes');
        $downVotes = (int) $model->downVotes()->sum('vote');
//        $downVotes = (int) $question->votes()->wherePivot('vote' , '1')->sum('vote');
//        $upVotes = (int) $question->votes()->wherePivot('vote' , '-1')->sum('vote');
        $upVotes = (int) $model->upVotes()->sum('vote');
        $model->votes_count = $downVotes + $upVotes;
        $model->save();

        return $model->votes_count;
    }

    public function voteQuestion(Question $question, $vote)
    {
        $voteQuestions = $this->voteQuestions();
       return $this->_vote($voteQuestions, $question, $vote);

    }

    public function voteAnswer(Answer $answer, $vote)
    {
        $voteAnswers = $this->voteAnswers();
        return $this->_vote($voteAnswers, $answer, $vote);

    }
}
