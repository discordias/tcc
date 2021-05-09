<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    private $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
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
        return $user;
    }
}
