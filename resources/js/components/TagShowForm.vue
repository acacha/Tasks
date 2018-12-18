<template>
    <v-form>
        <v-text-field
                autofocus
                v-model="name"
                label="Nom"
                hint="El nom de l'etiqueta..."
                placeholder="Nom de l'etiqueta"
                :readonly="true"
        ></v-text-field>

        <v-text-field
                autofocus
                v-model="color"
                label="Color"
                hint="El color de l'etiqueta..."
                placeholder="Color de l'etiqueta"
                :readonly="true"
        ></v-text-field>

        <v-textarea
                v-model="description"
                label="Descripció"
                hint="Escriu la descripció de l'etiqueta..."
                :readonly="true"
        ></v-textarea>
            </v-form>
</template>

<script>
export default {
  data () {
    return {
      name: this.tag.name,
      color: this.tag.color,
      description: this.tag.description
    }
  },
  props: {
    tag: {
      type: Object,
      required: true
    }
  }
}
</script>
