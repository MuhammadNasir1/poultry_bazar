<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $primaryKey = 'product_id';

    protected $fillable = [
        'user_id',
        'product_name',
        'product_sec_name',
        'product_description',
        'product_image',
        'product_unit',
        'product_purchase_rate',
        'product_sale_rate',
        'product_stock',
        'product_status',
    ];

    public $timstamps = true;

}
