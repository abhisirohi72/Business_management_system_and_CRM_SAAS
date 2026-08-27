@extends('layouts.app')

@section('title','Create Lead')

@section('page-title','Create Lead')


@section('content')

<div class="leads-form-page">

    <div class="page-header">
        <div>
            <h1>Add Lead</h1>
            <p>Create a new potential customer.</p>
        </div>

        <div class="header-actions">

            <a href="{{ route('leads.index') }}" class="btn-secondary">
                ← Back to Leads
            </a>

        </div>
    </div>

    {{-- Form Card --}}
    <div class="form-card">
        <form method="POST" action="{{ route('leads.store') }}">

            @csrf


            <div class="form-grid">


                <div class="form-group">

                    <label>
                        Name *
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Enter lead name"
                    >

                </div>



                <div class="form-group">

                    <label>
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Enter email"
                    >

                    @error('email')
                        <small class="error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>




                <div class="form-group">

                    <label>
                        Phone
                    </label>

                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone') }}"
                        placeholder="Enter phone"
                    >

                </div>




                <div class="form-group">

                    <label>
                        Company Name
                    </label>

                    <input
                        type="text"
                        name="company_name"
                        value="{{ old('company_name') }}"
                        placeholder="Company name"
                    >

                </div>




                <div class="form-group">

                    <label>
                        Source
                    </label>

                    <select name="source">

                        <option value="">
                            Select Source
                        </option>

                        <option value="Website">
                            Website
                        </option>

                        <option value="Referral">
                            Referral
                        </option>

                        <option value="Social Media">
                            Social Media
                        </option>

                    </select>

                </div>


            </div>



            <div class="form-group">

                <label>
                    Notes
                </label>

                <textarea
                    name="notes"
                    rows="4"
                    placeholder="Add notes..."
                >{{ old('notes') }}</textarea>

            </div>



            <button class="save-btn">

                Save Lead

            </button>


        </form>
    </div>    

</div>
@endsection