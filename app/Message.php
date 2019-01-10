<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $dates = ['created_at','updated_at'];
    protected $table = 'messages';
    protected $fillable = [
        'content',
        'subject_id',
        'sender_user_id',
        'acceptor_user_id',
    ];

    public function sender() {
        return $this->belongsTo('App\User','sender_user_id');
    }

    public function acceptor() {
        return $this->belongsTo('App\User','acceptor_user_id');
    }

    public function subject() {
        return $this->belongsTo('App\Subject','subject_id');
    }
}
