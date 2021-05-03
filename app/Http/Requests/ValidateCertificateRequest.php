<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateCertificateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'axle_id' => ['required', 'exists:axles,id'],
            'observation' => ['string', 'nullable'],
            'validated_hours' => ['integer', 'min:0'],
            'validated_minutes' => ['integer', 'max:59', 'min:0'],
        ];
    }
}
