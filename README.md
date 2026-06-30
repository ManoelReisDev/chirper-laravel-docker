# Laravel 13 com Docker

Ambiente local para estudo de Laravel 13 com PHP, Node.js, MySQL e Nginx, isolado por containers e sem instalar essas dependências no host.

## Estrutura

- `docker-compose.yml`: orquestra os containers.
- `docker/php/Dockerfile`: imagem do PHP-FPM com Composer e extensões do Laravel.
- `docker/node/Dockerfile`: imagem do Node.js LTS para Vite, npm e assets.
- `docker/nginx/default.conf`: Nginx servindo a pasta `public` do Laravel.
- `src/.env.example`: base de variáveis do Laravel.
- `src/.env`: arquivo real usado pelo Laravel, criado a partir do exemplo.
- `src/`: código-fonte do Laravel.

## Função de cada container

- `php`: executa o Laravel, roda `artisan`, `composer` e atende requisições PHP via PHP-FPM.
- `node`: executa `npm`, `npm run dev` e o pipeline de front-end do Laravel.
- `mysql`: guarda os dados do banco com persistência em volume nomeado.
- `nginx`: expõe a aplicação no navegador e repassa requisições PHP para o container `php`.

## Por que separar os containers

Separar PHP, Node, MySQL e Nginx evita instalar dependências no host, reduz conflito de versões e deixa cada parte do ambiente mais fácil de atualizar, reiniciar e entender.

## Primeiro uso após clonar

1. Copie o arquivo de exemplo do Laravel para `src/.env`.
2. Suba os containers.
3. Instale as dependências PHP e Node dentro dos containers.
4. Gere a `APP_KEY` se ela ainda estiver vazia.

```bash
cp src/.env.example src/.env
docker compose up -d --build
docker compose exec php composer install
docker compose exec php php artisan key:generate
docker compose exec node npm install
```

## Comandos do dia a dia

Subir o ambiente:

```bash
docker compose up -d --build
```

Derrubar o ambiente:

```bash
docker compose down
```

Remover também os dados do MySQL:

```bash
docker compose down -v
```

Instalar dependências PHP:

```bash
docker compose exec php composer install
```

Instalar dependências Node:

```bash
docker compose exec node npm install
```

Rodar o Vite em modo desenvolvimento:

```bash
docker compose exec node npm run dev
```

Executar migrations:

```bash
docker compose exec php php artisan migrate
```

Rodar o servidor embutido do Laravel, se quiser testar sem Nginx:

```bash
docker compose exec php php artisan serve --host=0.0.0.0 --port=8000
```

## Como o Laravel conecta ao MySQL

No arquivo `src/.env`, use `DB_HOST=mysql`, porque esse é o nome do serviço do banco dentro da rede do Docker Compose. O MySQL fica acessível pela porta interna `3306`.

Se você quiser acessar o banco pelo host, o mapeamento padrão é `3307:3306` para evitar conflito com uma instância local de MySQL já instalada.

## Como acessar a aplicação

Depois de subir os containers e instalar as dependências, abra `http://localhost:8000` no navegador.

## Permissões

Se aparecer erro de permissão em `storage` ou `bootstrap/cache`, ajuste o dono dos arquivos dentro do container PHP:

```bash
docker compose exec php sh -lc "chmod -R ug+rwX storage bootstrap/cache"
```

Se necessário, recrie o ambiente com o mesmo UID/GID do seu usuário no `.env`.

## O que vai para o Git

Deve ir para o Git:

- `docker-compose.yml`
- `docker/`
- `src/.env.example`
- `README.md`
- o código do Laravel em `src/`

Não deve ir para o Git:

- `src/.env`
- `src/vendor/`
- `src/node_modules/`
- `src/storage/`
- `src/bootstrap/cache/`
- dados do banco do volume `mysql-data`

## Observação sobre `php artisan serve`

Ele é útil só como alternativa de estudo. No setup principal, o acesso normal deve ser feito pelo Nginx.# laravel-node-docker-template
