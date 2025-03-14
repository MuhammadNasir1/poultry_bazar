<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    protected $primaryKey = 'company_id';

    protected $fillable = [
        'user_id',
        'company_name',
        'company_address',
        'company_phone',
        'company_logo',
        'company_status',
        'company_whatsapp_no',
        'company_terms_conditions',
        'company_views',
        'company_leads',
    ];

    public $timestamps = true;

}
