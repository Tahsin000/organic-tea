<?php

namespace Database\Seeders;

use App\Models\DeliveryCharge;
use Illuminate\Database\Seeder;

class DeliveryChargeSeeder extends Seeder
{
    public function run(): void
    {
        $charges = [
            [
                'area_name'  => 'ঢাকা',
                'area_key'   => 'dhaka',
                'charge'     => 60.00,
                'is_active'  => true,
                'sort_order' => 1,
            ],
            [
                'area_name'  => 'চট্টগ্রাম',
                'area_key'   => 'chittagong',
                'charge'     => 60.00,
                'is_active'  => true,
                'sort_order' => 2,
            ],
            [
                'area_name'  => 'ঢাকা/চট্টগ্রামের বাইরে',
                'area_key'   => 'outside',
                'charge'     => 120.00,
                'is_active'  => true,
                'sort_order' => 3,
            ],
            [
                'area_name'  => 'সিলেট',
                'area_key'   => 'sylhet',
                'charge'     => 100.00,
                'is_active'  => false, // disabled by default – admin can enable
                'sort_order' => 4,
            ],
        ];

        foreach ($charges as $charge) {
            DeliveryCharge::firstOrCreate(
                ['area_key' => $charge['area_key']],
                $charge
            );
        }
    }
}
