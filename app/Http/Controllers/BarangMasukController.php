<?php

namespace App\Http\Controllers;

use App\Category;
use App\InProductReport;
use App\Product;
use App\ProductsInCategory;
use App\Supplier;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use League\CommonMark\Inline\Element\Newline;
use Yajra\DataTables\DataTables;

class BarangMasukController extends Controller
{
    public function index() {
        $categories = Category::all();
        $suppliers = Supplier::all();

        return view('barangMasuk', compact('categories', 'suppliers'));
    }


    
    public function showTable() {
        $items = session()->get('items', []);

        $items = array_map(function($item, $index) {
            $item['id'] = $index;
            return $item;
        }, $items, array_keys($items));

        return DataTables::of($items)->make(true);
    }



    public function showOption(Request $request) {
        $products = ProductsInCategory::where('categoryName', $request->categoryName)->get();

        return response()->json($products);
    }




    public function delete($id) {
        $items = session()->get('items', []);

        if(isset($items[$id])) {
            unset($items[$id]);
            session()->put('items', array_values($items));
        }

        return response()->json(['success' => 'Item deleted successfully']);
    }

    public function save(Request $request) {
        $data = $request->input('data');

        // Lakukan penyimpanan menggunakan foreach
        foreach ($data as $item) {
            // MASUKA KE DALAM TABEL REPORT
            InProductReport::create([
                'categoryName' => $item['categoryname'],
                'productName' => $item['productname'],
                'supplierName' => $item['supplier'],
                'amount' => $item['amount'],
                'date' => $item['date'],
            ]);

            // MASUKAN KE DALAM TABEL PRODUCT
            // Cari produk berdasarkan kategori dan nama
            $product = Product::where('categoryName', $item['categoryname'])
                                ->where('productName', $item['productname'])
                                ->first();

            if ($product) {
                // Jika produk ditemukan, tambahkan jumlahnya
                $product->amount += $item['amount'];
                $product->save();
            } else {
                // Jika produk tidak ditemukan, buat produk baru
                Product::create([
                    'categoryName' => $item['categoryname'],
                    'productName' => $item['productname'],
                    'amount' => $item['amount'],
                ]);
            }
        }

        // Response jika sukses
        return response()->json(['message' => 'Data saved successfully.'], 200);
    }
}
