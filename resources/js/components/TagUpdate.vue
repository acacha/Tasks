<template>
    <span>
        <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition"
                  @keydown.esc="dialog=false">
            <v-toolbar color="primary" class="white--text">
                <v-btn flat icon class="white--text" @click="dialog=false">
                    <v-icon class="mr-1">close</v-icon>
                </v-btn>
                <v-toolbar-title class="white--text">Editar Etiqueta</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn flat class="white--text" @click="dialog=false">
                    <v-icon class="mr-1">exit_to_app</v-icon>
                    Sortir
                </v-btn>
                <!--TODO-->
                <v-btn flat class="white--text">
                    <v-icon class="mr-1">save</v-icon>
                    Guardar
                </v-btn>
            </v-toolbar>
            <v-card>
                <v-card-text>
                    <tag-update-form :tag="tag" @close="dialog=false" @updated="updated"></tag-update-form>
                </v-card-text>
            </v-card>
        </v-dialog>
        <v-btn v-if="$can('tags.update',tag)" icon color="success" flat title="Canviar la tasca"
               @click="dialog=true">
            <v-icon>edit</v-icon>
        </v-btn>
    </span>

</template>

<script>
import TagUpdateForm from './TagUpdateForm'
export default {
  name: 'TagUpdate',
  components: {
    'tag-update-form': TagUpdateForm
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
  },
  methods: {
    updated (tag) {
      this.$emit('updated', tag)
    }
  }
}
</script>
