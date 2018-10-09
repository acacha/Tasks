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
  name: 'Tasks',
  components: {
    'editable-text': EditableText
  },
  data() {
    return {
        filter: 'all', // All Completed Active
        newTask: '',
        dataTasks: this.tasks
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
    total() {
      return this.dataTasks.length
    },
    filteredTasks() {
        // Segons el filtre actiu
        // Alternativa switch/case -> array associatiu
        return filters[this.filter](this.dataTasks)
    }
  },
  watch: {
    tasks(newTasks) {
      this.dataTasks = newTasks
    }
  },
  methods: {
      editName(task,text) {
          task.name = text
      },
      setFilter(newFilter) {
          this.filter = newFilter
      },
      add() {
          this.dataTasks.splice(0,0,{ name: this.newTask, completed: false } )
          this.newTask=''
      },
      remove(task) {
          this.dataTasks.splice(this.dataTasks.indexOf(task),1)
      }
  },
  created() {
    // console.log('Component Tasks ha estat creat');
  }
}
</script>

<style>
  .strike {
    text-decoration: line-through;
  }
</style>
