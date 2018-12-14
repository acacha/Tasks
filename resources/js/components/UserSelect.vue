<template>
    <v-autocomplete
            :items="dataUsers"
            v-model="selectedUser"
            :item_value="itemValue"
            clearable
            :label="label"
    >
        <template slot="selection" slot-scope="data">
            <v-chip>
                <v-avatar :title="data.item.name">
                    <img :src="data.item.gravatar" :alt="data.item.name">
                </v-avatar>
                {{ data.item.name }}
            </v-chip>
        </template>
        <template slot="item" slot-scope="{ item: user }">
            <v-list-tile-avatar>
                <v-avatar :title="user.name">
                    <img v-if="user.gravatar" :src="user.gravatar" alt="avatar">
                    <img v-else src="https://www.gravatar.com/avatar/" alt="avatar">
                </v-avatar>
            </v-list-tile-avatar>
            <v-list-tile-content>
                <v-list-tile-title v-text="user.name"></v-list-tile-title>
                <v-list-tile-sub-title v-text="user.email"></v-list-tile-sub-title>
            </v-list-tile-content>
        </template>
    </v-autocomplete>
</template>

<script>
export default {
  name: 'UserSelect',
  data () {
    return {
      dataUsers: this.users,
      selectedUser: this.user
    }
  },
  model: {
    prop: 'user',
    event: 'selected'
  },
  props: {
    itemValue: {
      type: String,
      default: 'id'
    },
    user: {
      type: Object,
      default: function () {
        return {}
      }
    },
    users: {
      type: Array,
      required: true
    },
    label: {
      type: String,
      default: 'Usuaris'
    }
  },
  watch: {
    user (user) {
      this.selectedUser = user
    },
    selectedUser (newValue) {
      this.$emit('selected', newValue)
    },
    users () {
      this.dataUsers = this.users
    }
  }
}
</script>
