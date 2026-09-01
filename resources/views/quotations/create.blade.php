@extends('layouts.app')

@section('title', 'Create Quotation')

@section('page-title', 'Create Quotation')

@section('content')

<div class="project-form-page">

    <div class="page-header">

        <div>
            <h1>Add Quotation</h1>
            <p>Create a quotation for your client.</p>
        </div>

        <div class="header-actions">

            <a href="{{ route('quotations.index') }}" class="btn-secondary">
                ← Back to Quotations
            </a>

        </div>

    </div>

    <div class="form-card">

        <form action="{{ route('quotations.store') }}" method="POST">

            @csrf

            <div class="form-grid">

                {{-- Client --}}
                <div class="form-group">

                    <label for="client_id">Client *</label>

                    <select id="client_id" name="client_id">

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


                {{-- Project --}}
                <div class="form-group">

                    <label for="project_id">Project</label>

                    <select id="project_id" name="project_id">

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


                {{-- Quotation Date --}}
                <div class="form-group">

                    <label for="quotation_date">Quotation Date *</label>

                    <input
                        type="date"
                        id="quotation_date"
                        name="quotation_date"
                        value="{{ old('quotation_date', date('Y-m-d')) }}"
                    >

                </div>


                {{-- Valid Until --}}
                <div class="form-group">

                    <label for="valid_until">Valid Until *</label>

                    <input
                        type="date"
                        id="valid_until"
                        name="valid_until"
                        value="{{ old('valid_until') }}"
                    >

                </div>


                {{-- Status --}}
                <div class="form-group">

                    <label for="status">Status *</label>

                    <select id="status" name="status">

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
                                {{-- <th>Tax %</th> --}}
                                <th>Amount</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody id="quotation-items">

                            <tr class="quotation-item">

                                <td>
                                    <input
                                        type="text"
                                        name="items[0{{-- Quotation Items --}}][item_name]"
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

                                {{-- <td>
                                    <input
                                        type="number"
                                        name="items[0][tax]"
                                        value="0"
                                        min="0"
                                        step="0.01"
                                        class="item-tax"
                                    >
                                </td> --}}

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

            </div>


            {{-- Discount & Tax --}}
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

                    <label for="tax">Tax %</label>

                    <input
                        type="number"
                        id="tax"
                        name="tax"
                        value="{{ old('tax', 0) }}"
                        min="0"
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
                >{{ old('notes') }}</textarea>

            </div>


            {{-- Terms --}}
            <div class="form-group full-width">

                <label for="terms">Terms & Conditions</label>

                <textarea
                    id="terms"
                    name="terms"
                    rows="4"
                    placeholder="Enter terms and conditions"
                >{{ old('terms') }}</textarea>

            </div>


            <div class="form-actions">

                <button
                    type="submit"
                    class="btn-primary"
                >
                    Create Quotation
                </button>

            </div>

        </form>

    </div>

</div>

@endsection