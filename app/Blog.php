<?php

namespace Fadvi;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
	protected $table = 'blogs';

    protected $fillable = [
        'blog_title', 'blog_main_img', 'blog_snippet', 'blog_content', 'url_slug', 'advisor_blog', 'blog_url', 'advisor_id', 'advisor_name', 'firm_name',
    ];

    public function advisor()
    {
    	return $this->belongsTo('Fadvi\Advisor');
    }

    public function topics()
    {
    	return $this->belongstoMany('Fadvi\Topic');
    }

    public function addTopic(Topic $topic)
    {
        $this->topics()->attach($topic->id);
    }
}
