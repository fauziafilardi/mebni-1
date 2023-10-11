<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'membership_type',
        'name',
        'phone_number',
        'address',
        'contact_person',
        'contact_person_phone_number',
        'occupation',
        'is_agree',
        'email',
        'password',
        'email_verified_at',
        'photo_profile',
        'last_login',
        'user_ip',
        'is_logged_in',
        'is_active',
        'is_verified',
        'role',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function updateUserLogin()
    {
        DB::table('users')
        ->where('id', $this->id)
        ->update([
            'last_login' => now(),
            'user_ip' => request()->getClientIp()
        ]);
    }
}
