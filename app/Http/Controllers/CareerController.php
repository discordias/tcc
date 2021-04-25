<?php

namespace App\Http\Controllers;

use App\Http\Requests\CareerResquest;
use App\Models\Career;
use App\Models\TypeSituation;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CareerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $careers = Career::paginate(10);

        return Inertia::render('Career/Index', [
            'careers' => $careers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Career/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CareerResquest $request)
    {
        $validated = $request->validated();

        Career::create($validated);

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
        $career = Career::findOrFail($id);
        $students = User::where('career_id', $id)
            ->whereHas('roles', fn ($roles) => $roles->where('name', 'student'))
            ->paginate(20);

        $typeSituations = TypeSituation::all();

        return Inertia::render('Career/Show', [
            'career' => $career,
            'students' => $students,
            'typeSituations' => $typeSituations,
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
        $career = Career::findOrFail($id);

        return Inertia::render('Career/Edit', [
            'career' => $career,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CareerResquest $request, $id)
    {
        $validated = $request->validated();

        $career = Career::findOrFail($id);

        $career->name = $validated['name'];
        $career->code = $validated['code'];

        $career->save();

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
