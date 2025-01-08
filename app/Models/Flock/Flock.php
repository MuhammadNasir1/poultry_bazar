<?php

namespace App\Models\Flock;

use Illuminate\Database\Eloquent\Model;

class Flock extends Model
{
    protected $table = 'flocks';

    protected $primaryKey = 'flock_id';

    protected $fillable = [
        'flock_site_id',
        'user_id',
        'flock_name',
        'flock_image',
        'farmer_name',
        'flock_color',
        'flock_supervisor_user_id',
        'flock_accountant_user_id',
        'flock_assistant_user_id',
        'flock_expense',
        'flock_revenue',

    ];

    public $timestamps = true;
}
