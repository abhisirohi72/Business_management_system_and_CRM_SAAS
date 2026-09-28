@extends('layouts.app')
@section('title', 'Invoice')
@section('page-title', 'Invoice')
@section('content')

    <div class="invoice-page">

        {{-- Page Header --}}
        <div class="invoice-actions">

            <div>
                <h2>Invoice</h2>

                <p>
                    {{ $invoice->invoice_number }}
                </p>
            </div>

            <div class="action-buttons">

                <a href="{{ route('invoices.index') }}" class="btn btn-back">
                    ← Back
                </a>

                <a href="{{ route('invoices.edit', $invoice) }}" class="btn btn-edit">
                    Edit Invoice
                </a>

            </div>

        </div>


        {{-- Invoice --}}
        <div class="invoice-card">

            {{-- Header --}}
            <div class="invoice-header">

                <div>

                    <h2 class="company-name">
                        {{ env('APP_NAME', 'VayuShek'); }}
                    </h2>

                    <div class="company-info">
                        Business Management System<br>
                        {{ env('COMPANY_ADDRESS', 'India') }}<br>
                        India
                    </div>

                </div>


                <div class="invoice-title">

                    <h1>
                        INVOICE
                    </h1>

                    <div class="invoice-number">
                        {{ $invoice->invoice_number }}
                    </div>

                    <div class="invoice-meta">

                        <div>
                            <strong>Invoice Date:</strong>
                            {{ $invoice->invoice_date?->format('d M Y') }}
                        </div>

                        <div>
                            <strong>Due Date:</strong>
                            {{ $invoice->due_date?->format('d M Y') }}
                        </div>

                    </div>

                </div>

            </div>


            <hr class="divider">


            {{-- Billing --}}
            <div class="billing-section">

                <div>

                    <div class="section-label">
                        Bill To
                    </div>

                    <div class="section-value">
                        {{ $invoice->client?->name ?? 'N/A' }}
                    </div>

                </div>


                <div>

                    <div class="section-label">
                        Project
                    </div>

                    <div class="section-value">
                        {{ $invoice->project?->name ?? 'N/A' }}
                    </div>

                </div>

            </div>


            {{-- Items --}}
            <div style="overflow-x: auto;">

                <table class="items-table">

                    <thead>

                        <tr>

                            <th style="width: 45px;">
                                #
                            </th>

                            <th>
                                Item
                            </th>

                            <th>
                                Description
                            </th>

                            <th class="text-center" style="width: 70px;">
                                Qty
                            </th>

                            <th class="text-right" style="width: 120px;">
                                Unit Price
                            </th>

                            <th class="text-right" style="width: 120px;">
                                Amount
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach ($invoice->items as $index => $item)
                            <tr>

                                <td>
                                    {{ $index + 1 }}
                                </td>

                                <td>
                                    <div class="item-name">
                                        {{ $item->item_name }}
                                    </div>
                                </td>

                                <td>
                                    <div class="item-description">
                                        {{ $item->item_description ?? '-' }}
                                    </div>
                                </td>

                                <td class="text-center">
                                    {{ $item->quantity }}
                                </td>

                                <td class="text-right">
                                    ₹{{ number_format($item->unit_price, 2) }}
                                </td>

                                <td class="text-right">
                                    <strong>
                                        ₹{{ number_format($item->amount, 2) }}
                                    </strong>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- Bottom --}}
            <div class="bottom-section">

                {{-- Left --}}
                <div>

                    {{-- Status --}}
                    <div class="status-section">

                        <div class="section-label">
                            Status
                        </div>

                        @php

                            $statusClass = [
                                'draft' => 'status-draft',
                                'sent' => 'status-sent',
                                'partially_paid' => 'status-partially_paid',
                                'paid' => 'status-paid',
                                'overdue' => 'status-overdue',
                                'cancelled' => 'status-cancelled',
                            ];

                        @endphp

                        <span class="status-badge {{ $statusClass[$invoice->status] ?? 'status-draft' }}">

                            {{ ucwords(str_replace('_', ' ', $invoice->status)) }}

                        </span>

                    </div>


                    {{-- Notes --}}
                    @if ($invoice->notes)
                        <div class="notes-block">

                            <h4>
                                Notes
                            </h4>

                            <p>
                                {{ $invoice->notes }}
                            </p>

                        </div>
                    @endif


                    {{-- Terms --}}
                    @if ($invoice->terms)
                        <div class="notes-block">

                            <h4>
                                Terms & Conditions
                            </h4>

                            <p>
                                {{ $invoice->terms }}
                            </p>

                        </div>
                    @endif

                </div>


                {{-- Summary --}}
                <div>

                    <div class="summary">

                        <div class="summary-body">

                            {{-- Subtotal --}}
                            <div class="summary-row">

                                <span class="summary-label">
                                    Subtotal
                                </span>

                                <span class="summary-value">
                                    ₹{{ number_format($invoice->sub_total, 2) }}
                                </span>

                            </div>


                            {{-- Discount --}}
                            <div class="summary-row">

                                <span class="summary-label">
                                    Discount
                                </span>

                                <span class="summary-value">
                                    ₹{{ number_format($invoice->discount, 2) }}
                                </span>

                            </div>


                            {{-- Tax --}}
                            <div class="summary-row">

                                <span class="summary-label">
                                    Tax ({{ number_format($invoice->tax_rate, 2) }}%)
                                </span>

                                <span class="summary-value">
                                    ₹{{ number_format($invoice->tax, 2) }}
                                </span>

                            </div>

                        </div>


                        {{-- Total --}}
                        <div class="summary-total">

                            <div class="summary-row">

                                <span class="total-label">
                                    Total
                                </span>

                                <span class="total-value">
                                    ₹{{ number_format($invoice->total, 2) }}
                                </span>

                            </div>

                        </div>


                        <div class="summary-body">

                            {{-- Paid --}}
                            <div class="summary-row">

                                <span class="summary-label">
                                    Amount Paid
                                </span>

                                <span class="paid-value">
                                    ₹{{ number_format($invoice->amount_paid, 2) }}
                                </span>

                            </div>


                            {{-- Due --}}
                            <div class="summary-row">

                                <span class="summary-label">
                                    Amount Due
                                </span>

                                <span class="due-value">
                                    ₹{{ number_format($invoice->amount_due, 2) }}
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <div class="invoice-footer">
                Thank you for your business.
            </div>

        </div>

        <button id="aiBtn" class="ai-btn" onclick="getPaymentReminder()">
            <span id="aiIcon">✨</span>
            <span id="aiText">Generate Payment Reminder</span>
        </button>
        {{-- <div id="aiSummaryBox" class="ai-box hidden">
            <div class="ai-header">
                <div class="ai-icon-circle">✨</div>
                <h3 style="margin:0; font-weight:700; color:#1f2937;">AI Insights</h3>
                <span class="ai-live">Live</span>
            </div>
            <div id="aiContent" style="font-size: 14px;"></div>
        </div> --}}

        {{-- Modal Box Design --}}
        <div id="aiModal" class="ai-modal hidden">

            <!-- Backdrop -->
            <div class="ai-modal-backdrop" onclick="closeAIModal()"></div>


            <!-- Modal -->
            <div class="ai-modal-container">

                <!-- Header -->
                <div class="ai-modal-header">

                    <div class="ai-modal-title-wrapper">

                        <div class="ai-modal-icon">
                            ✨
                        </div>

                        <div>
                            <h2>AI Payment Reminder</h2>

                            <p>
                                Generate a professional payment reminder for this invoice.
                            </p>
                        </div>

                    </div>


                    <button type="button" class="ai-close-btn" onclick="closeAIModal()">
                        ×
                    </button>

                </div>


                <!-- Body -->
                <div class="ai-modal-body">

                    <!-- Invoice Info -->
                    <div class="ai-invoice-card">

                        <div class="ai-invoice-top">

                            <div>
                                <span class="ai-label">Invoice</span>

                                <strong>
                                    {{ $invoice->invoice_number }}
                                </strong>
                            </div>

                            <span class="ai-status">
                                {{ ucfirst($invoice->status ?? 'Unpaid') }}
                            </span>

                        </div>


                        <div class="ai-invoice-details">

                            <div>
                                <span class="ai-label">Client</span>

                                <strong>
                                    {{ $invoice->client->name ?? 'N/A' }}
                                </strong>
                            </div>


                            <div>
                                <span class="ai-label">Outstanding</span>

                                <strong class="ai-outstanding">
                                    ₹{{ number_format($invoice->outstanding_amount ?? 0, 2) }}
                                </strong>
                            </div>


                            <div>
                                <span class="ai-label">Due Date</span>

                                <strong>
                                    {{ $invoice->due_date?->format('d M Y') ?? 'N/A' }}
                                </strong>
                            </div>

                        </div>

                    </div>


                    <!-- AI Loading -->
                    <div id="aiLoading" class="ai-loading hidden">
                        <div class="ai-spinner"></div>

                        <div>
                            <strong>Analyzing invoice...</strong>

                            <p>
                                AI is preparing a professional payment reminder.
                            </p>
                        </div>
                    </div>


                    <!-- AI Result -->
                    <div id="aiSummaryBox" class="ai-result hidden">

                        <div class="ai-result-header">

                            <div>
                                <span class="ai-label">AI Generated Message</span>

                                <h3>Payment Reminder</h3>
                            </div>

                            <span class="ai-generated">
                                ✨ AI Generated
                            </span>

                        </div>


                        <!-- Subject -->
                        <div class="ai-field">

                            <label for="aiSubject">
                                Subject
                            </label>

                            <input type="text" id="aiSubject" readonly>

                        </div>


                        <!-- Message -->
                        <div class="ai-field">

                            <label for="aiContent">
                                Message
                            </label>

                            <textarea id="aiContent" rows="9" readonly></textarea>

                        </div>

                    </div>

                </div>


                <!-- Footer -->
                <div class="ai-modal-footer">

                    <button type="button" class="ai-secondary-btn" onclick="closeAIModal()">
                        Close
                    </button>


                    <button type="button" id="aiCopyBtn" class="ai-primary-btn hidden" onclick="copyAIMessage()">
                        📋 Copy Message
                    </button>

                </div>

            </div>

        </div>
    </div>
    <script>
        async function getPaymentReminder() {
            const btn = document.getElementById("aiBtn");
            const text = document.getElementById("aiText");
            const icon = document.getElementById('aiIcon');

            const modal = document.getElementById("aiModal");
            const loading = document.getElementById("aiLoading");
            const box = document.getElementById("aiSummaryBox");
            const copyBtn = document.getElementById("aiCopyBtn");

            const subject = document.getElementById("aiSubject");
            const content = document.getElementById("aiContent");

            // Open modal
            modal.classList.remove("hidden");

            // Loading state
            loading.classList.remove("hidden");
            box.classList.add("hidden");
            copyBtn.classList.add("hidden");

            text.innerText = "Analyzing...";
            icon.innerText = '⏳';
            btn.disabled = true;

            try {
                const res = await fetch("{{ route('invoices.ai-reminder', $invoice->id) }}");
                if (!res.ok) {
                    throw new Error("Something went wrong.");
                }

                const data = await res.json();
                console.log(data);

                let aiData;

                if (typeof data.summary === "string") {
                    aiData = JSON.parse(data.summary);
                } else {
                    aiData = data.summary;
                }
                // console.log(aiData.Subject);

                // Subject
                subject.value = aiData.subject ?? "";


                // Message
                content.value = aiData.body ?? "";


                // Show result
                loading.classList.add("hidden");
                box.classList.remove("hidden");
                // console.log(box.classList);
                copyBtn.classList.remove("hidden");
            } catch (error) {
                console.error(error);

                loading.innerHTML = `
                    <div class="ai-error-icon">⚠️</div>

                    <div>
                        <strong>Unable to generate reminder</strong>

                        <p>
                            Please try again.
                        </p>
                    </div>
                `;
            } finally {

                text.innerText = "Generate Payment Reminder";
                icon.innerText = "✨";
                btn.disabled = false;
            }
        }

        function closeAIModal() {

            const modal = document.getElementById("aiModal");

            modal.classList.add("hidden");

            document.body.classList.remove("overflow-hidden");
        }


        function copyAIMessage() {

            const subject = document.getElementById("aiSubject").value;
            const message = document.getElementById("aiContent").value;

            const text = `${subject}\n\n${message}`;

            navigator.clipboard.writeText(text)
                .then(() => {

                    const btn = document.getElementById("aiCopyBtn");

                    const originalText = btn.innerText;

                    btn.innerText = "✓ Copied";

                    setTimeout(() => {
                        btn.innerText = originalText;
                    }, 2000);

                })
                .catch(error => {

                    console.error(error);

                });
        }


        document.addEventListener("keydown", function(event) {

            if (event.key === "Escape") {
                closeAIModal();
            }

        });
    </script>
@endsection
