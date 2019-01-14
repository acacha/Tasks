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
