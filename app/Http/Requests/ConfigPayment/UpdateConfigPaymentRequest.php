<?php

namespace App\Http\Requests\ConfigPayment;

use Illuminate\Foundation\Http\FormRequest;

class UpdateConfigPaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        abort_if(Gate::denies('config_payment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
            'fee' => 'requeired|string|max:255',
            'vat' => 'requeired|string|max:255',
        ];
    }
}
