<template>
    <v-form>
        <v-text-field
                autofocus
                v-model="name"
                label="Nom"
                hint="El nom de la tasca..."
                placeholder="Nom de la tasca"
                :readony="true"
        ></v-text-field>

        <v-switch v-model="completed" :label="completed ? 'Completada' : 'Pendent'"></v-switch>

        <v-textarea
                v-model="description"
                label="Descripció"
                hint="Escriu la descripció de la tasca..."
                :readony="true"
        ></v-textarea>

        <!--// TODO USER AVATAR-->
    </v-form>
</template>

<script>
export default {
  data () {
    return {
      name: this.task.name,
      completed: this.task.completed,
      description: this.task.description
    }
  },
  props: {
    task: {
      type: Object,
      required: true
    }
  }
}
</script>
