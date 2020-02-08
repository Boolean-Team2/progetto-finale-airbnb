<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApartmentInfo extends Model
{
    protected $table = 'apartments_info';

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
