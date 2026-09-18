<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordController extends Controller{
    public function mostrarPedido(){
        return view('forgotPasswordScreen');
    }

    public function enviarLink(Request $request){
        $dados = $request->validate([
            'email' => ['required', 'string', 'email'],
        ], [
            'email.required' => 'Indique o email da conta.',
            'email.email' => 'Indique um email válido.',
        ]);

        $status = Password::sendResetLink($dados);

        if ($status === Password::RESET_THROTTLED) {
            return response()->json([
                'message' => 'Já pediu um link há pouco. Aguarde um minuto antes de tentar novamente.',
            ], 422);
        }

        if ($status !== Password::RESET_LINK_SENT) {
            return response()->json([
                'message' => 'Não existe nenhuma conta com esse email.',
            ], 422);
        }

        return response()->json(['ok' => true]);
    }

    public function mostrarFormulario(Request $request, string $token){
        return view('resetPasswordScreen', [
            'token' => $token,
            'email' => $request->query('email', ''),
        ]);
    }

    public function guardarNovaPassword(Request $request){
        $dados = $request->validate([
            'token' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:6', 'confirmed', 'regex:/^(?=.*[a-zA-Z])(?=.*[0-9]).+$/'],
        ], [
            'password.min' => 'A palavra-passe tem de ter pelo menos 6 caracteres.',
            'password.regex' => 'A palavra-passe tem de ter pelo menos uma letra e um número.',
        ]);

        $status = Password::reset($dados, function ($utilizador, $password) {
            $utilizador->forceFill(['password' => $password])->save();
        });

        if ($status !== Password::PASSWORD_RESET) {
            return response()->json([
                'message' => 'O link de recuperação é inválido ou expirou.',
            ], 422);
        }

        return response()->json(['ok' => true]);
    }
}
