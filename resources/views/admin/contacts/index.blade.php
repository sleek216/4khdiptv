@extends('admin.layouts.app')

@section('title', 'Support Inbox')

@section('content')
    <div class="mb-4">
        <div class="d-flex justify-content-between align-items-end">
            <div>
                <h1 class="xai-display">Inbox</h1>
                <p class="xai-subheading">Messages from the contact form and support requests.</p>
            </div>
            <div class="d-flex gap-2">
                <form action="{{ route('admin.contacts.mark-all-read') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-xai-secondary">
                        <i class="ph ph-check-double"></i>
                        <span>MARK ALL READ</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="xai-card-dark h-100" style="border-top: 3px solid var(--atlas-teal);">
                <span class="stat-tile-label">Total messages</span>
                <div class="stat-tile-value">{{ $stats['total'] }}</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="xai-card-dark h-100" style="border-top: 3px solid var(--atlas-amber);">
                <span class="stat-tile-label">Unread</span>
                <div class="stat-tile-value" style="color: var(--atlas-amber);">{{ $stats['new'] }}</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="xai-card-dark h-100" style="border-top: 3px solid var(--atlas-success);">
                <span class="stat-tile-label">Resolved</span>
                <div class="stat-tile-value" style="color: var(--atlas-success);">{{ $stats['replied'] }}</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="xai-card-dark h-100" style="border-top: 3px solid #2F6FED;">
                <span class="stat-tile-label">Reply rate</span>
                <div class="stat-tile-value">{{ $stats['total'] > 0 ? round(($stats['replied'] / $stats['total']) * 100, 1) : 0 }}%</div>
            </div>
        </div>
    </div>

    <div class="xai-card-dark mb-4 p-4">
        <form method="GET" action="{{ route('admin.contacts.index') }}" class="row g-3 align-items-end">
            <div class="col-lg-6">
                <label class="xai-config-label">Search inbox</label>
                <div class="xai-input-vault">
                    <input type="text" name="search" class="xai-config-input" placeholder="Name, email, or keywords…" value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-lg-4">
                <label class="xai-config-label">Filter by status</label>
                <div class="xai-input-vault">
                    <select name="status" class="xai-config-input" style="appearance: none;">
                        <option value="">All statuses</option>
                        <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>New</option>
                        <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Opened</option>
                        <option value="replied" {{ request('status') == 'replied' ? 'selected' : '' }}>Replied</option>
                        <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-2">
                <button type="submit" class="btn-xai-primary w-100 py-3">
                    Search
                </button>
            </div>
        </form>
    </div>

    <div class="xai-card-light p-0 overflow-hidden">
        <div class="table-responsive">
            <table class="xai-table">
                <thead>
                    <tr>
                        <th class="ps-4">Sender</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>When</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contacts as $contact)
                        <tr class="align-middle">
                            <td class="ps-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div style="width: 32px; height: 32px; background: transparent; border: 1px solid var(--xai-border-strong); border-radius: 0px; display: flex; align-items: center; justify-content: center; font-family: var(--font-display); font-weight: 400; color: var(--xai-text-primary); font-size: 12px;">
                                        {{ substr($contact->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div style="font-weight: 400; color: var(--xai-text-primary); font-size: 14px;">{{ $contact->name }}</div>
                                        <div style="font-size: 11px; color: var(--xai-text-muted); font-family: var(--font-display);">{{ $contact->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div style="font-weight: 400; font-size: 13px; color: var(--xai-text-primary);">{{ $contact->subject }}</div>
                                <div style="font-size: 11px; color: var(--xai-text-muted); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 250px;">
                                    {{ Str::limit($contact->message, 50) }}
                                </div>
                            </td>
                            <td>
                                @if($contact->status === 'new')
                                    <span style="font-family: var(--font-display); font-size: 10px; color: var(--atlas-amber); letter-spacing: 0.5px; border: 1px solid var(--atlas-amber); padding: 2px 8px;">New</span>
                                @elseif($contact->status === 'replied')
                                    <span style="font-family: var(--font-display); font-size: 10px; color: var(--atlas-success); letter-spacing: 0.5px; border: 1px solid var(--atlas-success); padding: 2px 8px;">Replied</span>
                                @else
                                    <span style="font-family: var(--font-display); font-size: 10px; color: var(--xai-text-muted); letter-spacing: 0.5px; border: 1px solid var(--xai-border-strong); padding: 2px 8px;">{{ ucfirst($contact->status) }}</span>
                                @endif
                            </td>
                            <td style="color: var(--xai-text-muted); font-size: 12px; font-family: var(--font-display);">
                                {{ $contact->created_at->diffForHumans() }}
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.contacts.show', $contact) }}" class="btn-xai-secondary" style="padding: 4px 12px; font-size: 11px; text-decoration: none;">
                                        Open
                                    </a>
                                    <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this message?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-xai-secondary" style="padding: 4px 12px; font-size: 11px; color: #ef4444; border-color: #ef4444;">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div style="color: var(--xai-text-muted);">
                                    <p style="font-family: var(--font-display); font-size: 12px;">No messages found</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $contacts->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
@endsection

@push('styles')
<style>
    .xai-config-label {
        font-family: var(--font-display);
        font-size: 11px;
        color: var(--xai-text-muted);
        margin-bottom: 8px;
        display: block;
    }
    .xai-input-vault {
        background: transparent;
        border: 1px solid var(--xai-border-strong);
        border-radius: 0px;
        transition: all 0.2s;
    }
    .xai-config-input {
        background: transparent;
        border: none;
        width: 100%;
        padding: 12px 16px;
        color: var(--xai-text-primary);
        font-size: 14px;
        font-family: var(--font-display);
    }
    .xai-config-input:focus { outline: none; }
    .xai-input-vault:focus-within {
        border-color: var(--atlas-teal);
    }
</style>
@endpush
