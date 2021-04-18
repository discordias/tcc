<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;
use Inertia\Inertia;

class ValidatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $validators = User::role('validator')->paginate(20);

        return Inertia::render('Admin/Validators/Index', [
            'validators' => $validators,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Validators/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();

        try {

            $validated['password'] = bcrypt('password');
            $user = User::create($validated);
            $user->assignRole('validator');

            DB::commit();
            return Redirect::back();
        } catch (\Exception $e) {

            DB::rollBack();
            $errors = new MessageBag();
            $errors->add('store_validator_error', 'Ocorreu um erro ao cadastrar o validador, tente novamente');
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
        $validator = User::where('id', $id)
        ->whereHas('roles', fn ($roles) => $roles->where('name', 'validator'))
        ->firstOrFail();

        return Inertia::render('Admin/Validators/Edit', [
            'validator' => $validator,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $validator = User::where('id', $id)
        ->whereHas('roles', fn ($roles) => $roles->where('name', 'validator'))
        ->firstOrFail();

    $validated = $request->validated();

    $validator->name = $validated['name'];
    $validator->email = $validated['email'];
    $validator->save();

    return Redirect::back();
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
