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

Un cop instal·lat, al vostre fitxer main.js principal (en el cas de Laravel a resources/js/App.vue) instal·leu Vuetify 
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

Editeu el fitxer de layout principal **resources/js/App.vue** i afegiu després de la línia:


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

Ara anem a aplicar el nou Layout, el primer que cal tindre en compte és el component v-app (https://vuetifyjs.com/en/layout/pre-defined#all-about-app)

El component v-app és imprescindible per tal que funcioni correctament vuetifyi ha de ser l'element pare/arrel/root de 
la resta d'element vuetify.

El layout que utilitzarem inicialment (més endavant el complicarem més) és el següent:

+-------------+-----------------------------------------------+
| Navigation  | HAMBURGER ICON | TOOLBAR/HEADER               |
|             +-----------------------------------------------+
| Bar         | DINAMIC CONTENT HERE (depending on URL/routes)|
| (Drawer)    |                                               |
+-------------+-----------------------------------------------|
| FOOTER                                                      |
+-------------+-----------------------------------------------|

Si ho passem a una estructura jeràrquica tipus document DOM/HTML amb components vue Vuetify/Propis:

```html
<v-app>
  <v-navigation-drawer>
   <v-list>Menú navegació</v-list>  
  </v-navigation-drawer>
  <v-toolbar></v-toolbar>
  <v-content>
    CONTENT HERE
  </v-content>
  <v-footer></v-footer>
</v-app>
```

Si observeu el codi del layout baseline:

 https://github.com/vuetifyjs/vuetifyjs.com/blob/master/src/examples/layouts/baseline.vue

Es tracta d'un component Vue, i per tant té una part de comportament amb l'estat de l'aplicació o es guarden variables 
bàsiques que permeten controlar estat general de la app (al exemple si el menu drawer està obert o no)

```html
<script>
  export default {
    data: () => ({
      drawer: null
    })
  }
</script>
```

Com instal·lem això a la nostra aplicació? Cal tenir en compte que estem utilitzant Laravel Blade i Vue conjuntament, i 
que tal i com hem comentat necessitem un component vue Pare amb la info de l'aplicació. 

A la carpeta **resources/js/components** teniu tots els components de la vostra aplicació però no hi ha un component Pare.
On és doncs? El teniu al fitxer **resources/js/capp.js**:

```javascript
const app = new window.Vue({
  el: '#app'
})
```

Què és el mateix que escriure:

```javascript
const AppComponent = require('./App.vue')
const app = new window.Vue(AppComponent)
```

on **App.vue** és:

```html
<script>
export default {
  el: '#app'
}
</script>
```

Feu aquest canvi/refactorització. Els components poden tenir etiqueta <template></template> o podeu utilitzar un 
CSS selector com (#app (l'element amb id='app')) per indicar on està la plantilla. Si entenm això ja podem organitzar 
el layout posant **App.vue**:

```html
<script>
export default {
  el: '#app',
  name: 'App',
  data () {
    return {
      drawer: null 
    }
  }
}
</script>
```

i canviant el nostre layout sense Vuetify a un layout amb Vuetify:

```
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title','Put your title here')</title>
</head>
<body>
<div id="app">
    <v-app>
        <v-navigation-drawer
                v-model="drawer"
                fixed
                app
        >
            <v-list dense>
                <v-list-tile @click="">
                    <v-list-tile-action>
                        <v-icon>home</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>Home</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-list-tile @click="">
                    <v-list-tile-action>
                        <v-icon>contact_mail</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>Contact</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </v-list>
        </v-navigation-drawer>
        <v-toolbar color="indigo" dark fixed app>
            <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
            <v-toolbar-title>Application</v-toolbar-title>
        </v-toolbar>
        <v-content>
            @yield('content')
        </v-content>
        <v-footer color="indigo" app>
            <span class="white--text">&copy; 2017</span>
        </v-footer>
    </v-app>
</div>
<script src="{{ mix('/js/App.vue') }}"></script>
</body>
</html>
``` 

Ara encarreguem-nos del menú de navegació, fem-lo estatic/hardcoded però preparat per poder passar-lo a base de dades o 
obtenir les dades del menú de forma dinàmica d'on creiem convenient, Vegeu l'exemple:

- https://github.com/vuetifyjs/vuetifyjs.com/blob/master/src/examples/layouts/googleContacts.vue

Posem les dades del menú en un array d'objectes al component App.vue:

```javascript
items: [
        { icon: 'contacts', text: 'Contacts' },
        { icon: 'history', text: 'Frequently contacted' },
        { icon: 'content_copy', text: 'Duplicates' },
        {
          icon: 'keyboard_arrow_up',
          'icon-alt': 'keyboard_arrow_down',
          text: 'Labels',
          model: true,
          children: [
            { icon: 'add', text: 'Create label' }
          ]
        },
        {
          icon: 'keyboard_arrow_up',
          'icon-alt': 'keyboard_arrow_down',
          text: 'More',
          model: false,
          children: [
            { text: 'Import' },
            { text: 'Export' },
            { text: 'Print' },
            { text: 'Undo changes' },
            { text: 'Other contacts' }
          ]
        },
        { icon: 'settings', text: 'Settings' },
        { icon: 'chat_bubble', text: 'Send feedback' },
        { icon: 'help', text: 'Help' },
        { icon: 'phonelink', text: 'App downloads' },
        { icon: 'keyboard', text: 'Go to the old version' }
      ]
    })
```

El fitxer queda:

```html
<script>
export default {
  el: '#app',
  name: 'App',
  data () {
    return {
      drawer: null,
      items: [
        { icon: 'contacts', text: 'Contacts' },
        { icon: 'history', text: 'Frequently contacted' },
        { icon: 'content_copy', text: 'Duplicates' },
        {
          icon: 'keyboard_arrow_up',
          'icon-alt': 'keyboard_arrow_down',
          text: 'Labels',
          model: true,
          children: [
            { icon: 'add', text: 'Create label' }
          ]
        },
        {
          icon: 'keyboard_arrow_up',
          'icon-alt': 'keyboard_arrow_down',
          text: 'More',
          model: false,
          children: [
            { text: 'Import' },
            { text: 'Export' },
            { text: 'Print' },
            { text: 'Undo changes' },
            { text: 'Other contacts' }
          ]
        },
        { icon: 'settings', text: 'Settings' },
        { icon: 'chat_bubble', text: 'Send feedback' },
        { icon: 'help', text: 'Help' },
        { icon: 'phonelink', text: 'App downloads' },
        { icon: 'keyboard', text: 'Go to the old version' }
      ]
    }
  }
}
</script>
```

Adapteu la variable items al menú que desitjeu

I canviem el navigation drawer al mateix que l'exemple.

ATENCIÓ:: Tinfreu un conflicte entre els mostachos Laravel Blade i Vue, utilitzeu @{{ 
https://laravel.com/docs/5.7/blade#blade-and-javascript-frameworks 

# Laravel frontend presets: Laravel Vuetify

https://github.com/laravel-frontend-presets/laravel-vuetify

Es pot utilitzar amb projectes Laravel acabats instal·lar.
