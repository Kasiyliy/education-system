<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model {
  use SoftDeletes;
  protected $table = 'department';
  protected $fillable = ['name','code','description'];
  public static function boot()
  {
    parent::boot();
    static::deleting(function($department) {
      $department->subjects()->delete();
    });
  }

  public function subjects()
  {
    return $this->hasMany('App\Subject','department_id');
  }

}
