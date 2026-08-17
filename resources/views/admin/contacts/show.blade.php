@extends('admin.layouts.app')

@section('title', 'Message Details')

@section('content')
    <div class="mb-4 d-flex justify-content-between align-items-end flex-wrap gap-3">
        <div>
            <h1 class="xai-display">Message details</h1>
            <p class="xai-subheading">Read the message, add notes, and update its status.</p>
        </div>
        <a href="{{ route('admin.contacts.index') }}" class="btn-xai-secondary">
            <i class="ph ph-arrow-left"></i>
            <span>Back to inbox</span>
        </a>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="xai-card-dark p-4 mb-4">
                <div class="d-flex align-items-start gap-3 mb-4 pb-4 border-bottom" style="border-color: var(--xai-border) !important;">
                    <div style="width: 48px; height: 48px; background: var(--xai-surface); border: 1px solid var(--xai-border-strong); display: flex; align-items: center; justify-content: center; font-size: 18px; font-weight: 700; color: var(--atlas-teal);">
                        {{ substr($contact->name, 0, 1) }}
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                            <div>
                                <h2 style="font-family: var(--font-display); font-size: 20px; margin: 0; color: var(--xai-text-primary);">{{ $contact->name }}</h2>
                                <div style="font-size: 13px; color: var(--atlas-teal);">{{ $contact->email }}</div>
                            </div>
                            <div>
                                @if($contact->status === 'new')
                                    <span class="xai-badge" style="color: var(--atlas-amber); border-color: var(--atlas-amber);">New</span>
                                @elseif($contact->status === 'replied')
                                    <span class="xai-badge" style="color: var(--atlas-success); border-color: var(--atlas-success);">Replied</span>
                                @else
                                    <span class="xai-badge">{{ ucfirst($contact->status) }}</span>
                                @endif
                            </div>
                        </div>
                        @if($contact->phone)
                            <div style="font-size: 13px; color: var(--xai-text-muted); margin-top: 8px;">
                                <i class="ph ph-phone me-1"></i>{{ $contact->phone }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mb-4">
                    <div class="stat-tile-label mb-2">Subject</div>
                    <div style="font-family: var(--font-display); font-size: 18px; color: var(--xai-text-primary);">{{ $contact->subject }}</div>
                </div>

                <div>
                    <div class="stat-tile-label mb-2">Message</div>
                    <div class="p-3" style="background: var(--xai-surface); border: 1px solid var(--xai-border); font-size: 14px; line-height: 1.7; color: var(--xai-text-secondary);">
                        {!! nl2br(e($contact->message)) !!}
                    </div>
                </div>
            </div>

            <div class="xai-card-dark p-4">
                <h2 style="font-family: var(--font-display); font-size: 16px; font-weight: 700; margin: 0 0 24px; color: var(--xai-text-primary);">Update status</h2>
                <form action="{{ route('admin.contacts.update-status', $contact) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="xai-config-label">Admin notes</label>
                        <div class="xai-input-vault">
                            <textarea name="admin_notes" class="xai-config-input" rows="4" style="min-height: 100px;" placeholder="Internal notes for this message…">{{ $contact->admin_notes }}</textarea>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="xai-config-label">Status</label>
                        <div class="xai-input-vault">
                            <select name="status" class="xai-config-input" style="appearance: none; cursor: pointer;">
                                <option value="new" {{ $contact->status === 'new' ? 'selected' : '' }}>New</option>
                                <option value="read" {{ $contact->status === 'read' ? 'selected' : '' }}>Opened</option>
                                <option value="replied" {{ $contact->status === 'replied' ? 'selected' : '' }}>Replied</option>
                                <option value="closed" {{ $contact->status === 'closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn-xai-primary py-3 px-5">
                        <span>Save changes</span>
                    </button>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="xai-card-dark p-4 mb-4">
                <div class="stat-tile-label mb-3">Actions</div>
                <div class="d-grid gap-2">
                    <a href="mailto:{{ $contact->email }}" class="btn-xai-primary text-center py-3" style="text-decoration: none;">
                        <span><i class="ph ph-paper-plane-tilt me-1"></i> Reply via email</span>
                    </a>
                    @if($contact->phone)
                        <a href="tel:{{ $contact->phone }}" class="btn-xai-secondary text-center py-3" style="text-decoration: none;">
                            <i class="ph ph-phone-call me-1"></i> Call sender
                        </a>
                    @endif
                </div>
            </div>

            <div class="xai-card-dark p-4 mb-4">
                <div class="stat-tile-label mb-3">Details</div>
                <div class="d-flex flex-column gap-3">
                    <div>
                        <div style="font-size: 11px; color: var(--xai-text-muted); margin-bottom: 4px;">Received</div>
                        <div style="font-size: 14px; color: var(--xai-text-primary);">{{ $contact->created_at->format('M d, Y h:i A') }}</div>
                        <div style="font-size: 11px; color: var(--xai-text-muted);">{{ $contact->created_at->diffForHumans() }}</div>
                    </div>
                    <div>
                        <div style="font-size: 11px; color: var(--xai-text-muted); margin-bottom: 4px;">Last updated</div>
                        <div style="font-size: 14px; color: var(--xai-text-primary);">{{ $contact->updated_at->format('M d, Y h:i A') }}</div>
                    </div>
                    <div>
                        <div style="font-size: 11px; color: var(--xai-text-muted); margin-bottom: 4px;">Message ID</div>
                        <div style="font-size: 14px; color: var(--atlas-teal); font-family: var(--font-display);">#{{ $contact->id }}</div>
                    </div>
                </div>
            </div>

            <div class="xai-card-light p-4" style="border-color: rgba(239, 68, 68, 0.35) !important;">
                <div style="font-size: 12px; font-weight: 700; color: #ef4444; margin-bottom: 12px;">Delete message</div>
                <p style="font-size: 12px; color: var(--xai-text-muted); margin-bottom: 16px;">This permanently removes the message and cannot be undone.</p>
                <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Permanently delete this message?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-xai-secondary w-100 py-3" style="color: #ef4444; border-color: #ef4444;">
                        <i class="ph ph-trash me-1"></i> Delete permanently
                    </button>
                </form>
            </div>
        </div>
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
