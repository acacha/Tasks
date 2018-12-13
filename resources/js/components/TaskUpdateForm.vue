<template>
    <v-form>
        <v-text-field v-model="name" label="Nom" hint="El nom de la tasca..." placeholder="Nom de la tasca"></v-text-field>

        <!--TODO toggle component? -->
        <v-switch v-model="completed" :label="completed ? 'Completada' : 'Pendent'"></v-switch>

        <v-textarea v-model="description" label="Descripció" hint="bla bla bla..."></v-textarea>

        <!--// TODO canviar a user-select-->
        <v-autocomplete v-model="user" :items="dataUsers" label="Usuari" item-text="name"></v-autocomplete>

        <div class="text-xs-center">
            <v-btn @click="$emit('close')">
                <v-icon class="mr-1">exit_to_app</v-icon>
                Cancel·lar
            </v-btn>
            <v-btn color="success" @click="update" :disabled="working" :loading="working">
                <v-icon class="mr-1" >save</v-icon>
                Actualitzar
            </v-btn>
        </div>
    </v-form>
</template>

<script>
export default {
  data () {
    return {
      name: this.task.name,
      description: this.task.description,
      completed: this.task.completed,
      user: this.task.user,
      dataUsers: this.users,
      working: false
    }
  },
  props: {
    task: {
      type: Object,
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
    update () {
      this.working = true
      const newTask = {
        name: this.name,
        description: this.description,
        completed: this.completed,
        user: this.user
      }
      window.axios.put(this.uri + '/' + this.task.id, newTask).then((response) => {
        this.$emit('updated', response.data)
        this.$emit('close')
        this.working = false
      }).catch(error => {
        this.$snackbar.showError(error)
        this.working = false
      })
    }
  }
}
</script>
