<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
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
            'name' => 'required|string|max:255',
            //uniques:users -> harus unik di tabel users
            'email' => [
                'required',
                'email',
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
                Rule::unique('users')->ignore($this->user),
            ],
            'password' => 'min:8|string|max:255|Password::min(8)->mixedCase()',
        ];
    }
}
