<template>
    <v-switch
            v-model="dataValue"
            :label="dataValue ? activeText : unactiveText"
            :loading="loading"
    ></v-switch>
</template>

<script>
export default {
  name: 'toggle',
  data () {
    return {
      dataValue: this.value,
      loading: false
    }
  },
  props: {
    activeText: {
      type: String,
      default: 'Active'
    },
    unactiveText: {
      type: String,
      default: 'Unactive'
    },
    uri: {
      type: String,
      required: true
    },
    value: {
      type: Boolean,
      required: true
    },
    resource: {
      type: Object,
      required: true
    }
  },
  watch: {
    dataValue (dataValue, oldDataValue) {
      if (dataValue !== oldDataValue) {
        if (dataValue) this.completeTask()
        else this.uncompleteTask()
      }
    }
  },
  methods: {
    completeTask () {
      this.loading = true
      window.axios.post(this.uri + '/' + this.resource.id).then(() => {
        this.loading = false
      }).catch(error => {
        this.loading = false
        this.$snackbar.showError(error)
      })
    },
    uncompleteTask () {
      this.loading = true
      window.axios.delete(this.uri + '/' + this.resource.id).then(() => {
        this.loading = false
      }).catch(error => {
        this.loading = false
        this.$snackbar.showError(error)
      })
    }
  }
}
</script>
