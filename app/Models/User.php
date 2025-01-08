<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_role',
        'added_user_id',
        'city_id',
        'module_id',
        'user_phone',
        'user_image',
        'user_status',
        'user_verified',
        'user_privileges',
        'address',
        'company_id',
        'transaction_id',
        'expiry_date',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // public function getModuleIdAttribute()
    // {
    //     return Module::whereIn('module_id', explode(',', $this->attributes['module_id']))->get();
    // }
    
    public function getModulesAttribute()
    {
        return Module::whereIn('module_id', explode(',', $this->attributes['module_id']))->get();
    }

    public function getCompanyAttribute()
    {
        return Company::find($this->attributes['company_id']);
    }


    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
