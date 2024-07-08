<?php

namespace App\Http\Controllers;

use App\Category;
use App\OutProductReport;
use App\Product;
use App\ProductsInCategory;
use App\Supplier;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index() {
        $categories = Category::all();
        $suppliers = Supplier::all();

        return view('barangKeluar', compact('categories', 'suppliers'));
    }




    public function showOption(Request $request) {
        $products = ProductsInCategory::where('categoryName', $request->categoryName)->get();

        return response()->json($products);
    }




    public function save(Request $request) {
        $data = $request->input('data');

        // Lakukan penyimpanan menggunakan foreach
        foreach($data as $item) {
            // MASUKA KE DALAM TABEL REPORT
            OutProductReport::create([
                'categoryName' => $item['categoryname'],
                'productName' => $item['productname'],
                'amount' => $item['amount'],
                'date' => $item['date'],
            ]);


            // MASUKAN KE DALAM TABEL PRODUCT
            // Cari produk berdasarkan kategori dan nama
            $product = Product::where('categoryName', $item['categoryname'])
                                ->where('productName', $item['productname'])
                                ->first();

            if ($product) {
                // Jika produk ditemukan, kurangi jumlahnya
                $product->amount -= $item['amount'];

                if ($product->amount > 0) {
                // Jika jumlah produk masih lebih dari 0, simpan perubahan
                $product->save();
                } else {
                // Jika jumlah produk kurang dari atau sama dengan 0, hapus produk
                $product->delete();
                }
            }
            // Jika produk tidak ditemukan, tidak perlu melakukan apa-apa
        }

        // Response jika sukses
        return response()->json(['message' => 'Data saved successfully.'], 200);
    }
}
