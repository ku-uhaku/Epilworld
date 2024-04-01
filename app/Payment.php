<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';


    public function booking()
    {
        return $this->belongsTo('App\Booking');
    }
    public function getImagePathAttribute()
    {
        return url('storage/images/payment') . '/';
    }
}
