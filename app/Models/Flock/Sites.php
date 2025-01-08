<?php

namespace App\Models\Flock;

use Illuminate\Database\Eloquent\Model;

class Sites extends Model
{

    protected $table = 'flock_sites';

    protected $primaryKey = 'site_id';

    protected $fillable = [
        'site_id',
        'user_id',
        'site_name',
        'site_manager',
        'site_phone',
        'site_location',
        'site_closing_date',    

    ];

    public $timestamps = true;
}
