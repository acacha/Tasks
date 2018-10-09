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

      // AJAX -> Asynchonous Javascript i  XML
      // XHR ->  XML/JSON HTTP Request Asíncrones
      // this.tasks =

      // JAVASCRIPT NO BLOQUEJA

      // let result = axios.get('http://localhost:8050/api/v1/tasks')
      //  console.log(result);

      // 3 ASYNC WAIT
      // async function () {
      //     let result = await axios.get('http://localhost:8050/api/v1/tasks')


      // 3 opcions
      // 1) API per defecte de javascript: https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest
      // 2) Jquery --> Ajax/XHR
      // 3) Llibreria específica -> Axios

      // 3 opcions
      // 1) CALLBACKS -> Funcions anònimes
      // let file = fileManager.open('/home/sergi/.bashrc')
      // console.log(file);
      // fileManager.open('/home/sergi/.bashrc', (file) => {
      //     console.log(file);
      // })
      // console.log('1');

      // 2 PROMISES then.catch
  }
}
</script>

<style>

</style>
