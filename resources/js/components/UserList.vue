<template>
    <v-list two-line>
        <template v-for="user in dataUsers">
            <v-list-tile>
                <v-list-tile-avatar>
                    <v-avatar :title="user.name">
                        <img :src="user.avatar" alt="avatar">
                    </v-avatar>
                </v-list-tile-avatar>
                <v-list-tile-content>
                    <v-list-tile-title v-text="user.name"></v-list-tile-title>
                    <v-list-tile-sub-title v-text="user.email"></v-list-tile-sub-title>
                </v-list-tile-content>
            </v-list-tile>
            <v-divider></v-divider>
        </template>
    </v-list>
</template>

<script>
export default {
  name: 'UserList',
  data () {
    return {
      dataUsers: []
    }
  },
  props: {
    users: {
      type: Array
    }
  },
  created () {
    if (this.users) this.dataUsers = this.users
    else {
      window.axios.get('/api/v1/users').then(response => {
        this.dataUsers = response.data
      }).catch(error => {
        console.log(error)
        // this.$snackbar.showError(error)
      })
    }
  }
}
</script>
