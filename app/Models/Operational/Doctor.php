<?php

namespace App\Models\Operational;

use App\Models\MasterData\Specialist;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use SoftDeletes;

    public $table = 'doctors';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $guarded = ['id'];

    //satu doctor hanya bisa melayani satu user dari satu waktu
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    //satu doctor hanya bisa memiliki gelar satu specialis
    public function specialist()
    {
        return $this->belongsTo(Specialist::class, 'specialis_id', 'id');
    }

    //satu doctor bisa memiliki banyak appointment
    public function appointment()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }
}
