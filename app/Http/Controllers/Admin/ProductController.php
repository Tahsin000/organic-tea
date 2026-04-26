<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['images', 'tags'])->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%")
                  ->orWhere('badge', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $products = $query->paginate(15)->withQueryString();

        return view('admin.ecommerce.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.ecommerce.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'slug'           => 'nullable|string|max:255',
            'desc'           => 'nullable|string',
            'price'          => 'required|numeric|min:0',
            'original_price' => 'required|numeric|min:0',
            'badge'          => 'nullable|string|max:100',
            'stock'          => 'required|integer|min:0',
            'discount_label' => 'nullable|string|max:255',
            'review_count'   => 'nullable|integer|min:0',
            'is_active'      => 'nullable|in:0,1',
            'sort_order'     => 'nullable|integer|min:0',
            'images'         => 'nullable|array',
            'images.*'       => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'tags'           => 'nullable|array',
            'tags.*.label'   => 'required_with:tags|string|max:255',
            'tags.*.color'   => 'nullable|in:green,red,amber,blue,purple',
        ]);

        $validated['slug']        = Str::slug($validated['slug'] ?? $validated['name']);
        $validated['is_active']   = ($validated['is_active'] ?? '0') === '1';
        $validated['sort_order']  = $validated['sort_order'] ?? 0;
        $validated['review_count']= $validated['review_count'] ?? 0;

        DB::transaction(function () use ($request, $validated) {
            $product = Product::create(collect($validated)->except(['images', 'tags'])->toArray());

            // Handle image uploads
            if ($request->hasFile('images')) {
                $isPrimary = true;
                foreach ($request->file('images') as $i => $file) {
                    $path = ImageService::upload($file, 'products');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => $path,
                        'sort_order' => $i + 1,
                        'is_primary' => $isPrimary,
                    ]);
                    $isPrimary = false;
                }
            }

            // Handle tags
            if (!empty($validated['tags'])) {
                foreach ($validated['tags'] as $i => $tag) {
                    ProductTag::create([
                        'product_id' => $product->id,
                        'label'      => $tag['label'],
                        'color'      => $tag['color'] ?? 'green',
                        'sort_order' => $i + 1,
                    ]);
                }
            }
        });

        return redirect()->route('admin.ecommerce.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $product->load(['images', 'tags']);
        return view('admin.ecommerce.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'slug'           => 'nullable|string|max:255',
            'desc'           => 'nullable|string',
            'price'          => 'required|numeric|min:0',
            'original_price' => 'required|numeric|min:0',
            'badge'          => 'nullable|string|max:100',
            'stock'          => 'required|integer|min:0',
            'discount_label' => 'nullable|string|max:255',
            'review_count'   => 'nullable|integer|min:0',
            'is_active'      => 'nullable|in:0,1',
            'sort_order'     => 'nullable|integer|min:0',
            'new_images'     => 'nullable|array',
            'new_images.*'   => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'delete_images'  => 'nullable|array',
            'delete_images.*'=> 'integer|exists:product_images,id',
            'primary_image'  => 'nullable|integer|exists:product_images,id',
            'tags'           => 'nullable|array',
            'tags.*.label'   => 'required_with:tags|string|max:255',
            'tags.*.color'   => 'nullable|in:green,red,amber,blue,purple',
        ]);

        $validated['slug']         = Str::slug($validated['slug'] ?? $validated['name']);
        $validated['is_active']    = ($validated['is_active'] ?? '0') === '1';
        $validated['sort_order']   = $validated['sort_order'] ?? 0;
        $validated['review_count'] = $validated['review_count'] ?? 0;

        DB::transaction(function () use ($request, $product, $validated) {
            $product->update(collect($validated)->except(['new_images', 'delete_images', 'primary_image', 'tags'])->toArray());

            // Delete selected images
            if (!empty($validated['delete_images'])) {
                $toDelete = ProductImage::whereIn('id', $validated['delete_images'])
                    ->where('product_id', $product->id)->get();
                foreach ($toDelete as $img) {
                    ImageService::delete($img->image_path);
                    $img->delete();
                }
            }

            // Set primary image
            if (!empty($validated['primary_image'])) {
                $product->images()->update(['is_primary' => false]);
                $product->images()->where('id', $validated['primary_image'])->update(['is_primary' => true]);
            }

            // Upload new images
            if ($request->hasFile('new_images')) {
                $nextOrder = $product->images()->max('sort_order') + 1;
                $hasPrimary = $product->images()->where('is_primary', true)->exists();
                foreach ($request->file('new_images') as $file) {
                    $path = ImageService::upload($file, 'products');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => $path,
                        'sort_order' => $nextOrder++,
                        'is_primary' => !$hasPrimary,
                    ]);
                    $hasPrimary = true;
                }
            }

            // Replace all tags
            $product->tags()->delete();
            if (!empty($validated['tags'])) {
                foreach ($validated['tags'] as $i => $tag) {
                    ProductTag::create([
                        'product_id' => $product->id,
                        'label'      => $tag['label'],
                        'color'      => $tag['color'] ?? 'green',
                        'sort_order' => $i + 1,
                    ]);
                }
            }
        });

        return redirect()->route('admin.ecommerce.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        // Remove uploaded images from storage
        foreach ($product->images as $img) {
            if ($img->image_path) {
                ImageService::delete($img->image_path);
            }
        }
        $product->delete();

        return redirect()->route('admin.ecommerce.products.index')
            ->with('success', 'Product deleted successfully.');
    }

    public function toggleStatus(Product $product)
    {
        $product->update(['is_active' => !$product->is_active]);
        return back()->with('success', 'Product status updated.');
    }

    public function destroyImage(Product $product, \App\Models\ProductImage $image)
    {
        // Ensure the image belongs to this product
        abort_if($image->product_id !== $product->id, 403);

        ImageService::delete($image->image_path);
        $image->delete();

        // If that was the primary image, promote the next one
        if ($image->is_primary) {
            $next = $product->images()->first();
            if ($next) {
                $next->update(['is_primary' => true]);
            }
        }

        return back()->with('success', 'Image deleted.');
    }
}
