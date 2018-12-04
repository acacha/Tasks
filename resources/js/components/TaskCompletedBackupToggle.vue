<template>
    <v-switch v-model="dataTask.completed" :label="dataTask.completed ? 'Completada' : 'Pendent'"></v-switch>
</template>

<script>
export default {
  name: 'TaskcompletedToggle',
  data () {
    return {
      dataTask: this.task
    }
  },
  props: {
    task: {
      type: Object,
      required: true
    }
  },
  watch: {
    dataTask: {
      handler: function (dataTask, oldDataTask) {
        if (dataTask.completed) this.completeTask()
        else this.uncompleteTask()
      },
      deep: true
    },
    // dataTask (task) {
    //   if (task.completed) this.completeTask()
    //   else this.uncompleteTask()
    // },
    task (task) {
      this.dataTask = task
    }
  },
  methods: {
    uncompleteTask () {
      console.log('TODO AXIOS UNCOMPLETE TASK')
    },
    completeTask () {
      console.log('TODO AXIOS COMPLETE TASK')
    }
  }
}
</script>
