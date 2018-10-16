# Introducció

Qüestions importants:
- Les validacions s'han de fer sempre com a mínim al backend (PHP)
- També es poden fer a Javascript però mai NOMÉS a Javascript
- Les validacions de javascript es fan per millorar la Experiència de l'usuari però no es poden considerar segures

Validacions Laravel/PHP
- Es realitzen al controlador
- OCO! Que es realitzin al controlador no vol dir que no delegui en una classe tercera per fer la feina

# Rules de Laravel

https://laravel.com/docs/5.7/validation#available-validation-rules

# Protocol HTTP i APIs

- Laravel utilitza el codi 422 (HTTP Status Code) per indicar errors de validació.
- Els errors estan en format Json a la resposta

# Com no fer les validacions

Amb ifs als controladors:

```php
/**
 * Store a new task.
 *
 * @param  Request  $request
 * @return Response
 */
public function store(Request $request)
{
    if(name_is_valid($request->name)) {
      // STORE
    } else {
      //ERROR
    }

}
```

Ok

```php
/**
 * Store a new task.
 *
 * @param  Request  $request
 * @return Response
 */
public function store(Request $request)
{
    $validatedData = $request->validate([
        'title' => 'required|unique:posts|max:255',
        'body' => 'required',
    ]);

    // The blog post is valid...
}
```

# Com mostrar els errors amb PHP

A les plantilles Blade es pot utilitzar la variable errors:

```
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
```

IMPORTANT: no us heu de preocupar de la variable errors la gestiona Laravel.

# Requests

- La idea és simple, en comptes d'utilitzar objecte Request simple creem una request per cada tipus de petició.
- Forma preferida durant el curs
- https://laravel.com/docs/5.7/validation#form-request-validation

Taula d'operacions crud, exemple amb Tasques:

```
 php artisan make:request StoreTask // Create
 php artisan make:request IndexTask // Index
 php artisan make:request ShowTask // show
 php artisan make:request UpdateTask // update
 php artisan make:request DestroyTask // destroy
 NOMÈS PHP:
 php artisan make:request EditTask // Index
 php artisan make:request CreateTask // Index
``` 

# Validació Vue

Tenim diverses llibreries
- vuelidate: https://github.com/monterail/vuelidate  
- Suportat a vuetify: https://vuetifyjs.com/en/components/forms

Com mostrar els errors:
- TODO
- Formularis: online al costat de cada mateixa entrada de formulari

# Test Driven Development

## Laravel

TODO

## Vue Components

TODO

# Recursos
- https://laravel.com/docs/5.7/validation
