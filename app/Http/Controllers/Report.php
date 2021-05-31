<?php

namespace App\Http\Controllers;

use App\Exports\CertificateExport;
use App\Models\Career;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use Illuminate\Support\Collection;
// use Illuminate\Http\Request;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class Report extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function certificates($careerId = 1, $year = 'Todos', $limit = 10)
    {

        // dd($semesterId);
        // $year = 2021;
        // $month = 1;

        // $startDate = CarbonImmutable::create($year, $month);
        // $endDate = $startDate->addMonths(6);
        // $period = CarbonPeriod::create($startDate, '1 month', $endDate);

        // $periodMonths = new Collection([]);

        // foreach ($period as $date) {
        //     $periodMonths[] = [
        //         'date' => $date,
        //     ];
        // }

        $career = Career::find($careerId);
        $careers = Career::all()->toArray();
        $students = User::query()
            ->withSum(['certificates' => fn ($certificate) => $certificate->where('type_situation_id', '=', 2)], 'validated_hours_in_minutes')
            ->with(['course_curriculum'])
            ->whereHas('roles', fn ($roles) => $roles->where('name', 'student'));

        if ($year !== 'Todos' && is_numeric($year)) {
            $students->where('entry_year', '=', $year);
        }

        $students = $students
            ->where('career_id', '=', $career->id)
            ->paginate($limit);

        $years = ['Todos', ...range(2017, date('Y'), 1)];

        // dd($students);
        return Inertia::render('Report/Certificates', [
            'career' => $career,
            'students' => $students,
            'careers' => $careers,
            'years' => $years,
            'currentYear' => $year,
            'currentLimit' => $limit,
        ]);
    }

    public function exportCertificates($careerId = 1, $year = 'Todos', $limit = 10)
    {
        return Excel::download(new CertificateExport((int) $careerId, $year, $limit), 'certificados.xlsx');
    }
}
