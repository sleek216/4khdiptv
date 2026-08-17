@extends('admin.layouts.app')

@section('title', 'Users')

@section('content')
    <div class="mb-5" data-aos="fade-in">
        <div class="d-flex justify-content-between align-items-end">
            <div>
                <h1 class="xai-display">USER MANAGEMENT</h1>
                <p class="xai-subheading">Manage all registered platform users, adjust their roles, and monitor their recent activity.</p>
            </div>
        <div class="d-flex gap-2">
            <form action="{{ route('admin.users.mark-all-read') }}" method="POST">
                @csrf
                <button type="submit" class="btn-xai-secondary">
                    <i class="ph ph-check-double"></i>
                    <span>MARK ALL READ</span>
                </button>
            </form>
            <a href="{{ route('admin.users.create') }}" class="btn-xai-primary">
                <span>CREATE USER</span>
            </a>
        </div>
        </div>
    </div>

    <!-- Entity Filters -->
    <div class="xai-card-dark mb-5">
        <form action="{{ route('admin.users.index') }}" method="GET" class="row g-4 align-items-end">
            <div class="col-lg-6">
                <label style="font-family: var(--font-display); font-size: 11px; font-weight: 400; color: var(--xai-text-secondary); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; display: block;">SEARCH USERS</label>
                <div class="search-input w-100" style="max-width: none;">
                    <i class="ph ph-fingerprint" style="color: var(--xai-text-muted);"></i>
                    <input type="text" name="search" placeholder="Search by name or email..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-lg-4">
                <label style="font-family: var(--font-display); font-size: 11px; font-weight: 400; color: var(--xai-text-secondary); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; display: block;">USER ROLE</label>
                <select name="role" class="w-100" style="background: transparent; border: 1px solid var(--xai-border-strong); border-radius: 0px; padding: 8px 16px; color: var(--xai-text-primary); font-family: var(--font-main); font-size: 14px; appearance: none; cursor: pointer; outline: none; transition: border 0.2s;" onchange="this.form.submit()">
                    <option value="" style="background: var(--xai-bg); color: var(--xai-text-primary);">All Permissions</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }} style="background: var(--xai-bg); color: var(--xai-text-primary);">SysAdmin</option>
                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }} style="background: var(--xai-bg); color: var(--xai-text-primary);">Standard</option>
                </select>
            </div>
            <div class="col-lg-2">
                <button type="submit" class="btn-xai-dark w-100 py-2 justify-content-center">
                    <span>SEARCH</span>
                </button>
            </div>
        </form>
    </div>

    <div class="xai-card-light p-0">
        <div class="table-responsive">
            <table class="xai-table">
                <thead>
                    <tr>
                        <th class="ps-4">NAME</th>
                        <th>EMAIL</th>
                        <th>ORDERS</th>
                        <th>ROLE</th>
                        <th>LAST LOGIN</th>
                        <th class="text-end pe-4">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr class="align-middle">
                            <td class="ps-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div style="width: 32px; height: 32px; background: transparent; border: 1px solid var(--xai-border-strong); border-radius: 0px; display: flex; align-items: center; justify-content: center; font-family: var(--font-display); font-weight: 400; color: var(--xai-text-primary); font-size: 14px;">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div style="font-weight: 400; font-size: 14px; color: var(--xai-text-primary);">{{ $user->name }}</div>
                                        <div style="font-size: 11px; color: var(--xai-text-muted); font-family: var(--font-display);">ID: {{ $user->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td style="font-size: 13px; color: var(--xai-text-secondary);">{{ $user->email }}</td>
                            <td style="font-family: var(--font-display); font-weight: 400; color: var(--xai-text-primary);">{{ $user->orders_count }}</td>
                            <td>
                                @if($user->is_admin)
                                    <span style="font-family: var(--font-display); font-size: 11px; padding: 4px 8px; border: 1px solid var(--xai-text-primary); color: var(--xai-text-primary); letter-spacing: 1px;">ADMIN</span>
                                @else
                                    <span style="font-family: var(--font-display); font-size: 11px; padding: 4px 8px; border: 1px solid var(--xai-border-strong); color: var(--xai-text-secondary); letter-spacing: 1px;">USER</span>
                                @endif
                            </td>
                            <td style="font-size: 12px; color: var(--xai-text-muted); font-family: var(--font-display);">
                                {{ $user->last_login_at ? $user->last_login_at->diffForHumans(null, true) : 'NEVER' }}
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.users.show', $user) }}" class="btn-xai-dark" style="padding: 6px 12px; font-size: 12px;" title="View User">
                                        VIEW
                                    </a>
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn-xai-dark" style="padding: 6px 12px; font-size: 12px;" title="Edit User">
                                        EDIT
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div style="color: var(--xai-text-muted);">
                                    <div style="font-family: var(--font-display); font-size: 12px; letter-spacing: 1px;">NO USERS FOUND</div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="p-4 border-top d-flex justify-content-between align-items-center" style="border-color: var(--xai-border) !important;">
            <div style="font-size: 12px; color: var(--xai-text-secondary); font-family: var(--font-display);">
                SHOWING <span style="color: var(--xai-text-primary);">{{ $users->firstItem() }}-{{ $users->lastItem() }}</span> OF {{ $users->total() }}
            </div>
            <div>
                {{ $users->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        </div>
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

