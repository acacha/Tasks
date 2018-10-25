# Configuració de l'entorn

Recordar fases aplicacions amb framework com Laravel:
- Bootstrap: arrancada de l'aplicació, execució de codi propi del framework (no codi del desenvolupador). Fase en que 
s'aplica la configuració. La configuració pot ser "dinàmica" o depenent de l'entorn (no es configura igual aplicació a 
explotació/producció que a desenvolupament) 

Fase paradigma Front Controller/SPA Single Page Application
- ROUTER/VUE-ROUTER

# Entorns:

- Desenvolupament/development: entorn local dels desenvolupadors. Cada desenvolupador té el seu propi sistema en local
- Staging: fase intermitja opcional. En grans projectes es poden aplicar abans els canvis a uns servidors el més similars
possibles als de explotació però amb accés limitat (accedeixen usuaris especials)
- Explotació/producció: entorn final on s'executa l'aplicació 

# Production

Qüestions a tenir en compte:

- Configuració especifica de l'entorn:
  - Base de dades explotació  en comptes de base de dades local
  - La base de dades no serà segurament amb SQLITE sinó amb algun sistema més robust com MySQL
  - Serveis de tercers en mode explotació:
     - Sistema d'enviament emails en explotació
     - Stripe o similars per pagaments bancaris
     - Sistemes de notificacions en explotació
     - Etc
- No s'han d'executar les aplicacions de development:
  - Laravel ide helper
  - Laravel debugbar o Laravel Telescope
  - Vue s'ha d'executar en mode producció i que no doni info a Vue dev tools
- La seguretat és una prioritat: es desactiva informació de xivatos, logs i misssatges d'error: si l'aplicació falla és 
important donar el mínim informació als possibles crackers. Per contra és un inconvenient per depurar i saber que ha 
passat quan hi han errors
- Rendiment de l'aplicació:
 - Cache del config: ```php artisan config:cache``` es desfà amb ```php artisan config:clear```
 - Optimitzar bootstrap Laravel cachejant-lo: ```php artisan optimize``` es desfà amb ```php artisan optmize:clear```
 - Cache de rutes: ```php artisan route:cache``` es desfà amb ```php artisan route:clear```
 - https://www.cloudways.com/blog/laravel-performance-optimization/

# Configuració de l'entorn en PHP

Fitxer .env, és un sistema habitual en altres llenguatges no PHP. La eina en que ens basem a PHP/LAravel és:

 https://github.com/vlucas/phpdotenv
 
Tindrem tants fitxers environment com entorns:

- .env.example: únic fitxer que trobarem a Github si el repositori és public. No conté dades confidencials només exemples
- .env: fitxer que utilitzem en local. Cal posar a .gitignore si el repositori és public
- .env.testing: opcional, utilitzat quan l'entorn és testing (vegeu també phpunit.xml)
- .env.staging: fitxer que utilitzem en staging. Cal posar a .gitignore si el repositori és public
- .env.production: fitxer que utilitzem en explotaciós. Cal posar a .gitignore si el repositori és public  

L'utilitzem per configurar, de fet la configuració va a la carpeta config, cal tenir en compte dos tipus de configuracions:

- Les que són identiques independentment de l'entorn: no cal utilitzar environment
- Les configuracions que sabem que depenen de l'entorn

Laravel proporciona helpers per treballar amb la configuració i entorn:

- Helper env: 'debug' => env('APP_DEBUG', false),
- App::environment(), retorna quin és el entorn actual
- Helper config: $value = config('app.timezone');

IMPORTANT:
- No utilitzar mai helper env al nostre codi!!! només als fitxers de configuració. Llegir el fitxer -env en cada execució
té un petit cost de rendiment, en explotació farem cache d'aquests valors de config i env no retorna res
- CAL doncs guardar tots els valors env() en una variable de config i hem d'utilitzar valor config

Configuration cache:

A explotació executem:

```
php artisan config:cache
```

https://laravel.com/docs/5.7/configuration#configuration-caching

EXEMPLE PER APLICACIÓ TASQUES: 
Creem fitxer **config/tasks.php** amb les variables de configuració propies de la nostra aplicació 

- Idees de configuració: imatge/icona del LOGO?
- Variables entorn:
  - Dades de l'usuari administrador (usuari propi) que crearem per defecte sempre a l'aplicació

Recursos:
-https://laravel.com/docs/5.7/configuration
- https://laravel.com/docs/5.7/configuration#configuration-caching

# Configuració de l'entorn en Javascript/Node (process.env)

IMPORTANT: NO PODEM UTILITZAR DADES CONFIDENCIALS A JAVASCRIPT COM PASSWORDS O TOKENS!!!

L'entorn el porta node.js.

Gràcies a Laravel Mix (webpack) podem utilitzar variables de configuració del fitxer .env per a Node.js:

Al fitxer **.env** només cal posar el prefix MIX_:

```
MIX_CLIENT_ID=2
MIX_API_URL=http://mysqserver.com/api/v1
```

I a Javascript:

```
let data = {
  id: process.env.MIX_CLIENT_ID,
  secret: process.env.MIX_CLIENT_SECRET
}
```

- https://medium.com/@patrickcurl/using-laravel-env-variables-inside-vue-js-components-29faa9a344c5 
- https://laravel.com/docs/5.7/mix


## Base de dades

En explotació cal tenir en compte dos fases:
- Explotació però en proves: no s'estan utilitzant encara dades reals -> podem eliminar, migrar, fer freshs i seeds de la 
base de dades a voluntat
- Explotació amb dades reals: MOLT DE COMPTE! no podem eliminar les dades així com així, cal tenir backups

Les migracions s'executen només les noves: SI CAL MODIFICAR UNA TAULA JA CREADA es crea una nova migració que modifiqui
la taula. CAL PLANIFICAR BÉ AQUESTS CASOS!

És molt important disenyar bé la base de dades per evitar el màxim els canvis d'estructura de la base de dades a explotació
per facilitar la tasca sinó cal tenir en compte plans de migració de dades d'un format de base de dades al format nou

# Configuració a nivell de sistemes

## Disposar d'un servidor web propi

La recomanació és utilitzar un servei de tercers com:

- Digital Ocean: https://www.digitalocean.com/
- https://education.github.com/pack: 50$ són deu mesos -> Cal tarjeta de credit

## Instal·lació del sistema operatiu

El sistema operatiu serà un Linux i escollim un Ubuntu Server. El millor és tenir una imatge preparada. Utilitzarem 
servei de pagament Laravel Forge:

- Laravel Forge: https://forge.laravel.com
- S'integra amb Digital Ocean via Tokens per tal de automatizar tasca intal·lació aplicacions a explotació 

## DNS i adreça IP

Dos formes de treballar:
- Configuració DNS d'explotació ok: tenim accés a la gestió del domini i podem crear les DNS que calgui
- Configuració DNS en mode fake: configurem les DNS al nostre fitxer local /etc/hosts

TODO, explicar algún sistema de configuració de DNS com Digital Ocean

## Servidor web
- Utilitzarem un servidor web "real" en explotació com Apache o Nginx (Nginx a l'exemple). No s'utilitza ni php -S, ni 
php artisan serve ni Laravels valets o similars

## Base de dades
- Utilitzarem un gestor de bases de dades com MySQL: cal crear la taula, els usuaris amb permisos, etc.

## Accés al servidor via SSH

Instal·lació de claus SSH:
- Podem automatizar la tasca amb Laravel Forge
- POdem crear també una comanda que ho faci 

## Configuració PHP (php.ini)

Tard o d'hora tindrem errors per la configuració de PHP com:

- Màxim de memòria que pot utilitzar un script
- Màxim de la mida de fitxer Upload
- etc

Cal configurar igual development i explotació

## Versions de les eines a utilitzar

És important per evitar problemes tenir les mateixes versions d'aplicacions:

- Versió sistema operatiu
- Versió de PHP
- Versió Nginx
- Versió MySQL

Un altre tema a tenir en compte és la configuració de l'entorn d'explotació amb les mateixes eines que a desenvolupament:

Llista eines a tenir en compte:
- Paquets PHP extres
- Supervisor

## Scheduler

TODO

## Git i explotació

IMPORTANT: No tocarem mai fitxers de codi directament a explotació

El procés es sempre canviar el local/development i fer un push dels canvis a Github. Aleshores apliquem canvis a explotació
fent un pull

NOTA: fa molt bé tenir un tag o tags que no sigui master a explotació per tal de controlar que puguem i que no al servidor
un cop l'aplicació ja està sent utilitzada pels usuaris. 

## COMPOSER I NPM A explotació

Cal recordar que heu d'executar un cop instal·lat el codi a explotació amb git clone/git pull:

```
composer install
npm install
cp .env.production .env
php artisan key:generate
php artisan migrate --seed
```

I altres configuracions com Laravel Passport o similars (paquets extres)

# Preparació per execució:
- Crear fitxer .env.production i afegir a .gitignore. Podem ja omplir el fitxer amb una clau ```php artisan key:generate```
- Preparació de Git/Github: etiquetes que no siguin master si s'escau
- Configuració fitxer .env.production
- Comandes i eines per facilitar la gestió explotació (creació base de dades, creació usuaris bàsics, seed )
- Configuració de DNS
- Preparació servidor (Digital Ocean + Laravel Forge)
- Preparació accés al servidor (Claus SSH)
- Configuració base de dades servidor
