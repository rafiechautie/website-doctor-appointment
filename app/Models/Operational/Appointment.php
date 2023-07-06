<?php

namespace App\Models\Operational;

use App\Models\MasterData\Consultation;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use SoftDeletes;

    public $table = 'appointments';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $guarded = ['id'];

    //satu appointement hanya bisa dimiliki oleh satu user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    //satu appointment hanya bisa dimiliki oleh satu doctor dalam satu waktu
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }

    //satu appointment hanya bisa dimiliki oleh satu consultation dalam satu waktu
    public function consultation()
    {
        return $this->belongsTo(Consultation::class, 'consultation_id', 'id');
    }

    //satu appointment memiliki satu transaction
    public function transaction()
    {
        return $this->hasOne(Transaction::class, 'appointment_id');
    }
}
