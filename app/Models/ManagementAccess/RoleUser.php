<?php

namespace App\Models\ManagementAccess;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleUser extends Model
{
    use SoftDeletes;

    public $table = 'role_users';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $guarded = ['id'];

    //satu role user hanya bisa dimiliki oleh satu user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    //satu role user bisa punya banyak role
    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_id', 'id');
    }
}
