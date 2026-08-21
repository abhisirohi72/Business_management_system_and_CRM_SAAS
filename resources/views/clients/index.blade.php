@extends('layouts.app')

@section('content')
<style>
    .clients-page {
        padding: 30px;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .page-header h1 {
        margin: 0;
        font-size: 28px;
    }

    .page-header p {
        margin-top: 5px;
        color: #6b7280;
    }

    .btn-primary {
        background: #2563eb;
        color: #fff;
        padding: 10px 16px;
        border-radius: 7px;
        text-decoration: none;
        font-weight: 600;
    }

    .btn-primary:hover {
        background: #1d4ed8;
    }

    .alert-success {
        background: #dcfce7;
        color: #166534;
        padding: 12px 16px;
        border-radius: 7px;
        margin-bottom: 20px;
    }

    .table-card {
        background: #fff;
        border-radius: 10px;
        overflow-x: auto;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
    }

    .table-card table {
        width: 100%;
        border-collapse: collapse;
    }

    .table-card th,
    .table-card td {
        padding: 14px 16px;
        text-align: left;
        border-bottom: 1px solid #e5e7eb;
    }

    .table-card th {
        background: #f9fafb;
        font-size: 13px;
        color: #6b7280;
    }

    .table-card td {
        font-size: 14px;
    }

    .status {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .status.active {
        background: #dcfce7;
        color: #166534;
    }

    .status.inactive {
        background: #fee2e2;
        color: #991b1b;
    }

    .actions {
        white-space: nowrap;
    }

    .actions a,
    .actions button {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 5px;
        border: none;
        text-decoration: none;
        font-size: 12px;
        cursor: pointer;
        margin-right: 4px;
    }

    .btn-view {
        background: #e0f2fe;
        color: #0369a1;
    }

    .btn-edit {
        background: #fef3c7;
        color: #92400e;
    }

    .btn-delete {
        background: #fee2e2;
        color: #991b1b;
    }

    .empty-state {
        text-align: center !important;
        padding: 40px !important;
        color: #6b7280;
    }

    .pagination {
        margin-top: 20px;
    }
</style>
<div class="clients-page">

    <div class="page-header">

        <div>
            <h1>Clients</h1>
            <p>Manage your company's clients.</p>
        </div>

        <a href="{{ route('clients.create') }}" class="btn-primary">
            + Add Client
        </a>

    </div>


    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif


    <div class="table-card">

        <table>

            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Company</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Created By</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($clients as $client)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            <strong>{{ $client->name }}</strong>
                        </td>

                        <td>
                            {{ $client->company_name ?? '-' }}
                        </td>

                        <td>
                            {{ $client->email ?? '-' }}
                        </td>

                        <td>
                            {{ $client->phone ?? '-' }}
                        </td>

                        <td>

                            @if($client->status === 'active')

                                <span class="status active">
                                    Active
                                </span>

                            @else

                                <span class="status inactive">
                                    Inactive
                                </span>

                            @endif

                        </td>

                        <td>
                            {{ $client->creator?->name ?? '-' }}
                        </td>

                        <td class="actions">

                            <a
                                href="{{ route('clients.show', $client) }}"
                                class="btn-view"
                            >
                                View
                            </a>

                            <a
                                href="{{ route('clients.edit', $client) }}"
                                class="btn-edit"
                            >
                                Edit
                            </a>

                            <form
                                action="{{ route('clients.destroy', $client) }}"
                                method="POST"
                                style="display:inline;"
                                onsubmit="return confirm('Are you sure you want to delete this client?')"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn-delete"
                                >
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="8" class="empty-state">
                            No clients found.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- Pagination --}}
    <div class="pagination">
        {{ $clients->links() }}
    </div>

</div>

@endsection