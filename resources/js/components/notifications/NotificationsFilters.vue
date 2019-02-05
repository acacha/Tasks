<template>
    <v-autocomplete
            v-model="dataSelectedFilters"
            :items="filters"
            attach
            label="Altres filtres"
            multiple
            return-object
            item-text="name"
            @input="input"
            @blur="blur"
            chips
    >
        <template slot="selection" slot-scope="data">{{ data.item.name }}, </template>
        <template slot="item" slot-scope="data">
            <v-checkbox v-model="data.tile.props.value"></v-checkbox>
            {{ data.item.name }}
        </template>
    </v-autocomplete>
</template>

<script>
export default {
  name: 'NotificationFilters',
  data () {
    return {
      dataSelectedFilters: this.selectedFilters
    }
  },
  model: {
    prop: 'selectedFilters',
    event: 'input'
  },
  props: {
    selectedFilters: {},
    filters: {
      type: Array,
      required: true
    }
  },
  watch: {
    selectedFilters (selectedFilters) {
      this.dataSelectedFilters = selectedFilters
    }
  },
  methods: {
    input () {
      this.$emit('input', this.dataSelectedFilters)
    },
    blur () {
      this.$emit('blur', this.dataSelectedFilters)
    }
  }
}
</script>
