<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use Illuminate\Database\Seeder;

/**
 * ProductSeeder
 *
 * Seeds products → product_images → product_tags (in dependency order).
 * Images use the public default fallback (images/product-d.png) when no
 * real upload is available, so the seeded products will always have a
 * visible thumbnail on a fresh install.
 */
class ProductSeeder extends Seeder
{
    /** Default placeholder stored as a public-folder path marker */
    private const DEFAULT_IMG = null; // null → model will fall back to asset('images/product-d.png')

    public function run(): void
    {
        $products = [
            [
                'product' => [
                    'name'           => 'স্পেশাল গ্রিন টি',
                    'slug'           => 'green-tea',
                    'desc'           => 'সিলেটের পাহাড়ি বাগানের সবচেয়ে সতেজ সবুজ চা পাতা। অ্যান্টিঅক্সিড্যান্টে ভরপুর, প্রতিদিনের স্বাস্থ্যের জন্য আদর্শ। হালকা মিষ্টি স্বাদ যা আপনাকে সুস্থ রাখবে সারাদিন।',
                    'price'          => 350,
                    'original_price' => 450,
                    'badge'          => 'বেস্ট সেলার',
                    'stock'          => 47,
                    'discount_label' => 'প্রথম অর্ডারে ২০% ছাড়',
                    'review_count'   => 128,
                    'is_active'      => true,
                    'sort_order'     => 1,
                ],
                // No real uploads yet – all images stay null → default image shown
                'images' => [
                    ['image_path' => self::DEFAULT_IMG, 'is_primary' => true,  'sort_order' => 1],
                    ['image_path' => self::DEFAULT_IMG, 'is_primary' => false, 'sort_order' => 2],
                    ['image_path' => self::DEFAULT_IMG, 'is_primary' => false, 'sort_order' => 3],
                ],
                'tags' => [
                    ['label' => 'বেস্ট সেলার',             'color' => 'green',  'sort_order' => 1],
                    ['label' => 'প্রথম অর্ডারে ২০% ছাড়', 'color' => 'red',    'sort_order' => 2],
                    ['label' => 'অ্যারোমা ব্লেন্ড স্পেশাল',          'color' => 'green',  'sort_order' => 3],
                ],
            ],
            [
                'product' => [
                    'name'           => 'প্রিমিয়াম ব্ল্যাক টি',
                    'slug'           => 'black-tea',
                    'desc'           => 'গাঢ় সুগন্ধি কালো চা - সকালের নাস্তার পারফেক্ট সঙ্গী। দীর্ঘ সময় ধরে ফার্মেন্টেশন করা প্রতিটি পাতা, যা দেয় শক্তিশালী স্বাদ এবং গভীর অ্যারোমা।',
                    'price'          => 280,
                    'original_price' => 350,
                    'badge'          => 'নতুন',
                    'stock'          => 62,
                    'discount_label' => 'প্রথম অর্ডারে ২০% ছাড়',
                    'review_count'   => 74,
                    'is_active'      => true,
                    'sort_order'     => 2,
                ],
                'images' => [
                    ['image_path' => self::DEFAULT_IMG, 'is_primary' => true,  'sort_order' => 1],
                    ['image_path' => self::DEFAULT_IMG, 'is_primary' => false, 'sort_order' => 2],
                ],
                'tags' => [
                    ['label' => 'নতুন',                    'color' => 'blue',  'sort_order' => 1],
                    ['label' => 'প্রথম অর্ডারে ২০% ছাড়', 'color' => 'red',   'sort_order' => 2],
                ],
            ],
            [
                'product' => [
                    'name'           => 'ফ্লোরাল হার্বাল টি',
                    'slug'           => 'floral-tea',
                    'desc'           => 'গোলাপ ও জুঁই ফুলের মিশ্রণে তৈরি মনোরম হার্বাল চা। স্ট্রেস কমাতে ও ভালো ঘুমের জন্য জাদুকরী। সীমিত এডিশন - এখনই সংগ্রহ করুন।',
                    'price'          => 420,
                    'original_price' => 550,
                    'badge'          => 'সীমিত',
                    'stock'          => 18,
                    'discount_label' => 'সীমিত সময়ের অফার',
                    'review_count'   => 56,
                    'is_active'      => true,
                    'sort_order'     => 3,
                ],
                'images' => [
                    ['image_path' => self::DEFAULT_IMG, 'is_primary' => true,  'sort_order' => 1],
                    ['image_path' => self::DEFAULT_IMG, 'is_primary' => false, 'sort_order' => 2],
                ],
                'tags' => [
                    ['label' => 'সীমিত এডিশন',            'color' => 'amber', 'sort_order' => 1],
                    ['label' => 'ফুলের সুগন্ধ',           'color' => 'green', 'sort_order' => 2],
                    ['label' => 'প্রথম অর্ডারে ২০% ছাড়', 'color' => 'red',   'sort_order' => 3],
                ],
            ],
            [
                'product' => [
                    'name'           => 'অ্যারোমা ব্লেন্ড কম্বো প্যাক',
                    'slug'           => 'combo-pack',
                    'desc'           => 'তিন ধরনের চা একসাথে - গ্রিন, ব্ল্যাক ও হার্বাল টি। পরিবারের সবার জন্য পারফেক্ট গিফট প্যাক। বিশেষ মূল্যে সাশ্রয়।',
                    'price'          => 950,
                    'original_price' => 1350,
                    'badge'          => 'সেরা ডিল',
                    'stock'          => 31,
                    'discount_label' => 'বান্ডেল সেভিংস ৩০%',
                    'review_count'   => 203,
                    'is_active'      => true,
                    'sort_order'     => 4,
                ],
                'images' => [
                    ['image_path' => self::DEFAULT_IMG, 'is_primary' => true,  'sort_order' => 1],
                    ['image_path' => self::DEFAULT_IMG, 'is_primary' => false, 'sort_order' => 2],
                    ['image_path' => self::DEFAULT_IMG, 'is_primary' => false, 'sort_order' => 3],
                ],
                'tags' => [
                    ['label' => 'সেরা ডিল',               'color' => 'green', 'sort_order' => 1],
                    ['label' => '৩টি পণ্য একসাথে',        'color' => 'blue',  'sort_order' => 2],
                    ['label' => 'গিফট প্যাক',             'color' => 'amber', 'sort_order' => 3],
                    ['label' => 'প্রথম অর্ডারে ২০% ছাড়', 'color' => 'red',   'sort_order' => 4],
                ],
            ],
        ];

        foreach ($products as $data) {
            $product = Product::firstOrCreate(
                ['slug' => $data['product']['slug']],
                $data['product']
            );

            // Only seed images/tags if freshly created (avoid duplicates)
            if ($product->wasRecentlyCreated) {
                foreach ($data['images'] as $imgData) {
                    // Skip null-path placeholders — the Product model falls back to
                    // asset('images/product-d.png') when no images exist.
                    if ($imgData['image_path'] === null) {
                        continue;
                    }
                    ProductImage::create([
                        'product_id' => $product->id,
                        ...$imgData,
                    ]);
                }

                foreach ($data['tags'] as $tagData) {
                    ProductTag::create([
                        'product_id' => $product->id,
                        ...$tagData,
                    ]);
                }
            }
        }
    }
}
