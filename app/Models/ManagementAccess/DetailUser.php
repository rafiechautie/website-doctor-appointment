<?php

namespace App\Models\ManagementAccess;

use Illuminate\Database\Eloquent\Model;
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
}
