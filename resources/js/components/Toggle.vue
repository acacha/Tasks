<template>
    <v-switch v-model="dataCompleted" :label="dataCompleted ? 'Completada' : 'Pendent'"></v-switch>
</template>

<script>
export default {
  name: 'Toggle',
  data () {
    return {
      dataCompleted: this.completed
    }
  },
  props: {
    completed: {
      type: Boolean,
      required: true
    },
    id: {
      type: Number,
      required: true
    }
  },
  watch: {
    completed (completed) {
      this.dataCompleted = completed
    },
    dataCompleted (dataCompleted, oldDataCompleted) {
      console.log('dataCompleted ha canviat')
      console.log('NOU:')
      console.log(dataCompleted)
      console.log('ANTIC:')
      console.log(oldDataCompleted)
      if (dataCompleted) {
        // LOADING i disabled TODO
        window.axios.post('/v1/completed_task/' + this.id) // TODO ACABAR
        // Route::delete('/v1/completed_task/{task}','Api\CompletedTasksController@destroy');
        // Route::post('/v1/completed_task/{task}','Api\CompletedTasksController@store');
      } else {
        // window.axios.delete('/v1/completed_task/{task}') // TODO ACABAR
      }
    }
  }
}
</script>
