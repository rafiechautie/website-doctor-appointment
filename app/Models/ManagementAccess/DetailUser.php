<?php

namespace App\Models\ManagementAccess;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailUser extends Model
{

    //fungsi softdeletes adalah untuk mengisi field deleted_at
    use SoftDeletes;

    //menjelaskan bahwa model DetailUser tablenya adalah detail_users
    public $table = 'detail_users';

    //melindungi field yang bersifat dates agar tidak sembarangan diisi
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $guarded = ['id'];

    //satu detail user punya satu user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    //satu detail user memiliki satu type user
    public function type_user(): BelongsTo
    {
        return $this->belongsTo(TypeUser::class, 'type_user_id', 'id');
    }
}
