<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    public function run(): void
    {
        $methods = [
            [
                'name'                 => 'ক্যাশ অন ডেলিভারি',
                'key'                  => 'cod',
                'description'          => 'পণ্য পেয়ে ডেলিভারি ম্যানকে পেমেন্ট করুন',
                'requires_transaction' => false,
                'payment_number'       => null,
                'icon'                 => 'banknotes',
                'is_active'            => true,
                'sort_order'           => 1,
            ],
            [
                'name'                 => 'বিকাশ',
                'key'                  => 'bkash',
                'description'          => 'বিকাশে পেমেন্ট করুন এবং ট্রানজেকশন আইডি দিন',
                'requires_transaction' => true,
                'payment_number'       => '01700000000', // replace with actual bKash number
                'icon'                 => 'device-mobile',
                'is_active'            => false, // disabled by default
                'sort_order'           => 2,
            ],
            [
                'name'                 => 'নগদ',
                'key'                  => 'nagad',
                'description'          => 'নগদে পেমেন্ট করুন এবং ট্রানজেকশন আইডি দিন',
                'requires_transaction' => true,
                'payment_number'       => '01700000001', // replace with actual Nagad number
                'icon'                 => 'device-mobile',
                'is_active'            => false, // disabled by default
                'sort_order'           => 3,
            ],
        ];

        foreach ($methods as $method) {
            PaymentMethod::firstOrCreate(
                ['key' => $method['key']],
                $method
            );
        }
    }
}
