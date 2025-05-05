<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Priority;  // Importăm modelul Priority
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
{
    $tasks = Task::with('priority') // Eager load prioritatea
                ->where('user_id', auth()->id())
                ->orderBy('completed_at')
                ->orderBy('id', 'DESC') // Sau adaugă ordonare după created_at
                ->paginate(10);

    return view('dashboard', [
        'tasks' => $tasks,
    ]);
}



    public function create()
    {
        // Obținem toate prioritățile disponibile
        $priorities = Priority::all();
        return view('tasks.create', compact('priorities')); // Trimis la formular
    }

    public function store(Request $request)
{
    $request->validate([
        'description' => 'required|max:255',
        'priority_id' => 'nullable|exists:priorities,id',  // Validăm prioritatea
    ]);

    $task = new Task();
    $task->description = $request->description;
    $task->priority_id = $request->priority_id;  // Salvăm prioritatea
    $task->user_id = auth()->id();  // Asigură-te că salvezi și user_id
    $task->save();

    return redirect()->route('dashboard')->with('success', 'Task created successfully.');
}

    public function updateStatus(Request $request, Task $task)
    {
    // Validarea intrării
    $request->validate([
        'status' => 'required|string|in:Not Started,In Progress,Halfway Done,Completed',
    ]);

    // Actualizarea statusului task-ului
    $task->status = $request->input('status');
    $task->save();

    // Redirecționare cu un mesaj de succes
    return redirect()->back()->with('success', 'Statusul task-ului a fost actualizat cu succes!');
    }


    public function update($id)
    {
        $task = Task::where('id', $id)->firstOrFail();

        $task->completed_at = now();
        $task->save();

        return redirect('/')->with('success', 'Task completat cu succes!');
    }

    public function delete($id)
    {
        $task = Task::where('id', $id)->firstOrFail();
        $task->delete();

        return redirect('/')->with('success', 'Task șters cu succes!');
    }
}
