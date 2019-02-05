<template>
    <v-btn color="error" @click="remove" :loading="loading" :disabled="loading">
        <v-icon>delete</v-icon> Eliminar
    </v-btn>
</template>

<script>
export default {
  name: 'NotificationsDeleteMultiple',
  data () {
    return {
      loading: false
    }
  },
  props: {
    notifications: {
      type: Array,
      required: true
    }
  },
  methods: {
    async remove () {
      let res = await this.$confirm('Esteu segurs que voleu eliminar aquestes notificacions?', { title: 'Esteu segurs?', buttonTrueText: 'Eliminar' })
      if (res) {
        this.removeNotifications()
      }
    },
    removeNotifications () {
      this.loading = true
      window.axios.post('/api/v1/notifications/multiple', { notifications: this.notifications.map(notification => notification.id) }).then(response => {
        this.$snackbar.showMessage("S'han esborrat correctament " + response.data + ' notificacions')
        this.$emit('deleted', response.data)
        this.loading = false
      }).catch(error => {
        this.$snackbar.showError(error)
        this.loading = false
      })
    }
  }
}
</script>
