<template>
    <v-switch v-model="dataTask.completed" :label="dataTask.comple ? 'Completada' : 'Pendent'"></v-switch>
</template>

<script>
export default {
  name: 'taskCompletedToggle',
  data () {
    return {
      dataTask: this.task
    }
  },
  props: {
    task: {
      type: Boolean,
      required: true
    }
  },
  watch: {
    dataTask: {
      handler: function (dataTask) {
        if (dataTask.completed) this.completeTask()
        else this.uncompleteTask()
      },
      deep: true
    }
  },
  methods: {
    completeTask () {
      // window.axios.post('/v1/completed_task/' + this.task.id) // TODO ACABAR
    },
    uncompleteTask () {
      // window.axios.delete('/v1/completed_task/' + this.task.id) // TODO ACABAR
    }
  }
}
</script>
