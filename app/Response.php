<?php

namespace Fadvi;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $fillable = [
    	'response',
    ];

    public function question()
    {
    	return $this->belongsToMany('Fadvi\Question', 'question_responses', 'response_id', 'question_id');
    }

    public function user()
    {
    	return $this->belongsToMany('Fadvi\User', 'question_responses', 'response_id', 'user_id');
    }

    public function advisor()
    {
        return $this->belongsToMany('Fadvi\Advisor', 'question_responses', 'response_id', 'advisor_id');
    }
}
