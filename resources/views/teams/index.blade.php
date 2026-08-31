@extends('layouts.app')

@section('title','View Team Members')

@section('page-title','View Team Members')

@section('content')

<div class="teams-page">

    {{-- Header --}}
    <div class="page-header">

        <div>
            <h1>Team Members</h1>
            <p>Manage all your company teams.</p>
        </div>

        <a href="{{ route('teams.create') }}" class="add-btn">
            + Add Team Member
        </a>

    </div>

    {{-- teams Table --}}
    <div class="table-card">

        @if($teams->count())

            <table>

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Company Name</th>                        
                        <th>Role</th>
                        <th>Email</th>
                        <th>Created At</th>
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
                                    {{ $team->name ?? '-' }}
                                </strong>
                            </td>

                            <td>
                                <strong>
                                    {{ $team->company->name ?? '-' }}
                                </strong>
                            </td>

                            <td> 
                                <strong>
                                    {{ $team->role->name ?? '-' }}
                                </strong>
                            </td>                            

                            <td>
                                {{ $team->email ?? '-' }}
                            </td>

                            <td>
                                {{ $team->created_at
                                    ? \Carbon\Carbon::parse($team->created_at)->format('d M Y')
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