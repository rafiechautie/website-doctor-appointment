<?php

namespace App\Models;

use App\Models\ManagementAccess\DetailUser;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    use SoftDeletes;

    public $table = 'users';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    // many to many
    public function role()
    {
        return $this->belongsToMany('App\Models\ManagementAccess\Role');
    }

    //satu user punya satu detail user
    public function detail_users()
    {
        return $this->hasOne(DetailUser::class, 'user_id');
    }

    //satu user bisa punya banyak role user
    public function role_users()
    {
        return $this->hasMany(RoleUser::class, 'user_id');
    }

    //satu user bisa memiliki banyak appointment
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'user_id');
    }

    //satu user hanya bisa dilayani oleh satu doctor dalam satu waktu
    public function doctor()
    {
        return $this->hasOne(Doctor::class, 'user_id');
    }
}
