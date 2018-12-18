<template>
    <span>
        <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition" @keydown.esc.stop.prevent="dialog=false">
            <v-toolbar color="blue darken-3" class="white--text">
            <v-btn flat icon class="white--text" @click="dialog=false">
                <v-icon>close</v-icon>
            </v-btn>
            <v-toolbar-title class="white--text">Mostrar Tasca</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn flat class="white--text" @click="dialog=false">
                <v-icon class="mr-1">exit_to_app</v-icon>
                Sortir
            </v-btn>
        </v-toolbar>
            <v-card>
                <v-card-text>
                    <task-show-form :task="task" :users="users"></task-show-form>
                </v-card-text>
            </v-card>
        </v-dialog>

        <v-btn icon color="primary" flat title="Mostrar la tasca"
               @click="dialog=true">
            <v-icon>visibility</v-icon>
        </v-btn>
    </span>
</template>

<script>
import TaskShowForm from './TaskShowForm'

export default {
  name: 'TaskShow',
  components: {
    'task-show-form': TaskShowForm
  },
  data () {
    return {
      dialog: false
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
    }
  }
}
</script>
