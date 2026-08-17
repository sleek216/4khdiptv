<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Database Backup Report</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #0c0e17;
            color: #f1f5f9;
            margin: 0;
            padding: 30px 15px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #141824;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }
        .header {
            background: linear-gradient(135deg, #7c3aed 0%, #3b82f6 100%);
            padding: 30px 24px;
            text-align: center;
            color: #ffffff;
        }
        .header h1 {
            margin: 0 0 8px;
            font-size: 24px;
            font-weight: 800;
        }
        .header p {
            margin: 0;
            font-size: 14px;
            opacity: 0.9;
        }
        .content {
            padding: 24px;
        }
        .stats-grid {
            display: table;
            width: 100%;
            margin: 20px 0;
        }
        .stat-col {
            display: table-cell;
            width: 33.33%;
            padding: 12px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 10px;
            text-align: center;
        }
        .stat-val {
            font-size: 20px;
            font-weight: 700;
            color: #a78bfa;
            margin-bottom: 4px;
        }
        .stat-lbl {
            font-size: 11px;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .attachment-box {
            background: rgba(124, 58, 237, 0.1);
            border: 1px solid rgba(124, 58, 237, 0.3);
            border-radius: 12px;
            padding: 16px;
            margin: 24px 0;
            text-align: center;
        }
        .attachment-box strong {
            color: #38bdf8;
            display: block;
            margin-bottom: 6px;
            font-size: 15px;
        }
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #64748b;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>4khdiptv Database Backup</h1>
            <p>Periodic System Data Export (CSV)</p>
        </div>
        
        <div class="content">
            <p style="font-size: 15px; line-height: 1.5; color: #cbd5e1;">
                Hello Admin,<br><br>
                Your requested 4khdiptv system database export has been generated successfully and is attached to this email as a CSV spreadsheet.
            </p>

            <div class="stats-grid">
                <div class="stat-col" style="margin-right: 8px;">
                    <div class="stat-val">{{ number_format($stats['total_users'] ?? 0) }}</div>
                    <div class="stat-lbl">Total Users</div>
                </div>
                <div class="stat-col" style="margin-right: 8px;">
                    <div class="stat-val">{{ number_format($stats['total_orders'] ?? 0) }}</div>
                    <div class="stat-lbl">Total Orders</div>
                </div>
                <div class="stat-col">
                    <div class="stat-val">${{ $stats['total_revenue'] ?? '0.00' }}</div>
                    <div class="stat-lbl">Revenue</div>
                </div>
            </div>

            <div class="attachment-box">
                <strong>📎 Attached File: {{ $stats['filename'] ?? '4khdiptv-backup.csv' }}</strong>
                <span style="font-size: 13px; color: #94a3b8;">Contains all Customers, Orders, Packages, Affiliates, Inquiries & Settings. Compatible with Microsoft Excel, Google Sheets, and Numbers.</span>
            </div>

            <p style="font-size: 12px; color: #94a3b8; line-height: 1.5;">
                Generated at: <strong>{{ $stats['generated_at'] ?? now()->toDateTimeString() }}</strong><br>
                Security notice: This file contains confidential business information. Please store it securely.
            </p>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} 4khdiptv System Automated Reporting.
        </div>
    </div>
</body>
</html>
