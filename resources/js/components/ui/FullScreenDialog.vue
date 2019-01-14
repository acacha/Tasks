<template>
    <span>
        <v-btn :flat="flat" icon :title="title" :color="color" dark class="ma-0" @click="toggle">
            <v-badge left overlap :color="badgeColor" v-if="badge">
              <span slot="badge" v-text="badge"></span>
              <v-icon large v-text="icon"></v-icon>
            </v-badge>
            <v-icon v-else v-text="icon"></v-icon>
        </v-btn>
        <v-dialog v-if="dialog" v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition"
            @keydown.esc.stop.prevent="toggle"><slot></slot></v-dialog>
    </span>
</template>

<script>
export default {
  name: 'FullScreenDialog',
  model: {
    prop: 'dialog',
    event: 'toggle'
  },
  props: {
    flat: {
      type: Boolean,
      default: true
    },
    badgeColor: {
      type: String,
      default: 'primary'
    },
    badge: {
      type: Number,
      default: null
    },
    color: {
      type: String,
      default: 'primary'
    },
    icon: {
      type: String,
      default: 'visibility'
    },
    resource: {
      type: Object,
      required: false
    },
    dialog: {},
    title: {
      type: String,
      default: ''
    }
  },
  methods: {
    toggle () {
      if (this.resource) {
        this.dialog ? this.$emit('toggle', false) : this.$emit('toggle', this.resource.id)
      } else this.$emit('toggle', !this.dialog)
    }
  }
}
</script>
