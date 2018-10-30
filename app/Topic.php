<?php

namespace Fadvi;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    public function advisor()
    {
        return $this->belongsToMany('Fadvi\Advisor', 'advisor_topics', 'topic_id', 'advisor_id')->withTimestamps();
    }

    public function question()
    {
    	return $this->belongsToMany('Fadvi\Question', 'question_topic', 'topic_id', 'question_id');
    }

}
