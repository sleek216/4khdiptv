@extends('admin.layouts.app')

@section('title', 'Announcements')

@section('content')
    <div class="mb-4">
        <h1 class="xai-display">Announcement Bar</h1>
        <p class="xai-subheading">Top blue banner on the website. Turn it on/off and edit text anytime.</p>
    </div>

    @if(session('success'))
        <div class="xai-card-light mb-4 py-3 px-4" style="border-color: var(--atlas-success) !important;">
            <div style="font-family: var(--font-display); font-size: 13px; color: var(--atlas-success);">{{ session('success') }}</div>
        </div>
    @endif

    <form action="{{ route('admin.announcement.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="xai-card-light p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3" style="border-color: var(--xai-border) !important;">
                        <div>
                            <h2 style="font-family: var(--font-display); font-size: 16px; font-weight: 700; margin: 0;">Show on website</h2>
                            <div style="font-size: 12px; color: var(--xai-text-muted); margin-top: 4px;">Enable or disable the top announcement bar.</div>
                        </div>
                        <div class="form-check form-switch m-0">
                            <input class="form-check-input" type="checkbox" id="announcement_enabled" name="announcement_enabled" value="1" {{ $settings['announcement_enabled'] == '1' ? 'checked' : '' }} style="width: 44px; height: 22px; cursor: pointer;">
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label" for="announcement_badge">Left badge</label>
                            <input type="text" class="form-control" id="announcement_badge" name="announcement_badge"
                                   value="{{ old('announcement_badge', $settings['announcement_badge']) }}" placeholder="LIMITED OFFER">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="announcement_highlight">Highlight chip</label>
                            <input type="text" class="form-control" id="announcement_highlight" name="announcement_highlight"
                                   value="{{ old('announcement_highlight', $settings['announcement_highlight']) }}" placeholder="LIVE CHAT">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="announcement_text">Main message</label>
                        <textarea class="form-control" id="announcement_text" name="announcement_text" rows="3"
                                  placeholder="ALL PAYMENT METHODS AVAILABLE CONTACT:">{{ old('announcement_text', $settings['announcement_text']) }}</textarea>
                        <div style="font-size: 12px; color: var(--xai-text-muted); margin-top: 6px;">Simple text or light HTML is fine.</div>
                        @error('announcement_text')
                            <div class="text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="announcement_link">Button link</label>
                            <input type="text" class="form-control" id="announcement_link" name="announcement_link"
                                   value="{{ old('announcement_link', $settings['announcement_link']) }}" placeholder="/packages">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="announcement_link_text">Button text</label>
                            <input type="text" class="form-control" id="announcement_link_text" name="announcement_link_text"
                                   value="{{ old('announcement_link_text', $settings['announcement_link_text']) }}" placeholder="Shop Now">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="xai-card-dark p-4 mb-3">
                    <div class="stat-tile-label mb-3">Preview</div>
                    <div style="background:#2563EB;color:#fff;border-radius:8px;padding:12px;font-size:12px;">
                        <div style="display:flex;flex-wrap:wrap;gap:8px;align-items:center;justify-content:center;">
                            <span style="background:rgba(255,255,255,.16);padding:4px 8px;border-radius:6px;font-weight:700;" id="pv-badge">{{ $settings['announcement_badge'] ?: 'LIMITED OFFER' }}</span>
                            <span id="pv-text">{{ $settings['announcement_text'] ?: 'Your message…' }}</span>
                            <span style="background:rgba(0,0,0,.22);padding:4px 8px;border-radius:6px;font-weight:700;" id="pv-chip">{{ $settings['announcement_highlight'] ?: 'LIVE CHAT' }}</span>
                            <span style="background:rgba(255,255,255,.18);padding:5px 10px;border-radius:8px;font-weight:700;" id="pv-btn">{{ $settings['announcement_link_text'] ?: 'Shop Now' }} →</span>
                        </div>
                    </div>
                    <button type="submit" class="btn-xai-primary w-100 mt-3">Save announcement</button>
                </div>
                <div class="xai-card-light p-4">
                    <div class="stat-tile-label mb-2">Where</div>
                    <p style="margin:0;font-size:13px;color:var(--xai-text-secondary);">Shows at the very top of every public page when enabled.</p>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const map = [
        ['announcement_badge', 'pv-badge'],
        ['announcement_text', 'pv-text'],
        ['announcement_highlight', 'pv-chip'],
        ['announcement_link_text', 'pv-btn'],
    ];
    map.forEach(([inputId, previewId]) => {
        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);
        if (!input || !preview) return;
        input.addEventListener('input', () => {
            preview.textContent = inputId === 'announcement_link_text'
                ? ((input.value || 'Shop Now') + ' →')
                : (input.value || preview.textContent);
        });
    });
});
</script>
@endpush
