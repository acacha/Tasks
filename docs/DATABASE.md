## Recursos

- https://laracasts.com/series/laravel-from-scratch-2018/episodes/7?autoplay=true

## Dependències:

Llibreries PHP:

SQLITE:

```
dpkg -l | grep php | grep sqlite
ii  php7.2-sqlite3                             7.2.10-0ubuntu0.18.04.1             amd64        SQLite3 module for PHP
```

MYSQL:

```
dpkg -l | grep php | grep mysql
ii  php7.2-mysql                               7.2.10-0ubuntu0.18.04.1             amd64        MySQL module for PHP
```

# Configuració

## SQLITE

Cal tenir en compte:
- Heu de tenir fitxer .env 
- Si no teniu fitxer el copier de .env.example
- Cal tenir fitxer database/database.sqlite (creeu buit amb touch database/database.sqlite)

Exemple fitxer .env:

```
DB_CONNECTION=sqlite
#DB_HOST=127.0.0.1
#DB_PORT=3306
#DB_DATABASE=homestead
#DB_USERNAME=homestead
#DB_PASSWORD=secret 
```

## MYSQL

Utilitzarem a explotació
Cal tenir en compte:
- Heu de tenir fitxer mysql instal·lat
- Cal crear una base de dades i un usuari amb tots els permisos d'accés a la base de dades
- Cal tenir fitxer .env


# Migracions

- https://laracasts.com/series/laravel-from-scratch-2018/episodes/7?autoplay=true
- https://laravel.com/docs/5.7/migrations

Crear una migració, al crear el model:

```
php artisan make:model

o

```
php artisan make:migration create_users_table
```