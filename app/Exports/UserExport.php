<?php

namespace App\Exports;

use App\Models\Certificate;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

// use Maatwebsite\Excel\Concerns\FromCollection;

class UserExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    // public function array(): array
    // {
    //     $certificates = Certificate::select('title', 'description')->get();

    //     return $certificates->toArray();
    // }

    public function collection()
    {
        $certificates = Certificate::select('title', 'description')->get();
        $certificates = new Collection([
            ['linha 1', 'teste'],
            ['linha 2', 'teste'],
        ]);
        return $certificates;
    }

    public function headings(): array
    {
        return ["your", "headings"];
    }
}
