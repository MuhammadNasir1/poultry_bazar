<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catching extends Model
{
    protected $table = 'catching';
    protected $primaryKey = 'cat_id';

    protected $fillable = [
        'user_id',
        'flock_id',
        'cat_date',
        'cat_receipt',
        'cat_driver_info',
        'cat_broker_info',
        'cat_cp_rate',
        'cat_healthy_rate',
        'cat_weight_booked',
        'cat_net_weight',
        'cat_total',
        'cat_grand_total',
        'cat_f_online',
        'cat_f_cash',
        'cat_f_cash_notes',
        'cat_f_receipt',
        'cat_advance',
        'cat_remaining',
        'cat_empty_weight',
        'cat_load_weight',
        'cat_paid_weight',
        'cat_mound_type',
        'cat_second_payment',
        'cat_second_cash',
        'cat_second_online',
        'cat_second_receipt',
        'cat_second_cash_notes',

    ];

    public $timestamps = true;

    public function getCatDriverInfoAttribute($value)
    {
        return json_decode($value, true);
    }
    
    public function getCatBrokerInfoAttribute($value)
    {
        return json_decode($value, true);
    }
    
    public function getCatFCashNotesAttribute($value)
    {
        return json_decode($value, true);
    }
    public function catSecondCashNotesAttribute($value)
    {
        return json_decode($value, true);
    }

    
     
}
