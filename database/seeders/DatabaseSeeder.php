<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     *
     * Order matters when FKs are involved:
     *  1. Admin user (no FKs)
     *  2. Products (no FKs)           → products table
     *  3. ProductSeeder               → product_images, product_tags (FK → products)
     *  4. Reviews                     → reviews (FK → products after migration)
     *  5. DeliveryCharges             → no FKs
     *  6. PaymentMethods              → no FKs
     *  7. Currencies                  → no FKs
     *  8. Landing content (user data) → depends on admin user existing
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            DeliveryChargeSeeder::class,
            PaymentMethodSeeder::class,
            ProductSeeder::class,          // FK: none (primary table)
            ReviewSeeder::class,           // FK: product_id (nullable)
            CurrencySeeder::class,
            LandingContentSeeder::class,   // depends on admin user
        ]);
    }
}
