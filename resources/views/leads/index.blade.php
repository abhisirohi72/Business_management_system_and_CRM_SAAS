@extends('layouts.app')

@section('title', 'Leads')

@section('page-title', 'Leads')

@section('content')

    <div class="page-header">

        <div>
            <h1>Leads</h1>

            <p>
                Manage your potential customers.
            </p>
        </div>

        <a href="{{ route('leads.create') }}" class="add-btn">
            + Add Lead
        </a>

    </div>


    <div class="table-card">
        @if($leads->count())
            <table>

                <thead>

                    <tr>
                        <th>Name</th>
                        <th>Company</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Source</th>
                        <th>Created By</th>
                        <th>Action</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach($leads as $lead)

                        <tr>

                            <td>
                                <strong>
                                    {{ $lead->name }}
                                </strong>
                            </td>

                            <td>
                                {{ $lead->company_name ?? '-' }}
                            </td>

                            <td>
                                {{ $lead->email ?? '-' }}
                            </td>

                            <td>
                                {{ $lead->phone ?? '-' }}
                            </td>

                            <td>

                                <span class="status {{ $lead->status }}">
                                    {{ ucfirst($lead->status) }}
                                </span>

                            </td>

                            <td>
                                {{ $lead->source ?? '-' }}
                            </td>

                            <td>
                                {{ $lead->creator->name }}
                            </td>

                            <td>
                                <div class="action-buttons">

                                    <a href="{{ route('leads.edit', $lead->id) }}" class="edit-btn">
                                        Edit
                                    </a>
                                    <form
                                        method="POST"
                                        action="{{ route('leads.destroy', $lead) }}"
                                        style="display: inline;"
                                        onsubmit="return confirm('Are you sure you want to delete this lead?')"
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
                                </div>
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>
            @if($leads->hasPages())
                {{ $leads->links('vendor.pagination.custom') }}
            @endif
        @else

            <div class="empty-state">

                <h3>No Leads Found</h3>

                <p>
                    You haven't created any leads yet.
                </p>

                <a
                    href="{{ route('leads.create') }}"
                    class="btn-primary"
                >
                    + Create First Lead
                </a>

            </div>
            
        @endif

    </div>


    <style>

        
    </style>

@endsection