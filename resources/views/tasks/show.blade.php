// File: resources/views/users/tasks/show.blade.php atau sejenisnya
<x-app-layout>
<x-slot name="header">
<h2>Tugas Saya</h2>
</x-slot>
<div class="max-w-3xl mx-auto p-4">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('tasks.my') }}" class="text-sm text-blue-600">&larr; Kembali</a>
    <h2 class="text-2xl font-bold mt-2">{{ $task->title }}</h2>
    <p class="text-sm text-gray-600">Dari: {{ $task->creator?->name }}</p>
    <p class="mt-3">{{ $task->description }}</p>

    <div class="mt-4">
        <h4 class="font-semibold">Files</h4>
        <ul>
            @foreach($task->files as $f)
            <li class="mt-2">
                <a target="_blank" href="{{ asset('storage/'.$f->file_path) }}" class="text-blue-600">{{ basename($f->file_path) }}</a>
                <form action="{{ route('tasks.files.destroy', $f) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button class="text-red-600 ml-2" onclick="return confirm('Hapus file?')">Hapus</button>
                </form>
            </li>
            @endforeach
        </ul>

        <form action="{{ route('tasks.files.store', $task) }}" method="POST" enctype="multipart/form-data" class="mt-3">
            @csrf
            <input type="file" name="file" required>
            <button class="bg-green-600 text-white px-3 py-1 rounded">Upload</button>
        </form>
    </div>

    <div class="mt-6">
        <h4 class="font-semibold">Komentar</h4>
        <div class="space-y-3 mt-3">
            @foreach($task->comments as $c)
            <div class="bg-gray-100 p-3 rounded">
                <div class="flex justify-between items-start">
                    <div>
                        <div class="text-sm font-semibold">{{ $c->user->name }} 
                            <span class="text-xs text-gray-500">{{ $c->user->role == 'admin' ? '(Admin)' : '(User)' }}</span>
                        </div>
                        <span class="text-xs text-gray-500">{{ $c->created_at->diffForHumans() }}</span>
                    </div>
                    
                    {{-- Tombol hapus hanya untuk komentar milik sendiri --}}
                    @if(auth()->id() === $c->user_id)
                        <form action="{{ route('tasks.comments.destroy', $c) }}" method="POST" class="inline" 
                              onsubmit="return confirm('Yakin ingin menghapus komentar ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 text-xs font-medium">
                                Hapus
                            </button>
                        </form>
                    @endif
                </div>
                <div class="mt-2 text-sm">{{ $c->comment }}</div>
            </div>
            @endforeach
        </div>

        <form action="{{ route('tasks.comments.store', $task) }}" method="POST" class="mt-3">
            @csrf
            <textarea name="comment" rows="3" class="w-full border p-2 rounded" placeholder="Tulis komentar Anda..." required></textarea>
            @error('comment')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
            <button class="bg-blue-600 text-white px-3 py-1 rounded mt-2">Kirim Komentar</button>
        </form>
    </div>
</div>
</x-app-layout>