<script>
export default {
  el: '#app',
  name: 'App',
  data () {
    return {
      drawer: null,
      items: [
        { icon: 'home', text: 'Welcome', url: '/' },
        { icon: 'home', text: 'Home', url: '/home' },
        {
          icon: 'keyboard_arrow_up',
          'icon-alt': 'keyboard_arrow_down',
          text: 'Tasques',
          model: true,
          children: [
            { icon: 'build', text: 'Tasques amb PHP', url: '/tasks' },
            { icon: 'build', text: 'Tasques', url: '/tasks_vue' }
          ]
        },
        { icon: 'help', text: 'Contact', url: '/contact' },
        { icon: 'public', text: 'About', url: '/about' }
      ]
    }
  }
}
</script>
