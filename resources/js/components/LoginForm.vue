<template>
    <v-form action="/login" method="POST">
        <v-toolbar dark color="primary">
            <v-toolbar-title>Login form</v-toolbar-title>
        </v-toolbar>
        <v-card-text>
            <input type="hidden" name="_token" :value="csrfToken">
            <v-text-field prepend-icon="person" name="email" label="Login" type="text" v-model="dataEmail"></v-text-field>
            <v-text-field id="password" prepend-icon="lock" name="password" label="Password" type="password" v-model="password"></v-text-field>
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" type="submit">Login</v-btn>
        </v-card-actions>
    </v-form>
</template>

<script>

export default {
  name: 'LoginForm',
  data () {
    return {
      dataEmail: this.email,
      password: ''
    }
  },
  props: [ 'email', 'csrfToken' ]
}
</script>
