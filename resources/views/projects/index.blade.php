@extends('layouts.app')

@section('content')

<div class="projects-page">

    {{-- Header --}}
    <div class="page-header">

        <div>
            <h1>Projects</h1>
            <p>Manage all your company projects.</p>
        </div>

        <a href="{{ route('projects.create') }}" class="add-btn">
            + Add Project
        </a>

    </div>

    {{-- Projects Table --}}
    <div class="table-card">

        @if($projects->count())

            <table class="projects-table">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Project</th>
                        <th>Client</th>
                        <th>Status</th>
                        <th>Priority</th>
                        <th>Start Date</th>
                        <th>Due Date</th>
                        <th>Budget</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($projects as $project)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                <strong>
                                    {{ $project->name }}
                                </strong>
                            </td>

                            <td>
                                {{ $project->client->name ?? '-' }}
                            </td>

                            <td>

                                <span class="badge status-{{ str_replace('_', '-', $project->status) }}">
                                    {{ ucwords(str_replace('_', ' ', $project->status)) }}
                                </span>

                            </td>

                            <td>

                                <span class="badge priority-{{ $project->priority }}">
                                    {{ ucfirst($project->priority) }}
                                </span>

                            </td>

                            <td>
                                {{ $project->start_date
                                    ? \Carbon\Carbon::parse($project->start_date)->format('d M Y')
                                    : '-' }}
                            </td>

                            <td>
                                {{ $project->due_date
                                    ? \Carbon\Carbon::parse($project->due_date)->format('d M Y')
                                    : '-' }}
                            </td>

                            <td>
                                {{ $project->budget !== null
                                    ? number_format($project->budget, 2)
                                    : '-' }}
                            </td>

                            <td class="actions">

                                    <a
                                        href="{{ route('projects.edit', $project) }}"
                                        class="edit-btn"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('projects.destroy', $project) }}"
                                        method="POST"
                                        style="display:inline;"
                                        onsubmit="return confirm('Are you sure you want to delete this project?');"
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
            @if($projects->hasPages())
                <div style="padding: 20px;">
                    {{ $projects->links() }}
                </div>
            @endif
        @else

            <div class="empty-state">

                <h3>No Projects Found</h3>

                <p>
                    You haven't created any projects yet.
                </p>

                <a
                    href="{{ route('projects.create') }}"
                    class="btn-primary"
                >
                    + Create First Project
                </a>

            </div>
            
        @endif

    </div>

</div>

@endsection