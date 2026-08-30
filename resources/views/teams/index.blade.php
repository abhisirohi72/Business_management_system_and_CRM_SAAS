@extends('layouts.app')

@section('title','View team')

@section('page-title','View team')

@section('content')

<div class="teams-page">

    {{-- Header --}}
    <div class="page-header">

        <div>
            <h1>Teams</h1>
            <p>Manage all your company teams.</p>
        </div>

        <a href="{{ route('teams.create') }}" class="add-btn">
            + Add team
        </a>

    </div>

    {{-- teams Table --}}
    <div class="table-card">

        @if($teams->count())

            <table>

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

                    @foreach($teams as $team)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                <strong>
                                    {{ $team->company->name ?? '-' }}
                                </strong>
                            </td>

                            <td>
                                <strong>
                                    {{ $team->project->name ?? '-' }}
                                </strong>
                            </td>

                            <td>
                                {{ $team->assignedTo->email ?? '-' }}
                            </td>

                            <td>
                                {{ $team->title ?? '-' }}
                            </td>

                            <td>

                                <span class="badge status-{{ str_replace('_', '-', $team->status) }}">
                                    {{ ucwords(str_replace('_', ' ', $team->status)) }}
                                </span>

                            </td>

                            <td>

                                <span class="badge priority-{{ $team->priority }}">
                                    {{ ucfirst($team->priority) }}
                                </span>

                            </td>

                            <td>
                                {{ $team->start_date
                                    ? \Carbon\Carbon::parse($team->start_date)->format('d M Y')
                                    : '-' }}
                            </td>

                            <td>
                                {{ $team->due_date
                                    ? \Carbon\Carbon::parse($team->due_date)->format('d M Y')
                                    : '-' }}
                            </td>


                            <td class="actions">
                                    <a
                                        href="{{ route('teams.show', $team) }}"
                                        class="view-btn"
                                    >
                                        View
                                    </a>
                                    <a
                                        href="{{ route('teams.edit', $team) }}"
                                        class="edit-btn mt-1"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('teams.destroy', $team) }}"
                                        method="POST"
                                        style="display:inline;"
                                        onsubmit="return confirm('Are you sure you want to delete this team?');"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="delete-btn mt-1"
                                        >
                                            Delete
                                        </button>

                                    </form>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>
            @if($teams->hasPages())
                <div style="padding: 20px;">
                    {{ $teams->links() }}
                </div>
            @endif
        @else

            <div class="empty-state">

                <h3>No teams Found</h3>

                <p>
                    You haven't created any teams yet.
                </p>

                <a
                    href="{{ route('teams.create') }}"
                    class="btn-primary"
                >
                    + Create First team
                </a>

            </div>
            
        @endif

    </div>

</div>

@endsection