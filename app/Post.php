<?php

namespace Fadvi;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post', 'user_id', 'discussion_id',
    ];

    public function user()
    {
    	return $this->belongsTo('Fadvi\User', 'user_id');
    }
}


