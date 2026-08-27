@extends('layouts.app')

@section('title','Create Client')

@section('page-title','Create Client')

@section('content')
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
{{-- 
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror --}}
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

                    {{-- @error('phone')
                        <span class="error">{{ $message }}</span>
                    @enderror --}}
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

                    {{-- @error('company_name')
                        <span class="error">{{ $message }}</span>
                    @enderror --}}
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

                    {{-- @error('status')
                        <span class="error">{{ $message }}</span>
                    @enderror --}}

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

                    {{-- @error('address')
                        <span class="error">{{ $message }}</span>
                    @enderror --}}

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

                    {{-- @error('notes')
                        <span class="error">{{ $message }}</span>
                    @enderror --}}

                </div>

            </div>


            <div class="form-actions">
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