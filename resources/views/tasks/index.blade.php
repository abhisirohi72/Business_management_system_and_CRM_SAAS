@extends('layouts.app')

@section('content')

<div class="tasks-page">

    {{-- Header --}}
    <div class="page-header">

        <div>
            <h1>Tasks</h1>
            <p>Manage all your company tasks.</p>
        </div>

        <a href="{{ route('tasks.create') }}" class="add-btn">
            + Add Task
        </a>

    </div>

    {{-- Tasks Table --}}
    <div class="table-card">

        @if($tasks->count())

            <table class="tasks-table">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Company Name</th>
                        <th>Project Name</th>
                        <th>Assigned To</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Priority</th>
                        <th>Start Date</th>
                        <th>Due Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($tasks as $task)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                <strong>
                                    {{ $task->project->name ?? '-' }}
                                </strong>
                            </td>

                            <td>
                                {{ $task->user->name ?? '-' }}
                            </td>

                            <td>
                                {{ $task->name ?? '-' }}
                            </td>

                            <td>

                                <span class="badge status-{{ str_replace('_', '-', $task->status) }}">
                                    {{ ucwords(str_replace('_', ' ', $task->status)) }}
                                </span>

                            </td>

                            <td>

                                <span class="badge priority-{{ $task->priority }}">
                                    {{ ucfirst($task->priority) }}
                                </span>

                            </td>

                            <td>
                                {{ $task->start_date
                                    ? \Carbon\Carbon::parse($task->start_date)->format('d M Y')
                                    : '-' }}
                            </td>

                            <td>
                                {{ $task->due_date
                                    ? \Carbon\Carbon::parse($task->due_date)->format('d M Y')
                                    : '-' }}
                            </td>


                            <td class="actions">
                                    <a
                                        href="{{ route('tasks.show', $task) }}"
                                        class="view-btn"
                                    >
                                        View
                                    </a>
                                    <a
                                        href="{{ route('tasks.edit', $task) }}"
                                        class="edit-btn"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('tasks.destroy', $task) }}"
                                        method="POST"
                                        style="display:inline;"
                                        onsubmit="return confirm('Are you sure you want to delete this task?');"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="delete-btn"
                                        >
                                            Delete
                                        </button>

                                    </form>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>
            @if($tasks->hasPages())
                <div style="padding: 20px;">
                    {{ $tasks->links() }}
                </div>
            @endif
        @else

            <div class="empty-state">

                <h3>No Tasks Found</h3>

                <p>
                    You haven't created any tasks yet.
                </p>

                <a
                    href="{{ route('tasks.create') }}"
                    class="btn-primary"
                >
                    + Create First Task
                </a>

            </div>
            
        @endif

    </div>

</div>

@endsection