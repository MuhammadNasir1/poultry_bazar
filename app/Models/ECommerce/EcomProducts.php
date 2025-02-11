<?php

namespace App\Models\ECommerce;

use Illuminate\Database\Eloquent\Model;

class EcomProducts extends Model
{
    protected $table = "ecom_product";
    protected $primaryKey = "ecom_product_id";

    protected $fillable = [
        'company_id',
        'user_id',
        'ecom_product_name',
        'ecom_product_category',
        'ecom_product_brand',
        'ecom_product_price',
        'ecom_product_description',
        'ecom_product_unit',
        'ecom_product_media',
        'ecom_product_status',
    ];

    public $timestamp = true;
}
