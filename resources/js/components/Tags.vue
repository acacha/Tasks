<template>
    <span>
        <tags-list :tags="dataTags"></tags-list>
        <tags-create @created="add" ></tags-create>
    </span>
</template>

<script>
import TagsList from './TagsList'
import TagsCreate from './TagsCreate'
export default {
  name: 'Tags',
  components: {
    'tags-list': TagsList,
    'tags-create': TagsCreate
  },
  data () {
    return {
      dataTags: this.tags
    }
  },
  props: {
    tags: {
      type: Array,
      required: true
    }
  },
  methods: {
    add (tag) {
      this.dataTags.push(tag)
    }
  }
}
</script>
