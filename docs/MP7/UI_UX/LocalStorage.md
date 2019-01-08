# Exemple:

TODOS MVC Vue: https://vuejs.org/v2/examples/todomvc.html

```javascript
// localStorage persistence
var STORAGE_KEY = 'todos-vuejs-2.0'
var todoStorage = {
  fetch: function () {
    var todos = JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]')
    todos.forEach(function (todo, index) {
      todo.id = index
    })
    todoStorage.uid = todos.length
    return todos
  },
  save: function (todos) {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(todos))
  }
}
```

Vue color pickers:
- https://saintplay.github.io/vue-swatches/
- http://vue-color.surge.sh/

Component configuració Tema:

- Escollir color primary
- Escollir color secundary
- Guardar el color a local Storage
- Mounted: recuperar color del LocalStorage
- app.js agafa color primary del localStorage si existeix i sinó valor per defecte
