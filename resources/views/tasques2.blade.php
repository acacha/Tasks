@foreach ($tasks as $task)
    <p>This is task {{ $task->name }}. User: {{ optional($task->user)->name }}</p>
@endforeach
