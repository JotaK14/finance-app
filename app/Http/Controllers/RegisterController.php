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
            'username' => ['required', 'string', 'min:4', 'max:20','regex:/^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9]+$/','unique:users,name'],
            'phoneNumber' => ['required', 'digits:9', 'unique:users,phoneNumber'],
            'password' => ['required', 'string', 'min:6', 'confirmed','regex:/^(?=.*[a-zA-Z])(?=.*[0-9]).+$/'],
        ], [
            'username.unique' => 'Já existe uma conta com esse nome de utilizador.',
            'phoneNumber.unique' => 'Já existe uma conta com esse número de telemóvel.',
        ]);

        User::create([
            'name' => $userInfo['username'],
            'phoneNumber' => $userInfo['phoneNumber'],
            'password' => $userInfo['password'],
        ]);

        return response()->json(['ok' => true]);
    }
}
