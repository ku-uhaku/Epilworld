<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParametageServices extends Model
{
    protected $table = 'parametage_services';




    public function users()
    {
        return $this->belongsToMany(User::class, 'user_parametrage', 'service_parametage_id', 'user_id')
            ->withPivot('energie', 'frequence', 'refroidissement');
    }
}
