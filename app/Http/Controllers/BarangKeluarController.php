<?php

namespace App\Http\Controllers;

use App\Category;
use App\OutProductReport;
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
        }

        // Response jika sukses
        return response()->json(['message' => 'Data saved successfully.'], 200);
    }
}
