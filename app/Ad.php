<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $table = 'ad';

    protected $fillable = [
        '24h',
        '72h',
        '144h',
        'duration_time'
    ];
    
    public function apartment() {

        return $this -> belongsTo(Apartment::class);
    }

}
