# Tasques a realitzar

# Components Vue a instal·lar

https://github.com/egoist/vue-timeago

```
npm i vue-timeago
```

https://www.npmjs.com/package/vue-json-tree-view
```
import TreeView from 'vue-json-tree-view'
window.Vue.use(TreeView)
```

## Instal·lar Laravel Telescope
 
 https://laravel.com/docs/5.7/telescope

Oco petaran tots els testos. Cal posar a **phpunit.xml**:

```
<env name="TELESCOPE_ENABLED" value="false"/>
```


## Changelog

Codi que us aporta el professor (heu de copiar del projecte de tasques del professor):
- Model i migracions taula log on guardar els esdeveniments
- Test unitari model Log
- Feature Test de la web /changelog:
  - Controlador web
  - Request objects
  - helpers.php: sample_logs() i noves Gates
  - Vista
  - Component (oco el component depèn altres components que també haureu instal·lar i de mòduls npm nous)
- Feature Test api: refresh del changelog  
- Variacions de la mateixa llista per veure només logs d'un recurs concret o d'un usuari concret.

Notes:
- Portar un registre de les operacions CRUD que es realitzen amb les tasques
- Característiques:
  - Consultable desde diferents perspectives:
  - Administrador/Manager/Admin: pot veure tots els esdeveniments que succeixen al sistema (accés al registre complet)
  - Usuari normal: Pot veure els canvis només de les seves tasques
  - Perspectiva del recurs modificat: historial de canvis per a una tasca concreta 
  
Base de dades:
- Relació polimorfica entre taula log i recurs que estem logant
- Cada log té un text associat (l'establirà el event Listener)
- Modificacions: nou_valor i valor antic
- Usuari que realitza l'operació
- Tipus operació (CRUD -> Create, Retrieve, Update, Delete, Show...)
- Extres: icona i color

```
Schema::create('logs', function (Blueprint $table) {
            $table->increments('id');
            $table->text('text');
            $table->datetime('time');
            $table->string('action_type');
            $table->string('module_type');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('old_value')->nullable();
            $table->string('new_value')->nullable();
            $table->nullableMorphs('loggable');
            $table->json('old_loggable')->nullable();
            $table->json('new_loggable')->nullable();
            $table->string('icon');
            $table->string('color');
            $table->timestamps();
        });  
```

## Notificacions
- Enviar una notificació per a cada operació del sistema
- De moment les notificacions seran Emails però val la pena tenir el sistema preparat per poder notificar via altres sistemes (SMS, missatges Chat: telegram o altres ...)


# Events

- En resum és un mecanisme que permet "connectar" dos fragments de codi de forma controlada -> Evitant copy/paste o Spaghetti Code 
- Event-drive programming: https://en.wikipedia.org/wiki/Event-driven_programming
- Imatge:

https://medium.com/google-developer-experts/event-driven-programming-for-android-part-ii-b1e05698e440

- Aka: Publisher/Suscriber | Observer paradigm

- Publisher: és el que "dispara"/trigger l'esdeveniment
- Event: Objecte o estrucutra de dades amb informació sobre l'esdeveniment
- Subscriber(aka Listener): Codi que s'executa quan succeix l'esdeveniment. Rep l'objecte event amb la informació 
de l'esdeveniment

## PHP/Laravel

- https://laravel.com/docs/5.7/events

Subscriptors/publishers:
- S'utilitza un provider per definir/subscriure tots els esdeveniments possibles així com els listeners que s'executen
cada cop succeixen els events -> EventServiceProvider
 - Es pot definir a qualsevol lloc però més val tenir tot en un sol lloc.
- Es poden disparar events en qualsevol punt del codi després de la fase de bootstrap (després de l'execució del provider)
- Helper event: 
Listeners/Observers:
- app/Listeners
Events:
- app/Events:
  - IMPORTANT: Són objectes PHP que funcionen com simples estructures de dades sense lògica de negoci/comportament
  
Comandes:

```
php artisan event:generate
```  
  
El més complicat dels esdeveniments sol ser depurar-los i testejar-los.

Laravel Scope:
- https://laravel.com/docs/5.7/telescope#event-watcher
- Laravel Debugbar

## Javascript/Vue

Utilitzem events per:
-Comunicació entre component fill i component pare (només sentit fill-pare)
-Comunicació entre components. EventBus -> Component Vue compartit (importat) als dos o més components que es volen 
comunicar entre ells

# Treball en segon terme

NOTA: per a que? Per augmentar rendiment
- Exemple: Millor experiència usuari: La interfície gràfica sigui ràpida i responsiva (no es pengi)
  - Android per exemple ho porta a l'extrem: obliga que certes tasques s'executin en segon terme i separa el procés que executa la UI (procés
  principal i prioritari) de tots els procesos lents (I/O: discos, xarxa, apis externes, computacions complexes, etc) 

- Programació multitasca: 
  - MULTITASCA UN CONCEPTE complex i que es pot IMPLEMENTAR de múltiples formes:
  - HARDWARE: CPU: temps compartit (multiplexació en temps), mateix temps real (multiprocessador, múltiples freqüencioes en comunicacions, etc)    
  - SOFTWARE: Javascript: Event Loop -> La multiplexació en temps pot donar sensació real de multitasca
  - MULTIPROCÉS/MULTHREAD: més d'un tros de codi executant-se al mateix temps
- XARXES/PROTOCOLS-> Són dos procesos comunicant-se entre sí (per exemple un client i un servidor) però amb la característica de que no tenen pq estar a la mateixa màquina  
- **IPC**: Inter Process Communication -> Conjunt de tècniques per permetre la programació i comunicació entre procesos 


## PHP/Laravel

**CUAS / Message Queue**

Laravel queues provide a **unified API** across a variety of different queue backends, such as Beanstalk, Amazon SQS, Redis, or even a relational database. Queues allow you to defer the processing of a time consuming task, such as sending an email, until a later time. Deferring these time consuming tasks drastically speeds up web requests to your application.

Message queue: una forma de comunicar procesos

**IMPORTANT**: A Laravel/PHP no activat per defecte -> els procesos són bloquejants i s'espera a la finalització d'un procés per continuar l'execució del codi

- https://en.wikipedia.org/wiki/Message_queue
### Relació entre cues i esdeveniments:
- https://laravel.com/docs/5.7/events#queued-event-listeners

## Javascript

TODO
- https://flaviocopes.com/javascript-events/ 
