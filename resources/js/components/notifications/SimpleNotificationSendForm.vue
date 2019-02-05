<template>
    <v-form
            ref="form"
    >
        <v-text-field
                v-model="title"
                :counter="140"
                label="Text curt de la notificació"
                required
                :error-messages="titleErrors"
                @input="$v.title.$touch()"
                @blur="$v.title.$touch()"
        ></v-text-field>
        <user-select
                label="A qui voleu enviar la notificació?"
                :users="users"
                v-model="user"
                :error-messages="userErrors"
                @input="$v.user.$touch()"
                @blur="$v.user.$touch()"
        ></user-select>
        <v-btn color="primary" flat :loading="sending" :disabled="sending || $v.$invalid" @click="send()"><v-icon class="mr-2">email</v-icon>Enviar</v-btn>
    </v-form>
</template>

<script>
import UserSelect from '../users/UsersSelectComponent'
import { validationMixin } from 'vuelidate'
import { required, maxLength } from 'vuelidate/lib/validators'

export default {
  name: 'SimpleNotificationForm',
  components: {
    'user-select': UserSelect
  },
  mixins: [ validationMixin ],
  validations: {
    title: { required, maxLength: maxLength(140) },
    user: { required }
  },
  data () {
    return {
      title: '',
      sending: false,
      user: null
    }
  },
  props: {
    users: {
      type: Array,
      required: true
    }
  },
  computed: {
    titleErrors () {
      const titleErrors = []
      if (!this.$v.title.$dirty) return titleErrors
      !this.$v.title.required && titleErrors.push('El títol és obligatori.')
      return titleErrors
    },
    userErrors () {
      const userErrors = []
      if (!this.$v.user.$dirty) return userErrors
      !this.$v.user.required && userErrors.push("L'usuari és obligatori.")
      return userErrors
    }
  },
  methods: {
    send () {
      this.sending = true
      window.axios.post('/api/v1/simple_notifications', {
        'user': this.user,
        'title': this.title
      }).then(() => {
        this.sending = false
        this.$snackbar.showMessage('Notificació enviada correctament')
        this.$emit('sent')
      }).catch(error => {
        this.sending = false
        this.$snackbar.showError(error)
      })
    }
  }
}
</script>
