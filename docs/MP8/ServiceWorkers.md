# Tasques

- Instal·lar/Registrar un service worker a la app
- A on: ho podriem fer a app.js però també es pot fer al mètode created()/mounted() d'un component Vue
  - Millor mounted: després del render
- Refactorització Layout:
  - Navigation menu de l'esquerra a un nou component per facilitar la programació de marcar el menñu seleccionat
# Conèixement previs

## Programació asíncrona Javascript 

- BOMBA FORK: http://acacha.org/w/index.php?title=Processos_Linux&redirect=no#ulimit
- EventLoop: és similar al gestor de ques de Laravel: un procés que esta continuament mirant quins esdeveniments hi ha pendents executar
- http://acacha.org/mediawiki/Programació_asíncrona_amb_Javascript
- http://acacha.org/mediawiki/Node.js#Event_loop._process.nextTick.28.29

## Conceptes

- Web Worker: Mimics multithreading, allowing intensive scripts to be run in the background so they do not block other scripts from running. Ideal for keeping your UI responsive while also performing processor-intensive functions. Cannot directly interact with the DOM. Communication must go through the Web Worker’s postMessage method.
- Service Worker: Background service that handles network requests. Ideal for dealing with offline situations and background syncs or push notifications. Cannot directly interact with the DOM. Communication must go through the Service Worker’s postMessage method.
- WebSocket: Creates an open connection between a client and a server, allowing persistent two-way communication over a single connection. Ideal for any situation where you currently use long-polling such as chat apps, online games, or sports tickers. Can directly interact with the DOM. Communication is handled through the WebSocket’s send method.

## Webworkers

- Workers dedicats: a vegades anomenats simplement web workers. Workers dedicats a una sola pàgina web
- Shared Workers: a vegades anomenats Workers a seques . Són workers compartits entre múltiples pàgines web

Exemples usos extensius:
- Obtención previa y/o almacenamiento en caché de datos para un uso futuro
- Métodos para destacar la sintaxis de código u otros formatos de texto en tiempo real
- Corrector ortográfico
- Análisis de datos de vídeo o audio
- Entrada y salida en segundo plano o solicitud de servicios web
- Procesamiento de conjuntos o respuestas JSON de gran tamaño
- Filtrado de imágenes en <canvas>
- Actualización de varias filas de una base de datos web local

### IPC/ Interprocess Communication

**app.js**:

```
var worker = new Worker("worker.js");
 
// Watch for messages from the worker
worker.onmessage = function(e){
  // The message from the client:
  e.data
};
```
**worker.js**:
``` 
worker.postMessage("start");
The Client:

onmessage = function(e){
  if ( e.data === "start" ) {
    // Do some computation
    done()
  }
};
 
function done(){
  // Send back the results to the parent page
  postMessage("done");
}
```

Exemple: 
- http://tinkering-webworkers.surge.sh/#/counter
- https://github.com/acacha/TinkeringWebWorkers


Recursos:
-http://acacha.org/mediawiki/Web_workers

# Service Workers

## Register

Igual que els web workers:

```
if ('serviceWorker' in navigator) {
  navigator.serviceWorker.register('/service-worker.js');
}
```

- **navigator**: Objecte global (com Window) The navigator object contains information about the browser.

Millor però:

```
if ('serviceWorker' in navigator) {
  window.addEventListener('load', function() {
    navigator.serviceWorker.register('/service-worker.js');
  });
}
```

PRIMERA VISITA DE l'USUARI:
- Demorar execució service worker fins que la pàgina estigui carregada o fins que l'objectiu principal de la pàgina s'hagui assolit
- https://developers.google.com/web/fundamentals/primers/service-workers/registration

RESTA DE VISITES
- navigator.serviceWorker.register() NO FA RES (NO CODE)

## CICLO DE VIDA

- https://developers.google.com/web/fundamentals/primers/service-workers/lifecycle                                       

# Recursos

- https://github.com/TalAter/awesome-service-workers
- https://github.com/w3c/ServiceWorker/blob/master/explainer.md
- https://serviceworke.rs/

# Llibreries

- sw-precache: https://github.com/GoogleChromeLabs/sw-precache
- sw-toolbox: https://github.com/GoogleChromeLabs/sw-toolbox
- https://mobiforge.com/design-development/service-worker-toolkits-and-libraries
- https://github.com/TalAter/awesome-service-workers#libraries-and-tools


# TODO

- Llegir: https://medium.com/dev-channel/offline-storage-for-progressive-web-apps-70d52695513c
    
