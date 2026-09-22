@extends('layouts.app')

@section('title', 'Quotation Details')

@section('page-title', 'Quotation Details')

@section('content')

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

                <a href="{{ route('quotations.index') }}" class="quotation-btn quotation-btn-back">
                    ← Back
                </a>


                <a href="{{ route('quotations.edit', $quotation) }}" class="quotation-btn quotation-btn-edit">
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

                                @if ($item->item_description)
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

                            <td colspan="5" style="text-align:center; padding:30px;">
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
        @if ($quotation->notes)
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
        @if ($quotation->terms)
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

        <button id="aiBtn" class="ai-btn" onclick="getAiSummary()">
            <span id="aiIcon">🤖</span>
            <span id="aiText">AI Summary</span>
        </button>

        <div id="aiSummaryBox" class="ai-box hidden">
            <div class="ai-header">
                <div class="ai-icon-circle">✨</div>
                <h3 style="margin:0; font-weight:700; color:#1f2937;">AI Insights</h3>
                <span class="ai-live">Live</span>
            </div>
            <div id="aiContent" style="font-size: 14px;"></div>
        </div>

    </div>
    <script>
        async function getAiSummary() {
            const btn = document.getElementById('aiBtn');
            const text = document.getElementById('aiText');
            const icon = document.getElementById('aiIcon');
            const box = document.getElementById('aiSummaryBox');
            const content = document.getElementById('aiContent');

            text.innerText = 'Analyzing...';
            icon.innerText = '⏳';
            btn.disabled = true;

            try {
                const res = await fetch("{{ route('quotation.ai-summary', $quotation->id) }}");
                const data = await res.json();
                const parsed = typeof data.summary === 'string' ? JSON.parse(data.summary) : data.summary;

                content.innerHTML = `
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                <span style="background:${parsed.verdict.includes('GO')? '#dcfce7' : '#fef3c7'}; color:${parsed.verdict.includes('GO')? '#166534' : '#92400e'}; padding:5px 12px; border-radius:20px; font-weight:700; font-size:13px;">${parsed.verdict} • Score ${parsed.score}/100</span>
                <span style="font-weight:700; color:#4f46e5;">${parsed.amount}</span>
            </div>
            <div class="ai-card ai-card-gray">📝 ${parsed.summary}</div>
            <div class="ai-card ai-card-amber">⚠️ <b>Risk:</b> ${parsed.risk}</div>
            <div class="ai-card" style="background:#f0fdf4; border:1px solid #bbf7d0;">💡 <b>Opportunity:</b> ${parsed.opportunity}</div>
            <div class="ai-card ai-card-indigo">🎯 <b>Next Action:</b> ${parsed.next_action}</div>
        `;
                box.classList.remove('hidden');
            } catch (e) {
                content.innerHTML = `<div style="color:red;">Error: ${e.message}</div>`;
                box.classList.remove('hidden');
            } finally {
                text.innerText = 'AI Summary';
                icon.innerText = '🤖';
                btn.disabled = false;
            }
        }
    </script>
@endsection
