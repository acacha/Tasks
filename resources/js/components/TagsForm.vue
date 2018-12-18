<template>
    <v-form>
        <v-text-field
                autofocus
                v-model="name"
                label="Nom"
                hint="El nom de l'etiqueta..."
                placeholder="Nom de l'etiqueta"
                :error-messages="nameErrors"
                @input="$v.name.$touch()"
                @blur="$v.name.$touch()"
        ></v-text-field>

        <v-text-field
                autofocus
                v-model="color"
                label="Nom"
                hint="El color de l'etiqueta..."
                placeholder="Color de l'etiqueta"
                :error-messages="colorErrors"
                @input="$v.color.$touch()"
                @blur="$v.color.$touch()"
        ></v-text-field>

        <v-textarea v-model="description" label="Descripció" hint="Escriu la descripció de l'etiqueta..."
                    :error-messages="descriptionErrors"
                    @input="$v.description.$touch()"
                    @blur="$v.description.$touch()"></v-textarea>

        <div class="text-xs-center">
            <v-btn @click="$emit('close')">
                <v-icon class="mr-1">exit_to_app</v-icon>
                Cancel·lar
            </v-btn>
            <v-btn color="success" @click="add" :disabled="loading || $v.$invalid" :loading="loading">
                <v-icon class="mr-1" >save</v-icon>
                Crear
            </v-btn>
        </div>
    </v-form>
</template>

<script>
import { validationMixin } from 'vuelidate'
import { required } from 'vuelidate/lib/validators'

export default {
  name: 'TagsForm',
  mixins: [validationMixin],
  validations: {
    name: { required },
    color: { required },
    description: { required }
  },
  data () {
    return {
      name: '',
      color: '',
      description: '',
      loading: false
    }
  },
  computed: {
    nameErrors () {
      const errors = []
      if (!this.$v.name.$dirty) return errors
      !this.$v.name.required && errors.push('El camp name és obligatori.')
      return errors
    },
    descriptionErrors () {
      const errors = []
      if (!this.$v.description.$dirty) return errors
      !this.$v.description.required && errors.push('El camp description és obligatori.')
      return errors
    },
    colorErrors () {
      const errors = []
      if (!this.$v.color.$dirty) return errors
      !this.$v.color.required && errors.push('El camp color és obligatori.')
      return errors
    }
  },
  methods: {
    reset () {
      this.name = ''
      this.description = ''
      this.color = ''
    },
    add () {
      this.loading = true
      const tag = {
        'name': this.name,
        'color': this.color,
        'description': this.description
      }
      window.axios.post('/api/v1/tags', tag).then(response => {
        this.$snackbar.showMessage('Etiqueta creada correctament')
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
