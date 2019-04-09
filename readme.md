# Vestylle API + Admin

## Ferramentas

- Laravel 5.7
- InfyOm Laravel Generator
- AdminLTE
- Yajra DataTables
- Docker Vessel
- Laradock

## Instalação

### Opção 1: Setup local usando Laradock

- Clonar o projeto com os submódulos:
  ``` sh
  git clone --recursive https://github.com/grupotesseract/vestylle-webapi
  ```
- Buildar Laradock:
  ``` sh
  cd laradock
  cp env-example .env
  ```
- Editar no `.env` do Laradock:
  - `DATA_PATH_HOST=~/.laradock/vestylle`
  - `POSTGRES_DB=vestylle`
  - Realizar demais edições caso seja necessário alterar portas / BD's
- Em seguida, editar no `.env` do projeto:
  ``` ini
  APP_NAME=vestylle-webapi
  DB_CONNECTION=pgsql
  DB_HOST=172.17.0.1
  DB_PORT=5432
  DB_DATABASE=vestylle
  DB_USERNAME=default
  DB_PASSWORD=secret
  ```
- Executar os containers e comandos na raiz do projeto:
  ``` sh
  docker-compose up -d nginx php-fpm postgres
  docker-compose exec workspace composer install
  docker-compose exec workspace php artisan key:generate
  docker-compose exec workspace php artisan migrate --seed
  ```

### Opção 2: Setup local usando Docker Vessel

- Clonar o projeto:
  ``` sh
  git clone --recursive https://github.com/grupotesseract/vestylle-webapi
  ```
- Criar o `.env` e buildar o projeto:
  ``` sh
  cp .env.example-vessel .env
  ./vessel start
  ./vessel composer install
  ./vessel artisan key:generate
  ./vessel artisan migrate --seed
  ```
- Build dos assets e iniciar o desenvolvimento:
  ``` sh
  ./vessel yarn install
  ./vessel yarn run watch
  ```
- Acessar [http://localhost](http://localhost)

### Deploy

- Configurar os remotes:
  ``` sh
  # Production - Cacodemon
  git remote add prod cacodemon:/var/www/html/vestylle.grupotesseract.com.br/backend.git

  # Develop & Stage - TesseractDev
  git remote add test tesseractdev:/var/www/html/vestylle-webapi/vestylle-webapi.git
  ```
- Conferir os remotes com `git remote -v`
- Para executar os deploys:
  ``` sh
  # Production
  git checkout master
  git push prod master

  # Stage
  git checkout stage
  git push test stage

  # Develop
  git checkout develop
  git push test develop
  ```
