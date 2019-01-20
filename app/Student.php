<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Student extends Model
{
    use SoftDeletes;
    protected $dates = ['created_at', 'dob'];
    protected $table = 'students';
    protected $fillable = [
        'id',
        'firstName',
        'middleName',
        'lastName',
        'mobileNo',
        'gender',
        'dob',

        'isActive',
        'user_id',
    ];

    public function setPasswordAttribute($pass)
    {

        $this->attributes['password'] = bcrypt($pass);

    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($student) {
            $student->registered()->delete();
        });
    }

    function setDobAttribute($value)
    {
        $this->attributes['dob'] = Carbon::createFromFormat('d/m/Y', $value);
    }

    public function registered()
    {
        return $this->hasMany('App\Registration', 'students_id');
    }

    public function results()
    {
        return $this->hasMany('App\Result', 'student_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
