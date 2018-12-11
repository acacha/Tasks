<template>
    <span>
        <v-dialog v-model="editDialog" fullscreen hide-overlay transition="dialog-bottom-transition"
            @keydown.esc="editDialog=false">
            <v-toolbar color="blue darken-3" class="white--text">
                <v-btn flat icon class="white--text" @click="editDialog=false">
                    <v-icon class="mr-1">close</v-icon>
                </v-btn>
                <v-toolbar-title class="white--text">Editar Tasca</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn flat class="white--text" @click="editDialog=false">
                    <v-icon class="mr-1">exit_to_app</v-icon>
                    Sortir
                </v-btn>
                <v-btn flat class="white--text">
                    <v-icon class="mr-1">save</v-icon>
                    Guardar
                </v-btn>
            </v-toolbar>
            <v-card>
                <v-card-text>
                    <v-form>
                        <v-text-field v-model="name" label="Nom" hint="El nom de la tasca..." placeholder="Nom de la tasca"></v-text-field>
                        <v-switch v-model="completed" :label="completed ? 'Completada' : 'Pendent'"></v-switch>

                        <v-textarea v-model="description" label="Descripció" hint="bla bla bla..."></v-textarea>
                        <v-autocomplete :items="dataUsers" label="Usuari" item-text="name"></v-autocomplete>
                        <div class="text-xs-center">
                            <v-btn @click="editDialog=false">
                                <v-icon class="mr-1">exit_to_app</v-icon>
                                Cancel·lar
                            </v-btn>
                            <v-btn color="success">
                                <v-icon class="mr-1" >save</v-icon>
                                Guardar
                            </v-btn>
                        </div>
                    </v-form>
                </v-card-text>
            </v-card>
        </v-dialog>
        <tasks-list :users="users" :uri="uri" :tasks="tasks"></tasks-list>
        <tasks-create :users="users" :uri="uri" @created="add" ></tasks-create>
    </span>
</template>

<script>
import TaskCompletedToggle from './TaskCompletedToggle'
import TasksCreate from './TasksCreate'
import TasksList from './TasksList'

export default {
  name: 'Tasques',
  components: {
    'task-completed-toggle': TaskCompletedToggle,
    'tasks-list': TasksList,
    'tasks-create': TasksCreate
  },
  data () {
    return {
      dataUsers: this.users,
      completed: false,
      name: '',
      description: '',
      editDialog: false,
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
    },
    removeTask (task) {
      this.dataTasks.splice(this.dataTasks.indexOf(task), 1)
    }
  }
}
</script>
