<template>
    <span>
        <v-toolbar color="blue darken-3">
            <v-menu bottom>
                <v-btn slot="activator" icon dark>
                    <v-icon>more_vert</v-icon>
                </v-btn>
                <v-list>
                    <v-list-tile href="/jobs/sheet_holders" target="_blank">
                        <v-list-tile-title>TODO 0 Estadístiques</v-list-tile-title>
                    </v-list-tile>
                </v-list>
            </v-menu>
            <v-toolbar-title class="white--text title" v-text="title"></v-toolbar-title>
            <v-spacer></v-spacer>

            <v-btn v-if="returnUrl" icon class="white--text" :href="returnUrl" title="Torna al mòdul">
                <v-icon>arrow_back</v-icon>
            </v-btn>

            <v-btn flat class="white--text" @click="realTime=!realTime" >
                <span class="mr-1">Temps real</span> <v-icon v-if="realTime">check_box</v-icon><v-icon v-else>check_box_outline_blank</v-icon>
            </v-btn>

            <fullscreen-dialog
                    :flat="false"
                    class="white--text"
                    icon="settings"
                    v-model="settingsDialog"
                    color="blue darken-3"
                    title="Canviar la configuració del registre de canvis">
                        <changelog-settings module="changelog" @close="settingsDialog = false"></changelog-settings>
            </fullscreen-dialog>

            <v-btn id="incidents_refresh_button" icon class="white--text" @click="refresh" :loading="refreshing" :disabled="refreshing">
                <v-icon>refresh</v-icon>
            </v-btn>
        </v-toolbar>
        <v-card>
              <v-container fluid>
                  <v-text-field
                          append-icon="search"
                          label="Buscar"
                          single-line
                          hide-details
                          v-model="search"
                          class="mb-2"
                  ></v-text-field>
                <v-timeline dense clipped>
                    <!--<v-slide-x-transition group> // TODO NO VA!! -->
                        <v-data-iterator
                                :search="search"
                                :items="timeline"
                                :rows-per-page-items="rowsPerPageItems"
                                :pagination.sync="pagination"
                                no-results-text="No s'ha trobat cap registre coincident"
                                no-data-text="No hi han dades disponibles"
                                rows-per-page-text="Registres per pàgina"
                                row
                                wrap

                        >
                     <v-timeline-item
                             slot="item"
                             slot-scope="{ item: log}"
                             :key="log.id"
                             class="mb-3"
                             :color="log.color"
                             :icon="log.icon"
                             small
                     >
                        <v-layout justify-space-between>
                            <v-flex xs2 text-xs-left align-self-center>
                                <template v-if="log.user_name">
                                    <user-avatar class="mr-2" :hash-id="log.user_hashid"
                                                 :alt="log.user_name"
                                    ></user-avatar>
                                    <span :title="log.user_email">{{log.user_name}}</span>
                                </template>
                                <template v-else>Cap usuari</template>
                            </v-flex>
                              <v-flex xs1 text-xs-left align-self-center>
                                <timeago v-if="realTime" :title="log.formatted_time" :datetime="typeof log.time === 'object' ? log.time.date : log.time" :auto-update="1" :converterOptions="{ includeSeconds: true }"></timeago>
                                <span :title="log.formatted_time" v-else>{{ log.human_time }}</span>
                            </v-flex>
                            <v-flex xs4 v-html="log.text" text-xs-left align-self-center></v-flex>
                            <v-flex xs1 text-xs-left align-self-center>
                                <compare-values name="Compara" title="Compara valor àntic i valor nou" :log="log"></compare-values>
                            </v-flex>
                            <v-flex xs1 text-xs-left align-self-center>
                                <json-dialog-component name="Actual" title="Objecte actual" :json="log.loggable"></json-dialog-component>
                            </v-flex>
                            <v-flex xs1 text-xs-left align-self-center>
                                <json-dialog-component name="Nou" title="Objecte nou" :json="JSON.parse(log.new_loggable)"></json-dialog-component>
                            </v-flex>
                            <v-flex xs1 text-xs-left align-self-center>
                                <json-dialog-component name="Àntic" title="Objecte en el moment de la modificació"  :json="JSON.parse(log.old_loggable)"></json-dialog-component>
                            </v-flex>
                            <v-flex xs1 text-xs-left align-self-center>
                                <v-btn icon :href="log.module.href" :target="log.module.target">
                                    <v-icon :title="'Mòdul ' + log.module.text">{{ log.module.icon }}</v-icon>
                                </v-btn>
                            </v-flex>
                            <v-flex xs1 text-xs-left align-self-center>
                                <v-icon :title="'Acció: ' + log.action.text">{{ log.action.icon }}</v-icon>
                            </v-flex>
                        </v-layout>
                    </v-timeline-item>
                 </v-data-iterator>
                     <!--</v-slide-x-transition>-->
                </v-timeline>
              </v-container>
        </v-card>
    </span>
</template>

<script>
import FullScreenDialog from '../ui/FullScreenDialog'
import JsonDialogComponent from '../ui/JsonDialogComponent'
import CompareValuesComponent from '../ui/CompareValuesComponent'
import ChangelogSettings from './ChangelogSettingsComponent'
import UserAvatar from '../ui/UserAvatarComponent'

export default {
  name: 'ChangelogList',
  components: {
    'fullscreen-dialog': FullScreenDialog,
    'json-dialog-component': JsonDialogComponent,
    'compare-values': CompareValuesComponent,
    'changelog-settings': ChangelogSettings,
    'user-avatar': UserAvatar
  },
  data () {
    return {
      search: '',
      settingsDialog: false,
      refreshing: false,
      dataLogs: this.logs,
      realTime: true,
      rowsPerPageItems: [ 10, 25, 50, 100, 500, 1000, { 'text': 'Tots', 'value': -1 } ],
      pagination: {
        rowsPerPage: 10
      }
    }
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
  },
  computed: {
    timeline () {
      return this.dataLogs.slice().reverse()
    }
  },
  watch: {
    realTime (newValue) {
      newValue ? this.activeRealTime() : this.disableRealTime()
    }
  },
  methods: {
    refresh () {
      this.fetch()
    },
    fetch () {
      this.refreshing = true
      window.axios.get(this.refreshUrl).then(response => {
        this.$snackbar.showMessage('Registre de canvis actualitzat correctament')
        this.dataLogs = response.data
        this.refreshing = false
      }).catch(error => {
        this.$snackbar.showError(error)
        this.refreshing = false
      })
    },
    activeRealTime () {
      // TODO NOTIFICATIONs
      // window.Echo.private(this.channel)
      //   .listen('LogCreated', (e) => {
      //     this.dataLogs.push(e.log)
      //   })
    },
    disableRealTime () {
      window.Echo.leave(this.channel)
    }
  },
  created () {
    if (this.realTime) this.activeRealTime()
  }
}
</script>
