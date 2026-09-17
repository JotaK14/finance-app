# Finance App — guia para agentes

Aplicação Laravel de gestão financeira pessoal. Ver README.md para instalação e execução.

## Domínio

- `User`: dono dos dados, tem `saldo`, `despesasMensais`, `salarioBruto`, `salarioLiquido`.
  `saldoDefinido` marca que o saldo inicial já foi definido (só pode acontecer uma vez).
- `Movimento`: ganho ou despesa (`tipo`, `descricao`, `valor`). Despesas guardam `valor` negativo.
  Tipos de despesa e classes CSS associadas estão em `config/movimentos.php`.
- `Irs`: dados usados para calcular o salário líquido a partir do bruto (residência, situação
  conjugal, dependentes, incapacidade). Regras de residência disponíveis em `config/irs.php`
  (atualmente só "Continente" está implementado).
- `App\Support\CalculadoraIrs`: calcula o `salarioLiquido` a partir de `Irs` + salário bruto.
  É a única fonte de verdade para as tabelas de retenção — não recriar essa lógica noutro sítio.

## Convenções

- Nomes de variáveis, métodos, rotas e chaves de configuração em português
  (`salarioBruto`, `guardarGanho`, `atualizarValores`) — manter consistência com o existente.
- Sem suite de testes automatizados neste projeto (decisão deliberada, não adicionar
  PHPUnit/Pest a não ser que peçam explicitamente).
- Alterar `salarioBruto` invalida o `Irs` guardado (ver `MainController::limparIrs`) — ter isto
  em conta ao mexer nesse fluxo.
- Middleware `terminar.sessao` (`app/Http/Middleware/TerminarSessao.php`) impede utilizadores
  autenticados de voltar a ver login/registo/splash.
