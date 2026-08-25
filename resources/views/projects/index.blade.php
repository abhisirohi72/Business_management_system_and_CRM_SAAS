@extends('layouts.app')

@section('content')

<style>
    /* .projects-page {
        padding: 30px;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .page-header h1 {
        margin: 0 0 5px;
        font-size: 26px;
    }

    .page-header p {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
    }

    .btn-primary {
        display: inline-block;
        padding: 10px 16px;
        background: #2563eb;
        color: #fff;
        border: none;
        border-radius: 7px;
        text-decoration: none;
        cursor: pointer;
        font-size: 14px;
    }

    .table-card {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
        overflow: hidden;
    }

    .projects-table {
        width: 100%;
        border-collapse: collapse;
    }

    .projects-table th,
    .projects-table td {
        padding: 14px 16px;
        text-align: left;
        border-bottom: 1px solid #e5e7eb;
        font-size: 14px;
    }

    .projects-table th {
        background: #f9fafb;
        font-weight: 600;
        color: #374151;
    }

    .projects-table td {
        color: #4b5563;
    }

    .projects-table tr:last-child td {
        border-bottom: none;
    }

    .badge {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-pending {
        background: #fef3c7;
        color: #92400e;
    }

    .status-in-progress {
        background: #dbeafe;
        color: #1e40af;
    }

    .status-completed {
        background: #dcfce7;
        color: #166534;
    }

    .status-cancelled {
        background: #fee2e2;
        color: #991b1b;
    }



    .actions {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .btn-edit {
        padding: 7px 11px;
        background: #eff6ff;
        color: #1d4ed8;
        border-radius: 6px;
        text-decoration: none;
        font-size: 13px;
    }

    .btn-delete {
        padding: 7px 11px;
        background: #fef2f2;
        color: #dc2626;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 13px;
    }

    .empty-state {
        padding: 50px 20px;
        text-align: center;
        color: #6b7280;
    }

    .success-message {
        margin-bottom: 20px;
        padding: 12px 16px;
        background: #dcfce7;
        color: #166534;
        border-radius: 7px;
        font-size: 14px;
    } */
</style>


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