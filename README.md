# Finance App

Aplicação web em Laravel para gestão financeira pessoal: registo de saldo, salário
bruto/líquido (com cálculo automático de IRS), ganhos e despesas mensais.

## Funcionalidades

- Split screen inicial que redireciona automaticamente para o login, e registo/autenticação de utilizadores
- Recuperação de password por email (login é feito por nome de utilizador, o email serve só
  para este fluxo) e definição de nova palavra-passe através do link recebido
- Definição do saldo inicial da conta (só pode ser definido uma vez)
- Edição, a qualquer momento, das despesas mensais e do salário bruto
- Cálculo automático do salário líquido a partir do salário bruto, com base nas variáveis do IRS
  (residência, situação conjugal, dependentes, incapacidade, etc.) — recalculado sempre que o
  salário bruto muda
- Registo de ganhos e despesas por categoria (Alimentação, Transporte, Habitação, Lazer),
  com atualização automática do saldo
- Edição e remoção de movimentos já registados, com recálculo automático do saldo
- Histórico de movimentos com saldo em cada momento e previsão do saldo no final do mês
- Botão para ocultar/mostrar todos os valores monetários apresentados no ecrã
- Overlay de carregamento (com spinner) sempre que se aguarda por uma resposta do servidor,
  para evitar cliques repetidos

## Stack

- [Laravel 13](https://laravel.com)
- SQLite (base de dados por omissão)
- [Resend](https://resend.com) para envio dos emails de recuperação de password
- CSS e JavaScript simples, um ficheiro por página, em `public/css` e `public/js` (servidos
  como estáticos via `asset()`) — o Tailwind CSS/Vite incluídos no scaffolding do projeto não
  são usados nas páginas da aplicação

## Instalação

Pré-requisitos: PHP 8.3+, Composer e Node.js.

    composer install
    npm install

    cp .env.example .env
    php artisan key:generate

    touch database/database.sqlite
    php artisan migrate

Os emails de recuperação de password são enviados via [Resend](https://resend.com)
(`resend/resend-php`). É necessário definir `MAIL_MAILER=resend` e `RESEND_API_KEY` no `.env`
(esta variável não vem no `.env.example`) — sem isso, o envio do link de recuperação falha.

## Correr em desenvolvimento

    composer run dev

Isto arranca em simultâneo o servidor Laravel, a queue, o Pail (logs) e o Vite (herdado do
scaffolding do Laravel; não é usado pelas páginas da aplicação, que servem CSS/JS estáticos
diretamente de `public/`).
A aplicação fica disponível em http://localhost:8000.

## Licença

Este projeto está licenciado sob a [MIT license](LICENSE).
