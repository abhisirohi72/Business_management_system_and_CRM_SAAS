@extends('layouts.app')

@section('content')

<style>
    .project-form-page {
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

    .page-header .project-header-actions {
        display: flex;
        gap: 10px;
    }
</style>


<div class="project-form-page">

    {{-- Page Header --}}
    <div class="page-header">

        <div>
            <h1>Add Project</h1>
            <p>Create a new project for your client.</p>
        </div>

        <div class="project-header-actions">

            <a href="{{ route('projects.index') }}" class="btn-secondary">
                ← Back to Projects
            </a>

        </div>

    </div>


    {{-- Form Card --}}
    <div class="form-card">

        <form action="{{ route('projects.store') }}" method="POST">

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

                    @error('client_id')
                        <span class="error">{{ $message }}</span>
                    @enderror

                </div>


                {{-- Project Name --}}
                <div class="form-group">

                    <label for="name">Project Name *</label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Enter project name"
                    >

                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror

                </div>


                {{-- Status --}}
                <div class="form-group">

                    <label for="status">Status *</label>

                    <select id="status" name="status">

                        <option value="pending"
                            {{ old('status', 'pending') === 'pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                        <option value="in_progress"
                            {{ old('status') === 'in_progress' ? 'selected' : '' }}>
                            In Progress
                        </option>

                        <option value="completed"
                            {{ old('status') === 'completed' ? 'selected' : '' }}>
                            Completed
                        </option>

                        <option value="cancelled"
                            {{ old('status') === 'cancelled' ? 'selected' : '' }}>
                            Cancelled
                        </option>

                    </select>

                    @error('status')
                        <span class="error">{{ $message }}</span>
                    @enderror

                </div>


                {{-- Priority --}}
                <div class="form-group">

                    <label for="priority">Priority *</label>

                    <select id="priority" name="priority">

                        <option value="low"
                            {{ old('priority', 'medium') === 'low' ? 'selected' : '' }}>
                            Low
                        </option>

                        <option value="medium"
                            {{ old('priority', 'medium') === 'medium' ? 'selected' : '' }}>
                            Medium
                        </option>

                        <option value="high"
                            {{ old('priority') === 'high' ? 'selected' : '' }}>
                            High
                        </option>

                        <option value="urgent"
                            {{ old('priority') === 'urgent' ? 'selected' : '' }}>
                            Urgent
                        </option>

                    </select>

                    @error('priority')
                        <span class="error">{{ $message }}</span>
                    @enderror

                </div>


                {{-- Start Date --}}
                <div class="form-group">

                    <label for="start_date">Start Date</label>

                    <input
                        type="date"
                        id="start_date"
                        name="start_date"
                        value="{{ old('start_date') }}"
                    >

                    @error('start_date')
                        <span class="error">{{ $message }}</span>
                    @enderror

                </div>


                {{-- Due Date --}}
                <div class="form-group">

                    <label for="due_date">Due Date</label>

                    <input
                        type="date"
                        id="due_date"
                        name="due_date"
                        value="{{ old('due_date') }}"
                    >

                    @error('due_date')
                        <span class="error">{{ $message }}</span>
                    @enderror

                </div>


                {{-- Budget --}}
                <div class="form-group">

                    <label for="budget">Budget</label>

                    <input
                        type="number"
                        id="budget"
                        name="budget"
                        value="{{ old('budget') }}"
                        placeholder="Enter project budget"
                        step="0.01"
                        min="0"
                    >

                    @error('budget')
                        <span class="error">{{ $message }}</span>
                    @enderror

                </div>


                {{-- Description --}}
                <div class="form-group full-width">

                    <label for="description">Description</label>

                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        placeholder="Enter project description"
                    >{{ old('description') }}</textarea>

                    @error('description')
                        <span class="error">{{ $message }}</span>
                    @enderror

                </div>

            </div>


            {{-- Actions --}}
            <div class="form-actions">

                <a
                    href="{{ route('projects.index') }}"
                    class="btn-secondary"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="btn-primary"
                >
                    Create Project
                </button>

            </div>

        </form>

    </div>

</div>

@endsection