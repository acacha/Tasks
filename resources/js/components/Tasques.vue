<template>
    <span>
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
            <v-btn icon class="white--text" @click="refresh">
                <v-icon>refresh</v-icon>
            </v-btn>
        </v-toolbar>
        <v-card>
            <v-card-title>
                TODO FILTERS EL BUSCADOR ETC
            </v-card-title>
            <v-data-table
                    :headers="headers"
                    :items="dataTasks"
            >
                <template slot="items" slot-scope="{item: task}">
                    <tr>
                        <td>{{ task.id }}</td>
                        <td v-text="task.name"></td>
                        <td v-text="task.user_id"></td>
                        <td v-text="task.completed"></td>
                        <td v-text="task.created_at"></td>
                        <td v-text="task.updated_at"></td>
                        <td>
                            <v-btn icon color="primary" flat title="Mostrar la tasca"
                                   @click="show(task)">
                                <v-icon>delete</v-icon>
                            </v-btn>
                            <v-btn icon color="success" flat title="Canviar la tasca"
                                   @click="update(task)">
                                <v-icon>delete</v-icon>
                            </v-btn>
                            <v-btn icon color="error" flat title="Eliminar la tasca"
                                    @click="destroy(task)">
                                <v-icon>delete</v-icon>
                            </v-btn>
                        </td>
                    </tr>
                </template>
            </v-data-table>
        </v-card>
        <v-btn
            @click="showCreateDialog"
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
      dataTasks: [
        {
          id: 1,
          name: 'Comprar pa',
          completed: false,
          user_id: 1,
          created_at: 'fa 1 minut',
          updated_at: 'fa 1 minut'
        },
        {
          id: 2,
          name: 'Comprar llet',
          completed: false,
          user_id: 1,
          created_at: 'fa 1 minut',
          updated_at: 'fa 1 minut'
        },
        {
          id: 3,
          name: 'Estudiar PHP',
          completed: true,
          user_id: 2,
          created_at: 'fa 1 minut',
          updated_at: 'fa 1 minut'
        }
      ],
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
  methods: {
    opcio1 () {
      console.log('OPCIO 1 REFRESH')
    },
    destroy (task) {
      console.log('TODO DELETE TASK ' + task.id)
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
      console.log('TODO REFRESH')
    },
    showCreateDialog () {
      console.log('TODO SHOW DIALOG TO CREATE TASK')
    }
  }
}
</script>
