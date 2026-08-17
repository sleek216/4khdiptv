@extends('admin.layouts.app')

@section('title', 'Database Backup & Auto-Export')

@section('content')
    <div class="mb-4">
        <h1 class="xai-display">Database Backup &amp; Auto-Export</h1>
        <p class="xai-subheading">Manage automated 30-day periodic database CSV backups and instant full-system exports.</p>
    </div>

    <div class="xai-tabs mb-4">
        <a href="{{ route('admin.settings.index') }}" class="xai-tab {{ request()->routeIs('admin.settings.index') ? 'active' : '' }}">
            <span>General</span>
        </a>
        <a href="{{ route('admin.settings.stripe') }}" class="xai-tab {{ request()->routeIs('admin.settings.stripe') ? 'active' : '' }}">
            <span>Stripe</span>
        </a>
        <a href="{{ route('admin.settings.nowpayments') }}" class="xai-tab {{ request()->routeIs('admin.settings.nowpayments') ? 'active' : '' }}">
            <span>Crypto</span>
        </a>
        <a href="{{ route('admin.settings.email') }}" class="xai-tab {{ request()->routeIs('admin.settings.email') ? 'active' : '' }}">
            <span>Email</span>
        </a>
        <a href="{{ route('admin.settings.backup') }}" class="xai-tab {{ request()->routeIs('admin.settings.backup') ? 'active' : '' }}">
            <span>Backup &amp; Export</span>
        </a>
        <a href="{{ route('admin.settings.webhooks') }}" class="xai-tab {{ request()->routeIs('admin.settings.webhooks') ? 'active' : '' }}">
            <span>Webhooks</span>
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success d-flex align-items-center gap-2 mb-4 p-3" style="border-radius: var(--radius); background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; font-weight: 600; font-size: 13px;">
            <i class="ph-fill ph-check-circle" style="font-size: 20px; color: #10b981;"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger d-flex align-items-start gap-2 mb-4 p-3" style="border-radius: var(--radius); background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; font-size: 13px; line-height: 1.5;">
            <i class="ph-fill ph-warning-circle" style="font-size: 20px; color: #ef4444; flex-shrink: 0; margin-top: 1px;"></i>
            <div>
                <strong>Error:</strong> {{ session('error') }}
                <div style="font-size: 12px; margin-top: 4px; color: #b91c1c;">
                    Tip: If using SMTP, ensure your correct email credentials are saved in <a href="{{ route('admin.settings.email') }}" style="color: #1d4ed8; text-decoration: underline;">Settings &rarr; Email</a>.
                </div>
            </div>
        </div>
    @endif

    <!-- System Snapshot Stat Tiles -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="xai-card-dark p-3" style="background: #ffffff; border: 1px solid var(--xai-border); border-radius: var(--radius); box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <div style="font-size: 11px; font-weight: 700; color: var(--xai-text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px;">Total Customers</div>
                <div style="font-size: 24px; font-weight: 800; color: #0B6E6A; font-family: var(--font-display);">{{ number_format($stats['total_users'] ?? 0) }}</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="xai-card-dark p-3" style="background: #ffffff; border: 1px solid var(--xai-border); border-radius: var(--radius); box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <div style="font-size: 11px; font-weight: 700; color: var(--xai-text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px;">Total Orders</div>
                <div style="font-size: 24px; font-weight: 800; color: #2563eb; font-family: var(--font-display);">{{ number_format($stats['total_orders'] ?? 0) }}</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="xai-card-dark p-3" style="background: #ffffff; border: 1px solid var(--xai-border); border-radius: var(--radius); box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <div style="font-size: 11px; font-weight: 700; color: var(--xai-text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px;">Gross Revenue</div>
                <div style="font-size: 24px; font-weight: 800; color: #059669; font-family: var(--font-display);">${{ number_format($stats['total_revenue'] ?? 0, 2) }}</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="xai-card-dark p-3" style="background: #ffffff; border: 1px solid var(--xai-border); border-radius: var(--radius); box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <div style="font-size: 11px; font-weight: 700; color: var(--xai-text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px;">Active Packages</div>
                <div style="font-size: 24px; font-weight: 800; color: #d97706; font-family: var(--font-display);">{{ number_format($stats['total_packages'] ?? 0) }}</div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Configuration Form -->
        <div class="col-lg-7">
            <form action="{{ route('admin.settings.update-backup') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="xai-card-dark p-4 mb-4" style="background: #ffffff; border: 1px solid var(--xai-border); border-radius: var(--radius); box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <div class="d-flex align-items-center justify-content-between mb-4 pb-3" style="border-bottom: 1px solid var(--xai-border);">
                        <h2 style="font-family: var(--font-display); font-size: 16px; font-weight: 700; margin: 0; color: var(--xai-text-primary);">
                            <i class="ph-bold ph-gear" style="color: #0B6E6A; margin-right: 6px;"></i>
                            Automated Export Configuration
                        </h2>
                    </div>

                    <!-- Enable Toggle Switch -->
                    <div class="mb-4 d-flex align-items-center justify-content-between p-3" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: var(--radius);">
                        <div>
                            <label class="xai-label mb-1" style="font-weight: 700; color: var(--xai-text-primary);">Enable Automated 30-Day Exporting</label>
                            <div style="font-size: 12px; color: var(--xai-text-muted);">Automatically generate and email full database CSV report on schedule.</div>
                        </div>
                        <div class="form-check form-switch mb-0 ms-3">
                            <input class="form-check-input" type="checkbox" name="backup_export_enabled" value="1" id="backup_export_enabled"
                                   style="width: 48px; height: 24px; cursor: pointer;"
                                   {{ ($backupSettings['backup_export_enabled'] ?? '1') === '1' ? 'checked' : '' }}>
                        </div>
                    </div>

                    <!-- Destination Email -->
                    <div class="mb-4">
                        <label for="backup_export_email" class="xai-label">
                            Destination Email Address <span style="color: #ef4444;">*</span>
                        </label>
                        <div class="search-input w-100" style="max-width: none; background: #ffffff; border: 1px solid #cbd5e1; border-radius: var(--radius); padding: 2px 12px; display: flex; align-items: center;">
                            <i class="ph ph-envelope-simple" style="color: var(--xai-text-muted); font-size: 18px; margin-right: 8px;"></i>
                            <input type="email" class="{{ $errors->has('backup_export_email') ? 'is-invalid' : '' }}"
                                   id="backup_export_email" name="backup_export_email"
                                   value="{{ old('backup_export_email', $backupSettings['backup_export_email']) }}"
                                   required placeholder="admin@4khdiptv.org"
                                   style="border: none; background: transparent; width: 100%; outline: none; font-size: 14px; color: var(--xai-text-primary); padding: 10px 0;">
                        </div>
                        <div style="font-family: var(--font-display); font-size: 11px; color: var(--xai-text-muted); margin-top: 6px;">
                            The full CSV backup spreadsheet with all database tables will be sent to this email.
                        </div>
                        @error('backup_export_email')
                            <div class="text-danger mt-2" style="font-size: 12px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Frequency Dropdown (Fixed & Styled) -->
                    <div class="mb-4">
                        <label for="backup_export_frequency_days" class="xai-label">
                            Export Frequency (Days)
                        </label>
                        <div class="custom-select-wrapper" style="position: relative; width: 100%;">
                            <select name="backup_export_frequency_days" id="backup_export_frequency_days" 
                                    class="form-select"
                                    style="background-color: #ffffff; border: 1px solid #cbd5e1; border-radius: var(--radius); padding: 11px 16px; font-size: 14px; font-weight: 500; color: var(--xai-text-primary); width: 100%; cursor: pointer; appearance: auto;">
                                <option value="30" {{ ($backupSettings['backup_export_frequency_days'] ?? '30') == '30' ? 'selected' : '' }}>Every 30 Days (Monthly Automated Backup - Recommended)</option>
                                <option value="14" {{ ($backupSettings['backup_export_frequency_days'] ?? '') == '14' ? 'selected' : '' }}>Every 14 Days (Bi-Weekly Backup)</option>
                                <option value="7" {{ ($backupSettings['backup_export_frequency_days'] ?? '') == '7' ? 'selected' : '' }}>Every 7 Days (Weekly Backup)</option>
                                <option value="1" {{ ($backupSettings['backup_export_frequency_days'] ?? '') == '1' ? 'selected' : '' }}>Every 1 Day (Daily Backup)</option>
                            </select>
                        </div>
                        <div style="font-family: var(--font-display); font-size: 11px; color: var(--xai-text-muted); margin-top: 6px;">
                            System cron runs in the background and sends the latest export once the frequency interval is reached.
                        </div>
                    </div>

                    <!-- Last Sent Info Banner -->
                    <div class="p-3 mb-4 d-flex align-items-center gap-3" style="background: #f0fdfa; border: 1px solid #ccfbf1; border-radius: var(--radius);">
                        <i class="ph-fill ph-clock-counter-clockwise" style="font-size: 24px; color: #0d9488; flex-shrink: 0;"></i>
                        <div>
                            <div style="font-size: 11px; font-weight: 700; color: #0f766e; text-transform: uppercase; letter-spacing: 0.05em;">Last Automated Export Timestamp:</div>
                            <div style="font-size: 13px; font-weight: 600; color: #115e59; font-family: var(--font-display); margin-top: 2px;">
                                {{ $backupSettings['backup_export_last_sent_at'] ? \Carbon\Carbon::parse($backupSettings['backup_export_last_sent_at'])->format('M d, Y • h:i A') : 'No previous automated export recorded' }}
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn-xai-primary w-100 py-3 d-flex align-items-center justify-content-center gap-2" style="border-radius: var(--radius); font-weight: 700;">
                        <i class="ph-bold ph-floppy-disk"></i>
                        <span>Save Configuration</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Manual Actions Card -->
        <div class="col-lg-5">
            <!-- Instant Send to Email -->
            <div class="xai-card-dark p-4 mb-4" style="background: #ffffff; border: 1px solid var(--xai-border); border-radius: var(--radius); box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <div class="d-flex align-items-center justify-content-between mb-3 pb-3" style="border-bottom: 1px solid var(--xai-border);">
                    <h2 style="font-family: var(--font-display); font-size: 16px; font-weight: 700; margin: 0; color: var(--xai-text-primary);">
                        <i class="ph-bold ph-paper-plane-tilt" style="color: #2563eb; margin-right: 6px;"></i>
                        Send Export to Email Now
                    </h2>
                </div>
                
                <p style="font-size: 13px; color: var(--xai-text-secondary); line-height: 1.6; margin-bottom: 18px;">
                    Trigger an immediate on-demand database export. The system will compile all 12+ database tables into a single UTF-8 CSV spreadsheet and dispatch it to your inbox right now.
                </p>

                <form action="{{ route('admin.settings.backup.send-email-now') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="xai-label">Send to alternate email (Optional):</label>
                        <div class="search-input w-100" style="max-width: none; background: #ffffff; border: 1px solid #cbd5e1; border-radius: var(--radius); padding: 2px 12px; display: flex; align-items: center;">
                            <i class="ph ph-envelope" style="color: var(--xai-text-muted); font-size: 18px; margin-right: 8px;"></i>
                            <input type="email" name="target_email" placeholder="Leave empty to use configured email above"
                                   style="border: none; background: transparent; width: 100%; outline: none; font-size: 13px; color: var(--xai-text-primary); padding: 9px 0;">
                        </div>
                    </div>

                    <button type="submit" class="btn w-100 py-3 d-flex align-items-center justify-content-center gap-2"
                            style="background: linear-gradient(135deg, #0B6E6A 0%, #15803d 100%); color: #ffffff; border: none; font-weight: 700; border-radius: var(--radius); font-size: 14px; box-shadow: 0 4px 12px rgba(11, 110, 106, 0.25); transition: all 0.2s ease;">
                        <i class="ph-bold ph-paper-plane-tilt" style="font-size: 18px;"></i>
                        <span>Send Export to Email Now</span>
                    </button>
                </form>
            </div>

            <!-- Direct CSV Download Button (Premium UI) -->
            <div class="xai-card-dark p-4" style="background: #ffffff; border: 1px solid var(--xai-border); border-radius: var(--radius); box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <div class="d-flex align-items-center justify-content-between mb-3 pb-3" style="border-bottom: 1px solid var(--xai-border);">
                    <h2 style="font-family: var(--font-display); font-size: 16px; font-weight: 700; margin: 0; color: var(--xai-text-primary);">
                        <i class="ph-bold ph-file-csv" style="color: #059669; margin-right: 6px;"></i>
                        Direct CSV Download
                    </h2>
                </div>

                <p style="font-size: 13px; color: var(--xai-text-secondary); line-height: 1.6; margin-bottom: 18px;">
                    Download the complete database backup CSV file directly to your local computer / device with 1-click.
                </p>

                <a href="{{ route('admin.settings.backup.download-csv') }}" class="btn w-100 py-3 d-flex align-items-center justify-content-center gap-2"
                   style="background: #f8fafc; border: 1.5px solid #059669; color: #059669; font-weight: 700; border-radius: var(--radius); font-size: 14px; transition: all 0.2s ease;">
                    <i class="ph-bold ph-download-simple" style="font-size: 18px;"></i>
                    <span>Download Database CSV File</span>
                </a>

                <div class="mt-3 p-2 text-center" style="font-size: 11px; color: var(--xai-text-muted); background: #f8fafc; border-radius: var(--radius-sm);">
                    <i class="ph-bold ph-shield-check" style="color: #059669;"></i> Includes Users, Orders, Packages, Affiliates, Commissions, Contacts &amp; Settings.
                </div>
            </div>
        </div>
    </div>
@endsection
