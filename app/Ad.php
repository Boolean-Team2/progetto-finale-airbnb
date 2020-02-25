<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $table = 'ads';

    protected $fillable = [
        'name', 'price'
    ];
    
    public function apartments() {

        return $this -> belongsToMany(Apartment::class) -> withPivot('start_time','end_time','active');
    }

}
