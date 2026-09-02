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
            'username.required' => 'Indique o nome de utilizador.',
            'username.min' => 'O nome de utilizador tem de ter pelo menos 4 caracteres.',
            'username.max' => 'O nome de utilizador não pode ter mais de 20 caracteres.',
            'username.alpha_num' => 'O nome de utilizador só pode ter letras e números.',
            'username.unique' => 'Já existe uma conta com esse nome de utilizador.',
            'password.required' => 'Indique a palavra-passe.',
            'password.min' => 'A palavra-passe tem de ter pelo menos 6 caracteres.',
            'password.confirmed' => 'As palavras-passe não coincidem.',
            'password.regex' => 'A palavra-passe tem de ter pelo menos uma letra e um número.',
        ]);

        User::create([
            'name' => $userInfo['username'],
            'password' => $userInfo['password'],
        ]);

        return response()->json(['ok' => true]);
    }
}
