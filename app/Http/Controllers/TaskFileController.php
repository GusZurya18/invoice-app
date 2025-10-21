<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Tambahkan import ini
use Illuminate\Support\Str;

class TaskFileController extends Controller
{
    public function store(Request $request, Task $task)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120' // max 5MB
        ]);

        $user = Auth::user();
        
        // Cek permission - user hanya bisa upload ke task mereka, atau admin bisa upload ke semua task
        if ($task->user_id !== $user->id && $user->role !== 'admin') {
            abort(403, 'Tidak memiliki akses untuk mengupload file ke task ini');
        }

        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        
        // Generate unique filename to avoid conflicts
        $filename = time() . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
        
        $path = $file->storeAs('task_files', $filename, 'public');

        TaskFile::create([
            'task_id' => $task->id,
            'user_id' => $user->id,
            'file_path' => $path,
            'file_type' => $file->getClientOriginalExtension(),
            'original_name' => $originalName
        ]);

        return back()->with('success', 'File berhasil diupload');
    }

    public function destroy(TaskFile $file)
    {
        $user = Auth::user();
        
        // Hanya uploader atau admin yang bisa hapus
        if ($file->user_id !== $user->id && $user->role !== 'admin') {
            abort(403, 'Tidak memiliki akses untuk menghapus file ini');
        }

        // Hapus file dari storage
        if (Storage::disk('public')->exists($file->file_path)) {
            Storage::disk('public')->delete($file->file_path);
        }
        
        // Hapus record dari database
        $file->delete();
        
        return back()->with('success', 'File berhasil dihapus');
    }

    public function download(TaskFile $file)
    {
        $user = Auth::user();
        $task = $file->task;
        
        // Cek permission - user hanya bisa download file dari task mereka, atau admin bisa download semua
        if ($task->user_id !== $user->id && $user->role !== 'admin') {
            abort(403, 'Tidak memiliki akses untuk mendownload file ini');
        }

        $filePath = storage_path('app/public/' . $file->file_path);
        
        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->download($filePath, $file->original_name ?? basename($file->file_path));
    }
}