<div class="p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-bold mb-4">Task Management</h2>
    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="py-2">Title</th>
                <th class="py-2">Description</th>
                <th class="py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
            <tr>
                <td class="py-2">{{ $task->title }}</td>
                <td class="py-2">{{ $task->description }}</td>
                <td class="py-2">
                    <button wire:click="deleteTask({{ $task->id }})" class="text-red-500 hover:text-red-700">
                        Delete
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
