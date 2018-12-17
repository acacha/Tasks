<template>

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
