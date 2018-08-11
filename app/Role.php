<?php

namespace Fadvi;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users()
    {
    	return $this->belongsToMany('Fadvi\User', 'user_role', 'role_id', 'user_id');
    }
}
