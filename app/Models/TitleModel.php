<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TitleModel extends Model
{
    protected $table = 'title';

    public function users()
    {
        return $this->belongsToMany('App\Models\UserModel', 'user_title', 'title_id', 'uid');
    }
}
