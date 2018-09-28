<?php

namespace Fadvi;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'question', 'topic_id', 'views', 'responses', 'details'
    ];

    public function user()
    {
        return $this->belongsTo('Fadvi\User');
    }

    public function topic()
    {
    	return $this->belongsToMany('Fadvi\Topic', 'question_topic', 'question_id', 'topic_id');
    }

    public function getTopics()
    {
    	return $this->topic()->get();
    }

    public function responses()
    {
        return $this->belongsToMany('Fadvi\Response', 'question_responses', 'question_id', 'response_id')->withPivot('discussion_created');
    }

    public function getResponses()
    {
        return $this->responses()->get();
    }

    public function countResponses()
    {
        return $this->getResponses()->count();
    }


}
