<template>
    <span>
        <v-toolbar color="blue darken-3">
            <v-menu>
                <v-btn slot="activator" icon dark>
                    <v-icon>more_vert</v-icon>
                </v-btn>
                <v-list>
                    <v-list-tile>
                        <v-list-tile-title>Opció 1</v-list-tile-title>
                    </v-list-tile>
                    <v-list-tile href="http://google.com">
                        <v-list-tile-title>Google</v-list-tile-title>
                    </v-list-tile>
                </v-list>
            </v-menu>
            <v-toolbar-title class="white--text">Etiquetes</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn icon class="white--text">
                <v-icon>settings</v-icon>
            </v-btn>
            <v-btn icon class="white--text" @click="refresh" :loading="loading" :disabled="loading">
                <v-icon>refresh</v-icon>
            </v-btn>
        </v-toolbar>
        <v-card>
            <v-card-title>
                <v-layout row wrap>
                    <v-flex lg3 class="mr-2">
                        <v-select
                                label="Filtres"
                                :items="filters"
                                v-model="filter"
                                item-text="name"
                        >
                        </v-select>
                    </v-flex>
                    <v-flex lg5>
                        <v-text-field
                                append-icon="search"
                                label="Buscar"
                                v-model="search"
                        ></v-text-field>
                    </v-flex>
                </v-layout>
            </v-card-title>
            <v-data-table
                    :headers="headers"
                    :items="dataTags"
                    :search="search"
                    no-results-text="No s'ha trobat cap registre coincident"
                    no-data-text="No hi han dades disponibles"
                    rows-per-page-text="Etiquetes per pàgina"
                    :rows-per-page-items="[5,10,25,50,100,200,{'text':'Tots','value':-1}]"
                    :loading="loading"
                    :pagination.sync="pagination"
                    class="hidden-md-and-down"
            >
                <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
                <template slot="items" slot-scope="{item: tag}">
                    <tr>
                        <td>{{ tag.id }}</td>
                        <td>
                            <span :title="tag.description">{{ tag.name }}</span>
                        </td>
                        <td v-text="tag.color">
                        </td>
                        <td>
                            <span :title="tag.created_at_formatted">{{ tag.created_at_human}}</span>
                        </td>
                        <td>
                            <span :title="tag.updated_at_formatted">{{ tag.updated_at_human}}</span>
                        </td>
                        <td>
                            <tag-show :tag="tag"></tag-show>
                            <tag-update :tag="tag" @updated="updateTag"></tag-update>
                            <tag-destroy :tag="tag" @removed="removeTag"></tag-destroy>
                        </td>
                    </tr>
                </template>
            </v-data-table>
            <v-data-iterator class="hidden-lg-and-up"
                             :items="dataTags"
                             :search="search"
                             no-results-text="No s'ha trobat cap registre coincident"
                             no-data-text="No hi han dades disponibles"
                             rows-per-page-text="Etiquetes per pàgina"
                             :rows-per-page-items="[5,10,25,50,100,200,{'text':'Tots','value':-1}]"
                             :loading="loading"
                             :pagination.sync="pagination"
            >
                <v-flex
                        slot="item"
                        slot-scope="{item:tag}"
                        xs12
                        sm6
                        md4
                >
                    <v-card class="mb-1">
                        <v-card-title v-text="tag.name"></v-card-title>
                        <v-list dense>
                            <v-list-tile>
                                <v-list-tile-content>Completed:</v-list-tile-content>
                                <v-list-tile-content class="align-end">{{ tag.completed }}</v-list-tile-content>
                            </v-list-tile>
                            <v-list-tile>
                                <v-list-tile-content>User:</v-list-tile-content>
                                <v-list-tile-content class="align-end">{{ tag.user_id }}</v-list-tile-content>
                            </v-list-tile>
                        </v-list>
                    </v-card>
                </v-flex>
            </v-data-iterator>
        </v-card>
    </span>
</template>

<script>
import TagDestroy from './TagDestroy'
import TagUpdate from './TagUpdate'
import TagShow from './TagShow'

export default {
  name: 'TagsList',
  data () {
    return {
      user: '',
      loading: false,
      dataTags: this.tags,
      filter: 'Totes',
      filters: [
        'Totes'
      ],
      search: '',
      pagination: {
        rowsPerPage: 25
      },
      headers: [
        { text: 'Id', value: 'id' },
        { text: 'Name', value: 'name' },
        { text: 'Color', value: 'color' },
        { text: 'Creat', value: 'created_at_timestamp' },
        { text: 'Modificat', value: 'updated_at_timestamp' },
        { text: 'Accions', sortable: false, value: 'full_search' }
      ]
    }
  },
  components: {
    'tag-destroy': TagDestroy,
    'tag-update': TagUpdate,
    'tag-show': TagShow
  },
  props: {
    tags: {
      type: Array,
      required: true
    }
  },
  watch: {
    tags (newTags) {
      this.dataTags = newTags
    }
  },
  methods: {
    updateTag (tag) {
      this.refresh()
    },
    removeTag (tag) {
      this.dataTags.splice(this.dataTags.indexOf(tag), 1)
    },
    refresh () {
      this.loading = true
      window.axios.get('/api/v1/tags').then(response => {
        this.dataTags = response.data
        this.loading = false
        this.$snackbar.showMessage('Etiquetes actualitzades correctament')
      }).catch(error => {
        this.loading = false
        this.$snackbar.showError(error)
      })
    }
  }
}
</script>
