- https://012.vuejs.org/guide/
- Patro MVVM: https://www.packtpub.com/mapt/book/web_development/9781786469946/2/ch02lvl1sec18/mvvm-architectural-pattern
- Basic data binding:  https://laracasts.com/series/learn-vue-2-step-by-step/episodes/1
- V-MODEL: How it works, equivalent to:
  v-model="varName" is equivalent to :value="varName" @input="e => varName = e.target.value".

<input v-model="searchText">

does the same thing as:

<input
  v-bind:value="searchText"
  v-on:input="searchText = $event.target.value"
>


- https://vuejs.org/v2/guide/forms.html
- Lazy (mètode onchange en comptes de output): https://vuejs.org/v2/guide/forms.html#lazy
- Customize:
  - https://vuejs.org/v2/guide/components.html#Using-v-model-on-Components
- Customizing: https://vuejs.org/v2/guide/components-custom-events.html#Customizing-Component-v-model

Vue.component('base-checkbox', {
  model: {
    prop: 'checked',
    event: 'change'
  },
  props: {
    checked: Boolean
  },
  template: `
    <input
      type="checkbox"
      v-bind:checked="checked"
      v-on:change="$emit('change', $event.target.checked)"
    >
  `
})

# VUE DEV-TOOLS

# Lists
- https://vuejs.org/v2/guide/list.html
- Directiva v-for
- Sistema plantilla Vue moustaches
- Operacions amb arrays: https://vuejs.org/v2/guide/list.html#Mutation-Methods
 -- push/pop/shift/unshift/splice/sort/reverse
 -- Funció filter/ foreach i altres operadors amb arrays

## V-IF i V-SHOW

Mostrar tasques completades i no completades

 RANGES:

 <div>
  <span v-for="n in 10">{{ n }} </span>
</div>

# CRUD

- https://vuejs.org/v2/examples/todomvc.html

## EDIT MODE

Laracast video test utils: https://laracasts.com/series/testing-vue/episodes/7

# Computed Properties

- IMPORTANT: sempre són calculs realitzats a partir de dades de vue (data). No fer sobre elements no monitoritzats per vue o constants
- A vegades es pot fer el que es fa amb un computed amb un mètode
- Exemple filtre de tasques: filteredTasks -> tasques completes o tsques incompletes
- https://vuejs.org/v2/guide/computed.html

# COMPONENTS PROPS

Comunicació amb components/API/CONTRACTE

Comunicació pares fills:
- https://medium.com/@sky790312/about-vue-2-parent-to-child-props-af3b5bb59829
- Patrons més complicats de comunicació: Bus i Store (Vuex)

- Props validation
- Vue hooks: created/mounted

# VUE EVENTS
- dos tipus events: predefinits (click, dblclick, change, input) i a mida (custom)
- https://vuejs.org/v2/guide/events.html
- CUSTOM EVENTS a components: https://vuejs.org/v2/guide/components-custom-events.html

# SLOTS

TODO

# Axios

- Comunicació amb la API
- Javascript Promises
- Programació asíncrona i Javascript

-->
