@extends('layouts.admin')

@section('content')
<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <!-- Main Card -->
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
            <!-- Header with Back Button -->
            <div class="px-8 pt-8 pb-6">
                <a href="{{ route('admin.tasks.index') }}" class="inline-flex items-center text-gray-700 hover:text-gray-900 transition-colors duration-200 mb-6">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span class="font-medium">Back</span>
                </a>
                <h1 class="text-3xl font-bold text-purple-600 text-center">Edit Task</h1>
            </div>

            <!-- Form Content -->
            <form action="{{ route('admin.tasks.update', $task) }}" method="POST" id="taskForm" class="px-8 pb-8">
                @csrf
                @method('PUT')
               
                <!-- Task Title -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                        Task Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           name="title"
                           id="title"
                           placeholder="Enter Task Title"
                           class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 @error('title') border-red-500 @enderror"
                           value="{{ old('title', $task->title) }}"
                           required>
                    @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Task Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                        Task Description
                    </label>
                    <textarea name="description"
                              id="description"
                              rows="4"
                              placeholder="Enter Task Description"
                              class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 resize-none @error('description') border-red-500 @enderror">{{ old('description', $task->description) }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Assigned To -->
                <div class="mb-6">
                    <label for="user_id" class="block text-sm font-semibold text-gray-700 mb-2">
                        Assigned To <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <select name="user_id"
                                id="user_id"
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 appearance-none bg-white @error('user_id') border-red-500 @enderror">
                            <option value="">-- Select User --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id', $task->user_id) == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>
                    @error('user_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Priority and Status Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Priority -->
                    <div>
                        <label for="priority" class="block text-sm font-semibold text-gray-700 mb-2">
                            Priority <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select name="priority"
                                    id="priority"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 appearance-none bg-white @error('priority') border-red-500 @enderror"
                                    required>
                                <option value="low" {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}>High</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                        @error('priority')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select name="status"
                                    id="status"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 appearance-none bg-white @error('status') border-red-500 @enderror"
                                    required>
                                <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="done" {{ old('status', $task->status) == 'done' ? 'selected' : '' }}>Done</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                        @error('status')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Start Date and Deadline Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Start Date -->
                    <div>
                        <label for="start_date" class="block text-sm font-semibold text-gray-700 mb-2">
                            Start Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date"
                               name="start_date"
                               id="start_date"
                               class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 @error('start_date') border-red-500 @enderror"
                               value="{{ old('start_date', $task->start_date?->format('Y-m-d')) }}">
                        @error('start_date')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deadline -->
                    <div>
                        <label for="deadline" class="block text-sm font-semibold text-gray-700 mb-2">
                            Deadline <span class="text-red-500">*</span>
                        </label>
                        <input type="date"
                               name="deadline"
                               id="deadline"
                               class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 @error('deadline') border-red-500 @enderror"
                               value="{{ old('deadline', $task->deadline?->format('Y-m-d')) }}">
                        @error('deadline')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Task Info -->
                <div class="mt-8 bg-gradient-to-r from-purple-50 to-indigo-50 p-6 rounded-2xl border border-purple-100">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Task Information
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                        <div class="bg-white p-3 rounded-xl">
                            <span class="font-medium text-gray-600 block mb-1">Created by:</span>
                            <p class="text-gray-900 font-semibold">{{ $task->creator->name ?? 'Unknown' }}</p>
                        </div>
                        <div class="bg-white p-3 rounded-xl">
                            <span class="font-medium text-gray-600 block mb-1">Created on:</span>
                            <p class="text-gray-900 font-semibold">{{ $task->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="bg-white p-3 rounded-xl">
                            <span class="font-medium text-gray-600 block mb-1">Last updated:</span>
                            <p class="text-gray-900 font-semibold">{{ $task->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Files and Comments Preview -->
                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Files -->
                    <div class="bg-gradient-to-br from-blue-50 to-cyan-50 p-5 rounded-2xl border border-blue-100">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                            Files ({{ $task->files->count() }})
                        </h3>
                        @if($task->files->count() > 0)
                            <ul class="space-y-2">
                                @foreach($task->files->take(3) as $file)
                                    <li class="flex items-center justify-between bg-white p-3 rounded-xl shadow-sm">
                                        <span class="text-sm text-gray-700 truncate flex-1">{{ $file->original_name ?? basename($file->file_path) }}</span>
                                        <span class="text-xs text-gray-500 ml-2">{{ $file->created_at->diffForHumans() }}</span>
                                    </li>
                                @endforeach
                                @if($task->files->count() > 3)
                                    <li class="text-sm text-gray-500 text-center">... and {{ $task->files->count() - 3 }} more files</li>
                                @endif
                            </ul>
                        @else
                            <p class="text-sm text-gray-500 text-center py-4">No files yet</p>
                        @endif
                    </div>

                    <!-- Comments -->
                    <div class="bg-gradient-to-br from-green-50 to-emerald-50 p-5 rounded-2xl border border-green-100">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            Comments ({{ $task->comments->count() }})
                        </h3>
                        @if($task->comments->count() > 0)
                            <div class="space-y-2">
                                @foreach($task->comments->take(3) as $comment)
                                    <div class="bg-white p-3 rounded-xl shadow-sm">
                                        <div class="flex justify-between items-start mb-1">
                                            <span class="text-sm font-medium text-gray-700">{{ $comment->user->name }}</span>
                                            <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-sm text-gray-600">{{ Str::limit($comment->content, 60) }}</p>
                                    </div>
                                @endforeach
                                @if($task->comments->count() > 3)
                                    <p class="text-sm text-gray-500 text-center">... and {{ $task->comments->count() - 3 }} more comments</p>
                                @endif
                            </div>
                        @else
                            <p class="text-sm text-gray-500 text-center py-4">No comments yet</p>
                        @endif
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 mt-8">
                    <button type="submit"
                            class="flex-1 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                        Update Task
                    </button>
                    <a href="{{ route('admin.tasks.show', $task) }}"
                       class="flex-1 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-semibold py-3 px-6 rounded-xl text-center transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                        View Details
                    </a>
                    <a href="{{ route('admin.tasks.index') }}"
                       class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-3 px-6 rounded-xl text-center transition-all duration-200">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript for Form Enhancement -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('taskForm');
    const startDateInput = document.getElementById('start_date');
    const deadlineInput = document.getElementById('deadline');
   
    // Form validation
    form.addEventListener('submit', function(e) {
        const title = document.getElementById('title').value.trim();
       
        if (title.length < 3) {
            e.preventDefault();
            alert('Task title must be at least 3 characters');
            return false;
        }
       
        // Validate date logic
        if (startDateInput.value && deadlineInput.value) {
            const startDate = new Date(startDateInput.value);
            const deadline = new Date(deadlineInput.value);
           
            if (deadline < startDate) {
                e.preventDefault();
                alert('Deadline cannot be earlier than start date');
                return false;
            }
        }
       
        // Add loading state to submit button
        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<svg class="animate-spin h-5 w-5 mr-2 inline-block" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Updating...';
    });
   
    // Auto-resize textarea
    const textarea = document.getElementById('description');
    textarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });
   
    // Add smooth focus effects
    const inputs = form.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.classList.add('scale-102');
        });
       
        input.addEventListener('blur', function() {
            this.classList.remove('scale-102');
        });
    });
});
</script>

<style>
/* Custom animations */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fadeIn {
    animation: fadeIn 0.5s ease-out;
}

/* Custom scrollbar for textarea */
textarea::-webkit-scrollbar {
    width: 6px;
}

textarea::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

textarea::-webkit-scrollbar-thumb {
    background: #c4b5fd;
    border-radius: 10px;
}

textarea::-webkit-scrollbar-thumb:hover {
    background: #a78bfa;
}

/* Date input styling */
input[type="date"]::-webkit-calendar-picker-indicator {
    cursor: pointer;
    filter: opacity(0.5);
    transition: filter 0.2s;
}

input[type="date"]::-webkit-calendar-picker-indicator:hover {
    filter: opacity(1);
}

/* Scale effect */
.scale-102 {
    transform: scale(1.01);
    transition: transform 0.2s ease;
}
</style>

@endsection