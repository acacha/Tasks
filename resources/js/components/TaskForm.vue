<template>
    <v-form>
        <v-text-field v-model="name" label="Nom" hint="El nom de la tasca..." placeholder="Nom de la tasca"></v-text-field>
        <v-switch v-model="completed" :label="completed ? 'Completada' : 'Pendent'"></v-switch>

        <v-textarea v-model="description" label="Descripció" hint="Escriu la descripció de la tasca..."></v-textarea>
        <v-autocomplete v-model="user_id" :items="dataUsers" label="Usuari" item-text="name"></v-autocomplete>
        <div class="text-xs-center">
            <v-btn @click="$emit('close')">
                <v-icon class="mr-1">exit_to_app</v-icon>
                Cancel·lar
            </v-btn>
            <v-btn color="success" @click="add">
                <v-icon class="mr-1" >save</v-icon>
                Afegir
            </v-btn>
        </div>
    </v-form>
</template>

<script>
export default {
  name: 'TaskForm',
  data () {
    return {
      name: '',
      completed: false,
      description: '',
      dataUsers: this.users,
      loading: false,
      user_id: null
    }
  },
  props: {
    users: {
      type: Array,
      required: true
    },
    addUri: {
      type: String,
      default: '/api/v1/tasks'
    }
  },
  methods: {
    add () {
      this.loading = true
      const task = {
        'name': this.name,
        'description': this.description,
        'completed': this.completed,
        'user_id': this.user_id
      }
      window.axios.post(this.addUri, task).then(response => {
        this.$snackbar.showMessage('Tasca creada correctament')
        this.$emit('created', response.data)
        this.loading = false
        this.$emit('close')
      }).catch(error => {
        this.$snackbar.showError(error.data)
        this.loading = false
      })
    }
  }
}
</script>
