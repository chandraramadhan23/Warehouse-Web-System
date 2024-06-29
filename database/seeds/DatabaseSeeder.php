<?php

use App\Category;
use App\Product;
use App\ProductsInCategory;
use App\Supplier;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Jaket Hoodie',
            'nameCategory' => 'Jaket',
            'amount' => '3',
        ]);

        Product::create([
            'name' => 'Jaket Cruneck',
            'nameCategory' => 'Jaket',
            'amount' => '2',
        ]);

        Product::create([
            'name' => 'Baju Adidas',
            'nameCategory' => 'Baju',
            'amount' => '20',
        ]);

        Product::create([
            'name' => 'Celana Kargo',
            'nameCategory' => 'Celana',
            'amount' => '2',
        ]);

        Product::create([
            'name' => 'Celana Pendek',
            'nameCategory' => 'Celana',
            'amount' => '36',
        ]);

        ProductsInCategory::create([
            'categoryName' => 'Topi',
            'productName' => 'Topi Golf',
        ]);

        Category::create([
            'nameCategory' => 'Jaket',
        ]);

        Category::create([
            'nameCategory' => 'Baju',
        ]);

        Category::create([
            'nameCategory' => 'Celana',
        ]);

        Supplier::create([
            'nameSupplier' => 'Sutrisno Wijayanto',
            'alamat' => 'Jalan Percetakan Negara NO 12 Jakarta Pusat, DKI Jakarta, Indonesia',
            'noHp' => '08121345432'
        ]);

        Supplier::create([
            'nameSupplier' => 'Krisna Adi Pati',
            'alamat' => 'Gn Mardani NO 42 Kalimantan Timur, Indonesia',
            'noHp' => '08999445765'
        ]);
    }
}
