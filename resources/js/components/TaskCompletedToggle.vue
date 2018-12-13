<template>
    <v-switch
            v-model="dataTask.completed"
            :label="dataTask.completed ? 'Completada' : 'Pendent'"
            :loading="loading"
    ></v-switch>
</template>

<script>
export default {
  name: 'taskCompletedToggle',
  data () {
    return {
      dataTask: this.task,
      loading: false
    }
  },
  props: {
    task: {
      type: Object,
      required: true
    }
  },
  watch: {
    task (task) {
      this.dataTask = task
    },
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
      this.loading = true
      window.axios.post('/api/v1/completed_task/' + this.task.id).then(() => {
        this.loading = false
      }).catch(error => {
        this.loading = false
        this.$snackbar.showError(error)
      })
    },
    uncompleteTask () {
      this.loading = true
      window.axios.delete('/api/v1/completed_task/' + this.task.id).then(() => {
        this.loading = false
      }).catch(error => {
        this.loading = false
        this.$snackbar.showError(error)
      })
    }
  }
}
</script>
