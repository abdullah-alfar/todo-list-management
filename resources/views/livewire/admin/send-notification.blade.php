<div class="p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-bold mb-4">Send Notification</h2>
    <form wire:submit.prevent="send">
        <div class="mb-4">
            <label for="user" class="block text-sm font-medium text-gray-700">Select User</label>
            <select wire:model="selectedUserId" id="user"
                class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                <option value="">Select a user</option>
                @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
            <textarea wire:model="message" id="message"
                class="mt-1 block w-full p-2 border border-gray-300 rounded-md"></textarea>
        </div>
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
            Send Notification
        </button>
    </form>
    @if (session()->has('message'))
    <div class="mt-4 p-4 bg-green-100 text-green-700 rounded-md">
        {{ session('message') }}
    </div>
    @endif
</div>
