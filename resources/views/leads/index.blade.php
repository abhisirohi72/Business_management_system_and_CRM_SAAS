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


    @if(session('success'))

        <div class="alert-success">
            {{ session('success') }}
        </div>

    @endif


    <div class="table-card">

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

                @forelse($leads as $lead)

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

                @empty

                    <tr>

                        <td colspan="8" class="empty">
                            No leads found.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    <style>

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
        }

        .page-header h1 {
            font-size: 25px;
            margin-bottom: 6px;
        }

        .page-header p {
            color: #6b7280;
            font-size: 14px;
        }

        .add-btn {
            background: #4f46e5;
            color: white;
            text-decoration: none;
            padding: 11px 18px;
            border-radius: 7px;
            font-size: 14px;
            font-weight: 600;
        }

        .add-btn:hover {
            background: #4338ca;2026-08-21 07:49:42
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            padding: 12px 15px;
            border-radius: 7px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .table-card {
            background: white;
            border-radius: 12px;
            overflow-x: auto;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }

        th,
        td {
            padding: 15px 18px;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
            font-size: 13px;
        }

        th {
            background: #f9fafb;
            color: #6b7280;
            font-size: 12px;
            text-transform: uppercase;
        }

        td {
            color: #374151;
        }

        .status {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .status.new {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .status.contacted {
            background: #fef3c7;
            color: #92400e;
        }

        .status.qualified {
            background: #dcfce7;
            color: #166534;
        }

        .status.lost {
            background: #fee2e2;
            color: #991b1b;
        }

        .status.converted {
            background: #ede9fe;
            color: #6d28d9;
        }

        .empty {
            text-align: center;
            padding: 40px !important;
            color: #9ca3af;
        }

        @media (max-width: 700px) {

            .page-header {
                align-items: flex-start;
                gap: 15px;
            }

            .add-btn {
                white-space: nowrap;
            }

        }
        .edit-btn,
        .delete-btn {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 6px;
            font-size: 12px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            color: white;
        }

        .edit-btn {
            background: #f59e0b;
        }

        .edit-btn:hover {
            background: #d97706;
        }

        .delete-btn {
            background: #ef4444;
        }

        .delete-btn:hover {
            background: #dc2626;
        }
    </style>

@endsection