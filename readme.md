# Projeto API + Admin da Vestylle

## Ferramentas

- Laravel 5.7
- Laravel Generator
- Adminlte
- Yajra DataTables v8
- Languages / locale pt-BR
- Laradock
- Docker Vessel

## Clone com submodulos

`git clone --recursive https://github.com/grupotesseract/vestylle-webapi.git`

# Setup local usando o Laradock

## Rodando o projeto

Buildar Laradock
- `cd laradock`
- `cp env-example .env` (editar caso seja necessario portas / BD's diferentes)
    - Alterar `DATA_PATH_HOST=~/.laradock/vestylle`
    - Alterar `POSTGRES_DB=vestylle`
- No `.env` do projeto:
    ```
    APP_NAME=vestylle-webapi
    DB_CONNECTION=pgsql
    DB_HOST=172.17.0.1
    DB_PORT=5432
    DB_DATABASE=vestylle
    DB_USERNAME=default
    DB_PASSWORD=secret
    ```
- `docker-compose up -d nginx php-fpm postgres`
- `docker-compose exec workspace composer install`
- `docker-compose exec workspace php artisan key:generate`
- `docker-compose exec workspace php artisan migrate --seed`

Acertar .env do projeto de acordo com as configs do laradock

# Setup local usando o Docker Vessel

```
# Start Vessel and prepare the environment:

cp .env.example-vessel .env
./vessel start
./vessel composer install
./vessel artisan key:generate
./vessel artisan migrate --seed

# Prepare de Assets
./vessel yarn install
./vessel yarn run watch
```

**Access [http://localhost](http://localhost)**
