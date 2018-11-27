export default {
  data () {
    return {
      snackbarMessage: 'Prova',
      snackbarTimeout: 3000,
      snackbarColor: 'success',
      snackbar: false
    }
  },
  methods: {
    showMessage (message) {
      this.snackbarMessage = message
      this.snackbarColor = 'success'
      this.snackbar = true
    },
    showError (error) {
      this.snackbarMessage = error
      this.snackbarColor = 'error'
      this.snackbar = true
    }
  }
}
