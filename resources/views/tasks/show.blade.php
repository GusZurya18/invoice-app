@extends('layouts.master')

@section('title', 'Task Detail')

@section('page-title', 'Task Detail')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-white to-blue-50 py-8 px-4">
    <div class="max-w-6xl mx-auto">
        
        @if(session('success'))
            <div class="bg-gradient-to-r from-green-500 to-emerald-500 text-white px-6 py-4 rounded-2xl mb-6 shadow-lg animate-fade-in flex items-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Back Button -->
        <a href="{{ route('tasks.my') }}" class="inline-flex items-center gap-2 text-purple-600 hover:text-purple-700 font-medium mb-6 group transition-all">
            <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali ke Task List
        </a>

        <!-- Main Content Grid -->
        <div class="grid lg:grid-cols-3 gap-6">
            
            <!-- Left Column - Task Details -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Task Header Card -->
                <div class="bg-white rounded-3xl shadow-xl p-8 border border-purple-100 hover:shadow-2xl transition-shadow">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <div class="mb-3">
                                <h1 class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent">
                                    {{ $task->title }}
                                </h1>
                            </div>
                            <div class="flex items-center gap-2 text-gray-600">
                                <span class="text-sm font-medium">Dibuat oleh:</span>
                                <span class="text-sm font-semibold text-purple-600">{{ $task->creator?->name }}</span>
                            </div>
                        </div>
                        <div class="bg-gradient-to-br from-purple-100 to-blue-100 rounded-2xl px-4 py-2 h-fit">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Task Timeline & Priority -->
                    <div class="grid sm:grid-cols-3 gap-4 mb-6">
                        <!-- Start Date -->
                        <div class="bg-gradient-to-br from-blue-50 to-cyan-50 p-4 rounded-xl border border-blue-200">
                            <div class="flex items-center gap-2 mb-2">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-xs font-semibold text-blue-600 uppercase">Mulai</span>
                            </div>
                            <p class="text-sm font-bold text-gray-800">{{ \Carbon\Carbon::parse($task->start_date)->format('d M Y') }}</p>
                        </div>

                        <!-- Due Date -->
                        <div class="bg-gradient-to-br from-orange-50 to-red-50 p-4 rounded-xl border border-orange-200">
                            <div class="flex items-center gap-2 mb-2">
                                <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-xs font-semibold text-orange-600 uppercase">Deadline</span>
                            </div>
                            <p class="text-sm font-bold text-gray-800">{{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}</p>
                        </div>

                        <!-- Priority -->
                        <div class="
                            @php
                                $priorityBg = match($task->priority) {
                                    'High' => 'from-red-50 to-pink-50 border-red-200',
                                    'Medium' => 'from-yellow-50 to-amber-50 border-yellow-200',
                                    'Low' => 'from-green-50 to-emerald-50 border-green-200',
                                    default => 'from-gray-50 to-slate-50 border-gray-200',
                                };
                            @endphp
                            bg-gradient-to-br {{ $priorityBg }} p-4 rounded-xl border">
                            <div class="flex items-center gap-2 mb-2">
                                <svg class="w-5 h-5 
                                    @php
                                        $priorityColor = match($task->priority) {
                                            'High' => 'text-red-600',
                                            'Medium' => 'text-yellow-600',
                                            'Low' => 'text-green-600',
                                            default => 'text-gray-600',
                                        };
                                    @endphp
                                    {{ $priorityColor }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                <span class="text-xs font-semibold {{ $priorityColor }} uppercase">Prioritas</span>
                            </div>
                            <p class="text-sm font-bold {{ $priorityColor }}">{{ ucfirst($task->priority) }}</p>
                        </div>
                    </div>

                    <div class="p-6 bg-gradient-to-br from-purple-50 to-blue-50 rounded-2xl border border-purple-100">
                        <div>
                            <h3 class="font-semibold text-gray-800 mb-2">Deskripsi Task</h3>
                            <p class="text-gray-700 leading-relaxed">{{ $task->description }}</p>
                        </div>
                    </div>
                </div>

                <!-- Files Section -->
                <div class="bg-white rounded-3xl shadow-xl p-8 border border-purple-100">
                    <div class="flex items-center gap-3 mb-6">
                        <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                        </svg>
                        <h2 class="text-2xl font-bold text-gray-800">Files & Attachments</h2>
                    </div>

                    @if($task->files->count() > 0)
                        <div class="grid sm:grid-cols-2 gap-4 mb-6">
                            @foreach($task->files as $f)
                                <div class="group relative bg-gradient-to-br from-purple-50 to-blue-50 p-4 rounded-xl border border-purple-200 hover:shadow-lg transition-all hover:scale-[1.02]">
                                    <div class="flex items-start gap-3">
                                        <svg class="w-6 h-6 text-purple-600 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg>
                                        <div class="flex-1 min-w-0">
                                            <a target="_blank" href="{{ asset('storage/'.$f->file_path) }}" class="text-purple-600 hover:text-purple-700 font-medium text-sm block truncate">
                                                {{ basename($f->file_path) }}
                                            </a>
                                            <form action="{{ route('tasks.files.destroy', $f) }}" method="POST" class="mt-2">
                                                @csrf @method('DELETE')
                                                <button class="text-red-500 hover:text-red-600 text-xs font-medium flex items-center gap-1 transition-colors" onclick="return confirm('Hapus file ini?')">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-400">
                            <svg class="w-16 h-16 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-sm font-medium">Belum ada file yang diupload</p>
                        </div>
                    @endif

                    <!-- Upload Form -->
                    <div class="bg-gradient-to-br from-purple-100 to-blue-100 p-6 rounded-2xl border-2 border-dashed border-purple-300">
                        <form action="{{ route('tasks.files.store', $task) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            <div class="flex items-center gap-3">
                                <svg class="w-6 h-6 text-purple-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                <label class="flex-1">
                                    <input type="file" name="file" required class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-600 file:text-white hover:file:bg-purple-700 file:cursor-pointer cursor-pointer">
                                </label>
                            </div>
                            <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                Upload File
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Comments Section -->
                <div class="bg-white rounded-3xl shadow-xl p-8 border border-purple-100">
                    <div class="flex items-center gap-3 mb-6">
                        <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        <h2 class="text-2xl font-bold text-gray-800">Komentar</h2>
                        <span class="ml-auto bg-purple-100 text-purple-600 text-sm font-semibold px-3 py-1 rounded-full">
                            {{ $task->comments->count() }}
                        </span>
                    </div>

                    <!-- Comments List -->
                    <div class="space-y-4 mb-6 max-h-[500px] overflow-y-auto pr-2 custom-scrollbar">
                        @forelse($task->comments as $c)
                            <div class="bg-gradient-to-br from-purple-50 to-blue-50 p-5 rounded-2xl border border-purple-100 hover:shadow-md transition-shadow">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-blue-500 rounded-full flex items-center justify-center text-white font-bold">
                                            {{ strtoupper(substr($c->user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-2">
                                                <span class="font-semibold text-gray-800">{{ $c->user->name }}</span>
                                                <span class="text-xs px-2 py-1 rounded-full font-medium {{ $c->user->role == 'admin' ? 'bg-red-100 text-red-600' : 'bg-blue-100 text-blue-600' }}">
                                                    {{ $c->user->role == 'admin' ? 'Admin' : 'User' }}
                                                </span>
                                            </div>
                                            <span class="text-xs text-gray-500 flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                {{ $c->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    @if(auth()->id() === $c->user_id)
                                        <form action="{{ route('tasks.comments.destroy', $c) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus komentar ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-600 transition-colors p-2 hover:bg-red-50 rounded-lg">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                                <p class="text-gray-700 leading-relaxed ml-13">{{ $c->comment }}</p>
                            </div>
                        @empty
                            <div class="text-center py-12 text-gray-400">
                                <svg class="w-20 h-20 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                <p class="font-medium">Belum ada komentar</p>
                                <p class="text-sm">Jadilah yang pertama berkomentar!</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Comment Form -->
                    <form action="{{ route('tasks.comments.store', $task) }}" method="POST" class="bg-gradient-to-br from-purple-100 to-blue-100 p-6 rounded-2xl border border-purple-200">
                        @csrf
                        <div class="mb-4">
                            <textarea name="comment" rows="3" class="w-full border-2 border-purple-200 p-4 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all resize-none" placeholder="Tulis komentar Anda..." required></textarea>
                        </div>
                        @error('comment')
                            <p class="text-red-600 text-sm mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                        <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            Kirim Komentar
                        </button>
                    </form>
                </div>

            </div>

            <!-- Right Column - Info Card -->
            <div class="lg:col-span-1">
                <div class="bg-gradient-to-br from-purple-600 to-blue-600 rounded-3xl shadow-xl p-8 text-white sticky top-6">
                    <div class="text-center mb-6">
                        <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-2">Task Info</h3>
                        <p class="text-purple-100 text-sm">Detail informasi task</p>
                    </div>

                    <div class="space-y-4">
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4">
                            <div class="flex items-center gap-3 mb-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-sm font-medium text-purple-100">Total Files</span>
                            </div>
                            <p class="text-3xl font-bold ml-9">{{ $task->files->count() }}</p>
                        </div>

                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4">
                            <div class="flex items-center gap-3 mb-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                <span class="text-sm font-medium text-purple-100">Total Komentar</span>
                            </div>
                            <p class="text-3xl font-bold ml-9">{{ $task->comments->count() }}</p>
                        </div>

                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4">
                            <div class="flex items-center gap-3 mb-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-sm font-medium text-purple-100">Dibuat</span>
                            </div>
                            <p class="text-sm font-semibold ml-9">{{ $task->created_at->format('d M Y') }}</p>
                        </div>
                    </div>

                    <div class="mt-6 pt-6 border-t border-white/20">
                        <p class="text-center text-sm text-purple-100">
                            Kolaborasi dan kelola task Anda dengan efisien
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fade-in 0.5s ease-out;
}

.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: #f3f4f6;
    border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: linear-gradient(to bottom, #9333ea, #3b82f6);
    border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(to bottom, #7c3aed, #2563eb);
}
</style>
@endsection