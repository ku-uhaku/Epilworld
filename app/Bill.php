<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = 'bill';
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $appends = ['imagePath'];

    public function getImagePathAttribute()
    {
        return url('storage/images/banner') . '/';
    }
}
