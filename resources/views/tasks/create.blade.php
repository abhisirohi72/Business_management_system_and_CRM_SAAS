@extends('layouts.app')

@section('title','Create Task')

@section('page-title','Create Task')

@section('content')

<div class="project-form-page">

    {{-- Page Header --}}
    <div class="page-header">

        <div>
            <h1>Add Task</h1>
            <p>Create a new task for your project.</p>
        </div>

        <div class="header-actions">

            <a href="{{ route('tasks.index') }}" class="btn-secondary">
                ← Back to Tasks
            </a>

        </div>

    </div>


    {{-- Form Card --}}
    <div class="form-card">

        <form action="{{ route('tasks.store') }}" method="POST">

            @csrf
            
            <div class="form-grid">

                {{-- Project --}}
                <div class="form-group">

                    <label for="project_id">Project *</label>

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

                {{-- Assigned To --}}
                <div class="form-group">

                    <label for="assigned_to">Assigned To *</label>

                    <select id="assigned_to" name="assigned_to">

                        <option value="">Select User</option>

                        @foreach($users as $user)

                            <option
                                value="{{ $user->id }}"
                                {{ old('assigned_to') == $user->id ? 'selected' : '' }}
                            >
                                {{ $user->name }}
                            </option>

                        @endforeach

                    </select>
                </div>

                {{-- Task Name --}}
                <div class="form-group">

                    <label for="name">Task Name *</label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Enter task name"
                    >
                </div>


                {{-- Status --}}
                <div class="form-group">

                    <label for="status">Status *</label>

                    <select id="status" name="status">
                        <option value="in_progress"
                            {{ old('status') === 'in_progress' ? 'selected' : '' }}>
                            In Progress
                        </option>

                        <option value="completed"
                            {{ old('status') === 'completed' ? 'selected' : '' }}>
                            Completed
                        </option>

                        <option value="on_hold"
                            {{ old('status') === 'on_hold' ? 'selected' : '' }}>
                            On Hold
                        </option>                     

                        <option value="cancelled"
                            {{ old('status') === 'cancelled' ? 'selected' : '' }}>
                            Cancelled
                        </option>

                    </select>
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
                        value="{{ old('start_date') }}"
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
                        value="{{ old('due_date') }}"
                    >
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

                    {{-- @error('description')
                        <span class="error">{{ $message }}</span>
                    @enderror --}}

                </div>

            </div>


            {{-- Actions --}}
            <div class="form-actions">

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