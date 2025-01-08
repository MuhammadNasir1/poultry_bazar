<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PosPurchase extends Model
{
    protected $table = 'pos_purchase';

    protected $primaryKey = 'purchase_id';

    protected $fillable = [
        'user_id',
        'product_id',
        'supplier_name',
        'purchase_date',
        'purchase_weight_quantity',
        'purchase_rate',
        'purchase_amount',
        'purchase_comments',
        'purchase_status',
    ];

    public $timestamps = true;

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

}
