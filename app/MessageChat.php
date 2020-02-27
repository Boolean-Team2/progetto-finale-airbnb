<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageChat extends Model
{
    protected $fillable = ['from', 'to', 'message', 'is_read'];
}
