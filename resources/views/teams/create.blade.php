```blade
@extends('layouts.app')

@section('title','Create Team Member')

@section('page-title','Create Team Member')

@section('content')

<div class="project-form-page">

    {{-- Page Header --}}
    <div class="page-header">

        <div>
            <h1>Add Team Member</h1>
            <p>Create a new team member for your company.</p>
        </div>

        <div class="header-actions">

            <a href="{{ route('teams.index') }}" class="btn-secondary">
                ← Back to Team
            </a>

        </div>

    </div>


    {{-- Form Card --}}
    <div class="form-card">

        <form action="{{ route('teams.store') }}" method="POST">

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
                        placeholder="Enter team member name"
                    >
                </div>


                {{-- Email --}}
                <div class="form-group">

                    <label for="email">Email *</label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Enter email address"
                    >
                </div>


                {{-- Password --}}
                <div class="form-group">

                    <label for="password">Password *</label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter password"
                    >

                </div>


                {{-- Confirm Password --}}
                <div class="form-group">

                    <label for="password_confirmation">Confirm Password *</label>

                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Confirm password"
                    >
                </div>


                {{-- Role --}}
                <div class="form-group">

                    <label for="role_id">Role *</label>

                    <select id="role_id" name="role_id">

                        <option value="">Select Role</option>

                        @foreach($roles as $role)

                            <option
                                value="{{ $role->id }}"
                                {{ old('role_id') == $role->id ? 'selected' : '' }}
                            >
                                {{ $role->name }}
                            </option>

                        @endforeach

                    </select>
                </div>

            </div>


            {{-- Actions --}}
            <div class="form-actions">

                <button
                    type="submit"
                    class="btn-primary"
                >
                    Create Team Member
                </button>

            </div>

        </form>

    </div>

</div>

@endsection
```
