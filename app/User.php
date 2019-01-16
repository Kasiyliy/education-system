<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;
    const ADMIN = "Admin";
    const TEACHER = "Teacher";
    const STUDENT = "Student";

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [

        'id',
        'firstname',
        'lastname',
        'login',
        'group',
        'description',
        'email',
        'password',
        'student_id',

    ];

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($pass){

        $this->attributes['password'] = bcrypt($pass);

    }

    public function quizes() {
        return $this->hasMany('App\Quiz','user_id');
    }

    public function subjects() {
        return $this->hasMany('App\Subject','user_id');
    }

    public function student(){
        return $this->hasOne('App\Student', 'user_id');
    }

    public function incomingMessages() {
        return $this->hasMany('App\Message','acceptor_user_id');
    }

    public function outcomingMessages() {
        return $this->hasMany('App\Message','sender_user_id');
    }

}
