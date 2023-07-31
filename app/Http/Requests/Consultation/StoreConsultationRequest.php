<?php

namespace App\Http\Requests\Consultation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreConsultationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // abort_if(Gate::denies('consultation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
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
            'name' => [
                'required',
                'string',
                'max:255',
                /**
                 *  jika nilai yang sedang divalidasi sama dengan nilai yang ada dalam kolom 'users'
                 *  untuk entitas saat ini, validasi tersebut akan diabaikan.
                 *  Ini memungkinkan pengguna untuk memperbarui informasi mereka tanpa
                 *  harus memvalidasi terhadap diri mereka sendiri
                 * 
                 * misal user A update data email A@gmai.com, maka rule email harus unik diabaikan
                 * jika user B update data email A@gmai.com, maka rule email dijakanlakan yang berarti user B
                 * tidak boleh menggunakan email A@gmai.com
                 */
                Rule::unique('consultation')->ignore($this->consultation),
            ],
        ];
    }
}
