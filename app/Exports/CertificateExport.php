<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CertificateExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    private int $careerId;
    private $year;
    private int $limit;

    public function __construct(int $careerId, $year, int $limit)
    {
        $this->careerId = $careerId;
        $this->year = $year;
        $this->limit = $limit;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // $career = Career::find($this->careerId);
        $students = User::query()
            ->withSum(['certificates' => fn ($certificate) => $certificate->where('type_situation_id', '=', 2)], 'validated_hours_in_minutes')
            ->with(['course_curriculum'])
            ->whereHas('roles', fn ($roles) => $roles->where('name', 'student'))
            ->where('career_id', '=', $this->careerId);


        if ($this->year !== 'Todos' && is_numeric($this->year)) {
            $students->where('entry_year', '=', $this->year);
        }

        $students = $students->limit($this->limit)->get();

        return $students->map(function ($student) {

            return [
                'Semestre Ingresso' => $student->entry_semester . '/' . $student->entry_year,
                'nome' => $student->name,
                'matricula' => $student->registration_number,
                'E-mail' => $student->email,
                'Total Realizado' => $student->certificates_sum_validated_hours_in_minutes
                    ? $this->formatHours($student->certificates_sum_validated_hours_in_minutes)
                    :'',
                '%' => $student->course_curriculum->minutes_total
                    ? ($student->certificates_sum_validated_hours_in_minutes/ $student->course_curriculum->minutes_total) * 100
                    : '--',
                'Quantidade Necessário' => $student->course_curriculum->minutes_total
                    ? $this->formatHours($student->course_curriculum->minutes_total)
                    : '',
            ];
        });

    }

    private function formatHours($minutes): string
    {
        return sprintf("%02d", ($minutes / 60 )) . ':' . sprintf("%02d",($minutes % 60));
    }

    public function headings(): array
    {
        return ["Semestre Ingresso", "Nome", "Matricula", "E-mail", "Total Realizado", "Porcentagem %", "Quantidade Necessário"];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:G1')->getAlignment()->applyFromArray(
            ['horizontal' => 'center', 'vertical' => 'center']
        );

        // return [
        //     // Style the first row as bold text.
        //     1    => ['font' => ['bold' => true]],

        //     // Styling a specific cell by coordinate.
        //     'B2' => ['font' => ['italic' => true]],

        //     // Styling an entire column.
        //     'C'  => ['font' => ['size' => 16]],
        // ];
    }
}
