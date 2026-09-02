@extends('layouts.app')

@section('title', 'Quotation Details')

@section('page-title', 'Quotation Details')

@section('content')

<style>
.quotation-show-page {
    padding: 30px;
    width: 100%;
    box-sizing: border-box;
}

.quotation-show-page .quotation-page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}

.quotation-show-page .quotation-page-header h1 {
    margin: 0;
    font-size: 28px;
    color: #111827;
}

.quotation-show-page .quotation-page-header p {
    margin: 6px 0 0;
    color: #6b7280;
}

.quotation-show-page .quotation-header-actions {
    display: flex;
    gap: 10px;
}

.quotation-show-page .quotation-btn {
    display: inline-block;
    padding: 9px 15px;
    border-radius: 7px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
}

.quotation-show-page .quotation-btn-back {
    background: #f3f4f6;
    color: #374151;
}

.quotation-show-page .quotation-btn-edit {
    background: #2563eb;
    color: #fff;
}

.quotation-show-page .details-card {
    width: 100%;
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-sizing: border-box;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
    margin-bottom: 25px;
}

.quotation-show-page .details-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 25px;
}

.quotation-show-page .detail-item {
    display: flex;
    flex-direction: column;
    gap: 7px;
}

.quotation-show-page .detail-item.full-width {
    grid-column: 1 / -1;
}

.quotation-show-page .detail-label {
    font-size: 12px;
    color: #6b7280;
    text-transform: uppercase;
    font-weight: 600;
}

.quotation-show-page .detail-value {
    font-size: 15px;
    color: #111827;
    font-weight: 500;
}

.quotation-show-page .quotation-status {
    display: inline-block;
    width: fit-content;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.quotation-show-page .quotation-status.draft {
    background: #f3f4f6;
    color: #374151;
}

.quotation-show-page .quotation-status.sent {
    background: #dbeafe;
    color: #1d4ed8;
}

.quotation-show-page .quotation-status.accepted {
    background: #dcfce7;
    color: #166534;
}

.quotation-show-page .quotation-status.rejected {
    background: #fee2e2;
    color: #991b1b;
}

.quotation-show-page .quotation-status.expired {
    background: #fef3c7;
    color: #92400e;
}


/* Items */

.quotation-show-page .items-card {
    width: 100%;
    background: #fff;
    border-radius: 10px;
    overflow-x: auto;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
    margin-bottom: 25px;
}

.quotation-show-page .items-card table {
    width: 100%;
    border-collapse: collapse;
}

.quotation-show-page .items-card th,
.quotation-show-page .items-card td {
    padding: 14px 16px;
    text-align: left;
    border-bottom: 1px solid #e5e7eb;
}

.quotation-show-page .items-card th {
    background: #f9fafb;
    font-size: 13px;
    color: #6b7280;
}

.quotation-show-page .items-card td {
    font-size: 14px;
    color: #111827;
}

.quotation-show-page .item-description {
    display: block;
    margin-top: 4px;
    color: #6b7280;
    font-size: 12px;
}


/* Summary */

.quotation-show-page .summary-card {
    width: 100%;
    max-width: 450px;
    margin-left: auto;
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-sizing: border-box;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
}

.quotation-show-page .summary-row {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    color: #374151;
}

.quotation-show-page .summary-row strong {
    color: #111827;
}

.quotation-show-page .total-row {
    border-top: 2px solid #e5e7eb;
    margin-top: 10px;
    padding-top: 15px;
    font-size: 18px;
    font-weight: 700;
}

.quotation-show-page .total-row strong {
    font-size: 20px;
}

@media (max-width: 768px) {

    .quotation-show-page {
        padding: 15px;
    }

    .quotation-show-page .quotation-page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }

    .quotation-show-page .details-grid {
        grid-template-columns: 1fr;
    }

    .quotation-show-page .detail-item.full-width {
        grid-column: auto;
    }

    .quotation-show-page .summary-card {
        max-width: 100%;
    }

}
</style>


<div class="quotation-show-page">

    {{-- Header --}}
    <div class="quotation-page-header">

        <div>

            <h1>Quotation Details</h1>

            <p>
                View complete quotation information.
            </p>

        </div>


        <div class="quotation-header-actions">

            <a
                href="{{ route('quotations.index') }}"
                class="quotation-btn quotation-btn-back"
            >
                ← Back
            </a>


            <a
                href="{{ route('quotations.edit', $quotation) }}"
                class="quotation-btn quotation-btn-edit"
            >
                Edit Quotation
            </a>

        </div>

    </div>


    {{-- Quotation Information --}}
    <div class="details-card">

        <div class="details-grid">

            <div class="detail-item">

                <span class="detail-label">
                    Quotation Number
                </span>

                <strong class="detail-value">
                    {{ $quotation->quotation_number }}
                </strong>

            </div>


            <div class="detail-item">

                <span class="detail-label">
                    Status
                </span>

                <span class="quotation-status {{ $quotation->status }}">
                    {{ ucfirst($quotation->status) }}
                </span>

            </div>


            <div class="detail-item">

                <span class="detail-label">
                    Client
                </span>

                <strong class="detail-value">
                    {{ $quotation->client?->name ?? '-' }}
                </strong>

            </div>


            <div class="detail-item">

                <span class="detail-label">
                    Project
                </span>

                <strong class="detail-value">
                    {{ $quotation->project?->name ?? '-' }}
                </strong>

            </div>


            <div class="detail-item">

                <span class="detail-label">
                    Quotation Date
                </span>

                <strong class="detail-value">
                    {{ $quotation->quotation_date?->format('d M Y') ?? '-' }}
                </strong>

            </div>


            <div class="detail-item">

                <span class="detail-label">
                    Valid Until
                </span>

                <strong class="detail-value">
                    {{ $quotation->valid_until?->format('d M Y') ?? '-' }}
                </strong>

            </div>


            <div class="detail-item">

                <span class="detail-label">
                    Created By
                </span>

                <strong class="detail-value">
                    {{ $quotation->createdBy?->name ?? '-' }}
                </strong>

            </div>


            <div class="detail-item">

                <span class="detail-label">
                    Created At
                </span>

                <strong class="detail-value">
                    {{ $quotation->created_at?->format('d M Y, h:i A') ?? '-' }}
                </strong>

            </div>

        </div>

    </div>


    {{-- Quotation Items --}}
    <div class="items-card">

        <table>

            <thead>

                <tr>
                    <th>#</th>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Unit Price</th>
                    <th>Amount</th>
                </tr>

            </thead>


            <tbody>

                @forelse($quotation->items as $item)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>

                            <strong>
                                {{ $item->item_name }}
                            </strong>

                            @if($item->item_description)

                                <span class="item-description">
                                    {{ $item->item_description }}
                                </span>

                            @endif

                        </td>

                        <td>
                            {{ $item->quantity }}
                        </td>

                        <td>
                            ₹{{ number_format($item->unit_price, 2) }}
                        </td>

                        <td>
                            ₹{{ number_format($item->amount, 2) }}
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="5"
                            style="text-align:center; padding:30px;"
                        >
                            No quotation items found.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- Summary --}}
    <div class="summary-card">

        <div class="summary-row">

            <span>
                Subtotal
            </span>

            <strong>
                ₹{{ number_format($quotation->sub_total, 2) }}
            </strong>

        </div>


        <div class="summary-row">

            <span>
                Discount
            </span>

            <strong>
                ₹{{ number_format($quotation->discount ?? 0, 2) }}
            </strong>

        </div>


        <div class="summary-row">

            <span>
                Tax ({{ number_format($quotation->tax_rate ?? 0, 2) }}%)
            </span>

            <strong>
                ₹{{ number_format($quotation->tax ?? 0, 2) }}
            </strong>

        </div>


        <div class="summary-row total-row">

            <span>
                Total
            </span>

            <strong>
                ₹{{ number_format($quotation->total, 2) }}
            </strong>

        </div>

    </div>


    {{-- Notes --}}
    @if($quotation->notes)

        <div class="details-card" style="margin-top:25px;">

            <div class="detail-item">

                <span class="detail-label">
                    Notes
                </span>

                <strong class="detail-value">
                    {{ $quotation->notes }}
                </strong>

            </div>

        </div>

    @endif


    {{-- Terms --}}
    @if($quotation->terms)

        <div class="details-card">

            <div class="detail-item">

                <span class="detail-label">
                    Terms & Conditions
                </span>

                <strong class="detail-value">
                    {{ $quotation->terms }}
                </strong>

            </div>

        </div>

    @endif
    
    {{-- AI Summary --}}
    <button onclick="getAISummary({{ $quotation->id }})">🤖 AI Summary</button>
    <div id="ai-box"></div>

</div>
<script>
function getAISummary(id){
  fetch(`/quotations/${id}/ai-summary`)
 .then(res=>res.json())
 .then(data=>{ document.getElementById('ai-box').innerText = data.summary })
}
</script>
@endsection