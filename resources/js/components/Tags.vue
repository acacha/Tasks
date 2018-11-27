<template>
    <div>
        TODO TAGS
        <v-btn @click="showMessage">Show snackbar message</v-btn>
        <v-btn @click="showError">Show snackbar error</v-btn>
    </div>
</template>

<script>
import EventBus from '../eventBus'
export default {
  name: 'Tags',
  data () {
    return {
    }
  },
  methods: {
    showMessage () {
      EventBus.$emit('showMessage', 'Missatge exemple')
    },
    showError () {
      EventBus.$emit('showError', 'Error exemple')
    }
  }
}
</script>
