@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-900">Detail Task</h1>
        <div class="flex space-x-3">
            <a href="{{ route('admin.tasks.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                Kembali
            </a>
            <a href="{{ route('admin.tasks.edit', $task) }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                Edit Task
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Task Info -->
            <div class="bg-white shadow rounded-lg p-6">
                <div class="border-b pb-4 mb-6">
                    <h2 class="text-xl font-semibold text-gray-900">{{ $task->title }}</h2>
                    <div class="flex items-center space-x-4 mt-2">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full
                            @if($task->status == 'pending') bg-yellow-100 text-yellow-800
                            @elseif($task->status == 'in_progress') bg-blue-100 text-blue-800
                            @elseif($task->status == 'done') bg-green-100 text-green-800
                            @endif">
                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                        </span>
                        <span class="px-3 py-1 text-xs font-semibold rounded-full
                            @if($task->priority == 'high') bg-red-100 text-red-800
                            @elseif($task->priority == 'medium') bg-yellow-100 text-yellow-800
                            @else bg-green-100 text-green-800
                            @endif">
                            Priority: {{ ucfirst($task->priority) }}
                        </span>
                    </div>
                </div>

                @if($task->description)
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-3">Deskripsi</h3>
                        <p class="text-gray-700 leading-relaxed">{{ $task->description }}</p>
                    </div>
                @endif

                <!-- Files -->
                @if($task->files->count() > 0)
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-3">Files ({{ $task->files->count() }})</h3>
                        <div class="space-y-2">
                            @foreach($task->files as $file)
                                <div class="flex items-center justify-between bg-gray-50 p-3 rounded-lg">
                                    <div class="flex items-center space-x-3">
                                        <div class="flex-shrink-0">
                                            @if(in_array($file->file_type, ['jpg', 'jpeg', 'png', 'gif']))
                                                <svg class="w-8 h-8 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                                                </svg>
                                            @elseif(in_array($file->file_type, ['pdf']))
                                                <svg class="w-8 h-8 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                                                </svg>
                                            @else
                                                <svg class="w-8 h-8 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                                                </svg>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">{{ $file->original_name ?? basename($file->file_path) }}</p>
                                            <p class="text-sm text-gray-500">Diupload oleh {{ $file->user->name }} • {{ $file->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank"
                                           class="text-blue-600 hover:text-blue-800 text-sm">
                                            Lihat
                                        </a>
                                        <form action="{{ route('admin.tasks.files.destroy', $file) }}" method="POST" class="inline"
                                              onsubmit="return confirm('Yakin ingin menghapus file ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Comments Section -->
                <div class="border-t pt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        Comments ({{ $task->comments->count() }})
                    </h3>

                    <!-- Existing Comments -->
                    @if($task->comments->count() > 0)
                        <div class="space-y-4 mb-6">
                            @foreach($task->comments as $comment)
                                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <h4 class="text-sm font-semibold text-gray-900">{{ $comment->user->name }}</h4>
                                            <span class="text-xs text-gray-500">
                                                {{ $comment->user->role == 'admin' ? '(Admin)' : '(User)' }}
                                            </span>
                                        </div>
                                        <div class="flex items-center space-x-3">
                                            <span class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                            @if(auth()->id() === $comment->user_id || auth()->user()->role === 'admin')
                                                <form action="{{ route('admin.tasks.comments.destroy', $comment) }}" method="POST" class="inline"
                                                      onsubmit="return confirm('Yakin ingin menghapus komentar ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800 text-xs font-medium">
                                                        Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                    <p class="text-gray-700 text-sm leading-relaxed whitespace-pre-wrap">{{ $comment->comment }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-sm mb-4">Belum ada komentar. Jadilah yang pertama berkomentar!</p>
                    @endif

                    <!-- Add Comment Form -->
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <h4 class="text-sm font-medium text-gray-900 mb-3">Tambah Komentar</h4>
                        <form action="{{ route('admin.tasks.comments.store', $task) }}" method="POST">
                            @csrf
                            <textarea name="comment" rows="3" 
                                      class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('comment') border-red-500 @enderror" 
                                      placeholder="Tulis komentar Anda di sini..." required>{{ old('comment') }}</textarea>
                            @error('comment')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <div class="mt-3 flex justify-end">
                                <button type="submit" 
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                                    Kirim Komentar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Task Details -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Detail Task</h3>
                <div class="space-y-3">
                    <div>
                        <span class="text-sm font-medium text-gray-700">Ditugaskan kepada:</span>
                        <p class="text-sm text-gray-900">{{ $task->assignee->name ?? 'Belum ditugaskan' }}</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-700">Dibuat oleh:</span>
                        <p class="text-sm text-gray-900">{{ $task->creator->name ?? 'Unknown' }}</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-700">Start Date:</span>
                        <p class="text-sm text-gray-900">{{ $task->start_date ? $task->start_date->format('d M Y') : 'Tidak ada' }}</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-700">Deadline:</span>
                        <p class="text-sm text-gray-900">{{ $task->deadline ? $task->deadline->format('d M Y') : 'Tidak ada deadline' }}</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-700">Dibuat:</span>
                        <p class="text-sm text-gray-900">{{ $task->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-700">Terakhir diupdate:</span>
                        <p class="text-sm text-gray-900">{{ $task->updated_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    @if($task->status != 'done')
                        <form action="{{ route('admin.tasks.update', $task) }}" method="POST" class="w-full">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="title" value="{{ $task->title }}">
                            <input type="hidden" name="description" value="{{ $task->description }}">
                            <input type="hidden" name="user_id" value="{{ $task->user_id }}">
                            <input type="hidden" name="start_date" value="{{ $task->start_date?->format('Y-m-d') }}">
                            <input type="hidden" name="deadline" value="{{ $task->deadline?->format('Y-m-d') }}">
                            <input type="hidden" name="priority" value="{{ $task->priority }}">
                            <input type="hidden" name="status" value="done">
                            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm">
                                Mark as Completed
                            </button>
                        </form>
                    @endif

                    @if($task->status == 'pending')
                        <form action="{{ route('admin.tasks.update', $task) }}" method="POST" class="w-full">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="title" value="{{ $task->title }}">
                            <input type="hidden" name="description" value="{{ $task->description }}">
                            <input type="hidden" name="user_id" value="{{ $task->user_id }}">
                            <input type="hidden" name="start_date" value="{{ $task->start_date?->format('Y-m-d') }}">
                            <input type="hidden" name="deadline" value="{{ $task->deadline?->format('Y-m-d') }}">
                            <input type="hidden" name="priority" value="{{ $task->priority }}">
                            <input type="hidden" name="status" value="in_progress">
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                                Start Progress
                            </button>
                        </form>
                    @endif

                    <form action="{{ route('admin.tasks.destroy', $task) }}" method="POST" class="w-full"
                          onsubmit="return confirm('Yakin ingin menghapus task ini? Semua file dan comment akan ikut terhapus.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm">
                            Delete Task
                        </button>
                    </form>
                </div>
            </div>

            <!-- Progress Stats -->
            @if($task->files->count() > 0 || $task->comments->count() > 0)
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Activity Stats</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-700">Total Files:</span>
                            <span class="text-sm font-medium text-gray-900">{{ $task->files->count() }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-700">Total Comments:</span>
                            <span class="text-sm font-medium text-gray-900">{{ $task->comments->count() }}</span>
                        </div>
                        @if($task->files->count() > 0)
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-700">Last File:</span>
                                <span class="text-sm font-medium text-gray-900">
                                    {{ $task->files->sortByDesc('created_at')->first()->created_at->diffForHumans() }}
                                </span>
                            </div>
                        @endif
                        @if($task->comments->count() > 0)
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-700">Last Comment:</span>
                                <span class="text-sm font-medium text-gray-900">
                                    {{ $task->comments->sortByDesc('created_at')->first()->created_at->diffForHumans() }}
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection