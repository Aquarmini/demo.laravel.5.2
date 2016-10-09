<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    protected $table = 'role';

    public function users()
    {
        return $this->hasMany('App\Models\UserModel', 'role_id', 'id');
    }

    public function books()
    {
        return $this->hasManyThrough('App\Models\BookModel', 'App\Models\UserModel', 'role_id', 'uid', 'id');
    }
}
