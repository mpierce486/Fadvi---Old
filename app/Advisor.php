<?php

namespace Fadvi;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Advisor extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'advisor', 'advisor_type', 'title', 'designations', 'image_path', 'firm_name', 
        'firm_city', 'firm_state', 'lat', 'long', 'username', 'about',
    ];

    protected $table = 'advisors';

    public function topics()
    {
        return $this->belongsToMany('Fadvi\Topic', 'advisor_topics', 'advisor_id', 'topic_id')->withTimestamps();
    }

    public function advisorTopics()
    {
        return $this->topics()->get();
    }

    public function addTopic(Topic $topic)
    {
        $this->topics()->attach($topic->id);
    }
        
}
