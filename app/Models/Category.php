<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $primaryKey = 'category_id';

    protected $fillable = [
        'added_user_id',
        'category_name',
        'category_image',
        'category_type',
        'category_status',
    ];

    public $timestamps = true;

}
