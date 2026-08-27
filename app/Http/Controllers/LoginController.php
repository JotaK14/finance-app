<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller{
    public function show(){
        return view('loginScreen');
    }

    public function store(Request $request){
        $userInfo = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'username.required' => 'Indique o nome de utilizador.',
            'username.string' => 'O nome de utilizador é inválido.',
            'password.required' => 'Indique a palavra-passe.',
            'password.string' => 'A palavra-passe é inválida.',
        ]);

        if (! Auth::attempt(['name' => $userInfo['username'], 'password' => $userInfo['password']])) {
            return response()->json([
                'message' => 'Nome de utilizador ou palavra-passe incorretos.',
            ], 422);
        }

        $request->session()->regenerate();

        return response()->json(['ok' => true]);
    }
}
