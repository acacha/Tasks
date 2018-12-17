<template>
    <span>
        <v-dialog
                v-model="dialog"
                width="500"
        >
          <v-card>
            <v-card-title
                    class="headline grey lighten-2"
                    primary-title
            >
              Informació versió de l'aplicació
            </v-card-title>

            <v-card-text>
                <ul>
                    <li>Branca: {{ dataGit.branch }}</li>
                    <li>Commit: {{ dataGit.commit }}</li>
                    <li>Commit_short: {{ dataGit.commit_short }}</li>
                    <li>Autor: {{ dataGit.author_name }}</li>
                    <li>Email: {{ dataGit.author_email }}</li>
                    <li>Missatge: {{ dataGit.message }}</li>
                    <li>Data: {{ dataGit.date_human }} | {{ dataGit.date_formatted }}</li>
                    <li>Origin: {{ dataGit.origin }}</li>
                    <li>Projecte Github: <a :href="githubURL()" target="_blank">{{ githubUri() }}</a></li>
                    <li>Commits Github: <a :href="githubURLIssues()" target="_blank">{{ githubUri() }}</a></li>
                </ul>
            </v-card-text>

            <v-divider></v-divider>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn icon small title="Actualitzeu les dades/flush de la cache" @click="refresh"><v-icon>refresh</v-icon></v-btn>
              <v-btn
                      color="primary"
                      flat
                      @click="dialog = false"
              >
                Tancar
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        Versió: <a href="#" click="dialog=true" class="white--text" @click="dialog = true">{{ dataGit.commit_short }}</a>
    </span>
</template>

<script>
export default {
  name: 'GitInfoComponent',
  data () {
    return {
      dialog: false,
      dataGit: this.git
    }
  },
  props: {
    git: {
      type: Object,
      required: false
    }
  },
  methods: {
    githubUri () {
      return this.dataGit.origin.split(':')[1].split('.')[0]
    },
    githubURL () {
      return 'https://github.com/' + this.githubUri()
    },
    githubURLIssues () {
      return this.githubURL() + '/commits/master'
    },
    refresh () {
      window.axios.get('/api/v1/git/info').then(response => {
        this.$snackbar.showMessage('Dades actualitzades correctament')
        this.dataGit = response.data
      }).catch(error => {
        this.$snackbar.showError(error)
      })
    }
  },
  created () {
    if (!this.git) this.dataGit = window.git
  }
}
</script>
