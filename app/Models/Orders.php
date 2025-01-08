<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $primaryKey = 'order_id';

    protected $fillable = [
        'user_id',
        'transaction_id',
        'customer_id',
        'customer_name',
        'customer_phone',
        'order_item_details',
        'order_type',
        'grand_total',
    ];

    public $timestamps = true;

}
