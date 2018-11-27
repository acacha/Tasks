<template>
    <div>
        TODO TAGS
        <v-btn @click="showMessage">Show snackbar message</v-btn>
        <v-btn @click="showError">Show snackbar error</v-btn>
    </div>
</template>

<script>
export default {
  name: 'Tags',
  data () {
    return {
    }
  },
  methods: {
    showMessage () {
      this.$snackbar.showMessage('Missatge exemple')
    },
    showError () {
      this.$snackbar.showError('Error exemple')
    }
  }
}
</script>
