<?php

namespace Fadvi;

use Illuminate\Database\Eloquent\Model;

class AdvisorJoinRequest extends Model
{
    protected $table = 'advisor_join_requests';

    protected $fillable = [
        'first_name', 'last_name', 'email', 'advisor_type', 'title', 'designations', 'image_path', 'firm_name', 
        'firm_address', 'lat', 'long', 'username', 'services', 'about',
    ];


}
