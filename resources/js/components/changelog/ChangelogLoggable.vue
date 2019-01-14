<template>
    <v-btn title="Registre de canvis" icon :href="'/changelog/loggable/' + loggable.api_uri + '/' + loggable.id" target="_blank">
        <v-icon>history</v-icon>
    </v-btn>
</template>

<script>
export default {
  props: {
    loggable: {
      type: Object,
      required: true
    }
  }
}
</script>
