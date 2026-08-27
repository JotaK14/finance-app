<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class MainController extends Controller{
    public function show(){
        $utilizador = Auth::user();

        $saldo = $utilizador->saldo;

        $despesas = $utilizador->despesas()
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->get()
            ->map(function ($despesa) use (&$saldo, $utilizador) {
                $saldoAtual = $saldo;
                $saldo += $despesa->valor;

                return [
                    'data' => $despesa->created_at->format('d/m'),
                    'descricao' => $despesa->descricao,
                    'tipo' => $despesa->tipo,
                    'valor' => $despesa->valor,
                    'saldoAtual' => $saldoAtual,
                    'saldoPos' => $saldoAtual - $utilizador->despesasMensais,
                ];
            });

        return view('mainScreen', [
            'saldo' => $utilizador->saldo,
            'saldoDefinido' => $utilizador->saldoDefinido,
            'despesasMensais' => $utilizador->despesasMensais,
            'despesas' => $despesas,
        ]);
    }

    public function atualizarValores(Request $request){
        $dados = $request->validate([
            'campo' => ['required', 'in:saldo,despesasMensais'],
            'valor' => ['required', 'numeric', 'min:0', 'max:99999999.99'],
        ], [
            'campo.required' => 'Não foi indicado que valor alterar.',
            'campo.in' => 'Só é possível alterar o saldo da conta ou as despesas mensais.',
            'valor.required' => 'Indique um valor.',
            'valor.numeric' => 'O valor tem de ser um número.',
            'valor.min' => 'O valor não pode ser negativo.',
            'valor.max' => 'O valor é demasiado alto.',
        ]);

        $utilizador = Auth::user();

        if ($dados['campo'] === 'saldo' && $utilizador->saldoDefinido) {
            return response()->json([
                'message' => 'O saldo da conta só pode ser definido uma vez.',
            ], 422);
        }

        $utilizador->{$dados['campo']} = $dados['valor'];

        if ($dados['campo'] === 'saldo') {
            $utilizador->saldoDefinido = true;
        }

        $utilizador->save();

        return response()->json(['ok' => true]);
    }


    public function guardarDespesa(Request $request){
        $dados = $request->validate([
            'tipo' => ['required', Rule::in(array_keys(config('despesas.classes')))],
            'descricao' => ['required', 'string', 'max:255'],
            'valor' => ['required', 'numeric', 'min:0.01', 'max:99999999.99'],
        ], [
            'tipo.required' => 'Escolha o tipo da despesa.',
            'tipo.in' => 'Esse tipo de despesa não existe.',
            'descricao.required' => 'Escreva uma descrição para a despesa.',
            'descricao.max' => 'A descrição não pode ter mais de 255 caracteres.',
            'valor.required' => 'Indique o valor da despesa.',
            'valor.numeric' => 'O valor tem de ser um número.',
            'valor.min' => 'O valor da despesa tem de ser maior do que zero.',
            'valor.max' => 'O valor é demasiado alto.',
        ]);

        DB::transaction(function () use ($dados) {
            $utilizador = Auth::user();

            $utilizador->despesas()->create($dados);

            $utilizador->decrement('saldo', $dados['valor']);
        });

        return response()->json(['ok' => true]);
    }
}
