<template>
    <span>
        <v-chip v-for="tag in task.tags" :key="tag.id" v-text="tag.name" :color="tag.color" @dblclick="removeTag"></v-chip>
        <v-btn icon @click="dialog = true"><v-icon>add</v-icon></v-btn>
        <v-btn icon @click="dialog = true"><v-icon>remove</v-icon></v-btn>
        <v-dialog v-model="dialog" width="500">
            <v-card>
                <v-card-title>Afegiu etiquetes a la tasca</v-card-title>
                <v-card-text>
                    <v-combobox
                            v-model="selectedTags"
                            :items="tags"
                            multiple
                            chips
                            item-text="name"
                    >
                        <template slot="selection"
                                  slot-scope="data">
                            <v-chip
                                    :selected="data.selected"
                                    :disabled="data.disabled"
                                    :key="JSON.stringify(data.item)"
                                    class="v-chip--select-multi"
                                    @input="data.parent.selectItem(data.item)"
                            > {{ data.item.name }}
                            </v-chip>
                        </template>
                    </v-combobox>

                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn flat @click="dialog = false">Cancel·lar</v-btn>
                    <v-btn color="primary" flat @click="addTag">Afegir</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </span>
</template>

<script>
export default {
  name: 'TasksTags',
  data () {
    return {
      dialog: false,
      selectedTags: []
    }
  },
  props: {
    task: {
      type: Object,
      required: true
    },
    tags: {
      type: Array,
      required: true
    }
  },
  methods: {
    removeTag () {
      // TODO ASYNC PRIMER EXECUTAR UN CONFIRM
      console.log('TODO REMOVE TAG')
      window.axios.delete('/api/v1/tasks/' + this.task.id + '/tag/' + this.tag).then(response => {
        this.$snackbar.showMessage('Etiqueta eliminada correctament')
      }).catch(error => {
        this.$snackbar.showError(error)
      })
    },
    addTag () {
      console.log('TODO ADD TAG')
      let tag = {}
      window.axios.post('/api/v1/tasks/' + this.task.id + '/tag', tag).then(response => {
        this.$snackbar.showMessage('Etiqueta afegida correctament')
      }).catch(error => {
        this.$snackbar.showError(error)
      })
    }
  }
}
</script>
