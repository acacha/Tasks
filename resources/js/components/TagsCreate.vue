<template>
<span>
    <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition" @keydown.esc.stop.prevent="dialog=false">
        <v-toolbar color="primary" class="white--text">
        <v-btn flat icon class="white--text" @click="dialog=false">
            <v-icon>close</v-icon>
        </v-btn>
        <v-toolbar-title class="white--text">Crear Etiqueta</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn flat class="white--text" @click="dialog=false">
            <v-icon class="mr-1">exit_to_app</v-icon>
            Sortir
        </v-btn>
        <v-btn flat class="white--text">
            <v-icon class="mr-1">save</v-icon>
            Afegir
        </v-btn>
    </v-toolbar>
        <v-card>
            <v-card-text>
                <tags-form @close="dialog=false" @created="created" ></tags-form>
            </v-card-text>
        </v-card>
    </v-dialog>
    <v-btn
            @click="dialog = true"
            fab
            bottom
            right
            fixed
            color="pink"
            class="white--text"
    >
            <v-icon>add</v-icon>
        </v-btn>
</span>
</template>

<script>
import TagsForm from './TagsForm'
export default {
  name: 'TagsCreate',
  components: {
    'tags-form': TagsForm
  },
  data () {
    return {
      dialog: false
    }
  },
  methods: {
    created (tags) {
      this.$emit('created', tags)
    }
  }
}
</script>
