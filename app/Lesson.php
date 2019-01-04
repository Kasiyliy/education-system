<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use SoftDeletes;

    protected $dates = ['created_at','updated_at','deleted_at'];
    protected $table = 'lessons';
    protected $fillable = [
        'name',
        'description',
        'presentation',
        'subject_id',
        'deleted_at',
    ];

    public function subject() {
        return $this->belongsTo('App\Subject','subject_id');
    }
}
