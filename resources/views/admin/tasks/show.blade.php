@extends('layouts.admin')

@section('content')
<div class="min-h-screen py-6 md:py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- White Container Background -->
        <div class="bg-white rounded-2xl md:rounded-3xl shadow-xl md:shadow-2xl p-4 md:p-8 mb-6">
        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-4 md:mb-6 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 p-3 md:p-4 rounded-lg shadow-sm animate-fadeIn">
                <div class="flex items-center">
                    <svg class="w-5 h-5 md:w-6 md:h-6 text-green-500 mr-2 md:mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-green-800 font-medium text-sm md:text-base">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Header Section -->
        <div class="mb-6 md:mb-8">
            <a href="{{ route('admin.tasks.index') }}" class="inline-flex items-center text-gray-700 hover:text-purple-600 transition-colors duration-200 mb-3 md:mb-4 group text-sm md:text-base">
                <svg class="w-4 h-4 md:w-5 md:h-5 mr-2 transform group-hover:-translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span class="font-medium">Back to Tasks</span>
            </a>
            
            <div class="flex flex-col gap-3 md:gap-4">
                <h1 class="text-2xl md:text-4xl font-bold bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">
                    Task Details
                </h1>
                <div class="flex flex-wrap gap-2 md:gap-3">
                    <a href="{{ route('admin.tasks.edit', $task) }}" 
                       class="inline-flex items-center justify-center bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white font-semibold px-4 md:px-6 py-2 md:py-3 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105 text-sm md:text-base">
                        <svg class="w-4 h-4 md:w-5 md:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit
                    </a>
                    <form action="{{ route('admin.tasks.destroy', $task) }}" method="POST" class="inline"
                          onsubmit="return confirm('Are you sure you want to delete this task?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center justify-center bg-gradient-to-r from-red-600 to-pink-600 hover:from-red-700 hover:to-pink-700 text-white font-semibold px-4 md:px-6 py-2 md:py-3 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105 text-sm md:text-base">
                            <svg class="w-4 h-4 md:w-5 md:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6">
            <!-- Left Column - Main Content -->
            <div class="lg:col-span-2 space-y-4 md:space-y-6">
                <!-- Task Card -->
                <div class="bg-white rounded-2xl md:rounded-3xl shadow-lg md:shadow-2xl overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-600 to-indigo-600 px-4 md:px-8 py-4 md:py-6">
                        <h2 class="text-lg md:text-2xl font-bold text-white mb-2 md:mb-3">{{ $task->title }}</h2>
                        <div class="flex flex-wrap gap-2 md:gap-3">
                            <span class="px-3 md:px-4 py-1.5 md:py-2 text-xs md:text-sm font-semibold rounded-full backdrop-blur-sm
                                @if($task->status == 'pending') bg-yellow-400/20 text-yellow-100 border border-yellow-300/30
                                @elseif($task->status == 'in_progress') bg-blue-400/20 text-blue-100 border border-blue-300/30
                                @elseif($task->status == 'done') bg-green-400/20 text-green-100 border border-green-300/30
                                @endif">
                                <svg class="w-3 h-3 md:w-4 md:h-4 inline-block mr-1 -mt-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                            </span>
                            <span class="px-3 md:px-4 py-1.5 md:py-2 text-xs md:text-sm font-semibold rounded-full backdrop-blur-sm
                                @if($task->priority == 'high') bg-red-400/20 text-red-100 border border-red-300/30
                                @elseif($task->priority == 'medium') bg-orange-400/20 text-orange-100 border border-orange-300/30
                                @else bg-green-400/20 text-green-100 border border-green-300/30
                                @endif">
                                <svg class="w-3 h-3 md:w-4 md:h-4 inline-block mr-1 -mt-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM14 11a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0v-1h-1a1 1 0 110-2h1v-1a1 1 0 011-1z"/>
                                </svg>
                                {{ ucfirst($task->priority) }}
                            </span>
                        </div>
                    </div>

                    <div class="p-4 md:p-8">
                        @if($task->description)
                            <div class="mb-6 md:mb-8">
                                <h3 class="text-base md:text-lg font-semibold text-gray-900 mb-2 md:mb-3 flex items-center">
                                    <svg class="w-4 h-4 md:w-5 md:h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                                    </svg>
                                    Description
                                </h3>
                                <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-4 md:p-6 rounded-xl md:rounded-2xl border border-gray-200">
                                    <p class="text-gray-700 leading-relaxed whitespace-pre-wrap text-sm md:text-base">{{ $task->description }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Files Section -->
                        <div class="mb-6 md:mb-8">
                            <h3 class="text-base md:text-lg font-semibold text-gray-900 mb-3 md:mb-4 flex items-center">
                                <svg class="w-4 h-4 md:w-5 md:h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                                Files
                                <span class="ml-2 px-2 md:px-3 py-0.5 md:py-1 bg-purple-100 text-purple-700 text-xs font-bold rounded-full">{{ $task->files->count() }}</span>
                            </h3>
                            
                            @if($task->files->count() > 0)
                                <div class="grid grid-cols-1 gap-3">
                                    @foreach($task->files as $file)
                                        <div class="bg-gradient-to-r from-blue-50 to-cyan-50 p-3 md:p-4 rounded-xl border border-blue-200 hover:shadow-lg transition-all duration-200">
                                            <div class="flex items-center justify-between gap-3">
                                                <div class="flex items-center space-x-3 flex-1 min-w-0">
                                                    <div class="flex-shrink-0">
                                                        @if(in_array($file->file_type, ['jpg', 'jpeg', 'png', 'gif']))
                                                            <div class="w-10 h-10 md:w-12 md:h-12 bg-gradient-to-br from-green-400 to-emerald-500 rounded-xl flex items-center justify-center shadow-lg">
                                                                <svg class="w-5 h-5 md:w-7 md:h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                                                </svg>
                                                            </div>
                                                        @elseif(in_array($file->file_type, ['pdf']))
                                                            <div class="w-10 h-10 md:w-12 md:h-12 bg-gradient-to-br from-red-400 to-pink-500 rounded-xl flex items-center justify-center shadow-lg">
                                                                <svg class="w-5 h-5 md:w-7 md:h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                                                                </svg>
                                                            </div>
                                                        @else
                                                            <div class="w-10 h-10 md:w-12 md:h-12 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-xl flex items-center justify-center shadow-lg">
                                                                <svg class="w-5 h-5 md:w-7 md:h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                                                                </svg>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="flex-1 min-w-0">
                                                        <p class="text-xs md:text-sm font-semibold text-gray-900 truncate">{{ $file->original_name ?? basename($file->file_path) }}</p>
                                                        <p class="text-xs text-gray-600 mt-0.5 md:mt-1">
                                                            <span class="font-medium">{{ Str::limit($file->user->name, 15) }}</span> • {{ $file->created_at->diffForHumans() }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="flex flex-col md:flex-row items-end md:items-center gap-1 md:gap-2">
                                                    <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank"
                                                       class="px-3 md:px-4 py-1.5 md:py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs md:text-sm font-medium rounded-lg transition-colors duration-200 flex items-center whitespace-nowrap">
                                                        <svg class="w-3 h-3 md:w-4 md:h-4 md:mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                        </svg>
                                                        <span class="hidden md:inline">View</span>
                                                    </a>
                                                    <form action="{{ route('admin.tasks.files.destroy', $file) }}" method="POST" class="inline"
                                                          onsubmit="return confirm('Are you sure?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="px-3 md:px-4 py-1.5 md:py-2 bg-red-600 hover:bg-red-700 text-white text-xs md:text-sm font-medium rounded-lg transition-colors duration-200 flex items-center whitespace-nowrap">
                                                            <svg class="w-3 h-3 md:w-4 md:h-4 md:mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                            </svg>
                                                            <span class="hidden md:inline">Delete</span>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-6 md:p-8 rounded-xl md:rounded-2xl border-2 border-dashed border-gray-300 text-center">
                                    <svg class="w-12 h-12 md:w-16 md:h-16 mx-auto text-gray-400 mb-2 md:mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="text-gray-500 font-medium text-sm md:text-base">No files attached</p>
                                </div>
                            @endif
                        </div>

                        <!-- Comments Section -->
                        <div>
                            <h3 class="text-base md:text-lg font-semibold text-gray-900 mb-3 md:mb-4 flex items-center">
                                <svg class="w-4 h-4 md:w-5 md:h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                                Comments
                                <span class="ml-2 px-2 md:px-3 py-0.5 md:py-1 bg-purple-100 text-purple-700 text-xs font-bold rounded-full">{{ $task->comments->count() }}</span>
                            </h3>

                            @if($task->comments->count() > 0)
                                <div class="space-y-3 md:space-y-4 mb-4 md:mb-6">
                                    @foreach($task->comments as $comment)
                                        <div class="bg-gradient-to-br from-green-50 to-emerald-50 p-4 md:p-5 rounded-xl md:rounded-2xl border border-green-200 hover:shadow-lg transition-all duration-200">
                                            <div class="flex justify-between items-start mb-2 md:mb-3 gap-2">
                                                <div class="flex items-center space-x-2 md:space-x-3 flex-1 min-w-0">
                                                    <div class="w-8 h-8 md:w-10 md:h-10 bg-gradient-to-br from-purple-500 to-indigo-500 rounded-full flex items-center justify-center shadow-lg flex-shrink-0">
                                                        <span class="text-white font-bold text-xs md:text-sm">{{ substr($comment->user->name, 0, 1) }}</span>
                                                    </div>
                                                    <div class="min-w-0 flex-1">
                                                        <h4 class="text-xs md:text-sm font-bold text-gray-900 truncate">{{ $comment->user->name }}</h4>
                                                        <p class="text-xs text-gray-600">
                                                            <span class="px-1.5 md:px-2 py-0.5 bg-purple-100 text-purple-700 rounded-full font-medium">
                                                                {{ $comment->user->role == 'admin' ? 'Admin' : 'User' }}
                                                            </span>
                                                            <span class="mx-1">•</span>
                                                            <span class="hidden sm:inline">{{ $comment->created_at->diffForHumans() }}</span>
                                                            <span class="sm:hidden">{{ $comment->created_at->format('d/m') }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                                @if(auth()->id() === $comment->user_id || auth()->user()->role === 'admin')
                                                    <form action="{{ route('admin.tasks.comments.destroy', $comment) }}" method="POST" class="inline"
                                                          onsubmit="return confirm('Delete comment?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-800 p-1.5 md:p-2 hover:bg-red-100 rounded-lg transition-colors duration-200 flex-shrink-0">
                                                            <svg class="w-3.5 h-3.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                            <p class="text-gray-700 text-xs md:text-sm leading-relaxed whitespace-pre-wrap ml-0 md:ml-13">{{ $comment->comment }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-6 md:p-8 rounded-xl md:rounded-2xl border-2 border-dashed border-gray-300 text-center mb-4 md:mb-6">
                                    <svg class="w-12 h-12 md:w-16 md:h-16 mx-auto text-gray-400 mb-2 md:mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                    <p class="text-gray-500 font-medium text-sm md:text-base">No comments yet</p>
                                </div>
                            @endif

                            <!-- Add Comment Form -->
                            <div class="bg-gradient-to-br from-blue-50 to-cyan-50 p-4 md:p-6 rounded-xl md:rounded-2xl border border-blue-200">
                                <h4 class="text-sm font-semibold text-gray-900 mb-3 md:mb-4 flex items-center">
                                    <svg class="w-4 h-4 md:w-5 md:h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    Add Comment
                                </h4>
                                <form action="{{ route('admin.tasks.comments.store', $task) }}" method="POST">
                                    @csrf
                                    <textarea name="comment" rows="3" 
                                              class="w-full px-3 md:px-4 py-2 md:py-3 text-sm md:text-base rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 resize-none @error('comment') border-red-500 @enderror" 
                                              placeholder="Write your comment..." required>{{ old('comment') }}</textarea>
                                    @error('comment')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <div class="mt-3 md:mt-4 flex justify-end">
                                        <button type="submit" 
                                                class="bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-semibold px-4 md:px-6 py-2 md:py-3 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center text-sm md:text-base">
                                            <svg class="w-4 h-4 md:w-5 md:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                            </svg>
                                            Send
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Sidebar -->
            <div class="space-y-4 md:space-y-6">
                <!-- Task Details Card -->
                <div class="bg-white rounded-2xl md:rounded-3xl shadow-lg md:shadow-2xl overflow-hidden">
                    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-4 md:px-6 py-3 md:py-4">
                        <h3 class="text-base md:text-lg font-bold text-white flex items-center">
                            <svg class="w-4 h-4 md:w-5 md:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Task Info
                        </h3>
                    </div>
                    <div class="p-4 md:p-6 space-y-3 md:space-y-4">
                        <div class="bg-gradient-to-br from-purple-50 to-indigo-50 p-3 md:p-4 rounded-xl border border-purple-200">
                            <span class="text-xs font-semibold text-purple-600 uppercase tracking-wide block mb-1.5 md:mb-2">Assigned To</span>
                            <p class="text-sm font-bold text-gray-900">{{ $task->assignee->name ?? 'Not assigned' }}</p>
                        </div>
                        <div class="bg-gradient-to-br from-blue-50 to-cyan-50 p-3 md:p-4 rounded-xl border border-blue-200">
                            <span class="text-xs font-semibold text-blue-600 uppercase tracking-wide block mb-1.5 md:mb-2">Created By</span>
                            <p class="text-sm font-bold text-gray-900">{{ $task->creator->name ?? 'Unknown' }}</p>
                        </div>
                        <div class="bg-gradient-to-br from-green-50 to-emerald-50 p-3 md:p-4 rounded-xl border border-green-200">
                            <span class="text-xs font-semibold text-green-600 uppercase tracking-wide block mb-1.5 md:mb-2">Start Date</span>
                            <p class="text-sm font-bold text-gray-900">{{ $task->start_date ? $task->start_date->format('d M Y') : 'No start date' }}</p>
                        </div>
                        <div class="bg-gradient-to-br from-orange-50 to-red-50 p-3 md:p-4 rounded-xl border border-orange-200">
                            <span class="text-xs font-semibold text-orange-600 uppercase tracking-wide block mb-1.5 md:mb-2">Deadline</span>
                            <p class="text-sm font-bold text-gray-900">{{ $task->deadline ? $task->deadline->format('d M Y') : 'No deadline' }}</p>
                        </div>
                        <div class="grid grid-cols-2 gap-2 md:gap-3">
                            <div class="bg-gradient-to-br from-gray-50 to-slate-50 p-2 md:p-3 rounded-xl border border-gray-200">
                                <span class="text-xs font-semibold text-gray-600 uppercase tracking-wide block mb-1">Created</span>
                                <p class="text-xs font-bold text-gray-900">{{ $task->created_at->format('d M Y') }}</p>
                                <p class="text-xs text-gray-600">{{ $task->created_at->format('H:i') }}</p>
                            </div>
                            <div class="bg-gradient-to-br from-gray-50 to-slate-50 p-2 md:p-3 rounded-xl border border-gray-200">
                                <span class="text-xs font-semibold text-gray-600 uppercase tracking-wide block mb-1">Updated</span>
                                <p class="text-xs font-bold text-gray-900">{{ $task->updated_at->format('d M Y') }}</p>
                                <p class="text-xs text-gray-600">{{ $task->updated_at->format('H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions Card -->
                <div class="bg-white rounded-2xl md:rounded-3xl shadow-lg md:shadow-2xl overflow-hidden">
                    <div class="bg-gradient-to-r from-green-600 to-emerald-600 px-4 md:px-6 py-3 md:py-4">
                        <h3 class="text-base md:text-lg font-bold text-white flex items-center">
                            <svg class="w-4 h-4 md:w-5 md:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            Quick Actions
                        </h3>
                    </div>
                    <div class="p-4 md:p-6 space-y-2 md:space-y-3">
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
                                <button type="submit" class="w-full bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-semibold px-3 md:px-4 py-2 md:py-3 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center justify-center text-sm md:text-base">
                                    <svg class="w-4 h-4 md:w-5 md:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Mark Complete
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
                                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white font-semibold px-3 md:px-4 py-2 md:py-3 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center justify-center text-sm md:text-base">
                                    <svg class="w-4 h-4 md:w-5 md:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Start Progress
                                </button>
                            </form>
                        @endif

                        <button onclick="window.print()" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold px-3 md:px-4 py-2 md:py-3 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center justify-center text-sm md:text-base">
                            <svg class="w-4 h-4 md:w-5 md:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                            </svg>
                            Print Task
                        </button>
                    </div>
                </div>

                <!-- Activity Stats Card -->
                @if($task->files->count() > 0 || $task->comments->count() > 0)
                    <div class="bg-white rounded-2xl md:rounded-3xl shadow-lg md:shadow-2xl overflow-hidden">
                        <div class="bg-gradient-to-r from-orange-600 to-red-600 px-4 md:px-6 py-3 md:py-4">
                            <h3 class="text-base md:text-lg font-bold text-white flex items-center">
                                <svg class="w-4 h-4 md:w-5 md:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                                Activity
                            </h3>
                        </div>
                        <div class="p-4 md:p-6 space-y-3 md:space-y-4">
                            <div class="flex justify-between items-center bg-gradient-to-r from-blue-50 to-cyan-50 p-3 md:p-4 rounded-xl border border-blue-200">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 md:w-10 md:h-10 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center mr-2 md:mr-3 shadow-lg">
                                        <svg class="w-4 h-4 md:w-5 md:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <span class="text-xs md:text-sm font-medium text-gray-700">Files</span>
                                </div>
                                <span class="text-xl md:text-2xl font-bold text-blue-600">{{ $task->files->count() }}</span>
                            </div>
                            <div class="flex justify-between items-center bg-gradient-to-r from-green-50 to-emerald-50 p-3 md:p-4 rounded-xl border border-green-200">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 md:w-10 md:h-10 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl flex items-center justify-center mr-2 md:mr-3 shadow-lg">
                                        <svg class="w-4 h-4 md:w-5 md:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                        </svg>
                                    </div>
                                    <span class="text-xs md:text-sm font-medium text-gray-700">Comments</span>
                                </div>
                                <span class="text-xl md:text-2xl font-bold text-green-600">{{ $task->comments->count() }}</span>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Progress Indicator -->
                <div class="bg-white rounded-2xl md:rounded-3xl shadow-lg md:shadow-2xl overflow-hidden">
                    <div class="bg-gradient-to-r from-cyan-600 to-blue-600 px-4 md:px-6 py-3 md:py-4">
                        <h3 class="text-base md:text-lg font-bold text-white flex items-center">
                            <svg class="w-4 h-4 md:w-5 md:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Progress
                        </h3>
                    </div>
                    <div class="p-4 md:p-6">
                        <div class="relative pt-1">
                            <div class="flex mb-2 items-center justify-between">
                                <div>
                                    <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-purple-600 bg-purple-200">
                                        @if($task->status == 'pending') Not Started
                                        @elseif($task->status == 'in_progress') In Progress
                                        @elseif($task->status == 'done') Completed
                                        @endif
                                    </span>
                                </div>
                                <div class="text-right">
                                    <span class="text-xs font-semibold inline-block text-purple-600">
                                        @if($task->status == 'pending') 0%
                                        @elseif($task->status == 'in_progress') 50%
                                        @elseif($task->status == 'done') 100%
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="overflow-hidden h-2 md:h-3 mb-4 text-xs flex rounded-full bg-purple-200">
                                <div style="width:
                                    @if($task->status == 'pending') 0%
                                    @elseif($task->status == 'in_progress') 50%
                                    @elseif($task->status == 'done') 100%
                                    @endif"
                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-gradient-to-r from-purple-600 to-indigo-600 transition-all duration-500">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Timeline -->
                        <div class="mt-4 md:mt-6 space-y-2 md:space-y-3">
                            <div class="flex items-center {{ $task->created_at ? 'text-green-600' : 'text-gray-400' }}">
                                <div class="w-6 h-6 md:w-8 md:h-8 rounded-full {{ $task->created_at ? 'bg-green-500' : 'bg-gray-300' }} flex items-center justify-center mr-2 md:mr-3">
                                    <svg class="w-3 h-3 md:w-4 md:h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-xs md:text-sm font-medium">Task Created</span>
                            </div>
                            <div class="flex items-center {{ $task->status != 'pending' ? 'text-green-600' : 'text-gray-400' }}">
                                <div class="w-6 h-6 md:w-8 md:h-8 rounded-full {{ $task->status != 'pending' ? 'bg-green-500' : 'bg-gray-300' }} flex items-center justify-center mr-2 md:mr-3">
                                    <svg class="w-3 h-3 md:w-4 md:h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-xs md:text-sm font-medium">Work Started</span>
                            </div>
                            <div class="flex items-center {{ $task->status == 'done' ? 'text-green-600' : 'text-gray-400' }}">
                                <div class="w-6 h-6 md:w-8 md:h-8 rounded-full {{ $task->status == 'done' ? 'bg-green-500' : 'bg-gray-300' }} flex items-center justify-center mr-2 md:mr-3">
                                    <svg class="w-3 h-3 md:w-4 md:h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="text-xs md:text-sm font-medium">Task Completed</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        </div>
        <!-- End White Container Background -->
    </div>
</div>

<!-- Custom Styles -->
<style>
/* Force sidebar hidden on mobile untuk halaman ini */
@media (max-width: 1024px) {
    .sidebar {
        transform: translateX(-100%) !important;
    }
    
    .sidebar.open {
        transform: translateX(0) !important;
    }
    
    /* Ensure overlay works */
    .mobile-overlay {
        display: none;
    }
    
    .mobile-overlay.open {
        display: block !important;
    }
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fadeIn {
    animation: fadeIn 0.5s ease-out;
}

/* Print Styles */
@media print {
    .no-print {
        display: none !important;
    }
    
    body {
        background: white;
    }
    
    .shadow-2xl, .shadow-lg {
        box-shadow: none !important;
    }
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(to bottom, #9333ea, #4f46e5);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(to bottom, #7e22ce, #4338ca);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Force check sidebar state on this page
    const sidebar = document.querySelector('.sidebar');
    const mobileOverlay = document.getElementById('mobileOverlay');
    
    // Ensure sidebar is closed on page load for mobile
    if (window.innerWidth <= 1024) {
        if (sidebar) {
            sidebar.classList.remove('open');
        }
        if (mobileOverlay) {
            mobileOverlay.classList.remove('open');
        }
        document.body.style.overflow = '';
    }
    
    // Auto-resize comment textarea
    const commentTextarea = document.querySelector('textarea[name="comment"]');
    if (commentTextarea) {
        commentTextarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
    }
});
</script>
@endsection