<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeSituationRequest;
use App\Models\TypeSituation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class TypeSituationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typeSituations = TypeSituation::paginate(10);

        return Inertia::render('TypeSituation/Index', [
            'typeSituations' => $typeSituations,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('TypeSituation/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypeSituationRequest $request)
    {
        $validated = $request->validated();

        TypeSituation::create($validated);

        return Redirect::back()->with('success', 'Cadastrado com Sucesso!');
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
        $typeSituation = TypeSituation::findOrFail($id);

        return Inertia::render('TypeSituation/Edit', [
            'typeSituation' => $typeSituation,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TypeSituationRequest $request, $id)
    {
        $validated = $request->validated();

        $typeSituation = TypeSituation::findOrFail($id);

        $typeSituation->name = $validated['name'];

        $typeSituation->save();

        return Redirect::back()->with('success', 'Atualizado com Sucesso!');
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
}
