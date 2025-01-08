<?php

namespace App\Models\Flock;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'flock_inventory';

    protected $primaryKey = 'fi_id';

    protected $fillable = [
        'flock_id',
        'company_id',
        'user_id',
        'fi_detail',
        'fi_status',

    ];

    public $timestamps = true;
}
