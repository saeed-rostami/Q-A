<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use VotableTrait;

    protected $fillable = ['body' , 'user_id'];
    protected $appends = ['created_date' , 'body_html' , 'is_best'];

    public function getBodyHtmlAttribute()
    {
//        return clean(Parsedown::instance()->text($this->body));
    }
//question-relationship
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
//user-relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }
//answer-count
    public static function boot()
    {
        parent::boot();
        static::created(function ($answer) {
            $answer->question->increment('answers_count');
        });

        static::deleted(function ($answer){
            $answer->question->decrement('answers_count');
        });
    }
//date-format
    public function getCreatedDateAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

//status ******
    public function isBest()
    {
        return $this->id === $this->question->best_answer_id;
    }

    public function getStatusAttribute()
    {
        return $this->isBest() ? 'vote-accepted' : '';
    }

    public function getIsBestAttribute()
    {
        return $this->isBest();
    }

}
