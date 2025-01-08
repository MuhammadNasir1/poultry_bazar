<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $table = 'modules';

    protected $primaryKey = 'module_id';

    protected $fillable = [
        'module_name',
        'module_description',
        'module_image',
        'module_status',
    ];

    public $timestamps = true;

}
