<?php

namespace Fadvi;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'advisor_id', 'question_id',
    ];

    public function user()
    {
    	return $this->belongsTo('Fadvi\User', 'user_id');
    }

    public function advisor()
    {
        return $this->belongsTo('Fadvi\Advisor', 'advisor_id');
    }

    public function question()
    {
        return $this->belongsTo('Fadvi\Question', 'question_id');
    }
}
