<template>
    <v-card class="elevation-3" v-if="!closed" >
        <v-toolbar dense color="white" class="elevation-0">
            <v-spacer></v-spacer>
            <v-toolbar-items>
                <v-btn icon @click.native="closed=true;$emit('close')">
                    <v-icon color="grey">close</v-icon>
                </v-btn>
                <v-btn v-if="!minified" icon @click.native="minified=true;$emit('minified')">
                    <v-icon color="grey">remove</v-icon>
                </v-btn>
                <v-btn v-else icon @click.native="minified=false;$emit('maxified')">
                    <v-icon color="grey">add</v-icon>
                </v-btn>
            </v-toolbar-items>
        </v-toolbar>
        <v-container fluid grid-list-xs v-if="!minified">
            <v-layout row wrap>
                <v-flex xs12>
                    {{ dataNotification.data.title }}
                    {{ dataNotification }}
                </v-flex>
            </v-layout>
        </v-container>

    </v-card>
</template>

<script>
export default {
  name: 'NotificationCard',
  data () {
    return {
      dataNotification: this.notification,
      closed: false,
      minified: false
    }
  },
  props: {
    notification: {
      type: Object,
      required: true
    }
  }
}
</script>
