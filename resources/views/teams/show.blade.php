@extends('layouts.app')

@section('content')
<style>
    .team-show-page {
        padding: 30px;
        width: 100%;
        box-sizing: border-box;
    }

    .team-show-page .team-page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .team-show-page .team-page-header h1 {
        margin: 0;
        font-size: 28px;
        color: #111827;
    }

    .team-show-page .team-page-header p {
        margin: 6px 0 0;
        color: #6b7280;
    }

    .team-show-page .team-header-actions {
        display: flex;
        gap: 10px;
    }

    .team-show-page .details-card {
        width: 100%;
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        box-sizing: border-box;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
    }

    .team-show-page .details-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 25px;
    }

    .team-show-page .detail-item {
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .team-show-page .detail-item.full-width {
        grid-column: 1 / -1;
    }

    .team-show-page .detail-label {
        font-size: 12px;
        color: #6b7280;
        text-transform: uppercase;
        font-weight: 600;
    }

    .team-show-page .detail-value {
        font-size: 15px;
        color: #111827;
        font-weight: 500;
    }

    .team-show-page .team-status {
        display: inline-block;
        width: fit-content;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .team-show-page .team-status {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    /* Pending */
    .team-show-page .team-status.pending {
        background: #fef3c7;
        color: #92400e;
    }

    /* In Progress */
    .team-show-page .team-status.in-progress {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .team-show-page .team-status.low {
        background: #f3f4f6;
        color: #374151;
    }

    .team-show-page .team-status.medium {
        background: #fef3c7;
        color: #92400e;
    }

    .team-show-page .team-status.high {
        background: #ffedd5;
        color: #9a3412;
    }

    .team-show-page .team-status.urgent {
        background: #fee2e2;
        color: #991b1b;
    }

    /* Completed */
    .team-show-page .team-status.completed {
        background: #dcfce7;
        color: #166534;
    }

    /* On Hold */
    .team-show-page .team-status.on-hold {
        background: #f3f4f6;
        color: #374151;
    }

    /* Cancelled */
    .team-show-page .team-status.cancelled {
        background: #fee2e2;
        color: #991b1b;
    }

    .team-show-page .team-status.inactive {
        background: #fee2e2;
        color: #991b1b;
    }

    .team-show-page .team-btn {
        display: inline-block;
        padding: 9px 15px;
        border-radius: 7px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
    }

    .team-show-page .team-btn-back {
        background: #f3f4f6;
        color: #374151;
    }

    .team-show-page .team-btn-edit {
        background: #2563eb;
        color: #fff;
    }
</style>
<div class="team-show-page">

    <div class="team-page-header">

        <div>
            <h1>Member Details</h1>
            <p>View complete team member information.</p>
        </div>

        <div class="team-header-actions">

            <a
                href="{{ route('teams.index') }}"
                class="team-btn team-btn-back"
            >
                ← Back
            </a>
        </div>

    </div>


    <div class="details-card">

        <div class="details-grid">
            <div class="detail-item">
                <span class="detail-label">Company Name</span>
                <strong class="detail-value">{{ $user->company->name }}</strong>
            </div>

            <div class="detail-item">
                <span class="detail-label">Name</span>
                <strong class="detail-value">{{ $user->name }}</strong>
            </div>

            <div class="detail-item">
                <span class="detail-label">Email</span>
                <strong class="detail-value">{{ $user->email }}</strong>
            </div>

            <div class="detail-item">
                <span class="detail-label">Created At</span>
                <strong class="detail-value">
                    {{ $user->created_at->format('d M Y, h:i A') }}
                </strong>
            </div>

            <div class="detail-item">
                <span class="detail-label">Updated At</span>
                <strong class="detail-value">
                    {{ $user->updated_at->format('d M Y, h:i A') }}
                </strong>
            </div>

        </div>

    </div>

</div>

@endsection