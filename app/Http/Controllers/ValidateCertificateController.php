<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateCertificateRequest;
use App\Models\Axle;
use App\Models\Career;
use App\Models\Certificate;
use App\Models\TypeSituation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Inertia\Inertia;

class ValidateCertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($careerId, $typeSituation)
    {
        $career = Career::findOrFail($careerId);

        $certificates = Certificate::where('type_situation_id', $typeSituation)
            ->whereHas('user', fn ($user) => $user->where('career_id', $careerId))
            ->paginate(20);

        $certificates->load('user');
        $certificates->load('typeSituation');
        $certificates->load('axle');

        $typeSituations = TypeSituation::all();
        $currentTypeSituation = TypeSituation::find($typeSituation);

        return Inertia::render('Validator/Certificate/Index', [
            'certificates' => $certificates,
            'typeSituations' => $typeSituations,
            'currentTypeSituation' => $currentTypeSituation,
            'career' => $career,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $certificate = Certificate::where('id', $id)
            ->firstOrFail();

        $certificate->load('TypeSituation');
        $certificate->load('Axle');
        $certificate->load('User');
        $certificate->validated_hours = $certificate->validated_hours;

        return Inertia::render('Validator/Certificate/Show', [
            'certificate' => $certificate,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $certificate = Certificate::where('id', $id)
            ->whereNotIn('type_situation_id', [2,3])
            ->firstOrFail();

        $certificate->load('user');
        $certificate->load('typeSituation');

        return Inertia::render('Validator/Certificate/Validate', [
            'certificate' => $certificate,
            'axles' => Axle::all(),
            'typeSituations' => TypeSituation::where('id', '!=', 1)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateCertificateRequest $request, $id)
    {
        $validated = $request->validated();
        $certificate = Certificate::where('id', $id)->with('user')->firstOrFail();
        $careeerId = $certificate->user->career_id;

        $certificate->axle_id = $validated['axle_id'];
        $certificate->type_situation_id = $validated['type_situation_id'];
        $certificate->observation = $validated['observation'];
        $certificate->validated_hours_in_minutes = ($validated['validated_hours'] * 60) + $validated['validated_minutes'];

        $certificate->save();

        return redirect()->route('validator.certificates.index', ['career_id' => $careeerId, 'type_situation' => 1])
            ->with('success', 'Validação realizada com Sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function download($id)
    {
        $certificate = Certificate::where('id', $id)
            ->firstOrFail();

        $filename = $certificate->title;
        $path = storage_path('app/'. $certificate->archive);

        return Response::make(file_get_contents($path), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$filename.'"'
        ]);

    }

}
