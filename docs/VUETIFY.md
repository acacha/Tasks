# Introducció

https://vuetifyjs.com/en/

Material Design Component Framework basat en Vue. De fet es tracta d'un Plugin Vue, és a dir una llibreria que amplia 
les funcionalitats de Vue. Bàsicament un cop instal·lat tindreu a la vostra disposició un ampli ventall de component
per a crear interfície amb Material Design (alerts, llistes, datatables, drawers, etc)

# Docs

https://vuetifyjs.com/en/getting-started/quick-start

# Instal·lació

## Aplicacions existents:

Instal·leu el mòdul Javascript

```javascript
npm install vuetify --save
```

Un cop instal·lat, al vostre fitxer main.js principal (en el cas de Laravel a resources/js/app.js) instal·leu Vuetify 
de la mateixa forma que s'instal·la qualsevol Plugin (Vue.use):

```javascript
import Vue from 'vue'
import Vuetify from 'vuetify'
 
Vue.use(Vuetify)
```

Ja tenim la part Javascript feta, ara falta el CSS i les Fonts de les que depen la llibreria:

Gràcies a Webpack podeu fer-ho al fitxer main.js (sinó caldria fer-ho com sempre posant el CSS al fitxer index.html, o 
en el cas de Laravel al fitxer amb el nostre layout principal **resources/viewslayouts/app.blade.php**):

```javascript
import 'vuetify/dist/vuetify.min.css' // Ensure you are using css-loader
````

El que no us podeu estalviar és afegir les fonts de Google al fitxer index.html/**resources/viewslayouts/app.blade.php**:

```javascript
<head>
  <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
</head>
````

o:

```
npm install --save-dev material-design-icons-iconfont
```

I poseu a index.js:

```
import 'material-design-icons-iconfont/dist/material-design-icons.css' // Ensure you are using css-loader
```


Recursos:
- https://vuetifyjs.com/en/getting-started/quick-start#existing-applications

## Projectes nous (només Javascript i Vue)

Utilitzeu com diu la documentació Vue-cli-

# Layout principal

Tenim diversos layouts predefinits a: https://vuetifyjs.com/en/layout/pre-defined

Utilitzarem:

- Intranet: https://vuetifyjs.com/en/examples/layouts/baseline
- Login/register: Dialogs
- Welcome Page: Tema predefinit: Parallax : https://vuetifyjs.com/themes/parallax-starter/

# Pas pas instal·lació del Layout principal

Instal·leu Vuetify:

```
npm install --save-dev vuetify material-design-icons-iconfont
```

Editeu el fitxer de layout principal **resources/js/app.js** i afegiu després de la línia:


```
window.Vue = require('vue')
```
la instal·lació de Vuetify:

```
const Vuetify = require('vuetify')
window.Vue.use(Vuetify)
```

Instal·leu també CSS i Google Fonts:

```
require('vuetify/dist/vuetify.min.css')
require('material-design-icons-iconfont/dist/material-design-icons.css')
```

Recompileu amb npmm run dev (o si teniut npm run hot funcionant ja es farà sol) 
