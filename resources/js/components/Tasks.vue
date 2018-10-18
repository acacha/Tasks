<template>
    <div id="tasks" class="tasks">
        <h1>Tasques ({{total}}):</h1>
        <input type="text"
               v-model="newTask" @keyup.enter="add"
               name="name"
        >

        <div v-if="errorMessage">
            Ha succeit un error: {{ errorMessage }}
        </div>

        <button id="button_add_task" @click="add">Afegir</button>

        <!--// SINTAX SUGAR-->
        <!--<input :value="newTask" @input="newTask = $event.target.value">-->
        <ul>
            <li v-for="task in filteredTasks" :key="task.id">
                <span :id="'task' + task.id" :class="{ strike: task.completed }">
                    <editable-text
                            :text="task.name"
                            @edited="editName(task, $event)"
                    ></editable-text>
                </span>
                &nbsp;
                <span @click="remove(task)">&#215;</span>
            </li>
        </ul>

        <span id="filters" v-show="total > 0">
            <h3>Filtros:</h3>
            Active filter: {{ filter }}
            <ul>
                <li><button @click="setFilter('all')">Totes</button></li>
                <li><button @click="setFilter('completed')">Completades</button></li>
                <li><button @click="setFilter('active')">Pendents</button></li>
            </ul>
        </span>

    </div>
</template>

<script>

import EditableText from './EditableText'

var filters = {
  all: function (tasks) {
    return tasks
  },
  completed: function (tasks) {
    return tasks.filter(function (task) {
      return task.completed
      // NO CAL
      // if (task.completed) return true
      // else return false
    })
  },
  active: function (tasks) {
    return tasks.filter(function (task) {
      return !task.completed
    })
  }
}

export default {
  name: 'Tasks',
  components: {
    'editable-text': EditableText
  },
  data () {
    return {
      filter: 'all', // All Completed Active
      newTask: '',
      dataTasks: this.tasks,
      errorMessage: ''
    }
  },
  props: {
    tasks: {
      type: Array,
      default: function () {
        return []
      }
    }
  },
  computed: {
    total () {
      return this.dataTasks.length
    },
    filteredTasks () {
      // Segons el filtre actiu
      // Alternativa switch/case -> array associatiu
      return filters[this.filter](this.dataTasks)
    }
  },
  watch: {
    tasks (newTasks) {
      this.dataTasks = newTasks
    }
  },
  methods: {
    editName (task, text) {
      task.name = text
    },
    setFilter (newFilter) {
      this.filter = newFilter
    },
    add () {
      window.axios.post('/api/v1/tasks', {
        name: this.newTask
      }).then((response) => {
        console.log('RESPONSE:')
        console.log(response.data)
        console.log('TASCA:')
        let task = { id: response.data.id, name: this.newTask, completed: false }
        console.log(task)
        this.dataTasks.splice(0, 0, { id: response.data.id, name: this.newTask, completed: false })
        this.newTask = ''
      }).catch((error) => {
        console.log(error)
      })
    },
    remove (task) {
      this.dataTasks.splice(this.dataTasks.indexOf(task), 1)
    }
  },
  created () {
    if (this.tasks.length === 0) {
      window.axios.get('/api/v1/tasks').then((response) => {
        console.log(response.data)
        this.dataTasks = response.data
      }).catch((error) => {
        this.errorMessage = error.response.data
      })
    }
  }
}
</script>

<style>
  .strike {
    text-decoration: line-through;
  }
</style>
