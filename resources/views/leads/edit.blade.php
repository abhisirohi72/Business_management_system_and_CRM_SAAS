@extends('layouts.app')

@section('title','Create Lead')

@section('page-title','Create Lead')


@section('content')


<div class="form-card">

    <div class="form-header">

        <h2>
            Edit Lead
        </h2>

        <p>
            Update the details of an existing lead.
        </p>

    </div>


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

                @error('name')
                    <small class="error">
                        {{ $message }}
                    </small>
                @enderror

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



<style>

.form-card {

    background:white;
    padding:30px;
    border-radius:12px;
    box-shadow:0 5px 20px rgba(0,0,0,.05);

}


.form-header {

    margin-bottom:25px;

}


.form-header h2 {

    font-size:22px;

}


.form-header p {

    color:#6b7280;
    font-size:14px;

}


.form-grid {

    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:20px;

}


.form-group {

    margin-bottom:20px;

}


label {

    display:block;
    font-size:13px;
    font-weight:600;
    margin-bottom:7px;

}


input,
select,
textarea {

    width:100%;
    padding:12px;
    border:1px solid #d1d5db;
    border-radius:8px;
    outline:none;

}


input:focus,
select:focus,
textarea:focus {

    border-color:#4f46e5;

}


.error {

    color:#dc2626;
    font-size:12px;

}


.save-btn {

    background:#4f46e5;
    color:white;
    border:none;
    padding:12px 25px;
    border-radius:8px;
    cursor:pointer;
    font-weight:600;

}


.save-btn:hover {

    background:#4338ca;

}


@media(max-width:700px){

    .form-grid{

        grid-template-columns:1fr;

    }

}


</style>


@endsection