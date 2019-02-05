<template>
    <span v-if="!closed">
        <v-toolbar color="primary" dense>
            <v-toolbar-title class="white--text">Notificacions rebudes</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items>
                <v-btn icon class="white--text" @click.native="closed=true;$emit('close')">
                    <v-icon>close</v-icon>
                </v-btn>
                <v-btn class="white--text" v-if="!minified" icon @click.native="minified=true;$emit('minified')">
                    <v-icon>remove</v-icon>
                </v-btn>
                <v-btn class="white--text" v-else icon @click.native="minified=false;$emit('maxified')">
                    <v-icon>add</v-icon>
                </v-btn>
            </v-toolbar-items>
        </v-toolbar>
        <template v-if="!minified" v-for="notification in notifications">
            <notification-card class="mb-1" :notification="notification"></notification-card>
        </template>
    </span>
</template>

<script>
import NotificationCard from './NotificationCard'
export default {
  name: 'UserNotificationsList',
  components: {
    'notification-card': NotificationCard
  },
  data () {
    return {
      closed: false,
      minified: false
    }
  },
  props: {
    notifications: {
      type: Array,
      required: true
    }
  }
}
</script>
