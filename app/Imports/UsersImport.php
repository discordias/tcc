<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\Validator;

class UsersImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;

    private $data;
    private $errors = []; // array to accumulate errors
    private $registered = [];

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function collection(Collection $rows)
    {
        $rows = $rows->toArray();
        foreach ($rows as $key => $row) {
            $validator = Validator::make($row, $this->rules(), $this->validationMessages());

            if ($validator->fails()) {
                $errorsUser = [
                    'row' => implode(', ', $row),
                    'errors' => [],
                ];

                foreach ($validator->errors()->messages() as $messages) {
                    foreach ($messages as $error) {
                        $errorsUser['errors'][] = $error;
                    }
                }

                $this->errors[] = $errorsUser;

            } else {
                // dd($row);
                $user = User::create([
                    'name' => $row['name'] ?? '',
                    'registration_number' => $row['registration_number'] ?? '',
                    'email' => $row['email'] ?? '',
                    'password' => Hash::make('password'),
                    'career_id' => $this->data['career_id'],
                    'entry_year' => $this->data['entry_year'],
                    'entry_semester' => $this->data['entry_semester'],
                ]);

                $user->assignRole('student');
                $this->registered[] = $user;
            }
        }

    }


    // this function returns all validation errors after import:
    public function getErrors()
    {
        return $this->errors;
    }

    public function getRegistred()
    {
        return $this->registered;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'max:100'],
            'email' => ['required', 'max:50', 'email'],
            'registration_number' => ['required', 'max:45', 'min:1', 'unique:users,registration_number'],
        ];
    }

    public function validationMessages()
    {
        return [
            'registration_number.unique' => trans('Matricula deve ser única'),
            'registration_number.max:45' => trans('Maximo de 45 caracteres para matrícula'),
            'registration_number.min:1' => trans('Minimo de 1 caracter para matrícula'),
            'registration_number.required' => trans('Matrícula é obrigatório'),
            'registration_number.email' => trans('Matrícula é obrigatório'),
            'registration_number.email' => trans('Maximo de 50 caracteres para o E-mail'),
            'registration_number.email' => trans('Campo de E-mail deve conter um E-mail Valido'),
            'registration_number.name' => trans('Matrícula é obrigatório'),
            'registration_number.name' => trans('Maximo de 100 caracteres para o Nome'),
        ];
    }
}
