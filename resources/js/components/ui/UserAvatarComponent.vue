<template>
    <span>
        <v-avatar color="grey lighten-4" :size="size" v-if="hashId" :tile="tile" @click="change" @dblclick="$emit('dblclick')">
            <img ref="previewImage"
                 :src="'/user/' + hashId + '/photo'"
                 :alt="alt"
                 :title="alt">
            <form class="upload" v-if="editable">
                <input
                        ref="file"
                        type="file"
                        name="photo"
                        accept="image/*"
                        :disabled="uploading"
                        @change="photoChange"/>
            </form>
        </v-avatar>
        <confirm-icon v-if="removable && user.photo"
                      icon="delete"
                      color="pink"
                      :working="deleting"
                      @confirmed="remove()"
                      tooltip="Eliminar foto"
                      message="Segur que voleu esborrar la foto de l'usuari?"
        ></confirm-icon>
    </span>
</template>

<script>
import axios from 'axios'
import ConfirmIconComponent from './ConfirmIconComponent'

export default {
  name: 'UserAvatarComponent',
  components: {
    'confirm-icon': ConfirmIconComponent
  },
  data () {
    return {
      uploading: false,
      deleting: false,
      path: ''
    }
  },
  props: {
    editable: {
      type: Boolean,
      default: false
    },
    removable: {
      type: Boolean,
      default: false
    },
    user: {
      type: Object,
      default: () => { return {} }
    },
    hashId: {
      required: true
    },
    size: {
      type: String,
      default: '40'
    },
    alt: {
      required: true
    },
    tile: {
      type: Boolean,
      default: false
    }
  },
  methods: {
    photoChange (event) {
      this.uploading = true
      let target = event.target || event.srcElement
      if (target.value.length !== 0) {
        const formData = new FormData()
        formData.append('photo', this.$refs.file.files[0])
        this.preview()
        this.save(formData)
      }
    },
    save (formData) {
      axios.post('/api/v1/user/' + this.user.id + '/photo', formData)
        .then(response => {
          this.uploading = false
          this.path = response.data
          this.$emit('input', this.path)
        })
        .catch(error => {
          this.uploading = false
          this.showError(error)
        })
    },
    preview () {
      if (this.$refs.file.files && this.$refs.file.files[0]) {
        let reader = new FileReader()
        reader.onload = e => {
          this.$refs.previewImage.setAttribute('src', e.target.result)
        }
        reader.readAsDataURL(this.$refs.file.files[0])
      }
    },
    change () {
      if (this.editable) this.$refs.file.click()
      this.$emit('click')
    },
    remove () {
      this.deleting = true
      axios.delete('/api/v1/user/' + this.user.id + '/photo')
        .then(response => {
          this.deleting = false
          this.path = ''
          this.$emit('input', this.path)
          this.$refs.previewImage.setAttribute('src', 'img/default.png')
          this.user.photo = null
        })
        .catch(error => {
          this.deleting = false
          this.showError(error)
        })
    }
  }
}
</script>

<style scoped>
    .upload > input
    {
        display: none;
    }
</style>
