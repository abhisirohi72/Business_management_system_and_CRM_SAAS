@extends('layouts.app')

@section('title', 'Edit Quotation')

@section('page-title', 'Edit Quotation')

@section('content')

<div class="project-form-page">

<div class="page-header">

    <div>
        <h1>Edit Quotation</h1>
        <p>Update quotation details and items.</p>
    </div>

    <div class="header-actions">

        <a href="{{ route('quotations.index') }}" class="btn-secondary">
            ← Back to Quotations
        </a>

    </div>

</div>


<div class="form-card">

    <form
        action="{{ route('quotations.update', $quotation) }}"
        method="POST"
    >

        @csrf
        @method('PUT')


        <div class="form-grid">

            {{-- Client --}}
            <div class="form-group">

                <label for="client_id">Client *</label>

                <select id="client_id" name="client_id">

                    <option value="">Select Client</option>

                    @foreach($clients as $client)

                        <option
                            value="{{ $client->id }}"
                            {{ old('client_id', $quotation->client_id) == $client->id ? 'selected' : '' }}
                        >
                            {{ $client->name }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Project --}}
            <div class="form-group">

                <label for="project_id">Project</label>

                <select id="project_id" name="project_id">

                    <option value="">Select Project</option>

                    @foreach($projects as $project)

                        <option
                            value="{{ $project->id }}"
                            {{ old('project_id', $quotation->project_id) == $project->id ? 'selected' : '' }}
                        >
                            {{ $project->name }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Quotation Date --}}
            <div class="form-group">

                <label for="quotation_date">Quotation Date *</label>

                <input
                    type="date"
                    id="quotation_date"
                    name="quotation_date"
                    value="{{ old('quotation_date', $quotation->quotation_date?->format('Y-m-d')) }}"
                >

            </div>


            {{-- Valid Until --}}
            <div class="form-group">

                <label for="valid_until">Valid Until *</label>

                <input
                    type="date"
                    id="valid_until"
                    name="valid_until"
                    value="{{ old('valid_until', $quotation->valid_until?->format('Y-m-d')) }}"
                >

            </div>


            {{-- Status --}}
            <div class="form-group">

                <label for="status">Status *</label>

                <select id="status" name="status">

                    <option value="draft"
                        {{ old('status', $quotation->status) === 'draft' ? 'selected' : '' }}>
                        Draft
                    </option>

                    <option value="sent"
                        {{ old('status', $quotation->status) === 'sent' ? 'selected' : '' }}>
                        Sent
                    </option>

                    <option value="accepted"
                        {{ old('status', $quotation->status) === 'accepted' ? 'selected' : '' }}>
                        Accepted
                    </option>

                    <option value="rejected"
                        {{ old('status', $quotation->status) === 'rejected' ? 'selected' : '' }}>
                        Rejected
                    </option>

                    <option value="expired"
                        {{ old('status', $quotation->status) === 'expired' ? 'selected' : '' }}>
                        Expired
                    </option>

                </select>

            </div>

        </div>


        {{-- Quotation Items --}}
        <div class="form-group full-width">

            <div class="items-header">

                <label>Quotation Items *</label>

                <button
                    type="button"
                    id="add-item"
                    class="add-btn"
                    style="margin-bottom:5px;"
                >
                    + Add Item
                </button>

            </div>


            <div class="quotation-items-wrapper">

                <table class="quotation-items-table">

                    <thead>

                        <tr>
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Unit Price</th>
                            <th>Amount</th>
                            <th></th>
                        </tr>

                    </thead>


                    <tbody id="quotation-items">

                        @forelse($quotation->items as $index => $item)

                            <tr class="quotation-item">

                                <td>

                                    <input
                                        type="text"
                                        name="items[{{ $index }}][item_name]"
                                        value="{{ old("items.$index.item_name", $item->item_name) }}"
                                        placeholder="Item name"
                                    >

                                    <input
                                        type="text"
                                        name="items[{{ $index }}][item_description]"
                                        value="{{ old("items.$index.item_description", $item->item_description) }}"
                                        placeholder="Description"
                                        style="margin-top: 5px; width: 100%;"
                                    >

                                </td>


                                <td>

                                    <input
                                        type="number"
                                        name="items[{{ $index }}][quantity]"
                                        value="{{ old("items.$index.quantity", $item->quantity) }}"
                                        min="1"
                                        class="item-quantity"
                                    >

                                </td>


                                <td>

                                    <input
                                        type="number"
                                        name="items[{{ $index }}][unit_price]"
                                        value="{{ old("items.$index.unit_price", $item->unit_price) }}"
                                        placeholder="0.00"
                                        min="0"
                                        step="0.01"
                                        class="item-price"
                                    >

                                </td>


                                <td>

                                    <span class="item-amount">
                                        ₹{{ number_format($item->amount, 2) }}
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

                        @empty

                            <tr class="quotation-item">

                                <td>

                                    <input
                                        type="text"
                                        name="items[0][item_name]"
                                        placeholder="Item name"
                                    >

                                    <input
                                        type="text"
                                        name="items[0][item_description]"
                                        placeholder="Description"
                                        style="margin-top: 5px; width: 100%;"
                                    >

                                </td>

                                <td>

                                    <input
                                        type="number"
                                        name="items[0][quantity]"
                                        value="1"
                                        min="1"
                                        class="item-quantity"
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

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- Discount & Tax --}}
        <div class="form-grid">

            <div class="form-group">

                <label for="discount">Discount</label>

                <input
                    type="number"
                    id="discount"
                    name="discount"
                    value="{{ old('discount', $quotation->discount ?? 0) }}"
                    min="0"
                    step="0.01"
                >

            </div>


            <div class="form-group">

                <label for="tax">Tax %</label>

                <input
                    type="number"
                    id="tax"
                    name="tax"
                    value="{{ old('tax', $quotation->tax_rate) }}"
                    min="0"
                    max="100"
                    step="0.01"
                >

            </div>

        </div>


        {{-- Quotation Summary --}}
        <div class="quotation-summary">

            <div class="summary-row">
                <span>Subtotal</span>
                <strong id="subtotal">₹0.00</strong>
            </div>

            <div class="summary-row">
                <span>Discount</span>
                <strong id="discount-display">₹0.00</strong>
            </div>

            <div class="summary-row">
                <span>Tax</span>
                <strong id="tax-display">₹0.00</strong>
            </div>

            <div class="summary-row total-row">
                <span>Total</span>
                <strong id="total">₹0.00</strong>
            </div>

        </div>


        {{-- Notes --}}
        <div class="form-group full-width">

            <label for="notes">Notes</label>

            <textarea
                id="notes"
                name="notes"
                rows="4"
                placeholder="Enter notes"
            >{{ old('notes', $quotation->notes) }}</textarea>

        </div>


        {{-- Terms --}}
        <div class="form-group full-width">

            <label for="terms">Terms & Conditions</label>

            <textarea
                id="terms"
                name="terms"
                rows="4"
                placeholder="Enter terms and conditions"
            >{{ old('terms', $quotation->terms) }}</textarea>

        </div>


        <div class="form-actions">

            <button
                type="submit"
                class="btn-primary"
            >
                Update Quotation
            </button>

        </div>

    </form>

</div>


</div>

<script>

    let itemIndex = {{ $quotation->items->count() }};


    const itemsContainer =
        document.getElementById('quotation-items');

    const addItemButton =
        document.getElementById('add-item');


    /*
    |--------------------------------------------------------------------------
    | Add Item
    |--------------------------------------------------------------------------
    */

    addItemButton.addEventListener('click', function () {

        const row = document.createElement('tr');

        row.classList.add('quotation-item');


        row.innerHTML = `

            <td>

                <input
                    type="text"
                    name="items[${itemIndex}][item_name]"
                    placeholder="Item name"
                >

                <input
                    type="text"
                    name="items[${itemIndex}][item_description]"
                    placeholder="Description"
                    style="margin-top: 5px; width: 100%;"
                >

            </td>


            <td>

                <input
                    type="number"
                    name="items[${itemIndex}][quantity]"
                    value="1"
                    min="1"
                    class="item-quantity"
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


    /*
    |--------------------------------------------------------------------------
    | Delete Item
    |--------------------------------------------------------------------------
    */

    itemsContainer.addEventListener('click', function (event) {

        if (
            event.target.classList.contains('delete-btn')
        ) {

            const rows =
                itemsContainer.querySelectorAll('.quotation-item');


            if (rows.length > 1) {

                event.target
                    .closest('.quotation-item')
                    .remove();

                calculateTotals();

            }

        }

    });


    /*
    |--------------------------------------------------------------------------
    | Item Calculation
    |--------------------------------------------------------------------------
    */

    itemsContainer.addEventListener('input', function (event) {

        if (
            event.target.classList.contains('item-quantity') ||
            event.target.classList.contains('item-price')
        ) {

            calculateTotals();

        }

    });


    /*
    |--------------------------------------------------------------------------
    | Discount & Tax Calculation
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('discount')
        .addEventListener('input', calculateTotals);


    document
        .getElementById('tax')
        .addEventListener('input', calculateTotals);


    /*
    |--------------------------------------------------------------------------
    | Calculate Totals
    |--------------------------------------------------------------------------
    */

    function calculateTotals()
    {

        let subtotal = 0;


        const rows =
            itemsContainer.querySelectorAll('.quotation-item');


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


        const taxPercentage =
            parseFloat(
                document.getElementById('tax').value
            ) || 0;


        const taxableAmount =
            Math.max(
                subtotal - discount,
                0
            );


        const taxAmount =
            (taxableAmount * taxPercentage) / 100;


        const total =
            taxableAmount + taxAmount;


        document.getElementById('subtotal').textContent =
            '₹' + subtotal.toFixed(2);


        document.getElementById('discount-display').textContent =
            '₹' + discount.toFixed(2);


        document.getElementById('tax-display').textContent =
            '₹' + taxAmount.toFixed(2);


        document.getElementById('total').textContent =
            '₹' + total.toFixed(2);

    }


    /*
    |--------------------------------------------------------------------------
    | Initial Calculation
    |--------------------------------------------------------------------------
    */

    calculateTotals();

</script>

@endsection
