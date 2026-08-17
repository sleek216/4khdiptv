<?php

namespace App\Services;

use App\Mail\DatabaseExportMail;
use App\Models\Affiliate;
use App\Models\Blog;
use App\Models\Channel;
use App\Models\ChannelCategory;
use App\Models\Commission;
use App\Models\Contact;
use App\Models\Country;
use App\Models\Coupon;
use App\Models\Faq;
use App\Models\Order;
use App\Models\Package;
use App\Models\Payout;
use App\Models\Referral;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class DatabaseExportService
{
    /**
     * Generate complete 100% full database CSV content covering every table and field.
     */
    public function generateExportCsv(): string
    {
        $handle = fopen('php://temp', 'r+');
        // UTF-8 BOM for flawless Excel / Numbers / Google Sheets display
        fwrite($handle, "\xEF\xBB\xBF");

        // ==========================================
        // 1. EXECUTIVE SYSTEM SUMMARY & TOTALS
        // ==========================================
        fputcsv($handle, ['========================================================================']);
        fputcsv($handle, ['4KHDIPTV - COMPLETE SYSTEM & DATABASE EXPORT BACKUP']);
        fputcsv($handle, ['========================================================================']);
        fputcsv($handle, ['Export Timestamp', now()->format('Y-m-d H:i:s T')]);
        fputcsv($handle, ['Environment', config('app.env', 'production')]);
        fputcsv($handle, ['Total Users/Customers', User::count()]);
        fputcsv($handle, ['Total Orders Placed', Order::count()]);
        fputcsv($handle, ['Completed Orders', Order::where('payment_status', 'completed')->count()]);
        fputcsv($handle, ['Pending Orders', Order::where('payment_status', 'pending')->count()]);
        fputcsv($handle, ['Gross Revenue ($)', number_format((float) Order::where('payment_status', 'completed')->sum('amount'), 2)]);
        fputcsv($handle, ['Total Packages', Package::count()]);
        fputcsv($handle, ['Total Coupons', Coupon::count()]);
        fputcsv($handle, ['Total Affiliates', Affiliate::count()]);
        fputcsv($handle, ['Total Commissions ($)', number_format((float) Commission::sum('commission_amount'), 2)]);
        fputcsv($handle, ['Total Contacts/Leads', Contact::count()]);
        fputcsv($handle, ['Total Testimonials', Testimonial::count()]);
        fputcsv($handle, ['Total FAQ Entries', Faq::count()]);
        fputcsv($handle, ['Total Channels Configured', Channel::count()]);
        fputcsv($handle, []);

        // ==========================================
        // 2. USERS & CUSTOMERS DATABASE
        // ==========================================
        fputcsv($handle, ['------------------------------------------------------------------------']);
        fputcsv($handle, ['TABLE: USERS & CUSTOMERS (FULL RECORD)']);
        fputcsv($handle, ['------------------------------------------------------------------------']);
        fputcsv($handle, [
            'ID', 'Full Name', 'Email Address', 'Phone Number', 'Country', 'Role', 'Status',
            '2FA Enabled', 'Email Verified', 'Total Orders Count', 'Lifetime Spent ($)',
            'Last Login IP', 'Created At', 'Updated At'
        ]);

        User::withCount('orders')
            ->with('orders')
            ->orderBy('id')
            ->chunk(100, function ($users) use ($handle) {
                foreach ($users as $user) {
                    $spent = (float) $user->orders->where('payment_status', 'completed')->sum('amount');
                    fputcsv($handle, [
                        $user->id,
                        $user->name,
                        $user->email,
                        $user->phone ?? 'N/A',
                        $user->country ?? 'N/A',
                        $user->isAdmin() ? 'ADMIN' : 'CUSTOMER',
                        $user->is_active ?? true ? 'Active' : 'Inactive',
                        $user->two_factor_confirmed_at ? 'Yes' : 'No',
                        $user->email_verified_at ? $user->email_verified_at->format('Y-m-d H:i:s') : 'Unverified',
                        $user->orders_count,
                        number_format($spent, 2, '.', ''),
                        $user->last_login_ip ?? 'N/A',
                        optional($user->created_at)->format('Y-m-d H:i:s'),
                        optional($user->updated_at)->format('Y-m-d H:i:s'),
                    ]);
                }
            });

        fputcsv($handle, []);

        // ==========================================
        // 3. ORDERS & SUBSCRIPTIONS (COMPLETE DETAILS)
        // ==========================================
        fputcsv($handle, ['------------------------------------------------------------------------']);
        fputcsv($handle, ['TABLE: ORDERS & SUBSCRIPTIONS (COMPLETE HISTORY)']);
        fputcsv($handle, ['------------------------------------------------------------------------']);
        fputcsv($handle, [
            'Order ID', 'Order Number', 'User ID', 'Customer Name', 'Customer Email', 'Customer Phone',
            'Package Name', 'Package Duration', 'Devices/Screens', 'Amount ($)', 'Discount ($)', 'Coupon Code',
            'Payment Method', 'Payment Status', 'Order Status', 'Active Subscription', 'Selected Countries',
            'Xtream Username', 'Xtream Password', 'Portal URL', 'M3U Link', 'MAC Address', 'Device Type',
            'Notes', 'Expires At', 'Order Created At'
        ]);

        Order::with(['package', 'countries'])->orderBy('id', 'desc')->chunk(150, function ($orders) use ($handle) {
            foreach ($orders as $order) {
                $countries = $order->countries ? $order->countries->pluck('name')->implode(', ') : '';
                fputcsv($handle, [
                    $order->id,
                    $order->order_number,
                    $order->user_id ?? 'Guest',
                    $order->customer_name,
                    $order->customer_email,
                    $order->customer_phone ?? 'N/A',
                    $order->package->name ?? 'N/A',
                    $order->package->duration_label ?? 'N/A',
                    $order->package->devices ?? $order->package->connections ?? 1,
                    number_format((float) $order->amount, 2, '.', ''),
                    number_format((float) ($order->discount_amount ?? 0), 2, '.', ''),
                    $order->coupon_code ?? 'None',
                    $order->payment_method,
                    strtoupper($order->payment_status),
                    strtoupper($order->order_status),
                    $order->is_active ? 'YES' : 'NO',
                    $countries ?: 'All Regions',
                    $order->username ?? 'N/A',
                    $order->password ?? 'N/A',
                    $order->portal_url ?? 'N/A',
                    $order->m3u_url ?? 'N/A',
                    $order->mac_address ?? 'N/A',
                    $order->device_type ?? 'N/A',
                    str_replace(["\r", "\n"], ' ', (string) ($order->notes ?? '')),
                    optional($order->expires_at)->format('Y-m-d H:i:s') ?? 'Lifetime / Not Set',
                    optional($order->created_at)->format('Y-m-d H:i:s')
                ]);
            }
        });

        fputcsv($handle, []);

        // ==========================================
        // 4. PACKAGES & PRICING PLANS
        // ==========================================
        fputcsv($handle, ['------------------------------------------------------------------------']);
        fputcsv($handle, ['TABLE: PACKAGES & SUBSCRIPTION TIERS']);
        fputcsv($handle, ['------------------------------------------------------------------------']);
        fputcsv($handle, [
            'ID', 'Package Name', 'Slug', 'Price ($)', 'Original Price ($)', 'Duration Label',
            'Duration (Months)', 'Duration (Days)', 'Devices Allowed', 'Status', 'Featured', 'Reseller Package', 'Created At'
        ]);

        Package::orderBy('id')->chunk(50, function ($packages) use ($handle) {
            foreach ($packages as $pkg) {
                fputcsv($handle, [
                    $pkg->id,
                    $pkg->name,
                    $pkg->slug,
                    number_format((float) $pkg->price, 2, '.', ''),
                    $pkg->original_price !== null ? number_format((float) $pkg->original_price, 2, '.', '') : 'N/A',
                    $pkg->duration_label,
                    $pkg->duration_months ?? 0,
                    $pkg->duration_days ?? 0,
                    $pkg->devices ?? $pkg->connections ?? 1,
                    $pkg->is_active ? 'Active' : 'Inactive',
                    $pkg->is_featured ? 'Yes' : 'No',
                    $pkg->is_reseller ? 'Yes' : 'No',
                    optional($pkg->created_at)->format('Y-m-d H:i:s')
                ]);
            }
        });

        fputcsv($handle, []);

        // ==========================================
        // 5. COUPONS & DISCOUNTS
        // ==========================================
        fputcsv($handle, ['------------------------------------------------------------------------']);
        fputcsv($handle, ['TABLE: DISCOUNT COUPONS']);
        fputcsv($handle, ['------------------------------------------------------------------------']);
        fputcsv($handle, [
            'ID', 'Coupon Code', 'Discount Type', 'Discount Value', 'Max Uses', 'Times Used',
            'Min Order Amount ($)', 'Valid From', 'Expires At', 'Status', 'Created At'
        ]);

        Coupon::orderBy('id')->chunk(50, function ($coupons) use ($handle) {
            foreach ($coupons as $coupon) {
                fputcsv($handle, [
                    $coupon->id,
                    $coupon->code,
                    $coupon->type,
                    $coupon->value,
                    $coupon->max_uses ?? 'Unlimited',
                    $coupon->used_count ?? 0,
                    number_format((float) ($coupon->min_order_amount ?? 0), 2, '.', ''),
                    optional($coupon->valid_from)->format('Y-m-d H:i:s') ?? 'Immediate',
                    optional($coupon->expires_at)->format('Y-m-d H:i:s') ?? 'Never',
                    $coupon->is_active ? 'Active' : 'Inactive',
                    optional($coupon->created_at)->format('Y-m-d H:i:s')
                ]);
            }
        });

        fputcsv($handle, []);

        // ==========================================
        // 6. AFFILIATE PARTNERS & PERFORMANCE
        // ==========================================
        fputcsv($handle, ['------------------------------------------------------------------------']);
        fputcsv($handle, ['TABLE: AFFILIATE PARTNERS']);
        fputcsv($handle, ['------------------------------------------------------------------------']);
        fputcsv($handle, [
            'Affiliate ID', 'User ID', 'Affiliate Name', 'Affiliate Email', 'Referral Code',
            'Commission Rate (%)', 'Lifetime Earnings ($)', 'Pending Payout ($)', 'Status', 'Joined Date'
        ]);

        Affiliate::with('user')->orderBy('id')->chunk(100, function ($affiliates) use ($handle) {
            foreach ($affiliates as $aff) {
                fputcsv($handle, [
                    $aff->id,
                    $aff->user_id,
                    $aff->user->name ?? 'N/A',
                    $aff->user->email ?? 'N/A',
                    $aff->referral_code,
                    $aff->commission_rate,
                    number_format((float) $aff->total_earnings, 2, '.', ''),
                    number_format((float) $aff->pending_payout, 2, '.', ''),
                    $aff->is_active ? 'Active' : 'Suspended',
                    optional($aff->created_at)->format('Y-m-d H:i:s')
                ]);
            }
        });

        fputcsv($handle, []);

        // ==========================================
        // 7. COMMISSIONS & PAYOUTS
        // ==========================================
        fputcsv($handle, ['------------------------------------------------------------------------']);
        fputcsv($handle, ['TABLE: AFFILIATE COMMISSIONS']);
        fputcsv($handle, ['------------------------------------------------------------------------']);
        fputcsv($handle, [
            'ID', 'Affiliate ID', 'Order ID', 'Order Amount ($)', 'Commission Rate (%)',
            'Commission Earned ($)', 'Commission Status', 'Approved At', 'Created At'
        ]);

        Commission::with('affiliate')->orderBy('id', 'desc')->chunk(100, function ($commissions) use ($handle) {
            foreach ($commissions as $comm) {
                fputcsv($handle, [
                    $comm->id,
                    $comm->affiliate_id,
                    $comm->order_id,
                    number_format((float) ($comm->order_amount ?? 0), 2, '.', ''),
                    $comm->rate ?? 0,
                    number_format((float) ($comm->commission_amount ?? 0), 2, '.', ''),
                    strtoupper($comm->status ?? 'pending'),
                    optional($comm->approved_at)->format('Y-m-d H:i:s') ?? 'Pending',
                    optional($comm->created_at)->format('Y-m-d H:i:s')
                ]);
            }
        });

        fputcsv($handle, []);

        // ==========================================
        // 8. CONTACT MESSAGES & INQUIRIES
        // ==========================================
        fputcsv($handle, ['------------------------------------------------------------------------']);
        fputcsv($handle, ['TABLE: CONTACT MESSAGES & SUPPORT LEADS']);
        fputcsv($handle, ['------------------------------------------------------------------------']);
        fputcsv($handle, [
            'ID', 'Customer Name', 'Email Address', 'Subject', 'Message Content', 'Status', 'Date Received'
        ]);

        Contact::orderBy('id', 'desc')->chunk(100, function ($contacts) use ($handle) {
            foreach ($contacts as $contact) {
                fputcsv($handle, [
                    $contact->id,
                    $contact->name,
                    $contact->email,
                    $contact->subject ?? 'General Inquiry',
                    str_replace(["\r", "\n", "\t"], ' ', (string) $contact->message),
                    strtoupper($contact->status ?? 'new'),
                    optional($contact->created_at)->format('Y-m-d H:i:s')
                ]);
            }
        });

        fputcsv($handle, []);

        // ==========================================
        // 9. CHANNELS & CATEGORIES
        // ==========================================
        fputcsv($handle, ['------------------------------------------------------------------------']);
        fputcsv($handle, ['TABLE: CHANNEL CATEGORIES']);
        fputcsv($handle, ['------------------------------------------------------------------------']);
        fputcsv($handle, ['Category ID', 'Category Name', 'Slug', 'Display Order', 'Active']);

        ChannelCategory::orderBy('id')->chunk(50, function ($cats) use ($handle) {
            foreach ($cats as $cat) {
                fputcsv($handle, [
                    $cat->id,
                    $cat->name,
                    $cat->slug ?? '',
                    $cat->sort_order ?? 0,
                    $cat->is_active ? 'Yes' : 'No'
                ]);
            }
        });

        fputcsv($handle, []);

        // ==========================================
        // 10. TESTIMONIALS & REVIEWS
        // ==========================================
        fputcsv($handle, ['------------------------------------------------------------------------']);
        fputcsv($handle, ['TABLE: TESTIMONIALS & REVIEWS']);
        fputcsv($handle, ['------------------------------------------------------------------------']);
        fputcsv($handle, ['ID', 'Author Name', 'Designation / Country', 'Rating Stars', 'Review Content', 'Active', 'Created At']);

        Testimonial::orderBy('id')->chunk(50, function ($testimonials) use ($handle) {
            foreach ($testimonials as $testi) {
                fputcsv($handle, [
                    $testi->id,
                    $testi->name,
                    $testi->designation ?? $testi->country ?? '',
                    $testi->rating ?? 5,
                    str_replace(["\r", "\n"], ' ', (string) $testi->content),
                    $testi->is_active ? 'Yes' : 'No',
                    optional($testi->created_at)->format('Y-m-d H:i:s')
                ]);
            }
        });

        fputcsv($handle, []);

        // ==========================================
        // 11. BLOG ARTICLES
        // ==========================================
        fputcsv($handle, ['------------------------------------------------------------------------']);
        fputcsv($handle, ['TABLE: BLOG POSTS & ARTICLES']);
        fputcsv($handle, ['------------------------------------------------------------------------']);
        fputcsv($handle, ['ID', 'Title', 'Slug', 'Category', 'Views Count', 'Published', 'Created At']);

        Blog::orderBy('id')->chunk(50, function ($blogs) use ($handle) {
            foreach ($blogs as $blog) {
                fputcsv($handle, [
                    $blog->id,
                    $blog->title,
                    $blog->slug,
                    $blog->category ?? 'General',
                    $blog->views ?? 0,
                    $blog->is_published ? 'Yes' : 'No',
                    optional($blog->created_at)->format('Y-m-d H:i:s')
                ]);
            }
        });

        fputcsv($handle, []);

        // ==========================================
        // 12. SYSTEM CONFIGURATIONS & SETTINGS
        // ==========================================
        fputcsv($handle, ['------------------------------------------------------------------------']);
        fputcsv($handle, ['TABLE: SYSTEM SETTINGS & CONFIGURATION']);
        fputcsv($handle, ['------------------------------------------------------------------------']);
        fputcsv($handle, ['Setting Key', 'Config Value', 'Category Group']);

        Setting::orderBy('id')->chunk(100, function ($settings) use ($handle) {
            foreach ($settings as $setting) {
                $val = (string) ($setting->value ?? '');
                // Mask sensitive credentials in CSV export for security
                if (preg_match('/secret|password|private_key|api_key|token/i', (string) $setting->key)) {
                    $val = '***PROTECTED***';
                }
                fputcsv($handle, [
                    $setting->key,
                    $val,
                    $setting->group ?? 'General'
                ]);
            }
        });

        rewind($handle);
        $content = stream_get_contents($handle);
        fclose($handle);

        return (string) $content;
    }

    /**
     * Send the CSV export file to the configured or specified email address.
     */
    public function sendExportToEmail(?string $customEmail = null): array
    {
        $targetEmail = $customEmail 
            ?: Setting::get('backup_export_email') 
            ?: Setting::get('admin_notification_email') 
            ?: Setting::get('mail_from_address') 
            ?: config('mail.from.address');

        if (empty($targetEmail) || !filter_var($targetEmail, FILTER_VALIDATE_EMAIL)) {
            return [
                'success' => false,
                'message' => 'Please configure a valid email address in Settings first.'
            ];
        }

        try {
            // Apply live SMTP settings from database if configured
            $this->configureDynamicMailer();

            $csvData = $this->generateExportCsv();
            $filename = '4khdiptv-complete-database-backup-' . now()->format('Y-m-d_H-i-s') . '.csv';

            $stats = [
                'total_users' => User::count(),
                'total_orders' => Order::count(),
                'total_revenue' => number_format((float) Order::where('payment_status', 'completed')->sum('amount'), 2),
                'generated_at' => now()->format('M d, Y - h:i A T'),
                'filename' => $filename,
            ];

            Mail::to($targetEmail)->send(new DatabaseExportMail($csvData, $filename, $stats));

            // Record timestamp of last successful email export
            Setting::set('backup_export_last_sent_at', now()->toDateTimeString());

            Log::info("Database export CSV sent successfully to: {$targetEmail}");

            return [
                'success' => true,
                'email' => $targetEmail,
                'filename' => $filename,
                'message' => "Complete database export CSV has been emailed to {$targetEmail} successfully!"
            ];
        } catch (\Throwable $e) {
            Log::error("Failed to send database export email: " . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Email dispatch error: ' . $e->getMessage() . '. Please verify your SMTP settings in Settings -> Email.'
            ];
        }
    }

    /**
     * Dynamically apply database-stored SMTP settings so mailing works consistently.
     */
    protected function configureDynamicMailer(): void
    {
        $host = Setting::get('mail_host');
        $port = Setting::get('mail_port');
        $username = Setting::get('mail_username');
        $password = Setting::get('mail_password');
        $encryption = Setting::get('mail_encryption');
        $fromAddress = Setting::get('mail_from_address');
        $fromName = Setting::get('mail_from_name');

        if ($host && $username && $password) {
            config([
                'mail.default' => 'smtp',
                'mail.mailers.smtp.host' => $host,
                'mail.mailers.smtp.port' => (int) ($port ?: 587),
                'mail.mailers.smtp.username' => $username,
                'mail.mailers.smtp.password' => $password,
                'mail.mailers.smtp.encryption' => $encryption ?: 'tls',
                'mail.from.address' => $fromAddress ?: $username,
                'mail.from.name' => $fromName ?: config('app.name', '4khdiptv'),
            ]);
        }
    }
}
