<?php

namespace App\Models\MasterData;

use App\Models\Operational\Doctor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specialist extends Model
{
    use SoftDeletes;

    public $table = 'specialist';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $guarded = ['id'];

    //satu gelar specialist bisa dimiliki oleh banyak doctor
    public function doctor()
    {
        return $this->hasMany(Doctor::class, 'specialist_id');
    }
}
