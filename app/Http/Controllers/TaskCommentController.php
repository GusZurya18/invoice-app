<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskCommentController extends Controller
{
    public function store(Request $request, Task $task)
    {
        $request->validate([
            'comment' => 'required|string|max:2000'
        ]);

        $user = Auth::user();

        // Izinkan admin, assignee, atau creator
        if ($task->user_id !== $user->id && 
            $user->role !== 'admin' && 
            $task->created_by !== $user->id) {
            abort(403, 'Anda tidak memiliki akses untuk memberikan komentar pada task ini.');
        }

        TaskComment::create([
            'task_id' => $task->id,
            'user_id' => $user->id,
            'comment' => $request->comment  // Gunakan 'comment' sesuai database
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }

    public function destroy(TaskComment $comment)
    {
        $user = Auth::user();

        if ($comment->user_id !== $user->id && $user->role !== 'admin') {
            abort(403);
        }

        $comment->delete();
        return back()->with('success', 'Komentar berhasil dihapus!');
    }
}