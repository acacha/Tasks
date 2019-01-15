# Tasques

## Taules Responsive

- https://material.io/design/components/data-tables.html#anatomy
- Utilitzar data iterator per mostrar stackades/Apilades les tasques com una llista de v-cards:
  - https://vuetifyjs.com/en/components/data-iterator
  - Visibilitat només a partir de ceta mida cap abaix
  - https://vuetifyjs.com/en/framework/display 
  - OCO: No abusar dels labels Pag 41 LABELS ARE A LAST RESORT

### Millores Taula tasques

- Utilitza Row checkbox per fer operacions masives
  - Ha de permete eliminar algunes accions com eliminar/delete (i ampliem la funcionalitat de la aplicació -> eliminació masiva)
    - Oco: Confirmació!!!
## Botons de confirmació

- Cancel buttons com a links o flat
- Red fora

### NOT ARE ELEMENTS ARE EQUAL

- Outline buttons a les accions de la taula?
- Eliminar algunes accions

### NO DATA
- https://vuetifyjs.com/en/components/data-tables#slot-no-data
- Encara millor:
  - No mostrar el data tables quan no hi ha ni una sola tasca -> Cas inicial MOLT IMPORTANT!!
  - Mostrar alternativament una mena de Landing Page amb un CTA que sigui afegir una tasca 
  - DON'T OVERLOOK EMPTY SPACES Pag 20    
  - Imatge: centrada icona de tasques amb border i algun color
  - Text que expliqui que cal fer
  - Boto CTA centrar i gran -> Afegir una tasca
     

## Icona de tasques (launcher icon)

- https://www.pwabuilder.com/imageGenerator
- https://app-manifest.firebaseapp.com/
- https://romannurik.github.io/AndroidAssetStudio/icons-launcher.html#foreground.type=clipart&foreground.clipart=android&foreground.space.trim=1&foreground.space.pad=0.25&foreColor=rgba(96%2C%20125%2C%20139%2C%200)&backColor=rgb(68%2C%20138%2C%20255)&crop=0&backgroundShape=square&effects=none&name=ic_launcher

Icona aplicació:
- Cal partir de la imatge més gran: 512x512pixels
- Icona tasca: https://www.flaticon.com/premium-icon/tasks-list-on-clipboard_46442

# Definició

Responsive web design aka rwd o Disseny web adaptable és un terme definit per primer cop al 2010 per Ethan Marcotte a http://alistapart.com vegeu l'article:

# Bases

Exemple: https://acacha.github.io/responsive-examples/weather.html

## Media queries

## Tipus de solucions responsive

https://github.com/acacha/responsive-examples

### Tiny tweaks

Utilitzat en pàgines estàtiques, principalment són ajustos del text:

```
 <style>
e      .c1 {
        padding: 10px;
        width: 100%;
      }
      @media (min-width: 500px) {
        .c1 {
          padding: 20px;
          font-size: 1.5em;
        }
      }
      @media (min-width: 800px) {
        .c1 {
          padding: 40px;
          font-size: 2em;
        }
      }
      /* // [END ttweaks] */
    </style>
```
https://github.com/acacha/responsive-examples/blob/master/tiny-tweaks.html
https://acacha.github.io/responsive-examples/tiny-tweaks.html

### Mostly fluid

https://acacha.github.io/responsive-examples/mostly-fluid.html

- Recolocar elements però amb una amplada màxima a partir de certes mides (casi fluid)
- https://github.com/acacha/responsive-examples/blob/master/mostly-fluid.html

### Column drop
- Apilar elements i sistema fluid
- https://acacha.github.io/responsive-examples/column-drop.html
- https://github.com/acacha/responsive-examples/blob/master/column-drop.html

## Layout shifter
- Com l'anterior però canviant a més l'orde dels elements apilats (primer el contingut)
- https://acacha.github.io/responsive-examples/layout-shifter.html
- https://github.com/acacha/responsive-examples/blob/master/layout-shifter.html

## Off canvas
- Patro dels drawers
- https://acacha.github.io/responsive-examples/off-canvas.html
- https://github.com/acacha/responsive-examples/blob/master/off-canvas.html

## Grid System

- https://material.io/design/layout/responsive-layout-grid.html#columns-gutters-margins
- https://vuetifyjs.com/en/framework/grid
- https://www.w3schools.com/css/css_rwd_grid.asp

## A pixel is not a Pixel

- La resolució de la pantalla (p.ex. 1080x860) ja no és l'única mésura que indica el nivell de detall de la pantalla
- High-density displays:: Pioner Apple amb el "Retina Display"
  - https://en.wikipedia.org/wiki/Retina_display
- **Software Pixels/CSS pixels**: els pixels de tota la vida 
- **Hardware pixels**: establert pel "device manufacturer"
- **Device pixel ratio|DPR|CSS Pixel Ratio**: quants pixels de hardware equivalent a un pixel de software
  - https://binaria.com/blog/device-pixel-ratio-consejos-para-desarrolladores/
- Altres:
  - DPI: Dots per Inch
  - PPI: Pixels Per Inch
  - Android té una mesura: https://developer.android.com/guide/practices/screens_support
Exemples:
- **Apple’s Retina display**: Device pixel ratio 2x (1 pixel equival a 4 pixels: 2 pixels altx 2 pixels ampla)
- **Samsung Galaxy S4**: x3 (9 hardware pixels).
  - Resolución física: 1080 x 1920
  - Device pixel ratio: 3
  - Resolución lógica: (1080/3) x (1920/3) = 360 x 640
- **LG G3/Galaxy S6**: x4 (16 hardware pixels).
- El vostre mobil: https://www.mydevice.io/
- http://dpi.lv/

Com afecta a les imatges:

- Les imatges s'escalen segons el DPR (es fan més grans)
- https://binaria.com/blog/device-pixel-ratio-consejos-para-desarrolladores/

Recursos:
- https://juiceboxinteractive.com/blog/a-pixel-is-not-a-pixel-designing-for-a-new-generation-of-mobile-devices/

## Viewport

```
<meta name="viewport" content="width=device-width, initial-scale=1">
```

- Usa la etiqueta meta viewport para controlar el ancho y el ajuste de la ventana de visualización del navegador.
- Incluye width=device-width para hacer coincidir el ancho de la pantalla en píxeles independientes del dispositivo.
- Incluye initial-scale=1 para establecer una relación de 1:1 entre los píxeles CSS y los píxeles independientes del dispositivo.


Exemple:

https://developers.google.com/web/fundamentals/design-and-ux/responsive/

# Recursos

http://acacha.org/mediawiki/Responsive_web_design
