<template>
    <v-form action="/login" method="POST">
        <v-toolbar dark color="primary">
            <v-toolbar-title>Login form</v-toolbar-title>
        </v-toolbar>
        <v-card-text>
            <input type="hidden" name="_token" :value="csrfToken">
            <v-text-field
                    prepend-icon="person"
                    name="email"
                    label="Login"
                    type="text"
                    v-model="dataEmail"
                    :error-messages="emailErrors"
                    @input="$v.email.$touch()"
                    @blur="$v.email.$touch()"
            ></v-text-field>
            <v-text-field id="password"
                          prepend-icon="lock"
                          name="password"
                          label="Password"
                          type="password"
                          v-model="password"
                          :error-messages="passwordErrors"
                          @input="$v.password.$touch()"
                          @blur="$v.password.$touch()"
            ></v-text-field>
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" type="submit">Login</v-btn>
        </v-card-actions>
    </v-form>
</template>

<script>
// import vuelidate from 'vuelidate'
// validationMixin = vuelidate.validationMixin
import { validationMixin } from 'vuelidate'
import { required, email, minLength } from 'vuelidate/lib/validators'

export default {
  name: 'LoginForm',
  mixins: [validationMixin],
  validations: {
    email: { required, email },
    password: { required, minLength: minLength(6) }
  },
  data () {
    return {
      dataEmail: this.email,
      password: ''
    }
  },
  props: [ 'email', 'csrfToken' ],
  computed: {
    emailErrors () {
      const errors = []
      if (!this.$v.email.$dirty) return errors
      !this.$v.email.email && errors.push('El camp email ha de ser un email vàlid.')
      !this.$v.email.required && errors.push('El camp email és obligatori.')
      return errors
    },
    passwordErrors () {
      const errors = []
      if (!this.$v.password.$dirty) return errors
      !this.$v.email.minLength && errors.push('El camp password ha de tenir una mida mínima de 6 caràcters.')
      !this.$v.password.required && errors.push('El camp password és obligatori.')
      return errors
    }
  }
}
</script>
