<?php

namespace App\Models\ManagementAccess;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    public $table = 'roles';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $guarded = ['id'];

    // many to many
    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function permission()
    {
        return $this->belongsToMany(Permission::class);
    }

    //satu role dimiliki oleh banyak  role users
    public function role_user()
    {
        return $this->hasMany(RoleUser::class . 'role_id');
    }

    //satu role bisa memiliki banyak permission roles
    public function permissions_role()
    {
        return $this->hasMany(PermissionRole::class . 'role_id');
    }
}
