<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        // Resolve product IDs by slug so reviews can be product-linked
        $products = Product::pluck('id', 'slug');
        $green  = $products['green-tea']   ?? null;
        $black  = $products['black-tea']   ?? null;
        $floral = $products['floral-tea']  ?? null;
        $combo  = $products['combo-pack']  ?? null;

        $reviews = [
            [
                'product_id' => $green,
                'name' => 'রহিম আহমেদ',
                'location' => 'ঢাকা',
                'initial' => 'রহ',
                'text' => 'অর্গানিক চা সত্যিই অসাধারণ! স্বাদ আর গন্ধ দুটোই প্রিমিয়াম।',
                'stars' => 5,
                'status' => true,
            ],
            [
                'product_id' => $green,
                'name' => 'ফারহানা খান',
                'location' => 'চট্টগ্রাম',
                'initial' => 'ফা',
                'text' => 'গ্রিন টি অর্ডার করেছিলাম, প্যাকেজিং ছিল দারুণ। চা পাতা একদম তাজা।',
                'stars' => 5,
                'status' => true,
            ],
            [
                'product_id' => $black,
                'name' => 'কামাল হোসেন',
                'location' => 'সিলেট',
                'initial' => 'কা',
                'text' => 'দীর্ঘদিন ধরে ভালো চা খুঁজছিলাম। অর্গানিক চা সেই খোঁজ শেষ করেছে।',
                'stars' => 5,
                'status' => true,
            ],
            [
                'product_id' => $floral,
                'name' => 'নাসরিন আক্তার',
                'location' => 'রাজশাহী',
                'initial' => 'না',
                'text' => 'হার্বাল টি আমার ঘুমের সমস্যা অনেকটাই কমিয়ে দিয়েছে।',
                'stars' => 4,
                'status' => true,
            ],
            [
                'product_id' => $combo,
                'name' => 'জাহিদ হাসান',
                'location' => 'খুলনা',
                'initial' => 'জা',
                'text' => 'কম্বো প্যাক কিনেছিলাম - তিন ধরনের চা একসাথে। মানসম্মত।',
                'stars' => 5,
                'status' => true,
            ],
            [
                'product_id' => $black,
                'name' => 'সালমা বেগম',
                'location' => 'চট্টগ্রাম',
                'initial' => 'সা',
                'text' => 'ব্ল্যাক টি এর সুগন্ধ অসাধারণ। ডেলিভারিও খুব দ্রুত।',
                'stars' => 5,
                'status' => true,
            ],
            [
                'product_id' => $combo,
                'name' => 'তানভীর রহমান',
                'location' => 'ঢাকা',
                'initial' => 'তা',
                'text' => 'বন্ধুর কাছ থেকে শুনে অর্ডার করেছিলাম। প্রিমিয়াম কোয়ালিটি।',
                'stars' => 4,
                'status' => true,
            ],
            [
                'product_id' => $green,
                'name' => 'মাহমুদা ইসলাম',
                'location' => 'বরিশাল',
                'initial' => 'মা',
                'text' => 'গ্রিন টি দিয়ে ডায়েট শুরু করেছি। স্বাদ হালকা কিন্তু তৃপ্তিদায়ক।',
                'stars' => 5,
                'status' => true,
            ],
            [
                'product_id' => $black,
                'name' => 'আরিফুল ইসলাম',
                'location' => 'সিলেট',
                'initial' => 'আ',
                'text' => 'চা প্রেমি হিসেবে বলছি - এত ভালো চা আগে পাইনি।',
                'stars' => 5,
                'status' => true,
            ],
            [
                'product_id' => $floral,
                'name' => 'রুমানা পারভীন',
                'location' => 'ঢাকা',
                'initial' => 'রু',
                'text' => 'ফুলের চা আমার পছন্দ সবচেয়ে বেশি। সুগন্ধ মন মুগ্ধ করে।',
                'stars' => 5,
                'status' => true,
            ],
            [
                'product_id' => null,
                'name' => 'সোহেল রানা',
                'location' => 'কক্সবাজার',
                'initial' => 'সো',
                'text' => 'সারাদিনে ৩ কাপ চা খাই। অর্গানিক চা স্বাস্থ্যের জন্য ভালো।',
                'stars' => 4,
                'status' => true,
            ],
            [
                'product_id' => $combo,
                'name' => 'তাসনিম জাহান',
                'location' => 'রংপুর',
                'initial' => 'তা',
                'text' => 'ছেলেমেয়েরাও এখন এই চা খায়। কোনো কৃত্রিম স্বাদ নেই।',
                'stars' => 5,
                'status' => true,
            ],
        ];

        foreach ($reviews as $review) {
            Review::create($review);
        }
    }
}
