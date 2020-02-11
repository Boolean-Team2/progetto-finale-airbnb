<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $table = 'ads';

    protected $fillable = [
        '24h',
        '72h',
        '144h',
        'start_time',
        'end_time'
    ];
    
    public function apartments() {

        return $this -> belongsToMany(Apartment::class);
    }

}
