<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class requestAccess extends Model
{
    protected $table = "request_accesses";
    protected $primaryKey = "access_id";
    protected $fillable = [
        'user_id',
        'user_name',
        'user_email',
        'user_phone',
        'access_module',
        'access_status',
    ];
    public $timestamps = true;
s

    public function module()
    {
        return $this->belongsTo(Module::class, 'access_module');
    }
}
