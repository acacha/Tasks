# HTML CANVAS

- Canvas clock
  - setInterval vs Request_Animation_Frame
  - https://www.w3schools.com/graphics/canvas_clock_start.asp 
  - http://www.dhtmlgoodies.com/tutorials/canvas-clock/
  - https://codepen.io/alejandroperezmartin/pen/phyDB
- Drawing Board: https://codepen.io/getflourish/pen/EyqxYE
  - Firma: https://codesandbox.io/s/n5qjp3oqv4
  - Vue-signature-pad: https://github.com/neighborhood999/vue-signature-pad#readme
    - https://jsfiddle.net/szimek/jq9cyzuc/
    - https://jsfiddle.net/szimek/osenxvjc/
    - http://szimek.github.io/signature_pad/
    
## Bàsic game

https://www.w3schools.com/graphics/game_movement.asp

# HTML MULTIMEDIA AUDIO O VIDEO

Vanilla Javascript:
- https://github.com/acacha/TinkeringMultimediaSupportHTML5
Media players (exemple videoJs):
- https://codepen.io/heff/pen/EarCt

# Funcionalitats noves cal entregar per corregit UF2 MP8 (multimedia)

## opció 2:

Notes audio en un chat

## Opció 1 Tasques:

- Afegir notes de veu (audios) a tasques
- Utilitzar llibreria Laravel 
  - https://github.com/spatie/laravel-medialibrary
  - https://docs.spatie.be/laravel-medialibrary/v7/introduction
- Crear una media collection es digui audios
- NO cal modificar menu add (opcional)
 - Modificar Task map pq inclogui el audio associat a una tasca (si en té)
 - Només crear una acció nova a datatables (columna accions):
   - Si la tasca no té cap audio associat: icona + que permeti afegir un audio a una tasca ja creada (obrint un nou dialeg)
     - Dialeg: mostri un nou formulari per afegir audio:
       - S'ha de poder capturar l'audio directament del microfon del dispositiu
       - Si nó hi ha microfon un upload normal i corrent
   - Si la tasca ja té un audio: dos icones: 
     - play: Utilitzar un https://vuetifyjs.com/en/components/bottom-sheets per mostrar un reproductor de l'audio
     - remove: dessaociar audio de la tasca
 - Nou controlador i nou Test:
   - URLs: 
     - POST (associar audio a tasca) /api/v1/tasks/{$task}/audio
     - DELETE (desassociar audio a tasca) /api/v1/tasks/{$task}/audio
   - Tasques 
   
## Perfil usuari

- El avatar de l'usuari s'ha de poder agafar directament d'una foto del dispositiu o webcam   
- Incorporar firma d'usuari al perfil
- Acció firmar tasca: envia un email al usuari amb un link únic per firmar una tasca

# Jocs i animacions

- Css animations and css transitions
- Animacions vue
- http://acacha.org/mediawiki/Request_Animation_Frame
