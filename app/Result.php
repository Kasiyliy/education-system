<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Result extends Model
{
    use SoftDeletes;
    protected $table = 'results';
    protected $fillable = ['student_id','percentage','done',];


    public function student(){
        return $this->belongsTo('App\Student', 'student_id');
    }
}
