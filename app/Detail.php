<?php

namespace Fadvi;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question_id', 'step_1', 'step_2', 'step_3', 'step_4', 'step_5'
    ];

    public function question()
    {
    	return $this->belongsTo('Fadvi\Question');
    }
}
