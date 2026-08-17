<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;
use App\Models\Package;
use Illuminate\Support\Str;

class DummyOrderSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        if (!$user) return;

        $packages = Package::all();
        if ($packages->isEmpty()) return;

        $paymentStatuses = ['pending', 'completed', 'failed', 'refunded'];
        $orderStatuses = ['pending', 'processing', 'completed', 'cancelled'];

        for ($i = 0; $i < 20; $i++) {
            $package = $packages->random();
            $paymentStatus = $paymentStatuses[array_rand($paymentStatuses)];
            $orderStatus = $orderStatuses[array_rand($orderStatuses)];
            
            // Random date within last 6 months
            $date = now()->subDays(rand(0, 180));

            Order::create([
                'order_number' => 'DUMMY-' . strtoupper(Str::random(8)),
                'user_id' => $user->id,
                'package_id' => $package->id,
                'customer_name' => $user->name,
                'customer_email' => $user->email,
                'customer_phone' => '1234567890',
                'amount' => $package->price,
                'payment_method' => 'Stripe',
                'payment_status' => $paymentStatus,
                'order_status' => $orderStatus,
                'activated_at' => ($orderStatus == 'completed') ? $date : null,
                'expires_at' => ($orderStatus == 'completed') ? (clone $date)->addMonths($package->duration_months ?? 1) : null,
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }
    }
}
