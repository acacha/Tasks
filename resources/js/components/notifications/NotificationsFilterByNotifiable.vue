<template>
    <user-select
            name="notifiable"
            label="Filtrar per usuari notificat"
            :users="dataNotifiables"
            v-model="dataNotifiable"
            @input="input"
            @blur="blur"
    ></user-select>
</template>

<script>
import UserSelect from '../users/UsersSelectComponent.vue'

export default {
  name: 'NotificationsFilterByNotifiable',
  components: {
    'user-select': UserSelect
  },
  data () {
    return {
      dataNotifiables: this.notifiables,
      dataNotifiable: this.notifiable
    }
  },
  model: {
    prop: 'notifiable',
    event: 'input'
  },
  props: {
    notifiables: {
      notifiable: Array,
      required: true
    },
    notifiable: {}
  },
  watch: {
    notifiable (notifiable) {
      this.dataNotifiable = notifiable
    }
  },
  methods: {
    input () {
      this.$emit('input', this.dataNotifiable)
    },
    blur () {
      this.$emit('blur', this.dataNotifiable)
    }
  }
}
</script>
