<?php

namespace App\Http\Controllers;

use App\Http\Requests\CertificateRequest;
use App\Models\Axle;
use App\Models\Certificate;
use App\Models\TypeSituation;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\MessageBag;
use Inertia\Inertia;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($typeSituation = null)
    {
        $userId = auth()->user()->id;
        $user = User::find(auth()->user()->id);

        if ($typeSituation == null) {
            $typeSituations = TypeSituation::query()
                ->withCount(['certificates' =>  function ($certificate) use($userId) {
                return $certificate->whereHas('user', fn ($user) => $user->where('id', $userId) );
            }])
            ->get();

            return Inertia::render('Certificate/Index', [
                'typeSituations' => $typeSituations,
            ]);
        }

        $certificates = $user->certificates()
            ->where('type_situation_id', $typeSituation)
            ->paginate(10);

        $certificates->load('typeSituation');
        $certificates->load('axle');

        $typeSituations = TypeSituation::all();
        $currentTypeSituation = TypeSituation::find($typeSituation);

        return Inertia::render('Certificate/List', [
            'certificates' => $certificates,
            'typeSituations' => $typeSituations,
            'currentTypeSituation' => $currentTypeSituation,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Certificate/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CertificateRequest $request)
    {
        $validated = $request->validated();

        try {

            $uploaded = $request->file('archive')->store('certificates/' . auth()->user()->id);

            $validated['archive'] = $uploaded;
            $validated['user_id'] = auth()->user()->id;
            $validated['type_situation_id'] = 1;
            // $validated['axle_id'] = null;

            Certificate::create($validated);
            return Redirect::back()->with('success', 'Cadastrado com Sucesso!');

        } catch (\Exception $e) {
            $errors = new MessageBag();
            $errors->add('store_certificate_error', 'Ocorreu um erro ao cadastrar o certificado, tente novamente');
            return Redirect::back()->withErrors($errors);
        }

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
            ->where('user_id', auth()->user()->id)
            ->firstOrFail();

        $certificate->load('TypeSituation');
        $certificate->load('Axle');
        $certificate->load('User');
        $certificate->validated_hours = $certificate->validated_hours;

        return Inertia::render('Certificate/Show', [
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
            ->where('user_id', auth()->user()->id)
            ->whereNotIn('type_situation_id', [2, 3])
            ->firstOrFail();

        return Inertia::render('Certificate/Edit', [
            'certificate' => $certificate,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CertificateRequest $request, $id)
    {
        $validated = $request->validated();

        $certificate = Certificate::where('id', $id)
            ->where('user_id', auth()->user()->id)
            ->whereNotIn('type_situation_id', [2, 3])
            ->firstOrFail();

        $currentFile = $certificate->archive;

        try {

            $uploaded = $request->file('archive')->store('certificates/' . auth()->user()->id);

            $validated['archive'] = $uploaded;
            $certificate->description = $validated['description'];
            $certificate->title = $validated['title'];
            $certificate->archive = $uploaded;

            $certificate->save();
            Storage::delete($currentFile);

            return Redirect::back()->with('success', 'Cadastrado com Sucesso!');

        } catch (\Exception $e) {
            $errors = new MessageBag();
            $errors->add('store_certificate_error', 'Ocorreu um erro ao cadastrar o certificado, tente novamente');
            return Redirect::back()->withErrors($errors);
        }
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
            ->where('user_id', auth()->user()->id)
            ->firstOrFail();

        $filename = $certificate->title;
        $path = storage_path('app/'. $certificate->archive);

        return Response::make(file_get_contents($path), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$filename.'"'
        ]);
    }
}
