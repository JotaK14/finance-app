# Finance App

Aplicação web em Laravel para gestão financeira pessoal: registo de saldo, salário
bruto/líquido (com cálculo automático de IRS), ganhos e despesas mensais.

## Funcionalidades

- Registo e autenticação de utilizadores
- Definição do saldo inicial da conta (definido uma única vez)
- Cálculo de salário líquido a partir do salário bruto, com base nas variáveis do IRS
  (residência, situação conjugal, dependentes, incapacidade, etc.)
- Registo de ganhos e despesas, com atualização automática do saldo
- Histórico de movimentos com saldo em cada momento

## Stack

- [Laravel 13](https://laravel.com)
- SQLite (base de dados por omissão)
- [Tailwind CSS 4](https://tailwindcss.com) + [Vite](https://vitejs.dev)

## Instalação

Pré-requisitos: PHP 8.3+, Composer e Node.js.

    composer install
    npm install

    cp .env.example .env
    php artisan key:generate

    touch database/database.sqlite
    php artisan migrate

## Correr em desenvolvimento

    composer run dev

Isto arranca em simultâneo o servidor Laravel, a queue, o Pail (logs) e o Vite.
A aplicação fica disponível em http://localhost:8000.

## Licença

Este projeto está licenciado sob a [MIT license](LICENSE).
