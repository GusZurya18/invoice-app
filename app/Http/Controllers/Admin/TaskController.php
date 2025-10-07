<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with(['assignee', 'creator'])
                    ->latest()
                    ->paginate(10);
        
        return view('admin.tasks.index', compact('tasks'));
    }

    public function create()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.tasks.create', compact('users'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'nullable|exists:users,id',
            'start_date' => 'nullable|date',
            'deadline' => 'nullable|date|after_or_equal:start_date',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:pending,in_progress,done'
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
            'start_date' => $request->start_date,  
            'deadline' => $request->deadline,   
            'priority' => $request->priority,
            'status' => $request->status,
            'created_by' => Auth::id()
        ]);

        return redirect()->route('admin.tasks.index')->with('success', 'Task berhasil dibuat!');
    }

    public function show(Task $task)
    {
        $task->load(['assignee', 'creator', 'files.user', 'comments.user']);
        return view('admin.tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $task->load(['assignee', 'creator', 'files', 'comments.user']);
        $users = User::where('role', 'user')->get();
        
        return view('admin.tasks.edit', compact('task', 'users'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'nullable|exists:users,id',
            'start_date' => 'nullable|date',
            'deadline' => 'nullable|date|after_or_equal:start_date',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:pending,in_progress,done'
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
            'start_date' => $request->start_date,  
            'deadline' => $request->deadline, 
            'priority' => $request->priority,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.tasks.index')->with('success', 'Task berhasil diupdate!');
    }

    public function destroy(Task $task)
    {
        foreach ($task->files as $file) {
            if (file_exists(storage_path('app/public/' . $file->file_path))) {
                unlink(storage_path('app/public/' . $file->file_path));
            }
        }

        $task->delete();

        return redirect()->route('admin.tasks.index')->with('success', 'Task berhasil dihapus!');
    }
}