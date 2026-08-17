@extends('admin.layouts.app')

@section('title', 'Countries')

@section('content')
    <div class="mb-4">
        <div class="d-flex justify-content-between align-items-end flex-wrap gap-3">
            <div>
                <h1 class="xai-display">Countries</h1>
                <p class="xai-subheading">Regions available for service and how they appear on the site.</p>
            </div>
            <a href="{{ route('admin.countries.create') }}" class="btn-xai-primary">
                <span>Add country</span>
            </a>
        </div>
    </div>

    <div class="xai-card-dark mb-4">
        <div style="font-family: var(--font-display); font-size: 14px; color: var(--xai-text-primary);">
            <span style="font-size: 18px; font-weight: 700;">{{ $countries->count() }}</span> countries listed
        </div>
    </div>

    <div class="xai-card-light p-0">
        <div class="table-responsive">
            <table class="xai-table">
                <thead>
                    <tr>
                        <th class="ps-4">Country</th>
                        <th>Code</th>
                        <th>Flag</th>
                        <th>Status</th>
                        <th>Sort</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($countries as $country)
                        <tr class="align-middle">
                            <td class="ps-4">
                                <div style="font-family: var(--font-display); font-weight: 400; font-size: 14px; color: var(--xai-text-primary);">{{ $country->name }}</div>
                            </td>
                            <td>
                                <div style="font-family: var(--font-display); color: var(--xai-text-primary); border: 1px solid var(--xai-border-strong); padding: 4px 8px; display: inline-block; font-size: 11px;">
                                    {{ $country->code }}
                                </div>
                            </td>
                            <td style="font-size: 18px;">
                                @if($country->flag)
                                    {{ $country->flag }}
                                @else
                                    <i class="ph ph-globe" style="color: var(--xai-text-muted);"></i>
                                @endif
                            </td>
                            <td>
                                @if($country->is_active)
                                    <span style="font-family: var(--font-display); font-size: 11px; padding: 4px 8px; border: 1px solid var(--atlas-success); color: var(--atlas-success);">Active</span>
                                @else
                                    <span style="font-family: var(--font-display); font-size: 11px; padding: 4px 8px; border: 1px solid var(--xai-border-strong); color: var(--xai-text-secondary);">Inactive</span>
                                @endif
                            </td>
                            <td style="font-family: var(--font-display); color: var(--xai-text-muted); font-size: 13px;">
                                {{ $country->sort_order }}
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.countries.edit', $country) }}" class="btn-xai-secondary" style="padding: 6px 12px; font-size: 12px;" title="Edit">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.countries.toggle-active', $country) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn-xai-secondary" style="padding: 6px 12px; font-size: 12px;" title="{{ $country->is_active ? 'Deactivate' : 'Activate' }}">
                                            {{ $country->is_active ? 'Disable' : 'Enable' }}
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.countries.destroy', $country) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this country?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-xai-secondary" style="padding: 6px 12px; font-size: 12px; border-color: #ef4444; color: #ef4444;" title="Delete">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div style="color: var(--xai-text-muted);">
                                    <div style="font-family: var(--font-display); font-size: 12px;">No countries yet</div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($countries->hasPages())
        <div class="p-4 border-top" style="border-color: var(--xai-border) !important;">
            <div class="d-flex justify-content-center">
                {{ $countries->links('pagination::bootstrap-5') }}
            </div>
        </div>
        @endif
    </div>
@endsection
