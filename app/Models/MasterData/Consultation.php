<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consultation extends Model
{
    use SoftDeletes;

    public $table = 'consultations';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $guarded = ['id'];

    //satu consultation bisa dimiliki oleh banyak appointment
    public function appointment()
    {
        return $this->hasMany(Appointment::class, 'consultation_id');
    }
}
