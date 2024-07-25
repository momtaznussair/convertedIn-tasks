<div class="container mx-auto py-6">
    <h2 class="text-2xl font-semibold text-gray-700 mb-6">Top 10 Users by Task Count</h2>
    <div class="overflow-x-auto">
        <table class="table w-full bg-white shadow-md rounded-lg">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-4">Rank</th>
                    <th class="p-4">User Name</th>
                    <th class="p-4">Task Count</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $index => $user)
                    <tr>
                        <td class="p-4">{{ $index + 1 }}</td>
                        <td class="p-4">{{ $user->name }}</td>
                        <td class="p-4">{{ $user->tasks_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
