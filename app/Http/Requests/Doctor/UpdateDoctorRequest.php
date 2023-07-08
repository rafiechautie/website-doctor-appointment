<?php

namespace App\Http\Requests\Doctor;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDoctorRequest extends FormRequest
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
            'specialist_id' => 'requeired|integer',
            'user_id' => 'requeired|integer',
            'name' => 'required|string|max:255',
            //uniques:users -> harus unik di tabel users
            'fee' => 'required|string|max:255',
            'photo' => 'nullable|string|max:10000',
        ];
    }
}
