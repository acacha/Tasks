<template>
    <v-card>
        <v-toolbar color="primary" dense>
            <v-menu bottom>
                <v-btn slot="activator" icon dark>
                    <v-icon>more_vert</v-icon>
                </v-btn>
                <v-list>
                    <v-list-tile href="/changelog/module/notifications" target="_blank">
                        <v-list-tile-title>Mostrar historial de notificacions (registre de canvis)</v-list-tile-title>
                    </v-list-tile>
                    <v-list-tile href="/users" target="_blank">
                        <v-list-tile-title>Gestionar usuaris</v-list-tile-title>
                    </v-list-tile>
                </v-list>
            </v-menu>
            <v-toolbar-title class="white--text">Notificacions</v-toolbar-title>
            <v-spacer></v-spacer>

            <v-tooltip bottom>
                <v-btn slot="activator" id="notifications_help_button" icon class="white--text" href="http://docs.scool.cat/docs/users" target="_blank">
                    <v-icon>help</v-icon>
                </v-btn>
                <span>Ajuda</span>
            </v-tooltip>

            <v-tooltip bottom>
                <v-btn slot="activator" icon class="white--text" @click="settings">
                    <v-icon>settings</v-icon>
                </v-btn>
                <span>Configuració</span>
            </v-tooltip>

            <v-tooltip bottom>
                <v-btn slot="activator" id="users_refresh_button" icon class="white--text" @click="refresh" :loading="refreshing" :disabled="refreshing">
                    <v-icon>refresh</v-icon>
                </v-btn>
                <span>Actualitzar</span>
            </v-tooltip>
        </v-toolbar>
        <v-card-title>
            <v-layout>
                <v-flex xs9 style="align-self: flex-end;">
                    <v-layout>
                        <v-flex xs3 class="text-sm-left" style="align-self: center;">
                            <notifications-filter-by-type :types="notificationTypes" v-model="selectedType"></notifications-filter-by-type>
                        </v-flex>
                        <v-flex xs9>
                            <v-layout>
                                <v-flex xs3>
                                    <notifications-filter-by-notifiable-type :types="notificationNotifiableTypes" v-model="selectedNotifiableType"></notifications-filter-by-notifiable-type>
                                </v-flex>
                                <v-flex xs4>
                                    <notifications-filter-by-notifiable :notifiables="notificationNotifiables" v-model="selectedNotifiable"></notifications-filter-by-notifiable>
                                </v-flex>
                                <v-flex xs5>
                                    <notifications-filters :filters="filterNames" v-model="selectedFilters"></notifications-filters>
                                </v-flex>
                            </v-layout>
                        </v-flex>
                    </v-layout>
                </v-flex>
                <v-flex xs3>
                    <v-text-field
                            append-icon="search"
                            label="Buscar"
                            single-line
                            hide-details
                            v-model="search"
                    ></v-text-field>
                </v-flex>
            </v-layout>
        </v-card-title>
        <div id="massive_actions" v-if="selected.length > 0" style="text-align: left;">
            <notifications-delete-multiple :notifications="selected" @deleted="selected=[];refresh(false)"></notifications-delete-multiple>
        </div>
        <v-data-table
                v-model="selected"
                select-all
                class="px-0 mb-5 hidden-sm-and-down"
                :headers="headers"
                :items="filteredNotifications"
                :search="search"
                item-key="id"
                disable-initial-sort
                no-results-text="No s'ha trobat cap registre coincident"
                no-data-text="No hi han dades disponibles"
                rows-per-page-text="Notificacions per pàgina"
                :rows-per-page-items="[5,10,25,50,100,200,500,1000,{'text':'Tots','value':-1}]"
        >
            <template slot="items" slot-scope="props">
                <tr>
                    <td>
                        <v-checkbox
                                v-model="props.selected"
                                primary
                                hide-details
                        ></v-checkbox>
                    </td>
                    <td class="text-xs-left cell">
                        {{ props.item.id }}
                    </td>
                    <td class="text-xs-left cell">
                        {{ props.item.type }}
                    </td>
                    <td class="text-xs-left cell">
                        <span v-if="props.item.notifiable_type === 'App\\Models\\User'">
                            <user-avatar :hash-id="props.item.user_hashid"
                                         :alt="props.item.user_name"
                                         :user="props.item.notifiable"
                            ></user-avatar>
                        </span>
                        <json-dialog-component btn-class="ma-0" icon="visibility" name="data" title="Veure les dades completes" :json="props.item.notifiable"></json-dialog-component>
                    </td>
                    <td class="text-xs-left cell" style="max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        {{ props.item.notifiable_type }}
                    </td>
                    <td class="text-xs-left cell" style="max-width: 175px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        <json-dialog-component btn-class="ma-0" icon="visibility" name="data" title="Veure les dades completes" :json="props.item.data"></json-dialog-component>
                        <span v-if="props.item.type === 'App\\Notifications\\SimpleNotification'">
                            <v-tooltip bottom>
                                <span slot="activator">{{ props.item.data.title }}</span>
                                <span>{{ props.item.data.title }}</span>
                            </v-tooltip>

                        </span>
                    </td>
                    <td class="text-xs-left cell" style="max-width: 125px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        <v-tooltip bottom>
                            <span slot="activator">{{ formatBoolean(props.item.read_at) }}</span>
                            <span v-if="props.item.read_at_formatted">{{ props.item.read_at_diff }} | {{ props.item.read_at_formatted }}</span>
                            <span v-else>{{ formatBoolean(props.item.read_at) }}</span>
                        </v-tooltip>
                    </td>
                    <td class="text-xs-left cell" :title="props.item.formatted_created_at">
                        <v-tooltip bottom>
                            <span slot="activator">{{ props.item.formatted_created_at_diff }}</span>
                            <span>{{ props.item.formatted_created_at }}</span>
                        </v-tooltip>
                    </td>
                    <td class="text-xs-left cell" :title="props.item.formatted_updated_at">
                        <v-tooltip bottom>
                            <span slot="activator">{{ props.item.formatted_updated_at_diff }}</span>
                            <span>{{ props.item.formatted_updated_at }}</span>
                        </v-tooltip>
                    </td>
                </tr>
            </template>
        </v-data-table>
    </v-card>
</template>

<script>
import NotificationsDeleteMultiple from './NotificationsDeleteMultiple'
import UserAvatar from '../ui/UserAvatarComponent'
import JsonDialogComponent from '../ui/JsonDialogComponent'
import NotificationsFilterByType from './NotificationsFilterByType'
import NotificationsFilterByNotifiableType from './NotificationsFilterByNotifiableType'
import NotificationsFilterByNotifiable from './NotificationsFilterByNotifiable'
import NotificationsFilters from './NotificationsFilters'

var filterNames = [
  {
    id: 1,
    name: 'Llegides',
    function: 'readNotifications'
  },
  {
    id: 2,
    name: 'Pendents de llegir',
    function: 'unreadNotifications'
  }
]

var filters = {
  all: function (notifications) {
    return notifications
  },
  byType: function (notifications, type) {
    return notifications ? notifications.filter(function (notification) {
      return notification.type === type
    }) : []
  },
  byNotifiableType: function (notifications, notifiableType) {
    return notifications ? notifications.filter(function (notification) {
      return notification.notifiable_type === notifiableType
    }) : []
  },
  byNotifiable: function (notifications, notifiable) {
    return notifications ? notifications.filter(function (notification) {
      return notification.notifiable.id === notifiable
    }) : []
  },
  readNotifications: function (notifications, type) {
    return notifications ? notifications.filter(function (notification) {
      return notification.read_at !== null
    }) : []
  },
  unreadNotifications: function (notifications, type) {
    return notifications ? notifications.filter(function (notification) {
      return notification.read_at === null
    }) : []
  }
}

export default {
  name: 'NotificationsList',
  components: {
    'notifications-delete-multiple': NotificationsDeleteMultiple,
    'user-avatar': UserAvatar,
    'json-dialog-component': JsonDialogComponent,
    'notifications-filter-by-type': NotificationsFilterByType,
    'notifications-filter-by-notifiable-type': NotificationsFilterByNotifiableType,
    'notifications-filter-by-notifiable': NotificationsFilterByNotifiable,
    'notifications-filters': NotificationsFilters
  },
  data () {
    return {
      selected: [],
      selectedType: null,
      selectedNotifiableType: null,
      selectedNotifiable: null,
      selectedFilters: [],
      search: '',
      internalNotifications: this.notifications,
      refreshing: false,
      headers: [
        { text: 'Uuid', align: 'left', value: 'id' },
        { text: 'Type', value: 'type' },
        { text: 'Notificat a', value: 'notifiable_id' },
        { text: 'Tipus Notificat', value: 'notifiable_type' },
        { text: 'Dades', value: 'data' },
        { text: 'Llegida', value: 'read_at_timestamp' },
        { text: 'Data creació', value: 'created_at_timestamp' },
        { text: 'Data actualització', value: 'updated_at_timestamp' }
      ]
    }
  },
  props: {
    notifications: {
      type: Array,
      required: true
    },
    forceRefresh: {}
  },
  watch: {
    forceRefresh (forceRefresh) {
      if (forceRefresh) {
        this.refresh()
        this.$emit('refreshed')
      }
    }
  },
  computed: {
    filteredNotifications: function () {
      let filteredNotifications = this.internalNotifications
      if (this.selectedType) filteredNotifications = filters['byType'](this.internalNotifications, this.selectedType)
      if (this.selectedNotifiableType) filteredNotifications = filters['byNotifiableType'](this.internalNotifications, this.selectedNotifiableType)
      if (this.selectedNotifiable) filteredNotifications = filters['byNotifiable'](this.internalNotifications, this.selectedNotifiable)
      if (this.selectedFilters.length > 0) {
        this.selectedFilters.forEach(filter => {
          filteredNotifications = filters[filter.function](this.internalNotifications)
        })
      }
      return filteredNotifications
    },
    notificationTypes () {
      const notificationTypes = this.internalNotifications ? this.internalNotifications.map(notification => {
        return notification.type
      }) : []
      return [ ...new Set(notificationTypes) ]
    },
    notificationNotifiableTypes () {
      const notificationNotifiableTypes = this.internalNotifications ? this.internalNotifications.map(notification => {
        return notification.notifiable_type
      }) : []
      return [ ...new Set(notificationNotifiableTypes) ]
    },
    notificationNotifiables () {
      let notificationNotifiables = this.internalNotifications ? this.internalNotifications.map(notification => {
        if (notification.notifiable_type === 'App\\Models\\User') return notification.notifiable
      }) : []
      notificationNotifiables = notificationNotifiables.filter(x => x !== undefined)
      return this.removeDuplicates(notificationNotifiables, 'id')
    }
  },
  methods: {
    removeDuplicates (myArr, prop) {
      return myArr.filter((obj, pos, arr) => {
        return arr.map(mapObj => mapObj[prop]).indexOf(obj[prop]) === pos
      })
    },
    formatBoolean (boolean) {
      return boolean ? 'Sí' : 'No'
    },
    refresh () {
      this.refreshing = true
      window.axios.get('/api/v1/notifications').then((response) => {
        this.refreshing = false
        this.internalNotifications = response.data
        this.$snackbar.showMessage('Notificacions actualitzades correctament')
      }).catch(error => {
        this.refreshing = false
        this.$snackbar.showError(error)
      })
    },
    settings () {
      console.log('settings TODO') // TODO
    }
  },
  created () {
    this.filterNames = filterNames
  }
}
</script>
