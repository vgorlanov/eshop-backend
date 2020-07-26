<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Электроника'],
            ['name' => 'Книги'],
            ['name' => 'Бытовая техника'],
            ['name' => 'Товары для дома'],
            ['name' => 'Аксессуары'],
            ['name' => 'Смартфоны'],
            ['name' => 'Фантастика'],
            ['name' => 'Samsung'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        factory(App\Models\Product::class, 200)->create();
    }
}
