# Chirper

[![Status](https://img.shields.io/badge/status-em%20desenvolvimento-yellow)](./)
[![Laravel](https://img.shields.io/badge/Laravel-13.8-FF2D20?logo=laravel&logoColor=white)](https://laravel.com/)
[![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![License](https://img.shields.io/badge/license-MIT-green)](#licença)

> Chirper é uma aplicação social simples construída com Laravel, focada em autenticação, publicação de mensagens curtas e gerenciamento de conteúdo com edição e exclusão de posts próprios.

---

<img width="947" height="857" alt="image" src="https://github.com/user-attachments/assets/535ad3b8-9081-4ee2-9cd4-579d4b95ad7b" />

## Visão Geral

Este projeto foi desenvolvido como prática de back-end com Laravel, usando uma arquitetura organizada, autenticação básica, autorização por policy e interface construída com Blade.

O ambiente local é totalmente containerizado com Docker, o que facilita a execução sem instalar PHP, MySQL e Nginx diretamente no computador.

---

## Funcionalidades

- Cadastro de usuários
- Login e logout
- Criação de chirps
- Edição e exclusão apenas dos chirps do próprio usuário
- Feed com os posts mais recentes
- Feedback visual para ações bem-sucedidas
- Interface responsiva com Blade Components

---

## Rotas da Aplicação

| Rota | Método | Acesso | Descrição |
|---|---|---|---|
| `/` | `GET` | Pública | Página inicial com o feed de chirps. |
| `/login` | `GET` | Visitante | Formulário de login. |
| `/login` | `POST` | Visitante | Autentica o usuário. |
| `/register` | `GET` | Visitante | Formulário de cadastro. |
| `/register` | `POST` | Visitante | Cria uma nova conta. |
| `/logout` | `POST` | Autenticado | Encerra a sessão do usuário. |
| `/chirps` | `POST` | Autenticado | Cria um novo chirp. |
| `/chirps/{chirp}/edit` | `GET` | Autenticado | Exibe o formulário de edição. |
| `/chirps/{chirp}` | `PUT` | Autenticado | Atualiza um chirp existente. |
| `/chirps/{chirp}` | `DELETE` | Autenticado | Remove um chirp existente. |

---

## Tecnologias Utilizadas

| Tecnologia | Uso no projeto |
|---|---|
| Laravel 13 | Framework principal da aplicação |
| PHP 8.3 | Linguagem de backend |
| MySQL | Banco de dados relacional |
| Nginx | Servidor web |
| Docker Compose | Orquestração do ambiente local |
| Blade | Camadas de view e componentes reutilizáveis |
| DaisyUI | Base visual dos componentes |
| Tailwind CSS | Utilitários de estilo |

---

## Estrutura do Projeto

- `docker-compose.yml`: orquestra os containers do ambiente.
- `docker/php/Dockerfile`: imagem do PHP com dependências necessárias.
- `docker/nginx/default.conf`: configuração do Nginx.
- `src/`: aplicação Laravel.
- `src/app/`: controllers, models, providers e policies.
- `src/resources/views/`: views Blade da aplicação.
- `src/routes/`: rotas web e console.

---

## Como Executar

### 1. Copie as variáveis de ambiente

```bash
cp src/.env.example src/.env
```

Depois, ajuste as credenciais do banco no `src/.env` para os valores do seu ambiente.

### 2. Suba o ambiente

```bash
docker compose up -d --build
```

### 3. Instale as dependências

```bash
docker compose exec php composer install
```

### 4. Gere a chave da aplicação

```bash
docker compose exec php php artisan key:generate
```

### 5. Execute as migrations

```bash
docker compose exec php php artisan migrate
```

### 6. Acesse no navegador

Abra:

```bash
http://localhost:8000
```

## Variáveis de Ambiente

No arquivo `src/.env`, o banco de dados deve apontar para o serviço interno do Docker:

```env
DB_HOST=mysql
DB_PORT=3306
```

Também lembre de criar e definir suas credenciais, por exemplo:

```env
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=secret
```

---

## Agradecimentos

Este projeto foi desenvolvido com base no curso oficial do Laravel:

[Getting Started with Laravel - What's Next?](https://laravel.com/learn/getting-started-with-laravel)

---

## Licença

Este projeto está sob a licença MIT.
