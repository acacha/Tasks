# SHARED STATE i COMPONENT VUE

Una problemàtica que aviat sorgirà és la de compartir informació (estat o shared state) entre components.
La solució bàsica de comunicació entre components que proporciona Vue es basa en la comunicació entre pares i fills
utilitzant props i esdeveniments a mida. Aquesta solució no és la més adient per casos com:

- Comunicació entre components que tenen relacions que no són pare/fill directe. Per exemple un component avi i un net 
no es poden comunicar directament ho han de fer a través del pare. O dos components germans (siblings) igual
- Estat compartit amb tots o molts components: Per exemple un component força habitual és un que permeti mostrar 
missatges tipus alerts/snackbars etc. La gran majoria de components de la nostra aplicació voldran interaccionar amb 
aquest component

# SOLUCIONS per a SHARED STATE i comunicació entre components

## Global Event Bus

Tots els components que volen fer comunicacions globals amb altres components depenen/utilitzen un objecte Vue
que fa la comunicació entre components

- https://alligator.io/vuejs/global-event-bus/ 

## Store pattern

```javascript
const sourceOfTruth = {}

const vmA = new Vue({
  data: sourceOfTruth
})

const vmB = new Vue({
  data: sourceOfTruth
})
```

PROBLEMA: Variables globals. Es fa díficl seguir o depurar qui ha canviar i quan l'estat.
SOLUCIÓ: STORE PATTERN

Imatge: https://vuejs.org/images/state.png

Control d'accés a l'estat via encapsulació/getters/setters:

```
var store = {
  debug: true,
  state: {
    message: 'Hello!'
  },
  setMessageAction (newValue) {
    if (this.debug) console.log('setMessageAction triggered with', newValue)
    this.state.message = newValue
  },
  clearMessageAction () {
    if (this.debug) console.log('clearMessageAction triggered')
    this.state.message = ''
  }
}
```

Recursos:
- https://vuejs.org/v2/guide/state-management.html
- https://markus.oberlehner.net/blog/should-i-store-this-data-in-vuex/

## PORTALS

- https://github.com/LinusBorg/portal-vue

## State managment library Vuex

Vuex is a state management pattern + library for Vue.js applications. Implementa el patró d'STORE i facilita
la gestió de l'estat compartit entre components

Imatge: https://vuex.vuejs.org/ | https://vuex.vuejs.org/vuex.png

- https://vuex.vuejs.org/

### Quan utilitzar Vuex?

- The data must be accessible by multiple (independent) components
- Centralized API / data fetching logic (SPA)
- Persisting application state on the client

### Quan no utilitzar Vuex?
- Complexity
- Overhead 

# Altres frameworks

La problemàtica és similar en altres frameworks com React o Angular i també adopetn solucions similars
