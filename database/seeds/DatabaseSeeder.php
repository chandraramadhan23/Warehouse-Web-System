<?php

use App\Category;
use App\InProductReport;
use App\OutProductReport;
use App\Product;
use App\ProductsInCategory;
use App\Supplier;
use App\User;
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

        // User
        User::create([
            'name' => 'M Chandra Ramadhan',
            'username' => 'chandra',
            'password'=> bcrypt('chandra'),
        ]);



        // Products
        Product::create([
            'categoryName' => 'Jaket',
            'productName' => 'Jaket Crewneck',
            'amount' => '150',
        ]);

        Product::create([
            'categoryName' => 'Jaket',
            'productName' => 'Jaket Hoodie',
            'amount' => '80',
        ]);

        Product::create([
            'categoryName' => 'Celana',
            'productName' => 'Kargo Panjang',
            'amount' => '120',
        ]);





        // ProductInCategory
        ProductsInCategory::create([
            'categoryName' => 'Jaket',
            'productName' => 'Jaket Crewneck',
        ]);

        ProductsInCategory::create([
            'categoryName' => 'Jaket',
            'productName' => 'Jaket Hoodie',
        ]);
        
        ProductsInCategory::create([
            'categoryName' => 'Celana',
            'productName' => 'Kargo Panjang',
        ]);

        ProductsInCategory::create([
            'categoryName' => 'Celana',
            'productName' => 'Kargo Pendek',
        ]);

        ProductsInCategory::create([
            'categoryName' => 'Celana',
            'productName' => 'Jeans Panjang',
        ]);




        // Category
        Category::create([
            'categoryName' => 'Jaket',
        ]);

        Category::create([
            'categoryName' => 'Celana',
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




        // InProductReport
        InProductReport::create([
            'categoryName' => 'Jaket',
            'productName' => 'Jaket Crewneck',
            'supplierName' => 'Sutrisno Wijayanto',
            'amount' => '100',
            'date' => '2024-04-07',
        ]);


        // OutProductReport
        OutProductReport::create([
            'categoryName' => 'Jaket',
            'productName' => 'Jaket Crewneck',
            'amount' => '50',
            'date' => '2024-04-07',
        ]);
    }
}
