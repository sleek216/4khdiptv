<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DummyPackageSeeder extends Seeder
{
    public function run(): void
    {
        $baseSortOrder = (int) (Package::max('sort_order') ?? 0) + 1;

        $packages = [];
        for ($i = 1; $i <= 10; $i++) {
            $name = "Dummy Package {$i}";
            $slug = Str::slug($name) . '-' . date('Ymd') . "-{$i}";

            $durationMonths = match (true) {
                $i <= 3 => 1,
                $i <= 6 => 3,
                $i <= 8 => 6,
                default => 12,
            };

            $durationDays = match ($durationMonths) {
                1 => 30,
                3 => 90,
                6 => 180,
                12 => 365,
                default => 30,
            };

            $durationLabel = match ($durationMonths) {
                1 => '1 Month',
                3 => '3 Months',
                6 => '6 Months',
                12 => '12 Months',
                default => '1 Month',
            };

            $price = match (true) {
                $i <= 3 => 9.99 + $i,
                $i <= 6 => 24.99 + $i,
                $i <= 8 => 44.99 + $i,
                default => 79.99 + $i,
            };

            $originalPrice = $price + 10;

            $packages[] = [
                'name' => $name,
                'slug' => $slug,
                'description' => 'Dummy package seeded for local testing.',
                'price' => $price,
                'original_price' => $originalPrice,
                'duration_months' => $durationMonths,
                'duration_days' => $durationDays,
                'duration_label' => $durationLabel,
                'connections' => $i % 4 === 0 ? 4 : ($i % 3 === 0 ? 2 : 1),
                'features_list' => json_encode([
                    '20,000+ Live Channels',
                    '50,000+ VOD',
                    'HD Streaming',
                    '24/7 Support',
                ]),
                'is_featured' => $i === 2,
                'is_trial' => false,
                'is_active' => true,
                'is_reseller' => false,
                'sort_order' => $baseSortOrder + $i,
            ];
        }

        foreach ($packages as $data) {
            Package::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
