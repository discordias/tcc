<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CareerResquest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => 'required|max:100',
            'code' => 'required|max:50'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nome é obrigatório',
            'name.max' => 'Máximo de 100 caracteres para o campo nome',
            'description.required' => 'Descrição é obrigatória',
            'description.max' => 'Máximo de 50 caracteres para o campo nome',
        ];
    }
}
