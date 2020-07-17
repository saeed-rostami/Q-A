<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Parsedown;


class Question extends Model
{
    use VotableTrait;
    protected $fillable = ['title', 'body'];
    protected $appends = ['created_date' , 'is_favorited' , 'favorites_count' , 'body_html'];
//user-relationship*********
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

//    url*****
    public function getUrlAttribute()
    {
        return route('questions.show', $this->slug);
    }

//    status***
    public function getCreatedDateAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

//status*******
    public function getStatusAttribute()
    {
        if ($this->answers_count > 0) {
            if ($this->best_answer_id) {
                return "answered-accepted";
            }
            return "answered";
        }
        return "unanswered";
    }

    public function getBodyHtmlAttribute()
    {
        return $this->bodyHtml();
    }

//answers********
    public function answers()
    {
        return $this->hasMany(Answer::class)->orderBy("votes_count" , "DESC");
    }

    public function acceptBestAnswer(Answer $answer)
    {
        $this->best_answer_id = $answer->id;
        $this->save();
    }

//    favorites*****
    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    public function isFavorited()
    {
        return $this->favorites()->where('user_id', \auth()->id())->count() > 0;
    }

    public function getIsFavoritedAttribute()
    {
        return $this->isFavorited();
    }

    public function getFavoritesCountAttribute()
    {
        return $this->favorites()->count();
    }
//body_html_xss***
    public function getExcerptAttribute()
    {
        return $this->excerpt(300);
    }

    public function excerpt($length)
    {
        return Str::limit(strip_tags($this->bodyHtml()) , $length);
    }
    private function bodyHtml()
    {
        return Parsedown::instance()->text($this->body);
    }
}
