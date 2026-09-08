@extends('layouts.app')

@section('content')
<div class="clients-page">

    <div class="page-header">

        <div>
            <h1>Invoices</h1>
            <p>Manage all your invoices</p>
        </div>

        <a href="{{ route('invoices.create') }}" class="add-btn">
            + Create Invoice
        </a>

    </div>


    <div class="table-card">

        <table class="table-card">

            <thead>
                <tr>
                    <th>#</th>
                    <th>Invoice</th>
                    <th>Client</th>
                    <th>Project</th>
                    <th>Invoice Date</th>
                    <th>Due Date</th>
                    <th>Total</th>
                    <th>Paid</th>
                    <th>Due</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>


            <tbody>

                @forelse($invoices as $invoice)

                    <tr>
                        <td>
                            {{ $invoices->firstItem() + $loop->index }}
                        </td>

                        <td>
                            <strong>
                                {{ $invoice->invoice_number }}
                            </strong>
                        </td>

                        <td>
                            {{ $invoice->client?->name ?? 'N/A' }}
                        </td>

                        <td>
                            {{ $invoice->project?->name ?? 'N/A' }}
                        </td>

                        <td>
                            {{ $invoice->invoice_date?->format('d M Y') }}
                        </td>

                        <td>
                            {{ $invoice->due_date?->format('d M Y') }}
                        </td>

                        <td>
                            ₹{{ number_format($invoice->total, 2) }}
                        </td>

                        <td>
                            ₹{{ number_format($invoice->amount_paid, 2) }}
                        </td>

                        <td>
                            ₹{{ number_format($invoice->amount_due, 2) }}
                        </td>

                        <td>

                            @php
                                $statusClasses = [
                                    'draft' => 'secondary',
                                    'sent' => 'info',
                                    'partially_paid' => 'warning',
                                    'paid' => 'success',
                                    'overdue' => 'danger',
                                    'cancelled' => 'dark',
                                ];
                            @endphp

                            <span class="badge bg-{{ $statusClasses[$invoice->status] ?? 'secondary' }}">
                                {{ ucwords(str_replace('_', ' ', $invoice->status)) }}
                            </span>

                        </td>

                        <td class="actions">
                            <div class="d-flex align-items-center gap-1 flex-nowrap" style="white-space: nowrap;">
                                
                                <a href="{{ route('invoices.show', $invoice) }}" class="view-btn">
                                    View
                                </a>

                                <a href="{{ route('invoices.edit', $invoice) }}" class="edit-btn">
                                    Edit
                                </a>

                                <form action="{{ route('invoices.destroy', $invoice) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this invoice?')" 
                                    class="d-inline m-0 p-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn">
                                        Delete
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="10" class="empty-state">
                            No invoices found.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- Pagination --}}
    <div class="pagination">
        {{ $invoices->links() }}
    </div>

</div>

@endsection