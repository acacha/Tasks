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

        <user-select v-model="user_id" :users="dataUsers" label="asdasdas"></user-select>

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
      user_id: null
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
    reset () {
      this.name = ''
      this.description = ''
      this.completed = ''
      this.user_id = null
    },
    add () {
      this.loading = true
      const task = {
        'name': this.name,
        'description': this.description,
        'completed': this.completed,
        'user_id': this.user_id
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
  }
}
</script>
