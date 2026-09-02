<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Support\CalculadoraIrs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class MainController extends Controller{
    public function show(){
        $utilizador = Auth::user();

        $saldo = $utilizador->saldo;

        $movimentos = $utilizador->movimentos()
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->get()
            ->map(function ($movimento) use (&$saldo, $utilizador) {
                $saldoAtual = $saldo;
                $saldo -= $movimento->valor;

                return [
                    'data' => $movimento->created_at->format('d/m'),
                    'descricao' => $movimento->descricao,
                    'tipo' => $movimento->tipo,
                    'classe' => config("movimentos.classes.{$movimento->tipo}"),
                    'valor' => $movimento->valor,
                    'saldoAtual' => $saldoAtual,
                    'saldoPos' => $saldoAtual - $utilizador->despesasMensais + $utilizador->salarioLiquido,
                ];
            });

        return view('mainScreen', [
            'saldo' => $utilizador->saldo,
            'saldoDefinido' => $utilizador->saldoDefinido,
            'despesasMensais' => $utilizador->despesasMensais,
            'salarioBruto' => $utilizador->salarioBruto,
            'salarioLiquido' => $utilizador->salarioLiquido,
            'irs' => $utilizador->irs,
            'movimentos' => $movimentos,
        ]);
    }

    public function atualizarValores(Request $request){
        $dados = $request->validate([
            'campo' => ['required', 'in:saldo, despesasMensais, salarioBruto, salarioLiquido'],
            'valor' => ['required', 'numeric', 'min:0', 'max:99999999.99'],
        ], [
            'campo.required' => 'Não foi indicado que valor alterar.',
            'campo.in' => 'Só é possível alterar o saldo da conta, as despesas mensais, o salário bruto ou o salário líquido.',
            'valor.required' => 'Indique um valor.',
            'valor.numeric' => 'O valor tem de ser um número.',
            'valor.min' => 'O valor não pode ser negativo.',
            'valor.max' => 'O valor é demasiado alto.',
        ]);

        $utilizador = Auth::user();
        $brutoAnterior = (float) $utilizador->salarioBruto;

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

        if ($dados['campo'] === 'salarioBruto' && $brutoAnterior !== (float) $dados['valor']) {
            $this->limparIrs($utilizador);
        }

        return response()->json(['ok' => true]);
    }

    public function guardarGanho(Request $request){
        $dados = $request->validate([
            'descricao' => ['required', 'string', 'max:255'],
            'valor' => ['required', 'numeric', 'min:0.01', 'max:99999999.99'],
        ], [
            'descricao.required' => 'Escreva uma descrição para o ganho.',
            'descricao.max' => 'A descrição não pode ter mais de 255 caracteres.',
            'valor.required' => 'Indique o valor do ganho.',
            'valor.numeric' => 'O valor tem de ser um número.',
            'valor.min' => 'O valor do ganho tem de ser maior do que zero.',
            'valor.max' => 'O valor é demasiado alto.',
        ]);

        $this->registar([
            'descricao' => $dados['descricao'],
            'tipo' => config('movimentos.tipoGanho'),
            'valor' => $dados['valor'],
        ]);

        return response()->json(['ok' => true]);
    }

    public function guardarDespesa(Request $request){
        $dados = $request->validate([
            'tipo' => ['required', Rule::in(config('movimentos.tiposDespesa'))],
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

        $this->registar([
            'descricao' => $dados['descricao'],
            'tipo' => $dados['tipo'],
            'valor' => -$dados['valor'],
        ]);

        return response()->json(['ok' => true]);
    }

        public function guardarIrs(Request $request){
        $utilizador = Auth::user();

        $dados = $request->validate([
            'residencia' => ['required', Rule::in(config('irs.residencias'))],
            'emAtividade' => ['required', 'boolean'],
            'incapacidade' => ['required', 'boolean'],
            'casado' => ['required', 'boolean'],
            'conjugeEmAtividade' => ['required', 'boolean'],
            'deficientesArmadas' => ['required', 'boolean'],
            'dependentes' => ['required', 'integer', 'min:0'],
        ], [
            'residencia.required' => 'Escolha a residência.',
            'residencia.in' => 'A residência tem de ser Continente, Açores ou Madeira.',
            'dependentes.required' => 'Indique o número de dependentes.',
            'dependentes.integer' => 'O número de dependentes tem de ser um número inteiro.',
            'dependentes.min' => 'O número de dependentes não pode ser negativo.',
            'dependentes.max' => 'O número de dependentes é demasiado alto.',
        ]);

        if (! in_array($dados['residencia'], config('irs.residenciasDisponiveis'), true)) {
            return response()->json([
                'message' => 'Por enquanto só é possível guardar com a residência no Continente.',
            ], 422);
        }

        $dados['casado'] = $dados['casado'] || $dados['conjugeEmAtividade'];
        $dados['incapacidade'] = $dados['incapacidade'] || $dados['deficientesArmadas'];

        $irs = $utilizador->irs()->updateOrCreate([], [
            ...$dados,
            'salarioBruto' => (float) $utilizador->salarioBruto,
        ]);

        $utilizador->setRelation('irs', $irs);
        $this->recalcularLiquido($utilizador);

        return response()->json(['ok' => true]);
    }

    private function limparIrs(User $utilizador): void{
        $utilizador->irs()->delete();
        $utilizador->setRelation('irs', null);
        $utilizador->update(['salarioLiquido' => 0]);
    }

    private function recalcularLiquido(User $utilizador): void{
        $irs = $utilizador->irs;

        if (! $irs) {
            return;
        }

        $bruto = (float) $utilizador->salarioBruto;
        $liquido = CalculadoraIrs::liquido($irs, $bruto);

        $irs->update(['salarioBruto' => $bruto, 'salarioLiquido' => $liquido]);
        $utilizador->update(['salarioLiquido' => $liquido]);
    }

    private function registar(array $movimento){
        DB::transaction(function () use ($movimento) {
            $utilizador = Auth::user();
            $utilizador->movimentos()->create($movimento);
            $utilizador->increment('saldo', $movimento['valor']);
        });
    }
}
