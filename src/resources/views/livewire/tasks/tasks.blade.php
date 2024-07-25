<div class="container mx-auto mt-10">
    <div class="overflow-x-auto">
        <table class="table table-zebra w-full">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Assigned User</th>
                    <th>Admin</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tasks as $task)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->assignee->name }}</td>
                        <td>{{ $task->assignor->name }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No tasks available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $tasks->links() }}
    </div>
</div>
