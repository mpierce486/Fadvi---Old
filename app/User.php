<?php

namespace Fadvi;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'advisor', 'advisor_type', 'title', 'designations', 'image_path', 'firm_name', 
        'firm_address', 'lat', 'long', 'services', 'fees', 'username', 'languages', 'advisor_registered'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function questions()
    {
        return $this->hasMany('Fadvi\Question');
    }

    public function userQuestions()
    {
        return $this->questions()->get();
    }

    public function userResponses()
    {
        return $this->belongsToMany('Fadvi\Response', 'question_responses', 'user_id', 'response_id');
    }

    // Relationship for discussions the user is associated with
    public function discussions()
    {
        return $this->hasMany('Fadvi\Discussion');
    }

    // Relationship for discussions the advisor is associated with
    public function discussionsAdvisor()
    {
        return $this->hasMany('Fadvi\Discussion', 'advisor_id');
    }

    public function posts()
    {
        return $this->hasMany('Fadvi\Post', 'user_id');
    }

    /**
     *  Roles methods
     */

    public function roles()
    {
        return $this->belongsToMany('Fadvi\Role', 'user_role', 'user_id', 'role_id');
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return false;
            }
        }
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    /**
     *  METHODS WHEN USER IS REGISTERED AS AN ADVISOR
     */

    // get questions that advisor can answer
    public function advisorQuestions()
    {
        return $this->belongsToMany('Fadvi\Question', 'question_notifications', 'user_id', 'question_id')->get();
    }

    public function advisorResponses()
    {
        return $this->belongsToMany('Fadvi\Response', 'question_responses', 'user_id', 'response_id')->withPivot('question_id')->get();
    }
}
