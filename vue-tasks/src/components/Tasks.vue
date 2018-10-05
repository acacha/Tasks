<template>
    <div>
        <h1>Tasques ({{total}}):</h1>
        <input type="text"
               v-model="newTask" @keyup.enter="add">
        <button @click="add">Afegir</button>

        <!--// SINTAX SUGAR-->

        <!--<input :value="newTask" @input="newTask = $event.target.value">-->
        <ul>
            <li v-for="task in filteredTasks" :key="task.id">
                <span :class="{ strike: task.completed }">
                    <editable-text
                            :text="task.name"
                            @edited="editName(task, $event)"
                    ></editable-text>
                </span>
                &nbsp;
                <span @click="remove(task)">&#215;</span>
            </li>
        </ul>

        <h3>Filtros:</h3>
        Activa filter: {{ filter }}
        <ul>
            <li><button @click="setFilter('all')">Totes</button></li>
            <li><button @click="setFilter('completed')">Completades</button></li>
            <li><button @click="setFilter('active')">Pendents</button></li>
        </ul>
    </div>
</template>

<script>

import EditableText from './EditableText'

var filters = {
  all: function(tasks) {
    return tasks
  },
  completed: function(tasks) {
    return tasks.filter(function (task) {
      return task.completed
        // NO CAL
      // if (task.completed) return true
      // else return false
    })
  },
  active: function(tasks) {
      return tasks.filter(function (task) {
          return !task.completed
      })
  },
}

export default {
  components: {
    'editable-text': EditableText
  },
  data() {
    return {
        filter: 'all', // All Completed Active
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
  computed: {
    total() {
      return this.tasks.length
    },
    filteredTasks() {
        // Segons el filtre actiu
        // Alternativa switch/case -> array associatiu
        return filters[this.filter](this.tasks)
    }
  },
  methods: {
      editName(task,text) {
          console.log('TASK: ' , task.name);
          console.log('text: ' , text);
          console.log('TODO edit name');
          task.name = text
      },
      setFilter(newFilter) {
          this.filter = newFilter
      },
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
</script>

<style>
  .strike {
    text-decoration: line-through;
  }
</style>
