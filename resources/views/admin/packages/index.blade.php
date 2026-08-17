@extends('admin.layouts.app')

@section('title', 'Packages')

@section('content')
    <div class="mb-5" data-aos="fade-in">
        <div class="d-flex justify-content-between align-items-end">
            <div>
                <h1 class="xai-display">PACKAGES</h1>
                <p class="xai-subheading">Manage all subscription packages, pricing plans, and connection limits for your platform.</p>
            </div>
            <a href="{{ route('admin.packages.create') }}" class="btn-xai-primary">
                <span>CREATE PACKAGE</span>
            </a>
        </div>
    </div>

    <!-- Inventory Header -->
    <div class="xai-card-dark mb-4">
        <div style="font-family: var(--font-display); font-size: 13px; color: var(--xai-text-primary); text-transform: uppercase; letter-spacing: 1px;">
            <span style="font-size: 16px;">{{ $packages->count() }}</span> TOTAL PACKAGES
        </div>
    </div>

    <div class="xai-card-light p-0">
        <div class="table-responsive">
            <table class="xai-table">
                <thead>
                    <tr>
                        <th class="ps-4">PACKAGE NAME</th>
                        <th>PRICE</th>
                        <th>CONNECTIONS</th>
                        <th>SALES</th>
                        <th>STATUS</th>
                        <th class="text-end pe-4">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($packages as $package)
                        <tr class="align-middle">
                            <td class="ps-4">
                                <div style="font-weight: 400; font-size: 14px; color: var(--xai-text-primary);">{{ $package->name }}</div>
                                <div class="d-flex gap-2 mt-2">
                                    @if($package->is_featured)
                                        <span style="font-family: var(--font-display); font-size: 10px; padding: 2px 8px; border: 1px solid var(--xai-text-primary); color: var(--xai-text-primary); letter-spacing: 1px;">FEATURED</span>
                                    @endif
                                    @if($package->is_trial)
                                        <span style="font-family: var(--font-display); font-size: 10px; padding: 2px 8px; border: 1px solid var(--xai-border-strong); color: var(--xai-text-secondary); letter-spacing: 1px;">TRIAL</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div style="font-family: var(--font-display); font-size: 16px; font-weight: 400; color: var(--xai-text-primary);">
                                    ${{ number_format($package->price, 2) }}
                                </div>
                                <div style="font-size: 11px; color: var(--xai-text-muted); font-family: var(--font-display);">
                                    / {{ $package->duration_label ?? ($package->duration_months ? $package->duration_months . 'mo' : ($package->duration_days . 'd')) }}
                                </div>
                            </td>
                            <td>
                                <div style="font-family: var(--font-display); font-size: 11px; color: var(--xai-text-primary); border: 1px solid var(--xai-border-strong); padding: 4px 8px; display: inline-block;">
                                    {{ $package->connections }} CONN
                                </div>
                            </td>
                            <td style="font-family: var(--font-display); font-weight: 400; font-size: 14px; color: var(--xai-text-primary);">{{ $package->orders_count }}</td>
                            <td>
                                @if($package->is_active)
                                    <span style="font-family: var(--font-display); font-size: 11px; padding: 4px 8px; border: 1px solid var(--xai-text-primary); color: var(--xai-text-primary); letter-spacing: 1px;">ACTIVE</span>
                                @else
                                    <span style="font-family: var(--font-display); font-size: 11px; padding: 4px 8px; border: 1px solid var(--xai-border-strong); color: var(--xai-text-secondary); letter-spacing: 1px;">INACTIVE</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.packages.edit', $package) }}" class="btn-xai-dark" style="padding: 6px 12px; font-size: 12px;" title="Edit">
                                        EDIT
                                    </a>
                                    <form action="{{ route('admin.packages.toggle-active', $package) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn-xai-dark" style="padding: 6px 12px; font-size: 12px;" title="{{ $package->is_active ? 'Deactivate' : 'Activate' }}">
                                            {{ $package->is_active ? 'DISABLE' : 'ENABLE' }}
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.packages.destroy', $package) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this package?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-xai-dark" style="padding: 6px 12px; font-size: 12px; border-color: #ff4444; color: #ff4444;" title="Delete">
                                            DELETE
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div style="color: var(--xai-text-muted);">
                                    <div style="font-family: var(--font-display); font-size: 12px; letter-spacing: 1px;">NO PACKAGES FOUND</div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($packages->hasPages())
        <div class="p-4 border-top" style="border-color: var(--xai-border) !important;">
            <div class="d-flex justify-content-center">
                {{ $packages->links('pagination::bootstrap-5') }}
            </div>
        </div>
        @endif
    </div>
@endsection

@push('styles')
<style>
    .pagination { gap: 6px; margin: 0; }
    .page-link { 
        border-radius: 0px !important; 
        border: 1px solid var(--xai-border-strong) !important; 
        color: var(--xai-text-primary) !important;
        background: transparent !important;
        padding: 8px 16px;
        font-family: var(--font-display);
        font-size: 12px;
    }
    .page-item.active .page-link { 
        background: var(--xai-surface) !important; 
        border-color: var(--xai-text-primary) !important; 
        color: var(--xai-text-primary) !important;
    }
    .page-link:hover {
        background: var(--xai-surface-hover) !important;
    }
</style>
@endpush
