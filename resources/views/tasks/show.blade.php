@extends('layouts.app')

@section('content')
<style>
.task-show-page {
    padding: 30px;
    width: 100%;
    box-sizing: border-box;
}

.task-show-page .task-page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}

.task-show-page .task-page-header h1 {
    margin: 0;
    font-size: 28px;
    color: #111827;
}

.task-show-page .task-page-header p {
    margin: 6px 0 0;
    color: #6b7280;
}

.task-show-page .task-header-actions {
    display: flex;
    gap: 10px;
}

.task-show-page .details-card {
    width: 100%;
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-sizing: border-box;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
}

.task-show-page .details-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 25px;
}

.task-show-page .detail-item {
    display: flex;
    flex-direction: column;
    gap: 7px;
}

.task-show-page .detail-item.full-width {
    grid-column: 1 / -1;
}

.task-show-page .detail-label {
    font-size: 12px;
    color: #6b7280;
    text-transform: uppercase;
    font-weight: 600;
}

.task-show-page .detail-value {
    font-size: 15px;
    color: #111827;
    font-weight: 500;
}

.task-show-page .task-status {
    display: inline-block;
    width: fit-content;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.task-show-page .task-status {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

/* Pending */
.task-show-page .task-status.pending {
    background: #fef3c7;
    color: #92400e;
}

/* In Progress */
.task-show-page .task-status.in-progress {
    background: #dbeafe;
    color: #1d4ed8;
}

.task-show-page .task-status.low {
    background: #f3f4f6;
    color: #374151;
}

.task-show-page .task-status.medium {
    background: #fef3c7;
    color: #92400e;
}

.task-show-page .task-status.high {
    background: #ffedd5;
    color: #9a3412;
}

.task-show-page .task-status.urgent {
    background: #fee2e2;
    color: #991b1b;
}

/* Completed */
.task-show-page .task-status.completed {
    background: #dcfce7;
    color: #166534;
}

/* On Hold */
.task-show-page .task-status.on-hold {
    background: #f3f4f6;
    color: #374151;
}

/* Cancelled */
.task-show-page .task-status.cancelled {
    background: #fee2e2;
    color: #991b1b;
}

.task-show-page .task-status.inactive {
    background: #fee2e2;
    color: #991b1b;
}

.task-show-page .task-btn {
    display: inline-block;
    padding: 9px 15px;
    border-radius: 7px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
}

.task-show-page .task-btn-back {
    background: #f3f4f6;
    color: #374151;
}

.task-show-page .task-btn-edit {
    background: #2563eb;
    color: #fff;
}
</style>
<div class="task-show-page">

    <div class="task-page-header">

        <div>
            <h1>Task Details</h1>
            <p>View complete task information.</p>
        </div>

        <div class="task-header-actions">

            <a
                href="{{ route('tasks.index') }}"
                class="task-btn task-btn-back"
            >
                ← Back
            </a>
        </div>

    </div>


    <div class="details-card">

        <div class="details-grid">
            <div class="detail-item">
                <span class="detail-label">Company Name</span>
                <strong class="detail-value">{{ $task->company->name }}</strong>
            </div>

            <div class="detail-item">
                <span class="detail-label">Project Name</span>
                <strong class="detail-value">{{ $task->project->name }}</strong>
            </div>

            <div class="detail-item">
                <span class="detail-label">Assigned To</span>
                <strong class="detail-value">{{ $task->assignedTo->name }}</strong>
            </div>

            <div class="detail-item">
                <span class="detail-label">Title</span>
                <strong class="detail-value">{{ $task->title ?? '-' }}</strong>
            </div>

            <div class="detail-item">
                <span class="detail-label">Description</span>
                <strong class="detail-value">{{ $task->description ?? '-' }}</strong>
            </div>
            <div class="detail-item">
                <span class="detail-label">Status</span>

                @if($task->status === 'pending')
                    <span class="task-status pending">Pending</span>
                @elseif($task->status === 'in_progress')
                    <span class="task-status in-progress">In Progress</span>
                @elseif($task->status === 'completed')
                    <span class="task-status completed">Completed</span>
                @elseif($task->status === 'on_hold')
                    <span class="task-status on-hold">On Hold</span>
                @elseif($task->status === 'cancelled')
                    <span class="task-status cancelled">Cancelled</span>
                @endif
            </div>

            <div class="detail-item">
                <span class="detail-label">Priority</span>

                @if($task->priority === 'low')
                    <span class="task-status low">Low</span>
                @elseif($task->priority === 'medium')
                    <span class="task-status medium">Medium</span>
                @elseif($task->priority === 'high')
                    <span class="task-status high">High</span>
                @elseif($task->priority === 'urgent')
                    <span class="task-status urgent">Urgent</span>
                @endif
            </div>

            <div class="detail-item">
                <span class="detail-label">Start Date</span>
                <strong class="detail-value">
                    {{ $task->start_date->format('d M Y') ?? 'N/A'}}
                </strong>
            </div>

            <div class="detail-item">
                <span class="detail-label">Due Date</span>
                <strong class="detail-value">
                    {{ $task->due_date->format('d M Y') ?? 'N/A'}}
                </strong>
            </div>

            <div class="detail-item">
                <span class="detail-label">Created At</span>
                <strong class="detail-value">
                    {{ $task->created_at->format('d M Y, h:i A') }}
                </strong>
            </div>

            <div class="detail-item">
                <span class="detail-label">Updated At</span>
                <strong class="detail-value">
                    {{ $task->updated_at->format('d M Y, h:i A') }}
                </strong>
            </div>

        </div>

    </div>

</div>

@endsection