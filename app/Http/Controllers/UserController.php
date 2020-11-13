<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('user.index') -> with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::all();
        return view('user.create', compact('role'));
    }
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);
    // }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

          //Validaciones
        $campos=[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
        $Mensaje = ["required" => 'El :attribute es requerido'];
        $this->validate($request, $campos, $Mensaje);


        //captura de datos enviados
        $data = request()->except('_token');
        
        //busca rol creado mediante el check asignado
        $rol = Role::findOrFail($data['role']);
        
        // // Creacion de usuario
        $user = User::create([
             'name' => $data['name'],
             'email' => $data['email'],
             'password' => Hash::make($data['password']),
        ]);
        // //asigna rol a user
         $user->roles()->attach(Role::where('name', $rol['name'])->first());


        // return response() -> json($empleado);
        return view('user.create');

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
        $user = User::findOrFail($id);
        $role = Role::all();
        $nameRole = implode(', ', $user -> roles() -> get() -> pluck('description')->toArray());

        return view('user.edit', compact(['user', 'nameRole', 'role'])) ;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        
        //   Validaciones
        $validation=[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
        $Mensaje = ["required" => 'El :attribute es requerido'];
        $this->validate($request, $validation, $Mensaje);

        //captura datos
        $dataUser = request() -> except(['_token', '_method']);

        // //actualiza datos de usuarios   
        $user -> roles() -> sync( $dataUser['role']);
        $user -> name = $dataUser['name'];
        $user -> email =  $dataUser['email'];
        $user -> password = Hash::make($dataUser['password']);
        $user ->  save();

        $ModifiedUser = User::findOrFail($user -> id);

        // return response() -> json($request);
        // return view('user.edit', compact($ModifiedUser));
        return redirect('user');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // dd($user);

        $user -> roles() -> detach();
        $user -> delete();

        return redirect('user');
    }
}
