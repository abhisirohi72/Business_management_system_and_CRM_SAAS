@extends('layouts.app')

@section('title', 'Create Invoice')

@section('page-title', 'Create Invoice')

@section('content')

<style>
.invoice-create-page {
    padding: 30px;
    width: 100%;
    box-sizing: border-box;
}

.invoice-create-page .page-header {
    margin-bottom: 25px;
}

.invoice-create-page .page-header h1 {
    margin: 0;
    font-size: 28px;
    color: #111827;
}

.invoice-create-page .page-header p {
    margin: 6px 0 0;
    color: #6b7280;
}

.invoice-create-page .form-card {
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
    margin-bottom: 25px;
}

.invoice-create-page .form-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 20px;
}

.invoice-create-page .form-group {
    display: flex;
    flex-direction: column;
    gap: 7px;
}

.invoice-create-page .form-group.full-width {
    grid-column: 1 / -1;
}

.invoice-create-page label {
    font-size: 13px;
    font-weight: 600;
    color: #374151;
}

.invoice-create-page input,
.invoice-create-page select,
.invoice-create-page textarea {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #d1d5db;
    border-radius: 7px;
    box-sizing: border-box;
    font-size: 14px;
}

.invoice-create-page textarea {
    min-height: 100px;
    resize: vertical;
}

.invoice-create-page .error {
    color: #dc2626;
    font-size: 12px;
}

.invoice-create-page .items-wrapper {
    overflow-x: auto;
}

.invoice-create-page table {
    width: 100%;
    border-collapse: collapse;
    min-width: 800px;
}

.invoice-create-page th,
.invoice-create-page td {
    padding: 12px;
    border-bottom: 1px solid #e5e7eb;
    text-align: left;
}

.invoice-create-page th {
    background: #f9fafb;
    color: #6b7280;
    font-size: 13px;
}

.invoice-create-page td input {
    min-width: 100px;
}

.invoice-create-page .item-name-input {
    min-width: 180px;
}

.invoice-create-page .item-description-input {
    margin-top: 6px;
}

.invoice-create-page .add-item-btn {
    margin-top: 15px;
    padding: 9px 14px;
    border: 0;
    border-radius: 7px;
    background: #111827;
    color: #fff;
    cursor: pointer;
}

.invoice-create-page .delete-btn {
    border: 0;
    background: transparent;
    color: #dc2626;
    font-size: 20px;
    cursor: pointer;
}

.invoice-create-page .summary-card {
    max-width: 450px;
    margin-left: auto;
    margin-top: 25px;
}

.invoice-create-page .summary-row {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    color: #374151;
}

.invoice-create-page .summary-row strong {
    color: #111827;
}

.invoice-create-page .total-row {
    border-top: 2px solid #e5e7eb;
    margin-top: 10px;
    padding-top: 15px;
    font-size: 18px;
    font-weight: 700;
}

.invoice-create-page .form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}

.invoice-create-page .cancel-btn,
.invoice-create-page .submit-btn {
    display: inline-block;
    padding: 10px 16px;
    border-radius: 7px;
    text-decoration: none;
    border: 0;
    cursor: pointer;
    font-weight: 600;
}

.invoice-create-page .cancel-btn {
    background: #f3f4f6;
    color: #374151;
}

.invoice-create-page .submit-btn {
    background: #2563eb;
    color: #fff;
}

@media (max-width: 768px) {
    .invoice-create-page {
        padding: 15px;
    }

    .invoice-create-page .form-grid {
        grid-template-columns: 1fr;
    }

    .invoice-create-page .form-group.full-width {
        grid-column: auto;
    }
}
</style>

<div class="invoice-create-page">

    <div class="page-header">
        <h1>Create Invoice</h1>
        <p>Create a new invoice for your client.</p>
    </div>

    @if ($errors->any())
        <div class="form-card">
            <strong>Please fix the following errors:</strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li class="error">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('invoices.store') }}"
        method="POST"
    >
        @csrf

        <div class="form-card">

            <div class="form-grid">

                <div class="form-group">
                    <label for="client_id">Client *</label>

                    <select
                        name="client_id"
                        id="client_id"
                        required
                    >
                        <option value="">Select Client</option>

                        @foreach($clients as $client)
                            <option
                                value="{{ $client->id }}"
                                {{ old('client_id') == $client->id ? 'selected' : '' }}
                            >
                                {{ $client->name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="form-group">
                    <label for="project_id">Project</label>

                    <select
                        name="project_id"
                        id="project_id"
                    >
                        <option value="">Select Project</option>

                        @foreach($projects as $project)
                            <option
                                value="{{ $project->id }}"
                                {{ old('project_id') == $project->id ? 'selected' : '' }}
                            >
                                {{ $project->name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="form-group">
                    <label for="quotation_id">Quotation</label>

                    <select
                        name="quotation_id"
                        id="quotation_id"
                    >
                        <option value="">Select Quotation</option>

                        @foreach($quotations as $quotation)
                            <option
                                value="{{ $quotation->id }}"
                                {{ old('quotation_id') == $quotation->id ? 'selected' : '' }}
                            >
                                {{ $quotation->quotation_number }}
                                -
                                {{ $quotation->client?->name ?? 'Unknown Client' }}
                                -
                                ₹{{ number_format($quotation->total, 2) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="status">Status *</label>

                    <select
                        name="status"
                        id="status"
                        required
                    >
                        <option value="draft"
                            {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>
                            Draft
                        </option>

                        <option value="sent"
                            {{ old('status') === 'sent' ? 'selected' : '' }}>
                            Sent
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="invoice_date">Invoice Date *</label>

                    <input
                        type="date"
                        name="invoice_date"
                        id="invoice_date"
                        value="{{ old('invoice_date', now()->format('Y-m-d')) }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="due_date">Due Date *</label>

                    <input
                        type="date"
                        name="due_date"
                        id="due_date"
                        value="{{ old('due_date') }}"
                        required
                    >
                </div>

            </div>

        </div>

        <div class="form-card">

            <h2>Invoice Items</h2>

            <div class="items-wrapper">

                <table>

                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Unit Price</th>
                            <th>Amount</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody id="invoice-items">

                        <tr class="invoice-item">

                            <td>
                                <input
                                    type="text"
                                    name="items[0][item_name]"
                                    placeholder="Item name"
                                    class="item-name-input"
                                    required
                                >

                                <input
                                    type="text"
                                    name="items[0][item_description]"
                                    placeholder="Description"
                                    class="item-description-input"
                                >
                            </td>

                            <td>
                                <input
                                    type="number"
                                    name="items[0][quantity]"
                                    value="1"
                                    min="1"
                                    class="item-quantity"
                                    required
                                >
                            </td>

                            <td>
                                <input
                                    type="number"
                                    name="items[0][unit_price]"
                                    placeholder="0.00"
                                    min="0"
                                    step="0.01"
                                    class="item-price"
                                    required
                                >
                            </td>

                            <td>
                                <span class="item-amount">
                                    ₹0.00
                                </span>
                            </td>

                            <td>
                                <button
                                    type="button"
                                    class="delete-btn"
                                >
                                    ×
                                </button>
                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

            <button
                type="button"
                id="add-item"
                class="add-item-btn"
            >
                + Add Item
            </button>

        </div>

        <div class="form-card">

            <div class="form-grid">

                <div class="form-group">
                    <label for="discount">Discount</label>

                    <input
                        type="number"
                        id="discount"
                        name="discount"
                        value="{{ old('discount', 0) }}"
                        min="0"
                        step="0.01"
                    >
                </div>

                <div class="form-group">
                    <label for="tax_rate">Tax (%)</label>

                    <input
                        type="number"
                        id="tax_rate"
                        name="tax_rate"
                        value="{{ old('tax_rate', 0) }}"
                        min="0"
                        max="100"
                        step="0.01"
                    >
                </div>

                <div class="form-group full-width">
                    <label for="notes">Notes</label>

                    <textarea
                        name="notes"
                        id="notes"
                    >{{ old('notes') }}</textarea>
                </div>

                <div class="form-group full-width">
                    <label for="terms">Terms & Conditions</label>

                    <textarea
                        name="terms"
                        id="terms"
                    >{{ old('terms') }}</textarea>
                </div>

            </div>

            <div class="summary-card">

                <div class="summary-row">
                    <span>Subtotal</span>
                    <strong id="subtotal">₹0.00</strong>
                </div>

                <div class="summary-row">
                    <span>Discount</span>
                    <strong id="discount-display">₹0.00</strong>
                </div>

                <div class="summary-row">
                    <span>
                        Tax (<span id="tax-rate-display">0.00</span>%)
                    </span>

                    <strong id="tax-display">
                        ₹0.00
                    </strong>
                </div>

                <div class="summary-row total-row">
                    <span>Total</span>
                    <strong id="total">₹0.00</strong>
                </div>

            </div>

        </div>

        <div class="form-card">

            <div class="form-actions">

                <a
                    href="{{ route('invoices.index') }}"
                    class="cancel-btn"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="submit-btn"
                >
                    Create Invoice
                </button>

            </div>

        </div>

    </form>

</div>

<script>
    let itemIndex = 1;

    const itemsContainer =
        document.getElementById('invoice-items');

    const addItemButton =
        document.getElementById('add-item');

    addItemButton.addEventListener('click', function () {

        const row = document.createElement('tr');

        row.classList.add('invoice-item');

        row.innerHTML = `
            <td>
                <input
                    type="text"
                    name="items[${itemIndex}][item_name]"
                    placeholder="Item name"
                    class="item-name-input"
                    required
                >

                <input
                    type="text"
                    name="items[${itemIndex}][item_description]"
                    placeholder="Description"
                    class="item-description-input"
                >
            </td>

            <td>
                <input
                    type="number"
                    name="items[${itemIndex}][quantity]"
                    value="1"
                    min="1"
                    class="item-quantity"
                    required
                >
            </td>

            <td>
                <input
                    type="number"
                    name="items[${itemIndex}][unit_price]"
                    placeholder="0.00"
                    min="0"
                    step="0.01"
                    class="item-price"
                    required
                >
            </td>

            <td>
                <span class="item-amount">
                    ₹0.00
                </span>
            </td>

            <td>
                <button
                    type="button"
                    class="delete-btn"
                >
                    ×
                </button>
            </td>
        `;

        itemsContainer.appendChild(row);

        itemIndex++;

        calculateTotals();
    });


    itemsContainer.addEventListener('click', function (event) {

        if (
            event.target.classList.contains('delete-btn')
        ) {

            const rows =
                itemsContainer.querySelectorAll('.invoice-item');

            if (rows.length > 1) {

                event.target
                    .closest('.invoice-item')
                    .remove();

                calculateTotals();
            }
        }
    });


    itemsContainer.addEventListener('input', function (event) {

        if (
            event.target.classList.contains('item-quantity') ||
            event.target.classList.contains('item-price')
        ) {
            calculateTotals();
        }
    });


    document
        .getElementById('discount')
        .addEventListener('input', calculateTotals);


    document
        .getElementById('tax_rate')
        .addEventListener('input', calculateTotals);


    function calculateTotals()
    {
        let subtotal = 0;

        const rows =
            itemsContainer.querySelectorAll('.invoice-item');

        rows.forEach(function (row) {

            const quantity =
                parseFloat(
                    row.querySelector('.item-quantity').value
                ) || 0;

            const unitPrice =
                parseFloat(
                    row.querySelector('.item-price').value
                ) || 0;

            const amount =
                quantity * unitPrice;

            row.querySelector('.item-amount').textContent =
                '₹' + amount.toFixed(2);

            subtotal += amount;
        });


        const discount =
            parseFloat(
                document.getElementById('discount').value
            ) || 0;


        const taxRate =
            parseFloat(
                document.getElementById('tax_rate').value
            ) || 0;


        const taxableAmount =
            Math.max(subtotal - discount, 0);


        const taxAmount =
            (taxableAmount * taxRate) / 100;


        const total =
            taxableAmount + taxAmount;


        document.getElementById('subtotal').textContent =
            '₹' + subtotal.toFixed(2);


        document.getElementById('discount-display').textContent =
            '₹' + discount.toFixed(2);


        document.getElementById('tax-rate-display').textContent =
            taxRate.toFixed(2);


        document.getElementById('tax-display').textContent =
            '₹' + taxAmount.toFixed(2);


        document.getElementById('total').textContent =
            '₹' + total.toFixed(2);
    }


    calculateTotals();

    document
        .getElementById('quotation_id')
        .addEventListener('change', function () {

            const quotationId = this.value;

            if (!quotationId) {
                return;
            }

            fetch(
                `{{ url('/invoices/quotation') }}/${quotationId}`
            )
                .then(response => {

                    if (!response.ok) {
                        throw new Error(
                            'Unable to load quotation.'
                        );
                    }

                    return response.json();
                })
                .then(data => {

                    /*
                    * Client
                    */
                    document.getElementById('client_id').value =
                        data.client_id ?? '';


                    /*
                    * Project
                    */
                    document.getElementById('project_id').value =
                        data.project_id ?? '';


                    /*
                    * Discount
                    */
                    document.getElementById('discount').value =
                        data.discount ?? 0;


                    /*
                    * Tax Rate
                    */
                    document.getElementById('tax_rate').value =
                        data.tax_rate ?? 0;

                    /*
                    * Notes
                    */
                    document.getElementById('notes').value =
                        data.notes ?? 0; 
                        
                    /*
                    * Terms
                    */
                    document.getElementById('terms').value =
                        data.terms ?? 0;     


                    /*
                    * Existing invoice items clear
                    */
                    itemsContainer.innerHTML = '';

                    itemIndex = 0;


                    /*
                    * Add quotation items
                    */
                    data.items.forEach(function (item) {

                        const row =
                            document.createElement('tr');

                        row.classList.add('invoice-item');

                        row.innerHTML = `
                            <td>
                                <input
                                    type="text"
                                    name="items[${itemIndex}][item_name]"
                                    value="${escapeHtml(item.item_name ?? '')}"
                                    class="item-name-input"
                                    required
                                >

                                <input
                                    type="text"
                                    name="items[${itemIndex}][item_description]"
                                    value="${escapeHtml(item.item_description ?? '')}"
                                    class="item-description-input"
                                >
                            </td>

                            <td>
                                <input
                                    type="number"
                                    name="items[${itemIndex}][quantity]"
                                    value="${item.quantity ?? 1}"
                                    min="1"
                                    class="item-quantity"
                                    required
                                >
                            </td>

                            <td>
                                <input
                                    type="number"
                                    name="items[${itemIndex}][unit_price]"
                                    value="${item.unit_price ?? 0}"
                                    min="0"
                                    step="0.01"
                                    class="item-price"
                                    required
                                >
                            </td>

                            <td>
                                <span class="item-amount">
                                    ₹0.00
                                </span>
                            </td>

                            <td>
                                <button
                                    type="button"
                                    class="delete-btn"
                                >
                                    ×
                                </button>
                            </td>
                        `;

                        itemsContainer.appendChild(row);

                        itemIndex++;
                    });


                    calculateTotals();
                })
                .catch(error => {

                    console.error(error);

                    alert(
                        'Unable to load quotation details.'
                    );
                });
        });


    function escapeHtml(value)
    {
        const div = document.createElement('div');

        div.textContent = value;

        return div.innerHTML;
    }
</script>

@endsection