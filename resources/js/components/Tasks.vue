<template>
    <v-container grid-list-md text-xs-center id="tasks" class="tasks">
        <v-layout row wrap>
            <v-flex xs12>
                <v-card>
                    <v-card-title dark color="primary">
                        <span class="title">Tasques ({{total}})</span>
                    </v-card-title>
                    <v-card-text class="px-0">
                        <form>
                            <v-text-field
                                    type="text"
                                    v-model="newTask" @keyup.enter="add"
                                    name="name"
                                    required>
                            </v-text-field>
                            <input type="text"
                                   v-model="newTask" @keyup.enter="add"
                                   name="name"
                                   required
                            >
                            <v-btn id="button_add_task" @click="add">Afegir</v-btn>
                        </form>

                        <div v-if="errorMessage">
                            Ha succeit un error: {{ errorMessage }}
                        </div>
                        <v-list dense>
                            <v-list-tile v-for="task in filteredTasks" :key="task.id">
                                <v-list-tile-content>
                                    <v-list-tile-title>
                                        <span :id="'task' + task.id" :class="{ strike: task.completed }">
                                        </span>
                                        <editable-text
                                                :text="task.name"
                                                @edited="editName(task, $event)"
                                        ></editable-text>
                                    </v-list-tile-title>
                                </v-list-tile-content>
                            </v-list-tile>
                        </v-list>

                        <span id="filters" v-show="total > 0">
        <h3>Filtros:</h3>
        Active filter: {{ filter }}
        <ul>
            <li><button @click="setFilter('all')">Totes</button></li>
            <li><button @click="setFilter('completed')">Completades</button></li>
            <li><button @click="setFilter('active')">Pendents</button></li>
        </ul>
    </span>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
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
      if (this.newTask === '') return
      window.axios.post('/api/v1/tasks', {
        name: this.newTask
      }).then((response) => {
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
