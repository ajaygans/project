<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class logincontroller extends Controller
{
    public function halamanlogin(){
        return view('login.loginaplikasi');
    }


    public function postlogin(Request $request ){
        if(Auth::attempt($request->only('email','password'))){
            return redirect('/home');
        }
        return redirect('/');
    }


    public function logout(Request $request ){
        Auth::logout();
        return redirect ('/');
    }

    public function registrasi(){
        return view('login.registrasi');
    }

    public function simpanregistrasi(Request $request){
        // dd($request->all());

        User::create([
            'name' => $request->name,
            'level' => 'siswa',
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'remember_token'=> Str::random(60), 
        ]);

        return view('welcome');
    }
};
