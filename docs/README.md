# CORS

localhost/:1 Failed to load http://127.0.0.1:8050/api/v1/tasks: No 'Access-Control-Allow-Origin' header is present on the requested resource. Origin 'http://localhost:8080' is therefore not allowed access.

Resources:
- https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS

# Laravel

## Testing

### HTTP

- https://laravel.com/docs/5.7/http-tests
- https://laravel.com/docs/5.7/database-testing

## Relacions

Una bona forma aprendre com funciones es via TDD i Wishfull programming


Recursos:
- https://laracasts.com/series/eloquent-relationships

# Eloquent

CRUD (CREATE RETRIVE UPDATE DELETE)

'''Recursos'''
- https://laravel.com/docs/5.7/eloquent

## LIST
Mètodes:

- Task::all() -> Resultat una col·lecció
- Task::where('completed', true)->orderBy('name', 'desc')->take(10)->get();
- Fresh: $freshFlight = $flight->fresh();

Recursos
- https://laravel.com/docs/5.7/eloquent#retrieving-models

## Collections

Laravel collections: https://laravel.com/docs/5.7/collections

## SHOW

```
$flight = App\Flight::find(1);
$flights = App\Flight::find([1, 2, 3]);
$flight = App\Flight::where('active', 1)->first();
$model = App\Flight::findOrFail(1);

```

## Create

INSERTS: https://laravel.com/docs/5.7/eloquent#inserting-and-updating-models

```
$flight = new Flight;

        $flight->name = $request->name;

        $flight->save();
```

### Mass assignement

OCO: Camp fillable:

    protected $fillable = ['name'];

```
$flight = App\Flight::create(['name' => 'Flight 10']);
```

## Update

```
$flight = App\Flight::find(1);

$flight->name = 'New Flight Name';

$flight->save();
```

## Delete

```
$flight = App\Flight::find(1);

$flight->delete();
```

## API CRUD (JSON) vs HTML CRUD

CRITERI: Mirar de no xocar amb el controlador ja existen NO API -> Espai de noms Api (carpeta)

```
app/Http/Controlloers/Api
```

ApiResources controller:

```
 Route::apiResource('photos', 'API\PhotoController');
```

```
php artisan make:controller API/PhotoController --api
```

NO CALEN ELS METODES create i edit (no hi ha formularis PHP/HTML)


## RUTES CRUD

- CRUD (Cru en anglès)
- BREAD (Pà en anglès): 
 - BROWSE READ EDIT ADD DELETE

Vídeo recomanat: https://laracasts.com/series/laravel-from-scratch-2018/episodes/11

RUTES:
- GET /projects (index)
- GET /projects/create (create) -> Formulari creació
- GET /projects/1 (show)
- POST /projects (store)
- GET /projects1/edit (edit)
- PATCH /projects/1 (update)
- DELETE /projects/1 (destroy)

Ajudes de Laravel (https://laravel.com/docs/5.7/controllers#resource-controllers):

```
 Route:resource('/projects') 
```

o

```
Route::resources([
    'photos' => 'PhotoController',
    'posts' => 'PostController'
]);
```

Controladors:

 - https://laravel.com/docs/5.7/controllers#resource-controllers

Quan les coses siguin més complicades/més reals (no sempre farem només CRUD) seguirem els criteris de Cruddy By Design:

- Exemple més complicat: canviar l'estat d'una tasca de completa a no completa o viceversa 

Tècniques:
- Give nested resources a dedicated controller
- Treat properties edited independently as separate resources
- Treat pivot models as their own resource
- Think of different states as different resources

Recursos:
- https://www.youtube.com/watch?v=MF0jFKvS4SI
- Github: https://github.com/adamwathan/laracon2017 

## Route Model Binding

 https://laravel.com/docs/5.7/controllers#resource-controllers

Verb	URI	Action	Route Name
GET	/photos	index	photos.index
GET	/photos/create	create	photos.create
POST	/photos	store	photos.store
GET	/photos/{photo}	show	photos.show
GET	/photos/{photo}/edit	edit	photos.edit
PUT/PATCH	/photos/{photo}	update	photos.update
DELETE	/photos/{photo}	destroy	photos.destroy

# Vue

## vue-tasks

## Guia de treball

- https://012.vuejs.org/guide/
- Patro MVVM: https://www.packtpub.com/mapt/book/web_development/9781786469946/2/ch02lvl1sec18/mvvm-architectural-pattern
- Basic data binding:  https://laracasts.com/series/learn-vue-2-step-by-step/episodes/1
- V-MODEL: How it works, equivalent to:
  v-model="varName" is equivalent to :value="varName" @input="e => varName = e.target.value".

<input v-model="searchText">

does the same thing as:

<input
  v-bind:value="searchText"
  v-on:input="searchText = $event.target.value"
>


- https://vuejs.org/v2/guide/forms.html
- Lazy (mètode onchange en comptes de output): https://vuejs.org/v2/guide/forms.html#lazy
- Customize:
  - https://vuejs.org/v2/guide/components.html#Using-v-model-on-Components
- Customizing: https://vuejs.org/v2/guide/components-custom-events.html#Customizing-Component-v-model

Vue.component('base-checkbox', {
  model: {
    prop: 'checked',
    event: 'change'
  },
  props: {
    checked: Boolean
  },
  template: `
    <input
      type="checkbox"
      v-bind:checked="checked"
      v-on:change="$emit('change', $event.target.checked)"
    >
  `
})

# VUE DEV-TOOLS

# Lists
- https://vuejs.org/v2/guide/list.html
- Directiva v-for
- Sistema plantilla Vue moustaches
- Operacions amb arrays: https://vuejs.org/v2/guide/list.html#Mutation-Methods
 -- push/pop/shift/unshift/splice/sort/reverse
 -- Funció filter/ foreach i altres operadors amb arrays

## V-IF i V-SHOW

Mostrar tasques completades i no completades

 RANGES:

 <div>
  <span v-for="n in 10">{{ n }} </span>
</div>

# CRUD

- https://vuejs.org/v2/examples/todomvc.html

## EDIT MODE

Laracast video test utils: https://laracasts.com/series/testing-vue/episodes/7

# Computed Properties

- IMPORTANT: sempre són calculs realitzats a partir de dades de vue (data). No fer sobre elements no monitoritzats per vue o constants
- A vegades es pot fer el que es fa amb un computed amb un mètode
- Exemple filtre de tasques: filteredTasks -> tasques completes o tsques incompletes
- https://vuejs.org/v2/guide/computed.html

# COMPONENTS PROPS

Comunicació amb components/API/CONTRACTE

Comunicació pares fills:
- https://medium.com/@sky790312/about-vue-2-parent-to-child-props-af3b5bb59829
- Patrons més complicats de comunicació: Bus i Store (Vuex)

- Props validation
- Vue hooks: created/mounted

# VUE EVENTS
- dos tipus events: predefinits (click, dblclick, change, input) i a mida (custom)
- https://vuejs.org/v2/guide/events.html
- CUSTOM EVENTS a components: https://vuejs.org/v2/guide/components-custom-events.html

# SLOTS

TODO

# Axios

- Comunicació amb la API
- Javascript Promises
- Programació asíncrona i Javascript

-->

# tasks_javascript

- Carpeta: tasks:javascript
- tailwind CSS

# Troubleshooting. Resol·lució de problemes

## CORS. Failed to load URL: No 'Access-Control-Allow-Origin' header is present on the requested resource. Origin ... is therefore not allowed access.

IMPORTANT: CORS no caldrà quan l'aplicació client/frontend i la backend/server siguin al mateix domini

Cal instal·lar la llibreria de Laravel:

 https://github.com/barryvdh/laravel-cors
 
```
$ composer require barryvdh/laravel-cors
```

I afegir Middleware:

```
protected $middleware = [
    // ...
    \Barryvdh\Cors\HandleCors::class,
];
```

