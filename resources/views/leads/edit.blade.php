@extends('layouts.app')

@section('title','Create Lead')

@section('page-title','Create Lead')


@section('content')


<div class="lead-form-page">

    <div class="page-header">
        <div>
            <h1>Edit Lead</h1>
            <p>Update the details of an existing lead.</p>
        </div>
        <div class="project-header-actions">

            <a href="{{ route('leads.index') }}" class="btn-secondary">
                ← Back To Leads
            </a>

        </div>
    </div>

    <div class="form-card">
        <form method="POST" action="{{ route('leads.update', $lead->id) }}">

            @csrf
            @method('PUT')

            <div class="form-grid">


                <div class="form-group">

                    <label>
                        Name *
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name',$lead->name) }}"
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
                        value="{{ old('email',$lead->email) }}"
                        placeholder="Enter email"
                    >

                </div>




                <div class="form-group">

                    <label>
                        Phone
                    </label>

                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone',$lead->phone) }}"
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
                        value="{{ old('company_name',$lead->company_name) }}"
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

                        <option value="Website" {{ old('source',$lead->source) == 'Website' ? 'selected' : '' }}>
                            Website
                        </option>

                        <option value="Referral" {{ old('source',$lead->source) == 'Referral' ? 'selected' : '' }}>
                            Referral
                        </option>

                        <option value="Social Media" {{ old('source',$lead->source) == 'Social Media' ? 'selected' : '' }}>
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
                >{{ old('notes',$lead->notes) }}</textarea>

            </div>



            <button class="save-btn">

                Save Lead

            </button>


        </form>
    </div>


</div>
@endsection