<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class serviceDetails extends Model
{
    protected $table = 'service_details';
    public $timestamps = true;

    public function service()
    {
        return $this->hasOne('App\Service',);
    }
}
