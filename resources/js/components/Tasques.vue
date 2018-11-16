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
                              flat
                              @click="destroy"
                              :loading="removing"
                              :disabled="removing"
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
        <v-dialog v-model="editDialog" fullscreen hide-overlay transition="dialog-bottom-transition"
            @keydown.esc="editDialog=false">
            <v-toolbar color="blue darken-3" class="white--text">
                <v-btn flat icon class="white--text" @click="editDialog=false">
                    <v-icon class="mr-1">close</v-icon>
                </v-btn>
                <v-toolbar-title class="white--text">Editar Tasca</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn flat class="white--text" @click="editDialog=false">
                    <v-icon class="mr-1">exit_to_app</v-icon>
                    Sortir
                </v-btn>
                <v-btn flat class="white--text">
                    <v-icon class="mr-1">save</v-icon>
                    Guardar
                </v-btn>
            </v-toolbar>
            <v-card>
                <v-card-text>
                    <v-form>
                        <v-text-field v-model="name" label="Nom" hint="El nom de la tasca..." placeholder="Nom de la tasca"></v-text-field>
                        <v-switch v-model="completed" :label="completed ? 'Completada' : 'Pendent'"></v-switch>

                        <v-textarea v-model="description" label="Descripció" hint="bla bla bla..."></v-textarea>
                        <v-autocomplete :items="dataUsers" label="Usuari" item-text="name"></v-autocomplete>
                        <div class="text-xs-center">
                            <v-btn @click="editDialog=false">
                                <v-icon class="mr-1">exit_to_app</v-icon>
                                Cancel·lar
                            </v-btn>
                            <v-btn color="success">
                                <v-icon class="mr-1" >save</v-icon>
                                Guardar
                            </v-btn>
                        </div>
                    </v-form>
                </v-card-text>
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
                                v-model="filter"
                                item-text="name"
                        >
                        </v-select>
                    </v-flex>
                    <v-flex lg4 class="mr-2">
                        <v-select
                                label="User"
                                :items="dataUsers"
                                v-model="user"
                                item-text="name"
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
                    class="hidden-md-and-down"
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
                                <v-icon>info</v-icon>
                            </v-btn>
                            <v-btn icon color="primary" flat title="Mostrar la tasca"
                                   @click="show(task)">
                                <v-icon>visibility</v-icon>
                            </v-btn>
                            <v-btn icon color="success" flat title="Canviar la tasca"
                                   @click="showUpdate(task)">
                                <v-icon>edit</v-icon>
                            </v-btn>
                            <v-btn icon color="error" flat title="Eliminar la tasca"
                                    @click="showDestroy(task)">
                                <v-icon>delete</v-icon>
                            </v-btn>
                        </td>
                    </tr>
                </template>
            </v-data-table>
            <v-data-iterator class="hidden-lg-and-up"
                             :items="dataTasks"
                             :search="search"
                             no-results-text="No s'ha trobat cap registre coincident"
                             no-data-text="No hi han dades disponibles"
                             rows-per-page-text="Tasques per pàgina"
                             :rows-per-page-items="[5,10,25,50,100,200,{'text':'Tots','value':-1}]"
                             :loading="loading"
                             :pagination.sync="pagination"
            >
                <v-flex
                        slot="item"
                        slot-scope="{item:task}"
                        xs12
                        sm6
                        md4
                >
                    <v-card class="mb-1">
                        <v-card-title v-text="task.name"></v-card-title>
                        <v-list dense>
                            <v-list-tile>
                              <v-list-tile-content>Completed:</v-list-tile-content>
                              <v-list-tile-content class="align-end">{{ task.completed }}</v-list-tile-content>
                            </v-list-tile>
                            <v-list-tile>
                              <v-list-tile-content>User:</v-list-tile-content>
                              <v-list-tile-content class="align-end">{{ task.user_id }}</v-list-tile-content>
                            </v-list-tile>
                        </v-list>
                    </v-card>
                </v-flex>
            </v-data-iterator>
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
      dataUsers: this.users,
      completed: false,
      name: '',
      description: '',
      deleteDialog: false,
      createDialog: false,
      editDialog: false,
      taskBeingRemoved: null,
      snackbar: true,
      user: '',
      usersold: [
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
      creating: false,
      editing: false,
      removing: false,
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
      type: Array,
      required: true
    },
    users: {
      type: Array,
      required: true
    }
  },
  methods: {
    showUpdate () {
      this.editDialog = true
    },
    opcio1 () {
      console.log('OPCIO 1 REFRESH')
    },
    showDestroy (task) {
      this.deleteDialog = true
      this.taskBeingRemoved = task
    },
    removeTask (task) {
      this.dataTasks.splice(this.dataTasks.indexOf(task), 1)
    },
    destroy () {
      this.removing = true
      window.axios.delete('/api/v1/user/tasks/' + this.taskBeingRemoved.id).then(() => {
        // this.refresh() // Problema -> rendiment
        this.removeTask(this.taskBeingRemoved)
        this.deleteDialog = false
        this.taskBeingRemoved = null
        // TODO showSnackbar
        this.removing = false
      }).catch(error => {
        console.log(error)
        // TODO showSnackbar
        this.removing = false
      })
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
      // USERS TASKS O TOTES LES TASQUES?
      window.axios.get('/api/v1/user/tasks').then(response => {
        console.log(response.data)
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
