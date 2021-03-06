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
        'address',
        'visibility',
        // 'sponsored',
        'user_id'
    ];

    public function user() {
        return $this -> belongsTo(User::class);
    }

    public function services() {
        return $this -> belongsToMany(Service::class);
    }

    public function messages() {
        return $this -> hasMany(Message::class);
    }

    public function views() {
        return $this -> hasMany(View::class);
    }

    public function ads() {
        return $this -> belongsToMany(Ad::class) -> withPivot('start_time','end_time','active');
    }
}
