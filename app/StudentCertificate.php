<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentCertificate extends Model
{
    use SoftDeletes;
    protected $fillable = ['IdNo' , 'goden_do', 'subject_id' , 'user_id' , 'teacher_id' , 'inspired_by', 'on_behalf_and_for'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function subjects()
    {
        return $this->hasMany('App\Subject', 'department_id');
    }

}
