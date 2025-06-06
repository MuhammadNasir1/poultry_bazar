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

    // public function getModulesAttribute()
    // {
    //     return Module::whereIn('module_id', explode(',', $this->attributes['module_id']))->get();
    // }

    //     public function getModulesAttribute()
    // {
    //     $subscribedIds = explode(',', $this->attributes['module_id']);

    //     return Module::all()->map(function ($module) use ($subscribedIds) {
    //         $module->subscribed = in_array($module->module_id, $subscribedIds);
    //         return $module;
    //     });
    // }

    // public function getModulesAttribute()
    // {
    //     $userId = $this->id; // Assuming 'id' is the user's primary key
    //     $subscribedIds = explode(',', $this->attributes['module_id']);

    //     return Module::where('module_status' , 1)->get()->map(function ($module) use ($subscribedIds, $userId) {
    //         $module->subscribed = in_array($module->module_id, $subscribedIds);

    //         // Fetch access_status from request_accesses table
    //         $access = requestAccess::where('user_id', $userId)
    //                                ->where('access_module', $module->module_id)
    //                                ->first();

    //         $module->access_status = $access ? $access->access_status : null;

    //         return $module;
    //     });
    // }


    public function getModulesAttribute()
    {
        $userId = $this->id; // Assuming 'id' is the user's primary key
        $subscribedIds = explode(',', $this->attributes['module_id']);

        return Module::where('module_status', 1)->get()->map(function ($module) use ($subscribedIds, $userId) {
            $module->subscribed = in_array($module->module_id, $subscribedIds);

            // Fetch access_status from request_accesses table
            $access = requestAccess::where('user_id', $userId)
                ->where('access_module', $module->module_id)
                ->first();

            // If access record exists, use its status
            // If not, and user is subscribed, set default to 1
            $module->access_status = $access
                ? $access->access_status
                : ($module->subscribed ? 1 : null);

            return $module;
        });
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
