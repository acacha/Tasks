<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edita una tasca</title>
</head>
<body>
    <h1>Edita una tasca</h1>
    <form action="/tasks/{{$task->id}}" method="POST">
        @csrf
        {{ method_field('PUT') }}
        Name: <input name="name" type="text" value="{{$task->name}}">
        {{--// CHECKBOX--}}
        Completed:
        @if ( $task->completed )
            <input name="completed" type="checkbox" checked>
        @else
            <input name="completed" type="checkbox">
        @endif
        <button>Editar</button>
    </form>
</body>
</html>
