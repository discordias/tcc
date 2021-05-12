<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Imports\UsersImport;
use App\Models\Career;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = User::role('student')->paginate(20);
        $students->load('career');

        return Inertia::render('Admin/Students/Index', [
            'students' => $students,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $careers = Career::with('CourseCurricula')->get();

        return Inertia::render('Admin/Students/Create', [
            'careers' => $careers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentStoreRequest $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();

        try {

            $validated['password'] = Hash::make('password');
            $user = User::create($validated);
            $user->assignRole('student');
            DB::commit();
            return Redirect::back()->with('success', 'Cadastrado com Sucesso!');
        } catch (\Exception $e) {

            DB::rollBack();
            $errors = new MessageBag();
            $errors->add('store_student_error', 'Ocorreu um erro ao cadastrar o aluno, tente novamente');
            return Redirect::back()->withErrors($errors);
        }

    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        $errors = [];
        $registred = [];

        if ($request->hasFile('archive')) {
            $import = new UsersImport($request->only(['career_id','entry_year','entry_semester']));
            $import->import($request->file('archive'));
            $errors = $import->getErrors();
            $registred = $import->getRegistred();
        }

        return Inertia::render('Admin/Students/Imports', [
            'errors' => $errors,
            'registred' => $registred,
        ]);
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
        $student = User::where('id', $id)
            ->whereHas('roles', fn ($roles) => $roles->where('name', 'student'))
            ->firstOrFail();

        $careers = Career::with('CourseCurricula')->get();

        return Inertia::render('Admin/Students/Edit', [
            'careers' => $careers,
            'student' => $student,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudentUpdateRequest $request, $id)
    {
        $student = User::where('id', $id)
            ->whereHas('roles', fn ($roles) => $roles->where('name', 'student'))
            ->firstOrFail();

        $validated = $request->validated();

        $student->name = $validated['name'];
        $student->email = $validated['email'];
        $student->career_id = $validated['career_id'];
        $student->save();

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
