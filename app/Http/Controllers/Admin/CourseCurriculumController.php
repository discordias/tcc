<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Axle;
use App\Models\Career;
use App\Models\CourseCurriculum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CourseCurriculumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $career = Career::findOrFail($id);
        $axles = Axle::all()->toArray();

        return Inertia::render('Career/CreateCourseCurriculum', [
            'career' => $career,
            'axles' => $axles,
        ]);

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
        $courseCurriculum = new CourseCurriculum();
        $courseCurriculum->minutes_total = $request->total_minutes * 60;
        $courseCurriculum->description = $request->description;
        $courseCurriculum->career_id = $request->career_id;

        $courseCurriculum->save();

        foreach ($request->axles as $axle) {
            $axleModel = Axle::find($axle['id']);
            $courseCurriculum->axles()->save($axleModel, ['total_minutes' => $axle['total_minutes']]);
        }

        return redirect()->route('careers.show', ['id' => $request->career_id])->with('success', 'Cadastrado com Sucesso!');
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
}
