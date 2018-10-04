<template>
    <div>
        <input type="text"
               v-model="newTask" @keyup.enter="add">
        <button @click="add">Afegir</button>

        <!--// SINTAX SUGAR-->

        <!--<input :value="newTask" @input="newTask = $event.target.value">-->
        <ul>
            <li v-for="task in tasks" :key="task.id">
                <span :class="{ strike: task.completed }">{{task.name}}</span>
                &nbsp;
                <span @click="remove(task)">&#215;</span>
            </li>
        </ul>
    </div>
</template>

<script>

// document.getElementById('newTask').value
//     var newTask='No tasca'
//     document.getElementById.value= newTask
    export default {
      data() {
        return {
            newTask: '',
            tasks: [
                {
                    id: 1,
                    name: 'Comprar pa',
                    completed: false
                },
                {
                    id: 2,
                    name: 'Comprar llet',
                    completed: false
                },
                {
                    id: 3,
                    name: 'Estudiar PHP',
                    completed: true
                }

            ]
        }
      },
      methods: {
          add() {
              this.tasks.splice(0,0,{ name: this.newTask, completed: false } )
              this.newTask=''
          },
          remove(task) {
              window.console.log(task)
              this.tasks.splice(this.tasks.indexOf(task),1)
          }
      }
    }

    // CAR
// {
//     marca: 'Renault',
//     consum: '5l/100',
//     start: function() {
//       console.log('arranca');
//     }
// }
</script>

<style>
  .strike {
    text-decoration: line-through;
  }
</style>

<!--

######## GUIDE

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

2

- VUE DEV-TOOLS

3) Lists
- https://vuejs.org/v2/guide/list.html
- Directiva v-for
- Sistema plantilla Vue moustaches
- Operacions amb arrays: https://vuejs.org/v2/guide/list.html#Mutation-Methods
 -- push/pop/shift/unshift/splice/sort/reverse
 -- Funció filter/ foreach i altres operadors amb arrays

3.1) V-IF i V-SHOW

Mostrar tasques completades i no completades

 RANGES:

 <div>
  <span v-for="n in 10">{{ n }} </span>
</div>

4) Computed Properties

- IMPORTANT: sempre són calculs realitzats a partir de dades de vue (data). No fer sobre elements no monitoritzats per vue o constants
- A vegades es pot fer el que es fa amb un computed amb un mètode
- Exemple filtre de tasques: filteredTasks -> tasques completes o tsques incompletes
- https://vuejs.org/v2/guide/computed.html

5) COMPONENTS PROPS

Comunicació amb components/API/CONTRACTE

Comunicació pares fills:
- https://medium.com/@sky790312/about-vue-2-parent-to-child-props-af3b5bb59829
- Patrons més complicats de comunicació: Bus i Store (Vuex)

- Props validation
- Vue hooks: created/mounted

7) VUE EVENTS
- dos tipus events: predefinits (click, dblclick, change, input) i a mida (custom)
- https://vuejs.org/v2/guide/events.html
- CUSTOM EVENTS a components: https://vuejs.org/v2/guide/components-custom-events.html

8) SLOTS


9) Axios

- Comunicació amb la API
- Javascript Promises
- Programació asíncrona i Javascript

-->