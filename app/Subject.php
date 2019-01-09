<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use SoftDeletes;
    protected $table = 'subject';
    protected $fillable = ['name', 'code', 'price', 'department_id', 'description', 'user_id',];


    public static function boot()
    {
        parent::boot();
        static::deleting(function ($subject) {
            $subject->quizes()->delete();

        });
    }

    public function department()
    {
        return $this->belongsTo('App\Department', 'department_id');
    }

    public function quizes()
    {
        return $this->hasMany('App\Quiz', 'subject_id');
    }

    public function lessons()
    {
        return $this->hasMany('App\Lesson', 'subject_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
