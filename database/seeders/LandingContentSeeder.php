<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class LandingContentSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            'hero' => [
                'status' => true,
                'badge' => '১০% প্রাকৃতিক ও জৈব',
                'title_1' => 'সেরা মানের ',
                'title_highlight' => 'অ্যারোমা ব্লেন্ড',
                'title_2' => ' চা <br class="hidden sm:block" /> আপনার দরজায়',
                'description' => 'সিলেটের পাহাড়ি বাগান থেকে সংগ্রহ করা বিশুদ্ধ জৈব চা পাতা।',
                'cta_primary' => 'পণ্য দেখুন',
                'cta_secondary' => 'অফার দেখুন',
                'stats' => [
                    ['value' => '৫০০০+', 'label' => 'সন্তুষ্ট গ্রাহক'],
                    ['value' => '৪.৮/৫', 'label' => 'গড় রেটিং'],
                    ['value' => '১০০০+', 'label' => 'অর্ডার সম্পন্ন'],
                ],
            ],

            'product_overview' => [
                'status' => true,
                'badge' => 'আমাদের বিশেষত্ব',
                'title_1' => 'কেন ',
                'title_highlight' => 'অ্যারোমা ব্লেন্ড',
                'title_2' => ' চা সেরা?',
                'description' => 'প্রতিটি কাপে প্রকৃতির বিশুদ্ধতা',
                'popular_title' => 'আমাদের জনপ্রিয় পণ্যসমূহ',
                'features' => [
                    ['icon' => 'shield', 'title' => '১০০% জৈব', 'desc' => 'কোনো রাসায়নিক সার বা কীটনাশক নেই'],
                    ['icon' => 'truck', 'title' => 'পাহাড়ি বাগান', 'desc' => 'সিলেটের পাহাড়ি এলাকায় গাছ থেকে সংগ্রহ'],
                    ['icon' => 'star', 'title' => 'হাতে তোলা', 'desc' => 'অভিজ্ঞ কর্মীদের দ্বারা যত্ন সহকারে সংগ্রহ'],
                    ['icon' => 'bolt', 'title' => 'তাজা প্যাকেজিং', 'desc' => 'ভ্যাকুয়াম সিল প্যাকেজিং'],
                ],
            ],

            'offer' => [
                'status' => true,
                'badge' => 'সীমিত সময়ের অফার!',
                'title_1' => 'প্রথম অর্ডারে ',
                'title_highlight' => '২০% ছাড়',
                'description' => 'অ্যারোমা ব্লেন্ড ট্রায়াল করুন বিশেষ মূল্যে।',
                'countdown_label' => 'অফার শেষ হতে বাকি',
                'timer_enabled' => true,
                'end_date' => date('Y-m-d', strtotime('+7 days')),
                'cta_text' => 'এখনই অর্ডার করুন',
                'stats' => [
                    ['value' => '৫০০', 'label' => 'সর্বনিম্ন অর্ডার'],
                    ['value' => 'ফ্রি', 'label' => 'ডেলিভারি'],
                    ['value' => '৭ দিন', 'label' => 'রিটার্ন পলিসি'],
                ],
            ],

            'product_gallery' => [
                'status' => true,
                'badge' => 'আমাদের যাত্রা',
                'title_1' => 'বাগান থেকে ',
                'title_highlight' => 'আপনার কাপ',
                'title_2' => ' পর্যন্ত',
                'description' => 'সিলেটের পাহাড় থেকে আপনার টেবিলে',
                'steps' => [
                    ['title' => 'পাহাড়ি বাগানে জন্ম', 'desc' => 'সিলেটের ২০০০ ফুট উচ্চতায় জৈব চা বাগান।'],
                    ['title' => 'হাতে সংগ্রহ', 'desc' => 'অভিজ্ঞ কর্মীরা হাতে তোলেন সেরা পাতা।'],
                    ['title' => 'প্রক্রিয়াকরণ', 'desc' => 'অক্সিডেশন, রোলিং ও ড্রাইয়িং।'],
                    ['title' => 'ভ্যাকুয়াম প্যাকেজিং', 'desc' => 'তাজা চা পাতা ভ্যাকুয়াম সিল প্যাকেজিং।'],
                    ['title' => 'আপনার দরজায় ডেলিভারি', 'desc' => '২৪ ঘন্টার মধ্যে ডেলিভারি।'],
                    ['title' => 'আপনার কাপে ভালোবাসা', 'desc' => 'প্রতিটি চুমুকে সিলেটের পাহাড়ের স্বাদ।'],
                ],
            ],

            'review' => [
                'status' => true,
                'badge' => 'গ্রাহকদের মতামত',
                'title_1' => 'আমাদের ',
                'title_highlight' => 'সন্তুষ্ট',
                'title_2' => ' গ্রাহকরা কী বলছেন',
                'description' => '৫,০০+ সন্তুষ্ট গ্রাহক',
                'stats' => [
                    ['value' => '৫,০০০+', 'label' => 'সন্তুষ্ট গ্রাহক'],
                    ['value' => '৪.৮/৫', 'label' => 'গড় রেটিং'],
                    ['value' => '১০,০০০+', 'label' => 'অর্ডার সম্পন্ন'],
                    ['value' => '৯৮%', 'label' => 'পুনরায় অর্ডার'],
                ],
            ],

            'footer' => [
                'status' => true,
                'brand_name' => 'অ্যারোমা ব্লেন্ড (Aroma Blend)',
                'brand_description' => 'সিলেটের পাহাড়ি বাগান থেকে বিশুদ্ধ জৈব চা পাতা।',
                'quick_links_title' => 'দ্রুত লিংক',
                'quick_links' => [
                    ['label' => 'পণ্যসমূহ', 'href' => '#products'],
                    ['label' => 'অফার', 'href' => '#offer'],
                    ['label' => 'রিভিউ', 'href' => '#reviews'],
                    ['label' => 'যোগাযোগ', 'href' => '#contact'],
                ],
                'contact_title' => 'যোগাযোগ',
                'contact_phone' => '+৮৮০ ১XXX-XXXXXX',
                'contact_email' => 'info@aromablend.com',
                'contact_address' => 'সিলেট, বাংলাদেশ',
            ],

            'mail' => [
                'status' => true,
                'emails' => [
                    ['email' => 'admin@aromablend.com', 'active' => true],
                ],
            ],

            'ribbon' => [
                'status' => true,
                'color' => 'green',
                'texts' => [
                    ['badge_text' => 'ফ্ল্যাশ সেল!', 'promotion_text' => 'সকল পণ্যে ২০% ছাড়', 'cta' => 'অফার দেখুন', 'link_url' => '#offer'],
                    ['badge_text' => 'নতুন!', 'promotion_text' => 'গ্রীন টি কালেকশন আসছে', 'cta' => 'দেখুন', 'link_url' => '#products'],
                    ['badge_text' => 'ফ্রি ডেলিভারি', 'promotion_text' => '৫০০৳ এর উপরে অর্ডারে', 'cta' => 'অর্ডার করুন', 'link_url' => '#checkout'],
                ],
                'timer' => [
                    'enabled' => true,
                    'countdown_label' => 'অফার শেষ হতে বাকি',
                    'start_date' => date('Y-m-d'),
                    'end_date' => date('Y-m-d', strtotime('+7 days')),
                ],
            ],
        ];

        $admin = User::where('is_admin', true)->first();

        if ($admin) {
            $admin->settings = $defaults;
            $admin->save();
        }
    }
}
