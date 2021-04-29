<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'type_situation_id' => ['required', 'exists:type_situations,id', Rule::notIn([1])],
            'validated_hours' => ['integer'],
            'validated_minutes' => ['integer'],
        ];
    }
}
