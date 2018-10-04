<template>
  <div id="app">
    <tasks></tasks>
  </div>
</template>

<script>
import Tasks from './components/Tasks.vue'

export default {
  name: 'app',
  components: {
      'tasks' : Tasks
  }
}
</script>

<style>

</style>
