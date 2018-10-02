<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Tasques</h1>
    {{--LARAVEL BLADE--}}
    <ul>
        @foreach ($tasks as $task)
            <li>{{ $task->name }} <button>Completar</button>
                <a href="/task_edit/{{ $task->id }}">
                    <button>Modificar</button>
                </a>

                <form action="/tasks/{{ $task->id }}" method="POST">
                    @csrf
                    {{ method_field('DELETE') }}
                    <button>Eliminar</button>
                </form>
            </li>
        @endforeach
    </ul>
    <form action="/tasks" method="POST">
        {{--label--}}
        @csrf
        <input name="name" type="text" placeholder="Nova tasca">
        <button>Afegir</button>
    </form>
</body>
</html>
