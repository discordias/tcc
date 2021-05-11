<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => ['required', 'max:100'],
            'email' => ['required', 'max:50', 'email', 'unique:users,email,' . $this->id],
            'registration_number' => ['required', 'max:45', 'min:1', 'unique:users,registration_number,' . $this->id],
        ];
    }
}
