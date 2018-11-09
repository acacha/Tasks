<template>
    <span>
        <v-dialog v-model="deleteDialog">
            <v-card>
                <v-card-title class="headline">Esteu segurs?</v-card-title>

                <v-card-text>
                    Aquesta operació no es pot desfer.
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                      <v-btn
                              color="green darken-1"
                              flat="flat"
                              @click="deleteDialog = false"
                      >
                        Cancel·lar
                      </v-btn>

                      <v-btn
                              color="error darken-1"
                              flat="flat"
                              @click="destroy"
                      >
                        Confirmar
                      </v-btn>
        </v-card-actions>
        </v-card>
        </v-dialog>
        <v-dialog v-model="createDialog" fullscreen hide-overlay transition="dialog-bottom-transition">
            <v-card>
                PROVA
            </v-card>
        </v-dialog>

        <v-snackbar :timeout="3000" color="success" v-model="snackbar">
            Això és un snackbar
            <v-btn dark flat @click="snackbar=false">Tancar</v-btn>
        </v-snackbar>
        <v-toolbar color="blue darken-3">
            <v-menu>
                <v-btn slot="activator" icon dark>
                    <v-icon>more_vert</v-icon>
                </v-btn>
                <v-list>
                    <v-list-tile @click="opcio1">
                        <v-list-tile-title>Opció 1</v-list-tile-title>
                    </v-list-tile>
                    <v-list-tile href="http://google.com">
                        <v-list-tile-title>Google</v-list-tile-title>
                    </v-list-tile>
                </v-list>
            </v-menu>
            <v-toolbar-title class="white--text">Tasques</v-toolbar-title>
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
                                v-model="filter">
                        </v-select>
                    </v-flex>
                    <v-flex lg4 class="mr-2">
                        <v-select
                                label="User"
                                :items="users"
                                v-model="user"
                                clearable>
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
                    :items="dataTasks"
                    :search="search"
                    no-results-text="No s'ha trobat cap registre coincident"
                    no-data-text="No hi han dades disponibles"
                    rows-per-page-text="Tasques per pàgina"
                    :rows-per-page-items="[5,10,25,50,100,200,{'text':'Tots','value':-1}]"
                    :loading="loading"
                    :pagination.sync="pagination"
            >
                <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
                <template slot="items" slot-scope="{item: task}">
                    <tr>
                        <td>{{ task.id }}</td>
                        <td v-text="task.name"></td>
                        <td v-text="task.user_id"></td>
                        <td v-text="task.completed"></td>
                        <td v-text="task.created_at"></td>
                        <td v-text="task.updated_at"></td>
                        <td>
                            <v-btn icon color="primary" flat title="Mostrar snackbar"
                                   @click="snackbar=true">
                                <v-icon>delete</v-icon>
                            </v-btn>
                            <v-btn icon color="primary" flat title="Mostrar la tasca"
                                   @click="show(task)">
                                <v-icon>delete</v-icon>
                            </v-btn>
                            <v-btn icon color="success" flat title="Canviar la tasca"
                                   @click="update(task)">
                                <v-icon>delete</v-icon>
                            </v-btn>
                            <v-btn icon color="error" flat title="Eliminar la tasca"
                                    @click="showDestroy(task)">
                                <v-icon>delete</v-icon>
                            </v-btn>
                        </td>
                    </tr>
                </template>
            </v-data-table>
        </v-card>
        <v-btn
            @click="showCreate"
            fab
            bottom
            right
            fixed
            color="pink"
            class="white--text"
        >
            <v-icon>add</v-icon>
        </v-btn>
    </span>
</template>

<script>
export default {
  name: 'Tasques',
  data () {
    return {
      deleteDialog: false,
      createDialog: false,
      snackbar: true,
      user: '',
      users: [
        'Sergi Tur',
        'Pepe Pardo',
        'Maria Delahoz'
      ],
      filter: 'Totes',
      filters: [
        'Totes',
        'Completades',
        'Pendents'
      ],
      search: '',
      pagination: {
        rowsPerPage: 25
      },
      loading: false,
      dataTasks: this.tasks,
      headers: [
        { text: 'Id', value: 'id' },
        { text: 'Name', value: 'name' },
        { text: 'User', value: 'user_id' },
        { text: 'Completat', value: 'completed' },
        { text: 'Creat', value: 'created_at' },
        { text: 'Modificat', value: 'updated_at' },
        { text: 'Accions', sortable: false }
      ]
    }
  },
  props: {
    tasks: {
      type: [],
      required: true
    }
  },
  methods: {
    opcio1 () {
      console.log('OPCIO 1 REFRESH')
    },
    showDestroy (task) {
      this.deleteDialog = true
    },
    destroy (task) {
      this.deleteDialog = false
      console.log('TODO DELETE TASK ' + task.id)
    },
    showCreate () {
      this.createDialog = true
    },
    create (task) {
      console.log('TODO CREATE TASK')
    },
    update (task) {
      console.log('TODO UPDATE TASK ' + task.id)
    },
    show (task) {
      console.log('TODO SHOW TASK ' + task.id)
    },
    refresh () {
      this.loading = true
      // setTimeout(() => { this.loading = false }, 5000)
      // OCO !! URL CANVIA SEGONS EL CAS!!! TODO
      // window.axios.get('/api/v1/tasks').then().catch()
      window.axios.get('/api/v1/user/tasks').then(response => {
        // SHOW SNACKBAR MISSATGE OK: 'Les tasques s'han actualitzat correctament
        this.dataTasks = response.data
        this.loading = false
      }).catch(error => {
        console.log(error)
        this.loading = false
        // SHOW SNACKBAR ERROR TODO
      })
    }
  }
}
</script>
