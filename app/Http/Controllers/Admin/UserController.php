<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    
    /**
     * Resets the password of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function resetPassword($id)
    {
        $users = User::findOrFail($id);
        $user->password = Hash::make('Welkom01');
        if($user->save()){
            return view('admin.users.index')->with('status', 'Wachtwoord gereset!');
        }
        return redirect()->back()->with('status_fail', 'Wachtwoord is niet gereset! Probeer het later opnieuw.');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('last_name', 'asc')->paginate(10);
        return view('admin.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        $user = new User();
        $user->first_name = ucfirst(strtolower($request->first_name));
        $user->last_name = ucfirst(strtolower($request->last_name));
        $user->email = strtolower($request->email);
        if(isset($request->is_admin)){
            $user->is_admin = 1;
        }
        else{
            $user->is_admin = 0;
        }
        $user->password = Hash::make('Welkom01');
        if($user->save()){
            return redirect()->route('admin.user.index')->with('status', 'Gebruiker aangemaakt!');
        }
        return redirect()->back()->with('status_fail', 'Gebruiker is niet aangemaakt! Probeer het later opnieuw');
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
        return view('admin.users.edit')->with('user', $user);
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
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        $user = User::findOrFail($id);
        $user->first_name = ucfirst(strtolower($request->first_name));
        $user->last_name = ucfirst(strtolower($request->last_name));
        $user->email = strtolower($request->email);
        if(isset($request->is_admin)){
            $user->is_admin = 1;
        }
        else{
            $user->is_admin = 0;
        }
        $user->password = Hash::make('Welkom01');
        if($user->save()){
            return redirect()->route('admin.user.index')->with('status', 'Gebruiker aangemaakt!');
        }
        return redirect()->back()->with('status_fail', 'Gebruiker is niet aangemaakt! Probeer het later opnieuw.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if($user->delete()){
            return redirect()->route('admin.user.index')->with('status', 'Gebruiker is gedeactiveerd!');
        }
        return redirect()->route()->back()->with('status_fail', 'Gebruiker deactiveren gefaald! Probeer het later nogmaals.');
    }
}
