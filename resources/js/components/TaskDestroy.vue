<template>
    <v-btn v-can="'tasks.destroy'" icon color="error" flat title="Eliminar la tasca"
           :loading="removing" :disabled="removing"
           @click="destroy(task)">
        <v-icon>delete</v-icon>
    </v-btn>
</template>

<script>
export default {
  'name': 'TaskDestroy',
  data () {
    return {
      removing: false,
    }
  },
  props: {
    task: {
      type: Object,
      required: true
    },
    uri: {
      type: String,
      required: true
    }
  },
  methods: {
    async destroy (task) {
      // ES6 async await
      let result = await this.$confirm('Les tasques esborrades no es poden recuperar',
        {
          title: 'Esteu segurs?',
          buttonTruetext: 'Eliminar',
          buttonFalsetext: 'Cancel·lar',
          color: 'error'
        })
      if (result) {
        this.removing = true
        window.axios.delete(this.uri + '/' + task.id).then(() => {
          this.$snackbar.showMessage("S'ha esborrat correctament la tasca")
          this.$emit('removed', task)
          this.removing = false
        }).catch(error => {
          this.$snackbar.showError(error.message)
          this.removing = false
        })
      }
    }
  }
}
</script>
