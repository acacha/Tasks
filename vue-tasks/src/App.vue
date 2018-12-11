<template>
  <div id="app">
    <!-- API
        JSON APIS/ REST APIS

        // BACKEND/LARAVEL/PHP que em proporcioni la llista de tasques

        http:://myservidor.com/tasks

        API REST O JSON NO TORNEN HTML -> Tornen Objectes Javascript en format JSON

       JSON
     -->
    <tasks :tasks="tasks"></tasks>
  </div>
</template>

<script>
import Tasks from './components/Tasks.vue'
import axios from 'axios'

export default {
  name: 'app',
  data () {
      return {
        tasks : [],
        error: null
      }
  },
  components: {
      'tasks' : Tasks,
  },
  created() {
    axios.get('http://127.0.0.1:8050/api/v1/tasks').then((response) => {
      this.tasks = response.data
    }).catch((error) => {
      this.error = error
    })
  }
}
</script>

<style>

</style>
