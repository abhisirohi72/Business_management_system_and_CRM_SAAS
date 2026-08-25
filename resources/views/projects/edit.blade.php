@extends('layouts.app')

@section('content')

<div class="project-form-page">

    {{-- Page Header --}}
    <div class="page-header">

        <div>
            <h1>Edit Project</h1>
            <p>Update project information for your client.</p>
        </div>

        <div class="project-header-actions">

            <a href="{{ route('projects.index') }}" class="btn-secondary">
                ← Back To Projects
            </a>

        </div>

    </div>


    {{-- Form Card --}}
    <div class="form-card">

        <form
            action="{{ route('projects.update', $project) }}"
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
                                {{ old('client_id', $project->client_id) == $client->id ? 'selected' : '' }}
                            >
                                {{ $client->name }}
                            </option>

                        @endforeach

                    </select>

                    {{-- @error('client_id')
                        <span class="error">{{ $message }}</span>
                    @enderror --}}

                </div>


                {{-- Project Name --}}
                <div class="form-group">

                    <label for="name">Project Name *</label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $project->name) }}"
                        placeholder="Enter project name"
                    >

                    {{-- @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror --}}

                </div>


                {{-- Status --}}
                <div class="form-group">

                    <label for="status">Status *</label>

                    <select id="status" name="status">

                        <option value="pending"
                            {{ old('status', $project->status) === 'pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                        <option value="in_progress"
                            {{ old('status', $project->status) === 'in_progress' ? 'selected' : '' }}>
                            In Progress
                        </option>

                        <option value="completed"
                            {{ old('status', $project->status) === 'completed' ? 'selected' : '' }}>
                            Completed
                        </option>

                        <option value="cancelled"
                            {{ old('status', $project->status) === 'cancelled' ? 'selected' : '' }}>
                            Cancelled
                        </option>

                    </select>

                    {{-- @error('status')
                        <span class="error">{{ $message }}</span>
                    @enderror --}}

                </div>


                {{-- Priority --}}
                <div class="form-group">

                    <label for="priority">Priority *</label>

                    <select id="priority" name="priority">

                        <option value="low"
                            {{ old('priority', $project->priority) === 'low' ? 'selected' : '' }}>
                            Low
                        </option>

                        <option value="medium"
                            {{ old('priority', $project->priority) === 'medium' ? 'selected' : '' }}>
                            Medium
                        </option>

                        <option value="high"
                            {{ old('priority', $project->priority) === 'high' ? 'selected' : '' }}>
                            High
                        </option>

                        <option value="urgent"
                            {{ old('priority', $project->priority) === 'urgent' ? 'selected' : '' }}>
                            Urgent
                        </option>

                    </select>

                    {{-- @error('priority')
                        <span class="error">{{ $message }}</span>
                    @enderror --}}

                </div>


                {{-- Start Date --}}
                <div class="form-group">

                    <label for="start_date">Start Date</label>

                    <input
                        type="date"
                        id="start_date"
                        name="start_date"
                        value="{{ old('start_date', $project->start_date) }}"
                    >

                    {{-- @error('start_date')
                        <span class="error">{{ $message }}</span>
                    @enderror --}}

                </div>


                {{-- Due Date --}}
                <div class="form-group">

                    <label for="due_date">Due Date</label>

                    <input
                        type="date"
                        id="due_date"
                        name="due_date"
                        value="{{ old('due_date', $project->due_date) }}"
                    >

                    {{-- @error('due_date')
                        <span class="error">{{ $message }}</span>
                    @enderror --}}

                </div>


                {{-- Budget --}}
                <div class="form-group">

                    <label for="budget">Budget</label>

                    <input
                        type="number"
                        id="budget"
                        name="budget"
                        value="{{ old('budget', $project->budget) }}"
                        placeholder="Enter project budget"
                        step="0.01"
                        min="0"
                    >

                    {{-- @error('budget')
                        <span class="error">{{ $message }}</span>
                    @enderror --}}

                </div>


                {{-- Description --}}
                <div class="form-group full-width">

                    <label for="description">Description</label>

                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        placeholder="Enter project description"
                    >{{ old('description', $project->description) }}</textarea>

                    {{-- @error('description')
                        <span class="error">{{ $message }}</span>
                    @enderror --}}

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
                    Update Project
                </button>

            </div>

        </form>

    </div>

</div>

@endsection