@extends('layouts.app')

@section('content')
<style>
    .client-form-page {
        padding: 30px;
    }

    .form-card {
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-group label {
        margin-bottom: 7px;
        font-size: 14px;
        font-weight: 600;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        padding: 10px 12px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 14px;
        outline: none;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: #2563eb;
    }

    .error {
        margin-top: 5px;
        color: #dc2626;
        font-size: 12px;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 25px;
    }

    .btn-secondary {
        display: inline-block;
        padding: 10px 16px;
        background: #f3f4f6;
        color: #374151;
        border-radius: 7px;
        text-decoration: none;
        border: none;
        cursor: pointer;
    }

    .btn-primary {
        padding: 10px 16px;
        background: #2563eb;
        color: #fff;
        border: none;
        border-radius: 7px;
        cursor: pointer;
    }
    .page-header .client-header-actions {
        display: flex;
        gap: 10px;
    }
</style>
<div class="client-form-page">

    <div class="page-header">
        <div>
            <h1>Add Client</h1>
            <p>Create a new client for your company.</p>
        </div>
        
        <div class="client-header-actions">
            <a href="{{ route('clients.index') }}" class="btn-secondary">
                ← Back to Clients
            </a>
        </div>
    </div>


    <div class="form-card">

        <form action="{{ route('clients.store') }}" method="POST">

            @csrf

            <div class="form-grid">

                {{-- Name --}}
                <div class="form-group">
                    <label for="name">Name *</label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Enter client name"
                    >

                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>


                {{-- Email --}}
                <div class="form-group">
                    <label for="email">Email</label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="client@example.com"
                    >

                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>


                {{-- Phone --}}
                <div class="form-group">
                    <label for="phone">Phone</label>

                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        value="{{ old('phone') }}"
                        placeholder="Enter phone number"
                    >

                    @error('phone')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>


                {{-- Company Name --}}
                <div class="form-group">
                    <label for="company_name">Company Name</label>

                    <input
                        type="text"
                        id="company_name"
                        name="company_name"
                        value="{{ old('company_name') }}"
                        placeholder="Client company"
                    >

                    @error('company_name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>


                {{-- Status --}}
                <div class="form-group">

                    <label for="status">Status *</label>

                    <select id="status" name="status">

                        <option value="active"
                            {{ old('status', 'active') === 'active' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="inactive"
                            {{ old('status') === 'inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>

                    @error('status')
                        <span class="error">{{ $message }}</span>
                    @enderror

                </div>


                {{-- Address --}}
                <div class="form-group full-width">

                    <label for="address">Address</label>

                    <textarea
                        id="address"
                        name="address"
                        rows="3"
                        placeholder="Enter client address"
                    >{{ old('address') }}</textarea>

                    @error('address')
                        <span class="error">{{ $message }}</span>
                    @enderror

                </div>


                {{-- Notes --}}
                <div class="form-group full-width">

                    <label for="notes">Notes</label>

                    <textarea
                        id="notes"
                        name="notes"
                        rows="4"
                        placeholder="Additional notes"
                    >{{ old('notes') }}</textarea>

                    @error('notes')
                        <span class="error">{{ $message }}</span>
                    @enderror

                </div>

            </div>


            <div class="form-actions">

                <a
                    href="{{ route('clients.index') }}"
                    class="btn-secondary"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="btn-primary"
                >
                    Create Client
                </button>

            </div>

        </form>

    </div>

</div>

@endsection