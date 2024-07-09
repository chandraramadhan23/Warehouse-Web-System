<?php

namespace App\Http\Controllers;

use App\InProductReport;
use App\OutProductReport;
use App\Product;
use App\ProductsInCategory;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() {

        $totalKategori = ProductsInCategory::distinct('categoryName')->count('categoryName');



        $totalProduct = Product::sum('amount');



        $totalSupplier = Supplier::distinct('supplierName')->count('supplierName');

        // Mengambil data supplier
        $suppliers = Supplier::select('supplierName', 'noHp')->get();



        $totalLaporanMasuk = InProductReport::distinct('id')->count('id');



        $totalLaporanKeluar = OutProductReport::distinct('id')->count('id');



        // Menghitung jumlah produk berdasarkan nama produk
        $amountsByProduct = Product::select('productName', DB::raw('sum(amount) as total_amount'))
            ->groupBy('productName')
            ->get();
        // Mengubah hasil menjadi array yang lebih mudah diakses
        $amounts = $amountsByProduct->mapWithKeys(function ($item) {
            return [$item->productName => $item->total_amount];
        });



        // Menghitung jumlah produk berdasarkan kategori
        $amountsByCategory = Product::select('categoryName', DB::raw('sum(amount) as total_amount'))
            ->groupBy('categoryName')
            ->get();
        // Mengubah hasil menjadi array yang lebih mudah diakses
        $categoryAmounts = $amountsByCategory->mapWithKeys(function ($item) {
            return [$item->categoryName => $item->total_amount];
        });



        return view('/dashboard', compact('totalSupplier', 'suppliers', 'totalKategori', 'totalProduct', 'totalLaporanMasuk', 'totalLaporanKeluar', 'amounts', 'categoryAmounts'));
    }
}
