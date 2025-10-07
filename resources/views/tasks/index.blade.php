<x-app-layout>
<x-slot name="header">
<h2>Tugas Saya</h2>
</x-slot>
<div class="max-w-4xl mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Tugas Kamu</h1>

    <div class="grid grid-cols-1 gap-4">
    @foreach($tasks as $task)
        <div class="bg-white p-4 rounded shadow">
            <div class="flex justify-between">
                <div>
                    <h3 class="font-bold">{{ $task->title }}</h3>
                    <p class="text-sm text-gray-600">Dari: {{ $task->creator?->name }}</p>
                </div>
                <div class="text-right">
                    <div class="text-sm">{{ $task->deadline?->format('Y-m-d') ?? '-' }}</div>
                    <div class="mt-2 font-semibold">{{ ucfirst(str_replace('_',' ',$task->status)) }}</div>
                </div>
            </div>

            <p class="mt-2">{{ Str::limit($task->description, 200) }}</p>

            <div class="mt-3 flex gap-2">
                <a href="{{ route('tasks.show', $task) }}" class="px-3 py-1 bg-blue-600 text-white rounded">Detail</a>

                <form action="{{ route('tasks.update.status', $task) }}" method="POST">
                    @csrf
                    <select name="status" onchange="this.form.submit()" class="border p-1 rounded">
                        <option value="pending" {{ $task->status=='pending' ? 'selected':'' }}>Pending</option>
                        <option value="in_progress" {{ $task->status=='in_progress' ? 'selected':'' }}>In Progress</option>
                        <option value="done" {{ $task->status=='done' ? 'selected':'' }}>Done</option>
                    </select>
                </form>
            </div>
        </div>
    @endforeach
    </div>

    <div class="mt-4">{{ $tasks->links() }}</div>
</div>
</x-app-layout>
