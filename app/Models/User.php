<?php

namespace App\Models;

use App\Traits\HavePermission;
use App\Mail\NewUserRegisterMail;
use App\Jobs\NewUserRegisterJob;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, HavePermission, SoftDeletes;
    /*
    |--------------------------------------------------------------------------
    | goblan variables
    |--------------------------------------------------------------------------
    */

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'is_active'
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
    ];

    const SUPERADMIN = 'SUPERADMIN';
    const ADMIN = 'ADMIN';
    const MEMBER = 'MEMBER';
    const GUEST = 'GUEST';

    /*
    |--------------------------------------------------------------------------
    | functions
    |--------------------------------------------------------------------------
    */

    public function isSuperAdmin()
    {
        return $this->role === User::SUPERADMIN;
    }
    public function isAdmin()
    {
        return $this->role === User::ADMIN;
    }
    public function isMember()
    {
        return $this->role === User::MEMBER;
    }

    public function isGuest()
    {
        return $this->role === User::GUEST;
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    protected static function boot()
    {

        parent::boot();

        static::created(function ($user) {

            // NewUserRegisterJob::dispatch(
            //     $user
            // )->onQueue("high");

            Mail::to('soporte@svcbmf.org')->send(new NewUserRegisterMail($user));
        });
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function directories()
    {
        return $this->hasMany(Directory::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Search
    |--------------------------------------------------------------------------
    */



    public static function search($query = ''){
        if(!$query){
            return self::all();
        }
        return self::where('username', 'like', "%$query%")
        ->orWhere('email', 'like', "%$query%")
        ->orWhere('role', 'like', "%$query%")
        ->get();
    }
}
