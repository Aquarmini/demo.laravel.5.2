<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookModel extends Model
{
    protected $table = 'book';

    public function user()
    {
        return $this->belongsTo('App\Models\UserModel', 'uid', 'id');
    }
}
