# Relationships


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
