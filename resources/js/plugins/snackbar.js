import * as mutations from '../store/mutation-types'
import store from '../store'

export default {
  install (Vue, options) {
    // Add Vue instance methods by attaching them to Vue.prototype.
    Vue.prototype.$snackbar = {
      showMessage (message) {
        this.showSnackBar(message, 'success')
      },
      showError (error) {
        this.showSnackBar(error, 'error')
      },
      cleanState () {
        setTimeout(() => {
          store.commit(mutations.SET_SNACKBAR_SHOW, false)
          store.commit(mutations.SET_SNACKBAR_TEXT, '')
          store.commit(mutations.SET_SNACKBAR_SUBTEXT, '')
        }, store.getters.snackbarTimeout)
      },
      showSnackBar (message, color) {
        store.commit(mutations.SET_SNACKBAR_SHOW, true)
        store.commit(mutations.SET_SNACKBAR_COLOR, color || 'error')
        if (typeof message === 'string') {
          store.commit(mutations.SET_SNACKBAR_TEXT, message)
          this.cleanState()
          return
        }
        if (message.status) {
          store.commit(mutations.SET_SNACKBAR_TEXT, message.status + ' ' + message.statusText)
          if (message.data && message.data.message) store.commit(mutations.SET_SNACKBAR_SUBTEXT, message.data.message)
          else store.commit(mutations.SET_SNACKBAR_SUBTEXT, message.statusText)
          this.cleanState()
        } else {
          store.commit(mutations.SET_SNACKBAR_TEXT, 'Error de xarxa')
          this.cleanState()
        }
      }
    }
  }
}
