<?php
use App\Models\User;
use App\Models\Review;
use App\Models\Product;
use App\Models\ProductTag;

// Update admin settings
$admin = User::where('is_admin', true)->first();
if ($admin) {
    $settings = $admin->settings;
    if ($settings) {
        $settingsJson = json_encode($settings, JSON_UNESCAPED_UNICODE);
        $settingsJson = str_replace(['অ্যারোমা ব্লেন্ড চা', 'অ্যারোমা ব্লেন্ড', 'organic-tea.com'], ['অ্যারোমা ব্লেন্ড', 'অ্যারোমা ব্লেন্ড', 'aromablend.com'], $settingsJson);
        $admin->settings = json_decode($settingsJson, true);
        $admin->save();
    }
}

// Update reviews
$reviews = Review::all();
foreach($reviews as $r) {
    $r->text = str_replace(['অ্যারোমা ব্লেন্ড চা', 'অ্যারোমা ব্লেন্ড'], ['অ্যারোমা ব্লেন্ড', 'অ্যারোমা ব্লেন্ড'], $r->text);
    $r->save();
}

// Update products
$products = Product::all();
foreach($products as $p) {
    $p->name = str_replace(['অ্যারোমা ব্লেন্ড কম্বো প্যাক', 'অ্যারোমা ব্লেন্ড'], ['অ্যারোমা ব্লেন্ড কম্বো প্যাক', 'অ্যারোমা ব্লেন্ড'], $p->name);
    $p->save();
}

// Update tags
$tags = ProductTag::all();
foreach($tags as $t) {
    $t->label = str_replace(['অ্যারোমা ব্লেন্ড স্পেশাল', 'অ্যারোমা ব্লেন্ড'], ['অ্যারোমা ব্লেন্ড স্পেশাল', 'অ্যারোমা ব্লেন্ড'], $t->label);
    $t->save();
}
echo "Database updated successfully.\n";
