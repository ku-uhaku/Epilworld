<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GlobalInvoice extends Model
{
    protected $table = 'global_invoice';
    public $primaryKey = 'id';


    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public function bookings()
    {
        return $this->belongsToMany('App\Booking', 'global_invoice_details', 'global_invoice_id', 'booking_id')->withPivot('status');
    }
}
