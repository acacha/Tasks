# Relationships

# Models

Artisan:

```
php artisan make:model Flight
```

```
php artisan make:model --help     
Description:
  Create a new Eloquent model class

Usage:
  make:model [options] [--] <name>

Arguments:
  name                  The name of the class

Options:
  -a, --all             Generate a migration, factory, and resource controller for the model
  -c, --controller      Create a new controller for the model
  -f, --factory         Create a new factory for the model
      --force           Create the class even if the model already exists
  -m, --migration       Create a new migration file for the model
  -p, --pivot           Indicates if the generated model should be a custom intermediate table model
  -r, --resource        Indicates if the generated controller should be a resource controller
  -h, --help            Display this help message
  -q, --quiet           Do not output any message
  -V, --version         Display this application version
      --ansi            Force ANSI output
      --no-ansi         Disable ANSI output
  -n, --no-interaction  Do not ask any interactive question
      --env[=ENV]       The environment the command should run under
  -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 fo
```

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
