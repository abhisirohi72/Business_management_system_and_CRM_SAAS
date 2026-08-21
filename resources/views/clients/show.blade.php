@extends('layouts.app')

@section('content')
<style>
.client-show-page {
    padding: 30px;
    width: 100%;
    box-sizing: border-box;
}

.client-show-page .client-page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}

.client-show-page .client-page-header h1 {
    margin: 0;
    font-size: 28px;
    color: #111827;
}

.client-show-page .client-page-header p {
    margin: 6px 0 0;
    color: #6b7280;
}

.client-show-page .client-header-actions {
    display: flex;
    gap: 10px;
}

.client-show-page .details-card {
    width: 100%;
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-sizing: border-box;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
}

.client-show-page .details-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 25px;
}

.client-show-page .detail-item {
    display: flex;
    flex-direction: column;
    gap: 7px;
}

.client-show-page .detail-item.full-width {
    grid-column: 1 / -1;
}

.client-show-page .detail-label {
    font-size: 12px;
    color: #6b7280;
    text-transform: uppercase;
    font-weight: 600;
}

.client-show-page .detail-value {
    font-size: 15px;
    color: #111827;
    font-weight: 500;
}

.client-show-page .client-status {
    display: inline-block;
    width: fit-content;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.client-show-page .client-status.active {
    background: #dcfce7;
    color: #166534;
}

.client-show-page .client-status.inactive {
    background: #fee2e2;
    color: #991b1b;
}

.client-show-page .client-btn {
    display: inline-block;
    padding: 9px 15px;
    border-radius: 7px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
}

.client-show-page .client-btn-back {
    background: #f3f4f6;
    color: #374151;
}

.client-show-page .client-btn-edit {
    background: #2563eb;
    color: #fff;
}
</style>
<div class="client-show-page">

    <div class="client-page-header">

        <div>
            <h1>Client Details</h1>
            <p>View complete client information.</p>
        </div>

        <div class="client-header-actions">

            <a
                href="{{ route('clients.index') }}"
                class="client-btn client-btn-back"
            >
                ← Back
            </a>

            <a
                href="{{ route('clients.edit', $client) }}"
                class="client-btn client-btn-edit"
            >
                Edit Client
            </a>

        </div>

    </div>


    <div class="details-card">

        <div class="details-grid">

            <div class="detail-item">
                <span class="detail-label">Name</span>
                <strong class="detail-value">{{ $client->name }}</strong>
            </div>

            <div class="detail-item">
                <span class="detail-label">Email</span>
                <strong class="detail-value">{{ $client->email ?? '-' }}</strong>
            </div>

            <div class="detail-item">
                <span class="detail-label">Phone</span>
                <strong class="detail-value">{{ $client->phone ?? '-' }}</strong>
            </div>

            <div class="detail-item">
                <span class="detail-label">Company</span>
                <strong class="detail-value">{{ $client->company_name ?? '-' }}</strong>
            </div>

            <div class="detail-item">
                <span class="detail-label">Status</span>

                @if($client->status === 'active')
                    <span class="client-status active">Active</span>
                @else
                    <span class="client-status inactive">Inactive</span>
                @endif

            </div>

            <div class="detail-item">
                <span class="detail-label">Created By</span>
                <strong class="detail-value">{{ $client->creator?->name ?? '-' }}</strong>
            </div>

            <div class="detail-item full-width">
                <span class="detail-label">Address</span>
                <strong class="detail-value">{{ $client->address ?? '-' }}</strong>
            </div>

            <div class="detail-item full-width">
                <span class="detail-label">Notes</span>
                <strong class="detail-value">{{ $client->notes ?? '-' }}</strong>
            </div>

            <div class="detail-item">
                <span class="detail-label">Created At</span>
                <strong class="detail-value">
                    {{ $client->created_at->format('d M Y, h:i A') }}
                </strong>
            </div>

            <div class="detail-item">
                <span class="detail-label">Updated At</span>
                <strong class="detail-value">
                    {{ $client->updated_at->format('d M Y, h:i A') }}
                </strong>
            </div>

        </div>

    </div>

</div>

@endsection