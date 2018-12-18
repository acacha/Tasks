<template>
    <v-btn v-can="'tags.destroy'" icon color="error" flat title="Eliminar l'etiqueta"
           :loading="removing" :disabled="removing"
           @click="destroy(tag)">
        <v-icon>delete</v-icon>
    </v-btn>
</template>

<script>
export default {
  'name': 'TagDestroy',
  data () {
    return {
      removing: false
    }
  },
  props: {
    tag: {
      type: Object,
      required: true
    }
  },
  methods: {
    async destroy (tag) {
      let result = await this.$confirm('Les etiquetes esborrades no es poden recuperar',
        {
          title: 'Esteu segurs?',
          buttonTruetext: 'Eliminar',
          buttonFalsetext: 'Cancel·lar',
          color: 'error'
        })
      if (result) {
        this.removing = true
        window.axios.delete('/api/v1/tags/' + tag.id).then(() => {
          this.$snackbar.showMessage("S'ha esborrat correctament l'etiqueta")
          this.$emit('removed', tag)
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
