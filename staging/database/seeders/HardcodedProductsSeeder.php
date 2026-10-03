<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class HardcodedProductsSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'cookies' => ['name' => 'Cookies', 'icon' => 'Signature Cookies', 'order' => 10],
            'brownies' => ['name' => 'Brownies', 'icon' => 'Signature Brownies', 'order' => 20],
            'tres-leches' => ['name' => 'Tres Leches', 'icon' => 'Milk Cakes', 'order' => 30],
            'drinks' => ['name' => 'Drinks', 'icon' => 'Cold Drinks', 'order' => 40],
            'boxes' => ['name' => 'Gift Boxes', 'icon' => 'Special Boxes', 'order' => 50],
        ];

        $products = [
            ['category' => 'cookies', 'name' => 'Classic Choc Chip Cookie', 'price' => 3.50, 'short_description' => 'Warm, soft, and chewy classic chocolate chip cookies loaded with gooey chocolate chips, delivering a timeless favorite in every bite.'],
            ['category' => 'cookies', 'name' => 'Brown Butter Cookie', 'price' => 3.50, 'short_description' => 'Rich and nutty brown butter cookies with a soft, chewy texture and a hint of caramelized flavor, perfect for a delightful treat.'],
            ['category' => 'cookies', 'name' => 'Double Choc Cookie', 'price' => 3.50, 'short_description' => 'Decadent double chocolate cookies with a rich chocolatey base, loaded with chocolate chunks and topped with a silky chocolate drizzle.'],
            ['category' => 'cookies', 'name' => 'White Choc Cookie', 'price' => 2.25, 'compare_price' => 3.00, 'short_description' => 'Soft and chewy cookies loaded with creamy white chocolate chips, offering a sweet and buttery flavor that is simply irresistible.'],
            ['category' => 'cookies', 'name' => 'MnMs Cookie', 'price' => 3.50, 'short_description' => 'Chewy cookies bursting with colorful M&Ms, combining fun and flavor in every delicious bite.'],
            ['category' => 'cookies', 'name' => 'Lotus Cookie', 'price' => 3.50, 'short_description' => 'Lotus cookies drizzled with rich caramel and topped with crunchy Lotus bits, creating a delightful blend of flavors and textures.'],
            ['category' => 'cookies', 'name' => 'Oreo Cookie', 'price' => 3.50, 'short_description' => 'Decadent cookies loaded with creamy Oreo chunks, delivering a delightful twist on a classic favorite with every indulgent bite.'],
            ['category' => 'cookies', 'name' => 'Salted Caramel Cookie', 'price' => 3.50, 'short_description' => 'Soft and buttery cookies filled with rich salted caramel and a hint of sea salt, perfectly balancing sweet and savory in every bite.'],
            ['category' => 'cookies', 'name' => "S'mores Cookie", 'price' => 3.50, 'short_description' => 'Delightfully chewy cookies packed with gooey marshmallows, chocolate chunks, and crunchy graham cracker bits.'],

            ['category' => 'brownies', 'name' => 'Kunafa Brownie', 'price' => 4.00, 'is_bestseller' => true, 'short_description' => 'A rich fusion of crispy golden kunafa layers and indulgent gooey brownie, the perfect balance of crunch and dessert bliss.'],
            ['category' => 'brownies', 'name' => 'Classic Brownie', 'price' => 3.50, 'short_description' => 'Rich, fudgy, and made with premium Belgian chocolate. A timeless classic done perfectly.'],
            ['category' => 'brownies', 'name' => 'Biscoff Brownie', 'price' => 3.50, 'short_description' => 'Fudgy brownie swirled with creamy Biscoff spread and topped with crushed Lotus biscuits for an irresistible caramelised crunch.'],
            ['category' => 'brownies', 'name' => 'Oreo Brownie', 'price' => 3.50, 'short_description' => 'Dense chocolate brownie loaded with Oreo chunks throughout and a creamy Oreo topping.'],
            ['category' => 'brownies', 'name' => 'Double Choc Brownie', 'price' => 3.50, 'short_description' => 'Gooey centre with layers of milk and dark Belgian chocolate for the ultimate chocolate lover.'],
            ['category' => 'brownies', 'name' => 'Salted Caramel Brownie', 'price' => 3.50, 'short_description' => 'Buttery caramel swirls folded through fudgy brownie with a generous sprinkle of sea salt flakes.'],
            ['category' => 'brownies', 'name' => 'MnMs Brownie', 'price' => 3.50, 'short_description' => 'Chewy fudgy brownie packed with colorful M&Ms for a fun and indulgent treat.'],
            ['category' => 'brownies', 'name' => 'White Chocolate Brownie', 'price' => 3.50, 'short_description' => 'Creamy white chocolate chunks melted into a soft, dense brownie base for a sweeter, lighter bite.'],

            ['category' => 'tres-leches', 'name' => 'Kunafa Tres Leches', 'price' => 7.99, 'short_description' => 'A decadent tres leches cake soaked in three milks and topped with creamy whipped finish and kunafa notes.'],
            ['category' => 'tres-leches', 'name' => 'Strawberry Tres Leches', 'price' => 7.99, 'is_bestseller' => true, 'short_description' => 'Strawberry style tres leches with fresh berry notes and a sweet milk soak.'],
            ['category' => 'tres-leches', 'name' => 'Saffron and Rose Tres Leches', 'price' => 7.99, 'is_new' => true, 'short_description' => 'A flavour infused tres leches combining aromatic saffron and delicate rose tastes.'],
            ['category' => 'tres-leches', 'name' => 'Pistachio and White Chocolate Tres Leches', 'price' => 7.99, 'short_description' => 'A rich tres leches with pistachio notes and white chocolate accents.'],
            ['category' => 'tres-leches', 'name' => 'Mocha Chocolate Tres Leches', 'price' => 7.99, 'short_description' => 'A chocolate coffee mocha twist on the classic milk soaked cake.'],
            ['category' => 'tres-leches', 'name' => 'Lotus Tres Leches', 'price' => 7.99, 'short_description' => 'Lotus inspired tres leches paired with creamy sponge and caramelised cookie flavour.'],
            ['category' => 'tres-leches', 'name' => 'Classic Caramel Tres Leches', 'price' => 7.99, 'short_description' => 'Traditional tres leches cake with a caramel flavour and soft whipped topping.'],

            ['category' => 'drinks', 'name' => 'Mango Iced Matcha', 'price' => 4.50, 'short_description' => 'A vibrant fusion of earthy Japanese matcha, creamy milk, and sweet tropical mango.'],
            ['category' => 'drinks', 'name' => 'Mango Limka', 'price' => 4.50, 'short_description' => 'A chilled tropical refreshment with juicy mango and zesty Limka soda.'],
            ['category' => 'drinks', 'name' => 'Summer Berry Chiller', 'price' => 4.50, 'short_description' => 'A cool blend of mixed berries, lightly sweetened and chilled to perfection.'],
            ['category' => 'drinks', 'name' => 'Iced Vanilla Matcha', 'price' => 4.50, 'short_description' => 'Smooth vanilla with earthy matcha and milk for a balanced iced latte.'],
            ['category' => 'drinks', 'name' => 'French Vanilla Latte', 'price' => 4.50, 'short_description' => 'Premium espresso with silky French vanilla syrup, served hot or iced.'],
            ['category' => 'drinks', 'name' => 'Iced Strawberry Matcha', 'price' => 4.50, 'short_description' => 'Earthy matcha with creamy milk and sweet strawberry notes.'],

            ['category' => 'boxes', 'name' => 'Craving Cookies Box of 6', 'price' => 20.99, 'short_description' => 'A box of 6 handcrafted cookies with a different flavour in each slot.'],
            ['category' => 'boxes', 'name' => 'Craving Cookies Box of 4', 'price' => 13.99, 'short_description' => 'A box of 4 handcrafted cookies, each one customizable by flavour.'],
            ['category' => 'boxes', 'name' => 'Craving Brownies Box of 6', 'price' => 20.99, 'short_description' => 'Mix box of 6 rich brownies with one base and your choice of toppings.'],
            ['category' => 'boxes', 'name' => 'Craving Brownies Box of 4', 'price' => 12.00, 'compare_price' => 13.99, 'short_description' => 'Mix box of 4 fudgy brownies where you choose a topping for each piece.'],
        ];

        $categoryMap = [];
        foreach ($categories as $slug => $meta) {
            $categoryMap[$slug] = Category::query()->updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $meta['name'],
                    'icon' => $meta['icon'],
                    'order' => $meta['order'],
                    'is_active' => true,
                ]
            );
        }

        $created = 0;
        $updated = 0;
        $orderByCategory = [];

        foreach ($products as $data) {
            $categorySlug = $data['category'];
            $category = $categoryMap[$categorySlug] ?? null;
            if (! $category) {
                continue;
            }

            $slug = Str::slug($data['slug'] ?? $data['name']);
            $description = $data['description'] ?? $data['short_description'] ?? ($data['name'].' by Current Cravings.');
            $orderByCategory[$categorySlug] = ($orderByCategory[$categorySlug] ?? 0) + 10;

            $product = Product::query()->firstOrNew(['slug' => $slug]);
            $exists = $product->exists;

            $product->fill([
                'category_id' => $category->id,
                'name' => $data['name'],
                'slug' => $slug,
                'description' => $description,
                'short_description' => $data['short_description'] ?? null,
                'price' => $data['price'],
                'compare_price' => $data['compare_price'] ?? null,
                'is_featured' => (bool) ($data['is_featured'] ?? false),
                'is_new' => (bool) ($data['is_new'] ?? false),
                'is_bestseller' => (bool) ($data['is_bestseller'] ?? false),
                'is_active' => true,
                'stock' => (int) ($data['stock'] ?? 0),
                'order' => $orderByCategory[$categorySlug],
            ]);

            if (! isset($data['image']) && ! $exists) {
                $product->image = null;
            } elseif (isset($data['image'])) {
                $product->image = $data['image'];
            }

            $product->save();

            if ($exists) {
                $updated++;
            } else {
                $created++;
            }
        }

        if ($this->command) {
            $this->command->info("Hardcoded products sync complete. Created: {$created}, Updated: {$updated}");
        }
    }
}

