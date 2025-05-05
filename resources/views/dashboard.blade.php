<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
</x-app-layout>

<div class="container">
    <h1>Tasks</h1>

    @foreach($tasks as $task)
    <div class="card @if($task->isCompleted()) border-success @endif" style="margin-bottom: 15px; position: relative;">
        <div class="card-body">
            <!-- Data creării în colțul dreapta sus -->
            <div class="task-date" style="position: absolute; top: 10px; right: 10px; font-size: 0.9rem; color: gray;">
                <p>Creat la: {{ $task->created_at->format('d-m-Y H:i') }}</p>
            </div>

            <p>{{ $task->description }}</p>
            
            <!-- Afișăm prioritatea -->
            <p>Prioritate: {{ $task->priority ? $task->priority->name : 'Nedefinită' }}</p>
            
            <!-- Formular pentru modificarea statusului -->
            <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST" style="margin-bottom: 10px;">
                @csrf
                @method('PATCH')
                <div class="d-flex align-items-center">
                    <select name="status" class="form-select" style="max-width: 200px; margin-right: 10px;">
                        <option value="Not Started" @if($task->status == 'Not Started') selected @endif>Neînceput</option>
                        <option value="In Progress" @if($task->status == 'In Progress') selected @endif>În Progres</option>
                        <option value="Halfway Done" @if($task->status == 'Halfway Done') selected @endif>Pe Jumătate Finalizat</option>
                        <option value="Completed" @if($task->status == 'Completed') selected @endif>Finalizat</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Actualizează statusul</button>
                </div>
            </form>

            @if(!$task->isCompleted())
                <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <div class="d-grid gap-2">
                        <button class="btn btn-light" type="submit">Completat</button>
                    </div>
                </form>
            @else
                <form action="/tasks/{{ $task->id }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger btn-block" type="submit">Șterge</button>
                </form>
            @endif
        </div>
    </div>
@endforeach





    {{-- Pagination links --}}
    <div class="d-flex justify-content-center">
        {{ $tasks->links() }}
    </div>

    <a href="/tasks/create" class="btn btn-primary btn-lg">Task nou</a>
</div>
