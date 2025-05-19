<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class requestAccess extends Model
{
    protected $appends = ['days_left'];

    protected $table = "request_accesses";
    protected $primaryKey = "access_id";
    protected $fillable = [
        'user_id',
        'user_name',
        'user_email',
        'user_phone',
        'access_module',
        'access_start_date',
        'access_end_date',
        'access_status',
    ];
    public $timestamps = true;


    public function module()
    {
        return $this->belongsTo(Module::class, 'access_module');
    }   

    public function getDaysLeftAttribute()
    {
        if ($this->access_end_date) {
            $today = Carbon::today();
            $endDate = Carbon::parse($this->access_end_date);

            return $today->diffInDays($endDate, false);
        }

        return null;
    }
}
