<template>
    <user-select :users="dataUsers" :label="label" @selected="impersonate" :item-value="null"></user-select>
</template>

<script>
import UserSelect from './UserSelect'

export default {
  name: 'Impersonate',
  components: {
    'user-select': UserSelect
  },
  data () {
    return {
      dataUsers: []
    }
  },
  props: {
    users: {
      type: Array
    },
    url: {
      type: String,
      default: '/api/v1/users'
    },
    label: {
      type: String,
      default: 'Usuaris'
    }
  },
  methods: {
    impersonate (user) {
      if (user) {
        window.location.href = '/impersonate/take/' + user.id
      }
    }
  },
  created () {
    if (this.users) this.dataUsers = this.users
    else {
      window.axios.get(this.url).then(response => {
        this.dataUsers = response.data
      }).catch(error => {
        this.$snackbar.showError(error)
      })
    }
  }
}
</script>
