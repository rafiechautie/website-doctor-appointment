<?php

namespace App\Http\Requests\Consultation;

use Illuminate\Foundation\Http\FormRequest;

class StoreConsultationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
            'doctor_id' => 'requeired|integer',
            'user_id' => 'requeired|integer',
            'consultation_id' => 'requeired|integer',
            'level' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|timezone:Asia/Jakarta',
            'status' => 'required|string|max:255',
        ];
    }
}
