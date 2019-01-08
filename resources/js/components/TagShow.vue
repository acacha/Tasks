<template>
    <span>
        <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition" @keydown.esc.stop.prevent="dialog=false">
            <v-toolbar color="primary" class="white--text">
            <v-btn flat icon class="white--text" @click="dialog=false">
                <v-icon>close</v-icon>
            </v-btn>
            <v-toolbar-title class="white--text">Mostrar la etiqueta</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn flat class="white--text" @click="dialog=false">
                <v-icon class="mr-1">exit_to_app</v-icon>
                Sortir
            </v-btn>
        </v-toolbar>
            <v-card>
                <v-card-text>
                    <tag-show-form :tag="tag"></tag-show-form>
                </v-card-text>
            </v-card>
        </v-dialog>

        <v-btn icon color="primary" flat title="Mostrar l'etiqueta"
               @click="dialog=true">
            <v-icon>visibility</v-icon>
        </v-btn>
    </span>
</template>

<script>
import TagShowForm from './TagShowForm'

export default {
  name: 'TagShow',
  components: {
    'tag-show-form': TagShowForm
  },
  data () {
    return {
      dialog: false
    }
  },
  props: {
    tag: {
      type: Object,
      required: true
    }
  }
}
</script>
