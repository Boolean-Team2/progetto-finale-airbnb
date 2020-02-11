<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $table = 'ads';

    protected $fillable = [
        'name',
        'start_time',
        'end_time'
    ];
    
    public function apartments() {

        return $this -> belongsToMany(Apartment::class);
    }

}
