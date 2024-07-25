<div class="navbar bg-base-100">

    <div class="navbar-start">

        <div class="dropdown">
            <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                </svg>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                @if (request()->route()->getName() !== 'tasks.list')
                    <li><a href="{{ route('tasks.list') }}">Task List</a></li>
                @endif

                @if (request()->route()->getName() !== 'tasks.create')
                    <li><a href="{{ route('tasks.create') }}">Create New Task</a></li>
                @endif

                @if (request()->route()->getName() !== 'tasks.statistics')
                    <li><a href="{{ route('tasks.statistics') }}">Statistcs</a></li>
                @endif
            </ul>

        </div>

        <a href="{{ route('tasks.list') }}" class="btn btn-ghost text-xl">ConvertedIn Tasks</a>
    </div>

    @if (request()->route()->getName() == 'tasks.list')
    <div class="navbar-center hidden lg:flex">
        <a href="{{ route('tasks.statistics') }}" class="btn btn-ghost text-l">Statistics</a>
    </div>
    @endif

    @if (request()->route()->getName() !== 'tasks.create')
    <div class="navbar-end">
        <a href="{{ route('tasks.create') }}" class="btn">Create New Task</a>
    </div>
    @else
    <div class="navbar-end hidden lg:flex">
        <a href="{{ route('tasks.statistics') }}" class="btn btn-ghost text-xl">Statistics</a>
    </div>
    @endif
    
</div>
