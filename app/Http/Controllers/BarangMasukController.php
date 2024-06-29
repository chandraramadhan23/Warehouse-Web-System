<?php

namespace App\Http\Controllers;

use App\Category;
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




    public function addSession(Request $request) {
        $items = session()->get('items', []);

        $newItem = [
            'category' => $request->input('category'),
            'productname' => $request->input('productname'),
            'supplier' => $request->input('supplier'),
            'amount' => $request->input('amount'),
            'date' => $request->input('date'),
        ];

        $items[] = $newItem;
        session()->put('items', $items);

        return response()->json(['success' => 'Item added successfully']);
    }



    public function delete($id) {
        $items = session()->get('items', []);

        if(isset($items[$id])) {
            unset($items[$id]);
            session()->put('items', array_values($items));
        }

        return response()->json(['success' => 'Item deleted successfully']);
    }
}
