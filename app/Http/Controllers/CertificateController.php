<?php

namespace App\Http\Controllers;

use App\Http\Requests\CertificateRequest;
use App\Models\Certificate;
use App\Models\User;
use Illuminate\Http\Request;
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
    public function index()
    {
        $user = User::find(auth()->user()->id);
        $certificates = $user->certificates()->paginate(10);

        $certificates->load('typeSituation');
        // dd($certificates);
        // $certificates->load('axle');

        return Inertia::render('Certificate/Index', [
            'certificates' => $certificates,
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

            $uploaded = $request->file('archive')->store('certificates/' . auth()->user()->id . '/');

            $validated['archive'] = $uploaded;
            $validated['user_id'] = auth()->user()->id;
            $validated['type_situation_id'] = 1;
            // $validated['axle_id'] = null;

            Certificate::create($validated);
            return Redirect::back()->with('success', 'Cadastrado com Sucesso!');

        } catch (\Exception $e) {
            dd($e);
            $errors = new MessageBag();
            $errors->add('store_certificate_error', 'Ocorreu um erro ao cadastrar o certificado, tente novamente');
            return Redirect::back()->withErrors($errors);
        }

        // dd($request);

        // $headers = array(
        //     'Content-Type: application/pdf',
        // );

        // return Storage::download('certificates/MeVCKqdOR6puxGbnWweSg5Fz02gNNp72zLJP7ijF.pdf', 'teste.pdf', $headers);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

        $headers = ['Content-Type: application/pdf'];

        return Storage::download($certificate->archive, 'mudar.pdf', $headers);
    }
}
