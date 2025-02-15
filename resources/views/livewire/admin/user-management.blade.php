<div class="p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-bold mb-4">User Management</h2>
    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="py-2">Name</th>
                <th class="py-2">Email</th>
                <th class="py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td class="py-2">{{ $user->name }}</td>
                <td class="py-2">{{ $user->email }}</td>
                <td class="py-2">
                    <button wire:click="deleteUser({{ $user->id }})" class="text-red-500 hover:text-red-700">
                        Delete
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
