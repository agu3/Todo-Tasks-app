<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" >
    <title>Document</title>
</head>
<body>
    <x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" >
    <x-slot name="header">
    </x-slot>
  </x-app-layout>  
       
        
    <div class="container">
         <h1>Tasks</h1>
        @foreach($tasks as $task)
        <div class="card" style="margin-bottom : 15px;">
            <div class="card-body">
                {{ $task->description}}
                <a href="btn"> Complete</a>
            </div>
        </div>
        @endforeach
        <a href="/tasks/create" class="btn btn-primary btn-lg  "> Task nou</a>
    </div>

</body>
</html>