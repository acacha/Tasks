<template>
  <div id="app">
    <tasks></tasks>
  </div>
</template>

<script>
import Tasks from './components/Tasks.vue'
import EditableText from './components/EditableText'

export default {
  name: 'app',
  components: {
      'tasks' : Tasks,
      'editable-text': EditableText
  }
}
</script>

<style>

</style>
