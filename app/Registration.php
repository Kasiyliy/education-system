<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registration extends Model
{
   use SoftDeletes;
   protected $dates = ['created_at','updated_at'];
   protected $table = 'registrations';
   protected $fillable = [
      'subject_id',
      'students_id',
      'deleted_at',
   ];

   public function subject() {
      return $this->belongsTo('App\Subject','subject_id');
   }
   public function student() {
      return $this->belongsTo('App\Student','students_id');
   }
}
