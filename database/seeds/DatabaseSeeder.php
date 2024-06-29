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
        ProductsInCategory::create([
            'categoryName' => 'Jaket',
            'productName' => 'Jaket Jeans',
        ]);

        ProductsInCategory::create([
            'categoryName' => 'Jaket',
            'productName' => 'Jaket Bulu',
        ]);
        
        ProductsInCategory::create([
            'categoryName' => 'Baju',
            'productName' => 'Baju Brand',
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
            'nameSupplier' => 'Tukijem Batako',
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
