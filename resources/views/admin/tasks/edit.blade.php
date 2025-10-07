@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-gray-900">Edit Task</h1>
        </div>

        <div class="p-6">
            <form action="{{ route('admin.tasks.update', $task) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Title -->
                    <div class="md:col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-700">Judul Task</label>
                        <input type="text" name="title" id="title" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('title') border-red-500 @enderror" 
                               value="{{ old('title', $task->title) }}" required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="description" id="description" rows="4" 
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('description') border-red-500 @enderror">{{ old('description', $task->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Assigned User -->
                    <div>
                        <label for="user_id" class="block text-sm font-medium text-gray-700">Tugaskan Kepada</label>
                        <select name="user_id" id="user_id" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('user_id') border-red-500 @enderror">
                            <option value="">Pilih User</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" 
                                        {{ (old('user_id', $task->user_id) == $user->id) ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Priority -->
                    <div>
                        <label for="priority" class="block text-sm font-medium text-gray-700">Prioritas</label>
                        <select name="priority" id="priority" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('priority') border-red-500 @enderror" required>
                            <option value="low" {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}>Low</option>
                            <option value="medium" {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="high" {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}>High</option>
                        </select>
                        @error('priority')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="status" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('status') border-red-500 @enderror" required>
                            <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="done" {{ old('status', $task->status) == 'done' ? 'selected' : '' }}>Done</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Start Date -->
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                        <input type="date" name="start_date" id="start_date" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('start_date') border-red-500 @enderror" 
                            value="{{ old('start_date', $task->start_date?->format('Y-m-d')) }}">
                        @error('start_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Due Date -->
                    <div>
                        <label for="deadline" class="block text-sm font-medium text-gray-700">Tanggal Deadline</label>
                        <input type="date" name="deadline" id="deadline" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('deadline') border-red-500 @enderror" 
                               value="{{ old('deadline', $task->deadline?->format('Y-m-d')) }}">
                        @error('deadline')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Task Info -->
                <div class="mt-8 bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900 mb-3">Informasi Task</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                        <div>
                            <span class="font-medium text-gray-700">Dibuat oleh:</span>
                            <p class="text-gray-900">{{ $task->creator->name ?? 'Unknown' }}</p>
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">Dibuat pada:</span>
                            <p class="text-gray-900">{{ $task->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">Terakhir diupdate:</span>
                            <p class="text-gray-900">{{ $task->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Files and Comments Preview -->
                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Files -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 mb-3">Files ({{ $task->files->count() }})</h3>
                        @if($task->files->count() > 0)
                            <ul class="space-y-2">
                                @foreach($task->files->take(3) as $file)
                                    <li class="flex items-center justify-between bg-white p-2 rounded">
                                        <span class="text-sm text-gray-700">{{ $file->original_name ?? basename($file->file_path) }}</span>
                                        <span class="text-xs text-gray-500">{{ $file->created_at->diffForHumans() }}</span>
                                    </li>
                                @endforeach
                                @if($task->files->count() > 3)
                                    <li class="text-sm text-gray-500">... dan {{ $task->files->count() - 3 }} file lainnya</li>
                                @endif
                            </ul>
                        @else
                            <p class="text-sm text-gray-500">Belum ada file</p>
                        @endif
                    </div>

                    <!-- Comments -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 mb-3">Comments ({{ $task->comments->count() }})</h3>
                        @if($task->comments->count() > 0)
                            <div class="space-y-2">
                                @foreach($task->comments->take(3) as $comment)
                                    <div class="bg-white p-2 rounded">
                                        <div class="flex justify-between items-start">
                                            <span class="text-sm font-medium text-gray-700">{{ $comment->user->name }}</span>
                                            <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-sm text-gray-600 mt-1">{{ Str::limit($comment->content, 60) }}</p>
                                    </div>
                                @endforeach
                                @if($task->comments->count() > 3)
                                    <p class="text-sm text-gray-500">... dan {{ $task->comments->count() - 3 }} comment lainnya</p>
                                @endif
                            </div>
                        @else
                            <p class="text-sm text-gray-500">Belum ada comment</p>
                        @endif
                    </div>
                </div>

                <div class="mt-8 flex justify-end space-x-3">
                    <a href="{{ route('admin.tasks.index') }}" 
                       class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">
                        Batal
                    </a>
                    <a href="{{ route('admin.tasks.show', $task) }}" 
                       class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                        Lihat Detail
                    </a>
                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                        Update Task
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection