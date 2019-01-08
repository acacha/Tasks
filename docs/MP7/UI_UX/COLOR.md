# Tasques:

- Refactoritzar aplicació de tasques per utilitzar els colors de forma concruent amb la teòria explicada:
- Utilitzar colors semantics:
  - Primary i secondary: 
    - [ ] Toolbar background color
    - [ ] Footer background color
    - [ ] Botons
    - https://material.io/tools/color/#!/?view.left=0&view.right=0&secondary.color=039BE5&primary.color=4FC3F7
  - Secondary color
    - Alguns botons que es vulguin destacar: 
    - FAB (Floating Action Button)
    - Tabs seleccionades
    - Alguns widgets de formulari com barras de progres, checkbox o switches, selectted items
  - Canviar el color de fons:
    - [ ] CARDS Aplicar al background de les cards
  - Semantic Colors:
   - [ ]
  - Colors de les etiquetes:
    - [ ] 
-  [ ] Un cop tota l'aplicació refactoritzada per no utilitzar colors fixos canviar la paleta/theme de Vuetify    
 -  [ ] Opcional paleta feta a mida millor escollir paleta del PDF de paletas del curs
- PWA -> Aplicació per a mòbils:
 - https://developers.google.com/web/updates/2015/08/using-manifest-to-set-sitewide-theme-color
 - Canviar el color de la system bar i de la barra de navegació del navegador 
# Tools

- PHPSTORM: https://www.jetbrains.com/help/phpstorm/color-picker.html: Ctrl+Shift+A -> Show Color Picker
- Plugin Chrome: Colorzilla
- Integrat a chrome dev tools

# HSL

- Pag 118 del llibre Adam Wathan
- Es recomanable per temes de disseny utilitzar HSL en comptes de codis HEX i RGB
- Els codis HEX i RGB no aportan informació de disseny, són dades d'ordinador no dades humanes
- HSL:
  - Hue/Tono: es medeix en graus dins d'una roda de colors
    - 0: Red
    - 120: Green
    - 240: Green
  - Saturació: 0% -> Gris (no color) 100% Saturació com de viu és el color
  - Ligthness: 0% negre 100% blank  

# Swatches

https://material.io/design/color/#color-theme-creation

# References

- Material spec: 
  - https://material.io/design/color/the-color-system.html#color-usage-palettes
  - https://material.io/tools/color/#!/?view.left=0&view.right=0
- Vuetify: https://vuetifyjs.com/en/framework/colors
- Tailwind CSS: https://tailwindcss.com/docs/colors
- Bootstrap: https://getbootstrap.com/docs/4.0/utilities/colors/

# Paletes

Quans colors utilitzar? Doncs al final es tracta de tenir un sistema predefinit que limiti la infinitat d'opcions:

- Important: no sortir de la gama de colors escollida, evitar la dispersitat de valors
- Degut a la norma anterior tampoc no ppodem agafar pocs colors (p.ex només primary, secondary, accent, error, warning, etc)
- Es crear una paleta a partir dels anteriors i variacions més darken i més lighten 
- Accent variations/Secondary -> Utilitzar més poc -> Accentuar coses com els CTA o els FABS
- Escala de grisos -> IMPORTANT (i no té pq ser pur gris pot ser un gris tirant a blau o altres variacions) 

Com escollir paleta:
- Buscar paletes predefinides: Vuetify té la propia
- Utilitzar recursos com el PDF del curs Refactorin UI amb múltiples paletes predefinides
- NO es recomana utilitzar un generador de paletes d'estos que hi ha per Internet

Procés manual:
- Escollir color base
- Primary: escollir el hue (blau per exemple) i buscar un color base sigui ok per fer de fons de color d'un botó
- Escollir els extrems: el més fosc i el més brillant
- Omplir els forats entremig-> Queda un color base + 4-5 variacions dark,light amunt i a abaix
- A vegades s'utilitza numeració : 500 és el color base i tenim (50), 100,200,300,400, 500, 600, 700, 800, 900
- Repetir per cada tipus color (primary, accent, error, etc)
- Amb els grisos dona igual el procés: no utilitzar mai negre pur (ni blanc

# Material

## Paletes

- Colors primary i secondary.
- Dark an light variants
- https://material.io/design/color/#color-usage-palettes

## Com aplicar les paletes:
- https://material.io/design/color/applying-color-to-ui.html#top-bottom-app-bars
- App bars
  - [ ] Top or Bottom -> Primary Colors
  - [ ] Barra de sistema-> Una variant del color més forta o més fluixa

# TRUCS

## Don’t let lightness kill your saturation

IMPORTANT: No deixa que la llum (L lightness) matí la saturació. S'ha de compensar la saturació a mesura que s'utilitzen
els estrems de lluminositat (ens apropem al negre o el blanc). Evitar dull colors

## Use perceived brightness to your advantage. Colors (percebuts per l'ull) més brillants

- Mínims de brillantor: Red/Green/Blue
- Màxims: Yellow/Cyan/Magenta

Es pot "augmentar/desaugmentar" la brillantor d'un color canviant el color (HUE) es a dir rotant una mica els graus del 
color apropant-se als màxims o mínims locals de brillantor

# Greys don’t have to be grey Color temperature

- Cool: afegir blau al gris
- Warm greys: Afegir yellow/orange

## Vuetify:

Theme generator: 

Noms:
- Gris (neutre): un munt de coses bàsiques de l'aplicació poden ser grises: Text, fons, panells, controls de formulari, cantonades
- primary: Color primary sovint associat a la marca-> Facebook-> Blau Google -> Roig Twitter blau fluix ,etc   
- secondary:
- accent: Yellow, pink, Teal (Turquesa). Semantic states (semafor)
  - error: Red: operacions de destrucció,perilloes
  - warning: Groc
  - success: Verd Positive trend, ok 
  - IMPORTANT: No abusar hi ha altres tècniques per fer similar
- info: 


Default:
{
  primary: '#1976D2',
  secondary: '#424242',
  accent: '#82B1FF',
  error: '#FF5252',
  info: '#2196F3',
  success: '#4CAF50',
  warning: '#FFC107'
}

Canviar el tema:

```javascript
Vue.use(Vuetify, {
  theme: {
    primary: '#3f51b5',
    secondary: '#b0bec5',
    accent: '#8c9eff',
    error: '#b71c1c'
  }
})
```

```
import colors from 'vuetify/es5/util/colors'

Vue.use(Vuetify, {
  theme: {
    primary: colors.purple,
    secondary: colors.grey.darken1,
    accent: colors.shades.black,
    error: colors.red.accent3
  }
})
```

### Dark and light
