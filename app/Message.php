<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'email_sender',
        'body'
    ];

    public function apartment() {

        return $this -> belongsTo(Apartment::class);
    }
}
