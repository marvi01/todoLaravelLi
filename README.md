# LiberFly API

Este README fornece instruções sobre como executar o projeto e como usar a API.

## Pré-requisitos

Antes de começar, verifique se você tem os seguintes itens instalados:

- [MySQL](https://www.mysql.com/) (ou outro banco de dados compatível)
- [Composer](https://getcomposer.org/) (para gerenciar dependências PHP)

## Configuração do Projeto

### 1. Clone o Repositório

Clone o repositório para sua máquina local e execute os comandos nessa ordem:

```bash
git clone https://github.com/marvi01/todoLaravelLi
cd todoProjectLi
composer install
cp .env.example .env
php artisan migrate
php artisan serve
````

### 1. Uso da API

Todas as rotas da API, com exceção de login e registro, exigem
que o token seja gerado através do login para autenticação.
[Documentação da API](https://app.swaggerhub.com/apis-docs/marcosvini10987/liberfly/1.0.0) 


