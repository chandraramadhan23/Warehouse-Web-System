<?php

namespace App\Http\Controllers;

use App\Category;
use App\ProductsInCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PengaturanBarangController extends Controller
{
    public function index() {
        $categories = Category::all();

        return view('pengaturans.barang', compact('categories'));
    }



    // ShowTable
    public function showTable(Request $request) {
        $products = ProductsInCategory::where('categoryName', $request->categoryName)->get();

        return DataTables::of($products)->make(true);
    }


    // Add
    public function add(Request $request) {
        ProductsInCategory::create([
            'categoryName' => $request->categoryName,
            'productName' => $request->productName,
        ]);
    }
}
