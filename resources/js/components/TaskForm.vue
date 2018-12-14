<template>
    <v-form>
        <v-text-field
                autofocus
                v-model="name"
                label="Nom"
                hint="El nom de la tasca..."
                placeholder="Nom de la tasca"
                :error-messages="nameErrors"
                @input="$v.name.$touch()"
                @blur="$v.name.$touch()"
        ></v-text-field>

        <v-switch v-model="completed" :label="completed ? 'Completada' : 'Pendent'"></v-switch>

        <v-textarea v-model="description" label="Descripció" hint="Escriu la descripció de la tasca..."></v-textarea>

        <user-select :item-value="null" v-model="user" :users="dataUsers" label="Usuari"></user-select>

        <!--<user-select v-model="variable"></user-select>-->

        <!--<user-select :value="variable" @input="this.variable = $event.target.value"></user-select>-->
        <!--<user-select v-bind:value="variable" v-on:input=""></user-select>-->


        <!--v-model equivalent for <user-select v-model="user_id" ..> -->
        <!--<user-select-->
                <!--v-bind:value="user_id"-->
                <!--v-on:input="user_id = $event.target.value"-->
        <!--&gt;-->
        <div class="text-xs-center">
            <v-btn @click="$emit('close')">
                <v-icon class="mr-1">exit_to_app</v-icon>
                Cancel·lar
            </v-btn>
            <v-btn color="success" @click="add" :disabled="loading || $v.$invalid" :loading="loading">
                <v-icon class="mr-1" >save</v-icon>
                Afegir
            </v-btn>
        </div>
    </v-form>
</template>

<script>
import { validationMixin } from 'vuelidate'
import { required } from 'vuelidate/lib/validators'
import UserSelect from './UserSelect'

export default {
  name: 'TaskForm',
  mixins: [validationMixin],
  validations: {
    name: { required }
  },
  components: {
    'user-select': UserSelect
  },
  data () {
    return {
      name: '',
      completed: false,
      description: '',
      dataUsers: this.users,
      loading: false,
      user: null
    }
  },
  props: {
    users: {
      type: Array,
      required: true
    },
    uri: {
      type: String,
      default: '/api/v1/tasks'
    }
  },
  computed: {
    nameErrors () {
      const errors = []
      if (!this.$v.name.$dirty) return errors
      !this.$v.name.required && errors.push('El camp name és obligatori.')
      return errors
    }
  },
  methods: {
    selectLoggedUser () {
      if (window.laravel_user) {
        this.user = this.users.find((user) => {
          return parseInt(user.id) === parseInt(window.laravel_user.id)
        })
      }
    },
    reset () {
      this.name = ''
      this.description = ''
      this.completed = false
      this.user = null
    },
    add () {
      this.loading = true
      const task = {
        'name': this.name,
        'description': this.description,
        'completed': this.completed,
        'user_id': this.user.id
      }
      window.axios.post(this.uri, task).then(response => {
        this.$snackbar.showMessage('Tasca creada correctament')
        this.reset()
        this.$emit('created', response.data)
        this.loading = false
        this.$emit('close')
      }).catch(error => {
        this.$snackbar.showError(error.data)
        this.loading = false
      })
    }
  },
  created () {
    this.selectLoggedUser()
  }
}
</script>
