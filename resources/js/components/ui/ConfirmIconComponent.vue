<template>
    <v-dialog v-model="dialog" persistent max-width="290" @keydown.esc="dialog = false">
        <v-tooltip bottom slot="activator" v-if="tooltip">
            <v-btn icon slot="activator" style="margin: 0px">
                <v-icon :color="color" :dark="dark">{{icon}}</v-icon>
            </v-btn>
            <span v-html="tooltip"></span>
        </v-tooltip>
        <v-btn icon slot="activator" v-else style="margin: 0px">
            <v-icon :color="color" :dark="dark">{{icon}}</v-icon>
        </v-btn>
        <v-card>
            <v-card-title class="headline" v-html="title"></v-card-title>
            <v-card-text v-html="message"></v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="green darken-1" flat @click.native="dialog = false" v-html="cancel"></v-btn>
                <v-btn color="red darken-1" flat @click.native="action" :disabled="working" :loading="working" v-html="confirm" id="confirm_button"></v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
  name: 'ConfirmIcon',
  data () {
    return {
      dialog: false
    }
  },
  props: {
    icon: {
      type: String,
      required: true
    },
    color: {
      type: String,
      default: 'primary'
    },
    dark: {
      type: Boolean,
      default: false
    },
    title: {
      type: String,
      default: 'Si us plau confirmeu...'
    },
    message: {
      type: String,
      default: 'Segur que voleu realitzar aquesta acció?'
    },
    confirm: {
      type: String,
      default: 'Confirmar'
    },
    cancel: {
      type: String,
      default: 'Cancel·lar'
    },
    working: {
      type: Boolean,
      default: false
    },
    tooltip: {
      type: String,
      default: null
    }
  },
  watch: {
    working: function (newValue, oldVAlue) {
      if (oldVAlue) {
        this.dialog = false
      }
    }
  },
  methods: {
    action () {
      this.$emit('confirmed')
    }
  }
}
</script>
