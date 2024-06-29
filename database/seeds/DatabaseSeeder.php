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
        // Products
        Product::create([
            'categoryName' => 'Jaket',
            'productName' => 'Jaket Cruneck',
            'amount' => '50',
        ]);





        // ProductInCategory
        ProductsInCategory::create([
            'categoryName' => 'Jaket',
            'productName' => 'Jaket Cruneck',
        ]);

        ProductsInCategory::create([
            'categoryName' => 'Jaket',
            'productName' => 'Jaket Hoodie',
        ]);
        
        ProductsInCategory::create([
            'categoryName' => 'Baju',
            'productName' => 'Baju Adidas',
        ]);

        ProductsInCategory::create([
            'categoryName' => 'Baju',
            'productName' => 'Baju Nike',
        ]);

        ProductsInCategory::create([
            'categoryName' => 'Baju',
            'productName' => 'Baju Puma',
        ]);




        // Category
        Category::create([
            'categoryName' => 'Jaket',
        ]);

        Category::create([
            'categoryName' => 'Baju',
        ]);




        // Supplier
        Supplier::create([
            'supplierName' => 'Sutrisno Wijayanto',
            'alamat' => 'Jalan Percetakan Negara NO 12 Jakarta Pusat, DKI Jakarta, Indonesia',
            'noHp' => '08121345432'
        ]);

        Supplier::create([
            'supplierName' => 'Tukijem Batako',
            'alamat' => 'Mall Bellagio NO 22 Jakarta Selatan, DKI Jakarta, Indonesia',
            'noHp' => '0812134789'
        ]);

        Supplier::create([
            'supplierName' => 'Krisna Adi Pati',
            'alamat' => 'Gn Mardani NO 42 Kalimantan Timur, Indonesia',
            'noHp' => '08999445765'
        ]);
    }
}
