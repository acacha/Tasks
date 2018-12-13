<template>
    <span>
        <tasks-list :users="users" :uri="uri" :tasks="dataTasks"></tasks-list>
        <tasks-create :users="users" :uri="uri" @created="add" ></tasks-create>
    </span>
</template>

<script>
import TasksCreate from './TasksCreate'
import TasksList from './TasksList'

export default {
  name: 'Tasques',
  components: {
    'tasks-list': TasksList,
    'tasks-create': TasksCreate
  },
  data () {
    return {
      dataTasks: this.tasks
    }
  },
  props: {
    tasks: {
      type: Array,
      required: true
    },
    users: {
      type: Array,
      required: true
    },
    uri: {
      type: String,
      required: true
    }
  },
  methods: {
    add (task) {
      this.dataTasks.push(task)
    }
  }
}
</script>
