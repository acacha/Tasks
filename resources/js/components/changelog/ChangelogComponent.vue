<template>
    <v-container fluid grid-list-md text-xs-center>
        <v-layout row wrap>
            <v-flex xs12>
                <changelog-list :refresh-url="refreshUrl" :return-url="returnUrl" :title="title" :channel="channel" :users="users" :logs="logs"></changelog-list>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
import ChangelogListComponent from './ChangelogListComponent'
export default {
  name: 'ChangeLogComponent',
  components: {
    'changelog-list': ChangelogListComponent
  },
  props: {
    logs: {
      type: Array,
      required: true
    },
    users: {
      type: Array,
      required: true
    },
    channel: {
      type: String,
      default: 'App.Log'
    },
    title: {
      type: String,
      default: 'Registre de canvis'
    },
    returnUrl: {
      type: String,
      default: null
    },
    refreshUrl: {
      type: String,
      default: '/api/v1/changelog'
    }
  }
}
</script>
