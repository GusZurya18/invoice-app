@extends('layouts.master')

@section('title', 'Tugas Kamu')

@section('page-title', 'Tugas Kamu')

@section('content')
<div class="min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold text-white">
                        Tugas Kamu
                    </h1>
                    <p class="mt-2 text-purple-100">Kelola dan pantau semua tugas yang diberikan kepadamu</p>
                </div>
                           {{-- Top Search and Notification --}}
            <div class="flex items-center gap-2 sm:gap-3 w-full sm:w-auto">
                <div class="relative flex-1 sm:flex-initial">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" id="searchInput"
                           class="w-full sm:w-64 lg:w-72 pl-10 pr-3 py-2 text-sm bg-white rounded-full border-0 focus:ring-2 focus:ring-white focus:ring-opacity-30 text-gray-900 placeholder-gray-500"
                           placeholder="Cari invoice...">
                </div>
            
            </div>
        </div>
            </div>
        </div>
        

        <!-- Stats Cards - 4 Cards in Row -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
            <!-- Total Tasks Card -->
            <div class="bg-white rounded-2xl p-6 shadow-md hover:shadow-lg transition-shadow">
                <div class="flex items-start justify-between mb-3">
                    <div class="bg-blue-500 p-3 rounded-xl">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ $tasks->total() }}</h3>
                <p class="text-sm text-gray-500 font-medium">Total Tugas</p>
                <p class="text-xs text-green-600 mt-2 flex items-center gap-1">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path>
                    </svg>
                    Semua task
                </p>
            </div>

            <!-- Pending Card -->
            <div class="bg-white rounded-2xl p-6 shadow-md hover:shadow-lg transition-shadow">
                <div class="flex items-start justify-between mb-3">
                    <div class="bg-orange-500 p-3 rounded-xl">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ $tasks->where('status', 'pending')->count() }}</h3>
                <p class="text-sm text-gray-500 font-medium">Pending</p>
                <p class="text-xs text-orange-600 mt-2 flex items-center gap-1">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    Menunggu dikerjakan
                </p>
            </div>

            <!-- In Progress Card -->
            <div class="bg-white rounded-2xl p-6 shadow-md hover:shadow-lg transition-shadow">
                <div class="flex items-start justify-between mb-3">
                    <div class="bg-blue-500 p-3 rounded-xl">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ $tasks->where('status', 'in_progress')->count() }}</h3>
                <p class="text-sm text-gray-500 font-medium">In Progress</p>
                <p class="text-xs text-blue-600 mt-2 flex items-center gap-1">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path>
                    </svg>
                    Sedang dikerjakan
                </p>
            </div>

            <!-- Done Card -->
            <div class="bg-white rounded-2xl p-6 shadow-md hover:shadow-lg transition-shadow">
                <div class="flex items-start justify-between mb-3">
                    <div class="bg-green-500 p-3 rounded-xl">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ $tasks->where('status', 'done')->count() }}</h3>
                <p class="text-sm text-gray-500 font-medium">Done</p>
                <p class="text-xs text-green-600 mt-2 flex items-center gap-1">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    Selesai dikerjakan
                </p>
            </div>
        </div>

        <!-- Tasks Container - White Background with Rounded Corners -->
        <div class="bg-white rounded-3xl shadow-xl p-8">
            <!-- Tasks Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-5">
                @foreach($tasks as $task)
                <div class="bg-gray-50 rounded-xl hover:shadow-md transition-all duration-300 border border-gray-200 overflow-hidden group hover:border-purple-200">
                    <div class="p-5">
                        <!-- Header -->
                        <div class="mb-4">
                            <h3 class="text-lg font-bold text-gray-800 group-hover:text-purple-600 transition-colors mb-2 line-clamp-1">
                                {{ $task->title }}
                            </h3>
                            
                            <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-xs">{{ $task->creator?->name }}</span>
                            </div>

                            <!-- Status & Deadline -->
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg font-medium text-xs {{ 
                                    $task->status == 'done' ? 'bg-green-100 text-green-700' : 
                                    ($task->status == 'in_progress' ? 'bg-blue-100 text-blue-700' : 
                                    'bg-orange-100 text-orange-700') 
                                }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ 
                                        $task->status == 'done' ? 'bg-green-500' : 
                                        ($task->status == 'in_progress' ? 'bg-blue-500' : 'bg-orange-500') 
                                    }}"></span>
                                    {{ $task->status == 'done' ? 'Done' : ($task->status == 'in_progress' ? 'In Progress' : 'Pending') }}
                                </span>

                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-purple-50 text-purple-700 text-xs font-medium">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $task->deadline?->format('d M Y') ?? 'No deadline' }}
                                </span>
                            </div>
                        </div>

                        <!-- Description -->
                        <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-2">
                            {{ Str::limit($task->description, 100) }}
                        </p>

                        <!-- Progress Bar for In Progress -->
                        @if($task->status == 'in_progress')
                        <div class="mb-4">
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-xs font-medium text-gray-500">Progress</span>
                                <span class="text-xs font-bold text-blue-600">60%</span>
                            </div>
                            <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-blue-500 to-purple-600 rounded-full" style="width: 60%"></div>
                            </div>
                        </div>
                        @endif

                        <!-- Actions -->
                        <div class="flex items-center gap-2">
                            <!-- Status Dropdown -->
                            <form action="{{ route('tasks.update.status', $task) }}" method="POST" class="flex-1">
                                @csrf
                                <select name="status" 
                                        onchange="this.form.submit()" 
                                        class="w-full px-3 py-2 text-sm rounded-lg border-2 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all cursor-pointer font-medium {{ 
                                            $task->status == 'done' ? 'text-green-700 bg-green-50 border-green-200' : 
                                            ($task->status == 'in_progress' ? 'text-blue-700 bg-blue-50 border-blue-200' : 
                                            'text-orange-700 bg-orange-50 border-orange-200') 
                                        }}">
                                    <option value="pending" {{ $task->status=='pending' ? 'selected':'' }}>Pending</option>
                                    <option value="in_progress" {{ $task->status=='in_progress' ? 'selected':'' }}>In Progress</option>
                                    <option value="done" {{ $task->status=='done' ? 'selected':'' }}>Done</option>
                                </select>
                            </form>

                            <!-- Detail Button -->
                            <a href="{{ route('tasks.show', $task) }}" 
                               class="inline-flex items-center justify-center p-2 bg-gradient-to-r from-purple-600 to-blue-600 text-white font-semibold rounded-lg hover:from-purple-700 hover:to-blue-700 transform hover:scale-105 transition-all shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Empty State -->
            @if($tasks->isEmpty())
            <div class="text-center py-16">
                <svg class="w-24 h-24 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="text-2xl font-bold text-gray-700 mb-2">Tidak Ada Tugas</h3>
                <p class="text-gray-500">Kamu belum memiliki tugas yang diberikan.</p>
            </div>
            @endif

            <!-- Pagination -->
            @if($tasks->hasPages())
            <div class="mt-8 pt-6 border-t border-gray-200">
                {{ $tasks->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection