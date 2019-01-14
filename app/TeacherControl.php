<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherControl extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id', 'entered'];


    //
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
