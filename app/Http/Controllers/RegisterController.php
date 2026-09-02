<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller{
    public function show(){
        return view('registerScreen');
    }

    public function store(Request $request){
        $userInfo = $request->validate([
            'username' => ['required', 'string', 'min:4', 'max:20','alpha_num:ascii','unique:users,name'],
            'password' => ['required', 'string', 'min:6', 'confirmed','regex:/^(?=.*[a-zA-Z])(?=.*[0-9]).+$/'],
        ], [
            'username.unique' => 'Já existe uma conta com esse nome de utilizador.',
            'password.min' => 'A palavra-passe tem de ter pelo menos 6 caracteres.',
            'password.regex' => 'A palavra-passe tem de ter pelo menos uma letra e um número.',
        ]);

        User::create([
            'name' => $userInfo['username'],
            'password' => $userInfo['password'],
        ]);

        return response()->json(['ok' => true]);
    }
}
