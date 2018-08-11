<?php

namespace Fadvi;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'user_id', 'advisor_id', 'summary', 'topics', 'discussion_id'
    ];

    public function user()
    {
    	return $this->belongsTo('Fadvi\User');
    }

    public function advisor()
    {
        return $this->belongsTo('Fadvi\Advisor');
    }
}
