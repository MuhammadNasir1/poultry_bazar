<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariations extends Model
{
    use HasFactory;

    protected $table = 'product_variations';

    protected $primaryKey = 'product_variation_id';

    protected $fillable = [
        'user_id',
        'product_id',
        'product_name',
        'variation_name',
        'variation_sale_rate',
        'variation_consumed',
        'variation_wastage',
        'variation_status',
        'variation_image',
        'is_fav',
    ];

    public $timestamps = true;

}
