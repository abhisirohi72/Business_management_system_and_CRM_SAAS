@extends('layouts.app')

@section('title', 'Edit Task')

@section('page-title', 'Edit Task')

@section('content')

<div class="project-form-page">

{{-- Page Header --}}
<div class="page-header">

    <div>
        <h1>Edit Task</h1>
        <p>Update the task details for your project.</p>
    </div>

    <div class="header-actions">

        <a href="{{ route('tasks.index') }}" class="btn-secondary">
            ← Back to Tasks
        </a>

    </div>

</div>


{{-- Form Card --}}
<div class="form-card">

    <form action="{{ route('tasks.update', $task) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="form-grid">

            {{-- Project --}}
            <div class="form-group">

                <label for="project_id">Project *</label>

                <select id="project_id" name="project_id">

                    <option value="">Select Project</option>

                    @foreach($projects as $project)

                        <option
                            value="{{ $project->id }}"
                            {{ old('project_id', $task->project_id) == $project->id ? 'selected' : '' }}
                        >
                            {{ $project->name }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Assigned To --}}
            <div class="form-group">

                <label for="assigned_to">Assigned To</label>

                <select id="assigned_to" name="assigned_to">

                    <option value="">Select User</option>

                    @foreach($users as $user)

                        <option
                            value="{{ $user->id }}"
                            {{ old('assigned_to', $task->assigned_to) == $user->id ? 'selected' : '' }}
                        >
                            {{ $user->name }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Task Name --}}
            <div class="form-group">

                <label for="title">Task Name *</label>

                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title', $task->title) }}"
                    placeholder="Enter task name"
                >

            </div>


            {{-- Status --}}
            <div class="form-group">

                <label for="status">Status *</label>

                <select id="status" name="status">

                    <option value="pending"
                        {{ old('status', $task->status) === 'pending' ? 'selected' : '' }}>
                        Pending
                    </option>

                    <option value="in_progress"
                        {{ old('status', $task->status) === 'in_progress' ? 'selected' : '' }}>
                        In Progress
                    </option>

                    <option value="completed"
                        {{ old('status', $task->status) === 'completed' ? 'selected' : '' }}>
                        Completed
                    </option>

                    <option value="on_hold"
                        {{ old('status', $task->status) === 'on_hold' ? 'selected' : '' }}>
                        On Hold
                    </option>

                    <option value="cancelled"
                        {{ old('status', $task->status) === 'cancelled' ? 'selected' : '' }}>
                        Cancelled
                    </option>

                </select>

            </div>


            {{-- Priority --}}
            <div class="form-group">

                <label for="priority">Priority *</label>

                <select id="priority" name="priority">

                    <option value="low"
                        {{ old('priority', $task->priority) === 'low' ? 'selected' : '' }}>
                        Low
                    </option>

                    <option value="medium"
                        {{ old('priority', $task->priority) === 'medium' ? 'selected' : '' }}>
                        Medium
                    </option>

                    <option value="high"
                        {{ old('priority', $task->priority) === 'high' ? 'selected' : '' }}>
                        High
                    </option>

                    <option value="urgent"
                        {{ old('priority', $task->priority) === 'urgent' ? 'selected' : '' }}>
                        Urgent
                    </option>

                </select>

            </div>


            {{-- Start Date --}}
            <div class="form-group">

                <label for="start_date">Start Date</label>

                <input
                    type="date"
                    id="start_date"
                    name="start_date"
                    value="{{ old('start_date', $task->start_date) }}"
                >

            </div>


            {{-- Due Date --}}
            <div class="form-group">

                <label for="due_date">Due Date</label>

                <input
                    type="date"
                    id="due_date"
                    name="due_date"
                    value="{{ old('due_date', $task->due_date) }}"
                >

            </div>


            {{-- Description --}}
            <div class="form-group full-width">

                <label for="description">Description</label>

                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    placeholder="Enter task description"
                >{{ old('description', $task->description) }}</textarea>

            </div>

        </div>


        {{-- Actions --}}
        <div class="form-actions">

            <button
                type="submit"
                class="btn-primary"
            >
                Update Task
            </button>

        </div>

    </form>

</div>

</div>

@endsection
