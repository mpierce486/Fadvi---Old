<?php

namespace Fadvi;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
	protected $table = 'blogs';

    protected $fillable = [
        'blog_title', 'blog_main_img', 'blog_snippet', 'blog_content', 'url_slug', 'advisor_blog', 'blog_url', 'advisor_id',
    ];

    public function advisor()
    {
    	return $this->belongsTo('Fadvi\Advisor');
    }
}
