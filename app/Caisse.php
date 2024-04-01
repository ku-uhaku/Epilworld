<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caisse extends Model
{
    protected $table = 'caisse';
    public $primaryKey = 'id';
    public $timestamps = true;
}
