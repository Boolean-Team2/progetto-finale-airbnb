<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = [
        'name',
        'description',
        'img',
        'rooms',
        'beds',
        'baths',
        'mq',
        'latitude',
        'longitude',
        'views'
    ];

    public function user() {

        return $this -> belongsTo(User::class);
    }

    public function apartment_info() {

        return $this -> hasOne(ApartmentInfo::class);
    }

    public function messages() {

        return $this -> hasMany(Message::class);
    }

    public function ads() {

        return $this -> belongsToMany(Ad::class);
    }
}
