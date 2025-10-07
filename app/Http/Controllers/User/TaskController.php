<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // tasks assigned to this user
        $tasks = Task::with(['creator','files','comments.user'])
                     ->where('user_id', $user->id)
                     ->orWhere('created_by', $user->id) // optionally also show tasks created by user
                     ->latest()
                     ->paginate(12);
        return view('tasks.index', compact('tasks'));
    }

    public function show(Task $task)
    {
        // authorization: only assigned user or creator or admin can view
        $user = Auth::user();
        if ($task->user_id !== $user->id && $task->created_by !== $user->id && $user->role !== 'admin') {
            abort(403);
        }
        $task->load(['creator','assignee','files.user','comments.user']);
        return view('tasks.show', compact('task'));
    }

    public function updateStatus(Request $request, Task $task)
    {
        $request->validate(['status'=>'required|in:pending,in_progress,completed']);
        $user = Auth::user();
        if ($task->user_id !== $user->id && $user->role !== 'admin') abort(403);

        $task->update(['status'=>$request->status]);
        return back()->with('success','Status diperbarui');
    }
}
