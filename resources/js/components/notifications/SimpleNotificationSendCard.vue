<template>
    <v-card class="elevation-3" v-if="!closed">
        <v-toolbar color="primary" dense>
            <v-toolbar-title class="white--text">Enviar una notificació </v-toolbar-title>
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
        <v-container fluid grid-list-xs v-if="!minified">
            <simple-notification-send-form :users="users" @sent="$emit('sent')"></simple-notification-send-form>
        </v-container>
    </v-card>
</template>

<script>
import SimpleNotificationSendForm from './SimpleNotificationSendForm'
export default {
  name: 'SimpleNotificationSendCard',
  components: {
    'simple-notification-send-form': SimpleNotificationSendForm
  },
  data () {
    return {
      closed: false,
      minified: false
    }
  },
  props: {
    users: {
      type: Array,
      required: true
    }
  }
}
</script>
