<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Todo App</title>
</head>
<body>
    <x-app-layout>
    <x-slot name="header">
        <!-- Dacă ai un header personalizat aici -->
    </x-slot>
        
    </x-app-layout>

    <div class="container">
        @if($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="/tasks">
    @csrf

    <!-- Descrierea Task-ului -->
    <div class="form-group">
        <label for="description">Descriere Task</label>
        <input type="text" class="form-control" name="description" id="description" required>
    </div>

    <!-- Selectarea Priorității -->
    <div class="form-group" style="margin-top: 15px;">
        <label for="priority_id">Alege Prioritatea</label>
        <select name="priority_id" id="priority_id" class="form-control" required>
            @foreach($priorities as $priority)
                <option value="{{ $priority->id }}">{{ $priority->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Submit buton -->
    <div class="form-group" style="margin-top: 15px;">
        <button type="submit" class="btn btn-primary">Crează Task</button>
    </div>
</form>

    </div>

</body>
</html>
