<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    use HasFactory;

    protected $table = 'markets';

    protected $primaryKey = 'market_id';

    protected $fillable = [
        'added_user_id',
        'city_id',
        'market_name',
        'market_image',
        'market_rate',
        'market_openrate',
        'market_closerate',
        'market_doc',
        'market_status',
    ];

    public $timestamps = true;

    public function getMarketImageAttribute($value)
    {
        return $value ? asset($value) : null;
    }

    public function marketHistory()
    {
        return $this->hasMany(MarketHistory::class, 'market_id', 'market_id');
    }

}
