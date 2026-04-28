<?php

namespace App\Http\Controllers;

use App\Models\DeliveryCharge;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class LandingPageController extends Controller
{
    private const ACTIVE_PRODUCTS_CACHE_KEY = 'active_products_v2';

    public function index()
    {
        $reviews = Review::active()
            ->inRandomOrder()
            ->get()
            ->map(fn ($r) => [
                'name'     => $r->name,
                'location' => $r->location,
                'initial'  => $r->initial ?? mb_substr($r->name, 0, 2),
                'image'    => $r->image_url,
                'text'     => $r->text,
                'stars'    => $r->stars,
            ]);

        $siteSettings = $this->getSiteSettings();

        $activeSettings = [];
        foreach ($siteSettings as $key => $section) {
            if (is_array($section) && isset($section['status'])) {
                // Ribbon always passed through (needed for v-if status check)
                if ($key === 'ribbon') {
                    $activeSettings[$key] = $section;
                    continue;
                }
                if ($section['status'] === true || $section['status'] === 'true' || $section['status'] === 1) {
                    $activeSettings[$key] = $section;
                }
            } elseif (!is_array($section)) {
                $activeSettings[$key] = $section;
            }
        }

        $products = $this->getActiveProducts();

        // Pass all highlighted products for the hero section slider
        $highlightedProducts = array_values(array_filter(
            $products,
            fn (array $product) => (bool) ($product['highlight'] ?? false)
        ));

        return Inertia::render('LandingPage', [
            'products'          => $products,
            'highlightedProducts' => $highlightedProducts,
            'reviews'           => $reviews,
            'site'              => $activeSettings,
        ]);
    }

    public function product(Request $request)
    {
        $slug    = $request->route('productSlug');
        $product = Product::active()
            ->with(['images', 'tags'])
            ->where('slug', $slug)
            ->firstOrFail();

        $allProducts = $this->getActiveProducts();
        $siteSettings = $this->getSiteSettings();

        return Inertia::render('ProductDetail', [
            'product'  => $product->toFrontendArray(),
            'products' => $allProducts,
            'site'     => $siteSettings,
        ]);
    }

    private function getSiteSettings(): array
    {
        return Cache::remember('site_settings', now()->addHours(24), function (): array {
            return User::getSiteSettings();
        });
    }

    private function getActiveProducts(): array
    {
        return Cache::remember(self::ACTIVE_PRODUCTS_CACHE_KEY, now()->addHours(6), function (): array {
            return Product::active()
                ->with(['images', 'tags'])
                ->orderBy('sort_order')
                ->get()
                ->mapWithKeys(fn ($product) => [$product->slug => $product->toFrontendArray()])
                ->all();
        });
    }
}
