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
        'discussion_id', 'user_id', 'advisor_id', 'post'
    ];

    public function user()
    {
    	return $this->belongsTo('Fadvi\User', 'user_id');
    }
}
