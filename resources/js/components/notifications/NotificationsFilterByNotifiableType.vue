<template>
    <v-autocomplete
            name="notificationNotifiableTypes"
            label="Filtrar per tipus de notificat"
            :items="dataTypes"
            v-model="dataType"
            clearable
            @input="input"
            @blur="blur"
            chips
    ></v-autocomplete>
</template>

<script>
export default {
  name: 'NotificationsFilterByNotifiableType',
  data () {
    return {
      dataTypes: this.types,
      dataType: this.type
    }
  },
  model: {
    prop: 'type',
    event: 'input'
  },
  props: {
    types: {
      type: Array,
      required: true
    },
    type: {}
  },
  watch: {
    type (type) {
      this.dataType = type
    }
  },
  methods: {
    input () {
      this.$emit('input', this.dataType)
    },
    blur () {
      this.$emit('blur', this.dataType)
    }
  }
}
</script>
