<?php

namespace App\Models\ManagementAccess;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermissionRole extends Model
{
    use SoftDeletes;

    public $table = 'permission_roles';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $guarded = ['id'];

    //satu permission roles hanya bisa memiliki satu permission
    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id', 'id');
    }

    //satu permission roles hanya bisa memiliki satu role
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
}
