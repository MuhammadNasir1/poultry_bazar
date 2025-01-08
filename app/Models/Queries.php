<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queries extends Model
{
    use HasFactory;

    protected $table = 'queries';

    protected $primaryKey = 'query_id';

    protected $fillable = [
        'added_user_id',
        'email',
        'query_subject',
        'query_message',
        'query_status',
        'query_response',
    ];

    public $timestamps = true;

}
