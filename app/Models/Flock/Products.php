<?php

namespace App\Models\Flock;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'flock_products';

    protected $primaryKey = 'fp_id';

    protected $fillable = [
        'company_id',
        'user_id',
        'fp_name',
        'fp_purchase_rate',
        'fp_sale_rate',
        'fp_quantity',
        'fp_details',
        'fp_status',
        'fp_type',  

    ];

    public $timestamps = true;
}
