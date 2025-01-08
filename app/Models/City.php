<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities';

    protected $primaryKey = 'city_id';

    protected $fillable = [
        'city_name',
        'city_province',
        'city_status',
    ];

    public $timestamps = true;

}
