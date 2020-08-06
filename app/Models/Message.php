<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table='chat';
    protected $fillable = array('message', 'sender');

}
