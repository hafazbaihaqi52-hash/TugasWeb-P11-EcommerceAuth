<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ==========================================
        // 1. MEMBUAT USER
        // ==========================================
        $users = User::factory()->count(5)->create();

        // ==========================================
        // 2. MEMBUAT KATEGORI
        // ==========================================
        $categories = Category::factory()->count(10)->create();

        // ==========================================
        // 3. MEMBUAT TAG
        // ==========================================
        $tags = Tag::factory()->count(15)->create();

        // ==========================================
        // 4. MEMBUAT 50 PRODUK
        // ==========================================
        $products = Product::factory()
            ->count(50)
            ->create([
                'category_id' => fn () => $categories->random()->id,
                'user_id' => fn () => $users->random()->id,
            ]);

        // ==========================================
        // 5. MENGHUBUNGKAN PRODUK DENGAN TAG
        // ==========================================
        foreach ($products as $product) {
            $product->tags()->attach(
                $tags->random(rand(1, 3))->pluck('id')->toArray()
            );
        }

        // ==========================================
        // 6. MEMBUAT 5 ORDER
        // ==========================================
        $orders = collect();

        foreach ($users as $user) {
            $orders->push(
                Order::create([
                    'user_id' => $user->id,
                    'status' => 'completed',
                    'total' => 0,
                ])
            );
        }

        // ==========================================
        // 7. MEMBUAT ORDER ITEM
        // ==========================================
        foreach ($orders as $order) {

            $selectedProducts = $products
                ->random(rand(2, 4));

            $total = 0;

            foreach ($selectedProducts as $product) {

                $qty = rand(1, 3);
                $price = $product->price;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'qty' => $qty,
                    'price' => $price,
                ]);

                $total += $qty * $price;
            }

            // ==========================================
            // 8. UPDATE TOTAL ORDER
            // ==========================================
            $order->update([
                'total' => $total,
            ]);
        }
    }
}