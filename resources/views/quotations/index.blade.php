@extends('layouts.app')

@section('content')

<div class="clients-page">

    <div class="page-header">

        <div>
            <h1>Quotations</h1>
            <p>Manage your company's quotations.</p>
        </div>

        <a href="{{ route('quotations.create') }}" class="add-btn">
            + Add Quotation
        </a>

    </div>


    <div class="table-card">

        <table>

            <thead>
                <tr>
                    <th>#</th>
                    <th>Quotation No.</th>
                    <th>Client</th>
                    <th>Project</th>
                    <th>Date</th>
                    <th>Valid Until</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Created By</th>
                    <th>Actions</th>
                </tr>
            </thead>


            <tbody>

                @forelse($quotations as $quotation)

                    <tr>

                        <td>
                            {{ $quotations->firstItem() + $loop->index }}
                        </td>

                        <td>
                            <strong>
                                {{ $quotation->quotation_number }}
                            </strong>
                        </td>

                        <td>
                            {{ $quotation->client?->name ?? '-' }}
                        </td>

                        <td>
                            {{ $quotation->project?->name ?? '-' }}
                        </td>

                        <td>
                            {{ $quotation->quotation_date?->format('d M Y') ?? '-' }}
                        </td>

                        <td>
                            {{ $quotation->valid_until?->format('d M Y') ?? '-' }}
                        </td>

                        <td>
                            ₹{{ number_format($quotation->total, 2) }}
                        </td>

                        <td>

                            @if($quotation->status === 'draft')

                                <span class="status inactive">
                                    Draft
                                </span>

                            @elseif($quotation->status === 'sent')

                                <span class="status active">
                                    Sent
                                </span>

                            @elseif($quotation->status === 'accepted')

                                <span class="status active">
                                    Accepted
                                </span>

                            @elseif($quotation->status === 'rejected')

                                <span class="status inactive">
                                    Rejected
                                </span>

                            @elseif($quotation->status === 'expired')

                                <span class="status inactive">
                                    Expired
                                </span>

                            @endif

                        </td>

                        <td>
                            {{ $quotation->createdBy?->name ?? '-' }}
                        </td>

                        <td class="actions">

                            <a
                                href="{{ route('quotations.show', $quotation) }}"
                                class="view-btn"
                            >
                                View
                            </a>

                            <a
                                href="{{ route('quotations.edit', $quotation) }}"
                                class="edit-btn"
                            >
                                Edit
                            </a>

                            <form
                                action="{{ route('quotations.destroy', $quotation) }}"
                                method="POST"
                                style="display:inline;"
                                onsubmit="return confirm('Are you sure you want to delete this quotation?')"
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

                @empty

                    <tr>

                        <td colspan="10" class="empty-state">
                            No quotations found.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- Pagination --}}
    <div class="pagination">
        {{ $quotations->links() }}
    </div>

</div>

@endsection