<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApartmentInfos extends Model
{
    protected $fillable = [
        'wifi',
        'parking',
        'pool',
        'reception',
        'sauna',
        'sea_view'
    ];

    public function apartment() {

        return $this -> belongsTo(Apartment::class);
    }
    
}
