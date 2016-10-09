<?php

namespace App\Models;

use App\Models\BaseModel;

class UserModel extends BaseModel
{
    protected $table = 'user';

    public function test()
    {
        return $this->mfnUpdate(['username' => time()]);
//        return $this->mfnUpdate(['id' => 23, 'name' => time()]);
//        return $this->mfnFind(['id' => 1, 'name' => 'limx']);
//        return $this->mfnFind(1);
//        return $this->where('id', '>', 10)->take(3)->get();
    }

    public function role()
    {
        return $this->belongsTo('App\Models\RoleModel', 'role_id', 'id');
    }

    public function book()
    {
        return $this->hasMany('App\Models\BookModel', 'uid', 'id');
    }

    public function titles()
    {
        return $this->belongsToMany('App\Models\TitleModel', 'user_title', 'uid', 'title_id');
    }
}
