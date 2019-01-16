<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certificate extends Model
{
    use SoftDeletes;
    protected $fillable = ['goden_do', 'inspired_by', 'on_behalf_and_for', 'subject_id'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function subjects()
    {
        return $this->hasMany('App\Subject', 'department_id');
    }
}
