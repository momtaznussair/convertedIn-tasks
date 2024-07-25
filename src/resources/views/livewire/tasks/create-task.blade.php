<div class="container mx-auto mt-10">
    <form wire:submit.prevent="save" class="space-y-6">
        <!-- Title -->
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input wire:model="form.title" type="text" id="title" name="title" class="input input-bordered w-full" placeholder="Enter title">
            @error('form.title') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea wire:model="form.description" id="description" name="description" class="textarea textarea-bordered w-full" rows="4" placeholder="Enter description"></textarea>
            @error('form.description') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
        </div>

        <!-- Admin Dropdown -->
        <div x-data="{ open: false }" @click.away="open = false" class="relative">
            <label for="admin" class="block text-sm font-medium text-gray-700">Admin</label>
            <input x-on:click="open = true" wire:model.live.debounce.250ms="adminSearch" type="text" id="admin" name="admin" class="input input-bordered w-full" placeholder="Search admin">
            @error('form.admin') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            <div x-show="open" class="absolute z-10 mt-2 w-full bg-white border border-gray-300 rounded-md shadow-lg">
                <ul>
                    @foreach($admins as $admin)
                        <li wire:click="selectAdmin({{ $admin->id }}, '{{ $admin->name }}')" x-on:click="open = false" class="cursor-pointer hover:bg-gray-100 p-2">{{ $admin->name }}</li>
                    @endforeach
                </ul>
                @if (count($admins) == 10)
                    <button wire:click.prevent="loadMoreAdmins" class="w-full text-center py-2 bg-gray-200 hover:bg-gray-300">Load More</button>
                @endif
            </div>
        </div>

        <!-- User Dropdown -->
        <div x-data="{ open: false }" @click.away="open = false" class="relative">
            <label for="user" class="block text-sm font-medium text-gray-700">User</label>
            <input x-on:click="open = true" wire:model.live.debounce.250ms="userSearch" type="text" id="user" name="user" class="input input-bordered w-full" placeholder="Search user">
            @error('form.user') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            <div x-show="open" class="absolute z-10 mt-2 w-full bg-white border border-gray-300 rounded-md shadow-lg">
                <ul>
                    @foreach($users as $user)
                        <li wire:click="selectUser({{ $user->id }}, '{{ $user->name }}')" x-on:click="open = false" class="cursor-pointer hover:bg-gray-100 p-2">{{ $user->name }}</li>
                    @endforeach
                </ul>
                @if (count($users) == 10)
                    <button wire:click.prevent="loadMoreUsers" class="w-full text-center py-2 bg-gray-200 hover:bg-gray-300">Load More</button>
                @endif
            </div>
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
