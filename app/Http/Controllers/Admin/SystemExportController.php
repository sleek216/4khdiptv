<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Package;
use App\Models\Setting;
use App\Models\User;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SystemExportController extends Controller
{
    public function download(): StreamedResponse
    {
        $fileName = '4khdiptv-system-backup-' . now()->format('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        return response()->stream(function () {
            $handle = fopen('php://output', 'w');
            fwrite($handle, "\xEF\xBB\xBF"); // Excel-friendly UTF-8

            // ===== USERS + ORDERS =====
            fputcsv($handle, ['SECTION', 'USERS_AND_ORDERS']);
            fputcsv($handle, [
                'User ID',
                'User Name',
                'User Email',
                'User Phone',
                'User Country',
                'User Created At',
                'Total Orders By User',
                'Total Spent By User',
                'Order Number',
                'Order Date',
                'Package Name',
                'Package Duration',
                'Order Amount',
                'Payment Method',
                'Payment Status',
                'Order Status',
                'Order Active',
                'Selected Countries',
                'Expires At',
            ]);

            User::query()
                ->where('is_admin', false)
                ->with(['orders.package', 'orders.countries'])
                ->withCount('orders')
                ->orderBy('id')
                ->chunk(100, function ($users) use ($handle) {
                    foreach ($users as $user) {
                        $totalSpentByUser = (float) $user->orders->sum('amount');

                        if ($user->orders->isEmpty()) {
                            fputcsv($handle, [
                                $user->id,
                                $user->name,
                                $user->email,
                                $user->phone,
                                $user->country,
                                optional($user->created_at)->format('Y-m-d H:i:s'),
                                (int) $user->orders_count,
                                number_format($totalSpentByUser, 2, '.', ''),
                                '', '', '', '', '', '', '', '', '', '', '',
                            ]);
                            continue;
                        }

                        foreach ($user->orders as $order) {
                            fputcsv($handle, [
                                $user->id,
                                $user->name,
                                $user->email,
                                $user->phone,
                                $user->country,
                                optional($user->created_at)->format('Y-m-d H:i:s'),
                                (int) $user->orders_count,
                                number_format($totalSpentByUser, 2, '.', ''),
                                $order->order_number,
                                optional($order->created_at)->format('Y-m-d H:i:s'),
                                $order->package->name ?? 'N/A',
                                $order->package->duration_label ?? '',
                                number_format((float) $order->amount, 2, '.', ''),
                                $order->payment_method,
                                $order->payment_status,
                                $order->order_status,
                                $order->is_active ? 'Yes' : 'No',
                                $order->countries->pluck('name')->implode(', '),
                                optional($order->expires_at)->format('Y-m-d H:i:s'),
                            ]);
                        }
                    }
                });

            fputcsv($handle, []);
            fputcsv($handle, ['SECTION', 'PACKAGES']);
            fputcsv($handle, [
                'Package ID', 'Name', 'Slug', 'Price', 'Original Price', 'Duration Label',
                'Duration Months', 'Duration Days', 'Connections', 'Active', 'Featured', 'Reseller', 'Created At',
            ]);

            Package::query()->orderBy('id')->chunk(100, function ($packages) use ($handle) {
                foreach ($packages as $package) {
                    fputcsv($handle, [
                        $package->id,
                        $package->name,
                        $package->slug,
                        number_format((float) $package->price, 2, '.', ''),
                        $package->original_price !== null ? number_format((float) $package->original_price, 2, '.', '') : '',
                        $package->getRawOriginal('duration_label') ?? $package->duration_label,
                        $package->duration_months,
                        $package->duration_days,
                        $package->connections ?? $package->devices,
                        $package->is_active ? 'Yes' : 'No',
                        $package->is_featured ? 'Yes' : 'No',
                        $package->is_reseller ? 'Yes' : 'No',
                        optional($package->created_at)->format('Y-m-d H:i:s'),
                    ]);
                }
            });

            fputcsv($handle, []);
            fputcsv($handle, ['SECTION', 'ORDERS_SUMMARY']);
            fputcsv($handle, [
                'Order ID', 'Order Number', 'Customer Email', 'Amount', 'Payment Status',
                'Order Status', 'Payment Method', 'Created At', 'Expires At',
            ]);

            Order::query()->with('user')->orderBy('id')->chunk(200, function ($orders) use ($handle) {
                foreach ($orders as $order) {
                    fputcsv($handle, [
                        $order->id,
                        $order->order_number,
                        $order->user->email ?? ($order->customer_email ?? ''),
                        number_format((float) $order->amount, 2, '.', ''),
                        $order->payment_status,
                        $order->order_status,
                        $order->payment_method,
                        optional($order->created_at)->format('Y-m-d H:i:s'),
                        optional($order->expires_at)->format('Y-m-d H:i:s'),
                    ]);
                }
            });

            fputcsv($handle, []);
            fputcsv($handle, ['SECTION', 'SETTINGS']);
            fputcsv($handle, ['Key', 'Value', 'Type', 'Group']);

            if (class_exists(Setting::class)) {
                Setting::query()->orderBy('id')->chunk(200, function ($settings) use ($handle) {
                    foreach ($settings as $setting) {
                        $value = (string) ($setting->value ?? '');
                        // Skip likely secrets from plain export
                        if (preg_match('/secret|password|private|api_key|token/i', (string) $setting->key)) {
                            $value = '[REDACTED]';
                        }
                        fputcsv($handle, [
                            $setting->key,
                            $value,
                            $setting->type ?? '',
                            $setting->group ?? '',
                        ]);
                    }
                });
            }

            fclose($handle);
        }, 200, $headers);
    }
}
