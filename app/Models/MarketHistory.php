<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketHistory extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $table = 'markets_history';
    protected $primaryKey = 'market_history_id';
    protected $fillable = [
        'market_id',
        'user_id',
        'market_rate',
        'market_openrate',
        'market_closerate',
        'market_doc',
    ];

    public $timestamps = true;

    public function market()
    {
        return $this->belongsTo(Market::class, 'market_id', 'market_id');
    }

}
